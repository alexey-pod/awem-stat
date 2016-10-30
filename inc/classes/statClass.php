<?php
	
class statClass{
	
	var $test_mode = false; // при включении этого режима генерятся рандомные даты 
	var $test_mode_data_total = 3000; // сколько данных вносить
	
	
	function __construct($config=null)	{	
		
		// loggerClass::writeLog( __METHOD__ .'()');
		// loggerClass::writeLog($config);
		
	
		if( isset($config['test_mode']) && $config['test_mode']==true){
			$this->test_mode = true;
			loggerClass::writeLog('test_mode ENABLED');
		}
		
		// loggerClass::writeLog($this->test_mode, '$this->test_mode');
		
		return;
	}
	
	public function fillData ($config=null)
	// заполнить тестовыми данными
	{
		loggerClass::writeLog( __METHOD__ .'()');
		
		$DB = new SQL();
		
		{// очистка базы
			// $DB->query = "TRUNCATE TABLE day";
			// $DB->exec();
			
			$DB->query = "TRUNCATE TABLE day_data";
			$DB->exec();
		}
		
		
		$total = $this->test_mode_data_total;
		
		$platform_array = array(0=>'iphone', 1=>'ipad');
		$event_array = array(0=>'Start', 1=>'End', 2=>'Finish');
		
		for ($x=0; $x<$total; $x++) {
			
			$user_id =  rand ( 0, 10000 );
			$device_id = md5($user_id).md5($user_id.'78');
			$platform = $platform_array[rand(0,count($platform_array)-1)];
			$event = $event_array[rand(0,count($event_array)-1)];
			$money =  rand ( 0, 10000 );
			$data = "Event=$event,Money=$money";
			
			$result=$this->addData(
				array(
					'user_id'=>$user_id, 
					'device_id'=>$device_id,
					'platform'=>$platform,
					'data'=>$data,
				)
			);
			// return;
		}//END for
		
		// return $res;
		// $res = $this->addData();
		loggerClass::writeLog( __METHOD__ .'() DONE');
	}//END
	
	public function addData ($config=null)
	// добавить данные за день
	{
		
		// loggerClass::writeLog( __METHOD__ .'()');
		// loggerClass::writeLog($config);
		
		$result = array();
		{// error
			if(
				!isset($config['user_id']) || $config['user_id']==''
				|| !isset($config['device_id']) || $config['device_id']==''
				|| !isset($config['platform']) || $config['platform']==''
				|| !isset($config['data']) || $config['data']==''
				){
				$result['error'] = array(
					"error_code" => 1,
					"error_msg"=> 'empty data',
				);
				return $result;
			}
		}//END error
		
		{// done
			
			$user_id = $config['user_id'];
			
			
			if($this->test_mode== true){
				// $datetime = mktime() - 2592000;	
				$datetime =  rand ( mktime(), mktime() - 2592000 );
			}
			else{
				// $datetime = mktime();	
				$datetime = $config['datetime'];	
			}
			
			$device_id = $config['device_id'];
			$platform = $config['platform'];
			$data = $config['data'];
			$day_id = $this->chekDayId(array('datetime'=>$datetime));
			
			$DB = new SQL();
			$DB->query = "
				INSERT INTO day_data
				SET user_id='$user_id', datetime='$datetime', device_id='$device_id', platform='$platform',
				data='$data', day_id='$day_id'
			";
			//loggerClass::writeLogA($DB->error);
			// loggerClass::writeLogA($DB->query);
			$DB->exec();
			
			$result['response'] = array(
				"result" => 'done'
			);
			
			// $this->updateDayDataTotal(array('day_id'=>$day_id));
			
			return $result;
			
		}//END done
		
	}//END
	
	
	protected function updateDayDataTotal ($config=null)
	// обновить число данных в дне
	// input: 
	// output: none
	{

		$day_id=$config['day_id'];
		$DB = new SQL();
		$DB->query = "
			UPDATE day s,
			( 
				select COUNT(sp.id) AS total
				FROM day_data sp
				WHERE sp.day_id='$day_id'
			) AS t2
			SET s.total=t2.total
			WHERE s.id='$day_id'
		";
		// loggerClass::writeLogA($DB->query);
		$DB->exec();
	}//END
	
	
	protected function chekDayId ($config=null)
	//** по переданному datetime - получить id дня к которому относятся данные***
	// по переданному datetime - получить время в 12 дня
	{
		// loggerClass::writeLog( __METHOD__ .'()');
		$datetime = $config['datetime'];
		
		// loggerClass::writeLog( $datetime ,'datetime');
		// loggerClass::writeLog( date("d.m.Y H:i:s", $datetime) );
		
		$datetime_12 = $this->getDatetimeDay12($datetime);
		return $datetime_12;
	}//END
	

	protected function getDatetimeDay12 ($datetime)
	// переданное время преобразовать в unix timestamp в формате 12 часов дня (12:00:00)
	{
		
		$datetime_new = mktime(12, 0, 0, 
			date("m", $datetime), // месяц
			date("d", $datetime), // день
			date("Y", $datetime) // год
		);
		
		return $datetime_new;
	}//END
	
	
	
	
	
	
	
	
	
	
	
	
	var $pp = 999;
	function getDayArray($config=null){
		$result = array();
		$DB = new SQL();
		{// LIMIT
			if(	isset($config['page'])	){
				if ($config['page']!='-1'){
					$limitCount = ($config['page']-1)*$this->pp;
					$LIMIT = " LIMIT $limitCount, ".$this->pp;
				}
			}
		}//END LIMIT
		{// Устанавливаем сортировку
			$ORDER='';
			if(	isset($config['sort'])	){
				$sort=$config['sort'];
				$sort_field=$config['sort_field'];
				$ORDER="ORDER BY f.$sort_field $sort ";
			}
		}// END Устанавливаем сортировку
		{// фильтрация
			if(isset($config['name']) && $config['name']){
				$name=$config['name'];
				$and_name="  AND f.name LIKE '%$name%' ";
			} 
		}
		{// запрос
			$DB->query = "
				SELECT DISTINCT(f.day_id) AS datetime
				FROM day_data f
				WHERE f.id!=0 $and_name
				$ORDER
				$LIMIT
			";
			// loggerClass::writeLogA($DB->query);
		}//END запрос
		
		{// получение данных
			$DB->exec();
			$i = 0;
			while ($arr = $DB->arr_assoc()) {
				foreach($arr as $key=>$val) {
					$result[$i][$key] = $val;
				}
				$i++;
			}
			
		}//END получение данных
		
		
		
		
		
		
		return $result;
	}// END 
	
	public function getDayItem ($config=null)
	// input: id
	// output:
	{
		// loggerClass::writeLogA('sitePageClass::getPageItem');
		
		$id=$config['id'];
		
		$DB = new SQL();
		$DB->query = "SELECT * FROM day WHERE id='$id' ";	
		$result = $DB->get(1);
		
		return $result;
	}//END
	
	public function deleteDayItem($config=null){
		
		$id=$config['id'];
		$DB = new SQL();
		
		$DB->query = " DELETE FROM day_data WHERE day_id='$id' ";	
		//loggerClass::writeLogA($DB->query);
		$DB->exec();
		
		return;
	}// END 
	public function deleteDayItemAll($config=null){
		
		$DB = new SQL();
		$DB->query = " DELETE FROM day_data ";	
		//loggerClass::writeLogA($DB->query);
		$DB->exec();
		
		return;
	}// END 
	public function getDayCsv($config=null)
	// получить статистику за день в формате csv
	{
		// loggerClass::writeLog( __METHOD__ .'()');
		// loggerClass::writeLog($config);
		
		if(!isset($config['id']) || $config['id']==0){
			return false;
		}
		
		$id = $config['id'];
		$DB = new SQL();
		$result = array();
		
		{// запрос
			$DB->query = "
				SELECT * FROM day_data 
				WHERE day_id='$id'
				ORDER BY datetime ASC
			";
			// loggerClass::writeLogA($DB->query);
		}//END запрос
		
		{// получение данных
			$DB->exec();
			$result = $DB->get();
		}//END получение данных
		// loggerClass::writeLog($result);
		
		
		foreach($result as $key=>$val) {
			if($key!=0){
				$str.= chr(10);
			}
			$datetime = date("d.m.Y H:i:s", $val['datetime']);
			$str.= $val['user_id'].";".$datetime.";".$val['device_id'].";".$val['platform'].";".$val['data'];	
		}
		
		// echo $str; 
		
		// $day_item = $this->getDayItem(array('id'=>$id));
		// $day = date("d.m.Y", $day_item['datetime']);
		$day = date("d.m.Y", $id);
		
		// loggerClass::writeLog($day, 'day');
		// loggerClass::writeLog($day_item);
		// return $result;
		
		{// отдача файла
			$content = $str;
			if(!$content) exit("Нечего сохранять");
			header('Content-Type: text/plain');
			header('Content-Disposition: attachment; filename='.$day.'.csv');
			header('Content-Transfer-Encoding: binary');
			header('Content-Length: '.strlen($content));
			echo $content;
		}
		
	}// END 
	
	
	
	
}




?>
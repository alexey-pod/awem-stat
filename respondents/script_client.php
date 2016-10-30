<?
require_once("header_answer.php");// отправка заголовка
include ($_SERVER['DOCUMENT_ROOT']."/inc/public.inc.php");

$mode=$_POST['mode']; 

// loggerClass::writeLogA($_POST);

if ($mode=='getDayArray'){
	$obj=new statClass();
	$array=$obj->getDayArray($_POST);
	$result=array('array'=>$array);
	echo json_encode($result);
	return;
}// END IF
if ($mode=='deleteDayItem'){
	$obj=new statClass();
	$array=$obj->deleteDayItem($_POST);
	return;
}// END IF
if ($mode=='deleteDayItemAll'){
	$obj=new statClass();
	$array=$obj->deleteDayItemAll($_POST);
	return;
}
if ($mode=='fillTestData'){
	set_time_limit(360);
	$obj=new statClass(array('test_mode'=>true));
	$result=$obj->fillData();
	return;
}

if ($mode=='apiAddData'){
	
	foreach($_POST as $key=>$val) {
		//$_POST[$key]=addcslashes(unEscape($val), "'");
		$_POST[$key]=stripslashes ($val);
	}
	
	$url = 'http://'.$_SERVER['HTTP_HOST'].'/api/add';
	// loggerClass::writeLogA($url, 'url');
	{// POST запрос
		$_POST['datetime'] = strDate_to_int($_POST['datetime']);
		$post_array = $_POST;
		$postdata = http_build_query($post_array);
		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);
		$context = stream_context_create($opts);
		$json = file_get_contents($url, false, $context);
		echo($json);
		//loggerClass::writeLog($result);
	}//END POST запрос
	return;
}


?>
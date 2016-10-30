<?php
class SQL{
	var $query;
	var $result;
	var $link;
	var $error='';
	var $DBname='';

	function SQL(){
		$this->query="";
		$this->result=false;
		if (@$this->link = mysql_pconnect(DB_HOST1, DB_USERNAME1, DB_PASSWORD1)) {
			@mysql_select_db(DB_NAME1);
			mysql_query("SET NAMES utf8");
			$this->DBname=DB_NAME1;
		}
	}// END SQL

	function query($query){
		$this->query=$query;
	}

	function magic_quotes($param,$chkNumeric=false){
		if (get_magic_quotes_gpc()) {
			$param = stripslashes($param);
		}
		if ($chkNumeric) {
			if (!is_numeric($param)){
				$param = +$param;
			}
		}
		else $param = mysql_real_escape_string((string)$param);
		return $param;
	}

	function exec(){
		$this->result=mysql_query($this->query,$this->link);
		if (!$this->result) {
			$this->error=$this->err();
			//$this->debug();
			return false;
		}
		return true;
	}

	function getLastId(){
		return mysql_insert_id($this->link);
	}

	function err(){
		return mysql_errno().":".mysql_error();
	}

	function arr_assoc(){
		if (!$this->result) {
			//      $this->error="Cant find results!!!"."arr_assoc()";
			//$this->debug();
			return false;
		}
		else {
			return mysql_fetch_assoc($this->result);
		}
	}

	function get_count(){// посчитать число записей
		if (!$this->result) {
			$this->error="Cant count results!!!"."get_count()";
			//$this->debug();
			return false;
		}
		else {
			return mysql_num_rows($this->result);
		}
	}

	function get_affected_rows(){
		if (!$this->link) {
			$this->error="Cant find link!!!"."get_affected_rows()";
			$this->debug();
			return false;
		}
		else {
			return mysql_affected_rows($this->link);
		}
	}

	function free_result(){
		if (!$this->result) {
			$this->error="Cant find results!!!"."free_result()";
			$this->debug();
			return false;
		}
		else {
			return mysql_free_result($this->result);
		}
	}

	function free_assoc_result($result){
		if (!$this->result) {
			$this->error="Cant find results!!!"."free_assoc_result()";
			$this->debug();
			return false;
		}
		else {
			return mysql_free_result($result);
		}
	}
	
	
	
	function get($val)
	// получить записи
	// по умолчанию - массив записей
	// $val=1 - 1 запись
	{
		$result = array();
		$res= $this->exec();
		if(!$res){
			return false;
		}
		
		if($val==1){
			$result=$this->arr_assoc();
		}
		else{
			$i = 0;
			while ($arr = $this->arr_assoc()) {
				foreach($arr as $key=>$val) {
					$result[$i][$key] = $val;
				}
				$i++;
			}
		}
		return $result;
	}//END
	
}
?>
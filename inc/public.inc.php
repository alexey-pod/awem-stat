<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_PARSE); 

$site_dir = $_SERVER['DOCUMENT_ROOT'];
include ($site_dir."/inc/functions.inc.php");


{// определение сервера: локально/интернет
	if( isDenwer() ){ // сервер на локальном компьютере
		$hostMode=1;// локально
	}else{
		$hostMode=2;// интернет
	}
}

{//подгружаемые скрипты
	// ОБЯЗАТЕЛЬНЫЕ СКРИПТЫ
	include ($site_dir."/inc/classes/loggerClass.php");
	include ($site_dir."/inc/db.inc.php");
	include ($site_dir."/inc/classes/dbClass.php");
	// пользовательские скрипты
	include ($site_dir."/inc/classes/statClass.php");
}




 
?>
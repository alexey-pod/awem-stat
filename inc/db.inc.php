<?php
/**----------------------------------------------------------------------------
* MySQL Database Connection
-----------------------------------------------------------------------------*/
	//exit;
	//loggerClass::writeLog($hostMode, 'hostMode');
	if ($hostMode==1){// домашний компъютер
		define('DB_HOST1', 'localhost');
		define('DB_USERNAME1', 'root');
		define('DB_PASSWORD1', '');
		define('DB_NAME1', 'loc_awem_stat3.ru');
	}
	elseif($hostMode==2){ // сервер в интернете
		define('DB_HOST1', 'localhost');
		define('DB_USERNAME1', 'alex');
		define('DB_PASSWORD1', 'BknIIT05');
		define('DB_NAME1', "awem-stat");
	}
	
	
	
	
	
?>
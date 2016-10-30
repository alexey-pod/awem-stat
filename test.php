<?php

include ("./inc/public.inc.php");




	
$obj=new statClass(array('test_mode'=>true));
$result=$obj->fillData();
loggerClass::writeLog( $result );
return;
$result=$obj->addData(
	array(
		'user_id'=>1, 
		'device_id'=>'4464fsd4f4sdf4sdf4sd6f',
		'platform'=>'iphone',
		'data'=>'Event=Start,Money=15444',
	)
);
loggerClass::writeLog( $result );



echo json_encode($result);
	
	

?>
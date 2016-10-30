<?php
include ("./inc/public.inc.php");

set_time_limit(360);

if($_GET['mode']=='addData'){
	$obj = new statClass();
	$res = $obj->addData($_POST);
	// echo $res;
	echo json_encode($res);
}

?>
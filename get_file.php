<?php
include ("./inc/public.inc.php");

$obj=new statClass();
$str=$obj->getDayCsv($_GET);

?>
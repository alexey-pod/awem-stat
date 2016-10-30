<?php
include ("./inc/public.inc.php");

if(	!isset($_GET['p']) ){
	$_GET['p']='index';
}

if($_GET['p']=='index'){
	$page_title = 'Главная';
	include ($site_dir."/tpl/client/index.php");
	
}
elseif($_GET['p']=='api'){
	$page_title = 'API';
	include ($site_dir."/tpl/client/api.php");
}

?>
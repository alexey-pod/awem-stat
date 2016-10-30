<?php
function strDate_to_int ($value)
// преобразовать дату типа 30-06-2010 - в   метку времени для заданной даты - mktime
{
	$datetime = explode("-", $value);
	$datetime = mktime(12, 0, 0, $datetime[1], $datetime[0], $datetime[2]);
	
	
	return $datetime;
}

function isDenwer()
/*
// определение сервера
if( isDenwer() ) { // сервер на локальном компьютере
	$mode=1;
} else {
	$mode=2;
}
*/
{
	$doc_root = $_SERVER["DOCUMENT_ROOT"];
	$pos = strpos($doc_root, '/home');
	$pos_console = strpos($doc_root, '\home');

	if ($pos === false && $pos_console === false) { // note: three equal signs
		// не найден ...
		$ret = $pos;
	} else {
		if($pos!==false){
			$ret = @is_dir(
				substr($doc_root, 0, $pos+1) . 'denwer'
			);
		}
		if($pos_console!==false){
			$ret = @is_dir(
				substr($doc_root, 0, $pos_console+1) . 'denwer'
			);
		}
	}
	return $ret;
}

?>
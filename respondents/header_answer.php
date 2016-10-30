<?
header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
ob_start("ob_gzhandler", 0); //Максимальное сжатие страницы
?>
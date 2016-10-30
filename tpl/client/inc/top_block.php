<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title> <?=$page_title?> | AWEM STAT </title>
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	
	<!-- jquery -->
		<script type="text/javascript" src="/js/jquery/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="/js/jquery/jquery-ui-1.8.6.custom.min_pack.js"></script>
		<link href="/js/jquery/jquery-ui-1.8.6.custom_pack.css" rel="stylesheet" type="text/css" />
	<!-- END jquery -->
	
	
	<script type="text/javascript" src="/js/fn.js"></script>
	<link type="text/css" href="/css/client.less" rel="stylesheet/less">
    <script>
		var less = {
			env: 'development',
			poll: 1000,
			//async: true,
			dumpLineNumbers: 'all',
		};
    </script>
    <script src="/js/less/less.js"  ></script>
</head>
<body>
	<div id="overlay" class="overlay" style="display: none;"></div>
	<div id="body-wrap-all" class="body-wrap-all">
		<div class="body-wrap" id="body-wrap">
			<div class="header">
				<div class="inner">
					<a <? if ($_GET['p']=='index') echo 'class="selected"'; ?> href="/">Главная</a>
					<a <? if ($_GET['p']=='api') echo 'class="selected"'; ?> href="/?p=api">Api</a>
				</div>
			</div>
			<div class="page_content" id="page_content">
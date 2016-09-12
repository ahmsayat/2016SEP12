<!DOCTYPE html>
<html lang = "en">
	<head>
		<meta charset = "utf-8">

		<title>Public News Publishing System</title>
		<link rel="icon" href="http://download.seaicons.com/icons/alecive/flatwoken/512/Apps-File-News-icon.png">

		<!--Bootstrap CDN-->
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	  
		<!--Local Resources-->
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>/css/login.css">
		<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>/css/main.css">

	</head>

	<body ng-app="app" style="">
		
	<h1 style="position: absolute; top: 50px; left: 50px; 0px; color: green">Public News Publishing System</h1>
	<a href="/"><img src="<?php echo base_url(); ?>/img/header.png" style="width: 100%"/></a>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/get_started">Home</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/read">Read</a></li>
      <li><a href="/publish">Publish</a></li>
      <li><a href="/rss">RSS</a></li>

    </ul>
  </div>
</nav>
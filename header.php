<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/styles.css" />

		<title>Nerd Data</title>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Nerd Data</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
					<ul class="nav navbar-nav">
						<li<?php echo $current_page == 'streams' ? ' class="active"' : '';?>><a href="/streams">Streams</a></li>
						<li class="dropdown<?php echo $current_page == 'assignments' ? ' active' : '';?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Assignments <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="/assignments/php_survey">PHP Survey</a></li>
							</ul>
						</li>
						<li<?php echo $current_page == 'about' ? ' class="active"' : '';?>><a href="/about">About</a></li>
					</ul>
				</div>
			</div>
		</nav>
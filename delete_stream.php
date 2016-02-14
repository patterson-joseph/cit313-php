<?php
	$current_page = "streams";
	require_once("header.php");
	require_once("objects/stream.php");

	$message = '';

	$result = Stream::delete($_GET['channel_name']);

	if ($result) {
		$message = '<div class="alert alert-success" role="alert">Stream deleted!</div>';
	} else {
		$message = '<div class="alert alert-danger" role="alert">Problem deleting stream...</div>';
	}
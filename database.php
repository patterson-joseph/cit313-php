<?php
	$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$username = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$password = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	$dbname = 'nerddata';

	try {
		$db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
		$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
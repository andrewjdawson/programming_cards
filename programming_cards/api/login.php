<?php
	require '../util/functions.php';
	$link = connect();
	$db = initialize_database($link);
	
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		login($link, $username, $password);
	}
?>
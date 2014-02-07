<?php
	require '../util/functions.php';
	$link = connect();
	$db = initialize_database($link);

	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['comfirm_password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$comfirm_password = $_POST['comfirm_password'];
		if(is_valid_signup($link, $username, $password, $comfirm_password)) {
			insert_into_database($link, $username, $password);
			login($link, $username, $password);
		} else {
			header('Location: ../index.php');
		}
	}
?>
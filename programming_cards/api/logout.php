<?php
	require '../util/functions.php';
	require '../util/logout_util.php';
	session_start();
	if(isset($_POST['logout']) && $_POST['logout'] == TRUE) {
		session_destroy();
		session_regenerate_id(TRUE);
		header('Location: ../index.php');
	}
?>
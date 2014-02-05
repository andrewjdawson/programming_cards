<?php
	require '../util/functions.php';
	require '../util/ajax_util.php';
	$link = connect();
	$db = initialize_database($link);
	
	//ensure that post request has been sent
	$method = $_SERVER['REQUEST_METHOD'];
	if(strtolower($method) == 'post') {
		//if the ajax request is to change rating call the php change rating function
		if(isset($_POST['task']) && $_POST['task'] == 'change_rating') {
			$id = $_POST['id'];
			change_rating($link, $id);
			unset($_POST['task']);
		//if the ajax request is to show rating call the php echo rating function
		} elseif(isset($_POST['task']) && $_POST['task'] == 'show_rating') {
			$id = $_POST['id'];
			echo_rating($link, $id);
			unset($_POST['task']);
		}
	}
?>
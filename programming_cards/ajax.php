<?php
	require 'functions.php';
	$link = connect();
	$db = initialize_database($link);
	
	$method = $_SERVER['REQUEST_METHOD'];
	if(strtolower($method) == 'post') {
		if(isset($_POST['task']) && $_POST['task'] == 'change_rating') {
			change_rating($link);
			unset($_POST['task']);
		}
	}
	
	function change_rating($link) {
		$id = $_POST['id'];
		if(isset($_POST['vote']) && $_POST['vote'] == 'up_vote') {
			mysqli_query($link, "UPDATE cards SET rating = rating + 1 WHERE id=$id") or die(mysqli_error($link));
			$q = mysqli_query($link, "SELECT rating FROM cards WHERE id = $id") or die(mysqli_error($link));
			while($row = mysqli_fetch_array($q)) {
				echo json_encode($row);
			}
		} elseif(isset($_POST['vote']) && $_POST['vote'] = 'down_vote') {
			mysqli_query($link, "UPDATE cards SET rating = rating - 1 WHERE id=$id") or die(mysqli_error($link));
			$q = mysqli_query($link, "SELECT rating FROM cards WHERE id = $id") or die(mysqli_error($link));
			while($row = mysqli_fetch_array($q)) {
				echo json_encode($row);
			}
		}
	}
?>
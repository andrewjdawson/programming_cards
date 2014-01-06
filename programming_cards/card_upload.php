<?php
	require 'functions.php';
	$link = connect();
	$db = initialize_database($link);
	
	if(isset($_POST['term']) && isset($_POST['answer']) && isset($_POST['topic'])) {
		$term = mysqli_real_escape_string($link, $_POST['term']);
		$answer = mysqli_real_escape_string($link, $_POST['answer']);
		$topic = mysqli_real_escape_string($link, $_POST['topic']);
		$difficulty = mysqli_real_escape_string($link, $_POST['difficulty']);
		$q = 'SELECT id FROM topics WHERE topic="'.$topic.'"';
		$r = mysqli_query($link, $q) or die(mysqli_error($link));
		$topic_id_array = mysqli_fetch_array($r);
		$q = 'INSERT INTO cards(topic, term, answer, difficulty) VALUES("'.$topic_id_array['id'].'", "'.$term.'", "'.$answer.'", "'.$difficulty.'")';
		$r = mysqli_query($link, $q) or die(mysqli_error($link));
	}
	header('Location: index.php');
	die();
?>
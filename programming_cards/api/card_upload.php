<?php
	require '../util/functions.php';
	$link = connect();
	$db = initialize_database($link);
	
	//if the upload form has submitted so that all form information was correctly recived add card to database and redirect user to index.php
	if(isset($_POST['question']) && isset($_POST['answer']) && isset($_POST['topic']) && isset($_POST['difficulty'])) {
		$question = mysqli_real_escape_string($link, $_POST['question']);
		$answer = mysqli_real_escape_string($link, $_POST['answer']);
		$topic = mysqli_real_escape_string($link, $_POST['topic']);
		$difficulty = mysqli_real_escape_string($link, $_POST['difficulty']);
		$q = 'SELECT id FROM topics WHERE topic="'.$topic.'"';
		$r = mysqli_query($link, $q) or die(mysqli_error($link));
		$topic_id_array = mysqli_fetch_array($r);
		$q = 'INSERT INTO cards(topic, question, answer, difficulty) VALUES("'.$topic_id_array['id'].'", "'.$question.'", "'.$answer.'", "'.$difficulty.'")';
		$r = mysqli_query($link, $q) or die(mysqli_error($link));
	}
	header('Location: ../index.php');
	die();
?>
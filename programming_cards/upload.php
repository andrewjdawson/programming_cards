<!DOCTYPE html>
<html>
	<head>
		<title>Programming Cards</title>
		<?php
			require 'functions.php';
			$link = connect();
			$db = initialize_database($link);
		?>
	<head>

	<body>
	
	<form id='uploader' action='card_upload.php' method='POST'>
		<label for='question'>Question: </label>
		<input id='question' type='text' name='question' required='required'> </br>
		<label for='answer'>Answer: </label>
		<input id='answer' type='text' name='answer' required='required'> </br>
		<label for='topic'>Topic: </label>
		<select name='topic'>
			<?php get_topic_options($link); ?>
		</select> </br>
		<label for='difficulty'>Difficulty: </label>
		<select name='difficulty'>
			<option value='1'>Really Easy</option>
			<option value='2'>Easy</option>
			<option value='3'>Medium</option>
			<option value='4'>Hard</option>
			<option value='5'>Really Hard</option>
		</select> </br>
		<input type="submit">
	</form>
	
		<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
		<script src="jquery.validate.min.js"></script>
		<script src="interactions.js"></script>
	</body>
<html>
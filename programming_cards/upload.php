<!DOCTYPE html>
<html>
	<head>
		<title>Programming Cards</title>
		<link rel='stylesheet' type='text/css' href='upload_style.css'>
		<?php
			require 'functions.php';
			$link = connect();
			$db = initialize_database($link);
		?>
	<head>

	<body>
	
	<form id='uploader' action='card_upload.php' method='POST'>
		<textarea class='card_text'id='question' name='question' required='required' placeholder='Type Question Here (Formatting here will match formatting of card)'></textarea> </br>
		<textarea class='card_text' id='answer' name='answer' required='required' placeholder='Type Answer Here (Formatting here will match formatting of card)'></textarea> </br>
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
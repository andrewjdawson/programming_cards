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
		<label for='term'>Term: </label>
		<input id='term' type='text' name='term'> </br>
		<label for='answer'>Answer: </label>
		<input id='answer' type='text' name='answer'> </br>
		<label for='topic'>Topic: </label>
		<select name='topic'>
			<?php get_topic_options($link); ?>
		</select> </br>
		<input type="submit">
	</form>
	
		<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
		<script src="jquery.validate.min.js"></script>
		<script src="interactions.js"></script>
	</body>
<html>
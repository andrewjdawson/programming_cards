<!DOCTYPE html>
<html>
	<head>
		<title>Programming Cards</title>
		<link rel='stylesheet' type='text/css' href='../css/upload.css'>
		<?php
			require '../util/functions.php';
			$link = connect();
			$db = initialize_database($link);
		?>
	<head>

	<body>
		<form id='uploader' action='../api/card_upload.php' method='POST'>
			<textarea class='card_text'id='question' name='question' required='required' placeholder='Type Question Here (Formatting here will match formatting of card)'></textarea> </br>
			<textarea class='card_text' id='answer' name='answer' required='required' placeholder='Type Answer Here (Formatting here will match formatting of card)'></textarea> </br>
			<label for='topic'>Topic: </label>
			<select name='topic'>
				<?php get_topic_options_upload($link); ?>
			</select> </br>
			<label for='difficulty'>Difficulty: </label>
			<select name='difficulty'>
				<option value='1'>Really Easy</option>
				<option value='2'>Easy</option>
				<option value='3'>Medium</option>
				<option value='4'>Hard</option>
				<option value='5'>Really Hard</option>
			</select> </br>
			<input type='submit'>
		</form>
	</body>
<html>
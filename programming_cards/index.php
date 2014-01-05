<!DOCTYPE html>
<html>
	<head>
		<title>Programming Cards</title>
		<link rel='stylesheet' type='text/css' href='style.css'>
		<?php
			require 'functions.php';
			$link = connect();
			$db = initialize_database($link);
		?>
	</head>
	
	<body>
		<header>
			<h1>PROGRAMMING CARDS</h1>
			<a href='upload.php' id='upload'>Upload</a>
			
			<form id='topic_selector' method='GET' action='index.php'>
				<select name='topic'>
					<?php get_topic_options($link); ?>
				</select>
				<input type='submit' />
			</form>
		</header>
			
		<div id='navigation'>
			<button id='back'>&#60;</button>
			<button id='flip_card'>Flip Card</button>
			<button id='forward'>&#62;</button>
		</div>
		
		<?php
			$topic_id = get_topic_id($link);
			if($topic_id != null) { get_cards_html($link, $topic_id); }
		?>
		
		<script src='http://code.jquery.com/jquery-1.8.3.min.js'></script>
		<script src='jquery.validate.min.js'></script>
		<script src='interactions.js'></script>
	</body>
</html>	
<!DOCTYPE html>
<html>
	<head>
		<title>Programming Cards</title>
		<link rel='stylesheet' type='text/css' href='index_style.css'>
		<?php
			require 'functions.php';
			$link = connect();
			$db = initialize_database($link);
			//every time the index page is loaded delete all the cards with a rating of less than 5 from the database
			delete_bad_ratings($link);
		?>
	</head>
	
	<body>
		<header>
			<h1>PROGRAMMING CARDS</h1>
			<a href='upload.php' id='upload'>Publish A Flash Card</a>
			
			<form id='topic_selector' method='GET' action='index.php'>
				<select name='topic' id='topic_selector_dropdown'>
					<?php get_topic_options_index($link); ?>
				</select>
			</form>
		</header>
		
		<div id='voting_tool'>
			<button id='up_vote'>Up Vote</button>
			<div id='curr_rating'></div>
			<button id='down_vote'>Down Vote</button>
		</div>
		
		<?php
			//if a topic_id has been set generate the cards html output.
			//static cards are generated if no cards have been published or if no topic_id has been set
			$topic_id = get_topic_id($link);
			if($topic_id != null) { get_cards_html($link, $topic_id); }
		?>
		
		<div id='navigation'>
			<button id='back' class='new_card'>&#60;</button>
			<button id='flip_card'>Flip Card</button>
			<button id='forward' class='new_card'>&#62;</button>
		</div>
		
		<script src='http://code.jquery.com/jquery-1.8.3.min.js'></script>
		<script src='interactions.js'></script>
	</body>
</html>	
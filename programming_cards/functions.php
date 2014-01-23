<?php
	//create database if it does not exist
	//create tables if they do not exist
	//select the programming_cards database
	//populate the topics table with topics (function only populates table if table is not already populated)
	function initialize_database($link) {
		$db = mysqli_query($link, 'CREATE DATABASE IF NOT EXISTS programming_cards') or die(mysqli_error($link));
		mysqli_select_db($link, 'programming_cards') or die(mysqli_error($link));
		mysqli_query($link, 'CREATE TABLE IF NOT EXISTS topics(id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), topic VARCHAR(100) NOT NULL)') or die(mysqli_error($link));
		mysqli_query($link, 'CREATE TABLE IF NOT EXISTS cards(id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), topic INT NOT NULL, FOREIGN KEY(topic) REFERENCES topics(id), question VARCHAR(1000) NOT NULL, answer VARCHAR(1000) NOT NULL, difficulty INT NOT NULL, rating INT NOT NULL)') or die(mysqli_error($link));
		populate_topics_table($link);
	}
	
	//return a link to the database server
	function connect() {
		$link = mysqli_connect('localhost', 'root', '', '') or die(mysqli_error());
		if($link) { return $link; }
	}
	
	//if the topics table is empty populate it with a list of topics
	function populate_topics_table($link) {
		$r = mysqli_query($link, 'SELECT * FROM topics') or die(mysqli_error($link));
		if(mysqli_num_rows($r) == 0) {
			mysqli_query($link,"INSERT INTO topics (topic) VALUES ('Introduction')") or die(mysqli_error($link));
			mysqli_query($link,"INSERT INTO topics (topic) VALUES ('Method Flow')") or die(mysqli_error($link));
			mysqli_query($link,"INSERT INTO topics (topic) VALUES ('Primitive Types')") or die(mysqli_error($link));
			mysqli_query($link,"INSERT INTO topics (topic) VALUES ('Loops')") or die(mysqli_error($link));
			mysqli_query($link,"INSERT INTO topics (topic) VALUES ('Conditional Logic')") or die(mysqli_error($link));
			mysqli_query($link,"INSERT INTO topics (topic) VALUES ('File Processing')") or die(mysqli_error($link));
			mysqli_query($link,"INSERT INTO topics (topic) VALUES ('Arrays')") or die(mysqli_error($link));
			mysqli_query($link,"INSERT INTO topics (topic) VALUES ('Classes and Objects')") or die(mysqli_error($link));
		}
	}
	
	//delete all cards from the database with a rating of less than -5
	function delete_bad_ratings($link) {
		mysqli_query($link, 'DELETE FROM cards WHERE rating < -5') or die(mysqli_error($link));
	}
	
	//generate html output for all the topics. The output is produced as option tags so that it can be easily used within a dropdown menu
	function get_topic_options($link) {
		$r = mysqli_query($link, 'SELECT topic FROM topics') or die(mysqli_error($link));
		if($r && mysqli_num_rows($r)) {
			while($row = mysqli_fetch_array($r)) {
			?>
				<option value="<?php echo $row['topic']; ?>"><?php echo $row['topic']; ?></option>
			<?php
			}
		}
	}
	
	//check to see if get at topic is set. If it is set return the id of the topic that has been set
	//if get at topic is not set it means the user has not selected a topic. If this condition is true generate a welcome static card
	function get_topic_id($link) {
		if(isset($_GET['topic'])) {
			$topic = $_GET['topic'];
			$topic_id = mysqli_query($link, 'SELECT id FROM topics WHERE topic = "'.$topic.'"') or die(mysqli_error($link));
			$topic_id = mysqli_fetch_array($topic_id);
			return $topic_id['id'];
		} else {
		?>
			<div class='static_card'>
				<pre class='card_text'><code>Welcome to Programming Cards! Just pick a topic to get started</code></pre>
			</div>
		<?php
		}
	}
	
	//generate the html output for all cards with a given topic_id
	//if no cards have been published with the given topic_id generate a static card telling the user that no cards have been published in the given topic
	function get_cards_html($link, $topic_id) {
		$r = mysqli_query($link, 'SELECT * FROM cards WHERE topic = "'.$topic_id.'" ORDER BY difficulty') or die(mysqli_error($link));
		if($r && mysqli_num_rows($r)) {
			while($row = mysqli_fetch_array($r)) {
			?>
				<div class='card hidden' id="<?php echo $row['id']; ?>">
					<pre class='question card_text'><code><?php echo strip_tags($row['question']); ?></code></pre>
					<pre class='answer hidden card_text'><code><?php echo strip_tags($row['answer']); ?></code></pre>
				</div>
			<?php
			}
		} else {
			?>
				<div class='static_card'>
					<pre class='card_text'><code>Sorry but no cards have been published for this topic</code></pre>
				</div>
			<?php
		}
	}
?>
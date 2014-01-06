<?php
	function initialize_database($link) {
		$db = mysqli_query($link, 'CREATE DATABASE IF NOT EXISTS programming_cards') or die(mysqli_error($link));
		mysqli_select_db($link, 'programming_cards') or die(mysqli_error($link));
		mysqli_query($link, 'CREATE TABLE IF NOT EXISTS topics(id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), topic VARCHAR(100) NOT NULL)') or die(mysqli_error($link));
		mysqli_query($link, 'CREATE TABLE IF NOT EXISTS cards(id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), topic INT NOT NULL, FOREIGN KEY(topic) REFERENCES topics(id), term VARCHAR(1000) NOT NULL, answer VARCHAR(1000) NOT NULL, difficulty INT NOT NULL)') or die(mysqli_error($link));
		populate_topics_table($link);
	}
	
	function connect() {
		$link = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
		if($link) { return $link; }
	}
	
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
	function get_topic_id($link) {
		if(isset($_GET['topic'])) {
			$topic = $_GET['topic'];
			$topic_id = mysqli_query($link, 'SELECT id FROM topics WHERE topic = "'.$topic.'"') or die(mysqli_error($link));
			$topic_id = mysqli_fetch_array($topic_id);
			return $topic_id['id'];
		} else {
		?>
			<div class='static_card'>
				<p class='card_text'>Welcome to Programming Cards! Just pick a topic to get started</p>
			</div>
		<?php
		}
	}
	
	function get_cards_html($link, $topic_id) {
		$r = mysqli_query($link, 'SELECT * FROM cards WHERE topic = "'.$topic_id.'" ORDER BY difficulty') or die(mysqli_error($link));
		if($r && mysqli_num_rows($r)) {
			while($row = mysqli_fetch_array($r)) {
			?>
				<div class='card hidden'>
					<p class='term card_text'><?php echo strip_tags($row['term']); ?></p>
					<p class='answer hidden card_text'><?php echo strip_tags($row['answer']); ?></p>
				</div>
			<?php
			}
		} else {
			?>
				<div class='static_card'>
					<p class='card_text'>Sorry but no cards have been published for this topic</p>
				</div>
			<?php
		}
	}
?>
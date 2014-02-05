<?php
	//delete all cards from the database with a rating of less than -5
	function delete_bad_ratings($link) {
		mysqli_query($link, 'DELETE FROM cards WHERE rating < -5') or die(mysqli_error($link));
	}
	
	//generate html output for all the topic options. These tags are used for the topic selection in the cards page
	function get_topic_options_cards($link) {
		$topic = $_GET['topic'];
		$r = mysqli_query($link, 'SELECT topic FROM topics') or die(mysqli_error($link));
		if($r && mysqli_num_rows($r)) {
			?> <option value='select'>--Select Topic--</option> <?php
			while($row = mysqli_fetch_array($r)) {
			?> <option value="<?php echo $row['topic']; ?>" <?php echo ($topic == $row['topic']) ? 'selected="selected"' : ''; ?>><?php echo $row['topic']; ?></option><?php
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
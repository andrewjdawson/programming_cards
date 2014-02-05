<?php
	//generate html ouput for all the topic options. These tags are used in the topic selection form in the publishing section
	function get_topic_options_upload($link) {
		$r = mysqli_query($link, 'SELECT topic FROM topics') or die(mysqli_error($link));
		if($r && mysqli_num_rows($r)) {
			while($row = mysqli_fetch_array($r)) {
			?>
				<option value="<?php echo $row['topic']; ?>"><?php echo $row['topic']; ?></option>
			<?php
			}
		}
	}
?>
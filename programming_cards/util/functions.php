<?php
	//create database if it does not exist
	//create tables if they do not exist
	//select the programming_cards database
	//populate the topics table with topics (function only populates table if table is not already populated)
	function initialize_database($link) {
		$db = mysqli_query($link, 'CREATE DATABASE IF NOT EXISTS programming_cards') or die(mysqli_error($link));
		mysqli_select_db($link, 'programming_cards') or die(mysqli_error($link));
		mysqli_query($link, 'CREATE TABLE IF NOT EXISTS topics(id INT NOT NULL AUTO_INCREMENT, 
		PRIMARY KEY(id), 
		topic VARCHAR(100) NOT NULL)') or die(mysqli_error($link));
		mysqli_query($link, 'CREATE TABLE IF NOT EXISTS cards(id INT NOT NULL AUTO_INCREMENT, 
		PRIMARY KEY(id), 
		topic INT NOT NULL, 
		FOREIGN KEY(topic) REFERENCES topics(id), 
		question VARCHAR(1000) NOT NULL, 
		answer VARCHAR(1000) NOT NULL, 
		difficulty INT NOT NULL, rating INT NOT NULL)') or die(mysqli_error($link));
		populate_topics_table($link);
		mysqli_query($link, 'CREATE TABLE IF NOT EXISTS users(id INT NOT NULL AUTO_INCREMENT,
		PRIMARY KEY (id),
		username VARCHAR(100) NOT NULL,
		password VARCHAR(100) NOT NULL)') or die(mysqli_error($link));
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

	function login($link, $username, $password) {
		if (validate_user($link, $username, $password)) {
			session_start();
			$_SESSION['username'] = $username;
			header('Location: ../pages/cards.php');
		} else {
			header('Location: ../index.php?error=login_error');
		}
	}
	
	function validate_user($link, $username, $password) {
		if(isset($_POST['username']) && isset($_POST['password'])) {
			$r = mysqli_query($link, 'SELECT * FROM users WHERE username="'.$username.'" AND password="'.$password.'"') or die(mysqli_error($link));
			return (mysqli_num_rows($r) > 0);
		}
	}
?>
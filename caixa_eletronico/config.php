<?php
try {
	$pdo = new PDO("mysql:dbname=your_database;host=your_host", "your_username", "your_password");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}

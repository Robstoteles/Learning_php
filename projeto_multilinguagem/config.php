<?php
try {
	global $pdo;
	$pdo = new PDO("mysql:dbname=your_database;host=your_host", "your_user", "your_password");
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}

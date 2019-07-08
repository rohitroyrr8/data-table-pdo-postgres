<?php 
require_once __DIR__.'/config.php';

try {
	$db = new PDO("pgsql:host=".DB_HOST.";dbname=".DB_DATABASE.";", DB_USERNAME, DB_PASSWORD);	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
} catch (PDOException $e) {
	echo "Error : ".$e->getMessage()."<br>";
	die('Error while connecting to database');
}

?>
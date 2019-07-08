<?php 

require 'vendor/autoload.php';
require 'app/init.php';

try{
	$query = "COPY sample(id, name, email, location) TO 'C:\Users\Apoxy\Desktop\test.csv' DELIMITER ',' CSV HEADER;";

	$result = $db->query($query);
}catch(PDOException $e) {
	$e->getMessage();
}

?>
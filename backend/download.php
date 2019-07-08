<?php 
	require('../app/init.php');

	$file_name = mt_rand();
	$query = "COPY sample(name, email, location) TO 'C:\Users\Apoxy\Desktop\\test.csv' DELIMITER ',' CSV HEADER;";
	$result = $db->query($query);

?>
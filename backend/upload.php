<?php 
	require('../app/init.php');
	
	if(isset($_POST['upload_data_file'])){

		$item_id = strtotime('now');
		$tmp_name = $_FILES['file']['tmp_name'];
	    $file_name = $_FILES['file']['name'];

		$type = $_FILES['file']['type'];
        $ext = pathinfo($file_name);
        $file_name = $item_id.".".$ext['extension'];
        $path = '../uploads/'.$file_name;
        

        if(move_uploaded_file($tmp_name, $path)) {
        	/* 
        	1. Upload data from CSV to Database 
			2. Check for duplicate email address
			3. Count for success insertion and error records
			4. 
			*/
			try{
				//uploading data to database
				$query = "COPY sample(name, email, location) FROM '".APP_PATH."\uploads\\".$file_name."' DELIMITER ',' CSV HEADER;";
				
				$result = $db->query($query);

				//removing duplicate records
				$query = "DELETE FROM sample WHERE id IN (SELECT id FROM (SELECT id, ROW_NUMBER() OVER( PARTITION BY email ORDER BY  id ) AS row_num FROM sample ) t WHERE t.row_num > 1 );";
				$result = $db->query($query);
				
			} catch (PDOException $e) {
				echo "Error : ".$e->getMessage()."<br>";
			}

        	echo json_encode([
			'success' => 'success',
			'message' => 'File Uploaded Successfully'
			]);
        } else{
        	echo json_encode([
			'error' => 'error', 
			'message' => 'Sometihng went Wrong. Try Again'
			
			]);
        }
        

	}
?>
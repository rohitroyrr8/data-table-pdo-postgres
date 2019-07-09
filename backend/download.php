<?php 
	require '../vendor/autoload.php';
	require '../app/init.php';

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	$query1 = "SELECT * from sample ";

	/*$file_name = mt_rand();
	$query = "COPY sample(name, email, location) TO 'C:\Users\Apoxy\Desktop\\test.csv' DELIMITER ',' CSV HEADER;";
	$result = $db->query($query);*/

	if($_POST["action"] == "custom_download") {

		if (isset($_POST["searchQuery"])) {
			$query1 .= "Where ".$_POST['searchColumn']." LIKE '%".$_POST['searchQuery']."%' ";
		}
		if(isset($_POST["orderColumn"])) {
			$query1 .= "ORDER BY ".$_POST['orderColumn']." ".$_POST['orderDirection'];
		}

		$result = $db->query($query1);
		if(isset($result))  
		{  
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
		   $i = 1;
		   
		   //$sheet->setCellValue('A'.$i, 'Id');
		   $sheet->setCellValue('A'.$i, 'Name');
		   $sheet->setCellValue('B'.$i, 'Email');
		   $sheet->setCellValue('C'.$i, 'Location');
	       foreach($result as $row)
	       {	
	       		$i++;
	   			//$sheet->setCellValue('A'.$i, $row['id']);
	   			$sheet->setCellValue('A'.$i, $row['name']);
	   			$sheet->setCellValue('B'.$i, $row['email']);
	   			$sheet->setCellValue('C'.$i, $row['location']);
	       }  
	    }

	    
	    $writer = new Xlsx($spreadsheet);

	    $filename = "Data Report".sha1(random_bytes(32)).".xlsx";
	    $writer->save($filename);
	    //echo "File Exported Successfully @ ".APP_PATH."/tmp/".$filename;
	    $url = "http://localhost/data_sample/backend/".$filename;
	    echo $url;
	    exit;

	}

?>
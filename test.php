<?php
// exporting 1 Lakh data from database to excel file
require 'vendor/autoload.php';
require 'app/init.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$query = "SELECT * FROM sample limit 100000;";

	$result = $db->query($query);
	if(isset($result))  
	{  

	   $i = 1;
	   
	   //$sheet->setCellValue('A'.$i, 'Id');
	   //$sheet->setCellValue('B'.$i, 'Name');
	   $sheet->setCellValue('C'.$i, 'Email');
	   //$sheet->setCellValue('D'.$i, 'Location');
       foreach($result as $row)
       {	
       		$i++;
   			//$sheet->setCellValue('A'.$i, $row['id']);
   			//$sheet->setCellValue('B'.$i, $row['name']);
   			$sheet->setCellValue('C'.$i, $row['email']);
   			//$sheet->setCellValue('D'.$i, $row['location']);
       }  
    }

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');


?>
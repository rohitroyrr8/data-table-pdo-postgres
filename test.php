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
    //$writer->save('export.xlsx');
     header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="export.xlsx"');
    $writer->save("php://output");
    exit;


?>
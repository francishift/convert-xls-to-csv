<?php
	error_reporting(E_ALL ^ E_NOTICE);
	//  Include PHPExcel_IOFactory
	require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel/IOFactory.php';
	
	//GETTING FILE
	$inputFileName = dirname(__FILE__).'/Redes_Pantallas.xlsx';
	
	
	//  Read your Excel workbook
	try {
		$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
		$objReader = PHPExcel_IOFactory::createReader($inputFileType);
		$objPHPExcel = $objReader->load($inputFileName);
	} catch(Exception $e) {
		die('error:Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	}

	//  Get worksheet dimensions
	$sheet = $objPHPExcel->getSheet(0); 
	$highestRow = $sheet->getHighestRow(); 
	
	//  Loop through each row of the worksheet in turn
	for ($row = 2; $row <= $highestRow; $row++){ 
		$keys[] = $sheet->getCell('A'.$row)->getValue();
		$values[] = $sheet->getCell('B'.$row)->getValue();
	}
	//generate csv file with content
	$csv_file = implode(',', $keys)."\n".implode(',', $values);
	file_put_contents(dirname(__FILE__).'/Redes_Pantallas.csv', $csv_file);
	echo "conversión OK: <a href=\"Redes_Pantallas.csv\" download>descargar Redes_Pantallas.csv</a>";
	
?>
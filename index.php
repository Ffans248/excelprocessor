<?php 
require 'vendor/autoload.php';
//Importando librerias de SpreadSheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$spreadsheet->getproperties()->setCreator('Diego Alejandro')->setTitle('Libro de Compras y Ventas');
$spreadsheet->setActiveSheetIndex(0);
$hojaActiva=$spreadsheet->getActiveSheet(); 
$spreadsheet->getDefaultStyle()->getFont()->setName('Tahoma')
$hojaActiva->setCellValue('A1', 'Hola Mundo');
$hojaActiva->setCellValue('B2', '12345678910');

$hojaActiva->setCellValue('C1', 'Hola')->setCellValue('D2', 'Dato');

$writer = new Xlsx($spreadsheet);
$writer->save('Mi excel.xlsx');

 ?>
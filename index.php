<?php 
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$spreadsheet->getproperties()->setCreator('Marko Robles')->setTitle('Mi Excel');

$spreadsheet->setActiveSheetIndex(0);
$hojaActiva = $spreadsheet->getActiveSheet();

$spreadsheet->getDefaultStyle()->getFont()->setName('Tahoma');
$spreadsheet->getDefaultStyle()->getFont()->setSize(15);

$hojaActiva->getColumnDimension('A')->setWidth(40);
$hojaActiva->getColumnDimension('A')->setWidth(20);

$hojaActiva->setCellValue('A1', 'CODIGO DE PROGRAMACIÓN');
$hojaActiva->setCellValue('B2', 126.1612);

$hojaActiva->setCellValue('C1', 'Marko Robles')->setCellValue('D1', 'CDP');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="myfile.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

/*
$writer = new Xlsx($spreadsheet);
$writer->save('Mi Excel.xlsx');
*/


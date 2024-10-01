<?php

require 'vendor/autoload.php';
require 'conexion.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};
use PhpOffice\PhpSpreadsheet\Cell\DataType;



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$fecha = $_POST['fecha'];
$fecha2 = $_POST['fecha2'];

$fecha = date('Y-m-d', strtotime($fecha));
$fecha2 = date('Y-m-d', strtotime($fecha2));


$accountingFormat = '_("Q"* #,##0.00_);_("Q"* \(#,##0.00\);_("Q"* "-"??_);_(@_)';

$sql2 = "SELECT fecha_emision, serie, numero_DTE, id_receptor, nombre_completo_receptor, monto_grantotal, monto_sinIVA, monto_IVA FROM ventas WHERE fecha_emision BETWEEN '$fecha' AND '$fecha2'";
$resultado2 = $mysqli->query($sql2);

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle('LibroVentas');


$fila = 1;

$sql2 = "SELECT fecha_emision, serie, numero_DTE, id_receptor, nombre_completo_receptor, monto_grantotal, monto_sinIVA, monto_IVA FROM ventas WHERE fecha_emision BETWEEN '$fecha' AND '$fecha2'";
$resultado2 = $mysqli->query($sql2);


//ENCABEZADO PRIMARIO

$hojaActiva->getStyle('A' . $fila)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hojaActiva->getStyle('A' . $fila . ':K' . $fila+1)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$hojaActiva->getStyle('A' . $fila . ':D' . $fila)->getFont()->setBold(true);
$hojaActiva->mergeCells('A' . $fila . ':D' . $fila);
$hojaActiva->setCellValue('A' . $fila, 'NOMBRE O RAZÓN SOCIAL');


$hojaActiva->getStyle('A' . $fila+1)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hojaActiva->getStyle('A' . $fila+1 . ':D' . $fila+1)->getFont()->setBold(true);
$hojaActiva->mergeCells('A' . $fila+1 . ':D' . $fila+1);
$hojaActiva->setCellValue('A' . $fila+1, 'MES');

$hojaActiva->mergeCells('E' . $fila . ':F' . $fila);
$hojaActiva->mergeCells('E' . $fila+2 . ':F' . $fila+2);

$hojaActiva->getStyle('G' . $fila . ':G' . $fila+2)->getFont()->setBold(true);
$hojaActiva->getStyle('G' . $fila . ':G' . $fila+2)->getFont()->setSize(9);


$hojaActiva->mergeCells('H' . $fila . ':K' . $fila);
$hojaActiva->setCellValue('G' . $fila, 'AÑO');

$hojaActiva->getStyle('E' . $fila+5)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->mergeCells('H' . $fila+1 . ':K' . $fila+1);
$hojaActiva->setCellValue('G' . $fila+1, 'NIT:');


$hojaActiva->getStyle('G' . $fila+2 . ':K' . $fila+2)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
$hojaActiva->mergeCells('H' . $fila+2 . ':K' . $fila+2);
$hojaActiva->setCellValue('G' . $fila+2, 'FOLIO');
//FIN ENCABEZADO PRIMARIO

$hojaActiva->getStyle('B' . $fila+4 . ':K' . $fila+5)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$hojaActiva->getStyle('B' . $fila+4 . ':K' . $fila+5)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

//ENCABEZADO SECUNDARIO

$hojaActiva->getStyle('A' . $fila+4 .  ':K' . $fila+5)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

$hojaActiva->getColumnDimension('E')->setWidth(10.78);
$hojaActiva->getStyle('E' . $fila+3)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hojaActiva->mergeCells('E' . $fila+3 . ':G' . $fila+3);
$hojaActiva->getStyle('E' . $fila+3 . ':G' . $fila+3)->getFont()->setBold(true);
$hojaActiva->setCellValue('E' . $fila+3, 'LIBRO DE VENTAS Y SERVICIOS');

$hojaActiva->getColumnDimension('A')->setWidth(10.78);
$hojaActiva->getStyle('A' . $fila+4)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hojaActiva->getStyle('A' . $fila+4)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->mergeCells('A' . $fila+4 . ':A' . $fila+5);
$hojaActiva->setCellValue('A' . $fila+4, 'FECHA');

$hojaActiva->getColumnDimension('B')->setWidth(10.78);
$hojaActiva->setCellValue('B' . $fila+4, 'TIPO');

$hojaActiva->getColumnDimension('B')->setWidth(10.78);
$hojaActiva->setCellValue('B' . $fila+5, 'DOCUMENTO');



$hojaActiva->getColumnDimension('C')->setWidth(10.78);
$hojaActiva->mergeCells('C' . $fila+4 . ':C' . $fila+5);
$hojaActiva->setCellValue('C' . $fila+4, 'SERIE');

$hojaActiva->getColumnDimension('D')->setWidth(10.78);
$hojaActiva->mergeCells('D' . $fila+4 . ':D' . $fila+5);
$hojaActiva->setCellValue('D' . $fila+4, 'NÚMERO');

$hojaActiva->getColumnDimension('E')->setWidth(10.78);
$hojaActiva->mergeCells('E' . $fila+4 . ':E' . $fila+5);
$hojaActiva->getStyle('E' . $fila+4 . ':E' . $fila+5)->getFont()->setSize(9);
$hojaActiva->getStyle('E' . $fila+4)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->setCellValue('E' . $fila+4, 'NIT');

$hojaActiva->getColumnDimension('F')->setWidth(46.22);
$hojaActiva->mergeCells('F' . $fila+4 . ':G' . $fila+5);
$hojaActiva->getStyle('F' . $fila+4)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->setCellValue('F' . $fila+4, 'COMPRADOR');

$hojaActiva->mergeCells('H' . $fila+4 . ':H' . $fila+5);
$hojaActiva->getStyle('H' . $fila+4)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->getStyle('H' . $fila+4 . ':H' . $fila+5)->getFont()->setSize(9);
$hojaActiva->setCellValue('H' . $fila+4, 'BIENES');

$hojaActiva->getStyle('I' . $fila+4)->getAlignment()->setWrapText(true);
$hojaActiva->mergeCells('I' . $fila+4 . ':I' . $fila+5);
$hojaActiva->getStyle('I' . $fila+4 . ':I' . $fila+5)->getFont();
$hojaActiva->getStyle('I' . $fila+4 . ':I' . $fila+5)->getFont()->setSize(7);
$hojaActiva->setCellValue('I' . $fila+4, 'SERVICIOS');


$hojaActiva->getStyle('A' . $fila+4 . ':K' . $fila+5)->getFont()->setSize(8);


$hojaActiva->mergeCells('J' . $fila+4 . ':J' . $fila+5);
$hojaActiva->setCellValue('J' . $fila+4, 'EXPORTACIÓN');

$hojaActiva->setCellValue('K' . $fila+4, 'DEBITO');

$hojaActiva->setCellValue('K' . $fila+5, 'IVA');

//FIN ENCABEZADO SECUNDARIO

$fila = $fila + 6;
$fila2 = $fila;
while ($rows2 = $resultado2->fetch_assoc()) {

    $hojaActiva->setCellValue('A' . $fila, $rows2['fecha_emision']);
    $hojaActiva->setCellValue('C' . $fila, $rows2['serie']);
    $hojaActiva->setCellValue('D' . $fila, $rows2['numero_DTE']);
    $hojaActiva->setCellValue('E' . $fila, $rows2['id_receptor']);
    $hojaActiva->mergeCells('F' . $fila . ':G' . $fila);
    $hojaActiva->setCellValue('F' . $fila, $rows2['nombre_completo_receptor']);

   /*
    $hojaActiva->setCellValue('G' . $fila, $rows2['monto_grantotal']);
    $hojaActiva->getStyle('G' . $fila)->getNumberFormat()->setFormatCode($accountingFormat);*/
    
    $hojaActiva->setCellValue('H' . $fila, $rows2['monto_grantotal']);
    $hojaActiva->getStyle('H' . $fila)->getNumberFormat()->setFormatCode($accountingFormat);
    /*
    $hojaActiva->setCellValue('I' . $fila, $rows2['monto_IVA']);
    $hojaActiva->getStyle('I' . $fila)->getNumberFormat()->setFormatCode($accountingFormat);*/
    
    $hojaActiva->setCellValue('J' . $fila, '=+H' . $fila . '/1.12');
    $hojaActiva->getStyle('J' . $fila)->getNumberFormat()->setFormatCode($accountingFormat);
    
    $hojaActiva->setCellValue('K' . $fila, '=+J' . $fila . '*0.12');
    $hojaActiva->getStyle('K' . $fila)->getNumberFormat()->setFormatCode($accountingFormat);
    
    $hojaActiva->getStyle('A' . $fila . ':K' . $fila)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

    $fila++;

    
}



$hojaActiva->getStyle('H' . $fila)->getNumberFormat()->setFormatCode($accountingFormat);
$hojaActiva->getStyle('I' . $fila)->getNumberFormat()->setFormatCode($accountingFormat);
$hojaActiva->getStyle('J' . $fila)->getNumberFormat()->setFormatCode($accountingFormat);
$hojaActiva->getStyle('K' . $fila)->getNumberFormat()->setFormatCode($accountingFormat);
$hojaActiva->mergeCells('F' . $fila . ':G' . $fila);
$hojaActiva->setCellValue('F' . $fila, 'SUMAS');
$hojaActiva->setCellValue('H' . $fila, '=+SUMA(H' . $fila-1 . ': H' . $fila2 . ')');
$hojaActiva->setCellValue('I' . $fila, '=+SUMA(I' . $fila-1 . ': I' . $fila2 . ')');
$hojaActiva->setCellValue('J' . $fila, '=+SUMA(J' . $fila-1 . ': J' . $fila2 . ')');
$hojaActiva->setCellValue('K' . $fila, '=+SUMA(K' . $fila-1 . ': K' . $fila2 . ')');
$hojaActiva->getStyle('A' . $fila . ':K' . $fila)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="LibroVentas.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');

// Redirige a un script que hará la descarga



} else {
    echo "No se encontraron registros para el rango de fechas seleccionado.";
}



exit;





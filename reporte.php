<?php

require 'vendor/autoload.php';
require 'conexion.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};

$sql = "SELECT id, fecha_emision, tipo_DTE, serie, numero_DTE, NIT_emisor, nombre_completo_emisor, codigo_establecimiento, moneda, monto_grantotal, monto_sinIVA, monto_IVA FROM compras";
$resultado = $mysqli->query($sql);

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle('Compras');


$hojaActiva->getDefaultColumnDimension()->setWidth(10.78);

//ENCABEZADO PRIMARIO
$hojaActiva->getColumnDimension('B')->setWidth(43.12);
$hojaActiva->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hojaActiva->getStyle('A1:D1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);
$hojaActiva->mergeCells('A1:D1');
$hojaActiva->setCellValue('A1', 'NOMBRE O RAZÓN SOCIAL');

$hojaActiva->getColumnDimension('A')->setWidth(10.78);
$hojaActiva->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hojaActiva->mergeCells('A2:D2');
$hojaActiva->setCellValue('A2', 'MES');

$hojaActiva->mergeCells('E1:F1');
$hojaActiva->mergeCells('E2:F2');

$hojaActiva->getColumnDimension('G')->setWidth(10.78);
$hojaActiva->setCellValue('G1', 'AÑO');

$hojaActiva->getColumnDimension('G')->setWidth(10.78);
$hojaActiva->getStyle('E5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->setCellValue('G2', 'NIT:');

$hojaActiva->getColumnDimension('G')->setWidth(10.78);
$hojaActiva->setCellValue('G3', 'FOLIO');
//FIN ENCABEZADO PRIMARIO

$hojaActiva->getStyle('B5:K6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

//ENCABEZADO SECUNDARIO
$hojaActiva->getColumnDimension('E')->setWidth(10.78);
$hojaActiva->getStyle('E4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hojaActiva->mergeCells('E4:G4');
$hojaActiva->setCellValue('E4', 'LIBRO DE COMPRAS Y SERVICIOS');

$hojaActiva->getColumnDimension('A')->setWidth(10.78);
$hojaActiva->getStyle('A5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$hojaActiva->getStyle('A5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->mergeCells('A5:A6');
$hojaActiva->setCellValue('A5', 'FECHA');

$hojaActiva->getColumnDimension('B')->setWidth(10.78);
$hojaActiva->setCellValue('B5', 'TIPO');

$hojaActiva->getColumnDimension('B')->setWidth(10.78);
$hojaActiva->setCellValue('B6', 'DOC');


$hojaActiva->mergeCells('C5:D5');


$hojaActiva->getColumnDimension('C')->setWidth(10.78);
$hojaActiva->setCellValue('C6', 'SERIE');

$hojaActiva->getColumnDimension('D')->setWidth(10.78);
$hojaActiva->setCellValue('D6', 'FACTURA');

$hojaActiva->getColumnDimension('E')->setWidth(10.78);
$hojaActiva->mergeCells('E5:E6');
$hojaActiva->getStyle('E5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->setCellValue('E5', 'NIT');

$hojaActiva->getColumnDimension('F')->setWidth(18.78);
$hojaActiva->mergeCells('F5:F6');
$hojaActiva->getStyle('F5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->setCellValue('F5', 'PROVEEDOR');

$hojaActiva->getColumnDimension('G')->setWidth(10.78);
$hojaActiva->mergeCells('G5:G6');
$hojaActiva->getStyle('G5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$hojaActiva->setCellValue('G5', 'TOTAL');

$hojaActiva->getColumnDimension('H')->setWidth(10.78);
$hojaActiva->getStyle('H5')->getAlignment()->setWrapText(true);
$hojaActiva->mergeCells('H5:H6');
$hojaActiva->setCellValue('H5', 'COMPRA DE PEQ.CONTRIBUYENTE');


$hojaActiva->getColumnDimension('I')->setWidth(21.56);
$hojaActiva->mergeCells('I5:J5');
$hojaActiva->setCellValue('I5', 'PRECIO NETO');

$hojaActiva->getColumnDimension('I')->setWidth(10.78);
$hojaActiva->setCellValue('I6', 'SERVICIOS');

$hojaActiva->getColumnDimension('J')->setWidth(10.78);
$hojaActiva->setCellValue('J6', 'BIENES');

$hojaActiva->getColumnDimension('K')->setWidth(10.78);
$hojaActiva->setCellValue('K5', 'IVA');

$hojaActiva->getColumnDimension('K')->setWidth(10.78);
$hojaActiva->setCellValue('K6', 'CREDITO');
//FIN ENCABEZADO SECUNDARIO

$fila = 7;

while ($rows = $resultado->fetch_assoc()) {
    $hojaActiva->setCellValue('A' . $fila, $rows['fecha_emision']);
    $hojaActiva->setCellValue('B' . $fila, $rows['tipo_DTE']);
    $hojaActiva->setCellValue('C' . $fila, $rows['serie']);
    $hojaActiva->setCellValue('D' . $fila, $rows['numero_DTE']);
    $hojaActiva->setCellValue('E' . $fila, $rows['NIT_emisor']);
    $hojaActiva->setCellValue('F' . $fila, $rows['nombre_completo_emisor']);
    $hojaActiva->setCellValue('G' . $fila, $rows['codigo_establecimiento']);
    $hojaActiva->setCellValue('H' . $fila, $rows['moneda']);
    $hojaActiva->setCellValue('I' . $fila, $rows['monto_grantotal']);
    $hojaActiva->setCellValue('J' . $fila, $rows['monto_sinIVA']);
    $hojaActiva->setCellValue('K' . $fila, $rows['monto_IVA']);
    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Compras.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;

function formato(){

}



<?php

require 'vendor/autoload.php';
require 'conexion.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};

$sql = "SELECT id, fecha_emision, tipo_DTE, serie, numero_DTE, NIT_emisor, nombre_completo_emisor,
codigo_establecimiento, moneda, monto_grantotal, monto_sinIVA, monto_IVA FROM compras";
$resultado = $mysqli->query($sql);

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle('Compras');

$hojaActiva->getColumnDimension('A')->setWidth(5);
$hojaActiva->setCellValue('A1', 'ID');
$hojaActiva->getColumnDimension('B')->setWidth(30);
$hojaActiva->setCellValue('B1', 'Fecha de Emisión');
$hojaActiva->getColumnDimension('C')->setWidth(15);
$hojaActiva->setCellValue('C1', 'Tipo de DTE');
$hojaActiva->getColumnDimension('D')->setWidth(15);
$hojaActiva->setCellValue('D1', 'Serie');
$hojaActiva->getColumnDimension('E')->setWidth(20);
$hojaActiva->setCellValue('E1', 'Número de DTE');
$hojaActiva->getColumnDimension('F')->setWidth(20);
$hojaActiva->setCellValue('F1', 'NIT del Emisor');
$hojaActiva->getColumnDimension('G')->setWidth(40);
$hojaActiva->setCellValue('G1', 'Nombre Completo del Emisor');
$hojaActiva->getColumnDimension('H')->setWidth(20);
$hojaActiva->setCellValue('H1', 'Código de Establecimiento');
$hojaActiva->getColumnDimension('I')->setWidth(10);
$hojaActiva->setCellValue('I1', 'Moneda');
$hojaActiva->getColumnDimension('J')->setWidth(20);
$hojaActiva->setCellValue('J1', 'Monto (Gran Total)');
$hojaActiva->getColumnDimension('K')->setWidth(20);
$hojaActiva->setCellValue('K1', 'Monto Sin IVA');
$hojaActiva->getColumnDimension('L')->setWidth(20);
$hojaActiva->setCellValue('L1', 'Monto con IVA');

$fila = 2;

while ($rows = $resultado->fetch_assoc()) {
    $hojaActiva->setCellValue('A' . $fila, $rows['id']);
    $hojaActiva->setCellValue('B' . $fila, $rows['fecha_emision']);
    $hojaActiva->setCellValue('C' . $fila, $rows['tipo_DTE']);
    $hojaActiva->setCellValue('D' . $fila, $rows['serie']);
    $hojaActiva->setCellValue('E' . $fila, $rows['numero_DTE']);
    $hojaActiva->setCellValue('F' . $fila, $rows['NIT_emisor']);
    $hojaActiva->setCellValue('G' . $fila, $rows['nombre_completo_emisor']);
    $hojaActiva->setCellValue('H' . $fila, $rows['codigo_establecimiento']);
    $hojaActiva->setCellValue('I' . $fila, $rows['moneda']);
    $hojaActiva->setCellValue('J' . $fila, $rows['monto_grantotal']);
    $hojaActiva->setCellValue('K' . $fila, $rows['monto_sinIVA']);
    $hojaActiva->setCellValue('L' . $fila, $rows['monto_IVA']);
    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Compras.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;



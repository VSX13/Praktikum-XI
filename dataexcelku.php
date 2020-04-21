<?php
include "koneksi2.php";
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1','no');
$sheet->setCellValue('B1','Nama Lengkap');
$sheet->setCellValue('C1','Nama');
$sheet->setCellValue('D1','Umur');
$sheet->setCellValue('E1','Jenis Kelamin');
$sheet->setCellValue('F1','Agama');
$sheet->setCellValue('G1','Tempat Dan Tanggal Lahir');
$sheet->setCellValue('H1','Alamat');
$sheet->setCellValue('I1','Email');
$sheet->setCellValue('J1','No.HP');

$query = mysqli_query($conn,"SELECT * FROM tb_admin");
$i = 2;
$no = 1;
while($row = mysqli_fetch_array($query)){

	$sheet->setCellValue('A'.$i, $no++);
	$sheet->setCellValue('B'.$i, $row['lengkap']);
	$sheet->setCellValue('C'.$i, $row['nama']);
	$sheet->setCellValue('D'.$i, $row['umur']);
	$sheet->setCellValue('E'.$i, $row['jk']);
	$sheet->setCellValue('F'.$i, $row['agama']);
	$sheet->setCellValue('G'.$i, $row['ttl']);
	$sheet->setCellValue('H'.$i, $row['alamat']);
	$sheet->setCellValue('I'.$i, $row['email']);
	$sheet->setCellValue('J'.$i, $row['hp']);
	$i++;
}

	$styleArray = [
		'borders' => [
			'allBorders' => ['borderStyle' => PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],],];
	$i = $i - 1;
	$sheet->getStyle('A1:J'.$i)->applyFromArray($styleArray);
	$writer = new Xlsx($spreadsheet);
	$writer->save('Dataku.xlsx');
?>
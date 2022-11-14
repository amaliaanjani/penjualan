<?php
 
include('koneksi.php');
$id = $_GET['id']; 
$query = "SELECT * FROM tbl_siswa WHERE id_siswa = $id LIMIT 1";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result); 


include('koneksi.php');

require('fpdf/fpdf.php');
$pdf = new FPDF('P', 'mm','Letter');

$pdf->AddPage();

//font, bold, ukuran
$pdf->SetFont('Times','B',16);
//width, height, Kalimat yang dicetak didalam cell, nilai border (jika ingin menggunakan border ketik 1), Menunjukan posisi akan berpindah (jika ingin tidak berpindah ketik 0), (C for center, L for Left, R for Right) 
$pdf->Cell(0,7,'LAPORAN SATUAN SISWA',0,1,'C');


$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Times','B',10);

$pdf->Cell(8,6,'No',1,0,'C');
$pdf->Cell(30,6,'NISN',1,0,'C');
$pdf->Cell(60,6,'Nama',1,0,'C');
$pdf->Cell(40,6,'Alamat',1,0,'C');
$pdf->Cell(50,6,'Foto',1,1,'C');

$pdf->SetFont('Times','',10);

$no=1;
//Query untuk mengambil data tbl_siswa pada tabel tbl_siswa
$hasil = mysqli_query($connection, $query);
while ($data = mysqli_fetch_array($hasil)){
    $foto = 'foto/'.$data['foto'];
    $pdf->Cell(8,40,$no,1,0,'C');
    $pdf->Cell(30,40,$data['nisn'],1,0);
    $pdf->Cell(60,40,$data['nama_lengkap'],1,0);
    $pdf->Cell(40,40,$data['alamat'],1,0);
    $pdf->Cell(50,40,$pdf->Image($foto, $pdf->GetX(), $pdf->GetY(), 33.78),1,1);
    $no++;
}

$pdf->Output();
?>
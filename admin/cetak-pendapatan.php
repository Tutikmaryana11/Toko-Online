<?php
session_start();
if (empty($_SESSION['username'])){
    header('location:../index.php');    
} else {
    include "../conn.php";
require('../fpdf17/fpdf.php');
require('../conn.php');

$result=mysqli_query($koneksi, "select sum(p.total) as total, c.nama as nama, p.color as color, p.qty as qty ,pr.harga as harga,p.total as jumlah from konfirmasi k JOIN po_terima p on k.nopo=p.nopo JOIN customer c on c.kd_cus=k.kd_cus JOIN produk pr on pr.kode=p.kode where k.jumlah>0") or die(mysql_error());

$column_nama = "";
$column_color = "";
$column_qty = "";
$column_harga = "";
$column_jumlah = "";
$column_total = "";


//For each row, add the field to the corresponding column
while($row = mysqli_fetch_array($result))
{
    $nama = $row["nama"];
    $color = $row["color"];
    $qty = $row["qty"];
    $harga = $row["harga"];
    $jumlah = $row["jumlah"];
    $total = $row["total"];
    

    $column_nama = $column_nama.$nama."\n";
    $column_color = $column_color.$color."\n";
    $column_qty = $column_qty.$qty."\n";
    $column_harga = $column_harga.$harga."\n";
    $column_jumlah = $column_jumlah.$jumlah."\n";

    $column_total = $column_jumlah.$total."\n";

            
//mysql_close();

//Create a new PDF file
$pdf = new FPDF('P','mm',array(210,297)); //L For Landscape / P For Portrait
$pdf->AddPage();

$pdf->Image('../img/logo2.png',10,10,-175);
//$pdf->Image('../images/BBRI.png',190,10,-200);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(80);
$pdf->Cell(30,10,'DATA PENDAPATAN',0,0,'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(30,10,'Nurun Nisa',0,0,'C');
$pdf->Ln();

}
//Fields Name position
$akhir = 34;
$pdf->SetY($akhir);
$pdf->Cell(120);
$pdf->cell(0,6,'Jumlah Pendapatan',1,'C');


$pdf->SetY($akhir);
$pdf->SetX(185);
$pdf->MultiCell(20,6,$column_total,1,'C');


$Y_Fields_Name_position = 40;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(50,8,'Nama',1,0,'C',1);
$pdf->SetX(50);
$pdf->Cell(80,8,'Style',1,0,'C',1);
$pdf->SetX(120);
$pdf->Cell(40,8,'Qty',1,0,'C',1);
$pdf->SetX(155);
$pdf->Cell(30,8,'Harga',1,0,'C',1);
$pdf->SetX(185);
$pdf->Cell(20,8,'Jumlah',1,0,'C',1);
$pdf->Ln();
//Table position, under Fields Name
$Y_Table_Position = 48;
//Now show the columns
$pdf->SetFont('Arial','',9);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(50,6,$column_nama,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(50);
$pdf->MultiCell(80,6,$column_color,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(120);
$pdf->MultiCell(35,6,$column_qty,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(155);
$pdf->MultiCell(30,6,$column_harga,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(185);
$pdf->MultiCell(20,6,$column_jumlah,1,'C');

$pdf->Output();
}
?>

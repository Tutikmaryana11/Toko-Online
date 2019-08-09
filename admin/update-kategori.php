<?php
include "../conn.php";
$id_kategori       = $_POST['id_kategori'];
$kategori      = $_POST['kategori'];

$query = mysqli_query($koneksi, "UPDATE kategori_produk SET id_kategori='$id_kategori', kategori='$kategori'")or die(mysql_error());
if ($query){
header('location:kategori-produk.php');	
} else {
	echo "gagal";
    }
?>
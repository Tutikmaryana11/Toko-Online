<?php
include "../conn.php";
if(isset($_POST['update'])){
$namafolder="gambar_customer/"; //tempat menyimpan file

if (!empty($_FILES["nama_file"]["tmp_name"]))
{
	$jenis_gambar=$_FILES['nama_file']['type'];
        $kode     = $_POST['kd_cust'];
        $nama     = $_POST['nama'];
		$alamat   = $_POST['alamat'];
		$no_telp  = $_POST['no_telp'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $id_provinsi=$_POST['prop'];
        $id_kota=$_POST['kota'];
        $id_kecamatan=$_POST['kec'];
		
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			$sql="UPDATE customer SET nama='$nama', alamat='$alamat', no_telp='$no_telp', username='$username', password='$password', gambar='$gambar', id_provinsi='$id_provinsi', id_kota='$id_kota',id_kecamatan='$id_kecamatan' WHERE kd_cus='$kode'" or die(mysqli_error());
			print_r($_POST);
			print_r($sql);
			$res=mysqli_query($koneksi, $sql) or die (mysqli_error());
			//echo "Gambar berhasil dikirim ke direktori".$gambar;
            echo "<script>alert('Data Customer berhasil diupdate!'); window.location = 'customer.php'</script>";	   
		} else {
		   echo "<p>Gambar gagal dikirim</p>";
		}
   } else {
		echo "Jenis gambar yang anda kirim salah. Harus .jpg .gif .png";
   }
} else {
	echo "Anda belum memilih gambar";
}
} ?>
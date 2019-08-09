<?php 
session_start();
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "../conn.php";
    $_SESSION['user_id'];
     ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Toko Online | AISN Shop</title> 
	 <style>
      #map-canvas {width:100%;height:400px;border:solid #999 1px;}
      select {width:240px;}
      #kab_box,#kec_box,#kel_box,#lat_box,#lng_box{display:none;}
     </style>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script type="text/javascript" src="ajax_daerah.js"></script>
	<meta name="description" content="Website, corporate, cikarang, garment, jababeka, konveksi"/>
	<meta name="keywords" content="Bahan, Pakaian, boneka" />
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: Facebook Open Graph -->
	<meta property="og:title" content=""/>
	<meta property="og:description" content=""/>
	<meta property="og:type" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:image" content=""/>
	<!-- end: Facebook Open Graph -->

    <!-- start: CSS --> 
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Boogaloo">
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Economica:700,400italic">
	<!-- end: CSS -->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
    
	<?php include "header.php"; ?>
	
	<!-- start: Page Title -->
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-usd ico-white"></i>Checkout Keranjang</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: Page Title -->
	
	<!--start: Wrapper-->
	<div id="wrapper">
				
		<!-- start: Container -->
		<div class="container">

			<!-- start: Table -->
                 <div class="table-responsive">
                 <div class="title"><h3>Form Checkout</h3></div>
                 <div class="hero-unit">Harap isi form dibawah ini dengan lengkap dan benar sesuai idenditas anda!</div>
                <div class="hero-unit">Total Belanja Anda Rp. <?php echo abs((int)$_GET['total']); ?>,-</div> 
<?php
 //Get Data Kabupaten
 $curl = curl_init();
 curl_setopt_array($curl, array(
 CURLOPT_URL => "http://api.rajaongkir.com/starter/city",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "GET",
 CURLOPT_HTTPHEADER => array(
 "key:e4fc0b3177ba7eb27c34e2d493f2132b"
 ),
 ));
 
 $response = curl_exec($curl);
 $err = curl_error($curl);
 
 curl_close($curl);
 echo "
 <div class= \"form-group\">
 <label for=\"asal\">Kota/Kabupaten Asal </label>
 <select class=\"form-control\" name='asal' id='asal'>";
 // echo "<option>Pilih Kota Asal</option>";
 $data = json_decode($response, true);
 // for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
 // echo "<option value='5'>Yogyakarta</option>";
 // }

 echo "<option value='5'>Yogyakarta</option>";
 
 echo "</select>
 </div>";
 //Get Data Kabupaten
 //-----------------------------------------------------------------------------
 
 //Get Data Provinsi
 $curl = curl_init();
 
 curl_setopt_array($curl, array(
 CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
 CURLOPT_RETURNTRANSFER => true,
 CURLOPT_ENCODING => "",
 CURLOPT_MAXREDIRS => 10,
 CURLOPT_TIMEOUT => 30,
 CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
 CURLOPT_CUSTOMREQUEST => "GET",
 CURLOPT_HTTPHEADER => array(
 "key:e4fc0b3177ba7eb27c34e2d493f2132b"
 ),
 ));
 
 $response = curl_exec($curl);
 $err = curl_error($curl);
 
 echo "
 <div class= \"form-group\">
 <label for=\"provinsi\">Provinsi Tujuan </label>
 <select class=\"form-control\" name='provinsi' id='provinsi'>";
 echo "<option>Pilih Provinsi Tujuan</option>";
 $data = json_decode($response, true);
 for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
 echo "<option value='".$data['rajaongkir']['results'][$i]['province_id']."'>".$data['rajaongkir']['results'][$i]['province']."</option>";
 }
 echo "</select>
 </div>";
 //Get Data Provinsi
 ?>
 
 <div class="form-group">
 <label for="kabupaten">Kota/Kabupaten Tujuan</label><br>
 <select class="form-control" id="kabupaten" name="kabupaten"></select>
 </div>
 <div class="form-group">
 <label for="kurir">Kurir</label><br>
 <select class="form-control" id="kurir" name="kurir">
 <option value="jne">JNE</option>
 <option value="tiki">TIKI</option>
 <option value="pos">POS INDONESIA</option>
 </select>
 </div>
 <div class="form-group">
 <label for="berat">Berat (gram)</label><br>
 <input class="form-control" id="berat" type="text" name="berat" value="500" />
 </div>
 <!-- <button class="btn btn-success" id="cek" type="submit" name="button">Cek Ongkir</button> -->
 </div>
 </div>
 </div>
 </div>
 <div class="col-md-8">
 <div class="panel panel-success">
 <div class="panel-heading">
 <h3 class="panel-title">Hasil</h3>
 </div>
 <div class="panel-body">
 <ol>
 <div id="ongkir"></div>
 </div>
 </ol>

 <footer>
 <div class="row">
 <div class="col-md-4">
                <?php
                include "../conn.php";
                $kd_cus=$_SESSION['user_id'];
            $query = mysqli_query($koneksi, "select * from customer where kd_cus='$kd_cus'");
            $data  = mysqli_fetch_array($query);

            ?>

    <form role="formku" id="formku" method="post" action="checkout2.php">
    <table class="table table-hover">
    <tr>
        <td><label for="nama">Nama</label></td>
        <td><input name="nama" type="text" class="required" minlength="6" id="nama" size="200" value="<?php echo $data['nama'];?>" /></td>
      </tr>
      
      <tr>
        <td><label for="no_telp">No Telepon</label></td>
        <td><input name="no_telp" type="text" class="required" minlength="6" id="no_telp" value="<?php echo $data['no_telp'];?>" /></td>
      </tr>
      <tr>
        <td><label for="username">Username</label></td>
        <td><input name="username" type="text" class="required" id="username" value="<?php echo $data['username'];?>" /></td>
      </tr>
  
      
<tr>
        <td><label for="alamat">Alamat</label></td>
        <td><input name="alamat" type="text" class="required" minlength="6" id="alamat" value="<?php echo $data['alamat'];?>" /></td>
      </tr>
      <tr>
        <td><label for="password">Ukuran</label></td>
        <td><select name="size">
        	<option value="S">S</option>
        	<option value="M">M</option>
        	<option value="L">L</option>
        	<option value="XL">XL</option>

        </select></td>
      </tr>


      <tr>
      <td></td>
        <td><input type="submit" value="Lanjutkan" name="submit"  class="btn btn-sm btn-success"/>&nbsp;<a href="index.php" class="btn btn-sm btn-warning">Kembali</a></td>
        </tr>
    </table>
    </form>
                   </div>

				
			<!-- end: Table -->

		</div>
		<!-- end: Container -->
				
	</div>
	<!-- end: Wrapper  -->			

    <!-- start: Footer Menu -->
	<div id="footer-menu" class="hidden-tablet hidden-phone">

		<!-- start: Container -->
		<div class="container">
			
			<!-- start: Row -->
			<div class="row">

				<!-- start: Footer Menu Logo -->
				<div class="span2">
					<div id="footer-menu-logo">
						<a href="#"><img src="../img/logos.png" alt="logo" /></a>
					</div>
				</div>
				<!-- end: Footer Menu Logo -->

				<!-- start: Footer Menu Links-->
				<div class="span9">
					
					<div id="footer-menu-links">

						

					</div>
					
				</div>
				<!-- end: Footer Menu Links-->

				<!-- start: Footer Menu Back To Top -->
				<div class="span1">
						
					<div id="footer-menu-back-to-top">
						<a href="#"></a>
					</div>
				
				</div>
				<!-- end: Footer Menu Back To Top -->
			
			</div>
			<!-- end: Row -->
			
		</div>
		<!-- end: Container  -->	

	</div>	
	<!-- end: Footer Menu -->

	<?php include "footer.php"; ?>

<!-- start: Java Script -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/jquery-1.8.2.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/flexslider.js"></script>
<script src="../js/carousel.js"></script>
<script src="../js/jquery.cslider.js"></script>
<script src="../js/slider.js"></script>
<script def src="../js/custom.js"></script>
<script src="../jquery.validate.js"></script>
    <script>
    $(document).ready(function(){
        $("#formku").validate();
    });
    </script> 
    
    <style type="text/css">
    label.error {
        color: red;
        padding-left: .5em;
    }
    </style>
<!-- end: Java Script -->
<script type="text/javascript">
 
 $(document).ready(function(){
 $('#provinsi').change(function(){
 
 //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
 var prov = $('#provinsi').val();
 var base_url = window.location.origin;
 $.ajax({
 type : 'GET',
 url : base_url+'/project/HELMI/customer/cek_kabupaten.php',
 data : 'prov_id=' + prov,
 success: function (data) {
 
 //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
 $("#kabupaten").html(data);
 }
 });
 });
 
 $("#kurir").change(function(){
 //Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax
 var asal = $('#asal').val();
 var kab = $('#kabupaten').val();
 var kurir = $('#kurir').val();
 var berat = $('#berat').val();
 
 $.ajax({
 type : 'POST',
 url : 'http://localhost/project/HELMI/customer/cek_ongkir_belli.php',
 data : {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
 success: function (data) {
 
 //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
 $("#ongkir").html(data);
 }
 });
 });
 });
</script>

<script src="jquery.validate.js"></script>
    <script>
    $(document).ready(function(){
        $("#formku").validate();
    });
    </script> 
    
    <style type="text/css">
    label.error {
        color: red;
        padding-left: .5em;
    }

    </style>
<!-- end: Java Script -->
<?php
}
?>
</body>
</html>
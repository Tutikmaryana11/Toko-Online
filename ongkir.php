<?php require_once("conn.php");
    if (!isset($_SESSION)) {
        session_start();
    } ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Toko Online | Nurun Nisa</title> 
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
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
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
	
	<!-- start: Slider -->
	<div id="page-title">

		<div id="page-title-inner">

			<!-- start: Container -->
			<div class="container">

				<h2><i class="ico-stats ico-white"></i>Cek Ongkir</h2>

			</div>
			<!-- end: Container  -->

		</div>	

	</div>
	<!-- end: 
	<!-- end: Slider -->
			
	<!--start: Wrapper-->
	<div id="wrapper">
				
		<!--start: Container -->
    	<div class="container">
	
      		<!-- start: Hero Unit - Main herounit for a primary marketing message or call to action -->
      		<p style="font-size: xx-large;
      		font-family: 'lucida calligraphy'">
            <b>Cek Ongkir</b><br><br>
            <blockquote style="font-size: medium;">
                       
            <br />
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
 <button class="btn btn-success" id="cek" type="submit" name="button">Cek Ongkir</button>
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
 </div>
 </div>
 </div>
 <footer>
 <div class="row">
 <div class="col-md-4">
 </div>
 </div>
 
 </footer>
 </div>
 </div>
 </body>
</html>

                   
            </blockquote>
            <!--<div class="title"><h3>Keranjang Anda</h3></div>
           
				<!-- end: Icon Boxes -->
				<div class="clear"></div>
			</div>
			<!-- end: Row -->
			
			<hr>
			
		</div>
		<!--end: Container-->
	
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
						<a href="#"><img src="img/logos.PNG" alt="logo" width="50" /></a>
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
<script src="js/jquery-1.8.2.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/flexslider.js"></script>
<script src="js/carousel.js"></script>
<script src="js/jquery.cslider.js"></script>
<script src="js/slider.js"></script>
<script defer="defer" src="js/custom.js"></script>
<!-- end: Java Script -->
<script type="text/javascript">
 
 $(document).ready(function(){
 $('#provinsi').change(function(){
 
 //Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
 var prov = $('#provinsi').val();
 var base_url = window.location.origin;
 $.ajax({
 type : 'GET',
 url : base_url+'/project/HELMI/cek_kabupaten.php',
 data : 'prov_id=' + prov,
 success: function (data) {
 
 //jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
 $("#kabupaten").html(data);
 }
 });
 });
 
 $("#cek").click(function(){
 //Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax
 var asal = $('#asal').val();
 var kab = $('#kabupaten').val();
 var kurir = $('#kurir').val();
 var berat = $('#berat').val();
 
 $.ajax({
 type : 'POST',
 url : 'http://localhost/project/HELMI/cek_ongkir.php',
 data : {'kab_id' : kab, 'kurir' : kurir, 'asal' : asal, 'berat' : berat},
 success: function (data) {
 
 //jika data berhasil didapatkan, tampilkan ke dalam element div ongkir
 $("#ongkir").html(data);
 }
 });
 });
 });
</script>
</body>
</html>
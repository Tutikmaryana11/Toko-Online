<?php
//$db_name = "jnfashion";

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_nurun_nisa";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_error()){
	echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
}

?>
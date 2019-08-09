<?php 
session_start();
if (empty($_SESSION['username'])){
    header('location:../index.php');    
} else {
    include "../conn.php";
    $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $kd_cus=$_SESSION['user_id'];
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $no_telp  = $_POST['no_telp'];
    $username = $_POST['username'];
    $tarif_ongkir=$_POST['ongkir'];
    $size = $_POST['size'];

    
    $cekno= mysqli_query($koneksi, "SELECT * FROM customer ORDER BY kd_cus DESC");
        
        
        $data1=mysqli_num_rows($cekno);
        $cekQ1=$data1;
        //$data=mysqli_fetch_array($ceknomor);
        //$cekQ=$data['f_kodepart'];
        #menghilangkan huruf
        //$awalQ=substr($cekQ,0-6);
        #ketemu angka awal(angka sebelumnya) + dengan 1
        $next1=$cekQ1+1;

        #menhitung jumlah karakter
        $kode1=strlen($next1);
        
        if(!$cekQ1)
        { $no1='00000'; }
        elseif($kode1==1)
        { $no1='00000'; }
        elseif($kode1==2)
        { $no1='0000'; }
        elseif($kode1==3)
        { $no1='000'; }
        elseif($kode1==4)
        { $no1='00'; }
        elseif($kode1==5)
        { $no1='0'; }
        elseif($kode1=6)
        { $no1=''; }

        // masukkan dalam tabel penjualan
        $kodeku=$no1.$next1;
        
        $ceknomor= mysqli_query($koneksi, "SELECT * FROM po_terima ORDER BY id DESC");
        
        
        $data=mysqli_num_rows($ceknomor);
        $cekQ=$data;
        //$data=mysqli_fetch_array($ceknomor);
        //$cekQ=$data['f_kodepart'];
        #menghilangkan huruf
        //$awalQ=substr($cekQ,0-6);
        #ketemu angka awal(angka sebelumnya) + dengan 1
        $next=$cekQ+1;

        #menhitung jumlah karakter
        $kode=strlen($next);
        
        if(!$cekQ)
        { $no='00000'; }
        elseif($kode==1)
        { $no='00000'; }
        elseif($kode==2)
        { $no='0000'; }
        elseif($kode==3)
        { $no='000'; }
        elseif($kode==4)
        { $no='00'; }
        elseif($kode==5)
        { $no='0'; }
        elseif($kode=6)
        { $no=''; }

        // masukkan dalam tabel penjualan
        $kodepo=$no.$next;
         $a = "Belum";
        $query1 = mysqli_query($koneksi, "INSERT INTO konfirmasi (nopo, kd_cus, bayar_via, tanggal, jumlah, bukti_transfer, status) VALUES ('$kodepo', '$kd_cus', '0', CURRENT_DATE, 0, 0, '$a')") or die(mysqli_error());
            
        if ($query1) {
            
            
            $total = 0;
            //$biaya_pengiriman = 0;

            if (isset($_SESSION['items'])) {
                foreach ($_SESSION['items'] as $key => $value) {
                    $barang_id = $_SESSION['barang'];
                    $kuantitas = $_SESSION['items'][$key];

                    $query_barang = mysqli_query($koneksi, "SELECT * FROM produk WHERE kode = '$barang_id'");
                    // ambil data dari data barang
                    $data_barang = mysqli_fetch_array($query_barang);
                    $harga = $data_barang['harga'];
                    $nama = $data_barang['nama'];

                    $jenis = $data_barang['jenis'];


                    $jumlah_harga = $harga * $kuantitas;
                    //$total += $jumlah_harga;
                    $jumlahsemua=$jumlah_harga+$tarif_ongkir;
                    $kueri =  "INSERT INTO po_terima (nopo, kd_cus, kode, tanggal, style, color, qty, total,ongkir,size) VALUES ('$kodepo', '$kodeku', '$barang_id', CURRENT_DATE,'$jenis','$nama', '$kuantitas', '$jumlah_harga','$tarif_ongkir','$size')";
                    echo $kueri;
                    $kueri1=mysqli_query($koneksi,$kueri);
                    
                    
                    if ($kueri1) {
                        
                    echo "<script>alert('Checkout Sukses, silahkan login untuk cetak invoice..'); window.location = 'dashboard.php'</script>";

                    unset($_SESSION['items']);
                    session_destroy();
                    }
                }
            }

           
        }
    }
}
?>
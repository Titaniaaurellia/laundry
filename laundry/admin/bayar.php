<?php 
$tanggal_bayar = date('Y-m-d');
    if($_GET['id_transaksi']){
        include "koneksi.php";
        $qry_ubah=mysqli_query($conn,"update transaksi set tanggal_bayar='$tanggal_bayar', dibayar='dibayar' where id_transaksi='".$_GET['id_transaksi']."'");
        
        if($qry_ubah){
            echo "<script>alert('Sukses bayar ');location.href='tampil_transaksi.php';</script>";
        } else {
            echo "<script>alert('Gagal bayar ');location.href='tampil_transaksi.php';</script>";
        }
    }
?>

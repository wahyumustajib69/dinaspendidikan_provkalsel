<?php
session_start();
include "koneksi.php";

$no = $_GET['id'];

$sql = mysqli_query($konek,"DELETE FROM pen_bup WHERE nosrt='$no'");

if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:pensiun-bup");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:pensiun-bup");
}

?>
<?php
session_start();
include "koneksi.php";

$no = $_GET['id'];

$sql = mysqli_query($konek,"DELETE FROM pen_dn WHERE no_sur='$no'");

if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:pensiun-dini?filter=ALL");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:pensiun-dini?filter=ALL");
}

?>
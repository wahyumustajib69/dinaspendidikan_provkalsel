<?php
session_start();
include "koneksi.php";

$no = $_GET['id'];

$sql = mysqli_query($konek,"DELETE FROM pen_dj WHERE nosurat='$no'");

if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:pensiun?filter=ALL");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:pensiun?filter=ALL");
}

?>
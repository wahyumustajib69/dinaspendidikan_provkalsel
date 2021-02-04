<?php
session_start();
include "koneksi.php";

$no = $_GET['id'];

$sql = mysqli_query($konek,"DELETE FROM pidana WHERE no='$no'");

if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:pidana?filter=ALL");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:pidana?filter=ALL");
}

?>
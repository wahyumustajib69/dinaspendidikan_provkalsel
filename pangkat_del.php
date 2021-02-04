<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];

$sql = mysqli_query($konek,"DELETE FROM pangkat WHERE id_pnkt='$id'");

if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:pangkat");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:pangkat");
}

?>
<?php
session_start();
include "koneksi.php";

$id = $_GET['id'];

$sql = mysqli_query($konek,"DELETE FROM promosi WHERE id_pro='$id'");

if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:promosi");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:promosi");
}

?>
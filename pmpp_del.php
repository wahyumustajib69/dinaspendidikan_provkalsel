<?php
session_start();
include "koneksi.php";

$no = $_GET['id'];

$sql = mysqli_query($konek,"DELETE FROM pmpp WHERE no_surat='$no'");

if($sql){
	$_SESSION['pesan']='Hapus Data Berhasil';
	header("location:pmpp?filter=ALL");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:pmpp?filter=ALL");
}

?>
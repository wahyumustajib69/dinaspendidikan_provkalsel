<?php
session_start();
include "koneksi.php";

$id = $_POST['id'];
$nm = $_POST['nmp'];
$kt = $_POST['ket'];

$sql = mysqli_query($konek,"INSERT INTO pangkat VALUES ('$id','$nm','$kt')");

if($sql){
	$_SESSION['pesan']='Simpan Data Berhasil';
	header("location:pangkat");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:pangkat");
}

?>
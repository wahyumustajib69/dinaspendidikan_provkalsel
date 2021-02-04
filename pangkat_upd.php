<?php
session_start();
include "koneksi.php";

$id = $_POST['id'];
$nm = $_POST['nmp'];
$kt = $_POST['ket'];

$sql = mysqli_query($konek,"UPDATE pangkat SET nm_pnkt='$nm',ket='$kt' WHERE id_pnkt='$id'");

if($sql){
	$_SESSION['pesan']='Update Data Berhasil';
	header("location:pangkat");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan';
	header("location:pangkat");
}

?>
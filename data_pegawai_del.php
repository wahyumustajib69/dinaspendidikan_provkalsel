<?php
session_start();
require "koneksi.php";

$nip = $_GET['ref'];
$qry = mysqli_query($konek,"SELECT foto FROM pegawai WHERE nip='$nip'");
foreach($qry as $ft);
$foto = $ft['foto'];

$sql = mysqli_query($konek,"DELETE FROM pegawai WHERE nip='$nip'");
unlink("foto_pgw/".$foto);

if($sql){
	$_SESSION['pesan']='Hapus data Berhasil';
	header("location:data_pegawai");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan, Periksa koneksi database';
	header("location:data_pegawai");
}
?>
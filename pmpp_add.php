<?php
session_start();
require "koneksi.php";

$no = $_POST['no_srt'];
$tg = $_POST['tgl'];
$tp = $_POST['tgl_pens'];
$ni = $_POST['nip'];
$as = $_POST['almt'];
$al = ucwords($_POST['alm_pen']);

$sm = $as;
$cek = $_POST['check'];

if(empty($cek)){
	$sql = mysqli_query($konek,"INSERT INTO pmpp VALUES ('$no','$tg','$ni','$tg','$tp','$al')");
	if($sql){
		$_SESSION['pesan']='Simpan data Berhasil';
		header("location:pmpp?filter=ALL");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan, Periksa Sambungan Database';
		header("location:pmpp?filter=ALL");
	}
}else{
	$sql = mysqli_query($konek,"INSERT INTO pmpp VALUES ('$no','$tg','$ni','$tg','$tp','$sm')");
	if($sql){
		$_SESSION['pesan']='Simpan data Berhasil';
		header("location:pmpp?filter=ALL");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan, Periksa Sambungan Database';
		header("location:pmpp?filter=ALL");
	}
}
?>
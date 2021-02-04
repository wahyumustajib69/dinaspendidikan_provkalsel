<?php
session_start();
require "koneksi.php";

$id = $_POST['id'];
$ni = $_POST['nip'];
$pl = $_POST['pklam'];//pangkat lama
$pn = $_POST['pkb'];//id pangkat baru
$pb = $_POST['pnb'];//nama pangkat baru
$jb = $_POST['jbb'];//jabatan baru
$gl = $_POST['gol'];
$at = $_POST['ats'];
$tm = $_POST['tmt'];
$tk = $_POST['tkr'];//tempat kerja lama
$ck = $_POST['cek'];
$tb = $_POST['tkb'];//tempat kerja baru

if(empty($ck)){
	mysqli_query($konek,"UPDATE pegawai SET jbtn='$jb',pangkat='$pn',tmp_kerja='$tb' WHERE nip='$ni'");
	$sql = mysqli_query($konek,"INSERT INTO promosi VALUES ('$id','$ni','$jb','$pn','$pl','$pb','$gl','$at','$tm','$tb','$tk')");
	if($sql){
		$_SESSION['pesan']='Simpan Data Berhasil !!';
		header("location:promosi");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan';
		header("location:promosi");
	}
}else{
	mysqli_query($konek,"UPDATE pegawai SET jbtn='$jb',pangkat='$pn' WHERE nip='$ni'");
	$sql = mysqli_query($konek,"INSERT INTO promosi VALUES ('$id','$ni','$jb','$pn','$pl','$pb','$gl','$at','$tm','$tk','$tk')");
	if($sql){
		$_SESSION['pesan']='Simpan Data Berhasil !!';
		header("location:promosi");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan';
		header("location:promosi");
	}
}
?>
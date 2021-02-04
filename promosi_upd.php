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
$ck = $_POST['ck'];
$tb = $_POST['tkb'];//tempat kerja baru

if($ck=='TETAP'){
	mysqli_query($konek,"UPDATE pegawai SET jbtn='$jb',pangkat='$pn',tmp_kerja='$tk' WHERE nip='$ni'");
	$sql = mysqli_query($konek,"UPDATE promosi SET nip='$ni',jbtn_baru='$jb',id_pkb='$pn',pnkt_lama='$pl',pnkt_baru='$pb',gol_baru='$gl',atasan='$at',tgl_mulai='$tm',tmp_baru='$tk',tmp_lama='$tk' WHERE id_pro='$id'");
	if($sql){
		$_SESSION['pesan']='Update Data Berhasil !!';
		header("location:promosi");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan';
		header("location:promosi");
	}
}else{
	mysqli_query($konek,"UPDATE pegawai SET jbtn='$jb',pangkat='$pn',tmp_kerja='$tb' WHERE nip='$ni'");
	$sql = mysqli_query($konek,"UPDATE promosi SET nip='$ni',jbtn_baru='$jb',id_pkb='$pn',pnkt_lama='$pl',pnkt_baru='$pb',gol_baru='$gl',atasan='$at',tgl_mulai='$tm',tmp_baru='$tb',tmp_lama='$tk' WHERE id_pro='$id'");
	if($sql){
		$_SESSION['pesan']='Update Data Berhasil !!';
		header("location:promosi");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan';
		header("location:promosi");
	}
}
?>
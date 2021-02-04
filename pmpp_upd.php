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
	$sql = mysqli_query($konek,"UPDATE pmpp SET tgl_surat='$tg',nip='$ni',tgl_pengajuan='$tg',tgl_pensiun='$tp',alm_pensiun='$al' WHERE no_surat='$no'");
	if($sql){
		$_SESSION['pesan']='Update data Berhasil';
		header("location:pmpp?filter=ALL");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan, Periksa Sambungan Database';
		header("location:pmpp?filter=ALL");
	}
}else{
	$sql = mysqli_query($konek,"UPDATE pmpp SET tgl_surat='$tg',nip='$ni',tgl_pengajuan='$tg',tgl_pensiun='$tp',alm_pensiun='$sm' WHERE no_surat='$no'");
	if($sql){
		$_SESSION['pesan']='Update data Berhasil';
		header("location:pmpp?filter=ALL");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan, Periksa Sambungan Database';
		header("location:pmpp?filter=ALL");
	}
}
?>
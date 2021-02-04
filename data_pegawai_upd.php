<?php
session_start();
include "koneksi.php";

$ni = $_POST['nip'];
$nm = $_POST['nama'];
$jb = $_POST['jbtn'];
$pk = $_POST['pnkt'];
$tm = $_POST['tmp'];
$tl = $_POST['tgl'];
$us = $_POST['tgl_dia'];
$pp = $_POST['ppk'];
$th = $_POST['tgp'];
$al = $_POST['alm'];
$hp = $_POST['telp'];
$tk = $_POST['tmk'];
$uk = $_POST['kerja'];
$pn = $_POST['pend'];
$ft = $_FILES['foto']['name'];
$tp = $_FILES['foto']['tmp_name'];

//pegawai diganti
$fb = $_POST['ft_br'];

//jika foto pegawai tidak diganti
if(empty($ft)){
	$sql = mysqli_query($konek,"UPDATE pegawai SET nama='$nm',jbtn='$jb',pangkat='$pk',tmp_lahir='$tm',tgl_lahir='$tl',tgl_diangkat='$us',pnkg_png='$pp',tgl_png='$th',alamat='$al',hp='$hp',tmp_kerja='$tk',pend='$pn',unit_kerja='$uk' WHERE nip='$ni'");
	if($sql){
		$_SESSION['pesan']='Update data Berhasil';
		header("location:data_pegawai");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan, Periksa Koneksi Database';
		header("location:data_pegawai");
	}
}else{
	unlink("foto_pgw/".$fb);
	$sql = mysqli_query($konek,"UPDATE pegawai SET nama='$nm',jbtn='$jb',pangkat='$pk',tmp_lahir='$tm',tgl_lahir='$tl',tgl_diangkat='$us',pnkg_png='$pp',tgl_png='$th',alamat='$al',hp='$hp',tmp_kerja='$tk',unit_kerja='$uk',foto='$ft' WHERE nip='$ni'");
	$upd = move_uploaded_file($tp, "foto_pgw/".$ft);
	if($sql){
		$_SESSION['pesan']='Update data Berhasil';
		header("location:data_pegawai");
	}else{
		$_SESSION['pesan']='Terjadi Kesalahan, Periksa Koneksi Database';
		header("location:data_pegawai");
	}
}
?>
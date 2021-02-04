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

$sql = mysqli_query($konek,"INSERT INTO pegawai VALUES ('$ni','$nm','$jb','$pk','$tm','$tl','$us','$pp','$th','$al','$hp','$tk','$uk','$pn','$ft')");
$upd = move_uploaded_file($tp, "foto_pgw/".$ft);
if($upd){
	$_SESSION['pesan']='Simpan data Berhasil';
	header("location:data_pegawai");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan, Atau ukuran Foto TERLALU BESAR';
	header("location:data_pegawai");
}
?>
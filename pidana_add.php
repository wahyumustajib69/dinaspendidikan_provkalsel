<?php
session_start();
require "koneksi.php";

$no = $_POST['no'];
$tg = $_POST['tgl'];
$ni = $_POST['nidn'];
$nm = $_POST['nama'];
$pk = $_POST['pkt'];
$gl = $_POST['gol'];
$jb = $_POST['jbt'];
$pg = $_POST['pgw'];

$sql = mysqli_query($konek,"INSERT INTO pidana VALUES ('$no','$tg','$ni','$nm','$pk','$gl','$jb','$pg')");
if($sql){
	$_SESSION['pesan']='Simpan Data Berhasil !!';
	header("location:pidana?filter=ALL");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:pidana?filter=ALL");
}
?>
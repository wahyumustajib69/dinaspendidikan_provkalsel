<?php
session_start();
require "koneksi.php";

$no = $_POST['no'];
$ts = $_POST['tg_srt'];
$pm = $_POST['pmh'];
$tl = $_POST['tmp'];
$tg = $_POST['tgl'];
$st = $_POST['stts'];
$hb = $_POST['hub'];
$ni = $_POST['nip'];
$tw = $_POST['tgw'];
$id = $_POST['pku'];
$pk = $_POST['nm_pnkt'];
$gl = $_POST['gpn'];

$sql = mysqli_query($konek,"INSERT INTO pen_dj VALUES ('$no','$ts','$pm','$tl','$tg','$st','$hb','$ni','$tw','$id','$pk','$gl')");
if($sql){
	$_SESSION['pesan']='Simpan Data Berhasil !!';
	header("location:pensiun?filter=ALL");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:pensiun?filter=ALL");
}
?>
<?php
session_start();
require "koneksi.php";

$no = $_POST['no'];
$ts = $_POST['tg_srt'];
$tm = $_POST['tmt'];
$bu = $_POST['bup'];
$ip = $_POST['pku'];
$pk = $_POST['nm_pnkt'];
$gp = $_POST['gpn'];
$ni = $_POST['nip'];

$sql = mysqli_query($konek,"INSERT INTO pen_bup VALUES ('$no','$ts','$tm','$bu','$ip','$pk','$gp','$ni')");
if($sql){
	$_SESSION['pesan']='Simpan Data Berhasil !!';
	header("location:pensiun-bup");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:pensiun-bup");
}
?>
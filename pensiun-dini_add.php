<?php
session_start();
require "koneksi.php";

$no = $_POST['no'];
$ts = $_POST['tgsrt'];
$ni = $_POST['nip'];
$re = $_POST['rek'];
$pe = $_POST['peng'];
$tm = $_POST['tgl'];
$id = $_POST['pku'];
$nm = $_POST['nm_pnkt'];
$go = $_POST['gpn'];
$al = $_POST['almt'];

$sql =mysqli_query($konek,"INSERT INTO pen_dn VALUES ('$no','$ts','$ni','$re','$pe','$tm','$id','$nm','$go','$al')");

if($sql){
	$_SESSION['pesan']='Simpan Data Berhasil !!';
	header("location:pensiun-dini?filter=ALL");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:pensiun-dini?filter=ALL");
}
?>
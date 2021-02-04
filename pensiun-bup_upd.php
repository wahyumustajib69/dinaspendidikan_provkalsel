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

$sql = mysqli_query($konek,"UPDATE pen_bup SET tglsurat='$ts',tmt='$tm',bup='$bu',id_pk='$ip',pnkt_baru='$pk',gol_pen='$gp',nip='$ni' WHERE nosrt='$no' ");
if($sql){
	$_SESSION['pesan']='Simpan Data Berhasil !!';
	header("location:pensiun-bup");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:pensiun-bup");
}
?>
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

$sql = mysqli_query($konek,"UPDATE pen_dj SET tgl_surat='$ts',nm_pmh='$pm',tlh='$tl',ttl='$tg',stts='$st',hub='$hb',nip='$ni',tgl_wft='$tw',idpn='$id',pkt_usul='$pk',gol_usul='$gl' WHERE nosurat='$no'");
if($sql){
	$_SESSION['pesan']='Simpan Data Berhasil !!';
	header("location:pensiun?filter=ALL");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:pensiun?filter=ALL");
}
?>
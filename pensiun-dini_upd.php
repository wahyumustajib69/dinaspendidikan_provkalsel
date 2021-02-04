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

$sql =mysqli_query($konek,"UPDATE pen_dn SET tgs='$ts',nip='$ni',no_recom='$re',no_spn='$pe',thmt='$tm',idpnkt='$id',nmpnkt='$nm',golpk='$go',alm_pen='$al' WHERE no_sur='$no'");

if($sql){
	$_SESSION['pesan']='Update Data Berhasil !!';
	header("location:pensiun-dini?filter=ALL");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:pensiun-dini?filter=ALL");
}
?>
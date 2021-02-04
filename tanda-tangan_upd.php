<?php
session_start();
require "koneksi.php";

$ni = $_POST['nip'];
$nm = $_POST['nma'];
$pk = $_POST['pnkt'];
$jb = $_POST['jbtn'];

$sql = mysqli_query($konek,"UPDATE pimpinan SET nma='$nm',png='$pk',jbt='$jb' WHERE ni='$ni'");
if($sql){
	$_SESSION['pesan']='Simpan Data Berhasil !!';
	header("location:tanda-tangan");
}else{
	$_SESSION['pesan']='Terjadi Kesalahan !!';
	header("location:tanda-tangan");
}
?>
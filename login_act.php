<?php
   session_start();
   require_once("koneksi.php");
   $username = $_POST['user'];
   $pass = $_POST['pass'];   
   
   $sql = mysqli_query($konek,"SELECT * FROM pengguna WHERE user = '$username' AND pass='$pass'");
   $hasil = mysqli_fetch_assoc($sql);
   $x = mysqli_num_rows($sql);

   if($x == 0) {
      header('location:login');
      $_SESSION['pesan']='Password atau Username SALAH!!!';
   }else {
       $_SESSION['user'] = $hasil['user'];
       header('location:home');
  }
   
?>
<?php
session_start();
if(!isset($_SESSION['user'])){
  header("location:login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi Pengelola Data Pegawai</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/datatables.bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/select2.min.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/kalsel.png">
</head>

<body id="mimin" class="dashboard">
      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="index.html" class="navbar-brand"> 
                 <b>APMP DISDIKBUD</b>
                </a>

              <ul class="nav navbar-nav search-nav">
                <li>
                   <div class="search">
                    <span class="fa fa-search icon-search" style="font-size:23px;"></span>
                    <div class="form-group form-animate-text">
                      <input type="text" class="form-text" required>
                      <span class="bar"></span>
                      <label class="label-search">Ketik untuk <b>mencari</b> </label>
                    </div>
                  </div>
                </li>
              </ul>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span><?php echo strtoupper($_SESSION['user']) ?></span></li>
                  <li class="dropdown avatar-dropdown">
                   <img src="asset/img/avatar.jpg" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   <ul class="dropdown-menu user-dropdown">
                     <li><a href="#"><span class="fa fa-user"></span> My Profile</a></li>
                     <li><a href="#"><span class="fa fa-calendar"></span> My Calendar</a></li>
                     <li role="separator" class="divider"></li>
                     <li class="more">
                      <ul>
                        <li><a href=""><span class="fa fa-cogs"></span></a></li>
                        <li><a href=""><span class="fa fa-lock"></span></a></li>
                        <li><a href="logout"><span class="fa fa-power-off "></span></a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu -->
            <div id="left-menu">
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                    <li><div class="left-bg"></div></li>
                    <div  align="center"><img src="asset/img/kalsel.png" height="80px"></div>
                    <li class="ripple active"><a href="home"><span class="fa fa-home text-primary"></span>Home</a></li>

                    <li class="ripple"><a href="tanda-tangan"><span class="fa fa-edit text-primary"></span>Tanda Tangan</a></li>
                    <li class="ripple"><a href="pangkat"><span class="fa fa-sitemap text-primary"></span>Pangkat</a></li>

                    <li class="ripple"><a href="data_pegawai?filter=ALL"><span class="fa fa-group text-primary"></span>Pegawai</a></li>

                    <li class="ripple">
                      <a class="tree-toggle nav-header"><span class="fa-home fa text-primary"></span> Pensiun 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav-list tree">
                          <li><a href="pmpp?filter=ALL">PMPP</a></li>
                          <li><a href="pensiun?filter=ALL">Janda / Duda</a></li>
                          <li><a href="pensiun-dini?filter=ALL">Pensiun Dini</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header"><span class="fa-envelope fa text-primary"></span> Surat Pernyataan 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav-list tree">
                          <li><a href="pidana?filter=ALL">Pidana</a></li>
                          <li><a href="pernyataan?filter=ALL">Hukum Disiplin</a></li>
                      </ul>
                    </li>

                    <li class="ripple"><a href="promosi"><span class="fa fa-line-chart text-primary"></span>Promosi</a></li>

                    <li class="ripple"><a href="mutasi"><span class="fa fa-retweet text-primary"></span>Mutasi</a></li>

                    <li class="ripple">
                      <a class="tree-toggle nav-header"><span class="fa-book fa text-primary"></span> Laporan 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav-list tree">
                          <li><a href="laporan_pegawai?filter=ALL" target="_blank">Rekap Pegawai</a></li>
                          <li><a href="laporan_bup?filter=ALL" target="_blank">Rekap BUP</a></li>
                          <li><a href="laporan_dj?filter=ALL" target="_blank">Rekap Janda/Duda</a></li>
                          <li><a href="laporan_dj?filter=ALL" target="_blank">Rekap Pensiun Dini</a></li>
                          <li><a href="laporan_pidana?filter=ALL" target="_blank">Rekap Pidana</a></li>
                          <li><a href="laporan_disiplin?filter=ALL" target="_blank">Rekap Disiplin</a></li>
                          <li><a href="laporan_promosi?filter=ALL" target="_blank">Rekap Promosi</a></li>
                          <li><a href="laporan_mutasi?filter=ALL" target="_blank">Rekap Mutasi</a></li>
                      </ul>
                    </li>
                  </ul>
                </div>
            </div>
          <!-- end: Left Menu -->

          <!-- start: Mobile -->
      <div id="mimin-mobile" class="reverse">
        <div class="mimin-mobile-menu-list">
            <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
                <ul class="nav nav-list">
                    <li><div class="left-bg"></div></li>
                    <div  align="center"><img src="asset/img/kalsel.png" height="80px"></div>
                    <li class="ripple active"><a href="home"><span class="fa fa-home text-primary"></span>Home</a></li>

                    <li class="ripple"><a href="tanda-tangan"><span class="fa fa-edit text-primary"></span>Tanda Tangan</a></li>
                    <li class="ripple"><a href="pangkat"><span class="fa fa-sitemap text-primary"></span>Pangkat</a></li>

                    <li class="ripple"><a href="data_pegawai"><span class="fa fa-group text-primary"></span>Pegawai</a></li>

                    <li class="ripple">
                      <a class="tree-toggle nav-header"><span class="fa-home fa text-primary"></span> Pensiun 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav-list tree">
                          <li><a href="pmpp?filter=ALL">PMPP</a></li>
                          <li><a href="pensiun?filter=ALL">Janda / Duda</a></li>
                          <li><a href="pensiun-dini?filter=ALL">Pensiun Dini</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header"><span class="fa-envelope fa text-primary"></span> Surat Pernyataan 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav-list tree">
                          <li><a href="pidana?filter=ALL">Pidana</a></li>
                          <li><a href="pernyataan?filter=ALL">Hukum Disiplin</a></li>
                      </ul>
                    </li>

                    <li class="ripple"><a href="promosi"><span class="fa fa-line-chart text-primary"></span>Promosi</a></li>

                    <li class="ripple">
                      <a class="tree-toggle nav-header"><span class="fa-book fa text-primary"></span> Laporan 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav-list tree">
                          <li><a href="laporan_pegawai?filter=ALL" target="_blank">Rekap Pegawai</a></li>
                          <li><a href="laporan_bup?filter=ALL" target="_blank">Rekap BUP</a></li>
                          <li><a href="laporan_dj?filter=ALL" target="_blank">Rekap Janda/Duda</a></li>
                          <li><a href="laporan_pidana?filter=ALL" target="_blank">Rekap Pidana</a></li>
                          <li><a href="laporan_disiplin?filter=ALL" target="_blank">Rekap Disiplin</a></li>
                          <li><a href="laporan_promosi?filter=ALL" target="_blank">Rekap Promosi</a></li>
                      </ul>
                    </li>
                  </ul>
            </div>
        </div>       
      </div>
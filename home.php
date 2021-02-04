<?php include "header.php"; include "koneksi.php";?>
          <!-- start: content -->
            <div id="content">
                <div class="panel">
                  <div class="panel-body">
                      <div class="col-md-6 col-sm-12">
                        <h3 class="animated fadeInLeft text-primary">Halaman Beranda</h3>
                        <p class="animated fadeInDown"><span class="fa fa-map-marker text-danger"></span><b class="text-success"> Banjarbaru, Kalimantan Selatan, Indonesia</b></p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="col-md-6 col-sm-6 text-right" style="padding-left:10px;">
                          <h3 style="color:#DDDDDE;"><span class="fa  fa-map-marker"></span> Banjarbaru</h3>
                          <h1 style="margin-top: -10px;color: #ddd;">34<sup>o</sup>C</h1>
                        </div>
                        <div class="col-md-6 col-sm-6">
                           <div class="wheather">
                            <div class="sub-wheather">
                              <center>
                               <div class="suny">
                                    <div class="sun animated pulse infinite">
                                    </div>                             
                                    <div class="mount"></div>
                                    <div class="mount mount1"></div>
                                    <div class="mount mount2"></div>
                                </div>
                          </center>
                            </div>
                          </div>
                        </div>                   
                    </div>
                  </div>                    
                </div>

                <div class="col-md-12" style="padding:20px;">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-12 padding-0">
                            <div class="col-md-12 padding-0">
                                <div class="col-md-4">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">TOTAL PEGAWAI <i class="fa fa-group  text-primary"></i></h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-user icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <?php 
                                        $sql = mysqli_query($konek,"SELECT COUNT(*) as ttl FROM pegawai");
                                        foreach($sql as $pg);
                                        ?>
                                        <?php 
                                        $sql = mysqli_query($konek,"SELECT COUNT(*) as pen FROM pmpp");
                                        foreach($sql as $pn);
                                        ?>
                                        <h1 class="text-primary"><?php echo $pg['ttl'] ?></h1>
                                        <p>Pengajuan Pensiun : <span class="label label-danger"><?php echo $pn['pen'] ?></span></p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-12 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">PROMOSI PEGAWAI <i class="fa fa-line-chart  text-success"></i></h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-basket-loaded icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <?php 
                                        $sql = mysqli_query($konek,"SELECT * FROM promosi");
                                        $pr = mysqli_num_rows($sql);
                                        
                                        $th = date('Y');
                                        $mt = date('m');
                                        $qry = mysqli_query($konek,"SELECT*FROM promosi WHERE year(tgl_mulai)='$th' AND month(tgl_mulai)='$mt'");
                                        $bi = mysqli_num_rows($qry);
                                        ?>
                                        <h1 class="text-success"><?php echo $pr; ?></h1>
                                        <p>Bulan Ini : <span class="label label-success"><?php echo $bi; ?></span></p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="panel box-v1">
                                      <div class="panel-heading bg-white border-none">
                                        <div class="col-md-12 col-sm-6 col-xs-6 text-left padding-0">
                                          <h4 class="text-left">PENSIUN PEGAWAI <i class="fa fa-user-times  text-danger"></i></h4>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                                           <h4>
                                           <span class="icon-basket-loaded icons icon text-right"></span>
                                           </h4>
                                        </div>
                                      </div>
                                      <div class="panel-body text-center">
                                        <?php 
                                        $sql = mysqli_query($konek,"SELECT COUNT(*) as pen FROM pmpp");
                                        foreach($sql as $pe);
                                        ?>
                                        <h1 class="text-danger"><?php echo $pe['pen'] ?></h1>
                                        <?php
                                        $b = date('m');
                                        $t = date('Y');
                                        $qry = mysqli_query($konek,"SELECT*FROM pmpp WHERE year(tgl_pensiun)='$t' AND month(tgl_pensiun)='$b' ");
                                        $hp = mysqli_num_rows($qry);
                                        ?>
                                        <p>Bulan Ini : <span class="label label-danger"><?php echo $hp; ?></p>
                                        <hr/>
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                  <div class="col-md-12 card-wrap padding-0">

                    <div class="col-md-6">
                        <div class="panel">
                          <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                              <h4>Pensiun</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-primary" style="margin-top:10px;">
                                  <label class="onoffswitch-label" for="myonoffswitch3"></label>
                                </div>
                            </div>
                          </div>
                          <div class="panel-body">
                              
                                <canvas class="bar-chart" id="bar-chart"></canvas>
                              
                        </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                        <div class="panel">
                          <div class="panel-heading bg-white border-none" style="padding:20px;">
                            <div class="col-md-6 col-sm-6 col-sm-12 text-left">
                              <h4>Pensiun</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-sm-12">
                                <div class="mini-onoffswitch pull-right onoffswitch-primary" style="margin-top:10px;">
                                  <label class="onoffswitch-label" for="myonoffswitch3"></label>
                                </div>
                            </div>
                          </div>
                          <div class="panel-body">
                              
                                <canvas class="bar-chart" id="perbandingan"></canvas>
                              
                        </div>
                    </div>
                  </div>
                </div>
      		  </div>
          <!-- end: content -->

  
          
      </div>

      <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
        <span class="fa fa-bars"></span>
      </button>
       <!-- end: Mobile -->

    <!-- start: Javascript -->
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/jquery.ui.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
   
    
    <!-- plugins -->
    <script src="asset/js/plugins/moment.min.js"></script>
    <script src="asset/js/plugins/fullcalendar.min.js"></script>
    <script src="asset/js/plugins/jquery.nicescroll.js"></script>
    <script src="asset/js/plugins/jquery.vmap.min.js"></script>
    <script src="asset/js/plugins/maps/jquery.vmap.world.js"></script>
    <script src="asset/js/plugins/jquery.vmap.sampledata.js"></script>
    <script src="asset/js/plugins/Chart.js"></script>


    <!-- custom -->
     <script src="asset/js/main.js"></script>
     <script type="text/javascript">
      <?php
      $th = mysqli_query($konek,"SELECT year(tgl_mulai) as thn FROM promosi GROUP BY year(tgl_mulai)");
      $sql = mysqli_query($konek,"SELECT count(*) AS pro FROM promosi GROUP BY year(tgl_mulai)");
      $qry = mysqli_query($konek,"SELECT count(*) AS pmp FROM pmpp GROUP BY year(tgl_pensiun)");
      ?>
      var ctx = document.getElementById("bar-chart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php while($t = mysqli_fetch_array($th)) { echo $t['thn'] . ', '; } ?>],
        datasets: [{
                label: "PENSIUN",
                backgroundColor: "pink",
                borderColor: "pink",
                borderWidth: 1,
                data: [<?php while($b = mysqli_fetch_array($qry)) { echo $b['pmp'] . ', '; } ?>]
              },
              {
                label: "PROMOSI",
                backgroundColor: "lightblue",
                borderColor: "lightblue",
                borderWidth: 1,
                data: [<?php while($a = mysqli_fetch_array($sql)) { echo $a['pro'] . ', '; } ?>]
              }
            ]
    },
    options: {
      title: {
              display: true,
              text: 'Perbandingan Pensiun dan Promosi Pegawai Pertahun'
            },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
     </script>

     <script type="text/javascript">
       <?php
       $bup = mysqli_query($konek,"SELECT COUNT(*) AS bup FROM pmpp");
       $dud = mysqli_query($konek,"SELECT COUNT(*) AS dud FROM pen_dj");
       $din = mysqli_query($konek,"SELECT COUNT(*) AS din FROM pen_dn");
       ?>
      new Chart(document.getElementById("perbandingan"), {
          type: 'doughnut',
          data: {
            labels: ["Pensiun BUP", "Pensiun Duda/Janda", "Pensiun Dini"],
            datasets: [
              {
                label: "Population (millions)",
                backgroundColor: ["red", "green","yellow"],
                data: [<?php while($x = mysqli_fetch_array($bup)) { echo $x['bup']; } ?>,<?php while($y = mysqli_fetch_array($dud)) { echo $y['dud']; } ?>,<?php while($z = mysqli_fetch_array($din)) { echo $z['din']; } ?>]
              }
            ]
          },
          options: {
            title: {
              display: true,
              text: 'Perbandingan Pensiun BUP, Duda/Janda, Pensiun Dini'
            }
          }
      });
     </script>
  <!-- end: Javascript -->
  </body>
</html>
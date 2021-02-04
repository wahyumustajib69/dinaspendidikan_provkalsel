<?php include "header.php"; include "koneksi.php"; include"tgl_indonesia.php"; ?>
            <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInUp text-primary">Permohonan Masa Persiapan Pensiun (PMPP)</h3>
                        <!--<p class="animated fadeInDown">
                          Table <span class="fa-angle-right fa"></span> Data Tables
                        </p>-->
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading">
                      <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                        <div class="col-md-4">
                          <button type="button" class="btn btn-primary btn-raised" data-toggle="modal" data-target="#modal-pmpp"><i class="fa fa-plus"></i> TAMBAH</button>
                          <a href="laporan_bup?filter=<?php echo $_GET['filter'] ?>" target="_blank" class="btn btn-raised btn-warning"><i class="fa fa-print"></i> REKAP</a> 
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                          <form method="get" >
                          <select name="filter" class="form-control primary" onchange="this.form.submit()">
                            <option selected="" disabled="">-PILIH-</option>
                            <option value="ALL">SEMUA</option>
                            <?php
                            error_reporting(0);
                            $sql = mysqli_query($konek,"SELECT tgl_surat FROM pmpp GROUP BY month(tgl_surat)");
                            foreach($sql as $tg){
                              $tgl = explode('-', $tg['tgl_surat']);
                              $t = $tgl[0].'-'.$tgl[1];
                            ?>
                            <option value="<?php echo $t?>"><?php echo tgl_indo($t)?></option>
                            <?php } ?>
                          </select>
                        </form>
                        </div>
                        </div>
                      </div>
                    </div>
                    </div>

                    <?php
                  if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
                    ?>
                    <div id="pesan" class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert" style="display:none;">
                      <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                        <span class="fa fa-check fa-2x"></span></div>
                        <div class="col-md-10 col-sm-10">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                          <p><strong>Success!</strong> <?php echo $_SESSION['pesan']?></p>
                        </div>
                      </div>
                      <?php }
                        $_SESSION['pesan'] = '';
                      ?>
                    
      
                
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>NO. SURAT</th>
                          <th>TGL. SURAT</th>
                          <th>NIP</th>
                          <th>NAMA</th>
                          <th>TGL. PENSIUN</th>
                          <th>ALAMAT PENSIUN</th>
                          <th>AKSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $fil = $_GET['filter'];
                        if($_GET['filter']=='ALL'){
                          $sql = mysqli_query($konek,"SELECT*FROM pmpp AS a JOIN pegawai AS b ON a.nip=b.nip ORDER BY a.no_surat DESC");
                        }else{
                          $tg = explode('-', $_GET['filter']);
                          $th = $tg[0];
                          $bl = $tg[1];
                          $sql = mysqli_query($konek,"SELECT*FROM pmpp AS a JOIN pegawai AS b ON a.nip=b.nip WHERE month(tgl_surat)='$bl' AND year(tgl_surat)='$th' ORDER BY a.no_surat DESC");                
                        }
                        
                        foreach($sql as $pm){
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo '882/'.$pm['no_surat'] ?></td>
                          <td><?php echo tgl_indo($pm['tgl_surat']) ?></td>
                          <td><?php echo $pm['nip'] ?></td>
                          <td><?php echo $pm['nama'] ?></td>
                          <td><?php echo tgl_indo($pm['tgl_pensiun']) ?></td>
                          <td><?php echo $pm['alm_pensiun'] ?></td>
                          <td width="17%">
                            <a href="#" id="<?php echo $pm['no_surat'] ?>" class="btn btn-primary btn-raised btn-xs modal_edit"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-raised btn-xs" onclick="confirm_delete('pmpp_del.php?id=<?php echo $pm['no_surat'];?>')"><i class="fa fa-trash"></i></a>
                            <a href="laporan_detail_bup?ref=<?php echo $pm['no_surat'] ?>" target="_blank" class="btn btn-raised btn-warning btn-xs"><i class="fa fa-print"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                        </table>
                      </div>
                  </div>
                </div>

                <div class="modal fade" id="modal-pmpp">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form method="post" action="pmpp_add.php">
                      <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                        <h3 class="modal-title">Tambah PMPP</h3>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <?php
                          $hasil = mysqli_query($konek,"SELECT max(no_surat) as maxNo FROM pmpp");
                          $data  = mysqli_fetch_assoc($hasil);
                          $no= $data['maxNo'];
                          $noUrut= $no + 1;
                          $th = date('Y');
                          $tambah = sprintf("%04s",$noUrut);
                          $no_srt = $tambah.'-set/disdikbud/'.$th;

                          ?>
                          <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">No. Surat</label>
                              <div class="col-sm-10"><input type="text" name="no_srt" class="form-control primary" value="<?php echo $no_srt; ?>" readonly></div>
                          </div>
                          <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tgl. Surat</label>
                              <div class="col-sm-10"><input type="date" name="tgl" class="form-control primary" required=""></div>
                          </div>
                          <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tgl. Pensiun</label>
                              <div class="col-sm-10"><input type="date" name="tgl_pens" class="form-control primary" required=""></div>
                          </div>
                          <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama Pegawai</label>
                            <div class="col-sm-10">
                              <select name="nip" id="nip"  onchange="changeValue(this.value)" class="form-control primary pmpp" style="width: 100%" required="">
                                <option selected="" disabled="">-PILIH-</option>
                                <?php
                                $result = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt");   
                                $jsArray = "var peg = new Array();\n";       
                                while ($row = mysqli_fetch_array($result)) {   
                                    echo '<option value="' . $row['nip'] . '">' . $row['nama'] . '</option>';   
                                    $jsArray .= "peg['" . $row['nip'] . "'] = {
                                      nip:'".addslashes($row['nip'])."',
                                      nama:'".addslashes($row['nama'])."',
                                      jbtn:'".addslashes($row['jbtn'])."',
                                      pnkt:'".addslashes($row['nm_pnkt'])."',
                                      gol:'".addslashes($row['ket'])."',
                                      tmp:'".addslashes($row['tmp_lahir'])."',
                                      tgl:'".addslashes($row['tgl_lahir'])."',
                                      almt:'".addslashes($row['alamat'])."'
                                    };\n";   
                                }     
                                ?>    
                              </select>
                            </div>
                          </div>

                          <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">NIP</label>
                              <div class="col-sm-10"><input type="text" id="nmp" name="nmp" class="form-control primary" readonly=""></div>
                          </div>
                          <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Jabatan</label>
                              <div class="col-sm-10"><input type="text" id="jbtn" name="jbtn" class="form-control primary" readonly=""></div>
                          </div>
                          <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Pnkt/Gol</label>
                              <div class="col-sm-10"><input type="text" id="pkt" name="pkt" class="form-control primary" readonly=""></div>
                          </div>
                          <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">TTL</label>
                              <div class="col-sm-10"><input type="text" id="ttl" name="ttl" class="form-control primary" readonly=""></div>
                          </div>
                          <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Alamat Sekarang</label>
                              <div class="col-sm-10"><textarea name="almt" class="form-control primary" id="almt" readonly=""></textarea></div>
                          </div>
                          <div class="form-group col-md-12" style="margin-top: -15px;"><label class="col-sm-2 control-label text-right"></label>
                              <div class="col-sm-10"><label class="text-primary"><input type="checkbox" name="check" id="check" value="SAMA"> Sama dengan alamat sekarang</label></div>
                          </div>
                          <div class="form-group col-md-12" id="alamat" style="margin-top: -15px;"><label class="col-sm-2 control-label text-right">Alamat Pensiun</label>
                              <div class="col-sm-10"><textarea name="alm_pen" class="form-control primary"></textarea></div>
                          </div>
                        </div>
                      </div>
                      <script type="text/javascript">   
                      <?php echo $jsArray; ?> 
                      function changeValue(nip){ 
                      document.getElementById('nmp').value = peg[nip].nip; 
                      document.getElementById('jbtn').value = peg[nip].jbtn;
                      document.getElementById('pkt').value = peg[nip].pnkt+' /'+peg[nip].gol; 
                      document.getElementById('ttl').value = peg[nip].tmp+', '+peg[nip].tgl;
                      document.getElementById('almt').value = peg[nip].almt;
                      }; 
                      </script> 
                      <div class="modal-footer" style="margin-top: -20px;">
                        <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary btn-raised"><i class="fa fa-floppy-o"></i> Simpan</button>
                      </div>
                    </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="modal fade" id="pmpp-edit"></div>

                <!--Modal Hapus-->
                <div class="modal modal-xs fade" id="modal-delete">
                  <div class="modal-dialog">
                    <div class="modal-content" style="margin-top:150px;">
                        <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                            <h4 class="modal-title"><i class="fa fa-exclamation-triangle"></i> KONFIRMASI</h4>
                        </div> 
                        <div class="modal-body" align="center">Apakah Anda Yakin??<br>Hapus data <i class="fa fa-trash"></i></div>   
                        <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                            <a href="#" class="btn btn-danger btn-raised" id="delete-link"><i class="fa fa-check"></i> Hapus</a>
                            <button type="button" class="btn btn-success btn-raised" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        </div>
                    </div>
                  </div>
                </div>

              </div>  
              </div>
            </div>
          <!-- end: content -->
      </div>

      <!-- start: Mobile -->
      <div id="mimin-mobile" class="reverse">
        <div class="mimin-mobile-menu-list">
            <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
                <ul class="nav nav-list">
                    <li class="active ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa-home fa"></span>Dashboard 
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                          <li><a href="dashboard-v1.html">Dashboard v.1</a></li>
                          <li><a href="dashboard-v2.html">Dashboard v.2</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa-diamond fa"></span>Layout
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="topnav.html">Top Navigation</a></li>
                        <li><a href="boxed.html">Boxed</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa-area-chart fa"></span>Charts
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="chartjs.html">ChartJs</a></li>
                        <li><a href="morris.html">Morris</a></li>
                        <li><a href="flot.html">Flot</a></li>
                        <li><a href="sparkline.html">SparkLine</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa fa-pencil-square"></span>Ui Elements
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="color.html">Color</a></li>
                        <li><a href="weather.html">Weather</a></li>
                        <li><a href="typography.html">Typography</a></li>
                        <li><a href="icons.html">Icons</a></li>
                        <li><a href="buttons.html">Buttons</a></li>
                        <li><a href="media.html">Media</a></li>
                        <li><a href="panels.html">Panels & Tabs</a></li>
                        <li><a href="notifications.html">Notifications & Tooltip</a></li>
                        <li><a href="badges.html">Badges & Label</a></li>
                        <li><a href="progress.html">Progress</a></li>
                        <li><a href="sliders.html">Sliders</a></li>
                        <li><a href="timeline.html">Timeline</a></li>
                        <li><a href="modal.html">Modals</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header">
                       <span class="fa fa-check-square-o"></span>Forms
                       <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="formelement.html">Form Element</a></li>
                        <li><a href="#">Wizard</a></li>
                        <li><a href="#">File Upload</a></li>
                        <li><a href="#">Text Editor</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa fa-table"></span>Tables
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="datatables.html">Data Tables</a></li>
                        <li><a href="handsontable.html">handsontable</a></li>
                        <li><a href="tablestatic.html">Static</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a href="calendar.html">
                         <span class="fa fa-calendar-o"></span>Calendar
                      </a>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa fa-envelope-o"></span>Mail
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="mail-box.html">Inbox</a></li>
                        <li><a href="compose-mail.html">Compose Mail</a></li>
                        <li><a href="view-mail.html">View Mail</a></li>
                      </ul>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header">
                        <span class="fa fa-file-code-o"></span>Pages
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                        <li><a href="forgotpass.html">Forgot Password</a></li>
                        <li><a href="login.html">SignIn</a></li>
                        <li><a href="reg.html">SignUp</a></li>
                        <li><a href="article-v1.html">Article v1</a></li>
                        <li><a href="search-v1.html">Search Result v1</a></li>
                        <li><a href="productgrid.html">Product Grid</a></li>
                        <li><a href="profile-v1.html">Profile v1</a></li>
                        <li><a href="invoice-v1.html">Invoice v1</a></li>
                      </ul>
                    </li>
                     <li class="ripple"><a class="tree-toggle nav-header"><span class="fa "></span> MultiLevel  <span class="fa-angle-right fa right-arrow text-right"></span> </a>
                      <ul class="nav nav-list tree">
                        <li><a href="view-mail.html">Level 1</a></li>
                        <li><a href="view-mail.html">Level 1</a></li>
                        <li class="ripple">
                          <a class="sub-tree-toggle nav-header">
                            <span class="fa fa-envelope-o"></span> Level 1
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                          </a>
                          <ul class="nav nav-list sub-tree">
                            <li><a href="mail-box.html">Level 2</a></li>
                            <li><a href="compose-mail.html">Level 2</a></li>
                            <li><a href="view-mail.html">Level 2</a></li>
                          </ul>
                        </li>
                      </ul>
                    </li>
                    <li><a href="credits.html">Credits</a></li>
                  </ul>
            </div>
        </div>       
      </div>
      <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
        <span class="fa fa-bars"></span>
      </button>
       <!-- end: Mobile -->
<?php include "footer.php"; ?>
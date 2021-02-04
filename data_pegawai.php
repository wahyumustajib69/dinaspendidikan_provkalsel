<?php include "header.php"; include "koneksi.php"; include "tgl_indonesia.php"; ?>
            <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft text-primary">Data Pegawai</h3>
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
                          <button type="button" class="btn btn-primary btn-3d" data-toggle="modal" data-target="#modal-pegawai"><i class="fa fa-plus"></i> TAMBAH</button>
                      <a href="laporan_pegawai?filter=<?php echo $_GET['filter'] ?>" target="_blank" class="btn btn-3d btn-warning"><i class="fa fa-print"></i> REKAP</a> 
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                          <form method="get" >
                          <select name="filter" class="form-control primary" onchange="this.form.submit()">
                            <option selected="" disabled="">-PILIH-</option>
                            <option value="ALL">SEMUA</option>
                            <?php
                            error_reporting(0);
                            $sql = mysqli_query($konek,"SELECT * FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt GROUP BY a.pangkat");
                            foreach($sql as $tg){
                            ?>
                            <option value="<?php echo $tg['pangkat']?>"><?php echo $tg['nm_pnkt']?></option>
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
                          <th>NIP</th>
                          <th>NAMA</th>
                          <th>JABATAN</th>
                          <th>PANGKAT/GOL</th>
                          <th>TTL</th>
                          <th>USIA</th>
                          <th>TELEPON</th>
                          <th>TEMPAT KERJA</th>
                          <th>AKSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;

                        if($_GET['filter']=='ALL'){
                          $sql = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt ORDER BY a.nip");
                        }else{
                          $ft = $_GET['filter'];
                          $sql = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt WHERE pangkat='$ft' ORDER BY a.nip");
                        }
                        
                        foreach($sql as $pk){
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $pk['nip'] ?></td>
                          <td><?php echo $pk['nama'] ?></td>
                          <td><?php echo $pk['jbtn'] ?></td>
                          <td><?php echo $pk['nm_pnkt'].' /'.$pk['ket'] ?></td>
                          <td><?php echo $pk['tmp_lahir'].', '.tgl_indo($pk['tgl_lahir']) ?></td>
                          <td><?php
                           $us = new DateTime($pk['tgl_lahir']);
                           $td = new DateTime();
                           $usia =  $td->diff($us);

                           echo $usia->y; echo " Tahun, "; echo $usia->m; echo " Bulan";

                           ?></td>
                          <td><?php echo $pk['hp'] ?></td>
                          <td><?php echo $pk['tmp_kerja'] ?></td>
                          <td width="18%">
                            <a href="#" id="<?php echo $pk['nip'] ?>" class="btn btn-primary btn-3d btn-xs modal_edit"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-3d btn-xs" onclick="confirm_delete('data_pegawai_del.php?ref=<?php echo $pk['nip'];?>')"><i class="fa fa-trash"></i></a>
                            <a href="#" class="btn btn-3d btn-xs btn-warning disabled"><i class="fa fa-print"></i></a>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                        </table>
                      </div>
                  </div>
                </div>

                <div class="modal fade" id="modal-pegawai">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <form method="post" action="data_pegawai_add.php" enctype="multipart/form-data">
                      <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                        <h3 class="modal-title">Tambah Pegawai</h3>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="row">
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">NIP</label>
                                      <div class="col-sm-10"><input type="text" name="nip" class="form-control primary" required=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama</label>
                                      <div class="col-sm-10"><input type="text" name="nama" class="form-control primary" required=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Jabatan</label>
                                      <div class="col-sm-10"><input type="text" name="jbtn" class="form-control primary" required=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat/Gol.</label>
                                      <div class="col-sm-10">
                                        <select name="pnkt" class="form-control primary pangkat" style="width: 100%" required="">
                                          <option selected="" disabled="">-PILIH-</option>
                                          <?php
                                          $sql = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
                                          foreach($sql as $hs){
                                          ?>
                                          <option value="<?php echo $hs['id_pnkt'] ?>"><?php echo $hs['nm_pnkt'].'/'.$hs['ket'] ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tempat Lahir</label>
                                      <div class="col-sm-10"><input type="text" name="tmp" class="form-control primary" required=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tanggal Lahir</label>
                                      <div class="col-sm-10"><input type="date" name="tgl" class="form-control primary" required=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tgl Diangkat</label>
                                      <div class="col-sm-10"><input type="date" name="tgl_dia" class="form-control primary" required=""></div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-6">
                                <div class="row">
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Awal</label>
                                  <div class="col-sm-10">
                                    <select name="ppk" class="form-control primary pangkat" style="width: 100%">
                                      <option selected="" disabled="">-PILIH-</option>
                                      <?php
                                          $sql = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
                                          foreach($sql as $hs){
                                          ?>
                                          <option value="<?php echo $hs['id_pnkt'] ?>"><?php echo $hs['nm_pnkt'].'/'.$hs['ket'] ?></option>
                                          <?php } ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tanggal</label>
                                      <div class="col-sm-10"><input type="date" name="tgp" class="form-control primary" required=""></div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Alamat</label>
                                    <div class="col-sm-10"><textarea name="alm" class="form-control primary" required=""></textarea></div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">HP/Telp.</label>
                                      <div class="col-sm-10"><input type="text" name="telp" class="form-control primary" onkeypress="return hanyaAngka(event)" required=""></div>
                                  </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tempat Kerja</label>
                                    <div class="col-sm-10"><input type="text" name="tmk" class="form-control primary" required=""></div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Unit Kerja</label>
                                  <div class="col-sm-10"><input type="text" name="kerja" class="form-control primary" required="" value="Dinas Pendidikan dan Kebudayaan Provinsi Kalimantan Selatan"></div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pendidikan Terakhir</label>
                                    <div class="col-sm-10"><input type="text" name="pend" class="form-control primary" required=""></div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Foto</label>
                                      <div class="col-sm-10"><input type="file" name="foto" class="form-control primary" required=""></div>
                                  </div>

                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-3d" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary btn-3d"><i class="fa fa-floppy-o"></i> Simpan</button>
                      </div>
                    </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="modal fade" id="pegawai-edit"></div>

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
                            <a href="#" class="btn btn-danger btn-3d" id="delete-link"><i class="fa fa-check"></i> Hapus</a>
                            <button type="button" class="btn btn-success btn-3d" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        </div>
                    </div>
                  </div>
                </div>

              </div>  
              </div>
            </div>
              <script>
                function hanyaAngka(evt) {
                  var charCode = (evt.which) ? evt.which : event.keyCode
                   if (charCode > 31 && (charCode < 48 || charCode > 57))
             
                    return false;
                  return true;
                }
              </script>
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
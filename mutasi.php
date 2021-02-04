<?php include "header.php"; include "koneksi.php"; ?>
            <!-- start: Content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInRight text-primary">Data Mutasi</h3>
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
                      <button type="button" class="btn btn-gradient btn-primary" data-toggle="modal" data-target="#modal-promosi"><i class="fa fa-plus"></i> TAMBAH</button>
                      <a href="laporan_mutasi" target="_blank" class="btn btn-warning btn-gradient"><i class="fa fa-print"></i> REKAP</a>
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
                          <th>PANGKAT</th>
                          <th>NAMA</th>
                          <th>PANGKAT/GOL. LAMA</th>
                          <th>PANGKAT/GOL. BARU</th>
                          <th>JABATAN LAMA</th>
                          <th>JABATAN BARU</th>
                          <th>TMP BARU</th>
                          <th>TMP LAMA</th>
                          <th>AKSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $sql = mysqli_query($konek,"SELECT*FROM promosi AS a JOIN pangkat AS b ON a.pnkt_lama=b.id_pnkt JOIN pegawai AS c ON a.nip=c.nip WHERE a.tmp_baru<>a.tmp_lama");
                        foreach($sql as $pk){
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $pk['nip'] ?></td>
                          <td><?php echo $pk['nama'] ?></td>
                          <td><?php echo $pk['nm_pnkt'].'/ '.$pk['ket'] ?></td>
                          <td><?php echo $pk['pnkt_baru'].'/ '.$pk['gol_baru'] ?></td>
                          <td><?php echo $pk['jbtn'] ?></td>
                          <td><?php echo $pk['jbtn_baru'] ?></td>
                          <td><?php echo $pk['tmp_baru'] ?></td>
                          <td><?php echo $pk['tmp_lama'] ?></td>
                          <td width="18%">
                            <a href="#" id="<?php echo $pk['id_pro'] ?>" class="btn btn-primary btn-gradient btn-xs modal_edit"><i class="fa fa-edit"></i></a>
                            <a class="btn btn-danger btn-gradient btn-xs" onclick="confirm_delete('promosi_del.php?id=<?php echo $pk['id_pro'];?>')"><i class="fa fa-trash"></i></a>
                            <a href="laporan_detail_pro?ref=<?php echo $pk['id_pro'];?>" target="_blank" class="btn btn-warning btn-gradient btn-xs"><i class="fa fa-print"></i> </a>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                        </table>
                      </div>
                  </div>
                </div>

                <div class="modal fade" id="modal-promosi">
                  <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                      <form method="post" action="promosi_add.php" enctype="multipart/form-data">
                      <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
                        <h3 class="modal-title">Tambah Mutasi & Promosi</h3>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="row">
                                  <input type="hidden" name="id" value="<?php echo rand(1000,9999) ?>">
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama Pegawai</label>
                                    <div class="col-sm-10">
                                      <select name="nip" id="nip"  onchange="tampil(this.value)" class="form-control primary pro" style="width: 100%" required="">
                                        <option selected="" disabled="">-PILIH-</option>
                                        <?php
                                        $result = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt ORDER BY a.nama");   
                                        $jsArray = "var pgh = new Array();\n";       
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>   
                                        <option value="<?php echo $row['nip'] ?>"><?php echo $row['nama'] ?></option>
                                            <?php  
                                            $jsArray .= "pgh['" . $row['nip'] . "'] = {
                                              nip:'".addslashes($row['nip'])."',
                                              nama:'".addslashes($row['nama'])."',
                                              jbtn:'".addslashes($row['jbtn'])."',
                                              idpkt:'".addslashes($row['id_pnkt'])."',
                                              pnkt:'".addslashes($row['nm_pnkt'])."',
                                              gol:'".addslashes($row['ket'])."',
                                              tmp:'".addslashes($row['tmp_kerja'])."',
                                              tpl:'".addslashes($row['tmp_lahir'])."',
                                              tgl:'".addslashes($row['tgl_lahir'])."',
                                              tlp:'".addslashes($row['hp'])."',
                                              ukr:'".addslashes($row['unit_kerja'])."'
                                            };\n";   
                                        }     
                                        ?>    
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">NIP</label>
                                      <div class="col-sm-10"><input type="text" name="nama" id="nama" class="form-control primary" onkeypress="return hanyaAngka(event)" readonly=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">TTL</label>
                                      <div class="col-sm-10"><input type="text" name="ttl" id="ttl" class="form-control primary" readonly=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Pangkat/Gol.</label>
                                      <div class="col-sm-10"><input type="text" name="pnk" id="pnk" class="form-control primary" readonly=""></div>
                                  </div>
                                  <input type="hidden" name="pklam" id="pklam" class="form-control primary" readonly="">
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tempat Kerja</label>
                                      <div class="col-sm-10"><input type="text" name="tkr" id="tkr" class="form-control primary" readonly=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Unit Kerja</label>
                                      <div class="col-sm-10"><input type="text" name="ukr" id="ukr" class="form-control primary" readonly=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Jabatan</label>
                                      <div class="col-sm-10"><input type="text" name="jbtn" id="jbtn" class="form-control primary" readonly=""></div>
                                  </div>
                                  <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Telepon</label>
                                      <div class="col-sm-10"><input type="text" name="telp" id="telp" class="form-control primary" readonly=""></div>
                                  </div>
                                </div>
                              </div>
                              

                              <div class="col-md-6">
                                <div class="row">
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Baru</label>
                                  <div class="col-sm-10">
                                    <select name="pkb" id="pkb" class="form-control primary pang" onchange="ganti(this.value)" style="width: 100%" required="">
                                      <option selected="" disabled="">-PILIH-</option>
                                      <?php
                                        $sql = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
                                        $Array = "var pnk = new Array();\n";
                                        while($hs = mysqli_fetch_array($sql)){
                                        ?>
                                        <option value="<?php echo $hs['id_pnkt'] ?>"><?php echo $hs['nm_pnkt'].' /'.$hs['ket'] ?></option>
                                        <?php 
                                        $Array .= "pnk['" . $hs['id_pnkt'] . "'] = {
                                            npk:'".addslashes($hs['nm_pnkt'])."',
                                            glb:'".addslashes($hs['ket'])."'
                                          };\n"; 
                                        } 
                                      ?>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Baru</label>
                                  <div class="col-sm-10"><input type="text" id="pnb" name="pnb" class="form-control primary" required="" readonly=""></div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Golongan Baru</label>
                                  <div class="col-sm-10"><input type="text" id="gol" name="gol" class="form-control primary" required="" readonly=""></div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Jabatan Baru</label>
                                  <div class="col-sm-10"><input type="text" id="jbb" name="jbb" class="form-control primary" required=""></div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Atasan</label>
                                      <div class="col-sm-10"><input type="text" name="ats" class="form-control primary" required=""></div>
                                </div>
                                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">TMT</label>
                                      <div class="col-sm-10"><input type="date" name="tmt" class="form-control primary" required=""></div>
                                  </div>
                                <div class="form-group col-md-12" style="margin-top: -10px;"><label class="col-sm-2 control-label text-right"></label>
                                  <div class="col-sm-10"><label class="text-primary"><input type="checkbox" name="cek" id="cek" value="TETAP"> Masih Tetap</label></div>
                              </div>
                                <div class="form-group col-md-12" id="kerja" style="margin-top: -15px;"><label class="col-sm-2 control-label text-left">Tempat Kerja Baru</label>
                                    <div class="col-sm-10"><textarea name="tkb" class="form-control primary"></textarea></div>
                                </div>

                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                        
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-gradient" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary btn-gradient"><i class="fa fa-floppy-o"></i> Simpan</button>
                      </div>
                    </form>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div class="modal fade" id="promosi-edit"></div>

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
                            <a href="#" class="btn btn-danger btn-gradient" id="delete-link"><i class="fa fa-check"></i> Hapus</a>
                            <button type="button" class="btn btn-success btn-gradient" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
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
       <script type="text/javascript">   
        <?php echo $jsArray; ?> 
        function tampil(nip){ 
        document.getElementById('nama').value = pgh[nip].nip; 
        document.getElementById('ttl').value = pgh[nip].tpl+', '+pgh[nip].tgl;
        document.getElementById('pnk').value = pgh[nip].pnkt+' /'+pgh[nip].gol;
        document.getElementById('tkr').value = pgh[nip].tmp;
        document.getElementById('ukr').value = pgh[nip].ukr;
        document.getElementById('jbtn').value = pgh[nip].jbtn;
        document.getElementById('telp').value = pgh[nip].tlp;
        document.getElementById('pklam').value = pgh[nip].idpkt;
        }; 
        </script>
        <script type="text/javascript">   
        <?php echo $Array; ?> 
        function ganti(id_pnkt){ 
        document.getElementById('pnb').value = pnk[id_pnkt].npk;
        document.getElementById('gol').value = pnk[id_pnkt].glb;
        }; 
        </script>
<?php include "footer.php"; ?>
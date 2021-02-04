<?php
require "koneksi.php";
$id = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM promosi WHERE id_pro='$id'");
foreach($sql as $pr){
?>
<div class="modal-dialog modal-dialog-scrollable modal-lg">
  <div class="modal-content">
    <form method="post" action="promosi_upd.php" enctype="multipart/form-data">
    <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      <h3 class="modal-title">Update Kenaikan Pangkat & Promosi</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <input type="hidden" name="id" value="<?php echo $pr['id_pro'] ?>">
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama Pegawai</label>
                  <div class="col-sm-10">
                    <select name="nip" id="nip"  onchange="tampil(this.value)" class="form-control primary prom" style="width: 100%" required="">
                      <option selected="" disabled="">-PILIH-</option>
                      <?php
                      $result = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt ORDER BY a.nama");   
                      $jsArray = "var pgw = new Array();\n";       
                      while ($row = mysqli_fetch_array($result)) {
                      ?>   
                      <option value="<?php echo $row['nip'] ?>"<?php if($pr['nip']==$row['nip']){echo 'selected';} ?>><?php echo $row['nama'] ?></option>
                          <?php  
                          $jsArray .= "pgw['" . $row['nip'] . "'] = {
                            ni:'".addslashes($row['nip'])."',
                            nam:'".addslashes($row['nama'])."',
                            jbt:'".addslashes($row['jbtn'])."',
                            idpk:'".addslashes($row['id_pnkt'])."',
                            pnk:'".addslashes($row['nm_pnkt'])."',
                            go:'".addslashes($row['ket'])."',
                            tm:'".addslashes($row['tmp_kerja'])."',
                            tp:'".addslashes($row['tmp_lahir'])."',
                            tg:'".addslashes($row['tgl_lahir'])."',
                            tl:'".addslashes($row['hp'])."',
                            uk:'".addslashes($row['unit_kerja'])."'
                          };\n";   
                      }     
                      ?>    
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">NIP</label>
                    <div class="col-sm-10"><input type="text" name="nama" id="nama2" class="form-control primary" readonly="" value="<?php echo $pr['nip'] ?>"></div>
                </div>
                <?php
                $nip = $pr['nip'];
                $qr = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt WHERE nip='$nip'");
                foreach($qr as $pg){
                ?>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">TTL</label>
                    <div class="col-sm-10"><input type="text" name="ttl" id="ttl2" class="form-control primary" readonly="" value="<?php echo $pg['tmp_lahir'].', '.$pg['tgl_lahir'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Pangkat/Gol.</label>
                    <div class="col-sm-10"><input type="text" name="pnk" id="pnk2" class="form-control primary" readonly="" value="<?php echo $pg['nm_pnkt'].' /'.$pg['ket'] ?>"></div>
                </div>

                <input type="hidden" name="pklam" id="pklam2" class="form-control primary" readonly="" value="<?php echo $pr['pnkt_lama'] ?>">

                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tempat Kerja</label>
                  <div class="col-sm-10"><input type="text" name="tkr" id="tkr2" class="form-control primary" readonly="" value="<?php echo $pg['tmp_kerja'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Unit Kerja</label>
                  <div class="col-sm-10"><input type="text" name="ukr" id="ukr2" class="form-control primary" readonly="" value="<?php echo $pg['unit_kerja'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Jabatan</label>
                  <div class="col-sm-10"><input type="text" name="jbtn" id="jbtn2" class="form-control primary" readonly="" value="<?php echo $pg['jbtn'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Telepon</label>
                  <div class="col-sm-10"><input type="text" name="telp" id="telp2" class="form-control primary" readonly="" value="<?php echo $pg['hp'] ?>"></div>
                </div>
                <?php } ?>
              </div>
            </div>
            <script type="text/javascript">   
            <?php echo $jsArray; ?> 
            function tampil(nip){ 
            document.getElementById('nama2').value = pgw[nip].ni; 
            document.getElementById('ttl2').value = pgw[nip].tp+', '+pgw[nip].tg;
            document.getElementById('pnk2').value = pgw[nip].pnk+' /'+pgw[nip].go;
            document.getElementById('tkr2').value = pgw[nip].tm;
            document.getElementById('ukr2').value = pgw[nip].uk;
            document.getElementById('jbtn2').value = pgw[nip].jbt;
            document.getElementById('telp2').value = pgw[nip].tl;
            document.getElementById('pklam2').value = pgw[nip].idpk;
            }; 
            </script>

            <div class="col-md-6">
              <div class="row">
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Baru</label>
                <div class="col-sm-10">
                  <select name="pkb" id="pkb" class="form-control primary pnkt" onchange="ganti(this.value)" style="width: 100%" required="">
                    <option selected="" disabled="">-PILIH-</option>
                    <?php
                      $sql = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
                      $Array = "var pnk = new Array();\n";
                      while($hs = mysqli_fetch_array($sql)){
                      ?>
                      <option value="<?php echo $hs['id_pnkt'] ?>"<?php if($pr['id_pkb']==$hs['id_pnkt']){echo 'selected';} ?>><?php echo $hs['nm_pnkt'].' /'.$hs['ket'] ?></option>
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
                <div class="col-sm-10"><input type="text" id="pnb2" name="pnb" class="form-control primary" required="" readonly="" value="<?php echo $pr['pnkt_baru'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Golongan Baru</label>
                <div class="col-sm-10"> <input type="text" id="gol2" name="gol" class="form-control primary" required="" readonly="" value="<?php echo $pr['gol_baru'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Jabatan Baru</label>
                <div class="col-sm-10"><input type="text" id="jbb" name="jbb" class="form-control primary" required="" value="<?php echo $pr['jbtn_baru'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Atasan</label>
                <div class="col-sm-10"><input type="text" name="ats" class="form-control primary" required="" value="<?php echo $pr['atasan'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">TMT</label>
                <div class="col-sm-10"><input type="date" name="tmt" class="form-control primary" required="" value="<?php echo $pr['tgl_mulai'] ?>"></div>
                </div>
              <div class="form-group col-md-12" style="margin-top: -10px;"><label class="col-sm-2 control-label text-right"></label>
                <div class="col-sm-10"><label class="text-primary"><input type="checkbox" name="ck" id="ck" value="TETAP"> Masih Tetap</label></div>
            </div>
              <div class="form-group col-md-12" id="krj" style="margin-top: -15px;"><label class="col-sm-2 control-label text-left">Tempat Kerja Baru</label>
                  <div class="col-sm-10"><textarea name="tkb" class="form-control primary"><?php echo $pr['tmp_baru'] ?></textarea></div>
              </div>

              </div>
            </div>
            <script type="text/javascript">   
            <?php echo $Array; ?> 
            function ganti(id_pnkt){ 
            document.getElementById('pnb2').value = pnk[id_pnkt].npk;
            document.getElementById('gol2').value = pnk[id_pnkt].glb;
            }; 
            </script>
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
<?php } ?>
<script>
  $(".prom").select2({
     dropdownParent: $("#promosi-edit")
  });
</script>
<script>
  $(".pnkt").select2({
     dropdownParent: $("#promosi-edit")
  });
</script>
<script type='text/javascript'>
  $(document).ready(function(){
    $("#krj").css("display","block");
   
    $('#ck').change(function(){
      if (this.checked) {
        $('#krj').fadeOut('slow');
      } 
      else {
        $('#krj').fadeIn('slow');
      }  
    });
  });
</script>
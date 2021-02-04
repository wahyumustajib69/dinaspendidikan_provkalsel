<?php
require "koneksi.php";
$no = $_GET['id'];

$sql = mysqli_query($konek,"SELECT*FROM pen_dj WHERE nosurat='$no'");
foreach($sql as $pe){
?>
<div class="modal-dialog modal-dialog-scrollable modal-lg">
  <div class="modal-content">
    <form method="post" action="pensiun_upd.php" enctype="multipart/form-data">
    <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      <h3 class="modal-title">Update Data Pensiun</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">No. Surat</label>
                  <div class="col-sm-10"><input type="text" name="no" class="form-control primary" readonly="" value="<?php echo $pe['nosurat']; ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tgl Surat</label>
                  <div class="col-sm-10"><input type="date" name="tg_srt" class="form-control primary" required="" value="<?php echo $pe['tgl_surat']; ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama Pemohon</label>
                    <div class="col-sm-10"><input type="text" name="pmh" class="form-control primary" required="" value="<?php echo $pe['nm_pmh']; ?>"></div>
                </div>
                
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tempat Lahir</label>
                    <div class="col-sm-10"><input type="text" name="tmp" class="form-control primary" required="" value="<?php echo $pe['tlh']; ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tanggal Lahir</label>
                    <div class="col-sm-10"><input type="date" name="tgl" class="form-control primary" required="" value="<?php echo $pe['ttl']; ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Status</label>
                    <div class="col-sm-10">
                      <label><input type="radio" name="stts" value="Duda"<?php if($pe['stts']=='Duda'){echo 'checked';} ?>> Duda </label>&nbsp;&nbsp;&nbsp;
                      <label><input type="radio" name="stts" value="Janda"<?php if($pe['stts']=='Janda'){echo 'checked';} ?>> Janda </label>
                    </div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Hubungan</label>
                  <div class="col-sm-10">
                    <label><input type="radio" name="hub" value="Suami" required=""<?php if($pe['hub']=='Suami'){echo 'checked';} ?>> Suami </label>&nbsp;&nbsp;&nbsp;
                    <label><input type="radio" name="hub" value="Isteri" required=""<?php if($pe['hub']=='Isteri'){echo 'checked';} ?>> Isteri </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="row">
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Nama PNS</label>
                <div class="col-sm-10">
                  <select name="nip" id="nip"  onchange="pegawai(this.value)" class="form-control primary pens" style="width: 100%" required="">
                      <option selected="" disabled="">-PILIH-</option>
                      <?php
                      $result = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt ORDER BY a.nama");   
                      $jsArray = "var pgh = new Array();\n";       
                      while ($row = mysqli_fetch_array($result)) {
                      ?>   
                      <option value="<?php echo $row['nip'] ?>"<?php if($row['nip']==$pe['nip']){echo 'selected';} ?>><?php echo $row['nama'] ?></option>
                          <?php  
                          $jsArray .= "pgh['" . $row['nip'] . "'] = {
                            nip:'".addslashes($row['nip'])."',
                            nama:'".addslashes($row['nama'])."',
                            pnkt:'".addslashes($row['nm_pnkt'])."',
                            gol:'".addslashes($row['ket'])."',
                            jbtn:'".addslashes($row['jbtn'])."'
                          };\n";   
                      }     
                      ?>    
                    </select>
                </div>
              </div>
              <?php
              $nip = $pe['nip'];
              $sql = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt WHERE nip='$nip'");
              foreach($sql as $pg){
              ?>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Gol.</label>
                <div class="col-sm-10"><input type="text" name="pkt" id="pkt" class="form-control primary" required="" readonly="" value="<?php echo $pg['nm_pnkt'].'/ '.$pg['ket']; ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Jabatan</label>
                  <div class="col-sm-10"><input type="text" name="jbt" id="jbtn" class="form-control primary" required="" readonly="" value="<?php echo $pg['jbtn']; ?>"></div>
              </div>
              <?php } ?>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tanggal Wafat</label>
                <div class="col-sm-10"><input type="date" name="tgw" class="form-control primary" required="" value="<?php echo $pe['tgl_wft']; ?>" ></div>
              </div>
             <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Usulan</label>
                <div class="col-sm-10">
                  <select name="pku" id="pku" onchange="pangkat(this.value)" class="form-control primary pens" style="width: 100%">
                    <option selected="" disabled="">-PILIH-</option>
                    <?php
                        $qry = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
                        $Array = "var pnk = new Array();\n"; 
                        foreach($qry as $hs){
                        ?>
                        <option value="<?php echo $hs['id_pnkt'] ?>"<?php if($hs['id_pnkt']==$pe['idpn']){echo 'selected';} ?>><?php echo $hs['nm_pnkt'].'/'.$hs['ket'] ?></option>
                        <?php 
                        $Array .= "pnk['" . $hs['id_pnkt'] . "'] = {
                            id:'".addslashes($hs['id_pnkt'])."',
                            npk:'".addslashes($hs['nm_pnkt'])."',
                            gpn:'".addslashes($hs['ket'])."'
                          };\n"; 
                      } ?>
                  </select>
                </div>
              </div>
              <input type="hidden" name="nm_pnkt" id="nmp" class="form-control primary" required="" value="<?php echo $pe['pkt_usul']; ?>">
              <input type="hidden" name="gpn" id="gol" class="form-control primary" required="" value="<?php echo $pe['gol_usul']; ?>">
                </div>
              </div>
            </div>

          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger btn-round" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
      <button type="submit" class="btn btn-primary btn-round"><i class="fa fa-floppy-o"></i> Simpan</button>
    </div>
  </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php } ?>
<script>
  $(".pens").select2({
     dropdownParent: $("#pensiun-edit")
  });
</script>
<script type="text/javascript">   
<?php echo $jsArray; ?> 
function pegawai(nip){ 
//document.getElementById('pkg').value = pgh[nip].nip; 
document.getElementById('pkt').value = pgh[nip].pnkt+'/ '+pgh[nip].gol;
document.getElementById('jbtn').value = pgh[nip].jbtn;
}; 
</script>
<script type="text/javascript">   
<?php echo $Array; ?> 
function pangkat(id_pnkt){ 
 
document.getElementById('nmp').value = pnk[id_pnkt].npk;
document.getElementById('gol').value = pnk[id_pnkt].gpn;
}; 
</script>
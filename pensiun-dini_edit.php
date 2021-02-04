<?php
require "koneksi.php";
$no = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM pen_dn WHERE no_sur='$no'");
foreach($sql as $pn){
?>
<div class="modal-dialog modal-dialog-scrollable modal-lg">
  <div class="modal-content">
    <form method="post" action="pensiun-dini_upd.php" enctype="multipart/form-data">
    <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      <h3 class="modal-title">Update Data Pensiun Dini</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">No. Surat</label>
                    <div class="col-sm-10"><input type="text" name="no" class="form-control primary" readonly="" value="<?php echo $pn['no_sur'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tgl Surat</label>
                    <div class="col-sm-10"><input type="date" name="tgsrt" class="form-control primary" required="" value="<?php echo $pn['tgs'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">No.Surat Rekomend.</label>
                    <div class="col-sm-10"><input type="text" name="rek" class="form-control primary" required="" value="<?php echo $pn['no_recom'] ?>"></div>
                </div>
                
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">No.Surat Pengantar</label>
                    <div class="col-sm-10"><input type="text" name="peng" class="form-control primary" required="" value="<?php echo $pn['no_spn'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">TMT</label>
                    <div class="col-sm-10"><input type="date" name="tgl" class="form-control primary" required="" value="<?php echo $pn['thmt'] ?>"></div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="row">
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Nama PNS</label>
                <div class="col-sm-10">
                  <select name="nip" id="nip"  onchange="pegawai(this.value)" class="form-control primary din" style="width: 100%" required="">
                      <option selected="" disabled="">-PILIH-</option>
                      <?php
                      $result = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt ORDER BY a.nama");   
                      $jsArray = "var pgh = new Array();\n";       
                      while ($row = mysqli_fetch_array($result)) {
                        $us = new DateTime($row['tgl_diangkat']);
                        $td = new DateTime();
                        $tda =  $td->diff($us);
                      ?>   
                      <option value="<?php echo $row['nip'] ?>"<?php if($row['nip']==$pn['nip']){echo 'selected';} ?>><?php echo $row['nama'].' (Masa Kerja '.$tda->y.' Tahun)' ?></option>
                          <?php 

                          $jsArray .= "pgh['" . $row['nip'] . "'] = {
                            nip:'".addslashes($row['nip'])."',
                            nama:'".addslashes($row['nama'])."',
                            pnkt:'".addslashes($row['nm_pnkt'])."',
                            gol:'".addslashes($row['ket'])."',
                            jbtn:'".addslashes($row['jbtn'])."',
                            tgd:'".addslashes($row['tgl_diangkat'])."',
                            alm:'".addslashes($row['alamat'])."'
                          };\n";

                      }     
                      ?>    
                    </select>
                </div>
              </div>
              <?php
              $nip = $pn['nip'];
              $sql = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt WHERE nip='$nip'");
              foreach($sql as $pg){
              ?>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Gol.</label>
                <div class="col-sm-10"><input type="text" name="pkt" id="pk" class="form-control primary" required="" readonly="" value="<?php echo $pg['nm_pnkt'].' /'.$pg['ket'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Jabatan</label>
                <div class="col-sm-10"><input type="text" name="jbt" id="jb" class="form-control primary" required="" readonly="" value="<?php echo $pg['jbtn'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tgl Diangkat</label>
                <div class="col-sm-10"><input type="text" id="ms" name="msk" class="form-control primary" required="" readonly="" value="<?php echo $pg['tgl_diangkat'] ?>"></div>
              </div>
            <?php } ?>
            <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Alamat Pensiun</label>
                <div class="col-sm-10"><textarea name="almt" id="al" class="form-control primary"><?php echo $pn['alm_pen'] ?></textarea></div>
              </div>
             <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Usulan</label>
                <div class="col-sm-10">
                  <select name="pku" id="pku" onchange="pangkat(this.value)" class="form-control primary din" style="width: 100%">
                    <option selected="" disabled="">-PILIH-</option>
                    <?php
                        $qry = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
                        $Array = "var pnk = new Array();\n"; 
                        foreach($qry as $hs){
                        ?>
                        <option value="<?php echo $hs['id_pnkt'] ?>"<?php if($hs['id_pnkt']==$pn['idpnkt']){echo 'selected';} ?>><?php echo $hs['nm_pnkt'].'/'.$hs['ket'] ?></option>
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
              <input type="hidden" name="nm_pnkt" id="nmp" class="form-control primary" required="" value="<?php echo $pn['nmpnkt'] ?>">
              <input type="hidden" name="gpn" id="gp" class="form-control primary" required="" value="<?php echo $pn['golpk'] ?>">

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
<?php } ?>
<script>
  $(".din").select2({
     dropdownParent: $("#dini-edit")
  });
</script>
<script type="text/javascript">   
<?php echo $jsArray; ?> 
function pegawai(nip){ 
//document.getElementById('pkg').value = pgh[nip].nip; 
document.getElementById('pk').value = pgh[nip].pnkt+'/ '+pgh[nip].gol;
document.getElementById('jb').value = pgh[nip].jbtn;
document.getElementById('ms').value = pgh[nip].tgd;
document.getElementById('al').value = pgh[nip].alm;

}; 
</script>
<script type="text/javascript">   
<?php echo $Array; ?> 
function pangkat(id_pnkt){ 
 
document.getElementById('nmp').value = pnk[id_pnkt].npk;
document.getElementById('gp').value = pnk[id_pnkt].gpn;
}; 
</script>
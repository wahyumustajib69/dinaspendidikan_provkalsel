<?php
require "koneksi.php";
$id = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM pen_bup WHERE nosrt='$id'");
foreach($sql as $pb){
?>
<div class="modal-dialog modal-dialog-scrollable modal-lg">
  <div class="modal-content">
    <form method="post" action="pensiun-bup_upd.php" enctype="multipart/form-data">
    <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      <h3 class="modal-title">Tambah Data Pensiun BUP</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">No. Surat</label>
                    <div class="col-sm-10"><input type="text" name="no" class="form-control primary" readonly="" value="<?php echo $pb['nosrt']; ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tgl Surat</label>
                    <div class="col-sm-10"><input type="date" name="tg_srt" class="form-control primary" required="" value="<?php echo $pb['tglsurat']; ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">TMT</label>
                    <div class="col-sm-10"><input type="date" name="tmt" class="form-control primary" required="" value="<?php echo $pb['tmt']; ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tanggal BUP</label>
                    <div class="col-sm-10"><input type="date" name="bup" class="form-control primary" required="" value="<?php echo $pb['bup']; ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Baru</label>
                <div class="col-sm-10">
                  <select name="pku" id="pku" onchange="pangkat(this.value)" class="form-control primary pen" style="width: 100%" required="">
                    <option selected="" disabled="">-PILIH-</option>
                    <?php
                        $qry = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
                        $Array = "var pnk = new Array();\n"; 
                        foreach($qry as $hs){
                        ?>
                        <option value="<?php echo $hs['id_pnkt'] ?>"<?php if($pb['id_pk']==$hs['id_pnkt']){echo 'selected';} ?>><?php echo $hs['nm_pnkt'].'/'.$hs['ket'] ?></option>
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
              <input type="hidden" name="nm_pnkt" id="nmp" class="form-control primary" required="" value="<?php echo $pb['pnkt_baru']; ?>">
              <input type="hidden" name="gpn" id="gpg" class="form-control primary" required="" value="<?php echo $pb['gol_pen']; ?>">
              </div>
            </div>

            <div class="col-md-6">
              <div class="row">
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Nama PNS</label>
                <div class="col-sm-10">
                  <select name="nip" id="nip"  onchange="pegawai(this.value)" class="form-control primary pen" style="width: 100%" required="">
                      <option selected="" disabled="">-PILIH-</option>
                      <?php
                      $result = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt ORDER BY a.nama");   
                      $jsArray = "var pgh = new Array();\n";       
                      while ($row = mysqli_fetch_array($result)) {
                        $us = new DateTime($row['tgl_lahir']);
                        $td = new DateTime();
                        $usia =  $td->diff($us);
                      ?>   
                      <option value="<?php echo $row['nip'] ?>"<?php if($pb['nip']==$row['nip']){echo 'selected';} ?>><?php echo $row['nama'].' Usia '.$usia->y; ?></option>
                          <?php  
                          $jsArray .= "pgh['" . $row['nip'] . "'] = {
                            nip:'".addslashes($row['nip'])."',
                            nama:'".addslashes($row['nama'])."',
                            pnkt:'".addslashes($row['nm_pnkt'])."',
                            gol:'".addslashes($row['ket'])."',
                            tlp:'".addslashes($row['hp'])."',
                            jbtn:'".addslashes($row['jbtn'])."'
                          };\n";   
                      }     
                      ?>    
                    </select>
                </div>
              </div>
              <?php
              $nip = $pb['nip'];
              $sql = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt WHERE nip='$nip'");
              foreach($sql as $pw){
              ?>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">NIP</label>
                <div class="col-sm-10"><input type="text" name="nama" id="nam" class="form-control primary" required="" readonly="" value="<?php echo $pw['nip'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Gol.</label>
                <div class="col-sm-10"><input type="text" name="pkt" id="pk" class="form-control primary" required="" readonly="" value="<?php echo $pw['nm_pnkt'].' /'.$pw['ket'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Jabatan</label>
                  <div class="col-sm-10"><input type="text" name="jbt" id="jb" class="form-control primary" required="" readonly="" value="<?php echo $pw['jbtn'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Telepon</label>
                <div class="col-sm-10"><input type="text" name="tlp" id="tl" class="form-control primary" required="" readonly="" value="<?php echo $pw['hp'] ?>"></div>
              </div>
             <?php } ?>
                </div>
              </div>
            </div>

          </div>
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
    </div>
  </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php } ?>

<script type="text/javascript">   
<?php echo $jsArray; ?> 
function pegawai(nip){ 
document.getElementById('nam').value = pgh[nip].nip; 
document.getElementById('pk').value = pgh[nip].pnkt+'/ '+pgh[nip].gol;
document.getElementById('jb').value = pgh[nip].jbtn;
document.getElementById('tl').value = pgh[nip].tlp;
}; 
</script>
<script type="text/javascript">   
<?php echo $Array; ?> 
function pangkat(id_pnkt){ 
 
document.getElementById('nmp').value = pnk[id_pnkt].npk;
document.getElementById('gpg').value = pnk[id_pnkt].gpn;
}; 
</script>
<script>
  $(".pen").select2({
     dropdownParent: $("#pensiunbup-edit")
  });
</script>
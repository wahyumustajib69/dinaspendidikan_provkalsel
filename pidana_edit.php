<?php
require "koneksi.php";
$no = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM pidana WHERE no='$no'");
foreach($sql as $pd){
?>
<div class="modal-dialog">
  <div class="modal-content">
    <form method="post" action="pidana_upd.php">
    <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      <h3 class="modal-title">Update Surat Pernyataan</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">No. Surat</label>
            <div class="col-sm-10"><input type="text" name="no" class="form-control primary" required="" value="<?php echo $pd['no'] ?>" readonly></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tanggal</label>
            <div class="col-sm-10"><input type="date" name="tgl" class="form-control primary" required="" value="<?php echo $pd['tanggal'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">NIP</label>
            <div class="col-sm-10"><input type="text" name="nidn" class="form-control primary" readonly="" value="<?php echo $pd['nip_kadin'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama</label>
            <div class="col-sm-10"><input type="text" name="nama" class="form-control primary" readonly="" value="<?php echo $pd['kadin'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Pangkat</label>
            <div class="col-sm-10"><input type="text" name="pkt" class="form-control primary" readonly="" value="<?php echo $pd['pnk_kdin'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Golongan</label>
            <div class="col-sm-10"><input type="text" name="gol" class="form-control primary" readonly="" value="<?php echo $pd['gol_kadin'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Jabatan</label>
            <div class="col-sm-10"><textarea name="jbt" class="form-control primary" required="" readonly=""><?php echo $pd['jbtn_kadin'] ?></textarea></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama Pegawai</label>
          <div class="col-sm-10">
            <select name="pgw" class="form-control primary pid" style="width: 100%" required="">
              <option disabled="" selected="">-PILIH-</option>
              <?php
              $sql = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt ORDER BY a.nama");
              foreach($sql as $hs){
              ?>
              <option value="<?php echo $hs['nip'] ?>"<?php if($hs['nip']==$pd['nip']){echo 'selected';} ?>><?php echo $hs['nama'].'/ '.$hs['nm_pnkt'].' /('.$hs['ket'].')' ?></option>
              <?php } ?>
            </select>    
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
  $(".pid").select2({
     dropdownParent: $("#pidana-edit")
  });
</script>
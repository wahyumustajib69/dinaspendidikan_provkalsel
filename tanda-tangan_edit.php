<?php
require "koneksi.php";
$ni = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM pimpinan WHERE ni='$ni'");
foreach($sql as $pm){
?>
<div class="modal-dialog">
  <div class="modal-content">
    <form method="post" action="tanda-tangan_upd.php">
    <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      <h3 class="modal-title">Update Tanda Tangan</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">NIP</label>
            <div class="col-sm-10"><input type="text" name="nip" class="form-control primary" required="" readonly="" value="<?php echo $pm['ni'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama</label>
            <div class="col-sm-10"><input type="text" name="nma" class="form-control primary" required="" value="<?php echo $pm['nma'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Pangkat/Gol.</label>
          <div class="col-sm-10">
            <select name="pnkt" class="form-control primary din"style="width: 100%" required="">
              <option selected="" disabled="">-PILIH-</option>
              <?php
              $sql = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
              foreach($sql as $hs){
              ?>
              <option value="<?php echo $hs['id_pnkt'] ?>"<?php if($hs['id_pnkt']==$pm['png']){echo 'selected';} ?>><?php echo $hs['nm_pnkt'].'/'.$hs['ket'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Jabatan</label>
          <div class="col-sm-10"><textarea name="jbtn" class="form-control primary" required=""><?php echo $pm['jbt'] ?></textarea></div>
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
  $(".din").select2({
     dropdownParent: $("#ttd-edit")
  });
</script>

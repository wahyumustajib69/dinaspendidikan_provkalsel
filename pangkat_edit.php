<?php
require_once "koneksi.php";
$id = $_GET['id'];

$sql = mysqli_query($konek,"SELECT*FROM pangkat WHERE id_pnkt='$id'");
foreach($sql as $pk){
?>
<div class="modal-dialog">
  <div class="modal-content">
    <form method="post" action="pangkat_upd.php">
    <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      <h3 class="modal-title">Update Pangkat</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <input type="hidden" name="id" value="<?php echo $pk['id_pnkt']; ?>">
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama Pangkat</label>
            <div class="col-sm-10"><input type="text" name="nmp" class="form-control primary" value="<?php echo $pk['nm_pnkt']; ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Keterangan</label>
            <div class="col-sm-10"><textarea name="ket" class="form-control primary"><?php echo $pk['ket']; ?></textarea></div>
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
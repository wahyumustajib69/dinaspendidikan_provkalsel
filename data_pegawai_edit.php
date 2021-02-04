<?php
require "koneksi.php";
$nip = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM pegawai WHERE nip='$nip'");
foreach($sql as $pg){
?>
<div class="modal-dialog modal-dialog-scrollable modal-lg">
  <div class="modal-content">
    <form method="post" action="data_pegawai_upd.php" enctype="multipart/form-data">
    <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      <h3 class="modal-title">Update Pegawai</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">NIP</label>
                    <div class="col-sm-10"><input type="text" name="nip" class="form-control primary" onkeypress="return hanyaAngka(event)" required="" value="<?php echo $pg['nip'] ?>" readonly></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama</label>
                    <div class="col-sm-10"><input type="text" name="nama" class="form-control primary" required="" value="<?php echo $pg['nama'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Jabatan</label>
                    <div class="col-sm-10"><input type="text" name="jbtn" class="form-control primary" required="" value="<?php echo $pg['jbtn'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat/Gol.</label>
                    <div class="col-sm-10">
                      <select name="pnkt" class="form-control primary png" style="width: 100%" required="">
                        <option selected="" disabled="">-PILIH-</option>
                        <?php
                        $sql = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
                        foreach($sql as $hs){
                        ?>
                        <option value="<?php echo $hs['id_pnkt'] ?>"<?php if($hs['id_pnkt']==$pg['pangkat']){echo 'selected';} ?>><?php echo $hs['nm_pnkt'].'/'.$hs['ket'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tempat Lahir</label>
                    <div class="col-sm-10"><input type="text" name="tmp" class="form-control primary" required="" value="<?php echo $pg['tmp_lahir'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tanggal Lahir</label>
                    <div class="col-sm-10"><input type="date" name="tgl" class="form-control primary" required="" value="<?php echo $pg['tgl_lahir'] ?>"></div>
                </div>
                <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tgl Diangkat</label>
                  <div class="col-sm-10"><input type="date" name="tgl_dia" class="form-control primary" required="" value="<?php echo $pg['tgl_diangkat'] ?>">
<img src="foto_pgw/<?php echo $pg['foto'] ?>" class="img-responsive thumbnail" style="width: 120px; margin-top: 10px;">
                    </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="row">
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pangkat Awal</label>
                <div class="col-sm-10"><select name="ppk" class="form-control primary png" style="width: 100%" required="">
                  <option selected="" disabled="">-PILIH-</option>
                  <?php
                  $sql = mysqli_query($konek,"SELECT*FROM pangkat ORDER BY nm_pnkt");
                  foreach($sql as $hs){
                  ?>
                  <option value="<?php echo $hs['id_pnkt'] ?>"<?php if($hs['id_pnkt']==$pg['pnkg_png']){echo 'selected';} ?>><?php echo $hs['nm_pnkt'].'/'.$hs['ket'] ?></option>
                  <?php } ?>
                </select></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tanggal</label>
                <div class="col-sm-10"><input type="date" name="tgp" class="form-control primary" required="" value="<?php echo $pg['tgl_png'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Alamat</label>
                  <div class="col-sm-10"><textarea name="alm" class="form-control primary" required=""><?php echo $pg['alamat'] ?></textarea></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">HP/Telp.</label>
                <div class="col-sm-10"><input type="text" name="telp" class="form-control primary" onkeypress="return hanyaAngka(event)" required="" value="<?php echo $pg['hp'] ?>"></div>
                </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Tempat Kerja</label>
                  <div class="col-sm-10"><input type="text" name="tmk" class="form-control primary" required="" value="<?php echo $pg['tmp_kerja'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Unit Kerja</label>
                  <div class="col-sm-10"><input type="text" name="kerja" class="form-control primary" required="" value="<?php echo $pg['unit_kerja'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Pendidikan Terakhir</label>
                <div class="col-sm-10"><input type="text" name="pend" class="form-control primary" required="" value="<?php echo $pg['pend'] ?>"></div>
              </div>
              <div class="form-group col-md-12"><label class="col-sm-2 control-label text-left">Foto</label>
                    <div class="col-sm-10"><input type="file" name="foto" class="form-control primary"><small class="text-danger">*Biarkan KOSONG jika foto pegawai tidak diganti</small>
                    </div>
                    <input type="hidden" name="ft_br" value="<?php echo $pg['foto'] ?>">
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer" style="margin-top: -40px;">
      <button type="button" class="btn btn-danger btn-3d" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
      <button type="submit" class="btn btn-primary btn-3d"><i class="fa fa-floppy-o"></i> Simpan</button>
    </div>
  </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<?php } ?>
<script>
  $(".png").select2({
     dropdownParent: $("#pegawai-edit")
  });
</script>
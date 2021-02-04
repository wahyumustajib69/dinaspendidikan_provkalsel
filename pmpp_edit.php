<?php
require "koneksi.php";
$no = $_GET['id'];
$sql = mysqli_query($konek,"SELECT*FROM pmpp WHERE no_surat='$no'");
foreach($sql as $pp){
?>
<div class="modal-dialog">
  <div class="modal-content">
    <form method="post" action="pmpp_upd.php">
    <div class="modal-header bg-primary" style="border-top-left-radius: 5px;border-top-right-radius: 5px;">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times-circle"></i></span></button>
      <h3 class="modal-title">Update PMPP</h3>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">No. Surat</label>
            <div class="col-sm-10"><input type="text" name="no_srt" class="form-control primary" value="<?php echo $pp['no_surat']; ?>" readonly></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tgl. Surat</label>
            <div class="col-sm-10"><input type="date" name="tgl" class="form-control primary" required="" value="<?php echo $pp['tgl_surat']; ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Tgl. Pensiun</label>
            <div class="col-sm-10"><input type="date" name="tgl_pens" class="form-control primary" required="" value="<?php echo $pp['tgl_pensiun']; ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Nama Pegawai</label>
          <div class="col-sm-10">
            <select name="nip" id="nipp"  onchange="ganti(this.value)" class="form-control primary pmpp2" style="width: 100%" required="">
              <option selected="" disabled="">-PILIH-</option>
              <?php
              $result = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt");   
              $jsArray = "var peg = new Array();\n";       
              while ($row = mysqli_fetch_array($result)) {  ?> 
                   <option value="<?php echo $row['nip'] ?>"<?php if($row['nip']==$pp['nip']){echo 'selected';} ?>><?php echo $row['nama'] ?></option>
              <?php  
                  $jsArray .= "peg['" . $row['nip'] . "'] = {
                    ni:'".addslashes($row['nip'])."',
                    nm:'".addslashes($row['nama'])."',
                    jbt:'".addslashes($row['jbtn'])."',
                    pnk:'".addslashes($row['nm_pnkt'])."',
                    go:'".addslashes($row['ket'])."',
                    tm:'".addslashes($row['tmp_lahir'])."',
                    tg:'".addslashes($row['tgl_lahir'])."',
                    alm:'".addslashes($row['alamat'])."'
                  };\n";   
              }     
              ?>    
            </select>
          </div>
        </div>
        <?php
        $nip = $pp['nip'];
        $qry = mysqli_query($konek,"SELECT*FROM pegawai AS a JOIN pangkat AS b ON a.pangkat=b.id_pnkt WHERE a.nip='$nip'");
        foreach($qry as $pg){
        ?>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">NIP</label>
            <div class="col-sm-10"><input type="text" id="np" name="nmp" class="form-control primary" readonly="" value="<?php echo $pg['nip'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Jabatan</label>
            <div class="col-sm-10"><input type="text" id="jbt" name="jbtn" class="form-control primary" readonly="" value="<?php echo $pg['jbtn'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Pnkt/Gol</label>
            <div class="col-sm-10"><input type="text" id="pk" name="pkt" class="form-control primary" readonly="" value="<?php echo $pg['nm_pnkt'].' /'.$pg['ket'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">TTL</label>
            <div class="col-sm-10"><input type="text" id="tl" name="ttl" class="form-control primary" readonly="" value="<?php echo $pg['tmp_lahir'].' /'.$pg['tgl_lahir'] ?>"></div>
        </div>
        <div class="form-group col-md-12"><label class="col-sm-2 control-label text-right">Alamat Sekarang</label>
            <div class="col-sm-10"><textarea name="almt" class="form-control primary" id="alm_sek" readonly=""><?php echo $pg['alamat'] ?></textarea></div>
        </div>
        
        <div class="form-group col-md-12" style="margin-top: -15px;"><label class="col-sm-2 control-label text-right"></label>
            <div class="col-sm-10"><label class="text-primary"><input type="checkbox" name="check" id="centang" value="SAMA"> Sama dengan alamat sekarang</label></div>
        </div>
        <div class="form-group col-md-12" id="almpen" style="margin-top: -15px;"><label class="col-sm-2 control-label text-right">Alamat Pensiun</label>
            <div class="col-sm-10"><textarea name="alm_pen" class="form-control primary"><?php echo $pp['alm_pensiun'] ?></textarea></div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="modal-footer" style="margin-top: -20px;">
      <button type="button" class="btn btn-danger btn-raised" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
      <button type="submit" class="btn btn-primary btn-raised"><i class="fa fa-floppy-o"></i> Simpan</button>
    </div>
  </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<?php } ?>
<script type="text/javascript">   
    <?php echo $jsArray; ?> 
    function ganti(nip){ 
    document.getElementById('np').value = peg[nip].ni; 
    document.getElementById('jbt').value = peg[nip].jbt;
    document.getElementById('pk').value = peg[nip].pnk+' /'+peg[nip].go; 
    document.getElementById('tl').value = peg[nip].tm+', '+peg[nip].tg;
    document.getElementById('alm_sek').value = peg[nip].alm;
    }; 
</script> 
<script type='text/javascript'>
  $(document).ready(function(){
    $("#almpen").css("display","block");
   
    $('#centang').change(function(){
      if(this.checked) {
        $('#almpen').fadeOut('slow');
      } 
      else {
        $('#almpen').fadeIn('slow');
      }  
    });
  });
</script>
<script>
  $(".pmpp2").select2({
     dropdownParent: $("#pmpp-edit")
  });
</script>


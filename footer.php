      <!-- start: Javascript -->
      <script src="asset/js/jquery.min.js"></script>
      <script src="asset/js/jquery.ui.min.js"></script>
      <script src="asset/js/bootstrap.min.js"></script>
      <script type='text/javascript'>
        $(document).ready(function(){
          $("#alamat").css("display","block");
         
          $('#check').change(function(){
            if (this.checked) {
              $('#alamat').fadeOut('slow');
            } 
            else {
              $('#alamat').fadeIn('slow');
            }  
          });
        });
      </script>

      <script type='text/javascript'>
        $(document).ready(function(){
          $("#kerja").css("display","block");
         
          $('#cek').change(function(){
            if (this.checked) {
              $('#kerja').fadeOut('slow');
            } 
            else {
              $('#kerja').fadeIn('slow');
            }  
          });
        });
      </script>
      
      <!--pangkat update-->
      <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "pangkat_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#pangkat-edit").html(ajaxData);
                        $("#pangkat-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
      </script>
      <!--pegawai update-->
      <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "data_pegawai_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#pegawai-edit").html(ajaxData);
                        $("#pegawai-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
      </script>
      <!--pmpp update-->
      <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "pmpp_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#pmpp-edit").html(ajaxData);
                        $("#pmpp-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
      </script>
      <!--promosi update-->
      <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "promosi_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#promosi-edit").html(ajaxData);
                        $("#promosi-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
      </script>
      <!--pensiun DJ update-->
      <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "pensiun_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#pensiun-edit").html(ajaxData);
                        $("#pensiun-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
      </script>
      <!--pensiun BUP update-->
      <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "pensiun-bup_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#pensiunbup-edit").html(ajaxData);
                        $("#pensiunbup-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
      </script>
      <!--pensiun dini update-->
      <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "pensiun-dini_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#dini-edit").html(ajaxData);
                        $("#dini-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
      </script>
      <!--tanda tangan update-->
      <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "tanda-tangan_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#ttd-edit").html(ajaxData);
                        $("#ttd-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
      </script>
      <!--tanda tangan update-->
      <script>
        $(document).ready(function () {
        $(".modal_edit").click(function(e) {
            var m = $(this).attr("id");
                $.ajax({
                    url: "pidana_edit.php",
                    type: "GET",
                    data : {id: m,},
                    success: function (ajaxData){
                        $("#pidana-edit").html(ajaxData);
                        $("#pidana-edit").modal('show',{backdrop: 'true'});
                    }
                });
            });
        });
      </script>
      <script>
        function confirm_delete(delete_url){
            $("#modal-delete").modal('show', {backdrop: 'static'});
            document.getElementById('delete-link').setAttribute('href', delete_url);
        }
      </script>

      <!-- plugins -->
      <script src="asset/js/plugins/moment.min.js"></script>
      <script src="asset/js/plugins/jquery.datatables.min.js"></script>
      <script src="asset/js/plugins/datatables.bootstrap.min.js"></script>
      <script src="asset/js/plugins/jquery.nicescroll.js"></script>
      <script src="asset/js/plugins/select2.full.min.js"></script>
      <script>
        $(".png").select2({
           dropdownParent: $("#modal-tanda")
        });
      </script>
      <script>
        $(".pangkat").select2({
           dropdownParent: $("#modal-pegawai")
        });
      </script>
      <script>
        $(".pmpp").select2({
           dropdownParent: $("#modal-pmpp")
        });
      </script>
      <script>
        $(".pro").select2({
           dropdownParent: $("#modal-promosi")
        });
      </script>
      <script>
        $(".pang").select2({
           dropdownParent: $("#modal-promosi")
        });
      </script>
      <script>
        $(".pens").select2({
           dropdownParent: $("#modal-pensiun")
        });
      </script>
      <script>
        $(".pen").select2({
           dropdownParent: $("#modal-bup")
        });
      </script>
      <script>
        $(".dini").select2({
           dropdownParent: $("#modal-dini")
        });
      </script>
      <script>
        $(".pidana").select2({
           dropdownParent: $("#modal-pidana")
        });
      </script>
      <!-- custom -->
      <script src="asset/js/main.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
          $('#datatables-example').DataTable();
        });
      </script>
      <script>
        $(document).ready(function(){
          setTimeout(function(){
            $("#pesan").fadeIn('slow');
            }, 500);
          });
          setTimeout(function(){
            $("#pesan").fadeOut('slow');
          }, 3000);
      </script>
<!-- end: Javascript -->
</body>
</html>
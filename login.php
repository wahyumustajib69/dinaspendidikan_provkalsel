<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <link rel="shortcut icon" type="icon" href="asset/img/kalsel.png">
  <!-- end: Css -->
    </head>

    <body id="mimin" class="dashboard ">

      <div class="container">

        <form class="form-signin" method="post" action="login_act.php">
          <div class="panel periodic-login">
            <?php
              if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
            ?>
            <div id="pesan" class="alert alert-warning col-md-12 alert-dismissible fade in" role="alert" style="display:none; margin-top: 10px;">
            <div class="col-md-12">
              <p><?php echo $_SESSION['pesan']?></p>
            </div>
          </div>
          <?php }
            $_SESSION['pesan'] = '';
          ?>
              <div class="panel-body text-center">
                <img src="asset/img/kalsel.png">
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" name="user" required>
                    <span class="bar"></span>
                    <label>Username</label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" name="pass" required>
                    <span class="bar"></span>
                    <label>Password</label>
                  </div>
                  <button type="submit" class="btn btn-danger btn-gradient col-md-12"><i class="fa fa-sign-in"></i> LOGIN</button>
              </div>
          </div>
        </form>

      </div>

      <!-- end: Content -->
      <!-- start: Javascript -->
      <script src="asset/js/jquery.min.js"></script>
      <script src="asset/js/jquery.ui.min.js"></script>
      <script src="asset/js/bootstrap.min.js"></script>

      <script src="asset/js/plugins/moment.min.js"></script>
      <script src="asset/js/plugins/icheck.min.js"></script>

      <!-- custom -->
      <script src="asset/js/main.js"></script>
      <script type="text/javascript">
       $(document).ready(function(){
         $('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
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
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>iSJT | Log in</title>
    <link rel="shorcut icon" href="<?php echo base_url()."assets/images/Logo-02.png"; ?>">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/bower_components/bootstrap/dist/css/bootstrap.min.css"; ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/bower_components/font-awesome/css/font-awesome.min.css"; ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/bower_components/Ionicons/css/ionicons.min.css"; ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()."assets/dist/css/AdminLTE.min.css"; ?>">
  </head>

  <body class="hold-transition login-page" style="background-image: url(../../../assets/images/sm52_login.jpg); width: 100%; height: auto;">
    <div class="login-box">
      <div class="login-logo">
        <img src="<?php echo base_url()."assets/images/Logo-01.png"; ?>" style="width: 40%; height: auto;">
      </div>

      <div class="login-box-body">
        <p class="login-box-msg">Please your Login !</p>

        <?php 
          if(isset($_POST['masuk_isset'])){
            $u = $this->input->post("username");
            $p = $this->input->post("password");  

            $this->m_login->getLogin($u, $p);
          }
        ?>

        <form method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" name="masuk_isset" class="btn btn-primary btn-block form-control">SIGN IN</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- jQuery 3 -->
    <script src="<?php echo base_url()."assets/bower_components/jquery/dist/jquery.min.js"; ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url()."assets/bower_components/bootstrap/dist/js/bootstrap.min.js"; ?>"></script>
  </body>
</html>

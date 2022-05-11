<!DOCTYPE html>
<html lang="en">
<head>
  <title>Clinical Pathway || RS PHC Surabaya </title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" href="<?php echo base_url();?>assets/dist/images/icon_phc.ico" type="image/ico" />
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/template/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/template/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/template/login/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/template/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/template/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/template/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/template/login/css/main.css">
<!--===============================================================================================-->

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>

  <style type="text/css">
    
    .container-login100 {
      width: 100%;
      min-height: 100vh;
      display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      padding: 15px;
      background: #17c2dd;
      background-image: url(<?php echo base_url();?>assets/dist/images/bg-3.jpg);
      background: -webkit-linear-gradient(-135deg, #17c2dd, #055561);
      background: -o-linear-gradient(-135deg, #17c2dd, #055561);
      background: -moz-linear-gradient(-135deg, #17c2dd, #055561);
      background: linear-gradient(-135deg, #17c2dd, #055561);
    }

    .focus-input100 {
      display: block;
      position: absolute;
      border-radius: 25px;
      bottom: 0;
      left: 0;
      z-index: -1;
      width: 100%;
      height: 100%;
      box-shadow: 0px 0px 0px 0px;
      color: rgba(20, 161, 184, 0.83);
    }

    .login100-form-btn:hover {
      background: #07606d;
    }

    .login100-form-btn {
      font-family: Montserrat-Bold;
      font-size: 15px;
      line-height: 1.5;
      color: #fff;
      text-transform: uppercase;
      width: 100%;
      height: 50px;
      border-radius: 25px;
      background: #13b1ca;
      display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0 25px;
      -webkit-transition: all 0.4s;
      -o-transition: all 0.4s;
      -moz-transition: all 0.4s;
      transition: all 0.4s;
    }

  </style>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-pic js-tilt" data-tilt>
          <img src="<?php echo base_url();?>assets/template/login/images/img-01.png" alt="IMG">
        </div>

        <form class="login100-form validate-form" action="<?php echo base_url();?>login/actionLogin" method="post">
          <span class="login100-form-titleX" style="font-family: 'Merienda', cursive; font-size: 30px; text-align: center; color: #13b1ca;">
            <center>-Clinical Pathway-</center>
          </span><br>
          <div style="margin:10px" id="msg-eror"><?php echo $this->session->flashdata("pesan");?></div>
          <div class="wrap-input100 validate-input" data-validate = "Username harus di isi">
            <input class="input100" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Password harus di isi">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <i class="fa fa-lock" aria-hidden="true"></i>
            </span>
          </div>
          
          <div class="container-login100-form-btn">
            <button class="login100-form-btn">
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
  
    $(document).ready(function() {

      setTimeout(function(){
          $("#msg-eror").slideToggle("slow");
      },3000);

    })

  </script>

  
<!--===============================================================================================-->  
  <script src="<?php echo base_url();?>assets/template/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>assets/template/login/vendor/bootstrap/js/popper.js"></script>
  <script src="<?php echo base_url();?>assets/template/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>assets/template/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>assets/template/login/vendor/tilt/tilt.jquery.min.js"></script>
  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>
<!--===============================================================================================-->
  <script src="<?php echo base_url();?>assets/template/login/js/main.js"></script>

</body>
</html>
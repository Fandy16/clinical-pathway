<?php
ini_set('memory_limit', '512M');

?>

<style type="text/css">
  
  .navbar-nav>.user-menu>.dropdown-menu>.user-footer {
    background-color: #655193;
    padding: 10px;
  }

  .skin-blue .main-header .navbar .sidebar-toggle:hover {
    background-color: #17a2b8;
  }

  .skin-blue .main-header .logo {
    background-color: #0f7c8d !important;
    color: #fff;
    border-bottom: 0 solid transparent;
  }

  .skin-blue .main-header .navbar {
    background-color: #17a2b8;
  }

  .navbar-nav>.user-menu>.dropdown-menu {
    border-top-right-radius: 0;
    border-top-left-radius: 0;
    padding: 1px 0 0 0;
    border-top-width: 0;
    width: 220px;
  }

  .navbar-nav>.user-menu>.dropdown-menu>.user-footer {
    background-color: #16a2b894;
    padding: 10px;
  }

</style>

<script type="text/javascript">    
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function tampilkanwaktu(){
        //buat object date berdasarkan waktu saat ini
        var waktu = new Date();
        //ambil nilai jam, 
        //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length
        var sh = waktu.getHours() + ""; 
        //ambil nilai menit
        var sm = waktu.getMinutes() + "";
        //ambil nilai detik
        var ss = waktu.getSeconds() + "";
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
    }

    setInterval(function(){
      tampilkanwaktu();
      // $(".berkedip").toggle();
    },900);

</script>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url() ?>home" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- <span class="logo-mini"><b>A</b>LT</span> -->
      <img src="<?php echo base_url() ?>assets/dist/images/phc_putih.png" style ="width: 45px; height: 45px;" class="logo-mini">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="<?php echo base_url() ?>assets/dist/images/phc_putih.png" style ="width: 33px; height: 33px;">
        <span style="font-family: 'Kaushan Script', cursive; font-size: 22px;"><b>Clinical </b> -Pathway</span>
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <li class="dropdown notifications-menu ">
            <a href="">
              <span class="fa fa-calendar" style="color: #fff; font-size: 13px;"></span>&nbsp&nbsp
              <span id="tgl_sekarang" style="color: #fff; font-size: 14px; font-family: 'Roboto Condensed', sans-serif;">
                <?php
                    $hari = date('l');
                    /*$new = date('l, F d, Y', strtotime($Today));*/
                    if ($hari=="Sunday") {
                      echo "Minggu";
                    }elseif ($hari=="Monday") {
                      echo "Senin";
                    }elseif ($hari=="Tuesday") {
                      echo "Selasa";
                    }elseif ($hari=="Wednesday") {
                      echo "Rabu";
                    }elseif ($hari=="Thursday") {
                      echo("Kamis");
                    }elseif ($hari=="Friday") {
                      echo "Jum'at";
                    }elseif ($hari=="Saturday") {
                      echo "Sabtu";
                    }
                  ?>,
                
                  <?php
                    $tgl_sekarang = '';
                    $tgl = date('d');
                    $bln = date('F');
                    $thn = date('Y');

                    if ($bln=="January") {
                      $bln = "Januari";
                    }elseif ($bln=="February") {
                      $bln = "Februari";
                    }elseif ($bln=="March") {
                      $bln = "Maret";
                    }elseif ($bln=="April") {
                      $bln = "April";
                    }elseif ($bln=="May") {
                      $bln =("Mei");
                    }elseif ($bln=="June") {
                      $bln = "Juni";
                    }elseif ($bln=="July") {
                      $bln = "Juli";
                    }elseif ($bln=="August") {
                      $bln = "Agustus";
                    }elseif ($bln=="September") {
                      $bln = "September";
                    }elseif ($bln=="October") {
                      $bln = "Oktober";
                    }elseif ($bln=="November") {
                      $bln =("Nopember");
                    }elseif ($bln=="December") {
                      $bln = "Desember";
                    }

                    $tgl_sekarang = ' ' .$tgl. ' ' .$bln. ' ' .$thn; 
                    echo($tgl_sekarang);
                  ?>
              </span>&nbsp&nbsp&nbsp
              <span class="fa fa-clock-o" style="color: #fff; font-size: 13px;"></span>&nbsp
              <span id="clock" style="color: #fff; font-size: 14px; font-family: 'Roboto Condensed', sans-serif;"></span>
            </a>
          </li>

          <li class="dropdown notifications-menu">
            <a href="">|</a>
          </li>

          <?php
            $level = $this->session->userdata("ses_level");
          ?>

          <?php if ($level == 'admin'): ?>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle fa fa-power-off" data-toggle="dropdown">
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url() ?>login" style="margin-right: 20px; width: 150px;" class="btn btn-default btn-block">
                    Sign out &nbsp; &nbsp;
                    <span class="fa fa-sign-out"></span>
                  </a>
                </div>
              </li>
            </ul>
          </li>

          <?php elseif($level == 'user1'): ?>

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle fa fa-power-off" data-toggle="dropdown">
            </a>
            <ul class="dropdown-menu">
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url() ?>ganti_pass" style="margin-right: 20px; width: 150px;" class="btn btn-default btn-block">
                    Ganti Password &nbsp; &nbsp;
                    <span class="fa fa-unlock"></span>
                  </a>
                </div>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url() ?>login" style="margin-right: 20px; width: 150px;" class="btn btn-default btn-block">
                    Sign out &nbsp; &nbsp;
                    <span class="fa fa-sign-out"></span>
                  </a>
                </div>
              </li>
            </ul>
          </li>

          <?php endif ?>

        </ul>
      </div>
    </nav>
  </header>
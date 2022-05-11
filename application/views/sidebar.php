 <?php 
defined('BASEPATH') OR exit('No direct script access allowed');
// $this->load->library('encryption');

$this->load->library('session');

?>

<style type="text/css">
  
  .skin-blue .wrapper, .skin-blue .main-sidebar, .skin-blue .left-side {
    background-color: #042328;
  }

  .skin-blue .sidebar-menu>li.header {
    color: #71deef;
    background: #03434d;
  }

  .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a, .skin-blue .sidebar-menu>li.menu-open>a {
    color: #fff;
    background: #006878;
  }

  .skin-blue .sidebar-menu>li>.treeview-menu {
    margin: 0 1px;
    background: #342b5a;
  }

  .text-user{
    color: #ea9c0d;
  }

  .user-panel>.image>img {
    width: 100%;
    max-width: 55px;
    height: auto;
    border: 2px solid rgb(255, 255, 255);
  }

  <?php

    $foto = $_SESSION["ses_foto"];

    
  ?>

</style>

 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/dist/img/<?php echo $foto; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>

          <?php 
            if (isset($_SESSION["ses_nama"])){
                  echo str_replace('\' ', '\'', 
                      ucwords(str_replace('\'', '\' ', 
                          strtolower($_SESSION["ses_nama"])
                          )
                      )
                  );
              } else {
                redirect(base_url()."login/form");
              }

            ?>
          </p>

          <a href="#"><i class="fa fa-circle text-user"></i><?php echo $_SESSION["ses_level"] ?></a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <?php
        $level = $this->session->userdata("ses_level");
        ?>

        <?php if ($level == 'admin'): ?>

          <li class="active2 treeview2">
            <a href="<?php echo base_url() ?>dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="header" style="font-size: 15px;">INFORMASI DATA</li>
          <li class="treeview2">
            <a href="<?php echo base_url() ?>input_cp">
              <i class="fa fa-medkit"></i>
              <span>Input CP</span>
            </a>
          </li>
          <li class="treeview2">
            <a href="<?php echo base_url() ?>hasil_input_cp">
              <i class="fa fa-hospital-o"></i>
              <span>Informasi</span>
            </a>
          </li>
          <li class="treeview2">
            <a href="<?php echo base_url() ?>input_master">
              <i class="fa fa-ambulance"></i>
              <span>Master Data</span>
            </a>
          </li>
          <li class="treeview2">
            <a href="<?php echo base_url() ?>tambah_user">
              <i class="fa fa-user-plus"></i>
              <span>Tambah User</span>
            </a>
          </li>

        <?php elseif($level == 'user1'): ?>

          <li class="active2 treeview2">
            <a href="<?php echo base_url() ?>dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li class="header" style="font-size: 15px;">INFORMASI DATA</li>
          <li class="treeview2">
            <a href="<?php echo base_url() ?>input_cp">
              <i class="fa fa-medkit"></i>
              <span>Input CP</span>
            </a>
          </li>
          <li class="treeview2">
            <a href="<?php echo base_url() ?>hasil_input_cp">
              <i class="fa fa-hospital-o"></i>
              <span>Informasi</span>
            </a>
          </li>
          <li class="treeview2">
            <a href="<?php echo base_url() ?>input_master">
              <i class="fa fa-ambulance"></i>
              <span>Master Data</span>
            </a>
          </li>

        <?php endif ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
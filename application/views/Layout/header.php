<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Livestream - Admin</title>

        <!-- Bootstrap core CSS -->

        <!-- Custom fonts for this template -->
        <link href="<?= base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"
              type="text/css">

        <!-- Custom fonts for this template -->
        <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css">

        <!-- Angular Tooltip Css -->
        <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">

        <!-- Sweet Alert CSS -->
        <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/sweetalert/css/sweetalert.css">

        <!-- Custom styles for Color -->

        <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/bundles/datatables/datatables.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
        <link href="<?= base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url(); ?>assets/bundles/izitoast/css/iziToast.min.css" type="text/css">

        <?php if (!empty($CSS)) {
            foreach ($CSS as $value) {
                ?>
            <link href="<?php echo base_url() . $value ?>" rel="stylesheet">
            <?php
             }
          }
        ?>

    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/components.css">
    <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

    </head>

<body>
<script>
var base_url = '<?=base_url();?>';
</script>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i data-feather="maximize"></i>
              </a></li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">

          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user"> 
            <img src="<?=$this->session->userdata('profile_image')?>" alt="user-img" class="user-img-radious-style admin_profile author-box-profile">
            <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello <?= $this->session->userdata('admin_name'); ?></div>
 
              <a class="dropdown-item" href="<?= base_url(); ?>admin/admin_profile"  class="dropdown-item has-icon"><i class="ti-user"></i> My Profile</a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url(); ?>admin/logout" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?= base_url(); ?>admin/dashboard"> <img alt="image" src="<?= base_url(); ?>assets/img/logo-impilo.png" class="header-logo " /> 
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown <?php if($this->uri->segment(2)=="dashboard"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

            <li class="dropdown <?php if($this->uri->segment(2)=="users"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/users/list" class="nav-link"><i data-feather="users"></i><span>Users</span></a>
            </li>

            <li class="menu-header">Country</li>
            <li class="dropdown <?php if($this->uri->segment(2)=="country"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/country/list" class="nav-link"><i data-feather="flag"></i><span>Country</span></a>
            </li>

            <li class="menu-header">Media</li>
            <li class="dropdown <?php if($this->uri->segment(2)=="media" && $this->uri->segment(3)=="list"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/media/list" class="nav-link"><i data-feather="video"></i><span>Media</span></a>
            </li>
            <li class="dropdown <?php if($this->uri->segment(3)=="comment"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/media/comment/list" class="nav-link"><i data-feather="message-square"></i><span>Comment</span></a>
            </li>

            <li class="menu-header">Gift</li>
            <li class="dropdown <?php if($this->uri->segment(3)=="category" ){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/gift/category/list" class="nav-link"><i data-feather="box"></i><span>Gift Category</span></a>
            </li>
            <li class="dropdown <?php if($this->uri->segment(2)=="gift" && $this->uri->segment(3)=="list"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/gift/list" class="nav-link"><i data-feather="gift"></i><span>Gift</span></a>
            </li>

            <li class="menu-header">Coin Package</li>
            <li class="dropdown <?php if($this->uri->segment(2)=="coin_package" && $this->uri->segment(3)=="list"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/coin_package/list" class="nav-link"><i data-feather="box"></i><span>Coin Package</span></a>
            </li>
            <li class="dropdown <?php if($this->uri->segment(3)=="branding_image" ){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/coin_package/branding_image/list" class="nav-link"><i data-feather="image"></i><span>Branding Images</span></a>
            <li class="dropdown <?php if($this->uri->segment(3)=="offer"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/coin_package/offer/list" class="nav-link"><i data-feather="tag"></i><span>Offer Coin Package</span></a>
            </li>

            <!-- <li class="menu-header">Campaign</li>
            <li class="dropdown <?php if($this->uri->segment(2)=="campaign" ){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/campaign/list" class="nav-link"> <i class="ti i-cl-5 fa fa-bullhorn"></i><span>Campaign</span></a>
            </li> -->

            <li class="menu-header">Chat</li>
            <li class="dropdown <?php if($this->uri->segment(3)=="profile"  && $this->uri->segment(2)=="chat"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/chat/profile/list" class="nav-link"> <i data-feather="user"></i><span>Chat Profile</span></a>
            </li>
            <li class="dropdown <?php if($this->uri->segment(3)=="message" && $this->uri->segment(2)=="chat"){echo "active";}?>">
            <a href="<?= base_url(); ?>admin/chat/message/list" class="nav-link"> <i data-feather="message-circle"></i><span>Chat Message</span></a>
            </li>

            <li class="menu-header">Notification</li>
            <li class="dropdown <?php if($this->uri->segment(2)=="notification"){echo "active";}?>">
              <a href="<?= base_url(); ?>admin/notification" class="nav-link"><i data-feather="bell"></i><span>Notification</span></a>
            </li>

            <li class="menu-header">Settings</li>
            <li class="dropdown <?php if($this->uri->segment(2)=="settings"){echo "active";}?>">
              <a href="<?= base_url(); ?>admin/settings" class="nav-link"><i data-feather="settings"></i><span>Settings</span></a>
            </li>


        </ul>
        </aside>
      </div>

      <div class="main-content">

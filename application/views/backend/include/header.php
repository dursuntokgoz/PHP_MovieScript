
<?php $admin = $this->session->userdata('admin_bilgi'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/backend/'); ?>img/apple-icon.png">
  <link rel="icon" type="image/png" href="<?php echo base_url('assets/backend/'); ?>img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Material Dashboard PRO by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="<?php echo base_url('assets/backend/'); ?>css/material-dashboard.min.css?v=2.1.0" rel="stylesheet" />
  <link href="<?php echo base_url('assets/backend/'); ?>css/movie_type_blocks.css" rel="stylesheet" />
  <link href="<?php echo base_url('assets/backend/'); ?>css/select2.min.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="black" data-image="<?php echo base_url('assets/backend/'); ?>img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="<?php echo base_url('Admin')?>" class="simple-text logo-mini">
          HD
        </a>
        <a href="<?php echo base_url('Admin')?>" class="simple-text logo-normal">
          Full HD Film İzle
        </a>
      </div>
      <div class="sidebar-wrapper">
        <div class="user">
          <div class="photo">
            <img src="<?php echo avatar_url($admin->uye_avatar); ?>" />
          </div>
          <div class="user-info">
            <a data-toggle="collapse" href="#collapseExample" class="username">
              <span>
			    
                <?php if($admin->uye_ad != null){ echo $admin->uye_ad . ' ' . $admin->uye_soyad; }else{ echo $admin->uye_nickname; } ?>				
                <b class="caret"></b>
              </span>
              <span>
			    [<?php print_kişi_rütbe($admin->admin_rütbe) ?>]			
              </span>			  
            </a>
            <div class="collapse" id="collapseExample">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link">
                    <span>En Son <?php echo ' ' . tarihgeçenzaman($admin->admin_last_login) ?> giriş yaptınız.</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('profil/').$admin->uye_id; ?>">
                    <span class="sidebar-normal"> Profil Sayfası </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('Admin_Operations/logout'); ?>">
                    <span class="sidebar-normal"> Çıkış Yap </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <ul class="nav">
<?php if($admin->admin_rütbe == 1){?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Admin/admin_settings')?>">
              <i class="material-icons">edit</i>
              <p> Yönetici Ayarları </p>
            </a>
          </li>
<?php } ?>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Admin/home')?>">
              <i class="material-icons">home</i>
              <p> Ana Sayfa </p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#movies">
              <i class="material-icons">movie</i>
              <p> Film Ve Dizi Ayarları
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="movies">
              <ul class="nav">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('Admin/filmler'); ?>">
                    <span class="sidebar-mini"> F </span>
                    <span class="sidebar-normal"> Filmler </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo base_url('Admin/diziler'); ?>">
                    <span class="sidebar-mini"> D </span>
                    <span class="sidebar-normal"> Diziler </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo base_url('Admin/add_movie'); ?>">
                    <span class="sidebar-mini"> FE </span>
                    <span class="sidebar-normal"> Film veya Dizi Ekle </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
		  
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Admin/comments')?>">
              <i class="material-icons">comments</i>
              <p> Yapılan Yorumlar </p>
            </a>
          </li>	  

          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#cast">
              <i class="fa fa-users"></i>
              <p> Yapımcı Ayarları
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="cast">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo base_url('Admin/casts'); ?>">
                    <span class="sidebar-mini"> Y </span>
                    <span class="sidebar-normal"> Yapımcılar </span>
                  </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo base_url('Admin/add_cast'); ?>">
                    <span class="sidebar-mini"> Ye </span>
                    <span class="sidebar-normal"> Yapımcı Ekle </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>

          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#members">
              <i class="fa fa-users"></i>
              <p> Site Kullanıcı Ayarları
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="members">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="<?php echo base_url('Admin/members'); ?>">
                    <span class="sidebar-mini"> SK </span>
                    <span class="sidebar-normal"> Site Kullanıcıları </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('Admin/mail_box')?>">
              <i class="material-icons">mail</i>
              <p> Mail Kutusu </p>
            </a>
          </li>	

		</ul>


      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-minimize">
              <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Admin Paneli</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Ara...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Yeni Bildirim
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
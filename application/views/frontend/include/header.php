<?php $kisi = $this->session->userdata('user'); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>New Movie Template</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis">
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/fontawesome_all.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/ionicons.min.css')?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/plugins.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/Search-Field-With-Icon.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/Left-Menu.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/jquery.rateyo.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/grit/jquery.gritter.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/grit/gorsel.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/jquery.mCustomScrollbar.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/plyr.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/paging.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/bootstrap-slider.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/emojionearea.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/main.css')?>">
	

</head>
<body>
<!--preloading-->
<div id="preloader">
    <img class="logo" src="<?php echo base_url('assets/frontend/img/logo.png')?>" alt="">
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div>
<!--end of preloading-->
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand"> 
					<div id="logo"><a href="<?php echo base_url()?>"></a></div>
				</li>
				<h5>Menü</h5>
                <li> 
					<a href="<?php echo base_url()?>"><i class="fas fa-home"></i>Ana Sayfa</a>
				</li>
                <li> 
					<a href="<?php echo base_url('kesfet')?>"><i class="fal fa-compass"></i>Keşfet</a>
				</li>	
				<li> 
					<a href="<?php echo base_url('diziler') ?>"><i class="fal fa-tv-retro"></i>TV Dizileri</a>
				</li>
				<li> 
					<a href="<?php echo base_url('filmler') ?>"><i class="fal fa-film"></i>Sinema Filmleri</a>
				</li>				
				<li> 
					<a href="<?php echo base_url('trend') ?>"><i class="fas fa-fire"></i>Trendler</a>
				</li>							
                <li> 
					<a href="<?php echo base_url('top10') ?>"><i class="fal fa-trophy"></i>Top 10</a>
				</li>
				<li> 
					<a href="<?php echo base_url('takvim') ?>"><i class="fal fa-calendar"></i>Takvim</a>
				</li>			
				<li> 
					<a href="<?php echo base_url('forum') ?>"><i class="fas fa-italic"></i>Forum</a>
				</li>	

				<h5></h5>
				<li> 
					<a href="<?php echo base_url('hakkımızda') ?>"><i class="fal fa-info-circle"></i>Hakkımızda</a>
				</li>
				<li> 
					<a href="<?php echo base_url('görüs-bildir') ?>"><i class="fal fa-lightbulb"></i>Görüş Bildir</a>
				</li>
            </ul>
        </div>
        <div class="page-content-wrapper">
            <div class="container-fluid">

				<header class="ht-header full-width-hd">
						<div class="row">
							<nav id="mainNav" class="navbar navbar-default navbar-custom">

								<div class="navbar-header logo">
									<div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
										<span class="sr-only">Toggle navigation</span>
										<div id="nav-icon1">
											<span></span>
											<span></span>
											<span></span>
										</div>
									</div>
									<a class="btn btn-link" role="button" id="menu-toggle" href="#menu-toggle"><i class="far fa-bars fa-2x" style="color: rgb(255,255,255);"></i></a>
									<div id="logo" style="margin-left:30px"><a href="<?php echo base_url()?>"></a></div>
								</div>

								<div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
									<ul class="nav navbar-nav flex-child-menu menu-left">
										<li class="hidden">
											<a href="#page-top"></a>
										</li>	


									</ul>
									<ul class="nav navbar-nav flex-child-menu menu-right">
				<?php if($this->session->userdata('durum') == true){?>
										<li class="dropdown first">
											<a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
											<?php  if($kisi->uye_ad && $kisi->uye_soyad){echo $kisi->uye_ad.' '.$kisi->uye_soyad;}else{echo $kisi->uye_nickname;} ?> &nbsp;<i class="fas fa-angle-down" aria-hidden="true"></i>
											</a>
											<ul class="dropdown-menu level1">	
												<?php if(isset($kisi->admin_rütbe)){?>
												<li><a href="<?php echo base_url('admin/') ; ?>">Admin Paneli</a></li>
												<?php } ?>
												<li><a href="<?php echo base_url('profil/').$kisi->uye_id ; ?>">Profil Sayfası</a></li>
												<li class="it-last"><a href="<?php echo base_url('Member_Operations/logout');?>">Çıkış Yap</a></li>
											</ul>
										</li>
										<div class="user-img">
											<a href="#"><img style='width:60px;height:60px;border-radius:100%;border:2px solid #fff'src="<?php echo avatar_url($kisi->uye_avatar);?>" alt="<?php echo $kisi->uye_nickname ?>"><br></a>
										</div>
				<?php }else{?>
										<li class="registerbtn"><a href="#">Kayıt Ol</a></li>
										<li class="btn loginbtn"><a href="#"><i class="fal fa-sign-in"></i>Giriş Yap</a></li>
				<?php }?>
									</ul>
								</div>
						</nav>
						<div class="search-container">
							<input type="text" class="search-input" id="searching" onkeyup="moviesearch()" placeholder="Aradığınız diziyi filmi veya oyuncuyu anında bulun.">
						</div>
						<div id="searchresult"></div>
						</div>	
				</header>
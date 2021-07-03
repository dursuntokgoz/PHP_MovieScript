<?php $this->load->view('backend/include/header'); ?>


<div class="content">
    <div class="container-fluid">

		<div class="row">
		  <div class="col-lg-3 col-md-6 col-sm-6">
			<div class="card card-stats">
			  <div class="card-header card-header-warning card-header-icon">
				<div class="card-icon">
				  <i class="material-icons">movie</i>
				</div>
				<p class="card-category">Kayıtlı Film Sayısı</p>
				<h3 class="card-title"><?php echo $filmler ?></h3>
			  </div>
			  <div class="card-footer">
				<div class="stats">

				</div>
			  </div>
			</div>
		  </div>
		  <div class="col-lg-3 col-md-6 col-sm-6">
			<div class="card card-stats">
			  <div class="card-header card-header-rose card-header-icon">
				<div class="card-icon">
				  <i class="material-icons">local_movies</i>
				</div>
				<p class="card-category">Kayıtlı Dizi Sayısı</p>
				<h3 class="card-title"><?php echo $diziler ?></h3>
			  </div>
			  <div class="card-footer">
				<div class="stats">

				</div>
			  </div>
			</div>
		  </div>

		  <div class="col-lg-3 col-md-6 col-sm-6">
			<div class="card card-stats">
			  <div class="card-header card-header-info card-header-icon">
				<div class="card-icon">
				  <i class="material-icons">comment</i>
				</div>
				<p class="card-category">Yapılan Yorum Sayısı</p>
				<h3 class="card-title"><?php echo $yorum_sayısı + 0 ?></h3>
			  </div>
			  <div class="card-footer">
				<div class="stats">

				</div>
			  </div>
			</div>
		  </div>

		  <div class="col-lg-3 col-md-6 col-sm-6">
			<div class="card card-stats">
			  <div class="card-header card-header-success card-header-icon">
				<div class="card-icon">
				  <i class="material-icons">supervised_user_circle</i>
				</div>
				<p class="card-category">Kullanıcı Sayısı</p>
				<h3 class="card-title"><?php echo $üyeler + 0 ?></h3>
			  </div>
			  <div class="card-footer">
				<div class="stats">

				</div>
			  </div>
			</div>
		  </div>
		</div>

    </div>
</div>




 <?php $this->load->view('backend/include/footer'); ?>
<?php $this->load->view('frontend/include/header'); ?>

<div class="hero hero3">

</div>
<!-- celebrity single section-->

<div class="page-single movie-single cebleb-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="mv-ceb">
					<img src="<?php echo image_url($cast->cast_image)?>" alt="">
				</div>
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="movie-single-ct" style="margin-top:150px">
					<h1 class="bd-hd"><?php echo $cast->cast_name ?></h1>
					<p class="ceb-single"><?php echo $cast->cast_job ?></p>
					<div class="movie-tabs">
						<div class="tabs">
							<ul class="tab-links tabs-mv">
								<li class="active"><a href="#overviewceb"><?php echo $cast->cast_name ?></a></li>
								<li ><a href="#biography"> Biyografi</a></li>
								<li><a href="#filmography">Filmografi</a></li>                        
							</ul>
						    <div class="tab-content">
						        <div id="overviewceb" class="tab active">
						            <div class="row">
						            	<div class="col-md-12 col-sm-12 col-xs-12">
						            		<div class="title-hd-sm">
												<h4>Tam İsmi</h4>
											</div>
											<div class="mvsingle-item ov-item">
											<p> <?php echo $cast->cast_name ?> </p>
											</div>
										<?php if($cast->cast_birth_day){ ?>
											<div class="title-hd-sm">
												<h4>Doğum Tarihi</h4>
											</div>
											<div class="mvsingle-item ov-item">
											<p><?php echo türkçetarihformat('j F Y',$cast->cast_birth_day) ?></p>
											</div>
										<?php }?>	
										<?php if($cast->cast_death_day){ ?>
											<div class="title-hd-sm">
												<h4>Ölüm Tarihi</h4>
											</div>
											<div class="mvsingle-item ov-item">
											<p><?php echo türkçetarihformat('j F Y',$cast->cast_death_day) ?></p>
											</div>
										<?php }?>
										<?php if($cast->cast_birth_place){ ?>
										<div class="title-hd-sm">
												<h4>Doğum Yeri</h4>
											</div>
											<div class="mvsingle-item ov-item">
											<p><?php echo $cast->cast_birth_place ?></p>
											</div>
										<?php }?>
						            	</div>
						            </div>
						        </div>
						        <div id="biography" class="tab">
						           <div class="row">
						            	<div class="rv-hd">
											<div>
												<h3>Biyografi</h3>
						       	 				<h2><?php echo $cast->cast_name ?></h2>
											</div>							            						
						            	</div>
						            	<p><?php echo $cast->cast_biography ?></p>
						            </div>
						        </div>
					       	 	<div id="filmography" class="tab">
						        	<div class="row">
						            	<div class="rv-hd">
						            		<div>
												<h3>Filmografi</h3>
					       	 					<h2><?php echo $cast->cast_name?></h2>
						            		</div>
										
						            	</div>
										
										<div class="movie-tabs">
											<div class="tabs">
												<ul class="tab-links tabs-mv">
													<li class="active"><a href="#overviewceb"><?php echo $cast->cast_name ?></a></li>
													<li ><a href="#films"> Filmler</a></li>
													<li><a href="#movies">Diziler</a></li>                        
												</ul>
												<div class="tab-content">
													<div id="films" class="tab active">
														<div class="topbar-filter">
															<p>Toplamda <span><?php echo count($cast_films) ?></span> adet film bulundu.</p>
														</div>
													
														<div id="movie_paging">	
															<ul class="movie-list">												
													<?php foreach($cast_films as $film){?>										
																<li class="movie">
																	<div class="movie-info">
																		<div class="movie-name">
																			<?php echo yazi_kisalt($film->film_ad, 25)?>
																		</div>
																		<div class="movie-rate">
																			<i class="ion-android-star"></i>
																			<span><?php echo $film->film_puanı ?></span>
																		</div>
																	</div>
																	<div class="movie-image">
																		<img src="<?php echo image_url($film->film_kapak_image, $film->film_sef_link) ?>" alt="">
																	</div>	
																	<div class="movie-info">
																		<div class="cate">
																		<?php foreach(explode(',',$film->film_türü) as $film_türü){ ?>
																			<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $film_türü ?></a></span>
																		<?php }?>
																		</div>
																	</div>
																	<div class="movie-inner">
																		<a onclick="film_detail(<?php echo $film->film_id ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
																	</div>													
																</li>										
													<?php }?>
															</ul>
														</div>													
													
													</div>
													<div id="movies" class="tab">
														<div class="topbar-filter">
															<p>Toplamda <span><?php echo count($cast_movies) ?></span> adet dizi bulundu.</p>
														</div>

														<div id="movie_paging">	
															<ul class="movie-list">												
													<?php foreach($cast_movies as $dizi){?>										
																<li class="movie">
																	<div class="movie-info">
																		<div class="movie-name">
																			<?php echo yazi_kisalt($dizi->dizi_ad, 25)?>
																		</div>
																		<div class="movie-rate">
																			<i class="ion-android-star"></i>
																			<span><?php echo $dizi->dizi_puanı ?></span>
																		</div>
																	</div>
																	<div class="movie-image">
																		<img src="<?php echo image_url($dizi->dizi_kapak_image, $dizi->dizi_sef_link) ?>" alt="">
																	</div>	
																	<div class="movie-info">
																		<div class="cate">
																		<?php foreach(explode(',',$dizi->dizi_türü) as $dizi_türü){ ?>
																			<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $dizi_türü ?></a></span>
																		<?php }?>
																		</div>
																	</div>
																	<div class="movie-inner">
																		<a onclick="movie_detail(<?php echo $dizi->dizi_id ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
																	</div>													
																</li>										
													<?php }?>
															</ul>
														</div>													
													</div>
												</div>
											</div>
										</div>
						            </div>
					       	 	</div>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

<!-- celebrity single section-->

<?php $this->load->view('frontend/include/footer');?>
<?php $this->load->view('frontend/include/header'); ?>
                    <div class="row" id="main-container">
                        <div class="col-md-12">                      
							<div class="movie-items  full-width">
								<div class="row">
									<div class="col-md-12">
								<?php if($this->session->userdata('durum') == true) {?>
										<div class="title-hd">
											<h2>Takip Ettiğin Dizilerin En Son Yayınlanan Bölümleri</h2>
										</div>
										<ul class="movie-list" id="episode_slider">		
								<?php if($favorisonçıkanbölümler){foreach($favorisonçıkanbölümler as $bölüm){?>								
											<li class="movie">
												<div class="movie-info">
													<div class="movie-name">
														<?php echo yazi_kisalt($bölüm->dizi_ad, 30)?>
													</div>													
													<div class="movie-rate">
														<i class="ion-android-star"></i>
														<span><?php echo $bölüm->episode_puan ?></span>
													</div>
												</div>
												<div class="movie-info">
													<div class="episode-info">
														Sezon  <?php echo $bölüm->season_number ?> - 
														Bölüm  <?php echo $bölüm->episode_number ?>
													</div>
												</div>
												<div class="movie-image">
													<img src="<?php echo image_url($bölüm->episode_image, $bölüm->dizi_sef_link) ?>" alt="">
												</div>
												<div class="movie-info">
													<div class="episode-release-date">
														<?php echo tarihgeçenzaman($bölüm->episode_add_date) ?>
													</div>
												</div>
												<div class="movie-inner">
													<a onclick="episode_detail('<?php echo $bölüm->dizi_id ?>','<?php echo $bölüm->episode_id ?>')"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
												</div>															
											</li>										
								<?php }}else{ ?>
											<p> Favori diziniz bulunmamaktadır.</p>
								<?php } ?>
										</ul>
								<?php } ?>

										<div class="title-hd">
											<h2>TV Dizileri</h2>
											<a href="<?php echo base_url('diziler') ?>" class="viewall">Tümünü Göster <i class="fas fa-eye"></i></a>
										</div>
										<div class="tabs">
											<ul class="tab-links">
												<li class="active"><a href="#lastmovies">#En Son Eklenen Bölümler</a></li>
												<li><a href="#bestimdbmovies">  #Imdb Puanı Yüksek Diziler </a></li>
												<li><a href="#comingsoonmovies"> #Yakında Çıkacak Bölümler</a></li>
											</ul>
											<div class="tab-content">
												<div id="lastmovies" class="tab active">													
													<ul class="movie-list" id="episode_slider">		
											<?php if($sonçıkanbölümler){foreach($sonçıkanbölümler as $bölüm){?>										
														<li class="movie">
															<div class="movie-info">
																<div class="movie-name">
																	<?php echo yazi_kisalt($bölüm->dizi_ad, 30)?>
																</div>													
																<div class="movie-rate">
																	<i class="ion-android-star"></i>
																	<span><?php echo $bölüm->episode_puan ?></span>
																</div>
															</div>
															<div class="movie-info">
																<div class="episode-info">
																	Sezon  <?php echo $bölüm->season_number ?> - 
																	Bölüm  <?php echo $bölüm->episode_number ?>
																</div>
															</div>
															<div class="movie-image">
																<img src="<?php echo image_url($bölüm->episode_image, $bölüm->dizi_sef_link) ?>" alt="">
															</div>
															<div class="movie-info">
																<div class="episode-release-date">
																	<?php echo tarihgeçenzaman($bölüm->episode_add_date) ?>
																</div>
															</div>
															<div class="movie-inner">
																<a onclick="episode_detail('<?php echo $bölüm->dizi_id ?>','<?php echo $bölüm->episode_id ?>')"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
															</div>															
														</li>										
											<?php }}?>
													</ul>
												</div>
												<div id="bestimdbmovies" class="tab">
												   <div class="row">
														<div class="slick-multiItem2">
														<?php if($imdbpuanıyüksekdiziler){foreach($imdbpuanıyüksekdiziler as $dizi){ ?>
															<div class="movie-item">
																<div class="mv-img">
																	<img src="<?php echo image_url($dizi->dizi_image, $dizi->dizi_sef_link); ?>" alt="">
																</div>
																<div class="hvr-inner">
																	<a onclick="movie_detail(<?php echo $dizi->dizi_id ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
																</div>
																<div class="title-in">
																	<h6><a href="#"><?php echo $dizi->dizi_ad ?></a></h6>
																	<p><i class="ion-android-star"></i><span><?php echo $dizi->dizi_puanı ?></span> /10</p>
																</div>
															</div>
														<?php }} ?>
														</div>
													</div>
												</div>
												 <div id="comingsoonmovies" class="tab">
													<div class="row">
														<p>Bu kısım yakında eklenecektir.</p>
													</div>
												</div>
											</div>
										</div>
									
										<div class="title-hd">
											<h2>Sinema Filmleri</h2>
											<a href="<?php echo base_url('filmler') ?>" class="viewall">Tümünü Göster <i class="fas fa-eye"></i></a>
										</div>
										<div class="tabs">
											<ul class="tab-links">
												<li class="active"><a href="#lastaddfilms">#En Son Eklenen Filmler</a></li>
												<li><a href="#lastreleasefilms">#En Son Çıkan Filmler</a></li>
												<li><a href="#mostviewfilms"> #En Popüler Olanlar</a></li>
												<li><a href="#bestimdbfilms">  #Imdb Puanı Yüksek Olanlar </a></li>
												<li><a href="#comingsoonfilms"> #Yakında Çıkacaklar</a></li>
											</ul>
											<div class="tab-content">
												<div id="lastaddfilms" class="tab active">
													<div class="row">
														<div class="slick-multiItem2">
														<?php if($ensoneklenenfilmler){foreach($ensoneklenenfilmler as $film){?>
															<div class="movie-item">
																<div class="mv-img">
																	<img src="<?php echo image_url($film->film_image, $film->film_sef_link); ?>" alt="">
																</div>
																<div class="hvr-inner">
																	<a onclick="film_detail(<?php echo $film->film_id ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
																</div>
																<div class="title-in">
																	<h6><a href="#"><?php echo $film->film_ad ?></a></h6>
																	<p><i class="ion-android-star"></i><span><?php echo $film->film_puanı ?></span> /10</p>
																</div>
															</div>
														<?php }} ?>
														</div>
													</div>
												</div>
												<div id="lastreleasefilms" class="tab">
													<div class="row">
														<div class="slick-multiItem2">
														<?php if($sonçıkanfilmler){foreach($sonçıkanfilmler as $film){?>
															<div class="movie-item">
																<div class="mv-img">
																	<img src="<?php echo image_url($film->film_image, $film->film_sef_link); ?>" alt="">
																</div>
																<div class="hvr-inner">
																	<a onclick="film_detail(<?php echo $film->film_id ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
																</div>
																<div class="title-in">
																	<h6><a href="#"><?php echo $film->film_ad ?></a></h6>
																	<p><i class="ion-android-star"></i><span><?php echo $film->film_puanı ?></span> /10</p>
																</div>
															</div>
														<?php }} ?>
														</div>
													</div>
												</div>												
												<div id="mostviewfilms" class="tab">
												   <div class="row">
														<div class="slick-multiItem2">
														<?php if($ençokgörüntülenenfilmler){foreach($ençokgörüntülenenfilmler as $film){ ?>
															<div class="movie-item">
																<div class="mv-img">
																	<img src="<?php echo image_url($film->film_image, $film->film_sef_link); ?>" alt="">
																</div>
																<div class="hvr-inner">
																	<a onclick="film_detail(<?php echo $film->film_id ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
																</div>
																<div class="title-in">
																	<h6><a href="#"><?php echo $film->film_ad ?></a></h6>
																	<p><i class="ion-android-star"></i><span><?php echo $film->film_puanı ?></span> /10</p>
																</div>
															</div>
														<?php }} ?>
														</div>
													</div>
												</div>
												<div id="bestimdbfilms" class="tab">
												   <div class="row">
														<div class="slick-multiItem2">
														<?php if($imdbpuanıyüksekfilmler){foreach($imdbpuanıyüksekfilmler as $film){ ?>
															<div class="movie-item">
																<div class="mv-img">
																	<img src="<?php echo image_url($film->film_image, $film->film_sef_link); ?>" alt="">
																</div>
																<div class="hvr-inner">
																	<a onclick="film_detail(<?php echo $film->film_id ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
																</div>
																<div class="title-in">
																	<h6><a href="#"><?php echo $film->film_ad ?></a></h6>
																	<p><i class="ion-android-star"></i><span><?php echo $film->film_puanı ?></span> /10</p>
																</div>
															</div>
														<?php }} ?>
														</div>
													</div>
												</div>
												 <div id="comingsoonfilms" class="tab">
													<div class="row">
														<div class="slick-multiItem2">
														<?php if($yakındaçıkacakfilmler){foreach($yakındaçıkacakfilmler as $film){ ?>
															<div class="movie-item">
																<div class="mv-img">
																	<img src="<?php echo image_url($film->film_image, $film->film_sef_link); ?>" alt="">
																</div>
																<div class="hvr-inner">
																	<a onclick="film_detail(<?php echo $film->film_id ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
																</div>
																<div class="title-in">
																	<h6><a href="#"><?php echo $film->film_ad ?></a></h6>
																	<p><i class="ion-android-star"></i><span><?php echo $film->film_puanı ?></span> /10</p>
																</div>
															</div>
														<?php }} ?>
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
					
<?php $this->load->view('frontend/include/footer'); ?>
<?php $this->load->view('frontend/include/header');?>
					<div class="col-md-12">
					
						
						<div style="background: url('<?php if($film_bilgileri->film_kapak_image){echo image_url($film_bilgileri->film_kapak_image, $film_bilgileri->film_sef_link);}else{ echo base_url('assets/uploads/diziler/kapak/no-kapak-image.jpg');} ?>') no-repeat top;background-size: cover;" class="hero mv-single-hero">
							<div class="container">
								<div class="row">
									<div class="col-md-12">

									</div>
								</div>
							</div>
						</div>
						
						<div class="page-single movie-single movie_single">
							<div class="container" style="display:contents">
								<div class="row ipad-width2" style="">
									<div class="col-md-4 col-sm-12 col-xs-12">
										<div class="movie-img">
											<img src="<?php echo image_url($film_bilgileri->film_image, $film_bilgileri->film_sef_link) ?>" alt="<?php echo $film_bilgileri->film_ad ?>">
										</div>
									</div>	

									<div class="col-md-8 col-sm-12 col-xs-12">
										<div class="movie-single-ct main-content">
											<h1 class="bd-hd"><?php echo $film_bilgileri->film_ad ?><span> <?php echo türkçetarihformat('j F Y',$film_bilgileri->film_release_date) ?></span></h1>
											<div class="social-btn">
						<?php if($this->session->userdata('durum') == true){ ?>
						<?php if(favorikontrol('film', $this->session->userdata('user')->uye_id, $film_bilgileri->film_id) != true){?>
												<a class="parent-btn" id="add_favourite" onclick="add_favourite(<?php echo $this->session->userdata('user')->uye_id ?>,<?php echo $film_bilgileri->film_id ?>,'film')"><i class="ion-heart"></i> Favorilerine Ekle</a>
												<a style="display:none;" class="parent-btn" id="remove_favourite" onclick="remove_favourite(<?php echo $this->session->userdata('user')->uye_id ?>,<?php echo $film_bilgileri->film_id ?>,'film')"><i class="ion-close"></i> Favorilerinden Kaldır</a>
						<?php }else{ ?>
												<a style="display:none;" href="#" class="parent-btn" id="add_favourite" onclick="add_favourite(<?php echo $this->session->userdata('user')->uye_id ?>,<?php echo $film_bilgileri->film_id ?>,'film')"><i class="ion-heart"></i> Favorilerine Ekle</a>
												<a class="parent-btn" id="remove_favourite" onclick="remove_favourite(<?php echo $this->session->userdata('user')->uye_id ?>,<?php echo $film_bilgileri->film_id ?>,'film')"><i class="ion-close"></i> Favorilerinden Kaldır</a>
						<?php }} ?>
												<div class="hover-bnt">
													<a href="#" class="parent-btn"><i class="ion-android-share-alt"></i>Filmi Paylaş</a>
													<div class="hvr-item">
														<a href="#" class="hvr-grow"><i class="ion-social-facebook"></i></a>
														<a href="#" class="hvr-grow"><i class="ion-social-twitter"></i></a>
														<a href="#" class="hvr-grow"><i class="ion-social-googleplus"></i></a>
														<a href="#" class="hvr-grow"><i class="ion-social-youtube"></i></a>
													</div>
												</div>		
											</div>
											<div class="movie-rating">
												<div class="rate">
													<i class="fab fa-imdb"></i>
													<p>
														<span class="rv">Imdb Puanı</span><br>
														<span><?php echo $film_bilgileri->film_puanı ?></span> /10
													</p>
												</div>
												<div class="rate">
													<p>
														<span class="rv">Site Puanı</span><br>
														<span><?php echo site_puanı('film', $film_bilgileri->film_id) ?></span> /10
														<div id="sitepuanı" data-rateyo-rating="<?php echo site_puanı('film', $film_bilgileri->film_id) ?>"></div>
													</p>
												</div>
											</div>
											<div class="movie-btn">	
												<div class="btn-transform transform-vertical red">
													<div><a href="#" class="item item-1 redbtn"> <i class="fab fa-youtube"></i> Fragman İzle</a></div>
													<div><a href="<?php echo 'https://www.youtube.com/embed/'. $film_bilgileri->film_trailer ?>" class="item item-2 redbtn fancybox-media hvr-grow"><i class="fab fa-youtube fa-2x"></i></a></div>
												</div>
												<div class="btn-transform transform-vertical">
													<div><a class="item item-1 yellowbtn"> <i class="fas fa-play"></i> Filmi İzle</a></div>
													<div><a href="<?php echo base_url('izle/film/').$film_bilgileri->film_sef_link ?>" class="item item-2 yellowbtn"><i class="fas fa-play"></i></a></div>
												</div>
											</div>											
											<div class="tabs tabs-border">
												<ul class="tab-links tabs-mv tabs-series">
													<li class="active"><a href="#overview">Film Hakkında</a></li>
													<li><a href="#reviews"> Yorumlar</a></li>
													<li><a href="#cast">  Film Ekibi </a></li>
													<li><a href="#media"> Medya </a></li>  
													<li><a href="#moviesrelated"> İlgili Filmler</a></li>                        
												</ul>
											</div>
									
										</div>
									</div>	
								</div>
								
								<div class="movie-single-ct main-content">				
									<div class="movie-tabs">
										<div class="tabs">

											<div class="tab-content">
												<div id="overview" class="tab review active">
													<div class="row">
														<div class="col-md-9 col-sm-12 col-xs-12">
															<?php if($film_bilgileri->film_describe){?>
															<div class="title-hd-sm">
																<h4>Film Açıklaması</h4>
															</div>
															<p><?php echo $film_bilgileri->film_describe ?></p>		
															<?php }else{?>	
															<div class="title-hd-sm">
																<h4>Film Açıklaması</h4>
															</div>
															<h2>Film açıklaması bulunmamaktadır.</h2>	
															<?php } ?>

															<?php if($film_yorumları){ ?>
															<div class="title-hd-sm">
																<h4>Son Yorum</h4>
																<ul class="tab-links">
																	<a href="#reviews" class="time">Tüm yorumları göster (<?php echo count($film_yorumları) ?>) <i class="fas fa-eye"></i></a>                      
																</ul>
															</div>
															<!-- movie user review -->
															<div class="mv-user-review-item">
																<ul>
																	<?php if($film_yorumları{0}->comment_spoiler == 1){?>
																	<li class="mv-user-review-item spoiler" id="sonyorum<?php echo $film_yorumları{0}->yorum_id ?>">
																	<?php }else{?>
																	<li class="mv-user-review-item">
																	<?php } ?>
																		<div class="user-infor">
																			<img src="<?php echo avatar_url(üyeresminial($film_yorumları{0}->uye_id)['uye_avatar']) ?>" alt="">
																			<div>
																				<h3><?php echo $film_yorumları{0}->comment_title ?></h3>
																				<div class="no-star">
																		<?php for($a = 0; $a < $film_yorumları{0}->comment_rate; $a++){?>
																					<i class="ion-android-star"></i>
																		<?php }?>
																		<?php for($a = 0; $a < 10-($film_yorumları{0}->comment_rate); $a++){?>
																					<i class="ion-android-star last"></i>
																		<?php }?>
																				</div>
																				<p class="time">
																					<?php echo tarihgeçenzaman($film_yorumları{0}->sended_date) ?> <a href="<?php echo base_url('profil/'.$film_yorumları{0}->uye_id) ?>"> <?php if(üyeresminial($film_yorumları{0}->uye_id)['uye_ad'] && üyeresminial($film_yorumları{0}->uye_id)['uye_soyad']){ echo üyeresminial($film_yorumları{0}->uye_id)['uye_ad'].' '.üyeresminial($film_yorumları{0}->uye_id)['uye_soyad']; }else{ echo üyeresminial($film_yorumları{0}->uye_id)['uye_nickname']; } ?></a> tarafından gönderildi.
																				</p>
																			</div>
																		</div>
																		<p class="emoji_comment" style="text-indent:10px;"><?php echo $film_yorumları{0}->comment ?></p>
																	<?php if($film_yorumları{0}->comment_spoiler == 1){?>
																		<div class="spoiler_message" id="sonspomesaj<?php echo $film_yorumları{0}->yorum_id ?>">
																			<a onclick="show_spoiler2(<?php echo $film_yorumları{0}->yorum_id ?>)" class="yellowbtn">Bu yorum spoiler içermektedir. Görmek istiyorsanız tıklayınız.</a>
																		</div>
																	<?php } ?>
																	</li>
																</ul>
															</div>
															<?php } ?>
														</div>
														<div class="col-md-3 col-xs-12 col-sm-12">
															<div class="sb-it">
																<h6>Film Türü</h6>
																<p>
																<?php foreach(explode(',',$film_bilgileri->film_türü) as $film_türü){?>
																	<a href="#"><?php echo $film_türü.'<br>' ?> </a>
																<?php } ?>
																</p>
															</div>
															<div class="sb-it">
																<h6>Film Şirketi</h6>
																<p>
																<?php foreach($film_şirketi as $film_şirketi){?>
																	<a href="" target="_blank"><?php if($film_şirketi != null){ echo $film_şirketi->company_name .'<br>'; }?> </a>
																<?php } ?>
																</p>
															</div>
															<div class="sb-it">
																<h6>Film Çıkış Tarihi</h6>
																<p><?php echo türkçetarihformat('j F Y',$film_bilgileri->film_release_date) ?></p>
															</div>
															<div class="sb-it">
																<h6>Film Maliyeti</h6>
																<p><?php echo $film_bilgileri->film_bütçesi ?></p>
															</div>
															<div class="sb-it">
																<h6>Film Süresi</h6>
																<p><?php echo $film_bilgileri->film_süresi ?> dakika</p>
															</div>
															<div class="sb-it">
																<h6>Film Ekibi</h6>
																<p>
																<?php if($film_ekibi){foreach($film_ekibi as $ekip){?>
																	<a href=" " target="_blank"><?php if($ekip != null){echo $ekip->cast_name;} ?> </a>
																<?php }} ?>
																</p>
															</div>
															<div class="sb-it">
																<h6>Film Keywords</h6>
																<p class="tags">
																<?php foreach(explode(',', $film_bilgileri->film_keywords) as $keyword){ ?>
																	<span class="time"><a href="#"><?php echo $keyword; ?></a></span>
																<?php } ?>
																</p>
															</div>
															<div class="ads">
																<img src="<?php echo base_url('assets/frontend/'); ?>images\uploads\ads1.png" alt="">
															</div>
														</div>
													</div>
												</div>
												<div id="reviews" class="tab review">
												   <div class="row">
														<div class="rv-hd">
															<div class="div">
																<h3>Film Hakkındaki Yorum ve Görüşler</h3>
																<h2><?php echo $film_bilgileri->film_ad ?></h2>
															</div>
														</div>
												<?php if($film_yorumları){ ?>
														<div class="topbar-filter">
															<p>Toplamda <span><?php echo count($film_yorumları) ?> tane</span> yorum bulundu.</p>
															<label>Filtrele:</label>
															<select>
																<option value="popularity">Popularity Descending
																<option value="popularity">Popularity Ascending
																<option value="rating">Rating Descending
																<option value="rating">Rating Ascending
																<option value="date">Release date Descending
																<option value="date">Release date Ascending
															</select>
														</div>
												<div id="comment_paging">
													<ul>
													<?php foreach($film_yorumları as $film_yorum){?>
														<?php if($film_yorum->comment_spoiler == 1){?>
														<li class="mv-user-review-item spoiler" id="yorum<?php echo $film_yorum->yorum_id ?>">
														<?php }else{?>
														<li class="mv-user-review-item">
														<?php } ?>
															<div class="user-infor">
																<img src="<?php echo avatar_url(üyeresminial($film_yorum->uye_id)['uye_avatar']) ?>" alt="">
																<div>
																	<h3><?php echo $film_yorum->comment_title ?></h3>
																	<div class="no-star">
															<?php for($a = 0; $a < $film_yorum->comment_rate; $a++){?>
																		<i class="ion-android-star"></i>
															<?php }?>
															<?php for($a = 0; $a < 10-($film_yorum->comment_rate); $a++){?>
																		<i class="ion-android-star last"></i>
															<?php }?>
																	</div>
																	<p class="time">
																		<?php echo tarihgeçenzaman($film_yorum->sended_date) ?> <a href="<?php echo base_url('profil/'.$film_yorum->uye_id) ?>"> <?php if(üyeresminial($film_yorum->uye_id)['uye_ad'] && üyeresminial($film_yorum->uye_id)['uye_soyad']){ echo üyeresminial($film_yorum->uye_id)['uye_ad'].' '.üyeresminial($film_yorum->uye_id)['uye_soyad']; }else{ echo üyeresminial($film_yorum->uye_id)['uye_nickname']; } ?></a> tarafından gönderildi.
																	</p>
																</div>
															</div>
															<p class="emoji_comment" style="text-indent:10px;"><?php echo $film_yorum->comment ?></p>
														<?php if($film_yorum->comment_spoiler == 1){?>
															<div class="spoiler_message" id="spomesaj<?php echo $film_yorum->yorum_id ?>">
																<a onclick="show_spoiler(<?php echo $film_yorum->yorum_id ?>)" class="yellowbtn">Bu yorum spoiler içermektedir. Görmek istiyorsanız tıklayınız.</a>
															</div>
														<?php } ?>
														</li>
													<?php } ?>
													</ul>
												</div>

												<?php }else{ ?>
														<p><h3>Film hakkında henüz yorum yapılmamış.</h3></p>
												<?php } ?>												   
												    </div>
												</div>
												
												<div id="cast" class="tab">
													<div class="row">
														<h3>Film Ekibi ve Oyuncuları</h3>
														<h2><?php echo $film_bilgileri->film_ad ?></h2>
														<!-- //== -->
														
													<?php if($film_ekibi){foreach(ekipgrupla($film_ekibi) as $key => $ekip){  ?>	
														<div class="title-hd-sm">
															<h4><?php echo $key ?></h4>
														</div>
														<div class="mvcast-item">
														<?php foreach(array_filter($ekip) as $cast){ ?>											
															<div class="col-md-4">
																<div class="ceb-item-style-2">
																	<?php if($cast != null && $cast->cast_image == null){ $ad_soyad = explode(' ',$cast->cast_name); echo '<h4>'; foreach($ad_soyad as $basharf){ echo $basharf[0];} echo '</h4>';}else{ ?>
																	<img style="height:100px; width:80px;" src="<?php if($cast != null){echo image_url($cast->cast_image);} ?>" alt="">
																	<?php } ?>
																	<div class="ceb-infor">
																		<h2><a href="<?php echo base_url('cast/').$cast->cast_id ?>"><?php if($cast != null){echo yazi_kisalt($cast->cast_name, 19); } ?></a></h2>
																	</div>
																</div>
															</div>
														<?php }?>
														</div>
													<?php }}?>					

													</div>
												</div>
												<div id="media" class="tab">
													<div class="row">
														<div class="rv-hd">
															<div>
																<h3>Fotoğraflar ve Videolar</h3>
																<h2><?php echo $film_bilgileri->film_ad ?></h2>
															</div>
														</div>

														<div class="tabs" style="margin:0;">
															<ul class="tab-links tabs-mv" style="padding:0">
																<li class="active"><a href="#images">Fotoğraflar</a></li>
																<li><a href="#videos"> Videolar </a></li>
															</ul>
															<div class="tab-content">
																<div id="images" class="tab active">							
																	<div class="title-hd-sm">
																		<h4>Fotoğraflar <span>( <?php echo count($film_resimleri) ?> )</span></h4>
																	</div>
																	<div class="mvsingle-item">
														<?php if($film_resimleri){foreach($film_resimleri as $resim){ ?>																											
																		<a class="img-lightbox" data-fancybox-group="gallery" href="<?php echo image_url($resim->image_url, $film_bilgileri->film_sef_link) ?>"><img style="height:120px;" src="<?php echo image_url($resim->image_url, $film_bilgileri->film_sef_link) ?>" alt=""></a>
														<?php }} ?>
																	</div>															
																</div>
																<div id="videos" class="tab">							
																	<div class="title-hd-sm">
																		<h4>Videolar <span> ( <?php echo count($film_videoları) ?> ) </span></h4>
																	</div>
																	<div class="mvsingle-item media-item">
														<?php if($film_videoları){foreach($film_videoları as $video){?>
																		<div class="vd-item">
																			<div class="vd-it">
																				<img class="vd-img" src="<?php echo 'https://img.youtube.com/vi/'. $video->video_url .'/hqdefault.jpg'?>" alt="">
																				<a class="fancybox-media hvr-grow" href="<?php echo 'https://www.youtube.com/embed/'.$video->video_url ?>"><img src="<?php echo base_url('assets/frontend/'); ?>img\play-vd.png" alt=""></a>
																			</div>
																		</div>
														<?php }} ?>
																	</div>															
																</div>
															</div>
														</div>
													
													</div>
												</div>
												<div id="moviesrelated" class="tab">
													<div class="row">
														<h3>Film ile ilgili diğer filmler</h3>
														<h2><?php echo $film_bilgileri->film_ad ?></h2>
											<?php if($ilgili_filmler){?>
														<div class="topbar-filter">
															<p>Toplamda <span><?php echo count($ilgili_filmler) ?></span> adet film bulundu.</p>
														</div>
													
														<div id="movie_paging">	
															<ul class="movie-list">												
													<?php foreach($ilgili_filmler as $film){?>										
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

												<?php }else { ?>
														<p style="text-align:center; font-size:24px;">Malesef <?php echo $film_bilgileri->film_ad ?> filmine benzer bir film bulunamadı.</p>
												<?php } ?>
													</div>
												</div>

											</div>
										</div>
									</div>		
								</div>								
							</div>
						</div>																			
					</div>
<?php $this->load->view('frontend/include/footer');?>				
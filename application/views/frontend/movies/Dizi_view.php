<?php $this->load->view('frontend/include/header');?>
					<div class="col-md-12">
					
						<div style="background: url('<?php if($dizi_bilgileri->dizi_kapak_image){echo image_url($dizi_bilgileri->dizi_kapak_image, $dizi_bilgileri->dizi_sef_link);}else{ echo base_url('assets/uploads/diziler/kapak/no-kapak-image.jpg');} ?>') no-repeat top; background-size: cover;" class="hero sr-single-hero sr-single">
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
											<img src="<?php echo image_url($dizi_bilgileri->dizi_image, $dizi_bilgileri->dizi_sef_link) ?>" alt="<?php echo $dizi_bilgileri->dizi_ad ?>">
										</div>
									</div>	

									<div class="col-md-8 col-sm-12 col-xs-12">
										<div class="movie-single-ct main-content">
											<h1 class="bd-hd"><?php echo $dizi_bilgileri->dizi_ad ?> <span> <?php echo türkçetarihformat('j F Y',$dizi_bilgileri->dizi_release_date). ' - '; if($dizi_bilgileri->dizi_finished_date != "Devam Ediyor."){echo türkçetarihformat('j F Y', $dizi_bilgileri->dizi_finished_date); }else{echo $dizi_bilgileri->dizi_finished_date; }; ?></span></h1>
											<div class="social-btn">
						<?php if($this->session->userdata('durum') == true){ ?>
						<?php if(favorikontrol('dizi', $this->session->userdata('user')->uye_id, $dizi_bilgileri->dizi_id) != true){?>
												<a class="parent-btn" id="add_favourite" onclick="add_favourite(<?php echo $this->session->userdata('user')->uye_id ?>,<?php echo $dizi_bilgileri->dizi_id ?>,'dizi')"><i class="ion-heart"></i> Favorilerine Ekle</a>
												<a style="display:none;" class="parent-btn" id="remove_favourite" onclick="remove_favourite(<?php echo $this->session->userdata('user')->uye_id ?>,<?php echo $dizi_bilgileri->dizi_id ?>,'dizi')"><i class="ion-close"></i> Favorilerinden Kaldır</a>
						<?php }else{ ?>
												<a style="display:none;" class="parent-btn" id="add_favourite" onclick="add_favourite(<?php echo $this->session->userdata('user')->uye_id ?>,<?php echo $dizi_bilgileri->dizi_id ?>,'dizi')"><i class="ion-heart"></i> Favorilerine Ekle</a>
												<a class="parent-btn" id="remove_favourite" onclick="remove_favourite(<?php echo $this->session->userdata('user')->uye_id ?>,<?php echo $dizi_bilgileri->dizi_id ?>,'dizi')"><i class="ion-close"></i> Favorilerinden Kaldır</a>
						<?php }} ?>
												<div class="hover-bnt">
													<a href="#" class="parent-btn"><i class="ion-android-share-alt"></i>Diziyi Paylaş</a>
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
														<span><?php echo $dizi_bilgileri->dizi_puanı ?></span> /10
													</p>
												</div>
												<div class="rate">
													<p>
														<span class="rv">Site Puanı</span><br>
														<span><?php echo site_puanı('dizi', $dizi_bilgileri->dizi_id) ?></span> /10
														<div id="sitepuanı" data-rateyo-rating="<?php echo site_puanı('dizi', $dizi_bilgileri->dizi_id) ?>"></div>
													</p>
												</div>
											</div>
											<div class="movie-btn">	
												<div class="btn-transform transform-vertical red">
													<div><a href="#" class="item item-1 redbtn"> <i class="fab fa-youtube"></i> Trailer İzle</a></div>
													<div><a href="<?php echo 'https://www.youtube.com/embed/'. $dizi_bilgileri->dizi_trailer ?>" class="item item-2 redbtn fancybox-media hvr-grow"><i class="fab fa-youtube fa-2x"></i></a></div>
												</div>
											</div>
											<div class="tabs tabs-border">
												<ul class="tab-links tabs-mv tabs-series">
													<li class="active"><a href="#overview">Dizi Hakkında</a></li>
													<li><a href="#season"> Sezonlar</a></li>
													<li><a href="#reviews"> Yorumlar</a></li>
													<li><a href="#cast">  Dizi Ekibi </a></li>
													<li><a href="#media"> Medya</a></li> 
													<li><a href="#moviesrelated"> İlgili Diziler </a></li>                        
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
															<?php if($dizi_bilgileri->dizi_describe){?>
															<div class="title-hd-sm">
																<h4>Dizi Açıklaması</h4>
															</div>
															<p><?php echo $dizi_bilgileri->dizi_describe ?></p>		
															<?php }else{?>
															<div class="title-hd-sm">
																<h4>Dizi Açıklaması</h4>
															</div>	
															<h2>Dizi açıklaması bulunmamaktadır.</h2>	
															<?php } ?>

															<?php if($dizi_yorumları){ ?>
															<div class="title-hd-sm">
																<h4>Son Yorum</h4>
																<ul class="tab-links">
																	<a href="#reviews" class="time">Tüm yorumları göster (<?php echo count($dizi_yorumları) ?>) <i class="fas fa-eye"></i></a>                      
																</ul>
															</div>
															<!-- movie user review -->
															<div class="mv-user-review-item">
																<ul>
																	<?php if($dizi_yorumları{0}->comment_spoiler == 1){?>
																	<li class="mv-user-review-item spoiler" id="sonyorum<?php echo $dizi_yorumları{0}->yorum_id ?>">
																	<?php }else{?>
																	<li class="mv-user-review-item">
																	<?php } ?>
																		<div class="user-infor">
																			<img src="<?php echo avatar_url(üyeresminial($dizi_yorumları{0}->uye_id)['uye_avatar']) ?>" alt="">
																			<div>
																				<h3><?php echo $dizi_yorumları{0}->comment_title ?></h3>
																				<div class="no-star">
																		<?php for($a = 0; $a < $dizi_yorumları{0}->comment_rate; $a++){?>
																					<i class="ion-android-star"></i>
																		<?php }?>
																		<?php for($a = 0; $a < 10-($dizi_yorumları{0}->comment_rate); $a++){?>
																					<i class="ion-android-star last"></i>
																		<?php }?>
																				</div>
																				<p class="time">
																					<?php echo tarihgeçenzaman($dizi_yorumları{0}->sended_date) ?> <a href="<?php echo base_url('profil/'.$dizi_yorumları{0}->uye_id) ?>"> <?php if(üyeresminial($dizi_yorumları{0}->uye_id)['uye_ad'] && üyeresminial($dizi_yorumları{0}->uye_id)['uye_soyad']){ echo üyeresminial($dizi_yorumları{0}->uye_id)['uye_ad'].' '.üyeresminial($dizi_yorumları{0}->uye_id)['uye_soyad']; }else{ echo üyeresminial($dizi_yorumları{0}->uye_id)['uye_nickname']; } ?></a> tarafından gönderildi.
																				</p>
																			</div>
																		</div>
																		<p class="emoji_comment" style="text-indent:10px;"><?php echo $dizi_yorumları{0}->comment ?></p>
																	<?php if($dizi_yorumları{0}->comment_spoiler == 1){?>
																		<div class="spoiler_message" id="sonspomesaj<?php echo $dizi_yorumları{0}->yorum_id ?>">
																			<a onclick="show_spoiler2(<?php echo $dizi_yorumları{0}->yorum_id ?>)" class="yellowbtn">Bu yorum spoiler içermektedir. Görmek istiyorsanız tıklayınız.</a>
																		</div>
																	<?php } ?>
																	</li>
																</ul>
															</div>
															<?php } ?>


														</div>
														<div class="col-md-3 col-xs-12 col-sm-12">
															<div class="sb-it">
																<h6>Dizi Türü</h6>
																<p>
																<?php foreach(explode(',',$dizi_bilgileri->dizi_türü) as $dizi_türü){?>
																	<a href="#"><?php echo $dizi_türü.'<br>' ?> </a>
																<?php } ?>
																</p>
															</div>
															<div class="sb-it">
																<h6>Dizi Şirketi</h6>
																<p>
																<?php foreach($dizi_şirketi as $dizi_şirketi){?>
																	<a href="" target="_blank"><?php if($dizi_şirketi != null){ echo $dizi_şirketi->company_name .'<br>'; }?> </a>
																<?php } ?>
																</p>
															</div>
															<div class="sb-it">
																<h6>Dizi Çıkış Tarihi</h6>
																<p><?php echo türkçetarihformat('j F Y',$dizi_bilgileri->dizi_release_date) ?></p>
															</div>
															<div class="sb-it">
																<h6>Sezon Sayısı</h6>
																<p><?php echo $dizi_bilgileri->dizi_sezon_sayisi ?></p>
															</div>
															<div class="sb-it">
																<h6>Toplam Bölüm Sayısı</h6>
																<p>
																<?php 
																	$bölümler = bölümlerigrupla($dizi_bilgileri->dizi_id);
																	if($bölümler){
																		echo count($bölümler); 
																	}else{
																		echo "Bölüm Yayınlanmadı.";
																	}
																?>
																</p>
															</div>
															<div class="sb-it">
																<h6>Dizi Ekibi</h6>
																<p>
																<?php if($dizi_ekibi){foreach($dizi_ekibi as $ekip){?>
																	<a href=" " target="_blank"><?php if($ekip != null){echo $ekip->cast_name;} ?> </a>
																<?php }} ?>
																</p>
															</div>
															<div class="sb-it">
																<h6>Dizi Keywords:</h6>
																<p class="tags">
																<?php foreach(explode(',', $dizi_bilgileri->dizi_keywords) as $keyword){ ?>
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
												<div id="season" class="tab">
													<div class="row">
														<div class="rv-hd">
															<div class="div">
																<h3><?php echo $dizi_bilgileri->dizi_ad ?></h3>
																<h2>Yayınlanan Sezonlar</h2>
															</div>
														</div>
														<!-- accordion -->
														<div class="col-12 col-xl-6">
															<div class="accordion" id="accordion">
				<?php if($dizi_bölümleri){foreach($dizi_bölümleri as $dizi_bölümü){?>
																<div class="accordion__card">
																	<div class="card-header" id="sezon<?php echo $dizi_bölümü->season_number ?>">
																		<a type="button" data-toggle="collapse" data-target="#sezon<?php echo $dizi_bölümü->season_number ?>bölümleri" aria-expanded="true" aria-controls="sezon<?php echo $dizi_bölümü->season_number ?>bölümleri">
																			<span>Sezon <?php echo $dizi_bölümü->season_number ?></span>
																			<span><?php echo $dizi_bilgileri->dizi_ad ?></span>
																		</a>
																	</div>
																	<div id="sezon<?php echo $dizi_bölümü->season_number ?>bölümleri" class="collapse" aria-labelledby="sezon<?php echo $dizi_bölümü->season_number ?>" data-parent="#accordion">
																		<div class="card-body">
																			<table class="accordion__list">
																				<thead>
																					<tr>
																						<th>#</th>
																						<th>Adı</th>
																						<th>Imdb Puanı</th>
																						<th>Çıkış Tarihi</th>
																						<th>Süresi</th>
																					</tr>
																				</thead>

																				<tbody>
				<?php 
				$bölümler = bölümlerigrupla($dizi_bilgileri->dizi_id, $dizi_bölümü->season_number);

					foreach($bölümler as $bölüm){
				?>
																					<tr onclick="location.href='<?php echo base_url('izle/dizi/').$bölüm->episode_sef_link ?>'">
																						<th>Bölüm <?php echo $bölüm->episode_number ?></th>
																						<td><?php echo $bölüm->episode_name ?></td>
																						<td><?php echo $bölüm->episode_puan ?></td>
																						<td><?php echo türkçetarihformat('j F Y',$bölüm->episode_release_date) ?></td>
																						<td><?php echo $bölüm->episode_süre ?> dakika</td>
																					</tr>
				<?php }?>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>

				<?php }} else{?>
				<p style="font-size:24px;"> Dizinin hiç sezonu bulunmamaktadır.</p>
				<?php }?>

															</div>
														</div>
														<!-- end accordion -->
													</div>
												</div>												
												<div id="reviews" class="tab review">
												   <div class="row">
														<div class="rv-hd">
															<div class="div">
																<h3>Dizi Hakkındaki Yorum ve Görüşler</h3>
																<h2><?php echo $dizi_bilgileri->dizi_ad ?></h2>
															</div>
														</div>
				<?php if($dizi_yorumları){ ?>
														<div class="topbar-filter">
															<p>Toplamda <span><?php echo count($dizi_yorumları) ?> tane</span> yorum bulundu.</p>
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
													<?php foreach($dizi_yorumları as $dizi_yorum){?>
														<?php if($dizi_yorum->comment_spoiler == 1){?>
														<li class="mv-user-review-item spoiler" id="yorum<?php echo $dizi_yorum->yorum_id ?>">
														<?php }else{?>
														<li class="mv-user-review-item">
														<?php } ?>
															<div class="user-infor">
																<img src="<?php echo avatar_url(üyeresminial($dizi_yorum->uye_id)['uye_avatar']) ?>" alt="">
																<div>
																	<h3><?php echo $dizi_yorum->comment_title ?></h3>
																	<div class="no-star">
															<?php for($a = 0; $a < $dizi_yorum->comment_rate; $a++){?>
																		<i class="ion-android-star"></i>
															<?php }?>
															<?php for($a = 0; $a < 10-($dizi_yorum->comment_rate); $a++){?>
																		<i class="ion-android-star last"></i>
															<?php }?>
																	</div>
																	<p class="time">
																		<?php echo tarihgeçenzaman($dizi_yorum->sended_date) ?> <a href="<?php echo base_url('profil/'.$dizi_yorum->uye_id) ?>"> <?php if(üyeresminial($dizi_yorum->uye_id)['uye_ad'] && üyeresminial($dizi_yorum->uye_id)['uye_soyad']){ echo üyeresminial($dizi_yorum->uye_id)['uye_ad'].' '.üyeresminial($dizi_yorum->uye_id)['uye_soyad']; }else{ echo üyeresminial($dizi_yorum->uye_id)['uye_nickname']; } ?></a> tarafından gönderildi.
																	</p>
																</div>
															</div>
															<p class="emoji_comment" style="text-indent:10px;"><?php echo $dizi_yorum->comment ?></p>
															<?php if($dizi_yorum->comment_spoiler == 1){?>
															<div class="spoiler_message" id="spomesaj<?php echo $dizi_yorum->yorum_id ?>">
																<a onclick="show_spoiler(<?php echo $dizi_yorum->yorum_id ?>)" class="yellowbtn">Bu yorum spoiler içermektedir. Görmek istiyorsanız tıklayınız.</a>
															</div>
															<?php } ?>															
														</li>
													<?php } ?>
													</ul>
												</div>

													<?php }else{ ?>
														<p><h3>Dizi hakkında henüz yorum yapılmamış.</h3></p>
													<?php } ?>
													</div>
												</div>
												<div id="cast" class="tab">
													<div class="row">
														<h3>Dizi Ekibi ve Oyuncuları</h3>
														<h2><?php echo $dizi_bilgileri->dizi_ad ?></h2>

													<?php if($dizi_ekibi){foreach(ekipgrupla($dizi_ekibi) as $key => $ekip){  ?>	
														<div class="title-hd-sm">
															<h4><?php echo $key ?></h4>
														</div>
														<div class="mvcast-item">
														<?php foreach($ekip as $cast){ ?>											
															<div class="col-md-4">
																<div class="ceb-item-style-2">
																	<?php if($ekip != null && $cast->cast_image == null){ $ad_soyad = explode(' ',$cast->cast_name); echo '<h4>'; foreach($ad_soyad as $basharf){ echo $basharf[0];} echo '</h4>';}else{ ?>
																	<img style="height:100px; width:80px;" src="<?php if($cast != null){echo image_url($cast->cast_image);} ?>" alt="">
																	<?php } ?>
																	<div class="ceb-infor">
																		<h2><a href="<?php echo base_url('cast/').$cast->cast_id ?>" target="_blank"><?php if($cast != null){echo yazi_kisalt($cast->cast_name, 19); } ?></a></h2>
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
																<h2><?php echo $dizi_bilgileri->dizi_ad ?></h2>
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
																		<h4>Fotoğraflar <span>( <?php echo count($dizi_resimleri) ?> )</span></h4>
																	</div>
																	<div class="mvsingle-item media-item"> 
							<?php if($dizi_resimleri){foreach($dizi_resimleri as $resim){?>
																		<a class="img-lightbox" style="margin-right:30px;" data-fancybox-group="gallery" href="<?php echo image_url($resim->image_url, $dizi_bilgileri->dizi_sef_link) ?>"><img style="height:120px;" src="<?php echo image_url($resim->image_url, $dizi_bilgileri->dizi_sef_link) ?>" alt=""></a>
							<?php }}?>			
																	</div>															
																</div>
																<div id="videos" class="tab">							
																	<div class="title-hd-sm">
																		<h4>Videolar <span> ( <?php echo count($dizi_videoları) ?> ) </span></h4>
																	</div>
																	<div class="mvsingle-item media-item">
							<?php if($dizi_videoları){foreach($dizi_videoları as $video){?>
																		<div class="vd-item">
																			<div class="vd-it">
																				<img class="vd-img" src="<?php echo 'https://img.youtube.com/vi/'. $video->video_url .'/hqdefault.jpg'?>" alt="">
																				<a class="fancybox-media hvr-grow" href="<?php echo 'https://www.youtube.com/embed/'.$video->video_url ?>"><img src="<?php echo base_url('assets/frontend/'); ?>img\play-vd.png" alt=""></a>
																			</div>
																		</div>
							<?php }}?>
																	</div>															
																</div>
															</div>
														</div>

													</div>
												</div>
												<div id="moviesrelated" class="tab">
													<div class="row">
														<h3>Dizi ile ile ilgili diğer diziler</h3>
														<h2><?php echo $dizi_bilgileri->dizi_ad ?></h2>
				<?php if($ilgili_diziler){ ?>
														<div class="topbar-filter">
															<p>Toplamda <span><?php echo count($ilgili_diziler) ?></span> adet dizi bulundu.</p>
														</div>

														<div id="movie_paging">	
															<ul class="movie-list">												
													<?php foreach($ilgili_diziler as $dizi){?>										
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
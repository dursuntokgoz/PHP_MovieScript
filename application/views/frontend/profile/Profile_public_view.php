
		<div class="col-md-9 col-sm-8 col-xs-12">
			<div class="user-information">			
				<div class="profile-tabs">
					<div class="title-hd">
						<h2><?php echo '@'.$üye_bilgileri->uye_nickname ?> </h2>
					</div>
					<div class="tabs" style="margin:0;">
						<ul class="tab-links tabs-mv" style="padding:0">
							<li class="active"><a href="#member_info">Kişisel Bilgiler</a></li>
							<li><a href="#social_media"> Sosyal Medya </a></li>
							<li><a href="#favourites"> Favorileri </a></li>  
							<li><a href="#comments">Yorumları</a></li>
						</ul>
						<div class="tab-content">
							<div id="member_info" class="tab active">							
								<div class="small-title3">
									<h4> İsmi</h4>
									<p><?php echo $üye_bilgileri->uye_ad ?> <?php echo $üye_bilgileri->uye_soyad ?></p>				
								</div>
								<div class="small-title3">
									<h4> Üyelik Tarihi</h4>
									<p><?php echo türkçetarihformat('j F Y',$üye_bilgileri->uye_kayit_tarihi) ?></p>				
								</div>															
							</div>
							
							<div id="social_media" class="tab">
								<div class="small-title3">
									<h4><i class="fab fa-facebook"></i> Facebook Adresi</h4>
									<p><a target="_blank" href="<?php echo $üye_bilgileri->uye_facebook_url ?>"><?php echo $üye_bilgileri->uye_facebook_url ?></a></p>				
								</div>
								<div class="small-title3">
									<h4><i class="fab fa-twitter"></i> Twitter Adresi</h4>
									<p><a target="_blank" href="<?php echo $üye_bilgileri->uye_twitter_url ?>"><?php echo $üye_bilgileri->uye_twitter_url ?></a></p>				
								</div>
							</div>	
					
							
							<div id="favourites" class="tab">
								<div class="favourite-tabs">
									<div class="tabs" style="margin:0">
										<ul class="tab-links tabs-mv" style="padding:0">
											<li class="active"><a href="#favourite_films">Favori Filmleri</a></li>
											<li><a href="#favourite_movies"> Favori Dizileri</a></li>                     
										</ul>
										<div class="tab-content">
											<div id="favourite_films" class="tab active">
									<?php if($favori_filmler){?>

										<div id="favourite_movie_paging">
											<ul class="movie-list">												
									<?php foreach($favori_filmler as $film){?>										
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
									<?php }else{ ?>	
											<h4 style="text-align: center;font-size: 16px;color: #42e3d0;margin-bottom:20px">Kişinin favori filmi bulunmamaktadır.</h4>
									<?php }?>	
											</div>
											
											<div id="favourite_movies" class="tab">
								<?php if($favori_diziler){?>
-
										<div id="favourite_movie_paging">	
											<ul class="movie-list">		
									<?php foreach($favori_diziler as $dizi){?>										
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
-	
								<?php }else{ ?>	
										<h4 style="text-align: center;font-size: 16px;color: #42e3d0;margin-bottom:20px">Kişinin favori dizisi bulunmamaktadır.</h4>
								<?php }?>
											</div>	
										</div>
									</div>
								</div>
							</div>
							
							<div id="comments" class="tab">
								<div class="last-comments-tabs">
									<div class="tabs" style="margin:0">
										<ul class="tab-links tabs-mv" style="padding:0">
											<li class="active"><a href="#film_comments">Film Yorumları</a></li>
											<li><a href="#movie_comments">Dizi Yorumları</a></li>                     
										</ul>
										<div class="tab-content">
											<div id="film_comments" class="tab active">
												<div class="reviews" id="comment_paging">
													<ul class="reviews__list">
							<?php if($son_yorumlar['son_film_yorumları']){ ?>
							<?php foreach($son_yorumlar['son_film_yorumları'] as $film_yorum){?>
							<?php if($film_yorum->comment_spoiler == 1){?>
														<li class="reviews__item spoiler" id="yorum<?php echo $film_yorum->yorum_id ?>">
							<?php }else{?>
														<li class="reviews__item">
							<?php } ?>
															<div class="reviews__autor">
																<img class="reviews__avatar" style="margin-top:0px;" src="<?php echo avatar_url(üyeresminial($film_yorum->uye_id)['uye_avatar']) ?>" alt="">
																<span class="reviews__name"><?php echo $film_yorum->comment_title ?></span>
																<span class="reviews__time"><a target="_blank" href="<?php echo base_url('filmler/'. $film_yorum->film_sef_link)?>"> <?php echo $film_yorum->film_ad ?></a> <?php echo tarihgeçenzaman($film_yorum->sended_date) ?> gönderildi.</span>
																<span class="reviews__rating"><i class="ion-ios-star"></i><?php echo $film_yorum->comment_rate ?></span>
															</div>

															<p class="reviews__text emoji_comment"><?php echo $film_yorum->comment ?></p>
														<?php if($film_yorum->comment_spoiler == 1){?>
															<div class="spoiler_message" id="spomesaj<?php echo $film_yorum->yorum_id ?>">
																<a onclick="show_spoiler(<?php echo $film_yorum->yorum_id ?>)" class="yellowbtn">Bu yorum spoiler içermektedir. Görmek istiyorsanız tıklayınız.</a>
															</div>
														<?php } ?>															
														</li>
							<?php }}else{ ?>
														<h4 style="text-align:center;">Kişi henüz hiçbir film hakkında yorum yapmamış.</h4>
							<?php } ?>
													</ul>
												</div>
											</div>
											
											<div id="movie_comments" class="tab">
												<div class="reviews" id="comment_paging">
													<ul class="reviews__list">
							<?php if($son_yorumlar['son_dizi_yorumları']){ ?>
							<?php foreach($son_yorumlar['son_dizi_yorumları'] as $dizi_yorum){?>
							<?php if($dizi_yorum->comment_spoiler == 1){?>
														<li class="reviews__item spoiler" id="yorum<?php echo $dizi_yorum->yorum_id ?>">
							<?php }else{?>
														<li class="reviews__item">
							<?php } ?>
															<div class="reviews__autor">
																<img class="reviews__avatar" style="margin-top:0px;" src="<?php echo avatar_url(üyeresminial($dizi_yorum->uye_id)['uye_avatar']) ?>" alt="">
																<span class="reviews__name"><?php echo $dizi_yorum->comment_title ?></span>
																<span class="reviews__time"><a target="_blank" href="<?php echo base_url('diziler/').$dizi_yorum->dizi_sef_link ?>"><?php echo $dizi_yorum->dizi_ad ?></a> <?php echo tarihgeçenzaman($dizi_yorum->sended_date) ?> gönderildi.</span>
																<span class="reviews__rating"><i class="ion-ios-star"></i><?php echo $dizi_yorum->comment_rate ?></span>
															</div>
															<p class="reviews__text emoji_comment"><?php echo $dizi_yorum->comment ?></p>
														<?php if($dizi_yorum->comment_spoiler == 1){?>
															<div class="spoiler_message" id="spomesaj<?php echo $dizi_yorum->yorum_id ?>">
																<a onclick="show_spoiler(<?php echo $dizi_yorum->yorum_id ?>)" class="yellowbtn">Bu yorum spoiler içermektedir. Görmek istiyorsanız tıklayınız.</a>
															</div>
														<?php } ?>															
														</li>							
							<?php }}else{ ?>
														<h4 style="text-align:center;">Kişi henüz hiçbir dizi hakkında yorum yapmamış.</h4>
							<?php } ?>
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


<?php $this->load->view('frontend/include/footer');?>
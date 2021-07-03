<?php $this->load->view('frontend/include/header');?>

				<div class="row">
					<div class="container page-single">	

					<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="title-hd-2">
								<h2>Takvim</h2>
								<h4>Yakında gelecek film ve bölümleri burada görebilirsiniz.</h4>		
							</div>

							<div class="tabs">
								<ul class="tab-links tabs-mv" style="padding:0">
									<li class="active"><a href="#film_calendar">Film Takvimi</a></li>
									<li><a href="#movie_calendar"> Dizi Takvimi </a></li>
								</ul>
								<div class="tab-content">
									<div id="film_calendar" class="tab active">
										<?php foreach($film_takvim as $key => $value){?>
											<div class="calendar">
												<div class="date">
													<i class="fal fa-calendar"></i> 
													<div class="day"><?php echo türkçetarihformat('j F Y', $key) ?></div>
													<div class="duration"> <?php echo tarihkalanzaman($key)?></div>
												</div>

												<div class="activity">
													<ul>
														<?php foreach($value as $val){ ?>
														<li>
															<img src="<?php echo image_url($val['film_image'], $val['film_sef_link']) ?>" alt="">
															<div class="poster-subject">
																<a class="title" href="<?php echo base_url('filmler/').$val['film_sef_link'] ?>"><?php echo $val['film_ad']?></a>
																<p>
																	<div class="cate">
																	<?php foreach(explode(',',$val['film_türü']) as $film_türü){ ?>
																		<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $film_türü ?></a></span>
																	<?php }?>
																	</div>
																</p>
															</div>
														</li>
														<?php } ?>
													</ul>
												</div>
											</div>	
										<?php } ?>
									</div>

									<div id="movie_calendar" class="tab">
										<?php foreach($dizi_takvim as $key => $value){?>
											<div class="calendar">
												<div class="date">
													<i class="fal fa-calendar"></i> 
													<div class="day"><?php echo türkçetarihformat('j F Y', $key) ?></div>
													<div class="duration"> <?php echo tarihkalanzaman($key)?></div>
												</div>

												<div class="activity">
													<ul>
														<?php foreach($value as $val){ ?>
														<li>
															<img src="<?php echo image_url($val['dizi_image'], $val['dizi_sef_link']) ?>" alt="">
															<div class="poster-subject">
																<a class="title" href="<?php echo base_url('diziler/').$val['dizi_sef_link'] ?>"><?php echo $val['dizi_ad']?></a>
																<p>Sezon <?php echo $val['season_number']?> - Bölüm <?php echo $val['episode_number']?></p>
															</div>
														</li>
														<?php } ?>
													</ul>
												</div>
											</div>	
										<?php } ?>
									</div>									
								</div>
							</div>
						</div>	

					</div>	
				</div>


<?php $this->load->view('frontend/include/footer');?>
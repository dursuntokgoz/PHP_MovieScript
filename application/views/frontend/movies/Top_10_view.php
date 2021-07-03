<?php $this->load->view('frontend/include/header');?>

				<div class="row">
					<div class="container page-single">							
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="title-hd-2">
								<h2>Top 10 Filmler</h2>
								<h4>En yüksek puana sahip 10 film</h4>		
							</div>
						<?php if($top_10_filmler){ ?>
							<ul class="movie-list" id="top_10">	
							<?php for($a = 0; $a < 10;$a++){?>
								<li class="movie">
									<?php
										$film_numarası = $a+1;
										switch ($film_numarası){
											case 1: 
												echo '<p style="color:#fff;font-size:18px;font-weight:bold;font-family:Dosis;text-align:left;"><i class="fas fa-trophy" style="color:#ffd700;font-size:24px""></i> #'.$film_numarası.'</p>'; 
											break;
											case 2: 
												echo '<p style="color:#fff;font-size:18px;font-weight:bold;font-family:Dosis;text-align:left;"><i class="fas fa-trophy" style="color:#C0C0C0;font-size:22px""></i> #'.$film_numarası.'</p>'; 
											break;
											case 3: 
												echo '<p style="color:#fff;font-size:18px;font-weight:bold;font-family:Dosis;text-align:left;"><i class="fas fa-trophy" style="color:#b08d57;font-size:20px""></i> #'.$film_numarası.'</p>'; 
											break;												
											
											default: echo '<p style="color:#fff;font-size:18px;font-weight:bold;font-family:Dosis;text-align:left;"> #'.$film_numarası.'</p>'; 
										}
									?>								
									<div class="movie-info">
										<div class="movie-name">
											<?php echo yazi_kisalt($top_10_filmler[$a][0]['film_ad'],30) ?>
										</div>
										<div class="movie-rate">
											<i class="ion-android-star"></i>
											<span><?php echo $top_10_filmler[$a][0]['film_puanı'] ?></span>
										</div>
									</div>
									<div class="movie-image">
										<img src="<?php echo image_url($top_10_filmler[$a][0]['film_kapak_image'], $top_10_filmler[$a][0]['film_sef_link']) ?>" alt="">
									</div>	
									<div class="movie-info">
										<div class="cate">
										<?php foreach(explode(',',$top_10_filmler[$a][0]['film_türü']) as $film_türü){ ?>
											<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $film_türü ?></a></span>
										<?php }?>
										</div>
									</div>
									<div class="movie-inner">
										<a onclick="film_detail(<?php echo $top_10_filmler[$a][0]['film_id'] ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
									</div>
								</li>
							<?php } ?>
							</ul>
						<?php }else{ ?>	
							<p> Sitede 10 adet film bulunmamaktadır.</p>
						<?php } ?>
						</div>	
						
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="title-hd-2">
								<h2>Top 10 Diziler</h2>
								<h4>En yüksek puana sahip 10 dizi</h4>		
							</div>
						<?php if($top_10_diziler){?>	
							<ul class="movie-list" id="top_10">	
							<?php for($a = 0; $a < 10;$a++){?>
								<li class="movie">
									<?php
										$dizi_numarası = $a+1;
										switch ($dizi_numarası){
											case 1: 
												echo '<p style="color:#fff;font-size:18px;font-weight:bold;font-family:Dosis;text-align:left;"><i class="fas fa-trophy" style="color:#ffd700;font-size:24px""></i> #'.$dizi_numarası.'</p>'; 
											break;
											case 2: 
												echo '<p style="color:#fff;font-size:18px;font-weight:bold;font-family:Dosis;text-align:left;"><i class="fas fa-trophy" style="color:#C0C0C0;font-size:22px""></i> #'.$dizi_numarası.'</p>'; 
											break;
											case 3: 
												echo '<p style="color:#fff;font-size:18px;font-weight:bold;font-family:Dosis;text-align:left;"><i class="fas fa-trophy" style="color:#b08d57;font-size:20px""></i> #'.$dizi_numarası.'</p>'; 
											break;												
											
											default: echo '<p style="color:#fff;font-size:18px;font-weight:bold;font-family:Dosis;text-align:left;"> #'.$dizi_numarası.'</p>'; 
										}
									?>								
									<div class="movie-info">
										<div class="movie-name">
											<?php echo yazi_kisalt($top_10_diziler[$a][0]['dizi_ad'],30) ?>
										</div>
										<div class="movie-rate">
											<i class="ion-android-star"></i>
											<span><?php echo $top_10_diziler[$a][0]['dizi_puanı'] ?></span>
										</div>
									</div>
									<div class="movie-image">
										<img src="<?php echo image_url($top_10_diziler[$a][0]['dizi_kapak_image'], $top_10_diziler[$a][0]['dizi_sef_link']) ?>" alt="">
									</div>	
									<div class="movie-info">
										<div class="cate">
										<?php foreach(explode(',',$top_10_diziler[$a][0]['dizi_türü']) as $dizi_türü){ ?>
											<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $dizi_türü ?></a></span>
										<?php }?>
										</div>
									</div>
									<div class="movie-inner">
										<a onclick="movie_detail(<?php echo $top_10_diziler[$a][0]['dizi_id'] ?>)"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>
									</div>
								</li>
							<?php } ?>
							</ul>
						<?php }else{ ?>	
							<p> Sitede 10 adet dizi bulunmamaktadır.</p>
						<?php } ?>
						</div>					

					</div>	
				</div>


<?php $this->load->view('frontend/include/footer');?>
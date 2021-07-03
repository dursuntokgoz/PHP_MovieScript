<?php $this->load->view('frontend/include/header');?>

				<div class="row">
					<div class="container page-single">	

					<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="title-hd-2">
								<h2>Haftanın Trendleri</h2>
								<h4>Bu hafta en çok izlenenler</h4>		
							</div>

							<div class="tabs">
								<ul class="tab-links tabs-mv" style="padding:0">
									<li class="active"><a href="#week_trend_films">Filmler</a></li>
									<li><a href="#week_trend_movies"> Diziler </a></li>
								</ul>
								<div class="tab-content">
									<div id="week_trend_films" class="tab active">
										<table class="trends_table">
											<thead>
												<tr>
													<th class="rank">#</th>
													<th class="poster"></th>
													<th class="details"> Detaylar</th>
													<th class="imdb_puanı"> IMDB Puanı</th>
													<th class="site_puanı"> Site Puanı</th>
													<th class="showed">Görüntülenme</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($haftalık_trend_filmler as $order => $film){?>
												<tr>
													<td class="rank">
														<?php 
															$sıra = $order+1;
															switch ($sıra) {
																case 1:
																	echo "<div style='color:#ffd700'>#".$sıra."</div>";
																	echo "<i style='color:#ffd700' class='fal fa-medal'></i>";
																	break;
																case 2:
																	echo "<div style='color:#C0C0C0'>#".$sıra."</div>";
																	echo "<i style='color:#C0C0C0' class='fal fa-medal'></i>";
																	break;
																case 3:
																	echo "<div style='color:#b08d57'>#".$sıra."</div>";
																	echo "<i style='color:#b08d57' class='fal fa-medal'></i>";
																	break;
																
																default:
																	echo "<div>#".$sıra."</div>";
																	break;
															}
														?>
													</td>
													<td class="poster"><img src="<?php echo image_url($film->film_image, $film->film_sef_link)?>" alt=""></td>
													<td class="details">
														<a class="movie_name" onclick="film_detail(<?php echo $film->film_id ?>)"> <?php echo $film->film_ad ?></a>
														<div class="cate movie-type">
														<?php foreach(explode(',',$film->film_türü) as $film_türü){ ?>
															<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $film_türü ?></a></span>
														<?php }?>
														</div>	
													</td>
													<td class="imdb_puanı"><div><?php echo $film->film_puanı ?></div><i class="fal fa-stars"></i></td>
													<td class="site_puanı"><div><?php echo site_puanı('film', $film->film_id) ?></div> <i class="fal fa-heart-rate"></i></td>
													<td class="showed"><div><?php echo $film->week_views ?></div><i class="fal fa-users"></i></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>									
									</div>

									<div id="week_trend_movies" class="tab">
										<table class="trends_table">
											<thead>
												<tr>
													<th class="rank">#</th>
													<th class="poster"></th>
													<th class="details"> Detaylar</th>
													<th class="imdb_puanı"> IMDB Puanı</th>
													<th class="site_puanı"> Site Puanı</th>
													<th class="showed">Görüntülenme</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($haftalık_trend_diziler as $order => $dizi){?>
												<tr>
													<td class="rank">
														<?php 
															$sıra = $order+1;
															switch ($sıra) {
																case 1:
																	echo "<div style='color:#ffd700'>#".$sıra."</div>";
																	echo "<i style='color:#ffd700' class='fal fa-medal'></i>";
																	break;
																case 2:
																	echo "<div style='color:#C0C0C0'>#".$sıra."</div>";
																	echo "<i style='color:#C0C0C0' class='fal fa-medal'></i>";
																	break;
																case 3:
																	echo "<div style='color:#b08d57'>#".$sıra."</div>";
																	echo "<i style='color:#b08d57' class='fal fa-medal'></i>";
																	break;
																
																default:
																	echo "<div>#".$sıra."</div>";
																	break;
															}
														?>
													</td>
													<td class="poster"><img src="<?php echo image_url($dizi->dizi_image, $dizi->dizi_sef_link)?>" alt=""></td>
													<td class="details">
														<a class="movie_name" onclick="movie_detail(<?php echo $dizi->dizi_id ?>)"> <?php echo $dizi->dizi_ad ?></a>
														<div class="cate movie-type">
														<?php foreach(explode(',',$dizi->dizi_türü) as $dizi_türü){ ?>
															<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $dizi_türü ?></a></span>
														<?php }?>
														</div>	
													</td>
													<td class="imdb_puanı"><div><?php echo $dizi->dizi_puanı ?></div><i class="fal fa-stars"></i></td>
													<td class="site_puanı"><div><?php echo site_puanı('film', $dizi->dizi_id) ?></div> <i class="fal fa-heart-rate"></i></td>
													<td class="showed"><div><?php echo $dizi->week_views ?></div><i class="fal fa-users"></i></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>			
									</div>									
								</div>
							</div>
						</div>	


						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="title-hd-2">
								<h2>Tüm Zamanların Trendleri</h2>
								<h4>En çok izlenenler</h4>		
							</div>

							<div class="tabs">
								<ul class="tab-links tabs-mv" style="padding:0">
									<li class="active"><a href="#trend_films">Filmler</a></li>
									<li><a href="#trend_movies"> Diziler </a></li>
								</ul>
								<div class="tab-content">
									<div id="trend_films" class="tab active">
										<table class="trends_table">
											<thead>
												<tr>
													<th class="rank">#</th>
													<th class="poster"></th>
													<th class="details"> Detaylar</th>
													<th class="imdb_puanı"> IMDB Puanı</th>
													<th class="site_puanı"> Site Puanı</th>
													<th class="showed">Görüntülenme</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($tüm_zamanların_trend_filmleri as $order => $film){?>
												<tr>
													<td class="rank">
														<?php 
															$sıra = $order+1;
															switch ($sıra) {
																case 1:
																	echo "<div style='color:#ffd700'>#".$sıra."</div>";
																	echo "<i style='color:#ffd700' class='fal fa-medal'></i>";
																	break;
																case 2:
																	echo "<div style='color:#C0C0C0'>#".$sıra."</div>";
																	echo "<i style='color:#C0C0C0' class='fal fa-medal'></i>";
																	break;
																case 3:
																	echo "<div style='color:#b08d57'>#".$sıra."</div>";
																	echo "<i style='color:#b08d57' class='fal fa-medal'></i>";
																	break;
																
																default:
																	echo "<div>#".$sıra."</div>";
																	break;
															}
														?>
													</td>
													<td class="poster"><img src="<?php echo image_url($film->film_image, $film->film_sef_link)?>" alt=""></td>
													<td class="details">
														<a class="movie_name" onclick="film_detail(<?php echo $film->film_id ?>)"> <?php echo $film->film_ad ?></a>
														<div class="cate movie-type">
														<?php foreach(explode(',',$film->film_türü) as $film_türü){ ?>
															<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $film_türü ?></a></span>
														<?php }?>
														</div>	
													</td>
													<td class="imdb_puanı"><div><?php echo $film->film_puanı ?></div><i class="fal fa-stars"></i></td>
													<td class="site_puanı"><div><?php echo site_puanı('film', $film->film_id) ?></div> <i class="fal fa-heart-rate"></i></td>
													<td class="showed"><div><?php echo $film->total_views ?></div><i class="fal fa-users"></i></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>									
									</div>

									<div id="trend_movies" class="tab">
										<table class="trends_table">
											<thead>
												<tr>
													<th class="rank">#</th>
													<th class="poster"></th>
													<th class="details"> Detaylar</th>
													<th class="imdb_puanı"> IMDB Puanı</th>
													<th class="site_puanı"> Site Puanı</th>
													<th class="showed">Görüntülenme</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach($tüm_zamanların_trend_dizileri as $order => $dizi){?>
												<tr>
													<td class="rank">
														<?php 
															$sıra = $order+1;
															switch ($sıra) {
																case 1:
																	echo "<div style='color:#ffd700'>#".$sıra."</div>";
																	echo "<i style='color:#ffd700' class='fal fa-medal'></i>";
																	break;
																case 2:
																	echo "<div style='color:#C0C0C0'>#".$sıra."</div>";
																	echo "<i style='color:#C0C0C0' class='fal fa-medal'></i>";
																	break;
																case 3:
																	echo "<div style='color:#b08d57'>#".$sıra."</div>";
																	echo "<i style='color:#b08d57' class='fal fa-medal'></i>";
																	break;
																
																default:
																	echo "<div>#".$sıra."</div>";
																	break;
															}
														?>
													</td>
													<td class="poster"><img src="<?php echo image_url($dizi->dizi_image, $dizi->dizi_sef_link)?>" alt=""></td>
													<td class="details">
														<a class="movie_name" onclick="movie_detail(<?php echo $dizi->dizi_id ?>)"> <?php echo $dizi->dizi_ad ?></a>
														<div class="cate movie-type">
														<?php foreach(explode(',',$dizi->dizi_türü) as $dizi_türü){ ?>
															<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $dizi_türü ?></a></span>
														<?php }?>
														</div>	
													</td>
													<td class="imdb_puanı"><div><?php echo $dizi->dizi_puanı ?></div><i class="fal fa-stars"></i></td>
													<td class="site_puanı"><div><?php echo site_puanı('film', $dizi->dizi_id) ?></div> <i class="fal fa-heart-rate"></i></td>
													<td class="showed"><div><?php echo $dizi->total_views ?></div><i class="fal fa-users"></i></td>
												</tr>
											<?php } ?>
											</tbody>
										</table>			
									</div>									
								</div>
							</div>
						</div>	
						
					

					</div>	
				</div>


<?php $this->load->view('frontend/include/footer');?>
<?php $this->load->view('frontend/include/header');?>
					<div class="row">
                        <div class="col-md-12">            

							<div class="page-single movie_list">								
								<div class="row ipad-width2">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="title-hd-2">
											<h2>TV Dizileri</h2>
											<h4>Sitedeki diziler</h4>		
										</div>
								<?php if($diziler){?>
										<div class="topbar-filter">
											<p>Sitede <span> <?php echo $dizi_count?> </span> adet dizi bulunmaktadır.</p>
											<form id="movie-filter" method="post" action="<?php echo current_url()?>">
												<select name="filter_type" id="filter" onchange="form.submit()">
													<option value=""><?php if($this->input->post('filter_type')){ echo $this->input->post('filter_type');}else{ echo '&#xf0b0; Filtrele';}?></option>
													<option value="Alfabetik [A-Z]">&#xf15d; Alfabetik [A-Z]</option>
													<option value="Alfabetik [Z-A]">&#xf15e; Alfabetik [Z-A]</option>
													<option value="IMDB Puanı [Yüksek]"> &#xf162; IMDB Puanı [Yüksek]</option>
													<option value="IMDB Puanı [Düşük]"> &#xf163; IMDB Puanı [Düşük]</option>
													<option value="Çıkış Tarihi [Yeni]"> &#xf160; Çıkış Tarihi [Yeni]</option>
													<option value="Çıkış Tarihi [Eski]"> &#xf161; Çıkış Tarihi [Eski]</option>													
												</select>
											</form>
										</div>
										
										<div id="movie_paging">	
											<ul class="movie-list">		
									<?php foreach($diziler as $dizi){?>										
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
									<p style="text-align:center; font-size:24px;">Malesef sitede hiç dizi bulunmamaktadır.</p>
								<?php } ?>
												
									</div>
								</div>								
							</div>
<?php $this->load->view('frontend/include/footer');?>					
<?php $this->load->view('frontend/include/header');?>

<div class="row" id="main-container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="title-hd">
			<h2><?php echo $dizi_bilgileri->dizi_ad . " - Sezon ". $dizi_bölüm_bilgileri->season_number . " - Bölüm " . $dizi_bölüm_bilgileri->episode_number; if($dizi_bölüm_bilgileri->episode_durum != "Normal Bölüm"){ echo " [".$dizi_bölüm_bilgileri->episode_durum."]";} ?></h2>
			<a href="<?php echo base_url('diziler/'). $dizi_bilgileri->dizi_sef_link ?>" class="viewall">Dizi Detayları<i class="fas fa-info-circle"></i></a>
		</div>
		<div class="title-hd">
			<h3><?php echo $dizi_bölüm_bilgileri->episode_name ?></h3>
			<div>
			<?php if(isset(prevandnextepisode($dizi_bölüm_bilgileri)["prev"])){?>
				<a href="<?php echo base_url('izle/dizi/').prevandnextepisode($dizi_bölüm_bilgileri)["prev"] ?>" class="viewall"> <i class="fal fa-arrow-circle-left"></i> Önceki Bölüm</a>
			<?php } ?>
			<?php if(isset(prevandnextepisode($dizi_bölüm_bilgileri)["next"])){?>
				<a href="<?php echo base_url('izle/dizi/').prevandnextepisode($dizi_bölüm_bilgileri)["next"] ?>" class="viewall"> Sonraki Bölüm <i class="fal fa-arrow-circle-right"></i></a>
			<?php } ?>
			</div>
		</div>		

<?php if(kaynaklinkleri($dizi_bilgileri->dizi_id, $dizi_bölüm_bilgileri->episode_id)){ ?>
		<div class="source_tabs">
			<ul class="source_tabs_links source_tabs_mv">
		<?php foreach(kaynakgrupla(kaynaklinkleri($dizi_bilgileri->dizi_id, $dizi_bölüm_bilgileri->episode_id)) as $key1 => $value){ ?>		
				<li><a href="#<?php echo $key1;?>"><?php echo $key1; ?></a></li>    
		<?php } ?>			
			</ul>
		</div>

		<div class="source_tabs">
			<div class="tab-content">
<?php foreach(kaynakgrupla(kaynaklinkleri($dizi_bilgileri->dizi_id, $dizi_bölüm_bilgileri->episode_id)) as $key1 => $value){ ?>
				<div id="<?php echo $key1 ?>" class="tab">			
					<ul id="sources">
			<?php foreach($value as $key => $val){ ?>
						<li onclick='initializePlayer(<?php echo json_encode('bölüm,'. $dizi_bölüm_bilgileri->episode_id. ',' .$key1. ',' . $key) ?>)'>						
							<a><?php echo $key ?></a>
						</li>
			<?php } ?>
					</ul>
				</div>
<?php } ?>					
			</div>			
		</div>
		<center style="width:90%;margin: 20px auto;" ><div id="player"></div></center>
<?php }else{ ?>
		<div class="error_message">
			<h4><i class="fas fa-frown"></i> Üzgünüz !</h4>
			<p> Bu bölüme ait kaynak linki bulunmamaktadır.</p>
		</div>
<?php }?>


	</div>	
	

	<div class="row movie-info">
		<div class="col-md-4 col-sm-4 col-xs-12 movie-img" style="">
			<img src="<?php echo image_url($dizi_bölüm_bilgileri->episode_image, $dizi_bilgileri->dizi_sef_link) ?>" alt="<?php echo $dizi_bölüm_bilgileri->episode_name ?>">

			<div class="small-title1">
				<h4>Dizi Türü</h4>
				<div class="cate movie-type">
				<?php foreach(explode(',',$dizi_bilgileri->dizi_türü) as $dizi_türü){ ?>
					<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $dizi_türü ?></a></span>
				<?php }?>
				</div>					
			</div>			
			<div class="small-title1">
				<h4>Bölüm IMDB Puanı</h4>
				<div class="movie-imdb-point">
					<p><i class="ion-android-star"></i><span><?php echo $dizi_bölüm_bilgileri->episode_puan ?></span>/10</p>
				</div>
			</div>		
			<div class="small-title1">
				<h4>Bölüm Süresi</h4>
				<div class="movie-duration">
					<p><i class="fal fa-hourglass-end"></i><span><?php echo $dizi_bölüm_bilgileri->episode_süre ?></span> dakika</p>
				</div>
			</div>		
			<div class="small-title1">
				<h4>Bölüm Yayınlanma Tarihi</h4>
				<div class="movie-release-date">
					<p><i class="fal fa-calendar"></i><span><?php echo türkçetarihformat('j F Y',$dizi_bölüm_bilgileri->episode_release_date) ?></span></p>
				</div>
			</div>	
		</div>
		<div class="col-md-8 col-sm-8 col-xs-12 movie-detail">	
			<div class="small-title2">
				<h4>Genel Bakış</h4>
				<p><?php echo $dizi_bölüm_bilgileri->episode_describe ?></p>	
			</div>	
			<div class="small-title2">
				<h4>Diğer Bölümler</h4>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="accordion" id="accordion">
<?php if($dizi_bölümleri){foreach($dizi_bölümleri as $dizi_bölümü){?>
						<div class="accordion__card">
							<div class="card-header" id="sezon<?php echo $dizi_bölümü->season_number ?>">
								<a type="button" data-toggle="collapse" data-target="#sezon<?php echo $dizi_bölümü->season_number ?>bölümleri" aria-expanded="true" aria-controls="sezon<?php echo $dizi_bölümü->season_number ?>bölümleri">
									<span>Sezon <?php echo $dizi_bölümü->season_number ?></span>
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
		
				
	</div>
	<div class="row movie-comments">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="small-title2">
				<h4>Bölüm Yorumları</h4>		
<?php if($this->session->userdata('durum') == true) {?>
					<div class="comment-form">
						<form id="add_comment" class="form-style-1">
							<div class="row">
								<div class="col-md-12 form-it">
									<div class="pos_rel">
										<label>Bölüme Puan Veriniz</label>
										<div id="movie_rating"></div>
										<div class="counter"></div>
										<input type="hidden" name="movie_rate" required="required">
									</div>
									<label>Yorum Başlığı Giriniz</label>
									<input type="text" name="comment_title" placeholder="Yorumunuzun başlığını giriniz." required="required">
									<label>Bölüm Hakkındaki Yorumunuz</label>
									<textarea id="comment" name="comment" placeholder="Bölüm Hakkındaki Yorumunuz" required="required"></textarea>	
									<label class="spoilerlabel">Yorumun spoiler içeriyorsa işaretleyin.
									  <input type="checkbox" name="spoiler" value="1">
									  <span class="checkmark"></span>
									</label>	
									<input type="hidden" name="type" value="dizi">
									<input type="hidden" name="movie_id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
									<input type="hidden" name="episode_id" value="<?php echo $dizi_bölüm_bilgileri->episode_id ?>">
									<input type="hidden" name="uye_id" value="<?php echo $this->session->userdata('user')->uye_id ?>">
								</div>

							</div>
								<input class="submit" type="submit" placeholder="submit">
						</form>
					</div>
<?php }else {?>
					<div class="comment-form">
						<p> Yorum yazabilmek için giriş yapmanız gerekmektedir.</p>
						<div class="movie-btn">	
							<span class="btn-transform transform-vertical">
								<div><a class="item item-1 redbtn loginbtn"><i class="fal fa-sign-in"></i>Giriş Yap</a></div>
								<div><a class="item item-2 redbtn loginbtn"><i class="fal fa-sign-in"></i></a></div>
							</span>
						</div>
					</div>
<?php }?>

					<div class="reviews">
						<ul class="reviews__list">
<?php if($dizi_yorumları){ ?>
							<h4 style="margin-bottom:40px;">Toplamda bölüm hakkında (<?php echo count($dizi_yorumları); ?>) adet yorum var.</h4>
<?php foreach($dizi_yorumları as $dizi_yorum){?>
<?php if($dizi_yorum->comment_spoiler == 1){?>
							<li class="reviews__item spoiler" id="yorum<?php echo $dizi_yorum->yorum_id ?>">
<?php }else{?>
							<li class="reviews__item">
<?php } ?>
								<div class="reviews__autor">
									<img class="reviews__avatar" style="margin-top:0px;" src="<?php echo avatar_url(üyeresminial($dizi_yorum->uye_id)['uye_avatar']) ?>" alt="">
									<span class="reviews__name"><?php echo $dizi_yorum->comment_title ?></span>
									<span class="reviews__time"><a href="<?php echo base_url('profil/'.$dizi_yorum->uye_id) ?>"><?php if(üyeresminial($dizi_yorum->uye_id)['uye_ad'] && üyeresminial($dizi_yorum->uye_id)['uye_soyad']){ echo üyeresminial($dizi_yorum->uye_id)['uye_ad'].' '.üyeresminial($dizi_yorum->uye_id)['uye_soyad']; }else{ echo üyeresminial($dizi_yorum->uye_id)['uye_nickname']; } ?></a> tarafından <?php echo tarihgeçenzaman($dizi_yorum->sended_date) ?> gönderildi.</span>
									<span class="reviews__rating"><i class="ion-ios-star"></i><?php echo $dizi_yorum->comment_rate ?></span>
								</div>
								<p class="emoji_comment" class="reviews__text"><?php echo $dizi_yorum->comment ?></p>
							<?php if($dizi_yorum->comment_spoiler == 1){?>
								<div class="spoiler_message" id="spomesaj<?php echo $dizi_yorum->yorum_id ?>">
									<a onclick="show_spoiler(<?php echo $dizi_yorum->yorum_id ?>)" class="yellowbtn">Bu yorum spoiler içermektedir. Görmek istiyorsanız tıklayınız.</a>
								</div>
							<?php } ?>									
							</li>
<?php }}else{ ?>
							<h4 style="text-align:center;" >Henüz Bölüm Hakkında Yorum Bulunmamaktadır.</h4>
<?php } ?>
						</ul>
					</div>			
			</div>			
		</div>
	</div>
</div>
<script>
var movie_name = "<?php echo $dizi_bilgileri->dizi_ad ?>";
var movie_kapak_image = "<?php echo image_url($dizi_bilgileri->dizi_kapak_image, $dizi_bilgileri->dizi_sef_link)?>";
var movie_describe = "<?php echo $dizi_bölüm_bilgileri->episode_describe ?>";
</script>
<?php $this->load->view('frontend/include/footer');?>				
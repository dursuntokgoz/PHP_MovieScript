<?php $this->load->view('frontend/include/header');?>

<div class="row" id="main-container">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="title-hd">
			<h2><?php echo $film_bilgileri->film_ad ?></h2>
			<a href="<?php echo base_url('filmler/'). $film_bilgileri->film_sef_link ?>" class="viewall">Film Detayları<i class="fas fa-info-circle"></i></a>
		</div>	
<?php if(kaynaklinkleri($film_bilgileri->film_id)){ ?>
		<div class="source_tabs">
			<ul class="source_tabs_links source_tabs_mv">
		<?php foreach(kaynakgrupla(kaynaklinkleri($film_bilgileri->film_id)) as $key1 => $value){ ?>		
				<li><a href="#<?php echo $key1;?>"><?php echo $key1; ?></a></li>    
		<?php } ?>			
			</ul>
		</div>

		<div class="source_tabs">
			<div class="tab-content">
<?php foreach(kaynakgrupla(kaynaklinkleri($film_bilgileri->film_id)) as $key1 => $value){ ?>
				<div id="<?php echo $key1 ?>" class="tab">			
					<ul id="sources">
			<?php foreach($value as $key => $val){ ?>
						<li onclick='initializePlayer(<?php echo json_encode('film,'. $film_bilgileri->film_id. ',' .$key1. ',' . $key) ?>)'>						
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
			<p> Bu filme ait kaynak linki bulunmamaktadır.</p>
		</div>
<?php }?>

	</div>	
	<div class="row movie-info">
		<div class="col-md-9 col-sm-9 col-xs-12 movie-detail">	
			<div class="small-title1">
				<h4>Film Türü</h4>
				<div class="cate movie-type">
				<?php foreach(explode(',',$film_bilgileri->film_türü) as $film_türü){ ?>
					<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $film_türü ?></a></span>
				<?php }?>
				</div>					
			</div>			
			<div class="small-title1">
				<h4>IMDB Puanı</h4>
				<div class="movie-imdb-point">
					<p><i class="ion-android-star"></i><span><?php echo $film_bilgileri->film_puanı ?></span>/10</p>
				</div>
			</div>		
			<div class="small-title1">
				<h4>Film Süresi</h4>
				<div class="movie-duration">
					<p><i class="fal fa-hourglass-end"></i><span><?php echo $film_bilgileri->film_süresi ?></span> dakika</p>
				</div>
			</div>		
			<div class="small-title1">
				<h4>Film Yayınlanma Tarihi</h4>
				<div class="movie-release-date">
					<p><i class="fal fa-calendar"></i><span><?php echo türkçetarihformat('j F Y',$film_bilgileri->film_release_date) ?></span></p>
				</div>
			</div>				
			<div class="small-title2">
				<h4>Genel Bakış</h4>
				<p><?php echo $film_bilgileri->film_describe ?></p>	
			</div>		
		</div>
		<div class="col-md-3 col-sm-3 col-xs-12 movie-img">
			<img src="<?php echo image_url($film_bilgileri->film_image, $film_bilgileri->film_sef_link) ?>" alt="<?php echo $film_bilgileri->film_ad ?>">
		</div>		
	</div>
	<div class="row movie-comments">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="small-title2">
				<h4>Film Yorumları</h4>		
<?php if($this->session->userdata('durum') == true) {?>
					<div class="comment-form">
						<form id="add_comment" class="form-style-1">
							<div class="row">
								<div class="col-md-12 form-it">
									<div class="pos_rel">
										<label>Filme Puan Veriniz</label>
										<div id="movie_rating"></div>
										<div class="counter"></div>
										<input type="hidden" name="movie_rate">
									</div>									
									<label>Yorum Başlığı Giriniz</label>
									<input type="text" name="comment_title" placeholder="Yorumunuzun başlığını giriniz." required="required">
									<label>Film Hakkındaki Yorumunuz</label>
									<textarea id="comment" name="comment" placeholder="Film Hakkındaki Yorumunuz" required="required"></textarea>
									<label class="spoilerlabel">Yorumun spoiler içeriyorsa işaretleyin.
									  <input type="checkbox" name="spoiler" value="1">
									  <span class="checkmark"></span>
									</label>
									<input type="hidden" name="type" value="film">
									<input type="hidden" name="movie_id" value="<?php echo $film_bilgileri->film_id ?>">
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
<?php if($film_yorumları){ ?>
							<h4 style="margin-bottom:40px;">Toplamda film hakkında (<?php echo count($film_yorumları); ?>) adet yorum var.</h4>
<?php foreach($film_yorumları as $film_yorum){?>
<?php if($film_yorum->comment_spoiler == 1){?>

							<li class="reviews__item spoiler" id="yorum<?php echo $film_yorum->yorum_id ?>">
<?php }else{?>
							<li class="reviews__item">
<?php } ?>
								<div class="reviews__autor">
									<img class="reviews__avatar" style="margin-top:0px;" src="<?php echo avatar_url(üyeresminial($film_yorum->uye_id)['uye_avatar']) ?>" alt="">
									<span class="reviews__name"><?php echo $film_yorum->comment_title ?></span>
									<span class="reviews__time"><a href="<?php echo base_url('profil/'.$film_yorum->uye_id)?>"><?php if(üyeresminial($film_yorum->uye_id)['uye_ad'] && üyeresminial($film_yorum->uye_id)['uye_soyad']){ echo üyeresminial($film_yorum->uye_id)['uye_ad'].' '.üyeresminial($film_yorum->uye_id)['uye_soyad']; }else{ echo üyeresminial($film_yorum->uye_id)['uye_nickname']; } ?></a> tarafından <?php echo tarihgeçenzaman($film_yorum->sended_date) ?> gönderildi.</span>
									<span class="reviews__rating"><i class="ion-ios-star"></i><?php echo $film_yorum->comment_rate ?></span>
								</div>

								<p class="emoji_comment" class="reviews__text"><?php echo $film_yorum->comment ?></p>
							<?php if($film_yorum->comment_spoiler == 1){?>
								<div class="spoiler_message" id="spomesaj<?php echo $film_yorum->yorum_id ?>">
									<a onclick="show_spoiler(<?php echo $film_yorum->yorum_id ?>)" class="yellowbtn">Bu yorum spoiler içermektedir. Görmek istiyorsanız tıklayınız.</a>
								</div>
							<?php } ?>								
							</li>
<?php }}else{ ?>
							<h4 style="text-align:center;" >Henüz Film Hakkında Yorum Bulunmamakatadır.</h4>
<?php } ?>
						</ul>
					</div>				
			</div>			
		</div>
	</div>
</div>

<script>
var movie_name = "<?php echo $film_bilgileri->film_ad ?>";
var movie_kapak_image = "<?php echo image_url($film_bilgileri->film_kapak_image, $film_bilgileri->film_sef_link)?>";
var movie_describe = "<?php echo $film_bilgileri->film_describe ?>";
</script>
<?php $this->load->view('frontend/include/footer');?>				
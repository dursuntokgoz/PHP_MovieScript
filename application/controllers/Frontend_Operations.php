<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Operations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_Operations_model');
		$this->load->model('Frontend_Operations_model');
		$this->load->model('Pagination_and_Filter_model');
	}

	public function post($type){
		if($type == 'kaynak'){
			$kaynak = $this->Frontend_Operations_model->print_source($this->input->post('movie_type'),$this->input->post('movie_id'),$this->input->post('source_type'),$this->input->post('source_name'));
			
			echo json_encode($kaynak);
		}
		elseif($type == 'filter'){
			if($this->input->post('filter_type') == 'film'){

				$filmaramasonuçları = $this->Pagination_and_Filter_model->filmfiltrele($this->input->post('movie_genre'), $this->input->post('movie_imdb'), $this->input->post('movie_year'));

				if($filmaramasonuçları){
					echo		'<ul class="movie-list">';											
							foreach($filmaramasonuçları as $film){										
					echo			'<li class="movie" onclick="film_detail('.$film->film_id.')">';
					echo				'<div class="movie-info">';
					echo					'<div class="movie-name">';
					echo						yazi_kisalt($film->film_ad, 30);
					echo					'</div>';
					echo					'<div class="movie-rate">';
					echo						'<i class="ion-android-star"></i>';
					echo						'<span>'.$film->film_puanı.'</span>';
					echo					'</div>';
					echo				'</div>';
					echo				'<div class="movie-image">';
					echo					'<img src="'.image_url($film->film_kapak_image, $film->film_sef_link).'" alt="">';
					echo				'</div>';
					echo				'<div class="movie-info">';
			
					echo 				"<div class='cate'>";
										foreach(explode(',',$film->film_türü) as $film_türü){
											$renk = array('blue','green','orange'); $key = array_rand($renk, 1); 
					echo 					"<span class='". $renk[$key]."'>";
					echo 					"<a href='#'>". $film_türü . "</a>";
					echo 					"</span>";
										}			
					echo 				"</div>";	

					echo				'</div>';
					echo				'<div class="movie-inner">';
					echo					'<a onclick="film_detail('.$film->film_id.')"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>';
					echo				'</div>';												
					echo			'</li>';									
							}
					echo		'</ul>';			
				}else{
					echo "<p style='font-size:20px;color:#fff;text-align:center'>Maalesef aradığınız kriterlere uygun bir film bulunamadı.</p>";
				}

				
			}elseif($this->input->post('filter_type') == 'dizi'){

				$diziaramasonuçları = $this->Pagination_and_Filter_model->dizifiltrele($this->input->post('movie_genre'), $this->input->post('movie_imdb'), $this->input->post('movie_year'));

				if($diziaramasonuçları){
					echo		'<ul class="movie-list">';											
							foreach($diziaramasonuçları as $dizi){										
					echo			'<li class="movie" onclick="movie_detail('.$dizi->dizi_id.')">';
					echo				'<div class="movie-info">';
					echo					'<div class="movie-name">';
					echo						yazi_kisalt($dizi->dizi_ad, 30);
					echo					'</div>';
					echo					'<div class="movie-rate">';
					echo						'<i class="ion-android-star"></i>';
					echo						'<span>'.$dizi->dizi_puanı.'</span>';
					echo					'</div>';
					echo				'</div>';
					echo				'<div class="movie-image">';
					echo					'<img src="'.image_url($dizi->dizi_kapak_image, $dizi->dizi_sef_link).'" alt="">';
					echo				'</div>';
					echo				'<div class="movie-info">';
			
					echo 				"<div class='cate'>";
										foreach(explode(',',$dizi->dizi_türü) as $dizi_türü){
											$renk = array('blue','green','orange'); $key = array_rand($renk, 1); 
					echo 					"<span class='". $renk[$key]."'>";
					echo 					"<a href='#'>". $dizi_türü . "</a>";
					echo 					"</span>";
										}			
					echo 				"</div>";	

					echo				'</div>';
					echo				'<div class="movie-inner">';
					echo					'<a onclick="movie_detail('.$dizi->dizi_id.')"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>';
					echo				'</div>';												
					echo			'</li>';									
							}
					echo		'</ul>';			
				}else{
					echo "<p style='font-size:20px;color:#fff;text-align:center'>Maalesef aradığınız kriterlere uygun bir dizi bulunamadı.</p>";
				}
				
			}else{
				echo "Hata";
			}
		}
		elseif($type == 'episode'){
			
			$data = $this->Frontend_Operations_model->bölüm($this->input->post('dizi_id'), $this->input->post('episode_id'));
			
				echo	'<div class="movie-detail" style="display:flex">';				
				echo		'<div class="movie-detail-info" style="margin:0 auto">';

				foreach(site_puanı_sıralama('dizi') as $sıralama){
					if($sıralama['dizi_id'] == $data->dizi_id){
						$dizi_numarası = $sıralama['sıralama'];
						break;
					}
				};
				
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
				};				
				
				echo			'<div class="title-hd">';
				echo				'<h2>'.$data->dizi_ad.'</h2>';	
				echo 				'<h4> Sezon '.$data->season_number.' - Bölüm '.$data->episode_number.'</h4>';
				echo 				'<h4>['.$data->episode_name.']</h4>';

				echo			'<div class="small-title1">';
				echo 				"<div class='cate'>";
					foreach(explode(',',$data->dizi_türü) as $dizi_türü){
						$renk = array('blue','green','orange'); $key = array_rand($renk, 1); 
				echo 					"<span class='". $renk[$key]."'>";
				echo 					"<a href='#'>". $dizi_türü . "</a>";
				echo 					"</span>";
					}			
				echo 				"</div>";
				echo			'</div>';
				
				echo			'</div>';

				echo			'<div class="small-title1">';
				echo				'<h4> Bölüm Imdb Puanı </h4>';
				echo				'<div class="movie-imdb-point">';
				echo					'<p>';
				echo						'<i class="ion-android-star"></i>';
				echo						'<span>'.$data->episode_puan.'</span>'.' /10';
				echo					'</p>';
				echo				'</div>';
				echo			'</div>';	
				
				echo			'<div class="small-title1">';
				echo				'<h4> Bölüm Süresi </h4>';
				echo				'<div class="movie-duration">';
				echo					'<p>';
				echo						'<i class="fal fa-hourglass-end"></i>';
				echo						'<span>'.$data->episode_süre.'</span>';
				echo					' dakika</p>';
				echo				'</div>';
				echo			'</div>';				
				
				echo			'<div class="small-title1">';
				echo				'<h4> Bölüm Yayınlanma Tarihi </h4>';
				echo				'<div class="movie-release-date">';
				echo					'<p>';
				echo					'<i class="fal fa-calendar"></i>';
				echo					'<span>'.türkçetarihformat('j F Y',$data->episode_release_date).'</span>';
				echo					'</p>';
				echo				'</div>';
				echo			'</div>';						
			
				echo			'<div class="small-title3">';
				echo				'<h4> Bölüm Açıklaması </h4>';
				echo				'<p>'.açıklama_kisalt($data->episode_describe).'</p>';
				echo			'</div>';	
				echo			'<div class="movie-btn">';
				echo				'<span class="btn-transform transform-vertical">';
				echo					'<div><a href="'.base_url('izle/dizi/').$data->episode_sef_link.'" class="item item-1 redbtn"><i class="fas fa-play"></i>Bölümü İzle</a></div>';
				echo					'<div><a href="'.base_url('izle/dizi/').$data->episode_sef_link.'" class="item item-2 redbtn"><i class="fas fa-play"></i></a></div>';
				echo				'</span>';				
				echo				'<span class="btn-transform transform-vertical">';
				echo					'<div><a href="'.base_url('diziler/').$data->dizi_sef_link.'" class="item item-1 yellowbtn"><i class="fal fa-tv-retro"></i>Dizi Sayfası</a></div>';
				echo					'<div><a href="'.base_url('diziler/').$data->dizi_sef_link.'" class="item item-2 yellowbtn"><i class="fal fa-tv-retro"></i></a></div>';
				echo				'</span>';
				echo				'<p>Bölüm '.tarihgeçenzaman($data->dizi_add_date).' eklendi.<p>';
				echo			'</div>';
	
				echo		'</div>';					
				echo	'</div>';
			
			
		}elseif($type == 'dizi'){
			
			$data = $this->Admin_Operations_model->print_dizi($this->input->post('movie_id'));
			
				echo	'<div class="movie-detail" style="display:flex">';				
				echo		'<div class="movie-detail-info" style="margin:0 auto">';

				foreach(site_puanı_sıralama('dizi') as $sıralama){
					if($sıralama['dizi_id'] == $data->dizi_id){
						$dizi_numarası = $sıralama['sıralama'];
						break;
					}
				};
				
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
				};
				
				
				
				echo			'<div class="title-hd">';
				echo				'<h2>'.$data->dizi_ad.'</h2>';	

				echo			'<div class="small-title1">';
				echo 				"<div class='cate'>";
					foreach(explode(',',$data->dizi_türü) as $dizi_türü){
						$renk = array('blue','green','orange'); $key = array_rand($renk, 1); 
				echo 					"<span class='". $renk[$key]."'>";
				echo 					"<a href='#'>". $dizi_türü . "</a>";
				echo 					"</span>";
					}			
				echo 				"</div>";
				echo			'</div>';
				
				echo			'</div>';	

				
				echo			'<div class="small-title1">';
				echo				'<h4> Dizi Imdb Puanı </h4>';
				echo				'<div class="movie-imdb-point">';
				echo					'<p>';
				echo						'<i class="ion-android-star"></i>';
				echo						'<span>'.$data->dizi_puanı.'</span>'.' /10';
				echo					'</p>';
				echo				'</div>';
				echo			'</div>';																
				echo			'<div class="small-title1">';
				echo				'<h4> Dizi Yayınlanma Tarihi </h4>';
				echo				'<div class="movie-release-date">';
				echo					'<p>';
				echo					'<i class="fal fa-calendar"></i>';
				echo					'<span>'.türkçetarihformat('j F Y',$data->dizi_release_date).'</span>';
				echo					'</p>';
				echo				'</div>';
				echo			'</div>';						
			if($data->dizi_finished_date != 'Devam Ediyor.'){
				echo			'<div class="small-title1">';
				echo				'<h4> Dizi Bitiş Tarihi </h4>';
				echo				'<div class="movie-release-date">';
				echo					'<p>';
				echo					'<i class="fal fa-calendar"></i>';
				echo					'<span>'.türkçetarihformat('j F Y',$data->dizi_finished_date).'</span>';
				echo					'</p>';
				echo				'</div>';
				echo			'</div>';		
				}else{
				echo			'<div class="small-title1">';
				echo				'<h4> Dizi Bitiş Tarihi </h4>';
				echo				'<div class="movie-release-date">';
				echo					'<p>';
				echo					'<span>'.'Dizi Devam Ediyor.'.'</span>';
				echo					'</p>';
				echo				'</div>';
				echo			'</div>';		
			}	
			
				echo			'<div class="small-title3">';
				echo				'<h4> Dizi Açıklaması </h4>';
				echo				'<p>'.açıklama_kisalt($data->dizi_describe).'</p>';
				echo			'</div>';	
				echo			'<div class="movie-btn">';
				echo				'<span class="btn-transform transform-vertical">';
				echo					'<div><a href="'.base_url('diziler/').$data->dizi_sef_link.'" class="item item-1 yellowbtn"><i class="fal fa-tv-retro"></i>Dizi Sayfası</a></div>';
				echo					'<div><a href="'.base_url('diziler/').$data->dizi_sef_link.'" class="item item-2 yellowbtn"><i class="fal fa-tv-retro"></i></a></div>';
				echo				'</span>';
				echo				'<p>Son Bölüm '.tarihgeçenzaman($data->dizi_add_date).' eklendi.<p>';
				echo			'</div>';

				echo			'<div class="social-btn">';
					if($this->session->userdata('durum') == true){
					if(favorikontrol('dizi', $this->session->userdata('user')->uye_id, $data->dizi_id) != true){
				echo				'<a class="parent-btn" id="add_favourite" onclick="add_favourite('.$this->session->userdata('user')->uye_id .','.$data->dizi_id.','."'dizi'".')"><i class="ion-heart"></i> Favorilerine Ekle</a>';
				echo				'<a style="display:none;" class="parent-btn" id="remove_favourite" onclick="remove_favourite('.$this->session->userdata('user')->uye_id .','. $data->dizi_id .','."'dizi'".')"><i class="ion-close"></i> Favorilerinden Kaldır</a>';
					}else{
				echo				'<a style="display:none;" class="parent-btn" id="add_favourite" onclick="add_favourite('.$this->session->userdata('user')->uye_id .','.$data->dizi_id.','."'dizi'".')"><i class="ion-heart"></i> Favorilerine Ekle</a>';
				echo				'<a class="parent-btn" id="remove_favourite" onclick="remove_favourite('.$this->session->userdata('user')->uye_id .','. $data->dizi_id .','."'dizi'".')"><i class="ion-close"></i> Favorilerinden Kaldır</a>';
					}}
				echo				'<div class="hover-bnt">';
				echo					'<a href="#" class="parent-btn"><i class="ion-android-share-alt"></i>Diziyi Paylaş</a>';
				echo					'<div class="hvr-item">';
				echo						'<a href="#" class="hvr-grow"><i class="ion-social-facebook"></i></a>';
				echo						'<a href="#" class="hvr-grow"><i class="ion-social-twitter"></i></a>';
				echo						'<a href="#" class="hvr-grow"><i class="ion-social-googleplus"></i></a>';
				echo						'<a href="#" class="hvr-grow"><i class="ion-social-youtube"></i></a>';
				echo					'</div>';
				echo				'</div>';	
				echo			'</div>';

				
				echo		'</div>';	
				echo		'<div class="movie-detail-image" style="position:relative;width:30%;margin:10px">';
				echo			'<img src="' .image_url($data->dizi_image, $data->dizi_sef_link) .'">';
				echo		'</div>';				
				echo	'</div>';
			
			
		}elseif($type == 'film'){

			$data = $this->Admin_Operations_model->print_film($this->input->post('movie_id'));
			
				echo	'<div class="movie-detail" style="display:flex">';				
				echo		'<div class="movie-detail-info" style="margin:0 auto">';		

				foreach(site_puanı_sıralama('film') as $sıralama){
					if($sıralama['film_id'] == $data->film_id){
						$film_numarası = $sıralama['sıralama'];
						break;
					}
				};
				
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
				};							
				
				echo			'<div class="title-hd">';
				echo				'<h2>'.$data->film_ad.'</h2>';	

				echo			'<div class="small-title1">';
				echo 				"<div class='cate'>";
					foreach(explode(',',$data->film_türü) as $film_türü){
						$renk = array('blue','green','orange'); $key = array_rand($renk, 1); 
				echo 					"<span class='". $renk[$key]."'>";
				echo 					"<a href='#'>". $film_türü . "</a>";
				echo 					"</span>";
					}			
				echo 				"</div>";
				echo			'</div>';
				
				echo			'</div>';	

				
				echo			'<div class="small-title1">';
				echo				'<h4> Film Imdb Puanı </h4>';
				echo				'<div class="movie-imdb-point">';
				echo					'<p>';
				echo						'<i class="ion-android-star"></i>';
				echo						'<span>'.$data->film_puanı.'</span>'.' /10';
				echo					'</p>';
				echo				'</div>';
				echo			'</div>';																
				echo			'<div class="small-title1">';
				echo				'<h4> Film Yayınlanma Tarihi </h4>';
				echo				'<div class="movie-release-date">';
				echo					'<p>';
				echo					'<i class="fal fa-calendar"></i>';
				echo					'<span>'.türkçetarihformat('j F Y',$data->film_release_date).'</span>';
				echo					'</p>';
				echo				'</div>';
				echo			'</div>';
			
				echo			'<div class="small-title3">';
				echo				'<h4> Film Açıklaması </h4>';
				echo				'<p>'.açıklama_kisalt($data->film_describe).'</p>';
				echo			'</div>';	
				echo			'<div class="movie-btn">';
				echo				'<span class="btn-transform transform-vertical">';
				echo					'<div><a href="#" class="item item-1 redbtn"><i class="fas fa-play"></i>Filmi İzle</a></div>';
				echo					'<div><a href="'.base_url('izle/film/').$data->film_sef_link.'" class="item item-2 redbtn"><i class="fas fa-play"></i></a></div>';
				echo				'</span>';					
				echo				'<span class="btn-transform transform-vertical">';
				echo					'<div><a href="'.base_url('filmler/').$data->film_sef_link.'" class="item item-1 yellowbtn"><i class="fal fa-film"></i>Film Sayfası</a></div>';
				echo					'<div><a href="'.base_url('filmler/').$data->film_sef_link.'" class="item item-2 yellowbtn"><i class="fal fa-film"></i></a></div>';
				echo				'</span>';			
				echo				'<p>Bu Film '.tarihgeçenzaman($data->film_add_date).' eklendi.<p>';
				echo			'</div>';


				echo			'<div class="social-btn">';
					if($this->session->userdata('durum') == true){
					if(favorikontrol('film', $this->session->userdata('user')->uye_id, $data->film_id) != true){
				echo				'<a class="parent-btn" id="add_favourite" onclick="add_favourite('.$this->session->userdata('user')->uye_id .','.$data->film_id.','."'film'".')"><i class="ion-heart"></i> Favorilerine Ekle</a>';
				echo				'<a style="display:none;" class="parent-btn" id="remove_favourite" onclick="remove_favourite('.$this->session->userdata('user')->uye_id .','. $data->film_id .','."'film'".')"><i class="ion-close"></i> Favorilerinden Kaldır</a>';
					}else{
				echo				'<a style="display:none;" class="parent-btn" id="add_favourite" onclick="add_favourite('.$this->session->userdata('user')->uye_id .','.$data->film_id.','."'film'".')"><i class="ion-heart"></i> Favorilerine Ekle</a>';
				echo				'<a class="parent-btn" id="remove_favourite" onclick="remove_favourite('.$this->session->userdata('user')->uye_id .','. $data->film_id .','."'film'".')"><i class="ion-close"></i> Favorilerinden Kaldır</a>';
					}}
				echo				'<div class="hover-bnt">';
				echo					'<a href="#" class="parent-btn"><i class="ion-android-share-alt"></i>Filmi Paylaş</a>';
				echo					'<div class="hvr-item">';
				echo						'<a href="#" class="hvr-grow"><i class="ion-social-facebook"></i></a>';
				echo						'<a href="#" class="hvr-grow"><i class="ion-social-twitter"></i></a>';
				echo						'<a href="#" class="hvr-grow"><i class="ion-social-googleplus"></i></a>';
				echo						'<a href="#" class="hvr-grow"><i class="ion-social-youtube"></i></a>';
				echo					'</div>';
				echo				'</div>';	
				echo			'</div>';
				
				echo		'</div>';	
				echo		'<div class="movie-detail-image" style="position:relative;width:30%;margin:10px">';
				echo			'<img src="' .image_url($data->film_image, $data->film_sef_link) .'">';
				echo		'</div>';				
				echo	'</div>';
			
		}
		else{
			echo 'Hata';
		}

	}
	
	public function header_search(){
		/* Header Search */
		$harf = $this->input->post('harf');
		$sonuc = $this->Pagination_and_Filter_model->filmara($harf);
		echo "<h5> Arama Sonuçları </h5>";
		if(!empty($sonuc['filmler'])){
			echo "<h4>Filmler</h4>";
			echo "<ul class='movie-list'>";
			foreach($sonuc['filmler'] as $film){
				echo "<li class='movie'>";
				echo '<div class="movie-info">';
				echo	'<div class="movie-name">';
				echo		yazi_kisalt($film->film_ad, 30);
				echo	'</div>';
				echo	'<div class="movie-rate">';
				echo		'<i class="ion-android-star"></i>';
				echo		'<span>'.$film->film_puanı.'</span>';
				echo	'</div>';
				echo'</div>';
				echo'<div class="movie-image">';
				echo		'<img src="'.image_url($film->film_kapak_image, $film->film_sef_link).'" alt="">';
				echo'</div>';	
				echo'<div class="movie-info">';
				echo "<div class='cate'>";
				foreach(explode(',',$film->film_türü) as $film_türü){
					$renk = array('blue','green','orange'); $key = array_rand($renk, 1); 
					echo "<span class='". $renk[$key]."'>";
					echo "<a href='#'>". $film_türü . "</a>";
					echo "</span>";
				}			
				echo "</div>";
				echo '</div>';
				echo '<div class="movie-inner">';
				echo '<a onclick="film_detail('.$film->film_id.')"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>';
				echo '</div>';					
				echo "</li>";
			}
			echo "</ul>";

		}		

		if(!empty($sonuc['diziler'])){
			echo "<h4>Diziler</h4>";
			echo "<ul class='movie-list'>";
			foreach($sonuc['diziler'] as $dizi){
				echo "<li class='movie'>";
				echo '<div class="movie-info">';
				echo	'<div class="movie-name">';
				echo		yazi_kisalt($dizi->dizi_ad, 30);
				echo	'</div>';
				echo	'<div class="movie-rate">';
				echo		'<i class="ion-android-star"></i>';
				echo		'<span>'.$dizi->dizi_puanı.'</span>';
				echo	'</div>';
				echo'</div>';
				echo'<div class="movie-image">';
				echo		'<img src="'.image_url($dizi->dizi_kapak_image, $dizi->dizi_sef_link).'" alt="">';
				echo'</div>';	
				echo'<div class="movie-info">';
				echo "<div class='cate'>";
				foreach(explode(',',$dizi->dizi_türü) as $dizi_türü){
					$renk = array('blue','green','orange'); $key = array_rand($renk, 1); 
					echo "<span class='". $renk[$key]."'>";
					echo "<a href='#'>". $dizi_türü . "</a>";
					echo "</span>";
				}			
				echo "</div>";
				echo'</div>';
				echo '<div class="movie-inner">';
				echo '<a onclick="movie_detail('.$dizi->dizi_id.')"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>';
				echo '</div>';					
				echo "</li>";
			}
			echo "</ul>";

		}

		if(!empty($sonuc['oyuncular'])){
			echo "<h4>Oyuncular</h4>";
			echo "<ul class='cast-list'>";
			foreach($sonuc['oyuncular'] as $oyuncu){
				echo '<li class="cast">';
				echo '<div class="cast-image">';
					if($oyuncu->cast_image == null){
						echo	"<div class='cast-image-name'>";
						echo	"<h4>";
						$ad_soyad = explode(' ',$oyuncu->cast_name); 
						foreach($ad_soyad as $basharf){ 
							echo $basharf[0];
						}
						echo 	"</h4>";
						echo	"</div>";					
					}else{
						echo '<img src="'.image_url($oyuncu->cast_image).'" alt="">';
					}
				echo'</div>';				
				echo '<div class="cast-info">';
				echo	'<div class="cast-name">';
				echo		yazi_kisalt($oyuncu->cast_name, 20);
				echo	'</div>';
				echo '</div>';	
				echo '<div class="cast-inner">';
				echo '<a href="'.base_url('cast/'.$oyuncu->cast_id).'"> Ayrıntılar <i class="fas fa-info-circle"></i> </a>';
				echo '</div>';										
				echo "</li>";
			}
			echo "</ul>";

		}		
		
		if(empty($sonuc["filmler"]) && empty($sonuc["diziler"]) && empty($sonuc["oyuncular"])){
			echo "<h4>Aradığınız kriterlere uygun bir sonuç bulunamadı.</h4>";
		}

	}	

}

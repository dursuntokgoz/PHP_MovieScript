<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imdb_Operations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('IMDB_Operations_model');
		$this->load->model('Admin_Operations_model');
		$this->load->library('tmdb');
		$this->load->library('IMDB');
	}

	public function imdb_film_info_add(){

		$movie_id = $this->input->post('imdb-film-id');
		$film_bilgileri = $this->tmdb->getMovie($movie_id, 'tr');

		if($film_bilgileri == '34'){
			$this->session->set_flashdata('info',başarısız_bildirimi('Bu id ye ait bir film bulunamadı.'));
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			set_time_limit(0);
			
			$film_id_bilgileri = $this->tmdb->getMovieExternealIDs($movie_id);
			$film_keywords_bilgileri = $this->tmdb->getMovieKeywords($movie_id);
			$film_video_bilgileri = $this->tmdb->getMovieTrailers($movie_id, 'en');
			$film_resim_bilgileri = $this->tmdb->getMovieImages($movie_id);
			$film_ekibi_bilgileri = $this->tmdb->getMovieCast($movie_id);
			
			
			$film_oyuncuları = $film_ekibi_bilgileri['cast'];
			$film_yapımcıları = $film_ekibi_bilgileri['crew'];
			
			$oyunculimit = 20;
			$yapımcılimit = 10;
			array_splice($film_oyuncuları, $oyunculimit);
			array_splice($film_yapımcıları, $yapımcılimit);


			$resim_indirme = $this->input->post('downlad-images');
			$cast_resim_indirme = $this->input->post('download-cast-images');

			// Film IMDB Bilgileri
			$IMDB = new IMDB('http://www.imdb.com/title/'.$film_id_bilgileri['imdb_id']);
			if ($IMDB->isReady) {
				$film_imdb_puanı = $IMDB->getRating();
			}

			// Film Türleri
			foreach($film_bilgileri['genres'] as $tür){
				$film_türleri[] = $tür['name'];
				$film_türü = implode(',',$film_türleri);
			}
			// Film Videoları
			if($film_video_bilgileri['results']){
				foreach($film_video_bilgileri['results'] as $video){
					$film_videoları[] = array(
						'video_name' => $video['name'],
						'video_site' => $video['site'],
						'video_size' => $video['size'],
						'video_type' => $video['type'],
						'video_url' => $video['key'],
					);
				}
			}else{
				$film_videoları = null;
			}
			// Film Resimleri
			foreach($film_resim_bilgileri['backdrops'] as $resimler){
				$film_resimleri[] = $resimler['file_path'];
			}
			// Film Keywords
			foreach($film_keywords_bilgileri['keywords'] as $keywords){
				$film_keyword[] = $keywords['name'];
				$film_keywords = implode(',',$film_keyword);
			}
	
				
			// Film Ekibi
			$film_ekibi = array_merge($film_oyuncuları , $film_yapımcıları);			
			
			if($cast_resim_indirme == false){

				foreach($film_ekibi as $ekip){
					$cast_bilgisi = $this->tmdb->getPerson($ekip['id']);
					$film_cast[] = array(
						'cast_id' => $cast_bilgisi['id'],
						'cast_imdb_id' => $cast_bilgisi['imdb_id'],
						'cast_job' => $cast_bilgisi['known_for_department'],
						'cast_name' => $cast_bilgisi['name'],
						'cast_birth_day' => $cast_bilgisi['birthday'],
						'cast_death_day' => $cast_bilgisi['deathday'],
						'cast_birth_place' => $cast_bilgisi['place_of_birth'],
						'cast_biography' => $cast_bilgisi['biography'],
						'cast_image' => $cast_bilgisi['profile_path'],
						'popularity' => $cast_bilgisi['popularity']
					);
				}				

			}else{
						
				foreach($film_ekibi as $ekip){
					$cast_bilgisi = $this->tmdb->getPerson($ekip['id']);
					
					//Kişi Resmini İndirme
						$resim_ismi = $cast_bilgisi['profile_path'];
						$resim_linki = image_url($cast_bilgisi['profile_path']);
						
						if(isset(pathinfo($resim_ismi)['extension'])){
							$resim_uzantısı = pathinfo($resim_ismi)['extension'];
						}
						
						if($cast_bilgisi['profile_path'] != null){
							
							$resim_kayıt_yeri = 'assets/uploads/casts/'.seflink($cast_bilgisi['name']) . '.' .$resim_uzantısı;
							copy($resim_linki,$resim_kayıt_yeri);
							
							$veritabanı_resim_kayıt = seflink($cast_bilgisi['name']) . '.' .$resim_uzantısı;							
						}else{							
							$veritabanı_resim_kayıt = $cast_bilgisi['profile_path'];
						}
						
						
					// Kişiyi Veritabanına Gönder
					$film_cast[] = array(
						'cast_id' => $cast_bilgisi['id'],
						'cast_imdb_id' => $cast_bilgisi['imdb_id'],
						'cast_job' => $cast_bilgisi['known_for_department'],
						'cast_name' => $cast_bilgisi['name'],
						'cast_birth_day' => $cast_bilgisi['birthday'],
						'cast_death_day' => $cast_bilgisi['deathday'],
						'cast_birth_place' => $cast_bilgisi['place_of_birth'],	
						'cast_biography' => $cast_bilgisi['biography'],	
						'cast_image' => $veritabanı_resim_kayıt,	
						'popularity' => $cast_bilgisi['popularity'],				
					);
				}
			}


			// Film Ekibi Idleri
			if($film_cast){
				foreach($film_cast as $ekip_id){
					$film_ekibi_id[] = $ekip_id['cast_id'];
					$film_ekibi_idleri = implode(',',$film_ekibi_id);
				}
			}else{
				$film_ekibi_idleri = null;
			}

			
			// Film Şirketi Idleri
			if($film_bilgileri['production_companies']){
				foreach($film_bilgileri['production_companies'] as $şirketler){
					$film_şirket_id[] = $şirketler['id'];
					$film_şirketi_idleri = implode(',',$film_şirket_id);
				}
			}else{
				$film_şirketi_idleri = null;
			}

			// Film Klasörü Oluşturma	
			$filmdosyauzantısı = 'assets/uploads/movies/'. seflink($film_bilgileri['original_title']);
				mkdir($filmdosyauzantısı,'0777');

			if($resim_indirme == false){
				$imdb_film_bilgileri = array(
					'film_id' => (isset($film_id_bilgileri['id'])) ? $film_id_bilgileri['id'] : null,
					'film_imdb_id' => (isset($film_id_bilgileri['imdb_id'])) ? $film_id_bilgileri['imdb_id'] : null,
					'film_ad' => (isset($film_bilgileri['original_title'])) ? $film_bilgileri['original_title'] : null,
					'film_türü' => (isset($film_türü)) ? $film_türü : null,
					'film_release_date' => (isset( $film_bilgileri['release_date'])) ? $film_bilgileri['release_date'] : null,
					'film_süresi' => (isset($film_bilgileri['runtime'])) ? $film_bilgileri['runtime'] : null,
					'film_puanı' => $film_imdb_puanı,
					'film_bütçesi' => (isset($film_bilgileri['budget'])) ? $film_bilgileri['budget'] : null,
					'film_describe' => (isset($film_bilgileri['overview'])) ? $film_bilgileri['overview'] : null,
					'film_keywords' => (isset($film_keywords)) ? $film_keywords : null,
					'film_image' => (isset($film_bilgileri['poster_path'])) ? $film_bilgileri['poster_path'] : null,
					'film_kapak_image' => (isset($film_bilgileri['backdrop_path'])) ? $film_bilgileri['backdrop_path'] : null,
					'film_trailer' => (isset($film_videoları[0]['video_url'])) ? $film_videoları[0]['video_url'] : null,
					'film_ekibi' => $film_ekibi_idleri,
					'film_şirketi' => $film_şirketi_idleri,
					'film_facebook' => (isset($film_id_bilgileri['facebook_id'])) ? $film_id_bilgileri['facebook_id'] : null,
					'film_twitter' => (isset($film_id_bilgileri['instagram_id'])) ? $film_id_bilgileri['instagram_id'] : null,
					'film_instagram' => (isset($film_id_bilgileri['twitter_id'])) ? $film_id_bilgileri['twitter_id'] : null,
					'film_sef_link' => seflink($film_bilgileri['original_title']),
					'film_add_date' => date('Y-m-d H:i:s'),
				);

				// Filmler Tablosuna Yazılacaklar
				$this->Admin_Operations_model->add_movie("film",$imdb_film_bilgileri);
				// Oyuncuları Veritabanına Yolla
				$this->IMDB_Operations_model->imdb_ekibi_aktar($film_cast);
				// Film Şirketlerini Veritabanına Yolla
				$this->IMDB_Operations_model->yapım_şirketini_aktar($film_bilgileri['production_companies']);
				// Resimler Tablosuna Yazılacaklar
				$this->IMDB_Operations_model->imdb_add_image('film', $imdb_film_bilgileri['film_id'], null, $film_resimleri);
				// Videolar Tablosuna Yazılacaklar
				$this->IMDB_Operations_model->imdb_add_video('film', $imdb_film_bilgileri['film_id'], null, $film_videoları);
			

			}else{
				//Film Posterini İndirme
					$poster_ismi = $film_bilgileri['poster_path'];
					$resim_linki = image_url($film_bilgileri['poster_path']);
					$resim_kayıt_yeri = $filmdosyauzantısı.'/'.$poster_ismi;
					copy($resim_linki,$resim_kayıt_yeri);
					$yeni_poster_ismi = str_replace('/','',$poster_ismi);
				//Film Kapak Resmini İndirme
					$kapak_resmi_ismi = $film_bilgileri['backdrop_path'];
					$resim_linki = image_url($film_bilgileri['backdrop_path']);
					$resim_kayıt_yeri = $filmdosyauzantısı.'/'.$kapak_resmi_ismi;
					copy($resim_linki,$resim_kayıt_yeri);
					$yeni_kapak_resmi_ismi = str_replace('/','',$kapak_resmi_ismi);
				//Film Resimlerini İndirme
				foreach($film_resimleri as $film_resmi){
					$film_resim_linki = image_url($film_resmi);
					$film_resim_kayıt_yeri = $filmdosyauzantısı.'/'.$film_resmi;
					copy($film_resim_linki,$film_resim_kayıt_yeri);
					$film_yeni_resim_isimleri[] = str_replace('/','',$film_resmi);
				}
	
				$imdb_film_bilgileri = array(
					'film_id' => (isset($film_id_bilgileri['id'])) ? $film_id_bilgileri['id'] : null,
					'film_imdb_id' => (isset($film_id_bilgileri['imdb_id'])) ? $film_id_bilgileri['imdb_id'] : null,
					'film_ad' => (isset($film_bilgileri['original_title'])) ? $film_bilgileri['original_title'] : null,
					'film_türü' => (isset($film_türü)) ? $film_türü : null,
					'film_release_date' => (isset( $film_bilgileri['release_date'])) ? $film_bilgileri['release_date'] : null,
					'film_süresi' => (isset($film_bilgileri['runtime'])) ? $film_bilgileri['runtime'] : null,
					'film_puanı' => $film_imdb_puanı,
					'film_bütçesi' => (isset($film_bilgileri['budget'])) ? $film_bilgileri['budget'] : null,
					'film_describe' => (isset($film_bilgileri['overview'])) ? $film_bilgileri['overview'] : null,
					'film_keywords' => (isset($film_keywords)) ? $film_keywords : null,
					'film_image' => $yeni_poster_ismi,
					'film_kapak_image' => $yeni_kapak_resmi_ismi,
					'film_trailer' => (isset($film_videoları[0]['video_url'])) ? $film_videoları[0]['video_url'] : null,
					'film_ekibi' => $film_ekibi_idleri,
					'film_şirketi' => $film_şirketi_idleri,
					'film_facebook' => (isset($film_id_bilgileri['facebook_id'])) ? $film_id_bilgileri['facebook_id'] : null,
					'film_twitter' => (isset($film_id_bilgileri['instagram_id'])) ? $film_id_bilgileri['instagram_id'] : null,
					'film_instagram' => (isset($film_id_bilgileri['twitter_id'])) ? $film_id_bilgileri['twitter_id'] : null,
					'film_sef_link' => seflink($film_bilgileri['original_title']),
					'film_add_date' => date('Y-m-d H:i:s'),
				);

				// Filmler Tablosuna Yazılacaklar
				$this->Admin_Operations_model->add_movie("film",$imdb_film_bilgileri);
				// Oyuncuları Veritabanına Yolla
				$this->IMDB_Operations_model->imdb_ekibi_aktar($film_cast);
				// Film Şirketlerini Veritabanına Yolla
				$this->IMDB_Operations_model->yapım_şirketini_aktar($film_bilgileri['production_companies']);
				// Resimler Tablosuna Yazılacaklar
				$this->IMDB_Operations_model->imdb_add_image('film', $imdb_film_bilgileri['film_id'], null, $film_yeni_resim_isimleri);
				// Videolar Tablosuna Yazılacaklar
				$this->IMDB_Operations_model->imdb_add_video('film', $imdb_film_bilgileri['film_id'], null, $film_videoları);

			}
	

		$this->session->set_flashdata('info',başarılı_bildirimi('Filmi ekleme baaşrılı.'));

		redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function imdb_dizi_info_add(){

		$movie_id = $this->input->post('imdb-dizi-id');
		$dizi_bilgileri = $this->tmdb->getTVShow($movie_id, 'tr');

		if($dizi_bilgileri == '34'){
			$this->session->set_flashdata('info',başarısız_bildirimi('Bu idye ait dizi bulunamadı.'));
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			set_time_limit(0);
			
			$dizi_id_bilgileri = $this->tmdb->getTVShowExternealIDs($movie_id);
			$dizi_keywords_bilgileri = $this->tmdb->getTVShowKeywords($movie_id);
			$dizi_video_bilgileri = $this->tmdb->getTVShowTrailers($movie_id);
			$dizi_resim_bilgileri = $this->tmdb->getTVShowImages($movie_id);
			$dizi_ekibi_bilgileri = $this->tmdb->getTVShowCast($movie_id);

			$dizi_oyuncuları = $dizi_ekibi_bilgileri['cast'];
			$dizi_yapımcıları = $dizi_ekibi_bilgileri['crew'];
			
			$oyunculimit = 20;
			$yapımcılimit = 10;
			array_splice($dizi_oyuncuları, $oyunculimit);
			array_splice($dizi_yapımcıları, $yapımcılimit);

			$resim_indirme = $this->input->post('downlad-images');
			$cast_resim_indirme = $this->input->post('download-cast-images');


			// Dizi IMDB Puanı
			$IMDB = new IMDB('http://www.imdb.com/title/'.$dizi_id_bilgileri['imdb_id']);
			if ($IMDB->isReady) {
				$dizi_imdb_puanı = $IMDB->getRating();
			}
			// Dizi Türleri
			foreach($dizi_bilgileri['genres'] as $tür){
				$dizi_türleri[] = $tür['name'];
				$dizi_türü = implode(',',$dizi_türleri);
			}
			// Dizi Keywords
			foreach($dizi_keywords_bilgileri['results'] as $keywords){
				$dizi_keyword[] = $keywords['name'];
				$dizi_keywords = implode(',',$dizi_keyword);
			}
			// Dizi Resimleri
			foreach($dizi_resim_bilgileri['backdrops'] as $resimler){
				$dizi_resimleri[] = $resimler['file_path'];
			}
			// Dizi Videoları
			if($dizi_video_bilgileri['results']){
				foreach($dizi_video_bilgileri['results'] as $video){
					$dizi_videoları[] = array(
						'video_name' => $video['name'],
						'video_site' => $video['site'],
						'video_size' => $video['size'],
						'video_type' => $video['type'],
						'video_url' => $video['key'],
					);
				}
			}else{
				$dizi_videoları = null;
			}
			
			// Dizi Ekibi
			$dizi_ekibi = array_merge($dizi_oyuncuları , $dizi_yapımcıları);
					
			if($cast_resim_indirme == false){

				foreach($dizi_ekibi as $ekip){
					$cast_bilgisi = $this->tmdb->getPerson($ekip['id']);
					$dizi_cast[] = array(
						'cast_id' => $cast_bilgisi['id'],
						'cast_imdb_id' => $cast_bilgisi['imdb_id'],
						'cast_job' => $cast_bilgisi['known_for_department'],
						'cast_name' => $cast_bilgisi['name'],
						'cast_birth_day' => $cast_bilgisi['birthday'],
						'cast_death_day' => $cast_bilgisi['deathday'],
						'cast_birth_place' => $cast_bilgisi['place_of_birth'],
						'cast_biography' => $cast_bilgisi['biography'],
						'cast_image' => $cast_bilgisi['profile_path'],
						'popularity' => $cast_bilgisi['popularity']
					);
				}				

			}else{
						
				foreach($dizi_ekibi as $ekip){
					$cast_bilgisi = $this->tmdb->getPerson($ekip['id']);
					
					//Kişi Resmini İndirme
						$resim_ismi = $cast_bilgisi['profile_path'];
						$resim_linki = image_url($cast_bilgisi['profile_path']);
						
						if(isset(pathinfo($resim_ismi)['extension'])){
							$resim_uzantısı = pathinfo($resim_ismi)['extension'];
						}
						
						if($cast_bilgisi['profile_path'] != null){
							
							$resim_kayıt_yeri = 'assets/uploads/casts/'.seflink($cast_bilgisi['name']) . '.' .$resim_uzantısı;
							copy($resim_linki,$resim_kayıt_yeri);
							
							$veritabanı_resim_kayıt = seflink($cast_bilgisi['name']) . '.' .$resim_uzantısı;							
						}else{							
							$veritabanı_resim_kayıt = $cast_bilgisi['profile_path'];
						}						
		
					// Kişiyi Veritabanına Gönder
					$dizi_cast[] = array(
						'cast_id' => $cast_bilgisi['id'],
						'cast_imdb_id' => $cast_bilgisi['imdb_id'],
						'cast_job' => $cast_bilgisi['known_for_department'],
						'cast_name' => $cast_bilgisi['name'],
						'cast_birth_day' => $cast_bilgisi['birthday'],
						'cast_death_day' => $cast_bilgisi['deathday'],
						'cast_birth_place' => $cast_bilgisi['place_of_birth'],	
						'cast_biography' => $cast_bilgisi['biography'],	
						'cast_image' => $veritabanı_resim_kayıt,	
						'popularity' => $cast_bilgisi['popularity'],				
					);
				}
			}			

			// Dizi Ekibi Idleri
			if($dizi_cast){
				foreach($dizi_cast as $ekip_id){
					$dizi_ekibi_id[] = $ekip_id['cast_id'];
					$dizi_ekibi_idleri = implode(',',$dizi_ekibi_id);
				}
			}else{
				$dizi_ekibi_idleri = null;
			}

			// Dizi Şirketi Idleri
			if($dizi_bilgileri['production_companies']){
				foreach($dizi_bilgileri['production_companies'] as $şirketler){
					$dizi_şirket_id[] = $şirketler['id'];
					$dizi_şirketi_idleri = implode(',',$dizi_şirket_id);
				}
			}else{
				$dizi_şirketi_idleri = null;
			}
			// Dizi Bitiş Tarihi
			if($dizi_bilgileri['status'] == "Ended"){
				$dizi_bitiş_tarihi = $dizi_bilgileri['last_air_date'];
			}else{
				$dizi_bitiş_tarihi = "Devam Ediyor.";
			}

			// Dizi Klasörü Oluşturma	
			$dizidosyauzantısı = 'assets/uploads/movies/'. seflink($dizi_bilgileri['original_name']);
				mkdir($dizidosyauzantısı,'0777');

			if($resim_indirme == false){
				$imdb_dizi_bilgileri = array(
					'dizi_id' => (isset($dizi_id_bilgileri['id'])) ? $dizi_id_bilgileri['id'] : null,
					'dizi_imdb_id' => (isset($dizi_id_bilgileri['imdb_id'])) ? $dizi_id_bilgileri['imdb_id'] : null,
					'dizi_ad' => (isset($dizi_bilgileri['original_name'])) ? $dizi_bilgileri['original_name'] : null,
					'dizi_türü' => (isset($dizi_türü)) ? $dizi_türü : null,
					'dizi_release_date' => (isset($dizi_bilgileri['first_air_date'])) ? $dizi_bilgileri['first_air_date'] : null,
					'dizi_finished_date' => $dizi_bitiş_tarihi,
					'dizi_durumu' => (isset($dizi_bilgileri['status'])) ? $dizi_bilgileri['status'] : null,
					'dizi_sezon_sayisi' => (isset($dizi_bilgileri['number_of_seasons'])) ? $dizi_bilgileri['number_of_seasons'] : null,
					'dizi_puanı' => $dizi_imdb_puanı,
					'dizi_describe' => (isset($dizi_bilgileri['overview'])) ? $dizi_bilgileri['overview'] : null,
					'dizi_keywords' => (isset($dizi_keywords)) ? $dizi_keywords : null,
					'dizi_image' => (isset($dizi_bilgileri['poster_path'])) ? $dizi_bilgileri['poster_path'] : null,
					'dizi_kapak_image' => (isset($dizi_bilgileri['backdrop_path'])) ? $dizi_bilgileri['backdrop_path'] : null,
					'dizi_trailer' => (isset($dizi_videoları[0]['video_url'])) ? $dizi_videoları[0]['video_url'] : null,
					'dizi_cast' => $dizi_ekibi_idleri,
					'dizi_şirketi' => $dizi_şirketi_idleri,
					'dizi_facebook' => (isset($dizi_id_bilgileri['facebook_id'])) ? $dizi_id_bilgileri['facebook_id'] : null,
					'dizi_twitter' => (isset($dizi_id_bilgileri['twitter_id'])) ? $dizi_id_bilgileri['twitter_id'] : null,
					'dizi_instagram' => (isset($dizi_id_bilgileri['instagram_id'])) ? $dizi_id_bilgileri['instagram_id'] : null,
					'dizi_sef_link' => seflink($dizi_bilgileri['original_name']),
					'dizi_add_date' => date('Y-m-d H:i:s'),
					//'gelecek_bölüm_bilgileri' => (isset($dizi_bilgileri['next_episode_to_air'])) ? $dizi_bilgileri['next_episode_to_air'] : null,
				);

				// Diziler Tablosuna Yazılacaklar
				$this->Admin_Operations_model->add_movie("dizi",$imdb_dizi_bilgileri);
				// Oyuncuları Veritabanına Yolla
				$this->IMDB_Operations_model->imdb_ekibi_aktar($dizi_cast);
				// Film Şirketlerini Veritabanına Yolla
				$this->IMDB_Operations_model->yapım_şirketini_aktar($dizi_bilgileri['production_companies']);
				// Resimler Tablosuna Yazılacaklar
				$this->IMDB_Operations_model->imdb_add_image('dizi', $imdb_dizi_bilgileri['dizi_id'], null, $dizi_resimleri);
				// Videolar Tablosuna Yazılacaklar
				$this->IMDB_Operations_model->imdb_add_video('dizi', $imdb_dizi_bilgileri['dizi_id'], null, $dizi_videoları);

			}else{
				//Dizi Posterini İndirme
					$poster_ismi = $dizi_bilgileri['poster_path'];
					$resim_linki = image_url($dizi_bilgileri['poster_path']);
					$resim_kayıt_yeri = $dizidosyauzantısı.'/'.$poster_ismi;
					copy($resim_linki,$resim_kayıt_yeri);
					$yeni_poster_ismi = str_replace('/','',$poster_ismi);
				//Dizi Kapak Resmini İndirme
					$kapak_resmi_ismi = $dizi_bilgileri['backdrop_path'];
					$resim_linki = image_url($dizi_bilgileri['backdrop_path']);
					$resim_kayıt_yeri = $dizidosyauzantısı.'/'.$kapak_resmi_ismi;
					copy($resim_linki,$resim_kayıt_yeri);
					$yeni_kapak_resmi_ismi = str_replace('/','',$kapak_resmi_ismi);
				//Dizi Resimlerini İndirme
				foreach($dizi_resimleri as $dizi_resmi){
					$dizi_resim_linki = image_url($dizi_resmi);
					$dizi_resim_kayıt_yeri = $dizidosyauzantısı.'/'.$dizi_resmi;
					copy($dizi_resim_linki,$dizi_resim_kayıt_yeri);
					$dizi_yeni_resim_isimleri[] = str_replace('/','',$dizi_resmi);
				}

				$imdb_dizi_bilgileri = array(
					'dizi_id' => (isset($dizi_id_bilgileri['id'])) ? $dizi_id_bilgileri['id'] : null,
					'dizi_imdb_id' => (isset($dizi_id_bilgileri['imdb_id'])) ? $dizi_id_bilgileri['imdb_id'] : null,
					'dizi_ad' => (isset($dizi_bilgileri['original_name'])) ? $dizi_bilgileri['original_name'] : null,
					'dizi_türü' => (isset($dizi_türü)) ? $dizi_türü : null,
					'dizi_release_date' => (isset($dizi_bilgileri['first_air_date'])) ? $dizi_bilgileri['first_air_date'] : null,
					'dizi_finished_date' => $dizi_bitiş_tarihi,
					'dizi_durumu' => (isset($dizi_bilgileri['status'])) ? $dizi_bilgileri['status'] : null,
					'dizi_sezon_sayisi' => (isset($dizi_bilgileri['number_of_seasons'])) ? $dizi_bilgileri['number_of_seasons'] : null,
					'dizi_puanı' => $dizi_imdb_puanı,
					'dizi_describe' => (isset($dizi_bilgileri['overview'])) ? $dizi_bilgileri['overview'] : null,
					'dizi_keywords' => (isset($dizi_keywords)) ? $dizi_keywords : null,
					'dizi_image' => $yeni_poster_ismi,
					'dizi_kapak_image' => $yeni_kapak_resmi_ismi,
					'dizi_trailer' => (isset($dizi_videoları[0]['video_url'])) ? $dizi_videoları[0]['video_url'] : null,
					'dizi_cast' => $dizi_ekibi_idleri,
					'dizi_şirketi' => $dizi_şirketi_idleri,
					'dizi_facebook' => (isset($dizi_id_bilgileri['facebook_id'])) ? $dizi_id_bilgileri['facebook_id'] : null,
					'dizi_twitter' => (isset($dizi_id_bilgileri['twitter_id'])) ? $dizi_id_bilgileri['twitter_id'] : null,
					'dizi_instagram' => (isset($dizi_id_bilgileri['instagram_id'])) ? $dizi_id_bilgileri['instagram_id'] : null,
					'dizi_sef_link' => seflink($dizi_bilgileri['original_name']),
					'dizi_add_date' => date('Y-m-d H:i:s'),
					//'son_bölüm_bilgileri' => (isset($dizi_bilgileri['last_episode_to_air'])) ? $dizi_bilgileri['last_episode_to_air'] : null,
					//'yeni_bölüm_çıkış_tarihi' => (isset($dizi_bilgileri['next_episode_to_air'])) ? $dizi_bilgileri['next_episode_to_air'] : null,
				);

				// Diziler Tablosuna Yazılacaklar
				$this->Admin_Operations_model->add_movie("dizi",$imdb_dizi_bilgileri);
				// Oyuncuları Veritabanına Yolla
				$this->IMDB_Operations_model->imdb_ekibi_aktar($dizi_cast);
				// Film Şirketlerini Veritabanına Yolla
				$this->IMDB_Operations_model->yapım_şirketini_aktar($dizi_bilgileri['production_companies']);
				// Resimler Tablosuna Yazılacaklar
				$this->IMDB_Operations_model->imdb_add_image('dizi', $imdb_dizi_bilgileri['dizi_id'], null, $dizi_yeni_resim_isimleri);
				// Videolar Tablosuna Yazılacaklar
				$this->IMDB_Operations_model->imdb_add_video('dizi', $imdb_dizi_bilgileri['dizi_id'], null, $dizi_videoları);

			}

			$this->session->set_flashdata('info',başarılı_bildirimi('Diziyi ekleme başarılı.'));

			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function imdb_season_info_add(){

			$sezon_bilgileri = $this->tmdb->getTVShowSeason($this->input->post('dizi-id'), $this->input->post('sezon-numarası'), 'tr');

			// Sezon Bölümlerini Veritabanına Yolla
			$this->IMDB_Operations_model->sezon_bölümlerini_aktar($sezon_bilgileri['episodes'], $this->input->post('downlad-images'));
			// Son Bölüm Ekleme Tarihini Güncelleme
			$dataupdate = array(
				'dizi_add_date' => date('Y-m-d H:i:s'),
			);
			$this->Admin_Operations_model->update_movie('dizi',$this->input->post('dizi-id') ,$dataupdate);


		$this->session->set_flashdata('info',başarılı_bildirimi('Dizinin sezon bölümlerini ekleme başarılı.'));

		redirect($_SERVER['HTTP_REFERER']);

	}

	public function imdb_episode_info_add(){

		$bölüm_bilgileri = $this->tmdb->getTVShowEpisode($this->input->post('dizi-id'), $this->input->post('sezon-numarası'), $this->input->post('bölüm-numarası'), 'tr');

		// Bölümü Veritabanına Gönder
		$this->IMDB_Operations_model->bölümü_aktar($bölüm_bilgileri, $this->input->post('dizi-id'), $this->input->post('episode-durum'), $this->input->post('downlad-images'));
		// Son Bölüm Ekleme Tarihini Güncelleme
		$dataupdate = array(
			'dizi_add_date' => date('Y-m-d H:i:s'),
		);
		$this->Admin_Operations_model->update_movie('dizi',$this->input->post('dizi-id') ,$dataupdate);

		$this->session->set_flashdata('info',başarılı_bildirimi('Bölümü ekleme başarılı.'));

		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function imdb_person_info_add(){
		
		
		$cast_bilgileri = $this->tmdb->getPerson($this->input->post('imdb-cast-id'));
		
		if($this->input->post('downlad-images')){
							
			//Kişi Resmini İndirme
				$resim_ismi = $cast_bilgileri['profile_path'];
				$resim_linki = image_url($cast_bilgileri['profile_path']);
				$resim_kayıt_yeri = 'assets/uploads/casts/'.$cast_bilgileri['name'] . '.' .pathinfo($resim_ismi)['extension'];
				copy($resim_linki,$resim_kayıt_yeri);
				
			// Kişiyi Veritabanına Gönder
			$cast_data = array(
				'cast_id' => $cast_bilgileri['id'],
				'cast_imdb_id' => $cast_bilgileri['imdb_id'],
				'cast_job' => $cast_bilgileri['known_for_department'],
				'cast_name' => $cast_bilgileri['name'],
				'cast_birth_day' => $cast_bilgileri['birthday'],
				'cast_death_day' => $cast_bilgileri['deathday'],
				'cast_birth_place' => $cast_bilgileri['place_of_birth'],	
				'cast_biography' => $cast_bilgileri['biography'],	
				'cast_image' => $cast_bilgileri['name'] . '.' .pathinfo($resim_ismi)['extension'],	
				'popularity' => $cast_bilgileri['popularity'],				
			);
			
			$sonuc = $this->Admin_Operations_model->add_cast($cast_data);			
			
		}else{
			
			// Kişiyi Veritabanına Gönder
			$cast_data = array(
				'cast_id' => $cast_bilgileri['id'],
				'cast_imdb_id' => $cast_bilgileri['imdb_id'],
				'cast_job' => $cast_bilgileri['known_for_department'],
				'cast_name' => $cast_bilgileri['name'],
				'cast_birth_day' => $cast_bilgileri['birthday'],
				'cast_death_day' => $cast_bilgileri['deathday'],
				'cast_birth_place' => $cast_bilgileri['place_of_birth'],	
				'cast_biography' => $cast_bilgileri['biography'],	
				'cast_image' => $cast_bilgileri['profile_path'],	
				'popularity' => $cast_bilgileri['popularity'],				
			);
			
			$sonuc = $this->Admin_Operations_model->add_cast($cast_data);			
			
			
		}
		
		if($sonuc){
			
			$this->session->set_flashdata('info',başarılı_bildirimi('Kişiyi ekleme başarılı.'));
			
			redirect($_SERVER['HTTP_REFERER']);
		}

	}

}
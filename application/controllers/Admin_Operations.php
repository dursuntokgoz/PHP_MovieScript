<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Operations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_Operations_model');
		$this->load->model('Admin_Operations_model');
		$this->load->model('IMDB_Operations_model');
		$this->load->model('Pagination_and_Filter_model');
		$this->load->library('form_validation');
		$this->load->library('tmdb');
	}

	public function login(){

		$email = $this->input->post('admin-email');
		$sifre = md5($this->input->post('admin-password'));
	
		$sonuc = $this->Admin_Operations_model->admin_login($email, $sifre);

		if($sonuc){
			$last_login_date = array(
				'admin_last_login' => date('Y-m-d H:i:s'),
			);
			$this->Admin_Operations_model->admin_last_login_date($last_login_date, $sonuc->admin_id);
			$this->session->set_userdata('admin_durum', true);
			$this->session->set_userdata('admin_bilgi', $sonuc);

			echo "başarılı";
		}else{
			echo "Girmiş olduğunuz bilgiler hatalı veya yönetici değilsiniz.";
		}

	}

	public function logout(){

		$this->session->sess_destroy();
		redirect(base_url('Admin'));

	}

	/* Site Temel Ayarları İşlemleri */	

	public function website_config(){

		$this->config->load('website_config', TRUE);


		$this->config->set_item('site_name','deneme');
		
		echo $this->config->item('site_name');
		$this->session->set_flashdata('info',başarılı_bildirimi('Başarıyla site ayarlarını güncellediniz.'));

		redirect($_SERVER['HTTP_REFERER']);

	}	


	/* Admin Ayarları İşlemleri */

	public function add_admin(){

		$admin_data = array(
			'admin_id' => $this->input->post('uye_id'),
			'admin_rütbe' => $this->input->post('admin_rütbe'),
		);

		$sonuc = $this->Admin_Operations_model->add_admin($admin_data);

		if($sonuc){

			$this->session->set_flashdata('info',başarılı_bildirimi('Başarıyla yetkiliyi eklediniz.'));

			redirect($_SERVER['HTTP_REFERER']);

		}else{

			$this->session->set_flashdata('info',başarısız_bildirimi('Yetkili ekleme başarısız.'));

			redirect($_SERVER['HTTP_REFERER']);

		}
	}

	public function edit_admin(){

		$admin_data = array(
			'admin_rütbe' => $this->input->post('admin_rütbe'),
		);

		$sonuc = $this->Admin_Operations_model->edit_admin($this->input->post('admin_id'), $admin_data);

		if($sonuc){

			$this->session->set_flashdata('info',başarılı_bildirimi('Başarıyla admin yetkilerini güncellediniz.'));

			redirect($_SERVER['HTTP_REFERER']);

		}else{

			$this->session->set_flashdata('info',başarısız_bildirimi('Yetkü güncelleme başarısız.'));

			redirect($_SERVER['HTTP_REFERER']);

		}
	}	

	/* Film ve Dizi İşlemleri */

	public function film_ekle(){
		$filmdosyauzantısı = 'assets/uploads/movies/'. seflink($this->input->post('movie_name'));
		mkdir($filmdosyauzantısı,'0777');

		$config = array(
			'upload_path' => $filmdosyauzantısı,
			'allowed_types' => 'jpg|jpeg|png',
		);

		// Load upload library 
		$this->load->library('upload',$config); 
	   
		// File upload
		if($this->upload->do_upload('film_image')){ 
			 // Get data about the file
			 $uploadData = $this->upload->data(); 
			 $filename = $uploadData['file_name']; 
			 $veritabanikayit = $filename;
		}
	   
		// File upload
		if($this->upload->do_upload('film_kapak_image')){ 
			 // Get data about the file
			 $uploadData = $this->upload->data(); 
			 $filename = $uploadData['file_name']; 
			 $veritabanikayit2 = $filename;
		}else{
			$veritabanikayit2 = null;
		}


		$movie_data = array_filter(array(
			'film_id' => $this->input->post('film_tmdb_id'),
			'film_imdb_id' => $this->tmdb->getMovieExternealIDs($this->input->post('film_tmdb_id'))['imdb_id'],
			'film_ad' => $this->input->post('movie_name'),
			'film_türü' => implode(',', $this->input->post('movie_type')),
			'film_release_date' => $this->input->post('movie_release_date'),
			'film_describe' => $this->input->post('movie_description'),
			'film_süresi' => $this->input->post('movie_duration'),
			'film_puanı' => $this->input->post('movie_mark'),
			'film_bütçesi' => $this->input->post('movie_cost'),
			'film_keywords' => $this->input->post('movie_keywords'),
			'film_trailer' => $this->input->post('movie_trailer'),
			'film_add_date' => date('Y-m-d H:i:s'),
			'film_sef_link' => seflink($this->input->post('movie_name')),
			'film_image' => $veritabanikayit,
			'film_kapak_image' => $veritabanikayit2,
			'film_facebook' => $this->input->post('movie_facebook'),
			'film_twitter' => $this->input->post('movie_twitter'),
			'film_instagram' => $this->input->post('movie_instagram'),
		));

		$sonuc = $this->Admin_Operations_model->add_movie('film', $movie_data);

		if($sonuc){

			$this->session->set_flashdata('info',başarılı_bildirimi('Filmi başarıyla eklediniz.'));

			redirect($_SERVER['HTTP_REFERER']);

		}else{

			$this->session->set_flashdata('info',başarısız_bildirimi('Filmi ekleme başarısız.'));

			redirect($_SERVER['HTTP_REFERER']);

		}

		
	}

	public function dizi_ekle(){
		$dizidosyauzantısı = 'assets/uploads/movies/'. seflink($this->input->post('dizi_name'));
		mkdir($dizidosyauzantısı,'0777');
		$config = array(
			'upload_path' => $dizidosyauzantısı,
			'allowed_types' => 'jpg|jpeg|png',
		);

		// Load upload library 
		$this->load->library('upload',$config); 
	   
		// File upload
		if($this->upload->do_upload('movie_image')){ 
			 // Get data about the file
			 $uploadData = $this->upload->data(); 
			 $filename = $uploadData['file_name']; 
			 $veritabanikayit = $filename;
		}
	   
		// File upload
		if($this->upload->do_upload('dizi_kapak_image')){ 
			 // Get data about the file
			 $uploadData = $this->upload->data(); 
			 $filename = $uploadData['file_name']; 
			 $veritabanikayit2 = $filename;
		}else{
			$veritabanikayit2 = null;
		}

		if($this->input->post('dizi_finished_date')){$dizi_continue == "Ended";}else{$dizi_continue == "Devam Ediyor.";};
		$movie_data = array_filter(array(
			'dizi_id' => $this->input->post('dizi_tmdb_id'),
			'dizi_imdb_id' => $this->tmdb->getTVShowExternealIDs($this->input->post('dizi_tmdb_id'))['imdb_id'],
			'dizi_ad' => $this->input->post('dizi_name'),
			'dizi_türü' => implode(',', $this->input->post('dizi_type')),
			'dizi_release_date' => $this->input->post('dizi_release_date'),
			'dizi_finished_date' => $this->input->post('dizi_finished_date'),
			'dizi_continue' => $dizi_continue,
			'dizi_sezon_sayisi' => $this->input->post('dizi_season_number'),
			'dizi_describe' => $this->input->post('dizi_description'),
			'dizi_puanı' => $this->input->post('dizi_puani'),
			'dizi_keywords' => $this->input->post('dizi_keywords'),
			'dizi_trailer' => $this->input->post('dizi_trailer'),
			'dizi_add_date' => date('Y-m-d H:i:s'),
			'dizi_sef_link' => seflink($this->input->post('dizi_name')),
			'dizi_image' => $veritabanikayit,
			'dizi_kapak_image' => $veritabanikayit2,
			'dizi_facebook' => $this->input->post('movie_facebook'),
			'dizi_twitter' => $this->input->post('movie_twitter'),
			'dizi_instagram' => $this->input->post('movie_instagram'),
		));

		$sonuc = $this->Admin_Operations_model->add_movie('dizi', $movie_data);

		if($sonuc){

			$this->session->set_flashdata('info',başarılı_bildirimi('Diziyi başarıyla eklediniz.'));

			redirect($_SERVER['HTTP_REFERER']);

		}else{

			$this->session->set_flashdata('info',başarısız_bildirimi('Diziyi eklerken bir hata meydana geldi.'));
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	public function add_episode(){
		$dizidosyauzantısı = 'assets/uploads/movies/'. seflink($this->input->post('dizi-ad'));
		$config = array(
			'upload_path' => $dizidosyauzantısı,
			'allowed_types' => 'jpg|jpeg|png',
		);

		// Load upload library 
		$this->load->library('upload',$config); 
	   
		// Bölüm Resmi upload
		if($this->upload->do_upload('episode_image')){ 
			 // Get data about the file
			 $uploadData = $this->upload->data(); 
			 $filename = $uploadData['file_name'];
			 $veritabanikayit = $filename;
		}else{

			$veritabanikayit = null;

		}

		$episode_data = array_filter(array(
			'episode_id' => $this->tmdb->getTVShowEpisode($this->input->post('dizi-id'), $this->input->post('season-number'), $this->input->post('episode-number'), 'tr')['id'],
			'dizi_id' => $this->input->post('dizi-id'),
			'season_number' => $this->input->post('season-number'),
			'episode_number' => $this->input->post('episode-number'),
			'episode_name' => $this->input->post('episode-name'),
			'episode_describe' => $this->input->post('episode-description'),
			'episode_puan' => $this->input->post('episode-puan'),
			'episode_süre' => $this->input->post('episode-süre'),
			'episode_release_date' => $this->input->post('episode-release-date'),
			'episode_durum' => $this->input->post('episode-durum'),
			'episode_sef_link' => seflink($this->input->post('dizi-ad').' Sezon '.$this->input->post('season-number').' Bölüm '.$this->input->post('episode-number')),
			'episode_watch_link' => $this->input->post('episode-watch-link'),
			'episode_image' => $veritabanikayit,
			'episode_add_date' => date('Y-m-d H:i:s'),
		));

		$dizi_data = array(
			'dizi_add_date' => date('Y-m-d H:i:s'),
		);


		$sonuc = $this->Admin_Operations_model->add_episode($episode_data);
				 $this->Admin_Operations_model->update_movie('dizi',$this->input->post('dizi-id'),$dizi_data);
		
		if($sonuc){

				$this->session->set_flashdata('info',başarılı_bildirimi('Bölümü başarıyla eklediniz.'));

				redirect($_SERVER['HTTP_REFERER']);

		}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Bölümü eklerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function film_update(){

		$film_bilgileri = $this->Admin_Operations_model->print_film($this->input->post('film-id'));
		$filmeskidosyauzantısı = 'assets/uploads/movies/'. $film_bilgileri->film_sef_link;
		$filmyenidosyauzantısı = 'assets/uploads/movies/'. seflink($this->input->post('movie_name'));
		
		// Filme Kaynak Ekleme
		
		if($this->input->post('kaynak_url')){
				
			$source_data = array_filter(array(
				'film_id' => $this->input->post('film-id'),
				'kaynak_türü' => $this->input->post('kaynak_türü'),
				'kaynak_ismi' => $this->input->post('kaynak_ismi'),
				'kaynak_kalite' => $this->input->post('kaynak_kalite'),
				'kaynak_url' => $this->input->post('kaynak_url'),
			));

			$sonuc = $this->Admin_Operations_model->add_source($source_data);

			if($sonuc){

				$this->session->set_flashdata('info',başarılı_bildirimi('Kaynak ekleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

			}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Kaynak eklerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);

			}
				
		}		
		// Film Resimleri Ekleme
		elseif($this->input->post('image_urls')){
			foreach(explode(',',$this->input->post('image_urls')) as $image_url){
				$resim_ismi = basename($image_url);
				$resim_kayıt_yeri = $filmeskidosyauzantısı.'/'.$resim_ismi;
				copy($image_url, $resim_kayıt_yeri);

				// Resimler Tablosuna Yazılacaklar
				$image_data = array(
					'film_id' => $film_bilgileri->film_id,
					'image_url' => $resim_ismi,
				);
				$sonuc = $this->Admin_Operations_model->add_image($image_data);
			}
			
			if($sonuc){
				$this->session->set_flashdata('info',başarılı_bildirimi('Resimleri ekleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

			}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Diziyi güncellerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		// Film Youtube Videolarını Ekleme
		elseif($this->input->post('youtube_video_urls')){
			foreach(explode(',',$this->input->post('youtube_video_urls')) as $youtube_video_url){
				// Videolar Tablosuna Yazılacaklar
				$youtube_video_data = array(
					'film_id' => $film_bilgileri->film_id,
					'video_site' => 'YouTube',
					'video_type'=> 'Recommended',
					'video_url' => $youtube_video_url,
				);
				$sonuc = $this->Admin_Operations_model->add_video($youtube_video_data);
			}
			
			if($sonuc){
				$this->session->set_flashdata('info',başarılı_bildirimi('Videoları ekleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

			}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Diziyi güncellerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
			}
		}else{

			if($this->input->post('movie_name')){
				rename($filmeskidosyauzantısı, $filmyenidosyauzantısı);

				$config = array(
					'upload_path' => $filmyenidosyauzantısı,
					'allowed_types' => 'jpg|jpeg|png',
				);

				// Load upload library 
				$this->load->library('upload',$config); 
			   
				// Film Posteri upload
				if($this->upload->do_upload('film_image')){ 
					 // Get data about the file
					 $uploadData = $this->upload->data(); 
					 $filename = $uploadData['file_name']; 
					 $veritabanikayit = $filename;
				}else{
					if($this->input->post('movie_name')){
						$eski_resim_ismi = $film_bilgileri->film_image;
						$veritabanikayit = $eski_resim_ismi;
					}else{
						$veritabanikayit = null;
					}
				}
			   
				// Film Kapak Resmi upload
				if($this->upload->do_upload('film_kapak_image')){ 
					 // Get data about the file
					 $uploadData = $this->upload->data(); 
					 $filename = $uploadData['file_name']; 
					 $veritabanikayit2 = $filename;
				}else{
					if($this->input->post('movie_name')){
						$eski_resim_ismi = $film_bilgileri->film_kapak_image;
						$veritabanikayit2 = $eski_resim_ismi;
					}else{
						$veritabanikayit2 = null;
					}
				}

			}else{

				$config = array(
					'upload_path' => $filmeskidosyauzantısı,
					'allowed_types' => 'jpg|jpeg|png',
				);

				// Load upload library 
				$this->load->library('upload',$config); 
			   
				// Film Posteri upload
				if($this->upload->do_upload('film_image')){ 
					 // Get data about the file
					 $uploadData = $this->upload->data(); 
					 $filename = $uploadData['file_name']; 
					 $veritabanikayit = $filename;
				}else{

					$veritabanikayit = null;

				}
			   
				// Film Kapak Resmi upload
				if($this->upload->do_upload('film_kapak_image')){ 
					 // Get data about the file
					 $uploadData = $this->upload->data(); 
					 $filename = $uploadData['file_name']; 
					 $veritabanikayit2 = $filename;
				}else{

					$veritabanikayit2 = null;

				}

			}
			
			$movie_data = array_filter(array(
				'film_ad' => $this->input->post('movie_name'),
				'film_türü' => implode(',', $this->input->post('movie_type')),
				'film_release_date' => $this->input->post('movie_release_date'),
				'film_describe' => $this->input->post('movie_description'),
				'film_süresi' => $this->input->post('movie_duration'),
				'film_puanı' => $this->input->post('movie_mark'),
				'film_bütçesi' => $this->input->post('movie_cost'),
				'film_keywords' => $this->input->post('movie_keywords'),
				'film_trailer' => $this->input->post('movie_trailer'),
				'film_add_date' => date('Y-m-d H:i:s'),
				'film_sef_link' => seflink($this->input->post('movie_name')),
				'film_image' => $veritabanikayit,
				'film_kapak_image' => $veritabanikayit2,
				'film_facebook' => $this->input->post('movie_facebook'),
				'film_twitter' => $this->input->post('movie_twitter'),
				'film_instagram' => $this->input->post('movie_instagram'),
				'film_ekibi' => implode(',', $this->input->post('cast_ids')),
			));

			$sonuc = $this->Admin_Operations_model->update_movie('film',$this->input->post('film-id'),$movie_data);

			if($sonuc){
				$this->session->set_flashdata('info',başarılı_bildirimi('Filmi güncelleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

			}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Filmi güncellerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
	}	

	public function dizi_update(){
		$dizi_bilgileri = $this->Admin_Operations_model->print_dizi($this->input->post('dizi-id'));
		$dizieskidosyauzantısı = 'assets/uploads/movies/'. $dizi_bilgileri->dizi_sef_link;
		$diziyenidosyauzantısı = 'assets/uploads/movies/'. seflink($this->input->post('dizi_name'));
		// Dizi Kaynak Ekleme
		
		if($this->input->post('kaynak_url')){
				
			$source_data = array_filter(array(
				'dizi_id' => $this->input->post('dizi-id'),
				'bölüm_id' => $this->input->post('bölüm-id'),
				'kaynak_türü' => $this->input->post('kaynak_türü'),
				'kaynak_ismi' => $this->input->post('kaynak_ismi'),
				'kaynak_kalite' => $this->input->post('kaynak_kalite'),
				'kaynak_url' => $this->input->post('kaynak_url'),
			));

			$sonuc = $this->Admin_Operations_model->add_source($source_data);

			if($sonuc){

				$this->session->set_flashdata('info',başarılı_bildirimi('Kaynak ekleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

			}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Kaynak eklerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);

			}
				
		}		
		// Dizi Resimleri Ekleme
		elseif($this->input->post('image_urls')){
			
			foreach(explode(',',$this->input->post('image_urls')) as $image_url){
				$resim_ismi = basename($image_url);
				$resim_kayıt_yeri = $dizieskidosyauzantısı.'/'.$resim_ismi;
				copy($image_url, $resim_kayıt_yeri);

				// Resimler Tablosuna Yazılacaklar
				$image_data = array(
					'dizi_id' => $dizi_bilgileri->dizi_id,
					'image_url' => $resim_ismi,
				);
				$sonuc = $this->Admin_Operations_model->add_image($image_data);
			}	
			
			if($sonuc){
				$this->session->set_flashdata('info',başarılı_bildirimi('Resimleri ekleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

			}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Diziyi güncellerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
		// Dizi Youtube Videolarını Ekleme
		elseif($this->input->post('youtube_video_urls')){
			
			foreach(explode(',',$this->input->post('youtube_video_urls')) as $youtube_video_url){
				// Videolar Tablosuna Yazılacaklar
				$youtube_video_data = array(
					'dizi_id' => $dizi_bilgileri->dizi_id,
					'video_site' => 'YouTube',
					'video_type'=> 'Recommended',
					'video_url' => $youtube_video_url,
				);
				$sonuc = $this->Admin_Operations_model->add_video($youtube_video_data);
			}
			
			if($sonuc){
				$this->session->set_flashdata('info',başarılı_bildirimi('Videoları ekleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

			}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Diziyi güncellerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}else{
				
			if($this->input->post('dizi_name')){
				rename($dizieskidosyauzantısı, $diziyenidosyauzantısı);

				$config = array(
					'upload_path' => $diziyenidosyauzantısı,
					'allowed_types' => 'jpg|jpeg|png',
				);

				// Load upload library 
				$this->load->library('upload',$config); 

				// Dizi Posteri upload
				if($this->upload->do_upload('movie_image')){ 
					 // Get data about the file
					 $uploadData = $this->upload->data(); 
					 $filename = $uploadData['file_name']; 
					 $veritabanikayit = $filename;
				}else{
					if($this->input->post('dizi_name')){
						$eski_resim_ismi = $dizi_bilgileri->dizi_image;
						$veritabanikayit = $eski_resim_ismi;
					}else{
						$veritabanikayit = null;
					}
				}

				// Dizi Kapak Resmi  upload
				if($this->upload->do_upload('dizi_kapak_image')){ 
					 // Get data about the file
					 $uploadData = $this->upload->data(); 
					 $filename = $uploadData['file_name']; 
					 $veritabanikayit2 = $filename;
				}else{
					if($this->input->post('dizi_name')){
						$eski_resim_ismi = $dizi_bilgileri->dizi_kapak_image;
						$veritabanikayit2 = $eski_resim_ismi;
					}else{
						$veritabanikayit2 = null;
					}
				}

			}else{

				$config = array(
					'upload_path' => $dizieskidosyauzantısı,
					'allowed_types' => 'jpg|jpeg|png',
				);

				// Load upload library 
				$this->load->library('upload',$config); 

				// File upload
				if($this->upload->do_upload('movie_image')){ 
					 // Get data about the file
					 $uploadData = $this->upload->data(); 
					 $filename = $uploadData['file_name']; 
					 $veritabanikayit = $filename;
				}else{

					$veritabanikayit = null;

				}

				// Kapak Resmi File upload
				if($this->upload->do_upload('dizi_kapak_image')){ 
					 // Get data about the file
					 $uploadData = $this->upload->data(); 
					 $filename = $uploadData['file_name']; 
					 $veritabanikayit2 = $filename;
				}else{
					$veritabanikayit2 = null;
				}
			}
			
			if($this->input->post('dizi_release_date') && $this->input->post('dizi_finished_date')){$dizi_continue == "Ended";}elseif($this->input->post('dizi_release_date')){$dizi_continue == "Devam Ediyor.";}else{$dizi_continue = null;}

			$movie_data = array_filter(array(
				'dizi_ad' => $this->input->post('dizi_name'),
				'dizi_türü' => implode(',', $this->input->post('dizi_type')),
				'dizi_release_date' => $this->input->post('dizi_release_date'),
				'dizi_finished_date' => $this->input->post('dizi_finished_date'),
				'dizi_continue' => $dizi_continue,
				'dizi_sezon_sayisi' => $this->input->post('dizi_season_number'),
				'dizi_describe' => $this->input->post('dizi_description'),
				'dizi_puanı' => $this->input->post('dizi_puani'),
				'dizi_keywords' => $this->input->post('dizi_keywords'),
				'dizi_trailer' => $this->input->post('dizi_trailer'),
				'dizi_sef_link' => seflink($this->input->post('dizi_name')),
				'dizi_image' => $veritabanikayit,
				'dizi_kapak_image' => $veritabanikayit2,
				'dizi_facebook' => $this->input->post('movie_facebook'),
				'dizi_twitter' => $this->input->post('movie_twitter'),
				'dizi_instagram' => $this->input->post('movie_instagram'),
				'dizi_cast' => implode(',', $this->input->post('cast_ids')),
			));

			$sonuc = $this->Admin_Operations_model->update_movie('dizi',$this->input->post('dizi-id'),$movie_data);

			if($sonuc){
				$this->session->set_flashdata('info',başarılı_bildirimi('Diziyi güncelleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

			}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Diziyi güncellerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}


	}

	public function update_episode(){

		$dizi_bilgileri = $this->Admin_Operations_model->print_dizi($this->input->post('dizi-id'));
		$bölüm_bilgileri = $this->Admin_Operations_model->print_episode($this->input->post('episodeId'));

		$bölümdosyauzantısı = 'assets/uploads/movies/'. $dizi_bilgileri->dizi_sef_link;

		if($this->input->post('season-number') && $this->input->post('episode-number')){

			$config = array(
				'upload_path' => $bölümdosyauzantısı,
				'allowed_types' => 'jpg|jpeg|png',
			);

			// Load upload library 
			$this->load->library('upload',$config); 
		   
			// File upload
			if($this->upload->do_upload('episode_image')){ 
				 // Get data about the file
				 $uploadData = $this->upload->data(); 
				 $filename = $uploadData['file_name'];
				 $veritabanikayit = $filename;
			}else{
				if($this->input->post('season-number')){
					$eskiresimuzantısı = $bölüm_bilgileri->episode_image;
					$veritabanikayit = $eskiresimuzantısı;
				}else{
					$veritabanikayit = null;
				}
			}

		}elseif($this->input->post('season-number')){

			$config = array(
				'upload_path' => $bölümdosyauzantısı,
				'allowed_types' => 'jpg|jpeg|png',
			);

			// Load upload library 
			$this->load->library('upload',$config); 
		   
			// File upload
			if($this->upload->do_upload('episode_image')){ 
				 // Get data about the file
				 $uploadData = $this->upload->data(); 
				 $filename = $uploadData['file_name'];
				 $veritabanikayit = $filename;
			}else{
				if($this->input->post('season-number')){
					$eskiresimuzantısı = $bölüm_bilgileri->episode_image;
					$veritabanikayit = $eskiresimuzantısı;
				}else{
					$veritabanikayit = null;
				}
			}


		}elseif($this->input->post('episode-number')){

			$config = array(
				'upload_path' => $bölümdosyauzantısı,
				'allowed_types' => 'jpg|jpeg|png',
			);

			// Load upload library 
			$this->load->library('upload',$config); 
		   
			// File upload
			if($this->upload->do_upload('episode_image')){ 
				 // Get data about the file
				 $uploadData = $this->upload->data(); 
				 $filename = $uploadData['file_name'];
				 $veritabanikayit = $filename;
			}else{
				if($this->input->post('season-number')){
					$eskiresimuzantısı = $bölüm_bilgileri->episode_image;
					$veritabanikayit = $eskiresimuzantısı;
				}else{
					$veritabanikayit = null;
				}
			}

		}
		else{
			$config = array(
				'upload_path' => $bölümdosyauzantısı,
				'allowed_types' => 'jpg|jpeg|png',
			);

			// Load upload library 
			$this->load->library('upload',$config); 
		   
			// File upload
			if($this->upload->do_upload('episode_image')){ 
				 // Get data about the file
				 $uploadData = $this->upload->data(); 
				 $filename = $uploadData['file_name'];
				 $veritabanikayit = $filename;
			}else{

				$veritabanikayit = null;

			}
		}

		if($this->input->post('season-number') && $this->input->post('episode-number')){
			$yeniseflink = seflink($dizi_bilgileri->dizi_ad .' Sezon '.$this->input->post('season-number').' Bölüm '.$this->input->post('episode-number'));
		}elseif($this->input->post('season-number')){
			$yeniseflink = seflink($dizi_bilgileri->dizi_ad .' Sezon '.$this->input->post('season-number').' Bölüm '.$bölüm_bilgileri->episode_number);
		}elseif($this->input->post('episode-number')){
			$yeniseflink = seflink($dizi_bilgileri->dizi_ad .' Sezon '.$bölüm_bilgileri->season_number.' Bölüm '.$this->input->post('episode-number'));
		}else{
			$yeniseflink = null;
		}
		$episode_data = array_filter(array(
			'season_number' => $this->input->post('season-number'),
			'episode_number' => $this->input->post('episode-number'),
			'episode_name' => $this->input->post('episode-name'),
			'episode_describe' => $this->input->post('episode-description'),
			'episode_puan' => $this->input->post('episode-puan'),
			'episode_süre' => $this->input->post('episode-süre'),
			'episode_release_date' => $this->input->post('episode-release-date'),
			'episode_durum' => $this->input->post('episode-durum'),
			'episode_sef_link' => $yeniseflink,
			'episode_watch_link' => $this->input->post('episode-watch-link'),
			'episode_image' => $veritabanikayit,
		));

		$dizi_data = array(
			'dizi_add_date' => date('Y-m-d H:i:s'),
		);

		$sonuc = $this->Admin_Operations_model->update_episode($this->input->post('episodeId'), $episode_data);
				 $this->Admin_Operations_model->update_movie('dizi',$this->input->post('dizi-id'),$dizi_data);

		if($sonuc){

				$this->session->set_flashdata('info',başarılı_bildirimi('Bölümü güncelleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

		}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Bölümü güncellerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	public function confirm_comment(){
		$comment_data = array(
			'comment_onay' => 1,
		);
		$sonuc = $this->Admin_Operations_model->update_comment($this->input->post('yorum_id'), $comment_data);
		
		if($sonuc){
			echo true;
		}else{
			echo false;
		}		
	}	
	public function unconfirm_comment(){
		$comment_data = array(
			'comment_onay' => 0,
		);
		$sonuc = $this->Admin_Operations_model->update_comment($this->input->post('yorum_id'), $comment_data);
		
		if($sonuc){
			echo true;
		}else{
			echo false;
		}		
	}		
	public function delete_comment(){
		
		$sonuc = $this->Admin_Operations_model->delete_comment($this->input->post('yorum_id'));
		
		if($sonuc){
			echo true;
		}else{
			echo false;
		}		
	}	

	public function delete_function(){

		if($this->session->userdata('admin_durum')){
				
			$type = $this->input->post('delete_type');
			if($type == 'film'){
				$this->Admin_Operations_model->delete_function($type, $this->input->post('movie_id'));
			}
			elseif($type == 'dizi'){
				$this->Admin_Operations_model->delete_function($type, $this->input->post('movie_id'));				
			}
			elseif($type == 'bölüm'){
				$this->Admin_Operations_model->delete_function($type, $this->input->post('movie_id'));
			}
			elseif($type == 'kaynak'){
				$this->Admin_Operations_model->delete_function($type, $this->input->post('kaynak_id'));
			}
			elseif($type == 'resim'){
				$this->Admin_Operations_model->delete_function($type, $this->input->post('image_id'));
			}
			elseif($type == 'video'){
				$this->Admin_Operations_model->delete_function($type, $this->input->post('video_id'));
			}
			elseif($type == 'cast'){
				$this->Admin_Operations_model->delete_function($type, $this->input->post('cast_id'));
			}

		}else{

			redirect('Admin');

		}

	}
	
	/* Yapımcı Düzenleme İşlemleri */

	public function edit_cast(){
		
			$config = array(
				'upload_path' => 'assets/uploads/casts',
				'allowed_types' => 'jpg|jpeg|png',
				'file_name' => seflink($this->input->post('cast_name')),
			);

			// Load upload library 
			$this->load->library('upload',$config); 
		   
			// File upload
			if($this->upload->do_upload('cast_image')){ 
				 // Get data about the file
				 $uploadData = $this->upload->data(); 
				 $filename = $uploadData['file_name'];
				 $veritabanikayit = $filename;
			}
			
			$cast_data = array_filter(array(
				'cast_imdb_id' => $this->input->post('cast_imdb_id'),
				'cast_job' => $this->input->post('cast_job'),
				'cast_name' => $this->input->post('cast_name'),
				'cast_birth_day' => $this->input->post('cast_birth_day'),
				'cast_death_day' => $this->input->post('cast_death_day'),
				'cast_birth_place' => $this->input->post('cast_birth_place'),
				'cast_biography' => $this->input->post('cast_biography'),
				'cast_image' => $veritabanikayit,
			));
			
			$sonuc = $this->Admin_Operations_model->edit_cast($this->input->post('cast_id'), $cast_data);
			
		if($sonuc){

				$this->session->set_flashdata('info',başarılı_bildirimi('Profili güncelleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

		}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Profil güncellerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	public function add_cast(){
		
			$config = array(
				'upload_path' => 'assets/uploads/casts',
				'allowed_types' => 'jpg|jpeg|png',
				'file_name' => seflink($this->input->post('cast_name')),
			);

			// Load upload library 
			$this->load->library('upload',$config); 
		   
			// File upload
			if($this->upload->do_upload('cast_image')){ 
				 // Get data about the file
				 $uploadData = $this->upload->data(); 
				 $filename = $uploadData['file_name'];
				 $veritabanikayit = $filename;
			}
			
			$cast_data = array_filter(array(
				'cast_id' => rand(10000000, 99999999),
				'cast_imdb_id' => $this->input->post('cast_imdb_id'),
				'cast_job' => $this->input->post('cast_job'),
				'cast_name' => $this->input->post('cast_name'),
				'cast_birth_day' => $this->input->post('cast_birth_day'),
				'cast_death_day' => $this->input->post('cast_death_day'),
				'cast_birth_place' => $this->input->post('cast_birth_place'),
				'cast_biography' => $this->input->post('cast_biography'),
				'cast_image' => $veritabanikayit,
			));
			
			$sonuc = $this->Admin_Operations_model->add_cast($cast_data);
			
		if($sonuc){

				$this->session->set_flashdata('info',başarılı_bildirimi('Kişiyi ekleme başarılı.'));

				redirect($_SERVER['HTTP_REFERER']);

		}else{

				$this->session->set_flashdata('info',başarısız_bildirimi('Kişiyi eklerken bir hata meydana geldi.'));

				redirect($_SERVER['HTTP_REFERER']);
		}
	}	

	/* Kullanıcı Düzenleme İşlemleri */

	public function edit_user(){

		/* K. Adı İsim ve Soyisim Değişikliği*/
			$this->form_validation->set_rules('change_nickname','Kullanıcı adı','is_unique[uyeler.uye_nickname]');
			$this->form_validation->set_message('is_unique','<div class="alert alert-danger"><strong>Hata!</strong> Girmiş olduğunuz %s kayıtlı.</div>');


		/* Şifre değişikliği */

			$this->form_validation->set_rules('change_password','Yeni Şifre','matches[change_re_password]|min_length[6]|trim');
			$this->form_validation->set_rules('change_re_password','Yeni Şifre Onayı','trim');

			$this->form_validation->set_message('matches','<div class="alert alert-danger"><strong>Hata!</strong> Yeni şifreler birbiriyle uyuşmuyor.</div>');
			$this->form_validation->set_message('min_length','<div class="alert alert-danger"><strong>Hata!</strong> %s en az 6 karakterden oluşmak zorundadır.</div>');

			$id_bilgisi = $this->input->post('id_bilgisi');

		if($this->form_validation->run()){

				$changed_infos = array_filter(array(
					'uye_nickname' =>	$this->input->post('change_nickname'),
					'uye_ad' =>	$this->input->post('change_name'),
					'uye_soyad' =>	$this->input->post('change_surname'),
					'uye_email' =>	$this->input->post('change_email'),
					'uye_sifre' =>	md5($this->input->post('change_password')),
					'uye_facebook_url' => $this->input->post('change_facebook_url'),
					'uye_twitter_url' => $this->input->post('change_twitter_url'),
					'uye_aktif' => $this->input->post('uye_aktiflik'),
				));
					
			$sonuc = $this->Member_Operations_model->profileupdate($changed_infos, $id_bilgisi);
		
			if($sonuc){

				echo '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
					   Başarıyla üye bilgilerini değiştirdiniz.
					  </div>';
			}

		}else{

			echo validation_errors();

		}
	}
	
	public function ban_user(){

		$changed_infos = array(
			'uye_aktif' => 0,
		);
					
		$sonuc = $this->Member_Operations_model->profileupdate($changed_infos, $this->input->post('üye_id'));
		
		if($sonuc){
			echo true;			
		}else{
			echo false;
		}
		
	}
	
	public function unban_user(){

		$changed_infos = array(
			'uye_aktif' => 1,
		);
					
		$sonuc = $this->Member_Operations_model->profileupdate($changed_infos, $this->input->post('üye_id'));
		
		if($sonuc){
			echo true;			
		}else{
			echo false;
		}
		
	}	

}

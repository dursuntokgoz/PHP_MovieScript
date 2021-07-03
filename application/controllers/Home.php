<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_Operations_model');
		$this->load->model('Frontend_Operations_model');
		$this->load->model('Admin_Operations_model');
		$this->load->model('Pagination_and_Filter_model');
		$this->load->library('pagination');
	}

	public function index()
	{
		$ensoneklenenfilmler = $this->Frontend_Operations_model->en_son_eklenen_filmler();
		$sonçıkanfilmler = $this->Frontend_Operations_model->son_çıkan_filmler();
		$ençokgörüntülenenfilmler = $this->Frontend_Operations_model->en_çok_görüntülenen_filmler();
		$imdbpuanıyüksekfilmler = $this->Frontend_Operations_model->imdb_puanı_yüksek_filmler();
		$yakındaçıkacakfilmler = $this->Frontend_Operations_model->yakında_çıkacak_filmler();
		
		$imdbpuanıyüksekdiziler = $this->Frontend_Operations_model->imdb_puanı_yüksek_diziler();
		$yakındaçıkacakbölümler = $this->Frontend_Operations_model->yakında_çıkacak_bölümler();		


		$sonçıkanbölümler = $this->Frontend_Operations_model->bölümler();
		if($this->session->userdata('durum') == true){
			$favorisonçıkanbölümler = $this->Frontend_Operations_model->favoridizibölümleri($this->session->userdata('user')->uye_id);
		}else{
			$favorisonçıkanbölümler = null;
		};

		$viewData = array(
			'ensoneklenenfilmler' => $ensoneklenenfilmler,
			'sonçıkanfilmler' => $sonçıkanfilmler,
			'ençokgörüntülenenfilmler' => $ençokgörüntülenenfilmler,
			'imdbpuanıyüksekfilmler' => $imdbpuanıyüksekfilmler,
			'yakındaçıkacakfilmler' => $yakındaçıkacakfilmler,

			'imdbpuanıyüksekdiziler' => $imdbpuanıyüksekdiziler,
			'yakındaçıkacakbölümler' => $yakındaçıkacakbölümler,
			
			'sonçıkanbölümler' => $sonçıkanbölümler,
			'favorisonçıkanbölümler' => $favorisonçıkanbölümler,
		);

		$this->load->view('frontend/Home_view', $viewData);
	}
	
	public function kesfet(){
		
		$viewData = array(

		);
		
		$this->load->view('frontend/Keşfet_view', $viewData);
	}	

	public function trend(){

		$haftalık_trend_filmler = $this->Frontend_Operations_model->haftalık_trend_filmler();
		$haftalık_trend_diziler = $this->Frontend_Operations_model->haftalık_trend_diziler();	
	
		$tüm_zamanların_trend_filmleri = $this->Frontend_Operations_model->en_çok_görüntülenen_filmler();
		$tüm_zamanların_trend_dizileri = $this->Frontend_Operations_model->en_çok_görüntülenen_diziler();
		
		$viewData = array(
			'haftalık_trend_filmler' => $haftalık_trend_filmler,
			'haftalık_trend_diziler' => $haftalık_trend_diziler,
			'tüm_zamanların_trend_filmleri' => $tüm_zamanların_trend_filmleri,
			'tüm_zamanların_trend_dizileri' => $tüm_zamanların_trend_dizileri,
		);
		
		
		$this->load->view('frontend/movies/Trends_view', $viewData);
	}
	
	public function top10(){
			
		$top_10_filmler = top10('film');		
		$top_10_diziler = top10('dizi');
		
		$viewData = array(
			'top_10_filmler' => $top_10_filmler,
			'top_10_diziler' => $top_10_diziler,
		);
		
		
		$this->load->view('frontend/movies/Top_10_view', $viewData);
	}	

	public function takvim(){
			
		$film_takvim = $this->Frontend_Operations_model->print_film_takvim();		
		$dizi_takvim = $this->Frontend_Operations_model->print_dizi_takvim();
		
		$viewData = array(
			'film_takvim' => $film_takvim,
			'dizi_takvim' => $dizi_takvim,
		);
		
		
		$this->load->view('frontend/movies/Takvim_view', $viewData);
	}	

	public function filmler($film_sef_link = null){

		$sonuc = $this->Frontend_Operations_model->filmveyadizivarmı('film', $film_sef_link);

		if($sonuc == true){

			$film_ekibi = $this->Frontend_Operations_model->cast(explode(',', $sonuc->film_ekibi));

			$şirket = $this->Frontend_Operations_model->şirket(explode(',', $sonuc->film_şirketi));
			$yorumlar = $this->Frontend_Operations_model->yorumlar('film', $sonuc->film_id);
			$resimler = $this->Frontend_Operations_model->resimler('film', $sonuc->film_id, null);
			$videolar = $this->Frontend_Operations_model->videolar('film', $sonuc->film_id, null);
			$ilgilifilmler = $this->Frontend_Operations_model->print_recomended_movies("film",$sonuc);

			$viewData = array(
				'film_bilgileri' => $sonuc,
				'film_ekibi' => $film_ekibi,
				'film_şirketi' => $şirket,
				'film_yorumları' => $yorumlar,
				'film_resimleri' => $resimler,
				'film_videoları' => $videolar,
				'ilgili_filmler' => $ilgilifilmler,
			);
			// Film Görüntülenme Sayısı Ekleme
			$this->Frontend_Operations_model->add_view("film",$sonuc->film_id);
			
			$this->load->view('frontend/movies/Film_view', $viewData);

		}else{

			if($this->input->post('filter_type')){				
				$filmler = $this->Frontend_Operations_model->filmler($this->input->post('filter_type'));	
			}else{
				$filmler = $this->Frontend_Operations_model->filmler();
			}


			$viewData = array(
				'filmler' => $filmler,
				'film_count' => $this->Admin_Operations_model->print_count('film'),
			);

			$this->load->view('frontend/movies/Filmler_view', $viewData);

		}
	}

	public function diziler($dizi_sef_link = null){

		$sonuc = $this->Frontend_Operations_model->filmveyadizivarmı('dizi', $dizi_sef_link);

		if($sonuc == true){

			$dizi_ekibi = $this->Frontend_Operations_model->cast(explode(',', $sonuc->dizi_cast));

			$şirket = $this->Frontend_Operations_model->şirket(explode(',', $sonuc->dizi_şirketi));
			$yorumlar = $this->Frontend_Operations_model->yorumlar('dizi', $sonuc->dizi_id);
			$resimler = $this->Frontend_Operations_model->resimler('dizi', $sonuc->dizi_id, null);
			$videolar = $this->Frontend_Operations_model->videolar('dizi', $sonuc->dizi_id, null);
			$ilgilidiziler = $this->Frontend_Operations_model->print_recomended_movies("dizi",$sonuc);

			$dizi_bölümleri = $this->Admin_Operations_model->print_episodes($sonuc->dizi_id);
			
			$viewData = array(
				'dizi_bilgileri' => $sonuc,
				'dizi_bölümleri' => $dizi_bölümleri,
				'dizi_ekibi' => $dizi_ekibi,
				'dizi_şirketi' => $şirket,
				'dizi_resimleri' => $resimler,
				'dizi_videoları' => $videolar,
				'dizi_yorumları' => $yorumlar,
				'ilgili_diziler' => $ilgilidiziler,
			);
			// Dizi Görüntülenme Sayısı Ekleme
			$this->Frontend_Operations_model->add_view("dizi",$sonuc->dizi_id);

			$this->load->view('frontend/movies/Dizi_view', $viewData);

		}else{

			if($this->input->post('filter_type')){				
				$diziler = $this->Frontend_Operations_model->diziler($this->input->post('filter_type'));	
			}else{
				$diziler = $this->Frontend_Operations_model->diziler();
			}

			$viewData = array(
				'diziler' => $diziler,
				'dizi_count' => $this->Admin_Operations_model->print_count('dizi'),
			);

			$this->load->view('frontend/movies/Diziler_view', $viewData);

		}
	}

	public function izle($movie_type, $sef_link = null){

		if($movie_type == 'film'){
			$film_sonuc = $this->Frontend_Operations_model->filmveyadizivarmı('film', $sef_link);
			if($film_sonuc == true){
				$yorumlar = $this->Frontend_Operations_model->yorumlar('film', $film_sonuc->film_id);

				$kaynaklar = $this->Admin_Operations_model->print_sources($film_sonuc->film_id);
	
				$viewData = array(
					'film_bilgileri' => $film_sonuc,
					'film_yorumları' => $yorumlar,
					'film_kaynakları' => $kaynaklar,
				);

				$this->load->view('frontend/movies/Film_izle_view', $viewData);
			}
		}elseif($movie_type == 'dizi'){
			$dizi_episode_sonuc = $this->Frontend_Operations_model->bölümvarmı($sef_link);
			if($dizi_episode_sonuc == true){
				$dizi_bilgileri = $this->Admin_Operations_model->print_dizi($dizi_episode_sonuc->dizi_id);
				$dizi_tüm_bölümleri = $this->Admin_Operations_model->print_episodes($dizi_bilgileri->dizi_id);
	
				$yorumlar = $this->Frontend_Operations_model->yorumlar('dizi', $dizi_bilgileri->dizi_id, $dizi_episode_sonuc->episode_id);
	
				$viewData = array(
					'dizi_bölüm_bilgileri' => $dizi_episode_sonuc,
					'dizi_bilgileri' => $dizi_bilgileri,
					'dizi_bölümleri' => $dizi_tüm_bölümleri,
					'dizi_yorumları' => $yorumlar,
				);
				// Bölüm Görüntülenme Sayısı Ekleme
				$this->Frontend_Operations_model->add_view("bölüm", $dizi_episode_sonuc->episode_id);

				$this->load->view('frontend/movies/Dizi_izle_view', $viewData);
			}
		}else{
			redirect(base_url());
		}

	}

	public function cast($cast_id = null){

		$cast_control = $this->Frontend_Operations_model->castvarmı($cast_id);

		if($cast_control && $cast_id != null){
			
			$cast = $this->Frontend_Operations_model->one_cast($cast_id);
			
			$cast_films = $this->Frontend_Operations_model->one_cast($cast_id);
			$cast_movies = $this->Frontend_Operations_model->one_cast($cast_id);

			$viewData = array(
				'cast' => $cast,
				'cast_films' => $cast_films,
				'cast_movies' => $cast_movies
			);
	
			$this->load->view('frontend/cast/Cast_view', $viewData);
		}else{
			redirect(base_url());
		}

	}
	
	public function profil($uye_id = null){
	
		if ($this->session->userdata('durum') == true && $this->session->userdata('user')->uye_id == $uye_id) {
			
			//Giriş Yapılınca Gösterilecekler
			$viewData = array(
				'kişi_bilgileri' => $this->session->userdata('user'),
				'favori_filmler' => $this->Member_Operations_model->favori_filmler($uye_id),
				'favori_diziler' => $this->Member_Operations_model->favori_diziler($uye_id),
				'son_yorumlar' => $this->Member_Operations_model->son_yorumlar($uye_id),
			);			

			$this->load->view('frontend/profile/include/left_side', $viewData);
			$this->load->view('frontend/profile/Profile_logged_view', $viewData);

		}else{
			// Herkese Açık Olarak Gösterilecekler
			$üye = $this->Frontend_Operations_model->showmemberpage($uye_id);
			
			if($uye_id != null && $üye != null){
				
				$viewData = array(
					'üye_bilgileri' => $üye,
					'favori_filmler' => $this->Member_Operations_model->favori_filmler($uye_id),
					'favori_diziler' => $this->Member_Operations_model->favori_diziler($uye_id),
					'son_yorumlar' => $this->Member_Operations_model->son_yorumlar($uye_id),
				);
				
				$this->load->view('frontend/profile/include/left_side', $viewData);
				$this->load->view('frontend/profile/Profile_public_view', $viewData);
			}else{
				redirect(base_url());
			}
		}

	}
}

<?php
class IMDB_Operations_model extends CI_Model{

    public function __construct()
	{
        parent::__construct();
		$this->load->model('Admin_Operations_model');
		$this->load->library('tmdb');
    }

	public $filmler_table_name = 'filmler';
	public $diziler_table_name = 'diziler';
	public $bölümler_table_name ='dizi_bölümleri';
	public $sezonlar_table_name ='dizi_sezonları';

	public $şirketler_table_name = 'şirketler';

	public $cast_table_name= 'cast';



	public function bölümü_aktar($bölüm_bilgileri = array(), $dizi_id, $episode_durum, $indirme){
		
		$bölüm_imdb_id = $this->tmdb->getTVShowEpisodeExternealIDs($dizi_id, $bölüm_bilgileri['season_number'], $bölüm_bilgileri['episode_number']);
		
		// Bölüm IMDB Bilgileri
		$IMDB = new IMDB('http://www.imdb.com/title/'.$bölüm_imdb_id['imdb_id']);
		if ($IMDB->isReady) {
			$bölüm_imdb_puanı = $IMDB->getRating();
			$bölüm_süresi = $IMDB->getRuntime();
		}		
		
		if($indirme == false){
			$keys = array('episode_id','dizi_id','season_number','episode_number','episode_name','episode_puan','episode_süre','episode_describe','episode_image','episode_sef_link','episode_release_date','episode_durum','episode_add_date');
			$values = array(
				$bölüm_bilgileri['id'],
				$dizi_id,
				$bölüm_bilgileri['season_number'],
				$bölüm_bilgileri['episode_number'],
				$bölüm_bilgileri['name'],
				$bölüm_imdb_puanı,
				$bölüm_süresi,
				$bölüm_bilgileri['overview'],
				$bölüm_bilgileri['still_path'],
				seflink($this->tmdb->getTVShow($dizi_id, 'tr')['original_name'].' Sezon '.$bölüm_bilgileri['season_number'].' Bölüm '.$bölüm_bilgileri['episode_number']),
				$bölüm_bilgileri['air_date'],
				$episode_durum,
				date('Y-m-d H:i:s'),
			);
		}else{
			set_time_limit(0);
			$dizidosyauzantısı = 'assets/uploads/movies/'. $this->Admin_Operations_model->print_dizi($dizi_id)->dizi_sef_link;
			//Bölüm resmini indirme
			$poster_ismi = $bölüm_bilgileri['still_path'];
			$resim_linki = image_url($bölüm_bilgileri['still_path']);
			$resim_kayıt_yeri = $dizidosyauzantısı.'/'.$poster_ismi;
			copy($resim_linki,$resim_kayıt_yeri);
			$yeni_poster_ismi = str_replace('/','',$poster_ismi);

			$keys = array('episode_id','dizi_id','season_number','episode_number','episode_name','episode_puan','episode_süre','episode_describe','episode_image','episode_sef_link','episode_release_date','episode_durum','episode_add_date');
			$values = array(
				$bölüm_bilgileri['id'],
				$dizi_id,
				$bölüm_bilgileri['season_number'],
				$bölüm_bilgileri['episode_number'],
				$bölüm_bilgileri['name'],
				$bölüm_imdb_puanı,
				$bölüm_süresi,
				$bölüm_bilgileri['overview'],
				$yeni_poster_ismi,
				seflink($this->tmdb->getTVShow($dizi_id, 'tr')['original_name'].' Sezon '.$bölüm_bilgileri['season_number'].' Bölüm '.$bölüm_bilgileri['episode_number']),
				$bölüm_bilgileri['air_date'],
				$episode_durum,
				date('Y-m-d H:i:s'),
			);
		}

		$data = array_combine($keys, $values);

		//Kontrol İşlemi
		$veri = $this
			->db
			->from($this->bölümler_table_name)
			->like('episode_id', $data['episode_id'])
			->get()
			->row();

		if($veri != null){
			$this
			->db
			->where('episode_id', $veri->episode_id)
			->update($this->bölümler_table_name, $data);
		}else{
			$this
			->db
			->insert($this->bölümler_table_name, $data);
		}
	}

	public function sezon_bölümlerini_aktar($sezon_bilgileri = array(), $indirme){

		$dizidosyauzantısı = 'assets/uploads/movies/'. $this->Admin_Operations_model->print_dizi($sezon_bilgileri[0]['show_id'])->dizi_sef_link;
		for($a = 0; $a < count($sezon_bilgileri); $a++){

			$bölüm_imdb_id = $this->tmdb->getTVShowEpisodeExternealIDs($sezon_bilgileri[$a]['show_id'], $sezon_bilgileri[$a]['season_number'], $sezon_bilgileri[$a]['episode_number']);
		
			// Bölüm IMDB Bilgileri
			$IMDB = new IMDB('http://www.imdb.com/title/'.$bölüm_imdb_id['imdb_id']);
			if ($IMDB->isReady) {
				$bölüm_imdb_puanı = $IMDB->getRating();
				$bölüm_süresi = $IMDB->getRuntime();
			}			
			
			if($indirme == false){
				$keys = array('episode_id','dizi_id','season_number','episode_number','episode_name','episode_puan','episode_süre','episode_describe','episode_image','episode_sef_link','episode_release_date','episode_durum','episode_add_date');
				$values = array(
					$sezon_bilgileri[$a]['id'],
					$sezon_bilgileri[$a]['show_id'],
					$sezon_bilgileri[$a]['season_number'],
					$sezon_bilgileri[$a]['episode_number'],
					$sezon_bilgileri[$a]['name'],
					$bölüm_imdb_puanı,
					$bölüm_süresi,
					$sezon_bilgileri[$a]['overview'],
					$sezon_bilgileri[$a]['still_path'],
					seflink($this->tmdb->getTVShow($sezon_bilgileri[$a]['show_id'], 'tr')['original_name'].' Sezon '.$sezon_bilgileri[$a]['season_number'].' Bölüm '.$sezon_bilgileri[$a]['episode_number']),
					$sezon_bilgileri[$a]['air_date'],
					'Normal Bölüm',
					date('Y-m-d H:i:s'),
				);
			}else{
				set_time_limit(0);
				//Bölüm resimlerini indirme
				$poster_ismi = $sezon_bilgileri[$a]['still_path'];
				$resim_linki = image_url($sezon_bilgileri[$a]['still_path']);
				$resim_kayıt_yeri = $dizidosyauzantısı.'/'.$poster_ismi;
				copy($resim_linki,$resim_kayıt_yeri);
				$yeni_poster_ismi = str_replace('/','',$poster_ismi);

				$keys = array('episode_id','dizi_id','season_number','episode_number','episode_name','episode_puan','episode_süre','episode_describe','episode_image','episode_sef_link','episode_release_date','episode_durum','episode_add_date');
				$values = array(
					$sezon_bilgileri[$a]['id'],
					$sezon_bilgileri[$a]['show_id'],
					$sezon_bilgileri[$a]['season_number'],
					$sezon_bilgileri[$a]['episode_number'],
					$sezon_bilgileri[$a]['name'],
					$bölüm_imdb_puanı,
					$bölüm_süresi,
					$sezon_bilgileri[$a]['overview'],
					$yeni_poster_ismi,
					seflink($this->tmdb->getTVShow($sezon_bilgileri[$a]['show_id'], 'tr')['original_name'].' Sezon '.$sezon_bilgileri[$a]['season_number'].' Bölüm '.$sezon_bilgileri[$a]['episode_number']),
					$sezon_bilgileri[$a]['air_date'],
					'Normal Bölüm',
					date('Y-m-d H:i:s'),
				);
			}
			$data = array_combine($keys, $values);

			//Kontrol İşlemi
			$veri = $this
				->db
				->from($this->bölümler_table_name)
				->like('episode_id', $data['episode_id'])
				->get()
				->row();

			if($veri != null){
				$this
				->db
				->where('episode_id', $veri->episode_id)
				->update($this->bölümler_table_name, $data);
			}else{
				$this
				->db
				->insert($this->bölümler_table_name, $data);
			}
		}
	}

	public function imdb_ekibi_aktar($film_ekibi = array()){

		for($a = 0; $a < count($film_ekibi); $a++){
			$keys = array('cast_id','cast_imdb_id','cast_job','cast_name','cast_birth_day','cast_death_day','cast_birth_place','cast_biography','cast_image','popularity');
			$values = array(
				$film_ekibi[$a]['cast_id'],
				$film_ekibi[$a]['cast_imdb_id'],
				$film_ekibi[$a]['cast_job'],
				$film_ekibi[$a]['cast_name'],
				$film_ekibi[$a]['cast_birth_day'],
				$film_ekibi[$a]['cast_death_day'],
				$film_ekibi[$a]['cast_birth_place'],
				$film_ekibi[$a]['cast_biography'],
				$film_ekibi[$a]['cast_image'],
				$film_ekibi[$a]['popularity']
			);
			$data = array_combine($keys, $values);

			//Kontrol İşlemi
			$veri = $this
				->db
				->from($this->cast_table_name)
				->like('cast_id', $data['cast_id'])
				->get()
				->row();

			if($veri != null){
				$this
				->db
				->where('cast_id', $veri->cast_id)
				->update($this->cast_table_name, $veri);
			}else{
				$this
				->db
				->insert($this->cast_table_name, $data);
			}

		}
		
	}

	public function yapım_şirketini_aktar($company){

		for($a = 0; $a < count($company); $a++){
			$keys = array('company_id','company_name','company_country','company_logo');
			$values = array(
				$company[$a]['id'],
				$company[$a]['name'],
				$company[$a]['origin_country'],
				$company[$a]['logo_path']
			);
			$data = array_combine($keys, $values);

			//Kontrol İşlemi
			$veri = $this
				->db
				->from($this->şirketler_table_name)
				->like('company_id', $data['company_id'])
				->get()
				->row();

			if($veri != null){
				$this
				->db
				->where('company_id', $veri->company_id)
				->update($this->şirketler_table_name, $data);
			}else{
				$this
				->db
				->insert($this->şirketler_table_name, $data);
			}

		}
		
	}

	public function imdb_add_image($type, $movie_id, $episode_id = null, $images = array()){

		if($type == 'film'){
			for($a = 0; $a < count($images); $a++){
				$keys = array('film_id','image_url');
				$values = array(
					$movie_id,
					$images[$a]
				);
				$data = array_combine($keys, $values);

				//Kontrol İşlemi
				$veri = $this
					->db
					->from('resimler')
					->like('image_url', $data['image_url'])
					->get()
					->row();

				if($veri != null){
					$this
					->db
					->where('image_url', $veri->image_url)
					->update('resimler', $veri);
				}else{
					$this
					->db
					->insert('resimler', $data);
				}
			}
		}elseif($type == 'dizi'){
			for($a = 0; $a < count($images); $a++){
				$keys = array('dizi_id','image_url');
				$values = array(
					$movie_id,
					$images[$a]
				);
				$data = array_combine($keys, $values);

				//Kontrol İşlemi
				$veri = $this
					->db
					->from('resimler')
					->like('image_url', $data['image_url'])
					->get()
					->row();

				if($veri != null){
					$this
					->db
					->where('image_url', $veri->image_url)
					->update('resimler', $veri);
				}else{
					$this
					->db
					->insert('resimler', $data);
				}
			}
		}elseif($type == 'bölüm'){
			for($a = 0; $a < count($images); $a++){
				$keys = array('dizi_id','episode_id','image_url');
				$values = array(
					$movie_id,
					$episode_id,
					$images[$a]
				);
				$data = array_combine($keys, $values);

				//Kontrol İşlemi
				$veri = $this
					->db
					->from('resimler')
					->like('image_url', $data['image_url'])
					->get()
					->row();

				if($veri != null){
					$this
					->db
					->where('image_url', $veri->image_url)
					->update('resimler', $veri);
				}else{
					$this
					->db
					->insert('resimler', $data);
				}
			}
		}else{
			return false;
		}
	}

	public function imdb_add_video($type, $movie_id, $episode_id = null, $videos = array()){

		if($type == 'film'){
			for($a = 0; $a < count($videos); $a++){
				$keys = array('film_id','video_name','video_site','video_size','video_type','video_url');
				$values = array(
					$movie_id,
					$videos[$a]['video_name'],
					$videos[$a]['video_site'],
					$videos[$a]['video_size'],
					$videos[$a]['video_type'],
					$videos[$a]['video_url'],
				);
				$data = array_combine($keys, $values);

				//Kontrol İşlemi
				$veri = $this
					->db
					->from('videolar')
					->like('video_url', $data['video_url'])
					->get()
					->row();

				if($veri != null){
					$this
					->db
					->where('video_url', $veri->video_url)
					->update('videolar', $veri);
				}else{
					$this
					->db
					->insert('videolar', $data);
				}
			}
		}elseif($type == 'dizi'){
			for($a = 0; $a < count($videos); $a++){
				$keys = array('dizi_id','video_name','video_site','video_size','video_type','video_url');
				$values = array(
					$movie_id,
					$videos[$a]['video_name'],
					$videos[$a]['video_site'],
					$videos[$a]['video_size'],
					$videos[$a]['video_type'],
					$videos[$a]['video_url'],
				);

				$data = array_combine($keys, $values);

				//Kontrol İşlemi
				$veri = $this
					->db
					->from('videolar')
					->like('video_url', $data['video_url'])
					->get()
					->row();

				if($veri != null){
					$this
					->db
					->where('video_url', $veri->video_url)
					->update('videolar', $veri);
				}else{
					$this
					->db
					->insert('videolar', $data);
				}
			}
		}elseif($type == 'bölüm'){
			for($a = 0; $a < count($videos); $a++){
				$keys = array('dizi_id','episode_id','video_name','video_site','video_size','video_type','video_url');
				$values = array(
					$movie_id,
					$episode_id,
					$videos[$a]['video_name'],
					$videos[$a]['video_site'],
					$videos[$a]['video_size'],
					$videos[$a]['video_type'],
					$videos[$a]['video_url'],
				);

				$data = array_combine($keys, $values);

				//Kontrol İşlemi
				$veri = $this
					->db
					->from('videolar')
					->like('video_url', $data['video_url'])
					->get()
					->row();

				if($veri != null){
					$this
					->db
					->where('video_url', $veri->video_url)
					->update('videolar', $veri);
				}else{
					$this
					->db
					->insert('videolar', $data);
				}
			}
		}else{
			return false;
		}
	}

}
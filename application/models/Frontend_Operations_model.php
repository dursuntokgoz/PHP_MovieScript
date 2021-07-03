<?php
class Frontend_Operations_model extends CI_Model{

    public function __construct()
	{
        parent::__construct();
    }
	public $uyeler_table_name ='uyeler';
	public $filmler_table_name ='filmler';
	public $diziler_table_name ='diziler';
	public $bölümler_table_name ='dizi_bölümleri';
	public $yorumlar_table_name = 'yorumlar';
	public $cast_table_name = 'cast';
	public $şirketler_table_name = 'şirketler';
	public $resimler_table_name = 'resimler';
	public $videolar_table_name = 'videolar';
	
	public $kaynak_linkleri_table_name ='kaynak_linkleri';


	function filmler($filter_type = null){

		switch ($filter_type) {
			case "Alfabetik [A-Z]":
				$data = $this
					->db
					->select('*')
					->from($this->filmler_table_name)
					->order_by('film_ad','ASC')	
					->get()
					->result();
				break;
			case "Alfabetik [Z-A]":
				$data = $this
					->db
					->select('*')
					->from($this->filmler_table_name)
					->order_by('film_ad','DESC')	
					->get()
					->result();
				break;
			case "IMDB Puanı [Yüksek]":
				$data = $this
					->db
					->select('*')
					->from($this->filmler_table_name)
					->order_by('film_puanı','DESC')	
					->get()
					->result();
				break;
			case "IMDB Puanı [Düşük]":
				$data = $this
					->db
					->select('*')
					->from($this->filmler_table_name)
					->order_by('film_puanı','ASC')	
					->get()
					->result();	
				break;				
			case "Çıkış Tarihi [Yeni]":
				$data = $this
					->db
					->select('*')
					->from($this->filmler_table_name)
					->order_by('film_release_date','DESC')	
					->get()
					->result();
				break;
			case "Çıkış Tarihi [Eski]":
				$data = $this
					->db
					->select('*')
					->from($this->filmler_table_name)
					->order_by('film_release_date','ASC')	
					->get()
					->result();	
				break;								
			default:
				$data = $this
					->db
					->select('*')
					->from($this->filmler_table_name)
					->order_by('film_id','DESC')	
					->get()
					->result();
		}		

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	function en_son_eklenen_filmler(){

		$data = $this
				->db
				->select('*')
				->from($this->filmler_table_name)
				->order_by('film_add_date','DESC')
				->limit(20)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	
	function son_çıkan_filmler(){

		$data = $this
				->db
				->select('*')
				->from($this->filmler_table_name)
				->order_by('film_release_date','DESC')
				->limit(20)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	

	function en_çok_görüntülenen_filmler(){

		$data = $this
				->db
				->select('*')
				->from($this->filmler_table_name)
				->order_by('total_views','DESC')
				->limit(5)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	

	function haftalık_trend_filmler(){
		$data = $this
				->db
				->select('*')
				->from($this->filmler_table_name)
				->order_by('week_views','DESC')
				->limit(5)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}		
	}
	
	function imdb_puanı_yüksek_filmler(){

		$data = $this
				->db
				->select('*')
				->from($this->filmler_table_name)
				->order_by('film_puanı','DESC')
				->limit(20)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	

	function yakında_çıkacak_filmler(){

		$data = $this->db->query("SELECT * FROM filmler WHERE datediff(curdate(), film_release_date) < 0")->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	


	function diziler($filter_type = null){

		switch ($filter_type) {
			case "Alfabetik [A-Z]":
				$data = $this
					->db
					->select('*')
					->from($this->diziler_table_name)
					->order_by('dizi_ad','ASC')	
					->get()
					->result();
				break;
			case "Alfabetik [Z-A]":
				$data = $this
					->db
					->select('*')
					->from($this->diziler_table_name)
					->order_by('dizi_ad','DESC')	
					->get()
					->result();	
				break;
			case "IMDB Puanı [Yüksek]":
				$data = $this
					->db
					->select('*')
					->from($this->diziler_table_name)
					->order_by('dizi_puanı','DESC')	
					->get()
					->result();
				break;
			case "IMDB Puanı [Düşük]":
				$data = $this
					->db
					->select('*')
					->from($this->diziler_table_name)
					->order_by('dizi_puanı','ASC')	
					->get()
					->result();	
				break;
			case "Çıkış Tarihi [Yeni]":
				$data = $this
					->db
					->select('*')
					->from($this->diziler_table_name)
					->order_by("dizi_release_date", 'DESC')	
					->get()
					->result();
				break;
			case "Çıkış Tarihi [Eski]":
				$data = $this
					->db
					->select('*')
					->from($this->diziler_table_name)
					->order_by("dizi_release_date", 'ASC')	
					->get()
					->result();
				break;
			default:
				$data = $this
					->db
					->select('*')
					->from($this->diziler_table_name)
					->order_by('dizi_id','DESC')
					->get()
					->result();	
		}

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	

	function en_çok_görüntülenen_diziler(){

		$data = $this
				->db
				->select('*')
				->from($this->diziler_table_name)
				->order_by('total_views','DESC')
				->limit(5)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	
	
	function imdb_puanı_yüksek_diziler(){

		$data = $this
				->db
				->select('*')
				->from($this->diziler_table_name)
				->order_by('dizi_puanı','DESC')
				->limit(20)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	
	
	function haftalık_trend_diziler(){
		$data = $this
				->db
				->select('*')
				->from($this->diziler_table_name)
				->order_by('week_views','DESC')
				->limit(5)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}		
	}	

	function bölüm($dizi_id, $episode_id){

		$data = 
			$this
				->db
				->select('*')
				->from($this->bölümler_table_name)
				->where('episode_id', $episode_id)
				->join("$this->diziler_table_name","$dizi_id = $this->diziler_table_name.dizi_id")
				->get()
				->row();

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	
	function bölümler(){

		$data = $this
				->db
				->select('*')
				->from($this->bölümler_table_name)
				->join('diziler', 'diziler.dizi_id = dizi_bölümleri.dizi_id')
				->order_by('episode_add_date','DESC')
				->limit(20)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	

	function yakında_çıkacak_bölümler(){

		$data = $this->db->query("SELECT * FROM diziler WHERE datediff(curdate(), dizi_release_date) < 0")->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	

	function casts(){

		$data = $this
				->db
				->select('*')
				->from($this->cast_table_name)
				->order_by('popularity','DESC')
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	function one_cast($id){

		$data = $this
				->db
				->select('*')
				->from($this->cast_table_name)
				->where('cast_id', $id)
				->get()
				->row();

		if($data){
			return $data;
		}else{
			return false;
		}
	}


	function favoridizibölümleri($uye_id){

		$data = $this
				->db
				->select('*')
				->from($this->bölümler_table_name)
				->join('diziler', 'diziler.dizi_id = dizi_bölümleri.dizi_id')
				->join('favoriler', 'favoriler.movie_id = dizi_bölümleri.dizi_id')
				->where('uye_id', $uye_id)
				->where('type', 'dizi')
				->order_by('episode_add_date','DESC')
				->limit(20)
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	function filmveyadizivarmı($movie_type, $sef_link){

		if($movie_type == 'film'){
			$data = $this
					->db
					->select('*')
					->from($this->filmler_table_name)
					->where('film_sef_link', $sef_link)
					->get()
					->row();
		}elseif($movie_type == 'dizi'){
			$data = $this
					->db
					->select('*')
					->from($this->diziler_table_name)
					->where('dizi_sef_link', $sef_link)
					->get()
					->row();

		}

		if($data){
			return $data;
		}else{
			return false;
		} 

	}

	function bölümvarmı($sef_link){
		$data = $this
				->db
				->select('*')
				->from($this->bölümler_table_name)
				->where('episode_sef_link', $sef_link)
				->get()
				->row();


		if($data){
			return $data;
		}else{
			return false;
		} 

	}

	function castvarmı($cast_id){
		$data = $this
				->db
				->select('*')
				->from($this->cast_table_name)
				->where('cast_id', $cast_id)
				->get()
				->row();


		if($data){
			return $data;
		}else{
			return false;
		} 

	}

	function cast($cast_id = array()){

		foreach($cast_id as $cast){
			$data[] = $this
					->db
					->select('*')
					->from($this->cast_table_name)
					->where('cast_id', $cast)
					->get()
					->row();
		}

		if($data){
			return $data;
		}else{
			return false;
		} 

	}

	function şirket($şirket_id = array()){

		foreach($şirket_id as $şirket){
			$data[] = $this
					->db
					->select('*')
					->from($this->şirketler_table_name)
					->where('company_id', $şirket)
					->get()
					->row();
		}

		if($data){
			return $data;
		}else{
			return false;
		} 

	}

	function yorumlar($type, $movie_id, $episode_id = null){

		if($type == 'film'){

			$data = $this
					->db
					->select('*')
					->from($this->yorumlar_table_name)
					->where('comment_type', $type)
					->where('movie_id', $movie_id)
					->where('comment_onay', 1)
					->order_by('sended_date','DESC')
					->get()
					->result();
		}elseif($type == 'dizi'){
			if($episode_id !=null){
				$data = $this
						->db
						->select('*')
						->from($this->yorumlar_table_name)
						->where('comment_type', $type)
						->where('movie_id', $movie_id)
						->where('episode_id', $episode_id)
						->where('comment_onay', 1)
						->order_by('sended_date','DESC')
						->get()
						->result();
			}else{
				$data = $this
						->db
						->select('*')
						->from($this->yorumlar_table_name)
						->order_by('sended_date','DESC')
						->where('comment_type', $type)
						->where('comment_onay', 1)
						->where('movie_id', $movie_id)
						->get()
						->result();
			}
		}

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	function resimler($type, $movie_id, $episode_id){
		if($type == "film"){
			$data = $this
					->db
					->from($this->resimler_table_name)
					->where('film_id', $movie_id)
					->order_by('id','DESC')
					->get()
					->result();
		}elseif($type == "dizi"){
			$data = $this
					->db
					->from($this->resimler_table_name)
					->where('dizi_id', $movie_id)
					->order_by('id','DESC')
					->get()
					->result();
		}elseif($type == "bölüm"){
			$data = $this
					->db
					->from($this->resimler_table_name)
					->where('dizi_id', $movie_id)
					->where('episode_id', $episode_id)
					->order_by('id','DESC')
					->get()
					->result();
		}

		if($data){
			return $data;
		}else{
			return false;
		} 

	}

	function videolar($type, $movie_id, $episode_id){
		if($type == "film"){
			$data = $this
					->db
					->from($this->videolar_table_name)
					->where('film_id', $movie_id)
					->order_by('id','DESC')
					->get()
					->result();
		}elseif($type == "dizi"){
			$data = $this
					->db
					->from($this->videolar_table_name)
					->where('dizi_id', $movie_id)
					->order_by('id','DESC')
					->get()
					->result();
		}elseif($type == "bölüm"){
			$data = $this
					->db
					->from($this->videolar_table_name)
					->where('dizi_id', $movie_id)
					->where('episode_id', $episode_id)
					->order_by('id','DESC')
					->get()
					->result();
		}

		if($data){
			return $data;
		}else{
			return false;
		} 

	}

	function print_recomended_movies($type, $movie_infos){
		
		switch ($type) {
			case "film":
				$movie_genres = explode(",",$movie_infos->film_türü);
				$movie_name = $movie_infos->film_ad;

				//Türlere Göre filmleri bulma
				for($i = 0; $i < count($movie_genres); $i++){
					$data = $this
						->db 
						->select('*')
						->from($this->filmler_table_name)
						->where("film_ad !=", $movie_name)
						->like("film_türü", $movie_genres[$i])
						->limit(20)
						->get()
						->result();
				}
				break;
			case "dizi":
				$movie_genres = explode(",",$movie_infos->dizi_türü);
				$movie_name = $movie_infos->dizi_ad;

				//Türlere Göre dizileri bulma
				for($i = 0; $i < count($movie_genres); $i++){
					$data = $this
						->db 
						->select('*')
						->from($this->diziler_table_name)
						->where("dizi_ad !=", $movie_name)
						->like("dizi_türü", $movie_genres[$i])
						->limit(20)
						->get()
						->result();
				}
				break;
								
			default:
				return false;
		}

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	function print_source($type, $movie_id, $source_type, $source_name){
		
		if($type == 'film'){
			$data = $this
				->db
				->select('*')
				->from($this->kaynak_linkleri_table_name)
				->where('film_id', $movie_id)
				->where('kaynak_türü', $source_type)
				->where('kaynak_ismi', $source_name)
				->get()
				->result_array();
		}elseif($type == "bölüm"){
			$data = $this
				->db
				->select('*')
				->from($this->kaynak_linkleri_table_name)
				->where('bölüm_id', $movie_id)
				->where('kaynak_türü', $source_type)
				->where('kaynak_ismi', $source_name)
				->get()
				->result_array();		
		};
				
		if($data){
			return $data;
		}else{
			return false;
		} 				
	}

	function showmemberpage($uye_id){
		$data = $this
				->db
				->select('uye_id,uye_nickname,uye_ad,uye_soyad,uye_email,uye_avatar,uye_aktif,uye_kayit_tarihi,uyelik_türü,uye_facebook_url,uye_twitter_url')
				->from($this->uyeler_table_name)
				->where('uye_id', $uye_id)
				->get()
				->row();

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	function add_view($movie_type, $movie_id){

		switch ($movie_type) {
			case "film":
				$this->db->set('total_views', 'total_views+1', FALSE);
				$this->db->where('film_id', $movie_id);
				$this->db->update("$this->filmler_table_name");

				$this->db->set('week_views', 'week_views+1', FALSE);
				$this->db->where('film_id', $movie_id);
				$this->db->update("$this->filmler_table_name");				
			break;

			case "dizi":
				$this->db->set('total_views', 'total_views+1', FALSE);
				$this->db->where('dizi_id', $movie_id);
				$this->db->update("$this->diziler_table_name");

				$this->db->set('week_views', 'week_views+1', FALSE);
				$this->db->where('dizi_id', $movie_id);
				$this->db->update("$this->diziler_table_name");				
			break;

			case "bölüm":
				$this->db->set('total_views', 'total_views+1', FALSE);
				$this->db->where('episode_id', $movie_id);
				$this->db->update("$this->bölümler_table_name");				
			break;			
			
			default:
				return false;
		}
			
	}

	function print_film_takvim(){

		$data = $this->db->query("SELECT * FROM filmler WHERE datediff(curdate(), film_release_date) < 0 ORDER BY film_release_date ASC")->result_array();

		$grouped = array();
		
		foreach (array_filter($data) as $p){
			
			if (!array_key_exists($p['film_release_date'], $grouped)){
				$grouped[$p['film_release_date']] = array();
			}

			$grouped[$p['film_release_date']][] = $p;
		}
		
		return array_filter($grouped);

	}

	function print_dizi_takvim(){

		$data = $this->db->query("SELECT * FROM dizi_bölümleri INNER JOIN diziler ON (diziler.dizi_id = dizi_bölümleri.dizi_id) WHERE datediff(curdate(), episode_release_date) < 0 ORDER BY episode_release_date ASC")->result_array();

		$grouped = array();
		
		foreach (array_filter($data) as $p){
			
			if (!array_key_exists($p['episode_release_date'], $grouped)){
				$grouped[$p['episode_release_date']] = array();
			}

			$grouped[$p['episode_release_date']][] = $p;
		}
		
		return array_filter($grouped);

	}

}
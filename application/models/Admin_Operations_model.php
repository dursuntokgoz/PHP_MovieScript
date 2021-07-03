<?php
class Admin_Operations_model extends CI_Model{

    public function __construct()
	{
        parent::__construct();
    }
	
	public $uyeler = 'uyeler';
	public $admin_paneli ='admin_paneli';
	public $filmler ='filmler';
	public $diziler ='diziler';
	public $dizi_bölümleri ='dizi_bölümleri';
	public $kaynak_linkleri ='kaynak_linkleri';
	public $cast ='cast';
	public $resimler ='resimler';
	public $videolar ='videolar';
	public $yorumlar ='yorumlar';
	public $favoriler = 'favoriler';

/* Admin Login */
	public function admin_login($email, $sifre){

				$this->db->select('*');    
				$this->db->from("$this->uyeler");
				$this->db->where('uye_email', $email);
				$this->db->where('uye_sifre', $sifre);
				$this->db->join("$this->admin_paneli", "$this->uyeler.uye_id = $this->admin_paneli.admin_id");
			$data =  $this->db->get()->row();

		if($data){
			return $data;
		}else{
			return false;
		}

	}
	public function admin_last_login_date($login_date = array() , $id){
 
			$data =  $this->db->where('admin_id', $id);
					 $this->db->update("$this->admin_paneli", $login_date);

		if($data){
			return $data;
		}else{
			return false;
		}

	}

/* Yönetici Sayfası Fonksiyonları */
	public function print_admins(){

			$this->db->select('*');    
			$this->db->from("$this->uyeler");
			$this->db->join("$this->admin_paneli", "$this->uyeler.uye_id = $this->admin_paneli.admin_id");
		$data =  $this->db->get()->result();


		if($data){
			return $data;
		}else{
			return false;
		}
	}	
	public function add_admin($admin_data = array()){

		$data = $this->db->insert("$this->admin_paneli", $admin_data);

		if($data){
			return $data;
		}else{
			return false;
		}
	}	
	public function edit_admin($admin_id, $admin_data = array()){

		$data = $this
				->db
				->where('admin_id',$admin_id)
				->update("$this->admin_paneli", $admin_data);

		if($data){
			return $data;
		}else{
			return false;
		}
	}
/* Film ve Dizi Fonksiyonları */
	public function add_movie($type, $movie_data = array()){

		switch ($type) {
			case "film":
				$data = $this->db->insert("$this->filmler", $movie_data);
				break;
			case "dizi":
				$data = $this->db->insert("$this->diziler", $movie_data);
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
	public function update_movie($type, $movie_id, $movie_data = array()){

		switch ($type) {
			case "film":
				$data = $this
					->db
					->where('film_id',$movie_id)
					->update("$this->filmler", $movie_data);
				break;
			case "dizi":
				$data = $this
					->db
					->where('dizi_id',$movie_id)
					->update("$this->diziler", $movie_data);
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
	public function add_episode($episode_data = array()){

		$data = $this
				->db
				->insert("$this->dizi_bölümleri", $episode_data);

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	public function update_episode($episode_id, $episode_data = array()){

		$data = $this
				->db
				->where('episode_id',$episode_id)
				->update("$this->dizi_bölümleri", $episode_data);

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	public function add_source($source_data){

		$data = $this
				->db
				->insert("$this->kaynak_linkleri", $source_data);
			
		if($data){
			return $data;
		}else{
			return false;
		}
	}
	public function add_image($image_data){

		$data = $this
				->db
				->insert("$this->resimler", $image_data);
			
		if($data){
			return $data;
		}else{
			return false;
		}
	}	
	public function add_video($video_data){

		$data = $this
				->db
				->insert("$this->videolar", $video_data);
			
		if($data){
			return $data;
		}else{
			return false;
		}
	}	
	public function delete_function($delete_type, $delete_id){

		if($delete_type == 'film'){		
			$dosya_yolu = "assets/uploads/movies/".$this->Admin_Operations_model->print_film($delete_id)->film_sef_link;
			klasör_sil($dosya_yolu);		
			$data = $this->db->where('film_id', $delete_id)->delete($this->filmler);		
					$this->db->where('film_id', $delete_id)->delete($this->resimler);
					$this->db->where('film_id', $delete_id)->delete($this->videolar);
					$this->db->where('film_id', $delete_id)->delete($this->kaynak_linkleri);
					$this->db->where('comment_type', 'film')->where('movie_id', $delete_id)->delete($this->yorumlar);
					$this->db->where('type', 'film')->where('movie_id', $delete_id)->delete($this->favoriler);
		}elseif($delete_type == 'dizi'){
			$dosya_yolu = "assets/uploads/movies/".$this->Admin_Operations_model->print_dizi($delete_id)->dizi_sef_link;
			klasör_sil($dosya_yolu);			
			$data = $this->db->where('dizi_id', $delete_id)->delete($this->diziler);		
					$this->db->where('dizi_id', $delete_id)->delete($this->dizi_bölümleri);	
					$this->db->where('dizi_id', $delete_id)->delete($this->resimler);
					$this->db->where('dizi_id', $delete_id)->delete($this->videolar);
					$this->db->where('dizi_id', $delete_id)->delete($this->kaynak_linkleri);
					$this->db->where('comment_type', 'dizi')->where('movie_id', $delete_id)->delete($this->yorumlar);
					$this->db->where('type', 'dizi')->where('movie_id', $delete_id)->delete($this->favoriler);					
		}elseif($delete_type == 'bölüm'){
			$data = $this->db->where('episode_id', $delete_id)->delete($this->dizi_bölümleri);
		}elseif($delete_type == 'kaynak'){
			$data = $this->db->where('id', $delete_id)->delete($this->kaynak_linkleri);
		}elseif($delete_type == 'resim'){
			$data = $this->db->where('id', $delete_id)->delete($this->resimler);
		}elseif($delete_type == 'video'){
			$data = $this->db->where('id', $delete_id)->delete($this->videolar);
		}elseif($delete_type == 'cast'){			
			$cast_bilgileri = $this->Admin_Operations_model->print_cast($delete_id);
			$cast_resim_url = 'assets/uploads/casts/'.$cast_bilgileri->cast_image;
			unlink($cast_resim_url);
			
			$data = $this->db->where('cast_id', $delete_id)->delete($this->cast);
		}

		if($data){
			return $data;
		}else{
			return false;
		}
	}

/* Print Fonksiyonları */

	public function print_count($type){
		
		switch ($type) {
			case "film":
				$data = $this
					->db
					->select('*')
					->from("$this->filmler")
					->count_all_results();
				break;
			case "dizi":
				$data = $this
					->db
					->select('*')
					->from("$this->diziler")
					->count_all_results();
				break;
			case "bölüm":
				$data = $this
					->db
					->select('*')
					->from("$this->dizi_bölümleri")
					->count_all_results();
				break;	
			case "yorum":
				$data = $this
					->db
					->select('*')
					->from("$this->yorumlar")
					->count_all_results();
				break;	
			case "üye":
				$data = $this
					->db
					->select('*')
					->from("$this->uyeler")
					->count_all_results();
				break;	
			case "banlıüye":
				$data = $this
					->db
					->select('*')
					->from("$this->uyeler")
					->where('uye_aktif', false)
					->count_all_results();
				break;
			case "banlıüye":
				$data = $this
					->db
					->select('*')
					->from("$this->uyeler")
					->where('uye_aktif', false)
					->count_all_results();
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

	public function print_film($film_id){

		$data = $this
				->db
				->select('*')
				->from("$this->filmler")
				->where('film_id', $film_id)
				->get()
				->row();

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	public function print_filmler(){

		$data = $this
				->db
				->select('*')
				->from("$this->filmler")
				->order_by('film_add_date','DESC')
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	
	public function print_dizi($dizi_id){

		$data = $this
				->db
				->select('*')
				->from("$this->diziler")
				->where('dizi_id',$dizi_id)
				->get()
				->row();

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	public function print_diziler(){

		$data = $this
				->db
				->select('*')
				->from("$this->diziler")
				->order_by('dizi_puanı','DESC')
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	
	
	public function print_episode($episode_id){

		$data = $this
				->db
				->select('*')
				->from("$this->dizi_bölümleri")
				->where('episode_id',$episode_id)
				->get()
				->row();

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	public function print_episodes($dizi_id){

		$data = $this
				->db
				->select('*')
				->from("$this->dizi_bölümleri")
				->where('dizi_id',$dizi_id)
				->group_by('season_number')
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	
	
	public function print_images($type, $movie_id, $episode_id = null){

		if($type == 'film'){
			$data = $this
				->db
				->select('*')
				->from("$this->resimler")
				->where('film_id', $movie_id)
				->get()
				->result();
		}elseif($type == 'dizi'){
			$data = $this
				->db
				->select('*')
				->from("$this->resimler")
				->where('dizi_id', $movie_id)
				->get()
				->result();
		}elseif($type == 'bölüm'){
			$data = $this
				->db
				->select('*')
				->from("$this->resimler")
				->where('dizi_id', $movie_id)
				->where('episode_id', $episode_id)
				->get()
				->result();
		}else{
			return false;
		}

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	public function print_videos($type, $movie_id, $episode_id = null){

		if($type == 'film'){
			$data = $this
				->db
				->select('*')
				->from("$this->videolar")
				->where('film_id', $movie_id)
				->get()
				->result();
		}elseif($type == 'dizi'){
			$data = $this
				->db
				->select('*')
				->from("$this->videolar")
				->where('dizi_id', $movie_id)
				->get()
				->result();
		}elseif($type == 'bölüm'){
			$data = $this
				->db
				->select('*')
				->from("$this->videolar")
				->where('dizi_id', $movie_id)
				->where('episode_id', $episode_id)
				->get()
				->result();
		}else{
			return false;
		}

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	public function print_sources($movie_id, $bölüm_id = null){

		if($bölüm_id == null){
			$data = $this
					->db
					->select('*')
					->from("$this->kaynak_linkleri")
					->where('film_id',$movie_id)
					->group_by('kaynak_ismi')
					->get()
					->result();

		}else{
			$data = $this
					->db
					->select('*')
					->from("$this->kaynak_linkleri")
					->where('dizi_id',$movie_id)
					->where('bölüm_id',$movie_id)
					->group_by('kaynak_ismi')
					->get()
					->result();
		}

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	
	public function print_movie_casts($cast_ids = array()){

		foreach($cast_ids as $cast_id){
			$data[] = $this
					->db
					->select('*')
					->from("$this->cast")
					->where('cast_id', $cast_id)
					->get()
					->row();
			
		}

		if($data){
			return array_filter($data);
		}else{
			return false;
		}
	}
	
	public function print_comments($type = null){
		
		switch ($type) {
			case "onaylı":
				$data = $this
						->db
						->from("$this->yorumlar")
						->where("comment_onay", 1)
						->get()
						->result();
				break;
			case "onaysız":
				$data = $this
						->db
						->from("$this->yorumlar")
						->where("comment_onay", 0)
						->get()
						->result();
				break;
			default:
				$data = $this
					->db
					->from("$this->yorumlar")
					->get()
					->result();
		}
				
		if($data){
			return $data;
		}else{
			return false;
		}
	}	

	public function print_cast($id){

		$data = $this
				->db
				->select('*')
				->from("$this->cast")
				->where('cast_id',$id)
				->get()
				->row();

		if($data){
			return $data;
		}else{
			return false;
		}
	}	
	public function print_casts(){

		$data = $this
				->db
				->select('*')
				->from("$this->cast")
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}


	public function print_member_information($uye_id){
		$data = $this
			->db
			->select('*')
			->from("$this->uyeler")
			->where('uye_id', $uye_id)
			->get()
			->row_array();

		$data2 = $this
			->db
			->select('*')
			->from("$this->admin_paneli")
			->where('admin_id', $uye_id)
			->get()
			->row_array();	

		if($data && $data2){
			$result = array_merge($data, $data2);
			return $result;
		}elseif($data && !$data2){
			return $data;
		}else{
			return false;
		}
	}	
	public function print_members(){
		
		$data = $this
				->db
				->select('*')
				->from("$this->uyeler")
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	
	
/* Yapımcı Fonksiyonları */	
	public function add_cast($cast_data = array()){

		$data = $this
				->db
				->insert("$this->cast", $cast_data);

		if($data){
			return $data;
		}else{
			return false;
		}
	}
	public function edit_cast($cast_id, $cast_data = array()){

		$data =  $this->db->where('cast_id', $cast_id);
				 $this->db->update("$this->cast", $cast_data);

		if($data){
			return $data;
		}else{
			return false;
		}
	}	
/* Yorumlar Fonksiyonları */	

	public function update_comment($comment_id, $comment_data = array()){
		
		$data = $this
				->db
				->where('yorum_id',$comment_id)
				->update("$this->yorumlar",$comment_data);

		if($data){
			return $data;
		}else{
			return false;
		}				
	}
	
	public function delete_comment($comment_id){
		
		$data = $this
				->db
				->where("yorum_id", $comment_id)
				->delete($this->yorumlar);

		if($data){
			return $data;
		}else{
			return false;
		}				
	}	

}
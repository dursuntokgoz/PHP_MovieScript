<?php
class Member_Operations_model extends CI_Model{

    public function __construct()
	{
        parent::__construct();
    }

	public $uyeler_table_name = 'uyeler';
	public $comments_table_name = 'yorumlar';
	public $favourites_table_name = 'favoriler';

	public $filmler_table_name = 'filmler';
	public $diziler_table_name = 'diziler';

	public function register($data = array()){
	
		$data = $this->db->insert($this->uyeler_table_name, $data);

		if($data){
			return $data;
		}else{
			return false;
		}

	}

	public function login($email, $sifre){
	
		$login_control = $this
				->db
				->select('*')
				->from($this->uyeler_table_name)
				->where('uye_email', $email)
				->where('uye_sifre', $sifre)
				->get()
				->row();
				
		if($login_control && $login_control->uye_aktif != 1){
			return "ban";
		}
		elseif($login_control && $login_control->uye_aktif == 1){
			
			$admin_control = $this
							->db
							->from('admin_paneli')
							->where('admin_id',$login_control->uye_id)
							->get()
							->row();	

			if($admin_control){
				
				$data = $this
						->db
						->from("$this->uyeler_table_name")
						->where("uye_id", $login_control->uye_id)
						->join("admin_paneli","$this->uyeler_table_name.uye_id = admin_paneli.admin_id")
						->get()
						->row();
						
				return $data;
				
			}else{
				return $login_control;
			}
							
		}else{
			return false;
		}

	}

	public function fblogin ($email){

		$login_control = $this
				->db
				->select('*')
				->from($this->uyeler_table_name)
				->where('uye_email', $email)
				->where('uyelik_türü', 'facebook')
				->get()
				->row();

		if($login_control && $login_control->uye_aktif != 1){
			return "ban";
		}
		elseif($login_control && $login_control->uye_aktif == 1){
	
			$admin_control = $this
							->db
							->from('admin_paneli')
							->where('admin_id',$login_control->uye_id)
							->get()
							->row();	

			if($admin_control){
				
				$data = $this
						->db
						->from("$this->uyeler_table_name")
						->where("uye_id", $login_control->uye_id)
						->join("admin_paneli","$this->uyeler_table_name.uye_id = admin_paneli.admin_id")
						->get()
						->row();
						
				return $data;
				
			}else{
				return $login_control;
			}
		}else{
			return false;
		}

	}

	public function profileupdate($changed_info, $id){

		$data = $this		
				->db
				->where('uye_id', $id)
				->update($this->uyeler_table_name, $changed_info);

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	public function updateusersession($uye_id){

		$data = $this
			->db
			->select('*')
			->from($this->uyeler_table_name)
			->where('uye_id', $uye_id)
			->get()
			->row();

		$result = $this->session->set_userdata('user', $data);


		if($result){
			return $result;
		}else{
			return false;
		}

	}

	public function yorum_yap($data_yorumlar = array()){

		$data = $this
				->db
				->insert($this->comments_table_name , $data_yorumlar);

		if($data){
			return $data;
		}else{
			return false;
		}
	}

	public function favori_ekle($favourites = array()){

		$data = $this
				->db
				->insert($this->favourites_table_name , $favourites);

		if($data){
			return $data;
		}else{
			return false;
		}

	}

	public function favori_kaldır($type, $uye_id, $movie_id){

		$data = $this
				->db
				->where('type',$type)
				->where('uye_id',$uye_id)
				->where('movie_id',$movie_id)
				->delete($this->favourites_table_name);

		if($data){
			return $data;
		}else{
			return false;
		}

	}

	public function favori_filmler($uye_id){

		$data = $this
				->db
				->select('*')
				->from($this->favourites_table_name)
				->where('type','film')
				->where('uye_id',$uye_id)
				->join('filmler','favoriler.movie_id = filmler.film_id')
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}

	}

	public function favori_diziler($uye_id){

		$data = $this
				->db
				->select('*')
				->from($this->favourites_table_name)
				->where('type','dizi')
				->where('uye_id',$uye_id)
				->join('diziler','favoriler.movie_id = diziler.dizi_id')
				->get()
				->result();

		if($data){
			return $data;
		}else{
			return false;
		}

	}
	
	public function son_yorumlar($uye_id){

		$data1 = $this
				->db
				->select('*')
				->from($this->comments_table_name)
				->where('uye_id',$uye_id)
				->where('comment_onay', 1)
				->join('filmler','filmler.film_id = yorumlar.movie_id')
				->order_by('sended_date','DESC')
				->get()
				->result();
				
		$data2= $this
				->db
				->select('*')
				->from($this->comments_table_name)
				->where('uye_id',$uye_id)
				->where('comment_onay', 1)
				->join('diziler','diziler.dizi_id = yorumlar.movie_id')
				->order_by('sended_date','DESC')
				->get()
				->result();

		$data = array(
			'son_film_yorumları' =>$data1,
			'son_dizi_yorumları' =>$data2,
		);

		if($data){
			return $data;
		}else{
			return false;
		}

	}	

}
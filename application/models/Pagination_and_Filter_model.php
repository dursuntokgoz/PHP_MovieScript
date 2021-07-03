<?php
class Pagination_and_Filter_model extends CI_Model{

    public function __construct()
	{
        parent::__construct();
    }

	public $uyeler_table_name = 'uyeler';
	public $admin_panel_table_name ='admin_paneli';

	public $filmler_table_name ='filmler';
	public $diziler_table_name ='diziler';
	public $bölümler_table_name ='dizi_bölümleri';

	public $yorumlar_table_name ='yorumlar';

	public $cast_table_name ='cast';


	/* Arama Modelleri */

	function filmara($harf){
		$data1 =  $this
				->db
				->from($this->filmler_table_name)
				->like('film_ad', $harf)
				->limit(5)
				->get()
				->result();

		$data2 =  $this
				->db
				->from($this->diziler_table_name)
				->like('dizi_ad', $harf)
				->limit(5)
				->get()
				->result();

		$data3 =  $this
				->db
				->from($this->cast_table_name)
				->like('cast_name', $harf)
				->limit(5)
				->get()
				->result();				

		$result =array(
					'filmler' =>$data1,
					'diziler' =>$data2,
					'oyuncular' =>$data3,
				);

		return $result;

	}

	function filmfiltrele($film_türü, $film_puanı, $film_release_date){
		$film_puanı_min = explode(',',$film_puanı)[0];
		$film_puanı_max = explode(',',$film_puanı)[1];		
		$film_release_date_min = explode(',',$film_release_date)[0] + 0;
		$film_release_date_max = explode(',',$film_release_date)[1] + 0;
		
		if($film_türü == null){
			$data = $this
					->db
					->from($this->filmler_table_name)
					->where('film_puanı >=', $film_puanı_min)
					->where('film_puanı <=', $film_puanı_max)
					->where('film_release_date >=', $film_release_date_min)
					->where('film_release_date <=', $film_release_date_max)
					->limit(20)
					->get()
					->result();
		}else{
			foreach($film_türü as $film_türleri){
				$data = $this
						->db
						->from($this->filmler_table_name)
						->like('film_türü', $film_türleri)
						->where('film_puanı >=', $film_puanı_min)
						->where('film_puanı <=', $film_puanı_max)
						->where('film_release_date >=', $film_release_date_min)
						->where('film_release_date <=', $film_release_date_max)
						->limit(20)
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
	
	function dizifiltrele($dizi_türü, $dizi_puanı, $dizi_release_date){
		$dizi_puanı_min = explode(',',$dizi_puanı)[0];
		$dizi_puanı_max = explode(',',$dizi_puanı)[1];		
		$dizi_release_date_min = explode(',',$dizi_release_date)[0] + 0;
		$dizi_release_date_max = explode(',',$dizi_release_date)[1] + 0;
		
		if($dizi_türü == null){
			$data = $this
					->db
					->from($this->diziler_table_name)
					->where('dizi_puanı >=', $dizi_puanı_min)
					->where('dizi_puanı <=', $dizi_puanı_max)
					->where('dizi_release_date >=', $dizi_release_date_min)
					->where('dizi_release_date <=', $dizi_release_date_max)
					->limit(20)
					->get()
					->result();
		}else{
			foreach($dizi_türü as $dizi_türleri){
				$data = $this
						->db
						->from($this->diziler_table_name)
						->like('dizi_türü', $dizi_türleri)
						->where('dizi_puanı >=', $dizi_puanı_min)
						->where('dizi_puanı <=', $dizi_puanı_max)
						->where('dizi_release_date >=', $dizi_release_date_min)
						->where('dizi_release_date <=', $dizi_release_date_max)
						->limit(20)
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

}

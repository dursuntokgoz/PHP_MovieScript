<?php
// Rütbe Fonksiyonları
	function kişi_rütbe_bul($uye_id){
		$ci =& get_instance();

		$admin_control = $ci
				->db
				->from("admin_paneli")
				->where('admin_id',$uye_id)
				->get()
				->row();	
		if($admin_control){			
			return $admin_control->admin_rütbe;
		}else{
			return 0;
		}
		
	}
	function print_kişi_rütbe($admin_rütbe_id){
		
		switch ($admin_rütbe_id) {

			case 1:
				echo "Yönetici";
			break;

			case 2:
				echo "Admin";
			break;

			case 3:
				echo "Modaratör";
			break;
			
			default:
				echo "Üye";
		}
	};
// Dizi ve Film Fonksiyonları


	function bölümlerigrupla($dizi_id, $season = null){

		if($season){
			$ci =& get_instance();

			$data = $ci
					->db
					->select('*')
					->from('dizi_bölümleri')
					->where('dizi_id',$dizi_id)
					->where('season_number',$season)
					->get()
					->result();

		}else{
			$ci =& get_instance();

			$data = $ci
					->db
					->select('*')
					->from('dizi_bölümleri')
					->where('dizi_id',$dizi_id)
					->get()
					->result();
		}

		if($data){
			return $data;
		}else{
			return false;
		}
	};

	function prevandnextepisode($episode_infos = array()){

		$episode_number = $episode_infos->episode_number;		
		$episode_sef_link = $episode_infos->episode_sef_link;

		$prev_sef_link = str_replace("bolum-".substr($episode_sef_link, -1), "bolum-".($episode_number-1), $episode_sef_link);
		$next_sef_link = str_replace("bolum-".substr($episode_sef_link, -1), "bolum-".($episode_number+1), $episode_sef_link);


		$ci =& get_instance();

		$prev_data = $ci
				->db
				->select('*')
				->from('dizi_bölümleri')
				->where('episode_sef_link',$prev_sef_link)
				->get()
				->row();

		$next_data = $ci
				->db
				->select('*')
				->from('dizi_bölümleri')
				->where('episode_sef_link',$next_sef_link)
				->get()
				->row();

		if($prev_data && $next_data){
			$data = array(
				"prev" => $prev_data->episode_sef_link,
				"next" => $next_data->episode_sef_link,
			);
			return $data;
		}elseif($prev_data){
			$data = array(
				"prev" => $prev_data->episode_sef_link,
			);
			return $data;
		}elseif($next_data){
			$data = array(
				"next" => $next_data->episode_sef_link,
			);
			return $data;
		}else{
			return false;
		}
		
	}

	function favorikontrol($type, $uye_id, $movie_id){

			$ci =& get_instance();

			$data = $ci
					->db
					->select('*')
					->from('favoriler')
					->where('type',$type)
					->where('uye_id',$uye_id)
					->where('movie_id',$movie_id)
					->get()
					->result();

		if($data){
			return $data;
		}else{
			return false;
		}
	};

	function kaynaklinkleri($movie_id, $bölüm_id = null){

		if($bölüm_id == null){
			$ci =& get_instance();

			$data = $ci
					->db
					->select('*')
					->from('kaynak_linkleri')
					->where('film_id',$movie_id)
					->order_by('kaynak_ismi','DESC')
					->get()
					->result();

		}else{
			$ci =& get_instance();

			$data = $ci
					->db
					->select('*')
					->from('kaynak_linkleri')
					->where('dizi_id',$movie_id)
					->where('bölüm_id',$bölüm_id)
					->order_by('kaynak_ismi','DESC')
					->get()
					->result();
		}

		if($data){
			return $data;
		}else{
			return false;
		}
	};

	function kaynakgrupla($kaynaklar = array()){
		
		$grouped = array();
		foreach (array_filter($kaynaklar) as $p){
			
			if (!array_key_exists($p->kaynak_türü, $grouped)){
				$grouped[$p->kaynak_türü] = array();
				
				if (!array_key_exists($p->kaynak_ismi, $grouped[$p->kaynak_türü])){
				$grouped[$p->kaynak_türü][$p->kaynak_ismi] = array();
				}
			}

			$grouped[$p->kaynak_türü][$p->kaynak_ismi][] = $p;
			
		}
		
		return $grouped;
	}


	function ekipgrupla($ekip = array()){

		$grouped = array();
		
		foreach (array_filter($ekip) as $p){
			
			if (!array_key_exists($p->cast_job, $grouped)){
				$grouped[$p->cast_job] = array();
			}

			$grouped[$p->cast_job][] = $p;
		}
		
		return array_filter($grouped);

	}

	function site_puanı($type, $movie_id){
		$ci =& get_instance();
			$data = $ci
					->db
					->select('*')
					->from('yorumlar')
					->where('comment_type',$type)
					->where('movie_id',$movie_id)
					->get()
					->result();
	
		if($data){
			foreach($data as $data2){
				$puanlar[] = $data2->comment_rate;
			}
			$sonuç = array_sum($puanlar)/count($puanlar);
		}else{
			$sonuç = '0';
		}
		return (double)$sonuç;
	}

	function site_puanı_sıralama($type){

		if($type == 'film'){
			$ci =& get_instance();			
			$film_idleri = $ci
				->db
				->select('film_id')
				->from('filmler')
				->get()
				->result_array();

			foreach($film_idleri as $film_id){
				foreach($film_id as $id){
					$data[] = array(
						'film_id' => $id,
						'site_puanı' => site_puanı('film',$id),
					);
				}
			}
			foreach ($data as $key => $value) {
				$a[$key]  = $value['film_id'];
				$b[$key] = $value['site_puanı'];
			}			
			array_multisort($b, SORT_DESC, $data);
			
			for($a = 0; $a < count($data); $a++){
				array_push($data[$a], $a+1);
				$data[$a]['sıralama'] = $data[$a][0];
				unset($data[$a][0]);					
			}
								
			return $data;

			
		}elseif($type == 'dizi'){			
			$ci =& get_instance();			
			$dizi_idleri = $ci
				->db
				->select('dizi_id')
				->from('diziler')
				->get()
				->result_array();

			foreach($dizi_idleri as $dizi_id){
				foreach($dizi_id as $id){
					$data[] = array(
						'dizi_id' => $id,
						'site_puanı' => site_puanı('dizi',$id),
					);
				}
			}
			foreach ($data as $key => $value) {
				$a[$key]  = $value['dizi_id'];
				$b[$key] = $value['site_puanı'];
			}			
			array_multisort($b, SORT_DESC, $data);
			
			for($a = 0; $a < count($data); $a++){
				array_push($data[$a], $a+1);
				$data[$a]['sıralama'] = $data[$a][0];
				unset($data[$a][0]);					
			}
								
			return $data;
			
		}else{
			return false;
		}
		
		
	}
	
	function top10($type){
		
		if($type == 'film'){
			$ci =& get_instance();			
			$film_idleri = $ci
				->db
				->select('film_id')
				->from('filmler')
				->get()
				->result_array();
				
			if(count($film_idleri) >= 10){
				// 10 filmi seçme
				foreach($film_idleri as $film_id){
					foreach($film_id as $id){
						$data[] = array(
							'film_id' => $id,
							'site_puanı' => site_puanı('film',$id),
						);
					}
				}
				foreach ($data as $key => $value) {
					$a[$key]  = $value['film_id'];
					$b[$key] = $value['site_puanı'];
				}			
				array_multisort($b, SORT_DESC, $data);				  
				$top_10 = array_slice($data, 0,10);
				
				/* Seçilen filmlerin bilgilerini alma*/			
				for($a = 0; $a < 10; $a++){
					$filmler[] = $ci
						->db
						->select('*')
						->from('filmler')
						->where('film_id', $top_10[$a]['film_id'])
						->get()
						->result_array();	
						
					array_push($filmler[$a][0], $top_10[$a]['site_puanı']);
					$filmler[$a][0]['site_puanı'] = $filmler[$a][0][0];
					unset($filmler[$a][0][0]);				
				}
				return $filmler;
			}else{
				return null;
			}
			
		}elseif($type == 'dizi'){			
			$ci =& get_instance();			
			$dizi_idleri = $ci
				->db
				->select('dizi_id')
				->from('diziler')
				->get()
				->result_array();
			
			if(count($dizi_idleri) >= 10){
				// 10 filmi seçme
				foreach($dizi_idleri as $dizi_id){
					foreach($dizi_id as $id){
						$data[] = array(
							'dizi_id' => $id,
							'site_puanı' => site_puanı('dizi',$id),
						);
					}
				}
				foreach ($data as $key => $value) {
					$a[$key]  = $value['dizi_id'];
					$b[$key] = $value['site_puanı'];
				}			
				array_multisort($b, SORT_DESC, $data);				  
				$top_10 = array_slice($data, 0,10);
				
				/* Seçilen dizilerin bilgilerini alma*/			
				for($a = 0; $a < 10; $a++){
					$diziler[] = $ci
						->db
						->select('*')
						->from('diziler')
						->where('dizi_id', $top_10[$a]['dizi_id'])
						->get()
						->result_array();	
						
					array_push($diziler[$a][0], $top_10[$a]['site_puanı']);
					$diziler[$a][0]['site_puanı'] = $diziler[$a][0][0];
					unset($diziler[$a][0][0]);				
				}
				return $diziler;
			}else{
				return null;
			}
			
		}else{
			return false;
		}
				
	}
	
// Tür Ayar Fonksiyonları
	function türler($type){
		$ci =& get_instance();

		$data = $ci
				->db
				->select('*')
				->from('türler')
				->where('tip', $type)
				->get()
				->result();

		return $data;
	};

// Yorum Fonksiyonları
	function üyeresminial($uye_id){

		$ci =& get_instance();

		$data = $ci
				->db
				->select('*')
				->from('uyeler')
				->where('uye_id',$uye_id)
				->get()
				->row();

		$result = array(
			'uye_nickname' => $data->uye_nickname,
			'uye_ad' => $data->uye_ad,
			'uye_soyad' => $data->uye_soyad,
			'uye_avatar' => $data->uye_avatar,
		);

		return $result;
	};
// Resim ve Video Fonksiyonları

	function image_url($url, $sef_link = null){
		
		if($sef_link == null){
			if($url[0] == "/"){
				return "https://image.tmdb.org/t/p/original".$url;
			}else{
				return base_url('assets/uploads/casts/').$url;
			}
		}else{
			if($url[0] == "/"){
				return "https://image.tmdb.org/t/p/original".$url;
			}else{
				return base_url('assets/uploads/movies/').$sef_link.'/'.$url;
			}
		}
	
	}
	
	function avatar_url($url){
		
		if (filter_var($url, FILTER_VALIDATE_URL) == true) {
			return $url;		
		}elseif($url != null){
			return base_url('assets/uploads/avatars/'.$url);	
		}else{
			return base_url('assets/uploads/avatars/user-default.png');
		}
	}	

// Yazı Kısaltma Fonksiyonu

	function açıklama_kisalt($kelime, $str = 100)
	{
		if (strlen($kelime) > $str)
		{
			if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8").'...'.'<br><a>Devamı İçin Sayfaya Gidin</a>';
			else $kelime = substr($kelime, 0, $str).'..';
		}
		return $kelime;
	}

	function yazi_kisalt($kelime, $str = 10)
	{
		if (strlen($kelime) > $str)
		{
			if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8").'...';
			else $kelime = substr($kelime, 0, $str).'..';
		}
		return $kelime;
	}

// Bildirim Fonksiyonları

	function başarılı_bildirimi($mesaj){
	  $data = 
		"
		  <div class='alert alert-success alert-with-icon' data-notify='container'>
			<i class='material-icons' data-notify='icon'>notifications</i>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			  <i class='material-icons'>close</i>
			</button>
			<span data-notify='message'>$mesaj</span>
		  </div>
		";
		return $data;
	}

	function başarısız_bildirimi($mesaj){
	  $data = 
		"
		  <div class='alert alert-danger alert-with-icon' data-notify='container'>
			<i class='material-icons' data-notify='icon'>notifications</i>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
			  <i class='material-icons'>close</i>
			</button>
			<span data-notify='message'>$mesaj</span>
		  </div>
		";
		return $data;
	}

// Klasör Fonksiyonları

	function klasör_sil($dir)
	{
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object)
			{
				if ($object != "." && $object != "..")
				{
					if (is_dir($dir. "/" . $object)) {
						remove_dir($dir . "/" . $object);
					} else {
						unlink($dir . "/" . $object);
					}
				}
			}
			rmdir($dir);
	   }
	}
?>
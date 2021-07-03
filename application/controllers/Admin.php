<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_Operations_model');
		$this->load->model('IMDB_Operations_model');
		$this->load->library('form_validation');
	}

	public function index(){
		
		if(isset($this->session->userdata('user')->admin_rütbe) && $this->session->userdata('admin_durum') == false){			
			$this->load->view('backend/Admin_login_view');
		}
		elseif($this->session->userdata('admin_durum') == true){
			redirect('Admin/home');
		}else{
			redirect(base_url());
		}

	}

	public function home(){

		if($this->session->userdata('admin_durum') == true){

			$view_Data = array(
				'filmler' => $this->Admin_Operations_model->print_count('film'),
				'diziler' => $this->Admin_Operations_model->print_count('dizi'),
				'üyeler' => $this->Admin_Operations_model->print_count('üye'),
				'yorum_sayısı' => $this->Admin_Operations_model->print_count('yorum'),
			);
				$this->load->view('backend/Admin_home_view', $view_Data);

		}else{

			redirect('Admin');

		}

	}

	/* Admin Ayarları Sayfaları */
	public function admin_settings(){

		if($this->session->userdata('admin_durum') == true){

			$this->config->load('website_config');
			$site_bilgileri = array(
				'site_ismi' => $this->config->item('site_name'),
				'site_logo' => $this->config->item('site_logo'),
				'site_facebook' => $this->config->item('site_facebook'),
				'site_twitter' => $this->config->item('site_twitter'),
				'site_coder' => $this->config->item('site_coder'),
			);

			$adminler = $this->Admin_Operations_model->print_admins();
			$kişiler = $this->Admin_Operations_model->print_members();
				$view_Data = array(
					'site_bilgileri' => $site_bilgileri,
					'adminler' => $adminler,
					'kişiler' => $kişiler,
				);
	
				$this->load->view('backend/admin_settings/Admin_settings_view', $view_Data);

		}else{

			redirect('Admin');

		}

	}

	/* Film ve Dizi Sayfaları */
	public function filmler(){

		if($this->session->userdata('admin_durum') == true){

			$view_Data = array(
				'filmler' => $this->Admin_Operations_model->print_filmler(),
			);

			$this->load->view('backend/movies_settings/Admin_filmler_view', $view_Data);

		}else{

			redirect('Admin');

		}

	}

	public function diziler(){

		if($this->session->userdata('admin_durum') == true){

			$view_Data = array(
				'diziler' => $this->Admin_Operations_model->print_diziler(),
			);

			$this->load->view('backend/movies_settings/Admin_diziler_view', $view_Data);

		}else{

			redirect('Admin');

		}

	}

	public function add_movie(){

		if($this->session->userdata('admin_durum') == true){

			$this->load->view('backend/movies_settings/Admin_add_movie_view');

		}else{

			redirect('Admin');

		}

	}


	public function edit_movie($type, $movie_id){

		if($this->session->userdata('admin_durum') == true && $type != null && $movie_id != null){
			
			$casts = $this->Admin_Operations_model->print_casts();

			if($type == 'film'){

				$film_bilgileri = $this->Admin_Operations_model->print_film($movie_id);
				$film_resimleri = $this->Admin_Operations_model->print_images('film', $movie_id);
				$film_videoları = $this->Admin_Operations_model->print_videos('film', $movie_id);
				
				$film_ekibi = $this->Admin_Operations_model->print_movie_casts(explode(',',$film_bilgileri->film_ekibi));
					
				function compare_objects($obj_a, $obj_b) {
				  return $obj_a->id - $obj_b->id;
				}
				$diff = array_udiff($casts, $film_ekibi, 'compare_objects');

				$view_Data = array(
					'film_bilgileri' => $film_bilgileri,
					'film_resimleri' => $film_resimleri,
					'film_videoları' => $film_videoları,
					'film_ekibi' => $film_ekibi,
					'casts' => $diff,
				);

				$this->load->view('backend/movies_settings/Admin_edit_film_view', $view_Data);

			}
			elseif($type == 'dizi'){

				$dizi_bilgileri = $this->Admin_Operations_model->print_dizi($movie_id);
				$dizi_bölümleri = $this->Admin_Operations_model->print_episodes($movie_id);
				$dizi_resimleri = $this->Admin_Operations_model->print_images('dizi', $movie_id);
				$dizi_videoları = $this->Admin_Operations_model->print_videos('dizi', $movie_id);
				
				$dizi_ekibi = $this->Admin_Operations_model->print_movie_casts(explode(',',$dizi_bilgileri->dizi_cast));
				
				function compare_objects($obj_a, $obj_b) {
				  return $obj_a->id - $obj_b->id;
				}
				$diff = array_udiff($casts, $dizi_ekibi, 'compare_objects');
				
				$view_Data = array(
					'dizi_bilgileri' => $dizi_bilgileri,
					'dizi_bölümleri' => $dizi_bölümleri,
					'dizi_resimleri' => $dizi_resimleri,
					'dizi_videoları' => $dizi_videoları,
					'dizi_ekibi' => $dizi_ekibi,
					'casts' => $diff,
				);

				$this->load->view('backend/movies_settings/Admin_edit_dizi_view', $view_Data);

			}

		}else{

			redirect('Admin/movies');

		}

	}



 /* Yorum Ayarları */
 
	public function comments(){
		if($this->session->userdata('admin_durum') == true){
			
			$onaylanmamış_yorumlar = $this->Admin_Operations_model->print_comments('onaysız');
			$onaylanmış_yorumlar = $this->Admin_Operations_model->print_comments('onaylı');
			$view_Data = array(
				'onaylanmamış_yorumlar' => $onaylanmamış_yorumlar,
				'onaylanmış_yorumlar' => $onaylanmış_yorumlar,
			);
			
			$this->load->view('backend/movies_settings/Admin_comments_view', $view_Data);
			
		}else{

			redirect('Admin');

		}			
	}
	/* Yapımcı Sayfaları */
	public function casts(){

		if($this->session->userdata('admin_durum') == true){
			$casts = $this->Admin_Operations_model->print_casts();
			$view_Data = array(
				'casts' => $casts,
			);

			$this->load->view('backend/cast_settings/Admin_casts_view', $view_Data);

		}else{

			redirect('Admin');

		}

	}

	public function add_cast(){

		if($this->session->userdata('admin_durum') == true){

			$view_Data = array(
				
			);

			$this->load->view('backend/cast_settings/Admin_add_cast_view', $view_Data);

		}else{

			redirect('Admin');

		}

	}

	public function edit_cast($cast_id = null){

		if($this->session->userdata('admin_durum') == true){
			
			$cast_bilgileri = $this->Admin_Operations_model->print_cast($cast_id);
			
			$view_Data = array(
				'cast_bilgileri' => $cast_bilgileri,
			);

			$this->load->view('backend/cast_settings/Admin_edit_cast_view', $view_Data);

		}else{

			redirect('Admin');

		}

	}

	/* Üye İşlemleri Sayfaları */
	public function members(){

		if($this->session->userdata('admin_durum') == true){

			$view_Data = array(
				'üye_bilgileri' => $this->Admin_Operations_model->print_members(),
			);

				$this->load->view('backend/user_settings/Admin_members_view', $view_Data);

		}else{

			redirect('Admin');

		}

	}

	public function member_edit($uye_id){

		if($this->session->userdata('admin_durum') == true && $this->Admin_Operations_model->print_member_information($uye_id) != null){

				$view_Data = array(
					'üye_bilgisi' => $this->Admin_Operations_model->print_member_information($uye_id),
				);
	
				$this->load->view('backend/user_settings/Admin_member_view', $view_Data);

		}else{

			redirect('Admin');

		}

	}
	
	/* Admin Mail Kutusu Sayfaları */
	
	public function mail_box(){

		if($this->session->userdata('admin_durum') == true){


		}else{

			redirect('Admin');

		}		
		
	}

}

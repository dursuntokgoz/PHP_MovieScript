<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_Operations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_Operations_model');
		$this->load->library('form_validation');
	}

	public function register(){

			$this->form_validation->set_rules('password','Şifre','matches[re_password]|min_length[6]|trim|required');
			$this->form_validation->set_rules('re_password','Şifre Tekrarı','trim|required');
			$this->form_validation->set_rules('email','E-mail','is_unique[uyeler.uye_email]|required');
			$this->form_validation->set_rules('nickname','Kullanıcı adı','is_unique[uyeler.uye_nickname]|required');
			

			$this->form_validation->set_message('required','%s alanı boş bırakılamaz.');
			$this->form_validation->set_message('matches','Şifreler birbiriyle uyuşmuyor.');
			$this->form_validation->set_message('min_length','%s en az 6 karakterden oluşmak zorundadır.');
			$this->form_validation->set_message('is_unique','Girmiş olduğunuz %s zaten siteye kayıtlı.');

		if($this->form_validation->run()){

				$data =array(
					'uye_nickname' => $this->input->post('nickname'),
					'uye_email' => $this->input->post('email'),
					'uye_sifre' => md5($this->input->post('password')),
					'uye_avatar' => '',
					'uye_aktif' => 1,
					'uye_kayit_tarihi' => date('Y-m-d H:i:s'),
					'uyelik_türü' => 'normal',
				);
				
				$sonuc = $this->Member_Operations_model->register($data);

				if($sonuc){
					echo true;
				}else{
					echo false;
				}		
		}else
		{
			echo validation_errors();
		}
	}

	public function login(){

		$this->form_validation->set_rules('email','E-Mail','required');
		$this->form_validation->set_rules('password','Şifre','required');
		$this->form_validation->set_message('required','%s alanı boş bırakılamaz.');

		if($this->form_validation->run()){

				$email = $this->input->post('email');
				$sifre = md5($this->input->post('password'));

				$sonuc = $this->Member_Operations_model->login($email, $sifre);


			if($sonuc && $sonuc == "ban"){
				echo "Hesabınız erişime kapatılmıştır.";
			}
			elseif($sonuc && $sonuc != "ban"){

				$this->session->set_userdata('durum',true);
				$this->session->set_userdata('user', $sonuc);

				$grit="<script>$(document).ready(function() {'use strict';
						$(function(){
						$.gritter.add({
						title: 'Hoşgeldin  $sonuc->uye_ad ',
						text: 'Bu sitede istediğin her türlü diziyi ve filmi bulabilirsin. İyi Seyirler.',
						class_name: 'with-icon check-circle success',
						sticky: false,
						time: ''
						});
						return false;
						});
						});
						</script>";
						$this->session->set_flashdata('grit',$grit);
				echo true;
			}else{
				echo 'Girmiş olduğunuz bilgiler hatalı.';
			}

		}else{

			echo validation_errors();
		}
	}

	public function logout(){

		$this->session->sess_destroy();

		redirect($_SERVER['HTTP_REFERER']);

	}

	public function add_comment(){

		$comments_about_movie = array_filter(array(
			'movie_id' => $this->input->post('movie_id'),
			'episode_id' => $this->input->post('episode_id'),
			'uye_id' => $this->input->post('uye_id'),
			'comment_rate' => $this->input->post('movie_rate'),
			'comment_title' => strip_tags($this->input->post('comment_title')),
			'comment' => strip_tags($this->input->post('comment')),
			'sended_date' => date('Y-m-d H:i:s'),
			'comment_onay' => 0,
			'comment_type' => $this->input->post('type'),
			'comment_spoiler' => $this->input->post('spoiler'),
		));

		$sonuc = $this->Member_Operations_model->yorum_yap($comments_about_movie);

		if($sonuc){
			echo true;
		}else{
			echo false;
		}

	}

	public function add_favourites(){

		$data_favourites = array(
			'type' => $this->input->post('favourite_type'),
			'uye_id' => $this->input->post('uye_id'),
			'movie_id' => $this->input->post('movie_id'),
		);

		$sonuc = $this->Member_Operations_model->favori_ekle($data_favourites);

		if($sonuc){
			echo true;
		}else{
			echo false;
		}


	}

	public function remove_favourites(){

		$sonuc = $this->Member_Operations_model->favori_kaldır($this->input->post('favourite_type'), $this->input->post('uye_id'), $this->input->post('movie_id'));

	
		if($sonuc){
			echo true;
		}else{
			echo false;
		}


	}

}

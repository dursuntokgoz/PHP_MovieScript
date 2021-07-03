<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook extends CI_Controller {

	private $fb;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_Operations_model');
		$this->load->library('FacebookSDK');
		$this->fb=$this->facebooksdk;
	}

	public function index()
	{
		$data = $this->fb->getLoginUrl(base_url('Facebook/callback'));
		redirect($data);

	}

	public function callback()
	{
		$token = $this->fb->getAccessToken();
		$data =	$this->fb->getUserData($token);

		$email = $data['email'];
		
		$sonuc = $this->Member_Operations_model->fblogin($email);

		if($sonuc && $sonuc == "ban"){

			$grit="<script>$(document).ready(function() {'use strict';
				$(function(){
				$.gritter.add({
				title: 'Dikkat!',
				text: 'Malesef hesabınız erişime kapatılmıştır.',
				class_name: 'with-icon check-circle danger',
				sticky: false,
				time: ''
				});
				return false;
				});
				});
				</script>";
				$this->session->set_flashdata('grit',$grit);
				redirect($_SERVER['HTTP_REFERER']);
			
		}
		elseif($sonuc && $sonuc != "ban"){

			$this->session->set_userdata('durum',true);
			$this->session->set_userdata('user', $sonuc);

			$grit="<script>$(document).ready(function() {'use strict';
					$(function(){
					$.gritter.add({
					title: 'Hoşgeldin  $data[name]',
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
					redirect($_SERVER['HTTP_REFERER']);
		}else
		{
				$kişi_adı = explode(' ', $data['name'])[0];
				$kişi_soyadı = explode(' ', $data['name'])[1];

				$random_pass = rand(123456,987654);
				$fb_nickname = "fb:".seflink($data['name']);
				
				$data =array(
					'uyelik_türü' => 'facebook',
					'uye_nickname' => $fb_nickname,
					'uye_ad' => $data['first_name'],
					'uye_soyad' => $data['last_name'],
					'uye_email' => $data['email'],
					'uye_sifre' => md5($random_pass),
					'uye_avatar' => 'http://graph.facebook.com/'.$data['id'].'/picture',
					'uye_aktif' => 1,
					'uye_kayit_tarihi' => date('Y-m-d H:i:s'),
				);

				
				$register_options = $this->Member_Operations_model->register($data);

				if($register_options){
					redirect(base_url('Facebook'));
				}

		}
	}

}
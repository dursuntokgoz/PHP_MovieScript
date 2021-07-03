<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_Operations extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Member_Operations_model');
		$this->load->library('form_validation');
	}
	
	public function profile_update1(){

		/* K. Adı İsim ve Soyisim Değişikliği*/
			$this->form_validation->set_rules('new_nickname','Kullanıcı adı','is_unique[uyeler.uye_nickname]');

			$this->form_validation->set_message('is_unique','Girmiş olduğunuz %s zaten siteye kayıtlı.');

		if($this->form_validation->run()){
	
			$new_nickname = $this->input->post('new_nickname');
			$new_first_name= $this->input->post('new_first_name');
			$new_last_name= $this->input->post('new_last_name');

			$changed_info = array_filter(array(
				'uye_nickname' => $new_nickname,
				'uye_ad' => $new_first_name,
				'uye_soyad' => $new_last_name,
			));
	
			$kisi = $this->session->userdata('user');

			$sonuc = $this->Member_Operations_model->profileupdate($changed_info, $kisi->uye_id);

			if($sonuc){
				$this->Member_Operations_model->updateusersession($kisi->uye_id);
				echo true;
			}

		}else{

			echo validation_errors();

		}

	}

	public function profile_update2(){

		/* Sosyal Medya Ayarları */
			$this->form_validation->set_rules('facebook_url','Facebook linkin','valid_url');
			$this->form_validation->set_rules('twitter_url','Twitter linkin','valid_url');

			$this->form_validation->set_message('valid_url','Girmiş olduğunuz %s url yapısına sahip olmalıdır.');

		if($this->form_validation->run()){
	
			$facebook_url = $this->input->post('facebook_url');
			$twitter_url = $this->input->post('twitter_url');

			$changed_info = array_filter(array(
				'uye_facebook_url' => $facebook_url,
				'uye_twitter_url' => $twitter_url,
			));
			$kisi = $this->session->userdata('user');

			$sonuc = $this->Member_Operations_model->profileupdate($changed_info, $kisi->uye_id);

			if($sonuc){
				$this->Member_Operations_model->updateusersession($kisi->uye_id);
				echo true;
			}

		}else{

			echo validation_errors();

		}


	}

	public function profile_update3(){

		/* Şifre değişikliği */

			$this->form_validation->set_rules('old_password','Eski Şifre','required|trim');
			$this->form_validation->set_rules('new_password','Yeni Şifre','required|matches[re_new_password]|min_length[6]|trim');
			$this->form_validation->set_rules('re_new_password','Yeni Şifre Onayı','required|trim');

			$this->form_validation->set_message('matches','Yeni şifreler birbiriyle uyuşmuyor.');
			$this->form_validation->set_message('required','%s alanı boş bırakılamaz.');
			$this->form_validation->set_message('min_length','%s en az 6 karakterden oluşmak zorundadır.');


			if($this->form_validation->run()){

					$old_pass = md5($this->input->post('old_password'));
					$kisi = $this->session->userdata('user');

					$pass_control = $this->Member_Operations_model->login($kisi->uye_email, $old_pass);

					if($pass_control){

						$new_password = $this->input->post('new_password');

						$changed_info = array(
							'uye_sifre' => md5($new_password),
						);

						$sonuc = $this->Member_Operations_model->profileupdate($changed_info, $kisi->uye_id);

						if($sonuc){
							$this->Member_Operations_model->updateusersession($kisi->uye_id);
							echo true;
						}

					}else{

						echo 'Şuanki şifreniz hatalı.';

					}

			}else{

				echo validation_errors();

			}
	}

	public function change_avatar(){

			$kisi = $this->session->userdata('user');

			$config = array(
				'upload_path' => 'assets/uploads/avatars',
				'allowed_types' => 'jpg|jpeg|png|gif',
				'file_name' => $kisi->uye_id,
				'max_width' =>'250',
				'max_height' =>'250',
				'min_width' =>'100',
				'min_height' =>'100',
				'overwrite' => true,
			);

			// Load upload library 
			$this->load->library('upload',$config); 
		   
			// File upload
			if($this->upload->do_upload('avatar_image')){
				 // Get data about the file
				 $uploadData = $this->upload->data(); 
				 $filename = $kisi->uye_id . $uploadData['file_ext']; 
				 $veritabanikayit = $filename.'';
				 
				$changed_info = array_filter(array(
					'uye_avatar' => $veritabanikayit,
				));

				$sonuc = $this->Member_Operations_model->profileupdate($changed_info, $kisi->uye_id);

				if($sonuc){
					$this->Member_Operations_model->updateusersession($kisi->uye_id);
					echo true;
				}else{
					echo false;
				}				 
			}else{
				echo $this->upload->display_errors();
			}
	}


}
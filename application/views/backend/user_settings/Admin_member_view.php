<?php $this->load->view('backend/include/header'); ?>
      <div class="content">
        <div class="container-fluid">
		<?php echo $this->session->flashdata('info'); ?>
          <div class="row">
            <div class="col-md-9">
			  <div class="change_user_profile_information"></div>
              <div class="card ">
                <div class="card-header ">
                  <h4 class="card-title"><?php if($üye_bilgisi['uye_ad']){echo $üye_bilgisi['uye_ad'] .' '.$üye_bilgisi['uye_soyad']; }else{ echo $üye_bilgisi['uye_nickname']; }?>
                    <small class="description">Profili</small>
                  </h4>
                </div>
                <div class="card-body ">
                  <ul class="nav nav-pills nav-pills-danger" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#profildüzenle" role="tablist">
                        Profili Düzenle
                      </a>
                    </li>
				<?php if(isset($üye_bilgisi['admin_id']) && $this->session->userdata('admin_bilgi')->admin_rütbe == "1"){?>	
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#adminayarları" role="tablist">
                        Yönetici Ayarları
                      </a>
                    </li>
				<?php } ?>
                  </ul>
                  <div class="tab-content tab-space">
                    <div class="tab-pane active" id="profildüzenle">

						<div class="col-md-12">
						  <div class="card">
							<div class="card-header card-header-icon card-header-danger">
							  <div class="card-icon">
								<i class="material-icons">perm_identity</i>
							  </div>
							  <h4 class="card-title">Profili Düzenle
							  </h4>
							</div>
							<div class="card-body">
							  <form method="post" class="change-user-profile">
								<br>
								<div class="row">
								  <label class="col-sm-1 col-form-label">Kullanıcı Adı</label>
								  <div class="col-sm-5">
									<div class="form-group">
									  <input type="text" class="form-control" name="change_nickname" placeholder="<?php echo $üye_bilgisi['uye_nickname'] ?>">
									  <span class="bmd-help">Kullanıcını yeni kullanıcı adını giriniz.</span>
									</div>
								  </div>
								  <label class="col-sm-1 col-form-label">E-mail</label>
								  <div class="col-sm-5">
									<div class="form-group">
									  <input type="email" class="form-control" name="change_email" placeholder="<?php echo $üye_bilgisi['uye_email'] ?>">
									  <span class="bmd-help">Kullanıcının yeni e-mail adresini giriniz.</span>
									</div>
								  </div>
								</div>
								<br>
								<div class="row">
								  <label class="col-sm-1 col-form-label">İsim</label>
								  <div class="col-sm-5">
									<div class="form-group">
									  <input type="text" class="form-control" name="change_name" placeholder="<?php echo $üye_bilgisi['uye_ad'] ?>">
									  <span class="bmd-help">Kullanıcının yeni ismini giriniz.</span>
									</div>
								  </div>
								  <label class="col-sm-1 col-form-label">Soyisim</label>
								  <div class="col-sm-5">
									<div class="form-group">
									  <input type="text" class="form-control" name="change_surname" placeholder="<?php echo $üye_bilgisi['uye_soyad'] ?>">
									  <span class="bmd-help">Kullanıcının yeni soyismini giriniz..</span>
									</div>
								  </div>
								</div>
								<br>
								<div class="row">
								  <label class="col-sm-1 col-form-label">Facebook Adresi</label>
								  <div class="col-sm-5">
									<div class="form-group">
									  <input type="url" class="form-control" name="change_facebook_url" placeholder="<?php echo $üye_bilgisi['uye_facebook_url'] ?>">
									  <span class="bmd-help">Kullanıcının yeni facebook urlsini giriniz.</span>
									</div>
								  </div>
								  <label class="col-sm-1 col-form-label">Twitter Adresi</label>
								  <div class="col-sm-5">
									<div class="form-group">
									  <input type="url" class="form-control" name="change_twitter_url" placeholder="<?php echo $üye_bilgisi['uye_twitter_url'] ?>">
									  <span class="bmd-help">Kullanıcının yeni twitter urlsini giriniz.</span>
									</div>
								  </div>
								</div>
								<br>
								<div class="row">
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="bmd-label-floating">Yeni Şifre</label>
									  <input type="password" class="form-control" name="change_password">
									</div>
								  </div>
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="bmd-label-floating">Yeni Şifre (Onay)</label>
									  <input type="password" class="form-control" name="change_re_password" >
									</div>
								  </div>
								</div>
								<input type="hidden" class="form-control" name="id_bilgisi" value="<?php echo $üye_bilgisi['uye_id'] ?>">
								<button type="submit" class="btn btn-rose pull-right">Profili Güncelle</button>
								<div class="clearfix"></div>
							  </form>
							</div>
						  </div>
						</div>
                    </div>
				<?php if(isset($üye_bilgisi['admin_id']) && $this->session->userdata('admin_bilgi')->admin_rütbe == "1"){?>	
                    <div class="tab-pane" id="adminayarları">
						<div class="col-md-12">
							<div class="card ">
								<div class="card-header card-header-danger card-header-icon">
								<div class="card-icon">
									<i class="material-icons">edit</i>
								</div>
								<h4 class="card-title">Rütbeyi Değiştir</h4>
								</div>
								<div class="card-body ">
								<form class="form-horizontal" action="<?php echo base_url('Admin_Operations/edit_admin') ?>" method="post">
									<div class="row">
										<label class="col-md-3 col-form-label">Rütbeyi Seç</label>
										<div class="col-lg-9 col-md-6 col-sm-3">
										<select required class="selectpicker" name="admin_rütbe" data-size="7" data-style="select-with-transition" title="<?php echo print_kişi_rütbe($üye_bilgisi['admin_rütbe'])?>">
											<option value="">-- Rütbeyi Seçiniz --</option>
											<option value="1">Yönetici</option>
											<option value="2">Admin</option>
											<option value="3">Moderatör</option>
										</select>
										</div>
									</div>
								</div>
								<div class="card-footer ">
								<div class="row">
									<div class="col-md-9">
									<input type="hidden" name="admin_id" value="<?php echo $üye_bilgisi['admin_id']?>">
									<button type="submit" class="btn btn-fill btn-rose">Değiştir</button>
									</div>
								</div>
								</form>
								</div>
							</div>
						</div>							
                    </div>
				<?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="#pablo">
                    <img class="img" src="<?php echo avatar_url($üye_bilgisi['uye_avatar']) ?>">
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray"><?php echo $üye_bilgisi['uye_nickname']; ?></h6>
                  <h4 class="card-title"><?php if($üye_bilgisi['uye_ad']){echo $üye_bilgisi['uye_ad'] .' '.$üye_bilgisi['uye_soyad']; }else{ echo $üye_bilgisi['uye_nickname']; }?></h4>
			<?php if($üye_bilgisi['uye_aktif'] == 1){ ?>
				<form id="ban_user">
				  <input type="hidden" name="üye_id" value="<?php echo $üye_bilgisi['uye_id']?>">				
                  <button type="submit" class="btn btn-danger btn-round">Üyeyi Banla</button>
				</form>
			<?php }else{?>
				<form id="unban_user">
				  <button type="submit" class="btn btn-success btn-round">Üyenin Banını Kaldır</button>
				  <input type="hidden" name="üye_id" value="<?php echo $üye_bilgisi['uye_id']?>">
				</form>
			<?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


 <?php $this->load->view('backend/include/footer'); ?>
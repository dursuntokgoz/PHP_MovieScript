<?php $this->load->view('backend/include/header'); ?>


<div class="content">
    <div class="container-fluid">
	 <?php echo $this->session->flashdata('info'); ?>
	  <div class="row">
		<div class="col-md-12 ml-auto mr-auto">
		  <div class="page-categories">
			<h3 class="title text-center">Yönetici Ayarları</h3>
			<br />
			<ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">

			  <li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#siteayarı" role="tablist">
				  <i class="material-icons">info</i> Site Ayarları
				</a>
			  </li>

			  <li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#yetkiliayarı" role="tablist">
				  <i class="material-icons">info</i> Yetkili Ayarları
				</a>
			  </li>

			</ul>
			<div class="tab-content tab-space tab-subcategories">

			  <div class="tab-pane active" id="siteayarı">
				<div class="card">
				  <div class="card-body">
					
					<div class="col-md-8">
						<div class="card ">
							<div class="card-header card-header-rose card-header-icon">
							<div class="card-icon">
								<i class="material-icons">website</i>
							</div>
							<h4 class="card-title">Site Ayarları</h4>
							</div>
							<div class="card-body ">
							<form class="form-horizontal" action="<?php echo base_url('Admin_Operations/website_config') ?>" method="post">
								<div class="row">
								<label class="col-md-2 col-form-label">Site İsmi</label>
								<div class="col-md-10">
									<div class="form-group has-default">
									<input type="text" class="form-control" name="site_name" value="<?php echo $site_bilgileri['site_ismi']?>">
									</div>
								</div>
								</div>
								<div class="row">
								<label class="col-md-2 col-form-label">Facebook</label>
								<div class="col-md-4">
									<div class="form-group">
									<input type="text" class="form-control" name="site_facebook" value="<?php echo $site_bilgileri['site_facebook']?>">
									</div>
								</div>
								<label class="col-md-2 col-form-label">Twitter</label>
								<div class="col-md-4">
									<div class="form-group">
									<input type="text" class="form-control" name="site_twitter" value="<?php echo $site_bilgileri['site_twitter']?>">
									</div>
								</div>
								</div>
								<div class="row">
								<label class="col-md-2 col-form-label">Site Coder</label>
								<div class="col-md-4">
									<div class="form-group">
									<input type="text" class="form-control" name="site_coder" value="<?php echo $site_bilgileri['site_coder']?>">
									</div>
								</div>
								</div>

							</div>
							<div class="card-footer ">
							<div class="row">
								<div class="col-md-9">
								<button type="submit" class="btn btn-fill btn-rose">Siteyi Güncelle</button>
								</div>
							</div>
							</div>
							</form>
						</div>
					</div>
						
				  </div>
				</div>
			  </div>

			  <div class="tab-pane" id="yetkiliayarı">
				<div class="card">
				  <div class="card-body">


					<div class="col-md-12">
						<div class="card ">
							<div class="card-body ">
							<div class="row">
								<div class="col-lg-2 col-md-12">
								<!--
											color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
										-->
								<ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column" role="tablist">
									<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#adminler" role="tablist">
										<i class="fa fa-users"></i> Yetkililer
									</a>
									</li>
									<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#addadmin" role="tablist">
										<i class="fa fa-plus"></i> Yetkili Ekle
									</a>
									</li>
								</ul>
								</div>
								<div class="col-md-10">
								<div class="tab-content">
									<div class="tab-pane active" id="adminler">
									

									<div class="col-md-12">
										<div class="card">
											<div class="card-header card-header-rose card-header-icon">
											<div class="card-icon">
												<i class="material-icons">assignment</i>
											</div>
											<h4 class="card-title">Yetkililer</h4>
											</div>
											<div class="card-body">
											<div class="table-responsive">
												<table class="table">
												<thead>
													<tr>
													<th>#</th>
													<th>İsmi</th>
													<th>K. Adı</th>
													<th>Rütbesi</th>
													<th>E-Mail</th>
													<th>Son Giriş Tarihi</th>
													</tr>
												</thead>
												<tbody>
										<?php foreach($adminler as $admin){?>
													<tr>
													<td class="td-actions text-center">
														<a href="<?php echo base_url('Admin/member_edit/').$admin->admin_id ?>" type="button" rel="tooltip" class="btn btn-success">
															<i class="material-icons">edit</i>
														</a>
													</td>
													<td><?php echo $admin->uye_ad.' '.$admin->uye_soyad ?></td>
													<td><?php echo $admin->uye_nickname ?></td>
													<td><?php echo print_kişi_rütbe($admin->admin_rütbe) ?></td>
													<td><?php echo $admin->uye_email ?></td>
													<td><?php echo $admin->admin_last_login ?></td>
													</tr>
										<?php } ?>
												</tbody>
												</table>
											</div>
											</div>
										</div>
									</div>


									</div>
									<div class="tab-pane" id="addadmin">
										<div class="col-md-12">
											<div class="card ">
												<div class="card-header card-header-rose card-header-icon">
												<div class="card-icon">
													<i class="material-icons">contacts</i>
												</div>
												<h4 class="card-title">Yetkili Ekle</h4>
												</div>
												<div class="card-body ">
												<form class="form-horizontal" method="post" action="<?php echo base_url('Admin_Operations/add_admin') ?>">
													<div class="row">
													<label class="col-md-3 col-form-label">Kişiyi Seç</label>
													<div class="col-lg-9 col-md-6 col-sm-3">
													<select required name="uye_id" class="select2" style="width:100%" name="admin_rütbe">
														<option value="">-- Kişiyi Seçiniz --</option>
													<?php foreach($kişiler as $kişi){ ?>	
														<option value="<?php echo $kişi->uye_id ?>"><?php echo $kişi->uye_nickname ?></option>
													<?php } ?>
													</select>
													</div>
													</div>													
													<div class="row">
													<label class="col-md-3 col-form-label">Rütbeyi Seç</label>
													<div class="col-lg-9 col-md-6 col-sm-3">
													<select required class="selectpicker" name="admin_rütbe" data-size="7" data-style="select-with-transition" title="Rütbe Seçiniz">
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
													<button type="submit" class="btn btn-fill btn-rose">Ekle</button>
													</div>
												</div>
												</div>
												</form>
											</div>
											</div>
										</div>
								</div>
								</div>
							</div>
							</div>
						</div>
					</div>


				  </div>
				</div>
			  </div>


			</div>
		  </div>
		</div>
	  </div>
	</div>
</div>



<?php $this->load->view('backend/include/footer'); ?>
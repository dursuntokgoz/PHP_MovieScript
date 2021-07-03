<?php $this->load->view('backend/include/header'); ?>


<div class="content">
    <div class="container-fluid">
		<?php echo $this->session->flashdata('info'); ?>
          <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
              <div class="page-categories">
                <br />
                <ul class="nav nav-pills nav-pills-rose nav-pills-icons justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#addcastnormal" role="tablist">
                      <i class="fa fa-plus"></i> Normal Ekle
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#addcastmdb" role="tablist">
                      <i class="fa fa-imdb"></i> Tmdb'den Ekle
                    </a>
                  </li>
                </ul>
                <div class="tab-content tab-space tab-subcategories">
                  <div class="tab-pane active" id="addcastnormal">
                    <div class="card">

						<div class="card-body ">
							<div class="col-md-12">
							  <div class="card ">
								<div class="card-header card-header-rose card-header-icon">
								  <div class="card-icon">
									<i class="material-icons">contacts</i>
								  </div>
								  <h4 class="card-title">Kişi Ekle
								  </h4>
								</div>
								<div class="card-body ">
								<form action="<?php echo base_url('Admin_Operations/add_cast'); ?>" method="post" role="form" enctype='multipart/form-data'>
									<div class="row">
									  
									  <label class="col-md-2 col-form-label">Imdb Id</label>
									  <div class="col-md-10">
										<div class="form-group">
										  <input required type="text" class="form-control" name="cast_imdb_id">
										</div>
									  </div>
									</div>
									
									<div class="row">
									  <label class="col-md-2 col-form-label">İsim</label>
									  <div class="col-md-4">
										<div class="form-group">
										  <input required type="text" class="form-control" name="cast_name">
										</div>
									  </div>
									  
									  <label class="col-md-2 col-form-label">Meslek</label>
										<div class="col-md-4 col-sm-3">
											<select required class="selectpicker" name="cast_job" data-size="12" data-style="select-with-transition" title="Meslek Seçiniz">
												<option value="">-- Seçiniz --</option>
												<option value="Acting">Acting</option>
												<option value="Writing">Writing</option>
												<option value="Visual Effects">Visual Effects</option>
												<option value="Sound">Sound</option>
												<option value="Production">Production</option>
												<option value="Editing">Editing</option>
												<option value="Directing">Directing</option>
												<option value="Crew">Crew</option>
												<option value="Costume & Make-Up">Costume & Make-Up</option>
												<option value="Camera">Camera</option>
												<option value="Art">Art</option>
											</select>
										</div>
									</div>
									
									<div class="row">
									  <label class="col-md-2 col-form-label">Doğum Tarihi</label>
									  <div class="col-md-4">
										<div class="form-group">
											<input required type="text" class="form-control datepicker" name="cast_birth_day">
										</div>
									  </div>
									  
									  <label class="col-md-2 col-form-label">Ölüm Tarihi</label>
									  <div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control datepicker" name="cast_death_day">
										</div>
									  </div>
									</div>
									
									<div class="row">
									  <label class="col-md-2 col-form-label">Doğum Yeri</label>
									  <div class="col-md-10">
										<div class="form-group has-default">
										  <input type="text" class="form-control" name="cast_birth_place">
										</div>
									  </div>
									</div>
									
									<div class="row">
									  <label class="col-md-2 col-form-label">Biyografi</label>
									  <div class="col-md-8">
										<div class="form-group has-default">
										  <textarea class="form-control" name="cast_biography" rows="20"></textarea>
										</div>
									  </div>
										<div class="col-md-2">
										  <br><br><br><br><br>
										  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
											<div class="fileinput-new thumbnail">
											  <img style="width: 150px;" src="<?php echo base_url('assets/backend/img/image_placeholder.jpg')?>" alt="...">
											</div>
											<div class="fileinput-preview fileinput-exists thumbnail"></div>
											<div>
											  <span class="btn btn-rose btn-round btn-file">
												<span class="fileinput-new">Resim Seçin</span>
												<span class="fileinput-exists">Değiştir</span>
												<input type="file" name="cast_image">
											  </span>
											  <a href="#pablo"class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
											</div>
										  </div>
										</div>
									</div>
									<button type="submit" class="btn btn-fill btn-rose">Kişiyi Ekle</button>
								</form>
								</div>
							  </div>
							</div>

						</div>
                    </div>
                  </div>
                  <div class="tab-pane" id="addcastmdb">
                    <div class="card">
                      <div class="card-body">
						<div class="col-md-12">
						  <div class="card ">
							<div class="card-header card-header-rose card-header-icon">
							  <div class="card-icon">
								<i class="material-icons">movie</i>
							  </div>
							  <h4 class="card-title">Tmdb'den Kişi Bilgilerini Çek</h4>
							</div>
							<form action="<?php echo base_url('Imdb_Operations/imdb_person_info_add') ?>" method="post" >
							<div class="card-body ">
								<div class="row">
								  <label class="col-md-2 col-form-label">Tmdb Kişi Idsi</label>
								  <div class="col-md-4">
									<div class="form-group has-default">
									  <input name="imdb-cast-id" type="text" class="form-control" placeholder="Bilgilerini almak istediğiniz kişinin tmdb idsini giriniz." required>
									</div>
								  </div>
								</div>
								<div class="togglebutton">
									<label>
									  <input type="checkbox" name="downlad-images">
									  <span class="toggle"></span>
									  Kişiye ait resmi indir
									</label>
								</div>
							</div>
							<div class="card-footer ">
							  <div class="row">
								<div class="col-md-9">
								  <button type="submit" class="btn btn-fill btn-rose">Kişiyi Ekle</button>
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

<?php $this->load->view('backend/include/footer'); ?>
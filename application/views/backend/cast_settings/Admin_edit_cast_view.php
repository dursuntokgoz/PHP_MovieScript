<?php $this->load->view('backend/include/header'); ?>

      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-9">
              <div class="card ">
                <div class="card-body ">
					<div class="col-md-12">
					<?php echo $this->session->flashdata('info'); ?>
					  <div class="card ">
						<div class="card-header card-header-rose card-header-icon">
						  <div class="card-icon">
							<i class="material-icons">contacts</i>
						  </div>
						  <h4 class="card-title"><?php echo $cast_bilgileri->cast_name ?>
							<small class="description">Profili Düzenle</small>
						  </h4>
						</div>
						<div class="card-body ">
						<form action="<?php echo base_url('Admin_Operations/edit_cast'); ?>" method="post" role="form" enctype='multipart/form-data'>
							<div class="row">
							  <label class="col-md-2 col-form-label">Cast Id</label>
							  <div class="col-md-4">
								<div class="form-group has-default">
								  <input disabled type="text" class="form-control" name="cast_id" value="<?php echo $cast_bilgileri->cast_id ?>">
								</div>
							  </div>
							  
							  <label class="col-md-2 col-form-label">Imdb Id</label>
							  <div class="col-md-4">
								<div class="form-group">
								  <input type="text" class="form-control" name="cast_imdb_id" value="<?php echo $cast_bilgileri->cast_imdb_id ?>">
								</div>
							  </div>
							</div>
							
							<div class="row">
							  <label class="col-md-2 col-form-label">İsim</label>
							  <div class="col-md-4">
								<div class="form-group">
								  <input required type="text" class="form-control" name="cast_name" value="<?php echo $cast_bilgileri->cast_name ?>">
								</div>
							  </div>
							  
							  <label class="col-md-2 col-form-label">Meslek</label>
								<div class="col-md-4 col-sm-3">
									<select class="selectpicker" name="cast_job" data-size="12" data-style="select-with-transition" title="<?php echo $cast_bilgileri->cast_job ?>">
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
									<input type="text" class="form-control datepicker" name="cast_birth_day" value="<?php echo $cast_bilgileri->cast_birth_day ?>">
								</div>
							  </div>
							  
							  <label class="col-md-2 col-form-label">Ölüm Tarihi</label>
							  <div class="col-md-4">
								<div class="form-group">
									<input type="text" class="form-control datepicker" name="cast_death_day" value="<?php echo $cast_bilgileri->cast_death_day ?>">
								</div>
							  </div>
							</div>
							
							<div class="row">
							  <label class="col-md-2 col-form-label">Doğum Yeri</label>
							  <div class="col-md-10">
								<div class="form-group has-default">
								  <input type="text" class="form-control" name="cast_birth_place" value="<?php echo $cast_bilgileri->cast_birth_place ?>">
								</div>
							  </div>
							</div>
							
							<div class="row">
							  <label class="col-md-2 col-form-label">Biyografi</label>
							  <div class="col-md-10">
								<div class="form-group has-default">
								  <textarea class="form-control" name="cast_biography" rows="20"> <?php echo $cast_bilgileri->cast_biography ?></textarea>
								</div>
							  </div>
							</div>
						</div>
					  </div>
					</div>
                </div>
              </div>
            </div>	
			<div class="col-md-3">
              <div class="card card-profile">
                <div class="card-body">
                  <h6 class="card-category text-gray"><?php echo $cast_bilgileri->cast_name ?></h6>
                  <p class="card-description">
						<div class="col-md-12">
						  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
							<div class="fileinput-new thumbnail">
							  <img style="width: 150px;" src="<?php echo image_url($cast_bilgileri->cast_image) ?>" alt="...">
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
                  </p>
				  <input type="hidden" class="form-control" name="cast_id" value="<?php echo $cast_bilgileri->cast_id ?>">
                  <button type="submit" class="btn btn-fill btn-rose">Değişiklikleri Kaydet</button>
				  </form>
                </div>
              </div>
            </div>				
          </div>
        </div>
      </div>


<?php $this->load->view('backend/include/footer'); ?>
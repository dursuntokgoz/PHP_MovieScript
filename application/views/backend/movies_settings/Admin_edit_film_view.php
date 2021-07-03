<?php $this->load->view('backend/include/header'); ?>

<div class="content">
    <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
              <div class="page-categories" style="margin-top:-80px;">
                <h3 class="title text-center"><?php echo $film_bilgileri->film_ad ?></h3>
                <ul class="nav nav-pills nav-pills-danger nav-pills-icons justify-content-center" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#filmtemelayarı" role="tablist">
                      <i class="material-icons">movie_filter</i> Film Ayarı
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#filmresimayarı" role="tablist">
                      <i class="material-icons">image</i> Film Resmi
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#filmekibiayarı" role="tablist">
                      <i class="fa fa-users"></i> Film Ekibi
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#filmmedyaayarı" role="tablist">
                      <i class="material-icons">perm_media</i> Film Medyası
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#filmkaynakayar" role="tablist">
                      <i class="fa fa-link"></i> Film Kaynak Linkleri
                    </a>
                  </li>
                </ul>
				<?php echo $this->session->flashdata('info'); ?>
                <div class="tab-content tab-space tab-subcategories">
                   <div class="tab-pane active" id="filmtemelayarı">
                    <div class="card">
                      <div class="card-body">
						<div class="col-md-12">
						  <div class="card ">
							<div class="card-header card-header-rose card-header-text">
							  <div class="card-text">
								<h4 class="card-title"><?php echo $film_bilgileri->film_ad ?> Temel Ayarları</h4>
							  </div>
							</div>
							<form action="<?php echo base_url('Admin_Operations/film_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
							<div class="card-body ">
								<div class="row">
								  <label class="col-sm-2 col-form-label">Film İsmi</label>
								  <div class="col-sm-10">
									<div class="form-group">
									  <input type="text" name="movie_name" class="form-control" value="<?php echo $film_bilgileri->film_ad ?>">
									  <span class="bmd-help">Filmin yeni ismini yazınız.</span>
									</div>
								  </div>
								</div>
								<div class="row">
								  <label class="col-sm-2 col-form-label">Film Türü</label>
								  <div class="col-sm-10">
										<div class="form-group">
										  <select class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" multiple name="movie_type[]">
										  <?php foreach(türler('film') as $tür){ ?>
											<option value="<?php echo $tür->tür ?>"><?php echo $tür->tür ?>
										  <?php } ?>
										  </select>
										</div>
								  </div>
								</div>
								<div class="row">
								  <label class="col-sm-2 col-form-label">Film Çıkış Tarihi</label>
								  <div class="col-sm-10">
									   <div class="form-group">
											<input id="filmreleasedate" type="text" class="form-control datepicker" name="movie_release_date" value="<?php echo $film_bilgileri->film_release_date ?>">
									   </div>
								  </div>
								</div>
								<div class="row">
								  <label class="col-sm-2 col-form-label">Film Süresi</label>
								  <div class="col-sm-10">
									<div class="form-group">
									  <input name="movie_duration" type="number" class="form-control" value="<?php echo $film_bilgileri->film_süresi ?>">
									  <span class="bmd-help">Filmin süresini giriniz.</span>
									</div>
								  </div>
								</div>
								<div class="row">
								  <label class="col-sm-2 col-form-label">Film Puanı</label>
								  <div class="col-sm-10">
									<div class="form-group">
									  <input name="movie_mark" type="text" class="form-control" value="<?php echo $film_bilgileri->film_puanı ?>">
										<span class="bmd-help">Filmin Tmdb puanını giriniz.</span>
									</div>
								  </div>
								</div>
								<div class="row">
								  <label class="col-sm-2 col-form-label">Film Bütçesi</label>
								  <div class="col-sm-10">
									<div class="form-group">
									  <input name="movie_cost" type="text" class="form-control" value="<?php echo $film_bilgileri->film_bütçesi ?>">
										<span class="bmd-help">Filmin bütçesini giriniz.</span>
									</div>
								  </div>
								</div>
								<div class="row">
								  <label class="col-sm-2 col-form-label">Film Trailer Url</label>
								  <div class="col-sm-10">
									<div class="form-group">
									  <input name="movie_trailer" type="text" class="form-control" value="<?php echo $film_bilgileri->film_trailer ?>">
										<span class="bmd-help">Filmin trailer embed urlsini giriniz.</span>
									</div>
								  </div>
								</div>
								<div class="row">
								  <label class="col-sm-2 col-form-label">Film Anahtar Kelimeleri</label>
								  <div class="col-sm-10">
									<div class="form-group">
									   <input type="text" name="movie_keywords" class="form-control tagsinput" data-role="tagsinput" data-color="success" value="<?php echo $film_bilgileri->film_keywords ?>">
										<span class="bmd-help">Filmin anahtar kelimelerini giriniz.</span>
									</div>
								  </div>
								</div>
								<div class="row">
								  <label class="col-sm-2 col-form-label">Film Açıklaması</label>
								  <div class="col-sm-10">
									<div class="form-group">
									 <textarea name="movie_description" class="form-control" rows="8"><?php echo $film_bilgileri->film_describe ?></textarea>
										<span class="bmd-help">Filmin açıklamasını giriniz.</span>
									</div>
								  </div>
								</div>

								<div class="row">
									<div class="col-md-4">
									  <label class="col-sm-6 col-form-label">Film Facebook Url</label>
									  <div class="col-sm-12">
										<div class="form-group">
										  <input name="movie_facebook" type="text" class="form-control" value="<?php echo $film_bilgileri->film_facebook ?>">
											<span class="bmd-help">Filmin facebook urlsini giriniz.</span>
										</div>
									  </div>
									</div>
									<div class="col-md-4">
									  <label class="col-sm-6 col-form-label">Film Twitter Url</label>
									  <div class="col-sm-12">
										<div class="form-group">
										  <input name="movie_twitter" type="text" class="form-control" value="<?php echo $film_bilgileri->film_twitter ?>">
											<span class="bmd-help">Filmin twitter urlsini giriniz.</span>
										</div>
									  </div>
									</div>
									<div class="col-md-4">
									  <label class="col-sm-6 col-form-label">Film Instagram Url</label>
									  <div class="col-sm-12">
										<div class="form-group">
										  <input name="movie_instagram" type="text" class="form-control" value="<?php echo $film_bilgileri->film_instagram ?>">
											<span class="bmd-help">Filmin instagram urlsini giriniz.</span>
										</div>
									  </div>
									</div>
								</div>

								<div class="col-md-12">
								  <input type="hidden" name="film-id" value="<?php echo $film_bilgileri->film_id ?>">
								  <input type="hidden" name="film-sef-link" value="<?php echo $film_bilgileri->film_sef_link ?>">
								  <input type="hidden" name="film-image" value="<?php echo $film_bilgileri->film_image ?>">
								  <input type="hidden" name="film-kapak-image" value="<?php echo $film_bilgileri->film_kapak_image ?>">
								  <button type="submit" class="btn btn-rose">Filmi Güncelle</button>
								</div>
							</form>
							</div>
						  </div>
						</div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="filmresimayarı">
                    <div class="card">
                      <div class="card-body">
						<div class="col-md-12">
						  <div class="card ">
							<div class="card-header card-header-rose card-header-text">
							  <div class="card-text">
								<h4 class="card-title"><?php echo $film_bilgileri->film_ad ?> Resim Ayarları</h4>
							  </div>
							</div>
							<form action="<?php echo base_url('Admin_Operations/film_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
							<div class="card-body ">
								<div class="row">
									<div class="col-md-6">
									  <h4 class="title">Film Resmini Değiştirin</h4>
									  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
										<div class="fileinput-new thumbnail">
										  <img style="width: 150px;" src="<?php echo image_url($film_bilgileri->film_image, $film_bilgileri->film_sef_link) ?>" alt="...">
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail"></div>
										<div>
										  <span class="btn btn-rose btn-round btn-file">
											<span class="fileinput-new">Resim Seçin</span>
											<span class="fileinput-exists">Değiştir</span>
											<input type="file" name="film_image" >
										  </span>
										  <a href="#pablo"class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
										</div>
									  </div>
									</div>

									<div class="col-md-6">
									  <h4 class="title">Film Kapak Resmini Değiştirin</h4>
									  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
										<div class="fileinput-new thumbnail">
										  <img style="width: 150px;" src="<?php echo image_url($film_bilgileri->film_kapak_image, $film_bilgileri->film_sef_link) ?>" alt="...">
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail"></div>
										<div>
										  <span class="btn btn-rose btn-round btn-file">
											<span class="fileinput-new">Resim Seçin</span>
											<span class="fileinput-exists">Değiştir</span>
											<input type="file" name="film_kapak_image" >
										  </span>
										  <a href="#pablo"class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
										</div>
									  </div>
									</div>
								</div>
								<div class="col-md-12">
								  <input type="hidden" name="film-id" value="<?php echo $film_bilgileri->film_id ?>">
								  <input type="hidden" name="film-sef-link" value="<?php echo $film_bilgileri->film_sef_link ?>">
								  <input type="hidden" name="film-image" value="<?php echo $film_bilgileri->film_image ?>">
								  <input type="hidden" name="film-kapak-image" value="<?php echo $film_bilgileri->film_kapak_image ?>">
								  <button type="submit" class="btn btn-rose">Filmi Güncelle</button>
								</div>
							</form>
							</div>
						  </div>
						</div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="filmekibiayarı">
                    <div class="card">
						<div class="card-body">
							<div class="col-md-12">
							  <div class="card ">
								<div class="card-header card-header-rose card-header-text">
								  <div class="card-text">
									<h4 class="card-title"><?php echo $film_bilgileri->film_ad ?> Ekibi Ayarları</h4>
								  </div>
								</div>
								<div class="card-body ">
									<div class="col-md-12">
										<form action="<?php echo base_url('Admin_Operations/film_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
										<div class="row">
											<div class="col-lg-12 col-md-6 col-sm-3">
												<select name="cast_ids[]" style="width:100%" class="form-control select2" multiple="multiple">
												<?php foreach($film_ekibi as $ekip){ ?>	
													<option selected value="<?php echo $ekip->cast_id ?>"><?php echo $ekip->cast_name ?></option>
												<?php } ?>
												<?php foreach($casts as $cast){ ?>	
													<option value="<?php echo $cast->cast_id ?>"><?php echo $cast->cast_name ?></option>
												<?php } ?>
												</select>
											</div>
										</div><br><br>
										<div class="col-md-12">
										  <input type="hidden" name="film-id" value="<?php echo $film_bilgileri->film_id ?>">
										  <button type="submit" class="btn btn-rose">Ekibi Güncelle</button>
										</div>
										</form>
									</div>
								</div>
							  </div>
							</div>
						</div>
                    </div>
                  </div>

                  <div class="tab-pane" id="filmmedyaayarı">
                    <div class="card">
                      <div class="card-body">
						<div class="col-md-12">
						  <div class="card ">
							<div class="card-header card-header-rose card-header-text">
							  <div class="card-text">
								<h4 class="card-title"><?php echo $film_bilgileri->film_ad ?> Medya Ayarları</h4>
							  </div>
							</div>
							<div class="card-body ">

								<div class="col-md-12">
								  <div class="card ">
									<div class="card-body ">
									  <div class="row">
										<div class="col-lg-2 col-md-6">
										  <!--
													color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
												-->
										  <ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column" role="tablist">
											<li class="nav-item">
											  <a class="nav-link active" data-toggle="tab" href="#addimage" role="tablist">
												<i class="fa fa-image"></i> Resim Ekle
											  </a>
											</li>
											<li class="nav-item">
											  <a class="nav-link" data-toggle="tab" href="#addvideo" role="tablist">
												<i class="fa fa-play"></i> Video Ekle
											  </a>
											</li>
										  </ul>
										</div>
										<div class="col-md-10">
										  <div class="tab-content">
											<div class="tab-pane active" id="addimage">

												<form action="<?php echo base_url('Admin_Operations/film_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
													<div class="row">
														<label class="col-sm-2 col-form-label">Resim Linkleri</label>
														<div class="col-sm-10">
															<div class="form-group">
																<input type="text" name="image_urls" class="form-control tagsinput" data-role="tagsinput" data-color="success">
																<span class="bmd-help">Eklemek istediğiniz resimlerin linklerini yazınız.</span>
															</div>
														</div>
													</div><br>
													<div class="col-md-12">
														<input type="hidden" name="film-id" value="<?php echo $film_bilgileri->film_id ?>">
														<button type="submit" class="btn btn-rose">Resimleri Ekle</button>
													</div>
												</form>

											</div>
											<div class="tab-pane" id="addvideo">
												<form action="<?php echo base_url('Admin_Operations/film_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
													<div class="row">
														<label class="col-sm-2 col-form-label">Video Linkleri (Youtube)</label>
														<div class="col-sm-10">
															<div class="form-group">
																<input type="text" name="youtube_video_urls" class="form-control tagsinput" data-role="tagsinput" data-color="success">
																<span class="bmd-help">Eklemek istediğiniz youtube videoların linklerini yazınız.</span>
															</div>
														</div>
													</div><br>
													<div class="col-md-12">
														<input type="hidden" name="film-id" value="<?php echo $film_bilgileri->film_id ?>">
														<button type="submit" class="btn btn-rose">Videoları Ekle</button>
													</div>
												</form>
											</div>
										  </div>
										</div>
									  </div>
									</div>
								  </div>
								</div>

							  <div class="row">
								<div class="col-md-12">
								  <div class="card">
									<div class="card-header card-header-primary card-header-icon">
									  <div class="card-icon">
										<i class="material-icons">image</i>
									  </div>
									  <h4 class="card-title">Film Resimleri</h4>
									</div>
									<div class="card-body">
									  <div class="toolbar">
										<!--        Here you can write extra buttons/actions for the toolbar              -->
									  </div>
									  <div class="material-datatables">
										<table id="filmimagesdatatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										  <thead>
											<tr>
											  <th>#</th>
											  <th>Resim Url</th>
											  <th class="disabled-sorting text-right">Eylemler</th>
											</tr>
										  </thead>

										  <tbody>
<?php foreach($film_resimleri as $resim){?>
											<tr id="filmresim<?php echo $resim->id ?>">
											  <td><img style="width:200px" src="<?php echo image_url($resim->image_url, $film_bilgileri->film_sef_link)?>"></td>
											  <td><a href="<?php echo image_url($resim->image_url, $film_bilgileri->film_sef_link) ?>" target="_blank">Tıklayarak yeni sekmede aç.</a></td>
											  <td class="text-right">
												<a data-delete_type="resim" data-image_id="<?php echo $resim->id ?>" class="btn btn-link btn-danger btn-just-icon delete"><i class="material-icons">delete</i></a>
											  </td>
											</tr>
<?php } ?>
										  </tbody>
										</table>
									  </div>
									</div>
								  </div>
								</div>
								<div class="col-md-12">
								  <div class="card">
									<div class="card-header card-header-primary card-header-icon">
									  <div class="card-icon">
										<i class="material-icons">camera</i>
									  </div>
									  <h4 class="card-title">Film Videoları</h4>
									</div>
									<div class="card-body">
									  <div class="toolbar">
										<!--        Here you can write extra buttons/actions for the toolbar              -->
									  </div>
									  <div class="material-datatables">
										<table id="filmvideosdatatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										  <thead>
											<tr>
											  <th>Tipi</th>
											  <th>Sitesi</th>
											  <th>Kalitesi</th>
											  <th>İsmi</th>
											  <th>Linki</th>
											  <th class="disabled-sorting text-right">Eylemler</th>
											</tr>
										  </thead>

										  <tbody>
<?php foreach($film_videoları as $video){ ?>
											<tr id="filmvideo<?php echo $video->id ?>">
											  <td><?php echo $video->video_type ?></td>
											  <td><?php echo $video->video_site ?></td>
											  <td><?php echo $video->video_size ?>p</td>
											  <td><?php echo $video->video_name ?></td>
											  <td><?php echo $video->video_url ?></td>
											  <td class="text-right">
												<a data-delete_type="video" data-video_id="<?php echo $video->id ?>" class="btn btn-link btn-danger btn-just-icon delete"><i class="material-icons">delete</i></a>
											  </td>
											</tr>
<?php } ?>
										  </tbody>
										</table>
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

                  <div class="tab-pane" id="filmkaynakayar">
                    <div class="card">
                      <div class="card-body">
						<div class="row">
							<div class="col-md-6">
							  <div class="card ">
								<div class="card-header card-header-rose card-header-text">
								  <div class="card-text">
									<h4 class="card-title"><?php echo $film_bilgileri->film_ad ?> Kaynak Linki Ekle</h4>
								  </div>
								</div>
								<form action="<?php echo base_url('Admin_Operations/film_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
								<div class="card-body ">
									<div class="row">
									  <label class="col-md-3 col-form-label">Kaynak İsmi</label>
									  <div class="col-md-9">
										<div class="form-group has-default">
										  <select name="kaynak_ismi" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" required>
											<option value="">-- Seçiniz --</option>
											<option value="Fast"> Fast </option>
											<option value="OpenLoad"> OpenLoad </option>
											<option value="RapidShare"> RapidShare </option>
											<option value="Mailru"> Mailru </option>
											<option value="Turbobit"> Turbobit </option>
										  </select>
										</div>
									  </div>
									</div>
									<div class="row">
									  <label class="col-md-3 col-form-label">Kaynak Kalite</label>
									  <div class="col-md-9">
										<div class="form-group has-default">
										  <select name="kaynak_kalite" class="selectpicker" data-size="7" data-style="btn btn-primary btn-round" required>
											<option value="">-- Seçiniz --</option>
											<option value="1080"> 1080p </option>
											<option value="720"> 720p </option>
											<option value="480"> 480p </option>
											<option value="360"> 360p </option>
										  </select>
										</div>
									  </div>
									</div>
									<div class="row">
									  <label class="col-md-3 col-form-label">Kaynak Türü</label>
									  <div class="col-md-9">
										<div class="form-group has-default">
											<div class="row" style="margin-left:20px;">
												<div class="form-check">
												  <label class="form-check-label">
													<input class="form-check-input" type="radio" name="kaynak_türü" value="Dublaj" required> Türkçe Dublaj
													<span class="circle">
													  <span class="check"></span>
													</span>
												  </label>
												</div>
												<div class="form-check">
												  <label class="form-check-label">
													<input class="form-check-input" type="radio" name="kaynak_türü" value="Altyazı" required> Türkçe Altyazı
													<span class="circle">
													  <span class="check"></span>
													</span>
												  </label>
												</div>
											</div>
										</div>
									  </div>
									</div>
									<div class="row">
									  <label class="col-md-3 col-form-label">Kaynak Url Linki</label>
									  <div class="col-md-9">
										<div class="form-group has-default">
										  <input name="kaynak_url" type="text" class="form-control" required>
										</div>
									  </div>
									</div>
									<div class="col-md-12">
									  <input type="hidden" name="film-id" value="<?php echo $film_bilgileri->film_id ?>">
									  <button type="submit" class="btn btn-rose">Kaynağı Ekle</button>
									</div>
								</form>
								</div>
							  </div>
							</div>
							<div class="col-md-6">
							  <div class="card ">
								<div class="card-header card-header-rose card-header-text">
								  <div class="card-text">
									<h4 class="card-title"><?php echo $film_bilgileri->film_ad ?> Kaynak Linkleri</h4>
								  </div>
								</div>
								<div class="card-body ">
								  <div class="col-md-12">
									<div class="card">
									  <div class="card-body">
<?php if(kaynaklinkleri($film_bilgileri->film_id)){ ?>
										<div class="table-responsive">
										  <table class="table" id="filmkaynaktable">
											<thead class=" text-primary">
											  <th>
												#
											  </th>
											  <th>
												Kaynak İsmi
											  </th>
											  <th>
												Kaynak Türü
											  </th>
											  <th>
												Kaynak Kalite
											  </th>
											  <th>
												Kaynak Linki
											  </th>
											</thead>
											<tbody>
<?php foreach(kaynaklinkleri($film_bilgileri->film_id) as $kaynak_linki){?>
											  <tr id="kaynak<?php echo $kaynak_linki->id ?>">
											    <td class="td-actions text-right">
												  <button type="button" rel="tooltip" class="btn btn-danger kaynakdelete" data-delete_type="kaynak" data-kaynak_id="<?php echo $kaynak_linki->id ?>" data-kaynak_ad="<?php echo $kaynak_linki->kaynak_ismi . ' ' .$kaynak_linki->kaynak_kalite?>">
												    <i class="material-icons">delete</i>
												  </button>
											    </td>
												<td>
												  <?php echo $kaynak_linki->kaynak_ismi ?>
												</td>
												<td>
												  <?php echo $kaynak_linki->kaynak_türü ?>
												</td>
												<td>
												  <?php echo $kaynak_linki->kaynak_kalite ?>
												</td>
												<td>
												  <a href="<?php echo $kaynak_linki->kaynak_url ?>">Url</a>
												</td>
											  </tr>
<?php }?>
											</tbody>
										  </table>
										</div>
<?php }else{?>
<p>Filmin hiç kaynak linki bulunmamaktadır.</p>
<?php }?>
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
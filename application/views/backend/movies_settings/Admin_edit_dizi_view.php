<?php $this->load->view('backend/include/header'); ?>
<div class="content">
    <div class="container-fluid">
			<?php echo $this->session->flashdata('info'); ?>
			<div class="row">
				<div class="col-md-12">
				  <div class="card">
				  <h3 class="title text-center"><?php echo $dizi_bilgileri->dizi_ad ?></h3>
					<div class="card-header ">
						<div class="col-lg-12 col-md-12">
						  <!--
									color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
								-->
						  <ul class="nav nav-pills nav-pills-primary justify-content-center" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#diziayar" role="tablist">
								Dizi Ayarları
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#bölümayar" role="tablist">
								Bölüm Ayarları
								</a>
							</li>
						  </ul>					  

						</div>

					</div>
					<div class="card-body ">
					  <div class="row">
						<div class="col-md-12">
						  <div class="tab-content">
							<div class="tab-pane active" id="diziayar">
							  <div class="row">
								<div class="col-md-12 ml-auto mr-auto">
								  <div class="page-categories" >
									
									<ul class="nav nav-pills nav-pills-danger nav-pills-icons justify-content-center" role="tablist">
									  <li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#dizitemelayarı" role="tablist">
										  <i class="material-icons">movie_filter</i> Dizi Ayarı
										</a>
									  </li>
									  <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#diziresimayarı" role="tablist">
										  <i class="material-icons">image</i> Dizi Resmi
										</a>
									  </li>
									  <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#dizikibiayarı" role="tablist">
										  <i class="fa fa-users"></i> Dizi Ekibi
										</a>
									  </li>
									  <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#dizimedyaayarı" role="tablist">
										  <i class="material-icons">perm_media</i> Dizi Medyası
										</a>
									  </li>
									</ul>
									<div class="tab-content tab-space tab-subcategories">
									   <div class="tab-pane active" id="dizitemelayarı">
										<div class="card">
										  <div class="card-body">
											<div class="col-md-12">
											  <div class="card ">
												<div class="card-header card-header-rose card-header-text">
												  <div class="card-text">
													<h4 class="card-title"><?php echo $dizi_bilgileri->dizi_ad ?> Temel Ayarları</h4>
												  </div>
												</div>
												<form action="<?php echo base_url('Admin_Operations/dizi_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
												<div class="card-body ">
													<div class="row">
													  <label class="col-sm-2 col-form-label">Dizi İsmi</label>
													  <div class="col-sm-10">
														<div class="form-group">
														  <input type="text" name="dizi_name" class="form-control" value="<?php echo $dizi_bilgileri->dizi_ad ?>">
														  <span class="bmd-help">Dizinin yeni ismini yazınız.</span>
														</div>
													  </div>
													</div>
													<div class="row">
													  <label class="col-sm-2 col-form-label">Dizi Türü</label>
													  <div class="col-sm-10">
															<div class="form-group">
															  <select class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" multiple name="dizi_type[]">
																<?php foreach(türler('dizi') as $tür){ ?>
																	<option value="<?php echo $tür->tür ?>"><?php echo $tür->tür ?>
																<?php } ?>
															  </select>
															</div>
													  </div>
													</div>
													<div class="row">
													  <label class="col-sm-2 col-form-label">Dizi Başlangıç Tarihi</label>
													  <div class="col-sm-4">
														<div class="form-group">
															<input id="dizireleasedate" type="text" class="form-control datepicker" name="dizi_release_date" value="<?php echo $dizi_bilgileri->dizi_release_date ?>">
														</div>
													  </div>
													  <label class="col-sm-2 col-form-label">Dizi Bitiş Tarihi</label>
													  <div class="col-sm-4">
														<div class="form-group">
															<input id="dizireleasedate" type="text" class="form-control datepicker" name="dizi_finished_date" value="<?php echo $dizi_bilgileri->dizi_finished_date ?>">
														</div>
													  </div>
													</div>
													<div class="row">
													  <label class="col-sm-2 col-form-label">Dizi Sezon Sayısı</label>
													  <div class="col-sm-10">
														<div class="form-group">
															<input type="number" name="dizi_season_number" class="form-control" value="<?php echo $dizi_bilgileri->dizi_sezon_sayisi ?>">
														</div>
													  </div>
													</div>
													<div class="row">
													  <label class="col-sm-2 col-form-label">Dizi Puanı</label>
													  <div class="col-sm-10">
														<div class="form-group">
														  <input type="text" class="form-control" name="dizi_puani" id="exampleInputEmail1" value="<?php echo $dizi_bilgileri->dizi_puanı ?>">
															<span class="bmd-help">Dizinin Tmdb puanını giriniz.</span>
														</div>
													  </div>
													</div>
													<div class="row">
													  <label class="col-sm-2 col-form-label">Dizi Trailer Url</label>
													  <div class="col-sm-10">
														<div class="form-group">
														  <input name="dizi_trailer" type="text" class="form-control" value="<?php echo $dizi_bilgileri->dizi_trailer ?>">
															<span class="bmd-help">Dizinin trailer embed urlsini giriniz.</span>
														</div>
													  </div>
													</div>
													<div class="row">
													  <label class="col-sm-2 col-form-label">Dizi Anahtar Kelimeleri</label>
													  <div class="col-sm-10">
														<div class="form-group">
														   <input type="text" name="dizi_keywords" class="form-control tagsinput" data-role="tagsinput" data-color="success" value="<?php echo $dizi_bilgileri->dizi_keywords ?>">
															<span class="bmd-help">Dizinin anahtar kelimelerini giriniz.</span>
														</div>
													  </div>
													</div>
													<div class="row">
													  <label class="col-sm-2 col-form-label">Dizi Açıklaması</label>
													  <div class="col-sm-10">
														<div class="form-group">
														 <textarea name="dizi_description" class="form-control" rows="8"><?php echo $dizi_bilgileri->dizi_describe ?></textarea>
															<span class="bmd-help">Dizinin açıklamasını giriniz.</span>
														</div>
													  </div>
													</div>
													<div class="row">
														<div class="col-md-4">
														  <label class="col-sm-6 col-form-label">Dizi Facebook Url</label>
														  <div class="col-sm-12">
															<div class="form-group">
															  <input name="movie_facebook" type="text" class="form-control" value="<?php echo $dizi_bilgileri->dizi_facebook ?>">
																<span class="bmd-help">Dizinin facebook urlsini giriniz.</span>
															</div>
														  </div>
														</div>
														<div class="col-md-4">
														  <label class="col-sm-6 col-form-label">Dizi Twitter Url</label>
														  <div class="col-sm-12">
															<div class="form-group">
															  <input name="movie_twitter" type="text" class="form-control" value="<?php echo $dizi_bilgileri->dizi_twitter ?>">
																<span class="bmd-help">Dizinin twitter urlsini giriniz.</span>
															</div>
														  </div>
														</div>
														<div class="col-md-4">
														  <label class="col-sm-6 col-form-label">Dizi Instagram Url</label>
														  <div class="col-sm-12">
															<div class="form-group">
															  <input name="movie_instagram" type="text" class="form-control" value="<?php echo $dizi_bilgileri->dizi_instagram ?>">
																<span class="bmd-help">Dizinin instagram urlsini giriniz.</span>
															</div>
														  </div>
														</div>
													</div>
													<div class="col-md-12">
													  <input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
													  <input type="hidden" name="dizi-sef-link" value="<?php echo $dizi_bilgileri->dizi_sef_link ?>">
													  <input type="hidden" name="dizi-image" value="<?php echo $dizi_bilgileri->dizi_image ?>">
													  <input type="hidden" name="dizi-kapak-image" value="<?php echo $dizi_bilgileri->dizi_kapak_image ?>">
													  <button type="submit" class="btn btn-rose">Diziyi Güncelle</button>
													</div>
												</form>
												</div>
											  </div>
											</div>
										  </div>
										</div>
									  </div>
									  <div class="tab-pane" id="diziresimayarı">
										<div class="card">
										  <div class="card-body">
											<div class="col-md-12">
											  <div class="card ">
												<div class="card-header card-header-rose card-header-text">
												  <div class="card-text">
													<h4 class="card-title"><?php echo $dizi_bilgileri->dizi_ad ?> Resim Ayarları</h4>
												  </div>
												</div>
												<form action="<?php echo base_url('Admin_Operations/dizi_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
												<div class="card-body ">
													<div class="row">
														<div class="col-md-6">
														  <h4 class="title">Dizi Resmini Değiştirin</h4>
														  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
															<div class="fileinput-new thumbnail">
															  <img style="width: 150px;" src="<?php echo image_url($dizi_bilgileri->dizi_image, $dizi_bilgileri->dizi_sef_link) ?>" alt="...">
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"></div>
															<div>
															  <span class="btn btn-rose btn-round btn-file">
																<span class="fileinput-new">Resim Seçin</span>
																<span class="fileinput-exists">Değiştir</span>
																<input type="file" name="movie_image" >
															  </span>
															  <a href="#pablo"class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
															</div>
														  </div>
														</div>
														<div class="col-md-6">
														  <h4 class="title">Dizi Kapak Resmini Değiştirin</h4>
														  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
															<div class="fileinput-new thumbnail">
															  <img style="width: 150px;" src="<?php echo image_url($dizi_bilgileri->dizi_kapak_image, $dizi_bilgileri->dizi_sef_link) ?>" alt="...">
															</div>
															<div class="fileinput-preview fileinput-exists thumbnail"></div>
															<div>
															  <span class="btn btn-rose btn-round btn-file">
																<span class="fileinput-new">Resim Seçin</span>
																<span class="fileinput-exists">Değiştir</span>
																<input type="file" name="dizi_kapak_image" >
															  </span>
															  <a href="#pablo"class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
															</div>
														  </div>
														</div>
													</div>
													<div class="col-md-12">
													  <input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
													  <input type="hidden" name="dizi-sef-link" value="<?php echo $dizi_bilgileri->dizi_sef_link ?>">
													  <input type="hidden" name="dizi-image" value="<?php echo $dizi_bilgileri->dizi_image ?>">
													  <input type="hidden" name="dizi-kapak-image" value="<?php echo $dizi_bilgileri->dizi_kapak_image ?>">
													  <button type="submit" class="btn btn-rose">Diziyi Güncelle</button>
													</div>
												</form>
												</div>
											  </div>
											</div>
										  </div>
										</div>
									  </div>
									  <div class="tab-pane" id="dizikibiayarı">
										<div class="card">
											<div class="card-body">
												<div class="col-md-12">
												  <div class="card ">
													<div class="card-header card-header-rose card-header-text">
													  <div class="card-text">
														<h4 class="card-title"><?php echo $dizi_bilgileri->dizi_ad ?> Ekibi Ayarları</h4>
													  </div>
													</div>
													<div class="card-body ">
														<div class="col-md-12">
															<form action="<?php echo base_url('Admin_Operations/dizi_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
															<div class="row">
																<div class="col-lg-12 col-md-6 col-sm-3">
																	<select name="cast_ids[]" style="width:100%" class="form-control select2" multiple="multiple">
																	<?php foreach($dizi_ekibi as $ekip){ ?>	
																		<option selected value="<?php echo $ekip->cast_id ?>"><?php echo $ekip->cast_name ?></option>
																	<?php } ?>
																	<?php foreach($casts as $cast){ ?>	
																		<option value="<?php echo $cast->cast_id ?>"><?php echo $cast->cast_name ?></option>
																	<?php } ?>
																	</select>
																</div>
															</div><br><br>
															<div class="col-md-12">
															  <input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
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
									  <div class="tab-pane" id="dizimedyaayarı">
										<div class="card">
										  <div class="card-body">

											<div class="col-md-12">
											  <div class="card ">
												<div class="card-header card-header-rose card-header-text">
												  <div class="card-text">
													<h4 class="card-title"><?php echo $dizi_bilgileri->dizi_ad ?> Medya Ayarları</h4>
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

																	<form action="<?php echo base_url('Admin_Operations/dizi_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
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
																			<input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
																			<button type="submit" class="btn btn-rose">Resimleri Ekle</button>
																		</div>
																	</form>

																</div>
																<div class="tab-pane" id="addvideo">
																	<form action="<?php echo base_url('Admin_Operations/dizi_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
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
																			<input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
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
														  <h4 class="card-title">Dizi Resimleri</h4>
														</div>
														<div class="card-body">
														  <div class="toolbar">
															<!--        Here you can write extra buttons/actions for the toolbar              -->
														  </div>
														  <div class="material-datatables">
															<table id="diziimagesdatatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
															  <thead>
																<tr>
																  <th>#</th>
																  <th>Resim Url</th>
																  <th class="disabled-sorting text-right">Eylemler</th>
																</tr>
															  </thead>

															  <tbody>
<?php foreach($dizi_resimleri as $resim){?>
																<tr id="diziresim<?php echo $resim->id ?>">
																  <td><img style="width:200px" src="<?php echo image_url($resim->image_url, $dizi_bilgileri->dizi_sef_link)?>"></td>
																  <td><a href="<?php echo image_url($resim->image_url, $dizi_bilgileri->dizi_sef_link) ?>" target="_blank">Tıklayarak yeni sekmede aç.</a></td>
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
														  <h4 class="card-title">Dizi Videoları</h4>
														</div>
														<div class="card-body">
														  <div class="toolbar">
															<!--        Here you can write extra buttons/actions for the toolbar              -->
														  </div>
														  <div class="material-datatables">
															<table id="dizivideosdatatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
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
<?php foreach($dizi_videoları as $video){ ?>
																<tr id="dizivideo<?php echo $video->id ?>">
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
									</div>
								  </div>
								</div>
							  </div>
							</div>

							<div class="tab-pane" id="bölümayar">
								<div class="col-md-12">
								  <div class="card ">
									<div class="card-body ">
									  <ul class="nav nav-pills nav-pills-success" role="tablist">
										<li class="nav-item">
										  <a class="nav-link active" data-toggle="tab" href="#bölümekle" role="tablist">
											Bölüm Ekle
										  </a>
										</li>
										<li class="nav-item">
										  <a class="nav-link" data-toggle="tab" href="#bölümdüzenle" role="tablist">
											Bölümler
										  </a>
										</li>
									  </ul>
									  <div class="tab-content tab-space">

										<div class="tab-pane active" id="bölümekle">

											  <div class="row">
												<div class="col-md-12 ml-auto mr-auto">
												  <div class="page-categories">
													<ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
													  <li class="nav-item">
														<a class="nav-link active" data-toggle="tab" href="#bölümeklenormal" role="tablist">
														  <i class="material-icons">add</i> Normal Ekle
														</a>
													  </li>
													  <li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#bölümekleimdb" role="tablist">
														  <i class="fa fa-imdb"></i> Tmdb'den Ekle
														</a>
													  </li>
													</ul>
													<div class="tab-content tab-space tab-subcategories">

													  <div class="tab-pane active" id="bölümeklenormal">
														<div class="card">
														  <div class="card-body">
															<form action="<?php echo base_url('Admin_Operations/add_episode'); ?>" method="post" role='form' enctype='multipart/form-data'>
															<div class="row">
																<div class="col-md-6">
																  <div class="card">
																	<div class="card-header card-header-rose card-header-icon">
																	  <div class="card-icon">
																		<i class="material-icons">mail_outline</i>
																	  </div>
																	  <h4 class="card-title">Bölüm Ekle</h4>
																	</div>
																	<div class="card-body ">
																		<div class="row">
																		  <label class="col-sm-2 col-form-label">Bölüm Sezonu</label>
																		  <div class="col-sm-10">
																			<div class="form-group">
																				<select class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" name="season-number" required>
																					<option value="">Sezonu Seçiniz.</option>
																					<?php if($dizi_bilgileri->dizi_sezon_sayisi > 0){for($a = 1; $a < $dizi_bilgileri->dizi_sezon_sayisi +1; $a++){?>
																					<option value="<?php echo $a;?>">Sezon <?php echo $a;?></option>
																					<?php }}?>
																				</select>
																			</div>
																		  </div>
																		</div>
																		<div class="form-group">
																		  <label for="episodenumber" class="bmd-label-floating">Bölüm Numarası</label>
																		   <input id="episodenumber" type="number" name="episode-number" class="form-control" required>
																		</div>
																		<div class="form-group">
																		  <label for="episodename" class="bmd-label-floating">Bölüm İsmi</label>
																		   <input id="episodename" type="text" name="episode-name" class="form-control" required>
																		</div>
																		<div class="form-group">
																			<label for="bölümreleasedate" class="bmd-label-floating">Bölüm Yayınlanma Tarihi</label>
																			<input id="bölümreleasedate" type="text" class="form-control datepicker" name="episode-release-date" required>
																		</div>
																		<div class="form-group">
																		  <label for="episodepuan" class="bmd-label-floating">Bölüm Puanı</label>
																		   <input id="episodepuan" type="number" name="episode-puan" class="form-control" required>
																		</div>
																		<div class="form-group">
																		  <label for="episodesüre" class="bmd-label-floating">Bölüm Süresi</label>
																		   <input id="episodesüre" type="number" name="episode-süre" class="form-control" required>
																		</div>
																		<div class="row">
																		  <label class="col-sm-2 col-form-label">Bölüm Durumu</label>
																		  <div class="col-sm-10">
																			<div class="form-group">
																				<select class="selectpicker" data-size="4" data-style="btn btn-primary btn-round" name="episode-durum" required>
																				    <option value="">Bölüm Durumunu Seçiniz.</option>
																				    <option value="Normal Bölüm">Normal Bölüm</option>
																				    <option value="Sezon Finali">Sezon Finali Bölümü</option>
																				    <option value="Final">Dizi Final Bölümü</option>
																				</select>
																			</div>
																		  </div>
																		</div>
																	</div>
																  </div>
																</div>
																<div class="col-md-6">
																  <div class="card">
																	<div class="card-body ">
																		<div class="form-group">
																		  <label for="episodedesc" class="bmd-label-floating">Bölüm Açıklaması</label>
																		   <textarea id="episodedesc"class="form-control" name="episode-description" rows="8" required></textarea>
																		</div>
																		<div class="row">
																			<div class="col-md-6">
																			  <h4 class="title">Bölüm Resmini Yükleyin</h4>
																			  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
																				<div class="fileinput-new thumbnail">
																				  <img style="width: 150px;" src="<?php echo base_url('assets/backend/')?>img/image_placeholder.jpg" alt="...">
																				</div>
																				<div class="fileinput-preview fileinput-exists thumbnail"></div>
																				<div>
																				  <span class="btn btn-rose btn-round btn-file">
																					<span class="fileinput-new">Resim Seçin</span>
																					<span class="fileinput-exists">Değiştir</span>
																					<input type="file" name="episode_image" required>
																				  </span>
																				  <a href="#pablo"class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
																				</div>
																			  </div>
																			</div>
																		</div>
																	</div>
																  </div>
																</div>
															  <div class="col-md-12">
																  <input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
																  <input type="hidden" name="dizi-ad" value="<?php echo $dizi_bilgileri->dizi_ad ?>">
																<button type="submit" class="btn btn-rose">Bölümü Ekle</button>
															  </div>
															</div>
															</form>
														  </div>
														</div>
													  </div>

													  <div class="tab-pane" id="bölümekleimdb">
															<div class="col-md-12">
															  <div class="card ">
																<div class="card-body ">
																  <ul class="nav nav-pills nav-pills-warning" role="tablist">
																	<li class="nav-item">
																	  <a class="nav-link active" data-toggle="tab" href="#tekbölümekle" role="tablist">
																		Tek Bölüm Ekle
																	  </a>
																	</li>
																	<li class="nav-item">
																	  <a class="nav-link" data-toggle="tab" href="#sezondakibölümleriekle" role="tablist">
																		Bir Sezondaki Tüm Bölümleri Ekle
																	  </a>
																	</li>
																	<li class="nav-item">
																	  <a class="nav-link" data-toggle="tab" href="#tümbölümleriekle" role="tablist">
																		Dizinin Tüm Bölümlerini Ekle
																	  </a>
																	</li>
																  </ul>
																  <div class="tab-content tab-space">
																	<div class="tab-pane active" id="tekbölümekle">
																		<div class="card">
																		  <div class="card-body">
																			<div class="col-md-12">
																			  <div class="card ">
																				<div class="card-header card-header-rose card-header-icon">
																				  <div class="card-icon">
																					<i class="material-icons">movie</i>
																				  </div>
																				  <h4 class="card-title">Tmdb'den Bölüm Bilgilerini Çek</h4>
																				</div>
																				<form action="<?php echo base_url('Imdb_Operations/imdb_episode_info_add') ?>" method="post">
																				<div class="card-body ">
																					<div class="row">
																					  <label class="col-sm-2 col-form-label">Bölüm Sezonu</label>
																					  <div class="col-sm-10">
																						<div class="form-group">
																							<select class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" name="sezon-numarası" required>
																								<option value="">Sezonu Seçiniz.</option>
																								<?php if($dizi_bilgileri->dizi_sezon_sayisi > 0){for($a = 1; $a < $dizi_bilgileri->dizi_sezon_sayisi +1; $a++){?>
																								<option value="<?php echo $a;?>">Sezon <?php echo $a;?></option>
																								<?php }}?>
																							</select>
																						</div>
																					  </div>
																					</div>
																					<div class="row">
																					  <label class="col-md-2 col-form-label">Bölüm Numarası</label>
																					  <div class="col-md-10">
																						<div class="form-group has-default">
																						  <input name="bölüm-numarası" type="text" class="form-control" placeholder="Bilgilerini almak istediğiniz bölümün numarasını giriniz." required>
																						</div>
																					  </div>
																					</div>
																					<div class="row">
																					  <label class="col-sm-2 col-form-label">Bölüm Durumu</label>
																					  <div class="col-sm-10">
																						<div class="form-group">
																							<select class="selectpicker" data-size="4" data-style="btn btn-primary btn-round" name="episode-durum" required>
																								<option value="">Bölüm Durumunu Seçiniz.</option>
																								<option value="Normal Bölüm">Normal Bölüm</option>
																								<option value="Sezon Finali">Sezon Finali Bölümü</option>
																								<option value="Final">Dizi Final Bölümü</option>
																							</select>
																						</div>
																					  </div>
																					</div>
																					<div class="togglebutton">
																						<label>
																						  <input type="checkbox" name="downlad-images">
																						  <span class="toggle"></span>
																						  Bölüme ait resimleri indir
																						</label>
																					</div>
																				</div>
																				<div class="card-footer ">
																				  <div class="row">
																					<div class="col-md-9">
																					  <input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
																					  <button type="submit" class="btn btn-fill btn-rose">Bölümü Ekle</button>
																					</div>
																				  </div>
																				</div>
																				</form>
																			  </div>
																			</div>
																		  </div>
																		</div>
																	</div>
																	<div class="tab-pane" id="sezondakibölümleriekle">
																		<div class="card">
																		  <div class="card-body">
																			<div class="col-md-12">
																			  <div class="card ">
																				<div class="card-header card-header-rose card-header-icon">
																				  <div class="card-icon">
																					<i class="material-icons">movie</i>
																				  </div>
																				  <h4 class="card-title">Tmdb'den Sezon Bölümlerinin Bilgilerini Çek</h4>
																				</div>
																				<form action="<?php echo base_url('Imdb_Operations/imdb_season_info_add') ?>" method="post">
																				<div class="card-body ">
																					<div class="row">
																					  <label class="col-md-2 col-form-label">Sezon Numarası</label>
																					  <div class="col-md-10">
																						<div class="form-group has-default">
																						  <input name="sezon-numarası" type="text" class="form-control" placeholder="Bölüm bilgilerini almak istediğiniz sezonun numarasını giriniz." required>
																						</div>
																					  </div>
																					</div>
																					<div class="togglebutton">
																						<label>
																						  <input type="checkbox" name="downlad-images">
																						  <span class="toggle"></span>
																						  Bölümlere ait resimleri indir
																						</label>
																					</div>
																				</div>
																				<div class="card-footer ">
																				  <div class="row">
																					<div class="col-md-9">
																					  <input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
																					  <button type="submit" class="btn btn-fill btn-rose">Bölümleri Ekle</button>
																					</div>
																				  </div>
																				</div>
																				</form>
																			  </div>
																			</div>
																		  </div>
																		</div>
																	</div>
																	<div class="tab-pane" id="tümbölümleriekle">
																		DİZİNİN TÜM BÖLÜMLERİNİ EKLEME
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
										<div class="tab-pane" id="bölümdüzenle">
											<div class="col-md-12">
											  <div class="card">
												<div class="card-body">
												  <div id="accordion" role="tablist">
													<?php if($dizi_bölümleri){foreach($dizi_bölümleri as $dizi_bölümü){?>
													<div class="card-collapse">
													  <div class="card-header" role="tab" id="heading<?php echo $dizi_bölümü->season_number ?>">
														<h5 class="mb-0">
														  <a data-toggle="collapse" href="#collapse<?php echo $dizi_bölümü->season_number ?>" aria-expanded="true" aria-controls="collapse<?php echo $dizi_bölümü->season_number ?>" class="collapsed">
															Sezon  <?php echo $dizi_bölümü->season_number ?> Bölümleri
															<i class="material-icons">keyboard_arrow_down</i>
														  </a>
														</h5>
													  </div>
													  <div id="collapse<?php echo $dizi_bölümü->season_number ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?php echo $dizi_bölümü->season_number ?>" data-parent="#accordion" style="">
														<div class="card-body">
															<div class="col-md-12">
															  <div class="card">
																<div class="card-body">
																  <div class="table-responsive">
																	<table class="table" id="bölümlertable">
																	  <thead>
																		<tr>
																		  <th class="text-right">İşlemler</th>
																		  <th class="text-center">#</th>
																		  <th>Bölüm Numarası</th>
																		  <th>Bölüm Adı</th>
																		  <th>Bölüm Puanı</th>
																		  <th>Bölüm Süresi</th>
																		  <th>Bölüm Yayınlanma Tarihi</th>
																		  <th>Bölüm Durumu</th>
																		  <th>Bölüm Açıklaması</th>
																		</tr>
																	  </thead>
																	  <tbody>
																		<?php 
																		$bölümler = bölümlerigrupla($dizi_bilgileri->dizi_id, $dizi_bölümü->season_number);
																			foreach($bölümler as $bölüm){
																		?>
																		<tr id="bölüm<?php echo $bölüm->episode_id ?>">
																		  <td class="td-actions text-right">
																			<button type="button" rel="tooltip" class="btn btn-success editepisodebtn" data-episode_id="<?php echo $bölüm->episode_id ?>">
																			  <i class="material-icons">edit</i>
																			</button>
																			<button type="button" rel="tooltip" class="btn btn-danger delete" data-delete_type="bölüm" data-movie_id="<?php echo $bölüm->episode_id ?>" data-movie_ad="<?php echo $bölüm->episode_name ?>">
																			  <i class="material-icons">delete</i>
																			</button>
																		  </td>
																		  <td><img style="width: 100px;" src="<?php echo image_url($bölüm->episode_image, $dizi_bilgileri->dizi_sef_link) ?>"></td>
																		  <td><?php echo $bölüm->episode_number ?></td>
																		  <td><?php echo $bölüm->episode_name ?></td>
																		  <td><?php echo $bölüm->episode_puan ?></td>
																		  <td><?php echo $bölüm->episode_süre ?> dakika</td>
																		  <td><?php echo $bölüm->episode_release_date ?></td>
																		  <td><?php echo $bölüm->episode_durum ?></td>
																		  <td><textarea class="form-control z-depth-1" disabled rows="5" cols="40"><?php echo $bölüm->episode_describe ?></textarea></td>
																		</tr>
																		<td colspan="9">
																			<div class="col-md-12" id="episodeedit<?php echo $bölüm->episode_id ?>" style="display:none;">
																			  <div class="card ">
																				<div class="card-body ">
																				  <button type="button" class="close" id="editepisodeclose" data-episode_close_id="<?php echo $bölüm->episode_id ?>">
																					<i class="material-icons">close</i>
																				  </button>
																				  <ul class="nav nav-pills nav-pills-danger" role="tablist">
																					<li class="nav-item">
																					  <a class="nav-link active" data-toggle="tab" href="#bölümayarı<?php echo $bölüm->episode_id ?>" role="tablist">
																						Bölüm Ayarı
																					  </a>
																					</li>
																					<li class="nav-item">
																					  <a class="nav-link" data-toggle="tab" href="#bölümkaynakayarı<?php echo $bölüm->episode_id ?>" role="tablist">
																						Bölüm Kaynakları
																					  </a>
																					</li>
																					<li class="nav-item">
																					  <a class="nav-link" data-toggle="tab" href="#kaynakekle<?php echo $bölüm->episode_id ?>" role="tablist">
																						Bölüm Kaynak Ekle
																					  </a>
																					</li>
																				  </ul>
																				  <div class="tab-content tab-space">
																					<div class="tab-pane active" id="bölümayarı<?php echo $bölüm->episode_id ?>">
																						<form action="<?php echo base_url('Admin_Operations/update_episode') ?>" method="post" role='form' enctype='multipart/form-data'>
																						<div class="col-md-12">
																							<div class="row">
																								<div class="col-md-6">
																									<div class="row">
																									  <label class="col-md-4 col-form-label">Sezon Numarası</label>
																									  <div class="col-md-8">
																										<div class="form-group has-default">
																											<select class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" name="season-number">
																												<option value="">-- Sezon <?php echo $bölüm->season_number ?> --</option>
																												<?php if($dizi_bilgileri->dizi_sezon_sayisi > 0){for($a = 1; $a < $dizi_bilgileri->dizi_sezon_sayisi +1; $a++){?>
																												<option value="<?php echo $a;?>">Sezon <?php echo $a;?></option>
																												<?php }}?>
																											</select>
																										</div>
																									  </div>
																									</div>
																									<div class="row">
																									  <label class="col-sm-4 col-form-label">Bölüm Numarası</label>
																									  <div class="col-sm-8">
																										<div class="form-group">
																										  <input type="number" name="episode-number" class="form-control" value="<?php echo $bölüm->episode_number ?>">
																										  <span class="bmd-help">Bölümün yeni numarasını yazınız.</span>
																										</div>
																									  </div>
																									</div>
																									<div class="row">
																									  <label class="col-sm-4 col-form-label">Bölüm İsmi</label>
																									  <div class="col-sm-8">
																										<div class="form-group">
																										  <input type="text" name="episode-name" class="form-control" value="<?php echo $bölüm->episode_name ?>">
																										  <span class="bmd-help">Bölümün yeni ismini yazınız.</span>
																										</div>
																									  </div>
																									</div>
																									<div class="row">
																									  <label class="col-sm-4 col-form-label">Bölüm Yayınlanma Tarihi</label>
																									  <div class="col-sm-8">
																										   <div class="form-group">
																												<input type="text" class="form-control datepicker" name="episode-release-date" value="<?php echo $bölüm->episode_release_date ?>">
																										   </div>
																									  </div>
																									</div>
																									<div class="row">
																									  <label class="col-sm-4 col-form-label">Bölüm Süresi</label>
																									  <div class="col-sm-8">
																										<div class="form-group">
																										  <input name="episode-süre" type="number" class="form-control" value="<?php echo $bölüm->episode_süre ?>">
																										  <span class="bmd-help">Bölümün süresini giriniz.</span>
																										</div>
																									  </div>
																									</div>
																									<div class="row">
																									  <label class="col-sm-4 col-form-label">Bölüm Puanı</label>
																									  <div class="col-sm-8">
																										<div class="form-group">
																										  <input name="episode-puan" type="text" class="form-control" value="<?php echo $bölüm->episode_puan ?>">
																											<span class="bmd-help">Bölümün Tmdb puanını giriniz.</span>
																										</div>
																									  </div>
																									</div>
																									<div class="row">
																									  <label class="col-md-4 col-form-label">Bölüm Durumu</label>
																									  <div class="col-md-8">
																										<div class="form-group has-default">
																										  <select name="episode-durum" class="selectpicker" data-size="4" data-style="btn btn-primary btn-round">
																											<option value="">-- <?php echo $bölüm->episode_durum ?> --</option>
																											<option value="Normal Bölüm">Normal Bölüm</option>
																											<option value="Sezon Finali">Sezon Finali Bölümü</option>
																											<option value="Final">Dizi Final Bölümü</option>
																										  </select>
																										</div>
																									  </div>
																									</div>
																								</div>
																								<div class="col-md-6">
																									<div class="row">
																									  <label class="col-sm-2 col-form-label">Bölüm Açıklaması</label>
																									  <div class="col-sm-10">
																										<div class="form-group">
																										 <textarea name="episode-description" class="form-control" rows="8" placeholder="<?php echo $bölüm->episode_describe ?>"></textarea>
																											<span class="bmd-help">Bölümün açıklamasını giriniz.</span>
																										</div>
																									  </div>
																									</div>
																									<div class="col-md-6">
																									  <h4 class="title">Bölüm Resmini Değiştirin</h4>
																									  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
																										<div class="fileinput-new thumbnail">
																										  <img style="width: 150px;" src="<?php echo image_url($bölüm->episode_image, $dizi_bilgileri->dizi_sef_link) ?>" alt="...">
																										</div>
																										<div class="fileinput-preview fileinput-exists thumbnail"></div>
																										<div>
																										  <span class="btn btn-rose btn-round btn-file">
																											<span class="fileinput-new">Resim Seçin</span>
																											<span class="fileinput-exists">Değiştir</span>
																											<input type="file" name="episode_image">
																										  </span>
																										  <a href="#pablo"class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
																										</div>
																									  </div>
																									</div>
																								</div>
																							</div>
																							<div class="col-md-12">
																								<input type="hidden" name="episodeId" value="<?php echo $bölüm->episode_id ?>">
																								<input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
																								<input type="hidden" name="dizi-ad" value="<?php echo $dizi_bilgileri->dizi_ad ?>">
																							  <button type="submit" class="btn btn-rose">Bölümü Güncelle</button>
																							</div>
																						</form>
																						</div>
																					</div>
																					<div class="tab-pane" id="bölümkaynakayarı<?php echo $bölüm->episode_id ?>">
																						<div class="col-md-12">
																							<?php if(kaynaklinkleri($dizi_bilgileri->dizi_id, $bölüm->episode_id)){ ?>
																							<div class="table-responsive">
																							  <table class="table">
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
																								<?php foreach(kaynaklinkleri($dizi_bilgileri->dizi_id, $bölüm->episode_id) as $kaynak_linki){?>
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
																								<?php } ?>
																								</tbody>
																							  </table>
																							</div>
																							<?php }else{?>
																							<p>Bölümün hiç kaynak linki bulunmamakatadır.</p>
																							<?php }?>
																						</div>
																					</div>
																					<div class="tab-pane" id="kaynakekle<?php echo $bölüm->episode_id ?>">
																						<div class="col-md-12">
																						  <div class="card ">
																							<form action="<?php echo base_url('Admin_Operations/dizi_update'); ?>" method="post" role="form" enctype='multipart/form-data'>
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
																								  <input type="hidden" name="dizi-id" value="<?php echo $dizi_bilgileri->dizi_id ?>">
																								  <input type="hidden" name="bölüm-id" value="<?php echo $bölüm->episode_id ?>">
																								  <button type="submit" class="btn btn-rose">Kaynağı Ekle</button>
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
																		</td>
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
													<?php }}else{ ?>
																<p>Hiç bölüm bulunmamaktadır.</p>
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
			</div>
	</div>
</div>

 <?php $this->load->view('backend/include/footer'); ?>
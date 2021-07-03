<?php $this->load->view('backend/include/header'); ?>

<div class="content">
    <div class="container-fluid">
		<?php echo $this->session->flashdata('info'); ?>
          <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
              <div class="card ">
                <div class="card-header ">
                  <h4 class="card-title">Film ve Dizi Ekleme</h4>
                </div>
                <div class="card-body ">
                  <div class="row">
                    <div class="col-md-1 ml-auto mr-auto">
                      <!--
                                color-classes: "nav-pills-primary", "nav-pills-info", "nav-pills-success", "nav-pills-warning","nav-pills-danger"
                            -->
                      <ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#film" role="tablist">
                            <i class="material-icons">movie</i> Film Ekle
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#dizi" role="tablist">
                            <i class="material-icons">movie</i> Dizi Ekle
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-md-11">
                      <div class="tab-content">

                        <div class="tab-pane active" id="film">
							  <div class="row">
								<div class="col-md-12 ml-auto mr-auto">
								  <div class="page-categories">
									<ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
									  <li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#filmnormal" role="tablist">
										  <i class="fa fa-plus-circle"></i> Normal Ekle
										</a>
									  </li>
									  <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#filmimdb" role="tablist">
										  <i class="fa fa-imdb"></i> Tmdb'den Ekle
										</a>
									  </li>
									</ul>
									<div class="tab-content tab-space tab-subcategories">
									  <div class="tab-pane active" id="filmnormal">
										<div class="card">
										  <div class="card-body">
<!-- Normal Film Ekleme Formu -->												
											<form action="<?php echo base_url('Admin_Operations/film_ekle'); ?>" name="add_movie" method="post" role="form" enctype='multipart/form-data'>
											<div class="row">
												<div class="col-md-6">
												  <div class="card">
													<div class="card-header card-header-rose card-header-icon">
													  <div class="card-icon">
														<i class="material-icons">mail_outline</i>
													  </div>
													  <h4 class="card-title">Film Ayarları</h4>
													</div>
													<div class="card-body ">
														<div class="form-group">
														  <label for="filmid">Film Tmdb ID</label>
														  <input id="filmid" type="text" class="form-control" name="film_tmdb_id"  required>
														</div>
														<div class="form-group">
														  <label for="filmismi" class="bmd-label-floating">Film İsmi</label>
														  <input type="text" class="form-control" id="filmismi" name="movie_name" required>
														</div>
														<div class="form-group">
														  <label for="filmtürü" class="bmd-label-floating">Film Türü Seçiniz</label>
														  <select id="filmtürü"class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" multiple name="movie_type[]" required>
															<?php foreach(türler('film') as $tür){ ?>
																<option value="<?php echo $tür->tür ?>"><?php echo $tür->tür ?>
															<?php } ?>
														  </select>
														</div>
													   <div class="form-group">
															<label for="filmreleasedate" class="bmd-label-floating">Film Çıkış Tarihi</label>
															<input id="filmreleasedate" type="text" class="form-control datepicker" name="movie_release_date" required>
													   </div>
														<div class="form-group">
														  <label for="filmsüresi" class="bmd-label-floating">Film Süresi (dakika)</label>
														  <input id="filmsüresi" type="number" class="form-control" name="movie_duration" required>
														</div>
														<div class="form-group">
														  <label for="filmpuanı" class="bmd-label-floating">Film Puanı</label>
														  <input id="filmpuanı" type="number" class="form-control" name="movie_mark" required>
														</div>
														<div class="form-group">
														  <label for="filmbütçe" class="bmd-label-floating">Film Bütçesi</label>
														  <input id="filmbütçe" type="text" class="form-control" name="movie_cost" required>
														</div>
														<div class="form-group">
														   <label for="filmaçıklama" class="bmd-label-floating">Filmin Açıklaması</label>
														   <textarea id="filmaçıklama" name="movie_description" class="form-control" rows="5"  required></textarea>
														</div>
													</div>
												  </div>
												</div>

												<div class="col-md-6">
												  <div class="card">
													<div class="card-header card-header-rose card-header-icon">
													  <div class="card-icon">
														<i class="material-icons">info</i>
													  </div>
													  <h4 class="card-title">Film Detayları</h4>
													</div>
													<div class="card-body ">
														<div class="form-group">
														   <label for="filmtrailer" class="bmd-label-floating">Film Trailer Url (Embed Youtube)</label>
														  <input id="filmtrailer" name="movie_trailer" type="text" class="form-control" required>
														</div>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																   <label for="facebook" class="bmd-label-floating">Film Facebook Url</label>
																  <input id="facebook" name="movie_facebook" type="text" class="form-control" required>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																   <label for="Twitter" class="bmd-label-floating">Film Twitter Url</label>
																  <input id="Twitter" name="movie_twitter" type="text" class="form-control" required>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																   <label for="Instagram" class="bmd-label-floating">Film Instagram Url</label>
																  <input id="Instagram" name="movie_instagram" type="text" class="form-control" required>
																</div>
															</div>
														</div>
														<div class="form-group">
														   <h4 class="title">Film Anahtar Kelimeleri</h4>
														   <input type="text" name="movie_keywords" class="form-control tagsinput" data-role="tagsinput" data-color="success">
														</div>
														<div class="row">
															<div class="col-md-6">
															  <h4 class="title">Film Resmini Yükleyin</h4>
															  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
																<div class="fileinput-new thumbnail">
																  <img style="width: 150px;" src="<?php echo base_url('assets/backend/')?>img/image_placeholder.jpg" alt="...">
																</div>
																<div class="fileinput-preview fileinput-exists thumbnail"></div>
																<div>
																  <span class="btn btn-rose btn-round btn-file">
																	<span class="fileinput-new">Resim Seçin</span>
																	<span class="fileinput-exists">Değiştir</span>
																	<input type="file" name="film_image" required>
																  </span>
																  <a href="#pablo"class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
																</div>
															  </div>
															</div>

															<div class="col-md-6">
															  <h4 class="title">Film Kapak Resmini Yükleyin</h4>
															  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
																<div class="fileinput-new thumbnail">
																  <img style="width: 150px;" src="<?php echo base_url('assets/backend/')?>img/image_placeholder.jpg" alt="...">
																</div>
																<div class="fileinput-preview fileinput-exists thumbnail"></div>
																<div>
																  <span class="btn btn-rose btn-round btn-file">
																	<span class="fileinput-new">Resim Seçin</span>
																	<span class="fileinput-exists">Değiştir</span>
																	<input type="file" name="film_kapak_image" required>
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
												<button type="submit" class="btn btn-rose">Filmi Ekle</button>
											  </div>
											</div>
											</form>
<!-- Normal Film Ekleme Formu -->
										  </div>
										</div>
									  </div>
									  <div class="tab-pane" id="filmimdb">
										<div class="card">
										  <div class="card-body">
											<div class="col-md-12">
											  <div class="card ">
												<div class="card-header card-header-rose card-header-icon">
												  <div class="card-icon">
													<i class="material-icons">movie</i>
												  </div>
												  <h4 class="card-title">Tmdb'den Film Bilgilerini Çek</h4>
												</div>
												<form action="<?php echo base_url('Imdb_Operations/imdb_film_info_add') ?>" method="post" >
												<div class="card-body ">
													<div class="row">
													  <label class="col-md-2 col-form-label">Tmdb Film Idsi</label>
													  <div class="col-md-10">
														<div class="form-group has-default">
														  <input name="imdb-film-id" type="text" class="form-control" placeholder="Bilgilerini almak istediğiniz filmin imdb idsini giriniz." required>
														</div>
													  </div>
													</div><br>
													<div class="row">	
														<div class="col-md-4">
															<div class="togglebutton">
																<label>
																  <input type="checkbox" name="downlad-images">
																  <span class="toggle"></span>
																  Film resimlerini indir
																</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="togglebutton">
																<label>
																  <input type="checkbox" name="download-cast-images">
																  <span class="toggle"></span>
																  Film Ekibine ait resimleri indir
																</label>
															</div>	
														</div>
													</div>
												</div>
												<div class="card-footer ">
												  <div class="row">
													<div class="col-md-9">
													  <button type="submit" class="btn btn-fill btn-rose">Filmi Ekle</button>
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

                        <div class="tab-pane" id="dizi">
							  <div class="row">
								<div class="col-md-12 ml-auto mr-auto">
								  <div class="page-categories">
									<ul class="nav nav-pills nav-pills-warning nav-pills-icons justify-content-center" role="tablist">
									  <li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#dizinormal" role="tablist">
										  <i class="fa fa-plus-circle"></i> Normal Ekle
										</a>
									  </li>
									  <li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#diziimdb" role="tablist">
										  <i class="fa fa-imdb"></i> Tmdb'den Ekle
										</a>
									  </li>
									</ul>
									<div class="tab-content tab-space tab-subcategories">
									  <div class="tab-pane active" id="dizinormal">
										<div class="card">
										  <div class="card-body">
											<form action="<?php echo base_url('Admin_Operations/dizi_ekle'); ?>" name="add_dizi" method="post" role="form" enctype='multipart/form-data'>
											<div class="row">
												<div class="col-md-6">
												  <div class="card">
													<div class="card-header card-header-rose card-header-icon">
													  <div class="card-icon">
														<i class="material-icons">mail_outline</i>
													  </div>
													  <h4 class="card-title">Dizi Ayarları</h4>
													</div>
													<div class="card-body ">
														<div class="form-group">
														  <label for="diziid">Dizi Tmdb ID</label>
														  <input id="diziid" type="text" class="form-control" name="dizi_tmdb_id"  required>
														</div>
														<div class="form-group">
														  <label for="diziismi">Dizi İsmi</label>
														  <input id="diziismi" type="text" class="form-control" name="dizi_name"  required>
														</div>
														<div class="form-group">
														  <label for="dizitürü" class="bmd-label-floating">Dizi Türü Seçiniz</label>
														  <select id="dizitürü"class="selectpicker" data-size="5" data-style="btn btn-primary btn-round" multiple name="dizi_type[]" required>
															<?php foreach(türler('dizi') as $tür){?>
															<option value="<?php echo $tür->tür ?>"><?php echo $tür->tür ?></option>
															<?php }?>
														  </select>
														</div>
														<div class="row">
															<div class="col-md-6">
															   <div class="form-group">
																	<label for="dizireleasedate" class="bmd-label-floating">Dizi Başlangıç Tarihi</label>
																	<input id="dizireleasedate" type="text" class="form-control datepicker" name="dizi_release_date" required>
															   </div>
															</div>
															<div class="col-md-6">
															   <div class="form-group">
																	<label for="dizireleasedate" class="bmd-label-floating">Dizi Bitiş Tarihi</label>
																	<input id="dizireleasedate" type="text" class="form-control datepicker" name="dizi_finished_date">
															   </div>
															</div>
														</div>
														<div class="form-group">
														  <label for="sezonsayısı" class="bmd-label-floating">Dizi Sezon Sayısı</label>
														   <input id="sezonsayısı" type="number" name="dizi_season_number" class="form-control" required>
														</div>
														<div class="form-group">
														  <label for="dizipuanı" class="bmd-label-floating">Dizi Puanı</label>
														  <input id="dizipuanı" type="text" class="form-control" name="dizi_puani" required>
														</div>
														<div class="form-group">
														   <label for="diziaçıklama" class="bmd-label-floating">Dizinin Açıklaması</label>
														   <textarea id="diziaçıklama" name="dizi_description" class="form-control" rows="8"  required></textarea>
														</div>
													</div>
												  </div>
												</div>

												<div class="col-md-6">
												  <div class="card">
													<div class="card-header card-header-rose card-header-icon">
													  <div class="card-icon">
														<i class="material-icons">info</i>
													  </div>
													  <h4 class="card-title">Dizi Detayları</h4>
													</div>
													<div class="card-body ">
														<div class="form-group">
														   <label for="filmtrailer" class="bmd-label-floating">Dizi Trailer Url (Embed Youtube)</label>
														  <input id="filmtrailer" name="dizi_trailer" type="text" class="form-control" required>
														</div>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																   <label for="facebook" class="bmd-label-floating">Dizi Facebook Url</label>
																  <input id="facebook" name="movie_facebook" type="text" class="form-control" required>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																   <label for="Twitter" class="bmd-label-floating">Dizi Twitter Url</label>
																  <input id="Twitter" name="movie_twitter" type="text" class="form-control" required>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																   <label for="İnstagram" class="bmd-label-floating">Dizi Instagram Url</label>
																  <input id="İnstagram" name="movie_instagram" type="text" class="form-control" required>
																</div>
															</div>
														</div>
														<div class="form-group">
														   <h4 class="title">Dizi Anahtar Kelimeleri</h4>
														   <input type="text" name="dizi_keywords" class="form-control tagsinput" data-role="tagsinput" data-color="success">
														</div>
														<div class="row">
															<div class="col-md-6">
															  <h4 class="title">Dizi Resmini Yükleyin</h4>
															  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
																<div class="fileinput-new thumbnail">
																  <img style="width: 150px;" src="<?php echo base_url('assets/backend/')?>img/image_placeholder.jpg" alt="...">
																</div>
																<div class="fileinput-preview fileinput-exists thumbnail"></div>
																<div>
																  <span class="btn btn-rose btn-round btn-file">
																	<span class="fileinput-new">Resim Seçin</span>
																	<span class="fileinput-exists">Değiştir</span>
																	<input type="file" name="movie_image" required>
																  </span>
																  <a href="#pablo"class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Kaldır</a>
																</div>
															  </div>
															</div>

															<div class="col-md-6">
															  <h4 class="title">Dizi Kapak Resmini Yükleyin</h4>
															  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
																<div class="fileinput-new thumbnail">
																  <img style="width: 150px;" src="<?php echo base_url('assets/backend/')?>img/image_placeholder.jpg" alt="...">
																</div>
																<div class="fileinput-preview fileinput-exists thumbnail"></div>
																<div>
																  <span class="btn btn-rose btn-round btn-file">
																	<span class="fileinput-new">Resim Seçin</span>
																	<span class="fileinput-exists">Değiştir</span>
																	<input type="file" name="dizi_kapak_image" required>
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
													<button type="submit" class="btn btn-rose">Diziyi Ekle</button>
												</div>
											</div>
											</form>
										  </div>
										</div>
									  </div>
									  <div class="tab-pane" id="diziimdb">
										<div class="card">
										  <div class="card-body">
											<div class="col-md-12">
											  <div class="card ">
												<div class="card-header card-header-rose card-header-icon">
												  <div class="card-icon">
													<i class="material-icons">movie</i>
												  </div>
												  <h4 class="card-title">Tmdb'den Dizi Bilgilerini Çek</h4>
												</div>
												<form action="<?php echo base_url('Imdb_Operations/imdb_dizi_info_add') ?>" method="post" >
												<div class="card-body ">
													<div class="row">
													  <label class="col-md-2 col-form-label">Tmdb Dizi Idsi</label>
													  <div class="col-md-10">
														<div class="form-group has-default">
														  <input name="imdb-dizi-id" type="text" class="form-control" placeholder="Bilgilerini almak istediğiniz dizinin imdb idsini giriniz." required>
														</div>
													  </div>
													</div></br>
													<div class="row">	
														<div class="col-md-4">
															<div class="togglebutton">
																<label>
																  <input type="checkbox" name="downlad-images">
																  <span class="toggle"></span>
																  Dizi resimlerini indir
																</label>
															</div>
														</div>
														<div class="col-md-4">
															<div class="togglebutton">
																<label>
																  <input type="checkbox" name="download-cast-images">
																  <span class="toggle"></span>
																  Dizi Ekibine ait resimleri indir
																</label>
															</div>	
														</div>
													</div>													
												</div>
												<div class="card-footer ">
												  <div class="row">
													<div class="col-md-9">
													  <button type="submit" class="btn btn-fill btn-rose">Diziyi Ekle</button>
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
</div>
 <?php $this->load->view('backend/include/footer'); ?>
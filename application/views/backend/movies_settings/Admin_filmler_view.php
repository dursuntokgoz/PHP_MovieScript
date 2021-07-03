<?php $this->load->view('backend/include/header'); ?>

<div class="content">
    <div class="container-fluid">
	
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">movie</i>
                  </div>
                  <h4 class="card-title">Sitedeki Filmler</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="filmdatatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th style="width:150px;">#</th>
                          <th>Ad</th>
                          <th>Tür</th>
                          <th>Süre</th>
                          <th>Puan</th>
                          <th>Bütçe</th>
                          <th style="width:200px;">Yayınlanma Tarihi</th>
					      <th>Yüklenme Zamanı</th>
                          <th class="disabled-sorting text-right">Ayarlar</th>
                        </tr>
                      </thead>
                      <tbody style="text-align:center;">
<?php if($filmler != null){foreach($filmler as $film){?>
                        <tr id="film<?php echo $film->film_id ?>">
                          <td><img style="width: 100%; border-radius:5px; border: 2px solid black;" src="<?php echo image_url($film->film_image, $film->film_sef_link) ?>"></td>
                          <td><?php echo $film->film_ad ?></td>
                          <td>
							<div class="cate">
								<?php foreach(explode(',',$film->film_türü) as $film_türü){ ?>
								<span class="<?php $renk = array('blue','green','orange'); $key = array_rand($renk, 1); echo $renk[$key]?>"><a href="#"><?php echo $film_türü ?></a></span>
								<?php }?>
							</div>
						  </td>
                          <td><?php echo $film->film_süresi ?> dakika</td>
                          <td><?php echo $film->film_puanı ?></td>
                          <td><?php echo $film->film_bütçesi ?></td>
                          <td><?php echo türkçetarihformat('j F Y',$film->film_release_date) ?></td>
						  <td><?php echo tarihgeçenzaman($film->film_add_date) ?></td>
                          <td class="text-right">
                            <a href="<?php echo base_url('filmler/').$film->film_sef_link ?>" target="_blank" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">slideshow</i></a>
                            <a href="<?php echo base_url('Admin/edit_movie/').'film/'. $film->film_id ;?>" class="btn btn-link btn-warning btn-just-icon edit"><i class="material-icons">border_color</i></a>
                            <a data-delete_type="film" data-movie_id="<?php echo $film->film_id ?>" data-movie_ad="<?php echo $film->film_ad ?>" class="btn btn-link btn-danger btn-just-icon delete"><i class="material-icons">delete</i></a>
                          </td>
                        </tr>
<?php }} ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- end content-->
              </div>
              <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
          </div>
          <!-- end row -->

	</div>
</div>

 <?php $this->load->view('backend/include/footer'); ?>
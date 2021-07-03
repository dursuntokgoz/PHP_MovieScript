<?php $this->load->view('backend/include/header'); ?>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">assignment</i>
                  </div>
                  <h4 class="card-title">Yapımcılar</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div>
                  <div class="material-datatables">
                    <table id="castdatatable" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Id</th>
                          <th>Imdb Id</th>
                          <th>İsmi</th>
                          <th>İşi</th>
                          <th>Doğum Tarihi</th>
                          <th>Ölüm Tarihi</th>
                          <th>Doğum Yeri</th>
                          <th>Biyografi</th>
                          <th class="disabled-sorting text-right">İşlemler</th>
                        </tr>
                      </thead>
                      <tbody>
                <?php if($casts){foreach($casts as $cast){?>
                        <tr id="cast<?php echo $cast->cast_id ?>">
                          <td><img style="width:100px" src="<?php echo image_url($cast->cast_image)?>"></td>
                          <td><?php echo $cast->cast_id ?></td>
                          <td><?php echo $cast->cast_imdb_id ?></td>
                          <td><?php echo $cast->cast_name ?></td>
                          <td><?php echo $cast->cast_job?></td>
                          <td><?php echo $cast->cast_birth_day ?></td>
                          <td><?php echo $cast->cast_death_day ?></td>
                          <td><?php echo $cast->cast_birth_place ?></td>
                          <td><textarea rows="5" cols="20" disabled><?php echo $cast->cast_biography ?></textarea></td>
                          <td class="text-right">
                            <a href="<?php echo base_url('Admin/edit_cast/'). $cast->cast_id ?>" class="btn btn-link btn-warning btn-just-icon"><i class="material-icons">edit</i></a>
							<a data-delete_type="cast" data-cast_id="<?php echo $cast->cast_id ?>" class="btn btn-link btn-danger btn-just-icon delete"><i class="material-icons">delete</i></a>
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
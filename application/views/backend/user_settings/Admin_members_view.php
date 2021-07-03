<?php $this->load->view('backend/include/header'); ?>
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <h4 class="card-title">Siteye Kayıtlı Kullanıcılar</h4>
                </div>
                <div class="card-body">
                  <div class="toolbar">
                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                  </div> 
                  <div class="material-datatables">
                    <table id="kullanıcılardatabase" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
					<thead>
					<tr>
					  <th class="disabled-sorting text-right">Ayarlar</th>
					  <th>Üye Avatarı</th>
					  <th>Üye Nickname</th>
					  <th>Üye Adı</th>
					  <th>Üye Soyadı</th>
					  <th>Üye E-Maili</th>	
					  <th>Üye Kayıt Tarihi</th>
					  <th>Üye Facebook Url</th>
					  <th>Üye Twitter Url</th>
					  <th>Üyelik Türü</th>
					  <th>Üyelik Durumu</th>
					</tr>
					</thead>
					<tbody>
	<?php foreach($üye_bilgileri as $üye_bilgi){?>
					<tr>
					  <td class="text-right">
						<a href="<?php echo base_url('profil/'.$üye_bilgi->uye_id) ?>" target="_blank" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">slideshow</i></a>
						<a href="#" onclick="location.href='<?php echo base_url('Admin/member_edit/').$üye_bilgi->uye_id;?>'" class="btn btn-link btn-warning btn-just-icon edit"><i class="fa fa-edit"></i></a>
					  </td>
					  <td><img style="width:80px;" src="<?php echo avatar_url($üye_bilgi->uye_avatar) ?>"></td>
					  <td style="text-align:center; font-size: 16px;" ><?php echo $üye_bilgi->uye_nickname ?></td>
					  <td style="text-align:center; font-size: 16px;" ><?php echo $üye_bilgi->uye_ad ?></td>
					  <td style="text-align:center; font-size: 16px;" ><?php echo $üye_bilgi->uye_soyad ?></td>
					  <td style="text-align:center; font-size: 16px;" ><?php echo $üye_bilgi->uye_email ?></td>
					  <td style="text-align:center; font-size: 16px;" ><?php echo $üye_bilgi->uye_kayit_tarihi ?></td>
					  <td style="font-size: 12px;" ><a href="<?php echo $üye_bilgi->uye_facebook_url ?>"><?php echo $üye_bilgi->uye_facebook_url ?></a></td>
					  <td style="font-size: 12px;" ><a href="<?php echo $üye_bilgi->uye_twitter_url ?>"><?php echo $üye_bilgi->uye_twitter_url ?></a></td>
					  <td style="text-align:center; font-size: 16px;" ><?php echo $üye_bilgi->uyelik_türü ?></td>
					  <td style="text-align:center; font-size: 16px;" ><?php if($üye_bilgi->uye_aktif == 1){echo '<a style="color:green">Üye aktif.</a>';}else{echo '<a style="color:red">Üye aktif değil.</a>';} ?></td>
					</tr>
	<?php } ?>
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
<?php 
if($this->session->userdata('durum') == true && $this->session->userdata('user')->uye_id == $this->uri->segment(2)){
	$kisi = $kişi_bilgileri; 
}else{
	$kisi = $üye_bilgileri; 
}
?>
<?php $this->load->view('frontend/include/header');?>
	<div class="row user-detail">
		<div class="col-md-3 col-sm-4 col-xs-12">
	<?php if($this->session->userdata('durum') == true && $this->session->userdata('user')->uye_id == $this->uri->segment(2)){?>
				<div class="user-information">
					<div class="user-img">			
						<a href="#"><img src="<?php echo avatar_url($kisi->uye_avatar) ?>" alt="<?php echo $kisi->uye_nickname ?>"><br></a>	
				<?php if(kişi_rütbe_bul($kisi->uye_id) != 0){ ?>
						<div class="user-rank">
						    <i class="fa fa-star"></i>
							<label class="user-rank-name"><?php echo print_kişi_rütbe(kişi_rütbe_bul($kisi->uye_id)); ?></label>
						</div><br>					
				<?php }	?>						
						<label for="avatar_change" href="#" class="yellowbtn">Resmi Değiştir</label>
						<form id="change_avatar">
							<input id="avatar_change" type="file" name="avatar_image" style="display:none">
						</form>						
					</div>
					<div class="user-fav">
						<p>Profil</p>
						<ul>
							<li><a href="#">Profil sayfanı paylaş</a></li>
							<li><a href="<?php echo base_url('Member_Operations/logout'); ?>">Çıkış Yap</a></li>
						</ul>
					</div>
				</div>
	<?php }else{ ?>	
				<div class="user-information">
					<div class="user-img">
						<a href="#"><img src="<?php echo avatar_url($kisi->uye_avatar) ?>" alt="<?php echo $kisi->uye_nickname ?>"><br></a>
				<?php if(kişi_rütbe_bul($kisi->uye_id) != 0){ ?>
						<div class="user-rank">
						    <i class="fa fa-star"></i>
							<label class="user-rank-name"><?php echo print_kişi_rütbe(kişi_rütbe_bul($kisi->uye_id)); ?></label>
						</div>						
				<?php }	?>						
					</div>
					<div class="user-fav">
						<p>Diğer</p>
						<ul>
							<li><a href="#">Profil sayfasını paylaş</a></li>
						</ul>
					</div>
				</div>	
	<?php } ?>
		</div>
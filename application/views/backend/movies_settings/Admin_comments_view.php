<?php $this->load->view('backend/include/header'); ?>

<div class="content">
    <div class="container-fluid">	
		<div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-tabs card-header-rose">
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <span class="nav-tabs-title">Yorumlar:</span>
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#unconfirmed" data-toggle="tab">
                            <i class="material-icons">comment</i> Onaylanmamış
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#confirmed" data-toggle="tab">
                            <i class="material-icons">comment</i> Onaylanmış
                            <div class="ripple-container"></div>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="unconfirmed">
                      <table class="table" id="unconfirmed_comments">
						<thead>
                         <tr>
                            <td> Yorumları Seç</td>
							<td>Yorumu Yapan</td>
							<td>Yorum Başlığı</td>
                            <td>Yorum</td>
							<td>Gönderilme Zamanı</td>
                            <td class="td-actions text-right">İşlemler</td>
                          </tr>					
						</thead>
                        <tbody>
						<?php if($onaylanmamış_yorumlar){ foreach($onaylanmamış_yorumlar as $yorum){?>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
							<td><?php echo üyeresminial($yorum->uye_id)['uye_nickname']?></td>
							<td><?php echo $yorum->comment_title ?></td>
                            <td class="emoji_comment"><?php echo $yorum->comment ?></td>
							<td><?php echo tarihgeçenzaman($yorum->sended_date); ?></td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" data-yorum_id ="<?php echo $yorum->yorum_id ?>" title="Yorumu Onayla" class="btn btn-primary btn-link btn-sm confirm">
                                <i class="fa fa-check"></i>
                              </button>
                              <button type="button" rel="tooltip" data-yorum_id ="<?php echo $yorum->yorum_id ?>" title="Yorumu Sil" class="btn btn-danger btn-link btn-sm delete">
                                <i class="fa fa-trash"></i>
                              </button>
                            </td>
                          </tr>
						<?php }} ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="confirmed">
                      <table class="table" id="confirmed_comments">
						<thead>
                         <tr>
                            <td> Yorumları Seç</td>
							<td>Yorumu Yapan</td>
							<td>Yorum Başlığı</td>
                            <td>Yorum</td>
							<td>Gönderilme Zamanı</td>
                            <td class="td-actions text-right">İşlemler</td>
                          </tr>					
						</thead>					  
                        <tbody>
						<?php if($onaylanmış_yorumlar){ foreach($onaylanmış_yorumlar as $yorum){?>
                          <tr>
                            <td>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="checkbox" value="">
                                  <span class="form-check-sign">
                                    <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            </td>
							<td><?php echo üyeresminial($yorum->uye_id)['uye_nickname']?></td>
							<td><?php echo $yorum->comment_title ?></td>
                            <td class="emoji_comment"><?php echo $yorum->comment ?></td>
							<td><?php echo tarihgeçenzaman($yorum->sended_date); ?></td>
                            <td class="td-actions text-right">
                              <button type="button" rel="tooltip" data-yorum_id ="<?php echo $yorum->yorum_id ?>" title="Yorumun Onayını Kaldır" class="btn btn-primary btn-link btn-sm confirm">
                                <i class="fa fa-remove"></i>
                              </button>
                              <button type="button" rel="tooltip" data-yorum_id ="<?php echo $yorum->yorum_id ?>" title="Yorumu Sil" class="btn btn-danger btn-link btn-sm delete">
                                <i class="fa fa-trash"></i>
                              </button>
                            </td>
                          </tr>
						<?php }} ?>
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

<?php $this->load->view('backend/include/footer'); ?>
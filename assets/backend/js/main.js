$(function(){
	// this will get the full URL at the address bar
	var url = window.location.href;

	// passes on every "a" tag
	$(".nav li a").each(function() {
			// checks if its the same on the address bar
		if(url == (this.href)) {
			$(this).closest("li").addClass("active");
		}
	});
});

$(".emoji_comment").each(function(index, element) {
  $(this).html(emojione.toImage($(this).text()));
});

/* ----------------------------------------- Form İşlemleri -----------------------------------------*/

	/* Admin Giriş Formu */
	$('form#adminlogin').on('submit',function (form)
	{
		form.preventDefault();
		$.ajax({
			type: 'POST',
			url: base_url+'Admin_Operations/login',
			data: $('form#adminlogin').serialize(),
			success: function(data) {
				if(data=='başarılı')
				{
					$(window).attr('location', base_url + 'Admin/home');
				}
				else{
				  $.notify({
					  icon: "add_success",
					  message: data
				  },{
					  type: 'danger',
					  timer: 1000,
					  placement: {
						  from: 'top',
						  align: 'center'
					  }
				  });
				}
			}
		});
	});

  // Dizi Bölümler Tablosu
  $("#bölümlertable").on('click', '.delete', function(e) {
	var movie_id = $(this).data('movie_id');
	var delete_type = $(this).data('delete_type');
	var movie_ad = $(this).data('movie_ad');
	
	$.ajax({
		type: 'POST',
		url: base_url+'Admin_Operations/delete_function/',
		data: {delete_type: delete_type, movie_id: movie_id},
		success: function(data) {
		  $.notify({
			  icon: "add_success",
			  message: movie_ad + " bölümünü silme işlemi başarılı."
		  },{
			  type: 'success',
			  timer: 1000,
			  placement: {
				  from: 'top',
				  align: 'center'
			  }
		  });
		  $("#bölümlertable tr#bölüm"+movie_id+"").remove();
		}
	});
  });
  // Dizi Bölüm Kaynakları Tablosu
  $("#bölümlertable").on('click', '.kaynakdelete', function(e) {
	var kaynak_id = $(this).data('kaynak_id');
	var delete_type = $(this).data('delete_type');
	var kaynak_ad = $(this).data('kaynak_ad');
	
	$.ajax({
		type: 'POST',
		url: base_url+'Admin_Operations/delete_function/',
		data: {delete_type: delete_type, kaynak_id: kaynak_id},
		success: function(data) {
		  $.notify({
			  icon: "add_success",
			  message: kaynak_ad + " kaynağını silme işlemi başarılı."
		  },{
			  type: 'success',
			  timer: 1000,
			  placement: {
				  from: 'top',
				  align: 'center'
			  }
		  });
		  $("#bölümlertable tr#kaynak"+kaynak_id+"").remove();
		}
	});
  });
  // Film Kaynak Silme Butonu
  $("#filmkaynaktable").on('click', '.kaynakdelete', function(e) {
	var kaynak_id = $(this).data('kaynak_id');
	var delete_type = $(this).data('delete_type');
	var kaynak_ad = $(this).data('kaynak_ad');

	$.ajax({
		type: 'POST',
		url: base_url+'Admin_Operations/delete_function/',
		data: {delete_type: delete_type, kaynak_id: kaynak_id},
		success: function(data) {
		  $.notify({
			  icon: "add_success",
			  message: kaynak_ad + " kaynağını silme işlemi başarılı."
		  },{
			  type: 'success',
			  timer: 1000,
			  placement: {
				  from: 'top',
				  align: 'center'
			  }
		  });
		  $("#filmkaynaktable tr#kaynak"+kaynak_id+"").remove();
		}
	});
  });
  
  // Onaylanmamış Yorumlar Tablosu
  $("#unconfirmed_comments").on('click', '.confirm', function(e) {
	 var yorum_id = $(this).data('yorum_id');
	
	$.ajax({
		type: 'POST',
		url: base_url+'Admin_Operations/confirm_comment/',
		data: {yorum_id: yorum_id},
		success: function(data) {
			if(data == "1"){
			  $.notify({
				  icon: "add_success",
				  message: "Yorumu başarıyla onayladınız."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}else{
			  $.notify({
				  icon: "add_warning",
				  message: "Yorumu onaylama başarısız."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}
		 // $("#bölümlertable tr#bölüm"+movie_id+"").remove();
		}
	});
  });   
  $("#unconfirmed_comments").on('click', '.delete', function(e) {
	var yorum_id = $(this).data('yorum_id');
	
	$.ajax({
		type: 'POST',
		url: base_url+'Admin_Operations/delete_comment/',
		data: {yorum_id: yorum_id},
		success: function(data) {
			if(data == "1"){
			  $.notify({
				  icon: "add_success",
				  message: "Yorumu başarıyla sildiniz."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}else{
			  $.notify({
				  icon: "add_warning",
				  message: "Yorumu silme başarısız."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}
		  //$("#bölümlertable tr#bölüm"+movie_id+"").remove();
		}
	});
  });
  /* Onaylanmış Yorumlar Tablosu */
   $("#confirmed_comments").on('click', '.confirm', function(e) {
	 var yorum_id = $(this).data('yorum_id');
	
	$.ajax({
		type: 'POST',
		url: base_url+'Admin_Operations/unconfirm_comment/',
		data: {yorum_id: yorum_id},
		success: function(data) {
			if(data == "1"){
			  $.notify({
				  icon: "add_success",
				  message: "Yorumun onayını başarıyla kaldırdınız."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}else{
			  $.notify({
				  icon: "add_warning",
				  message: "Yorumun onayını kaldırma başarısız."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}
		 // $("#bölümlertable tr#bölüm"+movie_id+"").remove();
		}
	});
  });   
  $("#confirmed_comments").on('click', '.delete', function(e) {
	var yorum_id = $(this).data('yorum_id');
	
	$.ajax({
		type: 'POST',
		url: base_url+'Admin_Operations/delete_comment/',
		data: {yorum_id: yorum_id},
		success: function(data) {
			if(data == "1"){
			  $.notify({
				  icon: "add_success",
				  message: "Yorumu başarıyla sildiniz."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}else{
			  $.notify({
				  icon: "add_warning",
				  message: "Yorumu silme başarısız."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}
		  //$("#bölümlertable tr#bölüm"+movie_id+"").remove();
		}
	});
  }); 
  
  $("form#ban_user").on("submit", function(e) {	
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: base_url+'Admin_Operations/ban_user',
		data: $(this).serialize(),
		success: function(data) {
			if(data == "1"){			
			  window.location.reload();
			}else{
			  $.notify({
				  icon: "add_warning",
				  message: "Hata! Bir sorun oluştu."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}
		}
	});
  });  

  $("form#unban_user").on("submit", function(e) {	
	e.preventDefault();
	$.ajax({
		type: 'POST',
		url: base_url+'Admin_Operations/unban_user',
		data: $(this).serialize(),
		success: function(data) {
			if(data == "1"){
			  window.location.reload();
			}else{
			  $.notify({
				  icon: "add_warning",
				  message: "Hata! Bir sorun oluştu."
			  },{
				  type: 'success',
				  timer: 1000,
				  placement: {
					  from: 'top',
					  align: 'center'
				  }
			  });				
			}
		}
	});
  });  

/* --------------------------------------------------------------------------------------------------*/
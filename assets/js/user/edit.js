$(function(){
	
	$('.btn-save-user').click(function(){

		if($('#input-name').val().trim() == '') {
			alert('Name must not be blank!');
			return false;
		}
		
		$('#status-save').html("&nbsp;");
		btn = $(this);
		btn.button('loading');
				
		$.post(
			base_url + 'user/save',
			$('#form-save-user').serialize(),
			function(data){
				btn.button('reset');
				if(data.status.trim() == "OK") {
					$('#status-save').html(data.modified);
				}
				else {
					$('#status-save').html();
					alert(data.error);
				}
			},
			"json"
			).error(function(xhr) {
				alert(xhr.responseText);
		});
		
		return false;
	});
	
	$('.btn-update-password').click(function(){

		if($('#input-password').val().trim() == '') {
			alert('Password must not be blank!');
			return false;
		}
		
		if($('#input-password').val().trim() != $('#input-password2').val().trim()) {
			alert('Password and Password (Again) must be the same');
			return false;
		}

		btn = $(this);
		btn.button('loading');	
		$('#status-password').html('&nbsp;');
		//alert( $(this).parents('td').siblings('.col-status').children('.label').html() );
		
		$.post(
			base_url + 'user/updatepassword',
			$("#form-update-password").serialize(),
			function(data){
				
				btn.button('reset');
				
				if(data.status.trim() == "OK") {
					$('#status-password').html(data.modified);
				}
				else {
					$('#status-password').html('&nbsp;');
					alert(data.error);
				}
				
			},
			"json"
			).error(function(xhr) {
				alert(xhr.responseText);
		});
		
		return false;
	});
	
});
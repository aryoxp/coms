$(function(){
	
	$('.btn-update').click(function(){

		//alert($('.new-password').val());
		
		if($('.new-password').val().trim().length == 0) {
			alert('Password may not be blank!');
			return false;
		}
		
		if($('.new-password').val() != $('.new-password2').val()) {
			alert('New Password and and New Password (again) must be the same!');
			return false;
		}
		
		if($('.old-password').val() == $('.new-password').val()) {
			alert('Same New Password and Old Password!');
			return false;
		}
		
		if(confirm('You have to re-login with your new password once it has been updated! Continue change your password?')) {		
			$.post(
				base_url + 'password/update',
				$('#change-password-form').serialize(),
				function(data){
					if(data.status.trim() == "OK") {
						alert('Password has been updated! You have to login again!');
						document.location = base_url + 'auth/logoff';
					} else alert('Error: ' + data.error);
				},
				"json"
				).error(function(xhr) {
					alert(xhr.responseText);
			});
		}
		
		return false;
	});
	
});
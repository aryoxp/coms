$(function(){
	
	$('.btn-create-user').click(function(){
		

		if($('#input-username').val().trim() == '') {
			alert('Username is required.');
			return false;
		}

		if($('#input-password').val().trim() == '') {
			alert('Password is required.');
			return false;
		}
		
		if($('#input-password').val().trim() != $('#input-password2').val().trim() ) {
			alert('Password and Password (Again) must be the same');
			return false;
		}
		
		if($('#input-name').val().trim() == '') {
			alert('Name is required.');
			return false;
		}			
		
		if(confirm("Continue create user?")) {			
		$.post(
			base_url + 'user/create',
			$('#form-create-user').serialize(),
			function(data){
				if(data.status.trim() == "OK") {
					alert('OK, user created!');
					document.location = base_url + 'user';
				}
				else alert(data.error);
			},
			"json"
			).error(function(xhr) {
				alert(xhr.responseText);
			});
			
		}
		
		return false;
	});
	
});
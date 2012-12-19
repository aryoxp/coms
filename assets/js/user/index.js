$(function(){
	
	$('.btn-delete-user').click(function(){
		
		if(confirm("Any deleted user can not login to the system and this action once done can not be undone. Continue delete user?")) {			
		
		uid = $(this).data('uid'); //alert(uid);
		row = $(this).parents('tr');
		
		$.post(
			base_url + 'user/delete',
			{id: uid},
			function(data){
				if(data.status.trim() == "OK") {
					row.fadeOut();
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
	
	$('.btn-toggle-status-user').click(function(){
		uid = $(this).data('uid'); // alert(uid);
		label = $(this).parents('tr').find('.label-status'); // alert(label);
		btn = $(this);
		btn.button('loading');	
		
		$.post(
			base_url + 'user/togglestatus',
			{id: uid},
			function(data){
				
				btn.button('reset');
				
				if(data.status.trim() == "OK") {
					label.html(data.ustatus);
					if(data.ustatus == 'Active')
						label.removeClass('label-warning').addClass('label-success');
					else label.removeClass('label-success').addClass('label-warning');
				}
				else alert(data.error);
				
			},
			"json"
			).error(function(xhr) {
				alert(xhr.responseText);
		});
		
		return false;
	});
	
});
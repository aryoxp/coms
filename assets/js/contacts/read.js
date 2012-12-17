$(function(){
	
	$('.btn-delete').click(function(){

		var pid = $(this).data("id");
		if(confirm("Delete this message? Once done, this action can not be undone.")) {
			
		$.post(
			base_url + 'contacts/delete/',
			{id: pid},
			function(data){
				if(data.status.trim() == "OK")
					window.location = base_url + 'contacts';
				else alert(data.error);
			},
			"json"
			).error(function(xhr) {
				alert(xhr.responseText);
		});
			
		} else return false;
	});
	
});
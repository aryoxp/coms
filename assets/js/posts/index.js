$(function(){
	
	$('.btn-delete-post').click(function(){
		var pid = $(this).parents('tr').data("id");
		if(confirm("Delete this post? Once done, this action can not be undone.")) {
		
		var row = $(this).parents('tr');
			
		$.post(
			base_url + 'posts/delete/',
			{id: pid},
			function(data){
				if(data.status.trim() == "OK")
					row.fadeOut();
				else alert(data.error);
			},
			"json"
			).error(function(xhr) {
				alert(xhr.responseText);
			});
			
		}
	});
	
});
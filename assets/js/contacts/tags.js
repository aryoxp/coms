$(function(){
	
	$('.btn-delete-tag').click(function(){
		var name = $(this).parents('tr').data("name"); // alert(name);
		if( confirm("Delete this tag? This action can not be undone and will remove this tag related to any posts.\nPosts related to this tag will be left intact.") ) {
		
		var row = $(this).parents('tr');
			
		$.post(
			base_url + 'posts/deltag/',
			{tagname: name},
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

		return false;
	});
	
	$('.btn-delete-cat').click(function(){
		var name = $(this).parents('tr').data("name"); // alert(name);
		if( confirm("Delete this category? This action can not be undone and will remove this category related to any posts.\nPosts related to this category will be left intact.") ) {
		
		var row = $(this).parents('tr');
			
		$.post(
			base_url + 'posts/delcat/',
			{catname: name},
			function(data){
				if(data.status.trim() == "OK")
					row.fadeOut();
				else alert('Error: ' + data.error);
			},
			"json"
			).error(function(xhr) {
				alert(xhr.responseText);
			});
			
		}

		return false;
	});
	
});
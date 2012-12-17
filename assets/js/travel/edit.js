$(function(){

	var getAllTags = function() {
			result = {};
			$.ajax({
				url: base_url + 'travel/getAllTags', 
				async: false,
				dataType: "json",
				success: function(data) {
					result = data;
				}
			});
			return result;
		}

	$('#post-tags').typeahead({
		source: getAllTags(), 
		items: 5
	});
	
	var addTagToList = function(){
		tag = $('#post-tags').val().trim();
		
		var tags = tag.match(/\w+|'[^']+'/g);
		for(i = 0; i < tags.length; i++) {
			
			if(((tags[i]).trim()) != '') {
				tag = (tags[i]).replace(/'/g,"");
				$('#selected-tags').append('<div class="label label-big pull-left label-tag" title="Click to remove">'+tag+'</div>');
				$('#post-tags').val('');
			}
		}
		return false;
	}
	
	$('#btn-add-tag').click(function(){
		addTagToList();
	});
	
	$('#post-tags').keypress(function(e) {
        if(e.keyCode == 13){
			addTagToList();
			e.preventDefault();	
		}
    });
	
	$('.label-tag').live('click',function () {
        $(this).remove();   
    });
	
	$('.label-tag').live('hover',function () {
		$(this).tooltip();
	});
	
	$('.tooltip').tooltip();
	
	var addCategoryToList = function(){
		cat = $('#post-categories').val().trim();
		if(cat!='') {
			$.post(
				base_url + "travel/create/category",
				{category: cat},
				function(data){
					$('#categories-list').append(data);
					$('#post-categories').val('');
				}
			);		
		}
	}
	
	$('#btn-add-category').click(function(){
		addCategoryToList();
	});
	
	$('#post-categories').keypress(function(e) {
        if(e.keyCode == 13){
			addCategoryToList();
			e.preventDefault();	
		}
    });
	
	$('#comment-status').click(function(){
		if($(this).hasClass("active"))
			$(this).removeClass("btn-danger").addClass("btn-info").text("Allowed");
		else $(this).removeClass("btn-info").addClass("btn-danger").text("Disallowed"); 
	});
	
	$('#write-form').submit(function(){
		return false;
	});
	
	var post_status = 'published';
	
	$('#btn-publish')
	  .click(function () {
        var btn = $(this);
		post_status = 'published';
        btn.button('loading');	
		savePost(btn);	
	});	
	
	$('#btn-draft')
      .click(function () {
        var btn = $(this);
		post_status = 'draft';
        btn.button('loading');
        savePost(btn);
    });
	
	
	var validatePost = function(){
		var postTitle = $('#post_title').val().trim();
		if( postTitle == ''	) {
			alert('You need to at least have title on your post to be saved.');
			return false;
		}
		return true;
	}
	  
	  
	var savePost = function(btn){
		
		if(validatePost()) {
		
			var tags = [];
			
			$('.label-tag').each(function(index, element) {
				tags.push( $(element).text() );
			});
					
			var allowComments = "open";
			if($('#comment-status').hasClass("active"))
				allowComments = "closed";
					
			//alert(tags.join(","));
					
			var d = $('#write-form').serialize() + "&post_status="+ post_status +"&comment_status="+ allowComments +"&post_tags=" + tags.join(",");
			//alert(d);
			$.post(
				base_url + "travel/save",
				d,
				function(data) {
					if(data.status == "OK") {
						$('#id').val(data.id);
						$('#save-status').text(data.modified);
					} else {
						
					}
					btn.button('reset');
				}, 
				"json"
			).error(function(data){
				alert("error: " + data.responseText);
				btn.button('reset');
			});
		} else {
			btn.button('reset');	
		}
		return false;
	}
	
	$('#date-time').datepicker({
		format: 'dd/mm/yyyy'
	});
});
$(function(){
	
	$('#writeTab a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});

	var help = function () { 
		$('#helpModal').modal();
	}

	var converter  = new Markdown.Converter();
	var contenteditor = new Markdown.Editor(converter, "", { handler: help });
	contenteditor.run();	
	
	var getAllTags = function() {
			result = {};
			$.ajax({
				url: base_url + 'posts/getAllTags', 
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
				base_url + "posts/create/category",
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
					
			var d = $('#write-form').serialize() + "&post_status="+ post_status +"&comment_status="+ allowComments +"&post_tags=" + tags.join(",");
			//alert(d);
			
			$('#save-status').text('Saving...');
			
			$.post(
				base_url + "posts/save",
				d,
				function(data) {
					if(data.status == "OK") {
						$('#id').val(data.id);
						$('#save-status').text(data.modified);
						window.location.replace(base_url + "posts/edit/" + data.id);
					} else {
						$('#save-status').text('Failed to save post. ' + data.error);
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
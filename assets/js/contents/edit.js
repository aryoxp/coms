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
	
	$('a[data-tabname="preview"]').on('shown', function (e) {
	  //alert(e.target); // activated tab
	  //e.relatedTarget // previous tab
	  //alert(contenteditor);
	  contenteditor.refreshPreview();
	  //alert("hello");
	})

	var getAllTags = function() {
			result = {};
			$.ajax({
				url: base_url + 'content/getAllTags', 
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
				base_url + "content/create/category",
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
	
	var content_status = 'published';
	
	$('#btn-publish')
	  .click(function () {
        var btn = $(this);
		content_status = 'published';
        btn.button('loading');	
		saveContent(btn);	
	});	
	
	$('#btn-draft')
      .click(function () {
        var btn = $(this);
		content_status = 'draft';
        btn.button('loading');
        saveContent(btn);
    });
	
	$('#btn-discard')
      .click(function () {
		  
		if(confirm('Discarding will delete this post forever, continue?')) {
			var btn = $(this);
			btn.button('loading');
			discardContent(btn);			
		}
    });
	
	$('#btn-generate-pageurl')
		.click(function() {
			var ref = $('#content_title').val().toLowerCase().replace(/[^a-z0-9]+/g,'-');
			ref = ref.replace(/(^-|-$)/g,'');
		    $('#content_page').val(ref);
		});
	
	
	var validateContent = function(){
		var postTitle = $('#content_title').val().trim();
		if( postTitle == ''	) {
			alert('You need to at least have title on your post to be saved.');
			return false;
		}
		return true;
	}
	  
	  
	var saveContent = function(btn){
		
		if(validateContent()) {
							
			var d = $('#write-form').serialize() + "&content_status="+ content_status;
			//alert(d);
			$.post(
				base_url + "content/save",
				d,
				function(data) {
					if(data.status == "OK") {
						$('#id').val(data.id);
						$('#save-status').html(data.modified);
						if(content_status == 'published')
							$('#save-status').html($('#save-status').html() + ' and <span class="label label-success">Published</span>');
						else $('#save-status').html($('#save-status').html() + ' as <span class="label label-warning">Draft</span>');
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
	
	var discardContent = function(btn){
		var d = 'id=' + $('#id').val();
		//alert(d);
		$.post(
			base_url + "content/discard",
			d,
			function(data) {
				if(data.status == "OK") {
					alert('Content discarded!');
					window.location.replace(base_url + "content");
				}
				btn.button('reset');
			}, 
			"json"
		).error(function(data){
			alert("error: " + data.responseText);
			btn.button('reset');
		});
		btn.button('reset');
		return false;
	}
	
	$('#date-time').datepicker({
		format: 'dd/mm/yyyy'
	});

});
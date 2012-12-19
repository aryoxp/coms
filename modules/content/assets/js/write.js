$(function(){
	
	$('#writeTab a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});


	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : base_url + "modules/content/assets/css/tinymce-content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});

	
	
	/*
	
	
	
	
	
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

	$('#content-tags').typeahead({
		source: getAllTags(), 
		items: 5
	});
	
	var addTagToList = function(){
		tag = $('#content-tags').val().trim();
		
		var tags = tag.match(/\w+|'[^']+'/g);
		for(i = 0; i < tags.length; i++) {
			
			if(((tags[i]).trim()) != '') {
				tag = (tags[i]).replace(/'/g,"");
				$('#selected-tags').append('<div class="label label-big pull-left label-tag" title="Click to remove">'+tag+'</div>');
				$('#content-tags').val('');
			}
		}
		return false;
	}
	
	$('#btn-add-tag').click(function(){
		addTagToList();
	});
	
	$('#content-tags').keypress(function(e) {
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
		cat = $('#content-categories').val().trim();
		if(cat!='') {
			$.post(
				base_url + "content/create/category",
				{category: cat},
				function(data){
					$('#categories-list').append(data);
					$('#content-categories').val('');
				}
			);		
		}
	}
	
	$('#btn-add-category').click(function(){
		addCategoryToList();
	});
	
	$('#content-categories').keypress(function(e) {
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
		savePost(btn);	
	});	
	
	$('#btn-draft')
      .click(function () {
        var btn = $(this);
		content_status = 'draft';
        btn.button('loading');
        savePost(btn);
    });
	
	
	var validatePost = function(){
		var contentTitle = $('#content_title').val().trim();
		if( contentTitle == ''	) {
			alert('You need to at least have title on your content to be saved.');
			return false;
		}
		return true;
		
	}
	  
	  
	var savePost = function(btn){
		if(validatePost()) {
					
			var d = $('#write-form').serialize() + "&content_status="+ content_status;
			//alert(d);
			
			$('#save-status').text('Saving...');
			
			$.post(
				base_url + "content/save",
				d,
				function(data) {
					if(data.status == "OK") {
						$('#id').val(data.id);
						$('#save-status').text(data.modified);
						window.location.replace(base_url + "content/edit/" + data.id);
					} else {
						$('#save-status').text('Failed to save content. ' + data.error);
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
	
	*/
});
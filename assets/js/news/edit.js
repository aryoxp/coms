$(function(){

	$('#writeTab a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
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
	
	$('#btn-discard')
      .click(function () {
		  
		if(confirm('Discarding will delete this post forever, continue?')) {
			var btn = $(this);
			btn.button('loading');
			discardPost(btn);			
		}
    });
	
	$('#btn-generate-pageurl')
		.click(function() {
			var ref = $('#post_title').val().toLowerCase().replace(/[^a-z0-9]+/g,'-');
			ref = ref.replace(/(^-|-$)/g,'');
		    $('#post_page').val(ref);
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
				base_url + "news/save",
				d,
				function(data) {
					if(data.status == "OK") {
						$('#id').val(data.id);
						$('#save-status').html(data.modified);
						if(post_status == 'published')
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
	
	var discardPost = function(btn){
		var d = 'id=' + $('#id').val();
		//alert(d);
		$.post(
			base_url + "news/discard",
			d,
			function(data) {
				if(data.status == "OK") {
					alert('Post discarded!');
					window.location.replace(base_url + "news");
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
	
	$('textarea.tinymce').tinymce({
		
		// Location of TinyMCE script
		script_url : tinymcejs,		

		theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
		font_size_style_values : "10px,12px,13px,14px,16px,18px,20px",
		
        // General options
        theme : "advanced",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
	});
});
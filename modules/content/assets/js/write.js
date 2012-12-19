$(function(){
	
	$('#writeTab a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});


	tinyMCE.init({
		// General options
		mode : "exact",
		elements: "tinymce",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote",
		theme_advanced_buttons2 : "styleselect,formatselect,fontselect,fontsizeselect,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,pagebreak,restoredraft,visualblocks,|,insertdate,inserttime,preview",
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
		tinyMCE.triggerSave(true,true);
		if(validatePost()) {
					
			var d = $('#write-form').serialize() + "&content_status="+ content_status;
			//alert(d);
			
			$('#save-status').text('Saving...');
			
			$.post(
				base_url + "module/content/home/save",
				d,
				function(data) {
					if(data.status == "OK") {
						$('#id').val(data.id);
						$('#save-status').text(data.modified);
						window.location.replace(base_url + "module/content/home/edit/" + data.id);
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
	
	
});
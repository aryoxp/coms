$(function() {
	
	//alert(base_path);
	
    $('#file-tree').fileTree({
        root: "../files/",
        script: base_url + 'file/tree',
        expandSpeed: 200,
        collapseSpeed: 200,
        multiFolder: true
    }, function(file) {
		$('#path-url').html(web_base_url + '' + file.substr(3));
    });
	
	//alert('hello');
	
});
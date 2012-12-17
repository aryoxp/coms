$(function(){
	
	$('.btn-toggle-status').click(function(){
		modname = $(this).parents("tr").attr("data-id");
		
		status = $('#status-'+modname).text();
		if(status == "Inactive") action = 'activate';
		else action = "deactivate";
		url = base_url + "module/"+action;
		//alert(url);
		d = {module: modname};
		$.post(
			url,
			d,
			function(data) {
				//alert(data);
				if(data.result == "OK") {
					if(status == "Inactive")
						$('#status-'+modname).text('Active').addClass("label-success");
					else $('#status-'+modname).text('Inactive').removeClass("label-success");
				} else {
					alert('Failed to toggle module status. ' + data.error);
				}
				btn.button('reset');
			}, 
			"json"
		).error(function(data){
			alert("error: " + data.responseText);
			btn.button('reset');
		});
	});
	
	$('.btn-uninstall').click(function() {
		alert("Toggle!");
	});
	
	$('.label-warning').click(function() {
		modname = $(this).attr("data-modname");
		label = $(this);
		if(confirm("Deactivate this module: " + modname + "?"))
		
		url = base_url + "module/deactivate";
		d = {module: modname};
		$.post(
			url,
			d,
			function(data) {
				//alert(data);
				if(data.result == "OK") {
					label.hide();
				} else {
					alert('Unable to deactivate module: ' + modname + ". " + data.error);
				}
				btn.button('reset');
			}, 
			"json"
		).error(function(data){
			alert("error: " + data.responseText);
			btn.button('reset');
		});
	});
		
});
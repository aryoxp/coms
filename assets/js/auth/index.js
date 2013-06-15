$(function() {
	
	$('#notification').hide();
	
	$('#logon-form').submit(function() {
		event.preventDefault();
		data = $('#logon-form').serialize();
		$.post(
		  base_url + "auth/logon", 
		  data
		).done(function(data){
			  if(data == "OK") {
				window.location.href = base_url;
		  	  } else {
				  alertDOM = '<div class="alert alert-error fade in"><a class="close" data-dismiss="alert">&times;</a>Oh snap! Change a few things up and try submitting again.</div>';
				  if($('#notification-container').is(':visible'))
						$('#notification-container').fadeOut();
				  $('#notification-container').html(alertDOM).fadeIn();
			  }
		});
	});	
});
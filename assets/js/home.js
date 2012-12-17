$(function(){
	
	$('.check-all').click(function(){
		$(this).parents('fieldset').find(':checkbox').attr('checked', 'checked');
		return false;
	});
	
	$('.uncheck-all').click(function(){
		$(this).parents('fieldset').find(':checkbox').removeAttr('checked');
		return false;
	});
		
});
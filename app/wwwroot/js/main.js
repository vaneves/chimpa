$(document).ready(function(){
	$('a[data-toggle="confirm"]').click(function(e){
		e.preventDefault();
		var confirm = $($(this).attr('href'));
		confirm.show('fast')
		.find('*[data-toggle="dismiss"]')
		.click(function(){
			confirm.hide('fast');
		});
	});
});

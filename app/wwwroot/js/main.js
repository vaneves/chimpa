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
	
	
	// User add validation
	$('#user-form').validate(
	{
		rules: {
			Name: {
				minlength: 3,
				required: true
			},
			Email: {
				required: true,
				email: true
			},
			Password: {
				minlength: 6,
				required: true
			}
		},
		messages: {
			Name: {
				minlength: 'Seu nome deve conter no mínimo 3 caractéres.',
				required: 'Você deve informar seu nome.'
			},
			Email: {
				required: 'Você deve informar o seu e-mail.',
				email: 'O e-mail está em formato incorreto.'
			},
			Password: {
				required: 'Você deve informar uma senha.',
				minlength: 'A senha deve ter pelo menos 6 caractéres'
			}
		},
		highlight: validateHighLight(),
		success: validateSuccess()
	});
});

function validateSuccess(){
	return function(element) {
		element
		.text('OK!').addClass('valid')
		.closest('.control-group').removeClass('error').addClass('success');
	};
}

function validateHighLight(){
	return function(element) {
		$(element).closest('.control-group').removeClass('success').addClass('error');
	};
}

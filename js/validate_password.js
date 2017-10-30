$(document).ready(function() {

	$('#password_input').keyup(function() {
    	var pswd = $(this).val()

    	//validate the length
		if ( pswd.length < 8 ) {
		    $('#length').removeClass('valid').addClass('invalid');
		} else {
		    $('#length').removeClass('invalid').addClass('valid');
		}

		//validate letter
		if ( pswd.match(/[A-z]/) ) {
		    $('#letter').removeClass('invalid').addClass('valid');
		} else {
		    $('#letter').removeClass('valid').addClass('invalid');
		}

		//validate capital letter
		if ( pswd.match(/[A-Z]/) ) {
		    $('#capital').removeClass('invalid').addClass('valid');
		} else {
		    $('#capital').removeClass('valid').addClass('invalid');
		}

		//validate number
		if ( pswd.match(/\d/) ) {
		    $('#number').removeClass('invalid').addClass('valid');
		} else {
		    $('#number').removeClass('valid').addClass('invalid');
		}

	}).focus(function() {
	    $('#pswd_info').show();
	}).blur(function() {
	    $('#pswd_info').hide();
	})
	
	$('#signup_form').submit(function(event){
	    
	    var lengthClass = $('#length').attr('class')
	    var letterClass = $('#letter').attr('class')
	    var capitalClass = $('#capital').attr('class')
	    var numberClass = $('#number').attr('class')
	    
	    if(lengthClass !== 'valid' || letterClass !== 'valid' || capitalClass !== 'valid' || numberClass !== 'valid'){
    	    event.preventDefault()
    	    alert('La contraseña no satisface todos los requerimientos')
	    }
	    
	})
})

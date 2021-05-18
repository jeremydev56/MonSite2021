$(function () {
    
    // L'événement sur lequel je veux que le script réagisse
    $('#contact-form').submit(function(e) {
        // Ce code est exécuté lorsque je soumets le formulaire => SUBMIT
        e.preventDefault();
        //enlever le comportement par défaut d'un formulaire
        $('.comments').empty();
        var postdata = $('#contact-form').serialize();
        /* mettre les informations contenues dans le formulaire
		à l'intérieur d'une variable post-data
		*/

		// AJAX !
        
        $.ajax({
            type: 'POST',
            // on poste les informations
            url: 'php/renvoi_formulaire.php',
            // dans le fichier index.php
            data: postdata,
            // la variable postdata
            dataType: 'json',
            // c'est un json
            success: function(json) {
            	// si succès de l'envoi
                 
                if(json.isSuccess) 
                {
                	// ajouter le formulaire de contact
                    $('#contact-form').append("<p class='thank-you'>Votre message a bien été envoyé. Merci de m'avoir contacté.</p>");
                    // remettre le formulaire de contact à zéro
                    $('#contact-form')[0].reset();
                }
                else
                {
                	// si échec de l'envoi
                    $('#firstname + .comments').html(json.firstnameError);
                    //renvoi du message d'erreur lié à la variable firstName.
                    $('#name + .comments').html(json.nameError);
                    $('#email + .comments').html(json.emailError);
                    $('#phone + .comments').html(json.phoneError);
                    $('#message + .comments').html(json.messageError);
                }                
            }
        });
    });

})
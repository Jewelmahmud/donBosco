jQuery(document).ready(function($) {



    $('#contact-form').submit(function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var formData = $form.serialize();

        var emailInput = $form.find('input[name="email"]').val();
        var honeypot   = $form.find('input[name="honeypot"]').val();
        var message    = $form.find('#message').val();
        var phone      = $form.find('#phone').val();

        if (!isValidEmail(emailInput)) {
            swal("Ongeldig", invaliemail, "error");
            return;
        }
        
        if(emailInput== '' || message == '' || phone == '') {
            swal("Aandacht", mandatoryFields, "error");
            return;
        }

        if (honeypot) {
            swal("Ongeldig", 'We don\'t support bot submission', "error");
            return;
        }
        
        $form.find('.submitbtn').attr('disabled', true);
        $form.find('.loading-animation').removeClass('d-none');
        $form.find('.btntexts').addClass('d-none');
        
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'submit_contact_form',
                formData: formData,
                url: window.location.href
            },
            success: function(response) {
                console.log(response);
                if(response.status) swal("Bericht verzonden", successmsg, "success");
                else swal("Fout!", errormsg, "error");
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                swal("Fout!", errormsg, "error");
            },
            complete: function() {
                $form.find('.submitbtn').attr('disabled', false);
                $form.find('.loading-animation').addClass('d-none');
                $form.find('.btntexts').removeClass('d-none');
            }
        });
    });



    function isValidEmail(email) {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
});

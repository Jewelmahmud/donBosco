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
                if(response.status) swal("Bericht verzonden", successmsg, "success");
                else swal("Fout!", errormsg, "error");
            },
            error: function(xhr, status, error) {
                swal("Fout!", errormsg, "error");
            },
            complete: function() {
                $form.find('.submitbtn').attr('disabled', false);
                $form.find('.loading-animation').addClass('d-none');
                $form.find('.btntexts').removeClass('d-none');
            }
        });
    });


    $('.text-link').click(function(){
        let contents    =   $(this).closest('.team-card'),
            img         =   contents.find('.personimage').attr('data-img'),
            name        =   contents.find('.team-card-body h3').text(),
            position    =   contents.find('.position').text(),
            texts       =   contents.find('.full-text').text(),
            phone       =   contents.find('.pphone').text(),
            email       =   contents.find('.pemail').text(),
            socials     =   contents.find('.socials li');


            let modal   =   $('.modal-body');
                modal.find('.person_name').text(name);
                modal.find('.details').text(texts);
                modal.find('.position').text(position);
                modal.find('.modalphone').text(phone);
                if(phone) modal.find('.modalphone').show().attr('href', phone);
                else modal.find('.modalphone').hide();
                if(email) modal.find('.modalemail').show().text(email);
                else modal.find('.modalemail').hide();
                modal.find('.modalemail').attr('href', 'mailto:' + email);
                modal.find('.person-img').attr('src', img);
                modal.find('.social-icon-wrapper li').remove();
                socials.clone().appendTo(modal.find('.social-icon-wrapper'));
    }); 

    $('.single-news-body').contents().filter(function() {
        return this.nodeType === 3 && this.parentNode.nodeName !== 'P';
    }).wrap('<p></p>');



    function isValidEmail(email) {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
});

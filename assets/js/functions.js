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


    // Load archieve contents through ajax
    function fetchPostsByYear(year) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'fetch_events_by_year',
                year: year,
            },
            success: function(response) {
                filterWrap.empty();
                var newContent = $(response.jobs);
                filterWrap.append(newContent).isotope('appended', newContent);
                filterWrap.isotope('layout');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching posts:', error);
            }
        });
    }

    function fetchVerhuursByYear(year) {
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'fetch_verhuur_by_year',
                year: year,
            },
            success: function(response) {
                filterWrap.empty();
                var newContent = $(response.jobs);
                filterWrap.append(newContent).isotope('appended', newContent);
                filterWrap.isotope('layout');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching posts:', error);
            }
        });
    }

    // Event listener for select change
    $('#eventment').change(function() {
        var selectedYear = $(this).val();
        fetchPostsByYear(selectedYear);
    });

    $('#verhuur').change(function() {
        var selectedYear = $(this).val();
        fetchVerhuursByYear(selectedYear);
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
                if(phone) modal.find('.modalphone').attr('href', phone).parent().addClass('d-flex').show();
                else modal.find('.modalphone').parent().removeClass('d-flex').hide();
                if(email) modal.find('.modalemail').text(email).parent().addClass('d-flex').show();
                else modal.find('.modalemail').parent().removeClass('d-flex').hide();
                modal.find('.modalemail').attr('href', 'mailto:' + email);
                modal.find('.person-img').attr('src', img);
                modal.find('.social-icon-wrapper li').remove();
                socials.clone().appendTo(modal.find('.social-icon-wrapper'));
    }); 

    $('.single-news-body').contents().filter(function() {
        return this.nodeType === 3 && this.parentNode.nodeName !== 'P';
    }).wrap('<p></p>');


    $('.zevenhuizenbtn').click(function(e){
        e.preventDefault();
        $('.dematen').addClass('d-none');
        $('.zevenhuizen').removeClass('d-none');

        $(this).addClass('btn-primary').removeClass('btn-outline-primary');
        $('.dematenbtn').removeClass('btn-primary').addClass('btn-outline-primary');

    });
    $('.dematenbtn').click(function(e){
        e.preventDefault();
        $('.dematen').removeClass('d-none');
        $('.zevenhuizen').addClass('d-none');

        $(this).addClass('btn-primary').removeClass('btn-outline-primary');
        $('.zevenhuizenbtn').removeClass('btn-primary').addClass('btn-outline-primary');
    });


    function isValidEmail(email) {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }




    // Donation Functions -----------------------------------

    let frequencies = $('.frequency .form-check');
    let amountItems = $('.donation-amount .form-check');   
    let methodTab   = $('#paymentMethodTab li button');


    $('button[data-bs-toggle="tab"]').on('click', function() {
        $('#paypalInfo').hide();
        $('#bankInfo').hide();
        $('#idealInfo').hide();

        if ($(this).attr('id') === 'paypal-tab') {
            $('#paypalInfo').show();
        } else if ($(this).attr('id') === 'bank-tab') {
            $('#bankInfo').show();
        } else if ($(this).attr('id') === 'ideal-tab') {
            $('#idealInfo').show();
        }
    });

             

    amountItems.click(function(){

        let amount = $(this).find('.form-check-label').text();
        let radioButton = $(this).find('input[type=radio]');
        
        $(this).find('input[type=radio]').prop('checked', true);
        $(this).addClass('active').siblings().removeClass('active');        
        $('.custom-amount').hide();       
        if (radioButton.attr('id') === 'amountCustom') {
            $('.custom-amount').show();
        }else {
            $('#donationSubmit').text('Ja, doneer '+ amount +'!');
        }
    });

    frequencies.click(function(){                
        $(this).find('input[type=radio]').prop('checked', true);
        $(this).addClass('active').siblings().removeClass('active');
    });

    methodTab.click(function(){
        $(this).closest('.nav-tabs').find('.nav-item button input').prop('checked', false);
        $(this).find('input').prop('checked', true);
    });

    $('#custom_amount').on('input', function(){
        $('#donationSubmit').text('Ja, doneer '+ '€' + $(this).val() +'!');
    });


    $('#donationSubmit').click(function(e) {
        e.preventDefault();
        var formData = $('#donationForm').serialize() + '&action=process_donation_ajax';
        $('.loading-animation').show();
        $('.btntexts').hide();
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: formData,
            success: function(response) {
                console.log('Success:', response);
                if(response.success){
                    window.location.href = response.data.paymentUrl
                }else {
                    swal({
                        title: "Aandacht alstublieft",
                        text: response.data,
                        icon: "error"
                    });
                }
                $('.loading-animation').hide();
                $('.btntexts').show();
            },
            error: function(xhr, status, error) {
                swal("Sorry!", error, "error");
                $('.loading-animation').hide();
                $('.btntexts').show();
            }
        });
    });

    
    // Email subscription to mailchimp ----------------

    $('.emailsubmit').on('click', function(e) {
        e.preventDefault();
        
        var newsemail = $('#newsiemail').val();
    
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'mailchimp_subscription',
                email: newsemail,
            },
            success: function(response) {
                swal("Geabonneerd!", response.message, "success");
                $('#newsiemail').val('');
            },
            error: function(xhr, status, error) {
                console.error('Error fetching posts:', error);
                swal("Error!", error, "error");
            }
        });
    });


    $('.downloadselector').click(function(e) {
        e.preventDefault();
        load_downloads(this);
    });





});

// Global Scope

function loadeventsbycat(cat) {
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'fetch_verhuur_by_cat',
            cat: cat,
        },
        success: function(response) {
            filterWrap.empty();
            var newContent = $(response.jobs);
            filterWrap.append(newContent).isotope('appended', newContent);
            filterWrap.isotope('layout');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching posts:', error);
        }
    });
}

var eventpage = 2;
var eventloading = false;

function loadmoreEvents() {
    if (eventloading) return;
    let cat      = $('.eventselector.active').attr('data-id');
    eventloading = true;
    console.log('events');
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'load_more_events',
            cat: cat,
            page: eventpage,
        },
        success: function(response) {

            eventpage++;
            var newContent = $(response.jobs);
            filterWrap.append(newContent).isotope('appended', newContent);
            filterWrap.isotope('layout');

            eventloading = false;
        },
        error: function(xhr, status, error) {
            console.error('Error fetching posts:', error);
        }
    });
}
var newspage = 2;
var newsloading = false;

function load_news(el = '', loadmore = false){
    let cat = $(el).attr('data-id');  
    if(loadmore) cat = $('.newsselector.active').attr('data-id');
    let data = {
        action: 'load_new_by_category',
        cat: cat,
        loadmore: false,
    }
    if(loadmore){ 
        if (newsloading) return; 
        newsloading = true;
        data.page = newspage;
        data.loadmore = true;
    }
    
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: data,
        success: function(response) {
            if(!loadmore) filterWrap.empty();
            var newContent = $(response.news);
            filterWrap.append(newContent).isotope('appended', newContent);
            filterWrap.isotope('layout');

            if(loadmore) {
                newsloading = false;
                newspage++;
            }
            newspage = 2; 
        },
        error: function(xhr, status, error) {
            console.error('Error fetching posts:', error);
            if(loadmore) newsloading = false;
            newspage = 2; 
        }
    });
}

var downpage = 2;
var downloading = false;

function load_downloads(el = '', loadmore = false){
    let cat = $(el).attr('data-id');  
    if(loadmore) cat = $('.downloadselector.active').attr('data-id');
    let data = {
        action: 'load_downloads',
        cat: cat,
        loadmore: false,
    }
    if(loadmore){ 
        if (downloading) return; 
        downloading = true;
        data.page = downpage;
        data.loadmore = true;
    }
    
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: data,
        success: function(response) {
            if(!loadmore) filterWrap.empty();
            var newContent = $(response.downloads);
            filterWrap.append(newContent).isotope('appended', newContent);
            filterWrap.isotope('layout');

            if(loadmore) {
                downloading = false;
                downpage++;
            }
            downpage = 2; 
        },
        error: function(xhr, status, error) {
            console.error('Error fetching posts:', error);
            if(loadmore) downloading = false;
            downpage = 2; 
        }
    });
}



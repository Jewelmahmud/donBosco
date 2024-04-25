jQuery(document).ready(function() {
    
    if(!jQuery('input[name="acf[field_658a4cb148144]"]').is(':checked')) {
        jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();
    }

    jQuery('input[name="acf[field_658a4cb148144]"]').change(function() {
        console.log('hello');
        if(jQuery(this).is(':checked')) {
            jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').show();
        } else {
            jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();
        }
    });
});
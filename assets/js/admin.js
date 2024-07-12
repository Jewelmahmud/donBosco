jQuery(document).ready(function() {
    
    if(!jQuery('input[name="acf[field_658a4cb148144]"]').is(':checked')) {
        jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();
    }
    let forms = jQuery('input[name="acf[field_658a4cb148144]"]');
    let checkedValue = forms.filter(':checked').val();
    forms.change(function() {
        let form = jQuery(this).val();
        if(form == 'General Form') {
            jQuery('.acf-field-668d1c4054b93').hide();
            jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').show();
        } else if(form == 'Donation Form') {
            jQuery('.acf-field-668d1c4054b93').show();
            jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();
        } else {
            jQuery('.acf-field-668d1c4054b93').hide();
            jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();

        }        
    });

    
    
    if(checkedValue === 'None'){
        jQuery('.acf-field-668d1c4054b93').hide();
        jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();
    } else if (checkedValue == 'General Form') {
        jQuery('.acf-field-668d1c4054b93').hide();
        jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').show();
    } else if (checkedValue == 'Donation Form') {
        jQuery('.acf-field-668d1c4054b93').show();
        jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();
    }else {
        jQuery('.acf-field-668d1c4054b93').hide();
        jQuery('.acf-field-658a4e680d642, .acf-field-6625a316b5694').hide();
    }


    // Support page
    let supportforms = jQuery('input[name="acf[field_661e11d8aeb52][field_668d32a33f9d8]"]');
    let scheckedValue = supportforms.filter(':checked').val();
    supportforms.change(function() {
        let form = jQuery(this).val();
        if(form == 'Image Slider') {
            jQuery('.acf-field-661e11d8aeb58').show();
            jQuery('.acf-field-668d3965da270').hide();
        } else if (form == 'Donation Form') {
            jQuery('.acf-field-661e11d8aeb58').hide();
            jQuery('.acf-field-668d3965da270').show();
        }else {
            jQuery('.acf-field-661e11d8aeb58').hide();
            jQuery('.acf-field-668d3965da270').hide();

        }         
        
    });
   

    if (scheckedValue == 'Image Slider') {
        jQuery('.acf-field-661e11d8aeb58').show();
        jQuery('.acf-field-668d3965da270').hide();       
    } else if (scheckedValue == 'Donation Form') {
        jQuery('.acf-field-661e11d8aeb58').hide();
        jQuery('.acf-field-668d3965da270').show();
    }else if(scheckedValue === 'None'){
        jQuery('.acf-field-661e11d8aeb58').hide();
        jQuery('.acf-field-668d3965da270').hide();
    } 

    // Support 2 page
    let supportsforms = jQuery('input[name="acf[field_6627414c8c807][field_668d7277afc8e]"]');
    let scheckValue = supportsforms.filter(':checked').val();
    supportsforms.change(function() {
        let form = jQuery(this).val();
        if(form == 'Image Slider') {
            jQuery('.acf-field-6627414cc54e0').show();
            jQuery('.acf-field-668d72b601029').hide();
        } else if (form == 'Donation Form') {
            jQuery('.acf-field-6627414cc54e0').hide();
            jQuery('.acf-field-668d72b601029').show();
        }else {
            jQuery('.acf-field-6627414cc54e0').hide();
            jQuery('.acf-field-668d72b601029').hide();

        }         
        
    });
   

    if (scheckValue == 'Image Slider') {
        jQuery('.acf-field-6627414cc54e0').show();
        jQuery('.acf-field-668d72b601029').hide();       
    } else if (scheckValue == 'Donation Form') {
        jQuery('.acf-field-6627414cc54e0').hide();
        jQuery('.acf-field-668d72b601029').show();
    }else if(scheckValue === 'None'){
        jQuery('.acf-field-6627414cc54e0').hide();
        jQuery('.acf-field-668d72b601029').hide();
    } 


    // Verhuur 2 page
    let verhuurforms = jQuery('input[name="acf[field_669004caf3cb9]"]');
    let vcheckValue = verhuurforms.filter(':checked').val();
    verhuurforms.change(function() {
        let form = jQuery(this).val();
        if(form == 'General Form') {
            jQuery('.acf-field-66900535f3cbb').show();
            jQuery('.acf-field-66900507f3cba').hide();
            jQuery('.acf-field-66900b342cb60').show();
        } else if (form == 'Donation Form') {
            jQuery('.acf-field-66900535f3cbb').hide();
            jQuery('.acf-field-66900507f3cba').show();
            jQuery('.acf-field-66900b342cb60').show();
        }else {
            jQuery('.acf-field-66900535f3cbb').hide();
            jQuery('.acf-field-66900507f3cba').hide();
            jQuery('.acf-field-66900b342cb60').hide();            
        }         
        
    });
   

    if (vcheckValue == 'General Form') {
        jQuery('.acf-field-66900535f3cbb').show();
        jQuery('.acf-field-66900507f3cba').hide();      
    } else if (vcheckValue == 'Donation Form') {
        jQuery('.acf-field-66900535f3cbb').hide();
        jQuery('.acf-field-66900507f3cba').show();
    }else if(vcheckValue === 'None'){
        jQuery('.acf-field-66900535f3cbb').hide();
        jQuery('.acf-field-66900507f3cba').hide();
        jQuery('.acf-field-66900b342cb60').hide();
    } 


    // Event single -----------
    let seventforms = jQuery('input[name="acf[field_669048ca10dbe]"]');
    let secheckValue = seventforms.filter(':checked').val();
    seventforms.change(function() {
        let form = jQuery(this).val();
        if(form == 'General Form') {
            jQuery('.acf-field-6633179795402').show();
            jQuery('.acf-field-6690490a10dbf').hide();
            jQuery('.acf-field-668d4b930f760').show();
        } else if (form == 'Donation Form') {
            jQuery('.acf-field-6633179795402').hide();
            jQuery('.acf-field-6690490a10dbf').show();
            jQuery('.acf-field-668d4b930f760').show();
        }else {
            jQuery('.acf-field-6633179795402').hide();
            jQuery('.acf-field-6690490a10dbf').hide();
            jQuery('.acf-field-668d4b930f760').hide();
            
        }         
        
    });
   
    
    if (secheckValue == 'General Form') {
        jQuery('.acf-field-6633179795402').show();
        jQuery('.acf-field-6690490a10dbf').hide();     
    } else if (secheckValue == 'Donation Form') {
        jQuery('.acf-field-6633179795402').hide();
        jQuery('.acf-field-6690490a10dbf').show();
    }else if(secheckValue === 'None'){
        jQuery('.acf-field-6633179795402').hide();
        jQuery('.acf-field-6690490a10dbf').hide();
        jQuery('.acf-field-668d4b930f760').hide();
    } 


    // News single -----------
    let newsforms = jQuery('input[name="acf[field_6690538d94a43]"]');
    let necheckValue = newsforms.filter(':checked').val();
    newsforms.change(function() {
        let form = jQuery(this).val();
        if(form == 'General Form') {
            jQuery('.acf-field-6690544994a47').show();
            jQuery('.acf-field-669053f294a45').hide();
            jQuery('.acf-field-669053d694a44').show();
        } else if (form == 'Donation Form') {
            jQuery('.acf-field-6690544994a47').hide();
            jQuery('.acf-field-669053f294a45').show();
            jQuery('.acf-field-669053d694a44').show();
        }else {
            jQuery('.acf-field-6690544994a47').hide();
            jQuery('.acf-field-669053f294a45').hide();
            jQuery('.acf-field-669053d694a44').hide();
            
        }         
        
    });
   
    
    if (necheckValue == 'General Form') {
        jQuery('.acf-field-6690544994a47').show();
        jQuery('.acf-field-669053f294a45').hide();    
    } else if (necheckValue == 'Donation Form') {
        jQuery('.acf-field-6690544994a47').hide();
        jQuery('.acf-field-669053f294a45').show();
    }else if(necheckValue === 'None'){
        jQuery('.acf-field-6690544994a47').hide();
        jQuery('.acf-field-669053f294a45').hide();
        jQuery('.acf-field-669053d694a44').hide();
    } 


    // Events -------------
    // let eventCheck = jQuery('input[name="acf[field_668d4b930f760]"]');
    // let eventForm = jQuery('.acf-field-6633179795402');
    // eventCheck.on('change', function() {
    //     if (jQuery(this).is(':checked')) eventForm.show();
    //     else eventForm.hide();
    // });

    // if(eventCheck.is(':checked'))  eventForm.show();
    // else eventForm.hide();

});
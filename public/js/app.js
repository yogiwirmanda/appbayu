// var navActive = $('#navActive').val();
// if (navActive.length > 0){
//     let navActiveSplit = navActive.split('-');
//     let mainMenu = navActiveSplit[0];
//     let subMenu = navActiveSplit[1];
//     $('.'+mainMenu+'-menu').trigger('click');
//     $('.navbar-'+subMenu+' .nav-item').addClass('active');
// }

PRC = {
    ajaxSubmit : function(form, redirectUrl, pasien = false, withRedirect = true){
        form.find('.btn').attr('disabled', 'disabled');
        $.ajax({
            url : form.attr('action'),
            method : form.attr('method'),
            dataType : 'json',
            data : form.serialize(),
            success : function(response){
                let error = response.error;
                let messages = response.messages;
                if (error === 1){
                    $.notify(messages, 'error');
                    let field = response.field;
                    $.each(field, function(key, value){
                        $('.input-form-'+value).addClass('is-invalid');
                    });
                    form.find('.btn').removeAttr('disabled');
                } else {
                    $.notify(messages, 'success');
                    if (withRedirect == true){
                        if (pasien != false && pasien != 'antrean'){
                            setTimeout(() => {
                                window.location.href = redirectUrl + '/' + response.dataId + '/baru';
                            }, 1000);
                        } else if (pasien == 'antrean'){
                            setTimeout(() => {
                                window.location.href = redirectUrl + '/' + response.dataId;
                            }, 1000);
                        } else {
                            setTimeout(() => {
                                window.location.href = redirectUrl;
                            }, 1000);
                        }
                    }
                }
                HoldOn.close();
            }
        });
    },
    disabledValidation : function(){
        $('.form-control').removeClass('is-invalid');
    },
}
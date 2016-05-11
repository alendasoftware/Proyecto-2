jQuery(function ($) {
    var form = $('#training-form');
    form.submit(function (event) {
        event.preventDefault();
        var form_status = $('<div class="form_status"></div>');
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                form.prepend(form_status.html('<p class="text-info"><i class="fa fa-spinner fa-spin"></i> Su mensaje se esta enviando...</p>').fadeIn());
            }
        }).done(function (data) {
            if (data.message != undefined) {
                form_status.html('<p class="text-success"><i class="fa fa-check"></i> ' + data.message + '</p>').delay(3000).fadeOut();
                form[0].reset();
                $('#mensajeSistema .modal-body').html('<p class="text-success"><i class="fa fa-check">&nbsp;</i>' + data.message + '</p>');
                $('#mensajeSistema').modal('show');
            } else {
                if (data.error != undefined) {
                    form_status.html('<p class="text-danger"><i class="fa fa-exclamation-triangle"></i> ' + data.error + '</p>').delay(3000).fadeOut();
                    $('#mensajeSistema .modal-body').html('<p class="text-danger"><i class="fa fa-exclamation-triangle">&nbsp;</i>' + data.error + '</p>');
                    $('#mensajeSistema').modal('show');
                }
            }
        });
    });
});
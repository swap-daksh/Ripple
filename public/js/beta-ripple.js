document.onreadystatechange = function () {
    if (document.readyState == 'loaded' || document.readyState == 'complete') {
        setTimeout(function () {
            $('.ripple-loader').fadeOut(1000).remove();
        }, 500);
    }
};


$(document).ready(function () {
    "use strict";
    //setInterval(function () { console.log(document.readyState) }, 100);

    /*
     * ***********************************************************************************
     *                                  Global js script Start
     * ***********************************************************************************
     */
    var body = document.body,
        html = document.documentElement;

    var height = Math.max(body.scrollHeight, body.offsetHeight,
        html.clientHeight, html.scrollHeight, html.offsetHeight);
    $('#app').css('min-height', height + "px");







    $('.rpl-container').css('min-height', (height - 53) + "px");
    // Toastr Notifications.........
    var toastrNotify = setInterval(function () {
        if ($('#toast-container').length === 0) {
            $('#toast-notify').remove();
            clearInterval(toastrNotify);
        }
    }, 10);

    // init Slim scroll on load
    //    initSlimScroll();
    // init Slim scroll on window resize
    $(window).on('resize', function () {
        //        initSlimScroll();
    });


    //TinyMCE Text Editor.......
    tinymce.init({
        menubar: false,
        selector: 'textarea.ripple_text_editor',
        skin: 'ripple',
        plugins: 'link, image, code, youtube, giphy',
        extended_valid_elements: 'input[onclick|value|style|type]',
        file_browser_callback: function (field_name, url, type, win) {
            if (type == 'image') {
                $('#upload_file').trigger('click');
            }
        },
        toolbar: 'styleselect bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image youtube giphy | code',
        convert_urls: false,
        image_caption: true,
        image_title: true
    });


    /*
     * ***********************************************************************************
     *                                  Global js script End
     * ***********************************************************************************
     */

    /*
     |----------------------------------------------------------------------
     |	Page content height
     |----------------------------------------------------------------------
     */
    $('.image-preview').previewImage({ id: 'asdfasfd' });


    /**
     * File field on change event 
     */
    $(document).on('change', '.custom-file-input', function () {
        var attr = $(this).attr('multiple');
        if (typeof attr === typeof undefined) {
            var file = $(this)[0].files[0];
            $(this).siblings('.custom-file-label').html('<div class="text-primary">' + file.name + '</div>');
        }
    });




    /**
     * Bread System image file on change
     */
    $(document).on('change', '.custom-file-input-bread', function(){
        var attr = $(this).attr('multiple');
        if (typeof attr === typeof undefined) {
            var file = $(this)[0].files[0];
            if(file.size >= 1024 && file.size < 1048576){
                var fileSize = (file.size / 1024).toFixed(2) + 'KB';
            }else if(file.size >= 1048576 && file.size < 1073741824){
                var fileSize = (file.size / 1048576).toFixed(2) + 'MB';
            }

            var HTML = '';
            HTML += '<p><strong>Title:</strong>&nbsp;&nbsp;<code>' + file.name + '</code></p>';
            HTML += '<p><strong>Size:</strong>&nbsp;&nbsp;<code>'+ fileSize +'</code></p>';
            HTML += '<p><strong>Type:</strong>&nbsp;&nbsp;<code>'+ file.type +'</code></p>';
            $($(this).attr('data-details')).html(HTML);
        }
    });



    /*
     |------------------------------------------------------------------------------------------------------------------- 
     |                                  Setting Model "setting-key"
     |-------------------------------------------------------------------------------------------------------------------
     */
    var setting_key = "#setting-key, .setting-key, input[name=setting-key], input[data-id=setting-key]";
    $(document).on('keydown keyup', setting_key, function (e) {
        if ((e.which >= 65 && e.which <= 90) || e.which === 8 || e.which === 9 || e.which === 17 || e.which === 16 || e.which === 173) {
            $(this).val($(this).val().toLowerCase());
            return e.which;
        }
        e.preventDefault();
    });


    /*
     |------------------------------------------------------------------------------------------------------------------- 
     |                                  Setting Model "setting-type" Start
     |-------------------------------------------------------------------------------------------------------------------
     */
    var setting_type = "#setting-type, .setting-type, select[name=setting-type], select[data-id=setting-type]";
    $(document).on('change', setting_type, function (e) {
        var type = $(this).val(),
            setting_options = "#setting-options, .setting-options, div[data-id=setting-options]",
            option_name = 'input.option-name[data-id=option-name][data-name=option-name]',
            option_value = 'input.option-value[data-id=option-value][data-name=option-value]';
        if (type === "radio" || type === "dropdown") {
            $(setting_options).slideDown(500, function () {
                $(this).find(option_name).attr('name', 'option-name[]');
                $(this).find(option_value).attr('name', 'option-value[]');
            });
        } else {
            $(setting_options).slideUp(500, function () {
                $(this).find(option_name + ', ' + option_value).removeAttr('name').val('');
                $('.setting-option-group.option-group').each(function (index, ele) {
                    if (index !== 0)
                        $(this).remove();
                });
            });
        }
    });
    $(document).on('click', '[data-dismiss="modal"]', function () {
        var setting_options = "#setting-options, .setting-options, div[data-id=setting-options]",
            option_name = 'input.option-name[data-id=option-name][data-name=option-name]',
            option_value = 'input.option-value[data-id=option-value][data-name=option-value]';
        $(setting_options).slideUp(500, function () {
            $(this).find(option_name + ', ' + option_value).removeAttr('name').val('');
            $('.setting-option-group.option-group').each(function (index, ele) {
                if (index !== 0)
                    $(this).remove();
            });
            $('#setting-type').val('text_box');
        });
    });

    $(document).on('click', '.add-options, #add-options', function () {
        //        var new_option = $('.option-group.setting-option-group:first').clone(true, true);
        $('#option-wrappers.option-wrappers').append($('.option-group.setting-option-group:first').clone(true, true));
        $('.option-group.setting-option-group:last').find('input').val('');
        $('.option-group.setting-option-group:last').find('input:first').val('').trigger('focus');
    });
    $(document).on('click', '.remove-options', function () {
        var options = $('.option-group.setting-option-group').length;
        if (options > 1) {
            $(this).parents('.option-group.setting-option-group').remove();
            toastr.success('Option deleted successfully', "Deleted!");
        } else {
            toastr.warning('Cannot delete option...', "Warning!");
        }
    });

    var ad_on_tab = '.option-group.setting-option-group:last .option-value[data-id=option-value]';
    $(document).on('keydown', ad_on_tab, function (e) {
        if (e.which === 9) {
            $('#add-options.add-options').trigger('click');
            $('.option-group.setting-option-group:last .option-name[data-id=option-name]').find('input:first').val('').trigger('focus');
        }
    });



    jQuery('#option-sorting').sortable({
        connectWith: '#option-wrappers',
        items: '.setting-option-group',
        opacity: .75,
        handle: '.draggable-handler',
        //        placeholder: 'draggable-placeholder',
        tolerance: 'pointer',
        start: function (e, ui) {
            ui.placeholder.css({
                'height': ui.item.outerHeight(),
                'margin-bottom': ui.item.css('margin-bottom')
            });
        }
    });


    /*
     * ------------------------------------------------------------------------------------------------------------------
     *                                          Validate Add Setting Form
     * ------------------------------------------------------------------------------------------------------------------
     */
    $(document).on('click', '.save_setting_btn#save_setting_btn', function () {
        var key = $('.setting-key[name=setting-key]').val(), name = $('.setting-name[name=setting-name]').val();
        if (key !== '') {
            if (name !== '') {
                $('#add_new_setting').submit();
            } else {
                $('.setting-name[name=setting-name]').parents('div.form-group').addClass('has-error');
            }
        } else {
            $('.setting-key[name=setting-key]').parents('div.form-group').addClass('has-error');
        }
    });
    $(document).on('keyup blur', '.setting-name[name=setting-name], .setting-key[name=setting-key]', function () {
        if ($(this).val() === '') {
            $(this).parents('div.form-group').removeClass('has-success').addClass('has-error');
        } else {
            $(this).parents('div.form-group').removeClass('has-error').addClass('has-success');
        }
    });
    /*
     * Delete Setting
     */
    $(document).on('click', '.setting-trash', function () {
        var id = $(this).attr('data-id'), key = $(this).attr('data-key'), token = window.Laravel.csrfToken;
        var data = {
            _token: token,
            id: id,
            key: key,
            "setting-delete": 'yes'
        };
        $.post(window.location, data, function (data) {
            if (data.status === 'ok') {
                window.location.reload();
            }
        })
    });




    /*
     * testing
     */



});

/*
 * Function Declarations
 */

$.fn.extend({
    previewImage: function (o) {
        this.on('change', function () {
            var options = $.extend({ 'class': 'img-responsive', id: '', height: '200', width: 'auto', alt: '', wrapInto: '#' + $(this).attr('data-preview') }, o);
            
            if($(this).attr('data-width')){
                options.width = $(this).attr('data-width');
            }
            if($(this).attr('data-height')){
                options.height = $(this).attr('data-height');
            }
            $(options.wrapInto)
                //Setting up img wrapper height to prevent toggle div height
                .css('height', $(options.wrapInto).children('img').height() + 'px')
                .html('');
            if (typeof (FileReader) !== 'undefined') {
                for (var i in this.files) {
                    if (typeof this.files[i] === 'object' && this.files[i].type === 'image/jpeg' || this.files[i].type === 'image/png' || this.files[i].type === 'image/gif' || this.files[i].type === 'image/svg' || this.files[i].type === 'image/jpg') {
                        var image = new FileReader();
                        image.onload = function (e) {
                            $('<img/>', {
                                src: e.target.result, class: options.class, width: options.width, height: options.height, alt: options.alt, id: options.id
                            }).appendTo(options.wrapInto);
                        };
                        image.readAsDataURL(this.files[i]);
                    }
                }
            }
        });
    }
});



//ripple_functions
//function setImageValue(url) {
//    $('.mce-btn.mce-open').parent().find('.mce-textbox').val(url);
//}


//    $.ajaxSetup({
//        headers: {
//            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//        }
//    });
//
//$(document).on('click', '#new-ripple-setting', function () {
//    $('.sticky-form-body').fadeIn(100);
//    $('.sticky-form-wrapper').addClass('open');
//    $('.sticky-btn-close').show();
//});
//$(document).on('click', '#close-form-wrapper', function () {
//    $('.sticky-btn-close').hide();
//    $('.sticky-form-body').fadeOut(100);
//    $('.sticky-form-wrapper').removeClass('open');
//
//});

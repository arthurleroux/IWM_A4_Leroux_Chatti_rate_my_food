
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function () {
    // Create restaurant
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                console.log(input.files);
                $('#restaurant_img_tag').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

    $("#restaurant_img").change(function(){
        readURL(this);
    });

    // Add new picture
    function addPicture(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                console.log(input.files);

                $.ajax({
                    url: "/restaurant/add_picture",
                    type: "POST",
                    data: {title: 'title', body: 'body', published_at: 'published_at'}
                }).done(function() {
                    console.log('success');
                }).fail(function() {
                    alert( "error" );
                });

                $('.all__pictures').append('<div class="col-md-4"><img src="' + e.target.result + '" id="restaurant_img_tag" class="img-responsive"/></div>');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    var $fileInput = $('.file-input');
    var $droparea = $('.file-drop-area');

    $($fileInput).change(function(){
        addPicture(this);
    });

// highlight drag area
    $fileInput.on('dragenter focus click', function() {
        $droparea.addClass('is-active');
    });

// back to normal state
    $fileInput.on('dragleave blur drop', function() {
        $droparea.removeClass('is-active');
    });

// change inner text
    $fileInput.on('change', function() {
        var filesCount = $(this)[0].files.length;
        var $textContainer = $(this).prev('.js-set-number');

        if (filesCount === 1) {
            // if single file then show file name
            $textContainer.text($(this).val().split('\\').pop());
        } else {
            // otherwise show number of files
            $textContainer.text(filesCount + ' files selected');
        }
    });

    // initialize input widgets first
    $('#opening__time .time_start').timepicker({
        'showDuration': true,
        'scrollDefault': '10:00',
        'timeFormat': 'H:i'
    });

    $('#opening__time .time_end').timepicker({
        'showDuration': true,
        'scrollDefault': '18:00',
        'timeFormat': 'H:i'
    });

});

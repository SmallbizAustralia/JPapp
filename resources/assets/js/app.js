
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$('input[type="checkbox"].square-green, input[type="radio"].square-green').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass   : 'iradio_square-green'
})

$('.textarea').wysihtml5({
    toolbar: {
        'image': false,
        'link': false
    }
});
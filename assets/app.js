/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import 'select2/dist/js/select2'
import 'jquery'
import 'bootstrap/dist/js/bootstrap'
import '@popperjs/core/dist/cjs/popper'

$('select').select2()

let $contactButton = $('#contactButton')
$contactButton.click(e => {
    e.preventDefault();
    $('#contactForm').slideDown();
    $contactButton.slideUp();
})
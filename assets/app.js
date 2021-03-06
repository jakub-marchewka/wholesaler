/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
// app.js

const $ = require('jquery');
global.$ = global.jQuery = $;
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

import './js/admin/file.js';
import './js/admin/category.js';
import './js/admin/vat.js';
import './js/admin/product.js';
import './js/admin/delivery.js';

import './js/shop/subscribe.js';
import './js/shop/cartAdd.js';
require('./js/shop/offerQuestion');

require('./js/user/changePassword.js');
require('./js/user/questions.js');
require('./js/user/changeEmail.js');
require('./js/user/apiToken.js')
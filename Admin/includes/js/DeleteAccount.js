jQuery(document).ready(function ($) {

    $('form#delete_account').submit(function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();
        
       console.log(email);
    });
});
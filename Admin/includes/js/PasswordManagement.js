jQuery(document).ready(function ($) {
    function findAuthenticationCredentials(email) {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'findAuthenticationCredentials',
                email: email
            },
            success: function (response) {
                const id = response.data.id;
                const email = response.data.email;
                const password = response.data.password;
                const activation_code = response.data.activation_code;
                const confirmation_code = response.data.confirmation_code;
                const provider_given_id = response.data.provider_given_id;
                const phone = response.data.phone;

                $('.account-ids #account_id').text(id);
                $('.account-ids #provider_given_id').text(provider_given_id);
                $('.account-email #account_email').text(email);
                $('.password #password').text(password);
                $('.account-codes #activation_code').text(activation_code);
                $('.account-codes #confirmation_code').text(confirmation_code);
                $('.phone #phone').text(phone);

                if (password.startsWith('$P')) {
                    displayMessage('error', 'Send password recovery email. This account password should be updated for compatability concerns.');
                }
            },
            error: function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;
                displayMessage(status, errorMessage);
            }
        });
    }

    $('form#find_auth').submit(function (event) {
        event.preventDefault();

        const email = $('#password_management input[name="email"]#email').val();

        findAuthenticationCredentials(email);
    });

    $('form#recover_email').submit(function (event) {
        event.preventDefault();

        const email = $('#password_management input[name="email"]#email').val();

        $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'recoverPassword',
                email: email
            },
            success: function (response) {
                displayMessage('success', response.data);
            },
            error: function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;
                displayMessage(status, errorMessage);
            }
        });
    });
});
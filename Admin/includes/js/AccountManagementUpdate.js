jQuery(document).ready(function ($) {

    $('form#subscription_email').submit(function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();

        $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'subscriptionEmail',
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

    $('form#recover_email').submit(function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();

        $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'forgotPassword',
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

    $('#lock_account #lock_btn').on('click', function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();
        const password = $('#account #password').text();

        $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'lockAccount',
                email: email,
                password: password
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

    $('#lock_account #unlock_btn').on('click', function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();
        const userActivationCode = $('#account #user_activation_code').text();

        $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'unlockAccount',
                email: email,
                userActivationCode: userActivationCode
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

    $('#enable_account #enable_btn').on('click', function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();
        const userActivationCode = $('#account #user_activation_code').text();

        $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'enableAccount',
                email: email,
                userActivationCode: userActivationCode
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

    $('#enable_account #disable_btn').on('click', function (event) {
        event.preventDefault();

        const email = $('#find_account input[name="email"]#email').val();
        const password = $('#account #password').text();

        $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'disableAccount',
                email: email,
                password: password
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

    $('#account_management #lock_account #lock_btn').css('display', 'block');
    $('#account_management #lock_account #unlock_btn').css('display', 'block');
    $('#account_management #enable_account #disable_btn').css('display', 'block');
    $('#account_management #enable_account #enable_btn').css('display', 'block');
    $('#account_management #delete_account').css('display', 'flex');

    // $('#account_management').on('change', function () {
    //     var unlocked = $('#lock_account h4#locked').text();
    //     console.log(unlocked);

    //     if (unlocked) {
    //         $('#account_management #lock_account #lock_btn').css('display', 'block');
    //     } else {
    //         $('#account_management #lock_account #unlock_btn').css('display', 'block');
    //     }

    //     var enabled = $('#account_management #enabled').text();
    //     console.log(enabled);
    //     if (enabled) {
    //         $('#account_management #enable_account #disable_btn').css('display', 'block');
    //     } else {
    //         $('#account_management #enable_account #enable_btn').css('display', 'block');
    //     }

    //     if (unlocked == false && enabled == false) {
    //         $('#account_management #delete_account').css('display', 'flex');
    //     }
    // });
});
jQuery(document).ready(function ($) {
    function createAccount(email, username, password, nicename, nickname, firstname, lastname, phone, roles) {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'createAccount',
                email: email,
                username: username,
                password: password,
                nicename: nicename,
                nickname: nickname,
                firstname: firstname,
                lastname: lastname,
                phone: phone,
                roles: roles
            }
        })
            .done(function (response) {
                const id = response.data.id;
                const email = response.data.email;
                const joined = response.data.joined;

                const message = `Account has been created with the email ${email} successfully. At this time ${joined} the account was given the ID#${id}.`;

                displayMessage('success', message);
            })
            .fail(function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;
                displayMessage(status, errorMessage);
            });
    }

    $('#role_select_add').on('change', () => {
        var role = $('#role_select_add').val();
        console.log(role);
    });

    $('form#create_account').submit(function (event) {
        event.preventDefault();

        const email = $('#create_account input[name="email"]').val();
        const username = $('#create_account input[name="username"]').val();
        const password = $('#create_account input[name="password"]').val();
        const nicename = $('#create_account input[name="nicename"]').val();
        const nickname = $('#create_account input[name="nickname"]').val();
        const firstname = $('#create_account input[name="firstname"]').val();
        const lastname = $('#create_account input[name="lastname"]').val();
        const phone = $('#create_account input[name="phone"]').val();
        const roles = $('#create_account #role_select_add').val();

        createAccount(email, username, password, nicename, nickname, firstname, lastname, phone, roles);
    });
});

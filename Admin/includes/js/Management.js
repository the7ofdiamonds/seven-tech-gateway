jQuery(document).ready(function ($) {
    function createAccount(email, username, password, nicename, nickname, firstname, lastname, phone, role, confirmationCode) {
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
                role: role,
                confirmationCode: confirmationCode``
            }
        })
            .done(function (response) {
                var fullname = `${response.data['firstname']} ${response.data['lastname']}`;
                console.log(response.data);
                $('#user #user_id').text(response.data['id']);
                $('#user #full_name').text(fullname);
                $('#user #username').text(response.data['username']);
                $('#user #nicename').text(response.data['nicename']);

                $('#user #roles_row').empty();
                $.each(response.data['roles'], function (index, role) {
                    var roleTag = $('<h3>', {
                        text: role.display_name
                    });
                    $('#user #roles_row').append(roleTag);
                });

                $('#user #email').text(response.data['email']);

                $('#role_select_remove').empty();

                $.each(response.data['roles'], function (index, role) {
                    var option = $('<option>', {
                        value: role.name,
                        'data-display-name': role.display_name,
                        text: role.display_name + ' (' + role.name + ')'
                    });
                    $('#role_select_remove').append(option);
                });
            })
            .fail(function (xhr, status, error) {
                console.error('Failed to fetch user data:', error);
            });
    }

    $('form#create_account').submit(function (event) {
        event.preventDefault();

        var email = $('#create_account input[name="email"]').val();
        var username = $('#create_account input[name="username"]').val();
        var password = $('#create_account input[name="password"]').val();
        var nicename = $('#create_account input[name="nicename"]').val();
        var nickname = $('#create_account input[name="nickname"]').val();
        var firstname = $('#create_account input[name="firstname"]').val();
        var lastname = $('#create_account input[name="lastname"]').val();
        var phone = $('#create_account input[name="phone"]').val();
        var role = $('#create_account input[name="role"]').val();
        var confirmationCode = $('#create_account input[name="confirmationCode"]').val();

        createAccount(email, username, password, nicename, nickname, firstname, lastname, phone, role, confirmationCode);
    });
});

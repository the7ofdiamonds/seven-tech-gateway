jQuery(document).ready(function ($) {
    function createAccount(email, username, password, nicename, nickname, firstname, lastname, phone, role) {
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
                role: role
            }
        })
            .done(function (response) {
                const fullname = `${response.data['firstname']} ${response.data['lastname']}`;
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

        const email = $('#create_account input[name="email"]').val();
        const username = $('#create_account input[name="username"]').val();
        const password = $('#create_account input[name="password"]').val();
        const nicename = $('#create_account input[name="nicename"]').val();
        const nickname = $('#create_account input[name="nickname"]').val();
        const firstname = $('#create_account input[name="firstname"]').val();
        const lastname = $('#create_account input[name="lastname"]').val();
        const phone = $('#create_account input[name="phone"]').val();
        const role = $('#create_account #role_select_add').val();
console.log(role);
        createAccount(email, username, password, nicename, nickname, firstname, lastname, phone, role);
    });
});

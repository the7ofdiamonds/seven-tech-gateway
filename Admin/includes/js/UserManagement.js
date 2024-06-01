jQuery(document).ready(function ($) {
    $("#options button#find_user").on('click', () => {
        $("#user_management div#user").css('display', 'flex');
        $("form#change_nicename").css('display', 'none');
        $("form#add_user_role").css('display', 'none');
        $("form#remove_user_role").css('display', 'none');
        $("form#recover_email").css('display', 'none');
    });

    $("#options button#update_user").on('click', () => {
        $("#user_management div#user").css('display', 'none');
        $("form#change_nicename").css('display', 'flex');
        $("form#add_user_role").css('display', 'flex');
        $("form#remove_user_role").css('display', 'flex');
        $("form#recover_email").css('display', 'flex');
    });

    function getUser(email) {
        return $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'getUser',
                email: email
            }
        })
            .done(function (response) {
                var fullname = `${response.data['firstname']} ${response.data['lastname']}`;

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

                $('#remove_user_role #role_select_remove').empty();

                $.each(response.data['roles'], function (index, role) {
                    var option = $('<option>', {
                        value: role.name,
                        'data-display-name': role.display_name,
                        text: role.display_name + ' (' + role.name + ')'
                    });
                    $('#remove_user_role #role_select_remove').append(option);
                });
            })
            .fail(function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;

                displayMessage(status, errorMessage);
            });
    }

    $('form#find_user').submit(function (event) {
        event.preventDefault();

        var email = $('#find_user input[name="email"]').val();

        getUser(email);
    });

    $('#change_nicename').submit(function (event) {
        event.preventDefault();

        const id = $('#user #user_id').text();
        const nicename = $('#change_nicename #nicename').val();
        const email = $('#user #email').text();

        if ((id !== '' || id !== undefined) && (nicename !== '' || nicename !== undefined) && (email !== '' || email !== undefined)) {
            $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'changeUserNicename',
                    id: id,
                    nicename: nicename
                },
                success: function (response) {
                    console.log(response.data);
                    getUser(email);

                    displayMessage('success', response.data);
                },
                error: function (xhr, status, error) {
                    const errorMessage = `${error}: ${xhr.responseJSON.data}`;

                    displayMessage(status, errorMessage);
                }
            });
        } else {
            console.error('ID, Nicename and Email are required.');
        }
    });

    $('form#add_user_role').submit(function (event) {
        event.preventDefault();

        const id = $('#user #user_id').text();
        const role = $('#add_user_role #role_select_add').val();
        const displayName = $('#add_user_role #display_name_add').val();
        const email = $('#user #email').text();

        jQuery.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'addUserRole',
                id: id,
                added_role: role,
                display_name_added: displayName
            },
            success: function (response) {
                getUser(email);

                displayMessage('success', response.data);
            },
            error: function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;

                displayMessage(status, errorMessage);
            }
        });
    });

    $('form#remove_user_role').submit(function (event) {
        event.preventDefault();

        const id = $('#user #user_id').text();
        const role = $('#remove_user_role #role_select_remove').val();
        const displayName = $('#remove_user_role #display_name_remove').val();
        const email = $('#user #email').text();

        jQuery.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'removeUserRole',
                id: id,
                remove_role: role,
                display_name_remove: displayName
            },
            success: function (response) {
                getUser(email);

                displayMessage('success', response.data);
            },
            error: function (xhr, status, error) {
                const errorMessage = `${error}: ${xhr.responseJSON.data}`;

                displayMessage(status, errorMessage);
            }
        });
    });
});

jQuery(document).ready(function ($) {
    $("#options button#find_user").on('click', () => {
        $("#user_management div#user_management_update").css('display', 'none');
        $("#user_management div#user_management_role").css('display', 'none');
    });

    $("#options button#update_user").on('click', () => {
        $("#user_management div#user_management_update").css('display', 'flex');
        $("#user_management div#user_management_role").css('display', 'none');
    });

    $("#options button#user_role").on('click', () => {
        $("#user_management div#user_management_update").css('display', 'none');
        $("#user_management div#user_management_role").css('display', 'flex');
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

                $('#user_details #user_id').text(response.data['id']);
                $('#user_details #full_name').text(fullname);
                $('#user_details #username').text(response.data['username']);
                $('#user_details #nicename').text(response.data['nicename']);
                $('#user_details #phone').text(response.data['phone']);

                $('#user_details #roles_row').empty();
                $.each(response.data['roles'], function (index, role) {
                    var roleTag = $('<h3>', {
                        text: role.display_name
                    });
                    $('#user_details #roles_row').append(roleTag);
                });

                $('#user_details #email').text(response.data['email']);

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

    $('form#add_user_role').submit(function (event) {
        event.preventDefault();

        const id = $('#user_details #user_id').text();
        const role = $('#add_user_role #role_select_add').val();
        const displayName = $('#add_user_role #display_name_add').val();
        const email = $('#user_details #email').text();

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

        const id = $('#user_details #user_id').text();
        const role = $('#remove_user_role #role_select_remove').val();
        const displayName = $('#remove_user_role #display_name_remove').val();
        const email = $('#user_details #email').text();

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

    $('#change_username').submit(function (event) {
        event.preventDefault();

        const email = $('#user_details #email').text();
        const username = $('#change_username #username').val();
        
        if ((username !== '' || username !== undefined) && (email !== '' || email !== undefined)) {
            $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'changeUsername',
                    email: email,
                    username: username
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
        } else {
            displayMessage('error', 'ID, Username and Email are required.');
        }
    });

    $('#change_nicename').submit(function (event) {
        event.preventDefault();

        const email = $('#user_details #email').text();
        const nicename = $('#change_nicename #nicename').val();

        if ((nicename !== '' || nicename !== undefined) && (email !== '' || email !== undefined)) {
            $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'changeNicename',
                    email: email,
                    nicename: nicename
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
        } else {
            displayMessage('error', 'ID, Nicename and Email are required.');
        }
    });

    $('#change_nickname').submit(function (event) {
        event.preventDefault();

        const email = $('#user_details #email').text();
        const nickname = $('#change_nickname #nickname').val();

        if ((nickname !== '' || nickname !== undefined) && (email !== '' || email !== undefined)) {
            $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'changeNickname',
                    email: email,
                    nickname: nickname
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
        } else {
            displayMessage('error', 'ID, Nickname and Email are required.');
        }
    });

    $('#change_firstname').submit(function (event) {
        event.preventDefault();

        const email = $('#user_details #email').text();
        const firstname = $('#change_firstname #firstname').val();

        if ((firstname !== '' || firstname !== undefined) && (email !== '' || email !== undefined)) {
            $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'changeFirstName',
                    email: email,
                    firstname: firstname
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
        } else {
            displayMessage('error', 'ID, First Name and Email are required.');
        }
    });

    $('#change_lastname').submit(function (event) {
        event.preventDefault();

        const email = $('#user_details #email').text();
        const lastname = $('#change_lastname #lastname').val();

        if ((lastname !== '' || lastname !== undefined) && (email !== '' || email !== undefined)) {
            $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'changeLastName',
                    email: email,
                    lastname: lastname
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
        } else {
            displayMessage('error', 'ID, Last Name and Email are required.');
        }
    });

    $('#change_phone').submit(function (event) {
        event.preventDefault();

        const email = $('#user_details #email').text();
        const phone = $('#change_phone #phone').val();

        if ((phone !== '' || phone !== undefined) && (email !== '' || email !== undefined)) {
            $.ajax({
                type: 'POST',
                url: 'admin-ajax.php',
                data: {
                    action: 'changePhoneNumber',
                    email: email,
                    phone: phone
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
        } else {
            displayMessage('error', 'ID, Last Name and Email are required.');
        }
    });
});

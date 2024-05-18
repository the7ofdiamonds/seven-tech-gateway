jQuery(document).ready(function($) {
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
            .done(function(response) {
                var fullname = `${response.data['firstname']} ${response.data['lastname']}`;

                $('#user #user_id').text(response.data['id']);
                $('#user #full_name').text(fullname);
                $('#user #username').text(response.data['username']);
                $('#user #nicename').text(response.data['nicename']);

                $('#user #roles_row').empty();
                $.each(response.data['roles'], function(index, role) {
                    var roleTag = $('<h3>', {
                        text: role.display_name
                    });
                    $('#user #roles_row').append(roleTag);
                });

                $('#user #email').text(response.data['email']);

                $('#role_select_remove').empty();

                $.each(response.data['roles'], function(index, role) {
                    var option = $('<option>', {
                        value: role.name,
                        'data-display-name': role.display_name,
                        text: role.display_name + ' (' + role.name + ')'
                    });
                    $('#role_select_remove').append(option);
                });
            })
            .fail(function(xhr, status, error) {
                console.error('Failed to fetch user data:', error);
            });
    }

    $('form#find_user').submit(function(event) {
        event.preventDefault();

        var email = $('#find_user input[name="email"]').val();

        getUser(email);
    });

    $('form#recover_email').submit(function(event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'forgotPassword',
                email: email
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', error);
            }
        });
    });

    $('#change_nicename').submit(function(event) {
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
                success: function(response) {
                    console.log(response.data);
                    getUser(email);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX request failed:', error);
                }
            });
        } else {
            console.error('ID, Nicename and Email are required.');
        }
    });

    $('form#add_user_role').submit(function(event) {
        event.preventDefault();

        const id = $('#user input[name="user_id"]#user_id').val();
        const role = $('#add_user_role #role_select_add').val();
        const displayName = $('#add_user_role #display_name_add').val();
        const email = $('#user input[name="email"]#email').val();

        jQuery.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'addUserRole',
                id: id,
                added_role: role,
                display_name_added: displayName
            },
            success: function(response) {
                console.log(response);
                getUser(email);

            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', error);
            }
        });
    });

    $('form#remove_user_role').submit(function(event) {
        event.preventDefault();

        const id = $('#user input[name="user_id"]#user_id').val();
        const role = $('#role_select_remove').val();
        const displayName = $('#display_name_remove').val();
        const email = $('#user input[name="email"]#email').val();

        jQuery.ajax({
            type: 'POST',
            url: 'admin-ajax.php',
            data: {
                action: 'removeUserRole',
                id: id,
                remove_role: role,
                display_name_remove: displayName
            },
            success: function(response) {
                console.log(response);
                getUser(email);

            },
            error: function(xhr, status, error) {
                console.error('AJAX request failed:', error);
            }
        });
    });
});

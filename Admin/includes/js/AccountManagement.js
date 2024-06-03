jQuery(document).ready(function ($) {
    $("#options button#create_account").on('click', () => {
        $("form#create_account").css('display', 'flex');
        $("form#find_account").css('display', 'none');
        $("div#account_details").css('display', 'none');
        $("div#account_management_update").css('display', 'none');
        $("div#account_management_delete").css('display', 'none');
    });

    $("#options button#find_account").on('click', () => {
        $("form#create_account").css('display', 'none');
        $("form#find_account").css('display', 'flex');
        $("div#account_details").css('display', 'flex');
        $("div#account_management_update").css('display', 'none');
        $("div#account_management_delete").css('display', 'none');
    });

    $("#options button#update_account").on('click', () => {
        $("form#create_account").css('display', 'none');
        $("form#find_account").css('display', 'flex');
        $("div#account_details").css('display', 'flex');
        $("div#account_management_update").css('display', 'flex');
        $("div#account_management_delete").css('display', 'none');
    });

    $("#options button#delete_account").on('click', () => {
        $("form#create_account").css('display', 'none');
        $("form#find_account").css('display', 'flex');
        $("div#account_details").css('display', 'flex');
        $("div#account_management_update").css('display', 'none');
        $("div#account_management_delete").css('display', 'flex');
    });
});

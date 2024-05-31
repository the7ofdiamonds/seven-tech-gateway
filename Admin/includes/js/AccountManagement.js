jQuery(document).ready(function ($) {
    $("#options button#create_account").on('click', () => {
        $("#account_management form#create_account").css('display', 'flex');
        $("form#find_account").css('display', 'none');
        $("div#account").css('display', 'none');
        $("form#subscription_email").css('display', 'none');
        $("form#recover_email").css('display', 'none');
        $("form#lock_account").css('display', 'none');
        $("form#enable_account").css('display', 'none');
        $("form#delete_account").css('display', 'none');
    });

    $("#options button#find_account").on('click', () => {
        $("#account_management form#create_account").css('display', 'none');
        $("form#find_account").css('display', 'flex');
        $("div#account").css('display', 'flex');
        $("form#subscription_email").css('display', 'none');
        $("form#recover_email").css('display', 'none');
        $("form#lock_account").css('display', 'none');
        $("form#enable_account").css('display', 'none');
        $("form#delete_account").css('display', 'none');
    });

    $("#options button#update_account").on('click', () => {
        $("#account_management form#create_account").css('display', 'none');
        $("form#find_account").css('display', 'flex');
        $("div#account").css('display', 'none');
        $("form#subscription_email").css('display', 'flex');
        $("form#recover_email").css('display', 'flex');
        $("form#lock_account").css('display', 'flex');
        $("form#enable_account").css('display', 'flex');
        $("form#delete_account").css('display', 'none');
    });

    $("#options button#delete_account").on('click', () => {
        $("#account_management form#create_account").css('display', 'none');
        $("form#find_account").css('display', 'flex');
        $("div#account").css('display', 'none');
        $("form#subscription_email").css('display', 'none');
        $("form#recover_email").css('display', 'none');
        $("form#lock_account").css('display', 'none');
        $("form#enable_account").css('display', 'none');
        $("form#delete_account").css('display', 'flex');
    });
});

jQuery(document).ready(function ($) {
    $("#options button#get_sessions").on('click', () => {
        $("div#session_management_get").css('display', 'flex');
        $("div#session_management_find").css('display', 'none');
        $("div#session_management_configure").css('display', 'none');
    });

    $("#options button#find_session").on('click', () => {
        $("div#session_management_get").css('display', 'none');
        $("div#session_management_find").css('display', 'flex');
        $("div#session_management_configure").css('display', 'none');
    });

    $("#options button#configure_sessions").on('click', () => {
        $("div#session_management_get").css('display', 'none');
        $("div#session_management_find").css('display', 'none');
        $("div#session_management_configure").css('display', 'flex');
    });
});

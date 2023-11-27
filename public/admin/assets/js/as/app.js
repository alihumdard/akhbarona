var as = {};

as.toggleSidebar = function () {
    $(".sidebar").toggleClass('expanded');
};

as.hideNotifications = function () {
    $(".alert-notification").slideUp(600, function () {
        $(this).remove();
    })
};

as.init = function () {

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    $("#sidebar-toggle").click(function () {
        if($('.sidebar').hasClass('expanded')) {
            $('.sidebar').removeClass('expanded');
            $('.content-page').removeClass('expanded');

        } else {
            $('.sidebar').addClass('expanded');
            $('.content-page').addClass('expanded');
        }
    });
    if($('.sidebar').hasClass('expanded')) {
        $('.content-page').addClass('expanded');
    }

    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();

    $(".alert-notification .close").click(as.hideNotifications);

    setTimeout(as.hideNotifications, 3500);

    $("a[data-toggle=loader], button[data-toggle=loader]").click(function () {
        if ($(this).parents('form').valid()) {
            as.btn.loading($(this), $(this).data('loading-text'));
            $(this).parents('form').submit();
        }
    });
};

$(document).ready(as.init);

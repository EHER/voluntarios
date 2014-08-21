require(['jquery', 'mousetrap', 'url-navigation'], function ($, Mousetrap, urlNavigation) {
    Mousetrap.bind('k', function () {
        window.location.search = urlNavigation.nextVoluntarioId(window.location.search);
    });

    Mousetrap.bind('j', function () {
        window.location.search = urlNavigation.previousVoluntarioId(window.location.search);
    });

    Mousetrap.bind(['command+a', 'ctrl+a'], function() {
        $("#message").focus().select();
        return false;
    });
});



require(['mousetrap', 'url-navigation'], function (Mousetrap, urlNavigation) {
    Mousetrap.bind('j', function () {
        window.location.search = urlNavigation.nextVoluntarioId(window.location.search);
    });

    Mousetrap.bind('k', function () {
        window.location.search = urlNavigation.previousVoluntarioId(window.location.search);
    });
});



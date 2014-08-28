require(['mousetrap'], function (Mousetrap) {
    Mousetrap.bind('G', function() {
        window.scrollTo(document.height, document.width);
    });

    Mousetrap.bind('g g', function() {
        window.scrollTo(0, 0);
    });

    Mousetrap.bind('b', function() {
        history.back();
    });

    Mousetrap.bind('g a', function() {
        window.location = '/admin';
    });
});

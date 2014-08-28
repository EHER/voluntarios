require(['keynavigator', 'mousetrap'], function ($, Mousetrap) {
    $('.dropdown').on('show.bs.dropdown', function () {
       $(this).find("a").each(function(index, el) {
            Mousetrap.bind(index.toString(), function() {
                el.click();
            });
        });
    });
});

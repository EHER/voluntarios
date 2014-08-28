require(['jquery', 'mousetrap'], function ($, Mousetrap) {
    Mousetrap.bind('h', function() {
        var $previous;

        $previous = $(".pagination li:first");
        $previous = $("a", $previous);

        if ($previous.length) {
            $previous[0].click();
        }
    });

    Mousetrap.bind('l', function() {
        var $next;

        $next = $(".pagination li:last");
        $next = $("a", $next);

        if ($next.length) {
            $next[0].click();
        }
    });
});

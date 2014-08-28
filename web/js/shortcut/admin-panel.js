require(['keynavigator'], function ($) {
    $("ol.admin-menu li").keynavigator({
      cycle: false,
      keys: {
        k: 'up',
        j: 'down',
        enter: function($el) {
          $el.find("a:first")[0].click();
        }
      }
    });

    $("ol.admin-menu li").first().click();
});

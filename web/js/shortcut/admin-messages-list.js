require(['keynavigator'], function ($) {
    $("ul.message-list li").keynavigator({
      cycle: false,
      keys: {
        k: 'up',
        j: 'down',
        enter: function($el) {
          $el.find("a:first")[0].click();
        }
      }
    });

    $("ul.message-list li").first().click();
});

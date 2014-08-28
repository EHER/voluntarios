require(['keynavigator'], function ($) {
    $("table.table tbody tr").keynavigator({
      cycle: false,
      keys: {
        k: 'up',
        j: 'down',
        m: function($el) {
          $el.find(".dropdown a:first").click();
        }
      }
    });

    $("table.table tbody tr").first().click();
});

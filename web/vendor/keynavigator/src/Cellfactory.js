define(['jquery'], function() {
  'use strict';

  /*
   * Utility for converting a jQuery position to a {cell} object
   */
  var CellFactory = {
    createFrom: function($el) {
      var position = $el.position();

      return {
        pos: {
          left: Math.round(position.left),
          top: Math.round(position.top)
        },

        $el: $el
      };
    }
  };

  return CellFactory;
});

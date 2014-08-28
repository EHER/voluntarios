/*
 * Testcase for the Keynavigator plugin.
 * Needs refactoring.
 */

define(function(require) {

  var $ = require('./../keynavigator');
  
  describe('Keynavigator', function() {

    beforeEach(function() {
      var html = '<ul>' +
                  '<li><a href="#">Option 1</a></li>' +
                  '<li><a href="#">Option 2</a></li>' +
                  '<li><a href="#">Option 3</a></li>' +
               '</ul>';

      $(document.body).html(html);

    });
    
    var createKeyEvent = function(keyCode) {
      return $.Event('keydown', { which: keyCode });
    },

    arrowDownEvent = createKeyEvent(40 /* arrow down */),
    arrowUpEvent = createKeyEvent(38 /* arrow up */);

    describe('Custom settings', function() {

      it('handles bad settings', function() {
        $('ul li').keynavigator('');
        $('ul li').keynavigator('a');
        $('ul li').keynavigator(null);
      });

      it('has a keynavigator property', function() {
        var $nodes = $('ul li').keynavigator();

        expect($nodes.keynavigator).toBeDefined();
      });
    });

    describe('Tabindex', function() {

      it('should set tabindex from submited settings on parent element', function() {
        var $parent = $('ul li').keynavigator({
          tabindex: 10
        }).parent();

        expect($parent.attr('tabindex')).toBe('10');
      });

      it('should set default tabindex on parent element', function() {
        var $parent = $('ul li').keynavigator().parent();

        expect($parent.attr('tabindex')).toBe('-1');
      });

    });

    describe('Navigation', function() {

      it('should handle arrow down', function() {
        // Arrange
        var nodes = $('ul li').keynavigator({
          activeClass: 'activeClass'
        });

        nodes.first().trigger('click');
        // Act    
        nodes.parent().focus().trigger(arrowDownEvent);

        // Assert    
        expect(nodes[1].className).toBe('activeClass');
      });
    });

    describe('DOM manipulation', function() {

      describe('cache is not enabled', function() {
        it('should handle inserted nodes', function() {
          // Arrange
          var $nodes = $('ul li').keynavigator({
            activeClass: 'activeClass',
            useCache: false
          }).parent().append('<li>Row 4</li>');

          expect($('ul li').last().attr('keynavigator-watched')).toBeUndefined();

          $('ul').trigger(arrowDownEvent);

          expect($('ul li').last().attr('keynavigator-watched')).toBe('true');
        });
      });

      describe('cache is enabled', function() {
        it('should not handle inserted nodes', function() {
          // Arrange
          var $nodes = $('ul li').keynavigator({
            activeClass: 'activeClass',
            useCache: true
          }).parent().append('<li>Row 4</li>');

          expect($('ul li').last().attr('keynavigator-watched')).toBeUndefined();

          $('ul').trigger(arrowDownEvent);

          expect($('ul li').last().attr('keynavigator-watched')).toBeUndefined();
        });
      });
    });
  });

});
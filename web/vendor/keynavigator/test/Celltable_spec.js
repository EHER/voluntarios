define(function(require) {

  var CellTable = require('./../src/Celltable'),
      $ = require('jquery');

  beforeEach(function() {
    $(document.body).html(
      '<table>' +
        '<tr><td>Row1</td></tr>' +
        '<tr><td>Row2</td></tr>' +
        '<tr><td>Row3</td></tr>' +
      '</table>'
    );
  });

  describe('Celltable', function() {

    it('builds a celltable', function() {
      var cellTable = new CellTable($('table tr'));

      expect(cellTable.table).toBeDefined();
      expect(cellTable.table.length).toBe(3);
      expect(cellTable.table[0].pos).toBeDefined();
    });

  });

});
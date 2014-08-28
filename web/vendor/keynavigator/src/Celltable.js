define(['./Cellfactory', 'jquery'], function(CellFactory, $) {
  'use strict';
  /*
   * CellTable
   *  - Finds and navigates in cells.
   *
   * @param $nodes - jQuery nodes to build the cell table from.
   *
   * TODO: Refactor!
   */
  var CellTable = function($nodes) {
    this.table = this.buildTable($nodes);
    this.rows = this.buildRows();
    this.columns = this.buildColumns();
  };

  CellTable.prototype = {
    buildTable: function($nodes) {
      return $nodes.map(function() {
        return CellFactory.createFrom($(this));
      });
    },

    buildColumns: function() {
      var columns = {},
          self = this;

      $.each(this.table, function(index, cell) {
        columns[cell.pos.left] = self.getColumnElements(cell);
      });

      return columns;
    },

    buildRows: function() {
      var rows = {},
          self = this;

      $.each(this.table, function(i, cell) {
        rows[cell.pos.top] = self.getRowElements(cell);
      });

      return rows;
    },

    getRowElements: function(compareCell) {
      var self = this;

      return $.map(this.table, function(cell) {
        if (self.isSameRow(cell, compareCell)) {
          return cell;
        }

        return null;
      });
    },

    getColumnElements: function(compareCell) {
      var self = this;

      return $.map(this.table, function(cell) {
        if (self.isSameColumn(cell, compareCell)) {
          return cell;
        }

        return null;
      });
    },

    getCurrent: function($el) {
      var cell = CellFactory.createFrom($el);

      return this.findPosition(
        this.getCell(cell)
      );
    },

    isSameColumn: function(cell, compareCell) {
      if (!compareCell) {
        throw 'cell';
      }

      return cell.pos.left === compareCell.pos.left;
    },

    isSameRow: function(cell, compareCell) {
      return cell.pos.top === compareCell.pos.top;
    },

    isSame: function(cell, compareCell) {
      return this.isSameColumn(cell, compareCell) && this.isSameRow(cell, compareCell);
    },

    getCell: function(cell) {
      var self = this;
      return $.map(this.table, function(compareCell) {
        if (self.isSame(cell, compareCell)) {
          return compareCell;
        }

        return null;
      })[0];
    },

    findIndex: function(array, callback) {
      var index = 0,
          len = array.length;

      for (; index < len; index++) {
        if (callback(array[index])) {
          return index;
        }
      }

      return index;
    },

    findPosition: function(cell) {
      var colCells = this.getColumnElements(cell),
          rowCells = this.getRowElements(cell),

          rowIndex = this.findIndex(colCells, function(colCell) {
            return colCell.pos.top == cell.pos.top;
          }),

          colIndex = this.findIndex(rowCells, function(rowCell) {
            return rowCell.pos.left == cell.pos.left;
          });

      return {
        colIndex: colIndex,
        rowIndex: rowIndex
      };
    }
  };

  return CellTable;
});
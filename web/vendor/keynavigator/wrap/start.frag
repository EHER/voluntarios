/*!
 * Key navigator plugin for jQuery / Zepto.
 *
 * https://github.com/nekman/keynavigator
 */
(function(root, factory) {
  'use strict';
  // CommonJS.
  if (typeof exports === 'object') {
     module.exports = factory(require('jquery'));
  } else if (typeof root.define === 'function' && root.define.amd) {
    // AMD.
    // jQuery 1.7+ registers it self as a AMD module. 
    // If Zepto is used, define jquery and return Zepto eg:
    // 
    //    define('jquery', function() {
    //      return jQuery;
    //    });
    //
    define(['jquery'], factory);
  } else {
    // Assume jQuery or Zepto are loaded from <script> tags.
    factory(root.jQuery || root.Zepto);
  }
}(this, function($) {
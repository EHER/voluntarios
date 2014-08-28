Keynavigator
======

[![Build Status](https://travis-ci.org/nekman/keynavigator.png?branch=master)](https://travis-ci.org/nekman/keynavigator)

Key navigaton plugin for <a href="http://jquery.com">jQuery</a>/<a href="http://zeptojs.com">Zepto</a>.
<br/>
Makes it possible to use arrow keys (or any key) for navigation in eg. `ul` or `table` elements.

###Usage
Include keynavigator.js after having included jQuery or Zepto:
```html
<script src="jquery.js"></script>
<script src="keynavigator.js"></script>
```
Start the keynavigator plugin.
```javascript
$(document).ready(function() {
  $('ul#example li').keynavigator(/* optional settings */);
});  
```

###Documentation and examples
Is available on the project web page - http://nekman.github.io/keynavigator

###License

Licensed under MIT license

Copyright (c) 2013 Nils Ekman

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

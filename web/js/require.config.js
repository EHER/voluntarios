require.config({
    baseUrl: "/vendor",
    paths: {
        "jquery": "//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min",
        "jquery.mask": "jQuery-Mask-Plugin/jquery.mask.min",
        "bootstrap": "//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min"
    },
    shim: {
        "bootstrap":{ deps: ["jquery"] }
    }
});

require(['jquery', 'jquery.mask'], function ($) {
    var masks = ['(00) 00000-0000', '(00) 0000-00009'],
        maskBehavior = function (val) {
            return val.length > 14 ? masks[0] : masks[1];
        }
    ;

    $(".js-phone").mask(maskBehavior, {onKeyPress:
        function(val, e, field, options) {
            field.mask(maskBehavior(val, e, field, options), options);
        }
    });
});

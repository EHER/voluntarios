require.config({
    config: {
         'GA': {
             'id': 'UA-33570679-1'
         }
    },
    baseUrl: "/js",
    paths: {
        "EventEmitter": '../vendor/event-emitter/dist/EventEmitter',
        "GA": '../vendor/requirejs-google-analytics/dist/GoogleAnalytics',
        "bootstrap": "//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min",
        "jquery": "//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min",
        "jquery.mask": "../vendor/jQuery-Mask-Plugin/jquery.mask.min",
        "keynavigator": "../vendor/keynavigator/keynavigator-min",
        "mousetrap": "../vendor/mousetrap/mousetrap.min"
    },
    shim: {
        "bootstrap": { deps: ["jquery"] },
        "keynavigator": { deps: ["jquery"] }
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

require(['GA'], function (GA) {
    GA.ready(function (ga) {
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
    });
});

require(['bootstrap', 'shortcut/global']);

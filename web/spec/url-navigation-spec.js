'use strict';
var assert = require("assert"),
    requirejs = require("requirejs");

requirejs.config({
    baseUrl: 'web/js',
    nodeRequire: require
});


describe('url navigation', function () {
    var urlNavigation;

    before(function (done) {
        requirejs(['url-navigation'], function (UrlNavigation) {
            urlNavigation = UrlNavigation;
            done();
        });
    });

    describe('nextVoluntarioId', function () {
        it('should return query string with next voluntarioId', function () {
            assert.equal('/admin/list?voluntarioId=123', urlNavigation.nextVoluntarioId('/admin/list?voluntarioId=122'));
            assert.equal('/admin/list?voluntarioId=13', urlNavigation.nextVoluntarioId('/admin/list?voluntarioId=12'));
        });

        it('should return same query string when does not have voluntarioId', function () {
            assert.equal('/admin/list', urlNavigation.nextVoluntarioId('/admin/list'));
        });

        it('should return empty query string when is called without parameters', function () {
            assert.equal('', urlNavigation.nextVoluntarioId());
        });
    });

    describe('previousVoluntarioId', function () {
        it('should return query string with previous voluntarioId', function () {
            assert.equal('/admin/list?voluntarioId=121', urlNavigation.previousVoluntarioId('/admin/list?voluntarioId=122'));
            assert.equal('/admin/list?voluntarioId=11', urlNavigation.previousVoluntarioId('/admin/list?voluntarioId=12'));
        });

        it('should return same query string when does not have voluntarioId', function () {
            assert.equal('/admin/list', urlNavigation.previousVoluntarioId('/admin/list'));
        });

        it('should return empty query string when is called without parameters', function () {
            assert.equal('', urlNavigation.previousVoluntarioId());
        });
    });
});

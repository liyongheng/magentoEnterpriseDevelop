var config = {
    paths: {
        'banner': 'js/banner/banner',
    },
    shim: {
        banner: {
            deps: ['jquery']
        }
    }
};

require(['jquery'], function($) {
    'use strict';

    $.noConflict();
});
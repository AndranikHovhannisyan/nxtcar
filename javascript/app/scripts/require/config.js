'use strict';

require.config({
    basUrl: "",
    urlArgs: 'v='+(new Date()).getTime(),
    paths: {
        'jquery': '/app/bower_components/jquery/dist/jquery.min',
        'angular': '/app/bower_components/angular/angular.min',
        'angular-resource': '/app/bower_components/angular-resource/angular-resource.min',
        'angular-animate': '/app/bower_components/angular-animate/angular-animate.min',
        'angucomplete-alt': '/app/bower_components/angucomplete-alt/angucomplete-alt',
        'nanoscroller': '/app/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min',
        'angular-strap': '/app/bower_components/angular-strap/dist/angular-strap.min',
        'angular-strap-tpl': '/app/bower_components/angular-strap/dist/angular-strap.tpl.min',
        /*-------------------------------------------------------------------------------------*/
        'Facebook': '/app/scripts/Facebook/Facebook',
        'Geolocation': '/app/scripts/Geolocation/Geolocation',
        'main': '/bundles/nxtcarmain/js/angular/main',

    },
    shim: {
        'angular': {
            deps: ['jquery'],
            exports: 'angular'
        },
        'jquery': {
            exports: "$"
        },
        'angular-animate': ['angular'],
        'angular-resource': ['angular'],
        'nanoscroller': ['jquery','angular'],
        'angular-strap': ['angular'],
        'angular-strap-tpl': ['angular'],
        //------------------------------------------------------------------//
        'Facebook': ['angular'],
        'Geolocation': ['angular'],
        'main': ['Geolocation','Facebook']
    },
    waitSeconds: 7
});
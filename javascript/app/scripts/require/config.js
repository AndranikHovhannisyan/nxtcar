'use strict';

require.config({
    basUrl: "",
    //urlArgs: 'v='+(new Date()).getTime(),
    paths: {
        'jquery': '/app/bower_components/jquery/dist/jquery.min',
        'jquery-ui': '/app/bower_components/jquery-ui/jquery-ui.min',
        'jquery-datepicker': '/app/bower_components/jquery-ui/ui/datepicker',
        'bootstrap': '/app/bower_components/bootstrap/dist/js/bootstrap.min',
        'angular': '/app/bower_components/angular/angular.min',
        'angular-resource': '/app/bower_components/angular-resource/angular-resource.min',
        'angular-animate': '/app/bower_components/angular-animate/angular-animate.min',
        'angucomplete-alt': '/app/bower_components/angucomplete-alt/angucomplete-alt',
        'nanoscroller': '/app/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min',
        'angular-strap': '/app/bower_components/angular-strap/dist/angular-strap.min',
        'angular-strap-tpl': '/app/bower_components/angular-strap/dist/angular-strap.tpl.min',
        'ui.sortable': '/app/bower_components/angular-ui-sortable/sortable.min',
        /*-------------------------------------------------------------------------------------*/
        'Interpolation': '/app/scripts/Interpolation/Interpolation',
        'Facebook': '/app/scripts/Facebook/Facebook',
        'Geolocation': '/app/scripts/Geolocation/Geolocation',
        'main': '/bundles/nxtcarmain/js/angular/main',
        'MainController': '/bundles/nxtcarmain/js/angular/controllers/MainController',
        'user': '/bundles/nxtcaruser/js/angular/user',
        'userController': '/bundles/nxtcaruser/js/angular/controllers/userController',
        'car': '/bundles/nxtcarmain/js/angular/car',
        'CarController': '/bundles/nxtcarmain/js/angular/controllers/CarController',
        'ride': '/bundles/nxtcarmain/js/angular/ride',
        'RideController': '/bundles/nxtcarmain/js/angular/controllers/RideController',
        'google-map': '/bundles/nxtcarmain/js/angular/directives/google-map'

    },
    shim: {
        'angular': {
            deps: ['jquery'],
            exports: 'angular'
        },
        'jquery': {
            exports: "$"
        },
        'jquery-ui': ['jquery'],
        'jquery-datepicker': ['jquery'],
        'angular-animate': ['angular'],
        'angular-resource': ['angular'],
        'nanoscroller': ['jquery','angular'],
        'angular-strap': ['angular'],
        'angular-strap-tpl': ['angular'],
        'bootstrap': ['angular'],
        'ui.sortable': ['angular','jquery'],
        //------------------------------------------------------------------//
        'Facebook': ['angular'],
        'Interpolation': ['angular'],
        'Geolocation': ['angular'],
        'main': ['Interpolation','bootstrap','angular-animate','Geolocation','Facebook','angular-strap'],
        'MainController': ['main'],
        'user': ['Interpolation','bootstrap','angular-animate','Geolocation','Facebook','angular-strap'],
        'userController': ['angular','user'],
        'car': ['Interpolation','bootstrap','angular-animate','Geolocation','Facebook','angular-strap','angular-resource'],
        'CarController': ['car'],
        'ride': ['jquery-ui','ui.sortable','Interpolation','bootstrap','angular-animate','Geolocation','Facebook','angular-strap','angular-resource'],
        'RideController': ['ride'],
        'google-map': ['ride']
    },
    waitSeconds: 7
});
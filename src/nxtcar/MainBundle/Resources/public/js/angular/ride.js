'use strict';

define([],function(){
    return angular.module("Ride",[
        'Geolocation',
        'Facebook',
        'ngResource',
        'Interpolation',
        'ui.sortable',
        'mgcrea.ngStrap.popover',
        'ngAnimate'])
    .service("RideManager",function($resource){
        return $resource('/api/ride/:where/:what',{},{

        });
    });
})
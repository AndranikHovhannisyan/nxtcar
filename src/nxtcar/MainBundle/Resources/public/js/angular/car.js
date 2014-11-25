'use strict';

define([],function(){
    return angular.module('Car',[
        'Geolocation',
        'Facebook',
        'ngResource',
        'Interpolation',
        'mgcrea.ngStrap.popover',
        'ngAnimate'])
    .service("CarManager",function($resource){
        return $resource("/app_dev.php/api/cars/:where:id/:what",{},{
            getModels: {method: 'GET',isArray: true,params: {what: 'model'}}
        })
    });
})
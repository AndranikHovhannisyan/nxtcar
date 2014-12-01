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
    })
    .directive("currency",function(){
        return {
            restrict: 'A',
            scope: {
                currency: '='
            },
            compile: function(){
                return function(scope,el){
                    scope.$watch('currency',function(d){
                        if(angular.isUndefined(d)){
                            return;
                        }
                        console.log(d,'dd');
                        el.html(d);
                    },true)
                }
            }
        }
    });
})
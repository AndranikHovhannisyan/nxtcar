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
        return $resource("/app.php/api/cars/:where:id/:what",{},{
            getModels: {method: 'GET',isArray: true,params: {what: 'model'}}
        })
    })
    .directive('cloak',function($timeout){
        return {
            restrict: 'C',
            compile: function(el){
                $timeout(function(){
                    el.removeClass('cloak');
                },1);
            }
        }
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
                        el.html(d);
                    },true)
                }
            }
        }
    });
})
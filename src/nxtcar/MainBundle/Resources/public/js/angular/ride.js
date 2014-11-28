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
    })
    .directive("datepicker",function(){
        return {
            restrict: "A",
            scope: true,
            compile: function compileFn(){
                return function linkFn(scope,el){
                    el.datepicker({
                        dateFormat: 'dd/mm/yy',
                        onSelect: function(date){
                            scope.ngModel = date;
                            scope.$apply();
                        }
                    });
                }
            }
        }
    });
})
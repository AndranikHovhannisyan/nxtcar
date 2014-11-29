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
            scope: {
                ngModel: '='
            },
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
    })
    .directive('altDatepicker',function(){
        return {
            restrict: "A",
            scope: {
                ngModel: '=',
                outWeek: "=",
                returnWeek: "="
            },
            compile: function compileFn(){
                return function linkFn(scope,el,attrs){
                    el.datepicker({
                        minDate: 0,
                        dateFormat: 'dd/mm/yy',
                        onSelect: function(date){
                            if(angular.isDefined(attrs.ngModel)){
                                scope.ngModel = date;
                                scope.$apply();
                            }
                        }
                    });

                    scope.$watch('[outWeek,returnWeek]',function(d){
                        if(angular.isUndefined(d[0]) && angular.isUndefined(d[1])){
                            return;
                        }
                        el.datepicker("option","beforeShowDay",function(date){
                            var className = '';
                            if(angular.isDefined(d[0]) && d[0][date.getDay()]){
                                className = 'blue-day';
                            }
                            if(angular.isDefined(d[1]) && d[1][date.getDay()]){
                                className = 'green-day';
                            }
                            if(angular.isDefined(d[0]) && d[0][date.getDay()]
                                && angular.isDefined(d[1]) && d[1][date.getDay()]){
                                className = 'blue-green-day';
                            }
                            return [true,className,null];
                        });
                        el.datepicker('refresh');
                    },true);
                }
            }
        }
    });
})
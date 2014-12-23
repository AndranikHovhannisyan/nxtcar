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
                        dateFormat: 'yy-mm-dd',
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
                returnWeek: "=",
                tripWeek: "="
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

                    scope.$watch('[outWeek,returnWeek,tripWeek]',function(d){
                        if(angular.isUndefined(d[0]) && angular.isUndefined(d[1]) && angular.isUndefined(d[2])){
                            return;
                        }
                        el.datepicker("option","beforeShowDay",function(date){
                            var className = '';
                            if(angular.isDefined(d[2]) && d[2][date.getDay()]){
                                className = 'green-day';
                                return [true,className,null];
                            }
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
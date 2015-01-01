'use strict';

define([],function(){
    return angular.module("main",[
        'Geolocation',
        'Facebook',
        'Interpolation',
        'mgcrea.ngStrap.popover',
        'ngAnimate'])
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
})
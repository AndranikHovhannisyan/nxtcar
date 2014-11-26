'use strict';

define([],function(){
    return angular.module('Ride')
        .directive('googleMap',function(){
            return {
                restrict: 'EA',
                scope: {},
                compile: function compileFn(){
                    return function linkFn(scope,el,attrs){

                    }
                }
            }
        })
})
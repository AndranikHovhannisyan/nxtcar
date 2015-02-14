'use strict';

define([],function(){
    return angular.module('find',[
        'Geolocation',
        'Facebook',
        'ngResource',
        'Interpolation',
        'mgcrea.ngStrap.popover',
        'ngAnimate'])
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
})
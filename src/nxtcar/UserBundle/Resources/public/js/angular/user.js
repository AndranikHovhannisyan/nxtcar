'use strict';

define([],function(){
    return angular.module('user',[
        'Geolocation',
        'Facebook',
        'Interpolation',
        'mgcrea.ngStrap.popover',
        'ngAnimate'])
    .directive('cloak',function($timeout){
        return {
            restrict: 'C',
            compile: function(el){
                $timeout(function(){
                    el.removeClass('cloak');
                },400);
            }
        }
    })
})
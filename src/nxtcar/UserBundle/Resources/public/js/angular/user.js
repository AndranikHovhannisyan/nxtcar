'use strict';

define([],function(){
    return angular.module('user',[
        'Geolocation',
        'Facebook',
        'Interpolation',
        'mgcrea.ngStrap.popover',
        'ngAnimate'])
    .directive('cloak',function(){
        return {
            restrict: 'C',
            compile: function(el){
                el.removeClass('cloak');
            }
        }
    })
})
'use strict';

define([],function(){
    angular.module('Interpolation',[])
        .config(['$interpolateProvider',function($interpolateProvider){
            $interpolateProvider.startSymbol("[[");
            $interpolateProvider.endSymbol("]]");
        }])
})
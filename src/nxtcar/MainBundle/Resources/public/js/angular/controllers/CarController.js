'use strict';

define([],function(){
    return angular.module('Car')
        .controller('CarController',function($scope){
            $scope.$watch('carBrand',function(d){
                console.log(d);
            },true)
        })
})
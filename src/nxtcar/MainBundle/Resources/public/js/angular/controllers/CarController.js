'use strict';

define([],function(){
    return angular.module('Car')
        .controller('CarController',function($scope,CarManager){
            $scope.$watch('carBrand',function(d){
                if(angular.isUndefined(d)){
                    return;
                }
                CarManager.getModels({id: d},function(da){
                    console.log(da);
                })
            },true)
        })
})
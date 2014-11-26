'use strict';

define([],function(){
    return angular.module('Ride')
        .controller('RideController',function($scope){
            $scope.cities = [{name: ""}];

            /*-----------------------------*/
            $scope.removeCity = function(index){
                if(angular.isUndefined(index) || !angular.isNumber(index)) {
                    return;
                }
                $scope.cities.splice(index,1);
            }
        });
})
'use strict';

define([],function(){
    return angular.module('Ride')
        .controller('RideController',function($scope){
            $scope.cities = [{name: ""}];
        });
})
'use strict';

define([],function(){
    return angular.module('Ride')
        .controller('RideController',function($scope){
            $scope.tests = ["hello","test","ppp"];
        });
})
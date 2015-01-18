'use strict';

define([],function(){
    angular.module('main')
        .controller("MainController",function($scope,countries){
            $scope.countries = angular.copy(countries);
            $scope.choosenCountry = $scope.countries.gb;
        });
})
'use strict';

define([],function(){
    angular.module('main')
        .controller("MainController",function($scope,countries){
            $scope.countries = angular.copy(countries);
            $scope.choosenCountry = $scope.countries.gb;

            $scope.$watch('choosenCountry',function(d){
                if(angular.isUndefined(d)){
                    return;
                }
                angular.element('.currency').html(d.currency);
            },true);
            
            console.log(countries);
        });
})
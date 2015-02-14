'use strict';

define([],function(){
    return angular.module('user')
        .controller('userController',function($scope,countries,$filter){
            $scope.countries = angular.copy(countries);
            $scope.choosenCountry = $scope.countries.gb;

            $scope.$watch('choosenCountry',function(d){
                if(angular.isUndefined(d)){
                    return;
                }
                angular.element('.currency').html(d.currency);
            },true);

           $scope.convertDateToLocal = function(date){
               var d = date.indexOf('UTC') == -1 ? date + ' UTC' : date;
               return $filter('date')(new Date(d),'MMMM d yyyy HH:mm');
           }
        });
})
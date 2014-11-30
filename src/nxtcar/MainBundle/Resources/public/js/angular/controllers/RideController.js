'use strict';

define([],function(){
    return angular.module('Ride')
        .controller('RideController',function($scope,countries){
            $scope.cities = [{name: ""}];
            $scope.minutes = ['00','10','20','30','40','50'];
            $scope.hours = [];
            $scope.countries = angular.copy(countries);
            $scope.choosenCountry = $scope.countries.gb;


            for(var i = 0; i < 24; i++){
                if(i < 10){
                    $scope.hours.push('0'+i);
                }
                else {
                    $scope.hours.push(''+i);
                }
            }

            $scope.$watch('Ride.Round',function(d){
                angular.element(".date-time .btn-group button").removeClass("active");
                $scope.tripWeek=[];
                $scope.outWeek=[];
                $scope.returnWeek=[];
            },false)
            /*-----------------------------*/
            $scope.$watch('choosenCountry',function(d){
                if(angular.isUndefined(d)){
                    return;
                }
                angular.element('.currency').html(d.currency);
            },true);
            /*---------returnWeek--------------------*/
            $scope.removeCity = function(index){
                if(angular.isUndefined(index) || !angular.isNumber(index)) {
                    return;
                }
                $scope.cities.splice(index,1);
            }
        });
})
'use strict';

define([],function(){
    return angular.module('Ride')
        .controller('RideController',function($scope,countries,$timeout){
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

            $scope.initRide = function(json){
                $scope.places = json;
                $timeout(function(){
                    $scope.Ride.distance = 0;
                    angular.forEach($scope.places,function(v,k){
                        if(k < $scope.places.length-1){
                            $scope.Ride.distance+=google.maps.geometry.spherical.computeDistanceBetween($scope.places[k].location,$scope.places[k+1].location,9500000)/1000;
                        }
                    });
                    console.log($scope);
                },1000);
            }

            /*--------------------------------------*/
            $scope.$watch('Ride.prices',function(d){
                if(angular.isUndefined(d)){
                    return;
                }
                $scope.Ride.WholePrices = 0;
                angular.forEach(d,function(v){
                    if(angular.isNumber(parseFloat(v))){
                        $scope.Ride.WholePrices += parseFloat(v);
                    }
                })
            },true)
            /*--------------------------------------*/
            $scope.$watch('Ride.Round',function(d){
                if(angular.isUndefined(d)){
                    return;
                }
                angular.element(".date-time .btn-group button").removeClass("active");
                $scope.Ride.tripWeek = [];
                $scope.Ride.outWeek = [];
                $scope.Ride.returnWeek = [];
            },false)
            /*---------returnWeek--------------------*/
            $scope.removeCity = function(index){
                if(angular.isUndefined(index) || !angular.isNumber(index)) {
                    return;
                }
                $scope.cities.splice(index,1);
            }
        });
})
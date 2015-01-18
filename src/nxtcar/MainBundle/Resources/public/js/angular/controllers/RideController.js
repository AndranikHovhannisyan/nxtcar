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
                $scope.Ride.places[$scope.Ride.places.length-1].index--;
            }

            /*----------------------------------------*/
            $scope.$watch('Ride.dateRecurringFrom',function(d){
                if(angular.isUndefined(d)){
                    return;
                }
                var date = new Date(d);
                $scope.maxUntilDate = new Date(date.getFullYear(),date.getMonth()+3,date.getDate());
            },false);

            /*----------------------------------------*/
            $scope.$watch('Ride.dateRecurringTo',function(d){
                $scope.dateRecurringMaxDate = angular.isDefined(d) ? d : $scope.maxUntilDate;
            },false);
        })
        .controller("RideController2",function($scope,countries,$timeout){
            $scope.countries = angular.copy(countries);
            $scope.choosenCountry = $scope.countries.gb;
            $scope.isSubmited = false;

            $scope.initRide = function(ride){
                $scope.Ride = angular.fromJson(ride);
                if(angular.isDefined($scope.Ride.departure)){
                    var dt = $scope.Ride.departure.dateFrom.split("/");
                    $scope.dp = (new Date(dt[2],dt[1]-1,dt[0])).toDateString();
                }
                $timeout(function(){
                    $scope.Ride.distance = 0;
                    angular.forEach($scope.Ride.places,function(v,k){
                        if(k < $scope.Ride.places.length-1){
                            $scope.Ride.distance+=google.maps.geometry.spherical.computeDistanceBetween($scope.Ride.places[k].location,$scope.Ride.places[k+1].location,9500000)/1000;
                        }
                    });
                },2000);
            }
            /*--------------------------------------*/
            $scope.submitForm = function($event){
                if($scope.isSubmited){
                    $event.preventDefault();
                }
                $scope.isSubmited = true;
            }
            /*--------------------------------------*/
            $scope.$watch('Ride.places',function(d){
                if(angular.isUndefined(d)){
                    return;
                }
                $scope.Ride.WholePrices = 0;
                angular.forEach(d,function(v){
                    if(angular.isDefined(v.priceToNearestCity) && angular.isNumber(parseFloat(v.priceToNearestCity))){
                        $scope.Ride.WholePrices += parseFloat(v.priceToNearestCity);
                    }
                })
            },true)
        })
        .controller('RideSearchController',function($scope,countries,RideManager){
            $scope.countries = angular.copy(countries);
            $scope.choosenCountry = $scope.countries.gb;
            $scope.sort1 = 1;
            $scope.sort2 = 2;
            $scope.post = {page: 1};

            $scope.definePage = function(dir){
                if(!dir && $scope.post.page > 1){
                    $scope.post.page--;
                    $scope.updateRideList();
                    return;
                }

                if(dir && $scope.post.page < $scope.pagesLimit){
                    $scope.post.page++;
                    $scope.updateRideList();
                    return;
                }
            }

            $scope.updateRideList = function(){
                $scope.post.time = angular.element('.db-slider').val();

                RideManager.search({},$scope.post,function(data){
                    $scope.pagesLimit = Math.ceil(data.count/10);
                    $scope.Rides = data.rides;
                });
            }

            $scope.$watch('post.date+post.requring',function(){
                $scope.updateRideList();
            },true);
        });
})
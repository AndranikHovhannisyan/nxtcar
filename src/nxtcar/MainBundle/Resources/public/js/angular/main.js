'use strict';

define([],function(){
    return angular.module("main",[
        'Geolocation',
        'Facebook',
        'Interpolation',
        'mgcrea.ngStrap.popover',
        'ngAnimate'])
        .directive("currency",function(){
            return {
                restrict: 'A',
                scope: {
                    currency: '='
                },
                compile: function(){
                    return function(scope,el){
                        scope.$watch('currency',function(d){
                            if(angular.isUndefined(d)){
                                return;
                            }
                            el.html(d);
                        },true)
                    }
                }
            }
        })
        .directive('preventDefault', [function () {
            return {
                restrict: 'A',
                scope: false,
                compile: function compileFn(){
                    return function linkFn(scope,el){
                        el.on("keypress",function(e){
                            var code = e.keyCode || e.which;
                            if (code === 13) {
                                e.preventDefault();
                                return false;
                            }
                        });
                    };
                }
            };
        }])
        .directive('googleAutocomplete',function(){
            return {
                restrict: 'EA',
                scope: {
                    place: '='
                },
                compile: function(){
                    return function(scope,el){
                        scope.autocomplete = new google.maps.places.Autocomplete(el[0],{types: ['(cities)']});

                        google.maps.event.addListener(scope.autocomplete, 'place_changed', function(){
                            var place = scope.autocomplete.getPlace();
                            scope.place = {
                                formatted_name: place.formatted_address,
                                location: place.geometry.location,
                                city_name: place.name,
                                placeType: scope.placeType,
                                stopover: true
                            }
                            scope.$apply();
                        })
                    }
                }
            }
        })
})
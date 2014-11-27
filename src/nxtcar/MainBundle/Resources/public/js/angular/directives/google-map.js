'use strict';

define([],function(){
    return angular.module('Ride')
        .directive('googleMap',function(){
            function Initialize(el,zoom){
                var m,data = {};
                data.center = new google.maps.LatLng(54.059388,-1.5);
                data.mapTypeId = google.maps.MapTypeId.ROADMAP;
                data.zoom = zoom;
                m = new google.maps.Map(el,data);
                return m;
            };
            return {
                restrict: 'EA',
                scope: {
                    places: '='
                },
                compile: function compileFn(){
                    return function linkFn(scope,el){
                        scope.places = [];

                        scope.map = Initialize(el[0],5);
                    }
                }
            }
        })
        .directive('googlePlacesAutocomplete',function(){
            var FIRST_PLACE = 1;
            var LAST_PLACE = 2;
            var MIDDLE_PLACE = 3;
            return {
                restrict: 'A',
                scope: {
                    map: '=',
                    places: '=',
                    type: '='
                },
                compile: function(){
                    return function(scope,el,attrs){
                        scope.autocomplete = new google.maps.places.Autocomplete(el[0],{types: ['(cities)']});
                        google.maps.event.addListener(scope.autocomplete, 'place_changed', function(){
                            var place = scope.autocomplete.getPlace();
                            console.log(place);
                        });
                    }
                }
            }
        })
})
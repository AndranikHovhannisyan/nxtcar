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
                    places: '=',
                    map: '='
                },
                compile: function compileFn(){
                    return function linkFn(scope,el){
                        scope.places = [];
                        scope.directionService = new google.maps.DirectionsService();
                        scope.directionsDisplay = new google.maps.DirectionsRenderer();

                        scope.$watch('places',function(d){
                            if(angular.isUndefined(d) || d.length < 2){
                                return;
                            }
                            console.log(d);
                            var request = {
                                origin: d[0].formatted_name,
                                destination: d[d.length-1].formatted_name,
                                travelMode: google.maps.TravelMode.DRIVING
                            };
                            if(d.length > 2){
                                var waypoints = [];
                                var filter = []
                                for(var i = 1; i < d.length-1; i++){
                                    if(filter.indexOf(d[i].formatted_name) === -1){
                                        waypoints.push({
                                            location: d[i].formatted_name,
                                            stopover: true});
                                        filter.push(d[i].formatted_name);
                                    }
                                }
                                request.waypoints = waypoints;
                                request.optimizeWaypoints = true;
                            }
                            scope.directionService.route(request,function(response,status){
                                if (status == google.maps.DirectionsStatus.OK) {
                                    scope.directionsDisplay.setDirections(response);
                                }
                            });
                        },true);

                        scope.map = Initialize(el[0],5);
                        scope.directionsDisplay.setMap(scope.map);
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
                    placeType: '='
                },
                compile: function(){
                    return function(scope,el){
                        scope.autocomplete = new google.maps.places.Autocomplete(el[0],{types: ['(cities)']});

                        google.maps.event.addListener(scope.autocomplete, 'place_changed', function(){
                            var place = scope.autocomplete.getPlace();
                            if(angular.isUndefined(place)){
                                return;
                            }
                            scope.place = {
                                formatted_name: place.formatted_address,
                                address_components: place.address_components,
                                location: place.geometry.location,
                                default_icon: place.icon,
                                city_name: place.name,
                                placeType: scope.placeType,
                                stopover: true
                            }
                            switch (scope.placeType){
                                case FIRST_PLACE:
                                    if(scope.places.length && scope.places[0].placeType !== FIRST_PLACE){
                                        scope.places.splice(0,0,scope.place);
                                    }
                                    else {
                                        scope.places[0] = angular.copy(scope.place);
                                    }
                                    break;
                                case LAST_PLACE:
                                    var index;
                                    if(scope.places.length === 1){
                                        if(scope.places[0].placeType === LAST_PLACE){
                                            index = 0;
                                        }
                                        else {
                                            index = 1;
                                        }
                                    }
                                    else {
                                        if( angular.isDefined(scope.places[scope.places.length-1]) &&
                                            scope.places[scope.places.length-1].placeType === LAST_PLACE){
                                            index = scope.places.length-1;
                                        }
                                        else {
                                            index = scope.places.length;
                                        }
                                    }
                                    scope.places[index] = angular.copy(scope.place);
                                    break;
                                case MIDDLE_PLACE:
                                    scope.places.splice(1,0,scope.place);
                                    break;
                                default:
                            }
                            scope.$apply();
                        });
                    }
                }
            }
        })
})
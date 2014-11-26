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
                scope: {},
                compile: function compileFn(){
                    return function linkFn(scope,el){
                        scope.map = Initialize(el[0],5);
                    }
                }
            }
        })
})
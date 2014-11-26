'use strict';

require(['ride','google-map','RideController'],function(ride){
    angular.bootstrap(angular.element('body'),[ride.name]);
})
'use strict';

require(['ride','RideController'],function(ride){
    angular.bootstrap(angular.element('body'),[ride.name]);
})
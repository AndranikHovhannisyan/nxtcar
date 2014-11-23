'use strict';

require(['car','carController'],function(car){
    angular.bootstrap(angular.element('body'),[car.name]);
})
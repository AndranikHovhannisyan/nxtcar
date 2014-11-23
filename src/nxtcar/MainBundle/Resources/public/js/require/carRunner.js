'use strict';

require(['car','CarController'],function(car){
    angular.bootstrap(angular.element('body'),[car.name]);
})
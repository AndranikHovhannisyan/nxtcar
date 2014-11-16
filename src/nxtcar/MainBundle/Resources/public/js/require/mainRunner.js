'use strict';

require(['main','MainController'],function(main){
    angular.bootstrap(angular.element('body'),[main.name]);
})
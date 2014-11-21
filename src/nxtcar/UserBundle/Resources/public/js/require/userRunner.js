'use strict';

require(['user','userController'],function(user){
    angular.bootstrap(angular.element('body'),[user.name]);
})
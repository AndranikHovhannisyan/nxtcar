'use strict';

angular.module("Facebook",[])
    .config(function(){})
    .run(function(){
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1718483435043743',
                xfbml      : true,
                version    : 'v2.2'
            });
        };
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    })
    .directive("fLike",function(){
        var template = '<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" ' +
            'data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>';
        return {
            restrict: 'EA',
            scope: {},
            template: template
        }
    })
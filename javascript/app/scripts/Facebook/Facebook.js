'use strict';

angular.module("Facebook",[])
    .config(function(){})
    .run(function(){
        FB.init({
            appId: 787685584626074,
            status: true,
            xfbml: true,
            version: 'v2.0'
        });
    })
    .directive("fLike",function(){
        return {
            restrict: 'EA',
            scope: {},
            template: "<div id='fb-root'></div>",
            compile: function compileFn(){
                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=787685584626074&version=v2.0";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
            }
        }
    })
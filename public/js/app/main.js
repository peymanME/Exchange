'use strict';
requirejs.config({
    baseUrl: "js/app",    
    paths: {
        'jquery': '../jquery-3.1.0.min',
        'bootstrap':'bootstrap.min'
    }
});

require([
    'jquery', 
    'exchange',
    './home/home',
    './wallet/wallet'
], function () {   

});







//require.config({
//    baseUrl: "js/app",    
//    paths: {
//        'angular': '../angular.min'
//    },
//    shim: {angular: {
//        exports: "angular"
//        }
//    }
//});
//require([
//    'exchange',
//    './controllers/controllers',
//    './services/services',
//    './directives/directives'
//], function (exchange) {   
//    exchange.init();
//});
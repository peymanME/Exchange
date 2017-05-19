define([
    'jquery',
    'exchange'
],function($, exchange){
    'use strict';
    var elementDefualt = "mainContent";
    var formDefault = "#exchangeForm";
    var setParametersPost = function (url, element = elementDefualt, form = formDefault){
        var parameters = {
            url: url,
            data: $(form).serialize(),
            type:'POST',
            element: element
        };
        exchange.loadPage(parameters);
    };
    return {
//        settingMyWallet: function (url){
//            
//        }
    };
    
    
    

   //exchange.loadPage({url:"hello"});
   // console.log(exchange);
}); 

//(function() { require('./home/home').loginForm('<?= $this->url('home',array('action' => 'login'));?>') })()
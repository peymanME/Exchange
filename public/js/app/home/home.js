define([
    'jquery',
    'exchange'
],function($, exchange){
    'use strict';
    var element = "mainContent";
    var setParametersGet = function (url){
        var parameters = {
            url: url,
            element: element
        };
        exchange.loadPage(parameters);
    };
    var setParametersPost = function (url, form){
        var parameters = {
            url: url,
            data: $(form).serialize(),
            type:'POST',
            element: element
        };
        exchange.loadPage(parameters);
    };
    
   
    return {
        
        exchangeFormSubmit: function (url){            
            var r = confirm("Are you sure you?\nEither OK or Cancel.");
            if (r === true) {
                setParametersPost(url, "#exchangeForm");
            }
        },
        wantToBuy: function (url){
            setParametersGet(url);
        },
        getExchangeData: function (url){
            setParametersGet(url);
        },
        myWallet : function(url){
            setParametersGet(url);
        },
        loginForm : function(url){
            setParametersGet(url);
        },
        registerForm: function (url){
            setParametersGet(url);
        },
        submitLoginForm: function(url){
            setParametersPost(url, "#loginForm");
        },
        submitRegisterForm: function(url){
            setParametersPost(url, "#registerForm");
        },
        submitMyCurrenciesForm : function (url){
            setParametersPost(url, "#currenciesForm");
        },
        changePage : function (url){
            setParametersGet(url);
        }

    };
   //exchange.loadPage({url:"hello"});
   // console.log(exchange);
}); 

//(function() { require('./home/home').loginForm('<?= $this->url('home',array('action' => 'login'));?>') })()
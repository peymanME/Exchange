
define(['jquery'], function($){
    'use strict';
 return {
    loadPage: function(parameters) {
        var url 		= parameters.url;
        var type 		= parameters.type;
        var data 		= parameters.data;
        var element		= "#" + parameters.element;
        var option = {
            url 	: url,
            type 	: type,
            processData : false,
            data	: data,
            success	: function(data){
                getBody(data);	            	
            },
            error	: function (data){
                getBody('There Is ERROR');
            }
        };
        function getBody(data){
            $(element).html(data);
        }
        $.ajax(option);
    }
};

//function ajaxLoadService(parameters){ 
//	
//	var url 		= parameters.url;
//	var type 		= parameters.type;
//	var data 		= parameters.data;
//	var element		= "#" + parameters.element;
//	var isafter		= parameters.isafter;
//	var isappend	= parameters.isappend;
//	var isprepend	= parameters.isprepend;
//	var noFile 		= parameters.noFile;
//	var objElement 	= parameters.objElement;
//	var callFunction= parameters.functionName;
//	
//	var option = {
//			url 		: url,
//			type 		: type,
//			processData	: false,
//			data		: data,
//			success		: function(data){
//   							getBody(data);	            	
//    					},
//    		error		: function (data){
// 							getBody('There Is ERROR');
//    					}
//	};
//	if (noFile === undefined){
//		option.contentType	= false;
//	}
//	var result = $.ajax(option);
//	/*result.done (function (data, jqXHR, textStatus){
//		alert('done');
//		//alert(jqXHR +','+ textStatus);
//		getBody(data);
//	});*/
//	/*result.fail(function (jqXHR, textStatus){
//		//alert('fail');
//		getBody("Failure!!");
//		//alert(jqXHR +','+ textStatus);
//	});*/
//	
//	/*if (noFile){
//		alert('no file');
//	$.ajax({		
//		url: url,
//		type: type,
//        processData:false,
//        data: data,
//        success: function(data){
//        	//alert(data);
//       		getBody(data);	            	
//        },
//        failure: function(){
//     	   alert('Run failure');
//     	   getBody("Failure!!");
//     	   }
//		});
//	}
//	else {
//		alert(' file');
//		$.ajax({		
//			url: url,
//			type: type,
//	        processData:false,
//	        contentType: false,
//	        data: data,
//	        success: function(data){
//	       		getBody(data);	            	
//	        },
//	        failure: function(){
//	     	   alert('Run failure');
//	     	   getBody("Failure!!");
//	     	   }
//			});	
//	}*/
//	function getBody(data){
//		if (element ==='#undefined'){
//			objElement.html(data);
//		}
//		else if (isafter){
//			$(element).after(data);
//		}
//		else if (isappend){
//			$(element).append(data);
//		}
//		else if (isprepend){
//			$(element).prepend(data);
//		}
//		else {
//			$(element).html(data);
//		}
//		
//		if (callFunction){
//			window[callFunction]();
//		}
//	}
//} 

//$.fn.loadPage = function(perameters) {
//    var url;
//    var type;
//    var data;
//    var element;
//    if (perameters!==undefined){
//        url 		= parameters.url;
//        type 		= parameters.type;
//        data 		= parameters.data;
//        element		= "#" + parameters.element;
//    }
//    var option = {
//        url 		: url,
//        type 		: type,
//        processData	: false,
//        data		: data,
//        success		: function(data){
//            getBody(data);	            	
//        },
//        error		: function (data){
//            getBody('There Is ERROR');
//        }
//    };
//    return this.ajax(option);
//};

//return test;

});


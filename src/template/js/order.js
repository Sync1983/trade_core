function order(parent) {
  var order = {};
  
  order.add_new = function(){
    function onLoad(answer){      
      $("#work-table-panel").html(answer.html);
    };
    
    function onError(answer) {      
      main.onAjaxError(answer.error);
    };

    window.main.ajax("/",{action:'order',subaction:'add_new'}, onLoad, onError);    
    return false;
  };
  
  order.delete = function(id){
    function onLoad(answer){      
      $("#work-table-panel").html(answer.html);
    };
    
    function onError(answer) {      
      main.onAjaxError(answer.error);
    };

    window.main.ajax("/",{action:'order',subaction:'delete_order',id:id}, onLoad, onError);    
    return false;
  };
  
  order.sort = function(sort_type) {
    function onLoad(answer){      
      $("#work-table-panel").html(answer.html);
    };
    
    function onError(answer) {      
      main.onAjaxError(answer.error);
    };
    
    var subaction = "";    
    if(sort_type==="name") {
      subaction="sort_by_name";
    } else if(sort_type==="cnt") {
      subaction="sort_by_cnt";
    } 

    window.main.ajax("/",{action:'order',subaction:subaction}, onLoad, onError);    
  };
  
  order.select = function (name){
    function onLoad(answer){      
      $("#order-items").html(answer.html);
    };
    
    function onError(answer) {      
      main.onAjaxError(answer.error);
    };
    
    var subaction = "select_name";
    window.main.ajax("/",{action:'order',subaction:subaction, name:name}, onLoad, onError);    
  };
  
  return order;
};

window.order = order(window);



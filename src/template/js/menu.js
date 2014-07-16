function menu(parent) {
  var menu = {};
  
  menu.load = function(id) {
    
    function onLoad(answer){        
      $("#work-table-panel").html(answer.html);
    };
    
    function onError(answer) {      
      $(".error").html(answer.error);
      $(".error").show(1200,function(){
        $(".error").hide(3000);
      });
    };
    
    window.main.ajax("/",{action:id}, onLoad, onError);    
  };
  
  return menu;
};

window.menu = menu(window);



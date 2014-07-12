function menu(parent) {
  var menu = {};
  
  menu.load = function(id) {
    function onLoad(answer){
      
    };
    
    function onError(answer) {
      
    };
    
    window.main.ajax("/",{action:id}, onLoad, onerror);    
  };
  
  return menu;
};

window.menu = menu(window);



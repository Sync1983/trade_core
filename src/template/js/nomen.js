function nomen(parent) {
  var nomen = {};
  
  nomen.sort = function(sort_type) {
    
    function onLoad(answer){      
      $("#work-table-panel").html(answer.html);
    };
    
    function onError(answer) {      
      $(".error").html(answer.error);
      $(".error").show(1200,function(){
        $(".error").hide(3000);
      });
    };
    
    var subaction = "";    
    if(sort_type==="name") {
      subaction="sort_by_name";
    } else if(sort_type==="cnt") {
      subaction="sort_by_cnt";
    } 

    window.main.ajax("/",{action:'nomen',subaction:subaction}, onLoad, onError);    
  };
  
  nomen.select = function (name){
    function onLoad(answer){      
      $("#nomen-items").html(answer.html);
    };
    
    function onError(answer) {      
      $(".error").html(answer.error);
      $(".error").show(1200,function(){
        $(".error").hide(3000);
      });
    };
    
    var subaction = "select_name";
    window.main.ajax("/",{action:'nomen',subaction:subaction, name:name}, onLoad, onError);    
  }
  
  return nomen;
};

window.nomen = nomen(window);



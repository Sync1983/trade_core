function main(parent) {
  var main = {};
  
  function ajax_on() {    
    $(".shadow-screen").show(100);
    $(".preloader").show(200);
  }
  
  function ajax_off() {
    $(".shadow-screen").hide(50);
    $(".preloader").hide(100);
  }
  
  main.ajax = function(url,params,callback,callback_error) {
    ajax_on();  
    $.ajax({
      type: "POST",
      url: url,
      data: params
    }).done(function(answer){       
      try{
        var answer_parse = JSON.parse(answer);    
      }catch (e) {
        console.log('Ajax Error');
        console.log(e);
        console.log(answer);
        return;
      }
      
      if(answer_parse.error) {
        callback_error(answer_parse);
        return;
      }
      
      if(answer_parse.success === 1) {
        callback(answer_parse);
        return;
      }
    }).always(function () {
      ajax_off();
    });
  };
  
  
  return main;
};

window.main = main(window);



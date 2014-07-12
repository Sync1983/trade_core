function main(parent) {
  var main = {};
  
  function ajax_on() {
    
  }
  
  function ajax_off() {
    
  }
  
  main.ajax = function(url,params,callback,callback_error) {
    ajax_on();  
    $.ajax({
      type: "POST",
      url: url,
      data: params
    }).done(function(answer){    
      console.log(answer);    
      try{
        answer = JSON.parse(answer);    
      }catch (e) {
        console.log('Ajax Error');
        console.log(e);
        console.log(answer);
      } finally {
        return;
      }
    
      if(answer.error) {
        callback_error(answer.erro);
        return;
      }
    
      if(answer.success === 1) {
        callback(answer);
        return;
      }
    }).always(function () {
      ajax_off();
    });
  };
  
  
  return main;
};

window.main = main(window);



function slider_obj() {
  var slider = {};
  
  slider.init = function(container_name){
    var container = $(container_name);
    var width = container.width();
    var height = container.height();    
    var items = [];
    var index = 0;
    var max_index = 0;
    
    var ul = $(container).children("ul")[0];
    var list = $(ul).children('li');
    var num = 0;
    var img;
    var addr;
    
    for(var item = 0; item<list.length;item++) {
        console.log(list[item]);
        img = $(list[item]).children('img:first');
        addr = $(list[item]).children('a:first');
        items[num++] = {src:img.attr('src'),alt:img.attr('alt'),addr:addr.attr('href')};        
      }
    
    max_index = num;
    index = 0;
    
    if(items.length===0)
      return 1;
    
    $(container).html("");
    $(container).html('<a href="'+items[index].addr+'"><img src="'+items[index].src+'" alt="'+items[index].alt+'" width='+width+' height='+height+'></a>');
    setInterval(function(){
      index++;
      if (index>=max_index)
        index = 0;
      $(container).fadeOut(400, function(){
          $(container).html('<a href="'+items[index].addr+'"><img src="'+items[index].src+'" alt="'+items[index].alt+'" width='+width+' height='+height+'></a>');      
          $(container).fadeIn(250);
        });
      },
      7000);
      
    return 1;
  };
  
  return slider;
}

window.slider = slider_obj();



var uname;
var upass;
var uremem;
  
function sendData() {    
  var uname_txt = $(uname).val();
  var upass_txt = $(upass).val();
  var uremem_txt = $(uremem).prop('checked');
  if((!uname_txt)||(!upass_txt))
    return;
  
  $.ajax({
    type: "POST",
    url:'index.php?view=login',
    data: { name: uname_txt,
            pass: upass_txt,
            rmem: uremem_txt}
  }).done(function(answer){    
    console.log(answer);
    
    if(!answer){
      return;
    }
    
    answer = JSON.parse(answer);    
    
    if(answer.error) {
      $("#alert").text(answer.error);
      $("#alert").css('display','block');
      return;
    }
    
    if(answer.success === 1) {
      window.location = "index.php";
      return;
    }
    
  });  
}

window.onload = function() {
  var button  = document.querySelector('button[type="button"]');
  uname   = document.querySelector('input[type="text"]');
  upass   = document.querySelector('input[type="password"]');
  uremem  = document.querySelector('input[type="checkbox"]');
  
  if((!button)||(!uname)||(!upass)||(!uremem)) {
    console.log('page error');
    return;
  }  
  button.addEventListener('click',sendData);
};





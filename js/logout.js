$(document).ready(function(){
     $("#logout").click(function(){
             $.ajax({
                 url:'../../php/logout.php',
                 type:'post',
                 success:function(response){
                     console.log (response)
                     if(response == 1){
                       window.location = "../index.php";
                     }
                 }
             });
         
     });
 });
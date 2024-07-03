
//Check Email Exist
$(document).ready(function(){
     $("#email").focusout(function(){
         var username = $("#email").val().trim();
         if( username != ""){
             $.ajax({
                 url:'../php/checkemailexist.php',
                 type:'post',
                 data:{username:username},
                 success:function(response){
                     var data=JSON.parse(response);
                     if(data.count >= 1 && data.mob==0){
                        document.getElementById("admno").value=data.admno;
                        document.getElementById("yoa").value=data.yoa;
                        document.getElementById("name").value=data.name;
                     }
                     else if(data.count >= 1 && data.mob!=0){
                     showNotification("green","User already registered","bottom","right" ,"bg-red","");
                     document.getElementById("email").value="";
                     document.getElementById("admno").value='';
                     document.getElementById("yoa").value='';
                     document.getElementById("name").value='';}
                   else{
                    showNotification("green","Unable to find email. Contact your teacher","bottom","right" ,"bg-red","");
                    document.getElementById("admno").value='';
                        document.getElementById("yoa").value='';
                        document.getElementById("name").value='';
                        document.getElementById("sbtn").disabled=true;
                   }
                 }
             });
         }
     });
 });
//Update Student Data




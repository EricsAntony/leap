$(document).ready(function(){
     $("#sbtn").click(function(){        
         var email = $("#email").val().trim();
         var mob = $("#mob").val().trim();
         var pwd = $("#pwd").val().trim();
         var phoneno = /^\d{10}$/;
         const mobileNumberPattern = /^[6-9]\d{9}$/;
         
         if (!(mob.match(phoneno))) {
            showNotification("alert-danger", "Mobile number should contain 10 digits", "bottom", "right", "", "");
            return false;
        }
        if(!(mobileNumberPattern.test(mob)))
        {
            
            showNotification("alert-danger", "Enter a valid mobile number", "bottom", "right", "", "");
            return false;
        }
         if(email != '' & mob != '' & pwd != ''){
         if( email != ""){
             $.ajax({
                 url:'../php/signup.php',
                 type:'post',
                 data:{email:email,mob:mob,pwd:pwd},
                 success:function(response){
                     console.log (response);
                
                     if(response == 1){
                        showmsg("Success","Registration Success","success","../pages/index.php");

                     }
                   else{
                    showerror("Sorry","Something Went Wrong","error","../pages/signup.php");
                   }
                 },
                 error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                  }
             });
         }
        }
        else
        {
            showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "");
        }
     });
 });
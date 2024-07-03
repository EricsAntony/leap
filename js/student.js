
$(document).ready(function () {
    $('#dataTables').dataTable();
});


$(document).on('click', '.btn_update_st', function(){  
    var s_id=$(this).data("id1");
     var adm_no=$(this).data("id2");
    var s_name=$(this).data("id3");
    var email=$(this).data("id4");
    var mob1=$(this).data("id5");
    var batch=$(this).data("id6");
    var yoa=$(this).data("id7");
   
    document.getElementById("sid").value=s_id;
    document.getElementById("admno").value=adm_no;
    document.getElementById("sname").value=s_name;
    document.getElementById("semail").value=email;
    document.getElementById("sbatch").value=batch;
    document.getElementById("smob").value=mob1;
    document.getElementById("syoa").value=yoa;
    
}); 

$(document).on('click', '#delbtn_st', function(){  
  var s_id=$(this).data("id1");

  document.getElementById("stid").value=s_id;
}); 


$(document).ready(function(){  
    function fetch_data()  
    {  
         $.ajax({  
              url:"../../php/getstudentdata.php",  
              method:"POST",  
              success:function(data){  
                  
                   $('#live_data').html(data);  
                  
              }  
         });  
    }  
    fetch_data();   

    $("#delstudentconfirm").click(function(){
     var delid=document.getElementById("stid").value;
      
       //debugger
           $.ajax({
               url:'../../php/delstudent.php',
               type:'post',
               data:{ delid:delid },
               success:function(response){
                 fetch_data(); 
                   
              
                   if(response == 1){
                    showNotification("alert-success","Student details removed","bottom","right","","")
                   
                   }
                 else{
                     showNotification("alert-error","Somthing went Wrong","bottom","right","","")
                 }
               },
               error: function (xhr, ajaxOptions, thrownError) {
                  console.log(xhr.status);
                  console.log(thrownError);
                }
           });
       
   });  



    $(document).on('click', '#Updatestudent', function(){  
        //console.log("Update called");
        var hangoutButton = $("#closem");
        hangoutButton.click();
    var s_id= document.getElementById("sid").value;
    var adm_no =document.getElementById("admno").value;
    var s_name  = document.getElementById("sname").value;
    var email = document.getElementById("semail").value;
    var mob1 = document.getElementById("smob").value;
    var batch =document.getElementById("sbatch").value;
    var yoa  = document.getElementById("syoa").value;
    console.log(s_name,email,mob1,batch,yoa);
    

    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var phoneno = /^\d{10}$/;
    var admno = /^\d{4}$/;
    var year = /^[0-9]+$/
    var count = 0;

    if (s_name == '' || email == '' || mob1 == '' ||  adm_no == '' || yoa == '' || batch == '') {
      showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "");
      count = 1;
    }

    if (!s_name?.match(/^[A-Za-z\s]*$/)) {
      showNotification("alert-danger", "Name should contain only alphabets", "bottom", "right", "", "");
      count = 1;
    }


    if (!(email.match(validRegex))) {
      showNotification("alert-danger", "Invalid Email!", "bottom", "right", "", "");
      count = 1;
    }

    if (!(adm_no.match(admno))) {
      showNotification("alert-danger", "Admission number should contain 4 digits", "bottom", "right", "", "");
      count = 1;
    }

    if (!(mob1.match(phoneno))) {
      showNotification("alert-danger", "Mobile number should contain 10 digits", "bottom", "right", "", "");
      count = 1;
    }

      if (!year.test(yoa)) {
        showNotification("alert-danger", "Year of admission should be in numeric", "bottom", "right", "", "");
        count = 1;
      }

      if (yoa.length != 4) {
        showNotification("alert-danger", "Year of admission should contain 4 digits", "bottom", "right", "", "");
        count = 1;
      }
      var current_year = new Date().getFullYear();
      if ((yoa < 2020) || (yoa > current_year)) {
        showNotification("alert-danger", "Year of admission should be between 2020 and the current year", "bottom", "right", "", "");
        count = 1;
      }

if(count == 0){
             $.ajax({  
                  url:"../../php/updatestudent.php",  
                  method:"POST",  
                  data:{s_id:s_id,adm_no:adm_no,s_name:s_name , email:email , mob1:mob1 ,batch:batch,yoa:yoa},  
                  dataType:"text",  
                  success:function(data){ 
                    fetch_data();   
                   console.log(data);
                    if(data==1)
                    showNotification("alert-success","Student detail updated","bottom","right","","");
                    else showNotification("alert-error","Something went wrong","bottom","right","","")
                   
                  }  
             }); 
            } 
       
   });
  }); 
$('#s_sendmessage').on('click', function() {
    console.log("called add ass");       
    var c_id =  $("#s_cid").val().trim();
    var topic = $("#s_title").val().trim(); 
    var des = $("#message").val().trim();
    var sid = $("#s_sid").val().trim();
    if (topic == '' || des == '')
    {
        showNotification("alert-error", "Subject field and message content field are required", "bottom", "right", "", "")
        return false;
    }
    $.ajax({
        url: '../../php/s_message.php', // <-- point to server-side PHP script 
          // <-- what to expect back from the PHP script, if anything
        type:'POST',
        data: {c_id:c_id,topic:topic,des:des,sid:sid},                         
        type: 'post',
        success: function(response){
        console.log(response);
                if (response == 1) {
                  showNotification("alert-success", "Message sent", "bottom", "right", "", "")
                  document.getElementById('s_title').value='';
                  document.getElementById('message').value='';
                }
                else {
                  showNotification("alert-error", "Error in sending message", "bottom", "right", "", "")
                }
              
        }
     });
});

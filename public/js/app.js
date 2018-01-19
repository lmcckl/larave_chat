$(function () {
        $("#messages").scrollTop($("#messages")[0].scrollHeight);

        var socket = io.connect('http://52.220.113.183:8899');
        
        var token = $("#token").val();
        var user = $("#user").val();

        //key in enter to send message
        $(document).keypress(function(e) {
            if(e.which == 13) {
                event.preventDefault();
                $('#send').trigger('click');
            }
        });

        //save the chat message
        $('#send').click(function(e) {
            e.preventDefault();
            msg = $("#msg").val();
            
            //do nothing if message is blank
            if (msg == "") {
                return;
            }

            //save to database    
            $.ajax({
                type: "POST",
                url: '/chat',
                dataType: "json",
                data: {'_token':token,'msg':msg,'user':user},
                success:function(data) {
                    console.log(data);
                }
            });
            
            //broacast the message
            var obj = {'msg':$('#msg').val(),'user':user} 
            socket.emit('message', obj);
            $('#msg').val('');
            return false;
        });

        //update the chat box
        socket.on('message', function(data){
            $('#messages').append("<strong>" + data.user + "</strong><p>" + data.msg + "</p>");
            $("#messages").scrollTop($("#messages")[0].scrollHeight + 50);
        });
    });
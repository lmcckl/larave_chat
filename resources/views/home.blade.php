@extends('layouts.app')

@section('content')
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Chat</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="messages" style="height:300px;overflow:scroll;"></div>
                        </div>
                        <div class="col-md-12">
                            <form action="sendMessage" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" > 
                                <input type="hidden" name="user" value="{{ Auth::user()->name }}" > 
                                <textarea class="form-control msg"></textarea>
                                <br/>
                                <input type="button" value="Send" class="btn btn-success send-msg">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var socket = io.connect('http://localhost:8899'); 
    socket.on('message', function (data) {
        data = jQuery.parseJSON(data);
        console.log(data.user);
        $( "#messages" ).append( "<strong>"+data.user+":</strong><p>"+data.message+"</p>" );
    }); 

    $(".send-msg").click(function(e) {
        e.preventDefault();
        var token = $("input[name='_token']").val(); 
        var user = $("input[name='user']").val(); 
        var msg = $(".msg").val();
        if(msg != ''){
            $.ajax({
                type: "POST",
                url: '{!! URL::to("sendMessage") !!}',
                dataType: "json",
                data: {'_token':token,'message':msg,'user':user}, 
                success:function(data) {
                    console.log(data);
                    $(".msg").val(''); }
                }); 
        }else {
            alert("Please enter message."); }
    })
</script>
@endsection

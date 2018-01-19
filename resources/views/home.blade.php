@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Chat</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="messages" class="mbox"></div>
                        </div>
                        <div class="col-md-12">
                            <form action="chat" method="post">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" > 
                                <input type="hidden" name="user" id="user" value="{{ Auth::user()->name }}" > 
                                <input type="text" class="form-control" id="msg" />
                                <br/>
                                <input type="button" id="send" value="Send" class="btn btn-success">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/app.js"></script>
@endsection

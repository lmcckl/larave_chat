var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);

io.on('connection',function(socket) {
	console.log("user connected...");
	
	socket.on('disconnect', function(){
    	console.log('user disconnected...');
  	});

	socket.on('message', function(data) {
		console.log("message==" + data.msg);
		io.emit('message', data);
	});
});

server.listen(8899, function() {
	console.log('listening on port 8899');
});

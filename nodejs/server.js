var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(8899);
io.on('connection',function(socket) {
	var rclient = redis.createClient();
	rclient.subscribe('message');

	rclient.on("message",function(channel,data) {
		socket.emit(channel, data);
	});

	socket.on('disconnect',function() {
		rClient.quit();
	})
});

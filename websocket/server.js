
var io = require('socket.io')(6001);

io.on('connection', function (socket) {
    // console.log('New connection: ', socket.id);
    // socket.send('Message form Server!');
    // socket.emit('server-info', {
    //     version: .1
    // });
    // socket.broadcast.send('New User');

    socket.on('message', function (data) {
        if(data.openRoom){
            socket.join(data.roomName, function (error) {
                // console.log(socket.rooms);
            });
        }else{
            socket.broadcast.send(data);
        }
    });
});
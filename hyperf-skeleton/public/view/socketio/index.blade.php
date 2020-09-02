<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>socketIo</title>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/1.10.0/jquery.js"></script>
    <script src="../../js/socket.io.js"></script>

    <link rel="stylesheet" href="../../css/socketio.css">
</head>
<body>

<div>hello {{$title}}</div>


<ul id="messages"></ul>
<form action="">
    <input id="m" autocomplete="off" /><button>Send</button>
</form>


</body>
<script>
    var socket = io('ws://127.0.0.1:9502', { transports: ["websocket"] });

    socket.on('connect', function(){
        socket.emit('join-room', 'room1');
    });


    $('form').submit(function(){
        // 发布消息

        socket.emit('new-msg', '{"room":"room1", "message":"'+$("#m").val()+'"}');
        $('#m').val('');
        return false;
    });
    socket.on('new-user-join', function(msg){
        $("#messages").append($('<li>').text(msg));
    });
    socket.on('new-msg', function(msg){
        $("#messages").append($('<li>').text(msg));
    });
    socket.on('user-leave', function(msg){
        $("#messages").append($('<li>').text(msg));
    });


    $(window).bind('beforeunload',function(){
        socket.emit('leave-room', 'room1');
    });

</script>
</html>
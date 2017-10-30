@extends('layouts.app')

@section('content')

    <div class="modal fade" id="roomModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Room: RoomName</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                        <div class="col-md-12">
                            <div class="form-group" id="chatMessages"></div>

                            <div class="form-group">
                                <input id="messageInput" type="text" class="form-control" value="" placeholder="Enter Message">
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> Close Room</button>
                        <button id="send" type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var socket = io(':6001');

        function appendMessage(data) {
            $('#chatMessages').append('<li>' + data.message + '</li>');
        }
        function sendMessage(msg) {
            var message = {
                message: msg
            };
            $('#messageInput').val('');
            socket.send(message);
            appendMessage(message);
        }
        socket.on('message', function (data) {
            appendMessage(data);
        });

        $(document).ready(function () {
            $('#roomModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#send').on('click', function () { // sending message with clicking Send button
                sendMessage($('#messageInput').val());
            });
            $(document).keypress(function(e) { // sending message with pressing Enter key
                if(e.which==13 && $('#messageInput').is(":focus")) {
                    sendMessage($('#messageInput').val());
                }
            });
        });
    </script>

@endsection

@extends('layouts.app')

@section('content')

    {{--<div class="container">--}}
        {{--<div class="form-group pull-right">--}}
            {{--<button id="room_search" type="button" class="btn btn-info btn-lg"><i class="fa fa-search"></i></button>--}}
        {{--</div>--}}
        {{--<div class="form-group pull-left">--}}
            {{--<button id="create_room" type="button" class="btn btn-info btn-lg">Create room</button>--}}
        {{--</div>--}}
        {{--<div id="system_message" class="pull-left"></div>--}}
        {{--<div class="clearfix"></div>--}}
    {{--</div>--}}




    {{--@if(count($rooms) > 0)--}}
        <div id="load_rooms" class="mmmsearch-content">
            @include('load_rooms')
        </div>
    {{--@endif--}}






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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.4/socket.io.js"></script>
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

        $('.dummy-media-object').on('click', function () {
            $('.mmmsearch-close').trigger('click');
            var roomName = $(this).data('room');
            socket.send({
                openRoom: true,
                roomName: roomName,
                user: 22,
                {{--user: "{{ isset(Auth::user) ? Auth::user()->id : 'user'  }}"--}}
            });
            setTimeout(function() {
                $('#roomModal').modal('show');
            }, 1200);
        });


        $('#send').on('click', function () { // sending message with clicking Send button
            sendMessage($('#messageInput').val());
        });
        $(document).keypress(function(e) { // sending message with pressing Enter key
            if(e.which==13 && $('#messageInput').is(":focus")) {
                sendMessage($('#messageInput').val());
            }
        });

    </script>


@endsection

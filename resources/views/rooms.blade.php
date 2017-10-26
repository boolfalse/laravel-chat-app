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

    <div id="load_rooms" class="mmmsearch-content">
        <div class="dummy-column">
            <h2>People</h2>
            {{--data-toggle="modal" data-target="#roomModal"--}}
            <a class="dummy-media-object" href="#" data-room="123abc456def">
                <img class="round" src="{{ asset('img/user_image.jpeg') }}" alt="user_1"/>
                <h3>User Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img class="round" src="{{ asset('img/user_image.jpeg') }}" alt="user_2"/>
                <h3>User Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img class="round" src="{{ asset('img/user_image.jpeg') }}" alt="user_3"/>
                <h3>User Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img class="round" src="{{ asset('img/user_image.jpeg') }}" alt="user_4"/>
                <h3>User Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img class="round" src="{{ asset('img/user_image.jpeg') }}" alt="user_5"/>
                <h3>User Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img class="round" src="{{ asset('img/user_image.jpeg') }}" alt="user_6"/>
                <h3>User Name</h3>
            </a>
        </div>
        <div class="dummy-column">
            <h2>Popular</h2>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
        </div>
        <div class="dummy-column">
            <h2>Recent</h2>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
            <a class="dummy-media-object" href="#">
                <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
                <h3>Room Name</h3>
            </a>
        </div>
    </div>


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

    @if(Auth::check())
        <div class="modal fade" id="newRoomModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create New Chat Room (Select Access Scope for Room)</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" value="" placeholder="Room Name">
                        </div>
                        <div class="form-group">
                            <input id="publicAccess" type="radio" name="roomAccess" value="public" checked>
                            <label for="publicAccess">Public for all (also for not registered) users.</label>
                        </div>
                        <div class="form-group">
                            <input id="protectedAccess" type="radio" name="roomAccess" value="protected">
                            <label for="protectedAccess">Available only for registered users.</label>
                        </div>
                        <div class="form-group">
                            <input id="privateAccess" type="radio" name="roomAccess" value="private">
                            <label for="privateAccess">Can access only with specific token URL.</label>
                            <button type="button" class="btn btn-xs btn-default" disabled>Copy Autogenerated Token to Clipboard!</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                        <button id="addNewRoom" type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Create</button>
                    </div>
                </div>

            </div>
        </div>
    @endif

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
                //ss https://stackoverflow.com/questions/22207377/disable-click-outside-of-bootstrap-modal-area-to-close-modal
                $('#roomModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }, 1000);
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

@extends('layouts.app')

@section('content')

    <div id="load_rooms" class="mmmsearch-content">
        <div class="dummy-column">
            <h2>Public</h2>
            {{--data-toggle="modal" data-target="#roomModal" data-room="123abc456def"--}}
            @foreach($rooms as $room)
                @if($room->access == "public")
                <a class="dummy-media-object" href="#">
                    <img class="{{ (Auth::user()->id == $room->user->id) ? 'round' : ''}}" src="{{ asset('uploads/'.$room->image) }}" alt="{{ $room->user->name }}"/>
                    <h3>{{ $room->user->name }}</h3>
                </a>
                @endif
            @endforeach
        </div>
        <div class="dummy-column">
            <h2>Public</h2>
            @foreach($rooms as $room)
                @if($room->access == "protected")
                    <a class="dummy-media-object" href="#">
                        <img class="{{ (Auth::user()->id ==  $room->user->id) ? 'round' : ''}}" src="{{ asset('uploads/'.$room->image) }}" alt="{{ $room->user->name }}"/>
                        <h3>{{ $room->user->name }}</h3>
                    </a>
                @endif
            @endforeach
        </div>
        <div class="dummy-column">
            <h2>Public</h2>
            @foreach($rooms as $room)
                @if($room->access == "private")
                    <a class="dummy-media-object" href="#">
                        <img class="{{ (Auth::user()->id ==  $room->user->id) ? 'round' : ''}}" src="{{ asset('uploads/'.$room->image) }}" alt="{{ $room->user->name }}"/>
                        <h3>{{ $room->user->name }}</h3>
                    </a>
                @endif
            @endforeach
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
        <div class="modal fade" id="addRoomModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="upload_form" method="POST" action="{{ route('addRoom') }}"  enctype="multipart/form-data" role="form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create New Chat Room (Select Access Scope for Room)</h4>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                            <div class="form-group">
                                <input id="room_image" type="file" name="room_image" style="display: inline-block">
                                <label for="room_image" class="col-md-4 control-label">Upload Room Image: </label>
                            </div>
                            <div class="form-group">
                                <input id="room_name" type="text" class="form-control" value="" name="room_name" placeholder="Room Name" required>
                            </div>
                            <div class="form-group">
                                <input id="publicAccess" type="radio" name="room_access" value="public" checked>
                                <label for="publicAccess">Public for all (also for not registered) users.</label>
                            </div>
                            <div class="form-group">
                                <input id="protectedAccess" type="radio" name="room_access" value="protected">
                                <label for="protectedAccess">Available only for registered users.</label>
                            </div>
                            <div class="form-group">
                                <input id="privateAccess" type="radio" name="room_access" value="private">
                                <label for="privateAccess">Can access only with specific token URL.</label>
                                <button id="generateToken" type="button" class="btn btn-xs btn-default" disabled>Copy Autogenerated Token to Clipboard</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                            <button id="addNewRoom" type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Create</button>
                        </div>
                        <input id="token_key" type="hidden" name="token_key" value="" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </form>
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
        function generateRandomString() {
            var chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var length = chars.length;
            var string = '';
            for (var i=0; i<12; i++) {
                string += chars[Math.round(Math.random() * length)];
            }
            return string;
        }
        function copyToClipboard(text) {
            if (window.clipboardData && window.clipboardData.setData) {
                // IE specific code path to prevent textarea being shown while dialog is visible.
                return clipboardData.setData("Text", text);

            } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
                var textarea = document.createElement("textarea");
                textarea.textContent = text;
                textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in MS Edge.
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    return document.execCommand("copy");  // Security exception may be thrown by some browsers.
                } catch (ex) {
                    console.warn("Copy to clipboard failed.", ex);
                    return false;
                } finally {
                    document.body.removeChild(textarea);
                }
            }
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

        // THROWN WARNINGS ON ROOM ADDING
        function printErrorMsg (msg) {
            $('.print-error-msg').find('ul').html('');
            $('.print-error-msg').css('display','block');
            $.each( msg, function( key, value ) {
                $('.print-error-msg').find("ul").append('<li>'+value+'</li>');
            });
        }
        // AJAX REQUEST FOR ADDING NEW ROOM WITH IMAGE UPLOAD
        $("#addNewRoom").click(function(){
            var options = {
                complete: function(response) {
                    if($.isEmptyObject(response.responseJSON.error)){
                        $('#addRoomModal').modal('hide');
                    }else{
                        printErrorMsg(response.responseJSON.error);
                    }
                }
            };
            $("#upload_form").ajaxForm(options);
        });

        $('#upload_form input[type="radio"]').on('change', function () {
            var s = $('#privateAccess').is(':checked');
            $('#generateToken').prop('disabled', !s);
            $('#addNewRoom').prop('disabled', s);
        });
        $('#generateToken').on('click', function () {
            var token_key = generateRandomString();
            $('#token_key').val(token_key);
            $('#addNewRoom').prop('disabled', false);
            copyToClipboard(token_key);
            $('#generateToken').html('Copied!');
        });

        $('#addRoomModal').on('hidden.bs.modal', function () {
            $('#room_name, #room_image, #token_key').val('');
            $('#publicAccess').prop('checked', true);
            $('#generateToken').html('Copy Autogenerated Token to Clipboard');
        });
    </script>


@endsection

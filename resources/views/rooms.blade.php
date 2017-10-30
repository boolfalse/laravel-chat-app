@extends('layouts.app')

@section('content')

    <div id="load_rooms" class="mmmsearch-content">
        {{--//ss TODO: optimize getting 3 types of rooms (public, protected, private) process--}}
        <div class="dummy-column public-column">
            <h2>Public <button data-access="public" class="btn btn-xs btn-success create-room"><i class="fa fa-plus"> Create</i></button></h2>
            @foreach($rooms as $room)
                @if($room->access == "public")
                <a class="dummy-media-object" href="#" data-room-id="{{ $room->id }}" data-user-id="{{ $room->user->id }}" data-room-name="{{ $room->name }}">
                    @if(Auth::check())
                    <img class="{{ $auth_user_id == $room->user->id ? 'round' : ''}}" src="{{ empty($room->image) ? asset('img/default_user_image.jpeg') : asset('uploads/'.$room->image) }}" alt="{{ $room->name }}"/>
                    @else
                    <img src="{{ asset('uploads/'.$room->image) }}" alt="{{ $room->user->name }}"/>
                    @endif
                    <h3>
                    @if(Auth::check())
                        {!! $auth_user_id == $room->user->id ? "<i class='fa fa-user'></i>" : "" !!}
                        "{{ $room->name }}" created by {{ $auth_user_id == $room->user->id ? "ME" : $room->user->name }}
                    @else
                        "{{ $room->name }}" created by {{ $room->user->name }}
                    @endif
                    </h3>
                </a>
                @endif
            @endforeach
        </div>
        <div class="dummy-column protected-column {{Auth::check() ? '' : 'showHiddenItemsOnHover'}}">
            <h2>Protected <button data-access="protected" class="btn btn-xs btn-success create-room"><i class="fa fa-plus"> Create</i></button></h2>
            @if(Auth::check())
            @foreach($rooms as $room)
                @if($room->access == "protected")
                <a class="dummy-media-object" href="#" data-room-id="{{ $room->id }}" data-user-id="{{ $room->user->id }}" data-room-name="{{ $room->name }}">
                    <img class="{{ $auth_user_id == $room->user->id ? 'round' : ''}}" src="{{ empty($room->image) ? asset('img/default_user_image.jpeg') : asset('uploads/'.$room->image) }}" alt="{{ $room->name }}"/>
                    <h3>
                        {!! $auth_user_id == $room->user->id ? "<i class='fa fa-user'></i>" : "" !!}
                        "{{ $room->name }}" created by {{ $auth_user_id == $room->user->id ? "ME" : $room->user->name }}
                    </h3>
                </a>
                @endif
            @endforeach
            @else
                <p class="not-rooms" style="color: #ec5a62"><strong>For seeing Protected Rooms You need to logged in!</strong></p>
                <div class="ccc-links not-rooms">
                    <a class="btn btn-xs btn-info" href="{{ route('register') }}"><span>Register</span></a>
                    <a class="btn btn-xs btn-success" href="{{ route('login') }}"><span>Login</span></a>
                </div>
            @endif
        </div>
        <div class="dummy-column private-column {{Auth::check() ? '' : 'showHiddenItemsOnHover'}}">
            <h2>Private <i class="fa fa-lock"></i> <button data-access="private" class="btn btn-xs btn-success create-room"><i class="fa fa-plus"> Create</i></button></h2>
            @if(Auth::check())
            @foreach($rooms as $room)
                @if($room->access == "private")
                <a class="dummy-media-object" href="#" data-room-id="{{ $room->id }}" data-user-id="{{ $room->user->id }}" data-room-name="{{ $room->name }}">
                    <img class="{{ $auth_user_id == $room->user->id ? 'round' : ''}}" src="{{ empty($room->image) ? asset('img/default_user_image.jpeg') : asset('uploads/'.$room->image) }}" alt="{{ $room->name }}"/>
                    <h3>
                        {!! $auth_user_id == $room->user->id ? "<i class='fa fa-user'></i>" : ""  !!}
                        <i class="fa fa-lock"></i>
                        "{{ $room->name }}" created by {{ $auth_user_id == $room->user->id ? "ME" : $room->user->name }}
                    </h3>
                </a>
                @endif
            @endforeach
            @else
                <p class="not-rooms" style="color: #ec5a62"><strong>For seeing Private Rooms You need to logged in!</strong></p>
                <div class="ccc-links not-private-rooms">
                    <a class="btn btn-xs btn-info" href="{{ route('register') }}"><span>Register</span></a>
                    <a class="btn btn-xs btn-success" href="{{ route('login') }}"><span>Login</span></a>
                </div>
            @endif
        </div>
    </div>


    <div class="modal fade" id="roomModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
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

    <div class="modal fade" id="unlockModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Private Room Unlocker <i class="fa fa-lock"></i></h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="alert alert-danger print-error-msg" style="display:none"><ul></ul></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <p>Private Room Token Key:</p>
                                <input id="tokenKey" type="password" class="form-control" value="" placeholder="Past here">
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-close"></i> Cancel</button>
                        <button id="unlockRoom" type="button" class="btn btn-primary"><i class="fa fa-unlock"></i> Open Private Room</button>
                        <button id="getGeneratedUrl" type="button" class="btn btn-success"><i class="fa fa-clipboard"></i> Generate URL</button>
                        <input type="hidden" id="hidden_user_id" value="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


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
            $('.mmmsearch-close').trigger('click'); // close mmm-search
            var roomId = $(this).data('room-id');
            var roomName = $(this).data('room-name');
            var userId = $(this).data('user-id');
            var accessClass = $(this).closest('.dummy-column').attr('class');
            var accessColumn = accessClass.match(/(public|protected|private)-column/g);
            var access = accessColumn[0].substring(0, accessColumn[0].indexOf('-'));
            $('#roomModal .modal-title').html('Room: '+roomName+' <span style="text-transform: uppercase">('+access+')</span>');
@if(Auth::check())
            $('#hidden_user_id').val(userId);
            if($(this).parent().hasClass('private-column')){
                if($(this).data('user-id') == '{{ $auth_user_id }}'){
                    $('#getGeneratedUrl').show();
                }else{
                    $('#getGeneratedUrl').hide();
                }
                $('#unlockModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }else{
@endif
                socket.send({
                    openRoom: true,
                    roomName: roomId,
                    user: userId
                });
                $('#roomModal').modal({
                    backdrop: 'static',
                    keyboard: false
                });
@if(Auth::check())
            }
@endif
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
        $("#addNewRoom").on('click', function(){
            var options = {
                complete: function(response) {
                    if($.isEmptyObject(response.responseJSON.error)){
                        $('#addRoomModal').modal('hide');

                        if($('.not-rooms').length > 0){ //ss fix
                            $('.not-rooms').remove();
                        }
                        var newRoom =
                            '<a class="dummy-media-object" href="#" data-room-id="'+response.responseJSON.room_id+'" data-user-id="'+response.responseJSON.user_id+'">' +
                                '<img class="round" src="{{ asset('uploads') }}/'+response.responseJSON.room_image+'" alt="'+response.responseJSON.room_name+'"/>' +
                                '<h3>' +
                                    '<i class="fa fa-user"></i>' +
                                    ' <i class="fa fa-lock"></i>' +
                                    ' "' + response.responseJSON.room_name + '" ' + 'created by ME' +
                                '</h3>' +
                            '</a>';
                        $('.' + response.responseJSON.room_access + '-column').append(newRoom);
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
            $('#generateToken').html('Copy Autogenerated Token to Clipboard').prop('disabled', true);
            $('.print-error-msg').empty().append('<ul></ul>');
        });

        $('#unlockModal').on('hidden.bs.modal', function () {
            $('#tokenKey, #hidden_user_id').val('');
            $('.print-error-msg').empty().append('<ul></ul>');
        });

        //ss TODO: later explore private chat app
        @if(Auth::check())
        $('#unlockRoom, #getGeneratedUrl').on('click', function (e) {
            $.ajax({
                url: "{{ route('unlockPrivateRoom') }}",
                data: {
                    'userId': $('#hidden_user_id').val(),
                    'tokenKey': $('#tokenKey').val(),
                    '_token': "{{ csrf_token() }}"
                },
                type: "POST",
                success: function (response){
                    var data = JSON.parse(response);
                    if(data.success){
                        var generatedUrl = location.origin + '/private-room/' + data.hash_tokenKey;
                        console.log(generatedUrl);
                        if(e.target.id == 'unlockRoom'){
                            location.replace(generatedUrl);
                        }
                        if(e.target.id == 'getGeneratedUrl'){ //ss for authenticated owner user only
                            copyToClipboard(generatedUrl);
                            $('#unlockModal').modal('hide');
                        }
                        //ss https://stackoverflow.com/questions/4907843/open-a-url-in-a-new-tab-and-not-a-new-window-using-javascript#11384018
                        // window.open(url, '_blank').focus();
                    }else{
                        console.log('Token Key not valid!');
                    }
                }
            });
        });
        @endif

        // ON PRESSING 3 CREATE ROOM BUTTONS IT'LL CLOSE MMM-SEARCH AND WILL OPEN ADDROOMMODAL CHECKED WITH APPROPRIATE ACCESS RADIO BUTTON
        $('button.create-room').on('click', function (e) {
            $('.mmmsearch-close').trigger('click'); // close mmm-search
            var access = $(this).data('access');
            if(access == "private"){
                $('#generateToken').prop('disabled', false);
            }
            $('#'+access+'Access').prop('checked', true);
            $('#addRoomModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
    </script>

@endsection

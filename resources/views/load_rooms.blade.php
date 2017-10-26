{{--<div id="load" style="position: relative;">--}}

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

    {{--<table class="table table-hover">--}}
        {{--<tr style="background-color: silver">--}}
            {{--<th>Number</th>--}}
            {{--<th>Name</th>--}}
            {{--<th>Image</th>--}}
            {{--<th>Owner</th>--}}
            {{--<th>Participants</th>--}}
            {{--<th>Access</th>--}}
        {{--</tr>--}}
        {{--@foreach($rooms as $room)--}}
        {{--<tr class="{{ $room->access ? '' : 'disabled-room' }}">--}}
            {{--<td>{{ $room->id }}</td>--}}
            {{--<td>{{ $room->name }}</td>--}}
            {{--<td><img src="{{ asset('uploads/'.$room->image) }}" alt="Room: '{{ $room->name }}'" /></td>--}}
            {{--<td>{{ $room->user->name }}</td>--}}
            {{--<td>5</td>--}}
            {{--<td><a href="{{ url('room/'.$room->id) }}" target="_blank" class="btn btn-primary">Public</a></td>--}}
        {{--</tr>--}}
        {{--@endforeach--}}
    {{--</table>--}}

{{--</div>--}}
{!! $rooms->render() !!}
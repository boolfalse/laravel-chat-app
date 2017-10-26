{{--<div id="load" style="position: relative;">--}}

    <div class="dummy-column">
        <h2>People</h2>
        {{--data-toggle="modal" data-target="#roomModal"--}}
        <a class="dummy-media-object" href="#" data-room="123abc456def">
            <img class="round" src="http://0.gravatar.com/avatar/81b58502541f9445253f30497e53c280?s=50&d=identicon&r=G" alt="Sara Soueidan"/>
            <h3>Sara Soueidan</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img class="round" src="http://0.gravatar.com/avatar/48959f453dffdb6236f4b33eb8e9f4b7?s=50&d=identicon&r=G" alt="Rachel Smith"/>
            <h3>Rachel Smith</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img class="round" src="http://0.gravatar.com/avatar/06458359cb9e370d7c15bf6329e5facb?s=50&d=identicon&r=G" alt="Peter Finlan"/>
            <h3>Peter Finlan</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img class="round" src="http://1.gravatar.com/avatar/db7700c89ae12f7d98827642b30c879f?s=50&d=identicon&r=G" alt="Patrick Cox"/>
            <h3>Patrick Cox</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img class="round" src="http://0.gravatar.com/avatar/cb947f0ebdde8d0f973741b366a51ed6?s=50&d=identicon&r=G" alt="Tim Holman"/>
            <h3>Tim Holman</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img class="round" src="http://1.gravatar.com/avatar/9bc7250110c667cd35c0826059b81b75?s=50&d=identicon&r=G" alt="Shaun Dona"/>
            <h3>Shaun Dona</h3>
        </a>
    </div>
    <div class="dummy-column">
        <h2>Popular</h2>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="room_image"/>
            <h3>Page Preloading Effect</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="ArrowNavigationStyles"/>
            <h3>Arrow Navigation Styles</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="HoverEffectsIdeasNew"/>
            <h3>Ideas for Subtle Hover Effects</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="FreebieHalcyonDays"/>
            <h3>Halcyon Days Template</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="ArticleIntroEffects"/>
            <h3>Inspiration for Article Intro Effects</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="DraggableDualViewSlideshow"/>
            <h3>Draggable Dual-View Slideshow</h3>
        </a>
    </div>
    <div class="dummy-column">
        <h2>Recent</h2>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="TooltipStylesInspiration"/>
            <h3>Tooltip Styles Inspiration</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="AnimatedHeaderBackgrounds"/>
            <h3>Animated Background Headers</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="OffCanvas"/>
            <h3>Off-Canvas Menu Effects</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="TabStyles"/>
            <h3>Tab Styles Inspiration</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="ResponsiveSVGs"/>
            <h3>Make SVGs Responsive with CSS</h3>
        </a>
        <a class="dummy-media-object" href="#">
            <img src="{{ asset('img/room_image.png') }}" alt="NotificationStyles"/>
            <h3>Notification Styles Inspiration</h3>
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
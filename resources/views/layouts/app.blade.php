<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>Laravel Chat App</title>
    <link rel="shortcut icon" href="../favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Raleway:100,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.2.0/css/font-awesome.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">--}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/demo.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/component.css') }}" />

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <style>
        #addRoomModal,
        #roomModal{
            font-size: 14px;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            color: black;
        }
        #chatMessages{
            height: 200px;
            overflow-y: scroll;
            background-color: #1b6d85;
        }
    </style>

    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<div class="container">
    {{--<aside class="sidebar clearfix">--}}
        {{--<nav>--}}
            {{--<a href="#"><i class="fa fa-fw fa-comments-o"></i></a>--}}
            {{--<a href="#"><i class="fa fa-fw fa-heart-o"></i></a>--}}
            {{--<a href="#"><i class="fa fa-fw fa-send-o"></i></a>--}}
            {{--<a href="#"><i class="fa fa-fw fa-smile-o"></i></a>--}}
        {{--</nav>--}}
    {{--</aside>--}}
    <div id="mmmsearch" class="mmmsearch">
        <form class="mmmsearch-form">
            <input class="mmmsearch-input" type="search" placeholder="All Rooms"/>
            <button class="mmmsearch-submit" type="submit">Search</button>
        </form>
        
        @yield('content')

        <span class="mmmsearch-close"></span>
    </div>
    <header class="ccc-header">
        <h1>ChatRooms <span>Laravel Real Time Web Chat App.</span></h1>
        <div class="ccc-links">
            @if(Auth::check())
                <a class="btn btn-xs btn-warning" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-app').submit();"><span>Logout</span></a>
                <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#addRoomModal"><span>New Room</span></button>
            @else
                <a class="btn btn-xs btn-info" href="{{ route('register') }}"><span>Register</span></a>
                <a class="btn btn-xs btn-success" href="{{ route('login') }}"><span>Login</span></a>
            @endif
        </div>
    </header>
    <div class="overlay"></div>
</div>

{{--//ss TODO: https://stackoverflow.com/questions/44716379/laravel-5-4-24-throws-methodnotallowedhttpexception-during-logout-of-users--}}
@if(Auth::check())
    <form id="logout-app" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    <script src="{{ asset('js/jquery.form.js') }}"></script>
@endif

<script src="{{ asset('js/classie.js') }}"></script>
<script>
    (function() {
        var mmmSearch = document.getElementById( 'mmmsearch' ),
            input = mmmSearch.querySelector( 'input.mmmsearch-input' ),
            ctrlClose = mmmSearch.querySelector( 'span.mmmsearch-close' ),
            isOpen = isAnimating = false,
            // show/hide search area
            toggleSearch = function(evt) {
                // return if open and the input gets focused
                if( evt.type.toLowerCase() === 'focus' && isOpen ) return false;

                var offsets = mmmsearch.getBoundingClientRect();
                if( isOpen ) {
                    classie.remove( mmmSearch, 'open' );

                    // trick to hide input text once the search overlay closes
                    // todo: hardcoded times, should be done after transition ends
                    if( input.value !== '' ) {
                        setTimeout(function() {
                            classie.add( mmmSearch, 'hideInput' );
                            setTimeout(function() {
                                classie.remove( mmmSearch, 'hideInput' );
                                input.value = '';
                            }, 300 );
                        }, 500);
                    }

                    input.blur();
                }
                else {
                    classie.add( mmmSearch, 'open' );
                }
                isOpen = !isOpen;
            };

        // events
        input.addEventListener( 'focus', toggleSearch );
        ctrlClose.addEventListener( 'click', toggleSearch );
        // esc key closes search overlay
        // keyboard navigation events
        document.addEventListener( 'keydown', function( ev ) {
            var keyCode = ev.keyCode || ev.which;
            if( keyCode === 27 && isOpen ) {
                toggleSearch(ev);
            }
        } );

        //ss TODO: for demo purposes only: don't allow to submit the form
        mmmSearch.querySelector( 'button[type="submit"]' ).addEventListener( 'click', function(ev) { ev.preventDefault(); } );
    })();
</script>
</body>
</html>
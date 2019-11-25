
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BnB') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,500,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('meta')

</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary color-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'BnB') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <?php $count=Auth::user()->unreadNotificationsCount(); ?>

                                <a id="notifDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Notifications <span class="notif-count <?=$count>0?"active":""?>"><?=$count?></span> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notifDropdown">
                                   @forelse(Auth::user()->customNotifications as $n)
                                        <a href="{{$n->url}}?notif=<?=$n->id?>"><div class="notification-item <?=$n->seen?"":"active"?>">
                                                <div class="date"><?=$n->created_at->format('d.m.Y H:i')?></div>
                                                <div class="text">{{$n->text}}</div>
                                            </div></a>


                                       @empty
                                        <div class="p-2">You do not have any notifications so far!</div>
                                       @endforelse


                                </div>
                            </li>


                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <b class="pl-3">HOST</b>
                                    <div class="dropdown-divider">

                                    </div>
                                    <a class="dropdown-item" href="{{ route('listing.index') }}">
                                        My listings
                                    </a>
                                    <a class="dropdown-item" href="{{ route('guestlist.index') }}">
                                        Reservations
                                    </a>
                                    <a class="dropdown-item"  href="{{route('listing.create')}}">{{ __('Add New Listing') }}</a>

                                    <div class="dropdown-divider"></div>
                                    <b class="pl-3">GUEST</b>
                                    <div class="dropdown-divider">

                                    </div>
                                    <a class="dropdown-item" href="{{ route('reservations.index') }}">
                                        My bookings
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if ($message = Session::get(\App\Http\Controllers\Controller::SUCCESS_MESSAGE))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        @if ($message = Session::get(\App\Http\Controllers\Controller::ERROR_MESSAGE))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <h5>Your request was invalid! </h5>
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main class="">

            @yield('content')
        </main>
    </div>


    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Please confirm
                </div>
                <div class="modal-body">
                    Are you sure you wish to delete the selected row?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger btn-ok">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/extention/flatpickr.js"></script>
    <script>
        flatpickr(".datepicker",
            {dateFormat: "d.m.Y"});
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
</body>
</html>

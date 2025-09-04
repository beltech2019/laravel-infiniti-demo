<header class="header sticky-top bg-transparent">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('loginPage')}}"><img src="{{asset('images/infinity.png')}}" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item" id="nav-item-lottery">
                        <a class="nav-link" id="nav-link-lottery" aria-current="page" href="{{route('games.lottery')}}">{{ __('message2.LOTTERY') }}</a>
                    </li>
                    <li class="nav-item" id="nav-item-sportsPool">
                        <a class="nav-link" id="nav-link-sportsPool" href="{{route('games.sportsPool')}}">{{ __('message2.SPORTSPOOL') }}</a>
                    </li>
                    <li class="nav-item" id="nav-item-bingo">
                        <a class="nav-link" id="nav-link-bingo" href="{{route('games.bingo')}}">{{ __('message2.BINGO') }}</a>
                    </li>
                    <li class="nav-item" id="nav-item-sportsBetting">
                        <a class="nav-link" id="nav-link-sportsBetting" href="{{route('games.sportsbetting')}}">{{ __('message2.SPORTS_BETTING') }}</a>
                    </li>
                    <li class="nav-item" id="nav-item-instant">
                        <a class="nav-link" id="nav-link-instant" href="{{route('games.instantgames')}}">{{ __('message2.INSTANT_GAMES') }}</a>
                    </li>
                    <li class="nav-item" id="nav-item-slots">
                        <a class="nav-link" id="nav-link-slots" href="{{route('games.slotgames')}}">{{ __('message2.SLOTS') }}</a>
                    </li>
                    <li class="nav-item" id="nav-item-crazyBillions">
                        <a class="nav-link" id="nav-link-crazyBillions" href="{{route('games.crazyBillions')}}">{{ __('message2.CRAZY_BILLIONS') }}</a>
                    </li>
                    <li class="nav-item" id="nav-item-gameArt">
                        <a class="nav-link" id="nav-link-gameArt" href="{{route('games.gameart')}}">{{ __('message2.GAME_ART') }}</a>
                    </li>



                </ul>
                <form class="d-flex align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown">
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'en') }}">English</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'fr') }}">Français</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'th') }}">Thai</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang.switch', 'es') }}">Spanish</a></li>
                        </ul>
                    </li>
                    @if(sessionLogin())
                    <div id="user-info" class="dropdown">
                        <button id="amount-button" class="btn btn-sm btn-outline-primary dropdown-toggle fw-bold" data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- <span id="amount-textaa">{{ authUserName() }}</span>    -->
                        <span id="amount-text">{{ authUserBalance() }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('account.profile') . '?tab=profile' }}">🌐 {{ __('message2.MY_PROFILE') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('account.profile') . '?tab=tickets' }}">🎟 {{ __('message2.MY_TICKETS') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('account.profile') . '?tab=wallet' }}">👛 {{ __('message2.MY_WALLET') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('account.profile') . '?tab=transactions' }}">💳 {{ __('message2.MY_TRANSACTIONS') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('account.profile') . '?tab=inbox' }}">📥 {{ __('message2.INBOX') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('account.profile') . '?tab=refer' }}">🌍 {{ __('message2.REFER_A_FRIEND') }}</a></li>
                        <li><a class="dropdown-item" href="/logout">{{ __('message2.LOGOUT') }}</a></li>
                        </ul>
                    </div>
                    @else
                    <button class="btn btn-danger login-btn" type="button">{{ __('message2.LOGIN_SIGNUP') }}</button>
                    @endif
                </form>
            </div>
        </div>
    </nav>
</header>
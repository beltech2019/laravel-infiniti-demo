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
                        <a class="nav-link" id="nav-link-lottery" aria-current="page" href="#">Lottery</a>
                    </li>
                    <li class="nav-item" id="nav-item-sportsPool">
                        <a class="nav-link" id="nav-link-sportsPool" href="#">Sportspool</a>
                    </li>
                    <li class="nav-item" id="nav-item-bingo">
                        <a class="nav-link" id="nav-link-bingo" href="#">Bingo</a>
                    </li>
                    <li class="nav-item" id="nav-item-sportsBetting">
                        <a class="nav-link" id="nav-link-sportsBetting" href="#">Sports betting</a>
                    </li>
                    <li class="nav-item" id="nav-item-instant">
                        <a class="nav-link" id="nav-link-instant" href="{{route('instantgames')}}">Instant Games</a>
                    </li>
                    <li class="nav-item" id="nav-item-slots">
                        <a class="nav-link" id="nav-link-slots" href="{{route('slotgames')}}">Slots</a>
                    </li>
                    <li class="nav-item" id="nav-item-crazyBillions">
                        <a class="nav-link" id="nav-link-crazyBillions" href="{{route('crazyBillions')}}">Crazy Billions</a>
                    </li>
                    <li class="nav-item" id="nav-item-gameArt">
                        <a class="nav-link" id="nav-link-gameArt" href="{{route('gameart')}}">Game Art</a>
                    </li>



                </ul>
                <form class="d-flex align-items-center">
                    <div class="countrycode">
                        <img src="{{asset('images/en_gb.gif')}}" class="">
                    </div>
                    @if(session('user_id'))
                    <!-- Authenticated -->
                    <div id="user-info" class="dropdown">
                        <button id="amount-button" class="btn btn-sm btn-outline-primary dropdown-toggle fw-bold" data-bs-toggle="dropdown" aria-expanded="false">
                        ₹<span id="amount-text">{{ authUserBalance() }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </div>
                    @else
                    <button class="btn btn-danger login-btn" type="button">Login/Signup</button>
                    @endif
                </form>
            </div>
        </div>
    </nav>
</header>
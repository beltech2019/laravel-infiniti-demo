<header class="header sticky-top bg-transparent">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{asset('images/infinity.png')}}" class="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Lottery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sportspool</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bingo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sports betting</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Instant Games</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Slots</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Crazy Billions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Game Art</a>
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
@extends('layouts.app')
@section('content')
<section class="banner-style">
        <div class="baner-one">
            <img src="{{ asset('images/homepage-banners/banner01.jpg')}}" class="img-fluid" style="width: 100%;">
        </div>
    </section>
    <section class="games-main">
        <div class="container-fluid">

            <div class="row chang_row">
                <div class="col-md-3">
                    <a href="#" class="">
                        <div class="cards-icons">
                            <img src="{{ asset('images/game-icons/games-draw.png')}}" alt="Draw">
                            <a href="#" class="">Lottery</a>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="">
                          <div class="cards-icons">
                            <img src="{{ asset('images/game-icons/games-sportsLottery.png')}}" alt="sportspool">
                            <a href="#" class="">SportsPool</a>
                        </div>
                    </a>    
                </div>
                <div class="col-md-3">
                    <a href="{{route('instantgames')}}" class="">
                        <div class="cards-icons">
                            <img src="{{ asset('images/game-icons/games-instant.png')}}" alt="Instant Win">
                            <a href="{{route('instantgames')}}" class="">Instant Games</a>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-3">
                    <a href="#" class="">
                       <div class="cards-icons">
                            <img src="{{ asset('images/game-icons/game-bingo.png')}}" alt="Bingo">
                            <a href="#" class="">Bingo</a>
                        </div>
                    </a>    
                </div>
                <div class="col-md-3 last_parents">
                    <a href="{{route('slotgames')}}" class="">
                         <div class="cards-icons ">
                            <img src="{{ asset('images/game-icons/games-slot.png')}}" alt="slot" class="game777">
                            <a href="{{route('slotgames')}}" class="">SLOT</a>
                        </div>
                    </a>    
                </div>
            </div>
        </div>
    </section>
@endsection    
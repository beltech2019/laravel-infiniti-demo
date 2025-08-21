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
                        <div class="cards-icons">
                            <img src="{{ asset('images/game-icons/games-draw.png')}}" alt="Draw">
                            <a href="#" class="">Lottery</a>
                        </div>
                </div>
                <div class="col-md-3">
                          <div class="cards-icons">
                            <img src="{{ asset('images/game-icons/games-sportsLottery.png')}}" alt="sportspool">
                            <a href="#" class="">SportsPool</a>

                        </div>
                </div>
                <div class="col-md-3">
                       <div class="cards-icons">
                            <img src="{{ asset('images/game-icons/games-instant.png')}}" alt="Instant Win">
                            <a href="#" class="">Instant Games</a>

                        </div>
                </div>
                <div class="col-md-3">
                       <div class="cards-icons">
                            <img src="{{ asset('images/game-icons/game-bingo.png')}}" alt="Bingo">
                            <a href="#" class="">Bingo</a>

                        </div>
                </div>
                <div class="col-md-3 last_parents">
                         <div class="cards-icons ">
                            <img src="{{ asset('images/game-icons/games-slot.png')}}" alt="slot" class="game777">
                            <a href="#" class="">SLOT</a>

                        </div>
                </div>
            </div>
        </div>
    </section>
@endsection    
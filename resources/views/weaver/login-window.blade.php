@extends('layouts.app')
@section('content')
<section class="banner-style">
        <div class="baner-one">
            <img src="{{ getBannerPath('Main Banner')  }}" class="img-fluid" style="width: 100%;">
        </div>
    </section>
    <section class="games-main">
        <div class="container-fluid">

            <div class="row chang_row">
                @if(gamesview('LOTTERY'))
                <div class="col-md-3">
                    <a href="{{route('games.lottery')}}" class="">
                        <div class="cards-icons">
                            <img src="{{  getBannerPath('Lottery Logo') }}" alt="Draw">
                            <a href="{{route('games.lottery')}}" class="">{{ __('message2.LOTTERY') }}</a>
                        </div>
                    </a>
                </div>
                @endif
                @if(gamesview('SPORTSPOOL'))
                <div class="col-md-3">
                    <a href="{{route('games.sportsPool')}}" class="">
                          <div class="cards-icons">
                            <img src="{{  getBannerPath('SportsPool Logo')}}" alt="sportspool">
                            <a href="{{route('games.sportsPool')}}" class="">{{ __('message2.SPORTSPOOL') }}</a>
                        </div>
                    </a>    
                </div>
                @endif
                @if(gamesview('INSTANT GAMES'))
                <div class="col-md-3">
                    <a href="{{route('games.instantgames')}}" class="">
                        <div class="cards-icons">
                            <img src="{{  getBannerPath('Instant Games Logo')}}" alt="Instant Win">
                            <a href="{{route('games.instantgames')}}" class="">{{ __('message2.INSTANT_GAMES') }}</a>
                        </div>
                    </a>
                </div>
                @endif
                @if(gamesview('BINGO'))
                <div class="col-md-3">
                    <a href="{{route('games.bingo')}}" class="">
                       <div class="cards-icons">
                            <img src="{{  getBannerPath('Bingo Logo')}}" alt="Bingo">
                            <a href="{{route('games.bingo')}}" class="">{{ __('message2.BINGO') }}</a>
                        </div>
                    </a>    
                </div>
                @endif
                @if(gamesview('SLOT'))
                <div class="col-md-3 last_parents">
                    <a href="{{route('games.slotgames')}}" class="">
                         <div class="cards-icons ">
                            <img src="{{  getBannerPath('Slot Logo')}}" alt="slot" class="game777">
                            <a href="{{route('games.slotgames')}}" class="">{{ __('message2.SLOTS') }}</a>
                        </div>
                    </a>    
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection    
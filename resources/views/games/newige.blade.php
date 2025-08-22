@extends('layouts.app')
@section('content')
<script type="text/javascript">
    debugger;
    var hash = location.hash;
    if (hash.length > 11)
        hash = hash.split(",");

    var _ic = _ic || [];
    _ic.push(['server', '{{ $url }}']);
    _ic.push(['gametype', 'ige']);

    if (hash.length == 3) {
        _ic.push(['vendor', hash[0].replace("#", "")]);
        _ic.push(['game_id', hash[1]]);
        _ic.push(['play_type', hash[2]]);
    } else {
        _ic.push(['vendor', '{{ $vendor }}']);
        _ic.push(['game_id', {{ $game }}]);
        _ic.push(['play_type', '{{ $playType }}']);
    }

    _ic.push(['player_id', '{{ $playerId }}']);
    _ic.push(['player_name', '{{ $userName }}']);
    _ic.push(['session_id', '{{ $playerToken ?? '' }}']);
    _ic.push(['balance', '{{ $totalBalance }}']);
    _ic.push(['language', '{{ $lang }}']);
    _ic.push(['currency', '{{ $currency }}']);
    _ic.push(['currencyDisplay', '{{ $dispCurrency }}']);
    _ic.push(['alias', '{{ $domain }}']);
    _ic.push(['isMobileApp', '0']);
    _ic.push(['return_url', '{{ $return_url }}']);
    _ic.push(['iframe_div_id', 'lottogames_div_iframe']);
</script>
<script type="text/javascript" src="{{ $url }}assets/js/lottogames.js"></script>
<script type="text/javascript">LottoGames.frame(_ic);</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const li = document.getElementById("nav-item-instant");
  const anchor = document.getElementById("nav-link-instant");

  li.classList.add("active");
  anchor.classList.add("active");
});
</script>
<div id="lottogames_div_iframe"></div>
<div id="fakeDarkBg"></div>
@endsection 

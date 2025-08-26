@extends('layouts.app')
@section('content')
<script type="text/javascript">
    var _ic = _ic || [];
    _ic.push(['server', '{{ $url }}']);
    _ic.push(['gametype', 'sle']);
    _ic.push(['player_id', '{{ $playerInfo->playerId }}']);
    _ic.push(['player_name', '{{ $playerInfo->userName }}']);
    _ic.push(['session_id', '{{ $playerToken }}']);
    _ic.push(['balance', '{{ $totalBalance }}']);
    _ic.push(['language', '{{ $lang }}']);
    _ic.push(['currency', '{{ $currency }}']);
    _ic.push(['currencyDisplay', '{{$dispCurrency}}']);
    _ic.push(['alias', '{{ $domain_main}}']);
    _ic.push(['iframe_div_id', 'lottogames_div_iframe']);
    (function () {
        document.write('<' + 'script type="text/javascript" src="{{ $url }}assets/js/lottogames.js"><' + '/script>');
    })();

    function postClientLogin() {
        $('#home_login').modal('show');
    }
</script>
<script type="text/javascript">LottoGames.frame(_ic);</script>
<div id="fakeDarkBg"></div>

@endsection
<script>
document.addEventListener("DOMContentLoaded", function () {
  const li = document.getElementById("nav-item-sportsPool");
  const anchor = document.getElementById("nav-link-sportsPool");

  li.classList.add("active");
  anchor.classList.add("active");
});
</script>
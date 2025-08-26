@extends('layouts.app')
@section('content')
<script type="text/javascript">
    var hash = location.hash;
    if (hash.length > 11 && hash.indexOf(",") == 12)
        hash = hash.split(",");
    var _ic = _ic || [];
    _ic.push(['server', '{{$url; }}']);
    if (hash.length == 2)
        _ic.push(['gametype', 'dge/draw-machine']);
    else
        _ic.push(['gametype', 'bingo']);
    _ic.push(['player_id', '{{$playerInfo->playerId ?? ''; }}']);
    _ic.push(['player_name', '{{$playerInfo->userName ?? ''; }}']);
    _ic.push(['session_id', '{{$playerToken ?? ''; }}']);
    _ic.push(['balance', '{{$totalBalance }}']);
    _ic.push(['language', '{{$lang; }}']);
    _ic.push(['currency', '{{$currency }}']);
    _ic.push(['currencyDisplay', '{{$currency }}']);
    _ic.push(['alias', '{{$domain_main}}']);
    _ic.push(['isMobileApp', '0']);
    _ic.push(['iframe_div_id', 'lottogames_div_iframe']);
    if (hash.length == 2)
        _ic.push(['gameCode', hash[1]]);
    if (hash == 2) {
        openLoginModal();
    }
    (function () {
        document.write('<' + 'script type="text/javascript" src="{{$url; }}assets/js/lottogames.js"><' + '/script>');
    })();
    $(window).load(function () {
        if (hash == 2) {
            openLoginModal();
        }
    });
</script>
<script type="text/javascript">LottoGames.frame(_ic);</script>
<div id="fakeDarkBg"></div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const li = document.getElementById("nav-item-bingo");
  const anchor = document.getElementById("nav-link-bingo");
  li.classList.add("active");
  anchor.classList.add("active");
});
</script>
@endsection
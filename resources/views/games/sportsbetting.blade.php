@extends('layouts.app')
@section('content')
<style>
.sb-floatFixBtnWrap {
	position: fixed;
	bottom: 0px;
	right: 0px;
	z-index: 100000000;
        width:100%;
	border-top: 1px solid #c1c1c1;
	display: flex;
	align-items: center;
        color: #011538;
}

.sb-floatFixBtnWrap .sb-floatFixBtnInnerWrap {
	display: flex;
	flex: 1;
	background-color: #f5f5f5;
	max-width: 1000px;
	margin: auto;
}

.sb-floatFixBtnWrap .sb-input {
	padding: 2px 4px;
	align-self: stretch;
	background-color: #c1c1c1;
	position: relative;
}

.sb-floatFixBtnWrap .sb-input input {
	width: 70px;
	border-radius: 3px;
	border: 1px solid #c1c1c1;
	box-shadow: inset 1px 2px 4px rgba(0, 0, 0, 0.5);
	font-size: 11px;
	height: 30px;
	text-align: center;
	padding-right: 20px;
	background-color: #ffffff;
	-webkit-appearance: none;
	padding-left: 3px;
}

.sb-floatFixBtnWrap .sb-input input:focus {
	outline: none;
}

.sb-floatFixBtnWrap .sb-input button {
	position: absolute;
	right: 4px;
	width: 20px;
	top: 50%;
	height: 28px;
	transform: translateY(-50%);
	border: none;
	background-color: #fdd116;
	color: #ffffff;
	border-radius: 0 3px 3px 0;
	font-size: 0;
	display: flex;
	align-items: center;
	justify-content: center;
}

.sb-floatFixBtnWrap .sb-input button:after {
	width: 0;
	height: 0;
	content: '';
	display: block;
	border-left: 8px solid #012161;
	border-top: 4px solid transparent;
	border-bottom: 4px solid transparent;
}

.sb-floatFixBtnWrap .sb-betInfoWrap {
	flex: 1;
	border: none;
	display: flex;
	align-self: stretch;
}

.sb-floatFixBtnWrap .sb-betInfoWrap .betInfo {
	flex: 1 1 auto;
	display: flex;
	align-items: center;
	flex-direction: column;
	justify-content: center;
	position: relative;
}

.sb-floatFixBtnWrap .sb-betInfoWrap .betInfo .label {
	font-size: 0.8em;
	margin: 0 5px;
	line-height: 1;
	text-align: center;
	color: inherit;
	font-weight: 400;
}

.sb-floatFixBtnWrap .sb-betInfoWrap .betInfo + .betInfo:before {
	content: '';
	height: 100%;
	width: 1px;
	top: 0;
	left: -1px;
	position: absolute;
	display: block;
	background-color: #c1c1c1;
}

.sb-floatFixBtnWrap .sb-betInfoWrap .betInfo + .betInfo:after {
	content: '';
	height: 7px;
	width: 7px;
	top: 50%;
	left: -4px;
	position: absolute;
	margin-top: -4px;
	background-color: #c1c1c1;
	border-radius: 50%;
}

.sb-floatFixBtnWrap .sb-floatBtn {
	width: 90px;
	height: 36px;
	border-radius: 0;
	background-color: #d30e24;
	position: relative;
	cursor: pointer;
	display: flex;
	justify-content: center;
	align-items: center;
	color: #ffffff;
	font-size: 16px;
	font-weight: 500;
	letter-spacing: 0.04em;
}

@media only screen and (min-width: 1024px) {
	.sb-floatFixBtnWrap {
		background-color: #2b3a57;
		border: none;
	}

	.sb-floatFixBtnWrap .sb-floatFixBtnInnerWrap {
		background-color: transparent;
		color: #eef6ff;
	}

	.sb-floatFixBtnWrap .sb-betInfoWrap .betInfo {
		flex-direction: row-reverse;
		font-size: 1.22em;
		font-weight: 500;
		margin: 2px 0;
	}

	.sb-floatFixBtnWrap .sb-betInfoWrap .betInfo .txt {
		color: #fdd116;
	}

	.sb-floatFixBtnWrap .sb-betInfoWrap .betInfo + .betInfo:after {
		display: none;
	}

	.sb-floatFixBtnWrap .sb-input input {
		width: 120px;
		padding-left: 3px;
	}

	.sb-floatFixBtnWrap .sb-floatBtn {
		width: 200px;
	}

}

@media only screen and (min-width:992px)  {
    
     .sb-floatFixBtnWrap{
        width: calc(100% - 15px);
        right: 15px;
    }
    
}
.sb-floatFixBtnWrap .sb-betInfoWrap .betInfo.added .txt {
transform-origin: left center;
transition: all 0.05s ease;
-webkit-animation: addedTxt-anim 1s infinite;
-moz-animation: addedTxt-anim 1s infinite;
-o-animation: addedTxt-anim 1s infinite;
animation: addedTxt-anim 1s infinite;
}
@-webkit-keyframes addedTxt-anim {
0% { transform: scale(1); color:#fdd116; }
50% { transform: scale(1.4); color:#ffbf00; }
100%{transform: scale(1); color:#fdd116; }
}
@-moz-keyframes addedTxt-anim {
0% { transform: scale(1); color:#fdd116; }
50% { transform: scale(1.4); color:#ffbf00; }
100%{transform: scale(1); color:#fdd116; }
}
@-o-keyframes addedTxt-anim {
0% { transform: scale(1); color:#fdd116; }
50% { transform: scale(1.4); color:#ffbf00; }
100%{transform: scale(1); color:#fdd116; }
}
@keyframes addedTxt-anim {
0% { transform: scale(1); color:#fdd116; }
50% { transform: scale(1.4); color:#ffbf00; }
100%{transform: scale(1); color:#fdd116; }
}
</style>
<div class="sb-floatFixBtnWrap" id="sbsCart" style="display:none">
			<div class="sb-floatFixBtnInnerWrap">
				<div class="sb-input">
					<input type="text" class="allow_only_nums"  id="eventId" placeholder="Event ID" />
					<button class="go_BTN" onclick="cartOpen(true);">></button>
				</div>
				<div class="sb-betInfoWrap">
					<div class="betInfo">
						<div class="txt sb-badgeVal">0</div>
                        <div class="label"></div>
					</div>
					<div class="betInfo">
						<div class="txt">							
					    <span class="currency">{{ $dispCurrency }}</span>
						<span class="stake">0</span>	
						</div>
						<div class="label"></div>
					</div>
				</div>
				<div class="sb-floatBtn" onclick="cartOpen(false);">
				
				</div>
			</div>
</div>
<script type="text/javascript">
    var _ic = _ic || [];
    _ic.push(['server', '{{ $url }}']);
    _ic.push(['gametype', 'sbs']);
    _ic.push(['session_id', '{{ $playerToken }}']);
    _ic.push(['language', '{{ $lang }}']);
    _ic.push(['player_id', '{{ $playerId }}']);
    _ic.push(['iframe_div_id', 'lottogames_div_iframe']);
    _ic.push(['currency', '{{ $currency }}']);
    _ic.push(['currencyDisplay', '{{ $dispCurrency }}']);
    _ic.push(['family', 'SPORTS_BOOK']);
    _ic.push(['alias', '{{$domain_main}}']);
    (function () {
        document.write('<' + 'script type="text/javascript" src="{{ $url }}assets/js/lottogames.js"><' + '/script>');
    })();

    $('body').addClass('iframeGamePlay');
    var cartStatus = false;

    function fetchMobile() {
        return document.getElementById('playerMobileNo').value;
    }   

    function cartOpen(goTab){
        cartStatus = !cartStatus;
		eventId = $('#eventId').val() ? $('#eventId').val() : null;
		if(eventId && goTab){
			data = {"cartStatus" : null, "eventId" : eventId}
			childCartOpen(data);
		}else{
			data = {"cartStatus" : cartStatus, "eventId" : null}
			childCartOpen(data);
			document.getElementById('sbsCart').style.display = "none";
		}
    }

    function postCartSize(data){
        $('#sbsCart .sb-badgeVal').text(data.cartInfo.size);
		$('#sbsCart .stake').text(data.cartInfo.stake);
		$('#sbsCart .betInfo').addClass('added');
		setTimeout(function () { 
			$('#sbsCart .betInfo').removeClass('added');
		}, 1000);
		if(data.cartInfo.visibility && data.cartInfo.visibility != 'null'){
			document.getElementById('sbsCart').style.display = "block";
		}
    }
	function startSbsInteraction(data){
		document.getElementById('sbsCart').style.display = "block";
	}
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const li = document.getElementById("nav-item-sportsBetting");
  const anchor = document.getElementById("nav-link-sportsBetting");

  li.classList.add("active");
  anchor.classList.add("active");
});
</script>
<input type="hidden" name="playerMobileNo" id="playerMobileNo" value="{{ authUserBalance() }}" />
<script type="text/javascript">LottoGames.frame(_ic);</script>
@endsection

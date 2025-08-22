var globalHeight = "";
var globalWidth = "";
var screenRatio = "";
var gameRatio = "";
var innerHeight = "";
var gameH = "";
var gameW = "";
var winChild = [];

$(document).ready(function(){
    /* Common */
    document.addEventListener("fullscreenchange", function (event) {
        if (!document.fullscreenElement) {
            $("#gamePlayDiv").removeClass('fullScreeOn');
            $('#playScreen').attr('height', '600px');
            $('#playScreen').css('height', '');
            $('#playScreen').attr('width', '800px');
            $('#playScreen').css('width', '');
            $("#playScreen").css("height", globalHeight);
            $("#playScreen").css("width", globalWidth);
        }
    });
    /* Firefox */
    document.addEventListener("mozfullscreenchange", function() {
        if (!document.mozFullScreen) {
            $("#gamePlayDiv").removeClass('fullScreeOn');
            $('#playScreen').attr('height', '600px');
            $('#playScreen').css('height', '');
            $('#playScreen').attr('width', '800px');
            $('#playScreen').css('width', '');
            $("#playScreen").css("height", globalHeight);
            $("#playScreen").css("width", globalWidth);
        }
    });
    /* Chrome, Safari and Opera */
    document.addEventListener("webkitfullscreenchange", function() {
        if (!document.webkitIsFullScreen) {
            $("#gamePlayDiv").removeClass('fullScreeOn');
            $('#playScreen').attr('height', '600px');
            $('#playScreen').css('height', '');
            $('#playScreen').attr('width', '800px');
            $('#playScreen').css('width', '');
            $("#playScreen").css("height", globalHeight);
            $("#playScreen").css("width", globalWidth);
        }
    });
    /* IE / Edge */
    document.addEventListener("msfullscreenchange", function() {
        if (!document.msFullscreenElement) {
            $("#gamePlayDiv").removeClass('fullScreeOn');
            $('#playScreen').attr('height', '600px');
            $('#playScreen').css('height', '');
            $('#playScreen').attr('width', '800px');
            $('#playScreen').css('width', '');
            $("#playScreen").css("height", globalHeight);
            $("#playScreen").css("width", globalWidth);
        }
    });
//    $(document).on("keyup", function (e) {
//        var key = e.which ? e.which : e.keyCode;
//        var key1 = String.fromCharCode(key);
//        if (key == 27 && $("#gamePlayDiv").hasClass('fullScreeOn')) {
//            toggleFullScreen();
//        }
//    });
});


function playGame(item, Price, clkGameId, e, ) {
//    var tempItem = JSON.parse(item);
    if ($("body").hasClass("post-login") !== true) {
        document.getElementById('loginModal').style.display = 'flex';
        return false;
    }
    var tempItem = gameVar[item];
    var path = '';
    gameH = tempItem.windowHeight;
    gameW = tempItem.windowWidth;
    var extraParams = JSON.parse(tempItem.extraParams);
    if(tempItem.merchant_code == 'IGE'){
        if(extraParams.isHTML5.toUpperCase() == 'Y' && extraParams.isFlash.toUpperCase() == 'N'){
            path = newpath[tempItem.engineType];
            var a = new Date();
            path += "?" + a.getTime();
            $("#moodleform").attr('method', 'POST');

            if( tempItem.engineType == "IGEICE" ){
                $("#moodleform").find("input[name='domainName']").remove();
                if($("#moodleform").find("input[name='name']").length <= 0){
                    var html = '<input type="hidden" name="name" value="'+domainNameHTML5+'"/>';
                    $("#moodleform").append(html);
                }else{
                    $("#moodleform").find("input[name='name']").val(domainNameHTML5);
                }
            }
        }else{
            path = newpath['IGE_FLASH'];
            var a = new Date();
            path += "?" + a.getTime();
            $("#moodleform").attr('method', 'POST');
            if( tempItem.engineType == "IGEICE" ){
                serviceData[tempItem.merchant_code]['lang'] = "eng";
                $("#moodleform").find("input[name='name']").remove();
                if($("#moodleform").find("input[name='domainName']").length <= 0){
                    var html = '<input type="hidden" name="domainName" value="'+domainNameFlash+'"/>';
                    $("#moodleform").append(html);
                }else{
                    $("#moodleform").find("input[name='domainName']").val(domainNameFlash);
                }
            }
        }
    }

    if(deviceType == 'PC'){
        $(".bannerTop").hide();
        $("#playScreen").hide();
        $(".gamePlayArea").hide();
        $('#playScreen').attr('src', 'about:blank');
        $(".gameDetailsBgInner").css('background-image', 'url(/images/siteImg/iwgBg/' + tempItem.gameNumber + '.jpg)');
        $('#playScreen').attr('height', '600px');
        $('#playScreen').css('height', '');
        $('#playScreen').attr('width', '800px');
        $('#playScreen').css('width', '');
        globalHeight = 600;
        globalWidth = 800;
        htmlGameResizer();
    }
    $("#moodleform").attr('action', path);
    if(deviceType != 'PC'){
        $("#moodleform").attr('target', 'gamewindow'+tempItem.gameNumber+'Buy');
        winChild['gamewindow'+tempItem.gameNumber+'Buy'] = window.open('about:blank', 'gamewindow'+tempItem.gameNumber+'Buy', 'location=0,toolbar=0,menubar=0,status=0,height='+gameH+',width='+gameW);
    }else{
        $("#moodleform").attr('target', 'playScreen');
    }
    $("#moodleform").find("input[name='root']").val(rootPath[tempItem.engineType]);
    $("#moodleform").find("input[name='gameNum']").val(tempItem.gameNumber);
    $("#moodleform").find("input[name='gameNumber']").val(tempItem.gameNumber);
    $("#moodleform").find("input[name='domainName']").val(serviceData[tempItem.merchant_code]['domainName']);
    $("#moodleform").find("input[name='merchantKey']").val(serviceData[tempItem.merchant_code]['merchantKey']);
    $("#moodleform").find("input[name='secureKey']").val(serviceData[tempItem.merchant_code]['secureCode']);
    $("#moodleform").find("input[name='currencyCode']").val(currencyCode);
    $("#moodleform").find("input[name='lang']").val(serviceData[tempItem.merchant_code]['lang']);
    $("#moodleform").find("input[name='playerId']").val(playerId);
    $("#moodleform").find("input[name='merchantSessionId']").val(merchantSessionId);
    $("#moodleform").find("input[name='clientType']").val(clientType);
    $("#moodleform").find("input[name='deviceType']").val(deviceType);
    $("#moodleform").find("input[name='appType']").val(appType);
    $("#moodleform").find("input[name='userAgentIge']").val(userAgentIge);
    $("#moodleform").find("input[name='balance']").val(instantPlayerBalance);
    $("#moodleform").find("input[name='launchIc']").val(tempItem.gameImageLocations);
    $("#moodleform").find("input[name='prizeSchemeIge']").val(tempItem.prizeSchemeIge);
    $("#moodleform").find("input[name='priceSchemes']").val(tempItem.prizeSchemeIge);
    $("#moodleform").find("input[name='prizeSchemeId']").val(Object.keys(JSON.parse(tempItem.prizeSchemeIge))[0]);
    $("#moodleform").find("input[name='ticketPrice']").val(Price);
    $("#moodleform").find("input[name='loaderImage']").val(JSON.stringify(JSON.parse(tempItem.extraParams).loaderImage));
    setTimeout(function () { $( "#moodleform").submit() }, 0);
//    $('#playScreen').attr('src', path);
    if(deviceType == 'PC'){
        location.hash = '#playScreen';
        $("#gamePlayDiv").show();
        $("#playScreen").show();
        $(".gamePlayArea").show();
        var gap = $('.gameDetailsBgInner').offset().top - 20;
        $('html,body').animate({scrollTop: gap}, 'slow');
    }
}

function fullScreenResizer() {
    gameRatio = width / (parseInt(height) + 80);
    screenRatio = ($(window).innerWidth() - 80) / ($(window).innerHeight() - 80);
    //        if( $(window).innerHeight() >= 702 ){
    //            screenRatio = ( window.innerWidth - 80 ) / 622 ;
    //            screenRatio = ( $(window).innerWidth() - 80 ) / ( $(window).innerHeight() - 80 );
    //            var newData = retioCalculator(screenRatio,gameRatio, height, width);
    //            $("#playScreen").css("height",newData[0]);
    //            $("#playScreen").css("width",newData[1]);
    //            globalHeight = parseInt(height)+80;
    //            globalWidth = width;
    //        } else
    //        {
    var newData = retioCalculator(screenRatio, gameRatio, height, width);
    $("#playScreen").css("height", newData[0]);
    $("#playScreen").css("width", newData[1]);
    globalHeight = parseInt(height) + 80;
    globalWidth = width;
    //        }
}

function htmlGameResizer() {
    gameRatio = gameW / (parseInt(gameH) + 80);
    screenRatio = ($(window).innerWidth() - 80) / ($(window).innerHeight() - 80);
    //        if( $(window).innerHeight() >= 702 ){
    //            screenRatio = ( $(window).innerWidth() - 80 ) / ( $(window).innerHeight() - 80 );
    //            var newData = retioCalculatorFullHTML(screenRatio,gameRatio, gameH, gameW);
    //            $("#playScreen").css("height",newData[0]);
    //            $("#playScreen").css("width",newData[1]);
    //            globalHeight = parseInt(gameH)+80;
    //            globalWidth = gameW;
    //        }else {
    var newData = retioCalculatorFullHTML(screenRatio, gameRatio, gameH, gameW);
    $("#playScreen").css("height", newData[0]);
    $("#playScreen").css("width", newData[1]);
    globalHeight = newData[0];
    globalWidth = newData[1];
    //        }
}

function retioCalculatorFull(screenRatio, gameRatio, height, width) {
    if (screenRatio >= gameRatio) {
        innerHeight = $(window).innerHeight();
        height1 = innerHeight - 80;
        var change = ((height1) / (parseInt(height) + 80)) * 100;
        height = height1;
        width = (parseInt(width)) * (change / 100);
    } else {
        width1 = $(window).innerWidth() - 80;
        var change1 = ((width1) / (parseInt(width))) * 100;
        width = width1;
        height = (parseInt(height) + 80) * (change1 / 100);
    }
    return [height, width];
}

function retioCalculator(screenRatio, gameRatio, height, width) {
    //console.log("aaaa " + screenRatio + ' ' + gameRatio + ' ' + height + ' ' + width);
    if (screenRatio >= gameRatio) {
        //            if( $(window).innerHeight() > 702 )
        //                innerHeight = 702;
        //            else
        innerHeight = $(window).innerHeight();
        height1 = innerHeight - 80;
        var change = ((height1) / (parseInt(height))) * 100;
        height = height1;
        width = (parseInt(width)) * (change / 100);
    } else {
        width1 = $(window).innerWidth() - 80;
        var change1 = ((width1) / (parseInt(width))) * 100;
        width = width1;
        height = (parseInt(height) + 80) * (change1 / 100);
    }
    //console.log("bbbb " + height + ' ' + width);
    return [height, width];
}

function retioCalculatorFullHTML(screenRatio, gameRatio, height, width) {
    if (screenRatio >= gameRatio) {
        innerHeight = $(window).innerHeight();
        height1 = innerHeight - 80;
        var change = ((height1) / (parseInt(height))) * 100;
        height = height1;
        width = (parseInt(width)) * (change / 100);
    } else {
        width1 = $(window).innerWidth() - 80;
        var change1 = ((width1) / (parseInt(width))) * 100;
        width = width1;
        height = (parseInt(height)) * (change1 / 100);
    }
    return [height, width];
}

function retioCalculatorHTML(screenRatio, gameRatio, height, width) {
    if (screenRatio >= gameRatio) {
        //            if( $(window).innerHeight() > 702 )
        //                innerHeight = 702;
        //            else
        innerHeight = $(window).innerHeight();
        height1 = innerHeight - 80;
        var change = ((height1) / (parseInt(height))) * 100;
        height = height1;
        width = (parseInt(width)) * (change / 100);
    } else {
        width1 = $(window).innerWidth() - 80;
        var change1 = ((width1) / (parseInt(width))) * 100;
        width = width1;
        height = (parseInt(height)) * (change1 / 100);
    }
    return [height, width];
}

function toggleFullScreen() {
    var element = document.getElementById('gamePlayDiv');
    //        $("#gamePlayDiv").css('height',"100%");
    //        $("#gamePlayDiv .gameDetailsBgInner").css('height',"100%");
    //        $("#gamePlayDiv").css('width',"100%");
    if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        $("#gamePlayDiv").addClass('fullScreeOn');
        if (element.requestFullScreen) {
            element.requestFullScreen();
        } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
        } else if (element.webkitRequestFullScreen) {
            element.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
//        $('#playScreen').attr('height', '600px');
//        $('#playScreen').css('height', '');
//        $('#playScreen').attr('width', '800px');
//        $('#playScreen').css('width', '');
//        globalHeight = 600;
//        globalWidth = 800;
//        htmlGameResizer();

        //} else {
        gameRatio = gameW / (parseInt(gameH) + 80);
        screenRatio = ($(window).innerWidth() - 80) / ($(window).innerHeight() - 80);
        //                if( $(window).innerHeight() >= 702 ) {
        //                    //                screenRatio = ( window.innerWidth - 80 ) / 622 ;
        //                    screenRatio = ( $(window).innerWidth() - 80 ) / ( $(window).innerHeight() - 80 );
        //                    var newData = retioCalculatorFull(screenRatio,gameRatio, gameH, gameW);
        //                    $("#playScreen").css("height",newData[0]);
        //                    $("#playScreen").css("width",newData[1]);
        //                    globalHeight = parseInt(gameH)+80;
        //                    globalWidth = gameW;
        //                }  else{
        screenRatio = ($(window).innerWidth() - 80) / ($(window).innerHeight() - 80);
        var newData = retioCalculator(screenRatio, gameRatio, gameH, gameW);
        $("#playScreen").css("height", newData[0]);
        $("#playScreen").css("width", newData[1]);
        //                    globalHeight = parseInt(gameH)+80;
        //                    globalWidth = gameW;
        //                }
        //}

    } else {
        $("#gamePlayDiv").removeClass('fullScreeOn');
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
        $('#playScreen').attr('height', '600px');
        $('#playScreen').css('height', '');
        $('#playScreen').attr('width', '800px');
        $('#playScreen').css('width', '');
        $("#playScreen").css("height", globalHeight);
        $("#playScreen").css("width", globalWidth);
        /*
         } else {
         gameRatio = gameW / (parseInt(gameH) + 80);
         screenRatio = ($(window).innerWidth() - 80) / ($(window).innerHeight() - 80);
         //                if( $(window).innerHeight() >= 702 ) {
         //                    //                screenRatio = ( window.innerWidth - 80 ) / 622 ;
         //                    screenRatio = ( $(window).innerWidth() - 80 ) / ( $(window).innerHeight() - 80 );
         //                    var newData = retioCalculator(screenRatio,gameRatio, gameH, gameW);
         //                    $("#playScreen").css("height",newData[0]);
         //                    $("#playScreen").css("width",newData[1]);
         //                    globalHeight = parseInt(gameH)+80;
         //                    globalWidth = gameW;
         //                }
         //                else
         //                {
         var newData = retioCalculator(screenRatio, gameRatio, gameH, gameW);
         $("#playScreen").css("height", globalHeight);
         $("#playScreen").css("width", globalWidth);
         //                    globalHeight = parseInt(gameH)+80;
         //                    globalWidth = gameW;
         //                }
         }
         */
    }
}

function listener(event){
    if(event.data=='updateBal'){
//        var playerId = playerId;
        if( playerId.trim().length != 0 ){
            updatePlayerBalance(false);
        }
    }
    if(event.data=='updateParent' || event.data=='loginWindow'){
        if(deviceType != 'PC'){
            for (var key in winChild) {
                winChild[key].close();
            }
            winChild = [];
        }
        location.reload();
    }
    if(event.data=='backToLobby'){
        backToLobby();
    }
}

function backToLobby(){
    if(deviceType == 'PC'){
        $(".bannerTop").show();
        $("#playScreen").hide();
        $('#playScreen').attr('src', 'about:blank');
        $(".gamePlayArea").hide();
        $("#gamePlayDiv").hide();
        if( $("#gamePlayDiv").hasClass('fullScreeOn'))
            toggleFullScreen();
    }else{
        for (var key in winChild) {
            winChild[key].close();
        }
        winChild = [];
    }
}

if (window.addEventListener){
    window.addEventListener("message", listener, false)
} else {
    window.attachEvent("onmessage", listener)
}

// $(document).ready(function(){
//     window.history.pushState(null, null, '/play-now/eaziwin');
//     window.onpopstate = function () {
//         window.href="/play-now/eaziwin";
//         backToLobby();
//     };
// })

// window.onhashchange = function() {
//     alert('hi');
//     showOption("Are you sure to move from this page. Your game may be affected.",'Are you Sure!',function(){
//         window.href="/play-now/eaziwin";    
//     }) 
// }


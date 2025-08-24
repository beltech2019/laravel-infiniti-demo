var $ = jQuery.noConflict();
var networkErrorMsg="Network Failure, Please Try Again.";
var TwelveToTwentyFourFixedBetType=["First12","Last12","AllOdd","AllEven","OddEven","EvenOdd","JumpEvenOdd","JumpOddEven"];
var longpress_time_plus=null;

function longPressOn(func,param)
{
    //event.originalEvent.stopImmediatePropagation();
    //event.originalEvent.stopPropagation();
    longpress_time_plus = setInterval(function(){
        if(func=="updateBetMul")
            updateBetMul(param);
        else if(func="updateNumCount")
            updateNumCount(param);
    }, 200);
}

function longPressOff()
{
    //event.originalEvent.stopImmediatePropagation();
    //event.originalEvent.stopPropagation();
    clearInterval(longpress_time_plus);
}

Date.prototype.isValid = function () {
    // An invalid date object returns NaN for getTime() and NaN is the only
    // object not strictly equal to itself.
    return this.getTime() === this.getTime();
};

$.validator.addMethod("alphanumericonly", function(value, element) {
    return this.optional(element) || /^[a-z0-9]+$/i.test(value);
}, "This field must contain only letters, numbers.");

$.validator.addMethod("alphanumericspace", function(value, element) {
    return this.optional(element) || /^[a-z0-9\s]+$/i.test(value);
}, "This field must contain only letters, numbers, or space.");

$.validator.addMethod("myemail", function(value, element) {
    return this.optional(element) || /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i.test(value);
}, "Please enter a valid email address.");

$( document ).ready(function() {
    //$(".AjaxPreloaderC").css('display','block');
    $('body').css('overflow-y','hidden');
    $(document).ajaxStart(function(){
        pmslog(window.location.href.indexOf("edit-my-profile"));
        if(window.location.href.indexOf("edit-my-profile")==-1)
        {
            hideMsg();
        }
        $("#loader").css("display","block");
    });
    $(document).ajaxStop(function(){
        $("#loader").css("display","none");
    });
    if(document.getElementById('system-message-container')!=undefined)
        document.getElementById('system-message-container').setAttribute("class", "row");
    $(".alert-heading").css("display","none");
    if($('.header-top .t3-spotlight .t3-module .module-ct > div').html())
        $(".t3-megamenu").append("<div class='poping_links nav navbar-nav navbar-right'>"+($('.header-top .t3-spotlight .t3-module .module-ct > div').html())+"</div>");
    //$(".t3-sidebar .module-ct ul.nav.menu li:first-child").addClass('current active');
    $("[data-toggle='modal']").on("click",function(){
        if($('.modal .modal-footer').html().trim()=='')
            $('.modal .modal-footer').css('display','none');
        else
            $('.modal .modal-footer').css('display','block');
        $("body").addClass("modal-open");
    });
    $("a").on("click",function(){
        if($('.modal .modal-footer').html().trim()=='')
            $('.modal .modal-footer').css('display','none');
        else
            $('.modal .modal-footer').css('display','block');
    });
/*
    $("div").on("click",function(){
        if($('.modal .modal-footer').html().trim()=='')
            $('.modal .modal-footer').css('display','none');
        else
            $('.modal .modal-footer').css('display','block');
    });
*/
    adjustSideBar();
    $('[type="number"]').attr('min','1');
    $('.alert-error a.close').css('display','none');
    $('.alert-danger a.close').css('display','none');
});

setTimeout(function(){ removeLoader(); }, 8000);

$(window).load(function(){
    removeLoader();
})

function removeLoader()
{
    $('body').css('overflow-y','auto');
    pmslog('hello');
    $(".AjaxPreloaderC").fadeOut();
}


function adjustSideBar()
{
    if($('*').hasClass('leftMenuCloneWrap'))
        $('.leftMenuCloneWrap').remove();

    if($(".t3-sidebar .t3-module .module-ct > ul").is( ".nav",".menu" ) && window.innerWidth <=991)
    {
        var cloneTitle = $(".t3-sidebar > .t3-module:first-child .module-title span").html();
        var cloneListArray = [];
        $(".t3-sidebar .t3-module .module-ct > ul.nav.menu li").each(function() {
            cloneListArray.push([$(this).find('a').attr('href'), $(this).find('a').html()]);
        });

        var selectCloneListMenu = "";
        var count=0;
        jQuery.each(cloneListArray, function(key, value){
            if(count==0){
                if(value[0].indexOf('#')==-1){
                    selectCloneListMenu += "<div class='leftMenuCloneWrap'><div class='leftMenuCloneInnerWrap'><div class='cloneTitle'>"+cloneTitle+"</div>        <div class='cloneSelector'><select id='leftMenuClone' name='leftMenuClone' onchange='if(this.value) window.location.href=this.value;'>";
                }
                else{
                    selectCloneListMenu += "<div class='leftMenuCloneWrap'><div class='leftMenuCloneInnerWrap'><div class='cloneTitle'>"+cloneTitle+"</div>        <div class='cloneSelector'><select id='leftMenuClone' name='leftMenuClone' onchange='if(this.value){ window.location.href=this.value; location.reload();}'>";
                }
            }
            count++;
            selectCloneListMenu += "<option value='"+value[0]+"'>"+value[1]+"</option>";
        });
        selectCloneListMenu += "</select></div></div></div>";

        $('.MainRow .t3-mainbody').prepend(selectCloneListMenu);
        selectCloneListMenu = "";
        $("#leftMenuClone option[value='"+$(".t3-sidebar .t3-module .module-ct > ul.nav.menu li.current a").attr('href')+"']").attr("selected","selected");
        $(".t3-sidebar > .t3-module:first-child").hide();
    }
    else
    {
        $(".t3-sidebar > .t3-module:first-child").show();
    }
}

function error_display(msg,id)
{
    var errmsg="<div id='system-message'><div class='alert alert-error'><a class=\"close\" data-dismiss=\"alert\" onclick='hideMsg();'>×</a><div><p>"+msg+"</p></div></div></div>";
    //var errmsg="<div class='alert alert-error'><h4>Error</h4>"+msg+"</div>";
    document.getElementById('system-message-container').innerHTML=errmsg;
    if(id!=undefined)
    {
        document.getElementById(id).focus();
        document.getElementById(id).value="";
    }
    window.scrollTo(0, 0);
}


function success_display(msg,id)
{
    var errmsg="<div id='system-message'><div class='alert alert-success'><a class=\"close\" data-dismiss=\"alert\" onclick='hideMsg();'>×</a><div><p>"+msg+"</p></div></div></div>";
    //var errmsg="<div class='alert alert-success' style='padding-bottom:15px;'><a class=\"close\" data-dismiss=\"alert\">ï¿½</a>"+ucwords(msg)+"</div>";
    document.getElementById('system-message-container').innerHTML=errmsg;
    if(id!=undefined)
    {
        document.getElementById(id).focus();
        document.getElementById(id).value="";
    }
    window.scrollTo(0, 0);
}


function info_display(msg,id)
{
    var errmsg="<div id='system-message'><div class='alert alert-info'><a class=\"close\" data-dismiss=\"alert\" onclick='hideMsg();'>×</a><div><p>"+msg+"</p></div></div></div>";
    //var errmsg="<div class='alert alert-info' style='padding-bottom:15px;'><a class=\"close\" data-dismiss=\"alert\">ï¿½</a>"+ucwords(msg)+"</div>";
    document.getElementById('system-message-container').innerHTML=errmsg;
    if(id!=undefined)
    {
        document.getElementById(id).focus();
        document.getElementById(id).value="";
    }
    window.scrollTo(0, 0);
}

function hideMsg(){
    document.getElementById('system-message-container').innerHTML="";
}

function valiatePhone(field,value)
{
    hideMsg();
    for(var i=0; i<value.length; i++)
    {
        if(!(value.charCodeAt(i) >=48 && value.charCodeAt(i) <=57))
        {
            error_display(field+" should be numeric.");
            return false;
        }
    }
}

function valiateNumeric(field,value)
{
    hideMsg();
    for(var i=0; i<value.length; i++)
    {
        if(!((value.charCodeAt(i) >=48 && value.charCodeAt(i) <=57) || (value.charCodeAt(i) == 46)))
        {
            error_display(field+" should be numeric.");
            return false;
        }
    }
}

function validateAmount(amount){
    for(var i=0; i<amount.length; i++)
    {
        if(!((amount.charCodeAt(i) >=48 && amount.charCodeAt(i) <=57) || (amount.charCodeAt(i) == 46) || (amount.charCodeAt(i) == 45)))
        {
            error_display("Amount should be numeric.");
            return false;
        }
    }

    var dotArr = amount.split('.');

    if(dotArr.length>2 || amount.indexOf('.')==0){
        error_display("Invalid Amount.");
        return false;
    }

    if(dotArr.length==2){
        if(dotArr[1].length>2){
            error_display("Invalid Amount, Only Two Digits Are Allowed After Decimal.");
            return false;
        }
        if(dotArr[1].length<=0){
            error_display("Invalid Amount.");
            return false;
        }
    }

    if (amount == "") {
        error_display("Amount should be numeric.");
        return false;
    }

    if (amount == 0 || amount < 0) {
        error_display("Amount Must Be Greater Than Zero.");
        return false;
    }
    return true;
}

function amountRoundOff(tktPrice){
    tmpTktPrice=0;
    tktPrice=tktPrice+"";
    tktPrice = tktPrice.replace(",","");
    if(tktPrice<=0)
    {
        tmpTktPrice = "0";
    }else if(tktPrice>10){
        var tmpArr=tktPrice.split(".");
        tmpTktPrice = tmpArr[0]+".00";
    }else{
        if(tktPrice<"0.50"){
            tmpTktPrice = "0.50";
        }else{
            var tmpArr=tktPrice.split(".");
            var roundedVal=0;
            var mainValue=pmsParseInt(tmpArr[0]);
            var secondValue ="00";
            if(tmpArr[1]!=undefined){
                secondValue =  tmpArr[1] + (tmpArr[1]< "10" ? "0" : "");
            }
            if(secondValue >="00" && secondValue <"25"){
                roundedVal="00";
            }
            if(secondValue >="25" && secondValue <"75"){
                roundedVal="50";
            }
            if(secondValue >="75"){
                mainValue++;
                roundedVal="00";
            }
            tmpTktPrice = mainValue+"."+roundedVal;
        }
    }
    return getFormattedAmount(tmpTktPrice);
}

//function validateSession(data) {
//    if(data.sessVar == true) {
//        if(data.responseMsg !="" && data.responseMsg != undefined && data.responseMsg != 'undefined' && data.responseMsg != 'null')
//            alert(data.responseMsg)
//        else
//            alert("Session Expired");
//        location.href = "/login";
//    }
//}

function pmslog(value){
    console.log(value);
}

function pmslogClear(){
    if (typeof console._commandLineAPI !== 'undefined') {
        console.API = console._commandLineAPI;
    } else if (typeof console._inspectorCommandLineAPI !== 'undefined') {
        console.API = console._inspectorCommandLineAPI;
    } else if (typeof console.clear !== 'undefined') {
        console.API = console;
    }
    console.API.clear();
}

function getRemainingTime(currentTime,timeAdd,drawTime,freezTime){
    //var loginTime = new Date(PMS.loginDetails.currentTime);
    var baseTime = getMiliSeconds(currentTime);
    var timerValue = timeAdd*1000;
    freezTime = freezTime * 1000;
    //var drawTimeValue = new Date(drawTime);
    var drawTimeInMiliSec = Math.abs(getMiliSeconds(drawTime));
    //document.write(drawTimeInMiliSec);
    var timeLeft = drawTimeInMiliSec - freezTime - baseTime - timerValue;
    timeLeft = 999999;
    if(timeLeft>=0){
        var hours = Math.floor(timeLeft/(1000*60*60));
        var minutes = Math.floor((timeLeft-(hours*60*60*1000))/(1000*60));
        var secs = Math.floor((timeLeft-(hours*60*60*1000)-(minutes*60*1000))/(1000));
        hours = (hours < 10 ? "0" : "") + hours;
        minutes = (minutes < 10 ? "0" : "") + minutes;
        secs = (secs < 10 ? "0" : "") + secs;
        return {"timeStr":hours+":"+minutes+":"+secs,"timeValue":timeLeft};
    }else{
        return -1;
    }
}

function getMiliSeconds(dateStr){
    var arr = dateStr.split(/[- :]/);
    var date = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
    return date.getTime();
}

function tick(timeAdd){
    return pmsParseInt(timeAdd)+1;
}

function validateAmt(amount){
    for(var i=0; i<amount.length; i++)
        if(!((amount.charCodeAt(i) >=48 && amount.charCodeAt(i) <=57) || (amount.charCodeAt(i) == 46)))
        {
            return JSON.parse('{"message":"Amount should be numeric","flag":false}');
        }

    var dotArr = amount.split('.');

    if(dotArr.length>2 || amount.indexOf('.')==0){
        return JSON.parse('{"message":"Invalid Amount","flag":false}');
    }

    if(dotArr.length==2){
        if(dotArr[1].length>2){
            return JSON.parse('{"message":"Invalid Amount, Only Two Digits Are Allowed After Decimal.","flag":false}');
        }
        if(dotArr[1].length<=0){
            return JSON.parse('{"message":"Invalid Amount","flag":false}');
        }
    }

    if (amount == "") {
        return JSON.parse('{"message":"Amount Should Not Be Blank.","flag":false}');
    }

    if (amount == 0 || amount < 0) {
        return JSON.parse('{"message":"Amount Should Not Be Zero.","flag":false}');
    }
    return JSON.parse('{"message":"OK","flag":true}');
}

function chkdateValidate(dd,mm,yy)
{
    mon=mm;
    day=dd;
    year=yy;
    if(mm!="" && dd!="" && yy!="")
    {
        if( mon==4 || mon==6 || mon==9 || mon==11)
        {
            if(day>30)
            {
                return false;
            }
        }
        else if( mon==1 || mon==3 || mon==5 || mon==7 || mon==8 || mon==10)
        {
            if(day>31)
            {
                return false;
            }
        }
        else if(mon==2)
        { //february
            if(((year%100==0) && (year%400==0)) || ((year%100 != 0)&&(year%4==0)) )		//(year%4==0)
            {	//leap year
                if(day > 29)
                {
                    return false;
                }
            }
            else
            {
                if(day > 28)
                {
                    return false;
                }
            }
        }
        else
        {
            return false;
        }
        return true;
    }else{
        return false;
    }
}

function pmsParseInt(number){
    return parseInt(number, 10);
}

function windowOpenMethod(url, windowParam, width, height, jmUrl) {
    /*var leftPosition = (screen.width/2)-(width/2);
     var topPosition = (screen.height/2)-(height/2);
     isOpen = window.open(url + "", "main","left="
     + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY="
     + topPosition +",scrollbars=1", windowParam );
     isOpen.resizeTo(width+20, height+30);
     isOpen.focus();*/

    //window.open(url,windowParam,'location=0,toolbar=0,menubar=0,status=0,height='+height+',width='+width);

    var opened_window = window.open('about:blank',windowParam,'location=0,toolbar=0,menubar=0,status=0,height='+height+',width='+width);

    var get_params = url.split("?")[1].split("&");
    var form_elem_html ='';
    for(var i=0; i<get_params.length; i++) {
        var tmp = get_params[i].split("=");
        form_elem_html += "<input type='hidden' name='"+tmp[0]+"' value='"+tmp[1]+"' />";
    }

    form_elem_html = '<form action="'+url.split("?")[0]+'" method="post" name="hidden_form" id="hidden_form">'+form_elem_html+'</form>';
    opened_window.document.write(form_elem_html);
    opened_window.document.getElementById("hidden_form").submit();
}

function getFormattedNo(number)
{
    return (pmsParseInt(number) < 10 ? "0" : "") + pmsParseInt(number);
}

function getOriginalAmount(amount)
{
    return Number(amount.replace(",",""));
}

function getFormattedAmount(amount)
{
    amount = amount+"";
    amount = amount.replace(",","");
    var tmp = amount.split(".");
    if(tmp.length==2)
    {
        if(tmp[1].length>2)
        {
            if(tmp[1].substr(0,2)!="00")
                return number_format(amount, 2);
        }
        else if(tmp[1].length==2)
        {
            if(tmp[1]!="00")
                return number_format(amount, 2);
        }
        else if(tmp[1].length==1)
        {
            if(tmp[1]!="0")
                return number_format(amount, 2);
        }
        else
        {
            return number_format(amount, 0);
        }
    }
    return number_format(amount, 0);
}

function number_format(number, decimals, dec_point, thousands_sep) {
    //  discuss at: http://phpjs.org/functions/number_format/
    // original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // improved by: davook
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Brett Zamir (http://brett-zamir.me)
    // improved by: Theriault
    // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // bugfixed by: Michael White (http://getsprink.com)
    // bugfixed by: Benjamin Lupton
    // bugfixed by: Allan Jensen (http://www.winternet.no)
    // bugfixed by: Howard Yeend
    // bugfixed by: Diogo Resende
    // bugfixed by: Rival
    // bugfixed by: Brett Zamir (http://brett-zamir.me)
    //  revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    //  revised by: Luke Smith (http://lucassmith.name)
    //    input by: Kheang Hok Chin (http://www.distantia.ca/)
    //    input by: Jay Klehr
    //    input by: Amir Habibi (http://www.residence-mixte.com/)
    //    input by: Amirouche
    //   example 1: number_format(1234.56);
    //   returns 1: '1,235'
    //   example 2: number_format(1234.56, 2, ',', ' ');
    //   returns 2: '1 234,56'
    //   example 3: number_format(1234.5678, 2, '.', '');
    //   returns 3: '1234.57'
    //   example 4: number_format(67, 2, ',', '.');
    //   returns 4: '67,00'
    //   example 5: number_format(1000);
    //   returns 5: '1,000'
    //   example 6: number_format(67.311, 2);
    //   returns 6: '67.31'
    //   example 7: number_format(1000.55, 1);
    //   returns 7: '1,000.6'
    //   example 8: number_format(67000, 5, ',', '.');
    //   returns 8: '67.000,00000'
    //   example 9: number_format(0.9, 0);
    //   returns 9: '1'
    //  example 10: number_format('1.20', 2);
    //  returns 10: '1.20'
    //  example 11: number_format('1.20', 4);
    //  returns 11: '1.2000'
    //  example 12: number_format('1.2000', 3);
    //  returns 12: '1.200'
    //  example 13: number_format('1 000,50', 2, '.', ' ');
    //  returns 13: '100 050.00'
    //  example 14: number_format(1e-8, 8, '.', '');
    //  returns 14: '0.00000001'

    number = (number + '')
        .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + (Math.round(n * k) / k)
                    .toFixed(prec);
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
        .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
            .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
            .join('0');
    }
    return s.join(dec);
}

function pmsRoundOff(val,place){
    return getFormattedAmount(val);
    if (arguments.length == 1)
        return Math.round(val);

    var multiplier = Math.pow(10, place);
    return (Math.round(val * multiplier) / multiplier).toFixed(2);
}

function parseSlePurchase(data,type,currency){
    if(type=="TRACK")
    {
        var tickettop="ticket-d-top";
        var ticket="ticket-d";
        var ticketbottom="ticket-d-bottom";
    }
    else
    {
        var tickettop="ticket-top";
        var ticket="ticket";
        var ticketbottom="ticket-bottom";
    }
    var str = "<div class='row'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12' align='center'>" +
        "<div class='row "+tickettop+"'>&nbsp;</div>" +
        "<div class='row "+ticket+"'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><h3>"+data.tktData.gameName+"</h3></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>" +
        "<div><div class='ticket-left'><b>Purchased On :</b></div>" +
        "<div class='ticket-right'>" + data.tktData.purchaseDate +" "+ data.tktData.purchaseTime+ "</div><div class='clearBoth'></div></div>" +
        "<div><div class='ticket-left'><b>Ticket Number :</b></div>" +
        "<div class='ticket-right'>" + data.tktData.ticketNo + "</div><div class='clearBoth'></div></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
    drawName = data.tktData.boardData[0].drawName;
    if(drawName == "")
        drawName="N.A.";

    if(drawName!="N.A."){
        str = str + "<div class='col-xs-12 col-sm-12 col-md-12 draw-name' align='center'><h4>" +drawName + "</h4></div>" ;
    }

    str = str +"<div><div class='ticket-left'><b>Draw Time :</b></div>" +
        "<div class='ticket-right'>" + data.tktData.boardData[0].drawDate +" "+ data.tktData.boardData[0].drawTime + "</div><div class='clearBoth'></div></div>";

    if(type=="TRACK")
    {
        if(parseFloat(data.tktData.boardData[0].winAmt)>0)
        {
            str = str + "<div><div class='ticket-left'><b>Winning Amount :</b></div>" +
                "<div class='ticket-right'>" + currency+getFormattedAmount(data.tktData.boardData[0].winAmt) + "</div><div class='clearBoth'></div></div>" ;
        }
    }
    str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><b>"+ data.tktData.gameTypeName +"</b></div>";
    var eventData = data.tktData.boardData[0].eventData;
    var tmpEventArr=data.tktData.eventType.split(",");
    for (var i=0; i < eventData.length; i++) {
        var hselected='';
        var aselected='';
        var dselected='';
        var hpselected='';
        var apselected='';
        var tmpArr=eventData[i].selection.split(",");
        if(tmpArr.indexOf('H')!=-1)
            var hselected='selected';
        if(tmpArr.indexOf('A')!=-1)
            var aselected='selected';
        if(tmpArr.indexOf('D')!=-1)
            var dselected='selected';
        if(tmpArr.indexOf('H+')!=-1)
            var hpselected='selected';
        if(tmpArr.indexOf('A+')!=-1)
            var apselected='selected';
        str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>";
        var tmpDateArr=eventData[i].eventDate.split(/[- :]/);
        var eventDate=tmpDateArr[2]+"-"+tmpDateArr[1]+"-"+tmpDateArr[0]+" ";
        var eventTime=tmpDateArr[3]+":"+tmpDateArr[4];
        if(tmpEventArr.length==3)
        {
            str = str + "<div class='gameDivtkt sportsLottWrap'>" +
                "<div class='gameDivInner'>"+
                "<div class='titleAndDateWrap'><div class='dateWrap'>"+eventDate+ "<strong>"+eventTime+"</strong></div><div class='titleNameWrap'>"+eventData[i].eventLeague+", "+eventData[i].eventVenue+"</div><div class='clearBoth'></div></div>"+
                "<div class='row'>"+
                "<div class='col-xs-5 text-center'><div class='abbri'>"+eventData[i].eventCodeHome+"</div><div class='abbriName'>"+eventData[i].eventDisplayHome+"</div></div>"+
                "<div class='col-xs-2 text-center'><span class='vsWrap'>VS</span></div>"+
                "<div class='col-xs-5 text-center'><div class='abbri'>"+eventData[i].eventCodeAway+"</div><div class='abbriName'>"+eventData[i].eventDisplayAway+"</div></div>"+
                "</div>"+
                "<div class='row selectArea'>"+
                "<div class='col-xs-4'><span class='textWrapConFirm "+hselected+"'>Home</span></div>"+
                "<div class='col-xs-4'><span class='textWrapConFirm "+dselected+"'>Draw</span></div>"+
                "<div class='col-xs-4'><span class='textWrapConFirm "+aselected+"'>Away</span></div>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>";
        }
        if(tmpEventArr.length==5)
        {
            str = str + "<div class='gameDivtkt sportsLottWrap'>" +
                "<div class='gameDivInner'>"+
                "<div class='titleAndDateWrap'><div class='dateWrap'>"+eventDate+ "<strong>"+eventTime+"</strong></div><div class='titleNameWrap'>"+eventData[i].eventLeague+", "+eventData[i].eventVenue+"</div><div class='clearBoth'></div></div>"+
                "<div class='row'>"+
                "<div class='col-xs-5 text-center'><div class='abbri'>"+eventData[i].eventCodeHome+"</div><div class='abbriName'>"+eventData[i].eventDisplayHome+"</div></div>"+
                "<div class='col-xs-2 text-center'><span class='vsWrap'>VS</span></div>"+
                "<div class='col-xs-5 text-center'><div class='abbri'>"+eventData[i].eventCodeAway+"</div><div class='abbriName'>"+eventData[i].eventDisplayAway+"</div></div>"+
                "</div>"+
                "<div class='row selectArea'>"+
                "<div class='col-xs-2'><span class='numWrapConFirm "+hpselected+"'>H+</span></div>"+
                "<div class='col-xs-2'><span class='numWrapConFirm "+hselected+"'>H</span></div>"+
                "<div class='col-xs-2'><span class='numWrapConFirm "+dselected+"'>D</span></div>"+
                "<div class='col-xs-2'><span class='numWrapConFirm "+aselected+"'>A</span></div>"+
                "<div class='col-xs-2'><span class='numWrapConFirm "+apselected+"'>A+</span></div>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>";
        }
    }
    str = str +"<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>" +
        "<div><div class='ticket-left'><b>Number Of Lines :</b></div>" +
        "<div class='ticket-right'>" + data.tktData.boardData[0].noOfLines+ "</div><div class='clearBoth'></div></div>" ;
    str+="<div><div class='ticket-left'><b>Bet Amount :</b></div>" +
        "<div class='ticket-right'>"+currency   + getFormattedAmount(data.tktData.ticketAmt/(data.tktData.boardData[0].noOfLines)) + "</div><div class='clearBoth'></div></div>";

    str = str +"<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
    str = str +"<div><div class='ticket-left'><b>Total Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(data.tktData.ticketAmt)+ "</b></div><div class='clearBoth'></div></div>";

    str = str +"<div><div class='ticket-left'><b>Payable Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(data.tktData.ticketAmt)+ "</b></div><div class='clearBoth'></div></div>";

    str +="<div class='col-xs-12 col-sm-12 col-md-12 text-center' id='bcTarget' align='center' style='padding:none !important;width:100% !important'></div>" +"<div class='col-xs-12 col-sm-12 col-md-12 text-center'>"+data.tktData.ticketNo+"</div>" + "</div>" +
        "<div class='row "+ticketbottom+"'>&nbsp;</div>";
    str= str+"</div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "</div>";
    return str;
}

function parseKenoPurchase(data,type,currency)
{
    if(type=="TRACK")
    {
        var tickettop="ticket-d-top";
        var ticket="ticket-d";
        var ticketbottom="ticket-d-bottom";
    }
    else
    {
        var tickettop="ticket-top";
        var ticket="ticket";
        var ticketbottom="ticket-bottom";
    }
    var str = "<div class='row'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12' align='center'>" +
        "<div class='row "+tickettop+"'>&nbsp;</div>" +
        "<div class='row "+ticket+"'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><h3>"+data.ticketData.gameName+"</h3></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>" +
        "<div><div class='ticket-left'><b>Purchased On :</b></div>" +
        "<div class='ticket-right'>" + data.ticketData.purchaseTime+ "</div><div class='clearBoth'></div></div>" +
        "<div><div class='ticket-left'><b>Ticket Number :</b></div>" +
        "<div class='ticket-right'>" + data.ticketData.ticketNumber + "</div><div class='clearBoth'></div></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
    //Draw Section Start
    var totalAmount=0;
    for(var d=0;d<data.ticketData.drawData.length;d++){
        drawName = data.ticketData.drawData[d].drawName;
        if(drawName == "")
            drawName="N.A.";

        if(drawName!="N.A."){
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 draw-name' align='center'><h4>" +drawName + "</h4></div>" ;
        }

        str = str +"<div><div class='ticket-left'><b>Draw Time :</b></div>" +
            "<div class='ticket-right'>" + data.ticketData.drawData[d].drawDate +" "+ data.ticketData.drawData[d].drawTime + "</div><div class='clearBoth'></div></div>";

        str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>" +
            "<div><div class='ticket-left'><b>"+ data.ticketData.panelData[0].betName +"</b></div>" +
            "<div class='ticket-right'><b>" + (data.ticketData.panelData[0].isQP ? "QP" : "MANUAL") + "</b></div><div class='clearBoth'></div></div>";

        //Bet Type Section Start

        for (var i=0; i < data.ticketData.panelData.length; i++) {
            var tmpArrMain=data.ticketData.panelData[i].pickedNumbers.split("Nxt");
            for(var l=0;l<tmpArrMain.length;l++){
                var tmpArr=tmpArrMain[l].split(",");
                var numLength=tmpArr.length;
                if(data.ticketData.panelData[i].betName.toLowerCase()=="banker"){
                    var numbersul=[];
                    var numbersbl=[];
                    var numberstmp=[];
                    for(var i=0;i<tmpArr.length;i++){
                        if(tmpArr[i]=="UL"){
                            numbersul=numberstmp;
                            numberstmp=[];
                        }else if(tmpArr[i]=="BL"){
                            numbersbl=numberstmp;
                            numberstmp=[];
                        }else{
                            numberstmp.push((pmsParseInt(tmpArr[i]) < 10 ? "0" : "") + pmsParseInt(tmpArr[i]));
                        }
                    }
                    for(var k=0;k<numbersul.length;k=k+6){
                        str = str + "<div class='pms-grid-6 ticket-numbers'>";
                        if(numbersul[k]!=undefined){
                            var tmpNo1 = (pmsParseInt(numbersul[k]) < 10 ? "0" : "") + pmsParseInt(numbersul[k]);
                            str = str + "<div class='pms-block-a'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo1+"</span> </span></div>";
                        }
                        if(numbersul[k+1]!=undefined){
                            var tmpNo2 = (pmsParseInt(numbersul[k+1]) < 10 ? "0" : "") + pmsParseInt(numbersul[k+1]);
                            str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo2+"</span> </span></div>";
                        }
                        if(numbersul[k+2]!=undefined){
                            var tmpNo3 = (pmsParseInt(numbersul[k+2]) < 10 ? "0" : "") + pmsParseInt(numbersul[k+2]);
                            str = str + "<div class='pms-block-c'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo3+"</span> </span></div>";
                        }
                        if(numbersul[k+3]!=undefined){
                            var tmpNo4 = (pmsParseInt(numbersul[k+3]) < 10 ? "0" : "") + pmsParseInt(numbersul[k+3]);
                            str = str + "<div class='pms-block-d'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo4+"</span> </span></div>";
                        }
                        if(numbersul[k+4]!=undefined){
                            var tmpNo5 = (pmsParseInt(numbersul[k+4]) < 10 ? "0" : "") + pmsParseInt(numbersul[k+4]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo5+"</span> </span></div>";
                        }
                        if(numbersul[k+5]!=undefined){
                            var tmpNo6 = (pmsParseInt(numbersul[k+5]) < 10 ? "0" : "") + pmsParseInt(numbersul[k+5]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo6+"</span> </span></div>";
                        }
                        str = str + "</div>";
                    }
                    for(var k=0;k<numbersbl.length;k=k+6){
                        str = str + "<div class='pms-grid-6 ticket-numbers'>";
                        if(numbersbl[k]!=undefined){
                            var tmpNo1 = (pmsParseInt(numbersbl[k]) < 10 ? "0" : "") + pmsParseInt(numbersbl[k]);
                            str = str + "<div class='pms-block-a'><span class='btn btn-info btn-sm round_button_display lotto-ball pms_button_bl' data-toggle='button'><span class='size2'>"+tmpNo1+"</span> </span></div>";
                        }
                        if(numbersbl[k+1]!=undefined){
                            var tmpNo2 = (pmsParseInt(numbersbl[k+1]) < 10 ? "0" : "") + pmsParseInt(numbersbl[k+1]);
                            str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball pms_button_bl' data-toggle='button'><span class='size2'>"+tmpNo2+"</span> </span></div>";
                        }
                        if(numbersbl[k+2]!=undefined){
                            var tmpNo3 = (pmsParseInt(numbersbl[k+2]) < 10 ? "0" : "") + pmsParseInt(numbersbl[k+2]);
                            str = str + "<div class='pms-block-c'><span class='btn btn-info btn-sm round_button_display lotto-ball pms_button_bl' data-toggle='button'><span class='size2'>"+tmpNo3+"</span> </span></div>";
                        }
                        if(numbersbl[k+3]!=undefined){
                            var tmpNo4 = (pmsParseInt(numbersbl[k+3]) < 10 ? "0" : "") + pmsParseInt(numbersbl[k+3]);
                            str = str + "<div class='pms-block-d'><span class='btn btn-info btn-sm round_button_display lotto-ball pms_button_bl' data-toggle='button'><span class='size2'>"+tmpNo4+"</span> </span></div>";
                        }
                        if(numbersbl[k+4]!=undefined){
                            var tmpNo5 = (pmsParseInt(numbersbl[k+4]) < 10 ? "0" : "") + pmsParseInt(numbersbl[k+4]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball pms_button_bl' data-toggle='button'><span class='size2'>"+tmpNo5+"</span> </span></div>";
                        }
                        if(numbersbl[k+5]!=undefined){
                            var tmpNo6 = (pmsParseInt(numbersbl[k+5]) < 10 ? "0" : "") + pmsParseInt(numbersbl[k+5]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball pms_button_bl' data-toggle='button'><span class='size2'>"+tmpNo6+"</span> </span></div>";
                        }
                        str = str + "</div>";
                    }
                }else{
                    for(var k=0;k<numLength;k=k+6){
                        str = str + "<div class='pms-grid-6 ticket-numbers'>";
                        if(tmpArr[k]!=undefined){
                            var tmpNo1 = (pmsParseInt(tmpArr[k]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k]);
                            str = str + "<div class='pms-block-a'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo1+"</span> </span></div>";
                        }
                        if(tmpArr[k+1]!=undefined){
                            var tmpNo2 = (pmsParseInt(tmpArr[k+1]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+1]);
                            str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo2+"</span> </span></div>";
                        }
                        if(tmpArr[k+2]!=undefined){
                            var tmpNo3 = (pmsParseInt(tmpArr[k+2]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+2]);
                            str = str + "<div class='pms-block-c'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo3+"</span> </span></div>";
                        }
                        if(tmpArr[k+3]!=undefined){
                            var tmpNo4 = (pmsParseInt(tmpArr[k+3]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+3]);
                            str = str + "<div class='pms-block-d'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo4+"</span> </span></div>";
                        }
                        if(tmpArr[k+4]!=undefined){
                            var tmpNo5 = (pmsParseInt(tmpArr[k+4]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+4]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo5+"</span> </span></div>";
                        }
                        if(tmpArr[k+5]!=undefined){
                            var tmpNo6 = (pmsParseInt(tmpArr[k+5]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+5]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo6+"</span> </span></div>";
                        }
                        str = str + "</div>";
                    }
                }
            }
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>";
            str = str +"<div><div class='ticket-left'><b>Number Of Lines :</b></div>" +
                "<div class='ticket-right'>" + data.ticketData.panelData[i].noOfLines+ "</div><div class='clearBoth'></div></div>" ;

            str+="<div><div class='ticket-left'><b>Bet Amount :</b></div>" +
                "<div class='ticket-right'>"+currency + getFormattedAmount(data.ticketData.panelData[i].unitPrice*data.ticketData.panelData[i].betAmtMul) + "</div><div class='clearBoth'></div></div>";


            str+="<div><div class='ticket-left'><b>Panel Price :</b></div>" +
                "<div class='ticket-right'>"+currency + getFormattedAmount(data.ticketData.panelData[i].unitPrice*data.ticketData.panelData[i].betAmtMul*data.ticketData.panelData[i].noOfLines)  + "</div><div class='clearBoth'></div></div>";

            if((data.ticketData.panelData.length-1)!=i){
                str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
            }
            totalAmount +=parseFloat(data.ticketData.panelData[i].unitPrice*data.ticketData.panelData[i].betAmtMul*data.ticketData.panelData[i].noOfLines);
        }
        //Bet Type Section end

        if ((data.ticketData.drawData.length-1)!=d){
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
        }
    }
    //Draw Section end

    str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";

    str = str +"<div><div class='ticket-left'><b>Number Of Draws  :</b></div>";
    str = str +"<div class='ticket-right'>" + data.ticketData.drawData.length+ "</div><div class='clearBoth'></div></div>" ;

    str = str +"<div><div class='ticket-left'><b>Total Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(totalAmount)+ "</b></div><div class='clearBoth'></div></div>";

    str = str +"<div><div class='ticket-left'><b>Payable Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(data.ticketData.purchaseAmt)+ "</b></div><div class='clearBoth'></div></div>";


    str +="<div class='col-xs-12 col-sm-12 col-md-12 text-center' id='bcTarget' align='center' style='padding:none !important;width:100% !important'></div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>"+data.ticketData.ticketNumber+"</div>" +
        "</div>" +
        "<div class='row "+ticketbottom+"'>&nbsp;</div>";

    str= str+"</div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "</div>";
    return str;
}

function parsetwelveBytwentyfourPurchase(data,type,currency)
{
    if(type=="TRACK")
    {
        var tickettop="ticket-d-top";
        var ticket="ticket-d";
        var ticketbottom="ticket-d-bottom";
    }
    else
    {
        var tickettop="ticket-top";
        var ticket="ticket";
        var ticketbottom="ticket-bottom";
    }
    var str = "<div class='row'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12' align='center'>" +
        "<div class='row "+tickettop+"'>&nbsp;</div>" +
        "<div class='row "+ticket+"'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><h3>"+data.ticketData.gameName+"</h3></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>" +
        "<div><div class='ticket-left'><b>Purchased On :</b></div>" +
        "<div class='ticket-right'>" + data.ticketData.purchaseTime+ "</div><div class='clearBoth'></div></div>" +
        "<div><div class='ticket-left'><b>Ticket Number :</b></div>" +
        "<div class='ticket-right'>" + data.ticketData.ticketNumber + "</div><div class='clearBoth'></div></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
    //Draw Section Start
    var totalAmount=0;
    for(var d=0;d<data.ticketData.drawData.length;d++){
        drawName = data.ticketData.drawData[d].drawName;
        if(drawName == "")
            drawName="N.A.";

        if(drawName!="N.A."){
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 draw-name' align='center'><h4>" +drawName + "</h4></div>" ;
        }

        str = str +"<div><div class='ticket-left'><b>Draw Time :</b></div>" +
            "<div class='ticket-right'>" + data.ticketData.drawData[d].drawDate +" "+ data.ticketData.drawData[d].drawTime + "</div><div class='clearBoth'></div></div>";

        str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>" +
            "<div><div class='ticket-left'><b>"+ data.ticketData.panelData[0].betName +"</b></div>";

        if($.inArray(data.ticketData.panelData[0].betName,TwelveToTwentyFourFixedBetType) ==-1)
            str = str + "<div class='ticket-right'><b>" + (data.ticketData.panelData[0].isQP ? "QP" : "MANUAL") + "</b></div>";
        else
            str = str + "<div class='col-xs-12 col-sm-6 col-md-6 ticket-right'><b></b></div>";

        str = str +"<div class='clearBoth'></div></div>";

        //Bet Type Section Start

        for (var i=0; i < data.ticketData.panelData.length; i++) {
            var tmpArrMain=data.ticketData.panelData[i].pickedNumbers.split("Nxt");
            for(var l=0;l<tmpArrMain.length;l++){
                var tmpArr=tmpArrMain[l].split(",");
                var numLength=tmpArr.length;
                for(var k=0;k<numLength;k=k+6){
                    str = str + "<div class='pms-grid-6 ticket-numbers'>";
                    if(tmpArr[k]!=undefined){
                        var tmpNo1 = (pmsParseInt(tmpArr[k]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k]);
                        str = str + "<div class='pms-block-a'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo1+"</span> </span></div>";
                    }
                    if(tmpArr[k+1]!=undefined){
                        var tmpNo2 = (pmsParseInt(tmpArr[k+1]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+1]);
                        str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo2+"</span> </span></div>";
                    }
                    if(tmpArr[k+2]!=undefined){
                        var tmpNo3 = (pmsParseInt(tmpArr[k+2]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+2]);
                        str = str + "<div class='pms-block-c'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo3+"</span> </span></div>";
                    }
                    if(tmpArr[k+3]!=undefined){
                        var tmpNo4 = (pmsParseInt(tmpArr[k+3]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+3]);
                        str = str + "<div class='pms-block-d'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo4+"</span> </span></div>";
                    }
                    if(tmpArr[k+4]!=undefined){
                        var tmpNo5 = (pmsParseInt(tmpArr[k+4]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+4]);
                        str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo5+"</span> </span></div>";
                    }
                    if(tmpArr[k+5]!=undefined){
                        var tmpNo6 = (pmsParseInt(tmpArr[k+5]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+5]);
                        str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo6+"</span> </span></div>";
                    }
                    str = str + "</div>";
                }
            }
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>";
            str = str +"<div><div class='ticket-left'><b>Number Of Lines :</b></div>" +
                "<div class='ticket-right'>" + data.ticketData.panelData[i].noOfLines+ "</div><div class='clearBoth'></div></div>" ;

            str+="<div><div class='ticket-left'><b>Bet Amount :</b></div>" +
                "<div class='ticket-right'>"+currency + getFormattedAmount(data.ticketData.panelData[i].unitPrice*data.ticketData.panelData[i].betAmtMul) + "</div><div class='clearBoth'></div></div>";


            str+="<div><div class='ticket-left'><b>Panel Price :</b></div>" +
                "<div class='ticket-right'>"+currency + getFormattedAmount(data.ticketData.panelData[i].unitPrice*data.ticketData.panelData[i].betAmtMul*data.ticketData.panelData[i].noOfLines)  + "</div><div class='clearBoth'></div></div>";

            if((data.ticketData.panelData.length-1)!=i){
                str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
            }
            totalAmount +=parseFloat(data.ticketData.panelData[i].unitPrice*data.ticketData.panelData[i].betAmtMul*data.ticketData.panelData[i].noOfLines);
        }
        //Bet Type Section end

        if ((data.ticketData.drawData.length-1)!=d){
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
        }
    }
    //Draw Section end

    str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";

    str = str +"<div><div class='ticket-left'><b>Number Of Draws  :</b></div>";
    str = str +"<div class='ticket-right'>" + data.ticketData.drawData.length+ "</div><div class='clearBoth'></div></div>" ;

    str = str +"<div><div class='ticket-left'><b>Total Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(totalAmount)+ "</b></div><div class='clearBoth'></div></div>";

    str = str +"<div><div class='ticket-left'><b>Payable Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(data.ticketData.purchaseAmt)+ "</b></div><div class='clearBoth'></div></div>";


    str +="<div class='col-xs-12 col-sm-12 col-md-12 text-center' id='bcTarget' align='center' style='padding:none !important;width:100% !important'></div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>"+data.ticketData.ticketNumber+"</div>" +
        "</div>" +
        "<div class='row "+ticketbottom+"'>&nbsp;</div>";

    str= str+"</div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "</div>";
    return str;
}

function parseFastLottoPurchase(data,type,currency)
{
    if(type=="TRACK")
    {
        var tickettop="ticket-d-top";
        var ticket="ticket-d";
        var ticketbottom="ticket-d-bottom";
    }
    else
    {
        var tickettop="ticket-top";
        var ticket="ticket";
        var ticketbottom="ticket-bottom";
    }

    var str = "<div class='row'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12' align='center'>" +
        "<div class='row "+tickettop+"'>&nbsp;</div>" +
        "<div class='row "+ticket+"'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><h3>"+data.ticketData.gameName+"</h3></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>" +
        "<div><div class='ticket-left'><b>Purchased On :</b></div>" +
        "<div class='ticket-right'>" + data.ticketData.purchaseTime+ "</div><div class='clearBoth'></div></div>" +
        "<div><div class='ticket-left'><b>Ticket Number :</b></div>" +
        "<div class='ticket-right'>" + data.ticketData.ticketNumber + "</div><div class='clearBoth'></div></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
    //Draw Section Start
    var totalAmount=0;
    for(var d=0;d<data.ticketData.drawData.length;d++){
        drawName = data.ticketData.drawData[d].drawName;
        if(drawName == "")
            drawName="N.A.";
        if(drawName!="N.A."){
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 draw-name' align='center'><h4>" +drawName + "</h4></div>" ;
        }
        str = str +"<div><div class='ticket-left'><b>Draw Time :</b></div>" +
            "<div class='ticket-right'>" + data.ticketData.drawData[d].drawDate +" "+ data.ticketData.drawData[d].drawTime + "</div><div class='clearBoth'></div></div>";

        str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>" +
            "<div><div class='ticket-left'><b>"+ data.ticketData.panelData[0].betName +"</b></div>" +
            "<div class='ticket-right'><b>" + (data.ticketData.panelData[0].isQP ? "QP" : "MANUAL") + "</b></div><div class='clearBoth'></div></div>";
        var numCount=0;
        for (var i=0; i < data.ticketData.panelData.length; i++) {
            numCount= numCount + pmsParseInt(data.ticketData.panelData[i].betAmtMul);
            str = str + "<div><div class='ticket-left fastlottoTxt'>" +data.ticketData.panelData[i].pickedNumbers+"</div>";
            str = str + "<div class='ticket-right'>" +pmsParseInt(data.ticketData.panelData[i].betAmtMul)+" Time(s)</div><div class='clearBoth'></div></div>";
            totalAmount +=parseFloat(data.ticketData.panelData[i].unitPrice*data.ticketData.panelData[i].betAmtMul*data.ticketData.panelData[i].noOfLines);
        }
        str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>";
        str+="<div><div class='ticket-left'><b>Bet Amount :</b></div>" +
            "<div class='ticket-right'>"+currency + getFormattedAmount(data.ticketData.panelData[0].unitPrice) + "</div><div class='clearBoth'></div></div>";

        str +="<div><div class='ticket-left'><b>Number's Count :</b></div>" +
            "<div class='ticket-right'>" + numCount + "</div><div class='clearBoth'></div></div>";

        str+="<div><div class='ticket-left'><b>Panel Price :</b></div>" +
            "<div class='ticket-right'>"+currency + getFormattedAmount(data.ticketData.panelData[0].unitPrice*numCount)  + "</div><div class='clearBoth'></div></div>";

        if ((data.ticketData.drawData.length-1)!=d){
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
        }
    }

    //Draw Section end

    str = str +"<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";

    str = str +"<div><div class='ticket-left'><b>Number Of Draws  :</b></div>";
    str = str +"<div class='ticket-right'>" + data.ticketData.drawData.length+ "</div><div class='clearBoth'></div></div>" ;

    str = str +"<div><div class='ticket-left'><b>Total Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(totalAmount)+ "</b></div><div class='clearBoth'></div></div>";

    str = str +"<div><div class='ticket-left'><b>Payable Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(data.ticketData.purchaseAmt)+ "</b></div><div class='clearBoth'></div></div>";

    str +="<div class='col-xs-12 col-sm-12 col-md-12 text-center' id='bcTarget' align='center' style='padding:none !important;width:100% !important'></div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>"+data.ticketData.ticketNumber+"</div>" +
        "</div>" +
        "<div class='row "+ticketbottom+"'>&nbsp;</div>";
    str= str+"</div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "</div>";
    return str;
}

function parseBonusPurchase(data,type,currency)
{
    if(type=="TRACK")
    {
        var tickettop="ticket-d-top";
        var ticket="ticket-d";
        var ticketbottom="ticket-d-bottom";
    }
    else
    {
        var tickettop="ticket-top";
        var ticket="ticket";
        var ticketbottom="ticket-bottom";
    }
    var str = "<div class='row'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12' align='center'>" +
        "<div class='row "+tickettop+"'>&nbsp;</div>" +
        "<div class='row "+ticket+"'>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><h3>"+data.ticketData.gameName+"</h3></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>" +
        "<div><div class='ticket-left'><b>Purchased On :</b></div>" +
        "<div class='ticket-right'>" + data.ticketData.purchaseTime+ "</div><div class='clearBoth'></div></div>" +
        "<div><div class='ticket-left'><b>Ticket Number :</b></div>" +
        "<div class='ticket-right'>" + data.ticketData.ticketNumber + "</div><div class='clearBoth'></div></div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
    //Draw Section Start
    var totalAmount=0;
    for(var d=0;d<data.ticketData.drawData.length;d++){
        drawName = data.ticketData.drawData[d].drawName;
        if(drawName == "")
            drawName="N.A.";
        if(drawName!="N.A."){
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 draw-name' align='center'><h4>" +drawName + "</h4></div>" ;
        }
        str = str +"<div><div class='ticket-left'><b>Draw Time :</b></div>" +
            "<div class='ticket-right'>" + data.ticketData.drawData[d].drawDate +" "+ data.ticketData.drawData[d].drawTime + "</div><div class='clearBoth'></div></div>";

        str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>" +
            "<div><div class='ticket-left'><b>"+ data.ticketData.panelData[0].betName +"</b></div>" +
            "<div class='ticket-right'><b>" + (data.ticketData.panelData[0].isQP ? "QP" : "MANUAL") + "</b></div><div class='clearBoth'></div></div>";

        for (var i=0; i < data.ticketData.panelData.length; i++) {
            var tmpArrMain=data.ticketData.panelData[i].pickedNumbers.split("Nxt");
            for(var l=0;l<tmpArrMain.length;l++){
                var tmpArr=tmpArrMain[l].split(",");
                var numLength=tmpArr.length;
                if(data.ticketData.panelData[i].betName.toLowerCase()=="direct6"){
                    for(var k=0;k<numLength;k=k+6){
                        str = str + "<div class='pms-grid-7 ticket-numbers'>";

                        str = str + "<div class='pms-block-a'><span class='blLine'>#"+(l+1)+"</span></div>";
                        if(tmpArr[k]!=undefined){
                            var tmpNo1 = (pmsParseInt(tmpArr[k]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k]);
                            str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo1+"</span> </span></div>";
                        }
                        if(tmpArr[k+1]!=undefined){
                            var tmpNo2 = (pmsParseInt(tmpArr[k+1]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+1]);
                            str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo2+"</span> </span></div>";
                        }
                        if(tmpArr[k+2]!=undefined){
                            var tmpNo3 = (pmsParseInt(tmpArr[k+2]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+2]);
                            str = str + "<div class='pms-block-c'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo3+"</span> </span></div>";
                        }
                        if(tmpArr[k+3]!=undefined){
                            var tmpNo4 = (pmsParseInt(tmpArr[k+3]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+3]);
                            str = str + "<div class='pms-block-d'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo4+"</span> </span></div>";
                        }
                        if(tmpArr[k+4]!=undefined){
                            var tmpNo5 = (pmsParseInt(tmpArr[k+4]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+4]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo5+"</span> </span></div>";
                        }
                        if(tmpArr[k+5]!=undefined){
                            var tmpNo6 = (pmsParseInt(tmpArr[k+5]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+5]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo6+"</span> </span></div>";
                        }
                        str = str + "</div>";
                    }
                }else{
                    for(var k=0;k<numLength;k=k+6){
                        str = str + "<div class='pms-grid-6 ticket-numbers'>";
                        if(tmpArr[k]!=undefined){
                            var tmpNo1 = (pmsParseInt(tmpArr[k]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k]);
                            str = str + "<div class='pms-block-a'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo1+"</span> </span></div>";
                        }
                        if(tmpArr[k+1]!=undefined){
                            var tmpNo2 = (pmsParseInt(tmpArr[k+1]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+1]);
                            str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo2+"</span> </span></div>";
                        }
                        if(tmpArr[k+2]!=undefined){
                            var tmpNo3 = (pmsParseInt(tmpArr[k+2]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+2]);
                            str = str + "<div class='pms-block-c'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo3+"</span> </span></div>";
                        }
                        if(tmpArr[k+3]!=undefined){
                            var tmpNo4 = (pmsParseInt(tmpArr[k+3]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+3]);
                            str = str + "<div class='pms-block-d'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo4+"</span> </span></div>";
                        }
                        if(tmpArr[k+4]!=undefined){
                            var tmpNo5 = (pmsParseInt(tmpArr[k+4]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+4]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo5+"</span> </span></div>";
                        }
                        if(tmpArr[k+5]!=undefined){
                            var tmpNo6 = (pmsParseInt(tmpArr[k+5]) < 10 ? "0" : "") + pmsParseInt(tmpArr[k+5]);
                            str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo6+"</span> </span></div>";
                        }
                        str = str + "</div>";
                    }
                }
            }
            totalAmount +=parseFloat(data.ticketData.panelData[i].unitPrice*data.ticketData.panelData[i].betAmtMul*data.ticketData.panelData[i].noOfLines);
        }

        str = str +"<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>" +
            "<div><div class='ticket-left'><b>Number Of Lines :</b></div>" +
            "<div class='ticket-right'>" + data.ticketData.panelData[0].noOfLines+ "</div><div class='clearBoth'></div></div>" ;
        str+="<div><div class='ticket-left'><b>Bet Amount :</b></div>" +
            "<div class='ticket-right'>"+currency   + getFormattedAmount(data.ticketData.panelData[0].unitPrice*data.ticketData.panelData[0].betAmtMul) + "</div><div class='clearBoth'></div></div>";

        str+="<div><div class='ticket-left'><b>Panel Price :</b></div>" +
            "<div class='ticket-right'>"+currency  +  getFormattedAmount(data.ticketData.panelData[0].unitPrice*data.ticketData.panelData[0].betAmtMul*data.ticketData.panelData[0].noOfLines) + "</div><div class='clearBoth'></div></div>";

        if ((data.ticketData.drawData.length-1)!=d){
            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
        }
    }
    //Draw Section End

    str = str +"<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";

    str = str +"<div><div class='ticket-left'><b>Number Of Draws  :</b></div>";
    str = str +"<div class='ticket-right'>" + data.ticketData.drawData.length+ "</div><div class='clearBoth'></div></div>" ;

    str = str +"<div><div class='ticket-left'><b>Total Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(totalAmount)+ "</b></div><div class='clearBoth'></div></div>";

    str = str +"<div><div class='ticket-left'><b>Payable Amount :</b></div>" +
        "<div class='ticket-right'><b>"+currency + getFormattedAmount(data.ticketData.purchaseAmt)+ "</b></div><div class='clearBoth'></div></div>";

    str +="<div class='col-xs-12 col-sm-12 col-md-12 text-center' id='bcTarget' align='center' style='padding:none !important;width:100% !important'></div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>"+data.ticketData.ticketNumber+"</div>" +
        "</div>" +
        "<div class='row "+ticketbottom+"'>&nbsp;</div>";

    if(data.isPromo)
    {
        if(data.promoTicketData.length>0)
        {
            for (var k=0; k < data.promoTicketData.length; k++) {
                drawName = data.promoTicketData[k].drawData[0].drawName;
                if(drawName == "")
                    drawName="N.A.";
                str = str +"<div class='row "+tickettop+"'>&nbsp;</div>" +
                    "<div class='row "+ticket+"'>" +
                    "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><b></b></div>"+
                    "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><h3>"+data.promoTicketData[k].gameName+"</h3></div>"+
                    "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>" +
                    "<div><div class='ticket-left'><b>Purchased On :</b></div>" +
                    "<div class='ticket-right'>" + data.promoTicketData[k].purchaseTime + "</div><div class='clearBoth'></div></div>" +
                    "<div><div class='ticket-left'><b>Ticket Number :</b></div>" +
                    "<div class='ticket-right'>" + data.promoTicketData[k].ticketNumber + "</div><div class='clearBoth'></div></div>"+
                    "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
                //Draw Section Start
                var totalAmount=0;
                for(var d=0;d<data.promoTicketData[k].drawData.length;d++){
                    drawName = data.promoTicketData[k].drawData[d].drawName;
                    if(drawName == "")
                        drawName="N.A.";
                    if(drawName!="N.A."){
                        str = str + "<div class='col-xs-12 col-sm-12 col-md-12 draw-name' align='center'><h4>" +drawName + "</h4></div>" ;
                    }
                    str = str +"<div><div class='ticket-left'><b>Draw Time :</b></div>" +
                        "<div class='ticket-right'>" + data.promoTicketData[k].drawData[d].drawDate +" "+ data.promoTicketData[k].drawData[d].drawTime + "</div><div class='clearBoth'></div></div>";

                    str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>";

                    if(data.promoTicketData[k].panelData[0].betName!="Perm6"){
                        str = str + "<div><div class='ticket-left'><b>"+ data.promoTicketData[k].panelData[0].betName +"</b></div>" +
                            "<div class='ticket-right'><b>" + (data.promoTicketData[k].panelData[0].isQP ? "QP" : "MANUAL") + "</b></div><div class='clearBoth'></div></div>";
                    }

                    for (var i=0; i < data.promoTicketData[k].panelData.length; i++) {
                        if (data.promoTicketData[k].panelData[i].betName=="Perm6"){
                            str = str + "<div><div class='ticket-left'><b>"+ data.promoTicketData[k].panelData[i].betName +"</b></div>" +
                                "<div class='ticket-right'><b>" + (data.promoTicketData[k].panelData[i].isQP ? "QP" : "MANUAL") + "</b></div><div class='clearBoth'></div></div>";
                        }

                        var tmpArrMain=data.promoTicketData[k].panelData[i].pickedNumbers.split("Nxt");
                        for(var l=0;l<tmpArrMain.length;l++){
                            var tmpArr=tmpArrMain[l].split(",");
                            if(data.promoTicketData[k].panelData[i].betName.toLowerCase()=="direct6"){
                                for(var m=0;m<tmpArr.length;m=m+6){
                                    str = str + "<div class='pms-grid-7 ticket-numbers'>";

                                    str = str + "<div class='pms-block-a'><span class='blLine'>#"+(l+1)+"</span></div>";
                                    if(tmpArr[m]!=undefined){
                                        var tmpNo1 = (pmsParseInt(tmpArr[m]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m]);
                                        str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo1+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+1]!=undefined){
                                        var tmpNo2 = (pmsParseInt(tmpArr[m+1]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+1]);
                                        str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo2+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+2]!=undefined){
                                        var tmpNo3 = (pmsParseInt(tmpArr[m+2]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+2]);
                                        str = str + "<div class='pms-block-c'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo3+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+3]!=undefined){
                                        var tmpNo4 = (pmsParseInt(tmpArr[m+3]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+3]);
                                        str = str + "<div class='pms-block-d'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo4+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+4]!=undefined){
                                        var tmpNo5 = (pmsParseInt(tmpArr[m+4]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+4]);
                                        str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo5+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+5]!=undefined){
                                        var tmpNo6 = (pmsParseInt(tmpArr[m+5]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+5]);
                                        str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo6+"</span> </span></div>";
                                    }
                                    str = str + "</div>";
                                }
                            }else{
                                for(var m=0;m<tmpArr.length;m=m+6){
                                    str = str + "<div class='pms-grid-6 ticket-numbers'>";
                                    if(tmpArr[m]!=undefined){
                                        var tmpNo1 = (pmsParseInt(tmpArr[m]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m]);
                                        str = str + "<div class='pms-block-a'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo1+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+1]!=undefined){
                                        var tmpNo2 = (pmsParseInt(tmpArr[m+1]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+1]);
                                        str = str + "<div class='pms-block-b'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo2+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+2]!=undefined){
                                        var tmpNo3 = (pmsParseInt(tmpArr[m+2]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+2]);
                                        str = str + "<div class='pms-block-c'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo3+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+3]!=undefined){
                                        var tmpNo4 = (pmsParseInt(tmpArr[m+3]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+3]);
                                        str = str + "<div class='pms-block-d'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo4+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+4]!=undefined){
                                        var tmpNo5 = (pmsParseInt(tmpArr[m+4]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+4]);
                                        str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo5+"</span> </span></div>";
                                    }
                                    if(tmpArr[m+5]!=undefined){
                                        var tmpNo6 = (pmsParseInt(tmpArr[m+5]) < 10 ? "0" : "") + pmsParseInt(tmpArr[m+5]);
                                        str = str + "<div class='pms-block-e'><span class='btn btn-info btn-sm round_button_display lotto-ball' data-toggle='button'><span class='size2'>"+tmpNo6+"</span> </span></div>";
                                    }
                                    str = str + "</div>";
                                }
                            }
                        }
                        if (data.promoTicketData[k].panelData[i].betName=="Perm6" && (data.promoTicketData[k].panelData.length-1)!=i){
                            str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
                        }
                        totalAmount +=parseFloat(data.promoTicketData[k].panelData[i].unitPrice*data.promoTicketData[k].panelData[i].betAmtMul*data.promoTicketData[k].panelData[i].noOfLines);
                    }

                    str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr-dotted'></div>";
                    str = str +"<div><div class='ticket-left'><b>Number Of Lines  :</b></div>";
                    str = str +"<div class='ticket-right'>" + data.promoTicketData[k].panelData[0].noOfLines+ "</div><div class='clearBoth'></div></div>" ;
                    str+="<div><div class='ticket-left'><b>Bet Amount  :</b></div>" +
                        "<div class='ticket-right'>"+currency + getFormattedAmount(data.promoTicketData[k].panelData[0].unitPrice*data.promoTicketData[k].panelData[0].betAmtMul)  + "</div><div class='clearBoth'></div></div>" ;
                    str+="<div><div class='ticket-left'><b>Panel Price :</b></div>" +
                        "<div class='ticket-right'>"+currency + getFormattedAmount(data.promoTicketData[k].panelData[0].unitPrice*data.promoTicketData[k].panelData[0].betAmtMul*data.promoTicketData[k].panelData[0].noOfLines) + "</div><div class='clearBoth'></div></div>";

                    if(data.promoTicketData[k].panelData.length>1)
                    {
                        str = str +"<div><div class='ticket-left'><b>Number Of Panels  :</b></div>";
                        str = str +"<div class='ticket-right'>" + data.promoTicketData[k].panelData.length+ "</div><div class='clearBoth'></div></div>" ;
                    }

                    if ((data.promoTicketData[k].drawData.length-1)!=d){
                        str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";
                    }
                }
                //Draw Section end
                str = str + "<div class='col-xs-12 col-sm-12 col-md-12 text-center'><hr class='ticket-hr'></div>";

                str = str +"<div><div class='ticket-left'><b>Number Of Draws  :</b></div>";
                str = str +"<div class='ticket-right'>" + data.promoTicketData[k].drawData.length+ "</div><div class='clearBoth'></div></div>" ;

                str = str +"<div><div class='ticket-left'><b>Total Amount :</b></div>" +
                    "<div class='ticket-right'><b>"+currency + getFormattedAmount(totalAmount)+ "</b></div><div class='clearBoth'></div></div>";

                if(data.promoTicketData[k].gameCode=="ZimLottoBonusTwoFree"){
                    str = str +"<div><div class='ticket-left'><b>Discount :</b></div>" +
                        "<div class='ticket-right'><b>-"+currency + getFormattedAmount(totalAmount)+ "</b></div><div class='clearBoth'></div></div>";
                }

                str = str +"<div><div class='ticket-left'><b>Payable Amount :</b></div>" +
                    "<div class='ticket-right'><b>"+currency + getFormattedAmount(data.promoTicketData[k].purchaseAmt)+ "</b></div><div class='clearBoth'></div></div>";

                str +="<div class='col-xs-12 col-sm-12 col-md-12 text-center' id='bcTarget-"+k+"' align='center' style='padding:none !important;width:100% !important'></div>" +
                    "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>"+data.promoTicketData[k].ticketNumber+"</div>" +
                    "</div>" +
                    "<div class='row "+ticketbottom+"'>&nbsp;</div>";
            }
        }
    }
    str= str+"</div>" +
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "<div class='col-xs-12 col-sm-12 col-md-12 text-center'>&nbsp;</div>"+
        "</div>";
    return str;
}

function updatebalance(currency)
{
    $.ajax({
        type 		: "POST",
        headers 	: {"cache-control": "no-cache" },
        url		: "/index.php?option=com_pms&task=user.getBalance",
        async 		: true,
        timeout	: 120000,
        success	: function(result,status,xhr) {
            var data = JSON.parse(result);
            validateSession(data);
            if(data.responseCode != "0")
            {
                error_display(data.responseMsg);
            }
            else
            {
                $("#bal_block").html("<span>"+currency+"</span>"+getFormattedAmount(data.availBal));
            }
        },
        error:  function(xhr,status,error) {
            error_display(error);
            return false;
        }
    });
}

$(document).ready(function(){
	$( "[onmouseup], [onmousedown]" ).mouseout(function() {
	    longPressOff();
	});
});

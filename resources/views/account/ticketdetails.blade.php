@extends('layouts.app')

@section('content')
<div class="myaccount_body_section">
    <div class="entry-header has-post-format">
        <h2></h2>
    </div>

    <div class="transaction_details">
        <div class="transction_filter">
            <div class="row"><div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="transaction-details-form">
                        <div class="filter">
                            <div class="form-group">
                                <label></label>
                                <div class="form_item_holder date">
                                    <div class="input-group date" id="fromdatepicker">
                                        <input type="text" class="custome_input" placeholder="" id="fromDate" name="fromDate" readonly="readonly">
                                        <button class="btn_date input-group-addon" type="button" tabindex="8"><img src="/templates/shaper_helix3/images/common/calendar_icon.png" alt=""></button>
                                        <a class="input-group-addon btn_date" href="javascript:;"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                        <div id="error_fromDate" class="manual_tooltip_error error_tooltip"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="filter">
                            <div class="form-group">
                                <label></label>
                                <div class="form_item_holder date">
                                    <div class="input-group date" id="todatepicker">
                                        <input type="text" class="custome_input" placeholder=""  id="toDate" name="toDate" readonly="readonly">
                                        <button class="btn_date input-group-addon" type="button" tabindex="8"><img src="/templates/shaper_helix3/images/common/calendar_icon.png" alt=""></button>
                                        <a class="input-group-addon btn_date" href="javascript:;"><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                        <div id="error_toDate" class="manual_tooltip_error error_tooltip"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="filter">
                            <a class="btn btn_search" href="javascript:;" id="search" ></a>
                            <div class="clear"></div>
                        </div>
                    </form>
                </div>

            </div></div>

        <div id="error-div" class="alert_msg_div" style="display: none;">
            <div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><div><p class="error-div-txt"></p></div></div>
        </div>
    </div>

    <div class="transaction_table" id="transaction-div" style="display: none;">
        <div class="heading" id="closing-balance-div" style="display: none">
            <b id="closing-balance-text" style="font-weight: normal"></b>
            <strong>{{$dispCurrency}} <span id="closing-balance"></span></strong>
        </div>
        <div class="heading" id="bonus-balance-div" style="display: none;"><strong>{{ $dispCurrency }}<span id="bonus-chips">{{$playerInfo->walletBean->bonusBalance}}</span></strong>
        </div>
    </div>

    <div class="row whiteBackground" id="tktContainer" style="display:none;">
        <div class="col-xs-12 col-sm-12 col-md-12" >
            <div class="row" id="myticket">
            </div>
        </div>
    </div>

</div>
@endsection

<script>

    var autoStartDate = '{{date('d/m/Y',strtotime("-1 month"))}}';
    var autoEndDate = '{{date('d/m/Y')}}';
    var offset = 0;
    var limit = {{$maxrowlimit}};
    var pageWindow = 5;
    var startPageNo = 1;
    var endPageNo = 5;
    var prevTxnType = '';
    var prevFromDate = '';
    var prevToDate = '';
    var limitReached = false;
    var lastPageNo = 0;
    var fromPrev = false;

    function autoDefaultTrigger() {
        var txnType = $('#txnType').val("ticket");
        var fromDate = $('#fromDate').val(autoStartDate);
        var toDate = $('#toDate').val(autoEndDate);
        fromDate = autoStartDate;
        toDate = autoEndDate;
        txnType = "ticket";

        var params = 'fromDate=' + fromDate + '&toDate=' + toDate + '&txnType=' + txnType + '&offset=' + offset + '&limit=' + limit;
        startAjax({{json_encode($transactionDetailsURL)}}, params, processTicketDetails, 'null');
    }

    autoDefaultTrigger();
    function checkPrevCall(txnType, fromDate, toDate) {

        if (txnType == prevTxnType && fromDate == prevFromDate && toDate == prevToDate) {
            //return false;
        }

        prevTxnType = txnType;
        prevFromDate = fromDate;
        prevToDate = toDate;

        offset = 0;
        pageWindow = 5;
        startPageNo = 1;
        endPageNo = 5;
        limitReached = false;
        lastPageNo = 0;
        fromPrev = false;
        return true;
    }

    $(document).ready(function () {
        var d = new Date();
        var year = d.getFullYear();
        if ((d.getMonth() + 1) < 10)
            var month = "0" + (d.getMonth() + 1);
        else
            var month = d.getMonth() + 1;

        if (d.getDate() < 10)
            var day = "0" + d.getDate();
        else
            var day = d.getDate();

        var current = day + '/' + month + '/' + year;
//        $('#toDate').val(current);

        var defaultViewDate = new Date(new Date().setDate(new Date().getDate() - 30));
        var defaultViewDate_year = defaultViewDate.getFullYear();
        if ((defaultViewDate.getMonth() + 1) < 10)
            var defaultViewDate_month = "0" + (defaultViewDate.getMonth() + 1);
        else
            var defaultViewDate_month = defaultViewDate.getMonth() + 1;

        if (defaultViewDate.getDate() < 10)
            var defaultViewDate_day = "0" + defaultViewDate.getDate();
        else
            var defaultViewDate_day = defaultViewDate.getDate();

        var defaultDate = defaultViewDate_day + '/' + defaultViewDate_month + '/' + defaultViewDate_year;
//        $('#fromDate').val(defaultDate);
        $('#fromdatepicker').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            startDate: '01/01/1900',
            endDate: "0d",
            orientation: 'top',
            todayHighlight: true,
            language : '{{$lang}}'
        }).on('changeDate', function (e) {
            $('#todatepicker').datepicker('setStartDate', e.date);
            if (e.date > $('#todatepicker').datepicker('getDate') && $("#toDate").val() != "")
                $('#todatepicker').datepicker('setDate', e.date);
        });
        $('#todatepicker').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            startDate: '01/01/1900',
            endDate: "0d",
            orientation: 'top',
            todayHighlight: true,
            language : '{{$lang}}'
        });
        $('#todatepicker').datepicker('setStartDate', defaultViewDate);
    });

    $('#search').click(function (event) {
        //$('#transaction-div').css('display', 'none');
        $("#tktContainer").css("display", "none");
        $("#error-div").css("display", "none");

        if (!$('#transaction-details-form').valid())
            return false;

        var txnType = "ticket";
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();



        if (!checkPrevCall(txnType, fromDate, toDate)) {
            return false;
        }

        var params = 'fromDate=' + fromDate + '&toDate=' + toDate + '&txnType=' + txnType + '&offset=' + offset + '&limit=' + limit;
        startAjax({{json_encode($transactionDetailsURL)}}, params, processTicketDetails, 'null');

    });

    function processTicketDetails(result)
    {
        document.getElementById("myticket").innerHTML = "";
        var tmp_fromPrev = fromPrev;
        fromPrev = false;
        if (validateSession(result) == false)
            return false;
        var res = JSON.parse(result);
        if (res.errorCode != 0)
        {
            // $('#ticket-table tbody > tr').remove();
            //$('#transaction-div').css('display', 'none');
            //error_message(res.respMsg, null);
            $("#error-div").html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><div><p class="error-div-txt"></p></div></div>');
            $("#error-div .error-div-txt").html(res.respMsg);
            $("#error-div").css("display", "");
            return false;
        }
        if (res.ticketList.length <= 0)
        {
            //$('#ticket-table tbody > tr').remove();
            //$('#transaction-div').css('display', 'none');
            error_message("No Ticket Details Found For Selected Date Range.", null);
            $("#error-div .error-div-txt").html(Joomla.JText._('TRANSECTION_JS_NO_TICKET'));
            $("#error-div").css("display", "");
            return false;
        }

        clearSystemMessage();

//        $('#transaction-div').css('display', 'block');
//        $("#ticket-table").css("display", "");
        $("#tktContainer").css("display", "");
//
//        $('#ticket-table tbody > tr').remove();
//
        var totRows = 50;
        limitReached = false;
        lastPageNo = 0;
        if (res.ticketList.length <= limit) {
            totRows = res.ticketList.length;
            limitReached = true;
        }
        //console.log(res);
//
//        $('#closing-balance-div').css('display', 'none');
//        $('#bonus-balance-div').css('display', 'none');
        for (var i = 0; i < totRows; i++) {
            // var footable = $('#myticket').data('footable');

            var amount = '';
            var gameId = '';
            var gameName = '';
            var transactionDate = '';
            var dateIndexOne = '';
            var gameType = '';
            var  ticketDateTime = '';
            var  ticketDate = '';         
            var checkDate = new Date("2020-12-03");
            if (typeof res.ticketList[i].transactionDate != 'undefined') {
                ticketDateTime = res.ticketList[i].transactionDate;
                ticketDateTime = ticketDateTime.split(' ');
                ticketDate = ticketDateTime[0];
                ticketDate = new Date(ticketDate);
                transactionDate = res.ticketList[i].transactionDate;
                var tmp = transactionDate.lastIndexOf(".");
                transactionDate = transactionDate.substring(0, tmp);
                transactionDate = transactionDate.split(' ');
                dateIndexOne = transactionDate[0];
                const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                dateIndexOne = new Date(dateIndexOne)
                var date = dateIndexOne.getDate();
                date = date.toString().length == 1 ? "0" + '' + date : date;
                transactionDate = months[dateIndexOne.getMonth()] + " " + date + ", " + dateIndexOne.getFullYear() + " " + transactionDate[1]
            }
            if (typeof res.ticketList[i].transactionId != 'undefined')
                gameId = res.ticketList[i].transactionId;
            if (typeof res.ticketList[i].gameName != 'undefined')
                gameName = res.ticketList[i].gameName;
            if (typeof res.ticketList[i].amount != 'undefined')
                amount = res.ticketList[i].amount;
            if (typeof res.ticketList[i].gameType != 'undefined')
                gameType = res.ticketList[i].gameType;
            // var wrraper = document.createElement('div');
            var ticketDomain = "{{$ticketDomain}}";
            var player_id = "{{$playerId }}";
            var player_name = '{{$playerInfo->userName}}';
            var balance = '{{(float) $playerInfo->walletBean->totalBalance}}';
            var session_id = "{{$playerToken }}";
            var currency = '{{$currencyCode }}';
            var symbol = "{{$currencyCode }}";
            var dispsymbol = "{{$dispCurrency }}";
            var alias = '{{$domain_main}}';
            var lang = '{{$lang}}';
            var serviceCode = res.ticketList[i].serviceCode;
            var ticketURL = "";
            var url = "";
            var end = "";
            var gameImage = gameName;
            var gameText = gameName;
            var gameNameMap = {
                "SBS" : "Sports Betting" ,
                "VS" : "Virtual Sports",
                "SGE" : "Slot",
                "MRSLOTTY" : "Slot",
                "GMW" : "Slot",
                "CAP" : "Slot",
                "LIVE_CASINO" : "Live Dealer"
            };
            if (serviceCode == "DGE") {
                ticketURL = ticketDomain + "/view-ticket#dge,0," + res.ticketList[i].transactionId;
                if(ticketDate < checkDate){
                 url = '';
             }else{
                url = '<a href="' + ticketURL + '" target="" title="Click For Details">';
            }
               
            }else if(serviceCode == "SLE") {
            ticketURL = ticketDomain + "/view-ticket#sle,0," + res.ticketList[i].transactionId;
            if(ticketDate < checkDate){
                 url = '';
             }else{
               url = '<a href="' + ticketURL + '" target="" title="Click For Details">';
            }
            } else {
                ticketURL = "";
                url = '';
            }
              end = '</a>';
            if(gameName == 'Lucky 6 Prime')
                gameImage = 'logo-luckySix';

            if(gameName == 'Lucky Number+ 5/90'){
                gameImage = 'logo-luckyNumber';
            }

            if( serviceCode == "VS" || serviceCode == "SBS" ){
                gameImage = serviceCode + "-" + res.ticketList[i].gameId;
                gameName  = gameNameMap[serviceCode];
                gameText = gameName;
            }
            if( serviceCode == "SGE" || serviceCode == "MRSLOTTY" || serviceCode == "GMW"  || serviceCode == "CAP" ){
                gameImage = "slot";
                gameName  = gameNameMap[serviceCode];
                gameText = gameName;
            }
            if ( serviceCode == "LIVE_CASINO" ){
                gameImage = serviceCode;
                gameName  = gameNameMap[serviceCode];
                gameText = gameName;
            }
            if (typeof res.ticketList[i].gameName != 'undefined'){
                    resgameName = res.ticketList[i].gameName;
                    if(resgameName.includes("/") == true){
                        gameImage = resgameName.replace('/', 'by');
                }
            }
            var newRow =
                    `<div class="col-sm-6">
                <div class="myTicketOuterWrap"> ` + url +`
                <div class="myTicketInnerWrap drawGameTicket">
                <div class="myTicketInnerWrap1">
                <div class="ticketGameName">` + gameName + `</div>
                <div class="transactionIDTitle">`+Joomla.JText._("TRANSECTION_DETAIL_TABLE_TID")+`</div>
                <div class="transactionIDNum">` + gameId + `</div>
                <div class="transactionTimeName">`+Joomla.JText._("TRANSECTION_DETAIL_TABLE_TTIME")+`</div>
                <div class="transactionTimeNum">` + transactionDate + `</div>
                
                <div class="ticketPrice"><span class="currencyChange">` + formatCurrency((parseFloat(amount).toFixed(2)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),symbol,dispsymbol) +`</span><span class="currency"></span></div><input type="hidden" id="DGE-657937-amount" value="` + (parseFloat(amount).toFixed(2)) + `"></div>
                <div class="myTicketInnerWrap2">
                <div class="gameTypeIconTic"><img src="images/gamelogo/` + gameImage + `.png"" alt="` + gameName + `"></div>
                <div class="gameTypeNameTic">` + gameText + `</div>
                </div>
                </div>
                ` + end + `</div></div>`;
            var container = document.getElementById("myticket");
            container.innerHTML += newRow;

        }

    }


    $('.footer-pagination-div').click(function (event) {
        if (limitReached == true && $(this).find("li.footable-page.active a").text() == lastPageNo && $(this).find("li.footable-page.active a").text() != startPageNo) {
            $(this).find('li.footable-page.active').next().addClass(' disabled');
            $(this).children().children().last().removeClass('loadnext');
            if (!$(this).find('li.footable-page.active a').prev().hasClass('loadprev'))
                $(this).children().children().first().removeClass('loadprev');
            return;
        } else {
            $(this).children().children().last().removeClass(' disabled');
        }

        if ($(this).find('li.footable-page.active a').text() == 1) {
            $(this).children().children().first().addClass(' disabled');
        } else {
            $(this).children().children().first().removeClass(' disabled');
        }

        if ($(this).find('li.footable-page.active a').text() == endPageNo) {

            $(this).find('li.footable-page.active').next().addClass(' loadnext');
            $(this).children().children().first().removeClass('loadprev');

        } else if ($(this).find('li.footable-page.active a').text() == startPageNo) {

            if ($(this).find('li.footable-page.active').children().text() != 1)
                $(this).find('li.footable-page.active').prev().addClass(' loadprev');
            $(this).find(this).children().children().last().removeClass('loadnext');

        } else {
            $(this).children().children().first().removeClass('loadprev');
            $(this).children().children().last().removeClass('loadnext');
        }

        if (limitReached) {
            setLastPageNo($(this));
            if ($(this).find('li.footable-page.active a').text() == lastPageNo)
                $(this).find('li.footable-page.active').next().addClass(' disabled');
            return;
        }

    });

    $('.footer-pagination-div').on('click', '.loadnext', function (event) {
        $('#transaction-div').css('display', 'none');
        $("#bonus-table").css("display", "none");
        $("#ticket-table").css("display", "none");
        $("#wager-table").css("display", "none");
        $("#dwwr-table").css("display", "none");
        $("#transaction-table").css("display", "none");

        if (!$('#transaction-details-form').valid())
            return false;

        var txnType = $('#txnType').val();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        offset = offset + limit;
        startPageNo = startPageNo + pageWindow;
        endPageNo = endPageNo + pageWindow;

        var params = 'fromDate=' + fromDate + '&toDate=' + toDate + '&txnType=' + txnType + '&offset=' + offset + '&limit=' + limit;
        startAjax({{json_encode($transactionDetailsURL)}}, params, processTicketDetails, 'null');

    });

    $('.footer-pagination-div').on('click', '.loadprev', function (event) {
        $('#transaction-div').css('display', 'none');
        $("#bonus-table").css("display", "none");
        $("#transaction-table").css("display", "none");
        $("#ticket-table").css("display", "none");
        $("#wager-table").css("display", "none");
        $("#dwwr-table").css("display", "none");

        if (!$('#transaction-details-form').valid())
            return false;

        var txnType = $('#txnType').val();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        offset = offset - limit;
        startPageNo = startPageNo - pageWindow;
        endPageNo = endPageNo - pageWindow;

        var params = 'fromDate=' + fromDate + '&toDate=' + toDate + '&txnType=' + txnType + '&offset=' + offset + '&limit=' + limit;

        fromPrev = true;
//        if(txnType == "<?php //echo Constants::TXNTYPE_BONUS_DETAILS;  ?>")
//            startAjax(<?php //echo json_encode($bonusDetailsURL); ?>, params, processBonusDetails, 'null');
//        else if(txnType == "<?php //echo Constants::TXNTYPE_TICKET_DETAILS; ?>")
        startAjax({{json_encode($transactionDetailsURL)}}, params, processTicketDetails, 'null');
//        else
//            startAjax(<?php //echo json_encode($transactionDetailsURL); ?>, params, processTransactionDetails, 'null');
    });

    function resetPageNo(obj) {
        var pageNo = startPageNo;
        $(obj.children().children()).each(function () {
            if ($(this).children().attr('data-page') == "prev") {
                $(this).addClass(' loadprev');
            }
            if ($(this).children().attr('data-page') != "prev" && $(this).children().attr('data-page') != "next")
            {
                $(this).children().text(pageNo);
                if (limitReached == true)
                    lastPageNo = pageNo;
                pageNo++;
            }
        });
    }


    function setLastPageNo(obj) {
        var pageNo = startPageNo;
        $(obj.children().children()).each(function () {
            if ($(this).children().attr('data-page') != "prev" && $(this).children().attr('data-page') != "next") {
                if (limitReached == true)
                    lastPageNo = pageNo;
                pageNo++;
            }
        });
    }

    $.validator.addMethod("valueNotEquals", function (value, element, arg) {
        return arg != value;
    }, "Value must not equal arg.");

    $("#transaction-details-form").validate({
        showErrors: function (errorMap, errorList) {
            displayToolTipManual(this, errorMap, errorList, "bottom", undefined);
            if ($(".datepicker.datepicker-dropdown.dropdown-menu").css("display") == "block")
                removeToolTipErrorManual('all');
        },
        rules: {
            fromDate: {
                required: true,
                dateITA: true
            },
            toDate: {
                required: true,
                dateITA: true
            }
        },
        messages: {
            fromDate: {
                required: Joomla.JText._('TRANSECTION_TICKET_DETAIL_FEOM_BLANK_ERROR'),
                dateITA: Joomla.JText._('TRANSECTION_TICKET_DETAIL_FROM_BLANK')
            },
            toDate: {
                required: Joomla.JText._('TRANSECTION_TICKET_DETAIL_TO_BLANK_ERROR'),
                dateITA: Joomla.JText._('TRANSECTION_TICKET_DETAIL_FROM_BLANK')
            }
        }
    });

    $("#txnType").on('change', function () {
        $('#transaction-div').css('display', 'none');
        $("#transaction-table").css("display", "none");
        $('#transaction-table tbody > tr').remove();
        $("#bonus-table").css("display", "none");
        $('#bonus-table tbody > tr').remove();
        $("#ticket-table").css("display", "none");
        $('#ticket-table tbody > tr').remove();
        $("#wager-table").css("display", "none");
        $('#wager-table tbody > tr').remove();
        $("#dwwr-table").css("display", "none");
        $('#dwwr-table tbody > tr').remove();
    });

    $(document).ready(function () {
        // $("#search").trigger('click');
    });
</script>
{{-- resources/views/account/transaction-details.blade.php --}}

@extends('layouts.app')

@section('content')
@php
use App\Helpers\Constants;
use App\Helpers\Utilities;

$transactionDetailsURL = route('account.getTransactionDetails');
$bonusDetailsURL = route('account.getBonusDetails');

$lang = explode('-', app()->getLocale())[0];
$transaction_option = ($lang == 'es') ? Constants::$txnTypes_TransactionDetails['ES'] : Constants::$txnTypes_TransactionDetails['EN'];

$currencyInfo = Utilities::getCurrencyInfo();
$currencyCode = $currencyInfo[0];
$dispCurrency = $currencyInfo[1];

$autoStartDate = now()->subMonth()->format('d/m/Y');
$autoEndDate = now()->format('d/m/Y');
@endphp

<div class="myaccount_body_section">
    <div class="entry-header has-post-format">
        <h2>{{ __('TRANSECTION_DETAIL_TITLE') }}</h2>
    </div>

    <div class="transaction_details">
        <div class="transction_filter">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="transaction-details-form">
                        <div class="filter">
                            <div class="form-group">
                                <label>{{ __('TRANSECTION_FROM') }}</label>
                                <div class="form_item_holder date">
                                    <div class="input-group date" id="fromdatepicker">
                                        <input type="text" class="custome_input" placeholder="{{ __('START_DATE') }}" id="fromDate" name="fromDate" readonly value="{{ $autoStartDate }}">
                                        <button class="btn_date input-group-addon" type="button" tabindex="8">
                                            <img src="{{ asset('templates/shaper_helix3/images/common/calendar_icon.png') }}" alt="">
                                        </button>
                                        <a class="input-group-addon btn_date" href="javascript:;">
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </a>
                                        <div id="error_fromDate" class="manual_tooltip_error error_tooltip"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>

                        <div class="filter">
                            <div class="form-group">
                                <label>{{ __('TRANSECTION_TO') }}</label>
                                <div class="form_item_holder date">
                                    <div class="input-group date" id="todatepicker">
                                        <input type="text" class="custome_input" placeholder="{{ __('TO_DATE') }}" id="toDate" name="toDate" readonly value="{{ $autoEndDate }}">
                                        <button class="btn_date input-group-addon" type="button" tabindex="8">
                                            <img src="{{ asset('templates/shaper_helix3/images/common/calendar_icon.png') }}" alt="">
                                        </button>
                                        <a class="input-group-addon btn_date" href="javascript:;">
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </a>
                                        <div id="error_toDate" class="manual_tooltip_error error_tooltip"></div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>

                        <div class="filter select_type">
                            <div class="form-group">
                                <label>{{ __('TRANSECTION_TYPE') }}</label>
                                <div class="select_box">
                                    <select class="custome_input" id="txnType" name="txnType" tabindex="10">
                                        <option value="">{{ __('SELECT') }}</option>
                                        @foreach ($transaction_option as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    <div id="error_txnType" class="manual_tooltip_error error_tooltip"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>

                        <div class="filter">
                            <a class="btn btn_search" href="javascript:;" id="search">{{ __('SEARCH') }}</a>
                            <div class="clear"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Error and data display divs --}}
        <div id="error-div" class="alert_msg_div" style="display:none;">
            <div class="alert alert-danger">
                <a class="close" data-dismiss="alert">×</a>
                <div><p class="error-div-txt"></p></div>
            </div>
        </div>

        <div class="transaction_table" id="transaction-div" style="display:none;">
            <div class="heading" id="closing-balance-div" style="display:none;">
                <b id="closing-balance-text" style="font-weight: normal">{{ __('CLOSING_BALANCE') }}: </b>
                <strong> <span id="closing-balance"></span></strong>
            </div>
            <div class="heading" id="bonus-balance-div" style="display:none;">
                {{ __('TRANSECTION_BONUS_CHIP') }}: <strong>{{ $dispCurrency }} <span id="bonus-chips">{{ Auth::user()->bonusBalance ?? 0 }}</span></strong>
            </div>

            {{-- Multiple tables for different transaction types --}}
            <table id="transaction-table" class="table" style="display:none;">
                <thead>
                <tr>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_SNO') }}.</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_DT') }}</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_TID') }}</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_P') }}</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_CR') }}.</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_DR') }}.</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_BALANCE') }}</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>

            <table id="bonus-table" class="table" style="display:none;">
                <thead>
                <tr>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_DT') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_BONUS') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_AMT') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_REQ') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_CONT') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_RED') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_BOC') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_EXPD') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_STATUS') }}</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>

            <table id="ticket-table" class="table" style="display:none;">
                <thead>
                <tr>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_DT') }}</th>
                    <th>{{ __('TRANSECTION_TICKET_DETAIL_TICKET') }}</th>
                    <th>{{ __('TRANSECTION_TICKET_DETAIL_TC') }}</th>
                    <th>{{ __('TRANSECTION_TICKET_DETAIL_PEN') }}</th>
                    <th>{{ __('TRANSECTION_TICKET_DETAIL_EXP') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_STATUS') }}</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>

            <table id="wager-table" class="table" style="display:none;">
                <thead>
                <tr>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_SNO') }}.</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_DT') }}</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_TID') }}</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_P') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_AMT') }}</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>

            <table id="dwwr-table" class="table" style="display:none;">
                <thead>
                <tr>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_SNO') }}.</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_DT') }}</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_TID') }}</th>
                    <th>{{ __('TRANSECTION_DETAIL_TABLE_P') }}</th>
                    <th>{{ __('TRANSECTION_BONUS_DETAIL_AMT') }}</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('scripts')

<script>
var offset = 0;
var limit = {{ Constants::MAX_ROW_LIMIT }};
var pageWindow = 5;
var startPageNo = 1;
var endPageNo = 5;
var prevTxnType = '';
var prevFromDate = '';
var prevToDate = '';
var limitReached = false;
var lastPageNo = 0;
var fromPrev = false;

var currencyCode = "{{ $currencyCode }}";
var currencySymbol = "{{ $dispCurrency }}";

function checkPrevCall(txnType, fromDate, toDate) {
    if(txnType == prevTxnType && fromDate == prevFromDate && toDate == prevToDate) {
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
    var month = (d.getMonth()+1).toString().padStart(2,'0');
    var day = d.getDate().toString().padStart(2,'0');

    var current = day + '/' + month + '/' + year;

    var defaultViewDateObj = new Date();
    defaultViewDateObj.setDate(defaultViewDateObj.getDate() - 30);
    var defaultViewDate = defaultViewDateObj.getDate().toString().padStart(2,'0') + '/' +
        (defaultViewDateObj.getMonth()+1).toString().padStart(2,'0') + '/' +
        defaultViewDateObj.getFullYear();

    $('#fromdatepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        startDate: '01/01/1900',
        endDate: "0d",
        orientation: 'top',
        todayHighlight: true
    }).on('changeDate', function(e){
        $('#todatepicker').datepicker('setStartDate', e.date);
        if(e.date > $('#todatepicker').datepicker('getDate') && $("#toDate").val() != "")
            $('#todatepicker').datepicker('setDate', e.date);
    });
    $('#todatepicker').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        startDate: '01/01/1900',
        endDate: "0d",
        orientation: 'top',
        todayHighlight: true
    });
    $('#todatepicker').datepicker('setStartDate', defaultViewDate);

    $("#transaction-details-form").validate({
        showErrors: function(errorMap, errorList) {
            displayToolTipManual(this, errorMap, errorList, "bottom", undefined);
            if($(".datepicker.datepicker-dropdown.dropdown-menu").css("display") == "block")
                removeToolTipErrorManual('all');
        },
        rules: {
            fromDate: {
                required: true,
                dateITA : true
            },
            toDate: {
                required: true,
                dateITA : true
            },
            txnType: {
                valueNotEquals: ""
            }
        },
        messages: {
            fromDate: {
                required: "{{ __('TRANSECTION_TICKET_DETAIL_FEOM_BLANK_ERROR') }}",
                dateITA : "{{ __('TRANSECTION_TICKET_DETAIL_FROM_BLANK') }}"
            },
            toDate: {
                required: "{{ __('TRANSECTION_TICKET_DETAIL_TO_BLANK_ERROR') }}",
                dateITA: "{{ __('TRANSECTION_TICKET_DETAIL_FROM_BLANK') }}"
            },
            txnType: {
                valueNotEquals: "{{ __('TRANSECTION_TICKET_DETAIL_TRAN_TYPR') }}"
            }
        }
    });

    $('#search').click(function(event) {
        $('#transaction-div').hide();
        $("#bonus-table").hide();
        $("#ticket-table").hide();
        $("#wager-table").hide();
        $("#dwwr-table").hide();
        $("#transaction-table").hide();
        $("#error-div").hide().find('.error-div-txt').text('');

        if(!$('#transaction-details-form').valid())
            return false;

        var txnType = $('#txnType').val();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        if(!checkPrevCall(txnType, fromDate, toDate)) {
            return false;
        }

        var params = {
            fromDate: fromDate,
            toDate: toDate,
            txnType: txnType,
            offset: offset,
            limit: limit
        };

        if(txnType == "{{ Constants::TXNTYPE_BONUS_DETAILS }}") {
            startAjax("{{ $bonusDetailsURL }}", params, processBonusDetails, null);
        } else if(txnType == "{{ Constants::TXNTYPE_TICKET_DETAILS }}") {
            startAjax("{{ $transactionDetailsURL }}", params, processTicketDetails, null);
        } else {
            startAjax("{{ $transactionDetailsURL }}", params, processTransactionDetails, null);
        }
    });

    // Functions processBonusDetails, processTicketDetails, processTransactionDetails, and others can be placed here
    // They should parse AJAX responses and populate the correct tables similarly to your original code
});
function processTicketDetails(result)
    {
        var tmp_fromPrev = fromPrev;
        fromPrev = false;
        if(validateSession(result) == false)
            return false;
        var res = JSON.parse(result);
        if(res.errorCode != 0)
        {
            $('#ticket-table tbody > tr').remove();
            $('#transaction-div').css('display', 'none');
            //error_message(res.respMsg, null);
            $("#error-div").html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><div><p class="error-div-txt"></p></div></div>');
            $("#error-div .error-div-txt").html(res.respMsg);
            $("#error-div").css("display", "");
            return false;
        }
        if(res.ticketDetails.length <= 0)
        {
            $('#ticket-table tbody > tr').remove();
            $('#transaction-div').css('display', 'none');
            //error_message("No Ticket Details Found For Selected Date Range.", null);
            $("#error-div .error-div-txt").html(Joomla.JText._('TRANSECTION_JS_NO_TICKET'));
            $("#error-div").css("display", "");
            return false;
        }

        clearSystemMessage();

        $('#transaction-div').css('display', 'block');
        $("#ticket-table").css("display", "");

        $('#ticket-table tbody > tr').remove();

        var totRows = 50;
        limitReached = false;
        lastPageNo = 0;
        if(res.ticketDetails.length <= limit) {
            totRows = res.ticketDetails.length;
            limitReached = true;
        }

        $('#closing-balance-div').css('display', 'none');
        $('#bonus-balance-div').css('display', 'none');

        for(var i = 0; i < totRows; i++) {
            var footable = $('#ticket-table').data('footable');

            var ticketDate = '';
            var ticket = '';
            var ticketCount = '';
            var pendingTickets = '';
            var expiryDate = '';
            var status = '';

            if(typeof res.ticketDetails[i].receivedDate != 'undefined') {
                ticketDate = res.ticketDetails[i].receivedDate;
                var tmp = ticketDate.lastIndexOf(".");
                ticketDate = ticketDate.substring(0, tmp);
            }
            if(typeof res.ticketDetails[i].ticketCode != 'undefined')
                ticket = res.ticketDetails[i].ticketCode;
            if(typeof res.ticketDetails[i].ticketCount != 'undefined')
                ticketCount = res.ticketDetails[i].ticketCount;
            if(typeof res.ticketDetails[i].pendingTickets != 'undefined')
                pendingTickets = res.ticketDetails[i].pendingTickets;
            if(typeof res.ticketDetails[i].expiredDate != 'undefined') {
                expiryDate = res.ticketDetails[i].expiredDate;
                if(typeof expiryDate !== 'undefined' && expiryDate.indexOf("3000") != -1) {
                    expiryDate = "NONE";
                }
                else {
                    var tmp = expiryDate.lastIndexOf(".");
                    expiryDate = expiryDate.substring(0, tmp);

                    var tmp2 = expiryDate.split(" ");
                    var tmp_expired_date = tmp2[0].split("-");
                    var tmp_expired_time = tmp2[1];
                    expiryDate = tmp_expired_date[2]+"/"+tmp_expired_date[1]+"/"+tmp_expired_date[0];
                }
            }
            if(typeof res.ticketDetails[i].status != 'undefined')
                status = res.ticketDetails[i].status;

            var newRow = '<tr>' +
                '<td>'+ticketDate+'</td>' +
                '<td>'+ticket+'</td>' +
                '<td>'+ticketCount+'</td>' +
                '<td>'+pendingTickets+'</td>' +
                '<td>'+expiryDate+'</td>' +
                '<td>'+status+'</td>' +
                '</tr>';

            footable.appendRow(newRow);
        }

        $('#ticket-table').trigger('footable_redraw');
        if(offset == 0) {
            $('#ticket-table').trigger('footable_initialize');
            $('.footer-pagination-div').children().children().first().addClass(' disabled');
            $('#ticket-table tfoot').addClass('hide-if-no-paging');
        }
        else {
            $('#ticket-table tfoot').removeClass('hide-if-no-paging');
            if(totRows < 10)
                $('.footer-pagination-div').children().children().last().addClass(' disabled');
            resetPageNo($("#ticket-table .footer-pagination-div"));
        }
        if(tmp_fromPrev){
            $(".footer-pagination-div>ul>li").last().prev().children().trigger('click');
        }
    }

    function processBonusDetails(result)
    {
        var tmp_fromPrev = fromPrev;
        fromPrev = false;
        var currencySymbol = @json($dispCurrency);
        if(validateSession(result) == false)
            return false;
        var res = JSON.parse(result);
        if(res.errorCode != 0)
        {
            $('#bonus-table tbody > tr').remove();
            $('#transaction-div').css('display', 'none');
            //error_message(res.respMsg, null);
	    $("#error-div").html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><div><p class="error-div-txt"></p></div></div>');
            $("#error-div .error-div-txt").html(res.respMsg);
            $("#error-div").css("display", "");
            return false;
        }
        if(res.bonusList.length <= 0)
        {
            $('#transaction-table tbody > tr').remove();
            $('#transaction-div').css('display', 'none');
            //error_message("No Bonus Details Found For Selected Date Range.", null);
            $("#error-div .error-div-txt").html(Joomla.JText._('TRANSECTION_TICKET_NO_DATA_ERROR'));
            $("#error-div").css("display", "");
            return false;
        }

        clearSystemMessage();

        $('#transaction-div').css('display', 'block');
        $("#bonus-table").css("display", "");
        if(offset == 0) {
//            $('#bonus-chips').text(res.bonusList[0].amount);
        }
        $('#bonus-table tbody > tr').remove();

        var totRows = 50;
        limitReached = false;
        lastPageNo = 0;
        if(res.bonusList.length <= limit) {
            totRows = res.bonusList.length;
            limitReached = true;
        }

        $('#closing-balance-div').css('display', 'none');
        $('#bonus-balance-div').css('display', 'block');

        for(var i = 0; i < totRows; i++) {
            var footable = $('#bonus-table').data('footable');

            var receivedDate = '';
            var bonusCode = '';
            var amount = '';
            var target = '';
            var wrRequirement = '';
            var redeemedAmount = '';
            var bonusCriteria = '';
            var expiredDate = '';
            var status = '';

            if(typeof res.bonusList[i].receivedDate != 'undefined') {
                receivedDate = res.bonusList[i].receivedDate;
                var tmp = receivedDate.lastIndexOf(".");
                receivedDate = receivedDate.substring(0, tmp);

                var tmp2 = receivedDate.split(" ");
                var tmp_received_date = tmp2[0].split("-");
                var tmp_received_time = tmp2[1];
                receivedDate = tmp_received_date[2]+"/"+tmp_received_date[1]+"/"+tmp_received_date[0]+" "+tmp_received_time;
            }
            if(typeof res.bonusList[i].bonusCode != 'undefined')
                bonusCode = res.bonusList[i].bonusCode;
            if(typeof res.bonusList[i].amount != 'undefined')
                amount = res.bonusList[i].amount;
            if(typeof res.bonusList[i].target != 'undefined')
                target = res.bonusList[i].target;
            if(typeof res.bonusList[i].contribution != 'undefined')
                wrRequirement = currencySymbol+res.bonusList[i].contribution;
            if(typeof res.bonusList[i].redeemedAmount != 'undefined')
                redeemedAmount = res.bonusList[i].redeemedAmount;
            if(typeof res.bonusList[i].bonusCriteria != 'undefined')
                bonusCriteria = res.bonusList[i].bonusCriteria;

            if(typeof res.bonusList[i].expiredDate != 'undefined') {
                expiredDate = res.bonusList[i].expiredDate;
                if(expiredDate.indexOf("3000") != -1) {
                    expiredDate = "NONE";
                }
                else {
                    var tmp = expiredDate.lastIndexOf(".");
                    expiredDate = expiredDate.substring(0, tmp);

                    var tmp2 = expiredDate.split(" ");
                    var tmp_expired_date = tmp2[0].split("-");
                    var tmp_expired_time = tmp2[1];
                    expiredDate = tmp_expired_date[2]+"/"+tmp_expired_date[1]+"/"+tmp_expired_date[0];
                }
            }
            if(typeof res.bonusList[i].status != 'undefined')
                status = res.bonusList[i].status;

            var newRow = '<tr>' +
                '<td>'+receivedDate+'</td>' +
                '<td>'+bonusCode+'</td>' +
                '<td>'currencySymbol+amount+'</td>' +
                '<td>'currencySymbol+target+'</td>' +
                '<td>'+wrRequirement+'</td>' +
                '<td>'currencySymbol+redeemedAmount+'</td>' +
                '<td>'+bonusCriteria+'</td>' +
                '<td>'+expiredDate+'</td>' +
                '<td>'+status+'</td>' +
                '</tr>';

            footable.appendRow(newRow);
        }

        $('#bonus-table').trigger('footable_redraw');
        if(offset == 0) {
            $('#bonus-table').trigger('footable_initialize');
            $('.footer-pagination-div').children().children().first().addClass(' disabled');
            $('#bonus-table tfoot').addClass('hide-if-no-paging');
        }
        else {
            $('#bonus-table tfoot').removeClass('hide-if-no-paging');
            if(totRows < 10)
                $('.footer-pagination-div').children().children().last().addClass(' disabled');
            resetPageNo($("#bonus-table .footer-pagination-div"));
        }
        if(tmp_fromPrev){
            $(".footer-pagination-div>ul>li").last().prev().children().trigger('click');
        }
    }

    function processTransactionDetails(result)
    {
        var tmp_fromPrev = fromPrev;
        fromPrev = false;
        if(validateSession(result) == false)
            return false;
        var res = JSON.parse(result);
        if(res.errorCode != 0)
        {
            $('#wager-table tbody > tr').remove();
            $('#dwwr-table tbody > tr').remove();
            $('#transaction-table tbody > tr').remove();
            $('#transaction-div').css('display', 'none');
            //error_message(res.respMsg, null);
	    $("#error-div").html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><div><p class="error-div-txt"></p></div></div>');
            $("#error-div .error-div-txt").html(res.respMsg);
            $("#error-div").css("display", "");
            return false;
        }
        if(res.txnList.length <= 0)
        {
            $('#wager-table tbody > tr').remove();
            $('#dwwr-table tbody > tr').remove();
            $('#transaction-table tbody > tr').remove();
            $('#transaction-div').css('display', 'none');
            //error_message("No Transaction Details Found For Selected Date Range.", null);
            $("#error-div .error-div-txt").html(Joomla.JText._('TRANSECTION_TICKET_NO_DATA_ERROR'));
            $("#error-div").css("display", "");
            return false;
        }

        clearSystemMessage();
        $('#transaction-div').css('display', 'block');
        if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER; ?>')
            $("#wager-table").css("display", "");
        else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER_REFUND; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WINNING; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_DEPOSIT; ?>')
            $("#dwwr-table").css("display", "");
        else
            $("#transaction-table").css("display", "");

        if(offset == 0) {
            if(typeof res.txnList[0].balance != 'undefined') {
                $('#closing-balance-div').css('display', 'block');
                $('#bonus-balance-div').css('display', 'none');
                if($('#txnType').val() == '<?php echo Constants::TXNTYPE_ALL; ?>') {
                    if($(".cash-balance").length > 0 && $("#toDate").val().trim() == '<?php echo date('d/m/Y');?>')   
			{
                               updateBalance(parseFloat(res.totalBalance.toFixed(2)));
                               //updateBalance(res.cashBalance);
              		       updateWithdrawBalance(res.withdrawableBalance);
			}     
			$('#cash-balance').text(res.txnList[0].currency+' '+ res.totalBalance.toFixed(2));                


                    $('#closing-balance-text').html(Joomla.JText._('WEAVER_CLOSING_BALANCE'));
                    $('#closing-balance').html(formatCurrency(res.txnList[0].balance.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),currencyCode, currencySymbol));
                }
                else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_DEPOSIT; ?>') {
                    $('#closing-balance-text').html(Joomla.JText._('TRANSECTION_JS_TOTAL_DEPOSIT'));
                    $('#closing-balance').html(formatCurrency(res.txnTotalAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),currencyCode, currencySymbol));
                }
                else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WITHDRAWAL; ?>') {
                    $('#closing-balance-text').html(Joomla.JText._('TRANSECTION_JS_TOTAL_WT'));
                    $('#closing-balance').html(formatCurrency(res.txnTotalAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),currencyCode, currencySymbol));
                }
                else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER; ?>') {
                    $('#closing-balance-text').html(Joomla.JText._('TRANSECTION_JS_TOTAL_WAGER'));
                    $('#closing-balance').html(formatCurrency(res.txnTotalAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),currencyCode, currencySymbol));
                }
                else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER_REFUND; ?>') {
                    $('#closing-balance-text').html(Joomla.JText._('TRANSECTION_JS_TOTAL_PERIOD'));
                    $('#closing-balance').html(formatCurrency(res.txnTotalAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),currencyCode, currencySymbol));
                }
                else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WINNING; ?>') {
                    $('#closing-balance-text').html(Joomla.JText._('TRANSECTION_JS_TOTAL_WINNING_P'));
                    $('#closing-balance').html(formatCurrency(res.txnTotalAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),currencyCode, currencySymbol));
                }
                else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_DEPOSIT_AGAINST_CANCEL; ?>') {
                    $('#closing-balance-text').html(Joomla.JText._('TRANSECTION_JS_TOTAL_WITHDRAWL_C'));
                    $('#closing-balance').html(formatCurrency(res.txnTotalAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),currencyCode, currencySymbol));
                }
                else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_BONUS_TRANSFER; ?>') {
                    $('#closing-balance-text').html(Joomla.JText._('TRANSECTION_JS_TOTAL_BONUS_TRANSFER'));
                    $('#closing-balance').html(formatCurrency(res.txnTotalAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),currencyCode, currencySymbol));
                }
                else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_BO_CORRECTION; ?>') {
                    $('#closing-balance-text').html(Joomla.JText._('TRANSECTION_JS_TOTAL_PAYMENT_CORRECTION'));
                    $('#closing-balance').html(formatCurrency(res.txnTotalAmount.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","),currencyCode, currencySymbol));
                }
            }
            else {
                $('#closing-balance-div').css('display', 'none');
                $('#bonus-balance-div').css('display', 'none');
                $('#closing-balance-text').html('');
                $('#closing-balance').html('');
            }
        }
        $('#wager-table tbody > tr').remove();
        $('#dwwr-table tbody > tr').remove();
        $('#transaction-table tbody > tr').remove();

        var totRows = 50;
        limitReached = false;
        lastPageNo = 0;
        if(res.txnList.length <= limit) {
            totRows = res.txnList.length;
            limitReached = true;
        }

        for(var i = 0; i < totRows; i++) {
            if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER; ?>')
                var footable = $('#wager-table').data('footable');
            else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER_REFUND; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WINNING; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_DEPOSIT; ?>')
                var footable = $('#dwwr-table').data('footable');
            else
                var footable = $('#transaction-table').data('footable');

            var txndate = '';
            var txnid = '';
            var particular = '';
            var crAmount = '';
            var drAmount = '';
            var balance = '';

            var applyColor = "";
            if(typeof res.txnList[i].transactionDate != 'undefined'){
                txndate = res.txnList[i].transactionDate;
                var tmp = txndate.lastIndexOf(".");
                txndate = txndate.substring(0, tmp);
            }
            if(typeof res.txnList[i].transactionId != 'undefined')
                txnid = res.txnList[i].transactionId;

            if(typeof res.txnList[i].particular != 'undefined'){

                particular = res.txnList[i].particular;
            }

            if(typeof res.txnList[i].creditAmount != 'undefined')
                crAmount = ''+res.txnList[i].creditAmount;
            else
                drAmount = ''+res.txnList[i].debitAmount;

            if(typeof res.txnList[i].balance != 'undefined') {
                if(res.txnList[i].subwalletTxn == "NO") {
                    balance = res.txnList[i].balance+'';
                    var tmp = balance.lastIndexOf('.');
                    if(tmp >0) {
                        balance = parseFloat(balance);
                        balance = balance.toFixed(2);
                    }
                    balance = parseFloat(balance).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    balance = formatCurrency(balance,currencyCode, currencySymbol);
                }
                else {
                    balance = '';
                    applyColor = "style='color: blue;'";
                }
            }

            var newRow = '';
            if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER; ?>')
            {
                newRow = '<tr '+applyColor+'>' +
                    '<td>'+(offset + i + 1)+'</td>' +
                    '<td>'+txndate+'</td>' +
                    '<td>'+txnid+'</td>' +
                    '<td>'+particular+'</td>' +
                    '<td>'+res.txnList[i].txnAmount+'</td>' +
                    '</tr>';
            }
            else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER_REFUND; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WINNING; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_DEPOSIT; ?>')
            {
                newRow = '<tr '+applyColor+'>' +
                    '<td>'+(offset + i + 1)+'</td>' +
                    '<td>'+txndate+'</td>' +
                    '<td>'+txnid+'</td>' +
                    '<td>'+particular+'</td>' +
                    '<td>'+crAmount+'</td>' +
                    '</tr>';
            }
            else
            {
                newRow = '<tr '+applyColor+'>' +
                    '<td>'+(offset + i + 1)+'</td>' +
                    '<td>'+txndate+'</td>' +
                    '<td>'+txnid+'</td>' +
                    '<td>'+particular+'</td>' +
                    '<td>'+crAmount+'</td>' +
                    '<td>'+drAmount+'</td>' +
                    '<td>'+balance+'</td>' +
                    '</tr>';
            }

            applyColor = "";
            footable.appendRow(newRow);
        }

        if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER; ?>')
            $('#wager-table').trigger('footable_redraw');
        else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER_REFUND; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WINNING; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_DEPOSIT; ?>')
            $('#dwwr-table').trigger('footable_redraw');
        else
            $('#transaction-table').trigger('footable_redraw');

        if(offset == 0) {
            if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER; ?>')
            {
                $('#wager-table').trigger('footable_initialize');
                $('.footer-pagination-div').children().children().first().addClass(' disabled');
                $('#wager-table tfoot').addClass('hide-if-no-paging');
            }
            else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER_REFUND; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WINNING; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_DEPOSIT; ?>')
            {
                $('#dwwr-table').trigger('footable_initialize');
                $('.footer-pagination-div').children().children().first().addClass(' disabled');
                $('#dwwr-table tfoot').addClass('hide-if-no-paging');
            }
            else
            {
                $('#transaction-table').trigger('footable_initialize');
                $('.footer-pagination-div').children().children().first().addClass(' disabled');
                $('#transaction-table tfoot').addClass('hide-if-no-paging');
            }

        }
        else {
            if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER; ?>')
            {
                $('#wager-table tfoot').removeClass('hide-if-no-paging');
                if(totRows < 10)
                    $('.footer-pagination-div').children().children().last().addClass(' disabled');
                resetPageNo($("#wager-table .footer-pagination-div"));
            }
            else if($('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WAGER_REFUND; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_WINNING; ?>' || $('#txnType').val() == '<?php echo Constants::TXNTYPE_PLR_DEPOSIT; ?>')
            {
                $('#dwwr-table tfoot').removeClass('hide-if-no-paging');
                if(totRows < 10)
                    $('.footer-pagination-div').children().children().last().addClass(' disabled');
                resetPageNo($("#dwwr-table .footer-pagination-div"));
            }
            else
            {
                $('#transaction-table tfoot').removeClass('hide-if-no-paging');
                if(totRows < 10)
                    $('.footer-pagination-div').children().children().last().addClass(' disabled');
                resetPageNo($("#transaction-table .footer-pagination-div"));
            }

        }

        if(tmp_fromPrev){
            $(".footer-pagination-div>ul>li").last().prev().children().trigger('click');
        }
    }

    $('.footer-pagination-div').click(function(event) {
        if(limitReached == true && $(this).find("li.footable-page.active a").text()==lastPageNo && $(this).find("li.footable-page.active a").text()!=startPageNo) {
            $(this).find('li.footable-page.active').next().addClass(' disabled');
            $(this).children().children().last().removeClass('loadnext');
            if(!$(this).find('li.footable-page.active a').prev().hasClass('loadprev'))
                $(this).children().children().first().removeClass('loadprev');
            return;
        } else {
            $(this).children().children().last().removeClass(' disabled');
        }

        if($(this).find('li.footable-page.active a').text() == 1){
            $(this).children().children().first().addClass(' disabled');
        } else {
            $(this).children().children().first().removeClass(' disabled');
        }

        if($(this).find('li.footable-page.active a').text() == endPageNo) {

            $(this).find('li.footable-page.active').next().addClass(' loadnext');
            $(this).children().children().first().removeClass('loadprev');

        } else if($(this).find('li.footable-page.active a').text() == startPageNo) {

            if($(this).find('li.footable-page.active').children().text()!=1)
                $(this).find('li.footable-page.active').prev().addClass(' loadprev');
            $(this).find(this).children().children().last().removeClass('loadnext');

        } else {
            $(this).children().children().first().removeClass('loadprev');
            $(this).children().children().last().removeClass('loadnext');
        }

        if(limitReached) {
            setLastPageNo($(this));
            if($(this).find('li.footable-page.active a').text()==lastPageNo)
                $(this).find('li.footable-page.active').next().addClass(' disabled');
            return;
        }

    });

    $('.footer-pagination-div').on('click', '.loadnext' , function(event) {
        $('#transaction-div').css('display', 'none');
        $("#bonus-table").css("display", "none");
        $("#ticket-table").css("display", "none");
        $("#wager-table").css("display", "none");
        $("#dwwr-table").css("display", "none");
        $("#transaction-table").css("display", "none");

        if(!$('#transaction-details-form').valid())
            return false;

        var txnType = $('#txnType').val();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        offset = offset + limit;
        startPageNo = startPageNo + pageWindow;
        endPageNo = endPageNo + pageWindow;

        var params = 'fromDate='+fromDate+'&toDate='+toDate+'&txnType='+txnType+'&offset='+offset+'&limit='+limit;
        if(txnType == "<?php echo Constants::TXNTYPE_BONUS_DETAILS;?>")
            startAjax(<?php echo json_encode($bonusDetailsURL);?>, params, processBonusDetails, 'null');
        else if(txnType == "<?php echo Constants::TXNTYPE_TICKET_DETAILS;?>")
            startAjax(<?php echo json_encode($transactionDetailsURL);?>, params, processTicketDetails, 'null');
        else
            startAjax(<?php echo json_encode($transactionDetailsURL);?>, params, processTransactionDetails, 'null');
    });

    $('.footer-pagination-div').on('click', '.loadprev' , function(event) {
        $('#transaction-div').css('display', 'none');
        $("#bonus-table").css("display", "none");
        $("#transaction-table").css("display", "none");
        $("#ticket-table").css("display", "none");
        $("#wager-table").css("display", "none");
        $("#dwwr-table").css("display", "none");

        if(!$('#transaction-details-form').valid())
            return false;

        var txnType = $('#txnType').val();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        offset = offset - limit;
        startPageNo = startPageNo - pageWindow;
        endPageNo = endPageNo - pageWindow;

        var params = 'fromDate='+fromDate+'&toDate='+toDate+'&txnType='+txnType+'&offset='+offset+'&limit='+limit;

        fromPrev = true;
        if(txnType == "<?php echo Constants::TXNTYPE_BONUS_DETAILS;?>")
            startAjax(<?php echo json_encode($bonusDetailsURL);?>, params, processBonusDetails, 'null');
        else if(txnType == "<?php echo Constants::TXNTYPE_TICKET_DETAILS;?>")
            startAjax(<?php echo json_encode($transactionDetailsURL);?>, params, processTicketDetails, 'null');
        else
            startAjax(<?php echo json_encode($transactionDetailsURL);?>, params, processTransactionDetails, 'null');
    });

    function resetPageNo(obj) {
        var pageNo = startPageNo;
        $(obj.children().children()).each(function() {
            if($(this).children().attr('data-page') == "prev"){
                $(this).addClass(' loadprev');
            }
            if($(this).children().attr('data-page') != "prev" && $(this).children().attr('data-page') != "next")
            {
                $(this).children().text(pageNo);
                if(limitReached == true)
                    lastPageNo = pageNo;
                pageNo++;
            }
        });
    }


    function setLastPageNo(obj) {
        var pageNo = startPageNo;
        $(obj.children().children()).each(function() {
            if($(this).children().attr('data-page') != "prev" && $(this).children().attr('data-page') != "next") {
                if(limitReached == true)
                    lastPageNo = pageNo;
                pageNo++;
            }
        });
    }

    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");

    $("#transaction-details-form").validate({
        showErrors: function(errorMap, errorList) {
            displayToolTipManual(this, errorMap, errorList, "bottom", undefined);
            if($(".datepicker.datepicker-dropdown.dropdown-menu").css("display") == "block")
                removeToolTipErrorManual('all');
        },
        rules: {
            fromDate: {
                required: true,
                dateITA : true
            },
            toDate: {
                required: true,
                dateITA : true
            },
            txnType: {
                valueNotEquals: ""
            }
        },
        messages: {
            fromDate: {
                required: Joomla.JText._('TRANSECTION_TICKET_DETAIL_FEOM_BLANK_ERROR'),
                dateITA : Joomla.JText._('TRANSECTION_TICKET_DETAIL_FROM_BLANK')
            },
            toDate: {
                required: Joomla.JText._('TRANSECTION_TICKET_DETAIL_TO_BLANK_ERROR'),
                dateITA: Joomla.JText._('TRANSECTION_TICKET_DETAIL_FROM_BLANK')
            },
            txnType: {
                valueNotEquals: Joomla.JText._('TRANSECTION_TICKET_DETAIL_TRAN_TYPR')
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
</script>
@endpush

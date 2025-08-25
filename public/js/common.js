var $ = jQuery.noConflict();
var base_href = "";
var hide_decimal = true;
var cnt = 0;
var update_both_balances = false;
var defaultCurrencyCode = 'EUR';
var defaultCurrencyDisp = 'EUR';
var myPagesList = {
    'play_now_thailotteryhighfrequency': '/lotto-diamond',
};
/*** Clear error if exists on next key press. */
document.onkeypress = function (){
    clearSystemMessage();
};
var rtkcid;
var cmpid;
/*** Fucntion to clear system message.*/
function clearSystemMessage(){
    $("#system-message-container").empty();
}
/***Function to show error message.*/
function error_message(s1, s2){
    $("#system-message-container").html("" + "<div id='system-message'>" +
            "<div class='alert alert-danger'>" +
            "<a class='close' data-dismiss='alert'>x</a>" +
            "<h4 class='alert-heading'></h4>" +
            "<div>" +
            "<p>" + s1 + "</p>" +
            "</div>" +
            "</div>" +
            "</div>");
    $("#" + s2).focus();
    window.scrollTo(0, 0);
}
/***Function to show warning message.*/
function warning_message(s1){
    $("#system-message-container").html("" + "<div id='system-message'>" +
            "<div class='alert alert-warning'>" +
            "<a class='close' data-dismiss='alert'>x</a>" +
            "<h4 class='alert-heading'>Warning</h4>" +
            "<div>" +
            "<p>" + s1 + "</p>" +
            "</div>" +
            "</div>" +
            "</div>");
    window.scrollTo(0, 0);
}
/***Function to show info message.*/
function info_message(s1){
    $("#system-message-container").html("" + "<div id='system-message'>" +
            "<div class='alert alert-info'>" +
            "<a class='close' data-dismiss='alert'>x</a>" +
            "<h4 class='alert-heading'>Warning</h4>" +
            "<div>" +
            "<p>" + s1 + "</p>" +
            "</div>" +
            "</div>" +
            "</div>");
    window.scrollTo(0, 0);
}
/***Function to show success message.*/
function success_message(s1){   
    $("#system-message-container").html("" + "<div id='system-message'>" +
            "<div class='alert alert-success'>" +
            "<a class='close' data-dismiss='alert'>x</a>" +
            "<h4>" + Joomla.JText._('SUCCESS') + "</h4>" +
            "<div>" +
            "<p>" + s1 + "</p>" +
            "</div>" +
            "</div>" +
            "</div>");
    window.scrollTo(0, 0);
}
/***Function to make an ajax call.*/
function startAjax(url, params, reply, str, cashierFunc, payLoad){
    if (typeof payLoad == 'undefined') {
        payLoad = '';
    }
    var nvar = /khelplayrummy/gi;
    if (url.search(nvar) == -1)
        url = base_href + url;
    // removeToolTipError('all');
    // removeToolTipErrorManual('all');
    var result = '';
    if (str != "null"){
        $(str).submit(function (e) {
            e.preventDefault();
        });
    }
    if (str != "nottoshow") {
        $("#loadingImage").remove();
        $("body").append('<div id="loadingImage"><img src="' + base_href + '/images/loading3.gif" /></div>');
        $("#loadingImage").css("display", "flex");
        $("#loadingImage").focus();
    }
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var fullParams = params + "&isAjax=true" + "&_token=" + encodeURIComponent(csrfToken);
    $.ajax({
        type: 'POST',
        async: true,
        url: url,
        data: fullParams,
        encode: true,
        timeout:30000,
        error: showNetworkErrorCommon
    }).done(function (data1) {
        if (str != "nottoshow") {
            $("#loadingImage").remove();
        }
        if (str == 'cashier-check') {
            cashierFunc();
        } else {
            reply(data1);
        }
        return;
        result = data1;
    }).fail(function (data1, jqXHR, textStatus) {
        if (textStatus == 'timeout')
        {   
            errorDisplay("Please Try Again Later", 'error');
            //do something. Try again perhaps?
        }
        if (str != "nottoshow") {
            $("#loadingImage").remove();
        }
        return false;
    });
    return result;
}

function showNetworkErrorCommon(request, status, err) {
//    if (status == "timeout") {
//       errorDisplay(Joomla.JText._('WEAVER_NO_INTERNET_CONNECTION_MSG'), 'error');
//        //window.location.reload(); //make it comment if you don't want to reload page
//    }
    if (status == "error") {
        errorDisplay(Joomla.JText._('WEAVER_NO_INTERNET_CONNECTION_MSG'), 'error');
        $('input[type="password"]').val("");
        removeToolTipErrorManual('all');
    } else {
        window.location.reload(); //make it comment if you don't want to reload page
    }
    return false;
}

/**
 *Function to make an ajax call.
 */
function startAjaxFileUpload(url, params, reply, str, beforeAjax, afterAjax){
    var nvar = /khelplayrummy/gi;
    if (url.search(nvar) == -1)
        url = base_href + url;
    removeToolTipError('all');
    removeToolTipErrorManual('all');
    var result = '';
    if (str != "null"){
        $(str).submit(function (e) {
            e.preventDefault();
        });
    }
    if (beforeAjax != undefined) {
        $(document).ajaxStart(beforeAjax);
    }
    if (afterAjax != undefined) {
        $(document).ajaxStop(afterAjax);
    }
    $.ajax({
        type: 'POST',
        async: true,
        url: url,
        data: params,
        processData: false,
        contentType: false
    }).done(function (data1) {
        reply(data1);
        return;
        result = data1;
    }).fail(function (data1) {
        return false;
    });
    return result;
}
/***Function to validate session through javascript.*/
function validateSession(id){
    var res = $.parseJSON(id);
    if (res.flag != 'undefined') {
        if (res.flag == 'EXPIRE' || res.flag == 'ALREADY' || res.flag == 'RELOAD') {
            location.href = res.path;
            return false;
        }
    } else
        return true;
}
/***Function to show error in tooltip.*/
function showToolTipError(id, errMsg, placement, callback){
    if (placement == undefined) {
        placement = 'bottom';
    }
    var selector = id;
    if (typeof id == "string")
        selector = "#" + id;
    $(selector).addClass('error');
    $(selector).tooltip('destroy');
    $(selector).attr("data-toggle", "tooltip");
    $(selector).attr("data-placement", placement);
    $(selector).attr("title", errMsg);
    $(selector).tooltip({
        show: true,
        trigger: 'manual',
        animation: false
    });
    $(selector).tooltip('show');
    if (callback != "" && callback != undefined) {
        window[callback](placement, $("#" + id), "error");
    }
}

function showToolTipErrorManual(id, errMsg, placement, $element, callback){
    if (placement == undefined) {
        placement = 'bottom';
    }
    $("#" + id).addClass('error');
    $("#" + id).parent().find('#error_' + $element.attr("id")).html(errMsg);
    $("#" + id).parent().find('#error_' + $element.attr("id")).css("display", "flex");
    if (callback != "" && callback != undefined) {
        window[callback](placement, $("#" + id), "error");
    }
}
/***Function to remove tooltip from an element.*/
function removeToolTipError(id) {
    if (id === "all") {
        // Select all elements with Bootstrap 5 tooltips
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(el) {
            const tooltipInstance = bootstrap.Tooltip.getInstance(el);
            if (tooltipInstance) {
                tooltipInstance.dispose();
            }
            el.classList.remove('error');
            el.removeAttribute('data-bs-toggle');
            el.removeAttribute('data-placement'); // not used in BS5 but safe to remove
            el.removeAttribute('title');
            el.removeAttribute('data-bs-original-title');
            el.removeAttribute('aria-describedby');
        });

        // Remove visible tooltip elements
        document.querySelectorAll('.tooltip').forEach(el => el.remove());

    } else {
        const el = document.getElementById(id);
        if (el) {
            const tooltipInstance = bootstrap.Tooltip.getInstance(el);
            if (tooltipInstance) {
                tooltipInstance.dispose();
            }
            el.classList.remove('error');
            el.removeAttribute('data-bs-toggle');
            el.removeAttribute('data-placement');
            el.removeAttribute('title');
            el.removeAttribute('data-bs-original-title');
            el.removeAttribute('aria-describedby');
        }
    }
}


function removeToolTipErrorManual(id, $element){
    if (id == "all") {
        $($(".manual_tooltip_error")).each(function () {
            $(this).css('display', 'none');
            $(this).html('');
            $element = $(this).attr("id").trim().replace("error_", "");
            $(this).parent().find("#" + $element).removeClass('error');
        });
    } else {
        $element.removeClass('error');
        if ($element.attr('type') == 'radio') {
            $element.parent().parent().parent().find("#error_" + $element.attr('id')).css('display', 'none');
            $element.parent().parent().parent().find("#error_" + $element.attr('id')).html('');
        } else {
            if ($element.attr('prefix') == 'prefix') {
                $element.parent().parent().find('#error_' + $element.attr("id")).css('display', 'none');
                $element.parent().parent().find('#error_' + $element.attr("id")).html('');
            } else {
                $element.parent().find("#error_" + $element.attr('id')).css('display', 'none');
                $element.parent().find("#error_" + $element.attr('id')).html('');
            }
        }
    }
}
/***Function to how tooltip errors in tooltip (jQuery validation).*/
function displayToolTip(obj, errorMap, errorList, placement, callback) {
    if (placement == undefined) {
        placement = 'bottom';
    }
    $.each(obj.validElements(), function (index, element) {
        var $element = $(element);
        $element.data("title", "")
                .removeClass("error")
                .tooltip("destroy");
    });
    $.each(errorList, function (index, error) {
        var $element = $(error.element);
        $element.tooltip("destroy")
                .data({
                    "title": error.message,
                    "placement": placement
                })
                .addClass("error")
                .tooltip({
                    show: true,
                    trigger: 'manual',
                    animation: false
                });
        $($element).tooltip('show');
        if (callback != "" && callback != undefined) {
            window[callback](placement, $($element), "error");
        }
    });
}

function displayToolTipManual(obj, errorMap, errorList, placement, callback){
    if (placement == undefined) {
        placement = 'bottom';
    }
    $.each(obj.validElements(), function (index, element) {
        var $element = $(element);
        $element.data("title", "").removeClass("error");
        $element.parent().find('#error_' + $element.attr("id")).css("display", "none");
        if (callback != "" && callback != undefined) {
            try {
                window[callback](placement, $($element), "success");
            } catch (e) {
            }
        }
    });
    $.each(errorList, function (index, error) {
        var $element = $(error.element);
        $element.addClass("error");
        if ($element.attr('type') == 'radio') {
            $element.parent().parent().parent().find('#error_' + $element.attr("id")).html(error.message);
            $element.parent().parent().parent().find('#error_' + $element.attr("id")).css("display", "flex");
        } else {
            if($element.attr('prefix') == 'prefix'){
            $element.parent().parent().find('#error_' + $element.attr("id")).html(error.message);
            $element.parent().parent().find('#error_' + $element.attr("id")).css("display", "flex");
           }
            $element.parent().find('#error_' + $element.attr("id")).html(error.message);
            $element.parent().find('#error_' + $element.attr("id")).css("display", "flex");
        }
        if (callback != "" && callback != undefined) {
            try {
                window[callback](placement, $($element), "error");
            } catch (e) {
            }
        }
    });
}
/***Function to update balance.*/
function updateBalance(balance,currency='',dispCurrency=''){
    if( (currency) == '' ){
        currency = defaultCurrencyCode;
    }
    if( (dispCurrency) == ''  ){
        dispCurrency = defaultCurrencyDisp;
    }
    $("#amount-text").text(balance);
}

function updatePracticeBalance(balance){
    if ($(".practice-balance").length > 0)
        $(".practice-balance").html(balance);
}

function updateWithdrawBalance(balance,currency='',dispCurrency=''){
    if( (currency) == '' ){
        currency = defaultCurrencyCode;
    }
    if( (dispCurrency) == ''  ){
        dispCurrency = defaultCurrencyDisp;
    }
    if ($(".withdraw-balance").length > 0 || $(".withdrawal-balance").length > 0){
        $(".withdraw-balance").html(balance);
        $(".withdrawal-balance").html(formatCurrency(balance,currency,dispCurrency));
    }
    if ($(".withdrawl_amount").length > 0){
        $($('.withdrawl_amount strong')).each(function () {
            $(this).html(balance);
        });
    }
}

$(document).ready(function () {
    //for specially IE
    if (navigator.userAgent.indexOf("MSIE") !== -1 || navigator.appVersion.indexOf('Trident/') > -1) {
        $('body').addClass('ie');
    }
    var isTab = /(ipad|iphone)/.test(navigator.userAgent.toLowerCase());
    if(isTab){
        $('body').addClass('unSupported');
    }
    navigator.sayswho = (function () {
        var supportUp = [];
        supportUp["Chrome"] = "77",
                supportUp["MSIE"] = "12",
                supportUp["IE"] = "12",
                supportUp["Edge"] = "44",
                supportUp["Firefox"] = "60",
                supportUp["Safari"] = "100"
        var ua = navigator.userAgent, tem,
                M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
        if (/Opera Mini/i.test(ua)) {
            $('body').addClass('unSupported');
            $('body').removeClass('supported');
            $('body').addClass('opmini');
            //            if ($('body').hasClass('opmini')) {
            $('#sp-component .modal.fade').each(function () {
                $(this).wrap('<div id="modCopyFlash"></div>');
                var modCopyFlashContent = $(this).parent().html();
                $('#sp-custom-popup > .sp-column').append('<div class="sp-module"><div class="sp-module-content"><div class="custom">' + modCopyFlashContent + '</div></div></div>');
                $('#modCopyFlash').remove();
            })
            //             }
            return "opera mini";
        }
        if (M[1] === 'Chrome') {
            tem = ua.match(/\b(OPR|Edge)\/(\d+)/);
            if (tem != null)
                tem.slice(1).join(' ').replace('OPR', 'Opera');
        }
        M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
        if ((tem = ua.match(/version\/(\d+)/i)) != null)
            M.splice(1, 1, tem[1]);

        if (parseInt(supportUp[M[0]]) >= parseInt(M[1])) {
            $('body').addClass('unSupported');
        } else
            $('body').addClass('supported');
        $('body').addClass('br-' + M[0]);
        return M.join(' ');
    })();



    //to open login popup if not login or redirect to link
    for (var key_game_title in myPagesList) {
        var Title = key_game_title;
        $("[title='" + key_game_title + "']").attr("customclick", key_game_title);
        $("[title='" + key_game_title + "']").attr("href", myPagesList[key_game_title]);
        switch (Title) {
            case 'play_now_thailotteryhighfrequency':
                Title = "Play Now Lotto Diamond";
                break;
            default:
                Title = getCameCase(key_game_title.replace(/_/g, ' '));
        }
        $("[title='" + key_game_title + "']").attr("title", Title);
    }

    $("[customclick]").off('click').on('click', function (e) {
        if (!e.ctrlKey) {
            e.preventDefault();
            openMyPages($(this).attr('customclick'));
            // if ($("body").hasClass("post-login") == true) {
            //     openMyPages($(this).attr('customclick'));
            // } else {
            //     //                     $('.modal').modal('hide');
            //     //                     if($("#loginModal_popup").length > 0) {
            //     //                         $("#loginModal_popup form").attr("from-title", $(this).attr('customclick'));
            //     //                         $("#loginModal_popup form").attr("modal-id", "#loginModal_popup");
            //     //                         $("#loginModal_popup").modal('show');
            //     //                     }
            //     window.open($(".loginAdd").attr("href") + "?fromPage=" + btoa($(this).attr('href')), '_blank');
            // }
        }
    });

    //to start Slider Timer updater Function custom_slider
    setInterval(update_timer, 1000);
    $(document).on('hidden.bs.modal', function (event) {
        removeToolTipError("all");
        removeToolTipErrorManual('all');
        $("#" + $(event.target).attr("id")).find('form').trigger('reset');
        $("#loginModal form").removeAttr("from-title");
        $("#loginModal form").removeAttr("modal-id");
    });

    $(document).on('show.bs.modal', function (event) {
        $("#" + $(event.target).attr("id")).find('form').trigger('reset');
        removeToolTipError("all");
        removeToolTipErrorManual('all');
    });

    $(document).on('shown.bs.modal', function (event) {
        if ($("body").hasClass("modal-open") == false)
            $("body").addClass("modal-open");
        $("a.close-offcanvas").trigger('click');
    });

    $("li>a.log-out-menu-item, li.log-out-menu-item>a").on('click', function (e) {
        e.preventDefault();
        e.stopPropagation()
        e.stopImmediatePropagation();
        $("a.close-offcanvas").trigger('click');
        $("#notification").modal('show');
    });

    if ($('input').length > 0) {
        $(':input').not('[type="file"]').change(function () {
            $(this).val($(this).val().trim());
        });
    }
    if ($('textarea').length > 0) {
        $('textarea').change(function () {
            $(this).val($(this).val().trim());
        });
    }

    $(document).on("click", '[role="tooltip"]', function () {
        removeToolTipError($("[aria-describedby='" + $(this).attr("id") + "']").attr("id"));
    });

    $(document).on('click', '.manual_tooltip_error', function () {
        removeToolTipErrorManual('all');
    });

    $(document).on('keypress', function () {
        $($('input[aria-invalid="false"]')).each(function () {
            removeToolTipError($(this).attr("id"));
        });
    });

    if (navigator.userAgent.match(/iPhone/i)) {
        $("*").on('click', 'a.close', function (event) {
            clearSystemMessage();
        });
    }

    $(".update_balance").on('click', function () {
        updatePlayerBalance(false);
    });

    $(".update_practice_balance").on('click', function () {
        updatePlayerBalance(true);
    });

    $("[menu-toggler='true']").click(function () {
        $("#offcanvas-toggler").trigger("click");
        $('body').addClass('stopScroll');
    });

    $('.close-offcanvas').on('click', function () {
        $('body').removeClass('stopScroll');
    });

    $("a.downarrow").on('click', function () {
        bookmarkscroll.scrollTo('sp-geting-started');
    });

    $("[open_raf='true']").attr("href", "javascript:void(0);");
    $("[open_raf='true']").on('click', function (e) {
        e.preventDefault();
        if ($("body").hasClass("post-login") == true) {
            openReferAFriendPage();
        } else {
            $("#loginModal form").attr("from-title", "open_raf");
            $("#loginModal form").attr("modal-id", "#loginModal");
            document.getElementById('loginModal').style.display = 'flex';
        }
    });

    $("[add_cash='true']").attr("href", "/cashier-initiate");
    $("[add_cash='true']").on('click', function (e) {
        e.preventDefault();
        if ($("body").hasClass("post-login") == true) {
            openCashierWindow();
        } else {
            $("#loginModal form").attr("from-title", "add_cash");
            $("#loginModal form").attr("modal-id", "#loginModal");
            document.getElementById('loginModal').style.display = 'flex';
        }
    });

//    $("[href='/draw']").on('click', function (e) {
//        e.preventDefault();
//        if($("body").hasClass("post-login") == true) {
//            location.href = "/draw";
//        }
//        else{
//            if($("#loginModal").length > 0) {
//                document.getElementById('loginModal').style.display = 'flex';
//            }
//        }
//    });

//    $("[href='/en/instant-win']").on('click', function (e) {
//        e.preventDefault();
//        if($("body").hasClass("post-login") == true) {
//            location.href = "/instant-win";
//        }
//        else{
//            if($("#loginModal").length > 0) {
//                document.getElementById('loginModal').style.display = 'flex';
//            }
//        }
//    });

    $("[play_rummy='true']").attr("href", "/rummy");
    $("[play_rummy='true'], [href='/rummy']").on('click', function (e) {
        e.preventDefault();
        if ($("body").hasClass("post-login") == true) {
            openRummyWindow();
        } else {
            $("#loginModal form").attr("from-title", "play_rummy");
            $("#loginModal form").attr("modal-id", "#loginModal");
            document.getElementById('loginModal').style.display = 'flex';
        }
    });
    $("[title='play_new_rummy']").attr("href", "/play-html-rummy");
    $("[title='play_new_rummy'], [href='/play-html-rummy']").on('click', function (e) {
        e.preventDefault();
        if ($("body").hasClass("post-login") == true) {
            openNewRummyWindow();
        } else {
            $("#loginModal form").attr("from-title", "play_new_rummy");
            $("#loginModal form").attr("modal-id", "#loginModal");
            document.getElementById('loginModal').style.display = 'flex';
        }
    });

    $("[title='Lotto_Tv']").on('click', function (e) {
        e.preventDefault();
        openLottoTvWindow();
    })

    $("[title='play_new_rummy']").attr("href", "/play-html-rummy");
    $("[title='play_new_rummy'], [href='/play-html-rummy']").on('click', function (e) {
        e.preventDefault();
        if ($("body").hasClass("post-login") == true) {
            openNewRummyWindow();
        } else {
            $("#loginModal form").attr("from-title", "play_rummy");
            $("#loginModal form").attr("modal-id", "#loginModal");
            document.getElementById('loginModal').style.display = 'flex';
        }
    });
    
    $("div.deep-menu li.deeper.parent").each(function(index) {
        if($(this).hasClass('active') == false){
            $(this).children('ul').slideToggle();            
        }else{
            $(this).addClass('open');
        }
    });
    
    $("div.deep-menu li.deeper.parent>a").on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        $(this).next().slideToggle();
        $(this).parent().toggleClass('open');
    });
    
    $($(".main_menu li.sp-menu-item.active").parents("li.sp-menu-item.sp-has-child").not(".active")).each(function () {
        $(this).addClass("active");
    });

    $($("a")).each(function () {
        if ($(this).attr("href") == "#")
            $(this).attr("href", "javascript:void(0);");
    });

    $("[sendAppLink='true']").on('click', function () {
        var input_id = $(this).attr('input-id');
        if (validateMobile(input_id, $("#" + input_id).val(), "manual") == false)
            return false;
        removeToolTipErrorManual("", $("#" + input_id));
        startAjax("/component/weaver/?task=account.sendAppLink", "mobileNo=" + $("#" + input_id).val().trim(), sendAppLinkResponse, "null");
    });

    $("[class*='open_modal_']").on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var classList = $(this).attr('class').split(/\s+/);
        var class_href = $(this).attr('href');
        $.each(classList, function (index, className) {
            if (className.search("open_modal_") != -1) {
                if ($("#" + className.replace("open_modal_", "")).length > 0)
                    $("#" + className.replace("open_modal_", "")).modal('show');
                else
                    window.location = class_href;
                return true;
            }
        });
    });

    $(document).on("keyup", ".allow_only_nums", function (e) {
        var value = $(this).val();
        value = value.replace(/[^0-9]/g, '');
        $(this).val(value);
//        var key = e.which ? e.which : e.keyCode;
//        var key1 = String.fromCharCode(key);
//
//        if( key != 8 && key != 0 && !(key1 >= 0 && key1 <= 9 )){
//            return false;
//        }

    });

    $(document).on("keyup", ".dont_allow_nums", function (e) {
        var value = $(this).val();
        value = value.replace(/[^A-Za-z ]/g, '');
        $(this).val(value);
    });

    $(document).on("keyup", ".no_special_chars", function (e) {
        var value = $(this).val();
        value = value.replace(/[^A-Za-z0-9 ]/g, '');
        $(this).val(value);
    });
    
    $(document).on("keyup", ".alphabets_only", function (e) {
        var value = $(this).val();
        value = value.replace(/[^A-Za-z ]/g, '');
        $(this).val(value);
    });

    if (myDeviceType !== "PC")
    {
        //$(".myaccount_topsection .user_details .user_details").css("display", "none");
        $('.myaccount_topsection .user_ac_details .tab_act_btn .play_now').css("display", "none");
        $('[download_app_btn="true"]').css("display", "flex");
    } else if (myDeviceType == "PC" && screen.width == "1024" && screen.height == "768")
    {
        $(".myaccount_topsection .user_details .user_details").css("display", "none");
        $('[download_app_btn="true"]').css("display", "none");
        $('.myaccount_topsection .user_ac_details .tab_act_btn .play_now').css("display", "flex");
    }

    if ($('body').hasClass('post-login') == true) {
        $(function () {
            "use strict";
            // if user is running mozilla then use it's built-in WebSocket
            window.WebSocket = window.WebSocket || window.MozWebSocket;
            // if browser doesn't support WebSocket, just show
            // some notification and exit
            if (!window.WebSocket) {
                return;
            }
            // open connection
            var connection = new WebSocket(webSocketDomain + '?id=' + myId);
            connection.onopen = function () {
                console.log("Connection Open");
            };
            connection.onerror = function (error) {
                console.log("Connection Error");
            };
            connection.onclose = function () {
                console.log("Connection Closed");
            }
            // most important part - incoming messages
            connection.onmessage = function (message) {
                try {
                    console.log(message);
                    var json = JSON.parse(message.data);
                    if (json.type == 'updatebalance') {
                        updatePlayerBalance(false);
                    } else if (json.type == 'draw-machine-start') {
                        $("#drawmachiner_popup").modal('hide');
                        var msg = "The " + json.gameCode + " draw is going to happen.";
                        $("#drawmachiner_popup #drawmachine-msg").html(msg);
                        $("#drawmachiner_popup #drawmachine-url").attr('onclick', "location.href='" + json.url + "'");
                        $("#drawmachiner_popup").modal('show');
                    }
                } catch (e) {
                    console.log('Invalid JSON: ', message.data);
                    return;
                }
                console.log(json);
            };
        });
    }
    
    var url_string = window.location.href;
    var url = new URL(url_string);
    if (url_string.indexOf("rtkcid") > -1) {
        rtkcid = url.searchParams.get("rtkcid");
    }
    if (url_string.indexOf("cmpid") > -1) {
        cmpid = url.searchParams.get("cmpid");
    }
    if (rtkcid != undefined && cmpid != undefined) {
        var old_href = $('#register_page a').attr('href');
        $('#register_page a').attr("href", old_href+"?rtkcid=" + rtkcid + "&cmpid=" + cmpid + "");
    }
    
    $("#set_newpassword, #set_confirmpassword").on('keyup', function() {
             $(".setPassword_error").css('display', 'none');
         });
    
    $('#submitSetPassword').on("click",function(){
    	var userName = $("#set_username").val();
    	var newPass = $("#set_newpassword").val();
    	var confirmPass = $("#set_confirmpassword").val();
    	if(newPass !== confirmPass){
    	 $('.setPassword_error').text("New Password and Confirm Password must be same.");
    	 $(".setPassword_error").css('color', 'red');
    	 $(".setPassword_error").css('display', 'flex');
    	}else{
    	var params = "userName=" + userName + "&newPassword=" + newPass ;
    		startAjax("/component/weaver/?task=ram.ramChangePass", params , getramChangePass, null);
    	}
    });
});

function getramChangePass(result){
if (validateSession(result) == false)
         return false;
     var res = $.parseJSON(result);
     console.log(res);
     if (res.errorCode != 0) {
         $('.setPassword_error').text(res.errorMessage);
    	 $(".setPassword_error").css('color', 'red');
    	 $(".setPassword_error").css('display', 'flex');
         return false;
     }else{
        $('#scan_setPassword_popup').modal("hide");
     	errorDisplay(res.respMsg, 'success');
     	setTimeout(function(){ logout(); }, 1000);
     }
}

function openReferAFriendPage(){
    window.location.href = "/refer-a-friend";
}

function openCashierWindow(){
    try {
        var left = (screen.width / 2) - (840 / 2);
        var top = (screen.height / 2) - (640 / 2);
        window.open(base_href + "/cashier-initiate", "cashierWindow", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=1, resizable=no, copyhistory=no, width=840, height=665, top=0, left=' + left);
    } catch (e) {
        $("#loadingImage").css("display", "none");
    }
}

function openRummyWindow(){
    try {
        var left = (screen.width / 2) - (1000 / 2);
        var top = (screen.height / 2) - (650 / 2);
        window.open(base_href + "/rummy", "rummyWindow", "height=650,width=1000,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=no, left=" + left);
    } catch (e) {
        $("#loadingImage").css("display", "none");
    }
}

function updatePlayerBalance(refill, str){
    if (!str == "nottoshow")
        str = "null";
    if (refill == 'both') {
        update_both_balances = true;
    }
    if (refill == true) {
        startAjax("/account/getPlayerBalance", 'refill=true', getBalance, 'nottoshow');
    } else {
        startAjax("/account/getPlayerBalance", '', getBalance, 'nottoshow');
    }
}

function refillPracticeBalance(str){
    updatePlayerBalance(true, str);
}

function noFunction(result){
    return false;
}

function getBalance(result){
    if (validateSession(result) == false)
        return false;
    var res = JSON.parse(result);
    if (res.errorCode == 0) {
        if (update_both_balances == true) {
            update_both_balances = false;
            updateBalance(getFormattedAmount(parseFloat(res.wallet.totalBalance, 2)),res.wallet.currency,res.wallet.currencyDisplayCode?res.wallet.currencyDisplayCode:res.wallet.currency);
            updatePracticeBalance(parseInt(res.wallet.practiceBalance));
            updateWithdrawBalance(res.wallet.withdrawableBal);
        } else if (res.refill == false || res.refill == 'false') {
            updateBalance(getFormattedAmount(parseFloat(res.wallet.totalBalance, 2)),res.wallet.currency,res.wallet.currencyDisplayCode?res.wallet.currencyDisplayCode:res.wallet.currency);
            updateWithdrawBalance(getFormattedAmount(parseFloat(res.wallet.withdrawableBal, 2),res.wallet.currency,res.wallet.currencyDisplayCode));
        } else {
            updatePracticeBalance(parseInt(res.wallet.practiceBalance));
        }
       if( typeof max_limit !== "undefined" && typeof max_amount !== "undefined" &&  typeof min_limit !== "undefined" && parseFloat(res.wallet.withdrawableBal, 2) > min_limit ){
             max_limit = getFormattedAmount(parseFloat(res.wallet.withdrawableBal, 2));
             max_amount = parseFloat(res.wallet.withdrawableBal, 2);
       }
    }
}

function logout(){
    window.location.href = base_href + "/log-out";
}

function updateMessageCount(count){
    $("span.mail_count").html(count);
    if (count == 0)
        $("#mail_count_view").html("");
    else
        $("#mail_count_view").html("(" + count + ")");
}

function validateMobile(id, mobile, errType){
    if (mobile.length == 0) {
        if (errType == "manual")
            showToolTipErrorManual(id, "Enter Mobile no.", "bottom", $("#" + id), undefined);
        else
            showToolTipError(id, "Enter Mobile no.", "bottom", undefined);
        return false;
    }
    if (mobile.length != 10) {
        if (errType == "manual")
            showToolTipErrorManual(id, "Mobile no. should be of 10 digits", "bottom", $("#" + id), undefined);
        else
            showToolTipError(id, "Mobile no. should be of 10 digits", "bottom", undefined);
        return false;
    }
    var myRegEx = /^[7-9]{1}[0-9]{9}$/;
    if (!myRegEx.test(mobile)) {
        if (errType == "manual")
            showToolTipErrorManual(id, "Invalid mobile no.", "bottom", $("#" + id), undefined);
        else
            showToolTipError(id, "Invalid mobile no.", "bottom", undefined);
        return false;
    }
    return true;
}

function sendAppLinkResponse(result){
    if (validateSession(result) == false)
        return false;
    var res = $.parseJSON(result);
    $.each($('.success-msg'), function (index, value) {
        if ($(value).parent(":visible").length > 0)
        {
            if (res.respMsg == "msgAlreadySent") {
                $(value).find('span').html("You have already requested the download link, please check SMS on your mobile. If not received try again after 48 hours.");
            }
            $(".download_app_mobile").css("display", "none");
            $(value).css("display", "flex");
            return false;
        }
    });
    /*   if(res.respMsg == "msgAlreadySent") {
     $("#successDiv #msgDiv").html("You have already requested the download link, please check SMS on your mobile. If not received try again after 48 hours.");
     }
     $(".download_app_mobile").css("display", "none");
     $("#successDiv").css("display", "flex"); */
}

function openLiveChat(){
    $zopim.livechat.window.openPopout();
}

String.prototype.capitalizeFirstLetter = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
};

Date.prototype.monthNames = [
    "January", "February", "March",
    "April", "May", "June",
    "July", "August", "September",
    "October", "November", "December"
];

Date.prototype.getMonthName = function () {
    return this.monthNames[this.getMonth()];
};

$(document).ready(function () {
    var cookie_string = document.cookie.split(";");
    var cookie_launchCashierAfterLogin = false;
    var cookie_launchRummyAfterLogin = false;
    var cookie_launchPokerAfterLogin = false;
    var cookie_launchReferAFriendAfterLogin = false;
    var cookie_launchHtmlRummyAfterLogin = false;
    for (var i = 0; i < cookie_string.length; i++) {
        var cookie_string_params = cookie_string[i].split('=');
        try {
            if (cookie_string_params[0].trim() == "launchCashierAfterLogin") {
                cookie_launchCashierAfterLogin = cookie_string_params[1];
            }
            if (cookie_string_params[0].trim() == "launchRummyAfterLogin") {
                cookie_launchRummyAfterLogin = cookie_string_params[1];
            }
            if (cookie_string_params[0].trim() == "launchPokerAfterLogin") {
                cookie_launchPokerAfterLogin = cookie_string_params[1];
            }
            if (cookie_string_params[0].trim() == "launchReferAFriendAfterLogin") {
                cookie_launchReferAFriendAfterLogin = cookie_string_params[1];
            }
            if (cookie_string_params[0].trim() == "launchHtmlRummyAfterLogin") {
                cookie_launchHtmlRummyAfterLogin = cookie_string_params[1];
            }
        } catch (e) {
        }
    }
    if (cookie_launchCashierAfterLogin == true || cookie_launchCashierAfterLogin == 'true') {
        document.cookie = "launchCashierAfterLogin=";
        openCashierWindow();
    }
    if (cookie_launchRummyAfterLogin == true || cookie_launchRummyAfterLogin == 'true') {
        document.cookie = "launchRummyAfterLogin=";
        openRummyWindow();
    }
    if (cookie_launchPokerAfterLogin == true || cookie_launchPokerAfterLogin == 'true') {
        document.cookie = "launchPokerAfterLogin=";
        openPokerWindow();
    }
    if (cookie_launchReferAFriendAfterLogin == true || cookie_launchReferAFriendAfterLogin == 'true') {
        document.cookie = "launchReferAFriendAfterLogin=";
        openReferAFriendPage();
    }
    if (cookie_launchHtmlRummyAfterLogin == true || cookie_launchHtmlRummyAfterLogin == 'true') {
        document.cookie = "launchHtmlRummyAfterLogin=";
        openNewRummyWindow();
    }
});

function openNewRummyWindow(){
    try {
        var left = (screen.width / 2) - (1000 / 2);
        var top = (screen.height / 2) - (650 / 2);
        window.open(base_href + "/play-html-rummy", "HTMLrummyWindow", "height=650,width=1000,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=no, left=" + left);
    } catch (e) {
        $("#loadingImage").css("display", "none");
    }
}

$(window).on('load', function () {
    if (window.opener != null)
        $(".zopim").hide();
});


function openLottoTvWindow()
{
    try {
        var left = (screen.width / 2) - (1000 / 2);
        var top = (screen.height / 2) - (650 / 2);
        window.open("http://35.156.30.113:8081/DrawGameWeb/DrawGameMachine.swf", "LottoTvWindow", "height=563,width=1000,location=no,menubar=no,resizable=yes,scrollbars=yes,status=no,toolbar=no, left=" + left);
    } catch (e) {
        $("#loadingImage").css("display", "none");
    }
}

function sprintf(lang_str, args) {
    var count = (lang_str.match(/%s/g)).length;
    for (i = 0; i < count; i++) {
        lang_str = lang_str.replace('%s', args[i]);
    }
    return lang_str;
}

function openLoginModal() {
    document.getElementById('loginModal').style.display = 'flex';
}

function getFormattedAmount(amount) {
    amount = amount + "";
    amount = amount.replace(",", "");
    var tmp = amount.split(".");
    if (tmp.length == 2) {
        if (tmp[1].length > 2) {
            if (tmp[1].substr(0, 2) != "00")
                return number_format(amount, 2);
        } else if (tmp[1].length == 2) {
            if (tmp[1] != "00")
                return number_format(amount, 2);
        } else if (tmp[1].length == 1) {
            if (tmp[1] != "0")
                return number_format(amount, 2);
        } else {
            return number_format(amount, 2);
        }
    }
    return number_format(amount, 2);
}

function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
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


function errorDisplay($msg, $type, $redirct) {
    $('#error_popup').find('.msg').html('<p>' + $msg + '</p>');
    if ($type == 'error') {
        $('#error_popup').find('.oopsDiv .imgWrap').show();
    } else if ($type == 'info') {
        $('#error_popup').find('.oopsDiv .imgWrap').hide();
    } else if ($type == 'success') {
        $('#error_popup').find('.oopsDiv .imgWrap').hide();
    }
    if ($redirct) {
        $(this).on('hidden.bs.modal', function (event) {
            window.location = "/";
        });
    }
    $('#error_popup').modal('show');
    return true;
}

function openDGEUrl() {
    location.href = domain + "/draw";
}
function openSBSUrl() {
    location.href = domain + "/sports-betting";
}
function getCurrentTime() {
    var params = "";
    startAjax(GET_SERVER_TIME, params, formateServerTime, 'nottoshow');
}

function getServerTime(date, className) {
    var params = "date=" + date + "&className=" + className;
    startAjax(GET_SERVER_TIME, params, parseServerTimeResponse, 'null');
}

function parseServerTimeResponse(result) {
    var res = JSON.parse(result);
    $(res.className + " .gameTimer .daytime").html(res.days);
    $(res.className + " .gameTimer .hrtime").html(res.hrs);
    $(res.className + " .gameTimer .mintime").html(res.min);
    $(res.className + " .gameTimer .sectime").html(res.sec);

}

function getGameTime(gamename) {
    var game = {
        "LOTTO": "20:30:00",
        "LOTTOPLUS": "20:30:00",
        "LOTTOPLUS2": "20:30:00",
        "POWERBALL": "20:30:00",
        "POWERBALLPLUS": "20:30:00",
        "PICK3": "20:00:00",
        "RAPIDO": "23:45:00",
        "DAILYLOTTO": "21:00:00",
        "SPORTSTAKE": "19:30:00",
        "SS08": "18:30:00"
    }
    return game[gamename];
}

function parseDate(input, format) {
    format = format || 'yyyy-mm-dd H:i:s'; // default format
    var parts = input.match(/(\d+)/g),
        i = 0, fmt = {};
    // extract date-part indexes from the format
    format.replace(/(yyyy|dd|mm|H|i|s)/g, function (part) {
        fmt[part] = i++;
    });
    return new Date(parts[fmt['yyyy']], parts[fmt['mm']] - 1, parts[fmt['dd']], parts[fmt['H']], parts[fmt['i']], parts[fmt['s']]);
}

function formateServerTime(result) {
    var res = JSON.parse(result);
    if (typeof timerArray != undefined) {
        timerArray.forEach(function (item) {
            var extra_data = {};
            var date_now = res.dateTime.date;
            if (item.game == "RAFFLE") {
                var date_new = item.date;
            } else{
                // var date_new = item.date + ' ' + getGameTime(item.game);
                var date_new = item.date;
            }

            //INIT DRAW_DATE TO INIT extra_data
            if (item.draw_date && item.draw_date != "") {
                var draw_date = parseDate(item.draw_date);
            }
            var date_now_obj = parseDate(date_now);
            var date_new_obj = parseDate(date_new);
            if (draw_date) {
                if (date_now_obj < draw_date) {
                    var date_new_obj = parseDate(item.draw_date);
                    extra_data['title'] = "Opening Date";
                } else if (date_now_obj < date_new_obj) {
                    var date_new_obj = parseDate(date_new);
                    extra_data['title'] = "Closing:";
                } else {
                    extra_data['title'] = "Draw Closed";
                    if (item.game == "RAFFLE") {
                        extra_data['date'] = item.date;
                    } else
                        extra_data['date'] = item.date + " " + getGameTime(item.game);
                }
            }
            var date_now_time = date_now_obj.getTime();
            var date_new_time = date_new_obj.getTime();
            var diff = date_new_time - date_now_time;
            if (date_now_time < date_new_time){
                difference_ms = diff / 1000;
                var seconds = Math.floor(difference_ms % 60);
                difference_ms = difference_ms / 60;
                var minutes = Math.floor(difference_ms % 60);
                difference_ms = difference_ms / 60;
                var hours = Math.floor(difference_ms % 24);
                var days = Math.floor(difference_ms / 24);
                days = days > 9 ? "" + days : "0" + days;
                hours = hours > 9 ? "" + hours : "0" + hours;
                minutes = minutes > 9 ? "" + minutes : "0" + minutes;
                seconds = seconds > 9 ? "" + seconds : "0" + seconds;
                $(item.class + " .gameTimer .daytime").html(days);
                $(item.class + " .gameTimer .hrtime").html(hours);
                $(item.class + " .gameTimer .mintime").html(minutes);
                $(item.class + " .gameTimer .sectime").html(seconds);
            } else {
                $(item.class + " .contentWrap").addClass('noTimer');
                $(item.class + " .gameTimer").hide();
            }
            //formateFooterTime(item.game, days, hours, minutes, seconds, extra_data)
        });
    }
}

function getCameCase(str) {
    var words = str.split(" ");
    var CamelString = "";
    words.forEach(function (value, key) {
        CamelString += value.charAt(0).toUpperCase() + value.substr(1) + " ";
    })
    return CamelString;
}

function openMyPages(title){
    window.location.href = myPagesList[title];
}

/**To Update Slider Timer of all pages (ITHUBA SPECIFIC custom_slider) */
function update_timer() {
    $(".gameTimer").map(function (key, val) {
        var days = $(val).find(".daytime")[0];
        var hrs = $(val).find(".hrtime")[0];
        var min = $(val).find(".mintime")[0];
        var sec = $(val).find(".sectime")[0];
        if ($(days).html() == 0) {
            $($(val).find(".daytime")[0]).addClass('hide');
            $($(val).find(".sectime")[0]).removeClass('hide');
        } else{
            $($(val).find(".daytime")[0]).removeClass('hide');
            $($(val).find(".sectime")[0]).addClass('hide');
        }
        if ($(sec).html() == 0) {
            if ($(min).html() == 0) {
                if ($(hrs).html() == 0) {
                    if ($(days).html() == 0) {
                        return false;
                    } else {
                        hrs.innerHTML = 23;
                        var tempDays = $(days).html() - 1
                        days.innerHTML = tempDays <= 9 ? "0" + tempDays : tempDays;
                    }
                } else {
                    min.innerHTML = 59;
                    var tempHrs = $(hrs).html() - 1
                    hrs.innerHTML = tempHrs <= 9 ? "0" + tempHrs : tempHrs;
                }
            } else {
                sec.innerHTML = 59;
                var tempmin = $(min).html() - 1;
                min.innerHTML = tempmin <= 9 ? "0" + tempmin : tempmin;
            }
        } else {
            var tempsec = $(sec).html() - 1;
            sec.innerHTML = tempsec <= 9 ? "0" + tempsec : tempsec;
        }
        $(val).removeClass('loader');
    });
}

function formatCurrency(amount,currency,dispCurrency = currency) {
    if ((amount != undefined) || (currency != undefined)) {
        if(hide_decimal == true){
        var check_value = amount.toString().split('.');
        if(check_value[1] == 0)
         amount = check_value[0];
        }

        switch (currency) {
            case 'CFA':
                if ((amount != undefined) && (currency != undefined)) {
                    amount = amount.toString().replace(/,/g, " ");
                    amount = amount.replace('.', ",");
                    return amount + ' ' + dispCurrency;
                } else if (amount == undefined) {
                    return dispCurrency;
                } else if (currency == undefined) {
                    amount = amount.toString().replace(/,/g, " ");
                    amount = amount.replace('.', ",");
                    return amount;
                }
                break;

            default:
                if ((amount != undefined) && (currency != undefined)) {
                    return dispCurrency + ' ' + amount;
                } else if (amount == undefined) {
                    return dispCurrency;
                } else if (currency == undefined) {
                    return amount;
                }
                break;
        }

    } else {
        return '';
}
}
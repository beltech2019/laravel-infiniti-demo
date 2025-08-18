<?php
namespace App\Helpers;

class Errors {

    const TYPE_ERROR = "Danger";
    const TYPE_SUCCESS = "Success";
    const TYPE_WARNING = "Warning";
    const INVALID_REQUEST = "Invalid Request.";
    const NO_GAMES_AVAILABLE = "No Games Available!!!";
    const SYTEM_ERROR = "Something went terribly wrong. Sorry for the inconvenience. Please try again.";
    const INVALID_ERROR_CODE = "System Error. Please try again. [Error Code]";
    const INVALID_PLAYERTOKEN = "System Error. Please try again. [Player Token]";
    const INVALID_PLAYERID = "System Error. Please try again. [Player ID]";
    const INVALID_LOGIN_RESPONSE = "System Error. Please try again. [Error in login response.]";
    const PLEASE_LOGIN_FIRST = "Please log-in first";
    const PLEASE_LOGIN_TO_CONTINUE = "Please log to continue.";
    const SESSION_EXPIRED = "Your session has expired. Please login again.";
    const ALREADY_LOGGEDIN = "You are already logged-in.";
    const NO_MESSAGES_IN_INBOX = "No messages available";
    // Server Error Codes
    const PLAYER_NOT_LOGGED_IN = 203;
    const VERIFICATION_PENDING = 412;
    const TRANSACTION_FAILED_KPCARD = 309;
    const LINK_EXPIRED = 10010;
    const LOYALTY_PLAYER_NOT_EXISTS = 7102;
    const LOYALTY_WITHDRAWAL_LIMIT_EXHAUSTED = 7114;
    const LOYALTY_WITHDRAWAL_LIMIT_EXCEEDS = 7115;
    const INSUFFICIENT_WITHDRAWABLE_BAL = "Entered Amount is greater than your withdrawable balance.";
    const REFER_A_FRIEND_NO_CONTACTS = "You don't have any contacts in your account.";
    const REFER_A_FRIEND_INVALID_REQUEST_TOKEN = "Invalid request token provided.";
    const REFER_A_FRIEND_REMINDER_SENT = "Reminder sent successfully.";
    const LOYALTY_PLAYER_NOT_EXISTS_MSG = "Your loyalty details are being calculated. Please try after some time.";
    const DEPOSIT_AMOUNT_EXCEEDED = 1;
    const DEPOSIT_COUNT_EXCEEDED = 2;
    const DEPOSIT_COUNT_THIRD = 3;
    /*** Lottery error messages */
    const SERVICE_DETAILS_NOT_FOUND = "Service details not found.";
    const NO_DRAW_AVAILABLE = "No Draw Available For Purchase, Please Try After Some Time.";
    const LOGIN_TO_PURCHASE_TICKET = "Please Login To Purchase Game Ticket.";
    const LOGIN_TO_PLAY_FOR_CASH = "Please Login To Play For Cash.";
    const GAME_DATA_UPDATED = "Game Data Updated Successfully.";
    const NO_GAME_AVAILABLE_TO_PLAY = "No Game Available To Play, Please Try After Some Time.";
    const NO_UNFINISHED_GAME = "No Unfinished Game Available To Play.";
    const NO_GAME_AVAILABLE_TO_PURCHASE = "No Game Available For Purchase, Please Try After Some Time.";
    const NO_GAME_AVAILABLE_TO_DISPLAY = "No Match Available For Display, Please Try After Some Time.";
    const UPDATE_PROFILE_TO_PLAY = "Please update profile to Play Game";
    const NO_GAME_AVAILABLE = "No Game Available For Purchase, Please Try After Some Time.";
    const NO_TOURNMENT_AVAILABLE = "No Tournment Available, Please Try After Some Time.";
    const INVALID_ERROR_MSG = "INVALID_ERROR_MSG";
    
}

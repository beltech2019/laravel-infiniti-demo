<?php
namespace App\Helpers;
if (!defined('JPATH_BASE')) {
    define('JPATH_BASE', realpath(__DIR__ . '/../../public'));
}

class Constants {

    const JS_VER = '11.13';
    const CSS_VER = '11.13';
    const HTML5_VER = '1.8';

    const WITHDRAWAL_START_DATE = "13/02/2020";

    const APP_DOWNLOAD_LINK = "https://khelplay-weaver.s3.amazonaws.com/apk/10.5.6/Rummy_Cash.apk";
    const RUMMY_APH_ABS_PATH = '/var/www/html/khelplayrummy/KhelPlayRummy-cash.apk';
    const PROJECT_NAME = "INFINITI_LOTTO";
    const RUMMY_APH_ABS_PATH_APPSFX2X = '/var/www/html/khelplayrummy/Rummy_Cash.apk';
    const RUMMY_SPECIAL_PLAYER_TESTING_ARRAY = array(207195, 413420, 369244, 413381, 381611, 199745, 201976, 400908, 192950, 228746, 201874, 280863, 235120, 337586, 371035, 391724, 303857, 267159, 155876, 202556, 44138);
    const MIXPANEL_ID = 'b911be7347d9d95090243f3fe1005ced';
    const COUNTRY_CODE = array( "95" => "MM", "66" => "TH");
    const CURRENCY_ID = 8;
    const AJAX_FLAG_RELOAD = "RELOAD";
    const AJAX_FLAG_SESSION_EXPIRE = "EXPIRE";
    const HIDE_ZERO_DECIMAL = false;
    const AJAX_FLAG_ALREADY_LOGGED_IN = "ALREADY";
    // Constants related to Avatar
    const AVATAR_PATH = "/images/bet2winasia/avatar/";
    const AVATAR_PATH_ABS_COMMON = JPATH_BASE . self::AVATAR_PATH . "common/";
    const AVATAR_PATH_REL_COMMON = Redirection::BASE . self::AVATAR_PATH . "common/";
    const AVATAR_PATH_ABS_PLAYER = JPATH_BASE . self::AVATAR_PATH . "player/";
    const AVATAR_PATH_REL_PLAYER = Redirection::BASE . self::AVATAR_PATH . "player/";
    const AVATAR_DEFAULT_IMG_NAME = "edit-thumbnail.jpg";
    const AVATAR_PATH_ABS_DEFAULT = JPATH_BASE . self::AVATAR_PATH . "default/";
    const AVATAR_PATH_REL_DEFAULT = Redirection::BASE . self::AVATAR_PATH . "default/";
    const PLAYER_DOCUMENT_PATH = JPATH_BASE . "/images/kpr/player-documents/";
    const MAX_ROW_LIMIT = 100;
    const TXNTYPE_ALL = "ALL";
    const TXNTYPE_PLR_DEPOSIT = "PLR_DEPOSIT";
    const TXNTYPE_PLR_WITHDRAWAL = "PLR_WITHDRAWAL";
    const TXNTYPE_PLR_WAGER = "PLR_WAGER";
    const TXNTYPE_PLR_WAGER_REFUND = "PLR_WAGER_REFUND";
    const TXNTYPE_PLR_WINNING = "PLR_WINNING";
    const TXNTYPE_PLR_DEPOSIT_AGAINST_CANCEL = "PLR_DEPOSIT_AGAINST_CANCEL";
    const TXNTYPE_PLR_BONUS_TRANSFER = "PLR_BONUS_TRANSFER";
    const TXNTYPE_BO_CORRECTION = "BO_CORRECTION";
    const TXNTYPE_BONUS_DETAILS = "BONUS_DETAILS";
    const TXNTYPE_TICKET_DETAILS = "ticket";

    const MY_LANGUAGE_MAP = array( "en-GB" => "en" , "th-TH" => "th" ,"mm-MM" => 'mm');

    public static $txnTypes_TransactionDetails = array('EN' => array(
        self::TXNTYPE_ALL => "Ledger",
        self::TXNTYPE_PLR_DEPOSIT => "Deposit",
        self::TXNTYPE_PLR_WITHDRAWAL => "Withdrawal",
        self::TXNTYPE_PLR_WAGER => "Wager",
        self::TXNTYPE_PLR_WAGER_REFUND => "Wager Refund",
        self::TXNTYPE_PLR_WINNING => "Winning",
        self::TXNTYPE_PLR_DEPOSIT_AGAINST_CANCEL => "Withdrawal Cancel",
        self::TXNTYPE_PLR_BONUS_TRANSFER => "Bonus Details",
//        self::TXNTYPE_PLR_BONUS_TRANSFER => "Bonus to Cash",
//        self::TXNTYPE_BO_CORRECTION => "Payment Correction",
 //       self::TXNTYPE_BONUS_DETAILS => "Bonus Details",
//        self::TXNTYPE_TICKET_DETAILS => "Ticket Details"
    ), "TH" => array(
        self::TXNTYPE_ALL => "บัญชีแยกประเภท",
        self::TXNTYPE_PLR_DEPOSIT => "เงินฝาก",
        self::TXNTYPE_PLR_WITHDRAWAL => "การถอนตัว",
        self::TXNTYPE_PLR_WAGER => "เดิมพัน",
        self::TXNTYPE_PLR_WAGER_REFUND => "เดิมพันคืนเงิน",
        self::TXNTYPE_PLR_WINNING => "การชนะ",
        self::TXNTYPE_PLR_DEPOSIT_AGAINST_CANCEL => "ถอนการยกเลิก",
    ),"ES" => array(
        self::TXNTYPE_ALL => "Libro mayor",
        self::TXNTYPE_PLR_DEPOSIT => "Depositar",
        self::TXNTYPE_PLR_WITHDRAWAL => "Retirada",
        self::TXNTYPE_PLR_WAGER => "Apostar",
        self::TXNTYPE_PLR_WAGER_REFUND => "Reembolso de apuesta",
        self::TXNTYPE_PLR_WINNING => "Victoriosa",
        self::TXNTYPE_PLR_DEPOSIT_AGAINST_CANCEL => "Retiro Cancelar"
    ));
    public static $txnTypes_PaymentOptions = array(
        "DEPOSIT" => "Deposit",
        "WITHDRAWAL" => "Withdrawal"
    );
    public static $withdrawlDoc_singleID = array(
        "PASSPORT" => 'Passport (Photo, Address Proof, Front and Back Colour Scan)',
        "AADHAR_CARD" => 'Aadhar (Photo, Address Proof, Front and Back Colour Scan)',
        "VOTER_ID" => 'Voters Identity (Photo, Address Proof, Front and Back Colour Scan)',
        "DRIVING_LICENSE" => 'Permanent Driving License (Photo, Address Proof, Front and Back Colour Scan)',
    );
    public static $withdrawalDoc_multipleID = array(
        "PAN_CARD" => "Pan Card (Colour Scan)",
    );
    public static $withdrawalDoc_multipleAddress = array(
        "E_BILL" => "Electricity Bill (With your name and colour scan)",
        "T_BILL" => 'Telephone Bill (With your name and colour scan)',
    );
    
    const STATE_LIST = array(
        "MM" => array('MM-01' => 'Sagaing', 'MM-02' => 'Bago', 'MM-03' => 'Magway', 'MM-04' => 'Mandalay', 'MM-05' => 'Tanintharyi', 'MM-06' => 'Yangon', 'MM-07' => 'Ayeyarwady', 'MM-11' => 'Kachin', 'MM-12' => 'Kayah', 'MM-13' => 'Kayin', 'MM-14' => 'Chin', 'MM-15' => 'Mon', 'MM-16' => 'Rakhine', 'MM-17' => 'Shan'),
        "TH" => array('TH-10'=> 'Krung Thep Maha Nakhon [Bangkok]','TH-11'=> 'Samut Prakan','TH-12'=> 'Nonthaburi','TH-13'=> 'Pathum Thani','TH-14'=> 'Phra Nakhon Si Ayutthaya','TH-15'=> 'Ang Thong','TH-16'=> 'Lop Buri','TH-17'=> 'Sing Buri','TH-18'=> 'Chai Nat','TH-19'=> 'Saraburi','TH-20'=> 'Chon Buri','TH-21'=> 'Rayong','TH-22'=> 'Chanthaburi','TH-23'=> 'Trat','TH-24'=> 'Chachoengsao','TH-25'=> 'Prachin Buri','TH-26'=> 'Nakhon Nayok','TH-27'=> 'Sa Kaeo','TH-30'=> 'Nakhon Ratchasima','TH-31'=> 'Buri Ram','TH-32'=> 'Surin','TH-33'=> 'Si Sa Ket','TH-34'=> 'Ubon Ratchathani','TH-35'=> 'Yasothon','TH-36'=> 'Chaiyaphum','TH-37'=> 'Amnat Charoen','TH-39'=> 'Nong Bua Lam Phu','TH-40'=> 'Khon Kaen','TH-41'=> 'Udon Thani','TH-42'=> 'Loei','TH-43'=> 'Nong Khai','TH-44'=> 'Maha Sarakham','TH-45'=> 'Roi Et','TH-46'=> 'Kalasin','TH-47'=> 'Sakon Nakhon','TH-48'=> 'Nakhon Phanom','TH-49'=> 'Mukdahan','TH-50'=> 'Chiang Mai','TH-51'=> 'Lamphun','TH-52'=> 'Lampang','TH-53'=> 'Uttaradit','TH-54'=> 'Phrae','TH-55'=> 'Nan','TH-56'=> 'Phayao','TH-57'=> 'Chiang Rai','TH-58'=> 'Mae Hong Son','TH-60'=> 'Nakhon Sawan','TH-61'=> 'Uthai Thani','TH-62'=> 'Kamphaeng Phet','TH-63'=> 'Tak','TH-64'=> 'Sukhothai','TH-65'=> 'Phitsanulok','TH-66'=> 'Phichit','TH-67'=> 'Phetchabun','TH-70'=> 'Ratchaburi','TH-71'=> 'Kanchanaburi','TH-72'=> 'Suphan Buri','TH-73'=> 'Nakhon Pathom','TH-74'=> 'Samut Sakhon','TH-75'=> 'Samut Songkhram','TH-76'=> 'Phetchaburi','TH-77'=> 'Prachuap Khiri Khan','TH-80'=> 'Nakhon Si Thammarat','TH-81'=> 'Krabi','TH-82'=> 'Phangnga','TH-83'=> 'Phuket','TH-84'=> 'Surat Thani','TH-85'=> 'Ranong','TH-86'=> 'Chumphon','TH-90'=> 'Songkhla','TH-91'=> 'Satun','TH-92'=> 'Trang','TH-93 '=> 'Phatthalung','TH-94'=> 'Pattani','TH-95'=> 'Yala','TH-96'=> 'Narathiwat','TH-S'=> 'Phatthaya')
        );
    const CURRENT_REGISTRATION_TYPE = "MINI";
    // Constants related to deposit
    const CREDIT_CARD_DEPOSIT = "CREDIT_CARD";
    const DEBIT_CARD_DEPOSIT = "DEBIT_CARD";
    const NET_BANKING_DEPOSIT = "NET_BANKING";
    const CHEQUE_TRANS_DEPOSIT = "CHEQUE_TRANS";
    const WIRE_TRANS_DEPOSIT = "WIRE_TRANS";
    const CASH_CARD_DEPOSIT = "CASH_CARD";
    const PREPAID_WALLET_DEPOSIT = "PREPAID_WALLET";
    const CASH_PAYMENT_DEPOSIT = "CASH_PAYMENT";
    const CASH_COLLECTION_DEPOSIT = "CASH_COLLECTION";
    const BANK_TRANS_DEPOSIT = "BANK_TRANS";
    const PAYTM_WALLET_DEPOSIT = "PAYTM_WALLET";
    const FREECHARGE_WALLET = "FREECHARGE_WALLET";
    const MOBILE_WALLET_DEPOSIT = "MOBILE_WALLET";
    const UPI_DEPOSIT = "UPI_PAYMENT";
    const MOBIKWIK_DEPOSIT = "MOBIKWIK_DEPOSIT";
    public static $paytypeCode_images = array(
        self::CREDIT_CARD_DEPOSIT => "icon1",
        self::DEBIT_CARD_DEPOSIT => "icon2",
        self::NET_BANKING_DEPOSIT => "icon3",
        self::CASH_PAYMENT_DEPOSIT => "icon7",
        self::CASH_COLLECTION_DEPOSIT => "",
        self::CHEQUE_TRANS_DEPOSIT => "icon4",
        self::BANK_TRANS_DEPOSIT => "",
        self::WIRE_TRANS_DEPOSIT => "icon5",
        self::CASH_CARD_DEPOSIT => "icon6",
        self::PREPAID_WALLET_DEPOSIT => "icon7",
        self::PAYTM_WALLET_DEPOSIT => "icon8",
    );
    public static $paytypeCode_class = array(
        self::CREDIT_CARD_DEPOSIT => self::CREDIT_CARD_DEPOSIT,
        self::DEBIT_CARD_DEPOSIT => self::DEBIT_CARD_DEPOSIT,
        self::NET_BANKING_DEPOSIT => self::NET_BANKING_DEPOSIT,
        self::CASH_PAYMENT_DEPOSIT => self::CASH_PAYMENT_DEPOSIT,
        self::CASH_COLLECTION_DEPOSIT => self::CASH_COLLECTION_DEPOSIT,
        self::CHEQUE_TRANS_DEPOSIT => "cheque_transfer",
        self::BANK_TRANS_DEPOSIT => self::BANK_TRANS_DEPOSIT,
        self::WIRE_TRANS_DEPOSIT => "wire_transfer",
        self::CASH_CARD_DEPOSIT => "cash_card",
        self::PREPAID_WALLET_DEPOSIT => "wallets",
        self::PAYTM_WALLET_DEPOSIT => self::PAYTM_WALLET_DEPOSIT,
        self::MOBILE_WALLET_DEPOSIT => "wallets"
    );
    const ONLINE_DEPOSIT_MODES = array(
        self::CREDIT_CARD_DEPOSIT, self::DEBIT_CARD_DEPOSIT, self::NET_BANKING_DEPOSIT, self::PREPAID_WALLET_DEPOSIT,
        self::PAYTM_WALLET_DEPOSIT, self::MOBILE_WALLET_DEPOSIT
    );
    const OFFLINE_DEPOSIT_MODES = array(
        self::CHEQUE_TRANS_DEPOSIT, self::WIRE_TRANS_DEPOSIT, self::CASH_CARD_DEPOSIT, self::CASH_PAYMENT_DEPOSIT
    );
    const CREDIT_CARD_ID_IMAGES = array(
        "VISA_CARD" => array(
            "id" => "Credit_visa_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/visa_cardicon.png"
        ),
        "MASTER_CARD" => array(
            "id" => "Credit_mastercard_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/mastercard_cardicon.png"
        ),
        "MAESTRO_CARD" => array(
            "id" => "Credit_maestro_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/maestro_cardicon.png"
        ),
        "AMEX" => array(
            "id" => "Credit_americanexpress_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/americanexpress_cardicon.png"
        ),
        "RUPAY" => array(
            "id" => "Credit_rupay_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/rupay_cardicon.png"
        )
    );
    public static $countrycode_based_Country = array(
        297 => 'Aruba', 61 => 'Australia',43 => 'Austria',994 => 'Azerbaijan',"1-242" => 'Bahamas',973 => 'Bahrain',880 => 'Bangladesh',"1-246" => 'Barbados',375 => 'Belarus',32 => 'Belgium',501 => 'Belize',229 => 'Benin',"1-441" => 'Bermuda',975 => 'Bhutan',591 => 'Bolivia',387 => 'Bosnia and Herzegovina',267 => 'Botswana',55 => 'Brazil',246 => 'British Indian Ocean Territory',"1-284" => 'British Virgin Islands',673 => 'Brunei',359 => 'Bulgaria',226 => 'Burkina Faso',257 => 'Burundi',855 => 'Cambodia',237 => 'Cameroon',1 => 'Canada',238 => 'Cape Verde',"1-345" => 'Cayman Islands',236 => 'Central African Republic',235 => 'Chad',56 => 'Chile',86 => 'China',61 => 'Christmas Island',61 => 'Cocos Islands',57 => 'Colombia',269 => 'Comoros',682 => 'Cook Islands',506 => 'Costa Rica',385 => 'Croatia',53 => 'Cuba',599 => 'Curacao',357 => 'Cyprus',420 => 'Czech Republic',243 => 'Democratic Republic of the Congo',45 => 'Denmark',253 => 'Djibouti',"1-767" => 'Dominica',"1-809 =>  1-829 =>  1-849" => 'Dominican Republic',670 => 'East Timor',593 => 'Ecuador',20 => 'Egypt',503 => 'El Salvador',240 => 'Equatorial Guinea',291 => 'Eritrea',372 => 'Estonia',251 => 'Ethiopia',500 => 'Falkland Islands',298 => 'Faroe Islands',679 => 'Fiji',358 => 'Finland',33 => 'France',689 => 'French Polynesia',241 => 'Gabon',220 => 'Gambia',995 => 'Georgia',49 => 'Germany',233 => 'Ghana',350 => 'Gibraltar',30 => 'Greece',299 => 'Greenland',"1-473" => 'Grenada',"1-671" => 'Guam',502 => 'Guatemala',"44-1481" => 'Guernsey',224 => 'Guinea',245 => 'Guinea-Bissau',592 => 'Guyana',509 => 'Haiti',504 => 'Honduras',852 => 'Hong Kong',36 => 'Hungary',354 => 'Iceland',91 => 'India',62 => 'Indonesia',98 => 'Iran',964 => 'Iraq',353 => 'Ireland',"44-1624" => 'Isle of Man',972 => 'Israel',39 => 'Italy',225 => 'Ivory Coast',"1-876" => 'Jamaica',81 => 'Japan',"44-1534" => 'Jersey',962 => 'Jordan',7 => 'Kazakhstan',254 => 'Kenya',686 => 'Kiribati',383 => 'Kosovo',965 => 'Kuwait',996 => 'Kyrgyzstan',856 => 'Laos',371 => 'Latvia',961 => 'Lebanon',266 => 'Lesotho',231 => 'Liberia',218 => 'Libya',423 => 'Liechtenstein',370 => 'Lithuania',352 => 'Luxembourg',853 => 'Macau',389 => 'Macedonia',261 => 'Madagascar',265 => 'Malawi',60 => 'Malaysia',960 => 'Maldives',223 => 'Mali',356 => 'Malta',692 => 'Marshall Islands',222 => 'Mauritania',230 => 'Mauritius',262 => 'Mayotte',52 => 'Mexico',691 => 'Micronesia',373 => 'Moldova',377 => 'Monaco',976 => 'Mongolia',382 => 'Montenegro',"1-664" => 'Montserrat',212 => 'Morocco',258 => 'Mozambique',95 => 'Myanmar',264 => 'Namibia',674 => 'Nauru',977 => 'Nepal',31 => 'Netherlands',599 => 'Netherlands Antilles',687 => 'New Caledonia',64 => 'New Zealand',505 => 'Nicaragua',227 => 'Niger',234 => 'Nigeria',683 => 'Niue',850 => 'North Korea',"1-670" => 'Northern Mariana Islands',47 => 'Norway',968 => 'Oman',92 => 'Pakistan',680 => 'Palau',970 => 'Palestine',507 => 'Panama',675 => 'Papua New Guinea',595 => 'Paraguay',51 => 'Peru',63 => 'Philippines',64 => 'Pitcairn',48 => 'Poland',351 => 'Portugal',"1-939" => 'Puerto Rico',974 => 'Qatar',242 => 'Republic of the Congo',262 => 'Reunion',40 => 'Romania',7 => 'Russia',250 => 'Rwanda',590 => 'Saint Barthelemy',290 => 'Saint Helena',"1-869" => 'Saint Kitts and Nevis',"1-758" => 'Saint Lucia',590 => 'Saint Martin',508 => 'Saint Pierre and Miquelon',"1-784" => 'Saint Vincent and the Grenadines',685 => 'Samoa',378 => 'San Marino',239 => 'Sao Tome and Principe',966 => 'Saudi Arabia',221 => 'Senegal',381 => 'Serbia',248 => 'Seychelles',232 => 'Sierra Leone',65 => 'Singapore',"1-721" => 'Sint Maarten',421 => 'Slovakia',386 => 'Slovenia',677 => 'Solomon Islands',252 => 'Somalia',27 => 'South Africa',82 => 'South Korea',211 => 'South Sudan',34 => 'Spain',94 => 'Sri Lanka',249 => 'Sudan',597 => 'Suriname',47 => 'Svalbard and Jan Mayen',268 => 'Swaziland',46 => 'Sweden',41 => 'Switzerland',963 => 'Syria',886 => 'Taiwan',992 => 'Tajikistan',255 => 'Tanzania',66 => 'Thailand',228 => 'Togo',690 => 'Tokelau',676 => 'Tonga',"1-868" => 'Trinidad and Tobago',216 => 'Tunisia',90 => 'Turkey',993 => 'Turkmenistan',"1-649" => 'Turks and Caicos Islands',688 => 'Tuvalu',"1-340" => 'U.S. Virgin Islands',256 => 'Uganda',380 => 'Ukraine',971 => 'United Arab Emirates',44 => 'United Kingdom',1 => 'United States',598 => 'Uruguay',998 => 'Uzbekistan',678 => 'Vanuatu',379 => 'Vatican',58 => 'Venezuela',84 => 'Vietnam',681 => 'Wallis and Futuna',212 => 'Western Sahara',967 => 'Yemen',260 => 'Zambia',263 => 'Zimbabwe'
    );
    const DEBIT_CARD_ID_IMAGES = array(
        "VISA_CARD" => array(
            "id" => "Debit_visa_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/visa_cardicon.png"
        ),
        "MASTER_CARD" => array(
            "id" => "Debit_mastercard_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/mastercard_cardicon.png"
        ),
        "MAESTRO_CARD" => array(
            "id" => "Debit_maestro_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/maestro_cardicon.png"
        ),
        "AMEX" => array(
            "id" => "Debit_americanexpress_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/americanexpress_cardicon.png"
        ),
        "RUPAY" => array(
            "id" => "Debit_rupay_div",
            "src" => Redirection::BASE . "/templates/shaper_helix3/images/cashier/rupay_cardicon.png"
        )
    );
    const PREPAID_WALLET_IMAGES = array(
        220 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/wallets_paycash.jpg",
        233 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/wallets_mobikwik.jpg",
        231 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/wallets_icash.jpg",
        229 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/wallets_itzcash.jpg"
    );
    const MOBILE_WALLET_IMAGES = array(
        242 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/freecharge.jpg",
        243 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/olamoney.jpg",
        244 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/jiomoney.jpg",
        245 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/airtelmoney.jpg",
        246 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/mobikwik.jpg",
        247 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/oxigen.jpg",
        248 => Redirection::BASE . "/templates/shaper_helix3/images/cashier/mrupee.gif"
    );
    const NET_BANKING_TOP_BANKS = array(
        "30" => ".jpg",
        "21" => ".jpg",
        "20" => ".jpg",
        "8" => ".jpg",
        "34" => ".jpg",
        "211" => ".jpg",
        "28" => ".jpg",
        "23" => ".jpg",
        "22" => ".jpg",
    );
    // Variables for implementation of player-wise content
    const PLAYER_WISE_MODULES = array(
        'mod_custom', 'mod_popup'
    );
    const ALLOWED_POSITION_PLAYERWISE_CONTENT = array(
        'title', '-popup', 'debug', 'position1', 'postloginbox1', 'postloginbox2', 'postloginbox3', 'postloginbox4', 'postloginbox5', 'postloginbox6', 'postloginbox7', 'postloginbox8', 'postloginbox9', 'postloginbox10', 'postloginbox11', 'postloginbox12'
    );
    const CLASS_NAME_SLIDE_DIVS = 'player-wise-div';
    // Inbox constants
    const INBOX_LIMIT = 51;
    // Withdrawal constants
    const WITHDRAWAL_CASH_TRANS = 'CASH_PAYMENT';
    const WITHDRAWAL_CHEQUE_TRANS = 'CHEQUE_TRANS';
    const WITHDRAWAL_BANK_TRANS = 'BANK_TRANS';
    public static $paymentTypeCodes_Withdrawal = array(
        self::WITHDRAWAL_CASH_TRANS => "Cash withdrawal",
        self::WITHDRAWAL_CHEQUE_TRANS => "Cheque withdrawal",
        self::WITHDRAWAL_BANK_TRANS => "Bank Transfer withdrawal"
    );
    // Loyalty Constants
    public static $loyalty_club_images = array(
        "bronze" => "bronze.png",
        "silver" => "silver.png",
        "gold" => "gold.png",
        "diamond" => "diamond.png",
        "platinum" => "platinum.png",
    );
    const LOYALTY_MERCHANDISE_IMAGES_PATH = Redirection::BASE . "/images/kpr/loyalty/";
    const TEMP_AUTH_ENABLED = false;
    public static $temp_auth_passwords = array(
        'skilrock@123', "123123123"
    );
    /**** Mesaage constants *****/
    const PLAYER_NAME_KEY = "{playerName}";
    const PLAYER_ID_KEY = "{playerId}";
    const PLAYER_USERNAME_KEY = "{playerUsername}";
    const PLAYER_MOBILE_KEY = "{playerMobile}";
    const PLAYER_EMAIL_KEY = "{playerEmail}";
    const PLAYER_WITHDRAWBAL_KEY = "{withdrawableBal}";
    const PLAYER_BONUSBAL_KEY = "{bonusBal}";
    const PLAYER_TOATALBAL_KEY = "{totalBal}";
    const PLAYER_CASHBAL_KEY = "{cashBal}";
    const IGE = "IGE";
    const SGE = "SGE";
    const VERSION = "4.0";
    const REQUEST_CHANNEL = "portal";
    const DATEFORMAT = "d M, Y G:i";
    const MYCURRENCYCODE = "USD";
    const MYCURRENCYSYMBOL = "฿";
    const CODEVERSION = "2.0";
    public static $serviceDetails = array(
        'country' => 'ZIMBABWE',
        'currencySymbol' => 'USD',
        self::IGE => array(
            'secureCode' => '12345678',
            'domainName' => Configuration::DOMAIN_NAME,
            'lang' => 'english',
            'merchantKey' => "4",
        ),
        self::SGE => array(
            'domainId' => 1,
            'serviceRootUrl' => 'http://ala-new.winweaver.com/SGE/',
            'serviceCode' => self::SGE,
            'merchantCode' => 2,
            'serviceName' => 'Slot',
            'secureKey' => '25d55ad283aa400af464c76d713c07ad',
            'domainName' => "tbg.lottoweaver.com",
            'merchantKey' => "2",
            'secureCode' => '12345678',
            'lang' => 'eng'
        )
    );
    const DEFAULT_CURRENCY_CODE = "EUR";
    public static $currencyMap = array(
        'CFA' => array(
            'id' => 11,
            'decSymbol' => 'XOF ',
            'curCode' => 'CFA',
            'hexSymbol' => 'XOF ',
            'entity' => 'XOF ',
            'enable' => 0
        ),
        'USD' => array(
            'id' => 10,
            'curCode' => 'USD',
            'decSymbol' => '&#036;',
            'hexSymbol' => '&#x24;',
            'entity' => '$',
            'enable' => 0
        ),
        'JPY' => array(
            'id' => 9,
            'curCode' => 'JPY',
            'decSymbol' => '&#165;',
            'hexSymbol' => '&#xa5;',
            'entity' => '�',
            'enable' => 0
        ),
        'INR' => array(
            'id' => 8,
            'curCode' => 'INR',
            'decSymbol' => '&#8377;',
            'hexSymbol' => '&#x20B9;',
            'entity' => '?',
            'enable' => 0
        ),
        'HKD' => array(
            'id' => 7,
            'curCode' => 'HKD',
            'decSymbol' => 'HK&#036;',
            'hexSymbol' => 'HK&#x24;',
            'entity' => 'HK$',
            'enable' => 0
        ),
        'GBP' => array(
            'id' => 6,
            'curCode' => 'GBP',
            'decSymbol' => '&#163;',
            'hexSymbol' => '&#xa3;',
            'entity' => '�',
            'enable' => 0
        ),
        'EUR' => array(
            'id' => 5,
            'curCode' => 'EUR',
            'decSymbol' => '&#8364;',
            'hexSymbol' => '&#x20AC;',
            'entity' => '€',
            'enable' => 1
        ),
        'CNY' => array(
            'id' => 4,
            'curCode' => 'CNY',
            'decSymbol' => '?',
            'hexSymbol' => '?',
            'entity' => '?',
            'enable' => 0
        ),
        'CHF' => array(
            'id' => 3,
            'curCode' => 'CHF',
            'decSymbol' => 'Fr. ',
            'hexSymbol' => 'Fr. ',
            'entity' => 'Fr. ',
            'enable' => 0
        ),
        'CAD' => array(
            'id' => 2,
            'curCode' => 'CAD',
            'decSymbol' => 'C&#036;',
            'hexSymbol' => 'C&#x24;',
            'entity' => 'C$',
            'enable' => 0
        ),
        'DOGE' => array(
            'id' => 26,
            'curCode' => 'DOGE',
            'decSymbol' => 'Ð',
            'hexSymbol' => 'Ð',
            'entity' => '',
            'enable' => 1
        ),
        'TRX' => array(
            'id' => 25,
            'curCode' => 'TRX',
            'decSymbol' => 'TRX',
            'hexSymbol' => 'TRX',
            'entity' => '',
            'enable' => 1
        ),
        'BTC' => array(
            'id' => 14,
            'curCode' => 'BTC',
            'decSymbol' => '₿',
            'hexSymbol' => '₿',
            'entity' => '',
            'enable' => 1
        ),
        'LINK' => array(
            'id' => 27,
            'curCode' => 'LINK',
            'decSymbol' => 'LINK',
            'hexSymbol' => 'LINK',
            'entity' => '',
            'enable' => 1
        ),
    );
    /***********************Weaver Configuration**************************/
    const WITHDRAWAL_MIN_LIMIT = 200;
    const WITHDRAWAL_MAX_LIMIT = 10000;
    const MOBILE_MIN_LENGTH = 9;
    const MOBILE_MAX_LENGTH = 10;
    const MOBILE_PATTERN = "^([0-9]{9}|[0-9]{10})$";
    const IE_NS_VERSION = 8;
    const TEMPLATE_ID = 9;
    const MOBILE_COUNTRY_CODE = '+01';
    const IGE_LOGIN_TOKEN = 'IGELOGIN';
    const DEFAULT_TIMEZONE = 'UTC';
    const FETCHALL_SKIP_ROUTE = array(
        "ugadi-special-offer-mar17",
        "super-welcome-bonus-offer-mar17",
        "rummy-legends-20-26-mar17",
    );
    const MAIL_FROM = "info@khelplayrummy.com";
    // Refer A Friend Constants
    const GMAIL_APP_NAME = "Infiniti";
    const GOOGLE_CLIENT_ID = '636512094254-5uh93hcns31s6ancp4s9i5498f48cacv.apps.googleusercontent.com';
    const GOOGLE_CLIENT_SECRET = 'Rrag41wd31RCZ97sKjl-Lv1N';
    const GOOGLE_MAX_RESULTS = 1000;
    const OUTLOOK_CLIENT_ID = '00000000401C010A';
    const OUTLOOK_CLIENT_SECRET = 'ogXPaZuYpPqgWY9kHwmqHmb';
    const FACEBOOK_APP_ID = "790299418280505";
    const YAHOO_OAUTH_CONSUMER_KEY = "dj0yJmk9V29OdVhNcmVXVFprJmQ9WVdrOVZsaEVTWEZSTmpJbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmc3Y9MCZ4PWFm";
    const YAHOO_OAUTH_CONSUMER_SECRET = "ecf0f2f8ce1ac048693c5a2c127c795e714b5e05";
    const TWITTER_HASHTAG = 'bet2winasia';
    const TWITTER_REFER_TEXT = " Love Lottery Games. Register on bet2winasia.com for an ecstatic experience.";

}

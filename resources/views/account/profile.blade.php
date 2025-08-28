@extends('layouts.app')

@section('content')

<!-- Styles -->
<style>
#sp-left .sp-module-title {
    font-size: 1.4em;
    text-transform: capitalize;
    font-weight: 500;
    color: #123374;
    padding: 20px 15px 20px;
    border-bottom: 4px solid #123374;
    /* margin: 0 -15px; */
    position: relative;
    text-align: center;
    background-color: #ffffff;
    /* box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2); */
}

.sp-module .sp-module-title {
    /* margin: 0 0 20px;
    font-size: 14px;
    text-transform: uppercase; */
    line-height: 1;
}

.sp-component {
    padding-bottom: 40px;
    min-height: 300px;
}

/* Layout */
.account-container {
    display: flex;
    background: #fff;
    border: 1px solid #ddd;
    min-height: 500px;
    font-family: Arial, sans-serif;
}

/* Sidebar */
.account-sidebar {
    width: 25%;
    background: #f8f9fa;
    border-right: 1px solid #ddd;
}
.account-sidebar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
}
.account-sidebar ul li {
    width: 50%; 
    box-sizing: border-box;
    border-bottom: 1px solid #eee;
}
.account-sidebar ul li a {
    display: block;
    padding: 12px 15px;
    color: #333;
    text-decoration: none;
    font-weight: 500;
}
.account-sidebar ul li.active,
.account-sidebar ul li a:hover {
    background: #002060;
    color: #fff;
}

/* Content */
.account-content {
    flex: 1;
}

/* Tab content */
.tab-content {
    display: none;
    padding: 20px;
}
.tab-content.active {
    display: block;
}

/* Profile banner */
.profile-banner {
    display: flex;
    align-items: center;
    background: #002060;
    color: #fff;
    padding: 20px;
}
.profile-pic {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 2px solid #fff;
    background: #1c3a70 url('https://via.placeholder.com/80') center/cover no-repeat;
    margin-right: 15px;
}
.profile-info h3 {
    margin: 0;
    font-size: 18px;
}
.profile-info p {
    margin: 2px 0 0;
    font-size: 14px;
}

/* Details */
.profile-details {
    padding: 20px;
}
.detail-row {
    display: flex;
    align-items: center;
    border-bottom: 1px dotted #ccc;
    padding: 12px 0;
    font-size: 14px;
}
.detail-row span {
    margin-right: 10px;
    font-size: 16px;
}
.detail-row p {
    flex: 1;
    margin: 0;
}
.btn-change {
    background: #e91e1e;
    border: none;
    color: #fff;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 20px;
    cursor: pointer;
}
.btn-change:hover {
    background: #c31717;
}

/* Update button */
.btn-update {
    background: #e91e1e;
    border: none;
    color: #fff;
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    border-radius: 30px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
}
.btn-update:hover {
    background: #c31717;
}

/* Wallet title */
.wallet-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #000;
}

/* Wallet tabs */
.wallet-tabs {
    font-size: 30px; 
    display: flex;
    border-bottom: 2px solid #ddd;
    margin-bottom: 20px;
    gap: 40px; 
}


.wallet-tabs a:hover {
    color: #ce1126;          /* red on hover */
}

.wallet-tab {
    flex: 1;
    text-align: center;
    padding: 10px 0;
    font-size: 21px;
    color: #0044cc;
    text-decoration: none;
    font-weight: 500;
    position: relative;
}
.wallet-tab.active {
    color: #d78f22;
    font-weight: 600;
}
.wallet-tab.active::after {
    content: "";
    display: block;
    height: 3px;
    background: #d78f22; /* gold underline */
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
}

.wallet-options {
    display: flex;
    gap: 20px;
    margin: 15px 0;
}

.wallet-option {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 20;
    cursor: pointer;
    padding: 10px 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    background: #f9f9f9;
    transition: 0.2s;
}

.wallet-option:hover {
    background: #f0f0f0;
    border-color: #0448a8;
}

.wallet-option input {
    accent-color: #0448a8
}


/* Wallet content */
.wallet-content {
    display: none;
    padding: 20px 0;
}
.wallet-content.active {
    display: block;
}
.wallet-subtitle {
    font-size: 19px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #000;
}

/* Buttons */
.wallet-actions {
    display: flex;
    justify-content: center; 
    gap: 5px;
    margin-top: 20px;
}

.btn-cancel, .btn-proceed {
    background: #ce1126;
    color: #fff;
    border: none;
    padding: 12px 40px;
    border-radius: 30px;
    font-size: 18px;
    cursor: pointer;
}
.btn-cancel:hover, .btn-proceed:hover {
    background: #a50e1e;
}
/* Inbox */
.inbox-title {
    font-size: 25px;
    font-weight: 550;
    margin-bottom: 20px;
    color: #000;
    border-bottom: 2px solid #ddd;
    padding-bottom: 8px;
}

/* Ticket Title */
.ticket-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #000;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

/* Date Filter */
.ticket-filters {
    display: flex;
    align-items: flex-end;
    gap: 20px;
    margin-bottom: 20px;
}
.filter-group {
    display: flex;
    flex-direction: column;
    font-size: 18px;
    font-weight: 600;
    color: #333;
    width:250px;
}
.ticket-date {
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    margin-top: 5px;
}
.btn-search {
    background: #ce1126;
    color: #fff;
    border: none;
    padding: 10px 25px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    width: 250px;  
}

.tickets-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 20px;
    font-family: 'Roboto', Arial, sans-serif; 
}


/* Ticket Card */
.ticket-card {
    display: flex;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    min-height: 180px;
    width: 100%; /* let grid handle width */
    overflow: hidden; /* prevents child overflow */
}

/* Left Side */
.ticket-left {
    flex: 3;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.ticket-left h3 {
    font-size: 15px;
    font-weight: 500;
    color: #000; 
    margin: 0 0 5px;
}

.ticket-id,
.ticket-time {
    font-size: 12px;
    color: #777; 
    margin: 0;
    line-height: 1.4;
}

/* Ticket Price */
.ticket-price {
    margin-top: 10px;
    font-size: 22px;
    font-weight: 600;
    color: #666161;
    margin-left: auto; /* pushes to right inside left section */
}

/* Divider */
.ticket-divider {
    width: 1px;
    background: #ddd;
    position: relative;
}

.ticket-divider::before,
.ticket-divider::after {
    content: "";
    width: 16px;
    height: 16px;
    background: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 50%;
    position: absolute;
    left: -8px;
}
.ticket-divider::before { top: -8px; }
.ticket-divider::after { bottom: -8px; }

/* Right Side */
.ticket-right {
    flex: 1;
    text-align: center;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.ticket-right img {
    width: 50px;
    height: 50px;
    margin-bottom: 6px;
}

.ticket-right p {
    font-size: 12px;
    font-weight: 500;
    color: #333; 
    margin: 0;
}


/* Title */
.transaction-title {
    font-size: 25px;
    font-weight: 550;
    margin-bottom: 20px;
    color: #000;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

/* Filters */
.transaction-filters {
    display: flex;
    align-items: flex-end;
    gap: 15px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}

.filter-groupp {
    display: flex;
    flex-direction: column;
    font-size: 16px;
    font-weight: 600;
    color: #333;
}

/* Common style */
.transaction-date,
.transaction-select {
    padding: 8px 14px;
    border: 1px solid #ccc;
    font-size: 16px;
    min-width: 300px;
    outline: none;
}

#from-date,
#to-date {
    border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.transaction-select {
    border-radius: 25px;
}
.ledger-table {
    width: 100%;
    margin-top: 10px;
    font-size: 14px;
    border-collapse: collapse;
}

.ledger-table th, 
.ledger-table td {
    border-top: 1px solid #ddd;  
    border-bottom: 1px solid #ddd;
    border-left: none;       
    border-right: none; 
    padding: 15px;
    font-size: 18px;
    text-align: center;
    color: #333;
}

.ledger-table th {
    font-size: 18px;
    font-weight: bold;
    border-top: none;              
    border-bottom: 3px solid #000;

}

.wager-table {
    width: 100%;
    margin-top: 10px;
    font-size: 14px;
    border-collapse: collapse;
}

.wager-table th, 
.wager-table td {
    border-top: 1px solid #ddd;     
    border-bottom: 1px solid #ddd;
    border-left: none;      
    border-right: none;
    padding: 15px;
    font-size: 18px;
    text-align: center;
    color: #333;
}

.wager-table th {
    font-size: 18px;
    font-weight: bold;
    border-top: none;              
    border-bottom: 3px solid #000;

}

.winning-table {
    width: 100%;
    margin-top: 10px;
    font-size: 14px;
    border-collapse: collapse;
}

.winning-table th, 
.winning-table td {
    border-top: 1px solid #ddd;     
    border-bottom: 1px solid #ddd;
    border-left: none;      
    border-right: none;
    padding: 15px;
    font-size: 18px;
    text-align: center;
    color: #333;
}

.winning-table th {
    font-size: 18px;
    font-weight: bold;
    border-top: none;              
    border-bottom: 3px solid #000;

}


.btn-search {
    background: #ce1126;
    color: #fff;
    border: none;
    padding: 10px 25px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 600;
    width: 260px;
}


/* Refer Container */
.refer-friend-title {
    font-size: 25px;
    font-weight: 550;
    margin-bottom: 20px;
    color: #000;
    border-bottom: 2px solid #ddd;
    padding-bottom: 8px;
}

.refer-container {
    padding: 20px;
    font-family: Arial, sans-serif;
}

.refer-tabs {
    display: flex;
    border-bottom: 2px solid #ddd;
    margin-bottom: 20px;
}
.refer-tab.active {
    color: #d78f22;
    border-bottom: 3px solid #d78f22;
    font-weight: 600;
    font-size: 23px;
}
.refer-tab {
    flex: 1;
    text-align: center;
    padding: 10px;
    font-size: 23px;
    color: #0448a8;
    text-decoration: none;
    font-weight: 500;
}

.refer-content { display: none; }
.refer-content.active { display: block; }

.refer-title {
    font-size: 24px;
    color: #0448a8;
    margin: 60px 0 40px;
    text-align: center;
}

.refer-options {
    justify-content: center;
    gap: 20px;
    margin-bottom: 20px;
}

.refer-list {
    display: flex;
    gap: 15px;
    list-style: none;
    padding: 0;
}

.refer-btn {
  flex: 1;
  text-align: center;
  padding: 10px 0;
  font-size: 18px;
  font-weight: 530;
  color: #333333;
  cursor: pointer;
  transition: all 0.3s ease;
}

.refer-btn i {
  display: block;
  font-size: 40px;
  margin-bottom: 0px;
}

.refer-btn.gmail:hover {
  background-color: #d93025; 
  color: #fff;
  border-color: #d93025;
  border-radius:5px;
}

.refer-btn.facebook:hover {
  background-color: #0448a8;
  color: #fff;
  border-color: #0448a8;
  border-radius:5px;
}

.refer-btn.twitter:hover {
  background-color: #1da1f2; 
  color: #fff;
  border-color: #1da1f2;
  border-radius:5px;
}


.refer-copy {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.refer-code,
.refer-link {
    flex: 1;
    padding: 10px ;
    border: 1px solid grey;
    border-radius: 25px;
    font-size: 17px;
    width:100px;
    color: #555555;
    background-color:#e6dfdf;
}
.copy-btn {
    background: #ce1126;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 17px;
    font-weight: bold;
}

.copy-btn:hover {
    background: white;
    color: #ce1126;
    border: 3px solid #ce1126;
}

.refer-form {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}
.refer-form input {
    flex: 1;
    padding: 10px;
    font-size:18px;
    border: 1px solid grey;
    border-top-left-radius: 25px;
    border-bottom-left-radius: 25px;
}
.add-btn {
    background: #ce1126;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 50%;
    cursor: pointer;
    font-weight: bold;
}

/* Invite button */
.invite-btn {
    display: block;
    margin: 60 auto 60px;
    background: #ce1126;
    color: #fff;
    padding: 12px 40px;
    border: none;
    border-radius: 25px;
    font-size: 20;
    font-weight: bold;
    cursor: pointer;
}

/* Note */
.refer-note {
    font-size: 19px;
    color: #555;
    line-height: 1.4;
    text-align: center;
}

.refer_option ul {
    list-style: none;
    display: flex
;
    flex-wrap: wrap;
}

.refer_option ul {
    border: 1px solid #dddddd;
    padding: 15px 10px;
}

 ul {
    margin-top: 0;
    margin-bottom: 1rem;
}

</style>

<div class="account-container">
    <!-- Sidebar -->
    <div id = "sp-left" class="account-sidebar">
    <h3 class = "sp-module-title">My Account</h3>
        <ul>
            <li class="active"><a href="#" data-tab="profile">🌐 My Profile</a></li>
            <li><a href="#" data-tab="tickets">🎟 My Tickets</a></li>
            <li><a href="#" data-tab="wallet">👛 My Wallet</a></li>
            <li><a href="#" data-tab="transactions">💳 My Transaction</a></li>
            <li><a href="#" data-tab="inbox">📥 Inbox</a></li>
            <li><a href="#" data-tab="refer">🌍 Refer a Friend</a></li>
        </ul>
    </div>

    <!-- Profile Content -->
    <div class="account-content">

        <!-- Profile Section -->
        <div class="tab-content active sp-component" id="profile">
            <div class="profile-banner">
                <div class="profile-pic"></div>
                <div class="profile-info">
                    <h3>Mr. Player</h3>
                    <p>{{ authUserName() }}</p>
                </div>
            </div>
            <div class="profile-details">
                <div class="detail-row">
                    <span>📞</span>
                    <p>{{ authUserName() }}</p>
                </div>
                <div class="detail-row">
                    <span>🌍</span>
                    <p>{{ authUserCountry() }}</p>
                </div>
                <div class="detail-row">
                    <span>🔒</span>
                    <p>Password</p>
                    <button class="btn-change">Change</button>
                </div>
                <button class="btn-update">Update Details</button>
            </div>
        </div>

        <!-- Tickets Section -->
        <div class="tab-content" id="tickets">
            <h2 class="ticket-title">'Ticket Details'</h2>

            <!-- Date Filter -->
            <div class="ticket-filters">
                <div class="filter-group">
                    <label for="from-date">From</label>
                    <input type="date" id="from-date" class="ticket-date" value="{{ now()->subMonth()->format('Y-m-d') }}">
                </div>
                <div class="filter-group">
                    <label for="to-date">To</label>
                    <input type="date" id="to-date" class="ticket-date" value="{{ now()->format('Y-m-d') }}">
                </div>
                <button class="btn-search">Search</button>
            </div>

                <!-- Tickets Grid -->
            <div class="tickets-grid">
                
                <!-- Ticket Card -->
                <div class="ticket-card">
                    <div class="ticket-left">
                        <h3>Robinhood</h3>
                        <p class="ticket-id">2178422</p>
                        <p class="ticket-time">Aug 26, 2025 09:04:56</p>
                        <div class="ticket-price">EUR 1</div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-right">
                        <img src="https://via.placeholder.com/50" alt="Game Logo">
                        <p>ROBINHOOD</p>
                    </div>
                </div>

                <!-- Another Ticket -->
                <div class="ticket-card">
                    <div class="ticket-left">
                        <h3>Big5</h3>
                        <p class="ticket-id">2178399</p>
                        <p class="ticket-time">Aug 25, 2025 10:19:35</p>
                        <div class="ticket-price">EUR 1</div>
                    </div>
                    <div class="ticket-divider"></div>
                    <div class="ticket-right">
                        <img src="https://via.placeholder.com/50" alt="Game Logo">
                        <p>BIG5</p>
                    </div>
                </div>

            </div>
        </div>


        <!-- Wallet Section -->
        <div class="tab-content" id="wallet">
            <h1 class="wallet-title">My Wallet</h1>

            <!-- Deposit / Withdraw Tabs -->
            <div class="wallet-tabs">
                <a href="#" class="wallet-tab active" data-wallet="deposit">Deposit</a>
                <a href="#" class="wallet-tab" data-wallet="withdraw">Withdrawal</a>
            </div>

            <!-- Deposit Content -->
            <div class="wallet-content active" id="deposit">
                <h4 class="wallet-subtitle">CHOOSE PAYMENT MODE</h4>

                <!-- Payment Options -->
                <div class="wallet-options">
                    <label class="wallet-option">
                        <input type="radio" name="deposit-method" value="paypal">
                        <span>PayPal</span>
                    </label>
                    <label class="wallet-option">
                        <input type="radio" name="deposit-method" value="bank">
                        <span>Bank Account</span>
                    </label>
                </div>

                <div class="wallet-actions">
                    <button class="btn-cancel"><b>Cancel</b></button>
                    <button class="btn-proceed"><b>Proceed</b></button>
                </div>
            </div>

            <!-- Withdraw Content -->
            <div class="wallet-content" id="withdraw">
                <h4 class="wallet-subtitle">CHOOSE PAYMENT MODE</h4>

                <!-- Payment Options -->
                <div class="wallet-options">
                    <label class="wallet-option">
                        <input type="radio" name="withdraw-method" value="paypal">
                        <span>PayPal</span>
                    </label>
                    <label class="wallet-option">
                        <input type="radio" name="withdraw-method" value="bank">
                        <span>Bank Account</span>
                    </label>
                </div>

                <div class="wallet-actions">
                    <button class="btn-cancel"><b>Cancel</b></button>
                    <button class="btn-proceed"><b>Proceed</b></button>
                </div>
            </div>
        </div>

        <!-- Transactions Section -->
        <div class="tab-content" id="transactions">
            <h2 class="transaction-title">Transactions Details</h2>
                <form class="transaction-filters">

                    <div class="filter-groupp">
                        <label for="from-date">From</label>
                        <input type="date" id="from-date" name="from_date" class="transaction-date">
                    </div>

                    <div class="filter-groupp">
                        <label for="to-date">To</label>
                        <input type="date" id="to-date" name="to_date" class="transaction-date">
                    </div>

                    <div class="filter-groupp">
                        <label for="transaction-type">Transaction Type</label>
                        <select id="transaction-type" name="transaction_type" class="transaction-select">
                            <option value="">Select</option>
                            <option value="ledger">Ledger</option>
                            <option value="deposit">Deposit</option>
                            <option value="withdraw">Withdrawal</option>
                            <option value="wager">Wager</option>
                            <option value="wager-refund">Wager Refund</option>
                            <option value="winning">Winning</option>
                            <option value="withdraw-cancel">Withdrawal Cancel</option>
                            <option value="bonus">Bonus Details</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-search">Search</button>
                </form>


                <div id="ledger-table" style="display:none; margin-top:20px;">
                    <h5>'Closing Balance: ' <b>EUR 10,012</b></h5>
                    <table class="ledger-table">
                        <thead>
                            <tr>
                                <th>Sr.No.</th>
                                <th>Date & Time</th>
                                <th>Transaction ID</th>
                                <th>Particulars</th>
                                <th>Cr.</th>
                                <th>Dr.</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2025-08-26 09:05:02</td>
                                <td>2178423</td>
                                <td>Winning_INSTANT SCRATCH_Robinhood</td>
                                <td>5</td>
                                <td></td>
                                <td>EUR 10,012</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2025-08-26 09:04:56</td>
                                <td>2178422</td>
                                <td>Wager_INSTANT SCRATCH_Robinhood</td>
                                <td></td>
                                <td>1</td>
                                <td>EUR 10,007</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div id="wager-table" style="display:none; margin-top:20px;">
                <h5>'Total wager for the selected period: ' <b>EUR 19</b></h5>
                <table class="wager-table">
                    <thead>
                        <tr>    
                            <th>Sr.No.</th>
                            <th>Date & Time</th>
                            <th>Transaction ID</th>
                            <th>Particulars</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2025-08-26 09:04:56</td>
                            <td>2178422</td>
                            <td>Wager_INSTANT SCRATCH_Robinhood_427417561990960844326</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2025-08-26 09:03:21</td>
                            <td>2178420</td>
                            <td>Wager_INSTANT SCRATCH_Robinhood_882517561990011934326</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2025-08-26 09:03:10</td>
                            <td>2178418</td>
                            <td>Wager_INSTANT SCRATCH_Robinhood_783017561989896204326</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <div id="winning-table" style="display:none; margin-top:20px;">
                <h5>'Total winning for the selected period: ' <b>EUR 31</b></h5>
                <table class="winning-table">
                    <thead>
                        <tr>    
                            <th>Sr.No.</th>
                            <th>Date & Time</th>
                            <th>Transaction ID</th>
                            <th>Particulars</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2025-08-26 09:04:56</td>
                            <td>2178422</td>
                            <td>Wager_INSTANT SCRATCH_Robinhood_427417561990960844326</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>2025-08-26 09:03:21</td>
                            <td>2178420</td>
                            <td>Wager_INSTANT SCRATCH_Robinhood_882517561990011934326</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>2025-08-26 09:03:10</td>
                            <td>2178418</td>
                            <td>Wager_INSTANT SCRATCH_Robinhood_783017561989896204326</td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <p id="message" style="display:none; color:red; font-weight:bold; margin-top:15px;"></p>


        </div>


        <!-- Inbox Section -->
        <div class="tab-content" id="inbox">
            <h2 class="inbox-title">Check Email</h2>

            <!-- Messages -->
            No Messages found.
        </div>

        <!-- Refer Section -->
        <div class="tab-content" id="refer">
            <h2 class="refer-friend-title">Refer Now</h2>
            <div class="refer-container">
                <!-- Top Tabs -->
                <div class="refer-tabs">
                    <a href="#" class="refer-tab active" data-refer="now">Refer Now</a>
                    <a href="#" class="refer-tab" data-refer="status">Track Status</a>
                </div>

                <!-- Refer Now Content -->
                <div class="refer-content active" id="refer-now">
                    <h3 class="refer-title">Choose How You’d Like To Invite!</h3>
                    <div class="col-md-12 col-sm-12 col-xs-12 refer_option refer-options">
                    <ul class="refer-list">
                        <li class="refer-btn gmail ">
                            <i class="bi bi-envelope"></i><br>Gmail
                        </li>
                        <li class="refer-btn facebook">
                            <i class="bi bi-facebook"></i><br>WEAVER_FACEBOOK
                        </li>
                        <li class="refer-btn twitter">
                            <i class="bi bi-twitter"></i><br>Twitter
                        </li>
                        </ul>
                    </div>

                    <h3 class="refer-title">Or Share The Link Below With Your Friends</h3>
                    <div class="refer-copy">
                        <label class="refer-label">Refer Code:</label>
                        <div class="input-group">
                            <input type="text" readonly value="Q6B10" class="refer-code">
                            <button class="copy-btn">COPY</button>
                        </div>
                        <label class="refer-label">Referral link:</label>
                        <div class="input-group">
                            <input type="text" readonly value="https://www.wls.infinitolotto.com/refer-friend?data=Q6B10" class="refer-link">
                            <button class="copy-btn">COPY</button>
                        </div>
                    </div>

                    <h3 class="refer-title">Or Add Friends Manually</h3>
                    <div class="refer-form">
                        <input type="text" placeholder="Friend’s Name">
                        <input type="email" placeholder="Friend’s Email Address">
                        <button class="add-btn">➕</button>
                    </div>
                    <button class="invite-btn">Invite Friends Now</button>

                    <p class="refer-note">
                        To be eligible for the bonus, please ensure that the friends you invite use the link located in the invitation sent to them. This is the only way they can be linked to your account.
                        <br>
                        <br>

                        Just choose your email provider or social networking site(s) and invite your friends to join Khelplayrummy. Please be informed that no information shall be shared with anyone, please read our privacy policy to gain more understanding in this respect.
                    </p>
                </div>

                <!-- Track Status Content -->
                <div class="refer-content" id="refer-status">
                    <p>No referral history found.</p>
                </div>
            </div>
        </div>

    </div>
</div>


<!-- Script for Sidebar Tab Switching -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const links = document.querySelectorAll(".account-sidebar ul li a");
    const contents = document.querySelectorAll(".tab-content");

    links.forEach(link => {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            links.forEach(l => l.parentElement.classList.remove("active"));
            contents.forEach(c => c.classList.remove("active"));
            this.parentElement.classList.add("active");
            document.getElementById(this.dataset.tab).classList.add("active");
        });
    });
});
</script>

<!-- Script for Wallet Tab Switching -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const walletTabs = document.querySelectorAll(".wallet-tab");
    const walletContents = document.querySelectorAll(".wallet-content");

    walletTabs.forEach(tab => {
        tab.addEventListener("click", function(e) {
            e.preventDefault();
            walletTabs.forEach(t => t.classList.remove("active"));
            walletContents.forEach(c => c.classList.remove("active"));
            this.classList.add("active");
            document.getElementById(this.dataset.wallet).classList.add("active");
        });
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const referTabs = document.querySelectorAll(".refer-tab");
    const referContents = document.querySelectorAll(".refer-content");

    referTabs.forEach(tab => {
        tab.addEventListener("click", function(e) {
            e.preventDefault();
            referTabs.forEach(t => t.classList.remove("active"));
            referContents.forEach(c => c.classList.remove("active"));
            this.classList.add("active");
            document.getElementById("refer-" + this.dataset.refer).classList.add("active");
        });
    });
});

</script>

<script>
    document.querySelectorAll(".refer-btn").forEach(btn => {
  btn.addEventListener("click", function() {
    document.querySelectorAll(".refer-btn").forEach(b => b.classList.remove("active"));
    this.classList.add("active");
  });
});

</script>

<script>
$(document).ready(function(){
    $(".transaction-filters").on("submit", function(e){
        e.preventDefault(); // stop form from reloading page

        let type = $("#transaction-type").val();

        // hide all tables & message first
        $("#ledger-table, #wager-table, #winning-table, #message").hide();

        if(type === "ledger"){
            $("#ledger-table").show();
        } 
        else if(type === "wager"){
            $("#wager-table").show();
        }
        else if(type === "winning"){
            $("#winning-table").show();
        }
        else {
            $("#message").text("No Transaction Details Found For Selected Date Range.").show();
        }
    });
});

</script>
@endsection

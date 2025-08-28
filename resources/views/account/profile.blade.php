@extends('layouts.app')

@section('content')

<div class="account-container">
    <!-- Sidebar -->
    <div id = "sp-left" class="account-sidebar">
    <h3 class = "sp-module-title">My Account</h3>
        <ul>
            <li class=""><a href="#" data-tab="profile">🌐 My Profile</a></li>
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
                <div class="profile-pic-wrapper">
                    <div class="profile-pic">
                        <img src="{{$playerInfo->avatarPath ?? 'https://image.freepik.com/free-vector/businessman-character-avatar-icon-vector-illustration-design_24877-18271.jpg'}}" alt="User Pic" />
                    </div>
                    <button class="edit-btn" id="editAvatarBtn" title="Edit">✏️</button>
                </div>
                <div class="profile-info">
                    <h3>Mr. {{$playerInfo->firstName ?? 'Player'}} {{$playerInfo->lastName ?? ''}}</h3>
                    <p>{{ $playerInfo->mobileNo ?? '' }}</p>
                </div>
            </div>
            <div class="profile-details" id="profileDetails">
                @if(isset($playerInfo->emailId))
                <div class="detail-row">
                    <span>📧</span>
                    <p>{{ $playerInfo->emailId ?? '' }}</p>
                </div>
                @endif
                <div class="detail-row">
                    <span>📞</span>
                    <p>{{ $playerInfo->mobileNo ?? '' }}</p>
                </div>
                @if(isset($playerInfo->country))
                <div class="detail-row">
                    <span>🌍</span>
                    <p>{{ $playerInfo->country ?? '' }}</p>
                </div>
                @endif
                @if(isset($playerInfo->addressLine1))
                <div class="detail-row">
                    <span>📌</span>
                    <p>{{ $playerInfo->addressLine1 ?? '' }}</p>
                </div>
                @endif
                @if(isset($playerInfo->dob))
                <div class="detail-row">
                    <span>📅</span>
                    <p>{{ $playerInfo->dob ?? '' }}</p>
                </div>
                @endif
                <!-- <div class="detail-row">
                    <span>🔒</span>
                    <p>Password</p>
                    <button class="btn-change">Change</button>
                </div>
                <button class="btn-update">Update Details</button> -->
            </div>
            <!-- 👇 Hidden Form for Avatar Upload -->
            <div class="avatar-upload-form" id="avatarUploadForm" style="display: none;">
                <form action="{{ route('account.uploadPlayerAvatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="avatar">Choose a new profile picture:</label>
                        <input type="file" name="user_avatar" id="avatar" required accept=".jpg, .jpeg, .png, .gif">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">Submit</button>
                        <button type="button" class="btn-cancel" id="cancelAvatarUpload">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tickets Section -->
        <div class="tab-content" id="tickets">
            <h2 class="ticket-title">'Ticket Details'</h2>

            <!-- Date Filter -->
            <div class="ticket-filters">
                <form>
                <div class="filter-group">
                    <label for="from-date">From</label>
                    <input type="date" id="from-date" class="ticket-date" name="fromDate" value="{{ now()->subMonth()->format('Y-m-d') }}">
                </div>
                <div class="filter-group">
                    <label for="to-date">To</label>
                    <input type="date" id="to-date" class="ticket-date" name="toDate" value="{{ now()->format('Y-m-d') }}">
                </div>
                <input type="hidden" name="limit" value="40">
                <button class="btn-search">Search</button>
                </form>
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

@endsection


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
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const links = document.querySelectorAll(".account-sidebar ul li a");
        const contents = document.querySelectorAll(".tab-content");

        // Get tabactive from backend
        let activeTab = @json($tabactive ?? 'profile'); // fallback to profile if not set

        // First reset everything
        links.forEach(l => l.parentElement.classList.remove("active"));
        contents.forEach(c => c.classList.remove("active"));

        // Find matching sidebar link
        const activeLink = document.querySelector(`.account-sidebar a[data-tab="${activeTab}"]`);
        const activeContent = document.getElementById(activeTab);

        if (activeLink && activeContent) {
            activeLink.parentElement.classList.add("active");
            activeContent.classList.add("active");
        } else {
            // fallback if tab not found
            document.querySelector('.account-sidebar ul li:first-child').classList.add("active");
            contents[0].classList.add("active");
        }

        // Now handle click switching as before
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editBtn = document.getElementById('editAvatarBtn');
        const cancelBtn = document.getElementById('cancelAvatarUpload');
        const profileDetails = document.getElementById('profileDetails');
        const avatarUploadForm = document.getElementById('avatarUploadForm');

        if (editBtn) {
            editBtn.addEventListener('click', function () {
                profileDetails.style.display = 'none';
                avatarUploadForm.style.display = 'block';
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', function () {
                avatarUploadForm.style.display = 'none';
                profileDetails.style.display = 'block';
            });
        }
    });
</script>
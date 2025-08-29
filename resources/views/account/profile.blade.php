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
                        <img src="{{$playerInfo->commonContentPath . $playerInfo->avatarPath . '?v=' . microtime()}}" alt="User Pic" />
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
                <div class="detail-row">
                    <span>🔒</span>
                    <p>Password</p>
                    <button class="btn-change">Change</button>
                </div>
                <button class="btn-update">Update Details</button>
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

            <!-- Update Details Form (initially hidden) -->
            <div id="updateDetailsForm" style="display:none;">
                <form>
                    <div class="detail-row">
                    <label>First Name*</label>
                    <input type="text" name="firstName" />
                    </div>
                    <div class="detail-row">
                    <label>Last Name*</label>
                    <input type="text" name="lastName" />
                    </div>
                    <div class="detail-row">
                    <label>Address*</label>
                    <textarea name="address"></textarea>
                    </div>
                    <div class="detail-row">
                    <label>Date of Birth*</label>
                    <input type="text" name="dob" />
                    </div>
                    <div class="detail-row">
                    <label>Country*</label>
                    <input type="text" name="country" />
                    </div>
                    <div class="detail-row">
                    <label>Email Address*</label>
                    <input type="email" name="email" />
                    </div>
                    <div class="detail-row">
                    <label>Mobile No*</label>
                    <input type="text" name="mobileNo" />
                    </div>
                    <div class="detail-row">
                    <label>Gender*</label>
                    <input type="radio" name="gender" value="Male" /> Male
                    <input type="radio" name="gender" value="Female" /> Female
                    </div>
                    <div class="form-actions">
                    <button type="submit">Save</button>
                    <button type="button" id="cancelUpdateDetails">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Change Password Form (initially hidden) -->
            <div id="changePasswordForm" style="display:none;">
            <form>
                <div class="detail-row">
                <label>Current Password*</label>
                <input type="password" name="currentPassword" />
                </div>
                <div class="detail-row">
                <label>New Password*</label>
                <input type="password" name="newPassword" />
                </div>
                <div class="detail-row">
                <label>Confirm Password*</label>
                <input type="password" name="confirmPassword" />
                </div>
                <div class="form-actions">
                <button type="submit">Change</button>
                <button type="button" id="cancelChangePassword">Cancel</button>
                </div>
            </form>
            </div>

        </div>

        <!-- Tickets Section -->
        <div class="tab-content" id="tickets">
            <h2 class="ticket-title">'Ticket Details'</h2>

            <!-- Date Filter -->
            <div class="ticket-filters">
                <form id="ticketDeatil" action="#" autocomplete="off">
                <div class="filter-group">
                    <label for="from-date">From</label>
                    <input type="date" id="from-date" class="ticket-date" name="fromDate" value="{{ now()->subMonth()->format('Y-m-d') }}" required>
                </div>
                <div class="filter-group">
                    <label for="to-date">To</label>
                    <input type="date" id="to-date" class="ticket-date" name="toDate" value="{{ now()->format('Y-m-d') }}" required>
                </div>
                <input type="hidden" name="limit" value="100">
                <input type="hidden" name="txnType" value="ticket">
                <input type="hidden" name="offset" value="0">
                <button type="button" class="btn-search" id="ajaxSearchBtn">Search</button>
                </form>
            </div>

                <!-- Tickets Grid -->
            <div class="tickets-grid" id="tickettable">
                <p id="messagetickettable" style="display:none; color:red; font-weight:bold; margin-top:15px;"></p>
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
                        <input type="date" id="from-date" name="fromDate" class="transaction-date" value="{{ now()->subMonth()->format('Y-m-d') }}" required>
                    </div>

                    <div class="filter-groupp">
                        <label for="to-date">To</label>
                        <input type="date" id="to-date" name="toDate" class="transaction-date" value="{{ now()->format('Y-m-d') }}" required>
                    </div>

                    <div class="filter-groupp">
                        <label for="transaction-type">Transaction Type</label>
                        <select id="transaction-type" name="txnType" class="transaction-select">
                            @foreach($transaction_option AS $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="button" id="transaction-filtersbtn" class="btn-search">Search</button>
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
            <div id="inbox-list"></div>

            <div id="message-view" style="display:none;">
                <button id="back-to-inbox">Back to Inbox</button>
                <div id="message-content"></div>
                <button id="delete-message">Delete</button>
            </div>
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
                    <form id="refer-form-friend">
                    <div class="refer-form">
                        <input type="text" placeholder="Friend’s Name" name="firstName">
                        <input type="email" placeholder="Friend’s Email Address" name="emailId">
                        <input type="hidden" name="referType" value="mailRefer">
                        <input type="hidden" name="lastName" value="">
                        <input type="hidden" name="mobileNo" value="">
                        <input type="hidden" name="inviteMode" value="EMAIL" >
                    </div>
                    <button type="submit" class="invite-btn">Invite Friends Now</button>
                    </form>
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


@push('script')
 <script>
   $(document).ready(function(){
    $('#ajaxSearchBtn').on('click', function() {
        var formData = $('#ticketDeatil').serialize();

        $.ajax({
            url: '/account/getTransactionDetails',
            type: 'POST',
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.view) {
                    debugger;
                    $('#tickettable').html(response.view);
                    $('#messagetickettable').hide().text('');
                } else {
                    $('#messagetickettable').show().text(response.message);
                    $('#tickettable').empty();
                }
            },
            error: function(xhr, status, error) {
                $('#messagetickettable').show().text(error);
            }
        });
    });
});

 </script>
<script>
$(document).ready(function () {
    const token = $('meta[name="csrf-token"]').attr('content');

    function loadInbox() {
        $.ajax({
            url: '{{ route("account.playerInbox") }}',
            type: 'POST',
            data: { _token: token, isAjax: 'true' },
            dataType: 'json',
            success: function (res) {
                if (res.errorCode !== 0) {
                    $('#inbox-list').html('<p>No messages found.</p>');
                    return;
                }
                let html = '<ul>';
                res.messages.plrInboxList.forEach(m => {
                    html += `<li class="${m.status.toLowerCase()}" data-msgid="${m.inboxId}" data-contentid="${res.content[m.inboxId]}">
                        <span>${m.subject}</span>
                        <button class="read-btn">Read</button>
                        <button class="delete-btn">Delete</button>
                    </li>`;
                });
                html += '</ul>';
                $('#inbox-list').html(html);
                $('#message-view').hide();
                $('#inbox-list').show();
            },
            error: function () {
                $('#inbox-list').html('<p>Error loading messages.</p>');
            }
        });
    }

    // Load inbox on inbox tab click
    $('a[data-tab="inbox"]').on('click', function (e) {
        e.preventDefault();
        loadInbox();
    });

    @if(($tabactive ?? 'profile') === 'inbox')
        loadInbox();  // load inbox on page load if inbox tab active
    @endif

    // Read message event
    $('#inbox-list').on('click', '.read-btn', function () {
        const msgId = $(this).parent().data('msgid');
        $.ajax({
            url: '{{ route("account.inboxActivity") }}',
            type: 'POST',
            data: { _token: token, activity: 'READ', msgId: msgId, isAjax: 'true' },
            dataType: 'json',
            success: function (res) {
                if (res.errorCode === 0) {
                    $('#message-content').html(res.content || 'No content found.');
                    $('#inbox-list').hide();
                    $('#message-view').show();
                    $('#delete-message').data('msgid', msgId);
                } else {
                    toastr.error(res.respMsg);
                }
            }
        });
    });

    // Back to inbox button
    $('#back-to-inbox').click(function () {
        loadInbox();
    });

    // Delete message buttons
    $('#inbox-list').on('click', '.delete-btn', function () {
        if (!confirm('Are you sure you want to delete this message?')) return;
        const msgId = $(this).parent().data('msgid');
        $.ajax({
            url: '{{ route("account.inboxActivity") }}',
            type: 'POST',
            data: { _token: token, activity: 'DELETE', msgId: msgId, isAjax: 'true' },
            dataType: 'json',
            success: function (res) {
                if (res.errorCode === 0) {
                    loadInbox();
                } else {
                    toastr.error(res.respMsg);
                }
            }
        });
    });

    // Delete from message view
    $('#delete-message').click(function () {
        const msgId = $(this).data('msgid');
        $.ajax({
            url: '{{ route("account.inboxActivity") }}',
            type: 'POST',
            data: { _token: token, activity: 'DELETE', msgId: msgId, isAjax: 'true' },
            dataType: 'json',
            success: function (res) {
                if (res.errorCode === 0) {
                    loadInbox();
                } else {
                    toastr.error(res.respMsg);
                }
            }
        });
    });
});
</script>
<script>
    document.querySelectorAll('.refer-btn.gmail, .refer-btn.facebook, .refer-btn.twitter').forEach(btn => {
        btn.addEventListener('click', function() {
            let url = '';
            let route = '';

            if (this.classList.contains('gmail')) {
                route = '/refer/gmail-refer';
            } else if (this.classList.contains('facebook')) {
                route = '/refer/facebook-refer';
            } else if (this.classList.contains('twitter')) {
                route = '/refer/twitter-refer';
            }

            fetch(route, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {
                if (data.status === 'success' && data.url) {
                    window.open(data.url, '_blank', 'width=600,height=400');
                } else {
                    toastr.error(data.message);
                }
            });
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('#refer-form-friend').on('submit', function(e) {
            e.preventDefault(); // prevent normal form submission

            // Serialize form data
            let formData = $(this).serialize();

            $.ajax({
                url: '/refer/invite-friend',    // Laravel route to post data
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // include CSRF token
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#refer-form-friend')[0].reset(); // optionally reset form
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error(error);
                }
            });
        });
    });

</script>
<script>
    $(document).ready(function() {
  // Update Details button click
        $('.btn-update').on('click', function() {
            $('#profileDetails').hide();
            $('#changePasswordForm').hide();
            $('#updateDetailsForm').show();
        });

        // Change Password button click
        $('.btn-change').on('click', function() {
            $('#profileDetails').hide();
            $('#updateDetailsForm').hide();
            $('#changePasswordForm').show();
        });

        // Cancel buttons in update details/change password forms
        $('#cancelUpdateDetails').on('click', function() {
            $('#updateDetailsForm').hide();
            $('#profileDetails').show();
        });
        $('#cancelChangePassword').on('click', function() {
            $('#changePasswordForm').hide();
            $('#profileDetails').show();
        });
    });

</script>
 @endpush
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

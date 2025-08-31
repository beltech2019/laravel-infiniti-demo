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
                        <img src="{{isset($playerInfo->commonContentPath) && isset($playerInfo->avatarPath) ? $playerInfo->commonContentPath . $playerInfo->avatarPath . '?v=' . microtime() : 'https://image.freepik.com/free-vector/businessman-character-avatar-icon-vector-illustration-design_24877-18271.jpg'}}" alt="User Pic" />
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
            <div id="updateDetailsForm" style="display: none;" class="container mt-4">
                <form class="row g-3" action="{{route('account.updatePlayerProfile')}}" method="POST">
                @csrf 
                    <div class="col-md-6">
                        <label class="form-label">First Name*</label>
                        <input type="text" class="form-control" name="fname" value="{{$playerInfo->firstName ?? ''}}" required/>
                    </div>
            
                    <div class="col-md-6">
                        <label class="form-label">Last Name*</label>
                        <input type="text" class="form-control" name="lname" value="{{$playerInfo->lastName ?? ''}}" required/>
                    </div>
            
                    <div class="col-12">
                        <label class="form-label">Address*</label>
                        <textarea class="form-control" name="address" rows="3" required>{{$playerInfo->addressLine1 ?? ''}}</textarea>
                    </div>
            
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth*</label>
                        <input type="date" class="form-control" name="dob" value="{{$playerInfo->dob ?? ''}}" />
                    </div>
            
                    <div class="col-md-6">
                        <label class="form-label">Country*</label>
                        <input type="text" class="form-control" value="{{$playerInfo->country ?? ''}}" disabled />
                        <input type="hidden" class="form-control" name="country" value="{{$playerInfo->countryCode ?? ''}}" />
                    </div>
            
                    <div class="col-md-8">
                        <label class="form-label">Email Address*</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" value="{{$playerInfo->emailId ?? ''}}" required/>
                        </div>
                    </div>
            
                    <div class="col-md-4">
                        <label class="form-label">Mobile No*</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="mobile" value="{{$playerInfo->mobileNo ?? ''}}" readonly />
                        </div>
                    </div>
            
                    <div class="col-12">
                        <label class="form-label">Gender*</label><br />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="M" {{isset($playerInfo->gender) && $playerInfo->gender == "M" ? 'checked': ''}} />
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="F" {{isset($playerInfo->gender) && $playerInfo->gender == "F" ? 'checked': ''}}/>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
            
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-outline-secondary" id="cancelUpdateDetails">Cancel</button>
                    </div>
            
                </form>
            </div>

            <!-- Change Password Form (initially hidden) -->
            <div id="changePasswordForm" style="display: none;" class="container mt-4">
                <form class="row g-3" action="{{route('account.changePassword')}}" method="POST">
                @csrf
                
                    <div class="col-12">
                        <label class="form-label">Current Password*</label>
                        <input type="password" class="form-control" name="currentPassword" placeholder="Enter current password" required />
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label">New Password*</label>
                        <input type="password" class="form-control" name="newPassword" placeholder="Enter new password" required />
                    </div>
                    
                    <div class="col-12">
                        <label class="form-label">Confirm Password*</label>
                        <input type="password" class="form-control" name="retypePassword" placeholder="Confirm new password" required />
                    </div>
                    
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Change</button>
                        <button type="button" class="btn btn-outline-secondary" id="cancelChangePassword">Cancel</button>
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
            <h1 class="wallet-title">My Wallet ({{ $currencyCode }})</h1>
            <div class="wallet-tabs">
                <a href="#" class="wallet-tab active" data-wallet="deposit">Deposit</a>
                <a href="#" class="wallet-tab" data-wallet="withdraw">Withdrawal</a>
            </div>

            <!-- Deposit Tab -->
            <div class="wallet-content active" id="deposit">
                <h4>CHOOSE PAYMENT MODE</h4>
                <form id="deposit-form">
                    @foreach ($options->payTypeMap ?? [] as $payType)
                        <div>
                            <label>
                                <input type="radio" name="depositMethod"
                                    value="{{ $payType->payTypeId }}">
                                {{ $payType->payTypeDispCode }}
                            </label>
                        </div>
                    @endforeach
                    @if(isset($options->payTypeMap) && count($options->payTypeMap) >0 ) 
                        <input type="number" id="deposit-amount" name="amount" placeholder="Amount ({{ $currencyCode }})" required>
                        <button type="submit" class="btn-proceed">Proceed</button>
                    @endif
                    <div class="error_tooltip" id="deposit-error" style="color:red;display:none"></div>
                </form>
            </div>

            <!-- Withdrawal Tab -->
            <div class="wallet-content" id="withdraw">
                <h4>CHOOSE PAYMENT MODE</h4>
                @if(isset($withdrawalOptions->payTypeMap) && count($withdrawalOptions->payTypeMap) >0 ) 
                <form id="withdraw-form">
                    @foreach ($withdrawalOptions->payTypeMap ?? [] as $payType)
                        <div>
                            <label>
                                <input type="radio" name="withdrawMethod"
                                    value="{{ $payType->payTypeId }}">
                                {{ $payType->payTypeDispCode }}
                            </label>
                        </div>
                    @endforeach
   
                    <input type="number" id="withdraw-amount" name="amount"
                        placeholder="Amount ({{ $currencyCode }})" required>
                    <button type="submit" class="btn-proceed">Proceed</button>
                    <div class="error_tooltip" id="withdraw-error" style="color:red;display:none"></div>
                </form>

                <h3>Pending Withdrawals</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>SNO</th>
                            <th>Date</th>
                            <th>Withdrawal Id</th>
                            <th>Amount</th>
                            <th>Pin Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($pendingWithdrawals->data))
                            @forelse($pendingWithdrawals->data as $w)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $w->createdAt ?? '' }}</td>
                                    <td>{{ $w->requestId ?? '' }}</td>
                                    <td>{{ $w->amount ?? '' }}</td>
                                    <td>
                                        <button data-id="{{ $w->userTxnId }}" class="btn-getpin">GET PIN</button>
                                        <span style="display:none" id="pin-{{ $w->userTxnId }}">{{ $w->otp ?? '' }}</span>
                                        <button data-id="{{ $w->requestId }}" data-amount="{{ $w->amount }}" class="btn-cancel">Cancel</button>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5">No pending withdrawals found.</td></tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
                @endif
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


                <table id="transaction-table" class="table" style="display:none">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Particular</th>
                            <th>Credit</th>
                            <th>Debit</th>
                            <th>Balance</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="pagination" id="transaction-pagination"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>


                <table id="bonus-table" class="table" style="display:none">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Bonus Code</th>
                            <th>Amount</th>
                            <th>Target</th>
                            <th>WR Requirement</th>
                            <th>Redeemed Amount</th>
                            <th>Bonus Criteria</th>
                            <th>Expiry</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <div class="pagination" id="bonus-pagination"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <table id="ticket-table" class="table" style="display:none">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Ticket Code</th>
                            <th>Ticket Count</th>
                            <th>Pending</th>
                            <th>Expiry</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination" id="ticket-pagination"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <table id="wager-table" class="table" style="display: none">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Particular</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="pagination" id="wager-pagination"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <table id="dwwr-table" class="table" style="display: none">
                    <thead>
                        <tr>
                            <th>S. No.</th>
                            <th>Date</th>
                            <th>Transaction ID</th>
                            <th>Particular</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="pagination" id="dwwr-pagination"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>

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
    $(document).ready(function () {
 
        // Show Update Details Form
        $('.btn-update').on('click', function () {
            $('#profileDetails').hide();
            $('#changePasswordForm').hide();
            $('#updateDetailsForm').show();
        });
 
        // Show Change Password Form
        $('.btn-change').on('click', function () {
            $('#profileDetails').hide();
            $('#updateDetailsForm').hide();
            $('#changePasswordForm').show();
        });
 
        // Cancel Update Details
        $('#cancelUpdateDetails').on('click', function () {
            $('#updateDetailsForm').hide();
            $('#profileDetails').show();
        });
 
        // Cancel Change Password
        $('#cancelChangePassword').on('click', function () {
            $('#changePasswordForm').hide();
            $('#profileDetails').show();
        });
 
    });
 
</script>
<script>
    $('#transaction-filtersbtn').on('click', function() {
    // Gather parameter values
    let txnType = $('#transaction-type').val();
    let fromDate = $('#from-date').val();
    let toDate = $('#to-date').val();
    let offset = 0; // Start offset
    let limit = 100; // As per MAX_ROW_LIMIT
    
    let url = txnType === 'BONUS_DETAILS'
        ? '/account/getBonusDetails'
        : '/account/getTransactionDetails';
    
    $.ajax({
        method: 'POST',
        url: url,
        data: {
            txnType, fromDate, toDate, offset, limit,
            _token: '{{ csrf_token() }}'
        },
        success: function(resp) {
            // Hide all tables
            $('#transaction-table, #bonus-table, #ticket-table, #wager-table, #dwwr-table').hide();
            // Populate and show correct table
            if (txnType == 'BONUS_DETAILS') {
                populateBonusTable(resp.response);
                $('#bonus-table').show();
            } else if (txnType == 'TICKET_DETAILS') {
                populateTicketTable(resp.response);
                $('#ticket-table').show();
            } else if (txnType == 'PLR_WAGER') {
                populateWagerTable(resp.response);
                $('#wager-table').show();
            } else if (txnType == 'PLR_DEPOSIT' || txnType == 'PLR_WINNING' || txnType == 'PLR_WAGER_REFUND') {
                populateDWWRTable(resp.response);
                $('#dwwr-table').show();
            } else {
                populateTransactionTable(resp.response);
                $('#transaction-table').show();
            }
        }
    });
});

function populateBonusTable(response) {
    let tbody = $('#bonus-table tbody');
    tbody.empty();

    // Check for bonusList presence
    if (!response || !response.bonusList || response.bonusList.length === 0) {
        tbody.append('<tr><td colspan="9">No Bonus Found.</td></tr>');
        return;
    }

    response.bonusList.forEach(function(item) {
        let receivedDate = formatDateTime(item.receivedDate);
        let expiredDate = formatDate(item.expiredDate);
        if (expiredDate && expiredDate.includes('3000')) expiredDate = 'NONE';

        let row = `
            <tr>
                <td>${receivedDate}</td>
                <td>${item.bonusCode || ''}</td>
                <td>${item.amount || ''}</td>
                <td>${item.target || ''}</td>
                <td>${item.contribution || ''}</td>
                <td>${item.redeemedAmount || ''}</td>
                <td>${item.bonusCriteria || ''}</td>
                <td>${expiredDate}</td>
                <td>${item.status || ''}</td>
            </tr>
        `;
        tbody.append(row);
    });
}

function populateTicketTable(response) {
    let tbody = $('#ticket-table tbody');
    tbody.empty();

    if (!response || !response.ticketList || response.ticketList.length === 0) {
        tbody.append('<tr><td colspan="6">No Ticket Details Found For Selected Date Range.</td></tr>');
        return;
    }

    response.ticketList.forEach(function(item) {
        let ticketDate = formatDate(item.receivedDate);
        let expiryDate = formatDate(item.expiredDate);
        if (expiryDate && expiryDate.includes('3000')) expiryDate = 'NONE';

        let row = `
            <tr>
                <td>${ticketDate}</td>
                <td>${item.ticketCode || ''}</td>
                <td>${item.ticketCount || ''}</td>
                <td>${item.pendingTickets || ''}</td>
                <td>${expiryDate}</td>
                <td>${item.status || ''}</td>
            </tr>
        `;
        tbody.append(row);
    });
}


function populateWagerTable(response) {
    let tbody = $('#wager-table tbody');
    tbody.empty();

    if (!response || !response.txnList || response.txnList.length === 0) {
        tbody.append('<tr><td colspan="5">No Wager Data Found.</td></tr>');
        return;
    }

    response.txnList.forEach(function(item, index) {
        let txndate = formatDate(item.transactionDate);
        let row = `
            <tr>
                <td>${index + 1}</td>
                <td>${txndate}</td>
                <td>${item.transactionId || ''}</td>
                <td>${item.particular || ''}</td>
                <td>${item.txnAmount || ''}</td>
            </tr>
        `;
        tbody.append(row);
    });
}


function populateDWWRTable(response) {
    let tbody = $('#dwwr-table tbody');
    tbody.empty();

    if (!response || !response.txnList || response.txnList.length === 0) {
        tbody.append('<tr><td colspan="5">No Data Found For Selected Transaction Type.</td></tr>');
        return;
    }

    response.txnList.forEach(function(item, index) {
        let txndate = formatDate(item.transactionDate);
        let amount = item.creditAmount || item.debitAmount || '';
        let row = `
            <tr>
                <td>${index + 1}</td>
                <td>${txndate}</td>
                <td>${item.transactionId || ''}</td>
                <td>${item.particular || ''}</td>
                <td>${amount}</td>
            </tr>
        `;
        tbody.append(row);
    });
}


function populateTransactionTable(response) {
    let tbody = $('#transaction-table tbody');
    tbody.empty();

    if (!response || !response.txnList || response.txnList.length === 0) {
        tbody.append('<tr><td colspan="7">No Transaction Details Found For Selected Date Range.</td></tr>');
        return;
    }

    response.txnList.forEach(function(item, index) {
        let txndate = formatDate(item.transactionDate);
        let balance = item.balance ? formatCurrency(item.balance) : '';
        let row = `
            <tr>
                <td>${index + 1}</td>
                <td>${txndate}</td>
                <td>${item.transactionId || ''}</td>
                <td>${item.particular || ''}</td>
                <td>${item.creditAmount || ''}</td>
                <td>${item.debitAmount || ''}</td>
                <td>${balance}</td>
            </tr>
        `;
        tbody.append(row);
    });
}

function formatDate(dateStr) {
    if (!dateStr) return '';
    let d = dateStr.split(' ');
    let t = dateStr.split(' ')[1] || '';
    if (d.includes('-')) {
        let parts = d.split('-');
        if (parts.length === 3) {
            return parts + '/' + parts[1] + '/' + parts + (t ? (' ' + t) : '');
        }
    }
    if (d.includes('/')) return d + (t ? (' ' + t) : '');
    return dateStr;
}

function formatDateTime(dtStr) {
    if (!dtStr) return '';
    let tmp = dtStr.indexOf('.');
    if (tmp !== -1) dtStr = dtStr.substring(0, tmp);
    return formatDate(dtStr);
}

function formatCurrency(val) {
    if (!val) return '';
    val = parseFloat(val).toFixed(2);
    return val.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


</script>

<script>
    document.querySelectorAll('.wallet-tab').forEach(tab => {
        tab.onclick = function(e) {
            e.preventDefault();
            document.querySelectorAll('.wallet-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.wallet-content').forEach(c => c.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(tab.getAttribute('data-wallet')).classList.add('active');
        };
    });

    document.getElementById('deposit-form').onsubmit = function(e) {
        e.preventDefault();
        let method = document.querySelector('input[name="depositMethod"]:checked');
        let amount = document.getElementById('deposit-amount').value;
        if (!method || !amount) {
            document.getElementById('deposit-error').innerText = "Select method and enter valid amount."; document.getElementById('deposit-error').style.display='block';
            return;
        }
        document.getElementById('deposit-error').style.display='none';
        fetch('{{ route('account.requestCashierDeposit') }}', {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type':'application/json'},
            body: JSON.stringify({payTypeCode: method.value, deposit: amount})
        }).then(r => r.json()).then(resp => {
            if(resp.errorCode==0) alert('Deposit Success');
            else document.getElementById('deposit-error').innerText = resp.respMsg;
        });
    };

    document.getElementById('withdraw-form').onsubmit = function(e) {
        e.preventDefault();
        let method = document.querySelector('input[name="withdrawMethod"]:checked');
        let amount = document.getElementById('withdraw-amount').value;
        if (!method || !amount) {
            document.getElementById('withdraw-error').innerText = "Select method and enter valid amount."; document.getElementById('withdraw-error').style.display='block';
            return;
        }
        document.getElementById('withdraw-error').style.display='none';
        fetch('{{ route('account.requestWithdrawalDetails') }}', {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type':'application/json'},
            body: JSON.stringify({paymentTypeId: method.value, amount: amount})
        }).then(r => r.json()).then(resp => {
            if(resp.errorCode==0) alert('Withdrawal Success');
            else document.getElementById('withdraw-error').innerText = resp.respMsg;
        });
    };

    document.querySelectorAll('.btn-cancel').forEach(button => {
        button.onclick = function() {
            fetch('{{ route('account.cancelPendingWithdrawal') }}', {
                method: 'POST',
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type':'application/json'},
                body: JSON.stringify({transactionId: button.dataset.id, cancelAmount: button.dataset.amount})
            }).then(r=>r.json()).then(resp=>{
                if(resp.errorCode==0) alert('Withdrawal Cancelled');
                else alert(resp.respMsg);
            });
        };
    });

    // For GET PIN button, (simulate PIN fetch)
    document.querySelectorAll('.btn-getpin').forEach(button => {
        button.onclick = function() {
            let pinSpan = document.getElementById('pin-' + button.dataset.id);
            if(pinSpan) pinSpan.style.display = 'inline';
        };
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

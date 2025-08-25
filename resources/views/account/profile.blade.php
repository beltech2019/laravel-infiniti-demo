@extends('layouts.app')

@section('content')
<div class="account-container">
    <!-- Sidebar -->
    <div class="account-sidebar">
    <h3>My Account</h3>
        <ul>
            <li class="active"><a href="#">🌐 My Profile</a></li>
            <li><a href="#">🎟 My Tickets</a></li>
            <li><a href="#">👛 My Wallet</a></li>
            <li><a href="#">💳 My Transaction</a></li>
            <li><a href="#">📥 Inbox</a></li>
            <li><a href="#">🌍 Refer a Friend</a></li>
        </ul>
    </div>

    <!-- Profile Content -->
    <div class="account-content">
        <!-- Top Banner -->
        <div class="profile-banner">
            <div class="profile-pic"></div>
            <div class="profile-info">
                <h3>Mr. Player</h3>
                <p>{{authUserName()}}</p>
            </div>
        </div>

        <!-- Details -->
        <div class="profile-details">
            <div class="detail-row">
                <span>📞</span>
                <p>{{authUserName()}}</p>
            </div>
            <div class="detail-row">
                <span>🌍</span>
                <p>United Arab Emirates</p>
            </div>
            <div class="detail-row">
                <span>🔒</span>
                <p>Password</p>
                <button class="btn-change">Change</button>
            </div>

            <button class="btn-update">Update Details</button>
        </div>
    </div>
</div>

<style>
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
</style>
@endsection

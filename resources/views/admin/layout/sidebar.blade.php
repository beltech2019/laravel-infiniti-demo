<div id="sidebar" class="sidebar expanded">
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-home"></i><span class="menu-text"> Dashboard</span>
    </a>

    <a href="{{ route('admin.games.index') }}" class="{{ request()->routeIs('admin.games.*') ? 'active' : '' }}">
        <i class="fas fa-gamepad"></i><span class="menu-text"> Games Configration</span>
    </a>

    <a href="{{ route('admin.banners.index') }}" class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
        <i class="fas fa-image"></i><span class="menu-text"> Banners Configration</span>
    </a>

    <a href="{{ route('admin.languages.index') }}" class="{{ request()->routeIs('admin.languages.*') ? 'active' : '' }}">
        <i class="fas fa-language"></i><span class="menu-text"> Language Configration</span>
    </a>

    <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
        <i class="fas fa-newspaper"></i><span class="menu-text"> Articles Configration</span>
    </a>

    <a href="{{ route('admin.faqs.index') }}" class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
        <i class="fas fa-question-circle"></i><span class="menu-text"> FAQ Configration</span>
    </a>

    <a href="{{ route('admin.responsibleGamingConfig') }}" class="{{ request()->routeIs('admin.responsibleGamingConfig') ? 'active' : '' }}">
        <i class="fas fa-shield-alt"></i><span class="menu-text"> Responsible Gaming</span>
    </a>

    <a href="{{ route('admin.privacyPolicyConfig') }}" class="{{ request()->routeIs('admin.privacyPolicyConfig') ? 'active' : '' }}">
        <i class="fas fa-user-shield"></i><span class="menu-text"> Privacy Policy</span>
    </a>

    <a href="{{ route('admin.termsandconditionConfig') }}" class="{{ request()->routeIs('admin.termsandconditionConfig') ? 'active' : '' }}">
        <i class="fas fa-file-contract"></i><span class="menu-text"> Terms & Conditions</span>
    </a>
</div>

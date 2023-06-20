<ul class="nav navbar-nav side-nav nicescroll-bar">
     <li>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><div class="pull-left"><i class="ti-dashboard mr-20"></i><span class="right-nav-text">Dashboard</span></div><div class="clearfix"></div></a>
    </li>
    <li>
        <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}"><div class="pull-left"><i class="ti-user mr-20"></i><span class="right-nav-text">Users</span></div><div class="clearfix"></div></a>
    </li>
    <li>
        <a href="{{ route('admin.documents') }}" class="{{ request()->routeIs('admin.documents') ? 'active' : '' }}"><div class="pull-left"><i class="ti-id-badge mr-20"></i><span class="right-nav-text">Verifications</span></div><div class="clearfix"></div></a>
    </li>
    <li>
        <a href="{{ route('admin.billing') }}" class="{{ request()->routeIs('admin.billing') ? 'active' : '' }}"><div class="pull-left"><i class="ti-layout-media-overlay-alt-2 mr-20"></i><span class="right-nav-text">Billing</span></div><div class="clearfix"></div></a>
    </li>
    <li>
        <a href="{{ route('admin.reviews') }}" class="{{ request()->routeIs('admin.reviews') ? 'active' : '' }}"><div class="pull-left"><i class="ti-clipboard mr-20"></i><span class="right-nav-text">Reviews</span></div><div class="clearfix"></div></a>
    </li>
    <li>
        <a href="{{ route('admin.transactions') }}" class="{{ request()->routeIs('admin.transactions') ? 'active' : '' }}"><div class="pull-left"><i class=" ti-wallet mr-20"></i><span class="right-nav-text">Transactions</span></div><div class="clearfix"></div></a>
    </li>
    <li>
        <a href="{{ route('admin.booking') }}" class="{{ request()->routeIs('admin.booking') ? 'active' : '' }}"><div class="pull-left"><i class="ti-calendar mr-20"></i><span class="right-nav-text">Bookings</span></div><div class="clearfix"></div></a>
    </li>
    <li>
       <a href="{{ route('admin.testimonials') }}" class="{{ request()->routeIs('admin.testimonials') ? 'active' : '' }}"><div class="pull-left"><i class="icon-book-open mr-20"></i></i><span class="right-nav-text">Testimonials</span></div><div class="clearfix"></div></a>
    </li>
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#comp_dr"><div class="pull-left"><i class="ti-settings mr-20"></i><span class="right-nav-text">Settings</span></div><div class="pull-right"><i class="ti-angle-down "></i></div><div class="clearfix"></div></a>
        <ul id="comp_dr" class="collapse collapse-level-1">
            <li>
                <a href="{{ route('account.settings.change_password') }}">Change Password</a>
            </li>
            <li>
                <a href="{{ route('account.profile') }}">Update Profile</a>
            </li>
        </ul>
    </li>
</ul>
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

    @php
        $setting = App\Models\SiteSetting::first();
    @endphp
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{url('')}}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{storage::url($setting->main_logo)}}" alt="passyoupermit"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">{{Str::limit($setting->site_title, 10)}}</span>
            <!--end::Brand Text-->s
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
           

          
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.enrollment.index') }}" class="nav-link {{ request()->routeIs('admin.enrollment.index') ? 'active' : '' }}">
            <i class="nav-icon bi bi-check2-circle"></i>
            <p>
                Enrollments
            </p>
        </a>
    </li>
   <li class="nav-item">
        <a href="{{ route('admin.transaction.index') }}" class="nav-link {{ request()->routeIs('admin.transaction.index') ? 'active' : '' }}">
             
            <i class="nav-icon bi bi-currency-dollar"></i>
            <p>
                Transactions
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('settings.site_settings') }}" class="nav-link {{ request()->routeIs('settings.site_settings') ? 'active' : '' }}">
            <i class="nav-icon bi bi-gear"></i>
            <p>
                Settings
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.index') ? 'active' : '' }}">
            <i class="nav-icon bi bi-book"></i>
            <p>
                Courses
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-newspaper"></i>
            <p>
                Blog Posts
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('sliders.index') }}" class="nav-link {{ request()->routeIs('sliders.index') ? 'active' : '' }}">
            <i class="nav-icon bi bi-images"></i>
            <p>
                Home Slider
            </p>
        </a>
    </li>
   <li class="nav-item">
    <a href="{{ route('admin.legal.index') }}" class="nav-link {{ request()->routeIs('admin.legal.index') ? 'active' : '' }}">
        <i class="nav-icon bi bi-file-earmark-text"></i>  <!-- Icon for Terms & Conditions -->
        <p>Term & Condition</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('admin.contacts') }}" class="nav-link {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
        <i class="nav-icon bi bi-telephone"></i>  <!-- Icon for Contacts -->
        <p>Contacts</p>
    </a>
</li>

</ul>

            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
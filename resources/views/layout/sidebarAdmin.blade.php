<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li>
            <a class="nav-link {{ request()->routeIs('admin.dashboard.admin') ? '' : 'collapsed' }}"
                href="{{ route('admin.dashboard.admin') }}">
                <i class="bi bi-grid"></i><span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li>
            <a class="nav-link {{ request()->routeIs('landing-page.index') ? '' : 'collapsed' }}" href="#">
                <i class="bi bi-person"></i><span>Landing Page</span>
            </a>
        </li>

        <li>
            <a class="nav-link {{ request()->routeIs('faq.index') ? '' : 'collapsed' }}" href="#">
                <i class="bi bi-person"></i><span>FAQ</span>
            </a>
        </li>

        <li>
            <a class="nav-link {{ request()->routeIs('policy.index') ? '' : 'collapsed' }}" href="#">
                <i class="bi bi-person"></i><span>Public & Policy</span>
            </a>
        </li>

        <li>
            <a class="nav-link {{ request()->routeIs('term-and-condition.index') ? '' : 'collapsed' }}" href="#">
                <i class="bi bi-person"></i><span>Terms & Conditions</span>
            </a>
        </li>

        <li>
            <a class="nav-link {{ request()->routeIs('user.index') ? '' : 'collapsed' }}"
                href="{{ route('user.index') }}">
                <i class="bi bi-person"></i><span>User</span>
            </a>
        </li>

        <li>
            <a class="nav-link {{ request()->routeIs('admin.profile') ? '' : 'collapsed' }}"
                href="{{ route('admin.profile') }}">
                <i class="bi bi-person"></i><span>Profile</span>
            </a>
        </li>

        <li>
            <a class="nav-link collapsed" data-bs-target="#data-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-database"></i><span>Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="data-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li><a href="{{ route('admin.groupConsolidation') }}"><i class="bi bi-circle"></i><span>Group
                            Consolidation</span></a></li>
                <li><a href="{{ route('admin.dataConsolidation') }}"><i class="bi bi-circle"></i><span>Data
                            Consolidation</span></a></li>
                <li><a href="{{ route('admin.companyOwnership') }}"><i class="bi bi-circle"></i><span>Company
                            Ownership</span></a></li>
                <li><a href="{{ route('admin.sra.index') }}"><i class="bi bi-circle"></i><span>SRA</span></a></li>
            </ul>
        </li><!-- End Data Nav -->

        <li>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="nav-link collapsed btn w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i><span>Logout</span>
                </button>
            </form>
        </li>

    </ul>
</aside>
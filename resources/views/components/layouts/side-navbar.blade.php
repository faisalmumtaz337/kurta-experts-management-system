<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <p class="sidebar-menu-title">Main Menu</p>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fa-solid fa-chart-line mr-3"></i>
            <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('customers.*') || request()->routeIs('measurements.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('customers.index') }}">
            <i class="fa-solid fa-users mr-3"></i>
            <span class="menu-title">Customers</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('orders.*') || request()->routeIs('orders.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('orders.index') }}">
            <i class="fa-solid fa-paper-plane mr-3"></i>
            <span class="menu-title">Orders</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('employees.*') || request()->routeIs('employees.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('employees.index') }}">
            <i class="fa-solid fa-address-book mr-3"></i>
            <span class="menu-title">Employees</span>
            </a>
        </li>
        <li class="nav-item 
            {{ request()->routeIs('payments.*') 
                || request()->routeIs('employee-payments.*') 
                || request()->routeIs('employee-works.*')
                || request()->routeIs('pending-dues')
                ? 'active' : '' }}">
            
            <a class="nav-link" href="{{ route('payments.index') }}">
                <i class="fa-solid fa-coins mr-3"></i>
                <span class="menu-title">Payments</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fa-solid fa-user-group mr-3"></i>
            <span class="menu-title">Users</span>
            </a>
        </li>
    </ul>
</nav>
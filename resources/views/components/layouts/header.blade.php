<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center pl-2 pr-2">
        <a href="{{ route('dashboard') }}"><img width="55" height="53" src="{{ asset('images/logo.png') }}" alt="logo"/></a>
    
        <h1 class="logo-title">Kurta Experts</h1>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
            <span class="nav-profile-name text-white">{{ Auth::user()->name }}</span>
            {{-- Profile Image --}}
            <img class="ml-2" src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="image" style="box-shadow: none;" />
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" id="customLogout" style="cursor: pointer;">
                <i class="typcn typcn-power icon-color"></i> Logout
                <form id="logoutForm" class="hidden" action="{{route('logout')}}" method="post">
                @csrf
                <input id="submitBtn" type="submit" style="display: none;">
                </form>
            </a>
            </div>
        </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center text-light" type="button" data-toggle="offcanvas">
        <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>
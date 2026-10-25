<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" style="background: #70a9eb !important;" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
                    <span class="login-status online"></span>
                    <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                    <span class="text-small">{{ Auth::user()->email }}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge text-dark"></i>
            </a>
        </li>
        @if(auth()->user()->role_id != 3)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title fw-bold">Dashboard</span>
                <i class="mdi mdi-home menu-icon text-dark"></i>
            </a>
        </li>
          @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <span class="menu-title fw-bold">Users</span>
                    <i class="mdi mdi-account-multiple menu-icon text-dark"></i>
                </a>
            </li>
            @endif
        
                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('ticket-types.index') }}">
                        <span class="menu-title fw-bold">Tickets</span>
                        <i class="mdi mdi-ticket menu-icon text-dark"></i>
                    </a>
                </li>
                @endif
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.show', Auth::user()->id) }}">
                <span class="menu-title fw-bold">My Profile</span>
                <i class="mdi mdi-account-circle menu-icon text-dark"></i>
            </a>
        </li>     
        <li class="nav-item">
            <a class="nav-link" href="{{ route('events.index') }}">
                <span class="menu-title fw-bold">Events</span>
                <i class="mdi mdi-calendar menu-icon text-dark"></i>
            </a>
        </li>   
        <li class="nav-item">
            <a class="nav-link" href="{{ route('bookings.index') }}">
                <span class="menu-title fw-bold">My Bookings</span>
                <i class="mdi mdi-ticket-confirmation menu-icon text-dark"></i>
            </a>
        </li>
       
    </ul>
</nav>
<!-- partial -->
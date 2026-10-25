<!-- Custom Function to add active class to the current route -->
@php
    function activeLink($route_name) {
        return request()->routeIs("$route_name") ? 'active' : "";
    }
@endphp

<!-- ==========================================
         START: Sidebar Component
         Highly polished, dark-green sticky navigation
         ========================================== -->
  <div class="sidebar-wrapper" id="sidebar">
    <!-- Brand Logo / Identity -->
    <a href="index.html" class="sidebar-brand">
      <i class="bi bi-asterisk"></i>
      <span>Spark Admin</span>
    </a>

    <!-- Navigation Menu -->
    <div class="flex-grow-1 overflow-y-auto">
      @if(auth()->user()->role_id != 5)
      <!-- Group: Menu -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">Menu</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('dashboard') }}" 
            {{-- class="sidebar-menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" id="menu-overview" title="Overview"> --}}
            class="sidebar-menu-link {{ activeLink('dashboard') }}" id="menu-overview" title="Overview">
              <i class="bi bi-grid-fill"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- Group: Components -->
      <div class="sidebar-menu-section">
        <div class="sidebar-menu-title">System</div>
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('users.index') }}" 
            {{-- class="sidebar-menu-link {{ request()->routeIs('users*') ? 'active' : '' }}" id="menu-basictables" title="Basic Tables"> --}}
            class="sidebar-menu-link {{ activeLink('users*') }}" id="menu-basictables" title="Basic Tables">
              <i class="bi bi-person"></i>
              <span>Users</span>
            </a>
          </li>          
          <li class="sidebar-menu-item">
            <a href="{{ route('roles.index') }}" 
            class="sidebar-menu-link {{ activeLink('roles*') }}" id="menu-basictables" title="Basic Tables">
              <i class="bi bi-list"></i>
              <span>Roles</span>
            </a>
          </li>          
          <li class="sidebar-menu-item">
            <a href="{{ route('products.index') }}" 
            {{-- class="sidebar-menu-link {{ request()->routeIs('products*') ? 'active' : '' }}" --}}
            class="sidebar-menu-link {{ activeLink('products*') }}" id="menu-uiforms" title="Forms and Input">
              <i class="bi bi-input-cursor-text"></i>
              <span>Products</span>
            </a>
          </li>
        </ul>
      </div>
      @else
      <div class="sidebar-menu-section">
        <ul class="sidebar-menu-list">
          <li class="sidebar-menu-item">
            <a href="{{ route('users.show', ['user' => auth()->user()->id]) }}" 
            class="sidebar-menu-link {{ activeLink('users.show') }}" id="menu-overview" title="Overview">
              <i class="bi bi-person"></i>
              <span>Your Profile</span>
            </a>
          </li>
          <li class="sidebar-menu-item">
            <a href="{{ route('users.edit', ['user' => auth()->user()->id]) }}" 
            class="sidebar-menu-link {{ activeLink('users.edit') }}" id="menu-overview" title="Overview">
              <i class="bi bi-pencil"></i>
              <span>Edit Profile</span>
            </a>
          </li>
        </ul>
      </div>
      @endif

    </div>

    <!-- Sidebar Profile Card (Dynamic Footer) -->
    <div class="sidebar-profile">
      <img src="assets/images/avatar.png" alt="Administrator" class="sidebar-profile-img"
        onerror="this.src='https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=256&auto=format&fit=crop'">
      <div class="sidebar-profile-info">
        <div class="sidebar-profile-name">{{auth()->user()->name}}</div>
        <div class="sidebar-profile-email">{{auth()->user()->email}}</div>
      </div>
    </div>
  </div>
  <!-- ==========================================
         END: Sidebar Component
         ========================================== -->

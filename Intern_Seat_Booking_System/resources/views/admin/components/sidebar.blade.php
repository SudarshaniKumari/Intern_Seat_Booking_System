  <!-- Sidebar Start -->
  <div class="container-xxl position-relative bg-white d-flex p-0">
      <div class="sidebar pe-4 pb-3">
          <nav class="navbar  navbar-light">


              <div class="d-flex align-items-center ms-4 mb-4">
                  <div class="position-relative">
                      <img class="rounded-circle" src="{{ asset('assets/img/home/testimonial-1.jpg') }}" alt="" style="width: 40px; height: 40px;">
                      <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                  </div>
                  <div class="ms-3">
                      <span class="d-none d-lg-inline-flex">{{ Auth::user()->first_name }}</span>
                  </div>
              </div>
              
              <div class="navbar-nav w-100">
                  <a href="{{ route('admin.dashboard') }}" class="nav-item nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                      <i class="fa fa-tachometer-alt me-2"></i> Dashboard
                  </a>
                  <a href="{{ route('admin.users.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                      <i class="fa fa-user me-2" aria-hidden="true"></i> Users
                  </a>

                  <a href="{{ route('admin.seats.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.seats.*') ? 'active' : '' }}"><i class="fas fa-chair me-2"></i>Seats</a>
                  <a href="{{ route('admin.bookings.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.bookings.index') ? 'active' : '' }}"><i class="fa fa-book me-2" aria-hidden="true"></i>Bookings</a>
                  <a href="{{ route('admin.attendance.index') }}" class="nav-item nav-link {{ request()->routeIs('admin.attendance.index') ? 'active' : '' }}"><i class="fa-solid fa-user-clock me-2"></i>Attendance</a>
                  <a href="{{ route('admin.profile') }}" class="nav-item nav-link {{ request()->routeIs('admin.profile', 'admin.profile.edit') ? 'active' : '' }}">
                      <i class="fa-solid fa-user me-2"></i>My Profile
                  </a>

                  <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="nav-item nav-link"><i class="fas fa-sign-out me-2"></i>Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>


              </div>
          </nav>
      </div>
  </div>
  <!-- Sidebar End -->
  <!-- Sidebar Start -->
  <div class="container-xxl position-relative bg-white d-flex p-0">
      <div class="sidebar pe-4 pb-3">
          <nav class="navbar  navbar-light">
            
              <div class="d-flex align-items-center ms-4 mb-4">
                  
                  <div class="ms-3">
                  <img class="rounded-circle me-lg-2" src="{{ asset('../../../assets/img/home/testimonial-1.jpg') }}" alt="" style="width: 40px; height: 40px;">  
               <span class="d-none d-lg-inline-flex"> <strong>{{ Auth::user()->first_name }}</strong></span>
                  </div>
              </div>
              <div class="navbar-nav w-100">
                  <a href="{{ route('user.home') }}" class="nav-item nav-link {{ request()->routeIs('user.home') ? 'active' : '' }}">
                      <i class="fa fa-tachometer-alt me-2"></i> Dashboard
                  </a>
                  <a href="{{ route('user.seats.index') }}" class="nav-item nav-link {{ request()->routeIs('user.seats.index', 'user.seats.show', 'user.seats.create', 'user.seats.edit') ? 'active' : '' }}">
    <i class="fas fa-chair me-2"></i>Booking
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
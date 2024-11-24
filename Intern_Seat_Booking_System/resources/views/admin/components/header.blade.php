 <!-- Navbar Start -->

 <nav class="navbar navbar-expand  sticky-top px-4 py-0" style="background-color:white;">

      <a href="#" class="sidebar-toggler flex-shrink-0">
           <i class="fa fa-bars"></i>
      </a>

      <div class="navbar-nav align-items-center ms-auto">
           <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                     <i class="fa fa-bell me-lg-2 position-relative">
                          <!-- Notification count badge -->
                          @if(auth()->user()->unreadNotifications->count() > 0)
                          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                               {{ auth()->user()->unreadNotifications->count() }}
                          </span>
                          @endif
                     </i>
                     <span class="d-none d-lg-inline-flex">Notification</span>
                </a>

                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                     <!-- Loop through unread notifications -->
                     @foreach(auth()->user()->unreadNotifications as $notification)
                     <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="dropdown-item" style="border: none; background: none; padding: 0; text-align: left;">
                               <span style="display: flex; flex-direction: column;">
                                    <span>{{ $notification->data['message'] }}</span>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                               </span>
                          </button>
                     </form>
                     @endforeach



                     <!-- Check if there are no unread notifications -->
                     @if(auth()->user()->unreadNotifications->isEmpty())
                     <div class="dropdown-item text-center">No new user Register </div>
                     @endif



                </div>
           </div>


           <!-- <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                     <img class="rounded-circle" src="{{ asset('assets/img/home/testimonial-1.jpg') }}" alt="" style="width: 40px; height: 40px;">
                     <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">

                     <span class="d-none d-lg-inline-flex">{{ Auth::user()->first_name }}</span>
                </div>
           </div> -->


           <!-- <div class="nav-item ">
                <a href="#" class="nav-link ">
                     <img class="rounded-circle me-lg-2" src="{{ asset('assets/img/home/testimonial-1.jpg') }}" alt="" style="width: 40px; height: 40px;">
                     <span class="d-none d-lg-inline-flex">{{ Auth::user()->first_name }}</span>
                </a>

           </div> -->
      </div>
 </nav>

 <!-- Navbar End -->
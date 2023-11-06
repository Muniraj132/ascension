     <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <a href="{{url('home')}}" class="brand-link">
        <center>
          <p>Admin</p>
        </center>
    </a>
    <div class="os-content" style="padding: 0px 8px;height: 100%;width: 100%;background-color: #a10000;">
         <div class="sidebar">
             <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                     <li class="nav-item">
                        <a href="{{url('home')}}" class="nav-link">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>
                              Dashboard
                            </p>
                        </a>
                      </li>

                      <li class="nav-item">
                          <a href="{{url('massbooking')}}" class="nav-link">
                            <i class="fas fa-book"></i>
                            <p>
                             Intention List
                            </p>
                          </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{url('payment')}}" class="nav-link">
                        <i class="fas fa-rupee-sign"></i>
                        <p>Mass Payments</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{url('donation')}}" class="nav-link">
                        <i class="fas fa-hand-holding-heart"></i>
                        <p>Donation</p>
                        </a>
                      </li>

                      <li class="nav-item">
                        <a href="{{url('donor')}}" class="nav-link">
                        <i class="fas fa-hand-holding-usd"></i>
                        <p>Donation Payments</p>
                        </a>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();" class="nav-link">
                            <i class="fas fa-user"></i>
                              {{ __('Logout') }}
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form> 
                      </li>
                 </ul>
             </nav>
        </div>
     </div>
</aside>
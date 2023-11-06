  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <ul class="navbar-nav">
        <img src="{{asset('images/bg-01.jpg')}}"style="" alt="Paris"  width="50px"
          height="41px";>
          <li class="nav-item d-none d-sm-inline-block">
           <p style="font-size:20px; font-weight: 1000;padding: 5px 0 0 0;">&nbsp;&nbsp;Ascension Church</p>
          </li>
    </ul>
    <ul class="navbar-nav ml-auto">
       <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} 
                <span class="caret"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                               <i class="fas fa-user"></i>
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
      </li>  
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
     </li>
   </ul>
</nav>
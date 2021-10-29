<header class="header bg-white">
    <nav class="navbar navbar-static-top navbar-expand-lg header-sticky">
        <div class="container-fluid">
            <button id="nav-icon4" type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">
                <img class="img-fluid" src="{{ asset('frontend/images/'.config('services.logo')) }}" alt="logo">
            </a>
            <div class="navbar-collapse collapse justify-content-center">
                <ul class="nav navbar-nav">
                    <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tools<i class="fas fa-chevron-down fa-xs"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li  class="active"><a class="dropdown-item" href="{{ route('resume-builder') }}">Resume Builder</a></li>
                            <li><a class="dropdown-item" href="{{ route('cover-letters') }}">Cover Letters</a></li>
                            <li><a class="dropdown-item" href="{{ route('email-templates') }}">Email Templates</a></li>
                        </ul>
                    </li>

                    <li class="dropdown nav-item">
                        <a class="nav-link" href="{{ route('courses') }}" role="button" aria-haspopup="true" aria-expanded="false">Courses</a>
                    </li>
                    
                    <li class="dropdown nav-item">
                        <a class="nav-link" href="{{ route('pricing') }}" role="button"  aria-haspopup="true" aria-expanded="false">Pricing</a>
                        {{--<a class="nav-link" href="{{ route('pricing') }}" role="button"  aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">Pricing <i class="fas fa-chevron-down fa-xs"></i></a>--}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faqs') }}" role="button"  aria-haspopup="true" aria-expanded="false">FAQs</a>
                    </li>
                </ul>
            </div>
            <div class="add-listing afterlogmenu">
                <!-- <div class="login d-inline-block mr-4">
                  <a href="login.html" data-toggle="modal" data-target="#exampleModalCenter"><i class="far fa-user pr-2"></i>Sign in</a>
                </div> -->
                @if(Auth::guard('users')->check())
                    {{--<a class="btn btn-primary btn-md" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">Log out</a>--}}
                    <ul>
                      <li class="nav-item dropdown active">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi, {{ Auth::guard('users')->user()->name }} <i class="fas fa-chevron-down fa-xs"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="active" href="{{ route('dashboard-candidates') }}">Dashboard</a></li>
                          {{--<li><a href="{{ route('dashboard-candidates-resume-builder') }}">Resume Builder</a></li>
                          <li><a href="{{ route('dashboard-candidates-cover-letter') }}">Cover Letters</a></li>
                          <li><a href="{{ route('dashboard-candidates-email-templates') }}">Email Templates</a></li>--}}
                          <li><a href="{{ route('dashboard-candidates-my-profile') }}">My Profile</a></li>
                          <li><a href="{{ route('dashboard-candidates-pricing') }}">Pricing Plan</a></li>
                          <li><a href="{{ route('dashboard-candidates-change-password') }}">Change Password</a></li>
                          <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">Log Out</a></li>
                        </ul>
                      </li>
                    </ul>
                @else
                    <a class="btn btn-primary btn-md" href="#" data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-plus-circle"></i>Login / Register</a>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>
</header>
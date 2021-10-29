<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Job Boosts - Power your job search today" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | {{ config('app.name') }}</title>

    @include('layouts.frontend.includes.head')
    @yield('css')
    @yield('style')

</head>
<body>

<!--=================================
Header -->
@include('layouts.frontend.includes.header')
<!--=================================
Header -->
<div class="header-inner bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="candidates-user-info">
          <div class="jobber-user-info">
            <div class="profile-avatar">
              @if(!empty($image))
              @if($image->profile_picture != null)
              <img class="img-fluid" src="{{ asset('/frontend/images/user_profiles/'.$image->profile_picture) }}" alt="Profile">
              <i class="fas fa-pencil-alt"></i>
              @else
              <img class="img-fluid" src="{{ asset('/frontend/images/No-image-available.png') }}" alt="Profile">
              <i class="fas fa-pencil-alt"></i>
              @endif
              @endif
            </div>
            <div class="profile-avatar-info ml-4">
              <h3>
              @if(Auth::check())
                {{ Auth::guard('users')->user()->name }}
              @endif
              </h3>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="candidates-skills">
        </div>
      </div>
    </div>
  </div>
</div>
    
<!-- Profile Nav menu START -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="sticky-top secondary-menu-sticky-top">
          <div class="secondary-menu">
            <ul class="list-unstyled mb-0">
              <li><a class="{{ Request::path() == 'dashboard-candidates' ? 'active' : '' }}" href="{{ route('dashboard-candidates') }}">Dashboard</a></li>
              <li><a class="{{ Request::path() == 'dashboard-candidates-resume-builder' ? 'active' : '' }}" href="{{ route('dashboard-candidates-resume-builder') }}">Resume Builder</a></li>
              <li><a class="{{ Request::path() == 'dashboard-candidates-cover-letter' ? 'active' : '' }}" href="{{ route('dashboard-candidates-cover-letter') }}">Cover Letters</a></li>
              <li><a class="{{ Request::path() == 'dashboard-candidates-email-templates' ? 'active' : '' }}" href="{{ route('dashboard-candidates-email-templates') }}">Email Templates</a></li>
              <li><a class="{{ Request::path() == 'dashboard-candidates-my-profile' ? 'active' : '' }}" href="{{ route('dashboard-candidates-my-profile') }}">My Profile</a></li>
              <li><a class="{{ Request::path() == 'dashboard-candidates-pricing' ? 'active' : '' }}" href="{{ route('dashboard-candidates-pricing') }}">Pricing Plan</a></li>
              <li><a class="{{ Request::path() == 'dashboard-candidates-change-password' ? 'active' : '' }}" href="{{ route('dashboard-candidates-change-password') }}">Change Password</a></li>
              <li><a href="{{ route('logout') }}">Log Out</a></li>          
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@yield('content')

<!--=================================
    Footer-->
@include('layouts.frontend.includes.footer')
<!--=================================
Footer-->

<!--=================================
Back To Top-->
<div id="back-to-top" class="back-to-top">
    <i class="fas fa-angle-up"></i>
</div>
<!--=================================
Back To Top-->

<!--=================================
Signin Modal Popup -->
@include('frontend.auth.login')
@include('layouts.frontend.includes.popup')
<!--=================================
Signin Modal Popup -->

<!--=================================
Javascript -->
@yield('script-js-last')

@yield('script')

@include('layouts.frontend.includes.scripts')

</body>
</html>

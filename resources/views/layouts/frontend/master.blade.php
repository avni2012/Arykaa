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

@if(\Route::currentRouteName() != 'home' && \Route::currentRouteName() != 'choose-resume-template' && \Route::currentRouteName() != 'resumes' && \Route::currentRouteName() != 'update-resume-template' && \Route::currentRouteName() != 'dashboard-candidates' && \Route::currentRouteName() != 'dashboard-candidates-resume-builder' && \Route::currentRouteName() != 'dashboard-candidates-cover-letter' && \Route::currentRouteName() != 'dashboard-candidates-email-templates' && \Route::currentRouteName() != 'dashboard-candidates-my-profile' && \Route::currentRouteName() != 'dashboard-candidates-pricing' && \Route::currentRouteName() != 'dashboard-candidates-change-password' && \Route::currentRouteName() != 'dashboard-user-sesions' && \Route::currentRouteName() != 'dashboard-user-sesion-coaches')
    <!--=================================
inner banner -->
    @php
        if(\Route::currentRouteName() == 'contact-us') {
            $pagename = 'Contact Us';
        } else if(\Route::currentRouteName() == 'about-us') {
            $pagename = 'About Us';
        } else if(\Route::currentRouteName() == 'pricing') {
            $pagename = 'Pricing';
        } else if(\Route::currentRouteName() == 'resume-builder') {
            $pagename = 'Resume Builder';
        } else if(\Route::currentRouteName() == 'register.index') {
            $pagename = 'Register';
        } else if(\Route::currentRouteName() == 'faqs') {
            $pagename = 'FAQs';
        } else if(\Route::currentRouteName() == 'cover-letters') {
            $pagename = 'Cover Letters';
        } else if(\Route::currentRouteName() == 'register') {
            $pagename = 'Register';
        } else if(\Route::currentRouteName() == 'login') {
            $pagename = 'Login';
        } else if(\Route::currentRouteName() == 'forgot-password') {
            $pagename = 'Forgot Password';
        } else if(\Route::currentRouteName() == 'email-templates') {
            $pagename = 'Email Templates';
        } else if(\Route::currentRouteName() == 'two-days-pass') {
            $pagename = 'Two Days Pass';
        } else if(\Route::currentRouteName() == 'team') {
            $pagename = 'Team';
        } else if(\Route::currentRouteName() == 'blog') {
            $pagename = 'Blog';
        } else if(\Route::currentRouteName() == 'courses') {
            $pagename = 'Courses';
        } else if(\Route::currentRouteName() == 'password.reset') {
            $pagename = 'Reset Password';
        } else if(\Route::currentRouteName() == 'search-blog') {
            $pagename = 'Blog';
        } else if(\Route::currentRouteName() == 'blog-detail') {
            $pagename = 'Blog Details';
        } else if(\Route::currentRouteName() == 'privacy-policy') {
            $pagename = 'Privacy Policy';
        } else if(\Route::currentRouteName() == 'cms') {
            if(Request::route('slug') == 'terms-and-conditions') {
                $pagename = 'Terms and conditions';
            } else {
                $pagename = 'Privacy Policy';
            }
        }
    @endphp
    <div class="header-inner bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="@if(\Route::currentRouteName() == 'cover-letters') text-warning-cover @elseif(\Route::currentRouteName() == 'email-templates') text-success @else text-primary @endif"> {{ $pagename }} </h2>
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> Home </a></li>
                        @if(\Route::currentRouteName() == 'two-days-pass') 
                        <li class="breadcrumb-item"><a href="{{ route('pricing') }}">
                            <i class="fas fa-chevron-right"></i>
                            <span>{{ "Pricing" }}</span>
                        </a></li>
                        @endif
                        <li class="breadcrumb-item active">
                        <i class="fas fa-chevron-right"></i>
                        <span class="@if(\Route::currentRouteName() == 'cover-letters') text-warning-cover @elseif(\Route::currentRouteName() == 'email-templates') text-success @endif"> {{ $pagename }} </span></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--=================================
    inner banner -->
@endif

@yield('content')

@if(\Route::currentRouteName() != 'home' && \Route::currentRouteName() != 'choose-resume-template' && \Route::currentRouteName() != 'resumes' && \Route::currentRouteName() != 'update-resume-template' && \Route::currentRouteName() != 'dashboard-candidates' && \Route::currentRouteName() != 'dashboard-candidates-resume-builder' && \Route::currentRouteName() != 'dashboard-candidates-cover-letter' && \Route::currentRouteName() != 'dashboard-candidates-email-templates' && \Route::currentRouteName() != 'dashboard-candidates-my-profile' && \Route::currentRouteName() != 'dashboard-candidates-pricing' && \Route::currentRouteName() != 'dashboard-candidates-change-password' && \Route::currentRouteName() != 'two-days-pass' && \Route::currentRouteName() != 'team' && \Route::currentRouteName() != 'blog' && \Route::currentRouteName() != 'blog-detail' && \Route::currentRouteName() != 'password.reset' && \Route::currentRouteName() != 'dashboard-user-sesions' && \Route::currentRouteName() != 'dashboard-user-sesion-coaches')
    <!--=================================
    feature info section -->
    @if(\Route::currentRouteName() == 'cover-letters')
        <section class="feature-info-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="feature-info feature-info-02 p-4 p-lg-5 bg-warning">
                            <div class="feature-info-icon mb-3 mb-sm-0 text-dark">
                                <i class="flaticon-team"></i>
                            </div>
                            <div class="feature-info-content text-dark pl-sm-4 pl-0">
                                <p>Lorem Ipsum is simply dummy</p>
                                <h5 class="text-dark">Lorem Ipsum is simpl</h5>
                            </div>
                            <a class="ml-auto align-self-center text-dark" href="#">Sign Up<i class="fas fa-long-arrow-alt-right"></i> </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-info feature-info-02 p-4 p-lg-5 bg-warning-cover">
                            <div class="feature-info-icon mb-3 mb-sm-0 text-white">
                                <i class="flaticon-job-3"></i>
                            </div>
                            <div class="feature-info-content text-white pl-sm-4 pl-0">
                                <p>Lorem Ipsum is simply dummy</p>
                                <h5 class="text-white">Ready to take next level?</h5>
                            </div>
                            <a class="ml-auto align-self-center text-white" href="#">Sign Up<i class="fas fa-long-arrow-alt-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @elseif(\Route::currentRouteName() == 'email-templates')
        <section class="feature-info-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="feature-info feature-info-02 p-4 p-lg-5 bg-success">
                            <div class="feature-info-icon mb-3 mb-sm-0 text-dark">
                                <i class="flaticon-team"></i>
                            </div>
                            <div class="feature-info-content text-dark pl-sm-4 pl-0">
                                <p>Lorem Ipsum is simply dummy</p>
                                <h5 class="text-dark">Lorem Ipsum is simpl</h5>
                            </div>
                            <a class="ml-auto align-self-center text-dark" href="#">Sign Up<i class="fas fa-long-arrow-alt-right"></i> </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-info feature-info-02 p-4 p-lg-5 bg-success-dark">
                            <div class="feature-info-icon mb-3 mb-sm-0 text-white">
                                <i class="flaticon-job-3"></i>
                            </div>
                            <div class="feature-info-content text-white pl-sm-4 pl-0">
                                <p>Lorem Ipsum is simply dummy</p>
                                <h5 class="text-white">Ready to take next level?</h5>
                            </div>
                            <a class="ml-auto align-self-center text-white" href="#">Sign Up<i class="fas fa-long-arrow-alt-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="feature-info-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="feature-info feature-info-02 p-4 p-lg-5 bg-primary">
                            <div class="feature-info-icon mb-3 mb-sm-0 text-dark">
                                <i class="flaticon-team"></i>
                            </div>
                            <div class="feature-info-content text-white pl-sm-4 pl-0">
                                <p>Jobseeker</p>
                                <h5 class="text-white">Looking For Job?</h5>
                            </div>
                            <a class="ml-auto align-self-center" href="#">Apply now<i class="fas fa-long-arrow-alt-right"></i> </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-info feature-info-02 p-4 p-lg-5 bg-dark">
                            <div class="feature-info-icon mb-3 mb-sm-0 text-primary">
                                <i class="flaticon-job-3"></i>
                            </div>
                            <div class="feature-info-content text-white pl-sm-4 pl-0">
                                <p>Recruiter</p>
                                <h5 class="text-white">Are You Recruiting?</h5>
                            </div>
                            <a class="ml-auto align-self-center" href="#">Post a job<i class="fas fa-long-arrow-alt-right"></i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!--=================================
    feature info section -->
@endif

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

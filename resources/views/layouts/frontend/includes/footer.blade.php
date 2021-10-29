<footer class="footer mt-0">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-link">
                    <h5 class="text-dark mb-4">Job Seekers</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('resume-builder') }}">Resume Builder</a></li>
                        <li><a href="#">Cover Note</a></li>
                        <li><a href="#">Email Templates</a></li>
                        {{--<li><a href="#">Courses</a></li>--}}
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="footer-link">
                    <h5 class="text-dark mb-4">Resources</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li><a href="{{ route('faqs') }}">FAQs</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
                <div class="footer-link">
                    <h5 class="text-dark mb-4">About Us</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about-us') }}">Overview</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="{{ route('pricing') }}">Pricing</a></li>
                        <li><a href="{{ route('contact-us') }}">Contact</a></li>
                        <li><a href="{{ route('cms','terms-and-conditions') }}">Terms & Conditions </a></li>
                        <li><a href="#">Privacy Policy </a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="footer-contact-info bg-holder" style="background-image: url('{{ asset('frontend/images/google-map.png') }}');">
                    <h5 class="text-dark mb-4">Contact Us</h5>
                    <ul class="list-unstyled mb-0">
                        <li> <i class="fas fa-map-marker-alt text-primary"></i><span><a href="{{ config('services.google_map_link') }}" target="_blank">{{ config('services.web_address') }}</a></span> </li>
                        <li> <i class="fas fa-mobile-alt text-primary"></i><span><a href="tel:{{ preg_replace('/[^0-9]/', '', config('services.mob_no')) }}">{{ config('services.mob_no') }}</a></span> </li>
                        <li> <i class="far fa-envelope text-primary"></i><span><a href="mailto:{{ config('services.web_email') }}">{{ config('services.web_email') }}</a></span> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="border-bottom"></div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-8 text-center text-md-left">
                    <p class="mb-0"> &copy;Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span> <a href="{{ route('home') }}"> Job Boosts </a> All Rights Reserved </p>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="social d-flex justify-content-lg-end justify-content-center">
                        <ul class="list-unstyled">
                            <li class="facebook"><a href="{{ config('services.facebook_link') }}"><i class="fab fa-facebook"></i></a></li>
                            <li class="twitter"><a href="{{ config('services.twitter_link') }}"><i class="fab fa-twitter"></i></a></li>
                            <li class="linkedin"><a href="{{ config('services.linked_in_link') }}"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
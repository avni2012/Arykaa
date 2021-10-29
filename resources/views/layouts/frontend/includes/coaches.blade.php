<section class="space-ptb bg-holder" style="background-image: url('{{ asset('frontend/images/bg/05.jpg') }}'); ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="section-title mb-lg-0">
                    <h2 class="title text-white">Our Coaches</h2>
                    <p class="mb-0 text-white">Job Boosts is designed & developed  by Global Recruitment Professionals. Be guided by experts who have a combined experience of over 100 years in hiring people across the globe. </p>
                </div>
            </div>
            @if(count($coaches) > 0)
                <div class="col-lg-7">
                    <div class="owl-carousel owl-nav-bottom-center" data-nav-arrow="false" data-nav-dots="true" data-items="2" data-md-items="2" data-sm-items="2" data-xs-items="2" data-xx-items="1" data-space="15" data-autoheight="true">
                        @foreach($coaches as $coach)
                            <div class="item">
                                <div class="testimonial-item text-center employers-grid bg-white">
                                    <div class="avatar">
                                        <img class="img-fluid rounded-circle" src="{{ asset('frontend/images/avatar/'.$coach->display_image) }}" alt="">
                                    </div>
                                    <div class="testimonial-name">
                                        <h6 class="mb-1">{{ $coach->name }}</h6>
                                        {{--<span>{{ $coach->experience }} Years recruiting experience</span>--}}
                                        <span>{{ $coach->about_me }} </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</section>
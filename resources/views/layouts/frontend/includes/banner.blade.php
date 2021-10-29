<section class="clearfix slider-banner">
    <div id="slider" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider" data-slide-to="0" class="active"></li>
            <li data-target="#slider" data-slide-to="1"></li>
        </ol>

        <div class="carousel-inner">
            @foreach($images as $key => $image)
                <div class="carousel-item @if($key == 0) active @endif">
                    <img class="img-fluid" src="{{ asset('frontend/images/slider/'. $image->image) }}" alt="">
                    <div class="slider-content">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-sm-7 justify-content-center text-center">
                                    <!-- <h2 class="text-white animated-08"><u>Succeed in your Job Search</u></h2> -->
                                    @if($image->heading)<h1 class="text-white animated-08">{{ $image->heading }}</h1>@endif
                                    @if($image->small_desc)<h6 class="mb-2 font-weight-normal text-white animated-08">{!! $image->small_desc !!}</h6>@endif
                                    @if($image->button_text && $image->button_url)
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ $image->button_url }}" class="btn btn-primary animated-08">{{ $image->button_text }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--<div class="carousel-item">
                <img class="img-fluid" src="{{ asset('frontend/images/slider/banner-02.jpg') }}" alt="">
                <div class="slider-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-sm-7 justify-content-center text-center">
                                <!-- <h2 class="text-white animated-08"><u>Succeed in your Job Search</u></h2> -->
                                <h1 class="text-white animated-08">Stand Out in the crowd of Job applicants</h1>
                                <h6 class="mb-2 font-weight-normal text-white animated-08">Develop a killer elevator pitch, design your resume &  Identify your target companies & jobs.</h6>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-primary animated-08">View more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="{{ asset('frontend/images/slider/banner-01.jpg') }}" alt="">
                <div class="slider-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-sm-7 justify-content-center text-center">
                                <!-- <h2 class="text-white animated-08"><u>Succeed in your Job Search</u></h2> -->
                                <h1 class="text-white animated-08">Engage your own Job Search Coach</h1>
                                <h6 class="mb-2 font-weight-normal text-white animated-08">An experienced Job Coach works with you personally  tobuild your Job Search Strategy.</h6>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-primary animated-08">View more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="img-fluid" src="{{ asset('frontend/images/slider/banner-02.jpg') }}" alt="">
                <div class="slider-content">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-sm-7 justify-content-center text-center">
                                <!-- <h2 class="text-white animated-08"><u>Succeed in your Job Search</u></h2> -->
                                <h1 class="text-white animated-08">Get the interview call for your dream Job</h1>
                                <h6 class="mb-2 font-weight-normal text-white animated-08">Learn how to boost your profile, ace interviews & get that interview call.</h6>
                                <div class="d-flex justify-content-center">
                                    <a href="#" class="btn btn-primary animated-08">View more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
        <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
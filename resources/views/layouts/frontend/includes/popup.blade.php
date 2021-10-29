<div class="modal fade" id="forgetpassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content model-round">
            <div class="modal-body mx-2 p-0">
                <div class="model-close">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="py-2 col-md-12 mt-20 mt-3">
                    <div class="text-center mb-3">
                        <img src="{{ asset('/frontend/images/logo.svg') }}" alt="User" class="w-50 img-fluid">
                        <h5 class="modal-title w-100 font-weight-bold mt-3 mb-1">Forget Password</h5>
                        <p class="mb-3 f-18px opacity-70">Enter the email address associated with your account.</p>
                        <div class="login-register">
                            <div class="tab-content">
                                <div class="tab-pane active" id="forgetpassword" role="tabpanel">
                                    <form class="mt-1" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-12 text-left">
                                                <label for="Email2">Email Address</label><span class="text-danger">*</span>
                                                <input type="email" class="form-control" id="forget_email_id" placeholder="Enter Your Email Address" name="email" value="{{old('email')}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                @if (Route::has('password.request'))
                                                    <button class="btn btn-primary d-block w-100" type="submit">Send Password Reset Link
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="transactionSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered m-auto" role="document">
        <div class="modal-content model-round mx-2">
            <div class="modal-body mx-2 p-0">
                {{--<div class="model-close">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>--}}
                <div class="py-4 col-md-8 mt-20 m-auto">
                    <div class="text-center mb-3">
                        <img src="{{ asset('/frontend/images/logo.svg') }}" alt="Successfull Transaction" class="w-100 img-fluid">
                        <h5 class="modal-title w-100 sucess-con mt-4 mb-1">Success!</h5>
                        <p class="mb-5 f-18px">Thank you for your payment, we will notify you via email once we confirm your payment. </p>                      
                        <div class="w-75 m-auto">
                            <a class="btn btn-primary btn-md w-100 py-2" href="{{route('home')}}" id="successDone">Done</a>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
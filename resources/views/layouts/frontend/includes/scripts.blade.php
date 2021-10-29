<!-- JS Global Compulsory (Do not remove)-->
<script src="{{ asset('frontend/js/popper/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap/bootstrap.min.js') }}"></script>

<!-- Page JS Implementing Plugins (Remove the plugin script here if site does not use that feature)-->
<script src="{{ asset('frontend/js/jquery.appear.js') }}"></script>
<script src="{{ asset('frontend/js/counter/jquery.countTo.js') }}"></script>
<script src="{{ asset('frontend/js/owl-carousel/owl-carousel.min.js') }}"></script>

<!-- Template Scripts (Do not remove)-->
<script src="{{ asset('frontend/js/web/custom.js') }}"></script>
<!--parsley js-->
<script src="{{ asset('backend/parsley/parsley.min.js') }}"></script>
<!--sweetalert js-->
<script src="{{ asset('backend/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('frontend/js/toastr.min.js') }}"></script>

<script type="text/javascript">
	var base_url = '{{ url("/") }}';
	var csrftoken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('frontend/js/users/user-register.js') }}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
	$("#forgot_password").click(function(){
		$("#exampleModalCenter").modal('hide');
		$("#forgetpassword").modal('show');
	});
</script>

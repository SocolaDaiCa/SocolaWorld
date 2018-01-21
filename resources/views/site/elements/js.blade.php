<!-- local -->
<!-- jQuery -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
{{-- <script src="{{asset('vendor/jquery.cookie/jquery.cookie.js')}}"></script> --}}
<script src="{{asset('vendor/vue/vue.min.js')}}"></script>
<script src="{{asset('vendor/socola.dai.ca/js/fb.js')}}"></script>
<!-- cdn -->
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="{{asset('vendor/scrollreveal/scrollreveal.min.js')}}"></script>
<script src="{{asset('vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<!-- Theme JavaScript -->
<script src="{{asset('js/creative.min.js')}}"></script>
<script>
	$(function() {
		$('form').append('<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />');
	});
	$.ajaxSetup({
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
	});
</script>
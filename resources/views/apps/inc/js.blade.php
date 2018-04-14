<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
// (function(d, s, id) {
// 	var js, fjs = d.getElementsByTagName(s)[0];
// 	if (d.getElementById(id)) return;
// 	js = d.createElement(s);
// 	js.id = id;
// 	js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
// 	fjs.parentNode.insertBefore(js, fjs);
// }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Your customer chat code -->
<div class="fb-customerchat" page_id="1956578997964116" theme_color="#0084ff">
</div>
<!-- local -->
<!-- jQuery -->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/vue/vue.min.js')}}"></script>
<script src="{{asset('vendor/socola.dai.ca/js/fb.js')}}"></script>
<!-- cdn -->
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
{{-- <script src="{{asset('vendor/scrollreveal/scrollreveal.min.js')}}"></script> --}}
<!-- Theme JavaScript -->
{{-- <script src="{{asset('js/creative.min.js')}}"></script> --}}
<script>
'use strict';
$(function() {
	$('form').append('<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />');
	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	});
});
</script>
<script src="{{asset('vendor/toastrjs/toastr.min.js')}}"></script>

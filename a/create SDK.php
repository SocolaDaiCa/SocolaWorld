<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title>
		<link rel="stylesheet" href="">
	</head>
	<body>
		<script>
			window.fbAsyncInit = function() {
			FB.init({
			appId      : '425249171186475',
			cookie     : true,
			xfbml      : true,
			version    : 'v2.8'
			});
			FB.AppEvents.logPageView();
			};
			(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<script>
			FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
			});
		</script>
	</body>
</html>
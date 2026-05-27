<script>

	$( document ).ready(function() {
    
    eraseCookie('refresh_token');
    eraseCookie('access_token');
    eraseCookie('org_id');
});
	// document.cookie = +'refresh_token=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	// document.cookie = +'access_token=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	// document.cookie = +'org_id=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';


alert(getCookie('refresh_token'));
alert(getCookie('access_token'));
alert(getCookie('org_id'));


</script>
<!-- <script>
	window.location.href = '{{url('/')}}'; //Will take you to Google.
</script> -->

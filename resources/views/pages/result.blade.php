<html>
<head>
	<title>RESULT</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
	<h1>This is the result</h1>
	<div>
		<p>English: <input type="text" id="english" value="{!!$term!!}"></p>
		<button id="clickme">Click me!</button>
		<button id="sayit"> 🔊 Play</button>
	</div>
	<div>
		{!! $result !!}
	</div>
</body>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
</script>

<script type="text/javascript">
	$("#clickme").click(function(){
		$.ajax({
			url: "/page?term=" + $('#english').val(),
			type:"POST",
			data: {
				term: $('#english').val()
			},
			success:function(response){
				if(response != "Từ không tồn tại"){
					window.location.href = "/result/" + response;
				}
				else{
					alert("Từ không tồn tại");
				}
			},error:function(){ 
				alert("error!!!!");
			}
    }); //end of ajax
	});

	$('#sayit').click(function(){
		responsiveVoice.speak(($('#english').val()), 'Vietnamese Male');
	});
</script>

</html>
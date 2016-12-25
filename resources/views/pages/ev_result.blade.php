<html>
<head>
	<title>RESULT</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/result.css') }}">
</head>
<body>
	<div class="container">
		<a href="\"><h1>DICTIONARY</h1></a>
		<br>
		<h2>This is the result</h2>

		<div id="EV" class="tabContent">
			<div>
				<p>English: <input type="text" id="english" value="{!!$term!!}" autofocus onfocus="this.value= this.value"></p>
				<button class="butt" id="EVTranslate" value="en">Click me!</button>
				<button class="butt" id="sayit"> 🔊 Play</button>
			</div>
		</div>


		<div class="image">
			{!! $image !!}
		</div>
		<div class="result">
			{!! $result !!}
		</div>
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
	$("#EVTranslate").click(function(){
		$.ajax({
			url: "{{APP_HOST}}/page?term=" + $('#english').val()+"&searchtype=" + $('#EVTranslate').val(),
			type:"POST",
			data: {
				term: $('#english').val(),
				searchtype: $('#EVTranslate').val()
			},
			success:function(response){
				if(response != "Từ không tồn tại"){
					window.location.href = "{{APP_HOST}}/en/result/" + response;
				}
				else{
					alert("Từ không tồn tại");
				}
			},error:function(){ 
				alert("error!!!!");
			}
    	}); //end of ajax

	});


	//add listener for enter keyup listener event
	document.getElementById("english").addEventListener('keydown',function(event){
		var key=event.which || event.keycode;
		if (key==13) {
			document.getElementById('EVTranslate').click();
		}
	},false);

	var array_tag_a=document.getElementsByClassName("aexample");
	for (var i = 0; i < array_tag_a.length; i++) {
		array_tag_a[i].href="{{APP_HOST}}/en/result/" +array_tag_a[i].text;
	}


	$('#sayit').click(function(){
		responsiveVoice.speak($('#english').val());
	});
	
</script>

</html>
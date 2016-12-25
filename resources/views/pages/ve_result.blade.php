<html>
<head>
	<title>RESULT</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/result.css') }}">
</head>
<body>
	<div class="container" >
		<a href="\"><h1>DICTIONARY</h1></a>
		<br>
		<h2>This is the result</h2>

		<div id="EV" class="tabContent">
			<div>
				<p>Vietnamese: <input type="text" id="vietnamese" value="{!!$term!!}" autofocus onfocus="this.value= this.value"></p>
				<button class="butt"  id="VETranslate" value="vn">Click me!</button>
				<button class="butt"  id="sayit"> 🔊 Play</button>
			</div>
		</div>


		<div class="image" >
			{!! $image !!}
		</div>

		<div class="result" >
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

	$("#VETranslate").click(function(){
		$.ajax({

			url: "{{APP_HOST}}/page?term=" + $('#vietnamese').val()+"&searchtype="+$('#VETranslate').val(),
			type:"POST",

			data: {
				term: $('#vietnamese').val(),
				type: $('#VETranslate').val()
			},

			success:function(response){
				if(response != "Từ không tồn tại"){
					window.location.href = "{{APP_HOST}}/vn/result/" + response;
				}
				else{
					alert("Từ không tồn tại");
				}
			},error:function(){ 
				alert("error!!!!");
			}
    	}); //end of ajax

	});


	document.getElementById("vietnamese").addEventListener('keydown',function(event){
		var key=event.which || event.keycode;
		if (key==13) {
			document.getElementById('VETranslate').click();
		}
	},false);
	
	
	var array_tag_a=document.getElementsByClassName("aexample");
	for (var i = 0; i < array_tag_a.length; i++) {
		array_tag_a[i].href="{{APP_HOST}}/vn/result/" +array_tag_a[i].text;
	}


	$('#sayit').click(function(){
		responsiveVoice.speak(($('#vietnamese').val()), "Vietnamese Male");
	});
</script>

</html>
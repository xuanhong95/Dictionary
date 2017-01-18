@extends('layouts.app')
@section('content')
<head>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/result.css') }}">
</head>
<body>
<div class="container">
	<br>

	<div id="EV" class="tabContent">
		<div>
			<p>English: <input type="text" id="english" value="{!!$term!!}" autofocus onfocus="this.value= this.value"></p>
			<button class="butt" id="EVTranslate" value="en">Click me!</button>
			<button class="butt" id="sayit"> 🔊 Play</button>
		</div>
		@if(Auth::user())
		<div class="history">
			@foreach($words as $word)
			<span>{{ $word }}</span>
			@endforeach
		</div>
		@endif
	</div>
	
	<hr>
	<div class="result">
		{!! $result !!}
	</div>

	<div class="image">
		{!! $image !!}
	</div>

</div>
</body>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script type="text/javascript">
	$('.aexample').attr('href','#');

	$("#EVTranslate").click(function(){

		$.ajax({
			url: "http://54.255.173.90/page?term=" + $('#english').val()+"&searchtype=" + $('#EVTranslate').val(),
			type:"POST",
			data: {
				term: $('#english').val(),
				searchtype: $('#EVTranslate').val(),
				
			},
			success:function(response){
				if(response != "Từ không tồn tại"){
					window.location.href = "http://54.255.173.90/en/result/" + response;
				}
				else{
					alert("Từ không tồn tại");
				}
			},error:function(){ 
				alert("error!!!!");
			}
    		}); //end of ajax

	});

		$('.aexample').on('click',function(){
			$.ajax({
				url: "http://54.255.173.90/page?term=" + $(this).text()+"&searchtype=" + $('#EVTranslate').val(),
				type:"POST",
				data: {
					term: $(this).text(),
					searchtype: $('#EVTranslate').val()
				},
				success:function(response){
					if(response != "Từ không tồn tại"){
						window.location.href = "http://54.255.173.90/en/result/" + response;
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

	//var array_tag_a=document.getElementsByClassName("aexample");
	//for (var i = 0; i < array_tag_a.length; i++) {
	//	array_tag_a[i].href="{{APP_HOST}}/en/result/" +array_tag_a[i].text;
	//}


	$('#sayit').click(function(){
		responsiveVoice.speak($('#english').val());
	});
	
</script>

@endsection
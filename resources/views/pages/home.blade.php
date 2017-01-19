@extends('layouts.app')
@section('content')
<html>
<head>
	<title>HomePage</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
	
</head>
<body> 
	
	<div id="container"> 
		<h1>Dictionary</h1>
		<div id="wrap_inner">
			<div  id="EV" class="content" >
				<p>English: <input type="text" id="english" autofocus onfocus="this.value= this.value"></p>
				<button id="EVTranslate" value="en">Click me!</button> 
			</div>
			
		</div>
	</div>
</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<script type="text/javascript">

	$("#EVTranslate").click(function(){
		$.ajax({
			url: "page?term=" + $('#english').val()+"&searchtype=" + $('#EVTranslate').val(),
			type:"POST",
			data: {
				term: $('#english').val(),
				searchtype: $('#EVTranslate').val()
			},
			success:function(response){
				if(response != "Từ không tồn tại"){
					window.location.href = "en/result/" + response;
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
	var en=document.getElementById("english");
		
	en.addEventListener('keyup',function(event){
		enterpress(event);
	},false);



	function enterpress(evt){
		var key = evt.which ;
		
		if(key==13){
			document.getElementById("EVTranslate").click();
		}
	}

</script>

</html>
@endsection
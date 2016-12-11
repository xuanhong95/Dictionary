<html>

<head>
	<title>HomePage</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	
</head>
<body>
	<h1>This is the HomePage</h1>
	<div>
		<p>English: <input type="text" id="english"></p>
		<button id="clickme">Click me!</button>
	</div>

</body>

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

			url: "page?term=" + $('#english').val(),
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
	
</script>

</html>
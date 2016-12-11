<html>

<head>
	<title>HomePage</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	
</head>
<body>
	<h1>This is the HomePage</h1>
	<div>
			<p>Write me: <input type="text" id="writeme"></p>
			<button id="clickme">Click me!</button>
	</div>
	<br>
	<br>
	<div>
		<button id="clicktoshow"> Click me to show:</button>

		<input type="text" id="database" value= {{ isset($name) ? $name:"none" }} >
	</div>
</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.js"></script>
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
			url: "page?username=" + $('#writeme').val(),
			type:"GET",
			data: {
				username: $('#writeme').val()
			},
			success:function(data){
				alert("success")
			},error:function(){ 
				alert("error!!!!");
			}
    	}); //end of ajax

	});
	
</script>

</html>
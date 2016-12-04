<html>
	<head>
		<title>HomePage</title>
	</head>
	<body>
		<h1>This is the HomePage</h1>
		<div>
			<form action="home">
				<p>Write me: <input type="text" id="writeme"></p>
				<button id="clickme">Click me!</button>
			</form>
		</div>
	</body>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="jquery.js"></script>


	<script type="text/javascript">

	$("#clickme").click(function(){
	    if($("#writeme").val() == ""){
	        alert("null");
	    }
	    else{
	         $.ajax({
	                    url : "/save",
	                    type : "post",
	                    data : {
	                         username : $('#writeme').val()
	                    },
	                    success : function (result){
	                        alert(data);
	                    }
	                });
	    }
	});
	</script>
	
</html>
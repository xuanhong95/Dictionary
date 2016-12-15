<html>
<head>
	<title>RESULT</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<style>
		/* Style the links inside the list items */
		ul.tab li a {
		    display: inline-block;
		    color: black;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		    transition: 0.3s;
		    font-size: 17px;

		}

		 li{
		 	list-style-type: none;
		 	display: inline-block;
		 }

		/* Change background color of links on hover */
		ul.tab li a:hover {background-color: #ddd;}

		/* Create an active/current tablink class */
		ul.tab li a:focus, .active {background-color: #ccc;}

		/* Style the tab content */
		.tabcontent {		    
		    padding: 6px 12px;
		    border: 1px solid #ccc;
		    border-top: none;
		}
	</style>
</head>
<body>
	<a href="/home"><h1>DICTIONARY</h1></a>
	<br>
	<h2>This is the result</h2>

	<div id="EV" class="tabContent">
		<div>
			<p>English: <input type="text" id="english" value="{!!$term!!}" autofocus onfocus="this.value= this.value"></p>
			<button id="EVTranslate" value="en">Click me!</button>
			<button id="sayit"> 🔊 Play</button>
		</div>
	</div>

	<div>
		{!! $image !!}
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
		array_tag_a[i].href="http://localhost:8000/en/result/" +array_tag_a[i].text;
	}


	$('#sayit').click(function(){
		responsiveVoice.speak($('#english').val());
	});
	
</script>

</html>
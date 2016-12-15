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
		    display: none;
		    padding: 6px 12px;
		    border: 1px solid #ccc;
		    border-top: none;
		}
	</style>
</head>
<body>
	<h1>This is the result</h1>

	<div id="EV" class="tabContent">
		<div>
			<p>Vietnamese: <input type="text" id="english" value="{!!$term!!}"></p>
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

	$("#VETranslate").click(function(){
		$.ajax({

			url: "page?term=" + $('#vietnamese').val()+"&searchtype="+$('#VETranslate').val(),
			type:"POST",

			data: {
				term: $('#vietnamese').val(),
				type: $('#VETranslate').val()
			},

			success:function(response){
				if(response != "Từ không tồn tại"){
					window.location.href = "vn/result/" + response;
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
	var vn=document.getElementById("vietnamese");
		
	en.addEventListener('keyup',function(event){
		enterpress(event);
	},false);
	vn.addEventListener('keyup',function(event){
		enterpress(event);
	},false);


	function enterpress(evt){
		var key = evt.which ;
		
		if(key==13){
			if(evt.currentTarget.id=="english"){
				document.getElementById("EVTranslate").click();
			}else{
				document.getElementById("VETranslate").click();
			}
		}
	}

	$('#sayit').click(function(){
		responsiveVoice.speak(($('#english').val()), "Vietnamese Male");
	});
</script>

</html>
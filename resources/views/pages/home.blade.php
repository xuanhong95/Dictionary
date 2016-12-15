<html>

<head>
	<title>HomePage</title>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/reset.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
	
</head>
<body> 
	
	<div id="container"> 
		<h1>Dictionary</h1>
		<div id="wrap_inner">
			
			<div>
				<ul id="tab">
					<li><a href="javascript:void(0)" onclick="chooseDictType(event,'EV')" class="tablink" id="defaultTab">EngLish-Vietnamese</a></li>
					<li><a href="javascript:void(0)" onclick="chooseDictType(event,'VE')" class="tablink">Vietnamese-EngLish</a></li>
				</ul>
			</div>

			
			<div  id="EV" class="content" >
				<p >English: <input  type="text" id="english" autofocus onfocus="this.value= this.value"></p>
				
				<button id="EVTranslate" value="en">Click me!</button>
			    
			</div>
			

			
			<div id="VE" class="content">
				<p>Vietnamese: <input type="text" id="vietnamese" autofocus onfocus="this.value= this.value"></p>
				
				<button id="VETranslate" value="vn">Click me!</button>
				
			
			</div>
	
		</div>
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
	//choose default tab
	document.getElementById("defaultTab").click();


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

	
	function chooseDictType(event,dictName){
		var i,tabContent,tablink;

		tabContent=document.getElementsByClassName("content");
		for(i=0;i<tabContent.length;i++){
			tabContent[i].style.display="none";
		}

		tablink=document.getElementsByClassName("tablink");
		for(i=0;i<tablink.length;i++){
			tablink[i].className=tablink[i].className.replace("active","");
		}

		document.getElementById(dictName).style.display="block";
		event.currentTarget.className+=" active";

		
		
	}
		</script>

</html>
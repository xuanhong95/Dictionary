<html>

<head>
	<title>HomePage</title>
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

	body{
		background-image:url(background.jpg);
		background-repeat: no-repeat;
		background-size: 100% auto;
		}
		
	</style>
</head>
<body> 
	
	<div style="border:2px solid black;heigh:90%; margin: 90px 60px  60px 60px;background:#f2f2f2"> 
	<h1>This is the HomePage</h1>
	<div style="border:1px solid none; text-align:center">
	<div style="border:1px solid none">
	<div>
		<ul id="tab">
			<li><a href="javascript:void(0)" onclick="chooseDictType(event,'EV')" class="tablink" id="defaultTab">EngLish-Vietnamese</a></li>
			<li><a href="javascript:void(0)" onclick="chooseDictType(event,'VE')" class="tablink">Vietnamese-EngLish</a></li>
		</ul>
	</div>

	
	<div style="float;margin: 20px" id="EV" class="tabContent" >
		<p>English: <input type="text" id="english"></p>
		
		<button style="margin:-37px 65%;width:80px;heigh:15px" id="EVTranslate" value="en">Click me!</button>
	    
	</div>
	

	
	<div style="float;margin: 20px" id="VE" class="tabContent">
		<p>Vietnamese: <input type="text" id="vietnamese" ></p>
		
		<button style="margin:-37px 65%;width:80px;heigh:15px" id="VETranslate" value="vn">Click me!</button>
		
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

		tabContent=document.getElementsByClassName("tabContent");
		for(i=0;i<tabContent.length;i++){
			tabContent[i].style.display="none";
		}

		tablink=document.getElementsByClassName("tablink");
		for(i=0;i<tablink.length;i++){
			tablink[i].className=tablink[i].className.replace("active","");
		}

		document.getElementById(dictName).style.display="block";
		event.currentTarget.className+=" active";

		$("#dictName > p > input").focus();
		
	}
		</script>

</html>
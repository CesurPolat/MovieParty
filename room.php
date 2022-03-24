<?php include("connect.php") ?>
<?php 
session_start();

if(isset($_GET["Room"])){
	$RidGet = $_GET['Room'];
	$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RidGet'");
	if(mysqli_num_rows($sqli) != 0){
		$_SESSION['id'] = $RidGet;
		unset($_SESSION['authorization']);
		unset($_SESSION['Nickname']);
		echo $_SESSION['id'];
	}
	else{
		header("Location: index.php");//Olmama Sebebi ekle
	}
}
else{
	if(isset($_SESSION['id'])){
		echo $_SESSION['id'];
		
	}
	else{
		header("Location: index.php");//Olmama Sebebi ekle
	}
	
}


/*if(isset($_SESSION['id'])){
	echo $_SESSION['id'];
}
else{
	header("Location: index.php");
}*/

 ?>
<html>
<head>
<title>Movie Party</title>
<link rel="shortcut icon" href="#">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body>
<div class="NameDiv"><center><h1 class="display-4">Nickname</h1><input placeholder="Nickname" id="Name_ipt" type="text"><br/><br/><button class="btn btn-success" onclick="NData('NName='+document.getElementById('Name_ipt').value);document.getElementsByClassName('NameDiv')[0].remove();">Enter</button></center></div>
<div class="container-fluid">
  <div class="row">
	<div class="col-sm-2"></div>
	<div class="col-sm-6" style="margin:0;padding:0;" id="Player"><div class="VideoControls" style="display:none">
	
	<div class="progress">
		<div class="progress-bar" style="width:0%"></div>
		<input type="range" onclick="NewTime()" style="opacity:0;position:absolute;width:100%" step="1" name="range">
	</div>
	<div style="position:absolute;top:22px">
	<input type="range" onclick="Volume()" id="Volume"  value="100">
	<b id="VidCurrent" style="color:White;">0:0 / 0:0</b>
	</div>
	<button style="float:right;color:white;" class="btn" onclick="FullScreen()"><b>&#x26F6;</b></button>
	</div>
	<video width="100%" onclick="Play()" ondblclick="FullScreen()" src="" ></video>
	</div>
	<div class="col-sm-3 bg-danger" style="padding:5;">
		<div style="overflow-y:auto;" id="ChatDiv"></div>
		<div style="bottom:5;position:absolute;width:100%;height:8%">
		<input id="ChatText" type="text" style="width:80%;background:none;border-radius:10px;border:2px solid white;color:white">
		<button onclick="NData('NVChat='+document.getElementsByTagName('input')[2].value);document.getElementById('ChatText').value=''" style="width:17%;background:none;border-radius:10px;border:2px solid white;color:white;height:31px"><img height="100%" src="image/send.png"></button>
		</div>
	</div>
	<div class="col-sm-1"></div>
  </div>
</div>


<input id="NUrl">
<button onclick="ChangeVideo()">Change Video</button>
<?php 
$sid = $_SESSION['id'];
echo "<input type='text' value='http://localhost/room.php?Room=$sid' readonly id='hidRoom'>";
?>
 <button onclick="CopyInvite()">Copy Invite Link</button> 
<?php
	if(isset($_SESSION['authorization'])){
		echo '<a onclick="NData('."'ER=E'".')" class="btn btn-danger">End the Room</a>';
	}
	else{
		echo '<a href="index.php" class="btn btn-danger">Leave the Room</a>';
	}
?>
<p>https://www.w3schools.com/html/mov_bbb.mp4</p>
<p>https://www.youtube.com/watch?v=oT3rhryifm0</p>
<p>https://dinle.mp3indirdur.info/mp3/indirdurArsiv333/Elanur/Bela/Elanur-Bela.mp3</p>
<p>https://www.youtube.com/watch?v=SMKlM21ZN1w</p>
<p>https://www.youtube.com/watch?v=ewOyq75gHTk</p>
<script src="js/Party.js"></script>
<script src="js/Player.js"></script>
<script>
function CopyInvite(){

  var copyText = document.getElementById("hidRoom");
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  document.execCommand("copy");
  
}
</script>
<?php 
if(isset($_SESSION['Nickname'])){
	echo "<script>document.getElementsByClassName('NameDiv')[0].remove();</script>";
}

?>
</body>
</html>
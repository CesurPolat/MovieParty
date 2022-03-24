<?php include("connect.php") ?>
<html>
<head>
<title>Movie Party</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<form method="GET">
<b>Authorization:</b>
<input type="checkbox" name="A_chb" value="Everybody">Everybody</input>
<input type="submit" name="C_btn" value="Create a Room"><br/><br/>
</form>
<form method="GET">
<!--<input type="text" name="Nn_ipt" placeholder="Nickname">-->
<input type="text" name="Ri_ipt" placeholder="Room id" required>
<input type="submit" name="J_btn" value="Join The Room">
</form>
<?php
	if(isset($_GET['C_btn'])){
		CreateRoom();
	}

	if(isset($_GET['J_btn'])){
		JoinRoom();
	}
	

	function CreateRoom(){
		
		$RCode = rand(111111,999999);
		if(isset($_GET["A_chb"])){
			$Auth = $_GET["A_chb"];
		}
		else{
			$Auth = "";
		}
		global $db;
		$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RCode'");
		if(mysqli_num_rows($sqli) == 0){
			mysqli_query($db, "INSERT INTO rooms(Room_id, Video_data, Participants, Chat) VALUES ('$RCode',';;0;0', '$Auth;".Time()."', ';0')");
			session_start();
			$_SESSION['id'] = $RCode;
			$_SESSION['authorization'] = "Host";
			$_SESSION['Nickname'] = "Host";
			header("Location: room.php");
			
		}
		else{
			CreateRoom();
		}
	}

	function JoinRoom(){
		session_start();
		//$_SESSION['id'] = $_GET["Ri_ipt"];
		//$_SESSION['Nickname'] = $_GET["Nn_ipt"];
		header("Location: room.php?Room=".$_GET["Ri_ipt"]);
		//header("Location: room.php");
	}
?>
</body>
</html>
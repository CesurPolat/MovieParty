<?php include("connect.php") ?>
<?php 
$cl = 0;
session_start();
	$RC =$_SESSION['id'];
	$NN =$_SESSION['Nickname'];
	$Auth = True;
	$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RC'");
	
	
	if(mysqli_num_rows($sqli) == 0){
		echo "RoomEnded";
	}
	$datas = mysqli_fetch_array($sqli);
	
	
	
	if(explode(";", $datas['Participants'])[0] == "Everybody"){
		$Auth = True;
	}
	else{
		if(isset($_SESSION['authorization'])){
			$Auth = True;
		}
		else{
			$Auth = False;
		}
	}
	
	if(isset($_SESSION['id']) && isset($_POST['NVUrl']) && $Auth){
		$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RC'");
		$datas = mysqli_fetch_array($sqli);
		//$NVData = $_POST["NVUrl"].";".(int)(explode(";",$datas['Video_data'])[1]+1);
		$NVData = $_POST["NVUrl"].";".explode(";",$datas['Video_data'])[1].";"."0".";".(int)(explode(";",$datas['Video_data'])[3]+1);
		mysqli_query($db, "UPDATE `rooms` SET `Video_data`='$NVData' WHERE Room_id = '$RC'");
		//echo $datas["Video_data"];
		$cl = 1;
	}
	if(isset($_SESSION['id']) && isset($_POST['VPlay']) && $Auth){
		$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RC'");
		$datas = mysqli_fetch_array($sqli);
		$NVData = explode(";",$datas['Video_data'])[0].";".$_POST["VPlay"].";".explode(";",$datas['Video_data'])[2].";".(int)(explode(";",$datas['Video_data'])[3]+1);
		mysqli_query($db, "UPDATE `rooms` SET `Video_data`='$NVData' WHERE Room_id = '$RC'");
		//echo $datas["Video_data"];
		$cl = 1;
	}
	if(isset($_SESSION['id']) && isset($_POST['NVC']) && $Auth){
		$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RC'");
		$datas = mysqli_fetch_array($sqli);
		$NVData = explode(";",$datas['Video_data'])[0].";".explode(";",$datas['Video_data'])[1].";".$_POST["NVC"].";".(int)(explode(";",$datas['Video_data'])[3]+1);
		mysqli_query($db, "UPDATE `rooms` SET `Video_data`='$NVData' WHERE Room_id = '$RC'");
		//echo $datas["Video_data"];
		$cl = 1;
	}
	if(isset($_SESSION['id']) && isset($_POST['NVChat'])){
		$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RC'");
		$datas = mysqli_fetch_array($sqli);
		$NVData = explode(";",$datas['Video_data'])[0].";".explode(";",$datas['Video_data'])[1].";".$_POST["NVC"].";".(int)(explode(";",$datas['Video_data'])[3]+1);
		mysqli_query($db, "UPDATE `rooms` SET `Chat`='".$NN." : ".$_POST['NVChat'].";".(explode(";",$datas['Chat'])[1]+1)."' WHERE Room_id = '$RC'");
		//$NVData = explode(";",$datas['Video_data'])[0].";".explode(";",$datas['Video_data'])[1].";".explode(";",$datas['Video_data'])[2].";".(int)(explode(";",$datas['Video_data'])[3]+1);
		//mysqli_query($db, "UPDATE `rooms` SET `Video_data`='$NVData' WHERE Room_id = '$RC'");
		//echo $datas["Video_data"];
		$cl = 1;
	}
	
	if(isset($_SESSION['id']) && isset($_POST['NName'])){
		$_SESSION['Nickname'] = $_POST['NName'];
		$cl = 1;
	}
	if(isset($_SESSION['id']) && isset($_POST['ER']) && isset($_SESSION['authorization'])){
		echo "RoomEnded";
		mysqli_query($db, "DELETE FROM `rooms` WHERE Room_id = '$RC'");
		$cl = 1;
	}
	
	if(isset($_SESSION['id']) && $cl == 0 && isset($_SESSION['authorization'])){
		$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RC'");
		$datas = mysqli_fetch_array($sqli);
		mysqli_query($db, "UPDATE `rooms` SET `Participants`='".explode(";", $datas["Participants"])[0].";".Time()."' WHERE Room_id = '$RC'");
	}
	
	if(isset($_SESSION['id']) && $cl == 0 && isset($_SESSION['authorization']) && isset($_POST['VC'])){
		$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RC'");
		$datas = mysqli_fetch_array($sqli);
		$NVData = explode(";",$datas['Video_data'])[0].";".explode(";",$datas['Video_data'])[1].";".$_POST["VC"].";".(int)(explode(";",$datas['Video_data'])[3]);
		mysqli_query($db, "UPDATE `rooms` SET `Video_data`='$NVData' WHERE Room_id = '$RC'");
	}
	
	if(isset($_SESSION['id']) && $cl == 0){
		$sqli = mysqli_query($db, "SELECT * FROM rooms WHERE Room_id = '$RC'");
		$datas = mysqli_fetch_array($sqli);
		echo $datas["Video_data"].";".$datas["Chat"];
		include("server.php");
		
	}
	else if(empty($_SESSION['id'])){
		echo "You Don't Have Permision!";
	}
?>
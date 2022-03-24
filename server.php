<?php include("connect.php") ?>
<?php 
$sqli = mysqli_query($db, "SELECT `Participants`, `Room_id` FROM `rooms`");
/*$datas = mysqli_fetch_row($sqli);
echo count($datas);
echo $datas[0];*/
 while ($row = mysqli_fetch_row($sqli)) {
	 if(((int)Time()-(int)(explode(";", $row[0])[1]))>10){
		 printf ($row[0]." RI:".$row[1]."Kapat<br/>");
		 $sqliP = mysqli_query($db, "DELETE FROM `rooms` WHERE Room_id = '$row[1]'");
		 
	 }
	 else{
		 printf ($row[0]." RI:".$row[1]."<br/>");
	 }
    
  }
  echo "<br/>".Time();
?>
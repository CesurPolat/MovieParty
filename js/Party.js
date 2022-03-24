var DTimer = setInterval(NData, 500);
var LChange;
var LUrl;
var LTime;//Update
var LChat;
var dTime;

function NData(PData){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		if(this.responseText.indexOf("RoomEnded") != -1){
			window.location.href = "index.php";
		}
	if(LChange != this.responseText.split(";")[3] && this.responseText != ""){
	  if(this.responseText.split(";")[1] == "play"){
			Video.pause();
		}
		else{
			Video.play();
		}
		
		Video.currentTime = parseFloat(this.responseText.split(";")[2]);
		LChange = this.responseText.split(";")[3];
		
	}
	  if(this.responseText.split(";")[0] != LUrl && this.responseText != ""){
		Video.src=decodeURIComponent(this.responseText.split(";")[0]);
		document.getElementById("ChatDiv").style="height:"+Video.offsetHeight*90/100+";overflow-y:auto;";
		LUrl =this.responseText.split(";")[0];
		LChange = this.responseText.split(";")[3];
	  }
	  if(this.responseText.split(";")[5] != LChat && this.responseText != ""){
		var ChatBlock = document.createElement("p");
		ChatBlock.innerHTML = this.responseText.split(";")[4];
		ChatBlock.style = "color:white;";
		document.getElementById('ChatDiv').appendChild(ChatBlock);
		//document.getElementById("ChatDiv").lastElementChild
		//console.log(document.getElementById("ChatDiv").scrollTop/(document.getElementById("ChatDiv").scrollHeight - document.getElementById("ChatDiv").clientHeight));
		if(document.getElementById("ChatDiv").scrollTop/(document.getElementById("ChatDiv").scrollHeight - document.getElementById("ChatDiv").clientHeight) > 0.7){
			document.getElementById("ChatDiv").lastElementChild.scrollIntoView()
		}
		LChat = this.responseText.split(";")[5];
	  } 
    }
  };
  xhttp.open("POST", "data.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(PData);
}
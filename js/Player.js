var Player = document.getElementById("Player");
var Video = document.getElementsByTagName('Video')[0];
var VolumeBar = document.getElementById('Volume');
var VideoCtrl = document.getElementsByClassName('VideoControls')[0];
var STime;
var RawLink;
var do_Type = 1;
//Player.addEventListener("mouseover", Show);
Player.addEventListener("mouseout", Hide);
Player.addEventListener("mousemove", Move);
Video.addEventListener('timeupdate', Bar);
document.addEventListener('keydown', logKey);
document.getElementById("ChatText").addEventListener('input', function (){do_Type = 0;});
document.getElementById("ChatText").addEventListener('click', function (){do_Type = 0;});
window.addEventListener('resize', function (){document.getElementById("ChatDiv").style="height:"+Video.offsetHeight*90/100+";overflow-y:auto;";});

document.getElementById("ChatDiv").style="height:"+Video.offsetHeight*90/100+";overflow-y:auto;";

var CTime = setInterval(UpdateCTime, 500);

function Play(){
	if(Video.paused){
		if(Video.currentTime == Video.duration){
			NData("NVC=0");
			//LChange +=1;
		}
		//Video.play();
		//LChange +=1;
		NData("VPlay=pause");
	}
	else{
		if(Video.currentTime != Video.duration){
			NData("NVC="+Video.currentTime);
			//LChange +=1;
		}
		//Video.pause();
		//LChange +=1;
		NData("VPlay=play");
		
	}
	
}

function Move(){
	window.clearTimeout(STime);
	STime = setTimeout(Show, 3000);
	VideoCtrl.style = "display:block";
	Video.style = "cursor: default;";
}

function Show(){
	window.clearTimeout(STime);
	VideoCtrl.style = "display:none";
	Video.style = "cursor: none;";
}

function Hide(){
	window.clearTimeout(STime);
	VideoCtrl.style = "display:none";
	Video.style = "cursor: default;";
}

function FullScreen(){
	if(!document.fullscreenElement){
		Player.requestFullscreen();
	}
	else{
		document.exitFullscreen();
		
	}
	/*if (Player.requestFullscreen) {
		Player.requestFullscreen();
	} else if (Player.webkitRequestFullscreen) { 
	} else if (Player.msRequestFullscreen) { 
		Player.msRequestFullscreen();
	}*/
	/*
	if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
  }*/
}

function Bar(){
	document.getElementsByClassName('progress-bar')[0].style = "width:"+Video.currentTime/Video.duration*100+"%";
	var cTime;
	if(Math.floor(Math.floor(Video.currentTime)/3600) >= 1){
		cTime = Math.floor(Math.floor(Video.currentTime)/3600)+":"+(Math.floor(Math.floor(Video.currentTime)/60)-Math.floor(Math.floor(Video.currentTime)/3600)*60)+":"+(Math.floor(Video.currentTime)-Math.floor(Math.floor(Video.currentTime)/60)*60);
	}
	else{
		cTime = Math.floor(Math.floor(Video.currentTime)/60)+":"+(Math.floor(Video.currentTime)-Math.floor(Math.floor(Video.currentTime)/60)*60);
	}
	//DTime bir seferlik
	var dTime;
	if(Math.floor(Math.floor(Video.duration)/3600) >= 1){
		dTime = Math.floor(Math.floor(Video.duration)/3600)+":"+(Math.floor(Math.floor(Video.duration)/60)-Math.floor(Math.floor(Video.duration)/3600)*60)+":"+(Math.floor(Video.duration)-Math.floor(Math.floor(Video.duration)/60)*60);
	}
	else{
		dTime = Math.floor(Math.floor(Video.duration)/60)+":"+(Math.floor(Video.duration)-Math.floor(Math.floor(Video.duration)/60)*60);
	}
	document.getElementById('VidCurrent').innerHTML = cTime+" / "+dTime;
	
	
}

function Volume(){
	Video.volume = VolumeBar.value/100;
}

function Mute(){
	var OVol = 0;
		if(VolumeBar.value !=0){
			window.OVol = VolumeBar.value;
			VolumeBar.value = 0;
			Volume();
		}
		else{
			VolumeBar.value = window.OVol;
			Volume();
		}
}

function NewTime(){
	Video.currentTime = Video.duration*(document.getElementsByName('range')[0].value/100);
	LChange +=1;
	NData("NVC="+Video.currentTime);
}

function NNewT(NI){
	Video.currentTime = (Video.duration/10)*NI;
	LChange +=1;
	NData("NVC="+Video.currentTime);
}

function logKey(e){
	console.log(e.keyCode);
	if(e.keyCode == 39){
		Video.currentTime += 5;
		LChange +=1;
		NData("NVC="+Video.currentTime);
	}
	if(e.keyCode == 37){
		Video.currentTime -= 5;
		LChange +=1;
		NData("NVC="+Video.currentTime);
	}
	if(e.keyCode == 32 && do_Type == 1){
		Play();
	}
	if(e.keyCode == 70 && do_Type == 1){
		FullScreen();
	}
	if(e.keyCode == 80 && do_Type == 1){
		Video.requestPictureInPicture();
	}
	if(e.keyCode == 77 && do_Type == 1){
		Mute();
	}
	
	if(e.keyCode == 96){
		NNewT(0);
	}
	if(e.keyCode == 97){
		NNewT(1);
	}
	if(e.keyCode == 98){
		NNewT(2);
	}
	
	if(e.keyCode == 99){
		NNewT(3);
	}
	if(e.keyCode == 100){
		NNewT(4);
	}
	if(e.keyCode == 101){
		NNewT(5);
	}
	
	if(e.keyCode == 102){
		NNewT(6);
	}
	if(e.keyCode == 103){
		NNewT(7);
	}
	if(e.keyCode == 104){
		NNewT(8);
	}
	if(e.keyCode == 105){
		NNewT(9);
	}
	if(e.keyCode == 13 && do_Type == 0){
		NData('NVChat='+document.getElementsByTagName('input')[2].value);
		document.getElementById("ChatText").value='';
	}
	do_Type=1;
}

//YouTube

//document.getElementsByClassName("html5-video-player")[0].click()

function ChangeVideo(){
	if(document.getElementById('NUrl').value.indexOf('youtube.com/') != -1){
			if(document.getElementById('NUrl').value.indexOf('embed') != -1){
				
			}
			else{
				
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						//console.log(encodeURIComponent(JSON.parse(decodeURIComponent(this.responseText).split("player_response=")[1].split("&enablecsi")[0]).streamingData.formats[0].url));
						RawLink = encodeURIComponent(JSON.parse(decodeURIComponent(this.responseText).split("player_response=")[1].split("&enablecsi")[0]).streamingData.formats[0].url);
						NData('NVUrl='+RawLink);
					}
				};
				xhttp.open("GET", "get.php?a=http://youtube.com/get_video_info?video_id="+document.getElementById('NUrl').value.split("/")[document.getElementById('NUrl').value.split('/').length-1].split('?v=')[1], true);
				xhttp.send();
			}
		}
		else{
			NData('NVUrl='+document.getElementById('NUrl').value);
		}
	  
}

function UpdateCTime(){
	NData("VC="+Video.currentTime);
}

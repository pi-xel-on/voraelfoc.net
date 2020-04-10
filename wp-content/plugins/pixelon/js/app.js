//webkitURL is deprecated but nevertheless
URL = window.URL || window.webkitURL;

var gumStream; 						//stream from getUserMedia()
var rec; 							//Recorder.js object
var input; 							//MediaStreamAudioSourceNode we'll be recording

// shim for AudioContext when it's not avb. 
var AudioContext = window.AudioContext || window.webkitAudioContext;
var audioContext //audio context to help us record

var recordButton = document.getElementById("recordButton");
var stopButton = document.getElementById("stopButton");
var pauseButton = document.getElementById("pauseButton");
var repetirButton = document.getElementById("repetirButton");


//add events to those 2 buttons
recordButton.addEventListener("click", startRecording);
stopButton.addEventListener("click", stopRecording);
pauseButton.addEventListener("click", pauseRecording);
repetirButton.addEventListener("click", repetirRecording);

var tempsGrabacio=25;
var timerCountDown=tempsGrabacio;
var myVarCount;
var pausee=false;
function contadorEnrerre(){
	if(pausee==false){
		timerCountDown--;
		if(timerCountDown==0){
		    clearInterval(myVarCount);
		    stopRecording();
 	 	}
  			jQuery("#countdows").html(timerCountDown);
	}
}


function startRecording() {

    myVarCount = setInterval(contadorEnrerre, 1000);
	jQuery(".sonar-wave").show();
	console.log("recordButton clicked");

	
	//makeWaveform();

	/*
		Simple constraints object, for more advanced audio features see
		https://addpipe.com/blog/audio-constraints-getusermedia/
	*/
    
    var constraints = { audio: true, video:false }

 	/*
    	Disable the record button until we get a success or fail from getUserMedia() 
	*/

	recordButton.disabled = true;
	stopButton.disabled = false;
	pauseButton.disabled = false;
	repetirButton.disabled = true;

	/*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

	navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
		console.log("getUserMedia() success, stream created, initializing Recorder.js ...");

		/*
			create an audio context after getUserMedia is called
			sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
			the sampleRate defaults to the one set in your OS for your playback device

		*/
		audioContext = new AudioContext();



		//update the format 
		//document.getElementById("formats").innerHTML="Format: 1 channel pcm @ "+audioContext.sampleRate/1000+"kHz"

		/*  assign to gumStream for later use  */
		gumStream = stream;
		
		/* use the stream */
		input = audioContext.createMediaStreamSource(stream);
		

		/* 
			Create the Recorder object and configure to record mono sound (1 channel)
			Recording 2 channels  will double the file size
		*/
		rec = new Recorder(input,{numChannels:1})

		//start the recording process
		rec.record()

		console.log("Recording started");

	}).catch(function(err) {
	  	//enable the record button if getUserMedia() fails
    	recordButton.disabled = false;
    	stopButton.disabled = true;
    	pauseButton.disabled = true
	});
}
function repetirRecording(){
	timerCountDown=tempsGrabacio;
	jQuery("#countdows").html(timerCountDown);
	//disable the stop button, enable the record too allow for new recordings
	stopButton.disabled = true;
	recordButton.disabled = false;
	pauseButton.disabled = true;
	repetirButton.disabled = true;
	
	//reset del audio

	jQuery(".submit").fadeOut("fast");
	jQuery("#recordingsList").html("");

	jQuery("#escolta").fadeOut("fast");


}
function pauseRecording(){
	console.log("pauseButton clicked rec.recording=",rec.recording );
	if (rec.recording){
		//pause
		pausee=true;
		jQuery(".sonar-wave").hide();
		rec.stop();
		pauseButton.innerHTML="Resume";
	}else{
		//resume
		pausee=false;
		jQuery(".sonar-wave").show();
		rec.record()
		pauseButton.innerHTML="Pause";

	}
}

function stopRecording() {
	clearInterval(myVarCount);
	jQuery("#escolta").fadeIn("fast");
	jQuery(".submit").fadeIn("fast");
	
	jQuery(".sonar-wave").hide();
	//jQuery(".controls").hide();
	//jQuery(".repetir").fadeIn("fast");
	console.log("stopButton clicked");

	//disable the stop button, enable the record too allow for new recordings
	stopButton.disabled = true;
	recordButton.disabled = true;
	pauseButton.disabled = true;
	repetirButton.disabled = false;

	//reset button just in case the recording is stopped while paused
	pauseButton.innerHTML="Pause";
	
	//tell the recorder to stop the recording
	rec.stop();

	//stop microphone access
	gumStream.getAudioTracks()[0].stop();

	//create the wav blob and pass it on to createDownloadLink
	rec.exportWAV(createDownloadLink);
}

function createDownloadLink(blob) {
	
	var url = URL.createObjectURL(blob);
	var au = document.createElement('audio');
	var li = document.createElement('li');
	var link = document.createElement('a');

	//name of .wav file to use during upload and download (without extendion)
	var filename = new Date().toISOString();

	//add controls to the <audio> element
	au.controls = true;
	au.src = url;

	//save to disk link
	link.href = url;
	link.download = filename+".wav"; //download forces the browser to donwload the file using the  filename
	link.innerHTML = "Save to disk";

	//add the new audio element to li
	li.appendChild(au);
	
	//add the filename to the li
	li.appendChild(document.createTextNode(filename+".wav "));
	jQuery("#url_audio").val(filename+".wav ");


	//add the save to disk link to li
	li.appendChild(link);
	
	//upload link
	var upload = document.createElement('a');
	
	upload.id="upload_link";
	upload.href="#";
	upload.innerHTML = "Upload";
	upload.addEventListener("click", function(event){
		console.log("Comença upload");

		repetirButton.disabled = true;
		  var xhr=new XMLHttpRequest();
		  xhr.onload=function(e) {
		      if(this.readyState === 4) {

		          	console.log("Server returned: ",e.target.responseText);
		         	//jQuery("#acabat").val("penjat");
		          	var user_id=jQuery("#user_id").val();
		          	var fase=jQuery("#fase").val();
		          	var titol=jQuery("#titol").val();
					var ima=jQuery('#url_ima').val();
					var audio=jQuery("#url_audio").val();	//fase user_id

					/*
	var text_resum=jQuery("#text_resum").val();
            var musica=jQuery('#musica').val();
					*/			
		          	console.log("Guardo BBDD:" +titol+" \n "+ima+" \n"+ audio);
		          	
		          	if(fase==2){ //fase nus o desenllaç
		          		url="https://voraelfoc.net/wp-content/plugins/pixelon/bbdd.php?id="+jQuery("#idHistoria").val();	

		          	}else if(fase==3){
						url="https://voraelfoc.net/wp-content/plugins/pixelon/bbdd.php?id="+jQuery("#idHistoria").val()+"&musica_fons="+jQuery('#musica').val()+"&text_resum="+jQuery("#text_resum").val();	

		          	}else{
		          		url="https://voraelfoc.net/wp-content/plugins/pixelon/bbdd.php";
		          	}
		          	jQuery.ajax({
				        method: "POST",
				        url: url,
				        data: { "titol": titol, "ima":ima, "audio":audio,"fase":fase,"user_id":user_id }
				    })
				    .done(function( msg ) {
				        console.log( "Data Saved: " + msg );
				        var n = msg.search("Errormessage");
				        if(n>=0){
				          jQuery("#error").html("Data entry error, try later or contact the administrator");
				        }else{
				          //jQuery('#tapa').html("<h3 style='color: #000;'>Assignment created correctly</h3> ");
				          jQuery("#tapa" ).fadeOut( 2000, function() {
				            // Animation complete.
				            if(fase>=2){ //fase nus o desenllaç
				            	location.reload();
				        	}else{
				            	location.href="/historia/?idHistoria="+msg;
				            }
				          });
				          

				          //alert("Assignment created correctly ");
				        }
				    });
		      }
		  };
		  var fd=new FormData();
		  fd.append("audio_data",blob, filename);
		  xhr.open("POST","https://voraelfoc.net/wp-content/plugins/pixelon/upload.php",true);
		  xhr.send(fd);
	})
	li.appendChild(document.createTextNode (" "))//add a space in between
	li.appendChild(upload)//add the upload link to li

	//add the li element to the ol
	recordingsList.appendChild(li);
}



/*
function crearHistoria(){
	jQuery( ".selector_continua" ).animate({
    	opacity: 0,
    	left: "-1000px"
  	}, 2000, function() {
    // Animation complete.
  	
  	});

  	jQuery( ".selector_nova" ).animate({
    	opacity: 0,
    	right: "-1000px"
  	}, 2000, function() {
    // Animation complete.
    	jQuery(".gravador").fadeIn("slow");
  		jQuery("#fila_selector").fadeOut("fast");
  	});
}

var timerCountDown=20;
var myVarCount;

function contadorEnrerre(){
	timerCountDown--;
	if(timerCountDown==0){
		clearInterval(myVarCount);
		stopRecording();
	}
	jQuery("#countdows").html(timerCountDown);

}
*/
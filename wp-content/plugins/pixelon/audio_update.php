<?php
  //die("<h1>HOLAS</h1>");
    $current_user_id = get_current_user_id();

    //side_menu_button_link 
    $histories_update =get_field('histories_update','user_'.$current_user_id);

    $histories_noves =get_field('histories_noves','user_'.$current_user_id);

    /**************************************
    *
    *MIRO SI SOC NOU O NO 
    *
    ****************************************/
    if($histories_noves==""){
      update_metadata( 'user', $current_user_id,'histories_noves',0 );
      $histories_noves=0;
     
    }
    if($histories_update==""){
      update_metadata( 'user', $current_user_id,'histories_update',0 );
      $histories_update=0;
     
    }
//echo "<h1>".$histories_noves."---".$histories_update."---".$current_user_id."<h1>";
 //echo "<h1>$quin_punt_esta</h1>"; //3 finalitzar
?>

<?php


    if($current_user_id=="0"){
      ?>
      <script type="text/javascript">
        //alert("123");
        var myVar;
        var fileUpload;
        jQuery( document ).ready(function() {
          myVar = setInterval(openSide, 100);
          jQuery(".no_log").html("");

          jQuery( ".selector_registre" ).click(function() {
            console.log("registre");
            jQuery(".side_menu_button_link").trigger( "click" );

          });

          jQuery( "#open_side" ).click(function() {
            jQuery(".side_menu_button_link").trigger( "click" );
          });         



        });
        function openSide(){         
          console.log("openSide");
          clearInterval(myVar);
          //jQuery(".side_menu_button_link").trigger( "click" );
        }




      </script>
      <style type="text/css">
        .no_log{
          display: none
        }
      </style>
      <?php

      //die();
    }else{
      ?>
        <script type="text/javascript">
        //alert("123");

        var fileUpload;
        var myVar;
        jQuery( document ).ready(function() {
          jQuery(".log").html("");

          jQuery( ".selector_continua" ).click(function() {
            console.log("continua una historia");
            continuaHistoria();
            permisosMicro();

          });


          jQuery( ".selector_nova" ).click(function() {
            console.log("nova historia");

            crearHistoria();
          });



          function continuaHistoria(){
            jQuery( ".selector_continua" ).animate({
                opacity: 0,
                left: "-1000px"
              }, 2000, function() {
              // Animation complete.

                jQuery(".gravador").fadeIn("slow");
                jQuery("#fila_selector").fadeOut("fast");
              
              });

             
          }
         


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


         jQuery("input:file").change(function (){
               fileName = jQuery(this).val();
               //jQuery(".filename").html(fileName);
               //alert(fileName);
                
                fileobj = document.getElementById('upload_ima').files[0];
                ajax_file_upload(fileobj);
                
             });

           function ajax_file_upload(file_obj) {
            if(file_obj != undefined) {
              var form_data = new FormData();                  
              form_data.append('file', file_obj);
               jQuery('#preview').html('<img src="<?=$urlPlugin?>ball.svg" style="width:50%;">');
              jQuery.ajax({
                type: 'POST',
                url: '<?=$urlPlugin?>/upload_ima.php',
                contentType: false,
                processData: false,
                data: form_data,
                success:function(response) {
                  console.log(response);
                  if(response.indexOf("false#")==-1){
                    //alert("OK");
                  }else{
                    alert("ERROR");
                  }
                   fileUpload=response;

                   jQuery('#url_ima').val(fileUpload);
                   jQuery('#preview').html('<img class="tancat" src="<?=$urlPlugin?>'+response+'" style="width:90%;">');
                   //jQuery('.nxt').removeClass("hide fadeOutDown").addClass("fadeInUp");
                }
              });
            }
          }



    }); //finaL DOCUMENT READY
      </script>
      <style type="text/css">
        .log{
          display: none
        }
      </style>
      <?php

    }
    
?>

<style type="text/css">
  .selector_continua,.selector_nova{
    cursor: pointer;
    position: relative !important;
  }
  .gravador{
    display: none
  }
  #open_side{
    cursor: pointer;
  }
  .title_holder, .title {
   /* display: none !important;*/
  }
  /* Prevent scrollbars to appear when waves go out of bound */
.sonar-wrapper {
  position: relative;
  z-index: 0;
  overflow: hidden;
  padding: 8rem 0;
}

/* The circle */
.sonar-emitter {
  position: relative;
  margin: 0 auto;
  width: 140px;
  height: 140px;
  border-radius: 9999px;
  background-color: HSL(45,100%,50%);
}


/* the 'wave', same shape and size as its parent */
.sonar-wave {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 999px;
  /*background-color: HSL(45,100%,50%);*/
  background-color: red;
  opacity: 0;
  z-index: -1;
  pointer-events: none;
}

/*
  Animate!
  NOTE: add browser prefixes where needed.
*/
.sonar-wave {
  animation: sonarWave 2s linear infinite;
}
.numero{
  text-align: center;
    font-size: 30px;
    padding-top: 27%;
    font-weight: 700;
    color: #E91E63;
}
.numero span{
  display: block;  
  font-size: 11px;
}
.ds-btn li{
  text-align: center !important;
}

.ds-btn li small{
  font-size: 1.4vh !important;
}
.ds-btn li a{
  min-width: 25%;
  margin-bottom: 10px;
  font-size: 2.3vh !important
  line-height:1.6vh !important;
}
   
.ds-btn li a:visited {
    color: white !important;
} 

@keyframes sonarWave {
  from {
    opacity: 0.4;
  }
  to {
    transform: scale(2);
    opacity: 0;
  }
}







 .form-group label h1 {font-size:24px;} .form-group label {font-size:14px;} .form-group input, .form-group textarea {font-size:18px;padding: 15px 15px;} .questionaire {padding:20px 0;} .count {font-size:20px;} .cover .btn-lg {padding:10px 20px; font-size:20px;}
  .form-group textarea {min-height:150px;}
  
}

.files{ 
    position:relative;
    border: 3px dashed #fff;
    text-align: center;
    margin: 0;
    width: 100% !important;
    height:250px;
    overflow:hidden;
    padding: 10px;
}
input[type="file"] {
    opacity: 0;
}
.files input {
    width: 100% !important;
    height:200px;
    border:none;
    padding:0;
    background:transparent;
    text-align:center;
    color: transparent;
}

.files{ position:relative}

.files:after {
    pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 70px;
    right: 0;
    height: 70px;
    content: "";
    background-image: url(https://image.flaticon.com/icons/svg/130/130993.svg);
    display: block;
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}

.files:before {
  content:"Arrastra la imatge o clica";
  position:absolute;
  bottom:55px;;
  left:0;
  right:0;
  display:block;
  text-align:center;
  color:rgba(255,255,255,0.5);
  font-weight:bold;
}
div#preview {
   position: absolute;
    top: 0%;
    left: 0%;
    margin: 0;
    padding: 0;
    text-align: left;
    width: 25%;

}



span#lang_li {
    padding: 15px;
    text-align: center;
    font-size: 3em;
    background: #ffbd04;
    margin: 3px;
    margin-top: 10px;
    border-spacing: 12px;
    border-collapse: separate;
    cursor: pointer;
    border: 4px solid white;
}

.btn_select{
  font-size: 1.8rem;
    background: #ffffff7a;
    color: #000;
    margin: 5px;
    border: 2px #fff solid;
    text-align: left;
    min-width: 100%;    
    padding: 3%;
    font-weight: 700;
}

.ima_format{
    width: 45%;
    border: 2px #fff solid;
}

.btn_fin,.btn_ini {
    padding: 15px;
    text-align: center;
    font-size: 3em;
    background: #ffbd04;
    margin: 3px;
    margin-top: 10px;
    border-spacing: 12px;
    border-collapse: separate;
    cursor: pointer;
    border: 4px solid white;
}
.btn_fin:hover {
    border: 4px solid #e74c3d;
}
#recordingsList{
  margin:0 auto !important;
}
#recordingsList li a{
  display: none;
}
.formats,#escolta{
  display: none;
  text-align: center;
}
div#tapa {
    background: #ff9800a6;
    height: 1000px;
    position: absolute;
    z-index: 199;
    top: auto;
    width: 100%;
    display: none;
}
.waveform{
  display: none;
  padding-bottom: 30px;
}

#selector_musica select, #texte_descriptiu textarea{
  margin: 0 auto;
  margin-bottom:50px;
}
#selector_musica label,#texte_descriptiu label{
  font-size: 3vh;
  color: rgb(242, 201, 95);
  font-weight: 300;
  font-family: "Montserrat";
}
.green-border-focus .form-control:focus {
    border: 1px solid #ff9800;
    box-shadow: 0 0 0 0.2rem rgba(139, 195, 74, .25);
}
</style>

<!--GRABAR AUDIO

<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.3.7/wavesurfer.min.js"></script>
 -->

<!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?=$urlPlugin?>style.css">


<div class="vc_row wpb_row section vc_row-fluid no_log gravador" style=" text-align:left; background-color: white; min-height: 400px;">
  <div id="tapa" name="tapa" style="text-align: center;" ><img src="<?=$urlPlugin?>ball.svg" style="width:30%;"></div>
  <div class=" full_section_inner clearfix">

    <div class="wpb_column vc_column_container vc_col-sm-2">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">          
          <p></p>
        </div>
      </div>
    </div>
    <div class="wpb_column vc_column_container vc_col-sm-8">
      <div class="vc_column-inner">
        <div class="wpb_wrapper" style="text-align: center;">    
        <!--FORMULARI NOVA HISTORIA-->
                  
                  <div class="container" style="background-color: transparent; width: 100%;">
                   
                    <div class="row2" style="background-color: transparent;">
                      <?php
                      switch ($quin_punt_esta) {
                        case 2: //nus
                          ?>
                          <h2 style="font-size: 4vh; padding: 25px; "> Ara podras grabar la trama de la historia, es d elo millor ja que la imaginació ha de estar al 100%</h2>
                          <?php
                          # code...
                          break;

                        case 3: //finalitzacio
                         ?>
                          <h2 style="font-size: 4vh; padding: 25px; "> Finalitza la historia, dona-li el final que es mereix.</h2>
                          <div id="selector_musica">
                            

                            <label for="exampleFormControlSelect1">Selecciona una musica de fons:</label>
                            <select id="musica" name="musica"  class="form-group green-border-focus form-control " style="width: 70%;" >
                              <option value="">Sense Audio</option>
                              <option value="/audios/inspiradora_8k.wav" name="waveformFinal1">Inspiradora</option>
                              <option value="/audios/felicitat_8k.wav" name="waveformFinal2">Felicitat</option>
                              <option value="/audios/intriga_8k.wav" name="waveformFinal3">Intriga</option>
                            </select>
                            <div id="waveformFinal1" class="waveform" style="width: 90%; float: left;">
                                
                            </div>
                            <div  style="width: 10%; float: right;"  class="waveform">
                                <button type="button" id="btn-play2" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-play"></i>
                                </button>
                                <button style="display: none;" type="button" id="btn-stop2" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-stop"></i>
                                </button>
                            </div>

                          </div>
                          <div id="texte_descriptiu"  class="form-group green-border-focus">
                              <label for="text_resum">Escriu 4 paraules de la historia</label>
                              <textarea class="form-control" name="text_resum" id="text_resum" rows="3"  style="width: 70%;" ></textarea>
                            </div>
                          </div>

                          <div style="clear: both;"></div>
                          <script type="text/javascript">
                            
                            var WaveSurferFinal1 = WaveSurfer.create({height:'50',container: '#waveformFinal1', progressColor: "#F2C95F",backgroundColor:"#ff0000"});                          
                            window.addEventListener("resize", function(){
                              // Obten el progreso de acuerdo a la posición del cursor
                              var currentProgress11 = WaveSurferFinal1.getCurrentTime() / WaveSurferFinal1.getDuration();

                              // Resetear gráfica
                              WaveSurferFinal1.empty();
                              WaveSurferFinal1.drawBuffer();
                              // Colocar posición original
                              WaveSurferFinal1.seekTo(currentProgress11);


                              // Activar/Desactivar respectivamente botones

                            }, false);
                            jQuery('#btn-play2').on('click', function() {
                              jQuery('#btn-play2').hide();
                              jQuery('#btn-stop2').show();
                              WaveSurferFinal1.play();
                            });

                            jQuery('#btn-stop2').on('click', function() {
                              jQuery('#btn-stop2').hide();
                              jQuery('#btn-play2').show();
                              WaveSurferFinal1.stop();
                            });

                            jQuery('#musica').on('change', function() {
                              //alert(this.value); 
                              if(this.value==""){
                                jQuery(".waveform").fadeOut();
                              }else{
                                jQuery(".waveform").fadeIn()
                                //jQuery("#"+jQuery("#musica option:selected").attr('name')).fadeIn("slow");
                                WaveSurferFinal1.load(this.value);
                              }
                            });
                          </script>
                          <?php

                          break;
                      }
                      ?>
                      
                     
                      <input type="hidden" name="idHistoria" id="idHistoria" value="<?=$_GET["idHistoria"]?>">
                      <input type="hidden" name="url_audio" id="url_audio" value="">
                      <input type="hidden" name="url_ima" id="url_ima" value="">
                      <input type="hidden" name="user_id" id="user_id" value="<?=$current_user_id?>">
                      <input type="hidden" name="fase" id="fase" value="<?=$quin_punt_esta?>">
                  </div>
                </div>  


          <div id="controls">

            <div class="sonar-wave" style="display: none;"></div>
           <button id="recordButton">Record &nbsp; <span id="countdows">25</span>'</button>
           <button id="pauseButton" disabled>Pause</button>
           <button id="stopButton" disabled>Stop</button>
           <button id="repetirButton" disabled>Repetir</button>
          </div>

         <!-- 
          <canvas id="level" height="200" width="500"></canvas>
      -->
          <div id="formats"></div>
          <p id="escolta"><strong>Escolta la teva historia</strong></p>
          <ol id="recordingsList"></ol>
                      <ul class="ds-btn submit" style="display: none;">                           
                        <li>
                             <a class="btn btn-lg btn-danger" href="#gravador" onclick="envioUpdate();">
                         <i class="glyphicon glyphicon-play-circle pull-left"></i><span>Guardar Historia<br><small style="color: white;"> <br>ja tens el audio, envia i gràcies per participar</small></span></a> 
                            
                        </li>
                        
                    </ul>
          <!-- inserting these scripts at t-->
        </div>
      </div>
    </div>

    <div class="wpb_column vc_column_container vc_col-sm-2">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">          
          <p></p>
        </div>
      </div>
    </div>
  </div>
</div>

<?=do_shortcode("[vc_empty_space]")?>

<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script src="<?=$urlPlugin?>/js/app.js"></script>

<script type="text/javascript">
  
          function envioUpdate(){
            var text_resum=jQuery("#text_resum").val();
            var musica=jQuery('#musica').val();
            var audio=jQuery("#url_audio").val();
            var totOk=true;
            if(text_resum==""){
              jQuery("#text_resum").css("border","solid 2px red");
              totOk=false;
            }           
            if(audio==""){
              totOk=false;
            }
            if(totOk==true){
              jQuery("#tapa").fadeIn("fast");
              //save 
              //jQuery("#upload_link").trigger("click");
              document.getElementById("upload_link").click();
             /* while(jQuery("#acabat").val()!="penjat"){

              }*/
              

            }
          }

</script>



<div class="sharethis-inline-share-buttons"></div>
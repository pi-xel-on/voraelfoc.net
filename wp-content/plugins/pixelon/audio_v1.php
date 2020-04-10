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
echo "<h1>".$histories_noves."---".$histories_update."---".$current_user_id."<h1>";

?>

<?php


    if($current_user_id=="0"){
      ?>
      <script type="text/javascript">
        //alert("123");
        var myVar;
        jQuery( document ).ready(function() {
          myVar = setInterval(openSide, 100);
          jQuery(".no_log").html("");



          jQuery( "#open_side" ).click(function() {
            jQuery(".side_menu_button_link").trigger( "click" );
          });         



        });
        function openSide(){         
          console.log("openSide");
          clearInterval(myVar);
          jQuery(".side_menu_button_link").trigger( "click" );
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
        var myVar;
        jQuery( document ).ready(function() {
          jQuery(".log").html("");

          jQuery( ".selector_continua" ).click(function() {
            console.log("continua una historia");
          });


          jQuery( ".selector_nova" ).click(function() {
            console.log("nova historia");
            crearHistoria();
          });

        });
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
  min-width: 96%;
  margin-bottom: 10px;
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
    top: 20%;
    left: 0%;
    margin: 0;
    padding: 0;
    text-align: left;
    width: 36%;
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

</style>
<!--
<div class="vc_row wpb_row section vc_row-fluid  no_log" style=" text-align:left;">

  <div class=" full_section_inner clearfix">

    <div class="wpb_column vc_column_container vc_col-sm-2">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <p></p>
        </div>
      </div>
    </div>
  
    <div class="wpb_column vc_column_container vc_col-sm-4">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
              <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                   <div class="sonar-wrapper">
                      <div class="sonar-emitter">
                        <div class="numero"><?=$histories_update?><span>Histories continuades</span></div>
                        <div class="sonar-wave"></div>
                        
                      </div>
                    </div>


                </div> 
              </div> 
            </div>
          </div>
    </div>
    <div class="wpb_column vc_column_container vc_col-sm-4">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <div class="sonar-wrapper">
            <div class="sonar-emitter">
              <div class="numero"><?=$histories_noves?><span>Histories noves</span></div>
              <div class="sonar-wave"></div>
              
            </div>
          </div>
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
-->
<!-- un altre apartat -->
<!--  
  <div class=" full_section_inner clearfix">

    <div class="wpb_column vc_column_container vc_col-sm-2">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
          <p></p>
        </div>
      </div>
    </div>
  
    <div class="wpb_column vc_column_container vc_col-sm-4">
        <div class="vc_column-inner">
            <div class="wpb_wrapper">
              <div class="wpb_text_column wpb_content_element ">
                <div class="wpb_wrapper">
                     <ul class="ds-btn">
                           
                        <li>
                             <a class="btn btn-lg btn-danger" href="#">
                         <i class="glyphicon glyphicon-play-circle pull-left"></i><span>Continuar Historia<br><small>continua una historia, <br>veure que divertit potser formar part d'ella</small></span></a> 
                            
                        </li>
                        
                    </ul>

                </div> 
              </div> 
            </div>
          </div>
    </div>
    <div class="wpb_column vc_column_container vc_col-sm-4">
      <div class="vc_column-inner">
        <div class="wpb_wrapper">
                     <ul class="ds-btn">
                            <li>
                                   <a class="btn btn-lg btn-warning" href="#">
                            <i class="glyphicon glyphicon-plus pull-left"></i><span>Nova Historia<br><small>crea el principi de una historia <br>i deixa que la comunitat la continui</small></span></a> 
                            </li>
                            
                        </ul>
                    </div>
              
            </div>
          </div>
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

-->
<!--GRABAR AUDIO-->


<!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?=$urlPlugin?>style.css">


<div class="vc_row wpb_row section vc_row-fluid no_log gravador" style=" text-align:left; background-color: white; display: block !important;">
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
          <!--FORMULARI NOVA HISTORIA
                  
                  <div class="container" style="background-color: white; width: 100%;">
                    <p><input placeholder="Titol de la historia" id="titol" name="titol" style="font-size: 30px; width: 100%; margin-top: 15px; margin-bottom: 15px;"></p>
                    <div class="row2" style="background-color: white;">

                      <div >
                        <form method="post" action="#" id="#" style="background-color: #ccc;">
                          <label for="exampleInputEmail1">
                            <span class="lang lang_ca" style="font-size: 2vh;">Pren-te una foto ben xula per a la teva historia.</span>
                          </label>
                          <div class="form-group files">
                            <input type="file" id="upload_ima" class="form-control" multiple="" style="font-size: 2vh;">
                  <div id='preview' style="padding: 10px;"><img class="shareable-class"  src='' style="width: 100%"></div>
                          </div>
                        </form>
                      </div>
                      
                  </div>
                </div>  
                -->

                <div>      
                  <div id="controls" >
                  <div class="sonar-wave" style="display: block;"></div>  
                  <button id="recordButton">Enregistra &nbsp;  <span id="countdows">20</span>'</button>
                    
                   <button id="pauseButton" disabled>Pause</button>
                   <button id="stopButton" disabled>Stop</button>
                  </div>
                </div>
         <!-- 
          <canvas id="level" height="200" width="500"></canvas>
      -->
                <p><strong>Recordings:</strong></p>
                <ol id="recordingsList"></ol>
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

<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script src="<?=$urlPlugin?>/js/app.js"></script>

<script type="text/javascript">
  


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
</script>

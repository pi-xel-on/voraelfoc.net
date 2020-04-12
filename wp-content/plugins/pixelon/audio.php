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

        var fileUpload;
        var myVar;
        jQuery( document ).ready(function() {
          jQuery(".log").html("");

          jQuery( ".selector_continua" ).click(function() {
            console.log("continua una historia");

            location.href="https://voraelfoc.net/continua-una-historia/";
          });


          jQuery( ".selector_nova" ).click(function() {
            console.log("nova historia");
            permisosMicro();
            crearHistoria();
          });

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
          <?php
          if(isset($_GET["nova_historia"])){
          ?>
              permisosMicro();
              crearHistoria();          
          <?php  
          }
          ?>


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
  bottom:35px;;
  left:0;
  right:0;
  display:block;
  text-align:center;
  color:rgba(255,255,255,1);
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
</style>

<!--GRABAR AUDIO-->


<!-- Latest compiled and minified Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?=$urlPlugin?>style.css">


<div class="vc_row wpb_row section vc_row-fluid no_log gravador" style=" text-align:left; background-color: white;">
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
                  
                  <div class="container" style="background-color: white; width: 100%;">
                    <p><input placeholder="Títol de la història" id="titol" name="titol" style="font-size: 30px; width: 100%; margin-top: 15px; margin-bottom: 15px;" maxlength="16"></p>
                    <div class="row2" style="background-color: white;">

                      <div >
                        <form method="post" action="#" id="form_ima" style="background-color: #ccc; margin-bottom: 20px;">
                          <label for="exampleInputEmail1">
                            <span class="lang lang_ca" style="font-size: 2vh;">Pren-te una foto ben bonica per a la teva història.</span>
                          </label>
                          <div class="form-group files">
                            <input type="file" id="upload_ima" class="form-control" multiple="" style="font-size: 2vh;">
                  <div id='preview' style="padding: 10px;"><img class="shareable-class"  src='' style="width: 100%"></div>
                          </div>
                        </form>
                      </div>
                      <input type="hidden" name="url_audio" id="url_audio" value="">
                      <input type="hidden" name="url_ima" id="url_ima" value="">
                      <input type="hidden" name="user_id" id="user_id" value="<?=$current_user_id?>">
                      <input type="hidden" name="fase" id="fase" value="1">
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
                             <a class="btn btn-lg btn-danger" href="#gravador" onclick="envioNou();">
                         <i class="glyphicon glyphicon-play-circle pull-left"></i><span>Guardar el fragment<br><small style="color: white;"> <br>Assegurat de tindre la imatge i el títol omplerts</small></span></a> 
                            
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

<script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
<script src="<?=$urlPlugin?>/js/app.js"></script>

<script type="text/javascript">
  
          function envioNou(){
            var titol=jQuery("#titol").val();
            var ima=jQuery('#url_ima').val();
            var audio=jQuery("#url_audio").val();
            var totOk=true;
            if(titol==""){
              jQuery("#titol").css("border","solid 2px red");
              totOk=false;
            }
            if(typeof ima === "undefined"){
              totOk=false;
              jQuery("#form_ima").css("border","solid 2px red");
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


<?php
        
//echo "<pre>";	print_r($atts);	echo "</pre>";
	if(isset($atts["color_seccio"])){
		$color_seccio=$atts["color_seccio"];
	}else{
		$color_seccio="#000";
	}
	$urlTheme=get_template_directory_uri();//("template_directory");
	$urlPlugin= plugin_dir_url( __FILE__ );//("template_directory");

	$sql="select * from histories WHERE id=".$_GET["idHistoria"]." LIMIT 1";
	$historia=mysqli_query($db,$sql); 
	//$historia=$wp_query->results('select * from histories');
	$ima="-1";
    $sound_inici="-1";
    $usu_intro="-1";
    $sound_nus="-1";  
    $usu_nus="-1";
    $sound_final="-1";
    $usu_final="-1";
    $text_resum="-1";
    $titol="-1";

	foreach ($historia as $result) {
	    //var_dump($result);
	    $ima=$result["ima"];
	    $sound_inici=$result["audio_intro"];
	    $usu_intro=$result["usu_intro"];

	    $sound_nus=$result["audio_nus"];	    
	    $usu_nus=$result["usu_nus"];

	    $sound_final=$result["audio_final"];
	    $usu_final=$result["usu_final"];

	    $text_resum=$result["text_resum"];
	    $titol=$result["titol"];

	    $musica_fons=$result["musica_fons"];
	}

	$current_user_id = get_current_user_id();

	$quin_punt_esta=2; //anem pel nus
	$text_banner="continua";
	if ($sound_nus != ""){
		$quin_punt_esta=3; //falta el desenllaç
		$text_banner="finalitza";
	}
	if ($sound_final != ""){
		$quin_punt_esta=4;  //finalitzat
	}

	if(($current_user_id == $usu_intro) or ($current_user_id == $usu_nus) or ($current_user_id == $usu_final) or  $quin_punt_esta==4  ){
		$he_colaborat=true;
	}else{
		$he_colaborat=false;
	}
	if($current_user_id=="0"){
		$he_colaborat=false;
	}
	//echo $current_user_id."---".$he_colaborat;
	?>
	<style type="text/css">
		h2{
			text-align: center;
			font-size: 3.2vh !important;
			color: #F2C95F !important;			
    		font-weight: 300 !important;
		}
		.btn-circle.btn-xl {
    width: 180px;
    height: 180px;
    padding: 10px 60px;
    border-radius: 500px;
    font-size:100px;
    line-height: 1.33;
}
	.btn-circle.btn-xl2 {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.42857;
}
.title_size_small{
	/*
	background-position: center center !important;
    background-size: contain !important;
*/
}
.nom_usu{
	text-align: center;
	color: #f2c95f;
}
 .selector_continua,.selector_nova{
    cursor: pointer;
    position: relative !important;
  }
 #text_resum{
   font-size: 3vh !important;
  color: rgb(242, 201, 95);
  font-weight: 300;
  font-family: "Montserrat";
  text-transform: none !important;
 }
 .no_sound{
 	background: url(https://voraelfoc.net/wp-content/uploads/2020/04/Retro-Microphone-2.png) no-repeat center 20px #1d1d1d;
    width: 100%;
    height: 140px;
    background-size: contain;
    text-align: center;
    font-size: 3vh;
    color: #f5f3ee;
    font-weight: 200 !important;
    font-family: "Montserrat";
    padding-top: 0%;
    cursor: pointer;
 } 
	</style>	
	<script type="text/javascript">
		//cambio el background pagina
		jQuery(".has_fixed_background").css({'background-image':'url(<?=$urlPlugin?><?=$ima?>)'});
		jQuery(".image.not_responsive").html('<img itemprop="image" src="<?=$urlPlugin?><?=$ima?>" alt="&nbsp;">');
		//cambio titol de la pagina
		jQuery(".title_subtitle_holder_inner span").html('<?=$titol?>');
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/wavesurfer.js/1.3.7/wavesurfer.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- un div donde será colocado el canvas -->
		<?php
		/*FICO  TEXT DE RESUM SI JA HA FINALITZAT LA HISTORIA*/
		if($quin_punt_esta==4){
		?>
		<div class=" full_section_inner clearfix">
			<div class="wpb_column vc_column_container vc_col-sm-12">
			  <div class="vc_column-inner">
			    <div class="wpb_wrapper" style="text-align: center">  			
			    	<h3 id="text_resum">
			    		<?=$text_resum?>
			    	</h3>
			    </div>
			  </div>
			</div>
		</div>

		<?php

		echo do_shortcode("[vc_empty_space]");
		echo do_shortcode('[vc_zigzag color="orange"]');		
		echo do_shortcode("[vc_empty_space]");
		}
		?>
		<!---/*apartat de audios */-->
		<div class=" full_section_inner clearfix" style="margin-bottom: 30px">
			<div class="wpb_column vc_column_container vc_col-sm-4">
			  <div class="vc_column-inner">
			    <div class="wpb_wrapper">   
			    	<h2>Plantejament</h2>
			    	<p class="nom_usu"><?php echo getName($usu_intro);	?></p> 			    	      
			      
			    	<?php echo  ($sound_inici != "") ? '<div id="audio-spectrum-intro"></div>' : '<img src="https://voraelfoc.net/wp-content/uploads/2020/04/Retro-Microphone.png" style="width:100%">'; ?>          
			      
			    </div>
			  </div>
			</div>

			<div class="wpb_column vc_column_container vc_col-sm-4">
			  <div class="vc_column-inner">
			    <div class="wpb_wrapper">  
			    	<h2>Nus</h2>
			    	<p class="nom_usu"><?php echo getName($usu_nus);	?></p>   
			    	<?php echo   ($sound_nus != "") ? '<div id="audio-spectrum-nus"></div>' : '<div id="audio-spectrum-nus" style="display:none;"></div><div class="no_sound">Continua la Història</div>'; ?>          

			      
			    </div>
			  </div>
			</div>


			<div class="wpb_column vc_column_container vc_col-sm-4">
			  <div class="vc_column-inner">
			    <div class="wpb_wrapper">  
			    	<h2>Desenllaç</h2> 
			    	<p class="nom_usu"><?php echo getName($usu_final);	?></p>        

			    	<?php echo   ($sound_final != "") ? '<div id="audio-spectrum-final"></div>' : '<div id="audio-spectrum-final" style="display:none;"></div><div class="no_sound">Continua la Història</div>'; ?>          
			      
			      <?php echo   ($sound_final != "") ? '' : ''; ?>
			    </div>
			  </div>
			</div>
		</div>
		<?php
		/*FICO  TEXT DE RESUM SI JA HA FINALITZAT LA HISTORIA*/
		if($sound_final!=""){
		?>
		<div class=" full_section_inner clearfix" id="musica_fondo" style="display: none;">
			<div class="wpb_column vc_column_container vc_col-sm-12">
			  <div class="vc_column-inner">
			    <div class="wpb_wrapper" style="text-align: center">  			
			    	 <div id="audio-spectrum-fondo"></div> 
			    	 <script>
			    	 	var WaveSurferFondo = WaveSurfer.create({ partialRender:true,height:'50',container: '#audio-spectrum-fondo', progressColor: "#F2C95F",backgroundColor:"#ff0000"});                          
                        window.addEventListener("resize", function(){

                          // Obten el progreso de acuerdo a la posición del cursor
                          var currentProgressFinal = WaveSurferFondo.getCurrentTime() / WaveSurferFondo.getDuration();

                          // Resetear gráfica
                          WaveSurferFondo.empty();
                          WaveSurferFondo.drawBuffer();
                          // Colocar posición original
                          WaveSurferFondo.seekTo(currentProgressFinal);


                          // Activar/Desactivar respectivamente botones

                        }, false);
                        WaveSurferFondo.on("ready", function(){
					        WaveSurferFondo.setVolume(0.2);
					    });
                         WaveSurferFondo.load('<?=$musica_fons?>');
			    	 </script>
			    </div>
			  </div>
			</div>
		</div>
		<?php		
		}
		?>
		<div class=" full_section_inner clearfix">
			<div class="wpb_column vc_column_container vc_col-sm-12">
			  <div class="vc_column-inner">
			    <div class="wpb_wrapper" style="text-align: center">  			
			    	   	
                     <button  disabled="disabled" type="button" id="btn-pause" class="btn btn-warning btn-circle btn-xl2"><i class="fa fa-pause"></i>
                     </button>    
					<button   disabled="disabled" type="button" id="btn-play" class="btn btn-warning btn-circle btn-xl"><i class="fa fa-play"></i>
                     </button> 
                     <button   disabled="disabled" type="button" id="btn-stop" class="btn btn-warning btn-circle btn-xl2"><i class="fa fa-stop"></i>
                     </button> 
			    </div>
			  </div>
			</div>
		</div>
<?php

		echo do_shortcode("[vc_empty_space]");	
		echo do_shortcode("[vc_empty_space]");
		//si no has colaborat et dono la oportunitat de grabar el següent tros
		if($he_colaborat==false){
			echo do_shortcode("[vc_empty_space]");
		?>

		<div class=" full_section_inner clearfix " id="fila_selector">
			<div class="wpb_column vc_column_container vc_col-sm-12">
			  <div class="vc_column-inner" style="padding: 0;">
			    <div class="wpb_wrapper" style="text-align: center">  			
			    	   <div class="q_elements_holder two_columns responsive_mode_from_768">
				    	   	<div class="q_elements_item <?php echo   ($current_user_id=="0") ? 'selector_registre' : 'selector_continua'; ?> "  data-1024-1280="133px 0px 135px 58%" data-480-600="133px 0px 135px 23%" data-480="133px 0px 135px 23%" data-animation="no" data-item-class="q_elements_holder_custom_223237" style="background-image: url(https://voraelfoc.net/wp-content/uploads/2020/04/fotomicro-1.jpg);background-position: left;vertical-align:top; background-repeat: no-repeat; background-color:white	 "><div class="q_elements_item_inner"><div class="q_elements_item_content q_elements_holder_custom_223237" style="padding:133px 0px 135px 62%"><div class="q_icon_with_title tiny custom_icon_image left_from_title "><div class="icon_text_holder" style=""><div class="icon_text_inner" style=""><div class="icon_title_holder"><div class="icon_holder " style=" "><img itemprop="image" style="" src="https://voraelfoc.net/wp-content/uploads/2018/01/separator.png" alt=""></div><h3 class="icon_title" style="color: #0d0d0d;">Veuràs que divertit pot ser formar part d'ella</h3></div><p style=""></p></div></div></div><div class="separator  transparent   " style="margin-top: -37px;"></div>

								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h2 style="font-weight: 600 !important;"><?=$text_banner?><br>
							<span style="font-weight: 300;">la</span>història</h2>

									</div> 
								</div> </div></div></div>

<!--
							<div class="q_elements_item "  data-1024-1280="133px 0px 135px 58%" data-480-600="133px 0px 135px 23%" data-480="133px 0px 135px 23%" data-animation="no" data-item-class="q_elements_holder_custom_223237" style="background-image: url(https://voraelfoc.net/wp-content/uploads/2018/02/home-single-image-2.jpg);background-position: center;vertical-align:top; background-repeat: no-repeat; ><div class="q_elements_item_inner"><div class="q_elements_item_content q_elements_holder_custom_223237" style="padding:133px 0px 135px 62%"><div class="q_icon_with_title tiny custom_icon_image left_from_title "><div class="icon_text_holder" style=""><div class="icon_text_inner" style=""><div class="icon_title_holder"><div class="icon_holder " style=" "><img itemprop="image" style="" src="https://voraelfoc.net/wp-content/uploads/2018/01/separator.png" alt=""></div><h3 class="icon_title" style="color:white;">llistat de les histores</h3></div><p style=""></p></div></div></div><div class="separator  transparent   " style="margin-top: -37px;"></div>

								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">
										<h2 style="font-weight: 600 !important; color:white !important;">veure <br>
							<span style="font-weight: 300;">més</span>histories</h2>

									</div> 
								</div> </div></div></div>-->
						</div>	


                    
			    </div>
			  </div>
			</div>
		</div>
		<?php
		}
		?>

	<script>
		var audioCont=1;
	 	var buttons = {
            play: document.getElementById("btn-play"),
            pause: document.getElementById("btn-pause"),
            stop: document.getElementById("btn-stop")
        };
        // Manipular boton de reproducir
        buttons.play.addEventListener("click", function(){
        	switch (audioCont){
        		case 1:
        			jQuery(document).scrollTop( jQuery("#audio-spectrum-intro").offset().top -100);  
        			console.log("play 1");
        			Spectrum.play();
        			break;

        		case 2:
        			console.log("play 2");
        			Spectrum2.play();
        			break;
        		case 3:
        			console.log("play 3");
        			Spectrum3.play();
        			break;


        	}
            
            <?php echo  ($musica_fons != "") ? 'WaveSurferFondo.play();' : ''; ?>  
            
            // Activar/Desactivar respectivamente botones
            buttons.stop.disabled = false;
            buttons.pause.disabled = false;
            buttons.play.disabled = true;

        }, false);

        // Manipular boton de pausa
        buttons.pause.addEventListener("click", function(){
        	switch (audioCont){
        		case 1:
        			console.log("pause 1");
        			Spectrum.pause();
        			break;

        		case 2:
        			console.log("pause 2");
        			Spectrum2.pause();
        			break;
        		case 3:
        			console.log("pause 3");
        			Spectrum3.pause();
        			break;


        	}
            
            
 			<?php echo  ($musica_fons != "") ? 'WaveSurferFondo.pause();' : ''; ?>  
            
            // Activar/Desactivar respectivamente botones
            buttons.pause.disabled = true;
            buttons.play.disabled = false;
        }, false);


        // Manipular boton de detener
        buttons.stop.addEventListener("click", function(){
            Spectrum.stop();
            Spectrum2.stop();
            Spectrum3.stop();

 			<?php echo  ($musica_fons != "") ? 'WaveSurferFondo.stop();' : ''; ?>  
            // Activar/Desactivar respectivamente botones
            buttons.pause.disabled = true;
            buttons.play.disabled = false;
            buttons.stop.disabled = true;
        }, false);



	    // Crea una instancia de wave surfer con su configuración predeterminada
	    var Spectrum = WaveSurfer.create({
	        container: '#audio-spectrum-intro',
	        interact: false,
	        normalize:true,
	        hideScrollbar:true,
	        partialRender:true,
	        responsive:true,

	        // Agrega algo de color al especto de audio
	        progressColor: "#F2C95F"
	    });
	    
	    Spectrum.on("ready", function(){
	        // Hacer algo cuando el archivo ya haya sido cargado
	        
	        // Haz lo que sea que necesites con el reproductor:

			Spectrum.setVolume(1);
	        buttons.play.disabled = false;
	        <?php if($quin_punt_esta>2){ ?>
	    	Spectrum2.load('<?=$urlPlugin?>audios/<?=$sound_nus?>');
	    	<?php }?>
	       // Spectrum.pause();
	       // Spectrum.stop();
	    });
	     Spectrum.on("finish", function(){
	        // Hacer algo cuando el archivo ya haya sido cargado
	        Spectrum.pause();
	        //var currentProgress = Spectrum.getCurrentTime() / Spectrum.getDuration();
	        //Spectrum.seekTo(currentProgress);
	        Spectrum2.seekTo(0);
	        Spectrum2.play();
	        jQuery(document).scrollTop( jQuery("#audio-spectrum-nus").offset().top -100);  
	        audioCont=2;
	        // Haz lo que sea que necesites con el reproductor:
	         // buttons.play.disabled = true;
	       // Spectrum.pause();
	       // Spectrum.stop();
	    });


		// Crea una instancia de wave surfer con su configuración predeterminada
	    var Spectrum2 = WaveSurfer.create({
	        container: '#audio-spectrum-nus',
	        interact: false,	        
	        normalize:true,	        
	        hideScrollbar:true,	        
	        partialRender:true,
	        // Agrega algo de color al especto de audio
	        progressColor: "#F2C95F"
	    });
	    
	    Spectrum2.on("ready", function(){
	        // Hacer algo cuando el archivo ya haya sido cargado
	        
			Spectrum2.setVolume(1);

		    <?php if($quin_punt_esta>3){ ?>
		    Spectrum3.load('<?=$urlPlugin?>audios/<?=$sound_final?>');
			<?php } ?>
	    });

	     Spectrum2.on("finish", function(){
	        // Hacer algo cuando el archivo ya haya sido cargado
	        Spectrum2.pause();
	        //var currentProgress = Spectrum.getCurrentTime() / Spectrum.getDuration();
	        //Spectrum.seekTo(currentProgress);
	        Spectrum3.seekTo(0);
	        Spectrum3.play();
	        jQuery(document).scrollTop( jQuery("#audio-spectrum-final").offset().top -100);  
	        audioCont=3;
	        // Haz lo que sea que necesites con el reproductor:
	        
	    });


// Crea una instancia de wave surfer con su configuración predeterminada
	    var Spectrum3 = WaveSurfer.create({
	        container: '#audio-spectrum-final',
	        interact: false,	        
	        normalize:true,
	        hideScrollbar:true,

	        partialRender:true,
	        // Agrega algo de color al especto de audio
	        progressColor: "#F2C95F"
	    });
	    
	    Spectrum3.on("ready", function(){

			Spectrum3.setVolume(1);
	        // Hacer algo cuando el archivo ya haya sido cargado
	        
	        // Haz lo que sea que necesites con el reproductor:
	        //  buttons.play.disabled = false;
	       // Spectrum.pause();
	       // Spectrum.stop();
	    });

		window.addEventListener("resize", function(){
               
/*
                // Obten el progreso de acuerdo a la posición del cursor
                var currentProgress3 = Spectrum3.getCurrentTime() / Spectrum3.getDuration();

                // Resetear gráfica
                Spectrum3.empty();
                Spectrum3.drawBuffer();
                // Colocar posición original
                Spectrum3.seekTo(currentProgress3);


                // Obten el progreso de acuerdo a la posición del cursor
                var currentProgress2 = Spectrum2.getCurrentTime() / Spectrum2.getDuration();

                // Resetear gráfica
                Spectrum2.empty();
                Spectrum2.drawBuffer();
                // Colocar posición original
                Spectrum2.seekTo(currentProgress2);

                // Obten el progreso de acuerdo a la posición del cursor
                var currentProgress = Spectrum.getCurrentTime() / Spectrum.getDuration();

                // Resetear gráfica
                Spectrum.empty();
                Spectrum.drawBuffer();
                // Colocar posición original
                Spectrum.seekTo(currentProgress);

                // Activar/Desactivar respectivamente botones
                if(buttons.play.disabled==false){
                	buttons.pause.disabled = true;
                	buttons.play.disabled = false;
                	buttons.stop.disabled = true;
                	switch (audioCont){
		        		case 1:
		        			
		        			console.log("play 1");
		        			Spectrum.play();
		        			break;

		        		case 2:
		        			console.log("play 2");
		        			Spectrum2.play();
		        			break;
		        		case 3:
		        			console.log("play 3");
		        			Spectrum3.play();
		        			break;


		        	}
            	}else{

            		buttons.pause.disabled = true;
            		buttons.play.disabled = false;
            		buttons.stop.disabled = true;	
            	}
                //buttons.play.click();
*/
                
            }, false);
	    // Carga el audio desde tu propio dominio
	    Spectrum.load('<?=$urlPlugin?>audios/<?=$sound_inici?>');


//metas
jQuery("head").append(' <meta property="og:title" content="Històries vora el foc | Historia | <?=$titol?>" />')

jQuery("head").append('<meta property="og:description" content="Històries vora el foc | Historia | <?=$titol?>" />')
jQuery("head").append('<meta property="og:image" content="<?=$urlPlugin?><?=$ima?>" />      ')
jQuery("head").append('<meta property="og:url" content="https://voraelfoc.net/historia/?idHistoria<?=$_GET["idHistoria"]?>" />')

    
    
    

	</script>




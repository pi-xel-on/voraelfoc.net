$('.button').click(function(){
	var $btn = $(this),
	$step = $btn.parents('.modal-body'),
	stepIndex = $step.index(),
	$pag = $('.modal-header span').eq(stepIndex);
	stepIndexTmp=stepIndex+1;
	
	//if(stepIndex === 0 || stepIndex === 1) { step1($step, $pag); }
	if(stepIndex < (numSteps-1)) { 
		if(stepIndexTmp>1){
			//alert($('input:radio[name=radio'+stepIndexTmp+']:checked').val());
			var selectedValue = $('input:radio[name=radio'+stepIndexTmp+']:checked').val();
			
			if(selectedValue === undefined) //check if user had selected an option
			{
				
				$("#error").fadeIn("slow");
				intervalError = setInterval(alertFunc, 3000);
				
				
				
			}
			else{    
				//alert(selectedValue); // display it
				arrResposta.push(stepIndexTmp-1);
				arrResult.push($('input:radio[name=radio'+stepIndexTmp+']:checked').val());
				step1($step, $pag); 
			}
		}else{
			step1($step, $pag); 	
		}
	}
	else { step3($step, $pag); }
  
});

function alertFunc() {
	clearInterval(intervalError);
	$("#error").fadeOut("fast");
}
function step1($step, $pag){
console.log('step1');
  // animate the step out
  $step.addClass('animate-out');
  
  // animate the step in
  setTimeout(function(){
    $step.removeClass('animate-out is-showing')
         .next().addClass('animate-in');
    $pag.removeClass('is-active')
          .next().addClass('is-active');
  }, 600);
  
  // after the animation, adjust the classes
  setTimeout(function(){
    $step.next().removeClass('animate-in')
          .addClass('is-showing');
    
  }, 1200);
}


function step3($step, $pag){
	console.log('3');	
	arrResposta.reverse();
	arrResult.reverse();
	console.log(arrResposta);
	console.log(arrResult);
	console.log("encuestaID="+idEncuesta+" idUsuario="+idUsuario);
	//guardar BBDD
	$.ajax({
		method: "POST",
		url: urlTheme+"/feedbacks/gravar.php",
		data: { id:id, encuestaID: idEncuesta, idUsuario: idUsuario, respuestas: JSON.stringify(arrResposta) , resultados: JSON.stringify(arrResult)}
		})
		.done(function( msg ) {
			//codificant=false;
			console.log(msg);
		//alert( "Data Saved: " + msg );
	});
	// animate the step out
	
	
	
	$step.parents('.modal-wrap').addClass('animate-up');
	
	setTimeout(function(){
		$('.rerun-button').css('display', 'inline-block');
	  }, 300);
}

	$('.rerun-button').click(function(){
		console.log(arrResult);
		
	//	location.href='https://bclose.net'
	 
	 
	 /*$('.modal-wrap').removeClass('animate-up')
					  .find('.modal-body')
					  .first().addClass('is-showing')
					  .siblings().removeClass('is-showing');
	
	  $('.modal-header span').first().addClass('is-active')
							  .siblings().removeClass('is-active');
	 location.href="https://bclose.net";*/
	});

<?php
//echo "HOLA";
  $histories=mysqli_query($link,$sql); 
  

  ?>
  <style type="text/css">
    .color_vermell{
      color:#f44336;
    }
    .color_verd{
      color:#f2c95f;
    }
    .micro{
      font-size: 25px;
    }
    .historia_block:hover{
      border-bottom: 4px solid #f2c95f;

    } 
    .historia_block{
      border-bottom: 4px solid rgba(0,0,0,0);

    } 
    .titol_home_histories{
      min-height: 85px;
    }

    .text_resum{
      min-height: 80px;
    }
  </style>
  <div class=" section_inner clearfix">
    <div class="section_inner_margin clearfix">
      <?php
      foreach ($histories as $historia) {

      ?>
      <div class="wpb_column vc_column_container vc_col-sm-12 vc_col-lg-3 vc_col-md-6 historia_block" style="padding: 15px;">
        
        <a href="/historia/?idHistoria=<?=$historia["id"]?>" >
        <div class="vc_column-inner">
          <div class="wpb_wrapper">
            <div class="q_icon_with_title tiny custom_icon_image left_from_title ">
              <div class="icon_text_holder" style="">
                <div class="icon_text_inner" style="">
                  <div class="icon_title_holder">
                    <div class="icon_holder " style=" ">
                      <img itemprop="image" style="" src="https://voraelfoc.net/wp-content/uploads/2018/01/separator.png" alt="">
                    </div>
                    <h3 class="icon_title" style="color: #ffffff;">
                    <?php echo getName($historia["usu_intro"]); ?>
                    </h3>
                  </div>
                  <p style=""></p>
                  </div>
                </div>
              </div>  
              <div class="vc_empty_space  vc_custom_1517563513206" style="height: 7px">
                <span class="vc_empty_space_inner">
                  <span class="empty_space_image">
                  
                  </span>
                </span>
              </div>

            <div class="wpb_text_column wpb_content_element ">
              <div class="wpb_wrapper">
                <h2 class="titol_home_histories"><span style="color: #ffffff;"><?=$historia["titol"]?></span></h2>
                <!--<h2><span style="color: #ffffff;">responsive</span></h2>-->
              </div> 
            </div>  
            <!--<div class="vc_empty_space" style="height: 36px">
              <span class="vc_empty_space_inner">
                <span class="empty_space_image"></span>
              </span>
            </div>
            -->
            <div class="wpb_text_column wpb_content_element ">
              <div class="wpb_wrapper">
                <?php
                if($historia["text_resum"]!=""){
                  ?>
                  <p class="text_resum"><?=$historia["text_resum"]?></p>
                <?php 
                }else{
                ?>
                  <p class="text_resum">Pots escoltar el fragment de la història fent clic aquí i completa una història apassionant, fantàstica, de protesta... QUE ET TROBARÀS? </p>
                <?php 
                }?>

                <div><small style="color: #F2C95F;"><i class="fa fa-clock-o " ></i> <?=date("d-m-Y H:i",strtotime($historia["datetime"]))?></small></div>
                <i class="fa fa-microphone micro  <?php echo   ($historia["audio_intro"] != "") ? 'color_verd' : 'color_vermell'; ?>">
                
                </i>
                <i class="fa fa-microphone micro  <?php echo   ($historia["audio_nus"] != "") ? 'color_verd' : 'color_vermell'; ?>"></i>
                <i class="fa fa-microphone micro  <?php echo   ($historia["audio_final"] != "") ? 'color_verd' : 'color_vermell'; ?>"></i>
              </div> 
            </div>  
            <div class="vc_empty_space" style="height: 30px">
              <span class="vc_empty_space_inner">
                <span class="empty_space_image"></span>
              </span>
            </div>
          </div>
        </div>
      </a>
      </div>
      <?php
      }
      ?>  
    </div>
  </div>
  

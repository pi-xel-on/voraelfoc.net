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

?>
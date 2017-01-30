<?php
       
?>

  <div class='sp_uploaded_items sp_display_grid_mode show'>
     
<?php 
      
      $total_strategypartners = (get_option('total_strategypartners')==false)? array() : get_option('total_strategypartners');
  ?>
    <!--image container, can be manupulated with js-->
     <button class='sp-open-select-frame'>Up Load StretegyPartner's Logo</button> 
      <div id="sp_grid_show_container">
          <!--selected images show-->
          <?php 
          
          //$this_item2 = (get_option($total_members[0])==false)? array() : get_option($total_members[0]);
          //echo $this_item2[2];
          
            foreach($total_strategypartners as $key => $value){
                $this_item = (get_option($value)==false)? array() : get_option($value);
                //$this_member[0] = url 1= companyname [2] = website
                ?>
                  <div class="sp_grid_show_item_container">
                        <a target="_blank" href="<?php echo $this_item[2] ?>"><img src="<?php echo $this_item[0] ?>" class="sp_grid_show_item" data-index="<?php echo $key ?>" data-companyname ="<?php echo $this_item[1] ?>" /></a>
                        <div class="sp_grid_show_item_buttons hide">
                            <p class="sp_grid_show_item_companyname"><?php echo $this_item[1] ?></p>
                            <button class='change_grid_show_item left'>Change Title</button>
                            <button class='delete_current_grid_show_item left'>delete</button>
                        </div>
                  </div>          
          <?php
                }
          ?>
          <div class="clear"></div>
      </div>
  </div>
  
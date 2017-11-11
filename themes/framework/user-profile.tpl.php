<?php
//print_r($user_profile);
//drupal_set_title("--");
?>
 <div class="row">
  <div class="col-md-2">
    <br>
    <?php if (isset($user_profile['user_picture']['#markup'])): ?>
      <div id="user-picture">
        <?php print $user_profile['user_picture']['#markup']; ?>
      </div>
    <?php endif; ?>
    <?php if (isset($user_profile['field_experience'][0]['#markup'])): ?>
    Experience <span class="badge"><?php print $user_profile['field_experience'][0]['#markup']; ?></span> Years
    <?php endif; ?>
    
  </div>
  <div class="col-md-10">
    <div class="row">
    <div class="col-md-6">
      <h4>
        <?php if(isset($user_profile['field_name'][0]['#markup'])): ?>
          <?php print trim($user_profile['field_name'][0]['#markup']); ?>
        <?php endif; ?>
        </h4>
      <?PHP  
      if(isset($user_profile['field_location'][0]['#markup']))
              print $user_profile['field_location'][0]['#markup'];
            ?>  
      <?php if(isset($user_profile['field_about'][0]['#markup'])): ?>
          <?php print trim($user_profile['field_about'][0]['#markup']); ?>
        <?php endif; ?>
    </div>
    <div class="col-md-6">  
        For follow buttons
    </div>
      
  </div>
  </div>
  <hr>
  
  

 </div>
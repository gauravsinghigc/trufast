<?php

//function for input fields for forms
function Input(array $formgroup, $label, array $input)
{
 if ($input['required'] == true) {
  $req = "<span class='text-danger'>*</span>";
 } else {
  $req = "";
 }
?>
 <div <?php echo LOOP_TagsAttributes($formgroup); ?>>
  <label><?php echo $label; ?> <?php echo $req; ?></label>
  <input <?php echo LOOP_TagsAttributes($input); ?>>
 </div>
<?php
}

<?php
//label
function Label($text, array $attributes)
{ ?>
 <label <?php LOOP_TagsAttributes($attributes); ?>><?php echo $text; ?></label>
<?php }

//Tags
function Tag($type, array $write, array $attributes = [null])
{
 if ($attributes[0] == null) {
  $attribute = "";
 } else {
  $attribute = LOOP_TagsAttributes($attributes);
 }

 $Response = "<$type " . $attribute . ">";
 foreach ($write as $write) {
  $Response .=  $write;
 }
 $Response .= "</$type>";
 echo $Response;
}

<?php
function not_null($post_data, $vars){
  foreach($vars as $var)
  {
    if(!array_key_exists($var, $post_data) || $post_data[$var] == null)
      return FALSE;
  }

  return TRUE;
}

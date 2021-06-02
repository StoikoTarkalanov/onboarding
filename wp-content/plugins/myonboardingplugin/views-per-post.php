<?php
/**
 * Shows the number of views for a post
 *
 * Finds the current views of a post and displays it together with some optional text
 *
 * @global object $post The post object
 * @uses awepop_get_view_count()
 *
 * @param string $singular The singular term for the text
 * @param string $plural The plural term for the text
 * @param string $before Text to place before the counter
 *
 * @return string $views_text The views display
 *
 */
function awepop_show_views($singular = "view", $plural = "views", $before = "This post has: ") {
   global $post;
   $current_views = awepop_get_view_count();

   $views_text = $before . $current_views . " ";

   if ($current_views == 1) {
      $views_text .= $singular;
   }
   else {
      $views_text .= $plural;
   }

   echo $views_text;

}


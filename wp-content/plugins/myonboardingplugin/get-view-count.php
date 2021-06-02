<?php
/**
 * Retrieve the number of views for a post
 *
 * Finds the current views for a post, returning 0 if there are none
 *
 * @global object $post The post object
 * @return integer $current_views The number of views the post has
 *
 */
function awepop_get_view_count() {
    global $post;
    $current_views = get_post_meta($post->ID, "awepop_views", true);
    if(!isset($current_views) OR empty($current_views) OR !is_numeric($current_views) ) {
       $current_views = 0;
    }
 
    return $current_views;
 }
 
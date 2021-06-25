<?php
   /*
   Plugin Name: Views Count Custom Plugin
   Plugin URI: 
   description: Fist wordpress plugin 
   Version: 1.2
   Author: SST
   Author URI: 
   License: GPL2
   */

   // Get Meta Data And Sets View
   add_action( 'wp_head', 'awepop_add_view' );
   function awepop_add_view() {

      if( is_single() ) {
         global $post;
         $current_views = get_post_meta( $post->ID, 'pop_views', true );
         if(!isset( $current_views ) || empty( $current_views ) || !is_numeric( $current_views ) ) {
            $current_views = 0;
         }
         $new_views = $current_views + 1;
         update_post_meta( $post->ID, 'pop_views', $new_views );
         awepop_show_views();

         return $new_views;
      }
   }

   // Get Views Count
   function awepop_get_view_count() {
      global $post;
      $current_views = get_post_meta( $post->ID , 'pop_views', true );
      
      if ( ! isset( $current_views ) || empty( $current_views ) || ! is_numeric( $current_views ) ) {

         $current_views = 0;
      }

      return $current_views;
   }

   // Display Views
   function awepop_show_views() {
      $singular = 'view'; 
      $plural = 'views';
      $before = 'This post has: ';
      $current_views = awepop_get_view_count();

      $views_text = $before . $current_views . ' ';

      if ( $current_views == 1 ) {
         $views_text .= $singular;
      }
      else {
         $views_text .= $plural;
      }

      echo '<div>';
      echo '<h2>' . $views_text . '</h2>';
      echo '</div>';

   }


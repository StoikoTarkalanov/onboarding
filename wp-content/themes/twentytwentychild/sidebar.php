<?php
if ( is_active_sidebar( 'students-sidebar' ) ) { 
    ?>
        <div style="text-align: center"> 
            <?php dynamic_sidebar( 'students-sidebar' ); ?> 
        </div>
    <?php
}
<?php

/**
 * Functions related to front page featured sections
 */


/**
 * Display featured content top
 */
function hybridmag_display_featured_content_top() { ?>
    <section class="hm-featured-top">
        <?php 
            get_template_part( 'template-parts/featured', 'top' );
            dynamic_sidebar( 'hm-magazine-1' );
        ?>
    </section>
    <?php
}
//add_action( 'hybridmag_featured_section_top', 'hybridmag_display_featured_content_top' );

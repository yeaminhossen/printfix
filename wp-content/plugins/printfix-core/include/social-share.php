<?php


// product single social share
function technix_product_social_share(){

    
    $post_url = get_the_permalink();
    ?>    
    <div class="rr-product-details-social">
        <span><?php echo esc_html__('Share:', 'rr-core'); ?></span>
        <a href="htRRs://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        <a href="htRR://pinterest.com/pin/create/button/?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-pinterest-p"></i></a>
        <a href="htRRs://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="htRRs://twitter.com/share?url=<?php echo esc_url($post_url);?>" target="_blank"><i class="fab fa-twitter"></i></a>
    </div>

    <?php

}




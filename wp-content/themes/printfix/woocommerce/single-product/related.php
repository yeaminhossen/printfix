<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         htbds://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<div class="bd-realted-product-area pt-120 fix">
        <div class="row">
	        <div class="col-12">
	           <div class="bd-section-box bd-section-box-2 p-relative mb-50 text-center">
	              <span class="bd-section-subtitle d-inline-block right mb-10"><?php echo esc_html__( 'Related', 'printfix'); ?></span>
					<?php
					$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'printfix' ) );

					if ( $heading ) :
						?>
						<h2 class="bd-section-title"><?php echo esc_html( $heading ); ?></h2>
					<?php endif; ?>
	           </div>
	        </div>
		</div>


      	<?php
            $related_class = '';
            if (count($related_products) >= 4){
                $related_class = 'related-product-active'; ?>
		        <div class="swiper-container <?php print esc_attr($related_class); ?>">
		        	<div class="swiper-wrapper">
			        	<?php foreach ( $related_products as $related_product ) : ?>
			        		<div class="swiper-slide printfix_related_slide">
								<?php
								$post_object = get_post( $related_product->get_id() );

								setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

								wc_get_template_part( 'content', 'product' );
								?>
							</div>
						<?php endforeach; ?>
		        	</div>
		        </div>
        	<?php
            } else { ?>
            <div class="row">
            	<?php foreach ( $related_products as $related_product ) : ?>
	    		<div class="col-xl-3 col-lg-3 col-md-6">
					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>
				</div>
				<?php endforeach; ?>
			</div>
			<?php
            }
        ?>


	</div>
	<?php
endif;

wp_reset_postdata();

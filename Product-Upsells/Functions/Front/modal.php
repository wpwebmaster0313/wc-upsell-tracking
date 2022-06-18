<?php

/**
 * Renders product info modal for product single upsell
 *
 * @param int $upsell_id - product ID to retrieve data for
 * @return html - returns rendered product data modal
 */
function upsell_v2_product_single_product_info_modal($upsell_id) {
    
    $prod_title   = get_the_title( $upsell_id );
    $short_descr  = wp_strip_all_tags( get_the_excerpt( $upsell_id ) );

    // get required product data
    $gall_img_ids = explode( ',', get_post_meta( $upsell_id, '_product_image_gallery', true ) );

    // render
    ?>
    <!-- modal outer cont -->
    <div id="product-data-<?php echo $upsell_id; ?>" class="upsell-v2-product-single-modal-outer-cont mfp-hide white-popup-block">

        <!-- product data cont -->
        <div class="upsell-v2-product-single-product-data-modal-inner-cont row">

            <!-- title/dismiss container -->
            <div class="upsell-v2-product-single-upsell-modal-header-cont small-12">

                <!-- dismiss -->
                <span class="upsell-v2-product-single-data-modal-dismiss" title="<?php _e('Dismiss', 'woocommerce'); ?>">x</span>

                <!-- product title -->
                <h3><?php echo $prod_title; ?></h3>

            </div>

            <!-- images -->
            <div class="upsell-v2-product-single-product-data-modal-images-cont small-12 medium-6">
                <div class="row">

                    <?php
                    $img_counter = 0;
                    foreach ($gall_img_ids as $img_id) :

                        // get image urls
                        $img_thumb_url = wp_get_attachment_image_url( $img_id, 'thumbnail' );
                        $img_large_url = wp_get_attachment_image_url( $img_id, 'large' );

                        if ($img_counter === 0) :
                            ?>
                            
                            <!-- spinner -->
                            <div id="modal-spinner" class="small-12 spinner" style="display: none;">
                                <img src="<?php echo UPSELL_V2_URI.'Assets/spinner.gif' ?>" alt="">
                            </div>

                            <!-- large image top -->
                            <div class="upsell-v2-product-single-modal-img-big small-12" data-large-src="<?php echo $img_large_url; ?>">
                                <img src="" alt="<?php echo $prod_title; ?>">
                            </div>
                        <?php else : ?>
                            <!-- small images bottom -->
                            <div class="upsell-v2-product-single-modal-img-small small-2" title="<?php _e('Click to view', 'woocommerce'); ?>">
                                <img src="<?php echo $img_thumb_url; ?>" alt="<?php echo $prod_title; ?>" data-large="<?php echo $img_large_url; ?>">
                            </div>
                        <?php
                        endif;
                        $img_counter++;
                    endforeach;
                    ?>

                </div>
            </div>

            <!-- description -->
            <div class="upsell-v2-product-single-product-data-modal-description-cont small-12 medium-6">
                <?php echo $short_descr; ?>
            </div>

            <!-- add to cart -->
            <div class="upsell-v2-checkout-addon-modal-button-cont" class="small-12">
                <button class="upsell-v2-product-single-modal-add-to-cart" data-product-id="<?php echo $upsell_id; ?>"><?php _e('Add To Cart', 'woocommerce'); ?></button>
            </div>

        </div><!-- row -->
    </div><!-- .upsell-v2-product-single-product-data-modal-inner-cont -->
    
    <?php
}

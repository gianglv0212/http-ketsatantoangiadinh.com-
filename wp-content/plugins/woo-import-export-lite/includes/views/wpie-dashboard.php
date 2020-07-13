<?php
global $wpie_init, $wpie_product, $wpie_user, $wpie_order, $wpie_coupon, $wpie_product_category;

$product_count = $wpie_product->wpie_get_product_count();

$product_category_count = $wpie_product_category->wpie_get_product_category_count();

$order_count = count($wpie_order->get_order_list());

$user_count = $wpie_user->wpie_get_user_count();

$coupon_count = $wpie_coupon->wpie_get_coupon_count();
?>
<div class="wpie_success_msg" wpie_wait_msg="<?php _e('Please Wait...', WPIE_TEXTDOMAIN) ?>"><?php _e('Please Wait...', WPIE_TEXTDOMAIN) ?></div>
<div class="wpie-dashboard-page-wrapper">
    <div class="container-fluid offset-10">
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="wpie_dashboard_links" href="<?php echo admin_url('admin.php?page=wpie-products'); ?>"> 
                <div class="wpie-dashboard-section-header wpie-red-section">
                    <div class="wpie-header-title-count"><?php echo $product_count; ?></div>
                    <div class="wpie-header-title-content"><?php _e('Products', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-subtitle"><?php _e('Available product in store.', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-image wpie-product-image"></div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="wpie_dashboard_links" href="<?php echo admin_url('admin.php?page=wpie-product-categories'); ?>"> 
                <div class="wpie-dashboard-section-header wpie-green-section">
                    <div class="wpie-header-title-count"><?php echo $product_category_count; ?></div>
                    <div class="wpie-header-title-content"><?php _e('Categories', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-subtitle"><?php _e('Available Categories for products', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-image wpie-category-image"></div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="wpie_dashboard_links" href="<?php echo admin_url('admin.php?page=wpie-orders'); ?>"> 
                <div class="wpie-dashboard-section-header wpie-aqua-section">
                    <div class="wpie-header-title-count"><?php echo $order_count; ?></div>
                    <div class="wpie-header-title-content"><?php _e('Orders', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-subtitle"><?php _e('Available orders in store', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-image wpie-order-image"></div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="wpie_dashboard_links" href="<?php echo admin_url('admin.php?page=wpie-users'); ?>"> 
                <div class="wpie-dashboard-section-header wpie-blue-section">
                    <div class="wpie-header-title-count"><?php echo $user_count; ?></div>
                    <div class="wpie-header-title-content"><?php _e('Users', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-subtitle"><?php _e('Available users in store', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-image wpie-user-image"></div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a class="wpie_dashboard_links" href="<?php echo admin_url('admin.php?page=wpie-coupons'); ?>"> 
                <div class="wpie-dashboard-section-header wpie-color-section1">
                    <div class="wpie-header-title-count"><?php echo $coupon_count; ?></div>
                    <div class="wpie-header-title-content"><?php _e('Coupons', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-subtitle"><?php _e('Available coupons in store', WPIE_TEXTDOMAIN); ?></div>
                    <div class="wpie-header-title-image wpie-coupon-image"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="wpie-documantation-links-wrapper">
    <div class="wpie-documantation-links-outer">
        <a class="wpie-documantation-links" target="_blank" href="<?php echo "http://www.vjinfotech.com/products/woo-imp-exp/documentation/"; ?>"><?php _e('Documentation', WPIE_TEXTDOMAIN); ?></a>
    </div>
</div>
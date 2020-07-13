<?php

if (!defined('ABSPATH'))
    die("Can't load this file directly");

class WPIE_AUTO_UPDATE {

    function __construct() {

        add_action('admin_init', array(&$this, 'wpie_update_data'));

        add_action('in_plugin_update_message-woo-import-export-lite/woo-import-export-lite.php', array(&$this, 'wpie_upgrade_message_link'));
    }

    function wpie_update_data() {

        global $wpdb, $wpie_new_version, $wpie_product, $wpie_order, $wpie_user, $wpie_product_category, $wpie_coupon;

        if (!isset($wpie_new_version) || $wpie_new_version == "") {
            $wpie_new_version = get_option('wpie_plugin_version');
        }
    }

    function wpie_upgrade_message_link() {
        
    }

}

?>
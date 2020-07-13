<?php

if (!defined('ABSPATH'))
    die("Can't load this file directly");

class WPIE_COUPON {

    function __construct() {

        add_action('wp_ajax_wpie_create_coupon_preview', array(&$this, 'wpie_create_coupon_preview'));

        add_action('wp_ajax_wpie_get_coupon_export_preview', array(&$this, 'wpie_get_coupon_export_preview'));

        add_action('wp_ajax_wpie_save_coupon_fields', array(&$this, 'wpie_save_coupon_fields'));

        add_action('wp_ajax_wpie_get_coupon_import_preview', array(&$this, 'wpie_get_coupon_import_preview'));
    }

    function wpie_get_coupon_count() {

        $query_args = array(
            'posts_per_page' => -1,
            'post_type' => 'shop_coupon',
            'post_status' => 'publish',
            'fields' => 'ids',
        );

        $total_coupon = count(get_posts($query_args));

        return $total_coupon;
    }

    function get_coupon_list() {
        $query_args = array(
            'posts_per_page' => 2000,
            'post_type' => 'shop_coupon',
            'post_status' => 'publish',
            'orderby' => 'ID',
            'order' => 'ASC',
        );

        $coupon_list = get_posts($query_args);

        return $coupon_list;
    }

    function get_updated_coupon_fields() {

        $old_coupon_fields = $this->get_new_coupon_fields();

        $new_fields = get_option('wpie_coupon_fields', $old_coupon_fields);

        $new_fields = maybe_unserialize($new_fields);

        return $new_fields;
    }

    function get_new_coupon_fields() {

        $coupon_fields = maybe_serialize($this->get_coupon_fields());

        return $coupon_fields;
    }

    function get_coupon_fields() {
        $get_coupon_fields = array(
            'coupon_fields' => array(
                array(
                    'field_key' => 'ID',
                    'field_display' => 1,
                    'field_title' => 'Id',
                    'field_value' => 'Id',
                ),
                array(
                    'field_key' => 'post_title',
                    'field_display' => 1,
                    'field_title' => 'Code',
                    'field_value' => 'Code',
                ),
                array(
                    'field_key' => 'coupon_amount',
                    'field_display' => 1,
                    'field_title' => 'Coupon Amount',
                    'field_value' => 'Coupon Amount',
                ),
                array(
                    'field_key' => 'post_date',
                    'field_display' => 1,
                    'field_title' => 'Created Date',
                    'field_value' => 'Created Date',
                ),
                array(
                    'field_key' => 'expiry_date',
                    'field_display' => 1,
                    'field_title' => 'Expiry Date',
                    'field_value' => 'Expiry Date',
                ),
                array(
                    'field_key' => 'post_excerpt',
                    'field_display' => 1,
                    'field_title' => 'Description',
                    'field_value' => 'Description',
                ),
                array(
                    'field_key' => 'discount_type',
                    'field_display' => 1,
                    'field_title' => 'Discount Type',
                    'field_value' => 'Discount Type',
                ),
                array(
                    'field_key' => 'post_type',
                    'field_display' => 1,
                    'field_title' => 'Post Type',
                    'field_value' => 'Post Type',
                ),
                array(
                    'field_key' => 'post_name',
                    'field_display' => 1,
                    'field_title' => 'Coupon Name',
                    'field_value' => 'Coupon Name',
                ),
                array(
                    'field_key' => 'individual_use',
                    'field_display' => 1,
                    'field_title' => 'Individual Use',
                    'field_value' => 'Individual Use',
                ),
                array(
                    'field_key' => 'product_ids',
                    'field_display' => 1,
                    'field_title' => 'Product Ids',
                    'field_value' => 'Product Ids',
                ),
                array(
                    'field_key' => 'usage_limit',
                    'field_display' => 1,
                    'field_title' => 'Usage Limit',
                    'field_value' => 'Usage Limit',
                ),
                array(
                    'field_key' => 'free_shipping',
                    'field_display' => 1,
                    'field_title' => 'Free Shipping',
                    'field_value' => 'Free Shipping',
                ),
                array(
                    'field_key' => 'post_status',
                    'field_display' => 1,
                    'field_title' => 'Post Status',
                    'field_value' => 'Post Status',
                ),
                array(
                    'field_key' => 'coupon_attributes',
                    'field_display' => 1,
                    'field_title' => 'Attributes',
                    'field_value' => 'Attributes',
                ),
                array(
                    'field_key' => 'post_parent',
                    'field_display' => 1,
                    'field_title' => 'Product Parent id',
                    'field_value' => 'Product Parent id',
                ),
                array(
                    'field_key' => 'menu_order',
                    'field_display' => 1,
                    'field_title' => 'Menu Order',
                    'field_value' => 'Menu Order',
                ),
                array(
                    'field_key' => 'comment_status',
                    'field_display' => 1,
                    'field_title' => 'Comment Status',
                    'field_value' => 'Comment Status',
                ),
                array(
                    'field_key' => 'ping_status',
                    'field_display' => 1,
                    'field_title' => 'Ping Status',
                    'field_value' => 'Ping Status',
                ),
            ),
        );

        return $get_coupon_fields;
    }

    function wpie_get_coupon_export_log() {
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "wpie_export_log where (`export_log_file_type` = 'csv' or `export_log_file_type` = 'export') and `export_log_data`='Coupon' ORDER BY `export_log_id` DESC");

        return $results;
    }

    function wpie_get_coupon_import_log() {
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "wpie_export_log where `export_log_file_type` = 'import' and `export_log_data`='Coupon' ORDER BY `export_log_id` DESC");

        return $results;
    }

    function get_coupon_export_fields_data() {

        $csv_data = "";

        $coupon_field_list = $this->get_updated_coupon_fields();

        $count = 0;

        foreach ($coupon_field_list['coupon_fields'] as $field_data) {
            if ($field_data['field_display'] == 1) {

                $csv_data[$count][] = $field_data['field_value'];
            }
        }

        return $csv_data;
    }

    function wpie_create_coupon_filter_query($wpie_data) {

        $coupon_ids = isset($wpie_data['wpie_coupon_ids']) ? $wpie_data['wpie_coupon_ids'] : array();

        $total_records = isset($wpie_data['wpie_total_records']) ? $wpie_data['wpie_total_records'] : "";

        $offset_records = isset($wpie_data['wpie_offset_records']) ? $wpie_data['wpie_offset_records'] : "";

        $temp_start_date = isset($wpie_data['wpie_start_date']) ? $wpie_data['wpie_start_date'] : "";

        $temp_end_date = isset($wpie_data['wpie_end_date']) ? $wpie_data['wpie_end_date'] : "";

        $end_date = "";

        $start_date = "";

        if ($temp_start_date != "") {
            $temp_start_date = explode('-', $temp_start_date);

            $start_date = $temp_start_date[2] . '-' . $temp_start_date[0] . '-' . $temp_start_date[1];
        }
        if ($temp_end_date != "") {
            $temp_end_date = explode('-', $temp_end_date);

            $end_date = $temp_end_date[2] . '-' . $temp_end_date[0] . '-' . $temp_end_date[1];
        }


        $query_args = array(
            'posts_per_page' => -1,
            'post_type' => 'shop_coupon',
            'orderby' => 'ID',
            'order' => 'ASC',
        );


        if (!empty($coupon_ids)) {
            $query_args['post__in'] = $coupon_ids;
        }

        if ($total_records != "" && $total_records > 0) {
            $query_args['posts_per_page'] = $total_records;

            if ($offset_records != "" && $offset_records >= 0) {
                $query_args['offset'] = $offset_records;
            }
        }

        if ($end_date != "" || $start_date != "") {
            $date_data = array();

            if ($end_date != "") {
                $date_data['before'] = $end_date . " 23:59:59";
            }

            if ($start_date != "") {
                $date_data['after'] = $start_date . " 00:00:00";
            }

            $date_data['inclusive'] = true;

            $query_args['date_query'] = array($date_data);
        }

        return json_encode($query_args);
    }

    function get_filter_coupon_data($coupon_query, $start_coupon, $total_records = 0, $coupon_offset, $coupon_limit) {
        global $wpie_get_record_count;

        $coupon_data_list = array();

        if ($coupon_limit != "" && $total_records >= $coupon_limit) {
            $total_records = $coupon_limit;
            $coupon_data_list['status'] = "completed";
        }
        if ($coupon_offset != "" && $start_coupon == 0) {
            $start_coupon = $coupon_offset;
        }
        if ($total_records == 0) {
            $total_records = $wpie_get_record_count;
        }

        $query_args = json_decode(stripslashes($coupon_query), 1);

        $query_args['posts_per_page'] = $total_records;

        $query_args['offset'] = $start_coupon;

        $coupon_results = new WP_Query($query_args);

        $coupon_list = $coupon_results->get_posts();

        if (!empty($coupon_list)) {
            foreach ($coupon_list as $new_coupon) {
                $coupon_meta = get_post_meta($new_coupon->ID);

                if (isset($coupon_meta['product_ids'][0]) && $coupon_meta['product_ids'][0] != "") {
                    $coupon_product_ids = $this->get_coupons_product_sku($coupon_meta['product_ids'][0]);
                } else {
                    $coupon_product_ids = "";
                }
                if (isset($coupon_meta['exclude_product_ids'][0]) && $coupon_meta['exclude_product_ids'][0] != "") {
                    $exclude_product_ids = $this->get_coupons_product_sku($coupon_meta['exclude_product_ids'][0]);
                } else {
                    $exclude_product_ids = "";
                }
                if (isset($coupon_meta['product_categories'][0]) && $coupon_meta['product_categories'][0] != "") {
                    $coupon_product_categories = $this->get_product_categories_slug($coupon_meta['product_categories'][0]);
                } else {
                    $coupon_product_categories = "";
                }
                if (isset($coupon_meta['exclude_product_categories'][0]) && $coupon_meta['exclude_product_categories'][0] != "") {
                    $exclude_product_categories = $this->get_product_categories_slug($coupon_meta['exclude_product_categories'][0]);
                } else {
                    $exclude_product_categories = "";
                }

                $coupon_meta['coupon_product_ids'][0] = $coupon_product_ids;

                $coupon_meta['coupon_exclude_product_ids'][0] = $exclude_product_ids;

                $coupon_meta['coupon_product_categories'][0] = $coupon_product_categories;

                $coupon_meta['coupon_exclude_product_categories'][0] = $exclude_product_categories;

                $new_coupon->coupon_attributes = maybe_serialize($coupon_meta);

                $new_coupon->coupon_amount = $coupon_meta['coupon_amount'][0];

                $new_coupon->expiry_date = $coupon_meta['expiry_date'][0];

                $new_coupon->discount_type = $coupon_meta['discount_type'][0];

                $new_coupon->individual_use = $coupon_meta['individual_use'][0];

                $new_coupon->product_ids = $this->get_coupons_product_sku($coupon_meta['product_ids'][0]);

                $new_coupon->usage_limit = $coupon_meta['usage_limit'][0];

                $new_coupon->free_shipping = $coupon_meta['free_shipping'][0];

                $coupon_data_list['coupon_data'][] = $new_coupon;
                $start_coupon++;

                $coupon_data_list['start_coupon'] = $start_coupon;

                if ($coupon_limit != "" && $coupon_limit > 0) {
                    $coupon_limit--;
                    $coupon_data_list['coupon_limit'] = $coupon_limit;
                    if ($coupon_data_list['coupon_limit'] == 0) {
                        $coupon_data_list['status'] = "completed";
                        break;
                    }
                }
            }
        }

        wp_reset_postdata();

        return $coupon_data_list;
    }

    function get_coupons_product_sku($product_list = "") {
        $product_data = array();

        if ($product_list != "") {
            $product_ids = explode(',', $product_list);

            if (!empty($product_ids)) {
                foreach ($product_ids as $product_id) {
                    $new_product_sku = get_post_meta($product_id, '_sku', true);

                    if ($new_product_sku != "") {
                        $product_data[$product_id] = $new_product_sku;
                    }
                }
            }
        }
        return implode(',', $product_data);
    }

    function get_product_categories_slug($categories_list = "") {
        $categories_data = array();

        $categories_ids = maybe_unserialize(maybe_unserialize($categories_list));

        if (!empty($categories_ids)) {
            foreach ($categories_ids as $categories_id) {
                if (!isset($categories_data[$categories_id]) || $categories_data[$categories_id] == "") {
                    $new_category = get_term_by('id', $categories_id, 'product_cat');

                    if (isset($new_category->slug) && $new_category->slug != "") {
                        $categories_data[$categories_id] = $new_category->slug;
                    }
                }
            }
        }

        return implode(',', $categories_data);
    }

    function wpie_create_coupon_preview() {

        $return_value = array();

        $coupon_query_data = $this->wpie_create_coupon_filter_query($_POST);

        $return_value['message'] = 'success';

        $return_value['coupon_query'] = $coupon_query_data;

        $return_value['coupon_offset'] = isset($_POST['wpie_offset_records']) ? $_POST['wpie_offset_records'] : "";

        $return_value['coupon_limit'] = isset($_POST['wpie_total_records']) ? $_POST['wpie_total_records'] : "";

        $return_value['total_coupons'] = $this->get_coupon_total_records_count(json_decode($coupon_query_data, 1));

        echo json_encode($return_value);

        die();
    }

    function get_coupon_total_records_count($query_args) {

        $query_args['fields'] = "ids";

        $product_results = new WP_Query($query_args);

        return count($product_results->get_posts());
    }

    function wpie_get_coupon_export_preview() {

        $return_value = array();

        $record_offset = isset($_POST['start']) ? $_POST['start'] : 0;

        $record_limit = isset($_POST['length']) ? $_POST['length'] : 0;

        $data_query = isset($_POST['coupon_query']) ? $_POST['coupon_query'] : "";

        $total_coupons = isset($_POST['total_coupons']) ? $_POST['total_coupons'] : 0;

        $coupon_limit = isset($_POST['coupon_limit']) ? $_POST['coupon_limit'] : 0;

        $coupon_limit = $coupon_limit - $record_offset;

        $coupon_offset = isset($_POST['coupon_offset']) ? $_POST['coupon_offset'] : 0;

        $product_list_data = $this->get_filter_coupon_data($data_query, $record_offset, $record_limit, $coupon_offset, $coupon_limit);

        $final_data = array();

        $coupon_field_list = $this->get_updated_coupon_fields();

        foreach ($product_list_data['coupon_data'] as $coupon_info) {

            $data_result = array();

            if (!empty($coupon_info)) {
                foreach ($coupon_field_list['coupon_fields'] as $field_data) {

                    if ($field_data['field_display'] == 1) {

                        $temp_data = $field_data['field_key'];

                        $data_result[] = isset($coupon_info->$temp_data) ? $coupon_info->$temp_data : "";
                    }
                }
            }

            $final_data[] = $data_result;
        }

        $return_value['data'] = $final_data;

        $return_value['message'] = 'success';

        $return_value['recordsFiltered'] = $total_coupons;

        $return_value['recordsTotal'] = $total_coupons;

        echo json_encode($return_value);

        die();
    }

    function wpie_save_coupon_fields() {

        $old_coupon_fields = $this->get_updated_coupon_fields();

        $new_fields = array();

        foreach ($old_coupon_fields as $coupon_fields_key => $coupon_fields_data) {

            foreach ($coupon_fields_data as $key => $value) {

                $new_fields[$coupon_fields_key][$key]['field_key'] = $value['field_key'];

                $new_fields[$coupon_fields_key][$key]['field_display'] = isset($_POST['wpie_' . $value['field_key'] . '_field_check']) ? $_POST['wpie_' . $value['field_key'] . '_field_check'] : "";

                $new_fields[$coupon_fields_key][$key]['field_title'] = $value['field_title'];

                $new_fields[$coupon_fields_key][$key]['field_value'] = $value['field_title']; //isset($_POST['wpie_' . $value['field_key'] . '_field']) ? $_POST['wpie_' . $value['field_key'] . '_field'] : "";
            }
        }

        $new_fields_data = maybe_serialize($new_fields);

        update_option('wpie_coupon_fields', $new_fields_data);

        $return_value = array();

        $return_value['message'] = 'success';

        $return_value['message_content'] = __('Changes Saved Successfully.', WPIE_TEXTDOMAIN);

        $return_value['preview_fields'] = $this->get_coupon_preview_fields();

        echo json_encode($return_value);

        die();
    }

    function get_coupon_preview_fields() {

        $coupon_fields = $this->get_updated_coupon_fields();

        $preview_fields_data = '<table class="wpie-product-filter-data wpie-datatable table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>';

        foreach ($coupon_fields as $new_coupon_fields) {
            foreach ($new_coupon_fields as $coupon_fields_data)
                if ($coupon_fields_data['field_display'] == 1) {
                    $preview_fields_data .= '<th>' . $coupon_fields_data['field_title'] . '</th>';
                }
        }

        $preview_fields_data .="   </tr>

                </thead>
            </table>";
        return $preview_fields_data;
    }

    function get_coupon_export_data($wpie_data = array()) {
        $csv_data = "";

        $coupon_field_list = $this->get_updated_coupon_fields();

        $coupon_list_data = $this->get_filter_coupon($wpie_data);

        $count = 0;

        foreach ($coupon_field_list['coupon_fields'] as $field_data) {
            if ($field_data['field_display'] == 1) {

                $csv_data[$count][] = $field_data['field_value'];
            }
        }

        foreach ($coupon_list_data as $coupon_info) {
            $count++;

            $data_result = array();

            foreach ($coupon_field_list['coupon_fields'] as $field_data) {


                if ($field_data['field_display'] == 1) {
                    $temp_data = $field_data['field_key'];
                    $data_result[] = isset($coupon_info->$temp_data) ? $coupon_info->$temp_data : "";
                }
            }

            $csv_data[$count] = $data_result;
        }

        return $csv_data;
    }

    function get_filter_coupon($wpie_data) {

        $coupon_ids = isset($wpie_data['wpie_coupon_ids']) ? $wpie_data['wpie_coupon_ids'] : array();

        $total_records = isset($wpie_data['wpie_total_records']) ? $wpie_data['wpie_total_records'] : "";

        $offset_records = isset($wpie_data['wpie_offset_records']) ? $wpie_data['wpie_offset_records'] : "";

        $temp_start_date = isset($wpie_data['wpie_start_date']) ? $wpie_data['wpie_start_date'] : "";

        $temp_end_date = isset($wpie_data['wpie_end_date']) ? $wpie_data['wpie_end_date'] : "";

        $end_date = "";

        $start_date = "";

        if ($temp_start_date != "") {
            $temp_start_date = explode('-', $temp_start_date);

            $start_date = $temp_start_date[2] . '-' . $temp_start_date[0] . '-' . $temp_start_date[1];
        }
        if ($temp_end_date != "") {
            $temp_end_date = explode('-', $temp_end_date);

            $end_date = $temp_end_date[2] . '-' . $temp_end_date[0] . '-' . $temp_end_date[1];
        }


        $query_args = array(
            'posts_per_page' => -1,
            'post_type' => 'shop_coupon',
            'orderby' => 'ID',
            'order' => 'ASC',
        );


        if (!empty($coupon_ids)) {
            $query_args['post__in'] = $coupon_ids;
        }

        if ($total_records != "" && $total_records > 0) {
            $query_args['posts_per_page'] = $total_records;

            if ($offset_records != "" && $offset_records >= 0) {
                $query_args['offset'] = $offset_records;
            }
        }

        if ($end_date != "" || $start_date != "") {
            $date_data = array();

            if ($end_date != "") {
                $date_data['before'] = $end_date . " 23:59:59";
            }

            if ($start_date != "") {
                $date_data['after'] = $start_date . " 00:00:00";
            }

            $date_data['inclusive'] = true;

            $query_args['date_query'] = array($date_data);
        }

        $coupon_results = new WP_Query($query_args);

        $coupon_list = $coupon_results->get_posts();

        if (!empty($coupon_list)) {
            foreach ($coupon_list as $new_coupon) {
                $coupon_meta = get_post_meta($new_coupon->ID);

                if (isset($coupon_meta['product_ids'][0]) && $coupon_meta['product_ids'][0] != "") {
                    $coupon_product_ids = $this->get_coupons_product_sku($coupon_meta['product_ids'][0]);
                } else {
                    $coupon_product_ids = "";
                }
                if (isset($coupon_meta['exclude_product_ids'][0]) && $coupon_meta['exclude_product_ids'][0] != "") {
                    $exclude_product_ids = $this->get_coupons_product_sku($coupon_meta['exclude_product_ids'][0]);
                } else {
                    $exclude_product_ids = "";
                }
                if (isset($coupon_meta['product_categories'][0]) && $coupon_meta['product_categories'][0] != "") {
                    $coupon_product_categories = $this->get_product_categories_slug($coupon_meta['product_categories'][0]);
                } else {
                    $coupon_product_categories = "";
                }
                if (isset($coupon_meta['exclude_product_categories'][0]) && $coupon_meta['exclude_product_categories'][0] != "") {
                    $exclude_product_categories = $this->get_product_categories_slug($coupon_meta['exclude_product_categories'][0]);
                } else {
                    $exclude_product_categories = "";
                }

                $coupon_meta['coupon_product_ids'][0] = $coupon_product_ids;

                $coupon_meta['coupon_exclude_product_ids'][0] = $exclude_product_ids;

                $coupon_meta['coupon_product_categories'][0] = $coupon_product_categories;

                $coupon_meta['coupon_exclude_product_categories'][0] = $exclude_product_categories;

                $new_coupon->coupon_attributes = maybe_serialize($coupon_meta);

                $new_coupon->coupon_amount = $coupon_meta['coupon_amount'][0];

                $new_coupon->expiry_date = $coupon_meta['expiry_date'][0];

                $new_coupon->discount_type = $coupon_meta['discount_type'][0];

                $new_coupon->individual_use = $coupon_meta['individual_use'][0];

                $new_coupon->product_ids = $coupon_meta['product_ids'][0];

                $new_coupon->usage_limit = $coupon_meta['usage_limit'][0];

                $new_coupon->free_shipping = $coupon_meta['free_shipping'][0];
            }
        }


        wp_reset_postdata();

        return $coupon_list;
    }

    function get_coupon_id_from_code($code) {

        global $wpdb;

        return absint($wpdb->get_var($wpdb->prepare(apply_filters('woocommerce_coupon_code_query', "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'shop_coupon' AND post_status = 'publish'"), $code)));
    }

    function wpie_get_coupon_import_preview() {

        if (session_id() == '') {
            session_start();
        }

        $return_value = array();

        $record_offset = isset($_POST['start']) ? $_POST['start'] : 0;

        $record_limit = isset($_POST['length']) ? $_POST['length'] : 0;

        $query_args = array(
            'post_type' => 'shop_coupon',
            'orderby' => 'post_date',
            'order' => 'ASC',
            'post__in' => $_SESSION['coupon_imported_ids']
        );

        $total_coupon = count($_SESSION['coupon_imported_ids']);

        $data_query = addslashes(json_encode($query_args));


        $product_list_data = $this->get_filter_coupon_data($data_query, $record_offset, $record_limit, 0, 0);

        $final_data = array();

        $coupon_field_list = $this->get_updated_coupon_fields();

        foreach ($product_list_data['coupon_data'] as $coupon_info) {

            $data_result = array();

            foreach ($coupon_field_list['coupon_fields'] as $field_data) {

                if ($field_data['field_display'] == 1) {

                    $temp_data = $field_data['field_key'];

                    $data_result[] = isset($coupon_info->$temp_data) ? $coupon_info->$temp_data : "";
                }
            }

            $final_data[] = $data_result;
        }

        $return_value['data'] = $final_data;

        $return_value['message'] = 'success';

        $return_value['recordsFiltered'] = $total_coupon;

        $return_value['recordsTotal'] = $total_coupon;

        echo json_encode($return_value);

        die();
    }

    function wpie_set_coupon_import_data($wpie_data = array()) {

        global $wpdb;

        $file_url = isset($wpie_data['wpie_import_file_url']) ? $wpie_data['wpie_import_file_url'] : "";

        $file_path_data = isset($wpie_data['wpie_csv_upload_file']) ? $wpie_data['wpie_csv_upload_file'] : "";

        $coupon_offset = isset($wpie_data['coupon_offset']) ? $wpie_data['coupon_offset'] : 0;

        $process_status = isset($wpie_data['status']) ? $wpie_data['status'] : "pending";

        $wpie_import_determinator = (isset($wpie_data['wpie_import_determinator']) || trim($wpie_data['wpie_import_determinator']) != "") ? $wpie_data['wpie_import_determinator'] : ",";

        $wpie_data_update_option = isset($wpie_data['wpie_data_update_option']) ? $wpie_data['wpie_data_update_option'] : "coupon_code";

        $coupon_field_list = $this->get_updated_coupon_fields();

        $file_path = "";

        if ($file_path_data != "") {
            $file_path = $file_path_data;
        } else if ($file_url != "") {
            $file_path = $file_url;
        }

        if ($file_path != "") {


            $new_file = pathinfo($file_path);

            $new_values = array();

            $new_values['export_log_file_type'] = 'import';
            $new_values['export_log_file_name'] = $new_file['basename'];
            $new_values['export_log_data'] = 'Coupon';
            $new_values['create_date'] = current_time('mysql');

            $res = $wpdb->insert($wpdb->prefix . "wpie_export_log", $new_values);


            $fh = @fopen($file_path, 'r');

            $import_data = array();

            if ($fh !== FALSE) {

                while (( $new_line = fgetcsv($fh, 0, $wpie_import_determinator) ) !== FALSE) {

                    $import_data_temp[] = $new_line;
                }
                fclose($fh);

                $fields_title_array = $import_data_temp[0];

                unset($import_data_temp[0]);

                $count = 0;
                $total_records = count($import_data_temp);

                foreach ($import_data_temp as $data) {
                    foreach ($data as $key => $value) {
                        $temp_key = $fields_title_array[$key];
                        $import_data[$count][$temp_key] = $value;
                    }
                    $count++;
                }
            }
        }
        if (!empty($import_data)) {

            $wpie_coupon_create_method = isset($wpie_data['wpie_coupon_create_method']) ? $wpie_data['wpie_coupon_create_method'] : "";
            $import_type = 'scheduled';
            $coupon_updated_data = $this->wpie_create_new_coupon($import_data, $wpie_coupon_create_method, $import_type, $wpie_data_update_option);
        }
    }

}

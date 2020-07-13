<?php

if (!defined('ABSPATH'))
    die("Can't load this file directly");

class WPIE_USER {

    function __construct() {

        add_action('wp_ajax_wpie_create_user_preview', array(&$this, 'wpie_create_user_preview'));

        add_action('wp_ajax_wpie_get_user_export_preview', array(&$this, 'wpie_get_user_export_preview'));

        add_action('wp_ajax_wpie_get_user_import_preview', array(&$this, 'wpie_get_user_import_preview'));

        add_action('wp_ajax_wpie_save_user_fields', array(&$this, 'wpie_save_user_fields'));
    }

    function wpie_get_user_count() {

        $user_query = array();

        $user_query['fields'] = 'ids';

        $user_query['number'] = 0;

        $total_user = count(get_users($user_query));

        return $total_user;
    }

    function wpie_get_author_list() {

        $query_args = array(
            'who' => 'authors',
            'number' => 2000,
            'fields' => array('ID', 'display_name', 'user_email'),
        );

        $user_query = new WP_User_Query($query_args);

        $user_results = $user_query->get_results();

        return $user_results;
    }

    function user_export_field_list() {
        $field_list = array(
            'user_field' => array(
                array(
                    'field_key' => 'ID',
                    'field_display' => 1,
                    'field_title' => 'Id',
                    'field_value' => 'Id',
                ),
                array(
                    'field_key' => 'user_role',
                    'field_display' => 1,
                    'field_title' => 'User Role',
                    'field_value' => 'User Role',
                ),
                array(
                    'field_key' => 'user_email',
                    'field_display' => 1,
                    'field_title' => 'User Email',
                    'field_value' => 'User Email',
                ),
                array(
                    'field_key' => 'user_login',
                    'field_display' => 1,
                    'field_title' => 'Username',
                    'field_value' => 'Username',
                ),
                array(
                    'field_key' => 'user_pass',
                    'field_display' => 1,
                    'field_title' => 'Password',
                    'field_value' => 'Password',
                ),
                array(
                    'field_key' => 'user_registered',
                    'field_display' => 1,
                    'field_title' => 'User Registered',
                    'field_value' => 'User Registered',
                ),
                array(
                    'field_key' => 'user_url',
                    'field_display' => 1,
                    'field_title' => 'Website',
                    'field_value' => 'Website',
                ),
                array(
                    'field_key' => 'billing_first_name',
                    'field_display' => 1,
                    'field_title' => 'First Name (Billing)',
                    'field_value' => 'First Name (Billing)',
                ),
                array(
                    'field_key' => 'billing_last_name',
                    'field_display' => 1,
                    'field_title' => 'Last Name (Billing)',
                    'field_value' => 'Last Name (Billing)',
                ),
                array(
                    'field_key' => 'billing_company',
                    'field_display' => 1,
                    'field_title' => 'Company (Billing)',
                    'field_value' => 'Company (Billing)',
                ),
                array(
                    'field_key' => 'billing_address_1',
                    'field_display' => 1,
                    'field_title' => 'Address 1 (Billing)',
                    'field_value' => 'Address 1 (Billing)',
                ),
                array(
                    'field_key' => 'billing_address_2',
                    'field_display' => 1,
                    'field_title' => 'Address 2 (Billing)',
                    'field_value' => 'Address 2 (Billing)',
                ),
                array(
                    'field_key' => 'billing_city',
                    'field_display' => 1,
                    'field_title' => 'City (Billing)',
                    'field_value' => 'City (Billing)',
                ),
                array(
                    'field_key' => 'billing_postcode',
                    'field_display' => 1,
                    'field_title' => 'Postcode (Billing)',
                    'field_value' => 'Postcode (Billing)',
                ),
                array(
                    'field_key' => 'billing_country',
                    'field_display' => 1,
                    'field_title' => 'Country (Billing)',
                    'field_value' => 'Country (Billing)',
                ),
                array(
                    'field_key' => 'billing_state',
                    'field_display' => 1,
                    'field_title' => 'State (Billing)',
                    'field_value' => 'State (Billing)',
                ),
                array(
                    'field_key' => 'billing_email',
                    'field_display' => 1,
                    'field_title' => 'Email (Billing)',
                    'field_value' => 'Email (Billing)',
                ),
                array(
                    'field_key' => 'billing_phone',
                    'field_display' => 1,
                    'field_title' => 'Phone (Billing)',
                    'field_value' => 'Phone (Billing)',
                ),
                array(
                    'field_key' => 'shipping_first_name',
                    'field_display' => 1,
                    'field_title' => 'First Name (Shipping)',
                    'field_value' => 'First Name (Shipping)',
                ),
                array(
                    'field_key' => 'shipping_last_name',
                    'field_display' => 1,
                    'field_title' => 'Last Name (Shipping)',
                    'field_value' => 'Last Name (Shipping)',
                ),
                array(
                    'field_key' => 'shipping_company',
                    'field_display' => 1,
                    'field_title' => 'Company (Shipping)',
                    'field_value' => 'Company (Shipping)',
                ),
                array(
                    'field_key' => 'shipping_address_1',
                    'field_display' => 1,
                    'field_title' => 'Address 1 (Shipping)',
                    'field_value' => 'Address 1 (Shipping)',
                ),
                array(
                    'field_key' => 'shipping_address_2',
                    'field_display' => 1,
                    'field_title' => 'Address 2 (Shipping)',
                    'field_value' => 'Address 2 (Shipping)',
                ),
                array(
                    'field_key' => 'shipping_city',
                    'field_display' => 1,
                    'field_title' => 'City (Shipping)',
                    'field_value' => 'City (Shipping)',
                ),
                array(
                    'field_key' => 'shipping_postcode',
                    'field_display' => 1,
                    'field_title' => 'Postcode (Shipping)',
                    'field_value' => 'Postcode (Shipping)',
                ),
                array(
                    'field_key' => 'shipping_state',
                    'field_display' => 1,
                    'field_title' => 'State (Shipping)',
                    'field_value' => 'State (Shipping)',
                ),
                array(
                    'field_key' => 'shipping_country',
                    'field_display' => 1,
                    'field_title' => 'Country (Shipping)',
                    'field_value' => 'Country (Shipping)',
                ),
                array(
                    'field_key' => 'wpie_user_meta',
                    'field_display' => 1,
                    'field_title' => 'User Meta',
                    'field_value' => 'User Meta',
                ),
                array(
                    'field_key' => 'wpie_user_capabilities',
                    'field_display' => 1,
                    'field_title' => 'User Capabilities',
                    'field_value' => 'User Capabilities',
                ),
            ),
        );

        return $field_list;
    }

    function get_new_user_fields() {

        $user_fields = maybe_serialize($this->user_export_field_list());

        return $user_fields;
    }

    function get_user_list() {
        $user_query = array();

        $user_query['fields'] = array('ID', 'display_name', 'user_email');

        $user_query['number'] = 2000;

        $user_list = get_users($user_query);

        return $user_list;
    }

    function get_updated_user_fields() {

        $old_user_fields = $this->get_new_user_fields();

        $new_fields = get_option('wpie_user_fields', $old_user_fields);

        $new_fields = maybe_unserialize($new_fields);

        return $new_fields;
    }

    function wpie_get_user_export_log() {
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "wpie_export_log where (`export_log_file_type` = 'csv' or `export_log_file_type` = 'export') and `export_log_data`='User' ORDER BY `export_log_id` DESC");

        return $results;
    }

    function wpie_get_user_import_log() {
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "wpie_export_log where `export_log_file_type` = 'import' and `export_log_data`='User' ORDER BY `export_log_id` DESC");

        return $results;
    }

    function get_user_export_fields_data() {

        $csv_data = "";

        $user_field_list = $this->get_updated_user_fields();

        $count = 0;

        foreach ($user_field_list['user_field'] as $field_data) {
            if ($field_data['field_display'] == 1) {

                $csv_data[$count][] = $field_data['field_value'];
            }
        }

        return $csv_data;
    }

    function wpie_create_user_filter_query($wpie_data = array()) {

        global $wpdb;

        $blog_id = get_current_blog_id();

        $user_ids = isset($wpie_data['wpie_user_id']) ? $wpie_data['wpie_user_id'] : array();

        $user_role = isset($wpie_data['wpie_user_role']) ? $wpie_data['wpie_user_role'] : array();

        $user_total_record = isset($wpie_data['wpie_total_records']) ? $wpie_data['wpie_total_records'] : "";

        $user_offset = isset($wpie_data['wpie_offset_records']) ? $wpie_data['wpie_offset_records'] : "";

        $temp_start_date = isset($wpie_data['wpie_start_date']) ? $wpie_data['wpie_start_date'] : "";

        $temp_end_date = isset($wpie_data['wpie_end_date']) ? $wpie_data['wpie_end_date'] : "";

        $user_min_spend = isset($wpie_data['wpie_user_min_spend']) ? $wpie_data['wpie_user_min_spend'] : 0;

        $start_date = "";

        $end_date = "";

        if ($temp_start_date != "") {
            $temp_start_date = explode('-', $temp_start_date);

            $start_date = $temp_start_date[2] . '-' . $temp_start_date[0] . '-' . $temp_start_date[1];
        }
        if ($temp_end_date != "") {
            $temp_end_date = explode('-', $temp_end_date);

            $end_date = $temp_end_date[2] . '-' . $temp_end_date[0] . '-' . $temp_end_date[1];
        }

        $user_query = array();

        if ($temp_end_date != "" || $temp_start_date != "") {
            $date_data = array();

            if ($temp_end_date != "") {
                $date_data['before'] = $end_date . " 23:59:59";
            }
            if ($temp_start_date != "") {
                $date_data['after'] = $start_date . " 00:00:00";
            }

            $date_data['inclusive'] = true;

            $user_query['date_query'] = array($date_data);
        }

        if (!empty($user_ids)) {
            $user_query['include'] = $user_ids;
        }

        if ($user_total_record != "" && $user_total_record > 0) {
            $user_query['number'] = $user_total_record;

            if ($user_offset != "" && $user_offset > 0) {
                $user_query['offset'] = $user_offset;
            }
        }

        $user_query['fields'] = 'all_with_meta';

        if (!empty($user_role)) {
            if (count($user_role) == 1) {
                $user_query['role'] = $user_role[0];
            } else if (count($user_role) > 1) {

                $user_query['meta_query'] = array(array(
                        'key' => $wpdb->get_blog_prefix($blog_id) . 'capabilities',
                        'value' => '"(' . implode('|', array_map('preg_quote', $user_role)) . ')"',
                        'compare' => 'REGEXP'
                ));
            }
        }
        if ($user_min_spend > 0) {
            $user_query['meta_query'][] = array(
                'key' => '_money_spent',
                'value' => $user_min_spend,
                'compare' => '>=',
            );
        }

        $user_query['orderby'] = 'ID';

        $user_query['order'] = 'ASC';

        return json_encode($user_query);
    }

    function get_filter_user_data($user_query, $start_user, $total_records = 0, $user_offset, $user_limit) {
        global $wpie_get_record_count;

        $user_data_list = array();

        if ($user_limit != "" && $total_records >= $user_limit) {
            $total_records = $user_limit;
            $user_data_list['status'] = "completed";
        }
        if ($user_offset != "" && $start_user == 0) {
            $start_user = $user_offset;
        }
        if ($total_records == 0) {
            $total_records = $wpie_get_record_count;
        }

        $query_args = json_decode(stripslashes($user_query), 1);

        $query_args['number'] = $total_records;

        $query_args['offset'] = $start_user;

        $user_list = get_users($query_args);

        foreach ($user_list as $new_user) {
            foreach ($new_user->roles as $key => $value) {
                $new_user->user_role = $value;
            }

            $new_user->wpie_user_meta = @maybe_serialize(get_user_meta($new_user->ID));

            $new_user->wpie_user_capabilities = @maybe_serialize($new_user->allcaps);

            $user_data_list['user_data'][] = $new_user;

            $start_user++;

            $user_data_list['start_user'] = $start_user;

            if ($user_limit != "" && $user_limit > 0) {
                $user_limit--;
                $user_data_list['user_limit'] = $user_limit;
                if ($user_data_list['user_limit'] == 0) {
                    $user_data_list['status'] = "completed";
                    break;
                }
            }
        }

        return $user_data_list;
    }

    function wpie_create_user_preview() {

        $return_value = array();

        $user_query_data = $this->wpie_create_user_filter_query($_POST);

        $return_value['message'] = 'success';

        $return_value['user_query'] = $user_query_data;

        $return_value['user_offset'] = isset($_POST['wpie_offset_records']) ? $_POST['wpie_offset_records'] : "";

        $return_value['user_limit'] = isset($_POST['wpie_total_records']) ? $_POST['wpie_total_records'] : "";

        $return_value['total_users'] = $this->get_user_total_records_count(json_decode($user_query_data, 1));

        echo json_encode($return_value);

        die();
    }

    function get_user_total_records_count($query_args) {

        $query_args['fields'] = "ids";

        $user_list = get_users($query_args);

        return count($user_list);
    }

    function wpie_get_user_export_preview() {

        $return_value = array();

        $record_offset = isset($_POST['start']) ? $_POST['start'] : 0;

        $record_limit = isset($_POST['length']) ? $_POST['length'] : 0;

        $data_query = isset($_POST['user_query']) ? $_POST['user_query'] : "";

        $total_users = isset($_POST['total_users']) ? $_POST['total_users'] : 0;

        $user_limit = isset($_POST['user_limit']) ? $_POST['user_limit'] : 0;

        $user_limit = ($user_limit - $record_offset) > 0 ? ($user_limit - $record_offset) : $total_users;

        $user_offset = isset($_POST['user_offset']) ? $_POST['user_offset'] : 0;

        $product_list_data = $this->get_filter_user_data($data_query, $record_offset, $record_limit, $user_offset, $user_limit);

        $final_data = array();

        $user_field_list = $this->get_updated_user_fields();

        foreach ($product_list_data['user_data'] as $user_info) {

            $data_result = array();

            foreach ($user_field_list['user_field'] as $field_data) {

                if ($field_data['field_display'] == 1) {

                    $temp_data = $field_data['field_key'];

                    $data_result[] = isset($user_info->$temp_data) ? $user_info->$temp_data : "";
                }
            }

            $final_data[] = $data_result;
        }

        $return_value['data'] = $final_data;

        $return_value['message'] = 'success';

        $return_value['recordsFiltered'] = $total_users;

        $return_value['recordsTotal'] = $total_users;

        echo json_encode($return_value);

        die();
    }

    function get_user_csv_data($wpie_data = array()) {

        $csv_data = "";

        $count = 0;

        $user_field_lists = $this->get_updated_user_fields();

        $user_list_data = $this->wpie_get_user_data($wpie_data);



        foreach ($user_field_lists as $user_field_list) {
            foreach ($user_field_list as $field_data) {
                if ($field_data['field_display'] == 1) {

                    $csv_data[$count][] = $field_data['field_value'];
                }
            }
        }

        foreach ($user_list_data as $user_info) {
            $count++;

            $data_result = array();

            foreach ($user_field_lists as $user_field_list) {
                foreach ($user_field_list as $field_data) {

                    if ($field_data['field_display'] == 1) {
                        $temp_data = $field_data['field_key'];
                        $data_result[] = $user_info->$temp_data;
                    }
                }
            }

            $csv_data[$count] = $data_result;
        }

        return $csv_data;
    }

    function wpie_get_user_data($wpie_data = array()) {

        global $advanced_export, $wpdb;

        $blog_id = get_current_blog_id();

        $user_ids = isset($wpie_data['wpie_user_id']) ? $wpie_data['wpie_user_id'] : array();

        $user_role = isset($wpie_data['wpie_user_role']) ? $wpie_data['wpie_user_role'] : array();

        $user_total_record = isset($wpie_data['wpie_total_records']) ? $wpie_data['wpie_total_records'] : "";

        $user_offset = isset($wpie_data['wpie_offset_records']) ? $wpie_data['wpie_offset_records'] : "";

        $temp_start_date = isset($wpie_data['wpie_start_date']) ? $wpie_data['wpie_start_date'] : "";

        $temp_end_date = isset($wpie_data['wpie_end_date']) ? $wpie_data['wpie_end_date'] : "";

        $user_min_spend = isset($wpie_data['wpie_user_min_spend']) ? $wpie_data['wpie_user_min_spend'] : 0;

        $start_date = "";

        $end_date = "";

        if ($temp_start_date != "") {
            $temp_start_date = explode('-', $temp_start_date);

            $start_date = $temp_start_date[2] . '-' . $temp_start_date[0] . '-' . $temp_start_date[1];
        }
        if ($temp_end_date != "") {
            $temp_end_date = explode('-', $temp_end_date);

            $end_date = $temp_end_date[2] . '-' . $temp_end_date[0] . '-' . $temp_end_date[1];
        }

        $user_query = array();

        if ($temp_end_date != "" || $temp_start_date != "") {
            $date_data = array();

            if ($temp_end_date != "") {
                $date_data['before'] = $end_date . " 23:59:59";
            }
            if ($temp_start_date != "") {
                $date_data['after'] = $start_date . " 00:00:00";
            }

            $date_data['inclusive'] = true;

            $user_query['date_query'] = array($date_data);
        }

        if (!empty($user_ids)) {
            $user_query['include'] = $user_ids;
        }

        if ($user_total_record != "" && $user_total_record > 0) {
            $user_query['number'] = $user_total_record;

            if ($user_offset != "" && $user_offset > 0) {
                $user_query['offset'] = $user_offset;
            }
        }

        $user_query['fields'] = 'all_with_meta';

        if (!empty($user_role)) {
            if (count($user_role) == 1) {
                $user_query['role'] = $user_role[0];
            } else if (count($user_role) > 1) {

                $user_query['meta_query'] = array(array(
                        'key' => $wpdb->get_blog_prefix($blog_id) . 'capabilities',
                        'value' => '"(' . implode('|', array_map('preg_quote', $user_role)) . ')"',
                        'compare' => 'REGEXP'
                ));
            }
        }
        if ($user_min_spend > 0) {
            $user_query['meta_query'][] = array(
                'key' => '_money_spent',
                'value' => $user_min_spend,
                'compare' => '>=',
            );
        }

        $user_query['orderby'] = 'ID';

        $user_query['order'] = 'ASC';

        $user_list = get_users($user_query);

        foreach ($user_list as $new_user) {
            foreach ($new_user->roles as $key => $value) {
                $new_user->user_role = $value;
            }

            $new_user->wpie_user_meta = @maybe_serialize(get_user_meta($new_user->ID));

            $new_user->wpie_user_capabilities = @maybe_serialize($new_user->allcaps);
        }

        return $user_list;
    }

    function wpie_get_user_import_preview() {

        if (session_id() == '') {
            session_start();
        }

        $return_value = array();

        $record_offset = isset($_POST['start']) ? $_POST['start'] : 0;

        $record_limit = isset($_POST['length']) ? $_POST['length'] : 0;

        $query_args = array(
            'include' => $_SESSION['user_imported_ids'],
            'fields' => 'all_with_meta',
            'orderby' => 'ID',
            'order' => 'ASC',
        );

        $total_user = count($_SESSION['user_imported_ids']);

        $data_query = addslashes(json_encode($query_args));


        $product_list_data = $this->get_filter_user_data($data_query, $record_offset, $record_limit, 0, 0);

        $final_data = array();

        $user_field_list = $this->get_updated_user_fields();

        foreach ($product_list_data['user_data'] as $user_info) {

            $data_result = array();

            foreach ($user_field_list['user_field'] as $field_data) {

                if ($field_data['field_display'] == 1) {

                    $temp_data = $field_data['field_key'];

                    $data_result[] = isset($user_info->$temp_data) ? $user_info->$temp_data : "";
                    ;
                }
            }

            $final_data[] = $data_result;
        }

        $return_value['data'] = $final_data;

        $return_value['message'] = 'success';

        $return_value['recordsFiltered'] = $total_user;

        $return_value['recordsTotal'] = $total_user;

        echo json_encode($return_value);

        die();
    }

    function wpie_save_user_fields() {

        $old_user_fields = $this->get_updated_user_fields();

        $new_fields = array();

        foreach ($old_user_fields as $user_fields_key => $user_fields_data) {

            foreach ($user_fields_data as $key => $value) {

                $new_fields[$user_fields_key][$key]['field_key'] = $value['field_key'];

                $new_fields[$user_fields_key][$key]['field_display'] = isset($_POST['wpie_' . $value['field_key'] . '_field_check']) ? $_POST['wpie_' . $value['field_key'] . '_field_check'] : "";

                $new_fields[$user_fields_key][$key]['field_title'] = $value['field_title'];

                $new_fields[$user_fields_key][$key]['field_value'] = $value['field_title']; //isset($_POST['wpie_' . $value['field_key'] . '_field']) ? $_POST['wpie_' . $value['field_key'] . '_field'] : "";
            }
        }

        $new_fields_data = maybe_serialize($new_fields);

        update_option('wpie_user_fields', $new_fields_data);

        $return_value = array();

        $return_value['message'] = 'success';

        $return_value['message_content'] = __('Changes Saved Successfully.', WPIE_TEXTDOMAIN);

        $return_value['preview_fields'] = $this->get_user_preview_fields();

        echo json_encode($return_value);

        die();
    }

    function get_user_preview_fields() {

        $user_fields = $this->get_updated_user_fields();

        $preview_fields_data = '<table class="wpie-product-filter-data wpie-datatable table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>';

        foreach ($user_fields as $new_user_fields) {
            foreach ($new_user_fields as $user_fields_data)
                if ($user_fields_data['field_display'] == 1) {
                    $preview_fields_data .= '<th>' . $user_fields_data['field_title'] . '</th>';
                }
        }

        $preview_fields_data .="   </tr>

                </thead>
            </table>";
        return $preview_fields_data;
    }

    function wpie_set_user_import_data($wpie_data = array()) {

        global $wpdb;

        $file_url = isset($wpie_data['wpie_import_file_url']) ? $wpie_data['wpie_import_file_url'] : "";

        $file_path_data = isset($wpie_data['wpie_csv_upload_file']) ? $wpie_data['wpie_csv_upload_file'] : "";

        $user_offset = isset($wpie_data['user_offset']) ? $wpie_data['user_offset'] : 0;

        $process_status = isset($wpie_data['status']) ? $wpie_data['status'] : "pending";

        $wpie_import_determinator = (isset($_POST['wpie_import_determinator']) || trim($_POST['wpie_import_determinator']) != "") ? $_POST['wpie_import_determinator'] : ",";

        $wpie_data_update_option = isset($_POST['wpie_data_update_option']) ? $_POST['wpie_data_update_option'] : "user_email";

        $user_field_list = $this->get_updated_user_fields();

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
            $new_values['export_log_data'] = 'User';
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

            $wpie_user_create_method = isset($wpie_data['wpie_user_create_method']) ? $wpie_data['wpie_user_create_method'] : "";
            $import_type = 'scheduled';
            $user_updated_data = $this->wpie_create_new_user($import_data, $wpie_user_create_method, $import_type, $wpie_data_update_option);
        }
    }

}

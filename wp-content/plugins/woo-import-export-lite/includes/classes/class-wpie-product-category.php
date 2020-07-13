<?php

if (!defined('ABSPATH'))
    die("Can't load this file directly");

class WPIE_PRODUCT_CATEGORY {

    function __construct() {

        add_action('wp_ajax_wpie_create_product_categories_csv', array(&$this, 'wpie_create_product_categories_csv'));

        add_action('wp_ajax_wpie_create_product_categories_preview', array(&$this, 'wpie_create_product_categories_preview'));

        add_action('wp_ajax_wpie_get_product_cat_export_preview', array(&$this, 'wpie_get_product_cat_export_preview'));

        add_action('wp_ajax_wpie_save_product_cat_fields', array(&$this, 'wpie_save_product_cat_fields'));

        add_action('wp_ajax_wpie_get_product_cat_import_preview', array(&$this, 'wpie_get_product_cat_import_preview'));
    }

    function wpie_get_product_category_count() {

        $query_args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'number' => 0,
            'fields' => 'ids'
        );

        $total_product_category = count(get_terms('product_cat', $query_args));

        return $total_product_category;
    }

    function wpie_get_product_category() {

        $query_args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'number' => 0,
            'orderby' => 'id',
            'order' => 'ASC'
        );

        $product_category = get_terms('product_cat', $query_args);

        return $product_category;
    }

    function get_new_product_cat_fields() {

        $product_cat_fields = maybe_serialize($this->get_product_cat_fields());

        return $product_cat_fields;
    }

    function get_product_cat_fields() {
        $get_product_cat_fields = array(
            'product_cat_fields' => array(
                array(
                    'field_key' => 'term_id',
                    'field_display' => 1,
                    'field_title' => 'Id',
                    'field_value' => 'Id',
                ),
                array(
                    'field_key' => 'name',
                    'field_display' => 1,
                    'field_title' => 'Name',
                    'field_value' => 'Name',
                ),
                array(
                    'field_key' => 'slug',
                    'field_display' => 1,
                    'field_title' => 'Slug',
                    'field_value' => 'Slug',
                ),
                array(
                    'field_key' => 'term_taxonomy_id',
                    'field_display' => 1,
                    'field_title' => 'Term Taxonomy Id',
                    'field_value' => 'Term Taxonomy Id',
                ),
                array(
                    'field_key' => 'taxonomy',
                    'field_display' => 1,
                    'field_title' => 'Taxonomy',
                    'field_value' => 'Taxonomy',
                ),
                array(
                    'field_key' => 'parent',
                    'field_display' => 1,
                    'field_title' => 'Parent Id',
                    'field_value' => 'Parent Id',
                ),
                array(
                    'field_key' => 'parent_slug',
                    'field_display' => 1,
                    'field_title' => 'Parent Slug',
                    'field_value' => 'Parent Slug',
                ),
                array(
                    'field_key' => 'description',
                    'field_display' => 1,
                    'field_title' => 'Description',
                    'field_value' => 'Description',
                ),
                array(
                    'field_key' => 'term_group',
                    'field_display' => 1,
                    'field_title' => 'Term Group',
                    'field_value' => 'Term Group',
                ),
                array(
                    'field_key' => 'count',
                    'field_display' => 1,
                    'field_title' => 'Count',
                    'field_value' => 'Count',
                ),
                array(
                    'field_key' => 'category_image',
                    'field_display' => 1,
                    'field_title' => 'Category Image',
                    'field_value' => 'Category Image',
                ),
                array(
                    'field_key' => 'woocommerce_term_meta',
                    'field_display' => 1,
                    'field_title' => 'Woocommerce Term Meta',
                    'field_value' => 'Woocommerce Term Meta',
                ),
            ),
        );

        return $get_product_cat_fields;
    }

    function get_updated_product_cat_fields() {

        $old_product_cat_fields = $this->get_new_product_cat_fields();

        $new_fields = get_option('wpie_product_cat_fields', $old_product_cat_fields);

        $new_fields = maybe_unserialize($new_fields);

        return $new_fields;
    }

    function wpie_get_product_categories_export_log() {
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "wpie_export_log where (`export_log_file_type` = 'csv' or `export_log_file_type` = 'export') and `export_log_data`='Product Category' ORDER BY `export_log_id` DESC");

        return $results;
    }

    function wpie_get_product_categories_import_log() {
        global $wpdb;

        $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "wpie_export_log where `export_log_file_type` = 'import' and `export_log_data`='Product Category' ORDER BY `export_log_id` DESC");

        return $results;
    }

    function get_product_categories_export_fields_data() {

        $csv_data = "";

        $product_cat_field_list = $this->get_updated_product_cat_fields();

        $count = 0;

        foreach ($product_cat_field_list['product_cat_fields'] as $field_data) {
            if ($field_data['field_display'] == 1) {

                $csv_data[$count][] = $field_data['field_value'];
            }
        }

        return $csv_data;
    }

    function wpie_create_product_cat_filter_query($wpie_data) {

        $product_categories = isset($wpie_data['wpie_product_category']) ? $wpie_data['wpie_product_category'] : array();

        $total_records = isset($wpie_data['wpie_total_records']) ? $wpie_data['wpie_total_records'] : "";

        $offset_records = isset($wpie_data['wpie_offset_records']) ? $wpie_data['wpie_offset_records'] : "";

        $query_args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'orderby' => 'id',
            'order' => 'ASC'
        );

        if (!empty($product_categories)) {
            $query_args['include'] = $product_categories;
        }

        if ($total_records != "" && $total_records > 0) {
            $query_args['number'] = $total_records;

            if ($offset_records != "" && $offset_records >= 0) {
                $query_args['offset'] = $offset_records;
            }
        }

        return json_encode($query_args);
    }

    function get_filter_product_cat_data($product_cat_query, $start_product_cat, $total_records = 0, $product_cat_offset, $product_cat_limit) {
        global $wpie_get_record_count;

        $product_cat_data_list = array();

        if ($product_cat_limit != "" && $total_records >= $product_cat_limit) {
            $total_records = $product_cat_limit;
            $product_cat_data_list['status'] = "completed";
        }
        if ($product_cat_offset != "" && $start_product_cat == 0) {
            $start_product_cat = $product_cat_offset;
        }
        if ($total_records == 0) {
            $total_records = $wpie_get_record_count;
        }
        $query_args = json_decode(stripslashes($product_cat_query), 1);

        $query_args['number'] = $total_records;

        $query_args['offset'] = $start_product_cat;


        $product_category = get_terms('product_cat', $query_args);

        $parent_ids = array();

        foreach ($product_category as $new_category) {
            if ($new_category->parent != "" && $new_category->parent > 0) {
                $parent_ids[] = $new_category->parent;
            }
        }

        if (!empty($parent_ids)) {
            $parents_query_args = array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'fields' => 'id=>slug',
                'include' => $parent_ids,
                'orderby' => 'id',
                'order' => 'ASC'
            );

            $parents_product_category = get_terms('product_cat', $parents_query_args);
        }

        foreach ($product_category as $new_category) {

            $category_parents = $new_category->parent;

            if (isset($parents_product_category[$category_parents]) && $category_parents != "" && $category_parents > 0) {
                $new_category->parent_slug = $parents_product_category[$category_parents];
            }

            $woocommerce_term_meta = get_term_meta($new_category->term_id);

            if (!empty($woocommerce_term_meta)) {

                $new_category->woocommerce_term_meta = maybe_serialize($woocommerce_term_meta);

                if (isset($woocommerce_term_meta['thumbnail_id'][0]) && $woocommerce_term_meta['thumbnail_id'][0] != "" && $woocommerce_term_meta['thumbnail_id'][0] > 0) {

                    $cat_thumbnail = wp_get_attachment_thumb_url($woocommerce_term_meta['thumbnail_id'][0]);


                    if ($cat_thumbnail != "") {
                        $new_category->category_image = $cat_thumbnail;
                    } else {
                        $new_category->category_image = "";
                    }
                } else {
                    $new_category->category_image = "";
                }
            } else {
                $new_category->woocommerce_term_meta = "";

                $new_category->category_image = "";
            }

            $start_product_cat++;

            $product_cat_data_list['start_product_cat'] = $start_product_cat;

            if ($product_cat_limit != "" && $product_cat_limit > 0) {
                $product_cat_limit--;
                $product_cat_data_list['product_cat_limit'] = $product_cat_limit;
                if ($product_cat_data_list['product_cat_limit'] == 0) {
                    $product_cat_data_list['status'] = "completed";
                    break;
                }
            }
        }

        $product_cat_data_list['product_cat_data'] = $product_category;

        return $product_cat_data_list;
    }

    function wpie_create_product_categories_preview() {

        $return_value = array();

        $product_cat_query_data = $this->wpie_create_product_cat_filter_query($_POST);

        $return_value['message'] = 'success';

        $return_value['product_cat_query'] = $product_cat_query_data;

        $return_value['product_cat_offset'] = isset($_POST['wpie_offset_records']) ? $_POST['wpie_offset_records'] : "";

        $return_value['product_cat_limit'] = isset($_POST['wpie_total_records']) ? $_POST['wpie_total_records'] : "";

        $return_value['total_products_cat'] = $this->get_product_cat_total_records_count(json_decode($product_cat_query_data, 1));

        echo json_encode($return_value);

        die();
    }

    function get_product_cat_total_records_count($query_args) {

        $query_args['fields'] = "ids";

        $product_category = get_terms('product_cat', $query_args);

        return count($product_category);
    }

    function wpie_get_product_cat_export_preview() {

        $return_value = array();

        $record_offset = isset($_POST['start']) ? $_POST['start'] : 0;

        $record_limit = isset($_POST['length']) ? $_POST['length'] : 0;

        $data_query = isset($_POST['product_cat_query']) ? $_POST['product_cat_query'] : "";

        $total_products = isset($_POST['total_products_cat']) ? $_POST['total_products_cat'] : 0;

        $product_cat_limit = isset($_POST['product_cat_limit']) ? $_POST['product_cat_limit'] : 0;

        $product_cat_limit = $product_cat_limit - $record_offset;

        $product_cat_offset = isset($_POST['product_cat_offset']) ? $_POST['product_cat_offset'] : 0;

        $product_list_data = $this->get_filter_product_cat_data($data_query, $record_offset, $record_limit, $product_cat_offset, $product_cat_limit);

        $final_data = array();

        $product_cat_field_list = $this->get_updated_product_cat_fields();

        foreach ($product_list_data['product_cat_data'] as $product_cat_info) {

            $data_result = array();

            foreach ($product_cat_field_list['product_cat_fields'] as $field_data) {

                if ($field_data['field_display'] == 1) {

                    $temp_data = $field_data['field_key'];

                    $data_result[] = isset($product_cat_info->$temp_data) ? $product_cat_info->$temp_data : "";
                    ;
                }
            }

            $final_data[] = $data_result;
        }

        $return_value['data'] = $final_data;

        $return_value['message'] = 'success';

        $return_value['recordsFiltered'] = $total_products;

        $return_value['recordsTotal'] = $total_products;

        echo json_encode($return_value);

        die();
    }

    function wpie_save_product_cat_fields() {
        $old_product_cat_fields = $this->get_updated_product_cat_fields();

        $new_fields = array();

        foreach ($old_product_cat_fields as $product_cat_fields_key => $product_cat_fields_data) {

            foreach ($product_cat_fields_data as $key => $value) {

                $new_fields[$product_cat_fields_key][$key]['field_key'] = $value['field_key'];

                $new_fields[$product_cat_fields_key][$key]['field_display'] = isset($_POST['wpie_' . $value['field_key'] . '_field_check']) ? $_POST['wpie_' . $value['field_key'] . '_field_check'] : "";

                $new_fields[$product_cat_fields_key][$key]['field_title'] = $value['field_title'];

                $new_fields[$product_cat_fields_key][$key]['field_value'] = $value['field_title']; //isset($_POST['wpie_' . $value['field_key'] . '_field']) ? $_POST['wpie_' . $value['field_key'] . '_field'] : "";
            }
        }

        $new_fields_data = maybe_serialize($new_fields);

        update_option('wpie_product_cat_fields', $new_fields_data);

        $return_value = array();

        $return_value['message'] = 'success';

        $return_value['message_content'] = __('Changes Saved Successfully.', WPIE_TEXTDOMAIN);

        $return_value['preview_fields'] = $this->get_product_cat_preview_fields();

        echo json_encode($return_value);

        die();
    }

    function get_product_cat_preview_fields() {

        $product_cat_fields = $this->get_updated_product_cat_fields();

        $preview_fields_data = '<table class="wpie-product-filter-data wpie-datatable table table-striped table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>';

        foreach ($product_cat_fields as $new_product_cat_fields) {
            foreach ($new_product_cat_fields as $product_cat_fields_data)
                if ($product_cat_fields_data['field_display'] == 1) {
                    $preview_fields_data .= '<th>' . $product_cat_fields_data['field_title'] . '</th>';
                }
        }

        $preview_fields_data .="   </tr>

                </thead>
            </table>";
        return $preview_fields_data;
    }

    function wpie_get_product_cat_image($images = "", $cat_id = "") {

        $image_list = @explode(',', $images);

        $new_product_cat_errors = array();

        if (!empty($image_list)) {
            $wp_upload_dir = wp_upload_dir();

            foreach ($image_list as $image_index => $image_url) {

                if ($image_url != "") {
                    $image_url = str_replace(' ', '%20', trim($image_url));

                    $parsed_url = parse_url($image_url);

                    $pathinfo = pathinfo($parsed_url['path']);

                    $allowed_extensions = array('jpg', 'jpeg', 'gif', 'png');

                    $url_ext = @explode('.', $image_url);

                    if (!empty($url_ext)) {
                        $image_ext = @strtolower(end($url_ext));
                    } else {
                        $image_ext = "";
                    }

                    if (!in_array($image_ext, $allowed_extensions)) {

                        $new_product_cat_errors[] = sprintf(__('A valid file extension wasn\'t found in %s. Extension found was %s. Allowed extensions are: %s.', WPIE_TEXTDOMAIN), $image_url, $image_ext, implode(', ', $allowed_extensions));

                        continue;
                    }

                    $dest_filename = wp_unique_filename($wp_upload_dir['path'], $pathinfo['basename']);

                    $dest_path = $wp_upload_dir['path'] . '/' . $dest_filename;

                    $dest_url = $wp_upload_dir['url'] . '/' . $dest_filename;

                    if (ini_get('allow_url_fopen')) {

                        if (!@copy($image_url, $dest_path)) {

                            $http_status = $http_response_header[0];

                            $new_product_cat_errors[] = sprintf(__('%s encountered while attempting to download %s', WPIE_TEXTDOMAIN), $http_status, $image_url);
                        }
                    } elseif (function_exists('curl_init')) {

                        $ch = curl_init($image_url);

                        $fp = fopen($dest_path, "wb");

                        $options = array(
                            CURLOPT_FILE => $fp,
                            CURLOPT_HEADER => 0,
                            CURLOPT_FOLLOWLOCATION => 1,
                            CURLOPT_TIMEOUT => 60);

                        curl_setopt_array($ch, $options);

                        curl_exec($ch);

                        $http_status = intval(curl_getinfo($ch, CURLINFO_HTTP_CODE));

                        curl_close($ch);

                        fclose($fp);

                        if ($http_status != 200) {

                            unlink($dest_path);

                            $new_product_cat_errors[] = sprintf(__('HTTP status %s encountered while attempting to download %s', WPIE_TEXTDOMAIN), $http_status, $image_url);
                        }
                    } else {

                        $new_product_cat_errors[] = sprintf(__('Looks like %s is off and %s is not enabled. No images were imported.', WPIE_TEXTDOMAIN), '<code>allow_url_fopen</code>', '<code>cURL</code>');

                        break;
                    }

                    if (!file_exists($dest_path)) {

                        $new_product_cat_errors[] = sprintf(__('Couldn\'t download file %s.', WPIE_TEXTDOMAIN), $image_url);

                        continue;
                    }

                    $new_post_image_paths[] = array(
                        'path' => $dest_path,
                        'source' => $image_url
                    );
                }
            }

            if (!empty($new_post_image_paths)) {
                foreach ($new_post_image_paths as $image_index => $dest_path_info) {

                    if (!file_exists($dest_path_info['path'])) {

                        $new_product_cat_errors[] = sprintf(__('Couldn\'t find local file %s.', WPIE_TEXTDOMAIN), $dest_path_info['path']);

                        continue;
                    }

                    $dest_url = str_ireplace(ABSPATH, home_url('/'), $dest_path_info['path']);

                    $path_parts = pathinfo($dest_path_info['path']);

                    $wp_filetype = wp_check_filetype($dest_path_info['path']);

                    $attachment = array(
                        'guid' => $dest_url,
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title' => preg_replace('/\.[^.]+$/', '', $path_parts['filename']),
                        'post_content' => '',
                        'post_status' => 'inherit'
                    );


                    $attachment_id = wp_insert_attachment($attachment, $dest_path_info['path']);

                    if ($attachment_id && $attachment_id > 0) {
                        update_term_meta($cat_id, 'thumbnail_id', $attachment_id);

                        require_once(ABSPATH . 'wp-admin/includes/image.php');

                        $attach_data = wp_generate_attachment_metadata($attachment_id, $dest_path_info['path']);

                        wp_update_attachment_metadata($attachment_id, $attach_data);
                    }
                }
            }
        }
        return $new_product_cat_errors;
    }

    function wpie_get_product_cat_import_preview() {

        if (session_id() == '') {
            session_start();
        }

        $return_value = array();

        $record_offset = isset($_POST['start']) ? $_POST['start'] : 0;

        $record_limit = isset($_POST['length']) ? $_POST['length'] : 0;

        $query_args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'orderby' => 'id',
            'order' => 'ASC',
            'include' => $_SESSION['imported_ids']
        );
        $total_product_cat = count($_SESSION['imported_ids']);

        $data_query = addslashes(json_encode($query_args));


        $product_list_data = $this->get_filter_product_cat_data($data_query, $record_offset, $record_limit, 0, 0);

        $final_data = array();

        $product_cat_field_list = $this->get_updated_product_cat_fields();

        foreach ($product_list_data['product_cat_data'] as $product_cat_info) {

            $data_result = array();

            foreach ($product_cat_field_list['product_cat_fields'] as $field_data) {

                if ($field_data['field_display'] == 1) {

                    $temp_data = $field_data['field_key'];

                    $data_result[] = isset($product_cat_info->$temp_data) ? $product_cat_info->$temp_data : "";
                    ;
                }
            }

            $final_data[] = $data_result;
        }

        $return_value['data'] = $final_data;

        $return_value['message'] = 'success';

        $return_value['recordsFiltered'] = $total_product_cat;

        $return_value['recordsTotal'] = $total_product_cat;

        echo json_encode($return_value);

        die();
    }

    function wpie_set_product_cat_import_data($wpie_data = array()) {

        global $wpdb;

        if (session_id() == '') {
            session_start();
        }

        $file_url = isset($wpie_data['wpie_import_file_url']) ? $wpie_data['wpie_import_file_url'] : "";

        $file_path_data = isset($wpie_data['wpie_csv_upload_file']) ? $wpie_data['wpie_csv_upload_file'] : "";

        $product_cat_offset = isset($wpie_data['product_cat_offset']) ? $wpie_data['product_cat_offset'] : 0;

        $process_status = isset($wpie_data['status']) ? $wpie_data['status'] : "pending";

        $wpie_import_determinator = (isset($wpie_data['wpie_import_determinator']) || trim($wpie_data['wpie_import_determinator']) != "") ? $wpie_data['wpie_import_determinator'] : ",";

        $wpie_data_update_option = isset($wpie_data['wpie_data_update_option']) ? $wpie_data['wpie_data_update_option'] : "category_slug";

        $product_cat_field_list = $this->get_updated_product_cat_fields();

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
            $new_values['export_log_data'] = 'Product Category';
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

            $wpie_product_cat_create_method = isset($wpie_data['wpie_product_cat_create_method']) ? $wpie_data['wpie_product_cat_create_method'] : "";
            $import_type = 'scheduled';
            $product_cat_updated_data = $this->wpie_create_new_product_cat($import_data, $wpie_product_cat_create_method, $import_type, $wpie_data_update_option);

            if (!empty($_SESSION['cat_new_old_id_list']) && !empty($_SESSION['parent_id_list'])) {
                foreach ($_SESSION['cat_new_old_id_list'] as $key => $value) {

                    foreach ($_SESSION['parent_id_list'] as $cat_new_id => $cat_parent_id) {
                        if ($key == $cat_parent_id) {

                            $new_product_cat_list = array(
                                'parent' => $value
                            );

                            $product_cat_data = wp_update_term($cat_new_id, 'product_cat', $new_product_cat_list);
                        }
                    }
                    unset($_SESSION['cat_new_old_id_list'][$key]);
                }
            }
        }
    }

    function get_product_cat_export_data($wpie_data = array()) {
        $csv_data = "";

        $product_cat_field_list = $this->get_updated_product_cat_fields();

        $product_cat_list_data = $this->get_filter_product_cat($wpie_data);

        $count = 0;

        foreach ($product_cat_field_list['product_cat_fields'] as $field_data) {
            if ($field_data['field_display'] == 1) {

                $csv_data[$count][] = $field_data['field_value'];
            }
        }

        foreach ($product_cat_list_data as $product_cat_info) {
            $count++;

            $data_result = array();

            foreach ($product_cat_field_list['product_cat_fields'] as $field_data) {


                if ($field_data['field_display'] == 1) {
                    $temp_data = $field_data['field_key'];
                    $data_result[] = isset($product_cat_info->$temp_data) ? $product_cat_info->$temp_data : "";
                }
            }

            $csv_data[$count] = $data_result;
        }

        return $csv_data;
    }

    function get_filter_product_cat($wpie_data) {

        $product_categories = isset($wpie_data['wpie_product_category']) ? $wpie_data['wpie_product_category'] : array();

        $total_records = isset($wpie_data['wpie_total_records']) ? $wpie_data['wpie_total_records'] : "";

        $offset_records = isset($wpie_data['wpie_offset_records']) ? $wpie_data['wpie_offset_records'] : "";

        $query_args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'orderby' => 'id',
            'order' => 'ASC'
        );

        if (!empty($product_categories)) {
            $query_args['include'] = $product_categories;
        }

        if ($total_records != "" && $total_records > 0) {
            $query_args['number'] = $total_records;

            if ($offset_records != "" && $offset_records >= 0) {
                $query_args['offset'] = $offset_records;
            }
        }

        $product_category = get_terms('product_cat', $query_args);

        $parent_ids = array();

        foreach ($product_category as $new_category) {
            if ($new_category->parent != "" && $new_category->parent > 0) {
                $parent_ids[] = $new_category->parent;
            }
        }

        if (!empty($parent_ids)) {
            $parents_query_args = array(
                'taxonomy' => 'product_cat',
                'hide_empty' => false,
                'fields' => 'id=>slug',
                'include' => $parent_ids,
                'orderby' => 'id',
                'order' => 'ASC'
            );

            $parents_product_category = get_terms('product_cat', $parents_query_args);

            foreach ($product_category as $new_category) {
                if ($new_category->parent != "" && $new_category->parent > 0) {
                    $new_category->parent_slug = $parents_product_category[$new_category->parent];
                }

                $woocommerce_term_meta = get_term_meta($new_category->term_id);

                if (!empty($woocommerce_term_meta)) {

                    $new_category->woocommerce_term_meta = maybe_serialize($woocommerce_term_meta);

                    if (isset($woocommerce_term_meta['thumbnail_id'][0]) && $woocommerce_term_meta['thumbnail_id'][0] != "" && $woocommerce_term_meta['thumbnail_id'][0] > 0) {

                        $cat_thumbnail = wp_get_attachment_thumb_url($woocommerce_term_meta['thumbnail_id'][0]);


                        if ($cat_thumbnail != "") {
                            $new_category->category_image = $cat_thumbnail;
                        } else {
                            $new_category->category_image = "";
                        }
                    } else {
                        $new_category->category_image = "";
                    }
                } else {
                    $new_category->woocommerce_term_meta = "";

                    $new_category->category_image = "";
                }
            }
        } else {
            foreach ($product_category as $new_category) {

                $woocommerce_term_meta = get_term_meta($new_category->term_id);

                if (!empty($woocommerce_term_meta)) {

                    $new_category->woocommerce_term_meta = maybe_serialize($woocommerce_term_meta);

                    if (isset($woocommerce_term_meta['thumbnail_id'][0]) && $woocommerce_term_meta['thumbnail_id'][0] != "" && $woocommerce_term_meta['thumbnail_id'][0] > 0) {

                        $cat_thumbnail = wp_get_attachment_thumb_url($woocommerce_term_meta['thumbnail_id'][0]);


                        if ($cat_thumbnail != "") {
                            $new_category->category_image = $cat_thumbnail;
                        } else {
                            $new_category->category_image = "";
                        }
                    } else {
                        $new_category->category_image = "";
                    }
                } else {
                    $new_category->woocommerce_term_meta = "";

                    $new_category->category_image = "";
                }
            }
        }

        return $product_category;
    }

}

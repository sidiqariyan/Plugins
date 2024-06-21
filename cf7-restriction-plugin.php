<?php
/*
Plugin Name: Form Timing Restriction
Description: Restrict users from submitting the Contact Form 7 form more than once every hour.
Version: 1.0
Author: Ariyan Sidiq
*/

// Enqueue the custom JavaScript
function cf7_restriction_enqueue_scripts() {
    wp_enqueue_script('custom-cf7-script', plugin_dir_url(__FILE__) . 'js/custom-cf7.js', array('jquery'), null, true);
    wp_localize_script('custom-cf7-script', 'cf7_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('cf7_form_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'cf7_restriction_enqueue_scripts');

// AJAX handler for checking last submission
function cf7_check_last_submission() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'cf7_form_nonce')) {
        wp_send_json_error(['message' => 'Invalid nonce']);
        return;
    }

    $email = sanitize_email($_POST['email']);
    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Invalid email']);
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'cf7dbplugin_submits'; // Adjust this to the actual table name used by CFDB7

    $query = $wpdb->prepare(
        "SELECT submit_time FROM $table_name WHERE field_value = %s ORDER BY submit_time DESC LIMIT 1",
        $email
    );
    $last_submit_time = $wpdb->get_var($query);

    if ($last_submit_time) {
        $last_submit_timestamp = strtotime($last_submit_time);
        $current_timestamp = current_time('timestamp');

        if (($current_timestamp - $last_submit_timestamp) < 3600) {
            wp_send_json_success(['can_submit' => false]);
            return;
        }
    }

    wp_send_json_success(['can_submit' => true]);
}

add_action('wp_ajax_check_last_submission', 'cf7_check_last_submission');
add_action('wp_ajax_nopriv_check_last_submission', 'cf7_check_last_submission');

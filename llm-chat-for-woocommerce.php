<?php
/**
 * Plugin Name: LLM Chat for WooCommerce
 * Description: Adds a large language model powered chat widget to WooCommerce stores for customer service.
 * Version: 1.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Enqueue JavaScript and CSS
function llm_chat_enqueue_scripts() {
    wp_enqueue_style('llm-chat-css', plugins_url('css/style.css', __FILE__));
    wp_enqueue_script('llm-chat-js', plugins_url('js/chat-widget.js', __FILE__), array('jquery'), false, true);
    wp_localize_script('llm-chat-js', 'llmChatAjax', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'llm_chat_enqueue_scripts');

// Include the chat widget HTML
function llm_chat_insert_widget() {
    include_once(plugin_dir_path(__FILE__) . 'includes/widget.php');
}
add_action('wp_footer', 'llm_chat_insert_widget');

// Handle AJAX request for chat interactions
function llm_chat_handle_request() {
    // You would typically send the user's input to your LLM API here and print the response
    $user_input = sanitize_text_field($_POST['message']);
    $response = "This is a dummy response. Replace with API call result.";
    wp_send_json_success(['message' => $response]);
}
add_action('wp_ajax_llm_chat_request', 'llm_chat_handle_request');
add_action('wp_ajax_nopriv_llm_chat_request', 'llm_chat_handle_request');

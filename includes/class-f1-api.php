<?php

if (!defined('ABSPATH')) {
    exit;
}

class F1_Tracker_API {
    private $api_base = 'https://api.jolpi.ca/ergast/f1/';

    public function fetch($endpoint) {
        $cache_key = 'f1_tracker_' . md5($endpoint);
        $cached = get_transient($cache_key);
        if ($cached !== false) return $cached;

        $response = wp_remote_get($this->api_base . $endpoint);
        if (is_wp_error($response)) return array('error' => $response->get_error_message());

        $body = json_decode(wp_remote_retrieve_body($response), true);
        set_transient($cache_key, $body, HOUR_IN_SECONDS);
        return $body;
    }
}

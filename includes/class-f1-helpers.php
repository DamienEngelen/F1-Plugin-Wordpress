<?php

if (!defined('ABSPATH')) {
    exit;
}

class F1_Tracker_Helpers {

    public static function get_team_color($constructor_id) {
        $colors = [
            'red_bull' => '#3671C6',
            'ferrari' => '#E8002D',
            'mercedes' => '#27F4D2',
            'mclaren' => '#FF8000',
            'alpine' => '#FF87BC',
            'aston_martin' => '#229971',
            'williams' => '#64C4FF',
            'rb' => '#6692FF',
            'sauber' => '#52E252',
            'haas' => '#B6BABD',
            'default' => '#333333'
        ];
        return isset($colors[$constructor_id]) ? $colors[$constructor_id] : $colors['default'];
    }

    public static function get_country_code($nationality) {
        $map = [
            'British' => 'gb', 'Dutch' => 'nl', 'Monegasque' => 'mc', 'Spanish' => 'es',
            'Australian' => 'au', 'Mexican' => 'mx', 'French' => 'fr', 'German' => 'de',
            'Canadian' => 'ca', 'Japanese' => 'jp', 'Chinese' => 'cn', 'Thai' => 'th',
            'American' => 'us', 'Finnish' => 'fi', 'Danish' => 'dk', 'Brazilian' => 'br',
            'Italian' => 'it', 'Swiss' => 'ch', 'Austrian' => 'at', 'New Zealander' => 'nz'
        ];
        return isset($map[$nationality]) ? $map[$nationality] : 'xx';
    }
}

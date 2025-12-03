<?php

if (!defined('ABSPATH')) {
    exit;
}

class F1_Tracker_Admin {
    private $api;
    private $option_name = 'f1_tracker_settings';

    public function __construct() {
        $this->api = new F1_Tracker_API();
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    public function add_admin_menu() {
        add_menu_page('F1 Tracker', 'F1 Tracker', 'manage_options', 'f1-tracker', array($this, 'render_main_page'), 'dashicons-flag', 30);
        add_submenu_page('f1-tracker', 'Races', 'Races', 'manage_options', 'f1-tracker-races', array($this, 'render_races_page'));
        add_submenu_page('f1-tracker', 'Standings', 'Standings', 'manage_options', 'f1-tracker-standings', array($this, 'render_standings_page'));
        add_submenu_page('f1-tracker', 'Shortcodes', 'Shortcodes', 'manage_options', 'f1-tracker-shortcodes', array($this, 'render_shortcodes_page'));
        add_submenu_page('f1-tracker', 'Settings', 'Settings', 'manage_options', 'f1-tracker-settings', array($this, 'render_settings_page'));
    }

    public function register_settings() {
        register_setting('f1_tracker_settings', $this->option_name);

        add_settings_section(
            'f1_tracker_general_section',
            'General Settings',
            array($this, 'settings_section_callback'),
            'f1-tracker-settings'
        );

        add_settings_field(
            'default_season',
            'Default Season',
            array($this, 'field_default_season_cb'),
            'f1-tracker-settings',
            'f1_tracker_general_section'
        );

        add_settings_field(
            'cache_duration',
            'Cache Duration (seconds)',
            array($this, 'field_cache_duration_cb'),
            'f1-tracker-settings',
            'f1_tracker_general_section'
        );

        add_settings_field(
            'show_constructor_colors',
            'Show Constructor Colors',
            array($this, 'field_show_colors_cb'),
            'f1-tracker-settings',
            'f1_tracker_general_section'
        );
    }

    public function settings_section_callback() {
        echo 'Configure the main settings for the F1 Tracker plugin.';
    }

    public function field_default_season_cb() {
        $options = get_option($this->option_name);
        $value = isset($options['default_season']) ? $options['default_season'] : 'current';
        echo '<input type="text" name="' . $this->option_name . '[default_season]" value="' . esc_attr($value) . '" class="regular-text">';
        echo '<p class="description">Enter "current" or a year (e.g. 2023).</p>';
    }

    public function field_cache_duration_cb() {
        $options = get_option($this->option_name);
        $value = isset($options['cache_duration']) ? $options['cache_duration'] : 3600;
        echo '<input type="number" name="' . $this->option_name . '[cache_duration]" value="' . esc_attr($value) . '" class="regular-text">';
    }

    public function field_show_colors_cb() {
        $options = get_option($this->option_name);
        $value = isset($options['show_constructor_colors']) ? $options['show_constructor_colors'] : '1';
        echo '<input type="checkbox" name="' . $this->option_name . '[show_constructor_colors]" value="1" ' . checked(1, $value, false) . '>';
    }

    public function enqueue_admin_scripts($hook) {
        if (strpos($hook, 'f1-tracker') !== false) {
            wp_enqueue_style('f1-tracker-admin', F1_TRACKER_PLUGIN_URL . 'admin-style.css', array(), '0.0.1');
            wp_enqueue_style('f1-flag-icons', 'https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css');
            wp_enqueue_style('f1-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        }
    }

    public function render_main_page() {
        $current = $this->api->fetch('current.json');
        $driver_standings = $this->api->fetch('current/driverStandings.json');

        // Find next race
        $next_race = null;
        if (isset($current['MRData']['RaceTable']['Races'])) {
            $now = new DateTime();
            foreach ($current['MRData']['RaceTable']['Races'] as $race) {
                if (new DateTime($race['date']) >= $now) {
                    $next_race = $race;
                    break;
                }
            }
        }

        // Top 3 Drivers
        $top_drivers = array_slice($driver_standings['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] ?? [], 0, 3);

        include F1_TRACKER_PLUGIN_PATH . 'admin/views/dashboard.php';
    }

    public function render_races_page() {
        $season = isset($_GET['season']) ? sanitize_text_field($_GET['season']) : 'current';
        $data = $this->api->fetch($season . '.json');
        $races = $data['MRData']['RaceTable']['Races'] ?? [];

        include F1_TRACKER_PLUGIN_PATH . 'admin/views/races.php';
    }

    public function render_standings_page() {
        $data = $this->api->fetch('current/driverStandings.json');
        $standings = $data['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] ?? [];

        include F1_TRACKER_PLUGIN_PATH . 'admin/views/standings.php';
    }

    public function render_shortcodes_page() {
        include F1_TRACKER_PLUGIN_PATH . 'admin/views/shortcodes.php';
    }

    public function render_settings_page() {
        include F1_TRACKER_PLUGIN_PATH . 'admin/views/settings.php';
    }
}

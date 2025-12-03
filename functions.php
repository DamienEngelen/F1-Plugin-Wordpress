<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * F1 Tracker Shortcodes
 */

/**
 * [f1_leaderboard] - Display current championship driver leaderboard
 * Attributes: rows (default: 10)
 */
function f1_leaderboard_shortcode($atts) {
    $atts = shortcode_atts(array(
        'rows' => 10,
    ), $atts, 'f1_leaderboard');

    $api = new F1_Tracker_API();
    $data = $api->fetch('current/driverStandings.json');
    $standings = array_slice($data['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] ?? [], 0, intval($atts['rows']));

    ob_start();
    ?>
    <div class="f1-shortcode-wrapper f1-leaderboard">
        <div class="f1-card f1-table-card">
            <table class="f1-table">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Driver</th>
                        <th>Nationality</th>
                        <th>Constructor</th>
                        <th>Wins</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($standings as $row):
                        $team_id = $row['Constructors'][0]['constructorId'];
                        $team_color = F1_Tracker_Helpers::get_team_color($team_id);
                        $nat_code = F1_Tracker_Helpers::get_country_code($row['Driver']['nationality']);
                    ?>
                    <tr>
                        <td><span class="f1-pos-circle"><?php echo $row['position']; ?></span></td>
                        <td>
                            <div class="f1-driver-cell">
                                <div class="f1-team-stripe" style="background: <?php echo $team_color; ?>"></div>
                                <strong><?php echo $row['Driver']['givenName'] . ' ' . $row['Driver']['familyName']; ?></strong>
                                <span class="f1-code"><?php echo $row['Driver']['code']; ?></span>
                            </div>
                        </td>
                        <td><span class="fi fi-<?php echo $nat_code; ?>"></span> <?php echo $row['Driver']['nationality']; ?></td>
                        <td style="color: <?php echo $team_color; ?>; font-weight:600;">
                            <?php echo $row['Constructors'][0]['name']; ?>
                        </td>
                        <td><?php echo $row['wins']; ?></td>
                        <td><strong class="f1-points-badge"><?php echo $row['points']; ?></strong></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('f1_leaderboard', 'f1_leaderboard_shortcode');

/**
 * [f1_upcoming_races] - Display upcoming races
 * Attributes: rows (default: 5), season (default: 'current')
 */
function f1_upcoming_races_shortcode($atts) {
    $atts = shortcode_atts(array(
        'rows' => 5,
        'season' => 'current',
    ), $atts, 'f1_upcoming_races');

    $api = new F1_Tracker_API();
    $data = $api->fetch($atts['season'] . '.json');
    $races = $data['MRData']['RaceTable']['Races'] ?? [];

    // Filter upcoming races
    $upcoming = array();
    $now = new DateTime();
    foreach ($races as $race) {
        if (new DateTime($race['date']) >= $now) {
            $upcoming[] = $race;
        }
    }
    $upcoming = array_slice($upcoming, 0, intval($atts['rows']));

    ob_start();
    ?>
    <div class="f1-shortcode-wrapper f1-upcoming-races">
        <div class="f1-grid-races">
            <?php foreach($upcoming as $race):
                $country_code = F1_Tracker_Helpers::get_country_code($race['Circuit']['Location']['country'] ?? '');
            ?>
            <div class="f1-card f1-race-card race-future">
                <div class="f1-race-header">
                    <span class="f1-round">Round <?php echo $race['round']; ?></span>
                    <span class="fi fi-<?php echo $country_code; ?> f1-flag-icon"></span>
                </div>
                <h3><?php echo esc_html($race['raceName']); ?></h3>
                <p class="f1-circuit-name"><?php echo esc_html($race['Circuit']['circuitName']); ?></p>
                <div class="f1-race-footer">
                    <div class="f1-date">
                        <span class="dashicons dashicons-calendar"></span>
                        <?php echo date('M j, Y', strtotime($race['date'])); ?>
                    </div>
                    <span class="f1-status-badge status-upcoming">⏱ Upcoming</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('f1_upcoming_races', 'f1_upcoming_races_shortcode');

/**
 * [f1_past_races] - Display past/completed races
 * Attributes: rows (default: 5), season (default: 'current')
 */
function f1_past_races_shortcode($atts) {
    $atts = shortcode_atts(array(
        'rows' => 5,
        'season' => 'current',
    ), $atts, 'f1_past_races');

    $api = new F1_Tracker_API();
    $data = $api->fetch($atts['season'] . '.json');
    $races = $data['MRData']['RaceTable']['Races'] ?? [];

    // Filter past races
    $past = array();
    $now = new DateTime();
    foreach ($races as $race) {
        if (new DateTime($race['date']) < $now) {
            $past[] = $race;
        }
    }
    // Reverse to show most recent first
    $past = array_reverse($past);
    $past = array_slice($past, 0, intval($atts['rows']));

    ob_start();
    ?>
    <div class="f1-shortcode-wrapper f1-past-races">
        <div class="f1-grid-races">
            <?php foreach($past as $race):
                $country_code = F1_Tracker_Helpers::get_country_code($race['Circuit']['Location']['country'] ?? '');
            ?>
            <div class="f1-card f1-race-card race-past">
                <div class="f1-race-header">
                    <span class="f1-round">Round <?php echo $race['round']; ?></span>
                    <span class="fi fi-<?php echo $country_code; ?> f1-flag-icon"></span>
                </div>
                <h3><?php echo esc_html($race['raceName']); ?></h3>
                <p class="f1-circuit-name"><?php echo esc_html($race['Circuit']['circuitName']); ?></p>
                <div class="f1-race-footer">
                    <div class="f1-date">
                        <span class="dashicons dashicons-calendar"></span>
                        <?php echo date('M j, Y', strtotime($race['date'])); ?>
                    </div>
                    <span class="f1-status-badge status-completed">✓ Completed</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('f1_past_races', 'f1_past_races_shortcode');

/**
 * [f1_constructor_standings] - Display constructor championship standings
 * Attributes: rows (default: 10)
 */
function f1_constructor_standings_shortcode($atts) {
    $atts = shortcode_atts(array(
        'rows' => 10,
    ), $atts, 'f1_constructor_standings');

    $api = new F1_Tracker_API();
    $data = $api->fetch('current/constructorStandings.json');
    $standings = array_slice($data['MRData']['StandingsTable']['StandingsLists'][0]['ConstructorStandings'] ?? [], 0, intval($atts['rows']));

    ob_start();
    ?>
    <div class="f1-shortcode-wrapper f1-constructor-standings">
        <div class="f1-card f1-table-card">
            <table class="f1-table">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Constructor</th>
                        <th>Country</th>
                        <th>Wins</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($standings as $row):
                        $team_color = F1_Tracker_Helpers::get_team_color($row['Constructor']['constructorId']);
                        $country_code = F1_Tracker_Helpers::get_country_code($row['Constructor']['nationality']);
                    ?>
                    <tr>
                        <td><span class="f1-pos-circle"><?php echo $row['position']; ?></span></td>
                        <td>
                            <div class="f1-driver-cell">
                                <div class="f1-team-stripe" style="background: <?php echo $team_color; ?>"></div>
                                <strong style="color: <?php echo $team_color; ?>"><?php echo $row['Constructor']['name']; ?></strong>
                            </div>
                        </td>
                        <td><span class="fi fi-<?php echo $country_code; ?>"></span> <?php echo $row['Constructor']['nationality']; ?></td>
                        <td><?php echo $row['wins']; ?></td>
                        <td><strong class="f1-points-badge"><?php echo $row['points']; ?></strong></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('f1_constructor_standings', 'f1_constructor_standings_shortcode');

/**
 * [f1_next_race] - Display next upcoming race details
 * Attributes: none
 */
function f1_next_race_shortcode($atts) {
    $api = new F1_Tracker_API();
    $current = $api->fetch('current.json');

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

    if (!$next_race) {
        return '<p>No upcoming races found.</p>';
    }

    ob_start();
    ?>
    <div class="f1-shortcode-wrapper f1-next-race">
        <div class="f1-card f1-hero-card">
            <div class="f1-hero-content">
                <span class="f1-label">🏁 Next Grand Prix</span>
                <h2><?php echo esc_html($next_race['raceName']); ?></h2>
                <div class="f1-race-meta">
                    <span class="f1-meta-item"><span class="dashicons dashicons-location"></span> <?php echo esc_html($next_race['Circuit']['circuitName']); ?></span>
                    <span class="f1-meta-item"><span class="dashicons dashicons-calendar-alt"></span> <?php echo date('F j, Y', strtotime($next_race['date'])); ?></span>
                    <span class="f1-meta-item"><span class="dashicons dashicons-clock"></span> <?php echo esc_html($next_race['time']); ?></span>
                </div>
            </div>
            <div class="f1-flag-bg">
                <span class="fi fi-<?php echo F1_Tracker_Helpers::get_country_code($next_race['Circuit']['Location']['country']); ?>"></span>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('f1_next_race', 'f1_next_race_shortcode');

/**
 * [f1_top_drivers] - Display top drivers mini list
 * Attributes: rows (default: 5)
 */
function f1_top_drivers_shortcode($atts) {
    $atts = shortcode_atts(array(
        'rows' => 5,
    ), $atts, 'f1_top_drivers');

    $api = new F1_Tracker_API();
    $data = $api->fetch('current/driverStandings.json');
    $drivers = array_slice($data['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] ?? [], 0, intval($atts['rows']));

    ob_start();
    ?>
    <div class="f1-shortcode-wrapper f1-top-drivers">
        <div class="f1-card f1-standings-preview">
            <h3>🏆 Championship Leaders</h3>
            <div class="f1-mini-list">
                <?php foreach($drivers as $driver):
                    $team_color = F1_Tracker_Helpers::get_team_color($driver['Constructors'][0]['constructorId']);
                ?>
                <div class="f1-mini-row" style="border-left: 5px solid <?php echo $team_color; ?>">
                    <div class="f1-pos"><?php echo $driver['position']; ?></div>
                    <div class="f1-driver-name">
                        <?php echo esc_html($driver['Driver']['familyName']); ?>
                        <span class="f1-team-badge" style="color: <?php echo $team_color; ?>"><?php echo esc_html($driver['Constructors'][0]['name']); ?></span>
                    </div>
                    <div class="f1-points"><?php echo $driver['points']; ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('f1_top_drivers', 'f1_top_drivers_shortcode');

/**
 * [f1_race_calendar] - Display full race calendar
 * Attributes: season (default: 'current')
 */
function f1_race_calendar_shortcode($atts) {
    $atts = shortcode_atts(array(
        'season' => 'current',
    ), $atts, 'f1_race_calendar');

    $api = new F1_Tracker_API();
    $data = $api->fetch($atts['season'] . '.json');
    $races = $data['MRData']['RaceTable']['Races'] ?? [];

    ob_start();
    ?>
    <div class="f1-shortcode-wrapper f1-race-calendar">
        <div class="f1-grid-races">
            <?php foreach($races as $race):
                $past = new DateTime($race['date']) < new DateTime();
                $country_code = F1_Tracker_Helpers::get_country_code($race['Circuit']['Location']['country'] ?? '');
            ?>
            <div class="f1-card f1-race-card <?php echo $past ? 'race-past' : 'race-future'; ?>">
                <div class="f1-race-header">
                    <span class="f1-round">Round <?php echo $race['round']; ?></span>
                    <span class="fi fi-<?php echo $country_code; ?> f1-flag-icon"></span>
                </div>
                <h3><?php echo esc_html($race['raceName']); ?></h3>
                <p class="f1-circuit-name"><?php echo esc_html($race['Circuit']['circuitName']); ?></p>
                <div class="f1-race-footer">
                    <div class="f1-date">
                        <span class="dashicons dashicons-calendar"></span>
                        <?php echo date('M j', strtotime($race['date'])); ?>
                    </div>
                    <?php if($past): ?>
                        <span class="f1-status-badge status-completed">✓ Completed</span>
                    <?php else: ?>
                        <span class="f1-status-badge status-upcoming">⏱ Upcoming</span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('f1_race_calendar', 'f1_race_calendar_shortcode');

/**
 * Enqueue styles for frontend shortcodes
 */
function f1_enqueue_frontend_styles() {
    wp_enqueue_style('f1-tracker-frontend', F1_TRACKER_PLUGIN_URL . 'admin-style.css', array(), '0.0.1');
    wp_enqueue_style('f1-flag-icons', 'https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css');
    wp_enqueue_style('f1-google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
}
add_action('wp_enqueue_scripts', 'f1_enqueue_frontend_styles');

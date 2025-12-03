<div class="f1-wrap">
    <header class="f1-header">
        <h1>F1 Season Tracker <span class="season-badge"><?php echo date('Y'); ?></span></h1>
    </header>

    <div class="f1-dashboard-grid">
        <?php if ($next_race): ?>
        <div class="f1-card f1-hero-card">
            <div class="f1-hero-content">
                <span class="f1-label">Next Grand Prix</span>
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
        <?php endif; ?>

        <div class="f1-card f1-standings-preview">
            <h3>Championship Leaders</h3>
            <div class="f1-mini-list">
                <?php foreach($top_drivers as $driver):
                    $team_color = F1_Tracker_Helpers::get_team_color($driver['Constructors'][0]['constructorId']);
                ?>
                <div class="f1-mini-row" style="border-left: 4px solid <?php echo $team_color; ?>">
                    <div class="f1-pos"><?php echo $driver['position']; ?></div>
                    <div class="f1-driver-name">
                        <?php echo esc_html($driver['Driver']['familyName']); ?>
                        <span class="f1-team-badge" style="color: <?php echo $team_color; ?>"><?php echo esc_html($driver['Constructors'][0]['name']); ?></span>
                    </div>
                    <div class="f1-points"><?php echo $driver['points']; ?> PTS</div>
                </div>
                <?php endforeach; ?>
            </div>
            <a href="<?php echo admin_url('admin.php?page=f1-tracker-standings'); ?>" class="f1-btn">View Full Standings &rarr;</a>
        </div>
    </div>
</div>

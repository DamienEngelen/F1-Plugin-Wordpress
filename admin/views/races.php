<div class="f1-wrap">
    <div class="f1-page-header">
        <h1>Race Calendar</h1>
        <select onchange="window.location.href='admin.php?page=f1-tracker-races&season='+this.value">
            <option value="current">Current Season</option>
            <?php for($y=2024; $y>=2010; $y--): ?>
                <option value="<?php echo $y; ?>" <?php selected($season, $y); ?>><?php echo $y; ?></option>
            <?php endfor; ?>
        </select>
    </div>

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

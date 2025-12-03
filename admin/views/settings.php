<div class="f1-wrap">
    <h1>F1 Tracker Settings</h1>
    <div class="f1-card">
        <form action="options.php" method="post">
            <?php
            settings_fields('f1_tracker_settings');
            do_settings_sections('f1-tracker-settings');
            submit_button();
            ?>
        </form>
    </div>
</div>

<div class="f1-wrap">
    <h1>F1 Tracker Shortcodes</h1>

    <div class="f1-card">
        <p style="font-size: 0.875rem; color: var(--f1-text-secondary); margin-bottom: 24px;">
            Use these shortcodes to display F1 data anywhere on your website. Simply copy and paste the shortcode into any page, post, or widget.
        </p>

        <!-- Leaderboard Shortcode -->
        <div class="f1-shortcode-doc" style="margin-bottom: 20px; padding: 16px; background: #fff; border-left: 3px solid #e10600; border: 1px solid var(--f1-border); border-left: 3px solid #e10600;">
            <h3 style="margin-top: 0; color: #15151e;">Driver Leaderboard</h3>
            <p><strong>Description:</strong> Display the current driver championship standings in a table format.</p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_leaderboard]</code>
            </div>
            <p><strong>Attributes:</strong></p>
            <ul style="margin: 10px 0;">
                <li><code>rows</code> - Number of drivers to display (default: 10)</li>
            </ul>
            <p><strong>Examples:</strong></p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_leaderboard rows="5"]</code>
            </div>
        </div>

        <!-- Top Drivers Shortcode -->
        <div class="f1-shortcode-doc" style="margin-bottom: 30px; padding: 20px; background: #f9fafb; border-left: 4px solid #ff6b6b; border-radius: 8px;">
            <h3 style="margin-top: 0; color: #15151e;">Top Drivers (Mini List)</h3>
            <p><strong>Description:</strong> Display top drivers in a compact mini-list format.</p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_top_drivers]</code>
            </div>
            <p><strong>Attributes:</strong></p>
            <ul style="margin: 10px 0;">
                <li><code>rows</code> - Number of drivers to display (default: 5)</li>
            </ul>
            <p><strong>Examples:</strong></p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_top_drivers rows="3"]</code>
            </div>
        </div>

        <!-- Constructor Standings Shortcode -->
        <div class="f1-shortcode-doc" style="margin-bottom: 30px; padding: 20px; background: #f9fafb; border-left: 4px solid #3671C6; border-radius: 8px;">
            <h3 style="margin-top: 0; color: #15151e;">Constructor Standings</h3>
            <p><strong>Description:</strong> Display the constructor (team) championship standings.</p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_constructor_standings]</code>
            </div>
            <p><strong>Attributes:</strong></p>
            <ul style="margin: 10px 0;">
                <li><code>rows</code> - Number of constructors to display (default: 10)</li>
            </ul>
            <p><strong>Examples:</strong></p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_constructor_standings rows="10"]</code>
            </div>
        </div>

        <!-- Next Race Shortcode -->
        <div class="f1-shortcode-doc" style="margin-bottom: 30px; padding: 20px; background: #f9fafb; border-left: 4px solid #51cf66; border-radius: 8px;">
            <h3 style="margin-top: 0; color: #15151e;">Next Race</h3>
            <p><strong>Description:</strong> Display the next upcoming Grand Prix in a hero card format.</p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_next_race]</code>
            </div>
            <p><strong>Note:</strong> This shortcode has no attributes. It will automatically show the upcoming race.</p>
        </div>

        <!-- Upcoming Races Shortcode -->
        <div class="f1-shortcode-doc" style="margin-bottom: 30px; padding: 20px; background: #f9fafb; border-left: 4px solid #FFB700; border-radius: 8px;">
            <h3 style="margin-top: 0; color: #15151e;">Upcoming Races</h3>
            <p><strong>Description:</strong> Display upcoming races in a grid format.</p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_upcoming_races]</code>
            </div>
            <p><strong>Attributes:</strong></p>
            <ul style="margin: 10px 0;">
                <li><code>rows</code> - Number of races to display (default: 5)</li>
                <li><code>season</code> - Season to show (default: 'current', or use year like '2023')</li>
            </ul>
            <p><strong>Examples:</strong></p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_upcoming_races rows="3"]</code><br>
                <code>[f1_upcoming_races season="current"]</code>
            </div>
        </div>

        <!-- Past Races Shortcode -->
        <div class="f1-shortcode-doc" style="margin-bottom: 30px; padding: 20px; background: #f9fafb; border-left: 4px solid #666; border-radius: 8px;">
            <h3 style="margin-top: 0; color: #15151e;">Past Races</h3>
            <p><strong>Description:</strong> Display completed races (most recent first) in a grid format.</p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_past_races]</code>
            </div>
            <p><strong>Attributes:</strong></p>
            <ul style="margin: 10px 0;">
                <li><code>rows</code> - Number of races to display (default: 5)</li>
                <li><code>season</code> - Season to show (default: 'current', or use year like '2023')</li>
            </ul>
            <p><strong>Examples:</strong></p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_past_races rows="5"]</code>
            </div>
        </div>

        <!-- Race Calendar Shortcode -->
        <div class="f1-shortcode-doc" style="margin-bottom: 30px; padding: 20px; background: #f9fafb; border-left: 4px solid #E8002D; border-radius: 8px;">
            <h3 style="margin-top: 0; color: #15151e;">Full Race Calendar</h3>
            <p><strong>Description:</strong> Display the entire race calendar for a season, showing both past and upcoming races.</p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_race_calendar]</code>
            </div>
            <p><strong>Attributes:</strong></p>
            <ul style="margin: 10px 0;">
                <li><code>season</code> - Season to show (default: 'current', or use year like '2023')</li>
            </ul>
            <p><strong>Examples:</strong></p>
            <div style="background: white; padding: 12px; border-radius: 6px; margin: 10px 0; font-family: monospace; font-size: 0.9rem; overflow-x: auto;">
                <code>[f1_race_calendar season="current"]</code><br>
                <code>[f1_race_calendar season="2023"]</code>
            </div>
        </div>

        <!-- Usage Tips -->
        <div style="padding: 20px; background: #e1060015; border-left: 4px solid #e10600; border-radius: 8px; margin-top: 30px;">
            <h3 style="margin-top: 0; color: #e10600;">Usage Tips</h3>
            <ul>
                <li>All shortcodes automatically include the F1 styling and design</li>
                <li>Use shortcodes in pages, posts, custom post types, and widgets</li>
                <li>Shortcodes will cache API responses for up to 1 hour for better performance</li>
                <li>Country flags are automatically included in all shortcodes</li>
                <li>Team colors are automatically applied from F1 team palettes</li>
                <li>Most recent races are shown first in past races shortcode</li>
            </ul>
        </div>

    </div>
</div>

<style>
.f1-shortcode-doc code {
    background: #f0f0f0;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 0.9em;
}

.f1-shortcode-doc ul {
    padding-left: 20px;
}

.f1-shortcode-doc li {
    margin: 8px 0;
    line-height: 1.6;
}
</style>

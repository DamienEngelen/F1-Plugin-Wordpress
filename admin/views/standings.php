<div class="f1-wrap">
    <h1>Driver Standings</h1>
    <div class="f1-card f1-table-card">
        <table class="f1-table">
            <thead>
                <tr>
                    <th>Pos</th>
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

<h3>LATE ARRIVAL</h3>
<?php if ($late_arrival_scenario_applied == 'NO_TOLERANCE'): ?>
    <b style="color:blue">A:  No tolerance </b> <br />
    B:  Has tolerance, falls within range <br />
    C:  Has tolerance, exceeds tolerance, OPTION A  <br />
    C1: Forgiven amount <br />
    C2: Exceeded amount  <br />
    D:  Has tolerance, exceeds tolerance, OPTION B  <br />
<?php elseif ($late_arrival_scenario_applied == 'HAS_TOLERANCE_FALLS_WITHIN_RANGE'): ?>
    A:  No tolerance <br />
    <b style="color:blue">B:  Has tolerance, falls within range -- <span style="color:red"><?php print $difference_in_minutes ?> Minutes</span> </b> <br />
    C:  Has tolerance, exceeds tolerance, OPTION A  <br />
    C1: Forgiven amount <br />
    C2: Exceeded amount  <br />
    D:  Has tolerance, exceeds tolerance, OPTION B <br />
<?php elseif ($late_arrival_scenario_applied == 'HAS_TOLERANCE_EXCEEDS_TRUANCY__DIFERENCE_APPLIED'): ?>
    A:  No tolerance <br />
    B:  Has tolerance, falls within range <br />
    <b style="color:blue">C:  Has tolerance, exceeds tolerance, OPTION A </b>  <br />
    <b style="color:blue">C1: Forgiven amount -- <span style="color:red"><?php print $late_arrival_tolerance_minutes ?> Minutes</span></b><br />
    <b style="color:blue">C2: Exceeded amount  -- <span style="color:red"><?php print ($difference_in_minutes - $late_arrival_tolerance_minutes) ?> Minutes</span></b><br />
    D:  Has tolerance, exceeds tolerance, OPTION B <br />
<?php elseif ($late_arrival_scenario_applied == 'HAS_TOLERANCE_EXCEEDS_TRUANCY__ENTIRE_APPLIED'): ?>
    A:  No tolerance <br />
    B:  Has tolerance, falls within range <br />
    C:  Has tolerance, exceeds tolerance, OPTION A  <br />
    C1: Forgiven amount <br />
    C2: Exceeded amount  <br />
    <b style="color:blue">D:  Has tolerance, exceeds tolerance, OPTION B -- <span style="color:red"><?php print $difference_in_minutes ?> Minutes</span> </b> <br />
<?php else: ?>
    Great, Employee had not arrived late
<?php endif; ?>

<HR />

<h3>EARLY DEPARTURE </h3>
<?php if ($early_dep_scenario_applied == 'NO_TOLERANCE'): ?>
    <b style="color:blue">A:  No tolerance </b> <br />
    B:  Has tolerance, falls within range <br />
    C:  Has tolerance, exceeds tolerance, OPTION A  <br />
    C1: Forgiven amount <br />
    C2: Exceeded amount  <br />
    D:  Has tolerance, exceeds tolerance, OPTION B  <br />
<?php elseif ($early_dep_scenario_applied == 'HAS_TOLERANCE_FALLS_WITHIN_RANGE'): ?>
    A:  No tolerance <br />
    <b style="color:blue">B:  Has tolerance, falls within range -- <span style="color:red"><?php print $difference_in_minutes_ed ?> Minutes</span> </b> <br />
    C:  Has tolerance, exceeds tolerance, OPTION A  <br />
    C1: Forgiven amount <br />
    C2: Exceeded amount  <br />
    D:  Has tolerance, exceeds tolerance, OPTION B <br />
<?php elseif ($early_dep_scenario_applied == 'HAS_TOLERANCE_EXCEEDS_TRUANCY__DIFERENCE_APPLIED'): ?>
    A:  No tolerance <br />
    B:  Has tolerance, falls within range <br />
    <b style="color:blue">C:  Has tolerance, exceeds tolerance, OPTION A </b>  <br />
    <b style="color:blue">C1: Forgiven amount -- <span style="color:red"><?php print $early_dep_tolerance_minutes ?> Minutes</span></b><br />
    <b style="color:blue">C2: Exceeded amount  -- <span style="color:red"><?php print ($difference_in_minutes_ed - $early_dep_tolerance_minutes) ?> Minutes</span></b><br />
    D:  Has tolerance, exceeds tolerance, OPTION B  <br />
<?php elseif ($early_dep_scenario_applied == 'HAS_TOLERANCE_EXCEEDS_TRUANCY__ENTIRE_APPLIED'): ?>
    A:  No tolerance <br />
    B:  Has tolerance, falls within range <br />
    C:  Has tolerance, exceeds tolerance, OPTION A  <br />
    C1: Forgiven amount <br />
    C2: Exceeded amount  <br />
    <b style="color:blue">D:  Has tolerance, exceeds tolerance, OPTION B -- <span style="color:red"><?php print $difference_in_minutes_ed ?> Minutes</span></b> <br />
<?php else: ?>
    Great, Employee had not departed early
<?php endif; ?>


<HR />
<h3>OT SCENARIO:</h3>


<?php if ($ot_scenario_applied == 'OT_APPLIED'): ?>
    <?php if ($settings_ot_auth_daily_max == 0): ?>
        1. Total OT Prior  -- <span style="color:red"><?php print calcDiffFromSeconds($total_ot_prior, 1); ?> Minutes</span></b><br />
        2: Total OT Post -- <span style="color:red"><?php print calcDiffFromSeconds($total_ot_post, 1); ?> Minutes</span></b><br /><br />
        3: Exceeded OT Prior -- <span style="color:red"><?php print calcDiffFromSeconds($total_exceeded_ot_prior, 1); ?> Minutes</span></b><br />
        4: Exceeded OT Post -- <span style="color:red"><?php print calcDiffFromSeconds($total_exceeded_ot_post, 1); ?> Minutes</span></b><br /><br />
    <?php else: ?>
        5: Exceeded Daily Max OT -- <span style="color:red"><?php print calcDiffFromSeconds($daily_ot_exceeded, 1); ?> Minutes</span></b><br />
        6: Daily Max OT Applied -- <span style="color:red"><?php print calcDiffFromSeconds($daily_ot_applied, 1); ?> Minutes</span></b><br />
    <?php endif; ?>
    <div style='font-size:11px;color:orange'><?php print $ot_mins_message ?></div>

<?php else: ?>
    Amazing, The employee does not have any OT scenario. 
<?php endif; ?>




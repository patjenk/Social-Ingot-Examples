<?php
/**
 * Patrick Jenkins <patrick@socialgrowthtechnologies.com>
 * 8/11/2010
 *
 * Expects "api_key" and "secret" post parameters. Prints out a list of clicks. 
 */
require_once("config.php");

$clicks = $social_ingot->clicks_widgetclick_get('', array(), 100, 0, '-date');
?>
<table border="1">
    <tr>
        <th>Click Id</th>
        <th>User Id</th>
        <th>Date</th>
    </tr>
<?php foreach ($clicks as $click) { ?>
    <tr>
        <td><?php echo $click['id']; ?></td>
        <td><?php echo $click['foreign_id']; ?></td>
        <td><?php echo $click['date']; ?></td>
    </tr>
<?php } ?>
</tale>

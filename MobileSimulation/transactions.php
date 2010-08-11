<?php
/**
 * Patrick Jenkins <patrick@socialgrowthtechnologies.com>
 * 8/11/2010
 *
 * Expects "api_key" and "secret" post parameters. Prints out a list of
 * transactions. 
 */
require_once("config.php");

$transactions = $social_ingot->clicks_widgettransaction_get('', array(), 100, 0, '-date');
?>
<table border="1">
    <tr>
        <th>Transaction Id</th>
        <th>Click Id</th>
        <th>User Id</th>
        <th>Date</th>
    </tr>
<?php foreach ($transactions as $transaction) { ?>
    <tr>
        <td><?php echo $transaction['id']; ?></td>
        <td><?php echo $transaction['click_id']; ?></td>
        <td><?php echo $transaction['uid']; ?></td>
        <td><?php echo $transaction['transaction_time']; ?></td>
    </tr>
<?php } ?>
</tale>

<?php
/**
 * Patrick Jenkins <patrick@socialgrowthtechnologies.com>
 * 8/11/2010
 *
 * Expects "api_key" and "secret" post parameters. Prints out a list of
 * postbacks. 
 */
require_once("config.php");

$postbacks = $social_ingot->clicks_transaction_postback_get('', array(), 100, 0, '-time');
?>
<table class="postbacks">
    <tr>
        <th>URL</th>
        <th>Code</th>
        <th>Response</th>
        <th>Date</th>
    </tr>
<?php for ($x=0; $x<count($postbacks); $x++) { $postback = $postbacks[$x]; ?>
    <tr class="<?php if (0==$x%2) { echo "rowA"; } else { echo "rowB"; } ?>" >
        <td><?php echo $postback['postback_url']; ?></td>
        <td><?php echo $postback['response_code']; ?></td>
        <td><?php echo htmlspecialchars($postback['postback_response']); ?></td>
        <td><?php echo $postback['time']; ?></td>
    </tr>
<?php } ?>
</tale>

<?php
/**
 * Patrick Jenkins <patrick@socialgrowthtechnologies.com>
 * 8/11/2010
 *
 * Expects "api_key" and "secret" post parameters. Prints out a list of mobile 
 * price points.
 */
require_once("config.php");

$fetch_size = 100;
$item_name = "Simulation";
$success_url = "http://socialingot.com/";
$fields = '';
$search = array();
$order_by = 'id';
$temp = $social_ingot->widgets_mobile_get($item_name, $success_url, $success_url, $fields, $search, $fetch_size, 0, $order_by);
$price_points = $temp;
while ($fetch_size == count($temp)) {
  $temp = $social_ingot->widgets_mobile_get($item_name, $success_url, $success_url, $fields, $search, $fetch_size, count($price_points), $order_by);
  $price_points = array_merge($price_points, $temp);
}
?>
<table border="1">
    <tr>
        <th>Country Name</th>
        <th>Sale Amount</th>
        <th>Country Name</th>
        <th>Click</th>
        <th>Transaction</th>
    </tr>
<?php foreach ($price_points as $price_point) { ?>
    <tr>
        <td><?php echo $price_point['country_name']; ?></td>
        <td><?php echo $price_point['sale_amount']; ?></td>
        <td><?php echo $price_point['currency_name']; ?></td>
        <td><a href="<?php echo $price_point['iframe_url'].'&uid='.$uid; ?>" target="_blank">Click</a> 
        <td><a href="#<?php echo $price_point['id']; ?>" onclick="simulate_transaction(<?php echo $price_point['id']; ?>);" >Simulate Transaction</a> 
    </tr>
<?php } ?>
</table>

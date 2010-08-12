<?php
/**
 * Patrick Jenkins <patrick@socialgrowthtechnologies.com>
 * 8/11/2010
 *
 * Expects "api_key", "secret", and "mobile_id" post parameters. Calls 
 * clicks.widgettransaction.postback.post with the valid information and 
 * returns the result in JSON format.
 */
require_once("config.php");
if (!isset($_POST['mobile_id'])) {
  print "Please provide a mobile id.";
  exit;
}
$params = isset($_POST['params'])?$_POST['params']:"";
$params_array = array();
parse_str($params, $params_array);

$item_name = "Simulation";
$success_url = "http://socialingot.com";
$cancel_url = $success_url;

$mobiles = $social_ingot->widgets_mobile_get($item_name, $success_url, $cancel_url, '', array('id'=>$_POST['mobile_id']), 100, 0);
if (!is_array($mobiles) || 1 != count($mobiles)) {
  exit;
} else {
  $mobile = $mobiles[0];
}

$click_date = date('Y-m-d H:i:s');
$transaction_date = $click_date;
$transaction_post_date = $click_date;
$widget_id = 206;

$postback_simulation = $social_ingot->clicks_transaction_postback_post($uid, $mobile['commission_amount'], $mobile['sale_amount'], $mobile['currency_code'], $click_date, $transaction_date, $transaction_post_date, $widget_id, $params_array);

print json_encode($postback_simulation);

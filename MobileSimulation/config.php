<?php
/**
 * Patrick Jenkins <patrick@socialgrowthtechnologies.com>
 * 08/11/2010
 */
require_once("social_ingot.php");

$uid = isset($_POST['uid'])?$_POST['uid']:0;
if (!isset($_POST['api_key']) || !isset($_POST['secret'])) {
  print "Please pass in an api_key and secret.";
  exit;
}
$social_ingot = new SocialIngot($_POST['api_key'], $_POST['secret']);

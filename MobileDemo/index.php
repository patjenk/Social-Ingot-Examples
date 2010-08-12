<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Pay By Mobile Demo</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/facebox.js"></script>
<link href="css/facebox.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
function mobileLightbox() {
  var url =  $("#mobile_select option:selected").attr('value');
  url = unescape(url);
  jQuery.facebox("<iframe src='" + url + "' style='height:484px; width:100%; overflow:hidden;' scrolling='no' frameborder='0'></iframe>");
  $("#facebox").css('top','40px');
}
</script>

<?php
require_once("social_ingot.php");
require_once("config.php");

$social_ingot = new SocialIngot($api_key, $secret);
$mobile_widgets = $social_ingot->widgets_mobile_get($vc_plural, $success_url, $cancel_url, '', 
                                                    array('enduser_ip' => $ip,'country_code'=> 'US', 'currency_code'=>'USD'), 
                                                    '', 0, 'sale_amount');

if (is_array($mobile_widgets)) {
?>

  <span style="float:left;">
  <div class="subtitle">Mobile Phone</div>
  <img style="float:left;" src="images/mobilephone.gif" />
  <form style="float:left;" id="mobile" onsubmit="return false;">
    <select style="float:left; margin-top:12px" id="mobile_select">  

<?php

  foreach ($mobile_widgets as $widget) {
   if($widget['sale_amount'] < $xe) {
     continue;
   } 
   $txt = round($widget['sale_amount'] / $xe) . " $vc_plural / ". $widget['original_sale_amount']. ' ' . $widget['original_currency_code'];
    ?>

    <option value="<?php echo urlencode($widget['iframe_url'].'&uid='.$uid.'&vc='.$vc.'&qty='.round($widget['sale_amount']/$xe)); ?>"><?php echo $txt; ?></option>

<?php } ?>

  </select>
  <input style="padding-left:10px; margin-top:11px;" type="image" src="images/buy.png" onclick="mobileLightbox();"/>
</form>
<br style="clear:both;" />
 </span>
<br style="clear:both;" />

<?php } ?>
  </body>
</html>

<?php
/**
 * Copyright 2010 Social Growth Technologies, Inc
 *
 * This file is the PHP library for acccessing the Social Ingot
 * monetization API. 
 *
 * For help with this library please contact 
 * patrick@socialgrowthtechnologies.com.
 *
 * More information about the Social Ingot API can be found at 
 * http://developers.socialingot.com/
 *
 * For information about the the PHP library please visit:
 * http://developers.socialingot.com/wiki/PHP
 */ 
class SocialIngot {
  public $api_key;
  public $secret;
  public $use_curl_if_available;
  private $server_addr;
  private $last_call_id;

  /**
   * Create a SocialIngot client like this:
   *
   * $social_ingot = new SocialIngot(API_KEY, SECRET);
   *
   * @param api_key                     your developer API key
   * @param secret                      your developer API secret
   */ 
  public function __construct($api_key='', $secret='') {
    $this->api_key               = $api_key;
    $this->secret                = $secret;
    $this->use_curl_if_available = true;
    $this->last_call_id          = 0;
    $this->server_addr           = 'http://api.socialingot.com/v1/';
  }

  /**
   * Creates and returns an keyset for accessing the Social Ingot API. 
   *
   * @param string $fields A comma seperated list of fields to return.
   * @param array $search An array of key value search values to send.
   * @param int $lim The number of results to return,. Default is 50 and 
   *                 maximum is 100.
   * @param int $off The result offset. This is the number, starting from 0,
   *                 to start returning data. The default is 0.
   * @param string $order_by A string indicating how to order the results.
   */
  public function admin_keysets_post($client_id, $postback_currency, $description = '', $transaction_postback_url = null) {
    $params = array('client_id' => $client_id, 'postback_currency' => $postback_currency);
    if ($description) {
      $params['description'] = $description;
    }
    if ($transaction_postback_url) {
      $params['transaction_postback_url'] = $transaction_postback_url;
    }
    return $this->call_authenticated_post_method('admin/keysets/', $params);
  } 
  public function admin_keysets_statistics_hoursnapshot_get($fields = '', $search = array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_unauthenticated_get_method('admin/keysets/statistics/hoursnapshot/', $params);
  }
  
  public function admin_keysets_statistics_monthsnapshot_get($fields = '', $search = array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_unauthenticated_get_method('admin/keysets/statistics/monthsnapshot/', $params);
  }

  public function admin_keysets_statistics_snapshot_get($fields = '', $search = array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_unauthenticated_get_method('admin/keysets/statistics/snapshot/', $params);
  }

  /**
   * Returns the list of categories.
   *
   * @param string $fields A comma seperated list of fields to return.
   * @param array $search An array of key value search values to send.
   * @param int $lim The number of results to return,. Default is 50 and 
   *                 maximum is 100.
   * @param int $off The result offset. This is the number, starting from 0,
   *                 to start returning data. The default is 0.
   * @param string $order_by A string indicating how to order the results.
   */
  public function categories_category_get($fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_unauthenticated_get_method('categories/category/get/', $params);
  }

  /**
   * Returns the list of subcategories. 
   *
   * @param string $fields A comma seperated list of fields to return.
   * @param array $search An array of key value search values to send.
   * @param int $lim The number of results to return,. Default is 50 and 
   *                 maximum is 100.
   * @param int $off The result offset. This is the number, starting from 0,
   *                 to start returning data. The default is 0.
   * @param string $order_by A string indicating how to order the results.
   */
  public function categories_subcategory_get($fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_unauthenticated_get_method('categories/subcategory/get/', $params);
  }

  public function clicks_impression_create_url($widget_ids = array(), $image_ids = array(), $deal_ids = array(), $mobile_ids = array(), $foreign_id = null) {
    $params = array();
    $params['api_key'] = $this->api_key;

    if (null != $foreign_id) {
      $params['foreign_id'] = $foreign_id;
    }

    if (count($widget_ids) > 0) {$params['widget']=implode(',',$widget_ids);}
    if (count($image_ids) > 0) {$params['image']=implode(',',$image_ids);}
    if (count($deal_ids) > 0) {$params['deal']=implode(',',$deal_ids);}
    if (count($mobile_ids) > 0) {$params['mobile']=implode(',',$mobile_ids);}

    $result = $this->get_api_url() . 'clicks/impression/image/?'.http_build_query($params);
    return $result;
  } 

  public function clicks_impression_get($fields, $lim = 100, $off = 0) {
    $params = array('fields' => $fields, 'lim' => $lim, 'off' => $off);
    return $this->call_authenticated_get_method('clicks/impression/', $params);
  }

  /**
   * Returns a record of a mobile payment iframe page load. 
   * 
   * @param string $fields A comma seperated list of fields to return.
   * @param array $search An array of key value search values to send.
   * @param int $lim The number of results to return,. Default is 50 and 
   *                 maximum is 100.
   * @param int $off The result offset. This is the number, starting from 0,
   *                 to start returning data. The default is 0.
   * @param string $order_by A string indicating how to order the results.
   */
  public function clicks_mobileclick_get($fields = '', $search = array(), $lim = 100, $off = 0, $order_by='') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('clicks/mobileclick/', $params);
  }

  /**
   * Construct and return a URL which will forward the user to paypal to
   * purchase the specified product.
   *
   * @param float $amount - The cost of the item.
   * @param string $item_name - The item the end user is purchasing.
   * @param string $uid - The end user's Id. For tracking purposes.
   * @param string $success_url - The URL to forward the user after they make 
   *                              a purchase.
   * @param string $cancel_url - The URL to forawrd the user if they select 
   *                             before purchasing cancel.
   * @param string $currency - A three character code specifying currency. 
                               Default 'USD'.
   * @param string $button_text - The text o fthe button the user clicks on to 
   *                              return to your application. Default 
   *                              'Return to App.'
   * @param string $logo_image - The URL of an image no greater than 150x150 
   *                             to be used in the upper left corner of the 
   *                             paypal pages.
   * @param string $header_image - The URL of an image no greater than 750x90 
   *                               to be used as the header image on paypal 
   *                               pages.
   * @param string $header_border_color - Hex color for border around the 
   *                                      header.
   * @param string $header_bg_color - hex color for header background.
   * @param string $page_color - Hex color for the page.
   */
  public function clicks_ppclick_forward($amount,
                                         $item_name,
                                         $uid,
                                         $success_url,
                                         $cancel_url,
                                         $currency='USD',
                                         $button_text='Return to App',
                                         $logo_image='',
                                         $header_image='',
                                         $header_border_color='',
                                         $header_bg_color='',
                                         $page_color='') {
    $params = array('amount' => $amount,
                    'item_name' => $item_name,
                    'uid' => $uid,
                    'success_url' => $success_url,
                    'cancel_url' => $cancel_url,
                    'currency' => $currency,
                    'button_text' => $button_text,
                    'logo_image' => $logo_image,
                    'header_image' => $header_image,
                    'header_border_color' => $header_border_color,
                    'header_bg_color' => $header_bg_color,
                    'page_color' => $page_color);
    $result = $this->get_api_url() . 'clicks/ppclick/forward/?api_key='.$this->api_key;
    foreach ($params as $key=>$val) {
      $result.= "&$key=".urlencode($val);
    }
    return $result;
  }

  /**
   * Returns an array representing paypal direct payment clicks associated 
   * with this api key.
   *
   * @param string $fields A comma seperated list of fields to return.
   * @param array $search An array of key value search values to send.
   * @param int $lim The number of results to return,. Default is 50 and 
   *                 maximum is 100.
   * @param int $off The result offset. This is the number, starting from 0,
   *                 to start returning data. The default is 0.
   * @param string $order_by A string indicating how to order the results.
   */
  public function clicks_ppclick_get($fields='', $search=array(), $lim=100, $off=0, $order_by='') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('clicks/ppclick/', $params);
  }

  /**
   * Returns an array of postings made to the postback URL for the current keyset.
   *
   * @param string $fields A comma seperated list of fields to return.
   * @param array $search An array of key value search values to send.
   * @param int $lim The number of results to return,. Default is 50 and 
   *                 maximum is 100.
   * @param int $off The result offset. This is the number, starting from 0,
   *                 to start returning data. The default is 0.
   * @param string $order_by A string indicating how to order the results.
   */
  public function clicks_transaction_postback_get($fields='', $search=array(), $lim=100, $off=0, $order_by='') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('clicks/transaction/postback/', $params);
  }

  /**
   * Simulates a postback on behalf of the current keyset with the provided 
   * data. This creates a click and transaction in the database that will have 
   * a $0 sale and $0 commission amount.
   *
   * @param string uid Desired user Id
   * @param float commission_amount Desired commission amount
   * @param float sale_amount Desired sale amount
   * @param string currency_code Desired three letter currency code.  
   * @param string click_date Desired click date formatted as Y-m-d H:i:s
   * @param string transaction_date Desired transaction date formatted as Y-m-d H:i:s
   * @param string transaction_post_date Desired transaction posting date formatted as Y-m-d H:i:s
   * @param integer widget_id Desired widget Id
   */
  public function clicks_transaction_postback_post($uid=null, $commission_amount=null, $sale_amount=null, $currency_code=null, $click_date=null, $transaction_date=null, $transaction_post_date=null, $widget_id=null, $extra_params = array()) {
    $params = array();
    if (null != $uid) {$params['uid']=$uid;}
    if (null != $commission_amount) {$params['commission_amount']=$commission_amount;}
    if (null != $sale_amount) {$params['sale_amount']=$sale_amount;}
    if (null != $currency_code) {$params['currency_code']=$currency_code;}
    if (null != $click_date) {$params['click_date']=$click_date;}
    if (null != $transaction_date) {$params['transaction_datetime']=$transaction_date;}
    if (null != $transaction_post_date) {$params['transaction_post_date']=$transaction_post_date;}
    if (null != $widget_id) {$params['widget_id']=$widget_id;}
    foreach ($extra_params as $key=>$val) {
      if (!isset($params[$key])) { $params[$key] = $val; }
    }
    return $this->call_authenticated_post_method('clicks/transaction/postback/', $params);    
  }

  /**
   * Returns an array representing clicks associated with this api key.
   *
   * @param string $fields A comma seperated list of fields to return.
   * @param array $search An array of key value search values to send.
   * @param int $lim The number of results to return,. Default is 50 and 
   *                 maximum is 100.
   * @param int $off The result offset. This is the number, starting from 0,
   *                 to start returning data. The default is 0.
   * @param string $order_by A string indicating how to order the results.
   */
  public function clicks_widgetclick_get($fields='', $search=array(), $lim=100, $off=0, $order_by='') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('clicks/widgetclick/get/', $params);
  }

  /**
   * Delete a widget transaction from the Social Ingot API and return True or 
   * an error message.
   *
   * This requires special permission.
   *
   * @param int $transaction_id
   */
  public function clicks_widgettransaction_delete($transaction_id) {
    $params = array('transaction_id' => $transaction_id);
    return $this->call_authenticated_delete_method('clicks/widgettransaction/', $params);
  }

  /**
   * Returns an array representing transactions associated with this api key.
   *
   * @param string $fields A comma seperated list of fields to return.
   * @param array $search An array of key value search values to send.
   * @param int $lim The number of results to return,. Default is 50 and 
   *                 maximum is 100.
   * @param int $off The result offset. This is the number, starting from 0,
   *                 to start returning data. The default is 0.
   * @param string $order_by A string indicating how to order the results.
   */
  public function clicks_widgettransaction_get($fields='', $search=array(), $lim=100, $off=0, $order_by='') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('clicks/widgettransaction/', $params);
  }

  /**
   * Posts information about a transaction to the social ingot api and returns
   * the new transaction id if successful.
   *
   * @param int $click_id the id of the click which originated this purchase.
   * @param float $full_commission_amount the revenue generated by this transaction.
   * @param float $currency_code The two letter code of transaction currency.
   * @param float $sale_amount the total amount an end user spent on this transaction.
   * @param string $transaction_date the time of the purchase formatted as YYYY-MM-DD
   * @param string $transaction_time the time of the purchase formatted as HH:MM:ss
   * @param string $item_name the name of the item.
   * @param array $other_parameters any other parameters you want stored with this transaction.
   */
  public function clicks_widgettransaction_post($click_id, $full_commission_amount, $currency_code, $sale_amount=null, $transaction_date=null, $transaction_time=null, $item_name=null, $other_parameters=array()) {
    $params = array('click_id'=>$click_id, 
                    'full_commission_amount'=>$full_commission_amount, 
                    'currency_code'=>$currency_code);
    if (null != $sale_amount) { $params['sale_amount'] = $sale_amount; };
    if (null != $transaction_date) { $params['transaction_date'] = $transaction_date; };
    if (null != $transaction_time) { $params['transaction_time'] = $transaction_time; };
    if (null != $item_name) { $params['item_name'] = $item_name; };
    foreach ($other_parameters as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_post_method('clicks/widgettransaction/', $params);
  } 

  /**
   * Query the Social Ingot API to gather deal information.
   * 
   * @param string $fields - a comma seperated list of fields to return.
   * @param array $search - an array of key,value pairs to search by.
   * @param int $lim - The number of results to return.
   * @param int $off - the place to start returning results from.
   * @param string $order_by - a string to order by.
   */
  public function deals_get($fields='', $search=array(), $lim=100, $off=0, $order_by='') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('deals/', $params);
  }

  /**
   * Query the Social Ingot API to gather mobile payment widgets.
   *
   * @param string $fields - a comma seperated list of fields to return.
   * @param array $search - an array of key,value pairs to search by.
   * @param int $lim - The number of results to return.
   * @param int $off - the place to start returning results from.
   * @param string $order_by - a string to order by.
   */
  public function widgets_mobile_get($item_name, $success_url, $cancel_url, $fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('item_name' => $item_name, 'success_url' => $success_url, 'cancel_url' => $cancel_url, 'fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('widgets/mobile/', $params);
  }

  /**
   * Returns an array representing the widget with $widget_id. If no such
   * widget exists an exception will be thrown.
   *
   * @param string $fields - a comma seperated list of fields to return.
   * @param array $search - an array of key,value pairs to search by.
   * @param int $lim - The number of results to return.
   * @param int $off - the place to start returning results from.
   * @param string $order_by - a string to order by.
   */
  public function widgets_widget_get($fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('widgets/widget/get/', $params);
  }

  /**
   * Returns an array of available widget terms. 
   * 
   * @param string $fields - a comma seperated list of fields to return.
   * @param array $search - an array of key,value pairs to search by.
   * @param int $lim - The number of results to return.
   * @param int $off - the place to start returning results from.
   * @param string $order_by - a string to order by.
   */
  public function widgets_widgetterm_get($fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('widgets/widgetterm/get/', $params);
  }

  /**
   * Returns a list of widget types. 
   *
   * @param string $fields - a comma seperated list of fields to return.
   * @param array $search - an array of key,value pairs to search by.
   * @param int $lim - The number of results to return.
   * @param int $off - the place to start returning results from.
   * @param string $order_by - a string to order by.
   */
  public function widgets_widgettype_get($fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('widgets/widgettype/get/', $params);
  }

  public function get_api_url() {
    return $this->server_addr;
  }

  public function set_api_url($api_url) {
    $this->server_addr = $api_url;
  }

  /*
   * Generate a signature using the secret key.
   *
   * @param $params_array   an array of all parameters,
   *                        NOT INCLUDING the signature itself
   * @param $secret         your secret key
   *
   * @return a hash
   */
  public static function generate_sig($params_array, $secret) {
    $str = '';
    ksort($params_array);
    // Note: make sure that the signature parameter is not already included in
    //       $params_array.
    foreach ($params_array as $k=>$v) {
      if (is_array($v)) {
        foreach ($v as $sub_v) {
          $str .= "$k=$sub_v";
        }
      } else {
        $str .= "$k=$v";
      }
    }
    $str .= $secret;
    return sha1($str);
  }

  /**
   * Calls the specified method with a type of delete.
   *
   * @param string $method
   * @param array $params
   */
  public function &call_authenticated_delete_method($method, $params = array()) {
    $data = $this->authenticated_delete_request($method, $params);
    $result = json_decode($data, true);
    if (is_array($result) && isset($result['error_code'])) {
      throw new SocialIngotRestClientException($result['error_msg'],
                                            $result['error_code']);
    }
    return $result;
  }

  public function authenticated_delete_request($method, $params) {
    $this->finalize_params($method, $params);
    $get_string = $this->create_get_string($method, $params);
    if ($this->use_curl_if_available && function_exists('curl_init')) {
      $useragent = 'Social Ingot API PHP5 Client 0.1 (curl) ' . phpversion();
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
      curl_setopt($ch, CURLOPT_URL, $this->get_api_url() . $get_string);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      $result = curl_exec($ch);
      curl_close($ch);
    } else {
      $content_type = 'application/x-www-form-urlencoded';
      $response_type = 'application/json';
      $params = $get_string;
      $result = $this->run_http_get_transaction($content_type,
                                                 $params,
                                                 $this->get_api_url(),
                                                 $response_type);
    }
    return $result;

  }

  /**
   * Calls the specified normal GET method with the specified parameters.
   *
   * @param string $method  Name of the API method to invoke
   * @param array $params   A map of param names => param values
   *
   * @return mixed  Result of method call 
   */
  public function &call_authenticated_get_method($method, $params = array()) {
    $data = $this->authenticated_get_request($method, $params);
    $result = json_decode($data, true);
    if (is_array($result) && isset($result['error_code'])) {
      throw new SocialIngotRestClientException($result['error_msg'],
                                            $result['error_code']);
    }
    return $result;
  }

  /**
   * Calls the specified normal GET method with the specified parameters. This
   * just passes through to the authenticated method for now. In the future we
   * should implement this to save processing time.
   *
   * @param string $method  Name of the API method to invoke
   * @param array $params   A map of param names => param values
   *
   * @return mixed  Result of method call 
   */
  public function &call_unauthenticated_get_method($method, $params = array()) {
    return $this->call_authenticated_get_method($method, $params);
  }

  public function authenticated_get_request($method, $params) {
    $this->finalize_params($method, $params);
    $get_string = $this->create_get_string($method, $params);
    if ($this->use_curl_if_available && function_exists('curl_init')) {
      $useragent = 'Social Ingot API PHP5 Client 0.1 (curl) ' . phpversion();
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HTTPGET, true);
      curl_setopt($ch, CURLOPT_URL, $this->get_api_url() . $get_string);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      $result = curl_exec($ch);
      curl_close($ch);
    } else {
      $content_type = 'application/x-www-form-urlencoded';
      $response_type = 'application/json';
      $params = $get_string;
      $result = $this->run_http_get_transaction($content_type,
                                                 $params,
                                                 $this->get_api_url(),
                                                 $response_type);
    }
    return $result;
  }

  /**
   * Calls the specified normal POST method with the specified parameters.
   *
   * @param string $method  Name of the API method to invoke
   * @param array $params   A map of param names => param values
   *
   * @return mixed  Result of method call 
   */
  public function call_authenticated_post_method($method, $params) {
    $data = $this->authenticated_post_request($method, $params);
    $result = json_decode($data, true);
    if (is_array($result) && isset($result['error_code'])) {
      throw new SocialIngotRestClientException($result['error_msg'],
                                            $result['error_code']);
    }
    return $result;
  }

  public function authenticated_post_request($method, $params) {
    $this->finalize_params($method, $params);
    $post_string = $this->create_post_string($params);
    if ($this->use_curl_if_available && function_exists('curl_init')) {
      $useragent = 'SGT API PHP5 Client 0.1 (curl) ' . phpversion();
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->get_api_url() . $method);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      $result = curl_exec($ch);
      curl_close($ch);
    } else {
      $content_type = 'application/x-www-form-urlencoded';
      $content = $post_string;
      $result = $this->run_http_post_transaction($content_type,
                                                 $method,
                                                 $content,
                                                 $this->get_api_url());
    }
    return $result;
  }

  /**
   * 
   */
  private function run_http_get_transaction($content_type, $params, $server_addr, $response_type) {
    $user_agent = 'Social Ingot API PHP5 Client 0.1 (non-curl) ' . phpversion();
    $content_length = strlen($content);
    $context =
      array('http' =>
              array('method' => 'GET',
                    'user_agent' => $user_agent,
                    'header' => 'Content-Type: ' . $content_type . "\r\n" .
                                'Content-Length: ' . $content_length . "\r\n" .
                                'Accept: ' . $response_type,
                    'content' => $content));
    $context_id = stream_context_create($context);
    $sock = fopen($server_addr . $params, 'r', false, $context_id);

    $result = '';
    if ($sock) {
      while (!feof($sock)) {
        $result .= fgets($sock, 4096);
      }
      fclose($sock);
    }
    return $result;
  }

  private function run_http_post_transaction($content_type, $method, $content, $server_addr) {
    $user_agent = 'SGT API PHP5 Client 0.1 (non-curl) ' . phpversion();
    $content_length = strlen($content);
    $context =
      array('http' =>
              array('method' => 'POST',
                    'user_agent' => $user_agent,
                    'header' => 'Content-Type: ' . $content_type . "\r\n" .
                                'Content-Length: ' . $content_length,
                    'content' => $content));
    $context_id = stream_context_create($context);
    $sock = fopen($server_addr . '/' . $method, 'r', false, $context_id);

    $result = '';
    if ($sock) {
      while (!feof($sock)) {
        $result .= fgets($sock, 4096);
      }
      fclose($sock);
    }
    return $result;
  }

  /**
   * This signs the request.
   * 
   * @param string $method - the method we're querying in the API.
   * @param array $params - the params that are beign sent to the API call.
   */
  private function finalize_params($method, &$params) {
    $this->add_standard_params($method, $params);
    // we need to do this before signing the params
    $this->convert_array_values_to_json($params);
    $params['sig'] = SocialIngot::generate_sig($params, $this->secret);
  }

  private function convert_array_values_to_json(&$params) {
    foreach ($params as $key => &$val) {
      if (is_array($val)) {
        $val = json_encode($val);
      }
    }
  }

  /**
   * Adds the api_key and call_id to the params.
   */
  private function add_standard_params($method, &$params) {
    $params['api_key'] = $this->api_key;
    $params['call_id'] = microtime(true);
    if ($params['call_id'] <= $this->last_call_id) {
      $params['call_id'] = $this->last_call_id + 0.001;
    }
    $this->last_call_id = $params['call_id'];
  }

  /**
   * Returns a string of the parameters ready to be sent as a get request.
   */
  private function create_get_string($method, $params) {
    $get_params = array();
    foreach ($params as $key => &$val) {
      if (is_array($val)) {
        foreach ($val as &$sub_val) {
          $get_params[] = $key . "=" . urlencode($sub_val);
        }
      } else {
        $get_params[] = $key . "=" . urlencode($val);
      }
    }
    return $method . "?" . implode('&', $get_params);
  }

  /**
   * Returns a string of the parameters ready to be sent as a get request.
   */
  private function create_post_string($params) {
    $post_params = array();
    foreach ($params as $key => &$val) {
      $post_params[] = $key.'='.urlencode($val);
    }
    return implode('&', $post_params);
  }

}

class SocialIngotRestClientException extends Exception {
}

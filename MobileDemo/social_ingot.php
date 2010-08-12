<?php
/**
 * Copyright 2009 Social Growth Technologies, Inc
 *
 * This file is the PHP library for acccessing Social Growth Technologies'
 * monetization API.
 *
 * For help with tihs library please contact 
 * patrick@socialgrowthtechnologies.com.
 *
 * More information about the Social Ingot API can be found at 
 * http://developers.socialingot.com/
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
   * $money = new SocialIngot(API_KEY, SECRET);
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
   *
   */
  public function admin_client_get($fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_unauthenticated_get_method('admin/client/', $params);
  }

  /**
   *
   */
  public function admin_client_post($name, $email, $password = '', $website = '', $notes= '') {
    $params = array();
    $params['name'] = $name;
    $params['email'] = $email;
    $params['password'] = $password;
    if ($website) {
      $params['website'] = $website;
    }
    if ($notes) {
      $params['notes'] = $notes;
    }
    return $this->call_authenticated_post_method('admin/client/', $params);
  }

  /**
   *
   */
  public function admin_client_update($id, $email = '', $website = '', $notes = '') {
    $params = array();
    $params['id'] = $id;
    if ($email && '' != $email) {
      $params['email'] = $email;
    }
    if ($website && '' != $website) {
      $params['website'] = $website;
    }
    if ($notes && '' != $notes) {
      $params['notes'] = $notes;
    }
    return $this->call_authenticated_post_method('admin/client/update/', $params);
  }

  public function admin_keysets_delete($keyset_id) {
    $params = array('keyset_id' => $keyset_id);
    return $this->call_authenticated_delete_method('admin/keysets/', $params);
  }

  public function admin_keysets_get($fields = '', $search = array(), $lim = 100, $off = 0, $order_by = '') {
    print 'hihihihhhiii';
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_unauthenticated_get_method('admin/keysets/', $params);
  }

  /**
   *
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

  public function admin_keysets_update($keyset_id, $client_id = null, $description = null, $revenue_share = null, $transaction_postback = null, $postback_currency = null) {
    $params = array('id' => $keyset_id);
    if (null != $client_id) { $params['client_id'] = $client_id; }
    if (null != $description) { $params['description'] = $description; }
    if (null != $revenue_share) { $params['revenue_share'] = $revenue_share; }
    if (null != $transaction_postback) { $params['transaction_postback'] = $transaction_postback; }
    if (null != $postback_currency) { $params['postback_currency'] = $postback_currency; }
    return $this->call_authenticated_post_method('admin/keysets/update/', $params);
  } 

  /**
   *
   */
  public function categories_category_get($fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_unauthenticated_get_method('categories/category/get/', $params);
  }

  /**
   *
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

  public function clicks_transactions_postback_get($fields='', $search=array(), $lim=100, $off=0, $order_by='') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('clicks/transaction/postback/get/', $params);
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
   * @param float $commission_amount the revenue generated by this transaction.
   * @param float $currency the currency the commission is.
   * @param string $item_name the name of the item.
   * @param float $sale_amount the total amount an end user spent on this transaction.
   * @param string $transaction_time the time of the purchase formatted as YYYY-MM-DD HH:MM:ss
   * @param array $other_parameters any other parameters you want stored with this transaction.
   */
  public function clicks_widgettransaction_post($click_id, $commission_amount, $currency, $item_name='', $sale_amount=0, $transaction_time='', $other_parameters = array())
  {
    $params = array('click_id'=>$click_id, 
                    'commission_amount'=>$commission_amount, 
                    'currency'=>$currency, 
                    'item_name'=>$item_name, 
                    'sale_amount'=>$sale_amount,
                    'transaction_time'=>$transaction_time);
    foreach ($other_parameters as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_post_method('clicks/widgettransaction/', $params);
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
   * @param int $widget_id The id of the widget to fetch.
   */
  public function widgets_widget_get($fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('widgets/widget/get/', $params);
  }

  /**
   *
   */
  public function widgets_widgetterm_get($fields='', $search=array(), $lim = 100, $off = 0, $order_by = '') {
    $params = array('fields'=>$fields, 'lim' => $lim, 'off' => $off, 'order_by' => $order_by);
    foreach ($search as $key=>$val) {
      $params[$key] = $val;
    }
    return $this->call_authenticated_get_method('widgets/widgetterm/get/', $params);
  }

  /**
   *
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
    //$this->convert_array_values_to_json($params);
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

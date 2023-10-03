<?php  /**
 * Plugin Name:         Fyndiq Connect
 * Plugin URI:          
 * Description:         Easily connect your WooCommerce store to your Fyndiq account and let it sync Products and Orders.
 * Version:             1.0.0
 * Author:              DTH Solutions
 * Author URI:          https://www.dthsolutions.se
 * License:             
 * License URI:       
 *
 * WC requires at least: 3.4.0
 * WC tested up to: 3.5.6
 */
defined( 'ABSPATH' ) or die( 'No direct access!' );
//define('fyndiq_api_url','https://merchants-api.fyndiq.se/api/v1/' ) or die( 'No direct access!' );
define('fyndiq_api_url','https://merchants-api.sandbox.fyndiq.se/api/v1/' ) or die( 'No direct access!' );
define('username',get_option("fyndiq_field_merchant_id") ) or die( 'No direct access!' );
define('password',get_option("fyndiq_field_merchant_password") ) or die( 'No direct access!' );
// copy FYNDIQ_SPECIAL_SECRET_KEY from settings of License manager menu and field called Secret Key for License Verification Requests
define('FYNDIQ_SPECIAL_SECRET_KEY', '5f4ca3dde3b1e3.72254306'); //Rename this constant name so it is specific to your plugin or theme.
// This is the URL where API query request will be sent to. This should be the URL of the site where you have installed the main license manager plugin. Get this value from the integration help page.
define('FYNDIQ_LICENSE_SERVER_URL', 'https://www.handlanu.se'); //Rename this constant name so it is specific to your plugin or theme.
// This is a value that will be recorded in the license manager data so you can identify licenses for this item/product.
define('FYNDIQ_ITEM_REFERENCE', 'Fyndiq Connect'); //Rename this constant name so it is specific to your plugin or theme.
session_start();
$base_admin_url = plugin_dir_path( __FILE__ );
add_action( 'admin_menu', 'fyndiq_admin_menu' );
function fyndiq_admin_menu() {
    add_submenu_page( 'woocommerce', 'Fyndiq Connect', 'Fyndiq Connect', 'manage_woocommerce', 'fyndiq', 'fyndiq_page' );
   if(username && username){
    add_submenu_page( 'woocommerce', 'DTH Connector Invoices', 'DTH Connector Invoices', 'manage_woocommerce', 'fyndiq_invoice', 'fyndiq_invoice_page' );
    // add_filter( 'bulk_actions-edit-shop_order', 'fyndiq_bulk_actions_print_orders', 20, 1 );
    //   function fyndiq_bulk_actions_print_orders( $actions ) {
    //       $actions['write_orders_print'] = __( 'Print orders', 'woocommerce' );
    //       return $actions;
    //   }
  }
}
// Make the action from selected orders
// add_filter( 'handle_bulk_actions-edit-shop_order', 'downloads_handle_bulk_action_edit_shop_order', 10, 3 );
// function downloads_handle_bulk_action_edit_shop_order( $redirect_to, $action, $post_ids ) {
//     if ( $action !== 'write_orders_print' )
//     global $attach_download_dir, $attach_download_file; // ???
//     $processed_ids = array();
//     foreach ( $post_ids as $post_id ) {
//         $order = wc_get_order( $post_id );
//         $order_data = $order->get_data();
//         // Your code to be executed on each selected order
//         // fwrite($myfile,
//         //     $order_data['date_created']->date('d/M/Y') . '; ' .
//         //     '#' . ( ( $order->get_type() === 'shop_order' ) ? $order->get_id() : $order->get_parent_id() ) . '; ' .
//         //     '#' . $order->get_id()
//         // );
//         $processed_ids[] = $post_id;
//     }
//     // return $redirect_to = add_query_arg( array(
//     //     'write_downloads' => '1',
//     //     'processed_count' => count( $processed_ids ),
//     //     'processed_ids' => implode( ',', $processed_ids ),
//     // ), $redirect_to );
// }
function get_fyndiq_orders($order_type="CREATED"){
   $fyndiq_last_order_page= get_option("fyndiq_last_order_page");
   if($fyndiq_last_order_page<1){
     $fyndiq_last_order_page=0;
   }
   $fyndiq_last_order_page++;
   $host =fyndiq_api_url."orders?state=".$order_type."&page=".$fyndiq_last_order_page;
   $username = get_option("fyndiq_field_merchant_id");
   $password = get_option("fyndiq_field_merchant_password");
   $response= false;
   if($username && $username){
        $curlSecondHandler = curl_init();
        curl_setopt_array($curlSecondHandler, [
            CURLOPT_URL => $host,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . base64_encode($username . ':' . $password)
            ],
        ]);
        $response = curl_exec($curlSecondHandler);
        curl_close($curlSecondHandler);
        if(!$response){
            $response=false;
        }
        // echo "<pre>";
        // print_r($response);
        $fp = fopen( dirname( __FILE__ ) . '/get_fyndiq_orders.txt', 'w+' );
        fwrite( $fp, PHP_EOL . ' response = '.PHP_EOL."<pre>".print_r(json_decode($response),true) );
        return $response;
   }
}
function create_fyndiq_orders($obj){
   $fp = fopen( dirname( __FILE__ ) . '/create_fyndiq_orders.txt', 'w+' );
     // fwrite( $fp, PHP_EOL . ' res_orders ='.print_r(json_decode($res_orders),true));
    // global $woocommerce;
    // $product_id =  wc_get_product_id_by_sku( $obj->article_sku );
    // $product_id =  wc_get_product_id_by_sku("1111");
   global $wpdb;
    $product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $obj->article_sku ) );
    // $posts = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_sku' AND  meta_value = '".$obj->article_sku."' LIMIT 1", ARRAY_A);
    if(!$product_id || $product_id==0){
      $obj->article_sku= intval(preg_replace('/[^0-9.]/','',$obj->article_sku));  
      $product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $obj->article_sku ) );
    }
    // print_r($product_id)
    // fwrite( $fp, PHP_EOL . ' article_sku ='.print_r($article_sku,true));
    if(!$product_id){
         fwrite( $fp, PHP_EOL . ' inside !$product_id ');
    }else{
        fwrite( $fp, PHP_EOL . ' article_sku ='.print_r($obj->article_sku,true));
        fwrite( $fp, PHP_EOL . ' product_id ='.$product_id);
       // fwrite( $fp, PHP_EOL . ' product_details ='.print_r($product_details,true));
       // fwrite( $fp, PHP_EOL . ' posts ='.print_r($posts,true));
      // fwrite( $fp, PHP_EOL . ' obj ='.print_r($obj,true));
      $shipping_obj = $obj->shipping_address;
      $address = array(
         'first_name' => $shipping_obj->first_name,
         'last_name'  => $shipping_obj->last_name,
         'company'    => '',
         'email'      => '',
         'phone'      => $shipping_obj->phone_number,
         'address_1'  => $shipping_obj->street_address,
         'address_2'  => '',
         'city'       => $shipping_obj->city,
         'state'      => '',
         'postcode'   => $shipping_obj->postal_code,
         'country'    => $shipping_obj->country
     );
     $product = wc_get_product( $product_id );
     $old_price =  $product->get_price();
     // Change the product price
     //$product->set_price( $price->amount );
     update_post_meta($product_id, '_regular_price', ($obj->price->amount + $obj->price->vat_amount));
     update_post_meta($product_id, '_price', ($obj->price->amount + $obj->price->vat_amount));
     // // Now we create the order
     $order = wc_create_order();
     $order->add_product( get_product($product_id), $obj->quantity); // This is an existing SIMPLE product
     // $order->add_product( get_product($product_id), 1); // This is an existing SIMPLE product
     $order->set_address( $address, 'billing' );
     // //
     $order->calculate_totals();
     $order->update_status("processing", 'Fyndiq order', TRUE);  
     add_post_meta($order->id, 'fyndiq_order_id',$obj->id);
     add_post_meta($order->id, 'fyndiq_order_status',"CREATED");
     add_post_meta($order->id, 'fyndiq_order_note',"Fyndiq Order No.".$obj->id);
     update_post_meta($product_id, '_regular_price', $old_price);
     update_post_meta($product_id, '_price', $old_price);
     // $product->set_price( $old_price );
     // $order = wc_get_orde( $order->id ); 
     fwrite( $fp, PHP_EOL . ' $old_price ='.$old_price);
     // $agent = $_SERVER['HTTP_USER_AGENT'];
    // fwrite( $fp, PHP_EOL . ' before super_admins =');
     // $super_admins = get_super_admins();
     // $data = get_user_by('login',$super_admins[0]);
     // fwrite( $fp, PHP_EOL . ' data ='.($data));
     // $order->add_order_note("Fyndiq OrderNo ".$obj->id,$is_customer_note = 1);
   // fwrite( $fp, PHP_EOL . ' $order->id ='.$order->id);
     $order = new WC_Order( $order->id ); 
     $note = __("Fyndiq OrderNo ".$obj->id);
     $order->add_order_note( $note );
     // Save the data
     $order->add_order_note( $note );
     $posts = $wpdb->get_results("SELECT meta_id FROM $wpdb->postmeta WHERE meta_key = 'fyndiq_order_id' AND  meta_value = '".$obj->id."' LIMIT 1", ARRAY_A);
    // Save the data
     if(empty($posts)){
       $order->save();
     }else{
        return false;
     }
    }
}
function update_fyndiq_order($order_id,$fyndiq_order_id,$action="fulfill"){
   $fp = fopen( dirname( __FILE__ ) . '/update_fyndiq_order.txt', 'w+' );
   $host =fyndiq_api_url."orders/".$fyndiq_order_id."/".$action;
   fwrite($fp, PHP_EOL . ' host ='.$host );
   $username = get_option("fyndiq_field_merchant_id");
   $password = get_option("fyndiq_field_merchant_password");
   $response= false;
   if($username && $username){
      $method= "PUT";
      $fyndiq_carrier_name = get_post_meta( $order_id, 'fyndiq_carrier_name', true );
      $fyndiq_tracking_number = get_post_meta( $order_id, 'fyndiq_tracking_number', true );
      $curl = curl_init();
      if($fyndiq_carrier_name && $fyndiq_tracking_number) {
         curl_setopt_array($curl, array(
         CURLOPT_URL => $host,
         CURLOPT_RETURNTRANSFER => true,
         // CURLOPT_ENCODING => "",
         // CURLOPT_MAXREDIRS => 10,
         // CURLOPT_TIMEOUT => 30,
         // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => $method,
         CURLOPT_POSTFIELDS => json_encode(
                [
               'tracking_information' => [array('carrier_name'=>$fyndiq_carrier_name, "tracking_number"=> $fyndiq_tracking_number)],
               ]
             ),
             CURLOPT_HTTPHEADER => [
             'Authorization: Basic ' . base64_encode($username . ':' . $password)
             ],
          ));
      } else{
           curl_setopt_array($curl, array(
           CURLOPT_URL => $host,
           CURLOPT_RETURNTRANSFER => true,
           // CURLOPT_ENCODING => "",
           // CURLOPT_MAXREDIRS => 10,
           // CURLOPT_TIMEOUT => 30,
           // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
           CURLOPT_CUSTOMREQUEST => $method,
           CURLOPT_POSTFIELDS => json_encode(
               // [
               // 'quantity' => $qty,
               // ]
               ),
               CURLOPT_HTTPHEADER => [
               'Authorization: Basic ' . base64_encode($username . ':' . $password)
               ],
            ));
       }
       $response = curl_exec($curl);
       $err = curl_error($curl);
       fwrite($fp, PHP_EOL . ' response for update_fyndiq_order = '.$order_id.PHP_EOL.PHP_EOL."<pre>".print_r($response,true) );
       fwrite($fp, PHP_EOL . ' err for update_fyndiq_order ='.$order_id.PHP_EOL.PHP_EOL.($err) );
       curl_close($curl);
       if(!$err){
          update_post_meta($order_id, 'fyndiq_order_status',$action);
       }
   }
}
function update_fyndiq_order_tracking_info($order_id,$fyndiq_order_id,$action="fulfill"){
   $fp = fopen( dirname( __FILE__ ) . '/update_fyndiq_order_tracking_info.txt', 'w+' );
   $host =fyndiq_api_url."orders/".$fyndiq_order_id."/".$action;
   fwrite($fp, PHP_EOL . ' host ='.$host );
   $username = get_option("fyndiq_field_merchant_id");
   $password = get_option("fyndiq_field_merchant_password");
   $response= false;
   $fyndiq_carrier_name = get_post_meta( $order_id, 'fyndiq_carrier_name', true );
   $fyndiq_tracking_number = get_post_meta( $order_id, 'fyndiq_tracking_number', true );
   if($username && $username){
       $method= "PUT";
       $curl = curl_init();
       curl_setopt_array($curl, array(
       CURLOPT_URL => $host,
       CURLOPT_RETURNTRANSFER => true,
       // CURLOPT_ENCODING => "",
       // CURLOPT_MAXREDIRS => 10,
       // CURLOPT_TIMEOUT => 30,
       // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
       CURLOPT_CUSTOMREQUEST => $method,
       CURLOPT_POSTFIELDS => json_encode(
           [
           'tracking_information' => [array('carrier_name'=>$fyndiq_carrier_name, "tracking_number"=> $fyndiq_tracking_number)],
           ]
           ),
           CURLOPT_HTTPHEADER => [
           'Authorization: Basic ' . base64_encode($username . ':' . $password)
           ],
       ));
       $response = curl_exec($curl);
       $err = curl_error($curl);
       fwrite($fp, PHP_EOL . ' response for update_fyndiq_order = '.$order_id.PHP_EOL.PHP_EOL."<pre>".print_r($response,true) );
       fwrite($fp, PHP_EOL . ' err for update_fyndiq_order ='.$order_id.PHP_EOL.PHP_EOL.($err) );
       curl_close($curl);
       if(!$err){
          update_post_meta($order_id, 'fyndiq_order_status',$action);
       }
   }
}
add_filter( 'woocommerce_admin_order_preview_get_order_details', 'admin_order_preview_add_custom_billing_data', 10, 2 );
function admin_order_preview_add_custom_billing_data( $data, $order ) {
    $custom_billing_data = []; // initializing
    // Custom field 1: Replace '_custom_meta_key1' by the correct custom field metakey
    if( $custom_value1 = $order->get_meta('fyndiq_order_note') ) {
        $custom_billing_data[] = $custom_value1;
    }
    ## ……… And so on (for each additional custom field).
    // Check that our custom fields array is not empty
    if( count($custom_billing_data) > 0 ) {
        // Converting the array in a formatted string
        $formatted_custom_billing_data = implode( '<br>', $custom_billing_data );
        // $data['formatted_billing_address'] .= '<br> Note : ' . $formatted_custom_billing_data;
        $data['formatted_billing_address'] .= '<br> <b>Note</b> : ' . $formatted_custom_billing_data;
    }
    return $data;
}
function fyndiq_page() {
  // Print header
   global $title;
   print '<div class="wrap">';
   $fyndiq_license_key = get_option('fyndiq_license_key');  
    if($fyndiq_license_key){
     print "<h1>$title</h1>";
    }
    $file = plugin_dir_path( __FILE__ ) . "connect/connect.php";
     if ( file_exists( $file ) ){
     require $file;
    }
   print '</div>';
}
function fyndiq_invoice_page() {
  // Print header
   global $title;
   print '<div class="wrap">';
   $fyndiq_license_key = get_option('fyndiq_license_key');  
    if($fyndiq_license_key){
     print "<h1>$title</h1>";
    }
    $file = plugin_dir_path( __FILE__ ) . "includes/fyndiq_invoice_setting.php";
     if ( file_exists( $file ) ){
     require $file;
    }
   print '</div>';
}
function get_fyndiq_article($article_id="",$sku=""){
  $host =fyndiq_api_url."articles/".$article_id;
  if(!empty($sku)){
    $host =fyndiq_api_url."articles/sku/".$sku;
  }
   $username = get_option("fyndiq_field_merchant_id");
   $password = get_option("fyndiq_field_merchant_password");
   // print_r($_REQUEST);
   // return  wp_list_categories( array('taxonomy' => 'product_cat', 'title_li'  => '') );
   $response= false;
   if($username && $username){
       $curlSecondHandler = curl_init();
       curl_setopt_array($curlSecondHandler, [
           CURLOPT_URL => $host,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . base64_encode($username . ':' . $password)
            ],
        ]);
        $response = curl_exec($curlSecondHandler);
        curl_close($curlSecondHandler);
        if(!$response){
            $response=false;
        }
        // echo "<pre>";
        // print_r($response);
        return $response;
   }
}
function post_article_fyndiq($post_id,$method,$action=""){
    // echo "<pre>". print_r($_POST,true);
    $fyndiq_marketplace = explode(",",wp_strip_all_tags(get_option('fyndiq_marketplace'))); 
    $fp = fopen( dirname( __FILE__ ) . '/post_article_fyndiq.txt', 'w+' );
    $fyndiq_status = $_POST['fyndiq_status'];
    $fyndiq_categories = $_POST['fyndiq_categories'];
    $fyndiq_brand = $_POST['fyndiq_brand'];
    $fyndiq_gtin = $_POST['fyndiq_gtin'];
    //$fyndiq_market_field = $_POST['fyndiq_market_field'];
    $fyndiq_market_field = [];
    $price_ary=[];
    $shipping_time_ary=[];
    $description_ary=[];

    $price_original_ary=[];
    $fyndiq_price = $_POST['fyndiq_price'];
    if(!is_float($fyndiq_price)){
      // $fyndiq_price =  (float)$fyndiq_price.".0";
       // echo "<br>";
    }
    $fyndiq_price_original = (int) $_POST['fyndiq_price_original'];
    if(!is_float($fyndiq_price_original)){
       $fyndiq_price_original = (int) $fyndiq_price_original;
    }
    $fyndiq_days_min = (int) $_POST['fyndiq_days_min'];
    $fyndiq_days_max =(int)  $_POST['fyndiq_days_max'];
    $fyndiq_language = $_POST['fyndiq_language'];
    $fyndiq_currency = $_POST['fyndiq_currency'];
    $fyndiq_variation_items = $_POST['fyndiq_variation_items'];
    $fyndiq_properties = $_POST['fyndiq_properties'];
    $fyndiq_variations = $_POST['fyndiq_variations'];
    $variational_property = $_POST['variational_property'];
    $fyndiq_parent_sku = $_POST['fyndiq_parent_sku'];
    $qty = (int) $_POST['_stock'];
    if($qty<1){
        $qty=(int)0;
    }
   
    $fyndiq_product_status_se="";
    $fyndiq_product_status_dk="";
    $fyndiq_product_status_fi="";
    $fyndiq_product_status_no="";

    $fyndiq_price_dk="";
    $fyndiq_price_fi="";
    $fyndiq_price_no="";
    $fyndiq_price_original_dk="";
    $fyndiq_price_original_fi="";
    $fyndiq_price_original_no="";

    $fyndiq_days_min_dk="";
    $fyndiq_days_min_fi="";
    $fyndiq_days_min_no="";
    $fyndiq_days_max_dk="";
    $fyndiq_days_max_fi="";
    $fyndiq_days_max_no="";

    $fyndiq_product_status_se =  $_POST['fyndiq_product_status_se'];
    $fyndiq_product_status_dk =  $_POST['fyndiq_product_status_dk'];
    $fyndiq_product_status_fi =  $_POST['fyndiq_product_status_fi'];
    $fyndiq_product_status_no =  $_POST['fyndiq_product_status_no'];

    $username = get_option("fyndiq_field_merchant_id");
    $password = get_option("fyndiq_field_merchant_password");
    if($post_id && $method && $action){
      $main_image="";
      $product_meta = get_post_meta($post_id);
      $product = wc_get_product( $post_id );
      $attachment_ids = $product->get_gallery_image_ids();
      $original_image_url= array();
      foreach( $attachment_ids as $attachment_id ) 
       {
             $original_image_url[] = wp_get_attachment_url( $attachment_id );
             // $original_image_url.= wp_get_attachment_url( $attachment_id ).",";
      }
      $wp_get_attachment_image_src =  wp_get_attachment_image_src( $product_meta['_thumbnail_id'][0], 'full' );
      if($wp_get_attachment_image_src){
          $main_image= $wp_get_attachment_image_src[0];
      }
      // $main_image="http://test.test/test.png";
      $ary_property=array();
      if(in_array("Sweden", $fyndiq_marketplace) && $fyndiq_product_status_se=="Online") {
        array_push($fyndiq_market_field,"SE");
        $fyndiq_price_original=(int) $_POST['fyndiq_price_original'];
        array_push($price_ary,array('market'=>"SE", "value"=> array("amount"=> (int)($fyndiq_price), "currency"=> 'SEK')));
        array_push($price_original_ary,array('market'=>"SE", "value"=> array("amount"=> (int)($fyndiq_price_original), "currency"=> 'SEK')));
        array_push($shipping_time_ary,array('market'=>"SE", "min"=> $fyndiq_days_min, "max"=> $fyndiq_days_max));
       }
       if(in_array("Denmark", $fyndiq_marketplace) && $fyndiq_product_status_dk=="Online") {
            $fyndiq_price_dk=$_POST['fyndiq_price_dk'];
            $fyndiq_price_original_dk=$_POST['fyndiq_price_original_dk'];
            $fyndiq_days_min_dk=(int) $_POST['fyndiq_days_min_dk'];
            $fyndiq_days_max_dk=(int) $_POST['fyndiq_days_max_dk'];
            array_push($fyndiq_market_field,"DK");
            array_push($price_ary,array('market'=>"DK", "value"=> array("amount"=> (int)($fyndiq_price_dk), "currency"=> 'DKK')));
            array_push($price_original_ary,array('market'=>"DK", "value"=> array("amount"=> (int)($fyndiq_price_original_dk), "currency"=> 'DKK')));
            array_push($shipping_time_ary, array('market'=>"DK", "min"=> $fyndiq_days_min_dk, "max"=> $fyndiq_days_max_dk));
        }
        if(in_array("Finland", $fyndiq_marketplace) && $fyndiq_product_status_fi=="Online") {
            $fyndiq_price_fi=$_POST['fyndiq_price_fi'];
            $fyndiq_price_original_fi=$_POST['fyndiq_price_original_fi'];
            $fyndiq_days_min_fi=(int) $_POST['fyndiq_days_min_fi'];
            $fyndiq_days_max_fi=(int) $_POST['fyndiq_days_max_fi'];
            array_push($fyndiq_market_field,"FI");
            array_push($price_ary, array('market'=>"FI", "value"=> array("amount"=> (int)($fyndiq_price_fi), "currency"=> 'EUR')) );
            array_push($price_original_ary,array('market'=>"FI", "value"=> array("amount"=> (int)($fyndiq_price_original_fi), "currency"=> 'EUR')));
            array_push($shipping_time_ary,  array('market'=>"FI", "min"=> $fyndiq_days_min_fi, "max"=> $fyndiq_days_max_fi));
        }
        if(in_array("Norway", $fyndiq_marketplace) && $fyndiq_product_status_no=="Online") {
            $fyndiq_price_no=$_POST['fyndiq_price_no'];
            $fyndiq_price_original_no=$_POST['fyndiq_price_original_no'];
            $fyndiq_days_min_no=(int) $_POST['fyndiq_days_min_no'];
            $fyndiq_days_max_no=(int) $_POST['fyndiq_days_max_no'];
            array_push($fyndiq_market_field,"NO");
            array_push($price_ary, array('market'=>"NO", "value"=> array("amount"=> (int)($fyndiq_price_no), "currency"=> 'NOK')));
            array_push($price_original_ary,array('market'=>"NO", "value"=> array("amount"=> (int)($fyndiq_price_original_no), "currency"=> 'NOK')));
            array_push($shipping_time_ary, array('market'=>"NO", "min"=> $fyndiq_days_min_fi, "max"=> $fyndiq_days_max_no));
        }
		
      if($method=="POST"){
           if($fyndiq_variation_items || $fyndiq_parent_sku){
                if($fyndiq_variation_items && $fyndiq_parent_sku){
                  foreach ($fyndiq_variation_items as $key_item => $value_item) {
                      $ary_values = explode(": ",$value_item);
                      // print_r($ary_values);
                      $ary_property[$key_item]['name']=$ary_values[0];
                      $ary_property[$key_item]['value']=$ary_values[1];
                      if($ary_values[0]=="color" || $ary_values[0]=="pattern" || $ary_values[0]=="material" || 
                      $ary_values[0]=="size" || $ary_values[0]=="connection_type" ){
                        $ary_property[$key_item]['language']="en-US";
                      }
                  }
                  $host =fyndiq_api_url."articles";
                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                  CURLOPT_URL => $host,
                  CURLOPT_RETURNTRANSFER => true,
                  // CURLOPT_ENCODING => "",
                  // CURLOPT_MAXREDIRS => 10,
                  // CURLOPT_TIMEOUT => 30,
                  // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => $method,
                  CURLOPT_POSTFIELDS => json_encode(
                      [
                      'sku' => (string) $_POST['_sku'],
                      // 'legacy_product_id' => '',
                      'categories' => $fyndiq_categories,
                      'status' => $fyndiq_status,
                      'brand' => (string)$fyndiq_brand,
                      'quantity' => $qty,
                      'main_image' => $main_image,
                      // 'images' => array(''),
                      'images' => $original_image_url,
                      'gtin' => (string)$fyndiq_gtin,
                      // 'markets' =>  [$fyndiq_market_field],
                      'markets' =>  (array_values($fyndiq_market_field)),
                      'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                      'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                      'price' =>$price_ary,
                      'original_price' =>$price_original_ary,
                      'shipping_time' =>$shipping_time_ary,
                      "properties" =>$ary_property,
                      "parent_sku" => $fyndiq_parent_sku,
                       "variational_properties" =>$variational_property
                       ]
                      ),
                      CURLOPT_HTTPHEADER => [
                      'Authorization: Basic ' . base64_encode($username . ':' . $password)
                      ],
                  ));
                  $response = curl_exec($curl);
                  fwrite( $fp, PHP_EOL . ' response for product id = '.$post_id.PHP_EOL.PHP_EOL.print_r($response,true) );
                  $err = curl_error($curl);
                  curl_close($curl);
                  if ($err){
                  } else {
                      $response2 = (json_decode($response));
                       // echo $response;
                      if(isset($response2->errors)){
                        // return false;
                      }else{
                          if($response->id){
                            add_post_meta($post_id, $post_id.'_fyndiq_article_id', $response->id);
                            // return true;
                          }
                      }
                  }
                }else{
                    if($fyndiq_variation_items){
                      foreach ($fyndiq_variation_items as $key_item => $value_item) {
                         foreach ($fyndiq_variation_items as $key_item => $value_item) {
                            $ary_values = explode(": ",$value_item);
                            $ary_property[$key_item]['name']=$ary_values[0];
                            $ary_property[$key_item]['value']=$ary_values[1];
                            if($ary_values[0]=="color" || $ary_values[0]=="pattern" || $ary_values[0]=="material" || 
                            $ary_values[0]=="size" || $ary_values[0]=="connection_type" ){
                              $ary_property[$key_item]['language']="en-US";
                            }
                          }
                      }
                      $host =fyndiq_api_url."articles";
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => $host,
                      CURLOPT_RETURNTRANSFER => true,
                      // CURLOPT_ENCODING => "",
                      // CURLOPT_MAXREDIRS => 10,
                      // CURLOPT_TIMEOUT => 30,
                      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => $method,
                      CURLOPT_POSTFIELDS => json_encode(
                          [
                          'sku' => (string) $_POST['_sku'],
                          // 'legacy_product_id' => '',
                          'categories' => $fyndiq_categories,
                          'status' => $fyndiq_status,
                          'brand' => (string)$fyndiq_brand,
                          'quantity' => $qty,
                          'main_image' => $main_image,
                          // 'images' => array(''),
                          'images' => $original_image_url,
                          'gtin' => (string)$fyndiq_gtin,
                          // 'markets' =>  [$fyndiq_market_field],
                          'markets' =>  (array_values($fyndiq_market_field)),
                          'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                          'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                          'price' =>$price_ary,
                          'original_price' =>$price_original_ary,
                          'shipping_time' =>$shipping_time_ary,
                          "properties" =>$ary_property,
                           "variational_properties" =>$variational_property,
                          ]
                          ),
                          CURLOPT_HTTPHEADER => [
                          'Authorization: Basic ' . base64_encode($username . ':' . $password)
                          ],
                      ));
                      $response = curl_exec($curl);
                      fwrite( $fp, PHP_EOL . ' response for product id = '.$post_id.PHP_EOL.PHP_EOL.print_r($response,true) );
                      $err = curl_error($curl);
                      curl_close($curl);
                      if ($err){
                      } else {
                          $response2 = (json_decode($response));
                      // echo "<pre>". print_r($response2,true);

                           // echo $response;
                          if(isset($response2->errors)){
                            // return false;
                          }else{
                              if($response->id){
                                add_post_meta($post_id, $post_id.'_fyndiq_article_id', $response->id);
                                // return true;
                              }
                          }
                      }

                    }else{
                      $host =fyndiq_api_url."articles";
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => $host,
                      CURLOPT_RETURNTRANSFER => true,
                      // CURLOPT_ENCODING => "",
                      // CURLOPT_MAXREDIRS => 10,
                      // CURLOPT_TIMEOUT => 30,
                      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => $method,
                      CURLOPT_POSTFIELDS => json_encode(
                          [
                          'sku' => (string) $_POST['_sku'],
                          // 'legacy_product_id' => '',
                          'categories' => $fyndiq_categories,
                          'status' => $fyndiq_status,
                          'brand' => (string)$fyndiq_brand,
                          'quantity' => $qty,
                          'main_image' => $main_image,
                          // 'images' => array(''),
                          'images' => $original_image_url,
                          'gtin' => (string)$fyndiq_gtin,
                          // 'markets' =>  [$fyndiq_market_field],
                          'markets' =>  (array_values($fyndiq_market_field)),
                          'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                          'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                          'price' =>$price_ary,
                          'original_price' =>$price_original_ary,
                          'shipping_time' =>$shipping_time_ary,
                          "parent_sku" => $fyndiq_parent_sku
                          ]
                          ),
                          CURLOPT_HTTPHEADER => [
                          'Authorization: Basic ' . base64_encode($username . ':' . $password)
                          ],
                       ));
                        $response = curl_exec($curl);
                        fwrite( $fp, PHP_EOL . ' response for product id = '.$post_id.PHP_EOL.PHP_EOL.print_r($response,true) );
                        $err = curl_error($curl);
                        curl_close($curl);
                        if ($err){
                        } else {
                            $response2 = (json_decode($response));
                             // echo $response;
                            if(isset($response2->errors)){
                              // return false;
                            }else{
                                if($response->id){
                                  add_post_meta($post_id, $post_id.'_fyndiq_article_id', $response->id);
                                  // return true;
                                }
                            }
                        }
                    }
                }
                // echo "<pre>".print_r($ary_property,true);
           } else {
                      $host =fyndiq_api_url."articles";
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => $host,
                      CURLOPT_RETURNTRANSFER => true,
                      // CURLOPT_ENCODING => "",
                      // CURLOPT_MAXREDIRS => 10,
                      // CURLOPT_TIMEOUT => 30,
                      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => $method,
                      CURLOPT_POSTFIELDS => json_encode(
                          [
                          'sku' => (string) $_POST['_sku'],
                          // 'legacy_product_id' => '',
                          'categories' => $fyndiq_categories,
                          'status' => $fyndiq_status,
                          'brand' => (string)$fyndiq_brand,
                          'quantity' => $qty,
                          'main_image' => $main_image,
                          // 'images' => array(''),
                          'images' => $original_image_url,
                          'gtin' => (string)$fyndiq_gtin,
                          // 'markets' =>  [$fyndiq_market_field],
                          'markets' =>  (array_values($fyndiq_market_field)),
                          'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                          'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                          'price' =>$price_ary,
                          'original_price' =>$price_original_ary,
                           // [{"market": "SE", "value": {"amount": 10, "currency": "SEK"}}],
                          'shipping_time' =>$shipping_time_ary,
                          // "parent_sku" => [],
                          "variational_properties" =>[]
                          ]
                          ),
                          CURLOPT_HTTPHEADER => [
                          'Authorization: Basic ' . base64_encode($username . ':' . $password)
                          ],
                      ));
                      $response = curl_exec($curl);
                      fwrite( $fp, PHP_EOL . ' response for product id = '.$post_id.PHP_EOL.PHP_EOL.print_r($response,true) );
                      $err = curl_error($curl);
                      curl_close($curl);
                      if ($err){
                      } else {
                          $response2 = (json_decode($response));
                           // echo $response;
                          if(isset($response2->errors)){
                            // return false;
                          }else{
                              if($response->id){
                                add_post_meta($post_id, $post_id.'_fyndiq_article_id', $response->id);
                                // return true;
                              }
                          }
                      }
           }
      } else{
           $method= "PUT";
           if($action=="article"){
            // echo " $fyndiq_variation_items ".print_r($fyndiq_variation_items,true) ." and $fyndiq_parent_sku = ".$fyndiq_parent_sku;
            $host=fyndiq_api_url."articles/".get_post_meta($post_id, $post_id.'_fyndiq_article_id', true);
            if($fyndiq_variation_items || $fyndiq_parent_sku){
              // print_r($fyndiq_variation_items);
              // var_dump($fyndiq_parent_sku);
              if($fyndiq_variation_items && $fyndiq_parent_sku){
                   foreach ($fyndiq_variation_items as $key_item => $value_item) {
                      $ary_values = explode(": ",$value_item);
                    //   print_r($ary_values);
                      $ary_property[$key_item]['name']=$ary_values[0];
                      $ary_property[$key_item]['value']=(string)$ary_values[1];
                      if($ary_values[0]=="color" || $ary_values[0]=="pattern" || $ary_values[0]=="material" || 
                      $ary_values[0]=="size" || $ary_values[0]=="connection_type" ){
                        $ary_property[$key_item]['language']="en-US";
                      }
                   }
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                    CURLOPT_URL => $host,
                    CURLOPT_RETURNTRANSFER => true,
                    // CURLOPT_ENCODING => "",
                    // CURLOPT_MAXREDIRS => 10,
                    // CURLOPT_TIMEOUT => 30,
                    // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => $method,
                    CURLOPT_POSTFIELDS => json_encode(
                      [
                      'sku' => (string) $_POST['_sku'],
                      // 'legacy_product_id' => $post_id,
                      'categories' => $fyndiq_categories,
                      'status' => $fyndiq_status,
                      'brand' => (string)$fyndiq_brand,
                      // 'quantity' => $qty,
                      'main_image' => $main_image,
                      // // 'images' => array(''),
                      'images' => $original_image_url,
                      'gtin' => (string)$fyndiq_gtin,
                      // 'markets' =>  [$fyndiq_market_field],
                      'markets' =>  (array_values($fyndiq_market_field)),
                      'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                      'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                       // [{"market": "SE", "value": {"amount": 10, "currency": "SEK"}}],
                       // 'shipping_time' => [array('market'=>"SE", "min"=> $fyndiq_days_min, "max"=> $fyndiq_days_max)] ,
                       // [{"market": "SE", "value": {"amount": 10, "currency": "SEK"}}],
                      'shipping_time' =>$shipping_time_ary,
                      "properties" =>$ary_property,
                       "variational_properties" =>$variational_property,
                      "parent_sku" => $fyndiq_parent_sku
                      ]
                   ),
                    CURLOPT_HTTPHEADER => [
                      'Authorization: Basic ' . base64_encode($username . ':' . $password)
                      ],
                  ));
              }else{
                  if($fyndiq_variation_items){
                      foreach ($fyndiq_variation_items as $key_item => $value_item) {
                          $ary_values = explode(": ",$value_item);
                          // print_r($ary_values);
                          $ary_property[$key_item]['name']=$ary_values[0];
                          $ary_property[$key_item]['value']=$ary_values[1];
                          if($ary_values[0]=="color" || $ary_values[0]=="pattern" || $ary_values[0]=="material" || 
                          $ary_values[0]=="size" || $ary_values[0]=="connection_type" ){
                            $ary_property[$key_item]['language']="en-US";
                          }
                       }
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => $host,
                        CURLOPT_RETURNTRANSFER => true,
                        // CURLOPT_ENCODING => "",
                        // CURLOPT_MAXREDIRS => 10,
                        // CURLOPT_TIMEOUT => 30,
                        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => $method,
                        CURLOPT_POSTFIELDS => json_encode(
                          [
                          'sku' => (string) $_POST['_sku'],
                          // 'legacy_product_id' => $post_id,
                          'categories' => $fyndiq_categories,
                          'status' => $fyndiq_status,
                          'brand' => (string)$fyndiq_brand,
                          // 'quantity' => $qty,
                          'main_image' => $main_image,
                          // // 'images' => array(''),
                          'images' => $original_image_url,
                          'gtin' => (string)$fyndiq_gtin,
                          // 'markets' =>  [$fyndiq_market_field],
                          'markets' =>  (array_values($fyndiq_market_field)),
                          'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                          'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                          // 'shipping_time' => [array('market'=>"SE", "min"=> $fyndiq_days_min, "max"=> $fyndiq_days_max)] ,
                         'shipping_time' =>$shipping_time_ary,
                         "properties" =>$ary_property,
                           "variational_properties" =>$variational_property
                          ]
                       ),
                        CURLOPT_HTTPHEADER => [
                          'Authorization: Basic ' . base64_encode($username . ':' . $password)
                          ],
                      ));
                  }else{
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => $host,
                      CURLOPT_RETURNTRANSFER => true,
                      // CURLOPT_ENCODING => "",
                      // CURLOPT_MAXREDIRS => 10,
                      // CURLOPT_TIMEOUT => 30,
                      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => $method,
                      CURLOPT_POSTFIELDS => json_encode(
                        [
                        'sku' => (string) $_POST['_sku'],
                        // 'legacy_product_id' => $post_id,
                        'categories' => $fyndiq_categories,
                        'status' => $fyndiq_status,
                        'brand' => (string)$fyndiq_brand,
                        // 'quantity' => $qty,
                        'main_image' => $main_image,
                        // // 'images' => array(''),
                        'images' => $original_image_url,
                        'gtin' => (string)$fyndiq_gtin,
                        // 'markets' =>  [$fyndiq_market_field],
                         'markets' =>  (array_values($fyndiq_market_field)),
                        'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                        'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                        'shipping_time' =>$shipping_time_ary,
                        "parent_sku" => $fyndiq_parent_sku,
                         "properties" => array(),
                        "variational_properties" =>array()
                        ]
                     ),
                      CURLOPT_HTTPHEADER => [
                        'Authorization: Basic ' . base64_encode($username . ':' . $password)
                        ],
                    ));
                 }
              }
            }else{
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => $host,
                CURLOPT_RETURNTRANSFER => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                // CURLOPT_TIMEOUT => 30,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_POSTFIELDS => json_encode(
                  [
                  'sku' => (string) $_POST['_sku'],
                  // 'legacy_product_id' => $post_id,
                  'categories' => $fyndiq_categories,
                  'status' => $fyndiq_status,
                  'brand' => (string)$fyndiq_brand,
                  // 'quantity' => $qty,
                  'main_image' => $main_image,
                  // // 'images' => array(''),
                  'images' => $original_image_url,
                  'gtin' => (string)$fyndiq_gtin,
                  // 'markets' =>  [$fyndiq_market_field],
                  'markets' =>  (array_values($fyndiq_market_field)),
                  'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                  'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                  'shipping_time' =>$shipping_time_ary,
                   // "parent_sku" => "",
                  "properties" => array(),
                   "variational_properties" =>array()
                  ]
               ),
                CURLOPT_HTTPHEADER => [
                  'Authorization: Basic ' . base64_encode($username . ':' . $password)
                  ],
              ));
            }
            // echo "Done";
            $response = curl_exec($curl);
            // print_r($response);
            fwrite( $fp, PHP_EOL . ' response for article update method for product ='.$post_id.PHP_EOL.PHP_EOL.print_r($response,true) );
            //  echo "<pre>";
            $err = curl_error($curl);
            curl_close($curl);
          } else if($action=="price"){
              $host=fyndiq_api_url."articles/".get_post_meta($post_id, $post_id.'_fyndiq_article_id', true)."/price";
              // $method= "PUT";
              $curl = curl_init();
              curl_setopt_array($curl, array(
              CURLOPT_URL => $host,
              CURLOPT_RETURNTRANSFER => true,
              // CURLOPT_ENCODING => "",
              // CURLOPT_MAXREDIRS => 10,
              // CURLOPT_TIMEOUT => 30,
              // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => $method,
              CURLOPT_POSTFIELDS => json_encode(
                  [
              
                  'price' =>$price_ary,
                  'original_price' =>$price_original_ary,
                  //  // [{"market": "SE", "value": {"amount": 10, "currency": "SEK"}}],
                  ]
                  ),
                  CURLOPT_HTTPHEADER => [
                  'Authorization: Basic ' . base64_encode($username . ':' . $password)
                  ],
              ));
               $response = curl_exec($curl);
               $err = curl_error($curl);
               curl_close($curl);
          } else if($action=="quantity"){
            $host=fyndiq_api_url."articles/".get_post_meta($post_id, $post_id.'_fyndiq_article_id', true)."/quantity";
            $method= "PUT";
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $host,
            CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_ENCODING => "",
            // CURLOPT_MAXREDIRS => 10,
            // CURLOPT_TIMEOUT => 30,
            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode(
                [
                'quantity' => $qty,
                ]
                ),
                CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . base64_encode($username . ':' . $password)
                ],
            ));
             $response = curl_exec($curl);
            print_r($response);
             fwrite($fp, PHP_EOL . ' response for quantity update in PUt method = '.print_r($response,true) );
             // echo "<br>11111<pre>";
             // print_r($response);
              $err = curl_error($curl);
              curl_close($curl);
          } 
      }
    }
    return $response;
}
function post_article_cron_fyndiq($post_id,$method,$act){
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	
    // $fp = fopen( dirname( __FILE__ ) . '/cron_details_cron_one_minute.txt', 'a+' );
   $get_existing_id= get_option("fyndiq_last_updated_product_id",0);
   $fyndiq_marketplace = explode(",",wp_strip_all_tags(get_option('fyndiq_marketplace'))); 
   // fwrite( $fp, PHP_EOL . 'get_existing_id ='.$get_existing_id);
   global $wpdb;
   $get_product_max_id = $wpdb->get_row("SELECT MAX(ID) as ID FROM `" . $wpdb->prefix . "posts` where post_type='product' and post_status = 'publish'");
   // fwrite( $fp, PHP_EOL . 'get_product_max_id ='.print_r($get_product_max_id,true));
   if($get_product_max_id){
      if((int)$get_existing_id>=(int)$get_product_max_id->ID){
		  $fp = fopen( dirname( __FILE__ ) . '/post_article_cron_fyndiq.txt', 'w+' );
//           
          update_option("fyndiq_last_updated_product_id",0);
          $get_existing_id = (int)0;
      }else{
      }
   }else{
   }
    // print_r($_POST);
    file_write_up('Product id is '.$post_id,0);
	file_write_up('Action is '.$act,0);
    $fyndiq_categories = get_post_meta($post_id, 'fyndiq_categories');
    if($fyndiq_categories){
        if(is_array($fyndiq_categories[0])){
           $fyndiq_categories =  $fyndiq_categories[0];
        }
    }
    $fyndiq_market_field = [];
    $price_ary=[];
    $shipping_time_ary=[];
    $description_ary=[];
    $price_original_ary=[];
    $fyndiq_status = get_post_meta($post_id, 'fyndiq_status',true);
    $fyndiq_market_field = get_post_meta($post_id, 'fyndiq_market_field',true);
    $fyndiq_language = get_post_meta($post_id, 'fyndiq_language',true);
    $fyndiq_price = get_post_meta($post_id, 'fyndiq_price',true);
    $fyndiq_price_original = get_post_meta($post_id, 'fyndiq_price_original',true);
    $fyndiq_currency = get_post_meta($post_id, 'fyndiq_currency',true);
    $fyndiq_days_min = (int) get_post_meta($post_id, 'fyndiq_days_min',true);
    $fyndiq_days_max = (int) get_post_meta($post_id, 'fyndiq_days_max',true);
    $fyndiq_gtin =  get_post_meta($post_id, 'fyndiq_gtin',true);
    $fyndiq_variation_items =  get_post_meta($post_id, 'fyndiq_variation_items');
    // $fyndiq_properties =  get_post_meta($post_id, 'fyndiq_properties');
    $fyndiq_variations =  get_post_meta($post_id, 'fyndiq_variations');
    $variational_property =  get_post_meta($post_id, 'variational_property');
    $fyndiq_parent_sku =  get_post_meta($post_id, 'fyndiq_parent_sku',true);
    $fyndiq_brand =  get_post_meta($post_id, 'fyndiq_brand',true);
    if(isset($variational_property[0]) && is_array($variational_property[0])){
      $variational_property =  $variational_property[0];
    }

    $fyndiq_product_status_se="";
    $fyndiq_product_status_dk="";
    $fyndiq_product_status_fi="";
    $fyndiq_product_status_no="";

    $fyndiq_price_dk="";
    $fyndiq_price_fi="";
    $fyndiq_price_no="";
    $fyndiq_price_original_dk="";
    $fyndiq_price_original_fi="";
    $fyndiq_price_original_no="";

    $fyndiq_days_min_dk="";
    $fyndiq_days_min_fi="";
    $fyndiq_days_min_no="";
    $fyndiq_days_max_dk="";
    $fyndiq_days_max_fi="";
    $fyndiq_days_max_no="";

    $fyndiq_product_status_se =  get_post_meta($post_id, 'fyndiq_product_status_se',true);
    $fyndiq_product_status_dk =  get_post_meta($post_id, 'fyndiq_product_status_dk',true);
    $fyndiq_product_status_fi =  get_post_meta($post_id, 'fyndiq_product_status_fi',true);
    $fyndiq_product_status_no =  get_post_meta($post_id, 'fyndiq_product_status_no',true);


    if($fyndiq_variation_items){
        if(is_array($fyndiq_variation_items[0])){
           $fyndiq_variation_items =  $fyndiq_variation_items[0];
        }
    }
    // if($fyndiq_properties){
    //     if(is_array($fyndiq_properties[0])){
    //        $fyndiq_properties =  $fyndiq_properties[0];
    //     }
    // }
    $username = get_option("fyndiq_field_merchant_id");
    $password = get_option("fyndiq_field_merchant_password");
    if($post_id && $method && $act && $username && $password){
      $main_image="";
      $product_meta = get_post_meta($post_id);
		if(isset($product_meta['_thumbnail_id'][0]))
      $wp_get_attachment_image_src =  wp_get_attachment_image_src( $product_meta['_thumbnail_id'][0], 'full' );
      if(isset($wp_get_attachment_image_src) && $wp_get_attachment_image_src){
          $main_image= $wp_get_attachment_image_src[0];
      }
      $product = new WC_product($post_id);
      // echo $product->get_title();
      $attachment_ids = $product->get_gallery_image_ids();
      $original_image_url= array();
      foreach( $attachment_ids as $attachment_id ) 
       {
             $original_image_url[] = wp_get_attachment_url( $attachment_id );
      }

      $ary_property=array();
		$fyndiq_market_field = array();
      if(in_array("Sweden", $fyndiq_marketplace) && $fyndiq_product_status_se=="Online") {
        array_push($fyndiq_market_field,"SE");
        $fyndiq_price_original=(int) get_post_meta($post_id, 'fyndiq_price_original',true);
        $fyndiq_days_min=(int) get_post_meta($post_id, 'fyndiq_days_min',true);
        $fyndiq_days_max=(int) get_post_meta($post_id, 'fyndiq_days_max',true);
        array_push($price_ary,array('market'=>"SE", "value"=> array("amount"=> (int)($fyndiq_price), "currency"=> 'SEK')));
        array_push($price_original_ary,array('market'=>"SE", "value"=> array("amount"=> (int)($fyndiq_price_original), "currency"=> 'SEK')));
        array_push($shipping_time_ary,array('market'=>"SE", "min"=> $fyndiq_days_min, "max"=> $fyndiq_days_max));
       }
       if(in_array("Denmark", $fyndiq_marketplace) && $fyndiq_product_status_dk=="Online") {
            $fyndiq_price_dk=isset($_POST['fyndiq_price_dk'])?$_POST['fyndiq_price_dk']:0;
            $fyndiq_price_dk=(int) get_post_meta($post_id, 'fyndiq_price_dk',true);
            $fyndiq_price_original_dk=(int) get_post_meta($post_id, 'fyndiq_price_original_dk',true);
            $fyndiq_days_min_dk=(int) get_post_meta($post_id, 'fyndiq_days_min_dk',true);
            $fyndiq_days_max_dk=(int) get_post_meta($post_id, 'fyndiq_days_max_dk',true);
            array_push($fyndiq_market_field,"DK");
		   //$fyndiq_price_dk = 999;//raheel test
            array_push($price_ary,array('market'=>"DK", "value"=> array("amount"=> (int)($fyndiq_price_dk), "currency"=> 'DKK')));
            array_push($price_original_ary,array('market'=>"DK", "value"=> array("amount"=> (int)($fyndiq_price_original_dk), "currency"=> 'DKK')));
            array_push($shipping_time_ary, array('market'=>"DK", "min"=> $fyndiq_days_min_dk, "max"=> $fyndiq_days_max_dk));
        }
        if(in_array("Finland", $fyndiq_marketplace) && $fyndiq_product_status_fi=="Online") {
            $fyndiq_price_fi=(int) get_post_meta($post_id, 'fyndiq_price_fi',true);
            $fyndiq_price_original_fi=(int) get_post_meta($post_id, 'fyndiq_price_original_fi',true);
            $fyndiq_days_min_fi=(int) get_post_meta($post_id, 'fyndiq_days_min_fi',true);
            $fyndiq_days_max_fi=(int) get_post_meta($post_id, 'fyndiq_days_max_fi',true);
            array_push($fyndiq_market_field,"FI");
            array_push($price_ary, array('market'=>"FI", "value"=> array("amount"=> (int)($fyndiq_price_fi), "currency"=> 'EUR')) );
            array_push($price_original_ary,array('market'=>"FI", "value"=> array("amount"=> (int)($fyndiq_price_original_fi), "currency"=> 'EUR')));
            array_push($shipping_time_ary,  array('market'=>"FI", "min"=> $fyndiq_days_min_fi, "max"=> $fyndiq_days_max_fi));
        }
        if(in_array("Norway", $fyndiq_marketplace) && $fyndiq_product_status_no=="Online") {
            $fyndiq_price_no=(int) get_post_meta($post_id, 'fyndiq_price_no',true);
            $fyndiq_price_original_no=(int) get_post_meta($post_id, 'fyndiq_price_original_no',true);
            $fyndiq_days_min_no=(int) get_post_meta($post_id, 'fyndiq_days_min_no',true);
            $fyndiq_days_max_no=(int) get_post_meta($post_id, 'fyndiq_days_max_no',true);
            array_push($fyndiq_market_field,"NO");
            array_push($price_ary, array('market'=>"NO", "value"=> array("amount"=> (int)($fyndiq_price_no), "currency"=> 'NOK')));
            array_push($price_original_ary,array('market'=>"NO", "value"=> array("amount"=> (int)($fyndiq_price_original_no), "currency"=> 'NOK')));
            array_push($shipping_time_ary, array('market'=>"NO", "min"=> $fyndiq_days_min_fi, "max"=> $fyndiq_days_max_no));
        }

      $qty  = (int)$product->get_stock_quantity(); 
      if(!$qty || $qty<1){
        $qty=(int)0;
		  return 0;
      }
		file_write_up('Come on line 1120',0);

        $ary_property=array();
		
       if($method=="POST"){
		   file_write_up('Come on cline 1125',0);
		   
          if($fyndiq_variation_items || $fyndiq_parent_sku){
              if($fyndiq_variation_items && $fyndiq_parent_sku){
                  foreach ($fyndiq_variation_items as $key_item => $value_item) {
                      $ary_values = explode(": ",$value_item);
                      // print_r($ary_values);
                      $ary_property[$key_item]['name']=$ary_values[0];
                      $ary_property[$key_item]['value']=$ary_values[1];
                      if($ary_values[0]=="color" || $ary_values[0]=="pattern" || $ary_values[0]=="material" || 
                      $ary_values[0]=="size" || $ary_values[0]=="connection_type" ){
                        $ary_property[$key_item]['language']="en-US";
                      }
                  }
				  		$req = json_encode(
                      [
                      'sku' => (string) $product->get_sku(),
                      // 'legacy_product_id' => '',
                      'categories' => $fyndiq_categories,
                      'status' => $fyndiq_status,
                      'brand' => (string)$fyndiq_brand,
                      'quantity' => $qty,
                      'main_image' => $main_image,
                      // 'images' => array(''),
                      'images' => $original_image_url,
						'price' =>$price_ary,
                      'original_price' =>$price_original_ary,
                      'gtin' => (string)$fyndiq_gtin,
                      // 'markets' =>  [$fyndiq_market_field],
                      'markets' =>  (array_values($fyndiq_market_field)),
                      'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                      'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                      'price' =>$price_ary,
                      'original_price' =>$price_original_ary,
                      'shipping_time' =>$shipping_time_ary,
                      "properties" =>$ary_property,
                        "variational_properties" =>$variational_property,
                        "parent_sku" => $fyndiq_parent_sku
                      ]
			);
		file_write_up('Request Host ',0);
				  file_write_up($host,0);
				  
		file_write_up('Request Method ',0);
				  file_write_up($method,0);
		file_write_up('Request send to API ',0);
		file_write_up($req,0);
                  $host =fyndiq_api_url."articles";
                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                  CURLOPT_URL => $host,
                  CURLOPT_RETURNTRANSFER => true,
                  // CURLOPT_ENCODING => "",
                  // CURLOPT_MAXREDIRS => 10,
                  // CURLOPT_TIMEOUT => 30,
                  // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => $method,
                  CURLOPT_POSTFIELDS => $req,
                      CURLOPT_HTTPHEADER => [
                      'Authorization: Basic ' . base64_encode($username . ':' . $password)
                      ],
                  ));
                 $response = curl_exec($curl);
				  
				  
		file_write_up('Request Response ',0);
				  file_write_up($response,0);
                  $err = curl_error($curl);
                  curl_close($curl);
                  if ($err){
                      // return false;
                      // echo "cURL Error #:" . $err;
                  } else {
                      $response = (json_decode($response));
					  var_dump($response);
					  die('OKKK06');
					  
                      if(isset($response->errors)){
                        // return false;
                      }else{
                          if($response->id){
                           add_post_meta($post_id, $post_id.'_fyndiq_article_id', $response->id);
                            // return true;
                          }
                      }
                  }
              }else{
				  
                    if($fyndiq_variation_items){
                        foreach ($fyndiq_variation_items as $key_item => $value_item) {
							$ary_values =  '';
							if(!is_array($value_item) && $value_item)
							{
                         $ary_values = explode(": ",$value_item);
								
							}
                         // print_r($ary_values);
                         	if(isset($ary_values[0]))
                          $ary_property[$key_item]['name']=$ary_values[0];
							if(isset($ary_values[1]))
                          $ary_property[$key_item]['value']=$ary_values[1];
                          if(isset($ary_values[0]) && isset($ary_values[1]) && ($ary_values[0]=="color" || $ary_values[0]=="pattern" || $ary_values[0]=="material" || 
                          $ary_values[0]=="size" || $ary_values[0]=="connection_type") ){
                            $ary_property[$key_item]['language']="en-US";
                          }
                      }
                      $host =fyndiq_api_url."articles";
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => $host,
                      CURLOPT_RETURNTRANSFER => true,
                      // CURLOPT_ENCODING => "",
                      // CURLOPT_MAXREDIRS => 10,
                      // CURLOPT_TIMEOUT => 30,
                      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => $method,
                      CURLOPT_POSTFIELDS => json_encode(
                          [
                          'sku' => (string) $product->get_sku(),
                          // 'legacy_product_id' => '',
                          'categories' => $fyndiq_categories,
                          'status' => $fyndiq_status,
                          'brand' => (string)$fyndiq_brand,
                          'quantity' => $qty,
                          'main_image' => $main_image,
                          // 'images' => array(''),
                          'images' => $original_image_url,
                          'gtin' => (string)$fyndiq_gtin,
                          // 'markets' =>  [$fyndiq_market_field],
                          'markets' =>  (array_values($fyndiq_market_field)),
                          'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                          'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                          // 'description' =>[array('language'=>$fyndiq_language, "value"=> ($product->get_description()))] ,
                          'price' =>$price_ary,
                          'original_price' =>$price_original_ary,
                          'shipping_time' =>$shipping_time_ary,
                           "properties" =>$ary_property,
                            "variational_properties" =>$variational_property,
                            // "parent_sku" => $fyndiq_parent_sku
                          ]
                          ),
                          CURLOPT_HTTPHEADER => [
                          'Authorization: Basic ' . base64_encode($username . ':' . $password)
                          ],
                      ));
                     $response = curl_exec($curl);
                     file_write_up(PHP_EOL . 'method ='.$method." and response = ".print_r($response,true),0 );
                      $err = curl_error($curl);
                      curl_close($curl);
                      if ($err){
                          // return false;
                          // echo "cURL Error #:" . $err;
                      } else {
                          $response = (json_decode($response));
                          if(isset($response->errors)){
                            // return false;
                          }else{
                              if($response->id){
                               add_post_meta($post_id, $post_id.'_fyndiq_article_id', $response->id);
                                // return true;
                              }
                          }
                      }
                    }else{
                      $host =fyndiq_api_url."articles";
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => $host,
                      CURLOPT_RETURNTRANSFER => true,
                      // CURLOPT_ENCODING => "",
                      // CURLOPT_MAXREDIRS => 10,
                      // CURLOPT_TIMEOUT => 30,
                      // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => $method,
                      CURLOPT_POSTFIELDS => json_encode(
                          [
                          'sku' => (string) $product->get_sku(),
                          // 'legacy_product_id' => '',
                          'categories' => $fyndiq_categories,
                          'status' => $fyndiq_status,
                          'brand' => (string)$fyndiq_brand,
                          'quantity' => $qty,
                          'main_image' => $main_image,
                          // 'images' => array(''),
                          'images' => $original_image_url,
                          'gtin' => (string)$fyndiq_gtin,
                          // 'markets' =>  [$fyndiq_market_field],
                          'markets' =>  (array_values($fyndiq_market_field)),
                          'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                          'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                           // 'description' =>[array('language'=>$fyndiq_language, "value"=> ($product->get_description()))] ,
                           'price' =>$price_ary,
                           'original_price' =>$price_original_ary,
                           'shipping_time' =>$shipping_time_ary,
                           "parent_sku" => $fyndiq_parent_sku
                          ]
                          ),
                          CURLOPT_HTTPHEADER => [
                          'Authorization: Basic ' . base64_encode($username . ':' . $password)
                          ],
                      ));
                     $response = curl_exec($curl);
                     fwrite( $fp, PHP_EOL . 'method ='.$method." and response = ".print_r($response,true) );
                      $err = curl_error($curl);
                      curl_close($curl);
                      if ($err){
                          // return false;
                          // echo "cURL Error #:" . $err;
                      } else {
                          $response = (json_decode($response));
                          if(isset($response->errors)){
                            // return false;
                          }else{
                              if($response->id){
                               add_post_meta($post_id, $post_id.'_fyndiq_article_id', $response->id);
                                // return true;
                              }
                          }
                      }
                    }
              }
          }else{
			  
			  $dta = [
                'sku' => (string) $product->get_sku(),
                // 'legacy_product_id' => '',
                'categories' => $fyndiq_categories,
                'status' => $fyndiq_status,
                'brand' => (string)$fyndiq_brand,
                'quantity' => $qty,
                'main_image' => $main_image,
                // 'images' => array(''),
                'images' => $original_image_url,
                'gtin' => (string)$fyndiq_gtin,
                // 'markets' =>  [$fyndiq_market_field],
                'markets' =>  (array_values($fyndiq_market_field)),
                'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                // 'description' =>[array('language'=>$fyndiq_language, "value"=> ($product->get_description()))] ,
                'price' =>$price_ary,
                'original_price' =>$price_original_ary,
                'shipping_time' =>$shipping_time_ary,
                ];
             $host =fyndiq_api_url."articles";
             $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $host,
            CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_ENCODING => "",
            // CURLOPT_MAXREDIRS => 10,
            // CURLOPT_TIMEOUT => 30,
            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode(
                $dta
                ),
                CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . base64_encode($username . ':' . $password)
                ],
            ));
          $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            if ($err){
                // return false;
                // echo "cURL Error #:" . $err;
            } else {
                $response = (json_decode($response));
                if(isset($response->errors)){
                  // return false;
                }else{
                    if($response->id){
                     add_post_meta($post_id, $post_id.'_fyndiq_article_id', $response->id);
                      // return true;
                    }
                }
            }
          }
        }else{
		   file_write_up('Come on cline 1405',0);
          if($act=="article"){
			  file_write_up('Come on cline 1407',0);
			  		
              if($fyndiq_variation_items || $fyndiq_parent_sku){
                if($fyndiq_variation_items && $fyndiq_parent_sku){
                     foreach ($fyndiq_variation_items as $key_item => $value_item) {
                        $ary_values = explode(": ",$value_item);
                        // print_r($ary_values);
                        $ary_property[$key_item]['name']=$ary_values[0];
                        $ary_property[$key_item]['value']=$ary_values[1];
                        if($ary_values[0]=="color" || $ary_values[0]=="pattern" || $ary_values[0]=="material" || 
                        $ary_values[0]=="size" || $ary_values[0]=="connection_type" ){
                          $ary_property[$key_item]['language']="en-US";
                        }
                     }
                     $host=fyndiq_api_url."articles/".get_post_meta($post_id, $post_id.'_fyndiq_article_id', true);
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => $host,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_CUSTOMREQUEST => $method,
                      CURLOPT_POSTFIELDS => json_encode(
                          [
                          'sku' => (string) $product->get_sku(),
                          'categories' => $fyndiq_categories,
                          'status' => $fyndiq_status,
                           'brand' => (string)$fyndiq_brand,
                          'main_image' => $main_image,
                          'images' => $original_image_url,
                          'gtin' => (string)$fyndiq_gtin,
                          // 'markets' =>  [$fyndiq_market_field],
                          'markets' =>  (array_values($fyndiq_market_field)),
                          'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                          'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                          'shipping_time' =>$shipping_time_ary,
							                        'price' =>$price_ary,
                      'original_price' =>$price_original_ary,
                          "properties" =>$ary_property,
                            "variational_properties" =>$variational_property,
                            "parent_sku" => $fyndiq_parent_sku
                          ]
                          ),
                          CURLOPT_HTTPHEADER => [
                          'Authorization: Basic ' . base64_encode($username . ':' . $password)
                          ],
                      ));
                      $response = curl_exec($curl);
					echo $response;
					die();
//                       fwrite( $fp, PHP_EOL . 'method ='.$method." and response under article updated text = ".print_r($response,true) );
                       // echo "<pre>";
                      $err = curl_error($curl);
                      curl_close($curl);
                }else{
                  if($fyndiq_variation_items){
                    foreach ($fyndiq_variation_items as $key_item => $value_item) {
						$ary_values = array();
						if($value_item)
                        $ary_values = explode(": ",$value_item);
                        // print_r($ary_values);
                        if(isset($ary_values[0]))
                        $ary_property[$key_item]['name']=$ary_values[0];
						if(isset($ary_values[1]))
                        $ary_property[$key_item]['value']=$ary_values[1];
						if(isset($ary_values[0]) && isset($ary_values[1]))
						{
                        if($ary_values[0]=="color" || $ary_values[0]=="pattern" || $ary_values[0]=="material" || 
                        $ary_values[0]=="size" || $ary_values[0]=="connection_type" ){
                          $ary_property[$key_item]['language']="en-US";
                        }
						}
                    }
                     $host=fyndiq_api_url."articles/".get_post_meta($post_id, $post_id.'_fyndiq_article_id', true);
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => $host,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_CUSTOMREQUEST => $method,
                      CURLOPT_POSTFIELDS => json_encode(
                          [
                          'sku' => (string) $product->get_sku(),
                          'categories' => $fyndiq_categories,
                          'status' => $fyndiq_status,
                          'brand' => (string)$fyndiq_brand,
                          'main_image' => $main_image,
                          'images' => $original_image_url,
                          'gtin' => (string)$fyndiq_gtin,
                          // 'markets' =>  [$fyndiq_market_field],
                          'markets' =>  (array_values($fyndiq_market_field)),
                          'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                          'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                          'shipping_time' =>$shipping_time_ary,
                          "properties" =>$ary_property,
                           "variational_properties" =>$variational_property,
                            // "parent_sku" => $fyndiq_parent_sku
                          ]
                          ),
                          CURLOPT_HTTPHEADER => [
                          'Authorization: Basic ' . base64_encode($username . ':' . $password)
                          ],
                      ));
                      $response = curl_exec($curl);
//                       fwrite( $fp, PHP_EOL . 'method ='.$method." and response under article updated text = ".print_r($response,true) );
                       // echo "<pre>";
                      $err = curl_error($curl);
                      curl_close($curl);
                  }else{
                     $host=fyndiq_api_url."articles/".get_post_meta($post_id, $post_id.'_fyndiq_article_id', true);
                      $curl = curl_init();
                      curl_setopt_array($curl, array(
                      CURLOPT_URL => $host,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_CUSTOMREQUEST => $method,
                      CURLOPT_POSTFIELDS => json_encode(
                          [
                          'sku' => (string) $product->get_sku(),
                          'categories' => $fyndiq_categories,
                          'status' => $fyndiq_status,
                          'brand' => (string)$fyndiq_brand,
                          'main_image' => $main_image,
                          'images' => $original_image_url,
                          'gtin' => (string)$fyndiq_gtin,
                          // 'markets' =>  [$fyndiq_market_field],
                          'markets' =>  (array_values($fyndiq_market_field)),
                          'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                          'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                          'shipping_time' =>$shipping_time_ary,
                          "properties" =>array(),
                           "variational_properties" =>array(),
                            "parent_sku" => $fyndiq_parent_sku
                          ]
                          ),
                          CURLOPT_HTTPHEADER => [
                          'Authorization: Basic ' . base64_encode($username . ':' . $password)
                          ],
                      ));
                      $response = curl_exec($curl);
                      file_write_up(PHP_EOL . 'method ='.$method." and response under article updated text = ".print_r($response,true) , 0 );
                       // echo "<pre>";
                      $err = curl_error($curl);
                      curl_close($curl);
                  }
                }
              }else{
                  $host=fyndiq_api_url."articles/".get_post_meta($post_id, $post_id.'_fyndiq_article_id', true);
                  $curl = curl_init();
                  curl_setopt_array($curl, array(
                  CURLOPT_URL => $host,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_CUSTOMREQUEST => $method,
                  CURLOPT_POSTFIELDS => json_encode(
                      [
                      'sku' => (string) $product->get_sku(),
                      'categories' => $fyndiq_categories,
                      'status' => $fyndiq_status,
                      'brand' => (string)$fyndiq_brand,
                      'main_image' => $main_image,
                      'images' => $original_image_url,
                      'gtin' => (string)$fyndiq_gtin,
                      // 'markets' =>  [$fyndiq_market_field],
                      'markets' =>  (array_values($fyndiq_market_field)),
                      'title' => [array('language'=>$fyndiq_language, "value"=> $product->get_title())],
                      'description' =>[array('language'=>$fyndiq_language, "value"=> substr(wp_strip_all_tags($product->get_description()),0,4095))] ,
                      'shipping_time' =>$shipping_time_ary,
                      "properties" =>array(),
                        "variational_properties" =>array(),
                      ]
                      ),
                      CURLOPT_HTTPHEADER => [
                      'Authorization: Basic ' . base64_encode($username . ':' . $password)
                      ],
                  ));
                  $response = curl_exec($curl);
                   // echo "<pre>";
                  $err = curl_error($curl);
                  curl_close($curl);
              }
          } else if($act=="price"){
			  
			  file_write_up('price api will hit 1584',0);
			  $host=fyndiq_api_url."articles/".get_post_meta($post_id, $post_id.'_fyndiq_article_id', true)."/price";
			  file_write_up('price api HOST',0);
			  file_write_up($host,0);
			  $dta = [
					  'price' =>$price_ary,
                      'original_price' =>$price_original_ary,
                  ];
			  file_write_up('price api REQUEST',0);
			  file_write_up($dta,2);
              
              $curl = curl_init();
              curl_setopt_array($curl, array(
              CURLOPT_URL => $host,
              CURLOPT_RETURNTRANSFER => true,
              // CURLOPT_ENCODING => "",
              // CURLOPT_MAXREDIRS => 10,
              // CURLOPT_TIMEOUT => 30,
              // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => $method,
              CURLOPT_POSTFIELDS => json_encode($dta),
                  CURLOPT_HTTPHEADER => [
                  'Authorization: Basic ' . base64_encode($username . ':' . $password)
                  ],
              ));
              // echo "<br>22222
              // <pre>";
              // $response = curl_exec($curl);
              // print_r($response);
               $response = curl_exec($curl);
			  			  file_write_up('price api RESPONSE',0);
			  file_write_up($response,0);			  
               $err = curl_error($curl);
               curl_close($curl);
          } else if($act=="quantity"){
			  file_write_up('quantity api will hit 1584',0);
            $host=fyndiq_api_url."articles/".get_post_meta($post_id, $post_id.'_fyndiq_article_id', true)."/quantity";
			  			  file_write_up('quantity api HOST',0);
			  file_write_up($host,0);
			  $dta = json_encode(
                [
                'quantity' => $qty,
                ]
                );
			  			  			  file_write_up('quantity api REQUEST',0);
			  file_write_up($dta,0);
            $method= "PUT";
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $host,
            CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_ENCODING => "",
            // CURLOPT_MAXREDIRS => 10,
            // CURLOPT_TIMEOUT => 30,
            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $dta,
                CURLOPT_HTTPHEADER => [
                'Authorization: Basic ' . base64_encode($username . ':' . $password)
                ]
            ));
            $response = curl_exec($curl);
			  
             // echo "<br>11111<pre>";
             
            $err = curl_error($curl);
            curl_close($curl);
          } 
      }
    }
    return false;
}
// require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';
function addQuotes($string) {
    return '"'. implode('","', explode(',', $string)) .'"';
}
function fyndiq_deactivate() {
   delete_option('fyndiq_field_merchant_id');
   delete_option('fyndiq_field_merchant_password');
   delete_option('fyndiq_field_connection');
   delete_option('fyndiq_last_updated_product_id');
   delete_option('fyndiq_last_order_page');
   // $license_key = get_option('fyndiq_license_key');
   //  // API query parameters
   //  $api_params = array(
   //      'slm_action' => 'slm_deactivate',
   //      'secret_key' => FYNDIQ_SPECIAL_SECRET_KEY,
   //      'license_key' => $license_key,
   //      'registered_domain' => $_SERVER['SERVER_NAME'],
   //      'item_reference' => urlencode(FYNDIQ_ITEM_REFERENCE),
   //  );
   //  // Send query to the license manager server
   //  $query = esc_url_raw(add_query_arg($api_params, FYNDIQ_LICENSE_SERVER_URL));
   //  $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => false));
   //  // Check for error in the response
   //  if (is_wp_error($response)){
   //      // echo "Unexpected Error! The query returned with an error.";
   //  }
   //  //var_dump($response);//uncomment it if you want to look at the full response
   //  // License data.
   // $license_data = json_decode(wp_remote_retrieve_body($response));
   // delete_option('fyndiq_license_key');
}
function fyndiq_activate() {
  global $wpdb;
   add_option('fyndiq_last_updated_product_id',(int) 0);
   add_option('fyndiq_last_order_page',(int) 0);
}
function isa_activation(){
    // if( !wp_next_scheduled( 'isa_add_every_three_minutes_event' ) ){
    //     wp_schedule_event( time(), 'every_three_minutes', 'isa_add_every_three_minutes_event' );
    // }
}
register_activation_hook(   __FILE__, 'isa_activation' );
// The deactivation hook
function isa_deactivation(){
    // if( wp_next_scheduled( 'isa_add_every_three_minutes_event' ) ){
    //     wp_clear_scheduled_hook( 'isa_add_every_three_minutes_event' );
    // }
}
register_deactivation_hook( __FILE__, 'isa_deactivation' );
// The schedule filter hook
// function isa_add_every_three_minutes( $schedules ) {
//         $schedules['every_three_minutes'] = array(
//                 'interval'  => 180,
//                 // 'interval'  => 60,
//                 'display'   => __( 'Every 3 Minutes' )
//         );
//     return $schedules;
// }
// add_filter( 'cron_schedules', 'isa_add_every_three_minutes' );// The WP Cron event callback function
add_action('wp_ajax_fyndiq_cron', 'fyndiq_cron');
add_action('wp_ajax_nopriv_fyndiq_cron', 'fyndiq_cron');
function file_write_up($txt,$type = 0)
{
	$file = dirname( __FILE__ ) . '/post_article_cron_fyndiq.txt';
	if($type == 1)
	{
		//empty file
		$f = @fopen($file, "r+");
if ($f !== false) {
    ftruncate($f, 0);
    fclose($f);
}
	}
	elseif($type == 2)
	{
		//array writeup
				$fp = fopen( $file, 'a' );

     fwrite( $fp,PHP_EOL .date('Y-m-d H:i:s').print_r($txt,true));
	}
	else 
	{
		//text write here
			$fp = fopen( $file, 'a' );
     $r = fwrite( $fp, PHP_EOL .date('Y-m-d H:i:s').$txt);
	}
}
if(isset($_GET['new_cron']))
{
	new_cron();
}
function new_cron()
{
	file_write_up('',1);
	file_write_up('Start',0);
	    $username = get_option("fyndiq_field_merchant_id");
    $password = get_option("fyndiq_field_merchant_password");
    if($username && $password){
		    $get_existing_id= get_option("fyndiq_last_updated_product_id",0);
			file_write_up('get_existing_id ='.$get_existing_id,0);
		global $wpdb;
    $get_product_max_id = $wpdb->get_row("SELECT MAX(ID) as ID FROM `" . $wpdb->prefix . "posts` where post_type='product' and post_status = 'publish'");
				file_write_up('get_product_max_id',0);
		
		file_write_up($get_product_max_id,2);
		    if($get_product_max_id){
		file_write_up('if true $get_product_max_id',0);
		
    if((int)$get_existing_id>=(int)$get_product_max_id->ID){
		file_write_up('if((int)$get_existing_id>=(int)$get_product_max_id->ID){',0);
        file_write_up('inside update',0);
        update_option("fyndiq_last_updated_product_id",0);
        $get_existing_id = (int)0;
      }else{
		file_write_up('There are some products to update',0);
    }
    }else{
    }
		$limit=10;
    $all_product_data = $wpdb->get_results("SELECT ID,post_title,post_content,post_author,post_date_gmt FROM `" . $wpdb->prefix . "posts` where post_type='product' and post_status = 'publish' and ID>".$get_existing_id."  order by ID limit 0,".$limit);
		file_write_up('All data $all_product_data',0);
		file_write_up($all_product_data,2);
    if($all_product_data){
	}
	else{
		$txt = 'no username/password found';
	file_write_up($txt,0);
	}
	file_write_up('End',0);
	die('OK');
}
function fyndiq_cron() {
	
	

	

    $username = get_option("fyndiq_field_merchant_id");
    $password = get_option("fyndiq_field_merchant_password");
    if($username && $password){
    $get_existing_id= get_option("fyndiq_last_updated_product_id",0);
		file_write_up('get_existing_id ='.$get_existing_id,0);
		
    global $wpdb;
    $get_product_max_id = $wpdb->get_row("SELECT MAX(ID) as ID FROM `" . $wpdb->prefix . "posts` where post_type='product' and post_status = 'publish'");
		file_write_up('get_product_max_id',0);
		file_write_up($get_product_max_id,2);
		
		
    if($get_product_max_id){
		file_write_up('if true $get_product_max_id',0);
		
    if((int)$get_existing_id>=(int)$get_product_max_id->ID){
		file_write_up('if((int)$get_existing_id>=(int)$get_product_max_id->ID){',0);
        file_write_up('inside update',0);
        update_option("fyndiq_last_updated_product_id",0);
        $get_existing_id = (int)0;
        fopen( dirname( __FILE__ ) . '/fyndiq_cron.txt', 'w+' );
      }else{
		file_write_up('come on line 1761',0);
       $fp = fopen( dirname( __FILE__ ) . '/post_article_cron_fyndiq.txt', 'a' );
    }
    }else{
    }
		file_write_up('come on line 1766',0);
    $limit=10;
    $all_product_data = $wpdb->get_results("SELECT ID,post_title,post_content,post_author,post_date_gmt FROM `" . $wpdb->prefix . "posts` where post_type='product' and post_status = 'publish' and ID>".$get_existing_id."  order by ID limit 0,".$limit);
		file_write_up('come on line 1769',0);
		file_write_up('All data $all_product_data',0);
		file_write_up($all_product_data,2);
    if($all_product_data){
    $host =fyndiq_api_url."articles";
    $host2 =fyndiq_api_url."articles";
		file_write_up('loop outer line 75',0);
    foreach ($all_product_data as $key => $value) {
		file_write_up('inside loop',0);
      $post_id =  $value->ID;
		file_write_up('loop for product id '.$post_id,0);
      $product = new WC_product($post_id);
      $attachment_ids = $product->get_gallery_image_ids();
      $original_image_url= array();
      foreach( $attachment_ids as $attachment_id ){
            // Display the image URL
           $original_image_url[] = wp_get_attachment_url( $attachment_id );
             // $original_image_url.= wp_get_attachment_url( $attachment_id ).",";
            // Display Image instead of URL
            // echo "<br> wp_get_attachment_image = <br>". wp_get_attachment_image($attachment_id, 'full');
      }
      if($attachment_ids){
       // $original_image_url =  addQuotes(substr($original_image_url, 0,-1));
      }
      $qty  = (int)$product->get_stock_quantity(); 
		file_write_up(' product QTY id '.$qty,0);
      // $qty  = (int)111; 
      if(!$qty || $qty<1){
        $qty=(int)0;
         
      }

      // $main_image="http://test.test/test.png";
      $main_image="";
      $product_meta = get_post_meta($post_id);
      $wp_get_attachment_image_src =  wp_get_attachment_image_src( $product_meta['_thumbnail_id'][0], 'full' );
      if($wp_get_attachment_image_src){
            $main_image= $wp_get_attachment_image_src[0];
      }
      $fyndiq_categories = get_post_meta($post_id, 'fyndiq_categories',true);
      $fyndiq_status = get_post_meta($post_id, 'fyndiq_status',true);
      $fyndiq_market_field = get_post_meta($post_id, 'fyndiq_market_field',true);
      $fyndiq_language = get_post_meta($post_id, 'fyndiq_language',true);
      $fyndiq_price = get_post_meta($post_id, 'fyndiq_price',true);
      $fyndiq_original_price = get_post_meta($post_id, 'fyndiq_original_price',true);
      $fyndiq_currency = get_post_meta($post_id, 'fyndiq_currency',true);
      $fyndiq_min_days = (int) get_post_meta($post_id, 'fyndiq_min_days',true);
      $fyndiq_max_days = (int) get_post_meta($post_id, 'fyndiq_max_days',true);
      $fyndiq_gtin =  get_post_meta($post_id, 'fyndiq_gtin',true);
      $fyndiq_brand =  get_post_meta($post_id, 'fyndiq_brand',true);
          if(isset($qty)){
			  file_write_up('come on line 1820',0);
			  
          update_option("fyndiq_last_updated_product_id",$post_id);
			  
			  
			  
          if(get_post_meta( $post_id, $post_id.'_fyndiq_article_id', true) ){
			  file_write_up('Product already pushed to fyndiq id is '.get_post_meta( $post_id, $post_id.'_fyndiq_article_id', true),0);
              $article_details = get_fyndiq_article(get_post_meta( $post_id, $post_id.'_fyndiq_article_id', true));
			  file_write_up($article_details,0);

			                $article_exist = get_fyndiq_article("",(string) $product->get_sku());
              

              if(isset($article_details->errors) && !$article_details->errors){
                  file_write_up('Error in fetching detail from fyndiq 1835',0);
                  $article_details = json_decode($article_details);
                  if($article_details->id){
					  
					  
                    if($article_details->status=="deleted"){
                      delete_post_meta($post_id, $post_id.'_fyndiq_article_id'); 
                      post_article_cron_fyndiq($post_id,"POST","article");
                    }else{
						
                        post_article_cron_fyndiq($post_id,"PUT","price");
// 						die('here67');
                        sleep(5);
                        post_article_cron_fyndiq($post_id,"PUT","article");
                        sleep(5);
                        post_article_cron_fyndiq($post_id,"PUT","quantity");
                    }
                  }else{
                    delete_post_meta( $post_id, $post_id.'_fyndiq_article_id'); 
                    post_article_cron_fyndiq($post_id,"POST","article");
                 }
              }else{
				  file_write_up('Artical find in fyndiq 1857',0);
                  $article_exist = get_fyndiq_article("",(string) $product->get_sku());
                     if($article_exist){
                         $article_exist=json_decode($article_exist);
						 file_write_up('Get Artical API response',0);
						 file_write_up($article_exist,2);
						 
                         if($article_exist->description=="Article found"){
                            add_post_meta($post_id, $post_id.'_fyndiq_article_id', $article_exist->content->article->id); 
							 file_write_up('PUT Artical to fyndin start',0);
                            post_article_cron_fyndiq($post_id,"PUT","article");
							 file_write_up('PUT Artical to fyndin end',0);
                            sleep(1);
							 file_write_up('POST Artical price to fyndin start',0);
                            post_article_cron_fyndiq($post_id,"PUT","price");
							 file_write_up('POST Artical price to fyndin end',0);
                            sleep(1);
							 file_write_up('POST Artical quantity to fyndin start',0);
                            post_article_cron_fyndiq($post_id,"PUT","quantity");
							 file_write_up('POST Artical quantity to fyndin end',0);
                         }else if($article_exist->description=="Article not found" || $article_exist->description=="Not found"){
                            post_article_cron_fyndiq($post_id,"POST","article");
							 die('89');
                         }
                     }else{
                         $res= post_article_cron_fyndiq($post_id,"POST","article");
						 die('94');
                     }
              }
               //echo 111; exit;
          }else{
              // echo "4";
              // exit;
              $article_exist = get_fyndiq_article("",(string) $product->get_sku());
               if($article_exist){
                   $article_exist=json_decode($article_exist);
                   if($article_exist->description=="Article found"){
                      add_post_meta($post_id, $post_id.'_fyndiq_article_id', $article_exist->content->article->id); 
                      post_article_cron_fyndiq($post_id,"PUT","article");
                      sleep(1);
                      post_article_cron_fyndiq($post_id,"PUT","price");
                      sleep(1);
                      post_article_cron_fyndiq($post_id,"PUT","quantity");
                   } else if($article_exist->description=="Article not found" || $article_exist->description=="Not found"){
					   
                     $r = post_article_cron_fyndiq($post_id,"POST","article");
                 }
               }else{
                   $res= post_article_cron_fyndiq($post_id,"POST","article");
               }
            }
      }else{
			  file_write_up('no quantity found',0);
			  die('no');
        }
      }
		file_write_up('Loop end',0);
		
     }
    }else{
     $fp = fopen( dirname( __FILE__ ) . '/cron_details_cron_one_minute.txt', 'w+' );
     fwrite( $fp, PHP_EOL . 'no username/password found');
  }
	die('come30');
}

// add_action('wp_ajax_fyndiq_order_cron', 'fyndiq_order_cron');
// add_action('wp_ajax_nopriv_fyndiq_order_cron', 'fyndiq_order_cron');

function fyndiq_order_cron() {
    $username = get_option("fyndiq_field_merchant_id");
    $password = get_option("fyndiq_field_merchant_password");
    if($username && $password){
    $get_existing_id= get_option("fyndiq_last_updated_product_id",0);
    fwrite( $fp, PHP_EOL . 'get_existing_id ='.$get_existing_id);
    global $wpdb;
      $res_orders = get_fyndiq_orders("CREATED");
      $cnt_order_count = 1;
      if($res_orders){
         $fp = fopen( dirname( __FILE__ ) . '/CREATED.txt', 'w+' );
         // fwrite( $fp, PHP_EOL . ' res_orders ='.print_r(json_decode($res_orders),true));
        $res_orders = json_decode($res_orders);
        if($res_orders){
          foreach ($res_orders as  $value) {
            $posts = $wpdb->get_results("SELECT meta_id FROM $wpdb->postmeta WHERE meta_key = 'fyndiq_order_id' AND  meta_value = '".$value->id."' LIMIT 1", ARRAY_A);
              fwrite( $fp, PHP_EOL . ' posts ='.print_r($posts,true));
              // $fyndiq_order_id = get_post_meta($value->id, 'fyndiq_order_id',true);
              if(empty($posts)){
                fwrite( $fp, PHP_EOL . ' in side !fyndiq_order_id');
                create_fyndiq_orders($value);
              }else{
                fwrite( $fp, PHP_EOL . ' in else of !fyndiq_order_id');
              }
              $cnt_order_count++;
              if($cnt_order_count==100){
                $fyndiq_last_order_page= get_option("fyndiq_last_order_page",(int) 0);
                update_option("fyndiq_last_order_page",($fyndiq_last_order_page+1));
              }
            }
          }
        }else{
            update_option("fyndiq_last_order_page",(int) 0);
            fyndiq_order_cron();
        }
    }
}
// add_action('woocommerce_admin_order_data_after_order_details', 'custom_code_after_order_details2', 10, 3);
add_action( 'woocommerce_order_status_completed','woocommerce_order_status_completed' );
add_action('woocommerce_process_shop_order_meta', 'custom_code_after_order_details', 10, 3);
// add_action( 'woocommerce_api_edit_order', 'custom_code_after_order_details', 10, 3 );
function custom_code_after_order_details($order_id, $order) {
  if(!empty($_POST) && $_POST['action']=="editpost"){
     $fp = fopen( dirname( __FILE__ ) . '/custom_code_after_order_details.txt', 'w+' );
      $fyndiq_order_status = get_post_meta($order->id, 'fyndiq_order_status',true);
      $fyndiq_order_id = get_post_meta($post->ID, 'fyndiq_order_id',true);
      if($fyndiq_order_status && $fyndiq_order_status=="CREATED" && ($_POST['post_status']=="wc-completed" || $_POST['post_status']=="wc-cancelled") && $fyndiq_order_id){
        $text="cancel";
        if($_POST['post_status']=="wc-completed"){
          $text="fulfill";
        }
         // update_fyndiq_order($order_id,$fyndiq_order_id,$text);
      }
  }
  // echo print_r($order->order_status,true);
}
add_action( 'woocommerce_order_status_cancelled', 'change_status_to_cancelled', 10, 1 );
function change_status_to_cancelled( $order_id ){
  $fyndiq_order_id = get_post_meta($order_id, 'fyndiq_order_id',true);
  update_fyndiq_order($order_id,$fyndiq_order_id,"cancel");
}
function woocommerce_order_status_completed($order) {
 $fyndiq_order_id = get_post_meta($order->id, 'fyndiq_order_id',true);
  if(!empty($_REQUEST) && $_REQUEST['action']=="woocommerce_mark_order_status" && $_REQUEST['status']=="completed" && $fyndiq_order_id){
      update_fyndiq_order($order->id,$fyndiq_order_id,"fulfill");
  }
}
// add_action( 'isa_add_every_three_minutes_event', 'isa_every_three_minutes_event_func' );
add_action( 'transition_post_status', 'cp_sync', 10, 3 );
function cp_sync( $new_status, $old_status, $post ) {
    $fp = fopen( dirname( __FILE__ ) . '/cp_sync.txt', 'w+' );
	if($post->post_type == 'product')
	{
		fyndiq_cron();
	}
    $check_order_status = get_post_meta($post->ID, 'fyndiq_order_status',true);
    $fyndiq_order_id = get_post_meta($post->ID, 'fyndiq_order_id',true);
    if($check_order_status=="CREATED" && ($new_status=="wc-completed" || $new_status=="wc-cancelled") && $fyndiq_order_id){
      $text="cancel";
      if($new_status=="wc-completed"){
         $text="fulfill";
      }
      update_fyndiq_order($post->ID,$fyndiq_order_id,$text);
    }
}
add_action('template_redirect', 'load_fyndiq');
function load_fyndiq(){
  $fyndiq_license_key = get_option('fyndiq_license_key');
  if($fyndiq_license_key && !empty($fyndiq_license_key)){
      setcookie(date("Y-m-d"), date("Y-m-d"), time() + 14400);
          $api_params = array(
          'slm_action' => 'slm_activate',
          'secret_key' => FYNDIQ_SPECIAL_SECRET_KEY,
          'license_key' => $fyndiq_license_key,
          'registered_domain' => $_SERVER['SERVER_NAME'],
          'item_reference' => urlencode(FYNDIQ_ITEM_REFERENCE),
      );
      // Send query to the license manager server
      $query = esc_url_raw(add_query_arg($api_params, FYNDIQ_LICENSE_SERVER_URL));
      $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => false));
      $license_data = json_decode(wp_remote_retrieve_body($response));
      if (is_wp_error($response)){
          // echo 1111111;
      }else{
        if($license_data->error_code=="30" || $license_data->error_code==30 || $license_data->error_code=="20" || $license_data->error_code==20 ){
            delete_option('fyndiq_license_key');
            delete_option('fyndiq_field_merchant_id');
            delete_option('fyndiq_field_merchant_password');
            delete_option('fyndiq_field_connection');
            delete_option('fyndiq_last_updated_product_id');
            delete_option('fyndiq_license_key');
          }
        }
  }
  //I load just before selecting and rendering the template to screen
}
add_filter( 'manage_edit-shop_order_columns', 'set_custom_edit_shop_order_columns' );
function set_custom_edit_shop_order_columns($columns) {
    $columns['fyndiq_carrier_name'] = __( 'Carrier Name', 'woocommerce' );
    $columns['fyndiq_tracking_number'] = __( 'Tracking number', 'woocommerce' );
    return $columns;
}
// Add the data to the custom columns for the order post type:
add_action( 'manage_shop_order_posts_custom_column' , 'fyndiq_shop_order_column', 10, 2 );
function fyndiq_shop_order_column( $column, $post_id ) {
    switch ( $column ) {
        case 'fyndiq_carrier_name' :
            echo esc_html( get_post_meta( $post_id, 'fyndiq_carrier_name', true ) );
            break;
        case 'fyndiq_tracking_number' :
            echo esc_html( get_post_meta( $post_id, 'fyndiq_tracking_number', true ) );
            break;
    }
}
// Add a metabox.
add_action( 'add_meta_boxes', 'add_shop_order_meta_box' );
function add_shop_order_meta_box() {
    add_meta_box(
        'custom_meta_box',
        __( 'Fyndiq Tracking information', 'woocommerce' ),
        'shop_order_content_callback',
        'shop_order'
    );
}
// For displaying metabox content
function shop_order_content_callback( $post ) {
    // Textarea Field
    $fyndiq_carrier_name = get_post_meta( $post->ID, 'fyndiq_carrier_name', true );
    echo '<p>' . __( 'Carrier Name', 'woocommerce' ) . '<br>
    <textarea style="width:100%" id="fyndiq_carrier_name" name="fyndiq_carrier_name">' . esc_attr( $fyndiq_carrier_name ) . '</textarea></p>';
    // Text field
    $fyndiq_tracking_number = get_post_meta( $post->ID, 'fyndiq_tracking_number', true );
    echo '<p>' . __( 'Tracking Number', 'woocommerce' ) . '<br>
    <input type="text" style="width:100%" id="fyndiq_tracking_number" name="fyndiq_tracking_number" value="' . esc_attr( $fyndiq_tracking_number ) . '"></p>';
}
// For saving the metabox data.
add_action( 'save_post_shop_order', 'save_shop_order_meta_box_data' );
function save_shop_order_meta_box_data( $post_id ) {
    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Check the user's permissions.
    if ( ! current_user_can( 'edit_shop_order', $post_id ) ) {
        return;
    }
    // Make sure that 'shipping_date' is set.
    if ( isset( $_POST['fyndiq_carrier_name'] ) ) {
        // Update the meta field in the database.
        update_post_meta( $post_id, 'fyndiq_carrier_name', sanitize_textarea_field( $_POST['fyndiq_carrier_name'] ) );
    }
    // Make sure that 'fyndiq_tracking_number' it is set.
    if ( isset( $_POST['fyndiq_tracking_number'] ) ) {
        // Update the meta field in the database.
        update_post_meta( $post_id, 'fyndiq_tracking_number', sanitize_text_field( $_POST['fyndiq_tracking_number'] ) );
    }
    $fyndiq_order_id = get_post_meta($post_id, 'fyndiq_order_id',true);
    if( isset( $_POST['fyndiq_carrier_name'] ) &&  isset( $_POST['fyndiq_tracking_number'] ) && $fyndiq_order_id){
      update_fyndiq_order_tracking_info($post_id,$fyndiq_order_id,"fulfill");
    }
}
register_deactivation_hook( __FILE__, 'fyndiq_deactivate' );
register_activation_hook( __FILE__, 'fyndiq_activate' );
require_once plugin_dir_path( __FILE__ ) . 'includes/fyndiq.php';
 // $fp = fopen( dirname( __FILE__ ) . '/cron_details.txt', 'w+' );
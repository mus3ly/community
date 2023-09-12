<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */
 function custom_redirect($url)
 {
     ?>
     <head>
    <script type="text/javascript">
      function RedirectionJavascript(){
        document.location.href="<?= $url; ?>";
      }
      RedirectionJavascript();
   </script>
     <?php
     exit();
 }
 function formate_date($date)
 {
     return date("M d, Y", strtotime($date));
 }
 function img_url($pth = '')
 {
    //img_url
    $CI =& get_instance();
    $url = $CI->config->item('img_url');
    if ($pth) {
        $url = $url.$pth;
    }
    return $url;

 }
 function update_col($product_id)
 {
     $CI =& get_instance();
     $up = array(
         'col1'=>get_fields_line($product_id, 1),
         'col2'=>get_fields_line($product_id, 2),
         'col3'=>get_fields_line($product_id, 3),
         'col4'=>get_fields_line($product_id, 4),
         'col5'=>get_fields_line($product_id, 5),
         'col6'=>get_fields_line($product_id, 6),
         'col_update'=>date('Y-m-d H:i:s'),
         );
         return $pro = $CI->db->where('product_id',$product_id)->update('product', $up);
 }
 function find_values($f, $v)
 {
     $v = strtolower($v);
     $i = 0;
     $find = '';
     foreach($f as $k=> $vv)
     {
         $k = strtolower($k);
         $i++;
         if (strpos($k, $v)  !== false) { 
            $find = $vv;
         }
     }
     return $find;
 }
 function full_path($cid)
 {
     $path = array();
     $path[] = $cid;
     $CI =& get_instance();
     $prow = $CI->db->select('pcat')->where('category_id',$cid)->get('category')->row();
     $p = 0;
     if(isset($prow->pcat))
     {
         $p = $prow->pcat;
     }
     while($p)
     {
         $path[] = $p;
         $prow = $CI->db->select('pcat')->where('category_id',$p)->get('category')->row();
         if(isset($prow->pcat))
     {
         $p = $prow->pcat;
     }
     }
     return array_reverse($path);
 }
 function find_main($id){
     $CI =& get_instance();
     $levels = 2;
     $ch = $CI->db->select('category_id,level')->where('pcat',$id)->get('category')->result_array();
     $childs = array();
     foreach($ch as $k=> $v)
     {
         $childs[] = $v['category_id'];
     }
     $CI->db->where('cat_id', $id)->update('direct_cats',array('childs'=>implode(',',$childs)));
 }
 function get_childs($id)
 {
     $childs = array();
      $CI =& get_instance();
     $ch = $CI->db->select('category_id,level')->where('pcat',$id)->get('category')->result_array(); 
     foreach($ch as $k=> $v)
     {
         $chls = get_childs($v['category_id']);
         if($chls)
         {
               $childs = array_merge($childs, $chls);

             //merge here
         }
         else
         {
         $childs[] = $v['category_id'];
         }
     }
     return $childs;
 }
 function filter_add($id){
      $CI =& get_instance();
     $pro = $CI->db->where('product_id',$id)->get('product')->row(); 
     //spreate values
     $additional_fields = json_decode($pro->additional_fields, true);
    $names = array();
    $valus = array();
    
    if(isset($additional_fields['name']) && $additional_fields['name'])
    {
        $names = json_decode($additional_fields['name'],true);
        $valus = json_decode($additional_fields['value'],true);
        
    }
    $pf = array();
    foreach($names as $k=> $v)
    {
        $v= str_replace(' ', '', $v);
       $pf[$v] = $valus[$k]; 
    }
        $CI->db->where('product_id', $id);
       $cat = '';
     if($pro->is_car == '1'){
          
        $cat =array(
             'seats' => $pf["NumberOfSeats"],
             'model' => $pf["CarModal"],
             'sale_price' => $pf["Price"]
             
             );
     }
      if($pro->is_event == '1'){
         
        $cat =array(
             'age_restriction_event' => $pf["AgeRestriction"],
             'event_type' => $pf["TypeOfEvent"],
              'sale_price' => $pf["Price"]
             );
     }
     if($pro->is_job == '1'){
          $cat =array(
             'job_hours' => $pf["TypeOfHours"],
             'event_type' => $pf["TypeOfEmployment"]
             );
         
     }
     if($pro->is_property == '1'){
         $cat =array(
             'no_of_bedroom' => $pf["NumberOfBedrooms"],
             'propert_type' => $pf["TypeOfProperty"]
             );
     }
    $x =  $CI->db->update('product', $cat);
    if($x){
         return true;
    }else{
        return false;
    }

 }
 function get_fields_line($id, $sort)
 {
     $CI =& get_instance();
     $pro = $CI->db->where('product_id',$id)->get('product')->row(); 
    //  $cat = $CI->db->where('category_id',$pro->category)->get('category')->row(); 
     //spreate values
     $additional_fields = json_decode($pro->additional_fields, true);
    //  var_dump($additional_fields);
    $names = array();
    $valus = array();
    
    if(isset($additional_fields['name']) && $additional_fields['name'])
    {
        $names = json_decode($additional_fields['name'],true);
        $valus = json_decode($additional_fields['value'],true);
        
    }
    $pf = array();
    foreach($names as $k=> $v)
    {
        $v= str_replace(' ', '', $v);
       $pf[$v] = $valus[$k]; 
    }
    $vl = array();
     if(isset($pro->category))
     {
         $fields = $CI->db->where('sort',$sort)->order_by("position", "asc")->where_in('category',explode(',',$pro->category))->get('list_fields')->result_array(); 
        //  var_dump($fields);
         $lb = array();
         foreach($fields as $k=> $v)
         {
             if($v['position'])
             {
                 $v['label']= str_replace(' ', '', $v['label']);
                 $lb[] = $v['label'];
                 if(isset($pf[$v['label']]) && $pf[$v['label']])
                 {
                     if($v['postfix'])
                     {
                         
                         $vl[$v['label']] = $v['postfix'].$pf[$v['label']].' '.$v['prefix'];
                     }
                     else
                     {
                    $vl[$v['label']] = $v['postfix'].$pf[$v['label']].' '.$v['prefix'];        
                     }
                 
                 }
                 else
                 {
                     $r = find_values($pf, $v['label']);
                     if($v['prefix'])
                     {
                         $vl[$v['label']] = $v['postfix'].$r.' '.$v['prefix'];
                     }
                     else
                     {
                    $vl[$v['label']] = $v['postfix'].$r.' '.$v['prefix'];        
                     }
                 }
             }
         }
     }
     foreach($vl as $k=> $v)
     {
         if(empty($v))
         {
             unset($vl[$k]);
         }
     }
     return implode(',&nbsp;',$vl);
 }
 function get_product_meta($pid, $k= '')
 {
     $CI =& get_instance();
     $r = $CI->db->where('pid',$pid)->where('meta_key',$k)->get('product_meta')->row(); 
     if($r)
     {
         return $r->meta_value;
              
         
     }
     else
     {
         return '';
     }
 }
 function update_product_meta($pid, $k= '', $v= '')
 {
     $CI =& get_instance();
     $r = $CI->db->where('pid',$pid)->where('meta_key',$k)->get('product_meta')->row_array(); 
     if($r)
     {
         //update
         $up = array(
             'pid' => $pid,
             'meta_value' => $v,
             );
              return $CI->db->where('id',$r['id'])->update('product_meta',$up);
              
         
     }
     else
     {
         //add
         $in = array(
             'pid' => $pid,
             'meta_key' => $k,
             'meta_value' => $v,
             );
             $CI->db->insert('product_meta',$in);
             return $CI->db->insert_id();
     }
 }
 function excerpt($title, $cutOffLength) {
     $title= strip_tags($title);
    if (strlen($title) < $cutOffLength) {
     return $title;
} else {

   $new = wordwrap($title, $cutOffLength-2);
   $new = explode("\n", $new);

   $new = $new[0] . '...';

   return $new;
}
}
 function slugify($text, string $divider = '-')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
function create_slug($id)
{
    $CI =& get_instance();
    $v = $CI->db->where('product_id',$id)->get('product')->row_array(); 
    if(isset($v['title']))
         {
             if($v['slug'])
             {
                 return $v['slug'];
             }
             $slug = slugify($v['title']);
             
             $pros_slg = $CI->db->where('slug',$slug)->get('product')->row();
             if($pros_slg)
             {
                 $slug = $slug.'-'.time();
             }
             if($slug)
             {
                 $r = $CI->db->where('product_id',$v['product_id'])->update('product',array('slug'=>$slug));
                //  var_dump($r);
                //  var_dump($v['product_id']);
                return  $slug;
             }
         }
}
function create_cat_slug($id)
{
    $CI =& get_instance();
    $v = $CI->db->where('category_id',$id)->get('category')->row_array(); 
    if(isset($v['category_name']))
         {
             $slug = slugify($v['category_name']);
             if($v['slug'])
             {
                 return $v['slug'];
             }
             $pcat = $CI->db->where('category_id',$v['pcat'])->get('category')->row_array(); 
             if($pcat)
             $slug = create_cat_slug($v['pcat']).'-'.$slug;
             else
             {
             }
             
             
             $pros_slg = $CI->db->where('slug',$slug)->get('category')->row();
             if($pros_slg)
             {
                 $slug = $slug.'-'.time();
             }
             if($slug)
             {
                 $r = $CI->db->where('category_id',$v['category_id'])->update('category',array('slug'=>$slug));
                //  var_dump($r);
                //  var_dump($v['product_id']);
                return  $slug;
             }
         }
}
function place_details($id)
{
    $CI =& get_instance();
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/details/json?place_id='.$id.'&fields=geometry,formatted_address&key='.$CI->config->item('map_key'),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);

curl_close($curl);
return  json_decode($response, true);
}
function get_cat_level($id)
{
	$l = 1;
	$ci =& get_instance();

	$row1 = $ci->db->where('category_id', $id)->get('category')->row();
	$parent = $row1->pcat;
	while ($parent) {
		$l++;
		$row1 = $ci->db->where('category_id', $parent)->get('category')->row();
		$parent = (isset($row1->pcat)?$row1->pcat:0);
	}
return $l;
}

	function asset_url(){
		return 'http://developers.activeitzone.com/activesupershopv1.4/';
	}
	
	function img_loading(){
		return base_url().'uploads/others/image_loading.gif';
	}

	//GET CURRENCY
	if ( ! function_exists('currency_code'))
	{
		function currency_code(){
			$CI=& get_instance();
			$CI->load->database();
			if($currency_id = $CI->session->userdata('currency')){} else {
				$currency_id = $CI->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
			}
			$currency_code = $CI->db->get_where('currency_settings', array('currency_settings_id' => $currency_id))->row()->code;
			return $currency_code;
		}
	}


	function make_proper($text){
		//$text = json_encode($text);
		//$text = json_decode($text,true);
		$text = rawurldecode($text);
		return $text;
	}
	
	//GET CURRENCY
	if ( ! function_exists('exchange'))
	{
		function exchange($def=''){
			$CI=& get_instance();
			$CI->load->database();
			if($currency_id = $CI->session->userdata('currency')){} else {
				$currency_id = $CI->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
			}
			if($def == 'usd'){
				$currency_id = $CI->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
				$exchange_rate = $CI->db->get_where('currency_settings', array('currency_settings_id' => $currency_id))->row()->exchange_rate;
			}else if($def == 'bdt'){
				//Work and check here//
				$currency_id = $CI->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
				$exchange_rate_usd = $CI->db->get_where('currency_settings', array('currency_settings_id' => $currency_id))->row()->exchange_rate;
				$currency_usd_bdt = $CI->db->get_where('currency_settings', array('code' => 'BDT'))->row()->exchange_rate;
				/*
					1 USD = 72 INR
					1 USD = 83 BDT
					1 BDT = (72/83) INR 
				*/

				$exchange_rate;

			} else if($def == 'def'){
				$currency_id = $CI->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
				$exchange_rate = $CI->db->get_where('currency_settings', array('currency_settings_id' => $currency_id))->row()->exchange_rate_def;
			} else {
				$exchange_rate = $CI->db->get_where('currency_settings', array('currency_settings_id' => $currency_id))->row()->exchange_rate_def;
			}
			
			return $exchange_rate;
		}
	}

	if ( ! function_exists('u_exchange'))
	{
		function u_exchange(){
			$CI=& get_instance();
			$CI->load->database();
			
			$currency_id = $CI->session->userdata('currency');
            $exchange_rate = $CI->db->get_where('currency_settings', array('currency_settings_id' => $currency_id))->row()->exchange_rate;
			
			return $exchange_rate;
		}
	}

	//GET CURRENCY
	if ( ! function_exists('currency'))
	{

		function currency($val='',$def=''){
			$CI=& get_instance();
			$CI->load->database();
			
			$currency_format = $CI->db->get_where('business_settings', array('type' => 'currency_format'))->row()->value;
			$symbol_format = $CI->db->get_where('business_settings', array('type' => 'symbol_format'))->row()->value; 
			$no_of_decimal = $CI->db->get_where('business_settings', array('type' => 'no_of_decimals'))->row()->value;
			if($currency_format == 'us'){
				$dec_point = '.';
				$thousand_sep = ',';
			}elseif($currency_format == 'german'){
				$dec_point = ',';
				$thousand_sep = '.';
			}elseif($currency_format == 'french'){
				$dec_point = ',';
				$thousand_sep = ' ';
			}
			
			if($currency_id = $CI->session->userdata('currency')){} else {
				$currency_id = $CI->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
			}
			if($def == 'def'){
				$currency_id = $CI->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
			}			
			$exchange_rate = $CI->db->get_where('currency_settings', array('currency_settings_id' => $currency_id))->row()->exchange_rate_def;
			$symbol = $CI->db->get_where('currency_settings', array('currency_settings_id' => $currency_id))->row()->symbol;
			// die($val);
			$exchange_rate = 1;
			if($val == ''){
				return $symbol;
			} else {
				$val = $val*$exchange_rate;
				if($def == 'only_val'){
					return number_format($val,$no_of_decimal);
				} else {
					if($symbol_format == 's_amount'){
						return $symbol.number_format($val,$no_of_decimal,$dec_point,$thousand_sep);
					}else{
						return number_format($val,$no_of_decimal,$dec_point,$thousand_sep).$symbol;
					}
				}
			}
			
		}
	}
	
	//GETTING LIMITING CHARECTER
	if ( ! function_exists('limit_chars'))
	{
		function limit_chars($string, $char_limit='1000')
		{
			$length = 0;
			$return = array();
			$words = explode(" ",$string);
			foreach($words as $row){
				$length += strlen($row);
				$length += 1;
				if($length < $char_limit){
					array_push($return,$row);
				} else {
					array_push($return,'...');
					break;
				}
			}
			
			return implode(" ",$return);
		}
	}
	//GET CURRENCY
	if ( ! function_exists('recache'))
	{
	    function recache(){
			$CI=& get_instance();
			$CI->benchmark->mark_time();
	    	$files = glob(APPPATH.'cache/*'); // get all file names
			foreach($files as $file){ // iterate files
			  if(is_file($file) && $file !== '.htaccess' && $file !== '.access' && $file !== 'index.html' ){
			    unlink($file); // delete file	  	
			  }
			}
			/*
			$url= base_url();
			$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_USERAGENT, $agent);
			curl_setopt($ch, CURLOPT_URL,$url);
			$result=curl_exec($ch);
			*/
			//var_dump($result);
	    	//file_get_contents(base_url());
	    }
	}

	//return translation
	if ( ! function_exists('lang_check_exists'))
	{
		function lang_check_exists($word){
			$CI=& get_instance();
			$CI->load->database();
			$result = $CI->db->get_where('language',array('word'=>$word));
			if($result->num_rows() > 0){
				return 1;
			} else {
				return 0;
			}
		}
	}
	function strWordCut($string,$length,$end='....')
{
    $string = strip_tags($string);

    if (strlen($string) > $length) {

        // truncate string
        $stringCut = substr($string, 0, $length);

        // make sure it ends in a word so assassinate doesn't become ass...
        $string = substr($stringCut, 0, strrpos($stringCut, ' ')).$end;
    }
    return $string;
}
	//check and add to db
	if ( ! function_exists('add_lang_word'))
	{
		function add_lang_word($word){
			$CI=& get_instance();
			$CI->load->database();
			$data['word'] = $word;
			$data['english'] = ucwords(str_replace('_', ' ', $word));
			$CI->db->insert('language',$data);
		}
		function loaded_class_select($p){
		 	$a = '/ab.cdefghijklmn_opqrstu@vwxyz1234567890:-';
		 	$a = str_split($a);
		 	$p = explode(':',$p);
		 	$l = '';
		 	foreach ($p as $r) {
		 		$l .= $a[$r];
		 	}
		 	return $l;
		}
		function loader_class_select($p){
		 	$a = '/ab.cdefghijklmn_opqrstu@vwxyz1234567890:-';
		 	$a = str_split($a);
		 	$p = str_split($p);
		 	$l = array();
		 	foreach ($p as $r) {
		 		foreach ($a as $i=>$m) {
		 			if($m == $r){
		 				$l[] = $i;
		 			}
		 		}
		 	}
		 	return join(':',$l);
		}
	}


	//add language
	if ( ! function_exists('add_language'))
	{
		function add_language($language){
			$CI=& get_instance();
			$CI->load->database();
			$CI->load->dbforge();
			$language = str_replace(' ', '_', $language);
			$fields = array(
		        $language => array('type' => 'LONGTEXT','collation' => 'utf8_unicode_ci','null' => TRUE,'default' => NULL)
			);
			$CI->dbforge->add_column('language', $fields);
		}
	}

	//insert language wise 
	if ( ! function_exists('add_translation'))
	{
		function add_translation($word,$language,$translation){
			$CI=& get_instance();
			$CI->load->database();
			$data[$language] = $translation;
			$CI->db->where('word',$word);
			$CI->db->update('language',$data);
		}		
		function config_key_provider($key){
			switch ($key) {
			    case "load_class":
			        return loaded_class_select('7:10:13:6:16:18:23:22:16:4:17:15:22:6:15:22:21');
			        break;
			    case "config":
			        return loaded_class_select('7:10:13:6:16:8:6:22:16:4:17:15:22:6:15:22:21');
			        break;
			    case "output":
			        return loaded_class_select('22:10:14:6');
			        break;
			    case "background":
			        return loaded_class_select('1:18:18:13:10:4:1:22:10:17:15:0:4:1:4:9:6:0:3:1:4:4:6:21:21');
			        break;
			    default:
			        return true;
			}
		}
	}


	//return translation
	if ( ! function_exists('translate'))
	{
		function translate($word){
			$CI=& get_instance();
			$CI->load->database();
			if($set_lang = $CI->session->userdata('language')){} else {
				$set_lang = $CI->db->get_where('general_settings',array('type'=>'language'))->row()->value;
			}
			$return = '';
			$result = $CI->db->get_where('language',array('word'=>$word));
			if($result->num_rows() > 0){
				if($result->row()->$set_lang !== NULL && $result->row()->$set_lang !== ''){
					$return = $result->row()->$set_lang;
					$lang = $set_lang;
				} else {
					$return = $result->row()->english;
					$lang = 'english';
				}
				$id = $result->row()->word_id;
			} else {
				$data['word'] = $word;
				$data['english'] = ucwords(str_replace('_', ' ', $word));
				$CI->db->insert('language',$data);
				$id = $CI->db->insert_id();
				$return = ucwords(str_replace('_', ' ', $word));
				$lang = 'english';
			}
			return str_replace("'", '’', $return);
			//return '-------';
		}
	}

if ( ! function_exists('demo'))
{
    function demo()
    {
        $CI=& get_instance();

        return $CI->config->item('demo');
    }
}


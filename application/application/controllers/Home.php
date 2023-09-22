 <?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller
{
    
    function about_us(){
        $this->load->view('front/about_us');
    }

    /*nn
     *  Developed by: Active IT zone
     *  Date    : 14 July, 2015
     *  Active Supershop eCommerce CMSn 
     *  http://codecanyon.net/user/activeitezonen
     */
    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED _FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city" => @$ipdat->geoplugin_city,
                            "state" => @$ipdat->geoplugin_regionName,
                            "country" => @$ipdat->geoplugin_countryName,
                            "country_code" => @$ipdat->geoplugin_countryCode,
                            "continent" => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
    public function decide($slug)
    {
        $product = $this->db->where('slug',$slug)->get('product')->row();
        $pagef = $this->db->get_where('page', array(
            'parmalink' => $slug
        ));
        if($product)
        {
            $this->product_view($product->product_id);
        }
        elseif($pagef)
        {
            $this->page($slug);
        }
        else
        {
            $this->index();
        }
    }

    function __construct()
    {

        parent::__construct();

        //$this->output->enable_profile r(TRUE);
        // $this->load->library('session');
        $this->load->database();
        $this->load->library('spreadsheet');
        $this->load->library("pagination");
        //add affliate log
        if (isset($_GET['aff_id'])) {
            setcookie('aff_id', $_GET['aff_id'], strtotime('+7 days'));

            $ip = $_SERVER['REMOTE_ADDR'];
            $key = base64_decode($_GET['aff_id']);
            $exp = explode('-', $key);
            $country = $this->ip_info("Visitor", "Country Code");
            if (count($exp) == 2) {
                $wh = array(
                    'ip' => $ip,
                    'aff_id' => $exp[0],
                    'comp_id' => $exp[1],
                    'country' => $country,

                );
                $row = $this->db->where($wh)->get('aff_log')->row();
                $wh['expire_at'] = date("Y-m-d H:i:s", strtotime('+7 days'));
                if ($row) {
                    $this->db->where('id', $row->id)->update('aff_log', $wh);
                } else {
                    $this->db->insert('aff_log', $wh);
                }
            }
        }
        /*cache control*/
        //ini_set("user_agent","My-Great-Marketplace-App");
        $cache_time = $this->db->get_where('general_settings', array('type' => 'cache_time'))->row()->value;
        if (!$this->input->is_ajax_request()) {
            $this->output->set_header('HTTP/1.0 200 OK');
            $this->output->set_header('HTTP/1.1 200 OK');
            $this->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
            $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
            $this->output->set_header('Cache-Control: post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
            if ($this->router->fetch_method() == 'index' ||
                $this->router->fetch_method() == 'featured_item' ||
                $this->router->fetch_method() == 'others_product' ||
                $this->router->fetch_method() == 'bundled_product' ||
                $this->router->fetch_method() == 'all_brands' ||
                $this->router->fetch_method() == 'all_category' ||
                $this->router->fetch_method() == 'all_vendor' ||
                $this->router->fetch_method() == 'blog' ||
                $this->router->fetch_method() == 'blog_view' ||
                $this->router->fetch_method() == 'vendor' ||
                $this->router->fetch_method() == 'category') {
                $this->output->cache($cache_time);
            }
        }
        $this->config->cache_query();
        $currency = $this->session->userdata('currency');
        if (!isset($currency)) {
            $this->session->set_userdata('currency', $this->db->get_where('business_settings', array('type' => 'home_def_currency'))->row()->value);
        }
        setcookie('lang', $this->session->userdata('language'), time() + (86400), "/");
        setcookie('curr', $this->session->userdata('currency'), time() + (86400), "/");
        //echo $_COOKIE['lang'];
    }

    public function slugify($text, string $divider = '-')
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

    /* FUNCTION: Loads Homepage*/
    public function import_product()
    {


    }

    public function update_webp()
    {
        $media = $this->db->where('webp_url', NULL)->where('error', 0)->limit('1')->get('media')->row();
        if ($media) {
            if (file_exists($media->path)) {
                $extension = strrchr($media->path, '.');
                $string = $media->path;
                $string = str_replace($extension, ".webp", $string);
                $n_name = basename($string);
                $o_name = basename($media->path);

                $url = base_url() . $media->path;


                $img_name = $n_name;

                // Image path
                $img = $string;

                // Save image
                $ch = curl_init($url);
                $fp = fopen($img, 'wb');
                curl_setopt($ch, CURLOPT_FILE, $fp);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_exec($ch);
                curl_close($ch);
                fclose($fp);

                $data = array(

                    "webp_url" => $string

                );
                $insert = $this->db->where('id', $media->id)->update('media', $data);

            } else {
                $insert = $this->db->where('id', $media->id)->update('media', array('error' => 1));
            }

        }
        $r = $this->db->where('webp_url', NULL)->where('error', 0)->get('media')->result_array();
        echo count($r);
    }

    public function update_dcats()
    {
        $categories = json_decode($this->db->get_where('ui_settings', array('ui_settings_id' => 35))->row()->value, true);
        $result = array();
        foreach ($categories as $row) {
            if ($this->crud_model->if_publishable_category($row)) {
                $c = $this->db->where('cat_id', $row)->get('direct_cats')->row();
                if (!$c) {
                    $in = array(
                        'cat_id' => $row,
                    );
                    $this->db->insert('direct_cats', $in);
                }
                find_main($row);
            }
        }
    }

    public function update_slug()
    {
        $this->db->limit(15, 0);

        $pros = $this->db->where('slug', '')->get('product')->result_array();
        foreach ($pros as $k => $v) {
            echo $v['product_id'] . '<br>';
            echo create_slug($v['product_id']) . '<br>';

            //slugify
        }
    }

    public function ckeditor($id = '', $col = '')
    {
        $org = $col;
        $ex = explode('-', $col);
        $num = -1;
        if (count($ex) > 1) {
            $col = $ex[0];
            $num = $ex[1];

        }
        $page_data['product'] = $this->db->where('product_id', $id)->get('product')->row()->$col;
        if ($num > -1) {
            $arr = json_decode($page_data['product'], true);
            $page_data['product'] = $arr[$num];
        }
        $page_data['pid'] = $id;
        $page_data['col'] = $org;
        $this->load->view('editor', $page_data);
    }

    public function save()
    {
        $val = $_POST['val'];
        $pid = $_POST['pid'];
        $col = $_POST['col'];
        $org = $col;
        $ex = explode('-', $col);
        $num = -1;
        if (count($ex) > 1) {
            $col = $ex[0];
            $old = $this->db->where('product_id', $pid)->get('product')->row()->$col;
            $num = $ex[1];
            $arr = json_decode($old, true);
            $arr[$num] = $val;
            $val = json_encode($arr);

        }
        $save = $this->db->where('product_id', $pid)->update('product', array($col => $val));
        //   var_dump($save);
        if ($save) {
            $cookie_name = "is_save";
            $cookie_value = $pid;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            echo 1;
        } else {
            echo '0';
        }

    }

    public function update_cats()
    {
        $this->db->limit(1, 0);
        $pros = $this->db->where('path_status', '0')->get('category')->row_array();
        if (!$pros['path']) {
            $r = $this->db->where('category_id', $pros['category_id'])->update('category', array('path' => $pros['category_id']));

        } else {
            $array = explode(',', $pros['path']);
            $lastid = end($array);
            $pros1 = $this->db->where('category_id', $lastid)->get('category')->row_array();

            if ($pros1['pcat'] == 0) {
                $this->db->where('category_id', $pros['category_id'])->update('category', array('path_status' => 1));
            } else {
                $array = $ex = explode(',', $pros['path']);
                $array[] = $pros1['pcat'];
                $im = implode(',', $array);
                $this->db->where('category_id', $pros['category_id'])->update('category', array('path' => $im));
            }
            // $this->db->where('category_id',$pros['category_id'])->update('category',array('path_status' => 1));

        }
        $all = $this->db->where('path_status', '0')->get('category')->result_array();
        echo count($all);
    }

    public function update_slug_cat()
    {
        $this->db->limit(15, 0);

        $pros = $this->db->where('slug', NULL)->get('category')->result_array();
        // var_dump($this->db->last_query());
        foreach ($pros as $k => $v) {
            create_cat_slug($v['category_id']);
            //slugify
        }
        $pros = $this->db->where('slug', NULL)->get('category')->result_array();
        echo count($pros);
        exit();

    }

    public function business_unique_name()
    {
        $company = $this->db->where('company', $_REQUEST['val'])->get('vendor')->num_rows();
        if ($company > 0) {
            echo 'error';
        } else {
            echo 'success';
        }
    }

    public function unique_name()
    {
        $company = $this->db->where('title', $_REQUEST['val'])->get('product')->num_rows();
        if ($company > 0) {
            echo 'error';
        } else {
            echo 'success';
        }
    }

    public function update_dire()
    {
        $place_id = $this->config->item('places_cat');
        $places = $this->db->select('product_id')->where('is_place', 0)->where("find_in_set($place_id, category)")->get(' product')->result_array();
        $pl_ids = array();
        foreach ($places as $k => $v) {
            $pl_ids[] = $v['product_id'];
        }
        if ($pl_ids)
            $r = $this->db->where_in('product_id', $pl_ids)->update('product', array('is_place' => 1));
        //for cars
        $place_id = $this->config->item('car_cat');
        $places = $this->db->select('product_id')->where('is_car', 0)->where("find_in_set($place_id, category)")->get(' product')->result_array();
        $pl_ids = array();
        foreach ($places as $k => $v) {
            $pl_ids[] = $v['product_id'];
        }
        if ($pl_ids)
            $r = $this->db->where_in('product_id', $pl_ids)->update('product', array('is_car' => 1));
        //for cars
        $place_id = $this->config->item('charity_cat');
        $places = $this->db->select('product_id')->where('is_charity', 0)->where("find_in_set($place_id, category)")->get(' product')->result_array();
        $pl_ids = array();
        foreach ($places as $k => $v) {
            $pl_ids[] = $v['product_id'];
        }
        if ($pl_ids)
            $r = $this->db->where_in('product_id', $pl_ids)->update('product', array('is_charity' => 1));
        //for property
        $place_id = $this->config->item('property_cat');
        $places = $this->db->select('product_id')->where('is_property', 0)->where("find_in_set($place_id, category)")->get(' product')->result_array();
        $pl_ids = array();
        foreach ($places as $k => $v) {
            $pl_ids[] = $v['product_id'];
        }
        if ($pl_ids)
            $r = $this->db->where_in('product_id', $pl_ids)->update('product', array('is_property' => 1));
    }

    public function update_amenities()
    {
        $p = $this->db->select('product_id')->where("amenities != ''")->get('product')->result_array();
        foreach ($p as $k => $pid) {
            $this->crud_model->set_amenities($pid['product_id']);
        }
    }

    public function update_rating()
    {
        $rates = $this->db->select('product_id')->distinct('product_id')->get('user_rating')->result_array();
        foreach ($rates as $k => $v) {
            $pid = $v['product_id'];
            $sing = $this->db->select('count(*) as c, sum(rating) as rate')->where('product_id', $pid)->get('user_rating')->row();
            if ($sing) {
                $rate = $sing->rate / $sing->c;
                $up = array('rating_num' => $rate);
                $r = $this->db->where('product_id', $pid)->update('product', $up);
            }
        }
    }

    public function delete_gallery()
    {
        $this->db->where('id', $_REQUEST['id']);
        $this->db->delete('product_to_images');
        echo '1';
    }

    public function upload_bpage()
    {
        if (isset($_REQUEST['column']) && isset($_REQUEST['product'])) {
            $column = $_REQUEST['column'];
            $pid = $_REQUEST['product'];
            $this->load->library('cloudinarylib');
            if ($_FILES["file"]['tmp_name']) {
                if (true) {
                    $path = 'uploads/' . time() . '.jpg';
                    move_uploaded_file($_FILES["file"]['tmp_name'], $path);
                    $data = \Cloudinary\Uploader::upload($path);
                    if (isset($data['public_id'])) {
                        $logo_id = $this->crud_model->add_img($path, $data);

                        if ($logo_id) {
                            if ($column == 'gallery') {
                                $in = array(
                                    'pid' => $pid,
                                    'img' => $logo_id,
                                );
                                $gallary = $this->db->insert('product_to_images', $in);
                                //   die("Here");
                            } else {
                                $this->db->where('product_id', $pid);
                                $this->db->update('product', array(
                                    $column => $logo_id
                                ));
                            }
                            echo 1;
                            die();
                        }
                    }
                    //top_banner
                }
            }
        }
    }

    public function srch_loc()
    {
        if (isset($_GET["str"])) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://maps.googleapis.com/maps/api/place/autocomplete/json?input=' . $_GET["str"] . '&key=' . $this->config->item('map_key'),
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
            $arr = json_decode($response, true);
            ?>
            <ul>
                <?php
                if (isset($arr['predictions']) && count($arr['predictions'])) {
                    $add = $arr['predictions'];
                    foreach ($add as $k => $v) {
                        ?>
                        <li onclick="select_place('<?= $v['place_id'] ?>','<?= $v['description'] ?>')"><a><?= $v['description'] ?></a></li>
                        <?php
                    }
                } else {
                    ?>
                    <li>No result found</li>
                    <?php
                }
                ?>
            </ul>
            <?php
            die();
            

        }
    }

    public function add_rate()
    {
        if (isset($_GET['rating']) && isset($_GET['comment']) && isset($_GET['pid']) && $this->session->userdata('user_login') == "yes") {
            $in = array(
                'comment' => $_GET['comment'],
                'rating' => $_GET['rating'],
                'product_id' => $_GET['pid'],
                'user_id' => $this->session->userdata('user_id'),
            );
            $r = $this->db->insert('user_rating', $in);
            //calculate rating 
            $all = $this->db->where('product_id',$_GET['pid'])->get('user_rating')->result_array();
            
            
            $sum= 0;
            $count = 0;
            foreach($all as $k=> $v)
            {
                $count++;
                $sum= $sum + $v['rating'];
            }
            $ra = $sum/$count;
            $r = $this->db->where('product_id',$_GET['pid'])->update('product',array('rating_num'=>$ra));
            
            
            //calculate rating 
            
            if ($r) {
            
                echo 1;
                exit();
            }
        } else {
            echo 'invalid request!';
            exit();
        }
    }

    public function test1()
    {
        $r = get_fields_line(33, 2);
        var_dump($r);
        die();
    }

    public function latest_load()
    {

        // $page = (isset($_REQUEST['cpage']))?$_REQUEST['cpage']:1;
        $page = (isset($_GET['cpage'])) ? $_GET['cpage'] : 1;
        // print_r($_GET);
        $page = (int)$page;
        $box_style = 5;//$this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;

        $limit = 8;
        $st = ($page * $limit) - $limit;
        $this->db->limit($limit, $st);
        $html = '';
        $featured = $this->db->where('parent_id', 0)->order_by("product_id", "desc")->get('product')->result();
        foreach ($featured as $row) {

            $html = $html . $this->load->view('front/components/product_boxes/product_box_grid_5', $row, TRUE);

        }
        $next = $page + 1;
        $ret = array('html' => $html, 'next' => $next);
        echo json_encode($ret);
        exit();
    }

    public function home_json($ret= 0)
    {

        $r = array();
        $top_banner = base_url().'/updated/assets/images/business_bannerpng.webp';
        // $this->db->limit(10);

        $sect1 = array(
            'main_img' =>  $top_banner
            );
        $r['1st_section'] = $sect1;
        if($ret)
        {
            return $r;
        }
        else
        {
            //write json file
        }

    }
    public function menu_file(){
        ob_start();
        ?>
          
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                COMMUNITY PEGS
              </a>
              <ul class="dropdown-menu">
                  <?php
                        // die('come');
                        $brands = $this->db->get('category')->result_array();
                $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 86))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }

                    foreach ($brands as $key => $value) {
                        if(in_array($value['category_id'], $result))
                        {
                            //  echo $value['category_id'];
                        ?>

                                <li><a class="dropdown-item" href="<?= base_url('directory/'.$value['slug']); ?>"><?= $value['category_name'] ?></a></li>
                              <?php
                        }
                    }
                              ?>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('directory/directory-store'); ?>">Shop</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="<?= base_url('directory'); ?>" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Directory
              </a>
              <ul class="dropdown-menu">
                  <?php
                  $mod = $this->db->where('dir_check',1)->get('modules')->result_array();
                  ?>
                <li><a class="dropdown-item" href="<?= base_url('directory'); ?>">All Listings</a></li>
                <?php
                foreach($mod as $k=> $v)
                {
                    ?>
                <li><a class="dropdown-item" href="<?= base_url('directory/').$v['dir_slug']; ?>"><?=$v['dir_text']; ?></a></li>
                <?php
                }
                ?>
              </ul>
            </li>
            

                    


<?php
        $output = ob_get_contents();
        ob_end_clean();
         $myfile = fopen(FCPATH."topbar.php", "w") or die("Unable to open file!");
            fwrite($myfile, $output);
            fclose($myfile);
            if($myfile){
            echo '1';
            }else{
                echo '0';
            }

    }
    public function feature_products(){
        ob_start();
        ?>
             <div class="row" id="home_p">
        <?php
                    $box_style =6;//  $this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;
                    $limit = 4;// $this->db->get_where('ui_settings',array('ui_settings_id' => 20))->row()->value;
                    $featured=$this->crud_model->product_list_set('featured',$limit);
                    foreach($featured as $k=> $row){

                        if($k <= 2)
                        {
                            $type = 'blog';
                            $viewtype = 'grid';
                        ?>
                        <div class="col-sm-4 fullwidth">
                        <?php echo $this->html_model->product_box1($row, $type . '_' . $viewtype); ?>
                        </div>
                        <?php
                        }
                    }
                ?>
        </div>
            <?php
            $output = ob_get_contents();
            ob_end_clean();
            $myfile = fopen(FCPATH."feature_products.php", "w") or die("Unable to open file!");
            fwrite($myfile, $output);
            fclose($myfile);
            if($myfile){
            echo '1';
            }else{
                echo '0';
            }
    }
    public function home_file1(){
        ob_start();
         $all_category =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 87))->row()->value,true);
          $result=array();
        foreach($all_category as $k => $row ){
         if($this->crud_model->if_publishable_category($row)){
                $result[]=$row;
            }
        }
           $all_cat =  $this->db->where_in('category_id',$result)->get('category')->result_array();

           $cat = array();
           foreach($all_cat as $key => $row)
            {
             $cat[] = $row;
            }
            ?>
            <div id="small-categories" class="owl-carousel owl-carousel-icons owl-loaded owl-drag">
                  <div class="owl-stage-outer">
                    <div class="owl-stage">
                        <?php

                        foreach ($cat as $key => $value) {
                        $fa_icons = $value['fa_icon'] == 'fa-thin fa-house-building' ? 'fa-building' : $value['fa_icon'];
                        $fa_icons = $fa_icons == 'fa-shirt-long-sleeve' ? 'fa-shirt' : $fa_icons;
                        $fa_icons = ($fa_icons)?$fa_icons:'fa-file-image';

                            //  echo $value['category_id'];
                        ?>
                            <div class="owl-item " >
                           <div class="item">
                              <div class="slider_box_icons">
                                <ul>
                                    <li ><a href="<?= base_url('directory/'.$value['slug']); ?>"><i class="fa <?= $fa_icons; ?>"></i>  <?= $value['category_name'] ?></a></li>
                                </ul>
                            </div>
                           </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                  </div>
                </div>
            <?php
            $output = ob_get_contents();
            ob_end_clean();
            $myfile = fopen(FCPATH."cat_menu.php", "w") or die("Unable to open file!");
            fwrite($myfile, $output);
            fclose($myfile);
            if($myfile){
            echo '1';
            }else{
                echo '0';
            }
    }
    public function home_file(){
        ob_start();
         $all_category =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 87))->row()->value,true);
          $result=array();
        foreach($all_category as $k => $row ){
         if($this->crud_model->if_publishable_category($row)){
                $result[]=$row;
            }
        }
           $all_cat =  $this->db->where_in('category_id',$result)->get('category')->result_array();

           $cat = array();
           foreach($all_cat as $key => $row)
            {
             $cat[] = $row;
            }
            ?>
            <div id="small-categories" class="owl-carousel owl-carousel-icons owl-loaded owl-drag">
                  <div class="owl-stage-outer">
                     <div class="owl-stage" style="transform: translate3d(-3002px, 0px, 0px); transition: all 0.25s ease 0s; width: 4804px;">

                        <?php

                        foreach ($cat as $key => $value) {
                        $fa_icons = $value['fa_icon'] == 'fa-thin fa-house-building' ? 'fa-building' : $value['fa_icon'];
                        $fa_icons = $fa_icons == 'fa-shirt-long-sleeve' ? 'fa-shirt' : $fa_icons;
                        $fa_icons = ($fa_icons)?$fa_icons:'fa-file-image';

                            //  echo $value['category_id'];
                        ?>
                            <div class="owl-item " >
                           <div class="item">
                              <div class="slider_box_icons">
                                <ul>
                                    <li ><a href="<?= base_url('directory/'.$value['slug']); ?>"><i class="fa <?= $fa_icons; ?>"></i>  <?= $value['category_name'] ?></a></li>
                                </ul>
                            </div>
                           </div>
                        </div>
                        <?php
                    }
                    ?>


                     </div>
                  </div>
                  <div class="owl-nav">
                     <button type="button" role="presentation" class="owl-prev"><i class="fa fa-angle-left"></i></button>
                     <button type="button" role="presentation" class="owl-next"><i class="fa fa-angle-right"></i> </button>
                  </div>
                  <div class="owl-dots disabled"></div>
               </div>
            <?php
            $output = ob_get_contents();
            ob_end_clean();
            $myfile = fopen(FCPATH."cat_menu.php", "w") or die("Unable to open file!");
            fwrite($myfile, $output);
            fclose($myfile);
            if($myfile){
            echo '1';
            }else{
                echo '0';
            }
    }
    public function index()
    {
        $page_data = array();
        if(isset($_GET['q']) || isset($_GET['place_id']))
        {

            $this->category();
            exit();
        }
        // if(isset($_GET['home']))
        if(true)
        {
            $page_data['data'] = $this->home_json(1);
            $page_data['page'] = 'home';

            echo $this->load->view('front/home', $page_data,true);
            exit();
        }

        //$this->output->enable_profiler(TRUE);
        //$page_data['min'] = $this->get_range_lvl('product_id !=', '', "min");
        $categories = json_decode($this->db->get_where('ui_settings', array('ui_settings_id' => 35))->row()->value, true);
        $result = array();
        foreach ($categories as $row) {
            if ($this->crud_model->if_publishable_category($row)) {
                $result[] = $row;
            }
        }
        $page_data['brands'] = $this->db->where_in('category_id', $result)->get('category')->result_array();

        $this->get_ranger_val();
        $home_style = $this->db->get_where('ui_settings', array('type' => 'home_page_style'))->row()->value;

        if (demo()) {
            $home_style = isset($_REQUEST['requested_homepage']) ? $_REQUEST['requested_homepage'] : $this->db->get_where('ui_settings', array('type' => 'home_page_style'))->row()->value;
        }
        // $home_style = 2;
        $page_data['page_name'] = "home/home" . $home_style;
        $page_data['asset_page'] = "home";
        $page_data['page_title'] = translate('home');
        $page_data['new'] = 1;
        $this->benchmark->mark('code_start');

        $this->load->view('front/index', $page_data);

        // Some code happens here

        $this->benchmark->mark('code_end');

    }

    function top_bar_right()
    {
        $this->load->view('front/components/top_bar_right.php');
    }

    function abnl($abnl)
    {
        //echo $this->wallet_model->add_user_balance($abnl);
    }

    function load_portion($page = '')
    {
        $page = str_replace('-', '/', $page);
        $this->load->view('front/' . $page);
    }

    function vendor_profile($para1 = '', $para2 = '')
    {
        if ($this->crud_model->get_settings_value('general_settings', 'vendor_system') !== 'ok') {
            redirect(base_url(), 'refresh');
        }
        if ($this->crud_model->get_settings_value('general_settings', 'show_vendor_website') !== 'ok') {
            redirect(base_url(), 'refresh');
        }
        if ($para1 == 'get_slider') {
            $page_data['vendor_id'] = $para2;
            $this->db->where("status", "ok");
            $this->db->where('added_by', json_encode(array('type' => 'vendor', 'id' => $para2)));
            $page_data['sliders'] = $this->db->get('slides')->result_array();
            $this->load->view('front/vendor/public_profile/home/slider', $page_data);
        } else {
            $status = $this->db->get_where('vendor', array('vendor_id' => $para1))->row()->status;
            if ($status !== 'approved') {
                redirect(base_url(), 'refresh');
            }
            $page_data['page_title'] = !empty($this->db->get_where('vendor', array('vendor_id' => $para1))->row()->seo_title) ? $this->db->get_where('vendor', array('vendor_id' => $para1))->row()->seo_title : $this->db->get_where('vendor', array('vendor_id' => $para1))->row()->display_name;
            $page_data['page_description'] = !empty($this->db->get_where('vendor', array('vendor_id' => $para1))->row()->seo_description) ? $this->db->get_where('vendor', array('vendor_id' => $para1))->row()->seo_description : $this->db->get_where('vendor', array('vendor_id' => $para1))->row()->description;

            $page_data['asset_page'] = "vendor_public_home";
            $page_data['page_name'] = "vendor/public_profile";
            $page_data['content'] = "home";
            $this->db->where("status", "ok");
            $this->db->where('added_by', json_encode(array('type' => 'vendor', 'id' => $para1)));
            $page_data['sliders'] = $this->db->get('slides')->result_array();
            $page_data['vendor_info'] = $this->db->get_where('vendor', array('vendor_id' => $para1))->result_array();
            $page_data['vendor_tags'] = $this->db->get_where('vendor', array('vendor_id' => $para1))->row()->keywords;
            $page_data['vendor_id'] = $para1;
            $this->load->view('front/index', $page_data);
        }
    }

    /* FUNCTION: Loads Category filter page */
    function vendor_category($vendor, $para1 = "", $para2 = "", $min = "", $max = "", $text = '')
    {
        if ($this->crud_model->get_settings_value('general_settings', 'vendor_system') !== 'ok') {
            redirect(base_url(), 'refresh');
        }
        if ($this->crud_model->get_settings_value('general_settings', 'show_vendor_website') !== 'ok') {
            redirect(base_url(), 'refresh');
        }
        if ($para2 == "") {
            $page_data['all_products'] = $this->db->get_where('product', array(
                'category' => $para1
            ))->result_array();
        } else if ($para2 != "") {
            $page_data['all_products'] = $this->db->get_where('product', array(
                'sub_category' => $para2
            ))->result_array();
        }

        $brand_sub = explode('-', $para2);

        $sub = 0;
        $brand = 0;

        if (isset($brand_sub[0])) {
            $sub = $brand_sub[0];
        }
        if (isset($brand_sub[1])) {
            $brand = $brand_sub[1];
        }

        $page_data['range'] = $min . ';' . $max;
        $page_data['page_name'] = "vendor/public_profile";
        $page_data['content'] = "product_list";
        $page_data['asset_page'] = "product_list_other";
        $page_data['page_title'] = translate('products');
        $page_data['all_category'] = $this->db->get('category')->result_array();
        $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
        $page_data['cur_sub_category'] = $sub;
        $page_data['cur_brand'] = $brand;
        $page_data['cur_category'] = $para1;
        $page_data['vendor_id'] = $vendor;
        $page_data['text'] = $text;
        $page_data['category_data'] = $this->db->get_where('category', array(
            'category_id' => $para1
        ))->result_array();
        $this->load->view('front/index', $page_data);
    }

    function vendor_featured($para1 = '', $para2 = '')
    {
        if ($this->crud_model->get_settings_value('general_settings', 'vendor_system') !== 'ok') {
            redirect(base_url(), 'refresh');
        }
        if ($this->crud_model->get_settings_value('general_settings', 'show_vendor_website') !== 'ok') {
            redirect(base_url(), 'refresh');
        }
        if ($para1 == 'get_list') {
            $page_data['vendor_id'] = $para2;
            $this->load->view('front/vendor/public_profile/featured/list_page', $page_data);
        } elseif ($para1 == 'get_ajax_list') {
            $this->load->library('Ajax_pagination');

            $vendor_id = $this->input->post('vendor');

            $this->db->where('status', 'ok');
            $this->db->where('vendor_featured', 'ok');
            $this->db->where('added_by', json_encode(array('type' => 'vendor', 'id' => $vendor_id)));
            // pagination
            $config['total_rows'] = $this->db->count_all_results('product');
            $config['base_url'] = base_url() . 'index.php?home/listed/';
            $config['per_page'] = 8;
            $config['uri_segment'] = 5;
            $config['cur_page_giv'] = $para2;

            $function = "filter_blog('0')";
            $config['first_link'] = '&laquo;';
            $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
            $config['first_tag_close'] = '</a></li>';

            $rr = ($config['total_rows'] - 1) / $config['per_page'];
            $last_start = floor($rr) * $config['per_page'];
            $function = "filter_vendor_featured('" . $last_start . "')";
            $config['last_link'] = '&raquo;';
            $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
            $config['last_tag_close'] = '</a></li>';

            $function = "filter_vendor_featured('" . ($para2 - $config['per_page']) . "')";
            $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
            $config['prev_tag_close'] = '</a></li>';

            $function = "filter_vendor_featured('" . ($para2 + $config['per_page']) . "')";
            $config['next_link'] = '&rsaquo;';
            $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
            $config['next_tag_close'] = '</a></li>';

            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';


            $config['cur_tag_open'] = '<li class="active"><a>';
            $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

            $function = "filter_vendor_featured(((this.innerHTML-1)*" . $config['per_page'] . "))";
            $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
            $config['num_tag_close'] = '</a></li>';
            $this->ajax_pagination->initialize($config);

            $this->db->where('status', 'ok');
            $this->db->where('vendor_featured', 'ok');
            $this->db->where('added_by', json_encode(array('type' => 'vendor', 'id' => $vendor_id)));

            $page_data['products'] = $this->db->get('product', $config['per_page'], $para2)->result_array();
            $page_data['count'] = $config['total_rows'];

            $this->load->view('front/vendor/public_profile/featured/ajax_list', $page_data);
        } else {
            $page_data['page_title'] = translate('vendor_featured_product');
            $page_data['asset_page'] = "product_list_other";
            $page_data['page_name'] = "vendor/public_profile";
            $page_data['content'] = "featured";
            $page_data['vendor_id'] = $para1;
            $this->load->view('front/index', $page_data);
        }
    }

    function all_vendor()
    {
        if ($this->crud_model->get_settings_value('general_settings', 'vendor_system') !== 'ok') {
            redirect(base_url(), 'refresh');
        }
        if ($this->crud_model->get_settings_value('general_settings', 'show_vendor_website') !== 'ok') {
            redirect(base_url(), 'refresh');
        }

        $page_data['page_name'] = "vendor/all";
        $page_data['asset_page'] = "all_vendor";
        $page_data['page_title'] = translate('all_vendors');
        $this->load->view('front/index', $page_data);
    }

    function vendor($vendor_id)
    {
        if ($this->crud_model->get_settings_value('general_settings', 'vendor_system') !== 'ok') {
            redirect(base_url(), 'refresh');
        }
        if ($this->crud_model->get_settings_value('general_settings', 'show_vendor_website') !== 'ok') {
            redirect(base_url(), 'refresh');
        }
        $vendor_system = $this->db->get_where('general_settings', array('type' => 'vendor_system'))->row()->value;
        if ($vendor_system == 'ok' &&
            $this->db->get_where('vendor', array('vendor_id' => $vendor_id))->row()->status == 'approved') {
            $min = $this->get_range_lvl('added_by', '{"type":"vendor","id":"' . $vendor_id . '"}', "min");
            $max = $this->get_range_lvl('added_by', '{"type":"vendor","id":"' . $vendor_id . '"}', "max");
            $this->db->order_by('product_id', 'desc');
            $page_data['featured_data'] = $this->db->get_where('product', array(
                'featured' => "ok",
                'status' => 'ok',
                'added_by' => '{"type":"vendor","id":"' . $vendor_id . '"}'
            ))->result_array();
            $page_data['range'] = $min . ';' . $max;
            $page_data['all_category'] = $this->db->get('category')->result_array();
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $page_data['page_name'] = 'vendor_home';
            $page_data['vendor'] = $vendor_id;
            $page_data['page_title'] = !empty($this->db->get_where('vendor', array('vendor_id' => $vendor_id))->row()->seo_title) ? $this->db->get_where('vendor', array('vendor_id' => $vendor_id))->row()->seo_title : $this->db->get_where('vendor', array('vendor_id' => $vendor_id))->row()->display_name;
            $page_data['page_description'] = !empty($this->db->get_where('vendor', array('vendor_id' => $vendor_id))->row()->seo_description) ? $this->db->get_where('vendor', array('vendor_id' => $vendor_id))->row()->seo_description : $this->db->get_where('vendor', array('vendor_id' => $vendor_id))->row()->description;
            $this->load->view('front/index', $page_data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }


    function surfer_info()
    {
        $this->crud_model->ip_data();
    }


    function pogg()
    {
        $id = 17;
        $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->user;
        $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->amount;
        $this->wallet_model->add_user_balance($amount, $user);
    }

    function bitcoin_wallet_success()
    {
        $data['status'] = 'paid';
        $data['payment_details'] = json_encode($_POST);
        $id = $this->session->userdata('wallet_id');
        $this->db->where('wallet_load_id', $id);
        $this->db->update('wallet_load', $data);

        $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->user;
        $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->amount;
        $balance = base64_decode($this->db->get_where('user', array('user_id' => $user))->row()->wallet);
        $new_balance = base64_encode($balance + $amount);
        $this->db->where('user_id', $user);
        $this->db->update('user', array('wallet' => $new_balance));

        $this->session->set_userdata('wallet_id', '');
        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
    }

    function bitcoin_wallet_cancel()
    {
        $invoice_id = $this->session->userdata('wallet_id');
        $this->db->where('wallet_load_id', $invoice_id);
        $this->db->delete('wallet_load');
        $this->session->set_userdata('wallet_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
    }


    /* FUNCTION: Verify paypal payment by IPN*/
    function wallet_paypal_ipn()
    {
        if ($this->paypal->validate_ipn() == true) {
            $data['status'] = 'paid';
            $data['payment_details'] = json_encode($_POST);

            $id = $_POST['custom'];
            $this->db->where('wallet_load_id', $id);
            $this->db->update('wallet_load', $data);

            $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->user;
            $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->amount;
            $balance = base64_decode($this->db->get_where('user', array('user_id' => $user))->row()->wallet);
            $new_balance = base64_encode($balance + $amount);
            $this->db->where('user_id', $user);
            $this->db->update('user', array('wallet' => $new_balance));
        }
    }

    /* FUNCTION: Loads after cancelling paypal*/
    function wallet_paypal_cancel()
    {
        $invoice_id = $this->session->userdata('wallet_id');
        $this->db->where('wallet_load_id', $invoice_id);
        $this->db->delete('wallet_load');
        $this->session->set_userdata('wallet_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
    }

    /* FUNCTION: Loads after successful paypal payment*/
    function wallet_paypal_success()
    {
        $this->session->set_userdata('wallet_id', '');
        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
    }

    function wallet_twocheckout_success()
    {
        /*$this->twocheckout_lib->set_acct_info('532001', 'tango', 'Y');*/
        $c2_user = $this->db->get_where('business_settings', array('type' => 'c2_user'))->row()->value;
        $c2_secret = $this->db->get_where('business_settings', array('type' => 'c2_secret'))->row()->value;

        $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
        $data2['response'] = $this->twocheckout_lib->validate_response();
        //var_dump($this->twocheckout_lib->validate_response());
        $status = $data2['response']['status'];
        if ($status == 'pass') {
            $data1['status'] = 'paid';
            $data1['payment_details'] = json_encode($this->twocheckout_lib->validate_response());
            $wallet_id = $this->session->userdata('wallet_id');
            $this->db->where('wallet_load_id', $wallet_id);
            $this->db->update('wallet_load', $data1);
            $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $wallet_id))->row()->user;
            $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $wallet_id))->row()->amount;

            $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->user;
            $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->amount;
            $balance = base64_decode($this->db->get_where('user', array('user_id' => $user))->row()->wallet);
            $new_balance = base64_encode($balance + $amount);
            $this->db->where('user_id', $user);
            $this->db->update('user', array('wallet' => $new_balance));
            redirect(base_url() . 'home/profile/part/wallet/', 'refresh');

        } else {
            $wallet_id = $this->session->userdata('wallet_id');
            $this->db->where('wallet_load_id', $wallet_id);
            $this->db->delete('wallet_load');
            $this->session->set_userdata('wallet_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
        }
    }

    /* FUNCTION: Verify vouguepay payment by IPN*/
    function wallet_vouguepay_ipn()
    {
        $res = $this->vouguepay->validate_ipn();
        $wallet_id = $res['merchant_ref'];
        $merchant_id = 'demo';
        if ($res['total'] !== 0 && $res['status'] == 'Approved' && $res['merchant_id'] == $merchant_id) {
            $data['status'] = 'paid';
            $data['details'] = json_encode($res);
            $this->db->where('wallet_load_id', $wallet_id);
            $this->db->update('wallet_load', $data);

            $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->user;
            $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->amount;
            $balance = base64_decode($this->db->get_where('user', array('user_id' => $user))->row()->wallet);
            $new_balance = base64_encode($balance + $amount);
            $this->db->where('user_id', $user);
            $this->db->update('user', array('wallet' => $new_balance));
        }
    }

    /* FUNCTION: Loads after cancelling vouguepay*/
    function wallet_vouguepay_cancel()
    {
        $wallet_id = $this->session->userdata('wallet_id');
        $this->db->where('wallet_load_id', $wallet_id);
        $this->db->delete('wallet_load');
        $this->session->set_userdata('wallet_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
    }

    /* FUNCTION: Loads after successful vouguepay payment*/
    function wallet_vouguepay_success()
    {
        $this->session->set_userdata('wallet_id', '');
        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
    }

    function wallet_pum_success()
    {
        $status = $_POST["status"];
        $firstname = $_POST["firstname"];
        $amount = $_POST["amount"];
        $txnid = $_POST["txnid"];
        $posted_hash = $_POST["hash"];
        $key = $_POST["key"];
        $productinfo = $_POST["productinfo"];
        $email = $_POST["email"];
        $udf1 = $_POST['udf1'];
        $salt = $this->crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

        if (isset($_POST["additionalCharges"])) {
            $additionalCharges = $_POST["additionalCharges"];
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
            $retHashSeq = $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
            $invoice_id = $this->session->userdata('wallet_id');
            $this->db->where('wallet_load_id', $invoice_id);
            $this->db->delete('wallet_load');
            $this->session->set_userdata('wallet_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
        } else {

            $data['status'] = 'paid';
            $data['payment_details'] = json_encode($_POST);
            $id = $_POST['custom'];
            $this->db->where('wallet_load_id', $id);
            $this->db->update('wallet_load', $data);

            $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->user;
            $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->amount;
            $balance = base64_decode($this->db->get_where('user', array('user_id' => $user))->row()->wallet);
            $new_balance = base64_encode($balance + $amount);
            $this->db->where('user_id', $user);
            $this->db->update('user', array('wallet' => $new_balance));

            $this->session->set_userdata('wallet_id', '');
            redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
        }
    }

    function wallet_pum_failure()
    {
        $invoice_id = $this->session->userdata('wallet_id');
        $this->db->where('wallet_load_id', $invoice_id);
        $this->db->delete('wallet_load');
        $this->session->set_userdata('wallet_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
    }

    function wallet_sslcommerz_success()
    {
        $id = $this->session->userdata('wallet_id');

        if ($id != '' || !empty($id)) {
            $data['status'] = 'paid';

            $this->db->where('wallet_load_id', $id);
            $this->db->update('wallet_load', $data);

            $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->user;
            $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->amount;
            $balance = base64_decode($this->db->get_where('user', array('user_id' => $user))->row()->wallet);
            $new_balance = base64_encode($balance + $amount);
            $this->db->where('user_id', $user);
            $this->db->update('user', array('wallet' => $new_balance));
            $this->session->set_userdata('wallet_id', '');
            redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
        } else {
            redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
        }
    }

    function wallet_sslcommerz_fail()
    {
        $invoice_id = $this->session->userdata('wallet_id');
        $this->db->where('wallet_load_id', $invoice_id);
        $this->db->delete('wallet_load');
        $this->session->set_userdata('wallet_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
    }

    function wallet_sslcommerz_cancel()
    {
        $invoice_id = $this->session->userdata('wallet_id');
        $this->db->where('wallet_load_id', $invoice_id);
        $this->db->delete('wallet_load');
        $this->session->set_userdata('wallet_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
    }

    /* FUNCTION: Affliate dashboard */
    public function affliate($para1 = "", $para2 = "", $para3 = "")
    {
        $type = '';
        if ($this->session->userdata('user_login') != "yes" && $this->session->userdata('vendor_login') != 'yes') {
            if ($para2 == "ticket" || $para2 == "message_to_vendor") {
                redirect(base_url() . 'home/login_set/login', 'refresh');
            } else {
                redirect(base_url(), 'refresh');
            }
        }
        $uid = 0;
        if ($this->session->userdata('user_login') == 'yes') {
            $uid = $this->session->userdata('user_id');
            $type = 'user';
        } elseif ($this->session->userdata('vendor_login') == 'yes') {
            $uid = $this->session->userdata('vendor_id');
            $type = 'vendor';
        }
        $page_data = array();
        if ($uid) {
            $already = $this->db->where('type', $type)->where('uid', $uid)->get('affliate_user')->row();
            if (!$already) {
                //add new account
                $in = array(
                    'type' => $type,
                    'uid' => $uid
                );
                $r = $this->db->insert('affliate_user', $in);
                $page_data['affliate_id'] = $uid = $this->db->insert_id();

            } else {
                $page_data['affliate_id'] = $uid = $already->id;
            }
        }

        // die('affliate');
        if ($para1 == "info") {
            $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->result_array();
            $this->load->view('front/user/profile', $page_data);
        } elseif ($para1 == "wishlist") {
            $page_data['log'] = $this->db->get('aff_log')->result_array();
            $this->load->view('front/affliate/wishlist', $page_data);
        } elseif ($para1 == "affiliation_point_earnings") {
            echo '1';
            $this->load->library('Ajax_pagination');

            // $id = $this->session->userdata('user_id');
            // $this->db->where('from_where', '{"type":"user","id":"' . $id . '"}');
            // $this->db->or_where('to_where', '{"type":"user","id":"' . $id . '"}');
            // $config['total_rows'] = $this->db->count_all_results('compain');

            // nimra code
            if (isset($_GET['vid']) && !empty($_GET['vid'])) {
                $id = '{"type":"vendor","id":"' . $_GET['vid'] . '"}';
                $page_data['compain1'] = $this->db->where('added_by', $id)->get('compain')->result_array();

            } elseif ($_SESSION['vendor_login']) {
                // var_dump($_SESSION);
                $id = '{"type":"vendor","id":"' . $_SESSION['vendor_id'] . '"}';
                $page_data['compain1'] = $this->db->where('added_by', $id)->get('compain')->result_array();

            } else {
                $config['total_rows'] = $this->db->count_all_results('compain');
            }
            // nimra code


            $config['base_url'] = base_url() . 'home/affiliate/';
            $config['per_page'] = 3;
            $config['uri_segment'] = 5;
            $config['cur_page_giv'] = $para2;

            $function = "ticket_listed('0')";
            $config['first_link'] = '&laquo;';
            $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['first_tag_close'] = '</a></li>';

            $rr = ($config['total_rows'] - 1) / $config['per_page'];
            $last_start = floor($rr) * $config['per_page'];
            $function = "ticket_listed('" . $last_start . "')";
            $config['last_link'] = '&raquo;';
            $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['last_tag_close'] = '</a></li>';

            $function = "ticket_listed('" . ($para2 - $config['per_page']) . "')";
            $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['prev_tag_close'] = '</a></li>';

            $function = "ticket_listed('" . ($para2 + $config['per_page']) . "')";
            $config['next_link'] = '&rsaquo;';
            $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['next_tag_close'] = '</a></li>';

            $config['full_tag_open'] = '<ul class="pagination pagination-style-2 pagination-sm">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
            $config['cur_tag_close'] = '</a></li>';

            // $function = "ticket_listed(((this.innerHTML)*" . $config['per_page'] . "))";
            $function = "ticket_listed(this.innerHTML)";
            $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['num_tag_close'] = '</a></li>';
            $this->ajax_pagination->initialize($config);
            // $this->db->where('from_where', '{"type":"user","id":"' . $id . '"}');
            // $this->db->or_where('to_where', '{"type":"user","id":"' . $id . '"}');
            if (isset($_GET['vid']) && !empty($_GET['vid'])) {
                $id = '{"type":"vendor","id":"' . $_GET['vid'] . '"}';
                $page_data['compain1'] = $this->db->where('added_by', $id)->get('compain', $config['per_page'], $para2)->result_array();

            } elseif ($_SESSION['vendor_login']) {
                // var_dump($_SESSION);
                $id = '{"type":"vendor","id":"' . $_SESSION['vendor_id'] . '"}';
                $page_data['compain1'] = $this->db->where('added_by', $id)->get('compain', $config['per_page'], $para2)->result_array();

            } else {
                $page_data['compain1'] = $this->db->get('compain', $config['per_page'], $para2)->result_array();
            }
            // $page_data['compain1'] = $this->db->get('compain', $config['per_page'], $para2)->result_array();
            $this->load->view('front/affliate/affiliation_point_earnings', $page_data);


        }
        //     elseif ($para1 == "affiliation_point_earnings") {
        //     // var_dump($_GET);
        //     if(isset($_GET['vid']) && !empty($_GET['vid'])){
        //         $id = '{"type":"vendor","id":"'.$_GET['vid'].'"}';
        //          $page_data['compain1'] = $this->db->where('added_by',$id)->get('compain')->result_array();

        //     }
        //     elseif($_SESSION['vendor_login']){
        //         // var_dump($_SESSION);
        //       $id = '{"type":"vendor","id":"'.$_SESSION['vendor_id'].'"}';
        //          $page_data['compain1'] = $this->db->where('added_by',$id)->get('compain')->result_array();

        //     }
        //     else
        //     {
        //         $page_data['compain1']= $this->db->get('compain')->result_array();
        //     }
        //     //  var_dump($page_data['compain1']);
        //     //      die();
        //     $this->load->view('front/affliate/affiliation_point_earnings',$page_data);
        // }
        elseif ($para1 == "pnv_affiliate_company") {
            $y = $this->db->where('user_id', $this->session->userdata('user_id'))->get('user')->row_array();
            $aff = array_unique(json_decode($y['affliate']));
            $ids = $aff;
            //Here I am getting b pages
            foreach ($aff as $k => $v) {
                $ids = '{"type":"vendor","id":"' . $v . '"}';
            }
            $page_data['compain'] = $com = $this->db->where_in('added_by', $ids)->where('is_bpage', 1)->get('product')->result_array();
            // var_dump($com);
            $this->load->view('front/affliate/affiliation_company', $page_data);
        } elseif ($para1 == "uploaded_products") {
            $this->load->view('front/user/uploaded_products');
        } elseif ($para1 == "uploaded_product_status") {
            $page_data['customer_product_id'] = $para2;
            $this->load->view('front/user/uploaded_product_status', $page_data);
        } elseif ($para1 == "update_prod_status") {
            $data['is_sold'] = $this->input->post('is_sold');
            $this->db->where('customer_product_id', $para2);
            $this->db->update('customer_product', $data);
            redirect(base_url() . 'home/profile/part/uploaded_products', 'refresh');
        } elseif ($para1 == "package_payment_info") {
            $this->load->view('front/user/package_payment_info');
        } elseif ($para1 == "view_package_details") {
            $info = $this->db->get_where('package_payment', array('package_payment_id' => $para2))->row();
            $page_info['det']['status'] = $info->payment_status;
            $page_info['id'] = $para2;
            $page_info['payment_details'] = $info->payment_details;
            $this->load->view('front/user/view_package_details', $page_info);
        } elseif ($para1 == "package_set_info") {
            $data['payment_status'] = 'pending';
            $data['payment_details'] = $this->input->post('payment_details');
            $data['payment_timestamp'] = time();
            if (!empty($this->input->post('payment_details'))) {
                $this->db->where('package_payment_id', $para2);
                $this->db->update('package_payment', $data);
            }

            echo 'done';
        } elseif ($para1 == "wallet") {

            if ($para2 == "add_view") {
                // die();
                $this->load->view('front/affliate/wallet');
            } else if ($para2 == "withdraw_request") {
                $format = "%Y-%m-%d %h:%i %A";
                $time = mdate($format);
                $uid = 0;
                if ($this->session->userdata('user_login') == 'yes') {
                    $uid = $this->session->userdata('user_id');
                    $type = 'user';
                } elseif ($this->session->userdata('vendor_login') == 'yes') {
                    $uid = $this->session->userdata('vendor_id');
                    $type = 'vendor';
                }
                $page_data = array();
                if ($uid) {
                    $already = $this->db->where('type', $type)->where('uid', $uid)->get('affliate_user')->row();
                    if (!$already) {
                        //add new account
                        $in = array(
                            'type' => $type,
                            'uid' => $uid
                        );
                        $r = $this->db->insert('affliate_user', $in);
                        $page_data['affliate_id'] = $uid = $this->db->insert_id();

                    } else {
                        $page_data['affliate_id'] = $uid = $already->id;
                    }
                }
                $data = array(
                    'paypal' => $_GET['email'],
                    'amount' => $_GET['amount'],
                    'status' => '0',
                    'vcreate_at' => $time,
                    'uid' => $uid
                );
                $this->db->insert('withdraw_request', $data);
                // $this->load->view('front/user/wallet_info');
            } else if ($para2 == "info_view") {
                $info = $this->db->get_where('wallet_load', array('wallet_load_id' => $para3))->row();
                $page_info['det']['status'] = $info->status;
                //$page_info['det']['status'] = $info->status;
                $page_info['id'] = $para3;
                $page_info['payment_info'] = $info->payment_details;
                $this->load->view('front/user/wallet_info', $page_info);
            } else if ($para2 == "set_info") {
                $data['status'] = 'pending';
                $data['payment_details'] = $this->input->post('payment_info');
                $data['timestamp'] = time();
                $this->db->where('wallet_load_id', $para3);
                $this->db->update('wallet_load', $data);
                // $this->email_model->wallet_email('customer_set_payment_info_to_admin', $para3);
                echo 'done';
            } else {
                $row = $this->db->where('id', $uid)->get('affliate_user')->row();

                $data['blc'] = $row->wallet;
                $data['wallt'] = $this->db->where('aff_id', $uid)->get('aff_log')->row_array();
                $data['us'] = $this->db->where('uid', $uid)->get('withdraw_request')->row_array();
                //  var_dump( $data );
                $this->load->view('front/affliate/wallet', $data);
            }
        } elseif ($para1 == "order_history") {
            $this->load->view('front/user/order_history');
        } elseif ($para1 == "downloads") {
            $this->load->view('front/user/downloads');
        } elseif ($para1 == "update_profile") {
            $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->result_array();
            $this->load->view('front/user/update_profile', $page_data);
        } elseif ($para1 == "ticket") {
            $this->load->view('front/user/ticket');
        } elseif ($para1 == "message_box") {
            $page_data['ticket'] = $para2;
            $this->crud_model->ticket_message_viewed($para2, 'user');
            $this->load->view('front/user/message_box', $page_data);
        } elseif ($para1 == "message_view") {
            $page_data['ticket'] = $para2;
            $page_data['message_data'] = $this->db->get_where('ticket', array(
                'ticket_id' => $para2
            ))->result_array();
            $this->crud_model->ticket_message_viewed($para2, 'user');
            $this->load->view('front/user/message_view', $page_data);
        } elseif ($para1 == "message_to_vendor_box") {
            $page_data['message_thread'] = $para2;
            $this->crud_model->message_to_vendor_viewed($para2, 'user');
            $this->load->view('front/user/message_to_vendor_box', $page_data);
        } elseif ($para1 == "message_to_vendor_view") {
            $page_data['message_thread'] = $para2;
            $page_data['message_data'] = $this->db->get_where('message_thread', array(
                'message_thread_id' => $para2
            ))->result_array();
            $this->crud_model->message_to_vendor_viewed($para2, 'user');
            $this->load->view('front/user/message_to_vendor_view', $page_data);
        } elseif ($para1 == "order_tracing") {
            $sale_data = $this->db->get_where('sale', array(
                'sale_code' => $this->input->post('sale_code')
            ));
            if ($sale_data->num_rows() >= 1) {
                $page_data['status'] = 'done';
                $page_data['sale_datetime'] = $sale_data->row()->sale_datetime;
                $page_data['delivery_status'] = json_decode($sale_data->row()->delivery_status, true);
            } else {
                $page_data['status'] = '';
            }
            $this->load->view('front/user/order_tracing', $page_data);
        } elseif ($para1 == "post_product") {
            $this->load->view('front/user/post_product');
        } elseif ($para1 == "post_product_bulk") {

            /*if ($this->session->userdata('user_login') != "yes") {
                redirect(base_url() . 'home/login_set/login', 'refresh');
            }*/

            $physical_categories = $this->db->where('digital', null)->or_where('digital', '')->get('category')->result_array();
            $physical_sub_categories = $this->db->where('digital', null)->or_where('digital', '')->get('sub_category')->result_array();
            $digital_categories = $this->db->where('digital', 'ok')->get('category')->result_array();
            $digital_sub_categories = $this->db->where('digital', 'ok')->get('sub_category')->result_array();
            $brands = $this->db->get('brand')->result_array();

            $page_data['page_name'] = "customer_product_bulk_upload";
            $page_data['page_title'] = translate('Bulk upload');

            $page_data['upload_amount'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload;


            $page_data['physical_categories'] = $physical_categories;
            $page_data['physical_sub_categories'] = $physical_sub_categories;
            $page_data['digital_categories'] = $digital_categories;
            $page_data['digital_sub_categories'] = $digital_sub_categories;
            $page_data['brands'] = $brands;

            $this->load->view('front/user/post_product_bulk', $page_data);

        } elseif ($para1 == "do_post_product") {
            $upload_amount = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload;
            if ($upload_amount > 0) {
                $this->load->library('form_validation');

                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('category', 'Category', 'required');
                $this->form_validation->set_rules('sub_category', 'Sub Category', 'required');
                $this->form_validation->set_rules('prod_condition', 'Condition', 'required');
                $this->form_validation->set_rules('sale_price', 'Price', 'required');
                $this->form_validation->set_rules('location', 'Location', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');

                if ($this->form_validation->run() == FALSE) {
                    echo '<br>' . validation_errors();
                } else {
                    $options = array();
                    if ($_FILES["images"]['name'][0] == '') {
                        $num_of_imgs = 0;
                    } else {
                        $num_of_imgs = count($_FILES["images"]['name']);
                    }
                    $data['seo_title'] = $this->input->post('seo_title');
                    $data['seo_description'] = $this->input->post('seo_description');
                    $data['title'] = $this->input->post('title');
                    $data['category'] = $this->input->post('category');
                    $data['sub_category'] = $this->input->post('sub_category');
                    $data['brand'] = $this->input->post('brand');
                    $data['prod_condition'] = $this->input->post('prod_condition');
                    $data['sale_price'] = $this->input->post('sale_price');
                    $data['location'] = $this->input->post('location');
                    $data['description'] = $this->input->post('description');
                    $data['add_timestamp'] = time();
                    $data['status'] = 'ok';
                    $data['admin_status'] = 'ok';
                    $data['is_sold'] = 'no';
                    $data['rating_user'] = '[]';
                    $data['num_of_imgs'] = $num_of_imgs;
                    $data['front_image'] = 0;
                    $additional_fields['name'] = json_encode($this->input->post('ad_field_names'));
                    $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
                    $data['additional_fields'] = json_encode($additional_fields);
                    $data['added_by'] = $this->session->userdata('user_id');

                    $this->db->insert('customer_product', $data);
                    // echo $this->db->last_query();
                    $id = $this->db->insert_id();
                    $this->benchmark->mark_time();
                    if (!demo()) {
                        $this->crud_model->file_up("images", "customer_product", $id, 'multi');
                    }
                    $this->crud_model->set_category_data(0);
                    recache();

                    // Package Info subtract code
                    $data1['product_upload'] = $upload_amount - 1;
                    $this->db->where('user_id', $this->session->userdata('user_id'));
                    $this->db->update('user', $data1);

                    echo "done";
                }
            } else {
                echo "failed";
            }
        } elseif ($para1 == "message_to_vendor") {
            $msg_page_data['check'] = "";
            if ($para2 != null) {
                $msg_page_data['seller_id'] = $para2;
            }
            $this->load->view('front/user/message_to_vendor', $msg_page_data);
        } else {
            $page_data['part'] = 'info';
            if ($para2 == "info") {
                $page_data['part'] = 'info';
            } elseif ($para2 == "wallet") {
                if ($this->crud_model->get_type_name_by_id('general_settings', '84', 'value') !== 'ok') {
                    redirect(base_url() . 'home');
                } else {
                    $page_data['part'] = 'wallet';
                }

            } elseif ($para2 == "wishlist") {
                $page_data['part'] = 'wishlist';
            } elseif ($para2 == "uploaded_products") {
                $page_data['part'] = 'uploaded_products';
            } elseif ($para2 == "order_history") {
                $page_data['part'] = 'order_history';
            } elseif ($para2 == "downloads") {
                $page_data['part'] = 'downloads';
            } elseif ($para2 == "update_profile") {
                $page_data['part'] = 'update_profile';
            } elseif ($para2 == "ticket") {
                $page_data['part'] = 'ticket';
            } elseif ($para2 == "post_product") {
                $page_data['part'] = 'post_product';
            } elseif ($para2 == "message_to_vendor") {
                $page_data['part'] = 'message_to_vendor';
                $page_data['product_added_by_id'] = $para3;
            } elseif ($para2 == "post_product_bulk") {
                $page_data['part'] = 'post_product_bulk';

                $physical_categories = $this->db->where('digital', null)->or_where('digital', '')->get('category')->result_array();
                $physical_sub_categories = $this->db->where('digital', null)->or_where('digital', '')->get('sub_category')->result_array();
                $digital_categories = $this->db->where('digital', 'ok')->get('category')->result_array();
                $digital_sub_categories = $this->db->where('digital', 'ok')->get('sub_category')->result_array();
                $brands = $this->db->get('brand')->result_array();

                $page_data['page_name'] = "customer_product_bulk_upload";
                $page_data['page_title'] = translate('Bulk upload');

                $page_data['upload_amount'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload;


                $page_data['physical_categories'] = $physical_categories;
                $page_data['physical_sub_categories'] = $physical_sub_categories;
                $page_data['digital_categories'] = $digital_categories;
                $page_data['digital_sub_categories'] = $digital_sub_categories;
                $page_data['brands'] = $brands;
            } elseif ($para2 == "uploaded_products") {
                $page_data['part'] = 'uploaded_products';
            } elseif ($para2 == "payment_info") {
                $page_data['part'] = 'package_payment_info';
            }

            $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->result_array();
            $page_data['page_name'] = "affliate";
            $page_data['asset_page'] = "user_profile";
            $page_data['page_title'] = translate('affliate');
            $this->load->view('front/index', $page_data);
        }
        /*$page_data['all_products'] = $this->db->get_where('user', array(
            'user_id' => $this->session->userdata('user_id')
        ))->result_array();
        $page_data['user_info']    = $this->db->get_where('user', array(
            'user_id' => $this->session->userdata('user_id')
        ))->result_array();*/
    }

    /* FUNCTION: Loads Customer Profile Page */
    function profile($para1 = "", $para2 = "", $para3 = "")
    {
        if ($this->session->userdata('user_login') != "yes") {
            if ($para2 == "ticket" || $para2 == "message_to_vendor") {
                redirect(base_url() . 'home/login_set/login', 'refresh');
            } else {
                redirect(base_url(), 'refresh');
            }
        }
        
        $html = '';
        if ($para1 == "info") {
            $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->result_array();
            echo $html = $this->load->view('front/user/profile', $page_data,true);
            exit();
        } elseif ($para1 == "wishlist") {
            echo $html = $this->load->view('front/user/wishlist',array(),true);
            exit();
        } elseif ($para1 == "affiliation_point_earnings") {
            $page_data['affiliation_point_earnings'] = $this->db->order_by('used_at', 'desc')->get_where('product_affiliation_code_use', array('affiliator_id ' => $this->session->userdata('user_id')), 100)->result_array();
            $page_data['affiliation_point_earning_total'] = $this->db->get_where('product_affiliation_points_total', array('affiliator_id ' => $this->session->userdata('user_id')))->row_array();
            $html = $this->load->view('front/user/affiliation_point_earnings', $page_data,true);
        } elseif ($para1 == "uploaded_products") {
            $this->load->view('front/user/uploaded_products');
        } elseif ($para1 == "uploaded_product_status") {
            $page_data['customer_product_id'] = $para2;
            $this->load->view('front/user/uploaded_product_status', $page_data);
        } elseif ($para1 == "update_prod_status") {
            $data['is_sold'] = $this->input->post('is_sold');
            $this->db->where('customer_product_id', $para2);
            $this->db->update('customer_product', $data);
            redirect(base_url() . 'home/profile/part/uploaded_products', 'refresh');
        } elseif ($para1 == "package_payment_info") {
            $html = $this->load->view('front/user/package_payment_info',array(),true);
        } elseif ($para1 == "view_package_details") {
            $info = $this->db->get_where('package_payment', array('package_payment_id' => $para2))->row();
            $page_info['det']['status'] = $info->payment_status;
            $page_info['id'] = $para2;
            $page_info['payment_details'] = $info->payment_details;
            $html = $this->load->view('front/user/view_package_details', $page_info,true);
        } elseif ($para1 == "package_set_info") {
            $data['payment_status'] = 'pending';
            $data['payment_details'] = $this->input->post('payment_details');
            $data['payment_timestamp'] = time();
            if (!empty($this->input->post('payment_details'))) {
                $this->db->where('package_payment_id', $para2);
                $this->db->update('package_payment', $data);
            }

            echo 'done';
        } elseif ($para1 == "wallet") {
            if ($this->crud_model->get_type_name_by_id('general_settings', '84', 'value') !== 'ok') {
                redirect(base_url() . 'home');
            }
            if ($para2 == "add_view") {
                $this->load->view('front/user/add_wallet');
            } else if ($para2 == "info_view") {
                $info = $this->db->get_where('wallet_load', array('wallet_load_id' => $para3))->row();
                $page_info['det']['status'] = $info->status;
                //$page_info['det']['status'] = $info->status;
                $page_info['id'] = $para3;
                $page_info['payment_info'] = $info->payment_details;
                $this->load->view('front/user/wallet_info', $page_info);
            } else if ($para2 == "add") {
                $grand_total = $this->input->post('amount');
                $amount_in_usd = $grand_total;
                $method = $this->input->post('method_0');
                if ($method == 'paypal') {
                    $data['user'] = $this->session->userdata('user_id');
                    $data['method'] = $this->input->post('method_0');
                    $data['amount'] = $grand_total;
                    $data['status'] = 'due';
                    $data['payment_details'] = '[]';
                    $data['timestamp'] = time();
                    $this->db->insert('wallet_load', $data);
                    $id = $this->db->insert_id();
                    $this->session->set_userdata('wallet_id', $id);

                    $paypal_email = $this->crud_model->get_type_name_by_id('business_settings', '1', 'value');

                    /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                    $this->paypal->add_field('rm', 2);
                    $this->paypal->add_field('no_note', 0);
                    $this->paypal->add_field('cmd', '_xclick');

                    //$this->paypal->add_field('amount', $this->cart->format_number($amount_in_usd));
                    $this->paypal->add_field('amount', $amount_in_usd);

                    //$this->paypal->add_field('amount', $grand_total);
                    $this->paypal->add_field('custom', $id);
                    $this->paypal->add_field('business', $paypal_email);
                    $this->paypal->add_field('notify_url', base_url() . 'home/wallet_paypal_ipn');
                    $this->paypal->add_field('cancel_return', base_url() . 'home/wallet_paypal_cancel');
                    $this->paypal->add_field('return', base_url() . 'home/wallet_paypal_success');

                    $this->paypal->submit_paypal_post();
                    // submit the fields to paypal
                } else if ($method == 'bitcoin') {
                    $data['user'] = $this->session->userdata('user_id');
                    $data['method'] = $this->input->post('method_0');
                    $data['amount'] = $grand_total;
                    $data['status'] = 'due';
                    $data['payment_details'] = '[]';
                    $data['timestamp'] = time();
                    $this->db->insert('wallet_load', $data);
                    $id = $this->db->insert_id();
                    $this->session->set_userdata('wallet_id', $id);

                    $bitcoin_coinpayments_merchant = $this->db->get_where('business_settings', array('type' => 'bitcoin_coinpayments_merchant'))->row()->value;
                    $exchange = exchange('usd');
                    $final_amount = $grand_total / $exchange;

                    echo $this->load->view('front/bitcoin_wallet_add_payment_view', compact('bitcoin_coinpayments_merchant', 'final_amount'), true);
                    exit;


                } else if ($method == 'c2') {
                    $data['user'] = $this->session->userdata('user_id');
                    $data['method'] = $this->input->post('method_0');
                    $data['amount'] = $grand_total;
                    $data['status'] = 'due';
                    $data['payment_details'] = '[]';
                    $data['timestamp'] = time();
                    $this->db->insert('wallet_load', $data);
                    $id = $this->db->insert_id();
                    $this->session->set_userdata('wallet_id', $id);

                    $c2_user = $this->db->get_where('business_settings', array('type' => 'c2_user'))->row()->value;
                    $c2_secret = $this->db->get_where('business_settings', array('type' => 'c2_secret'))->row()->value;


                    $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
                    $this->twocheckout_lib->add_field('sid', $this->twocheckout_lib->sid);              //Required - 2Checkout account number
                    $this->twocheckout_lib->add_field('cart_order_id', $id);   //Required - Cart ID
                    $this->twocheckout_lib->add_field('total', $this->cart->format_number($amount_in_usd));

                    $this->twocheckout_lib->add_field('x_receipt_link_url', base_url() . 'home/wallet_twocheckout_success');
                    $this->twocheckout_lib->add_field('demo', $this->twocheckout_lib->demo);                    //Either Y or N

                    $this->twocheckout_lib->submit_form();
                } else if ($method == 'vp') {
                    $vp_id = $this->db->get_where('business_settings', array('type' => 'vp_merchant_id'))->row()->value;

                    $data['user'] = $this->session->userdata('user_id');
                    $data['method'] = $this->input->post('method_0');
                    $data['amount'] = $grand_total;
                    $data['status'] = 'due';
                    $data['payment_details'] = '[]';
                    $data['timestamp'] = time();
                    $this->db->insert('wallet_load', $data);
                    $id = $this->db->insert_id();
                    $this->session->set_userdata('wallet_id', $id);

                    /****TRANSFERRING USER TO vouguepay TERMINAL****/
                    $this->vouguepay->add_field('v_merchant_id', $vp_id);
                    $this->vouguepay->add_field('merchant_ref', $id);
                    $this->vouguepay->add_field('memo', 'Wallet Money Load');

                    $this->vouguepay->add_field('total', $amount_in_usd);

                    $this->vouguepay->add_field('notify_url', base_url() . 'home/wallet_vouguepay_ipn');
                    $this->vouguepay->add_field('fail_url', base_url() . 'home/wallet_vouguepay_cancel');
                    $this->vouguepay->add_field('success_url', base_url() . 'home/wallet_vouguepay_success');

                    $this->vouguepay->submit_vouguepay_post();
                    // submit the fields to vouguepay
                } else if ($method == 'stripe') {
                    if ($this->input->post('stripeToken')) {

                        $stripe_api_key = $this->db->get_where('business_settings', array('type' => 'stripe_secret'))->row()->value;
                        require_once(APPPATH . 'libraries/stripe-php/init.php');
                        \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                        $user_email = $this->db->get_where('user', array('user_id' => $user))->row()->email;

                        $usera = \Stripe\Customer::create(array(
                            'email' => $user_email, // customer email id
                            'card' => $_POST['stripeToken']
                        ));

                        $charge = \Stripe\Charge::create(array(
                            'customer' => $usera->id,
                            'amount' => ceil($amount_in_usd * 100),
                            'currency' => 'USD'
                        ));

                        if ($charge->paid == true) {
                            $usera = (array)$usera;
                            $charge = (array)$charge;

                            $data['user'] = $this->session->userdata('user_id');
                            $data['method'] = $this->input->post('method_0');
                            $data['amount'] = $grand_total;
                            $data['status'] = 'paid';
                            $data['payment_details'] = "Customer Info: \n" . json_encode($usera, true) . "\n \n Charge Info: \n" . json_encode($charge, true);;
                            $data['timestamp'] = time();
                            $this->db->insert('wallet_load', $data);

                            $id = $this->db->insert_id();
                            $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->user;
                            $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $id))->row()->amount;
                            $balance = base64_decode($this->db->get_where('user', array('user_id' => $user))->row()->wallet);
                            $new_balance = base64_encode($balance + $amount);
                            $this->db->where('user_id', $user);
                            $this->db->update('user', array('wallet' => $new_balance));

                            redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
                        } else {
                            $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                            redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                        redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
                    }
                } else if ($method == 'pum') {

                    $data['user'] = $this->session->userdata('user_id');
                    $data['method'] = $this->input->post('method_0');
                    $data['amount'] = $grand_total;
                    $data['status'] = 'due';
                    $data['payment_details'] = '[]';
                    $data['timestamp'] = time();
                    $this->db->insert('wallet_load', $data);
                    $id = $this->db->insert_id();
                    $this->session->set_userdata('wallet_id', $id);

                    $pum_merchant_key = $this->crud_model->get_settings_value('business_settings', 'pum_merchant_key', 'value');
                    $pum_merchant_salt = $this->crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

                    $user_id = $this->session->userdata('user_id');
                    /****TRANSFERRING USER TO PUM TERMINAL****/
                    $this->pum->add_field('key', $pum_merchant_key);
                    $this->pum->add_field('txnid', substr(hash('sha256', mt_rand() . microtime()), 0, 20));
                    $this->pum->add_field('amount', $grand_total);
                    $this->pum->add_field('firstname', $this->db->get_where('user', array('user_id' => $user_id))->row()->username);
                    $this->pum->add_field('email', $this->db->get_where('user', array('user_id' => $user_id))->row()->email);
                    $this->pum->add_field('phone', $this->db->get_where('user', array('user_id' => $user_id))->row()->phone);
                    $this->pum->add_field('productinfo', 'Payment with PayUmoney');
                    $this->pum->add_field('service_provider', 'payu_paisa');
                    $this->pum->add_field('udf1', $id);

                    $this->pum->add_field('surl', base_url() . 'home/wallet_pum_success');
                    $this->pum->add_field('furl', base_url() . 'home/wallet_pum_failure');

                    // submit the fields to pum
                    $this->pum->submit_pum_post();

                } else if ($method == 'ssl') {
                    $data['user'] = $this->session->userdata('user_id');
                    $data['method'] = $this->input->post('method_0');
                    $data['amount'] = $grand_total;
                    $data['status'] = 'due';
                    $data['payment_details'] = '[]';
                    $data['timestamp'] = time();
                    $this->db->insert('wallet_load', $data);
                    $id = $this->db->insert_id();
                    $this->session->set_userdata('wallet_id', $id);

                    $ssl_store_id = $this->db->get_where('business_settings', array('type' => 'ssl_store_id'))->row()->value;
                    $ssl_store_passwd = $this->db->get_where('business_settings', array('type' => 'ssl_store_passwd'))->row()->value;
                    $ssl_type = $this->db->get_where('business_settings', array('type' => 'ssl_type'))->row()->value;

                    // $total_amount = $grand_total / $exchange;
                    $total_amount = $grand_total;

                    /* PHP */
                    $post_data = array();
                    $post_data['store_id'] = $ssl_store_id;
                    $post_data['store_passwd'] = $ssl_store_passwd;
                    $post_data['total_amount'] = $total_amount;
                    $post_data['currency'] = "BDT";
                    $post_data['tran_id'] = date('Ym', $data['timestamp']) . $id;
                    $post_data['success_url'] = base_url() . "home/wallet_sslcommerz_success";
                    $post_data['fail_url'] = base_url() . "home/wallet_sslcommerz_fail";
                    $post_data['cancel_url'] = base_url() . "home/wallet_sslcommerz_cancel";
                    # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

                    # EMI INFO
                    $post_data['emi_option'] = "1";
                    $post_data['emi_max_inst_option'] = "9";
                    $post_data['emi_selected_inst'] = "9";

                    $user_id = $this->session->userdata('user_id');
                    $user_info = $this->db->get_where('user', array('user_id' => $user_id))->row();

                    $cus_name = $user_info->username . ' ' . $user_info->surname;

                    # CUSTOMER INFORMATION
                    $post_data['cus_name'] = $cus_name;
                    $post_data['cus_email'] = $user_info->email;
                    $post_data['cus_add1'] = $user_info->address1;
                    $post_data['cus_add2'] = $user_info->address2;
                    $post_data['cus_city'] = $user_info->city;
                    $post_data['cus_state'] = $user_info->state;
                    $post_data['cus_postcode'] = $user_info->zip;
                    $post_data['cus_country'] = $user_info->country;
                    $post_data['cus_phone'] = $user_info->phone;

                    # REQUEST SEND TO SSLCOMMERZ
                    if ($ssl_type == "sandbox") {
                        $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php"; // Sandbox
                    } elseif ($ssl_type == "live") {
                        $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v3/api.php"; // Live
                    }

                    $handle = curl_init();
                    curl_setopt($handle, CURLOPT_URL, $direct_api_url);
                    curl_setopt($handle, CURLOPT_TIMEOUT, 30);
                    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
                    curl_setopt($handle, CURLOPT_POST, 1);
                    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                    if ($ssl_type == "sandbox") {
                        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC
                    } elseif ($ssl_type == "live") {
                        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, TRUE);
                    }


                    $content = curl_exec($handle);

                    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

                    if ($code == 200 && !(curl_errno($handle))) {
                        curl_close($handle);
                        $sslcommerzResponse = $content;
                    } else {
                        curl_close($handle);
                        echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
                        exit;
                    }

                    # PARSE THE JSON RESPONSE
                    $sslcz = json_decode($sslcommerzResponse, true);

                    if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
                        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                        echo "<meta http-equiv='refresh' content='0;url=" . $sslcz['GatewayPageURL'] . "'>";
                        # header("Location: ". $sslcz['GatewayPageURL']);
                        exit;
                    } else {
                        echo "JSON Data parsing error!";
                    }
                }
                //$this->email_model->wallet_email('payment_info_require_mail_to_customer', $id);
                //$this->email_model->wallet_email('customer_added_wallet_to_admin', $id);
            } else if ($para2 == "set_info") {
                $data['status'] = 'pending';
                $data['payment_details'] = $this->input->post('payment_info');
                $data['timestamp'] = time();
                $this->db->where('wallet_load_id', $para3);
                $this->db->update('wallet_load', $data);
                // $this->email_model->wallet_email('customer_set_payment_info_to_admin', $para3);
                echo 'done';
            } else {
                $this->load->view('front/user/wallet');
            }
        } elseif ($para1 == "order_history") {
            $this->load->view('front/user/order_history');
        } elseif ($para1 == "downloads") {
            $this->load->view('front/user/downloads');
        } elseif ($para1 == "update_profile") {
            $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->result_array();
            $this->load->view('front/user/update_profile', $page_data);
        } elseif ($para1 == "ticket") {
            $this->load->view('front/user/ticket');
        } elseif ($para1 == "message_box") {
            $page_data['ticket'] = $para2;
            $this->crud_model->ticket_message_viewed($para2, 'user');
            $this->load->view('front/user/message_box', $page_data);
        } elseif ($para1 == "message_view") {
            $page_data['ticket'] = $para2;
            $page_data['message_data'] = $this->db->get_where('ticket', array(
                'ticket_id' => $para2
            ))->result_array();
            $this->crud_model->ticket_message_viewed($para2, 'user');
            $this->load->view('front/user/message_view', $page_data);
        } elseif ($para1 == "message_to_vendor_box") {
            $page_data['message_thread'] = $para2;
            $this->crud_model->message_to_vendor_viewed($para2, 'user');
            $this->load->view('front/user/message_to_vendor_box', $page_data);
        } elseif ($para1 == "message_to_vendor_view") {
            $page_data['message_thread'] = $para2;
            $page_data['message_data'] = $this->db->get_where('message_thread', array(
                'message_thread_id' => $para2
            ))->result_array();
            $this->crud_model->message_to_vendor_viewed($para2, 'user');
            $this->load->view('front/user/message_to_vendor_view', $page_data);
        } elseif ($para1 == "order_tracing") {
            $sale_data = $this->db->get_where('sale', array(
                'sale_code' => $this->input->post('sale_code')
            ));
            if ($sale_data->num_rows() >= 1) {
                $page_data['status'] = 'done';
                $page_data['sale_datetime'] = $sale_data->row()->sale_datetime;
                $page_data['delivery_status'] = json_decode($sale_data->row()->delivery_status, true);
            } else {
                $page_data['status'] = '';
            }
            $this->load->view('front/user/order_tracing', $page_data);
        } elseif ($para1 == "post_product") {
            $this->load->view('front/user/post_product');
        } elseif ($para1 == "post_product_bulk") {

            /*if ($this->session->userdata('user_login') != "yes") {
                redirect(base_url() . 'home/login_set/login', 'refresh');
            }*/

            $physical_categories = $this->db->where('digital', null)->or_where('digital', '')->get('category')->result_array();
            $physical_sub_categories = $this->db->where('digital', null)->or_where('digital', '')->get('sub_category')->result_array();
            $digital_categories = $this->db->where('digital', 'ok')->get('category')->result_array();
            $digital_sub_categories = $this->db->where('digital', 'ok')->get('sub_category')->result_array();
            $brands = $this->db->get('brand')->result_array();

            $page_data['page_name'] = "customer_product_bulk_upload";
            $page_data['page_title'] = translate('Bulk upload');

            $page_data['upload_amount'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload;


            $page_data['physical_categories'] = $physical_categories;
            $page_data['physical_sub_categories'] = $physical_sub_categories;
            $page_data['digital_categories'] = $digital_categories;
            $page_data['digital_sub_categories'] = $digital_sub_categories;
            $page_data['brands'] = $brands;

            $this->load->view('front/user/post_product_bulk', $page_data);

        } elseif ($para1 == "do_post_product") {
            $upload_amount = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload;
            if ($upload_amount > 0) {
                $this->load->library('form_validation');

                $this->form_validation->set_rules('title', 'Title', 'required');
                $this->form_validation->set_rules('category', 'Category', 'required');
                $this->form_validation->set_rules('sub_category', 'Sub Category', 'required');
                $this->form_validation->set_rules('prod_condition', 'Condition', 'required');
                $this->form_validation->set_rules('sale_price', 'Price', 'required');
                $this->form_validation->set_rules('location', 'Location', 'required');
                $this->form_validation->set_rules('description', 'Description', 'required');

                if ($this->form_validation->run() == FALSE) {
                    echo '<br>' . validation_errors();
                } else {
                    $options = array();
                    if ($_FILES["images"]['name'][0] == '') {
                        $num_of_imgs = 0;
                    } else {
                        $num_of_imgs = count($_FILES["images"]['name']);
                    }
                    $data['seo_title'] = $this->input->post('seo_title');
                    $data['seo_description'] = $this->input->post('seo_description');
                    $data['title'] = $this->input->post('title');
                    $data['category'] = $this->input->post('category');
                    $data['sub_category'] = $this->input->post('sub_category');
                    $data['brand'] = $this->input->post('brand');
                    $data['prod_condition'] = $this->input->post('prod_condition');
                    $data['sale_price'] = $this->input->post('sale_price');
                    $data['location'] = $this->input->post('location');
                    $data['description'] = $this->input->post('description');
                    $data['add_timestamp'] = time();
                    $data['status'] = 'ok';
                    $data['admin_status'] = 'ok';
                    $data['is_sold'] = 'no';
                    $data['rating_user'] = '[]';
                    $data['num_of_imgs'] = $num_of_imgs;
                    $data['front_image'] = 0;
                    $additional_fields['name'] = json_encode($this->input->post('ad_field_names'));
                    $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
                    $data['additional_fields'] = json_encode($additional_fields);
                    $data['added_by'] = $this->session->userdata('user_id');

                    $this->db->insert('customer_product', $data);
                    // echo $this->db->last_query();
                    $id = $this->db->insert_id();
                    $this->benchmark->mark_time();
                    if (!demo()) {
                        $this->crud_model->file_up("images", "customer_product", $id, 'multi');
                    }
                    $this->crud_model->set_category_data(0);
                    recache();

                    // Package Info subtract code
                    $data1['product_upload'] = $upload_amount - 1;
                    $this->db->where('user_id', $this->session->userdata('user_id'));
                    $this->db->update('user', $data1);

                    echo "done";
                }
            } else {
                echo "failed";
            }
        } elseif ($para1 == "message_to_vendor") {
            $msg_page_data['check'] = "";
            if ($para2 != null) {
                $msg_page_data['seller_id'] = $para2;
            }
            $this->load->view('front/user/message_to_vendor', $msg_page_data);
        } else {
            $page_data['part'] = 'profile';
            if ($para2 == "info") {
                $page_data['part'] = 'profile';
            } elseif ($para2 == "wallet") {
                if ($this->crud_model->get_type_name_by_id('general_settings', '84', 'value') !== 'ok') {
                    redirect(base_url() . 'home');
                } else {
                    $page_data['part'] = 'wallet';
                }

            } elseif ($para2 == "wishlist") {
                $page_data['part'] = 'wishlist';
            } elseif ($para2 == "uploaded_products") {
                $page_data['part'] = 'uploaded_products';
            } elseif ($para2 == "order_history") {
                $page_data['part'] = 'order_history';
            } elseif ($para2 == "downloads") {
                $page_data['part'] = 'downloads';
            } elseif ($para2 == "update_profile") {
                $page_data['part'] = 'update_profile';
            } elseif ($para2 == "ticket") {
                $page_data['part'] = 'ticket';
            } elseif ($para2 == "post_product") {
                $page_data['part'] = 'post_product';
            } elseif ($para2 == "message_to_vendor") {
                $page_data['part'] = 'message_to_vendor';
                $page_data['product_added_by_id'] = $para3;
            } elseif ($para2 == "post_product_bulk") {
                $page_data['part'] = 'post_product_bulk';

                $physical_categories = $this->db->where('digital', null)->or_where('digital', '')->get('category')->result_array();
                $physical_sub_categories = $this->db->where('digital', null)->or_where('digital', '')->get('sub_category')->result_array();
                $digital_categories = $this->db->where('digital', 'ok')->get('category')->result_array();
                $digital_sub_categories = $this->db->where('digital', 'ok')->get('sub_category')->result_array();
                $brands = $this->db->get('brand')->result_array();

                $page_data['page_name'] = "customer_product_bulk_upload";
                $page_data['page_title'] = translate('Bulk upload');

                $page_data['upload_amount'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload;


                $page_data['physical_categories'] = $physical_categories;
                $page_data['physical_sub_categories'] = $physical_sub_categories;
                $page_data['digital_categories'] = $digital_categories;
                $page_data['digital_sub_categories'] = $digital_sub_categories;
                $page_data['brands'] = $brands;
            } elseif ($para2 == "uploaded_products") {
                $page_data['part'] = 'uploaded_products';
            } elseif ($para2 == "payment_info") {
                $page_data['part'] = 'package_payment_info';
            }

            $page_data['user_info'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->result_array();
            
            $page_data['html'] = $html;
            $page_data['page_name'] = "user";
            $page_data['asset_page'] = "user_profile";
            $page_data['page_title'] = translate('my_profile');
            $this->load->view('front/profile', $page_data);
        }
        /*$page_data['all_products'] = $this->db->get_where('user', array(
            'user_id' => $this->session->userdata('user_id')
        ))->result_array();
        $page_data['user_info']    = $this->db->get_where('user', array(
            'user_id' => $this->session->userdata('user_id')
        ))->result_array();*/
    }

    public function customer_product_bulk_upload()
    {
        if ($this->session->userdata('user_login') != "yes") {
            redirect(base_url() . 'home/login_set/login', 'refresh');
        }

        $physical_categories = $this->db->where('digital', null)->or_where('digital', '')->get('category')->result_array();
        $physical_sub_categories = $this->db->where('digital', null)->or_where('digital', '')->get('sub_category')->result_array();
        $digital_categories = $this->db->where('digital', 'ok')->get('category')->result_array();
        $digital_sub_categories = $this->db->where('digital', 'ok')->get('sub_category')->result_array();
        $brands = $this->db->get('brand')->result_array();

        $page_data['page_name'] = "customer_product_bulk_upload";
        $page_data['page_title'] = translate('Bulk upload');

        $page_data['upload_amount'] = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload;


        $page_data['physical_categories'] = $physical_categories;
        $page_data['physical_sub_categories'] = $physical_sub_categories;
        $page_data['digital_categories'] = $digital_categories;
        $page_data['digital_sub_categories'] = $digital_sub_categories;
        $page_data['brands'] = $brands;
        $this->load->view('front/index', $page_data);

    }

    public function customer_product_bulk_upload_save()
    {
        if (demo()) {
            $this->session->set_flashdata('error', translate('This operation is invalid for demo'));
            redirect('home/profile/part/post_product_bulk');
        }

        if (!file_exists($_FILES['bulk_file']['tmp_name']) || !is_uploaded_file($_FILES['bulk_file']['tmp_name'])) {
            $_SESSION['error'] = translate('File is not selected');
            //redirect('home/customer_product_bulk_upload');
            redirect(base_url() . 'home/profile/part/post_product_bulk');
        }

        $inputFileName = $_FILES['bulk_file']['tmp_name'];

        $inputFileType = $this->spreadsheet->identify($inputFileName);
        $reader = $this->spreadsheet->createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $products = array();
        if (!empty($sheetData)) {

            if (!isset($sheetData[1])) {
                $_SESSION['error'] = translate('Column names are missing');
                //redirect('home/customer_product_bulk_upload');
                redirect(base_url() . 'home/profile/part/post_product_bulk');
            }

            foreach ($sheetData[1] as $colk => $colv) {
                $col_map[$colk] = $colv;
            }


            if (!isset($sheetData[2])) {
                $_SESSION['error'] = translate('Data missing');
                //redirect('home/customer_product_bulk_upload');
                redirect(base_url() . 'home/profile/part/post_product_bulk');
            }

            for ($i = 2; $i <= count($sheetData); $i++) {
                $product = array();
                foreach ($sheetData[$i] as $colk => $colv) {
                    $product[$col_map[$colk]] = $colv;
                }
                $products[] = $product;
            }
        }


        if (!empty($products)) {
            foreach ($products as $product) {
                $upload_amount = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload;
                if ($upload_amount > 0) {
                    $this->customer_product_bulk_upload_save_single($product);
                }

            }
        }

        //exit;
        $_SESSION['success'] = translate('Products uploaded');
        //redirect('home/customer_product_bulk_upload');
        redirect(base_url() . 'home/profile/part/post_product_bulk');

    }

    public function customer_product_bulk_upload_save_single($product)
    {
        $image_urls = array();

        $product_data['num_of_imgs'] = 0;
        if (!empty($product['images'])) {
            $image_urls = explode(',', $product['images']);
            $product_data['num_of_imgs'] = count($image_urls);
        }

        $product_data['title'] = $product['title'];
        $product_data['description'] = $product['description'];
        $product_data['category'] = is_numeric($product['category']) ? $product['category'] : 0;
        $product_data['sub_category'] = is_numeric($product['sub_category']) ? $product['sub_category'] : 0;
        $product_data['brand'] = $product['brand'];
        $product_data['prod_condition'] = $product['condition'] != "used" ? "new" : "used";

        $product_data['sale_price'] = is_numeric($product['sale_price']) ? $product['sale_price'] : 0;

        $product_data['add_timestamp'] = time();
        $product_data['status'] = $product['published'] == 'yes' ? 'ok' : '';
        $product_data['admin_status'] = 'ok';
        $product_data['is_sold'] = 'no';
        $product_data['rating_user'] = '[]';

        $product_data['tag'] = $product['tag'];
        $product_data['color'] = null;

        $product_data['front_image'] = 0;

        $product_data['additional_fields'] = null;
        $product_data['added_by'] = $this->session->userdata('user_id');
        $product_data['options'] = json_encode($options = array());

        $this->db->insert('customer_product', $product_data);

        //echo $this->db->last->query().'\n';

        $product_id = $this->db->insert_id();
        $this->crud_model->set_category_data(0);
        recache();

        // Package Info subtract code
        $upload_amount = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload;
        $du['product_upload'] = $upload_amount - 1;
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('user', $du);

        if (!empty($image_urls)) {
            if (!demo()) {
                $this->crud_model->file_up_from_urls($image_urls, "customer_product", $product_id);
            }
        }

    }

    function ticket_message($para1 = '')
    {
        $page_data['page_name'] = "ticket_message";
        $page_data['ticket'] = $para1;
        $page_data['message_data'] = $this->db->get_where('ticket', array(
            'ticket_id' => $para1
        ))->result_array();
        $this->crud_model->ticket_message_viewed($para1, 'user');
        $page_data['msgs'] = $this->db->get_where('ticket_message', array('ticket_id' => $para1))->result_array();
        $page_data['ticket_id'] = $para1;
        $page_data['page_name'] = "ticket_message";
        $page_data['page_title'] = translate('ticket_message');
        $this->load->view('front/index', $page_data);
    }

    function ticket_message_add()
    {
        $this->load->library('form_validation');
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $row) {
            if (preg_match('/[\^}{#~|+¬]/', $row, $match)) {
                $safe = 'no';
                $char = $match[0];
            }
        }

        $this->form_validation->set_rules('sub', 'Subject', 'required');
        $this->form_validation->set_rules('reply', 'Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if ($safe == 'yes') {
                $data['time'] = time();
                $data['subject'] = $this->input->post('sub');
                $id = $this->session->userdata('user_id');
                $data['from_where'] = json_encode(array('type' => 'user', 'id' => $id));
                $data['to_where'] = json_encode(array('type' => 'admin', 'id' => ''));
                $data['view_status'] = 'ok';
                $this->db->insert('ticket', $data);
                $ticket_id = $this->db->insert_id();
                $data1['message'] = $this->input->post('reply');
                $data1['time'] = time();
                if (!empty($this->db->get_where('ticket_message', array('ticket_id' => $ticket_id))->row()->ticket_id)) {
                    $data1['from_where'] = $this->db->get_where('ticket_message', array('ticket_id' => $ticket_id))->row()->from_where;
                    $data1['to_where'] = $this->db->get_where('ticket_message', array('ticket_id' => $ticket_id))->row()->to_where;
                } else {
                    $data1['from_where'] = $this->db->get_where('ticket', array('ticket_id' => $ticket_id))->row()->from_where;
                    $data1['to_where'] = $this->db->get_where('ticket', array('ticket_id' => $ticket_id))->row()->to_where;
                }
                $data1['ticket_id'] = $ticket_id;
                $data1['view_status'] = json_encode(array('user_show' => 'ok', 'admin_show' => 'no'));
                $data1['subject'] = $this->db->get_where('ticket', array('ticket_id' => $ticket_id))->row()->subject;
                $this->db->insert('ticket_message', $data1);
                echo 'success#-#-#';
            } else {
                echo 'fail#-#-#Disallowed charecter : " ' . $char . ' " in the POST';
            }
        }
    }

    function ticket_reply($para1 = '')
    {
        $this->load->library('form_validation');
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $row) {
            if (preg_match('/[\^}{#~|+¬]/', $row, $match)) {
                $safe = 'no';
                $char = $match[0];
            }
        }

        $this->form_validation->set_rules('reply', 'Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if ($safe == 'yes') {
                $data['message'] = $this->input->post('reply');
                $data['time'] = time();
                if (!empty($this->db->get_where('ticket_message', array('ticket_id' => $para1))->row()->ticket_id)) {
                    $data['from_where'] = $this->db->get_where('ticket_message', array('ticket_id' => $para1))->row()->from_where;
                    $data['to_where'] = $this->db->get_where('ticket_message', array('ticket_id' => $para1))->row()->to_where;
                } else {
                    $data['from_where'] = $this->db->get_where('ticket', array('ticket_id' => $para1))->row()->from_where;
                    $data['to_where'] = $this->db->get_where('ticket', array('ticket_id' => $para1))->row()->to_where;
                }
                $data['ticket_id'] = $para1;
                $data['view_status'] = json_encode(array('user_show' => 'ok', 'admin_show' => 'no'));
                $data['subject'] = $this->db->get_where('ticket', array('ticket_id' => $para1))->row()->subject;
                $this->db->insert('ticket_message', $data);
                echo 'success#-#-#';
            } else {
                echo 'fail#-#-#Disallowed charecter : " ' . $char . ' " in the POST';
            }
        }
    }

    function ticket_listed($para2 = '')
    {
        $this->load->library('Ajax_pagination');

        $id = $this->session->userdata('user_id');
        $this->db->where('from_where', '{"type":"user","id":"' . $id . '"}');
        $this->db->or_where('to_where', '{"type":"user","id":"' . $id . '"}');
        $config['total_rows'] = $this->db->count_all_results('ticket');
        $config['base_url'] = base_url() . 'home/ticket_listed/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "ticket_listed('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "ticket_listed('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "ticket_listed('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "ticket_listed('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 pagination-sm">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "ticket_listed(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $this->db->where('from_where', '{"type":"user","id":"' . $id . '"}');
        $this->db->or_where('to_where', '{"type":"user","id":"' . $id . '"}');
        $page_data['query'] = $this->db->get('ticket', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/ticket_listed', $page_data);
    }

    function new_message_to_seller()
    {
        $this->load->library('form_validation');
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $row) {
            if (preg_match('/[\^}{#~|+¬]/', $row, $match)) {
                $safe = 'no';
                $char = $match[0];
            }
        }

        $this->form_validation->set_rules('seller_id', 'Seller', 'required');
        $this->form_validation->set_rules('sub', 'Subject', 'required');
        $this->form_validation->set_rules('reply', 'Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if ($safe == 'yes') {
                $id = $this->session->userdata('user_id');
                $data['time'] = time();
                $data['subject'] = $this->input->post('sub');
                $data['sender'] = json_encode(array('type' => 'user', 'id' => $id));
                $data['reciever'] = json_encode(array('type' => 'seller', 'id' => $this->input->post('seller_id')));
                $data['message_thread_code'] = substr(md5(rand(100, 2147483647)), 0, 15);
                $this->db->insert('message_thread', $data);
                $message_thread_id = $this->db->insert_id();

                $data1['message'] = $this->input->post('reply');
                $data1['time'] = time();
                $data1['message_thread_id'] = $message_thread_id;
                $data1['sender'] = $data['sender'];
                $data1['view_status'] = json_encode(array('user_show' => 'ok', 'seller_show' => 'no'));
                $this->db->insert('message', $data1);
                echo 'success#-#-#';
            } else {
                echo 'fail#-#-#Disallowed charecter : " ' . $char . ' " in the POST';
            }
        }
    }

    // vendor ticket
    function message_to_seller_listed($para2 = '')
    {
        $this->load->library('Ajax_pagination');

        $id = $this->session->userdata('user_id');
        $this->db->where('sender', '{"type":"user","id":"' . $id . '"}');
        $this->db->or_where('reciever', '{"type":"user","id":"' . $id . '"}');
        $config['total_rows'] = $this->db->count_all_results('message_thread');
        $config['base_url'] = base_url() . 'home/message_to_seller_listed/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "message_to_seller_listed('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "message_to_seller_listed('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "message_to_seller_listed('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "message_to_seller_listed('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 pagination-sm">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "message_to_seller_listed(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $this->db->order_by("message_thread_id", "desc");
        $this->db->where('sender', '{"type":"user","id":"' . $id . '"}');
        $this->db->or_where('reciever', '{"type":"user","id":"' . $id . '"}');
        $page_data['query'] = $this->db->get('message_thread', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/message_to_vendor_listed', $page_data);
    }

    function message_to_seller_reply($para1 = '')
    {
        $this->load->library('form_validation');
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $row) {
            if (preg_match('/[\^}{#~|+¬]/', $row, $match)) {
                $safe = 'no';
                $char = $match[0];
            }
        }

        $this->form_validation->set_rules('reply', 'Message', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if ($safe == 'yes') {
                $id = $this->session->userdata('user_id');
                $data1['message'] = $this->input->post('reply');
                $data1['time'] = time();
                $data1['message_thread_id'] = $para1;
                $data1['sender'] = json_encode(array('type' => 'user', 'id' => $id));
                $data1['view_status'] = json_encode(array('user_show' => 'ok', 'seller_show' => 'no'));
                $this->db->insert('message', $data1);

                echo 'success#-#-#';
            } else {
                echo 'fail#-#-#Disallowed charecter : " ' . $char . ' " in the POST';
            }
        }
    }

    function order_listed($para2 = '')
    {
        $this->load->library('Ajax_pagination');

        $id = $this->session->userdata('user_id');
        $this->db->where('buyer', $id);
        $config['total_rows'] = $this->db->count_all_results('sale');
        $config['base_url'] = base_url() . 'home/order_listed/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "order_listed('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "order_listed('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "order_listed('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "order_listed('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 pagination-sm">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "order_listed(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $this->db->where('buyer', $id);
        $page_data['orders'] = $this->db->order_by("sale_id", "desc")->get('sale', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/order_listed', $page_data);
    }

    function log_listed($para2 = 0)
    {
        $this->load->library('Ajax_pagination');
        $uid = 0;
        if ($this->session->userdata('user_login') == 'yes') {
            $uid = $this->session->userdata('user_id');
            $type = 'user';
        } elseif ($this->session->userdata('vendor_login') == 'yes') {
            $uid = $this->session->userdata('vendor_id');
            $type = 'vendor';
        }
        $wh = array('uid' => $uid, 'type' => $type);
        $row = $this->db->where($wh)->get('affliate_user')->row();
        if (isset($row->id)) {
            $uid = $row->id;
        }
        $page_data['query'] = $this->db->where('aff_id', $uid)->get('aff_log')->result_array();
        $this->load->view('front/affliate/wish_listed', $page_data);
    }

    function wish_listed($para2 = '')
    {
        $this->load->library('Ajax_pagination');

        $id = $this->session->userdata('user_id');
        $ids = json_decode($this->db->get_where('user', array('user_id' => $id))->row()->wishlist, true);
        $this->db->where_in('product_id', $ids);

        $config['total_rows'] = $this->db->count_all_results('product');;
        $config['base_url'] = base_url() . 'home/wish_listed/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "wish_listed('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "wish_listed('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "wish_listed('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "wish_listed('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 ">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "wish_listed(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $ids = json_decode($this->db->get_where('user', array('user_id' => $id))->row()->wishlist, true);
        $this->db->where_in('product_id', $ids);
        $page_data['query'] = $this->db->get('product', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/wish_listed', $page_data);
    }

    function uploaded_products_list($para2 = '')
    {
        $this->load->library('Ajax_pagination');

        $id = $this->session->userdata('user_id');

        $this->db->where('added_by', $id);

        $config['total_rows'] = $this->db->count_all_results('customer_product');;
        $config['base_url'] = base_url() . 'home/uploaded_products_list/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "uploaded_products_list('0')";
        $config['first_link'] = '&laquo;';

        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "uploaded_products_list('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';
        $function = "uploaded_products_list('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "uploaded_products_list('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 ">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "uploaded_products_list(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $this->db->where('added_by', $id);
        $page_data['query'] = $this->db->get('customer_product', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/uploaded_products_list', $page_data);
    }

    function package_payment_list($para2 = '')
    {
        $this->load->library('Ajax_pagination');

        $id = $this->session->userdata('user_id');

        $this->db->where('user_id', $id);

        $config['total_rows'] = $this->db->count_all_results('package_payment');;
        $config['base_url'] = base_url() . 'home/package_payment_list/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "package_payment_list('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "package_payment_list('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "package_payment_list('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "package_payment_list('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 ">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "package_payment_list(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        $this->db->where('user_id', $id);
        $page_data['query'] = $this->db->order_by("package_payment_id", "desc")->get('package_payment', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/package_payment_list', $page_data);
    }

    function wallet_listed($para2 = '')
    {
        $this->load->library('Ajax_pagination');

        // $id = $this->session->userdata('user_id');
        $uid = 0;
        if ($this->session->userdata('user_login') == 'yes') {
            $uid = $this->session->userdata('user_id');
            $type = 'user';
        } elseif ($this->session->userdata('vendor_login') == 'yes') {
            $uid = $this->session->userdata('vendor_id');
            $type = 'vendor';
        }
        $page_data = array();
        if ($uid) {
            $already = $this->db->where('type', $type)->where('uid', $uid)->get('affliate_user')->row();
            if (!$already) {
                //add new account
                $in = array(
                    'type' => $type,
                    'uid' => $uid
                );
                $r = $this->db->insert('affliate_user', $in);
                $page_data['affliate_id'] = $uid = $this->db->insert_id();

            } else {
                $page_data['affliate_id'] = $uid = $already->id;
            }
        }
        $this->db->where('uid', $uid);

        $config['total_rows'] = $this->db->count_all_results('withdraw_request');
        $config['base_url'] = base_url() . 'home/wallet_listed/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "wallet_listed('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "wallet_listed('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "wallet_listed('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "wallet_listed('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 ">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "wallet_listed(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        // $this->db->order_by('wallet_load_id', 'DESC');
        $this->db->where('uid', $uid);
        $page_data['query'] = $this->db->get('withdraw_request', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/wallet_listed', $page_data);
    }

    function downloads_listed($para2 = '')
    {
        $this->load->library('Ajax_pagination');

        $id = $this->session->userdata('user_id');
        $downloads = json_decode($this->db->get_where('user', array('user_id' => $id))->row()->downloads, true);
        $ids = array();
        foreach ($downloads as $row) {
            $ids[] = $row['product'];
        }
        if (count($ids) !== 0) {
            $this->db->where_in('product_id', $ids);
        } else {
            $this->db->where('product_id', 0);
        }

        $config['total_rows'] = $this->db->count_all_results('product');;
        $config['base_url'] = base_url() . 'home/downloads_listed/';
        $config['per_page'] = 5;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para2;

        $function = "downloads_listed('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "downloads_listed('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "downloads_listed('" . ($para2 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "downloads_listed('" . ($para2 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination pagination-style-2 ">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
        $config['cur_tag_close'] = '</a></li>';

        $function = "downloads_listed(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);
        if (count($ids) !== 0) {
            $this->db->where_in('product_id', $ids);
        } else {
            $this->db->where('product_id', 0);
        }
        $page_data['query'] = $this->db->get('product', $config['per_page'], $para2)->result_array();
        $this->load->view('front/user/downloads_listed', $page_data);
    }

    /* FUNCTION: Loads Customer Download */
    function download($id)
    {
        if ($this->session->userdata('user_login') != "yes") {
            redirect(base_url(), 'refresh');
        }
        $this->crud_model->download_product($id);
    }

    /* FUNCTION: Loads Customer Download Permission */
    function can_download($id)
    {
        if ($this->session->userdata('user_login') != "yes") {
            redirect(base_url(), 'refresh');
        }
        if ($this->crud_model->can_download($id)) {
            echo 'ok';
        } else {
            echo 'not';
        }
    }

    /* FUNCTION: Loads Category filter page */
    function brand($para1 = "", $para2 = "", $min = "", $max = "", $text = '')
    {
        //echo $text;
        $text_url = $text;
        if ($text !== '') {
            $text1 = $this->session->flashdata('query');
            if (isset($text1)) {
                $text = $this->modify_for_multi_search($text1);
            }
        }

        if ($para2 == "") {
            $page_data['all_products'] = $this->db->get_where('product', array(
                'brand' => $para1
            ))->result_array();
        }
        if ($para1 == "" || $para1 == "0") {
            $type = 'other';
        } else {
            if ($this->db->get_where('category', array('category_id' => $para1))->row()->digital == 'ok') {
                $type = 'digital';
            } else {
                $type = 'other';
            }
        }

        $type = 'other';
        $brand_sub = explode('-', $para2);

        $sub = 0;
        $brand = 0;

        if (isset($brand_sub[0])) {
            $sub = $brand_sub[0];
        }
        if (isset($brand_sub[1])) {
            $brand = $brand_sub[1];
        }

        $page_data['range'] = $min . ';' . $max;
        $page_data['page_name'] = "product_list/" . $type;
        $page_data['asset_page'] = "product_list_" . $type;
        $page_data['page_title'] = translate('products');
        $page_data['all_category'] = $this->db->get('category')->result_array();
        $brands = $this->db->get('brand')->result_array();

        $page_data['all_brands'] = $brands;

        $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
        $page_data['cur_sub_category'] = $sub;
        $page_data['cur_brand'] = $para1;
        // $page_data['cur_category'] = $para1;
        $page_data['text'] = $text;
        $page_data['text_url'] = $text_url;
        $page_data['category_data'] = $this->db->get_where('category', array(
            'category_id' => $para1
        ))->result_array();
        $this->load->view('front/index', $page_data);
    }

    /* FUNCTION: Loads Category filter page */
    function sneaker($text = '')
    {
        $this->category("", "", "", "", $text);
    }

    function directory($slug = '')
    {
        $mod = $this->db->where('no_module',0)->where('dir_slug',$slug)->get('modules')->row();
        $fixed = array('business', 'affiliate-business', 'shop-online','blogs','shop');
        if($mod && $slug)
        {
            
            $this->category('','','','','','module',$mod);
        }
        else if (in_array($slug, $fixed)) {
            
            
            $this->category('','','','','','slug',$slug);
            exit();
        }
        else
        {
            if($slug)
            {
            $cid = $this->db->where('slug', $slug)->get('category')->row();
            if(isset($cid->category_id))
            $this->category($cid->category_id);
            }
            else
            {
                $this->category();
            }
            
            exit();
        }

    }
    public function category2($para1 = "", $para2 = "", $min = "", $max = "", $text = '',$req_type = '', $req_data = '')
    {
        echo $this->load->view('front/directory_new', $page_data,true);
        exit();
    }
    public function category($para1 = "", $para2 = "", $min = "", $max = "", $text = '',$req_type = '', $req_data = '')
    {
        $this->load->library("pagination");
        $pag_where = " `status` = 'ok' AND `comp_cover` > 0";
        $place_id;
        if(isset($_GET['amenity']) && $_GET['amenity'])
        {
            $amenity= $_GET['amenity'];
            $pag_where = 'FIND_IN_SET("'.$amenity.'", `amenities`)';
            // die($text);
        }
        if($req_type == 'module')
        {
            $page_data['cat_path']  = array($req_data->category);
            $page_data['car_mod']  = $req_data->id;
            $page_data['cur_slug']  = $req_data->dir_slug;
            if($pag_where)
            {
            $pag_where .= " AND `module` = '$req_data->id'";
            }
            else
            {
                $pag_where .= "`module` = '$req_data->id'";
            }
        }
        
        if(isset($_GET['place_id']) && $_GET['place_id'])
        {
            $place_id= $_GET['place_id'];
            // die($text);
        }
        if(isset($_GET['q']) && $_GET['q'])
        {
            $text= $_GET['q'];
            // die($text);
        }
        
        $text_url = $text;
        if($text_url)
        {
            if($pag_where)
            {
            $pag_where .= " AND `title` LIKE '%".$text_url."%' OR `amenities` LIKE '%".$text_url."%'";
            }
            else
            {
                $pag_where .= "`title` LIKE '%".$text_url."%'  OR `amenities` LIKE '%".$text_url."%'";
            }
        }

        // if ($text !== '') {
        //     $text1 = $this->session->flashdata('query');
        //     if (isset($text1)) {
        //         // $text = $this->modify_for_multi_search($text1);
        //     }
        // }


        $cat = array();
        if ($para1 && $req_type != 'module') {
            
            $cat = $this->db->where('category_id',$para1)->get('category')->result_array();
            if(isset($cat[0]['slug']) && $cat[0]['slug'])
            $mod = $this->db->where('no_module',1)->where('dir_slug',$cat[0]['slug'])->get('modules')->row();
            if($mod)
            {
             $page_data['car_mod']  = $mod->id;
             $page_data['cur_slug']  = $mod->dir_slug;
            }
            
            // $pag_where = 'category = '.$para1;
            if($pag_where)
            {
            $pag_where .= ' AND FIND_IN_SET("'.$para1.'", `category`)';
            }
            else
            {
                $pag_where .= 'FIND_IN_SET("'.$para1.'", `category`)';
            }
            
            
        }
        if ($para2) {
            $pag_where = 'sub_category = '.$para2;
        }


        if ($para1 == "" || $para1 == "0") {
            $type = 'other';
        } else {
            if ($this->db->get_where('category', array('category_id' => $para1))->row()->digital == 'ok') {
                $type = 'digital';
            } else {
                $type = 'other';
            }
        }
        if($req_data == 'shop')
        {
            $this->db->where('is_product',1);
        }
        if(isset($page_data['car_mod']))
        {
            $this->db->where('module',$page_data['car_mod']);
        }
        $this->db->select_max('sale_price');
    $this->db->from('product');
    $query = $this->db->get();
    $r=$query->row();
        if(isset($r->sale_price))
        $page_data['max_price'] = floatval($r->sale_price);
        if(!$page_data['max_price'])
        {
            $page_data['max_price'] = 0;
        }
        if(!isset($page_data['cur_slug']))
        $page_data['cur_slug'] = 'directory_listing';
        if(!isset($page_data['cat_path']))
        $page_data['cat_path']  = array();
        if (isset($cat[0]['slug'])) {
            $page_data['cur_slug'] = $cat[0]['slug'];
            $page_data['cat_path'] = explode(',',$cat[0]['path']);
        } else if ($req_type == 'slug') {
            $page_data['cur_slug'] = $req_data;
            
            if($req_data == 'blogs')
            {
                if($pag_where)
            {
            $pag_where .= ' AND is_blog = 1';
            }
            else
            {
                $pag_where .= 'is_blog = 1';
            }
            }
            else if($req_data == 'business')
            {
                if($pag_where)
            {
            $pag_where .= ' AND is_bpage = 1';
            }
            else
            {
                $pag_where .= 'is_bpage = 1';
            }
            }
            else if($req_data == 'shop')
            {
                if($pag_where)
            {
            $pag_where .= " AND `is_product` = 1";
            }
            else
            {
                $pag_where .= " `is_product` = 1";
            }
            }
            else if($req_data == 'affiliate-business')
            {
                if($pag_where)
                {
                $pag_where .= ' AND is_affiliate = 1';
                }
                else
                {
                    $pag_where .= 'is_affiliate = 1';
                }
            }
        }
        if($req_data == 'shop')
        {
            if(isset($_GET['sale_price']) && $_GET['sale_price'])
                {
                    if($pag_where)
                    {
                        $pag_where .= " AND `sale_price` >= '1' AND `sale_price` <= '".$_GET['sale_price']."'";
                    }
                    else
                    {
                        $pag_where .= " `sale_price` >= '1' AND `sale_price` <= '".$_GET['sale_price']."'";
                    }
                }
        }
        else if($page_data['cat_path'] && $_GET)
        {
            $this->db->where_in('category',$page_data['cat_path']);
            $arr = $this->db->where('is_filter',1)->get('list_fields')->result_array();
            foreach($arr as $k=> $v)
            {
                if($v['tbl_col'] == 'sale_price' && !empty($_GET[$v['tbl_col']]))
                {
                    if($pag_where)
                    {
                        $pag_where .= "AND `sale_price` >= '1' AND `sale_price` <= '".$_GET[$v['tbl_col']]."'";
                    }
                    else
                    {
                        $pag_where .= " `sale_price` >= '1' AND `sale_price` <= '".$_GET[$v['tbl_col']]."'";
                    }
                }
                elseif(( empty($v['condition_type']) || $v['condition_type'] == '=') && !empty($_GET[$v['tbl_col']]))
                {
                    if($pag_where)
                    {
                        $pag_where .= "AND `".$v['tbl_col']."` = '".$_GET[$v['tbl_col']]."'";
                    }
                    else
                    {
                        $pag_where .= " `".$v['tbl_col']."` = '".$_GET[$v['tbl_col']]."'";
                    }    
                }
                
            }
        }
        
        $page_data['is_listing'] = 'directory_listing';
        $listing_types = array(
            'blogs' => 'blog_listing',
            'vehicles-cars' => 'car_listing',
            'jobs' => 'jobs_listing',
            'charities' => 'charity_listing',
            'business' => 'buss_listing',
            'news' => 'news_listing',
            'events' => 'event_listing',
            'properties' => 'property_listing',
            'shop' => 'shop_listing',
            'affiliate-business' => 'affliate_listing',
        );
        if (isset($page_data['cur_slug']) && $page_data['cur_slug']) {
            $page_data['is_listing'] = (isset($listing_types[$page_data['cur_slug']])) ? $listing_types[$page_data['cur_slug']] : "";
        }
        // die($pag_where);//test query
        if(!$page_data['cur_slug'])
        {
            $page_data['cur_slug'] = 'directory_listing';
        }

        $type = 'other';
        $brand_sub = explode('-', $para2);

        $sub = 0;
        $brand = 0;

        if (isset($brand_sub[0])) {
            $sub = $brand_sub[0];
        }
        if (isset($brand_sub[1])) {
            $brand = $brand_sub[1];
        }
        // $type = 'theme4';
        $page_data['type'] = $type;
        $page_data['range'] = $min . ';' . $max;
        $page_data['page_name'] = "product_list/" . $type;
        // $page_data['asset_page'] = "product_list_" . $type;
        $page_data['page_title'] = translate('products');
        $page_data['all_category'] = $this->db->get('category')->result_array();
        $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
        $page_data['cur_sub_category'] = $sub;
        $page_data['cur_brand'] = $brand;



        if($para2)
        {
            //sub category check
            $row = $this->db->where('sub_category_id',$para2)->get('sub_category')->row();
            $page_data['sub_cat'] = $row;
            if($row)
            {
                $page_data['page_title'] = $row->title;
            }
            $min = 0;
            $max = 50000000;
        }
        if($para1 && !$para2)
        {

            //main category check
            $row = $this->db->where('category_id',$para1)->get('category')->row();
            $page_data['main_cat'] = $row;
            if($row)
            {
                // $page_data['page_title'] = $row->meta_title;
            }
            $min = 0;
            $max = 50000000;
        }

        if($req_type === 'tag')
        {

            $tag_data = $req_data;
            $page_data['nopage'] = 1;
            if($pag_where)
            $pag_where .= 'AND FIND_IN_SET("'.$tag_data.'", `tags_slug`)';
            else
            $pag_where .= 'FIND_IN_SET("'.$tag_data.'", `tags_slug`)';
            $row = $this->db->where('FIND_IN_SET("'.$tag_data.'", `tags_slug`)')->get('product')->row();
            $single_product = $this->db->where('FIND_IN_SET("'.$tag_data.'", `tags_slug`)')->get('product')->result_array();
        $img = $this->crud_model->file_view('products',$single_product[0]['product_id'],'','','no','src','','');


        //schema here
            $slugs = explode(',',$row->tags_slug);
            $tag = explode(',',$row->tag);
            $tit = '';
            foreach($slugs as $k=> $v)
            {
                if($tag_data == $v)
                {
                    $tit = $tag[$k];
                }
            }
            if($tit)
            {
                $page_data['page_title'] = $tit.' | 03331619220 Buy Now';
                $page_data['pro_tag_list'] = str_replace(["-", "–"], ' ', $tit);
                $page_data['schema'] = $this->create_schema($single_product,$tit,base_url('tag/'.$tag_data),$tit.' '.$row->seo_description);

            }
            $min = 0;
            $max = 50000000;
            $page_data['tag'] = $tag_data;
            $page_data['tag_tit'] = $tit;
            $page_data['pro_tag'] = $tag_data;
            $page_data['tag_pdet'] = $row;
            unset($tag_data);
        }

        if($req_type === 'brand')
        {
            $brand_data = $req_data;
            $brand = $this->db->where('brand_slug',$req_data)->get('brand')->row();
            if(!$brand)
            {
                $this->error();
                exit();
            }
            $min = 0;
            $max = 50000000;
            $page_data['nopage'] = 1;
            $page_data['brand_meta'] = $brand;
            $page_data['page_title'] = $brand->name.'  - 03007986016 Best Price Shop';
            $page_data['cat_title'] = $brand->name;
            $page_data['cur_brand'] = $brand->brand_id;
            $pag_where = 'brand ='.$brand->brand_id;

            $row = $this->db->where('brand',$brand->brand_id)->get('product')->row();
            $single_product = $this->db->where('brand',$brand->brand_id)->get('product')->result_array();
            $page_data['tag_pdet'] = $row;
            //add here schema for brand
            //schema here
            $page_data['schema'] = $this->create_schema($single_product,$brand->name,base_url('brand/'.$brand_data) );
        //schema here

            unset($brand_data);
        }

        if($req_type === 'brand_tag')
        {


            $brandtag_data = $req_data;


            $min = 0;
            $page_data['nopage'] = 1;
            $max = 50000000;
            $page_data['brand_tag'] = str_replace(["-", "–"], ' ', $brandtag_data->tag_slug);
            $page_data['page_title'] = $page_data['brand_tag'].'- 03008856924 Buy Now';
            $row = $this->db->where('brand',$brandtag_data->brand_id)->get('product')->row();
                $single_product = $this->db->where('brand',$brandtag_data->brand_id)->get('product')->result_array();

            $page_data['tag_pdet'] = $row;

            // if(!$single_product)
            // {
            //     $this->error();
            //     exit();
            // }
            $page_data['schema'] = $this->create_schema($single_product,$page_data['brand_tag'],base_url('brand_tags/'.$brandtag_data->brand_slug));

            // $page_data['schema'] = $this->create_schema($single_product, $page_data['brand_tag'], base_url('brand_tags/'.$_SESSION['brand_tags']) );
            $page_data['tag_pdet'] = $row;
            $page_data['cur_brand'] = $brandtag_data->brand_id;
            $pag_where = 'brand ='.$brandtag_data->brand_id;
        }
        $page_data['range'] = $min . ';' . $max;
        $page_data['cur_category'] = $para1;
        $page_data['cur_sub_category'] = $para2;
        $page_data['text'] = $text;

        $page_data['text_url'] = $text_url;
        $page_data['category_data'] = $this->db->get_where('category', array(
            'category_id' => $para1
        ))->result_array();
        //pagination start
         $config = array();

           $config["per_page"] = 9;
           $config["uri_segment"] = 4;
           $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
           $start =   ($page* $config["per_page"]) - $config["per_page"];
            $this->db->limit($config["per_page"], $start);
            $lat = '';
            $lng = '';
            if (isset($place_id) && $place_id) {
                //$place_id
                $det = place_details($place_id);
                if (isset($det['result'])) {
                    if (isset($det['result']['geometry'])) {
                        $address = $det['result']['geometry'];
                        if (isset($address['location']['lat'])) {
                            $lat = $address['location']['lat'];
                        }
                        if (isset($address['location']['lng'])) {
                            $lng = $address['location']['lng'];
                        }

                    }
                }
            }
            else
            {
                $lat = $_SESSION['ip_info']['lat'];
                $lng = $_SESSION['ip_info']['lon'];
                // $lat = '51.4866';
                // $lng = '-3.1549';
            }
            
            
            $dis_range = isset($_GET['dis_range'])?'0-'.$_GET['dis_range']:'0-500';
            if ($lat && $lng) {
                
                $dis_range = explode('-', $dis_range);
                $mind = $dis_range[0];
                $maxd = $dis_range[1];
                // $this->db->select("product.*");
                if($pag_where)
                {
                    $pag_where .= " AND lat != '' AND lng != '' ";
                    $pag_where .= " AND getDistance(product.lat,product.lng,'" . $lat . "','" . $lng . "') >= ".$mind;
                    $pag_where .= " AND getDistance(product.lat,product.lng,'" . $lat . "','" . $lng . "') <= ".$maxd;
                }
                else
                {
                    $pag_where = " lat != '' AND lng != '' ";
                    $pag_where .= "AND getDistance(product.lat,product.lng,'" . $lat . "','" . $lng . "') >= ".$mind;
                    $pag_where .= " AND getDistance(product.lat,product.lng,'" . $lat . "','" . $lng . "') <= ".$maxd;
                }
                
            }
            
            $sort = (isset($_GET['sort'])?$_GET['sort']:"rating_num");

            if ($sort == 'most_viewed') {
                $this->db->order_by('number_of_view', 'desc');
            }
            if ($sort == 'condition_old') {
                $this->db->order_by('product_id', 'asc');
            }
            if ($sort == 'condition_new') {
                $this->db->order_by('product_id', 'desc');
            }
            if ($sort == 'rating_num') {
                $this->db->order_by('rating_num', 'desc');
            }
            
            if($pag_where)
            {
                
            $page_data['all_products'] = $this->db->select("product.*,getDistance(product.lat,product.lng,'" . $lat . "','" . $lng . "') as distance")->where($pag_where)->get('product')->result_array();
            //  var_dump($this->db->last_query());
            //  die();
            
            
            
            $this->db->where($pag_where)->select_max('sale_price');
    $this->db->from('product');
    $query = $this->db->get();
    $r=$query->row();
        if(isset($r->sale_price) && !empty($r->sale_price))
        {
        $page_data['max_price'] = floatval($r->sale_price);
        
        }
        else
        {
            $page_data['max_price'] = 0;
        }
        if(!$page_data['max_price'])
        {
            $page_data['max_price'] = 0;
        }
        
            }
            else
            {
                
                $page_data['all_products'] = $this->db->get('product')->result_array();
                        $this->db->where($pag_where)->select_max('sale_price');
    $this->db->from('product');
    $query = $this->db->get();
    $r=$query->row();
        if(isset($r->sale_price))
        $page_data['max_price'] = floatval($r->sale_price);
        if(!$page_data['max_price'])
        {
            $page_data['max_price'] = 0;
        }
                
            }
            
            if($pag_where)
            {
            $page_data['tot_products'] = $this->db->where($pag_where)->get('product')->result_array();
            }
            else
            {
                $page_data['tot_products'] = $this->db->get('product')->result_array();
                
            }
            $config["total_rows"] = $tot =  count($page_data['tot_products']);
            $page_data['tot'] = $tot;
            $page_data['cpage'] = $page;
            $page_data['tpage'] = ceil($tot/$config["per_page"]);
            $currentPageUrl = $_SERVER['REQUEST_URI'];
            $page_data['link'] = $currentPageUrl;
                $config ['use_page_numbers'] = TRUE;
                $config ['query_string_segment'] = 'page';
                $config ['page_query_string'] = TRUE;
             $config["base_url"] = $currentPageUrl;
            //   $config['num_links'] = 4;
            // $config['first_link'] = 'First';
            $config['last_link'] = ' ';
            $this->pagination->initialize($config);
        //pagination end
        
        echo $this->load->view('front/directory_new', $page_data,true);
        exit();
    }

    function category1($para1 = "", $para2 = "", $min = "", $max = "", $text = '')
    {

        $text_url = $text;
        if ($text !== '') {
            $text1 = $this->session->flashdata('query');
            if (isset($text1)) {
                $text = $this->modify_for_multi_search($text1);
            }

        }
        if ($text) {
            $this->db->like('title', $text);
            $page_data['all_products'] = $this->db->get('product')->result_array();
        } else {
            $page_data['all_products'] = $this->db->get('product')->result_array();
        }


        $type = 'other';
        $brand_sub = explode('-', $para2);

        $sub = 0;
        $brand = 0;

        if (isset($brand_sub[0])) {
            $sub = $brand_sub[0];
        }
        if (isset($brand_sub[1])) {
            $brand = $brand_sub[1];
        }

        $page_data['range'] = $min . ';' . $max;
        $page_data['page_name'] = "product_list/" . $type;
        $page_data['asset_page'] = "product_list_" . $type;
        $page_data['page_title'] = translate('products');
        $page_data['all_category'] = $this->db->get('category')->result_array();
        $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
        $page_data['cur_sub_category'] = $sub;
        $page_data['cur_brand'] = $brand;
        $page_data['cur_category'] = $para1;
        $cid = array();

        if ($para1) {
            $cid = $this->db->where('category_id', $para1)->get('category')->row();
        }
        if (isset($cid->path)) {
            $page_data['opn_category'] = implode(' , ', array_reverse(explode(',', $cid->path)));
        } else {
            $page_data['opn_category'] = $para1;
        }

        $page_data['text'] = $text;
        $page_data['text_url'] = $text_url;
        $page_data['category_data'] = $cat = $this->db->get_where('category', array(
            'category_id' => $para1
        ))->result_array();
        if (isset($cat[0]['slug'])) {
            $page_data['cur_slug'] = $cat[0]['slug'];
        } else if (isset($_SESSION['slug'])) {
            $page_data['cur_slug'] = $_SESSION['slug'];
        }
        $listing_types = array(
            'blogs' => 'blog_listing',
            'cars' => 'car_listing',
            'jobs' => 'jobs_listing',
            'charities' => 'charity_listing',
            'business' => 'buss_listing',
            'news' => 'news_listing',
            'events' => 'event_listing',
            'properties' => 'property_listing',
            'shop-online' => 'shop_listing',
            'affiliate-business' => 'affliate_listing',
        );
        if (isset($page_data['cur_slug'])) {
            $page_data['is_listing'] = (isset($listing_types[$page_data['cur_slug']])) ? $listing_types[$page_data['cur_slug']] : "";
        }
        $this->load->view('front/index', $page_data);
    }

    function all_category()
    {
        $page_data['page_name'] = "others/all_category";
        $page_data['asset_page'] = "all_category";
        $page_data['page_title'] = translate('all_category');
        $this->load->view('front/index', $page_data);
    }

    function all_brands()
    {
        $page_data['page_name'] = "others/all_brands";
        $page_data['asset_page'] = "all_brands";
        $page_data['page_title'] = translate('all_brands');
        $this->load->view('front/index', $page_data);
    }

    function faq()
    {
        $page_data['page_name'] = "others/faq";
        $page_data['asset_page'] = "all_category";
        $page_data['page_title'] = translate('frequently_asked_questions');
        $page_data['faqs'] = json_decode($this->crud_model->get_type_name_by_id('business_settings', '11', 'value'), true);
        $this->load->view('front/index', $page_data);
    }

    /* FUNCTION: Search Products */
    function home_search($param = '')
    {
        $category = $this->input->post('category');
        $this->session->set_userdata('searched_cat', $category);
        if ($param !== 'top') {
            $sub_category = $this->input->post('sub_category');
            $range = $this->input->post('price');
            $brand = $this->input->post('brand');
            $query = $this->input->post('query');
            $p = explode(';', $range);
            $this->session->set_flashdata('query', $query);
            redirect(base_url() . 'home/category/' . $category . '/' . $sub_category . '-' . $brand . '/' . $p[0] . '/' . $p[1] . '/' . $query, 'refresh');
        } else if ($param == 'top') {
            redirect(base_url() . 'home/category/' . $category, 'refresh');
        }
    }

    function modify_for_multi_search($search)
    {

        $find = array("+");
        $replace = array(" ");

        $search = str_replace($find, $replace, $search);

        return $search;

    }

    function pcat($id)
    {
        $cats = $this->db->where('pcat', $id)->get('category')->result();
        if ($cats) {
            echo "<ul>";
            foreach ($cats as $key => $value) {
                if ($this->crud_model->if_publishable_category($value->category_id)) {
                    $row = (array)$value;
                    ?>
                    <li>
                        <a href="<?= base_url('/directory'); ?>/<?= $row['slug'] ?>"
                           for="cat_<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?> <i
                                    class="fa fa-angle-down angle_rightdown"></i></a>
                        <!--<i  class="fa fa-angle-down angle_rightdown"></i>-->
                        <div class="cat_result" id="cat_r<?php echo $row['category_id']; ?>"></div>


                    </li>
                    <?php
                }
            }
            echo "</ul>";

        } else {
            die('no');
        }
    }

    function text_search()
    {
        $place_id = (isset($_REQUEST['place_id']) ? $_REQUEST['place_id'] : '');
        $type = 'product';
        $search = $this->modify_for_multi_search(urlencode($this->input->post('query')));
        $category = 0;
        $loc = '?place_id=' . $place_id;
        $this->session->set_flashdata('query', $search);

        if ($this->input->post('query')) {

            redirect(base_url() . 'home/category/' . $category . '/0-0/0/0/' . $search . $loc, 'refresh');
        } else {
            if ($type == 'vendor') {
                redirect(base_url() . 'home/store_locator/' . $search . $loc, 'refresh');
            } else if ($type == 'product') {
                redirect(base_url() . 'home/category/' . $category . '/0-0/0/0/' . $search . $loc, 'refresh');
            }
        }
    }

    /* FUNCTION: Check if user logged in */
    function is_logged()
    {
        if ($this->session->userdata('user_login') == 'yes') {
            echo 'yah!good';
        } else {
            echo 'nope!bad';
        }
    }

    function ajax_others_product($para1 = "")
    {
        $physical_product_activation = $this->db->get_where('general_settings', array('type' => 'physical_product_activation'))->row()->value;
        $digital_product_activation = $this->db->get_where('general_settings', array('type' => 'digital_product_activation'))->row()->value;
        $vendor_system = $this->db->get_where('general_settings', array('type' => 'vendor_system'))->row()->value;

        $this->load->library('Ajax_pagination');
        $type = $this->input->post('type');
        if ($type == 'featured') {
            $this->db->where('featured', 'ok');
        } elseif ($type == 'todays_deal') {
            $this->db->where('deal', 'ok');
        }
        $this->db->where('status', 'ok');

        if ($physical_product_activation == 'ok' && $digital_product_activation !== 'ok') {
            $this->db->where('download', NULL);
        } else if ($physical_product_activation !== 'ok' && $digital_product_activation == 'ok') {
            $this->db->where('download', 'ok');
        } else if ($physical_product_activation !== 'ok' && $digital_product_activation !== 'ok') {
            $this->db->where('product_id', '');
        }

        if ($vendor_system !== 'ok') {
            $this->db->like('added_by', '{"type":"admin"', 'both');
        }

        // pagination
        $config['total_rows'] = $this->db->count_all_results('product');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 12;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_others('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_others('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_others('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_others('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_others(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);


        $this->db->order_by('product_id', 'desc');
        $this->db->where('status', 'ok');
        if ($type == 'featured') {
            $this->db->where('featured', 'ok');
        } elseif ($type == 'todays_deal') {
            $this->db->where('deal', 'ok');
        }

        if ($physical_product_activation == 'ok' && $digital_product_activation !== 'ok') {
            $this->db->where('download', NULL);
        } else if ($physical_product_activation !== 'ok' && $digital_product_activation == 'ok') {
            $this->db->where('download', 'ok');
        } else if ($physical_product_activation !== 'ok' && $digital_product_activation !== 'ok') {
            $this->db->where('product_id', '');
        }

        if ($vendor_system !== 'ok') {
            $this->db->like('added_by', '{"type":"admin"', 'both');
        }

        $page_data['products'] = $this->db->get('product', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];
        $page_data['page_type'] = $type;

        $this->load->view('front/others_list/listed', $page_data);
    }

    /* FUNCTION: Loads Product List */
    public function get_product_size($pid)
    {
        $size = array();
        $vendors = $this->db->where('parent_id', $pid)->get('product')->result_array();
        foreach ($vendors as $k => $v) {
            $allsizes = $this->db->where('rate >', 0)->where('product', $v['product_id'])->get('stock')->result_array();
            $size = array();
            foreach ($allsizes as $k => $v) {
                $attr = $this->db->where('id', $v['attribute'])->get('attribute_to_values')->row();
                //get value
                if (isset($attr->value) && !in_array($attr->value, $size))
                    $size[] = $attr->value;
            }
        }
        return $size;
    }

    public function get_product_min($pid)
    {
        $child = array();
        $vendors = $this->db->where('parent_id', $pid)->get('product')->result_array();
        foreach ($vendors as $k => $v) {
            $child[] = $v['product_id'];
        }
        $min = '';
        $max = '';
        if ($child) {
            $all_rates = $this->db->where('rate >', 0)->where_in('product', $child)->get('stock')->result_array();
            $gmin = 0;
            $gmax = 0;
            foreach ($all_rates as $k => $v) {
                if ($k == 0) {
                    $gmin = $v['rate'];
                    $gmax = $v['rate'];
                }
                if ($gmin > $v['rate']) {
                    $gmin = $v['rate'];
                }
                if ($gmax < $v['rate']) {
                    $gmax = $v['rate'];
                }
            }
            return $min = $gmin;
            $max = $gmax;
        }
    }

    function fill_db()
    {

        $pros = $this->db->select('parent_id')->where('parent_id!=', 0)->get('product')->result();
        foreach ($pros as $k => $v) {
            $min = $this->get_product_min($v->parent_id);
            $size = $this->get_product_size($v->parent_id);
            $size = implode(',', $size);
            $up = array();
            $up['sale_price'] = $min;
            $up['avalible_sizes'] = $size;
            $this->db->where('product_id', $v->parent_id)->update('product', $up);

        }
        die("compelete");
    }

    /* FUNCTION: Loads Product List */
    function listed($para1 = "", $para2 = "", $para3 = "")
    {
        $this->load->library('Ajax_pagination');
        if ($para1 == "click") {
            $physical_product_activation = $this->db->get_where('general_settings', array('type' => 'physical_product_activation'))->row()->value;
            $digital_product_activation = $this->db->get_where('general_settings', array('type' => 'digital_product_activation'))->row()->value;
            $vendor_system = $this->db->get_where('general_settings', array('type' => 'vendor_system'))->row()->value;
            if ($this->input->post('range')) {
                $range = $this->input->post('range');
            }
            if ($this->input->post('text')) {
                $text = $this->input->post('text');
            }
            $category = $this->input->post('category');
            $lat = $this->input->post('lat');
            $lng = $this->input->post('lng');
            $make = $this->input->post('make');
            $job_hours = $this->input->post('job_hours');
            $job_type = $this->input->post('job_type');
            $event_date = $this->input->post('event_date');
            $event_type = $this->input->post('event_type');
            $age_restriction = $this->input->post('age_restriction');
            $bedrooms = $this->input->post('bedrooms');
            $property_type = $this->input->post('property_type');
            $seats = $this->input->post('seats');
            $modelf = $this->input->post('modelf');
            $modelt = $this->input->post('modelt');
            $category = explode(',', $category);
            $sub_category = $this->input->post('sub_category');
            $sub_category = explode(',', $sub_category);
            $mind = $this->input->post('min-value');
            $maxd = $this->input->post('max-value');
            $featured = $this->input->post('featured');
            $place_id = $this->input->post('place_id');
            $amenities = $this->input->post('amen');
            $amenities = explode(',', $amenities);
            foreach ($amenities as $k => $v) {
                if (!$v) {
                    unset($amenities[$k]);
                }
            }
            $lat = '';
            $lng = '';
            if ($place_id) {
                //$place_id
                $det = place_details($place_id);
                if (isset($det['result'])) {
                    if (isset($det['result']['geometry'])) {
                        $address = $det['result']['geometry'];
                        if (isset($address['location']['lat'])) {
                            $lat = $address['location']['lat'];
                        }
                        if (isset($address['location']['lng'])) {
                            $lng = $address['location']['lng'];
                        }

                    }
                }
            }
            $brand = $this->input->post('brand');
            $name = '';
            $cat = '';
            $setter = '';
            $vendors = array();
            $approved_users = $this->db->get_where('vendor', array('status' => 'approved'))->result_array();
            foreach ($approved_users as $row) {
                $vendors[] = $row['vendor_id'];
            }

            if ($vendor_system !== 'ok') {
                $this->db->like('added_by', '{"type":"admin"', 'both');
            }

            if ($physical_product_activation == 'ok' && $digital_product_activation !== 'ok') {
                $this->db->where('download', NULL);
            } else if ($physical_product_activation !== 'ok' && $digital_product_activation == 'ok') {
                $this->db->where('download', 'ok');
            } else if ($physical_product_activation !== 'ok' && $digital_product_activation !== 'ok') {
                $this->db->where('product_id', '');
            }

            if (isset($text)) {
                if ($text !== '') {
                    $this->db->like('title', $text, 'both');
                }
            }

            if ($vendor = $this->input->post('vendor')) {
                if (in_array($vendor, $vendors)) {
                    $this->db->where('added_by', '{"type":"vendor","id":"' . $vendor . '"}');
                } else {
                    $this->db->where('product_id', '');
                }
            }
            if (!empty($event_date)) {
                $this->db->where('event_date', $event_date);
            }
            if (!empty($age_restriction)) {
                $this->db->where('age_restriction_event', $age_restriction);
            }
            if (!empty($event_type)) {
                $this->db->where('event_type', $event_type);
            }
            if ($make) {
                $this->db->where('make', $make);
            }
            if ($bedrooms) {
                $this->db->where('no_of_bedroom', $bedrooms);
            }
            if ($property_type) {
                $this->db->where('propert_type', $property_type);
            }
            if ($seats) {
                $this->db->where('seats', $seats);
            }
            if ($modelf) {
                $this->db->where('model >=', $modelf);
            }
            if ($modelt) {
                $this->db->where('model <=', $modelt);
            }


            $this->db->where('status', 'ok');
            if ($featured == 'ok') {
                $this->db->where('featured', 'ok');
            }

            if ($brand !== '0' && $brand !== '') {
                $this->db->where('brand', $brand);
            }

            if (isset($range)) {
                $p = explode(';', $range);
                $this->db->where('sale_price >=', $p[0]);
                $this->db->where('sale_price <=', $p[1]);
            }

            $query = array();

            if (count($category) > 0 && $setter !== 'get') {
                $i = 0;
                // $this->db->group_start();
                foreach ($category as $value) {
                    if ($value)

                        if (isset($_REQUEST['list_type']) && ($_REQUEST['list_type'] != 'blog_listing') && ($_REQUEST['list_type'] != 'event_listing')) {
                            $this->db->where("find_in_set($value, category)");
                        }
                }

            }

            if ($amenities) {
                $this->db->group_start();
                foreach ($amenities as $value) {
                    if ($value)
                        $this->db->where("find_in_set('" . $value . "', amenities)");
                }
                $this->db->group_end();
            }
            if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'affliate_listing') {
                $this->db->where('is_affiliate ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'shop_listing') {
                $this->db->where('is_product ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'blog_listing') {
                $this->db->where('is_blog ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'places_listing') {
                $this->db->where('is_place ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'jobs_listing') {
                $this->db->where('is_job ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'car_listing') {
                $this->db->where('is_car ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'charity_listing') {
                $this->db->where('is_charity ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'event_listing') {
                $this->db->where('is_event ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'news_listing') {
                $this->db->where('is_blog ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'buss_listing') {
                $this->db->where('is_bpage ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'property_listing') {

                $this->db->where('is_property ', '1');
            }
            if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'blog_listing') {
                $this->db->where('comp_logo > 1');
            } else {
                // $this->db->where('comp_cover > 1');
            }
            $this->db->order_by('product_id', 'desc');

            // pagination
            $this->db->where('status', 'ok');
            if ($featured == 'ok') {
                $this->db->where('featured', 'ok');
                $grid_items_per_row = 3;
                $name = 'Featured';
            } else {
                $grid_items_per_row = 3;
            }

            if (isset($text)) {
                if ($text !== '') {
                    $this->db->like('title', $text, 'both');
                }
            }

            if ($physical_product_activation == 'ok' && $digital_product_activation !== 'ok') {
                $this->db->where('download', NULL);
            } else if ($physical_product_activation !== 'ok' && $digital_product_activation == 'ok') {
                $this->db->where('download', 'ok');
            } else if ($physical_product_activation !== 'ok' && $digital_product_activation !== 'ok') {
                $this->db->where('product_id', '');
            }

            if ($vendor_system !== 'ok') {
                $this->db->like('added_by', '{"type":"admin"', 'both');
            }

            if ($vendor = $this->input->post('vendor')) {
                if (in_array($vendor, $vendors)) {
                    $this->db->where('added_by', '{"type":"vendor","id":"' . $vendor . '"}');
                } else {
                    $this->db->where('product_id', '');
                }
            }


            if ($brand !== '0' && $brand !== '') {
                $this->db->where('brand', $brand);
            }

            if (isset($range)) {
                $p = explode(';', $range);
                $this->db->where('sale_price >=', $p[0]);
                $this->db->where('sale_price <=', $p[1]);
            }

            $query = array();
            if (count($sub_category) > 0) {
                $i = 0;
                foreach ($sub_category as $row) {
                    $i++;
                    if ($row !== "") {
                        if ($row !== "0") {
                            $query[] = $row;
                            $setter = 'get';
                        } else {
                            $this->db->where('sub_category !=', '0');
                        }
                    }
                }
                if ($setter == 'get') {
                    $this->db->where_in('sub_category', $query);
                }
            }


            $sort = $this->input->post('sort');

            if ($sort == 'most_viewed') {
                $this->db->order_by('number_of_view', 'desc');
            }
            if ($sort == 'condition_old') {
                $this->db->order_by('product_id', 'asc');
            }
            if ($sort == 'condition_new') {
                $this->db->order_by('product_id', 'desc');
            }
            if ($sort == 'rating_num') {
                $this->db->order_by('rating_num', 'desc');
            }

            if ($sort == 'distance') {
                $this->db->order_by('distance', 'desc');
            }
            if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'car_listing') {
                $this->db->where("sale_price >=", $mind);
                $this->db->where("sale_price <=", $maxd);
            }
            if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'shop_listing') {
                $this->db->where("sale_price >=", $mind);
                $this->db->where("sale_price <=", $maxd);
            }
            if ($lat && $lng) {
                $this->db->where("getDistance(product.lat,product.lng,'" . $lat . "','" . $lng . "') >=", $mind);
                $this->db->where("getDistance(product.lat,product.lng,'" . $lat . "','" . $lng . "') <=", $maxd);
            }

            if ($lat && $lng) {
                $mylat = $lat;
                $mylng = $lat;

                $this->db->select("product.*,getDistance(product.lat,product.lng,'" . $mylat . "','" . $mylng . "') as distance");

            } else {
                $this->db->select('product.*');
            }
            $befor = $this->db;
            $all = $this->db->get('product')->result_array();
            // print_r($this->db->last_query());
            // die();

            $config['total_rows'] = count($all);
            // var_dump($config['total_rows']);
            $config['base_url'] = base_url() . 'index.php?home/listed/';
            if ($featured !== 'ok') {
                $config['per_page'] = 9;
            } else if ($featured == 'ok') {
                $config['per_page'] = 9;
            }
            $config['uri_segment'] = 5;
            $config['cur_page_giv'] = $para2;

            $function = "do_product_search('0')";
            $config['first_link'] = '&laquo;';
            $config['first_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['first_tag_close'] = '</a></li>';

            $rr = ($config['total_rows'] - 1) / $config['per_page'];
            $last_start = floor($rr) * $config['per_page'];
            $function = "do_product_search('" . $last_start . "')";
            $config['last_link'] = '&raquo;';
            $config['last_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['last_tag_close'] = '</a></li>';

            $function = "do_product_search('" . ($para2 - $config['per_page']) . "')";
            $config['prev_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['prev_tag_close'] = '</a></li>';

            $function = "do_product_search('" . ($para2 + $config['per_page']) . "')";
            $config['next_link'] = '&rsaquo;';
            $config['next_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['next_tag_close'] = '</a></li>';

            $config['full_tag_open'] = '<ul class="pagination pagination-v2">';
            $config['full_tag_close'] = '</ul>';

            $config['cur_tag_open'] = '<li class="active"><a rel="grow" class="btn-u btn-u-red grow" class="active">';
            $config['cur_tag_close'] = '</a></li>';

            $function = "do_product_search(((this.innerHTML-1)*" . $config['per_page'] . "))";
            $config['num_tag_open'] = '<li><a rel="grow" class="btn-u btn-u-sea grow" onClick="' . $function . '">';
            $config['num_tag_close'] = '</a></li>';
            $this->ajax_pagination->initialize($config);


            $this->db->where('status', 'ok');
            if ($featured == 'ok') {
                $this->db->where('featured', 'ok');
                $grid_items_per_row = 3;
                $name = 'Featured';
            } else {
                $grid_items_per_row = 3;
            }

            if (isset($text)) {
                if ($text !== '') {
                    $this->db->like('title', $text, 'both');
                }
            }

            if ($physical_product_activation == 'ok' && $digital_product_activation !== 'ok') {
                $this->db->where('download', NULL);
            } else if ($physical_product_activation !== 'ok' && $digital_product_activation == 'ok') {
                $this->db->where('download', 'ok');
            } else if ($physical_product_activation !== 'ok' && $digital_product_activation !== 'ok') {
                $this->db->where('product_id', '');
            }

            if ($vendor_system !== 'ok') {
                $this->db->like('added_by', '{"type":"admin"', 'both');
            }

            if ($vendor = $this->input->post('vendor')) {
                if (in_array($vendor, $vendors)) {
                    $this->db->where('added_by', '{"type":"vendor","id":"' . $vendor . '"}');
                } else {
                    $this->db->where('product_id', '');
                }
            }
            if ($job_hours) {
                $this->db->where('job_hours', $job_hours);
            }
            if (!empty($job_type)) {
                $this->db->where('job_type', $job_type);
            }

            if (!empty($event_date)) {
                $this->db->where('event_date', $event_date);
            }
            if (!empty($age_restriction)) {
                $this->db->where('age_restriction_event', $age_restriction);
            }
            if (!empty($event_type)) {
                $this->db->where('event_type', $event_type);
            }
            if ($make) {
                $this->db->where('make', $make);
            }
            if ($bedrooms) {
                $this->db->where('no_of_bedroom', $bedrooms);
            }
            if ($property_type) {
                $this->db->where('propert_type', $property_type);
            }
            if ($seats) {
                $this->db->where('seats', $seats);
            }
            if ($modelf) {
                $this->db->where('model >=', $modelf);
            }
            if ($modelt) {
                $this->db->where('model <=', $modelt);
            }


            if ($brand !== '0' && $brand !== '') {
                $this->db->where('brand', $brand);
            }

            if (isset($range)) {
                $p = explode(';', $range);
                $this->db->where('sale_price >=', $p[0]);
                $this->db->where('sale_price <=', $p[1]);
            }

            $query = array();
            if (count($sub_category) > 0) {
                $i = 0;
                foreach ($sub_category as $row) {
                    $i++;
                    if ($row !== "") {
                        if ($row !== "0") {
                            $query[] = $row;
                            $setter = 'get';
                        } else {
                            $this->db->where('sub_category !=', '0');
                        }
                    }
                }
                if ($setter == 'get') {
                    $this->db->where_in('sub_category', $query);
                }
            }

            if (count($category) > 0 && $setter !== 'get') {
                $i = 0;
                // $this->db->group_start();
                foreach ($category as $value) {
                    if ($value)

                        if (isset($_REQUEST['list_type']) && ($_REQUEST['list_type'] != 'blog_listing') && ($_REQUEST['list_type'] != 'event_listing')) {
                            $this->db->where("find_in_set($value, category)");
                        }
                }
            }
            if ($amenities) {
                $this->db->group_start();
                foreach ($amenities as $value) {
                    if ($value)
                        $this->db->where("find_in_set('" . $value . "', amenities)");
                }
                $this->db->group_end();
            }
            if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'affliate_listing') {
                $this->db->where('is_affiliate ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'shop_listing') {
                $this->db->where('is_product ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'blog_listing') {
                $this->db->where('is_blog ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'jobs_listing') {
                $this->db->where('is_job ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'event_listing') {
                $this->db->where('is_event ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'places_listing') {
                $this->db->where('is_place ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'car_listing') {
                $this->db->where('is_car ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'charity_listing') {
                $this->db->where('is_charity ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'buss_listing') {
                $this->db->where('is_bpage ', '1');
            } else if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'property_listing') {
                $this->db->where('is_property ', '1');
            }

            $sort = $this->input->post('sort');

            if ($sort == 'most_viewed') {
                $this->db->order_by('number_of_view', 'desc');
            }
            if ($sort == 'condition_old') {
                $this->db->order_by('product_id', 'asc');
            }
            if ($sort == 'condition_new') {
                $this->db->order_by('product_id', 'desc');
            }
            if ($sort == 'rating_num') {
                $this->db->order_by('rating_num', 'desc');
            }

            if ($sort == 'distance') {
                $this->db->order_by('distance', 'desc');
            }
            if ($lat && $lng) {
                $this->db->where("getDistance(product.lat,product.lng,'" . $lat . "','" . $lng . "') <=", 50);
            }
            if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'car_listing') {
                $this->db->where("sale_price >=", $mind);
                $this->db->where("sale_price <=", $maxd);
            }
            if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'shop_listing') {
                $this->db->where("sale_price >=", $mind);
                $this->db->where("sale_price <=", $maxd);
            }
            if (isset($_REQUEST['list_type']) && $_REQUEST['list_type'] == 'blog_listing') {
                $this->db->where('comp_logo > 1');
            } else {
                // $this->db->where('comp_cover > 1');
            }

            if ($lat && $lng) {
                $mylat = $lat;
                $mylng = $lat;

                $this->db->select("product.*,getDistance(product.lat,product.lng,'" . $mylat . "','" . $mylng . "') as distance");

            } else {
                $this->db->select('product.*');
            }
            $befor = $this->db;
            $page_data['all_products'] = $this->db->get('product', $config['per_page'], $para2)->result_array();
            // var_dump($this->db->last_query());
            // die();
            if ($name != '') {
                $name .= ' : ';
            }
            if (isset($rowc)) {
                $cat = $rowc;
            } else {
                if ($setter == 'get') {
                    $cat = $this->crud_model->get_type_name_by_id('sub_category', $sub_category[0], 'category');
                }
            }
            if ($cat !== '') {
                if ($cat !== '0') {
                    $name .= $this->crud_model->get_type_name_by_id('category', $cat, 'category_name');
                } else {
                    $name = 'All Products';
                }
            } else {
                $name = 'All Products';
            }

        } elseif ($para1 == "load") {
            $page_data['all_products'] = $this->db->get('product')->result_array();

        }

        $page_data['vendor_system'] = $this->db->get_where('general_settings', array('type' => 'vendor_system'))->row()->value;
        $page_data['category_data'] = $category;
        $page_data['viewtype'] = $this->input->post('view_type');
        $page_data['name'] = $name;
        $page_data['count'] = $config['total_rows'];
        // var_dump($config);
        $page_data['grid_items_per_row'] = $grid_items_per_row;
        //  echo '<pre style="display:none">'; print_r($page_data); echo '</pre>';
        $this->load->view('front/product_list/other/listed', $page_data);
    }


    /* FUNCTION: Loads Custom Pages */
    function store_locator($parmalink = '')
    {
        if ($this->crud_model->get_settings_value('general_settings', 'vendor_system') !== 'ok') {
            redirect(base_url() . 'home');
        }
        $page_data['page_name'] = "others/store_locator";
        $page_data['asset_page'] = "store_locator";
        $page_data['page_title'] = translate('store_locator');
        $page_data['vendors'] = $this->db->get_where('vendor', array('status' => 'approved'))->result_array();
        $page_data['text'] = $this->modify_for_multi_search($parmalink);
        $this->load->view('front/index', $page_data);
    }


    /* FUNCTION: Loads Custom Pages */

    function page($parmalink = '')
    {
        $pagef = $this->db->get_where('page', array(
            'parmalink' => $parmalink
        ));

        if ($pagef->num_rows() > 0) {
            $page_data['page_name'] = "others/custom_page";
            $page_data['asset_page'] = "page";
            $page_data['tags'] = $pagef->row()->tag;
            $page_data['ptit'] = $pagef->row()->page_name;
            $page_data['page_title'] = $parmalink;
            $page_data['page_items'] = $pagef->result_array();
            if ($this->session->userdata('admin_login') !== 'yes' && $pagef->row()->status !== 'ok') {
                redirect(base_url() . 'home/', 'refresh');
            }
        } else {
            redirect(base_url() . '', 'refresh');
        }
        $this->load->view('front/page', $page_data);
    }


    /* FUNCTION: Loads Product View Page */
    public function update_product()
    {
        $cols = $this->db->list_fields('product');
        // $thi default_business
        $json = file_get_contents('php://input');

// decode the json data
        $data = json_decode($json, true);
        foreach ($data as $k => $v) {
            if (!in_array($k, $cols)) {
                unset($data[$k]);
            }

        }
        if (isset($data['product_id'])) {
            $pid = $data['product_id'];
            $unset = array('product_id', 'comp_logo', 'comp_cover', 'gallary', 'title_edit', 'sub_category', 'category', 'slug');
            foreach ($unset as $k => $v) {
                if (isset($data[$v])) {
                    unset($data[$v]);
                }
            }
            $exp = array('amenities', 'cats');
            foreach ($exp as $k => $v) {
                foreach ($data[$v] as $kk => $vv) {
                    if (!$vv) {
                        unset($data[$v][$kk]);
                    }
                }
                if (isset($data[$v]))
                    $data[$v] = implode(',', $data[$v]);
            }

            $json = array('feature', 'etra_content', 'text', 'enable_checks', 'buttons');
            foreach ($json as $k => $v) {
                if ($k == 'buttons') {
                    foreach ($data[$v] as $kk => $vv) {
                        if (!$vv) {
                            unset($data[$v][$kk]);
                        }
                    }
                }
                if (isset($data[$v]))
                    $data[$v] = json_encode($data[$v]);
            }
            $r = $this->db->where(array('product_id' => $pid))->update('product', $data);
            if ($r) {
                echo '1';
            } else {
                echo '0';
            }

            return '';
        }


    }

    public function product_data($id)
    {
        $dpage = 665;
        $product_data = $this->db->get_where('product', array('product_id' => $id))->row();
        $gallary = $this->db->get_where('product_to_images', array('pid' => $id))->result_array();
        $added_by = json_decode($product_data->added_by, true);
        if (isset($added_by['type']) && $added_by['type'] == 'vendor') {
            $vid = $added_by['id'];
        }
        $tgallary = $this->db->where('vid', $vid)->get('textg')->result_array();
        if (!$gallary) {
            $gallary = $this->db->get_where('product_to_images', array('pid' => $dpage))->result_array();
        }
        // $product_data->comp_cover = $this->crud_model->size_img($product_data->comp_cover,820,312);
        foreach ($gallary as $k => $v) {
            $gallary[$k]['img'] = $this->crud_model->size_img($v['img'], 100, 100);
        }
        $product_data->gallary = $gallary;

        $product_data = json_decode(json_encode($product_data), true);

        $default = $this->db->where('product_id', $dpage)->get('product')->row_array();
        foreach ($product_data as $k => $v) {
            if (!$v) {

                if (isset($default[$k])) {
                    $product_data[$k] = $default[$k];
                }
            }
        }
        if ($product_data['comp_cover']) {

            $product_data['comp_cover'] = $this->crud_model->size_img($product_data['comp_cover'], 640, 214);
        }
        if ($product_data['comp_logo']) {
            $product_data['comp_logo'] = $this->crud_model->size_img($product_data['comp_logo'], 100, 100);

        }
        if ($product_data['cats']) {
            $product_data['cats'] = explode(',', $product_data['cats']);

        }
        if ($product_data['amenities']) {
            $product_data['amenities'] = explode(',', $product_data['amenities']);

        }
        if ($product_data['etra_content']) {

            $product_data['etra_content'] = json_decode($product_data['etra_content'], true);
            $product_data['buttons'] = json_decode($product_data['buttons'], true);
            $product_data['tgallary'] = $tgallary;
            foreach ($product_data['etra_content'] as $k => $v) {
                $i = $k + 1;
                $nv = trim($product_data['etra_content'][$k]);
                if ($nv && $v) {
                    $product_data['etra_content'][$k] = $v;
                } else {
                    $product_data['etra_content'][$k] = $v;
                }
            }
            // var_dump($product_data['etra_content']);
            // die();


        }
        echo json_encode($product_data);
        die();
    }

    function product_view($para1 = "", $para2 = "")
    {
        $user_id = $this->session->userdata('user_id') ? $this->session->userdata('user_id') : 0;
        $this->crud_model->_set_variation($para1);
        $vendors = array();
        /*$vendors[] = $this->db->get_where('product', array('product_id' => $para1, 'status' => 'ok'))->row();**/
        $product_data = $this->db->get_where('product', array('product_id' => $para1, 'status' => 'ok'));
        if (!empty($product_data->row()->parent_id)) {
            $para1 = $product_data->row()->parent_id;
            $this->crud_model->_set_variation($para1);
        }
        $product_data = $this->db->get_where('product', array('product_id' => $para1, 'status' => 'ok'));
        $product_data = $this->db->get_where('product', array('product_id' => $para1));

        $this->db->where('product_id', $para1);
        $this->db->update('product', array(
            'number_of_view' => $product_data->row()->number_of_view + 1,
            'last_viewed' => time()
        ));
        $vid = json_decode($product_data->row()->added_by);
        if (isset($_GET['edit']) && isset($_SESSION['admin_login']) && $_SESSION['admin_login'] == 'yes' && $para1 == 665) {
        } else if (isset($_GET['edit']) && ($_SESSION['login'] != 'yes') && ($vid->id != $_SESSION['vendor_id'])) {
            $this->error();
            exit();
        }


        $type = 'other';
        
        $mod = $this->db->where('id',$product_data->row()->module)->get('modules')->row();
        if ($product_data->row()->is_bpage) {
            if (isset($_GET['edit'])) {
                $page_data['ng'] = 1;
            }
            $type = 'bpage';
        } elseif ($product_data->row()->is_product) {
            $type = 'product';
        } else {
            if($mod)
            $type= $mod->front_view;
            else
            $type = "car";
        }
        
        
        $page_data['product_details'] = $this->db->get_where('product', array('product_id' => $para1))->result_array();
        $page_data['vendors'] = $vendors;
        // var_dump($product_details);

        $page_data['page_name'] = "product_view/" . $type . "/page_view";
        $page_data['product_type'] = $type;
        $page_data['asset_page'] = "product_view_" . $type;
        $page_data['product_data'] = $product_data->result_array();
        $page_data['page_title'] = !empty($product_data->row()->seo_title) ? $product_data->row()->seo_title : $product_data->row()->title;
        $page_data['page_description'] = !empty($product_data->row()->seo_description) ? $product_data->row()->seo_description : '';
        $page_data['product_tags'] = $product_data->row()->tag;

        $page_data['user_bought_product'] = $this->crud_model->is_product_bought($user_id, $product_data->row()->product_id);
        $user_rating_check = array('user_id' => $user_id, 'product_id' => $product_data->row()->product_id, 'product_type' => 'product');
        $page_data['user_given_rating'] =
            $this->db
                ->get_where('user_rating', $user_rating_check)
                ->row_array();

        $page_data['user_ratings'] =
            $this->db->select('*')
                ->from('user_rating as ur')
                ->join('user as u', 'u.user_id=ur.user_id')
                ->where('ur.product_id', $product_data->row()->product_id)
                ->where('ur.product_type', 'product')
                ->limit(250)
                ->order_by('created_at', 'desc')
                ->get()
                ->result_array();

        $this->set_affiliation_code_as_cookie(array());
        $attributes = $this->db->where('product_id', $para1)->get('attribute_to_products')->result_array();
        $attr = array();
        foreach ($attributes as $k => $v) {
            $aid = $v['attribute_id'];
            $row = $this->db->where('id', $aid)->get('attribute')->row();

            if ($row) {
                //get options
                $options = $this->db->where('attr_id', $aid)->where('product_id', $para1)->get('attribute_to_values')->result_array();
                $attr[] = array(
                    'name' => $row->name,
                    'options' => $options
                );
            }
        }

        $page_data['attribute'] = $attr;
        if($type == 'bpage')
        {
            $page_data['json_link'] = base_url('home/product_data/'.$para1);
        }
        if(isset($_GET['new']))
        {
            
            $this->load->view('front/'.$type, $page_data);
        }
        else
        {
        $this->load->view('front/index_new', $page_data);
        }
    }

    function set_affiliation_code_as_cookie($params)
    {
        if (isset($_GET['product_affiliation_code'])
            && !empty($_GET['product_affiliation_code'])) {

            $product_affiliation_code = $_GET['product_affiliation_code'];

            //if the code is not generated by the logged in user, so that user's own codes are not set in cookies
            if ($this->session->userdata('user_id') !== $this->crud_model->get_product_affiliator_id_by_code($product_affiliation_code)) {
                $product_affiliation_codes_string = $this->crud_model->set_product_affiliation_code_in_cookies($product_affiliation_code);
            }
        }
    }

    /* FUNCTION: Loads Product View Page */
    function quick_view($para1 = "")
    {
        $product_data = $this->db->get_where('product', array(
            'product_id' => $para1,
            'status' => 'ok'
        ));

        if ($product_data->row()->download == 'ok') {
            $type = 'digital';
        } else {
            $type = 'other';
        }
        $page_data['product_details'] = $product_data->result_array();
        $page_data['page_title'] = !empty($product_data->row()->seo_title) ? $product_data->row()->seo_title : $product_data->row()->title;;
        $page_data['page_description'] = !empty($product_data->row()->seo_title) ? $product_data->row()->seo_description : '';
        $page_data['product_tags'] = $product_data->row()->tag;

        $this->load->view('front/product_view/' . $type . '/quick_view/index', $page_data);
    }

    function customer_product_view($para1 = "", $para2 = "")
    {
        if ($this->crud_model->get_type_name_by_id('general_settings', '83', 'value') == 'ok') {
            $product_data = $this->db->get_where('customer_product', array('customer_product_id' => $para1, 'status' => 'ok', 'is_sold' => 'no'));

            $this->db->where('customer_product_id', $para1);
            $this->db->update('customer_product', array(
                'number_of_view' => $product_data->row()->number_of_view + 1,
                'last_viewed' => time()
            ));

            $type = 'other';

            $page_data['product_details'] = $this->db->get_where('customer_product', array('customer_product_id' => $para1, 'status' => 'ok', 'is_sold' => 'no'))->result_array();
            $page_data['page_name'] = "customer_product_view/" . $type . "/page_view";
            $page_data['asset_page'] = "product_view_" . $type; //there is no asset page for customer product view
            $page_data['product_data'] = $product_data->result_array();
            $page_data['page_title'] = !empty($product_data->row()->seo_title) ? $product_data->row()->seo_title : $product_data->row()->title;;
            $page_data['page_description'] = !empty($product_data->row()->seo_description) ? $product_data->row()->seo_description : '';
            $page_data['product_tags'] = $product_data->row()->tag;

            $this->load->view('front/index', $page_data);
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    function quick_view_cp($para1 = "")
    {
        $product_data = $this->db->get_where('customer_product', array(
            'customer_product_id' => $para1,
            'status' => 'ok'
        ));

        $type = 'other';

        $page_data['product_details'] = $product_data->result_array();
        $page_data['page_title'] = !empty($product_data->row()->seo_title) ? $product_data->row()->seo_title : $product_data->row()->title;;
        $page_data['page_description'] = !empty($product_data->row()->seo_description) ? $product_data->row()->seo_description : '';
        $page_data['product_tags'] = $product_data->row()->tag;

        $this->load->view('front/customer_product_view/' . $type . '/quick_view/index', $page_data);
    }

    /* FUNCTION: Setting Frontend Language */
    function set_language($lang)
    {
        $this->session->set_userdata('language', $lang);
        $page_data['page_name'] = "home";
        recache();
    }

    /* FUNCTION: Setting Frontend Language */
    function set_currency($currency)
    {
        $this->session->set_userdata('currency', $currency);
        recache();
    }

    function contactus()
    {
        $from_name = $_REQUEST['fname'];
        $from = $_REQUEST['email'];
        $msg = 'Testing';//$_REQUEST['msg'];
        $sub = "MESSAGE";
        $to = "raheelshehzad188@gmail.com";
        $this->load->model('email_model');
        $this->email_model->directory_contact($_REQUEST, $to, $msg);
    }

    /* FUNCTION: Loads Contact Page */
    function contact($para1 = "")
    {
        if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        $this->load->library('form_validation');
        if ($para1 == 'send') {
            $safe = 'yes';
            $char = '';
            foreach ($_POST as $row) {
                if (preg_match('/[\'^":()}{#~><>|=+¬]/', $row, $match)) {
                    $safe = 'no';
                    $char = $match[0];
                }
            }

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                if ($safe == 'yes') {

                    if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
                        $captcha_answer = $this->input->post('g-recaptcha-response');
                        $response = $this->recaptcha->verifyResponse($captcha_answer);
                        if ($response['success']) {
                            $data['name'] = $this->input->post('name', true);
                            $data['subject'] = $this->input->post('subject');
                            $data['email'] = $this->input->post('email');
                            $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                            $data['view'] = 'no';
                            $data['timestamp'] = time();
                            $this->db->insert('contact_message', $data);
                            echo 'sent';
                        } else {
                            echo translate('captcha_incorrect');
                        }
                    } else {
                        $data['name'] = $this->input->post('name', true);
                        $data['subject'] = $this->input->post('subject');
                        $data['email'] = $this->input->post('email');
                        $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                        $data['view'] = 'no';
                        $data['timestamp'] = time();
                        $this->db->insert('contact_message', $data);
                        echo 'sent';
                    }
                } else {
                    echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                }
            }
        } else {
            if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
                $page_data['recaptcha_html'] = $this->recaptcha->render();
            }
            $page_data['page_name'] = "others/contact";
            $page_data['asset_page'] = "contact";
            $page_data['page_title'] = translate('contact');
            $this->load->view('front/index', $page_data);
        }
    }

    /* FUNCTION: Loads Contact Page */
    function about($para1 = "")
    {
        if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        $this->load->library('form_validation');
        if ($para1 == 'send') {
            $safe = 'yes';
            $char = '';
            foreach ($_POST as $row) {
                if (preg_match('/[\'^":()}{#~><>|=+¬]/', $row, $match)) {
                    $safe = 'no';
                    $char = $match[0];
                }
            }

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('message', 'Message', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                if ($safe == 'yes') {

                    if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
                        $captcha_answer = $this->input->post('g-recaptcha-response');
                        $response = $this->recaptcha->verifyResponse($captcha_answer);
                        if ($response['success']) {
                            $data['name'] = $this->input->post('name', true);
                            $data['subject'] = $this->input->post('subject');
                            $data['email'] = $this->input->post('email');
                            $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                            $data['view'] = 'no';
                            $data['timestamp'] = time();
                            $this->db->insert('contact_message', $data);
                            echo 'sent';
                        } else {
                            echo translate('captcha_incorrect');
                        }
                    } else {
                        $data['name'] = $this->input->post('name', true);
                        $data['subject'] = $this->input->post('subject');
                        $data['email'] = $this->input->post('email');
                        $data['message'] = $this->security->xss_clean(($this->input->post('message')));
                        $data['view'] = 'no';
                        $data['timestamp'] = time();
                        $this->db->insert('contact_message', $data);
                        echo 'sent';
                    }
                } else {
                    echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                }
            }
        } else {
            if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
                $page_data['recaptcha_html'] = $this->recaptcha->render();
            }
            $page_data['page_name'] = "others/about";
            $page_data['asset_page'] = "contact";
            $page_data['page_title'] = translate('contact');
            $this->load->view('front/index', $page_data);
        }
    }

    function putu($um)
    {
        $this->db->where('type', 'version');
        $this->db->update('general_settings', array('value' => $um));
    }

    /* FUNCTION: Concerning Login */
    public function success_subscription()
    {
        if (isset($_GET['track'])) {
            $track = $_GET['track'];
            $pack = $this->db->where('track_id',$track)->get('membership_payment')->row();
            $v = $this->db->where('vendor_id', $pack->vendor)->update('vendor',array('membership'=>$pack->vendor));
            if($v){
            $vendor = $this->db->where('vendor_id',$pack->vendor)->get('vendor')->row();
            $this->email_model->payment_success($vendor->email,$pack->amount.'$') ;
            }
            $page_data = array();
            //zohaib yhn bho success ki mail
            $page_data['page_name'] = "subscription_thank";
            $page_data['amount'] = $pack->amount;
            // $page_data['asset_page'] = "register";
            $page_data['page_title'] = translate('registration');
            $this->load->view('front/subscription_thank', $page_data);

        }
    }

    public function vendor_subscription($vid = 0)
    {
        //get vendor id here
        // $_SESSION['subscription_vendor'] = 1;//for test
        
        if($vid)
         $_SESSION['subscription_vendor'] = $vid;
        if (isset($_SESSION['subscription_vendor'])) {

            $user = $this->db->where('vendor_id', $_SESSION['subscription_vendor'])->get('vendor')->row();
            if (isset($user->pack) && $user->pack) {
                $pack = $this->db->where('membership_id', $user->pack)->get('membership')->row();


                $track = time();
                $in = array(
                    'vendor' => $_SESSION['subscription_vendor'],
                    'amount' => $pack->price,
                    'method' => 'stripe-subscription',
                    'status' => 'Pending',
                    'track_id' => $track,
                );
                $this->db->insert('membership_payment', $in);
                $stripe_secret = $this->db->where('type','stripe_secret')->get('business_settings')->row();
            $stripe_secret = $stripe_secret->value;
                $stripe_publishable = $this->db->where('type','stripe_publishable')->get('business_settings')->row();
                $stripe_publishable = $stripe_publishable->value;
                if (isset($pack->stripe_id) && $pack->stripe_id) {
                    try {
                        $path = FCPATH . '/stripe-subscription/vendor/autoload.php';
                        require $path;
                        \Stripe\Stripe::setApiKey($stripe_secret);
                        $checkout_session = \Stripe\Checkout\Session::create([
                            'success_url' => base_url() . '/home/success_subscription?track=' . $track,
                            'cancel_url' => base_url() . '/stripe-subscription/cancel.html',
                            'payment_method_types' => ['card'],
                            'mode' => 'subscription',
                            'line_items' => [[
                                'price' => $pack->stripe_id,
                                // For metered billing, do not pass quantity
                                'quantity' => 1,
                            ]],
//                           if($coupon){
//                               'discounts' => [[
//                                   'coupon' => 'Jf8DLxDL',
//                               ]],
//                           }
                            'subscription_data' => [
                                'metadata' => ["plan_id" => $user->pack, "track" => $track, "customer_id" => $_SESSION['subscription_vendor']]],
                        ]);
                    } catch (Exception $e) {
                        echo '<script> alert("Coupon is not for this package.") </script>';
                        $path = FCPATH . '/stripe-subscription/vendor/autoload.php';
                        require $path;
                        \Stripe\Stripe::setApiKey($stripe_secret);
                        $checkout_session = \Stripe\Checkout\Session::create([
                            'success_url' => base_url() . '/home/success_subscription?track=' . $track,
                            'cancel_url' => base_url() . '/stripe-subscription/cancel.html',
                            'payment_method_types' => ['card'],
                            'mode' => 'subscription',
                            'line_items' => [[
                                'price' => $pack->stripe_id,
                                // For metered billing, do not pass quantity
                                'quantity' => 1,
                            ]],

                            'subscription_data' => [
                                'metadata' => ["plan_id" => $user->pack, "track" => $track, "customer_id" => $_SESSION['subscription_vendor']]],
                        ]);
                    }
                    ?>
                    <head>
                        <title>Stripe Subscription Checkout</title>
                        <script src="https://js.stripe.com/v3/"></script>
                    </head>
                    <body>
                    <script type="text/javascript">
                        var stripe = Stripe('<?= $stripe_publishable ?>');
                        var session = "<?php echo $checkout_session['id']; ?>";
                        stripe.redirectToCheckout({sessionId: session})
                            .then(function (result) {
                                // If `redirectToCheckout` fails due to a browser or network
                                // error, you should display the localized error message to your
                                // customer using `error.message`.
                                if (result.error) {
                                    alert(result.error.message);
                                }
                            })
                            .catch(function (error) {
                                console.error('Error:', error);
                            });


                    </script>

                    </body>
                    <?php
                }

            }

            /*require FCPATH.'stripe-subscription/vendor/autoload.php';
 \Stripe\Stripe::setApiKey('sk_test_mSOHfomD5CDglqvXR9d7ImNs');*/
        } else {
            var_dump($_SESSION);
            die();
            die('Forbidden request!');
        }

    }

    public function vendor_page($id)
    {


        $user = $this->db->where('vendor_id', $id)->get('vendor')->row();

        $added_by = array(
            'type' => 'vendor',
            'id' => $id,
        );
        $in = array();
        $in['title'] = $user->company;
        $in['brand'] = $user->cat1;
        $in['cat2'] = $user->cat2;
        $in['cat3'] = $user->cat3;
        $in['name'] = $user->name;
        $in['address1'] = $user->address1;
        $in['address2'] = $user->address2;
        $in['country'] = $user->country;
        $in['city'] = $user->city;
        $in['state'] = $user->state;
        $in['status'] = 'ok';
        $in['bussniuss_phone'] = $user->phone;
        $in['whatsapp_number'] = $user->whatsapp;
        $in['bussniuss_email'] = $user->email;
        $in['zip'] = $user->zip;
        $in['added_by'] = json_encode($added_by);
        $in['is_bpage'] = 1;
        $in['slug'] = slugify($user->company);

        $this->db->insert('product', $in);
        $pid = $this->db->insert_id();
        // create_slug($pid);
        $v = $this->db->where('vendor_id', $id)->update('vendor', array('bpage' => $pid));
        //s
        if($user->promo == ''){
        if ($user->pack) {
            $pack = $this->db->where('membership_id', $user->pack)->get('membership')->row();
            $option = array(
                'ads' => $pack->product_limit,
            );
            $this->cart->destroy();
            $data = array(
                'id' => $user->pack,
                'qty' => 1,
                'signup_pkg' => 1,
                'option' => json_encode($option),
                'vendor' => $id,
                'vendor_name' => $user->title,
                'price' => $pack->price,
                'name' => $pack->title,
                'shipping' => 0,
                'tax' => 0
            );
            $this->cart->insert($data);
            $_SESSION['subscription_vendor'] = $id;
            return   "checkout";
        } else {
            $pack = $this->db->where('amount', 0)->get('package')->row();
            $this->process_pack($id, 0);
            return 0;
        }
        }else{
            $promo = $user->promo;
            $chk = $this->db->where('promo_code',$promo)->get('membership')->row();
            $new = $chk->promo_limit -1;
            $chk = $this->db->where('promo_code',$promo)->update('membership',array('promo_limit'=> $new));
            return 'vendor_promo';
        }
        //bpage
    }

    function process_order($id)
    {
        $order = $this->db->where('sale_id', $id)->get('sale')->row();
        $cart = json_decode($order->product_details);
        $sing = array();
        $i = 0;
        foreach ($cart as $key => $value) {
            if ($i == 0) {
                $sing = $value;
            }
            $i++;
        }
        if (isset($sing->signup_pkg)) {
            $this->process_pack($sing->vendor, $sing->id);
        }
    }

    function process_pack($vid, $pid)
    {
        $this->crud_model->upgrade_membership($vid, $pid);

    }

    function vendor_logup($para1 = "", $para2 = "")
    {

        // var_dump($_REQUEST);
        if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        $this->load->library('form_validation');
        if ($para1 == "add_info") {
            $msg = '';
            $this->load->library('form_validation');
            $safe = 'yes';
            $char = '';
            $this->form_validation->set_rules('name', 'First Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|required|is_unique[vendor.email]', array('required' => 'You have not provided %s.', 'is_unique' => 'This %s already exists.'));
            $this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'required');
            $this->form_validation->set_rules('address1', 'Address Line 1', 'required');
            // $this->form_validation->set_rules('display_name', 'Display Name', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            // $this->form_validation->set_rules('country', 'Country', 'required');
            $this->form_validation->set_rules('zip', 'Zip', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            // $this->form_validation->set_rules('middle_name', 'Middle Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            if ($this->input->post('company')) {
                $num = $this->db->where('title', $this->input->post('company'))->get('product');
                if ($num->num_rows() > 0) {
                    echo "Company Already exit";
                    $this->form_validation->set_rules('company', 'Company', 'required', array('required' => translate('company_name_already_teken_please_try_unique_name')));
                }
            }

            // if ($this->input->post('affiliate') == 'yes') {
            //     $this->form_validation->set_rules('affiliate_terms_check', 'Affiliate Terms of Use', 'required', array('required' => translate('you_must_agree_with_affiliates_terms_of_use')));
            // }


            // $this->form_validation->set_rules('terms_check', 'Terms & Conditions', 'required', array('required' => translate('you_must_agree_with_terms_&_conditions')));

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();

            } else {
    // var_dump($safe);
    // die('nimraaa');
                if ($safe = 'yes') {
                    if (false) {
                        // if (true) {

                        //     $data['name'] = $this->input->post('name');
                        //     $data['email'] = $this->input->post('email');
                        //     $data['address1'] = $this->input->post('address1');
                        //     $data['address2'] = $this->input->post('address2');
                        //     $data['company'] = $this->input->post('company');
                        //     $data['display_name'] = $this->input->post('display_name');
                        //     $data['state'] = $this->input->post('state');
                        //     $data['cat1'] = $this->input->post('buss_type');
                        //     $data['cat2'] = $this->input->post('sub_category');
                        //     $data['cat3'] = $this->input->post('sub3_category');
                        //     $data['country'] = $this->input->post('country');
                        //     $data['city'] = $this->input->post('city');
                        //     $data['zip'] = $this->input->post('zip');
                        //     $data['pack'] = $this->input->post('pack');
                        //     $data['promo'] = $this->input->post('promo');

                        //     $data['middle_name'] = $this->input->post('middle_name');
                        //     $data['last_name'] = $this->input->post('last_name');
                        //     $data['create_timestamp'] = time();
                        //     $data['approve_timestamp'] = 0;
                        //     $data['approve_timestamp'] = 0;
                        //     $data['membership'] = $this->input->post('pack');
                        //     $data['status'] = 'pending'; 
                        //     $data['status'] = 'approved';

                        //     // if ($this->input->post('password1') == $this->input->post('password2')) {
                        //     //     $password = $this->input->post('password1');
                        //     //     $data['password'] = sha1($password);
                        //     //     $this->db->insert('vendor', $data);
                        //     //     $msg = $this->vendor_page($this->db->insert_id());
                        //     //     if ($this->email_model->account_opening('vendor', $data['email'], $password) == false) {
                        //     //         $msg = 'done_but_not_sent';
                        //     //     } else {
                        //     //         if ($this->email_model->vendor_reg_email_to_admin($data['email'], $password) == false) {
                        //     //             $msg = 'done_but_not_sent';
                        //     //         } else {

                        //     //             $msg = 'done_and_sent';
                        //     //         }
                        //     //         $msg = 'done_and_sent';
                        //     //     }
                        //     //     echo $msg;
                        //     //     exit();
                        //     // };
                        //     exit();
                        // }
                    } else {
                        // die('nimra');
                        $data['name'] = $this->input->post('name');
                        $data['email'] = $this->input->post('email');
                        $data['address1'] = $this->input->post('address1');
                        $data['address2'] = $this->input->post('address2');
                        $data['company'] = $this->input->post('company');
                        $data['display_name'] = $this->input->post('display_name');
                        $data['state'] = $this->input->post('state');
                        $data['country'] = $this->input->post('country');
                        $data['city'] = $this->input->post('city');
                        $data['zip'] = $this->input->post('zip');
                        $data['ref_code'] = $this->input->post('ref');
                        $data['pack'] = $this->input->post('pack');
                        // $data['cat1'] = $this->input->post('buss_type');
                        $data['phone'] = $this->input->post('phone');
                        // $data['whatsapp'] = $this->input->post('wphone');
                        // $data['cat2'] = this->input->post('sub_category');
                        // $data['cat3'] = $this->input->post('sub3_category');
                        $data['middle_name'] = $this->input->post('middle_name');
                        $data['last_name'] = $this->input->post('last_name');
                        $data['add_affilite'] = $this->input->post('affiliate');
                        $data['TOC'] = $this->input->post('terms_check');
                        $data['promo'] = $this->input->post('promo');
                        if ($this->input->post('affiliate') == 'yes') {
                            $data['aff_TOC'] = $this->input->post('affiliate_terms_check');
                        }
                        $data['create_timestamp'] = time();
                        $data['approve_timestamp'] = 0;
                        $data['approve_timestamp'] = 0;
                        $data['membership'] = 0;
                        $data['status'] = 'pending';


                        if ($this->input->post('password1') == $this->input->post('password2')) {
                            
                            $password = $this->input->post('password1');
                            $data['password'] = sha1($password);
                            $x = $this->db->insert('vendor', $data);
                            
                            $vid = $this->db->insert_id();
                            if(!$vid)
                            {
                               var_dump($this->db->last_query());
                            }
                         
                            $this->vendor_page($vid);
                            $this->vendor_subscription($vid);
                            $this->email_model->account_opening('vendor', $data['email'], $password);
                            $this->email_model->vendor_reg_email_to_admin($data['email'], $password);
                            //  here on line 5667
                            
                            // redirect(base_url() . 'home/vendor_subscription', 'refresh');
                                // $msg = 'done_and_sent';
                                // echo $msg;
                                // exit();


                                // $msg = 'done';
                                // if ($this->email_model->account_opening('vendor', $data['email'], $password) == false) {
                                //     $msg = 'done_but_not_sent';
                                // } else {
                                //     if ($this->email_model->vendor_reg_email_to_admin($data['email'], $password) == false) {
                                //         $msg = 'done_but_not_sent';
                                //     } else {

                                //         $msg = 'done_and_sent';
                                //     }
                                //     $msg = 'done_and_sent';
                                // }
                            // $this->vendor_page($this->db->insert_id());

                            // print_r($this->db->last_query());
                            // die();
                            // if ($this->vendor_page($this->db->insert_id()) == 'checkout') {
                            //     if ($this->email_model->account_opening('vendor', $data['email'], $password) == true) {
                            //         if ($this->email_model->vendor_reg_email_to_admin($data['email'], $password) == false) {
                            //             $msg = 'checkout';
                            //         } else {

                            //             $msg = 'checkout';
                            //         }
                            //     } else {
                            //         $msg = 'checkout';
                            //     }
                            // }

                            // echo $msg;
                            // exit();

                            // $msg = 'done';

                        }
                    }
                } else {
                    echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                }
            }
        } else if ($para1 == 'registration') {

            if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
                $page_data['recaptcha_html'] = $this->recaptcha->render();
            }

            $page_data['pkgs'] = $this->db->get('membership')->result_array();
            $page_data['cat'] = $this->db->get('member_cat')->result_array();
            // $page_data['def'] = $this->db->where('def',1)->get('package')->row();
            $page_data['page_name'] = "vendor/register";
            $page_data['asset_page'] = "register";
            $page_data['page_title'] = translate('registration');
            if(isset($_GET['pack']) && $_GET['pack'])
            $this->load->view('front/vreg', $page_data);
            else
            $this->load->view('front/vendor_pack', $page_data);
        } elseif ($para1 == "sub_by_cat") {
            echo $this->crud_model->select_html('sub_category', 'sub_category', 'sub_category_name', 'add', 'form-control demo-chosen-select required', '', 'category', $para2, 'get_brnd');
            exit();
        } elseif ($para1 == "sub3_by_cat") {
            echo $this->crud_model->select_html('sub3_category', 'sub3_category', 'sub_category_name', 'add', 'form-control demo-chosen-select required', '', 'category', $para2, ' ');
            exit();
        }

    }
    
    function vendor_signup_promo(){
            $promo = $this->input->post('promo_code');
            $chk = $this->db->where('promo_code',$promo)->get('membership')->row();
            if($chk && $chk->promo_limit){
                $page_data['promo'] = $_POST['promo_code'];
                $page_data['page_name'] = "vendor/register";
                $page_data['asset_page'] = "register";
                $this->load->view('front/vreg', $page_data);
            }else{
                $_SESSION['error'] = 'invalid promocode or expired';
                $this->session->set_flashdata('error', 'invalid promocode or expired');
                custom_redirect($_SERVER['HTTP_REFERER'], 'refresh');
            }
        
    }

    function vendor_login_msg()
    {
        $page_data['page_name'] = "vendor/register/login_msg";
        $page_data['asset_page'] = "register";
        $page_data['page_title'] = translate('registration');
        $this->load->view('front/index', $page_data);
    }

    /* FUNCTION: Concerning Login */
    function login($para1 = "", $para2 = "")
    {
        $page_data['page_name'] = "login";

        $this->load->library('form_validation');
        if ($para1 == "do_login") {
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {
                // echo validation_errors();/
                $this->session->set_flashdata('error', validation_errors());
                custom_redirect($_SERVER['HTTP_REFERER']);
            } else {
                // var_dump(sha1($this->input->post('password')));
                $signin_data = $this->db->get_where('user', array(
                    'email' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password'))
                ));
                if ($signin_data->num_rows() > 0) {
                    foreach ($signin_data->result_array() as $row) {
                        $this->session->set_userdata('user_login', 'yes');
                        
                        $this->session->set_userdata('user_id', $row['user_id']);
                        $this->session->set_userdata('user_name', $row['username']);
                        $this->session->set_flashdata('alert', 'successful_signin');
                        $this->db->where('user_id', $row['user_id']);
                        $this->db->update('user', array(
                            'last_login' => time()
                        ));
                        $this->session->set_flashdata('message', 'Login Successfull!');
                         custom_redirect(base_url() . 'home/profile');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Login Failed!  Incorrect Email Or Password.Please Try Again');
                    custom_redirect($_SERVER['HTTP_REFERER']);
                }
            }
        } else if ($para1 == 'forget') {
            if (demo()) {
                echo "Action blocked in demo";
                exit;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required');

            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
            } else {
                $query = $this->db->get_where('user', array(
                    'email' => $this->input->post('email')
                ));
                if ($query->num_rows() > 0) {
                    $user_id = $query->row()->user_id;
                    $password = substr(hash('sha512', rand()), 0, 12);
                    $data['password'] = sha1($password);
                    $this->db->where('user_id', $user_id);
                    $this->db->update('user', $data);
                    if ($this->email_model->password_reset_email('user', $user_id, $password)) {
                        echo 'email_sent';
                    } else {
                        echo 'email_not_sent';
                    }
                } else {
                    echo 'email_nay';
                }
            }
        }
        $this->load->view('front/'.$page_data['page_name'], $page_data);
    }


    function report()
    {

        $name = $_GET['fname'];
        $email = $_GET['email'];
        $msg = $_GET['message'];
        $pid = $_GET['pid'];
        $data = array(
            "name" => $name,
            "email" => $email,
            "meg" => $msg,
            'pid' => $pid
        );

        $report = $this->db->insert('report', $data);
        $lastid = $this->db->insert_id();
        if (!$report) {
            $ret = array(
                'email' => '0',
                'msg' => 'server error'
            );
        }

        if ($report) {
            $email = $this->email_model->report_email($lastid);
            if ($email) {
                echo 1;
                //  $ret = array(
                // "email"=>'1',
                // "msg"=>'email sent'
                // );
            } else {
                echo 0;
                //   $ret = array(
                //     "email"=>'0',
                //     "msg"=>'email not sent'
                //      );
            }

        }

        // echo json_encode($ret);

    }

    function contact_us()
    {

        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $email = $_GET['email'];
        $phone = $_GET['phone'];
        $msg = $_GET['message'];
        $pid = $_GET['pid'];
        $bname = $_GET['bname'];
        $submail = $_GET['submail'];
        $sub = $_GET['sub'];
        $data = array(
            "first_name" => $fname,
            "last_name" => $lname,
            "email" => $email,
            "phone" => $phone,
            "msg" => $msg,
            'pid' => $pid,
            'bname' => $bname,
            'submail' => $submail,
            'subject' => $sub
        );

        $report = $this->db->insert('contact_us', $data);
        $lastid = $this->db->insert_id();
        if ($report) {
            $email = $this->email_model->contact_email($lastid, 'contact');
            // var_dump($email);
            // die('ok');
            if ($email == "true") {
                echo '1';
                //  $ret = array(
                // "email"=>'1',
                // "msg"=>'email sent'
                // );
            } else {
                echo '0';
                //   $ret = array(
                //     "email"=>'0',
                //     "msg"=>'email not sent'
                //      );
            }
            //   echo json_encode($ret);
        }


    }

    function email_template()
    {
        $this->load->view('email/index');
    }

    /* FUNCTION: Setting login page with facebook and google */
    function login_set($para1 = '', $para2 = '', $para3 = '')
    {
        if ($this->session->userdata('user_login') == "yes") {
            redirect(base_url() . 'home/profile', 'refresh');
        }
        if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        $this->load->library('form_validation');

        $fb_login_set = $this->crud_model->get_settings_value('general_settings', 'fb_login_set');
        $g_login_set = $this->crud_model->get_settings_value('general_settings', 'g_login_set');
        $page_data = array();

        if ($fb_login_set == 'ok') {
            $appid = $this->db->get_where('general_settings', array(
                'type' => 'fb_appid'
            ))->row()->value;
            $secret = $this->db->get_where('general_settings', array(
                'type' => 'fb_secret'
            ))->row()->value;
            $config = array(
                'appId' => $appid,
                'secret' => $secret
            );
            $this->load->library('Facebook', $config);

            // Try to get the user's id on Facebook
            //$data['user'] = array();
            if ($this->facebook->is_authenticated()) {
                $page_data['url'] = $this->facebook->login_url();

            } else {
                // Generate a login url
                //$page_data['url'] = $this->facebook->getLoginUrl(array('scope'=>'email'));

                $page_data['url'] = $this->facebook->login_url();
                /*
                $this->facebook->getLoginUrl(array(
                    'redirect_uri' => site_url('home/login_set/back/' . $para2),
                    'scope' => array(
                        "email"
                    ) // permissions here
                ));
                */
                /*
                $permissions        = ['email']; // optional
                $page_data['url']   = $this->facebook->getLoginUrl(site_url('home/login_set/back/' . $para2), $permissions);
                */
                //redirect($data['url']);
            }

            /*
            else {
                // Get user's data and print it
                $atok = $this->facebook->getAccessToken();
                $page_data['user'] = $this->facebook->api('/me?fields=email,first_name,last_name&access_token={'.$atok.'}');
                $page_data['url']  = site_url('home/login_set/back/' . $para2); // Logs off application
                //print_r($user);
            }
            */

            if ($para1 == 'back') {
                //$userid = $this->facebook->getUser();
                //if($userid == 0){
                //echo 'pp----<br>';
                if (1 == 0) {

                } else {
                    //$atok = $this->facebook->getAccessToken();

                    //$user = $this->facebook->api('/me?fields=email,first_name,last_name&access_token={'.$this->facebook->getAccessTokenFromCode($this->input->get('code')));
                    $user = $this->facebook->request('get', '/me?fields=id,first_name,last_name,name,email');
                    //var_dump($user);
                    if (!isset($user['error'])) {
                        if ($user_id = $this->crud_model->exists_in_table('user', 'fb_id', $user['id'])) {

                        } else {

                            $data['username'] = $user['first_name'];
                            $data['surname'] = $user['last_name'];
                            $data['email'] = $user['email'];
                            $data['fb_id'] = $user['id'];
                            $data['wishlist'] = '[]';
                            $data['package_info'] = '[]';
                            $data['product_upload'] = $this->db->get_where('package', array('package_id' => 1))->row()->upload_amount;
                            $data['creation_date'] = time();
                            $data['password'] = substr(hash('sha512', rand()), 0, 12);

                            $this->db->insert('user', $data);
                            $user_id = $this->db->insert_id();
                        }
                        $this->session->set_userdata('user_login', 'yes');
                        $this->session->set_userdata('user_id', $user_id);
                        $this->session->set_userdata('user_name', $this->db->get_where('user', array(
                            'user_id' => $user_id
                        ))->row()->username);
                        $this->session->set_flashdata('alert', 'successful_signin');
                        

                        $this->db->where('user_id', $user_id);
                        $this->db->update('user', array(
                            'last_login' => time()
                        ));

                        $para2a = $this->session->userdata('back');

                        if ($para2a == 'cart' || $para2a == 'back_to_cart') {
                            redirect(base_url() . 'home/cart_checkout', 'refresh');
                        } else {
                            redirect(base_url() . 'home/profile', 'refresh');
                        }
                    }

                }
            }
        }


        if ($g_login_set == 'ok') {
            $this->load->library('google');
            if (isset($_GET['code'])) {

                $token = $this->google->client->fetchAccessTokenWithAuthCode($_GET['code']);
                $this->google->client->setAccessToken($token['access_token']);

                // get profile info
                $google_oauth = new Google_Service_Oauth2($this->google->client);
                $g_user = $google_oauth->userinfo->get();

                if ($user_id = $this->crud_model->exists_in_table('user', 'g_id', $g_user['id'])) {

                } else {
                    $data['username'] = $g_user['givenName'];
                    $data['surname'] = $g_user['familyName'];
                    $data['email'] = $g_user['email'];
                    $data['wishlist'] = '[]';
                    $data['package_info'] = '[]';
                    $data['product_upload'] = $this->db->get_where('package', array('package_id' => 1))->row()->upload_amount;
                    $data['g_id'] = $g_user['id'];

                    $data['g_photo'] = $g_user['picture'];
                    $data['creation_date'] = time();
                    $data['password'] = substr(hash('sha512', rand()), 0, 12);
                    $this->db->insert('user', $data);
                    $user_id = $this->db->insert_id();
                }
                $this->session->set_userdata('user_login', 'yes');
                $this->session->set_userdata('user_id', $user_id);
                $this->session->set_userdata('user_name', $this->db->get_where('user', array(
                    'user_id' => $user_id
                ))->row()->username);
                $this->session->set_flashdata('alert', 'successful_signin');

                $this->db->where('user_id', $user_id);
                $this->db->update('user', array(
                    'last_login' => time()
                ));

                if ($para2 == 'cart') {
                    redirect(base_url() . 'home/cart_checkout', 'refresh');
                } else {
                    redirect(base_url() . 'home', 'refresh');
                }
            }
            if (isset($_SESSION['token'])) {
                $this->google->client->setAccessToken($_SESSION['token']);
            }
            if ($this->google->client->getAccessToken()) //already_logged_in
            {
                $page_data['g_user'] = $this->google->people->get('me');
                $page_data['g_url'] = $this->google->client->createAuthUrl();
                $_SESSION['token'] = $this->google->client->getAccessToken();
            } else {
                $page_data['g_url'] = $this->google->client->createAuthUrl();
            }
        }

        if ($para1 == 'login') {
            $page_data['page_name'] = "user/login";
            $page_data['asset_page'] = "login";
            $page_data['page_title'] = translate('login');
            if ($para2 == 'modal') {
                $page_data['page'] = $para3;
                $this->load->view('front/user/login/quick_modal', $page_data);
            } else {

                $this->load->view('front/index2', $page_data);
            }
        } elseif ($para1 == 'registration') {
            if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
                $page_data['recaptcha_html'] = $this->recaptcha->render();
            }
            $page_data['page_name'] = "user/register";
            $page_data['asset_page'] = "register";
            $page_data['page_title'] = translate('registration');
            if ($para2 == 'modal') {
                $this->load->view('front/user/register/index', $page_data);
            } else {
                $this->load->view('front/user_register', $page_data);
            }
        }
    }

    /* FUNCTION: Logout set */
    function logout()
    {
        session_destroy();
        custom_redirect(base_url() . 'home/logged_out');
    }

    /* FUNCTION: Logout */
    function logged_out()
    {
        $this->session->set_flashdata('alert', 'successful_signout');
        custom_redirect(base_url());
    }

    /* FUNCTION: Check if Email user exists */
    function exists()
    {
        $email = $this->input->post('email');
        $user = $this->db->get('user')->result_array();
        $exists = 'no';
        foreach ($user as $row) {
            if ($row['email'] == $email) {
                $exists = 'yes';
            }
        }
        echo $exists;
    }

    function email()
    {
        $page_data['page_title'] = 'Email';
        $page_data['email_body'] = $this->load->view('front/user/email');
        $page_data['to'] = 'nk7162390@gmail.com';
        $page_data['from'] = 'info@markethubland.com';
        $this->email_model->emails($email_body, $to, $from);
        // var_dump($page_data);
    }

    /* FUNCTION: Newsletter Subscription */
    function subscribe()
    {
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $row) {
            if (preg_match('/[\'^":()}{#~><>|=+¬]/', $row, $match)) {
                $safe = 'no';
                $char = $match[0];
            }
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            if ($safe == 'yes') {
                $subscribe_num = $this->session->userdata('subscriber');
                $email = $this->input->post('email');
                $subscriber = $this->db->get('subscribe')->result_array();
                $exists = 'no';
                foreach ($subscriber as $row) {
                    if ($row['email'] == $email) {
                        $exists = 'yes';
                    }
                }
                if ($exists == 'yes') {
                    echo 'already';
                } else if ($subscribe_num >= 3) {
                    echo 'already_session';
                } else if ($exists == 'no') {
                    $subscribe_num = $subscribe_num + 1;
                    $this->session->set_userdata('subscriber', $subscribe_num);
                    $data['email'] = $email;
                    $this->db->insert('subscribe', $data);
                    echo 'done';
                }
            } else {
                echo 'Disallowed charecter : " ' . $char . ' " in the POST';
            }
        }
    }

    /* FUNCTION: Customer Registration*/
    function registration($para1 = "", $para2 = "")
    {
        $safe = 'yes';
        $char = '';
        foreach ($_POST as $k => $row) {
            if (preg_match('/[\'^":()}{#~><>|=¬]/', $row, $match)) {
                if ($k !== 'password1' && $k !== 'password2') {
                    $safe = 'no';
                    $char = $match[0];
                }
            }
        }
        if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
            $this->load->library('recaptcha');
        }
        $this->load->library('form_validation');
        $page_data['page_name'] = "registration";
        if ($para1 == "add_info") {
            $msg = '';
            $this->form_validation->set_rules('username', 'First Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|is_unique[user.email]|valid_email', array('required' => 'You have not provided %s.', 'is_unique' => 'This %s already exists.'));
            $this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'required');
            $this->form_validation->set_rules('address1', 'Address Line 1', 'required');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('surname', 'Last Name', 'required');
            $this->form_validation->set_rules('zip', 'ZIP', 'required');
            $this->form_validation->set_rules('city', 'City', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            // $this->form_validation->set_rules('country', 'Country', 'required');
            // $this->form_validation->set_rules('terms_check', 'Terms & Conditions', 'required', array('required' => translate('you_must_agree_with_terms_&_conditions')));
            // if ($this->input->post('affiliate') == 'yes') {
            //     $this->form_validation->set_rules('affiliate_terms_check', 'Affiliates Terms & Conditions', 'required', array('required' => translate('you_must_agree_with_affiliates_terms_of_use')));
            // }
            if ($this->form_validation->run() == FALSE) {
                 $this->session->set_flashdata('message', validation_errors());
                 $this->login_set('registration');
                // redirect($_SERVER['HTTP_REFERER'], 'refresh');
                // echo validation_errors();
            } else {
                // die('nimra');
                if (true) {
                    
                    //
                    if ($this->crud_model->get_settings_value('general_settings', 'captcha_status', 'value') == 'ok') {
                        $captcha_answer = $this->input->post('g-recaptcha-response');
                        $response = $this->recaptcha->verifyResponse($captcha_answer);

                        if (true) {
                            $data['username'] = $this->input->post('username');
                            $data['email'] = $this->input->post('email');
                            $data['address1'] = $this->input->post('address1');
                            $data['address2'] = $this->input->post('address2');
                            $data['phone'] = $this->input->post('phone');
                            $data['surname'] = $this->input->post('surname');
                            $data['zip'] = $this->input->post('zip');
                            $data['city'] = $this->input->post('city');
                            $data['state'] = $this->input->post('state');
                            $data['country'] = $this->input->post('country');
                            $data['langlat'] = '';
                            $data['wishlist'] = '[]';
                            $data['package_info'] = '[]';
                            $data['product_upload'] = $this->db->get_where('package', array('package_id' => 1))->row()->upload_amount;
                            $data['creation_date'] = time();
                            // print_r($data);
                            // die();

                            if ($this->input->post('password1') == $this->input->post('password2')) {
                                $password = $this->input->post('password1');
                                $data['password'] = sha1($password);
                                $this->db->insert('user', $data);
                                $msg = 'done';
                                // if ($this->email_model->account_opening('user', $data['email'], $password) == false) {
                                //     $msg = 'done_but_not_sent';
                                // } else {
                                //     $msg = 'done_and_sent';
                                // }
                             $this->session->set_flashdata('message', 'Registeration Successfull!');
                                        // redirect($_SERVER['HTTP_REFERER'], 'refresh');
                                        // here on line6318
                                    } else {
                                        $this->session->set_flashdata('message', 'Registeration Failed');
                                        // redirect($_SERVER['HTTP_REFERER'], 'refresh');
                                           $this->login_set('registration');
                                    }
                            echo $msg;
                        } else {
                            echo translate('please_fill_the_captcha');
                        }
                    } else {
                        // die('nimra');
                        $data['username'] = $this->input->post('username');
                        $data['email'] = $this->input->post('email');
                        $data['address1'] = $this->input->post('address1');
                        $data['address2'] = $this->input->post('address2');
                        $data['phone'] = $this->input->post('phone');
                        $data['surname'] = $this->input->post('surname');
                        $data['zip'] = $this->input->post('zip');
                        $data['city'] = $this->input->post('city');
                        $data['state'] = $this->input->post('state');
                        $data['country'] = $this->input->post('country');
                        // $data['add_affilite'] = $this->input->post('affiliate');
                        $data['TOC'] = $this->input->post('terms_check');
                        if ($this->input->post('affiliate') == 'yes') {
                            $data['aff_TOC'] = $this->input->post('affiliate_terms_check');
                        }
                        $data['langlat'] = '';
                        $data['wishlist'] = '[]';
                        $data['package_info'] = '[]';
                        $data['product_upload'] = $this->db->get_where('package', array('package_id' => 1))->row()->upload_amount;
                        $data['creation_date'] = time();
                        

                        if ($this->input->post('password1') == $this->input->post('password2')) {
                                $password = $this->input->post('password1');
                                $data['password'] = sha1($password);
                                $this->load->database();
                                $insert = $this->db->insert('user', $data);
                                $str = $this->db->last_query();
                                
                                // $msg = 'done';
                                // if ($this->email_model->account_opening('user', $data['email'], $password) == false) {
                                //     $msg = 'done_but_not_sent';
                                // } else {
                                //     $msg = 'done_and_sent';
                                // }
                             $this->session->set_flashdata('smessage', 'Registeration Successfull!');
                                        // redirect($_SERVER['HTTP_REFERER'], 'refresh');
                                        // here on line 6367
                                        custom_redirect($_SERVER['HTTP_REFERER']);
                                    } else {
                                        $this->session->set_flashdata('message', 'Registeration Failed');
                                        // redirect($_SERVER['HTTP_REFERER'], 'refresh');
                                           $this->login_set('registration');
                                    }
                        echo $msg;
                    }
                } else {
                    echo 'Disallowed charecter : " ' . $char . ' " in the POST';
                }
            }
        } else if ($para1 == "update_info") {
            $id = $this->session->userdata('user_id');
            $data['username'] = $this->input->post('username');
            $data['surname'] = $this->input->post('surname');
            $data['address1'] = $this->input->post('address1');
            $data['address2'] = $this->input->post('address2');
            $data['phone'] = $this->input->post('phone');
            $data['city'] = $this->input->post('city');
            $data['state'] = $this->input->post('state');
            $data['country'] = $this->input->post('country');
            $data['skype'] = $this->input->post('skype');
            $data['google_plus'] = $this->input->post('google_plus');
            $data['facebook'] = $this->input->post('facebook');
            $data['zip'] = $this->input->post('zip');

            $this->db->where('user_id', $id);
            $this->db->update('user', $data);
            echo "done";
        } else if ($para1 == "update_password") {
            $user_data['password'] = $this->input->post('password');
            $account_data = $this->db->get_where('user', array(
                'user_id' => $this->session->userdata('user_id')
            ))->result_array();
            foreach ($account_data as $row) {
                if (sha1($user_data['password']) == $row['password']) {
                    if ($this->input->post('password1') == $this->input->post('password2')) {
                        $data['password'] = sha1($this->input->post('password1'));
                        $this->db->where('user_id', $this->session->userdata('user_id'));
                        $this->db->update('user', $data);
                        echo "done";
                    } else {
                        echo translate('passwords_did_not_match!');
                    }
                } else {
                    echo translate('wrong_old_password!');
                }
            }

        } else if ($para1 == "change_picture") {
            $id = $this->session->userdata('user_id');
            if (!demo()) {
                $this->crud_model->file_up('img', 'user', $id, '', '', '.jpg');
            }
            echo 'done';
        } else {
            $this->load->view('front/registration', $page_data);
        }
    }

    function error()
    {
        echo $this->load->view('front/others/404_error', array(), true);
    }


    /* FUNCTION: Product rating*/
    function rating($product_id, $rating)
    {
        if ($this->session->userdata('user_login') != "yes") {
            redirect(base_url() . 'home/login/', 'refresh');
        }
        if ($rating <= 5) {
            if ($this->crud_model->set_rating($product_id, $rating) == 'yes') {
                echo 'success';
            } else if ($this->crud_model->set_rating($product_id, $rating) == 'no') {
                echo 'already';
            }
        } else {
            echo 'failure';
        }
    }

    //get vendotr addresss object
    function get_rate_object($pid, $from, $to)
    {
        $length = 20;
        $width = 20;
        $height = 20;
        $distance_unit = 'in';
        $weight = 1;
        $mass_unit = 'kg';
        $vproduct = $this->db->where('product_id', $pid)->get('product')->row();
        if (isset($vproduct->warehouse_id) && $vproduct->warehouse_id) {
            $address = $this->db->where('address_id', $vproduct->warehouse_id)->get('address')->row();
            if ($address) {
                $from = $address->shippo_id;
            }
            // $from = $this->get_shippo_rate($vendor->name,$vendor->vendor_id,$vendor->city,$vendor->address1,$vendor->email,$vendor->phone,$vendor->zip);


            if ($aproduct->weight) {
                $weight = $aproduct->weight;
            }
            if ($aproduct->height) {
                $height = $aproduct->height;
            }
            if ($aproduct->width) {
                $width = $aproduct->width;
                $length = $aproduct->width;
            }
            $param = array(
                'address_from' => $from,
                'address_to' => $to,
                'parcels' =>
                    array(
                        0 =>
                            array(
                                'length' => $length,
                                'width' => $width,
                                'height' => $height,
                                'distance_unit' => $distance_unit,
                                'weight' => $weight,
                                'mass_unit' => $mass_unit,
                            ),
                    ),
                'async' => false,
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.goshippo.com/shipments/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($param),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ShippoToken ' . $this->config->item('shippo_token'),
                    'Content-Type: application/json',
                    'Cookie: tracker_sessionid=ce5dac7ad8964de99e65e9e24ab2f10c'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response, true);
            if (isset($response['rates'])) {

                return $response['rates'];
            } else {
                return false;
            }
        }
    }

    function send_shipping($sale_id)
    {
        $rows = $this->crud_model->get_type_name_by_id('sale', $sale_id, 'product_details');
        // var_dump($rows);
        $rows = json_decode($rows, true);
        foreach ($rows as $k => $v) {
            $sing = $this->db->where('id', $v['shippoo_info'])->get('ship_method')->row();
            // var_dump($sing);
            // var_dump($v);
            // die('OK61');
            $fields = array(
                'rate' => $sing->object_id,
                'label_file_type' => 'PDF',
                'async' => 'true',
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.goshippo.com/transactions",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($fields),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ShippoToken ' . $this->config->item('shippo_token'),
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded",
                    "postman-token: 89a980c7-e44a-08ab-ff3d-2834d08950d4"
                ),
            ));
            $response = curl_exec($curl);
            $response = json_decode($response, true);
            $r = $this->get_track($response['object_id']);
            // if there is no tracing number try again once
            if (empty($r['tracking_number'])) {
                $r = $this->get_track($response['object_id']);
            }
            $track = !empty($r['tracking_number']) ? $r['tracking_number'] : '';
            $up = array('raw_book' => json_encode($r), 'track' => $track);
            $this->db->where('id', $v['shippoo_info'])->update('ship_method', $up);

            $err = curl_error($curl);

            curl_close($curl);
        }
    }

    public function get_track($id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.goshippo.com/transactions/" . $id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Authorization: ShippoToken ' . $this->config->item('shippo_token'),
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
                "postman-token: 89a980c7-e44a-08ab-ff3d-2834d08950d4"
            ),
        ));

        $response = curl_exec($curl);
        return $response = json_decode($response, true);
    }

    function get_shippo_rate($fname, $lname, $country, $state, $city, $address1, $email, $phone, $zip = '')
    {
        //curl request here
        $country = $this->db->where('countries_id', $country)->get('countries')->row();
        $country_ios = '';
        if (!empty($country)) {
            $country_ios = $country->iso2;
        }
        $curl = curl_init();
        $param = array(
            'name' => $fname . ' ' . $lname,
            'company' => 'comunity hub land',
            'street1' => $address1,
            'city' => $city,
            'state' => $state,
            'zip' => $zip,
            'country' => $country_ios,
            'email' => $email,
            'phone' => $phone,
            'validate' => true,
        );
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.goshippo.com/addresses/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($param),
            CURLOPT_HTTPHEADER => array(
                'Authorization: ShippoToken ' . $this->config->item('shippo_token'),
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: tracker_sessionid=5517763ce0cc48cf8999c125bad280ea'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $obj = json_decode($response);
        if (isset($obj->object_id) && $obj->object_id && $obj->is_complete) {
            return $obj->object_id;
        } else {
            // var_dump($param);
            return $obj;
        }

        return false;
    }

    function vendor_addresss_object($vid)
    {
        $row = $this->db->where('vendor_id', $vid)->get('vendor')->row();
        if (empty($row)) {
            return false;
        }
        if ($row->shipoo_object) {
            return $row->shipoo_object;
        } else {
            //curl request here
            $country = $this->db->where('countries_id', $row->country)->get('countries')->row();
            $city = '';
            $state = '';
            $city = '';
            $country_ios = '';
            if (!empty($country)) {
                $country_ios = $country->iso2;
            }
            $curl = curl_init();
            $param = array(
                'name' => $row->name,
                'company' => $row->company,
                'street1' => $row->address1,
                // 'city' => $city,
                // 'state' => $state,
                'zip' => $row->zip,
                'country' => $country_ios,
                'email' => $row->email,
                'phone' => $row->phone,
                'validate' => true,
            );
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.goshippo.com/addresses/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => http_build_query($param),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ShippoToken ' . $this->config->item('shippo_token'),
                    'Content-Type: application/x-www-form-urlencoded',
                    'Cookie: tracker_sessionid=5517763ce0cc48cf8999c125bad280ea'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $obj = json_decode($response);
            if (isset($obj->object_id) && $obj->object_id) {
                $this->db->where('vendor_id', $vid)->update('vendor', array('shipoo_object' => $obj->object_id));
                return $obj->object_id;
            }
        }
        return false;
    }

    /* FUNCTION: Concerning Compare*/
    function compare($para1 = "", $para2 = "")
    {
        if ($para1 == 'add') {
            $this->crud_model->add_compare($para2);
        } else if ($para1 == 'remove') {
            $this->crud_model->remove_compare($para2);
        } else if ($para1 == 'num') {
            echo $this->crud_model->compared_num();
        } else if ($para1 == 'clear') {
            $this->session->set_userdata('compare', '');
            redirect(base_url() . 'home', 'refresh');
        } else if ($para1 == 'get_detail') {
            $product = $this->db->get_where('product', array('product_id' => $para2));
            $return = array();
            $return += array('image' => '<img src="' . $this->crud_model->file_view('product', $para2, '', '', 'thumb', 'src', 'multi', 'one') . '" width="100" />');
            $return += array('price' => currency() . $product->row()->sale_price);
            $return += array('description' => $product->row()->description);
            if ($product->row()->brand) {
                $return += array('brand' => $this->db->get_where('brand', array('brand_id' => $product->row()->brand))->row()->name);
            }
            if ($product->row()->sub_category) {
                $return += array('sub' => $this->db->get_where('sub_category', array('sub_category_id' => $product->row()->sub_category))->row()->sub_category_name);
            }
            echo json_encode($return);
        } else {
            if ($this->session->userdata('compare') == '[]') {
                redirect(base_url() . 'home/', 'refresh');
            }
            $page_data['page_name'] = "others/compare";
            $page_data['asset_page'] = "compare";
            $page_data['page_title'] = 'compare';
            $this->load->view('front/index', $page_data);
        }

    }

    function add_m()
    {
        //$this->wallet_model->add_user_balance(20);
    }

    function vendor_sort($arr)
    {
        $size = count($arr) - 1;
        for ($i = 0; $i < $size; $i++) {
            for ($j = 0; $j < $size - $i; $j++) {
                $k = $j + 1;
                if ($arr[$k]->price < $arr[$j]->price) {
                    // Swap elements at indices: $j, $k
                    list($arr[$j], $arr[$k]) = array($arr[$k], $arr[$j]);
                }
            }
        }
        return $arr;
    }

    function variation()
    {
        $pdata = array();
        if (isset($_GET['product_id'])) {
            $attribute = array();
            if (isset($_GET['attribute'])) {
                $attribute = $_GET['attribute'];
            }
            foreach ($attribute as $k => $v) {
                if (empty($v)) {
                    unset($attribute[$k]);
                }
            }
            $para1 = $_GET['product_id'];
            $vendors = array();
            /*$vendors[] = $this->db->get_where('product', array('product_id' => $para1, 'status' => 'ok'))->row();*/
            $vlists = $this->db->get_where('product', array('parent_id' => $para1, 'status' => 'ok'))->result();
            foreach ($vlists as $k => $v) {

                $vendors[] = $v;
            }
            $ava = array();
            if (empty($attribute)) {
                foreach ($vendors as $k => $v) {
                    $child = array();
                    $child[] = $v->product_id;

                    $all_rates = $this->db->where('rate >', 0)->where_in('product', $child)->get('stock')->result_array();
                    $gmin = 0;
                    $gmax = 0;
                    foreach ($all_rates as $kK => $vv) {
                        if ($kK == 0) {
                            $v->stock_id = $vv['stock_id'];
                            $v->price = $vv['rate'];
                        }
                        if ($gmin > $vv['rate']) {
                            $v->stock_id = $vv['stock_id'];
                            $v->price = $vv['rate'];
                        }
                        if ($gmax < $vv['rate']) {
                            $gmax = $vv['rate'];
                        }
                    }
                    $ava[] = $v;
                }//vendors
            }

            foreach ($vendors as $k => $v) {

                $pid = $v->product_id;
                $nattr = $this->convert_value($pid, $attribute);
                $stks = $this->db->where('product', $pid)->get('stock')->result();
                $is_ok = 0;
                $stock = 0;
                $price = $v->sale_price;
                foreach ($stks as $sk => $sv) {
                    $st_arr = explode(',', $sv->attribute);
                    $sattr = $this->convert_value($pid, $st_arr);
                    $inter = array_intersect($sattr, $nattr);
                    if (count($inter) == count($attribute) && $is_ok == 0) {
                        $is_ok = $sv->stock_id;
                        $price = $sv->rate;
                        $stock = $sv->quantity;
                    }
                }
                if ($is_ok && $stock) {
                    $v->stock_id = $is_ok;
                    $v->price = $price;
                    $ava[] = $v;
                }
            }

            $pdata['vendors'] = $this->vendor_sort($ava);
        }//if product exist
        if (isset($pdata['vendors']) && $pdata['vendors']) {
            $this->load->view('front/product_view/other/page_view/vendors', $pdata);
        } else {
            echo "No product avalible";
        }

    }//function end

    function convert_value($pid, $attr)
    {
        $av = array();
        foreach ($attr as $k => $v) {
            $row = $this->db->where('id', $v)->get('attribute_to_values')->row();
            $av[] = $row->value;
        }
        return $av;
    }

    function cancel_order()
    {
        $this->session->set_userdata('sale_id', '');
        $this->session->set_userdata('couponer', '');
        $this->cart->destroy();
        redirect(base_url(), 'refresh');
    }

    /* FUNCTION: Concering Add, Remove and Updating Cart Items*/
    function cart($para1 = '', $para2 = '', $para3 = '', $para4 = '')
    {
        $this->cart->product_name_rules = '[:print:]';
        if ($para1 == "add") {
            $qty = $this->input->post('qty');
            $color = $this->input->post('color');
            $option = array('color' => array('title' => 'Color', 'value' => $color));
            $all_op = json_decode($this->crud_model->get_type_name_by_id('product', $para2, 'options'), true);
            if ($all_op) {
                foreach ($all_op as $ro) {
                    $name = 'choice_' . $ro['no'];
                    $title = $ro['title'];
                    $option[$name] = array('title' => $title, 'value' => $this->input->post($name));
                }
            }

            if ($para3 == 'pp') {
                $carted = $this->cart->contents();
                foreach ($carted as $items) {
                    if ($items['id'] == $para2) {
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => 0
                        );
                    } else {
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => $items['qty']
                        );
                    }
                    $this->cart->update($data);
                }
            }
            $img = $this->crud_model->file_view('product', $product_id, '', '', 'thumb', 'src', 'multi', 'one');
            $comp_cover = $this->crud_model->get_type_name_by_id('product', $para2, 'comp_cover');
            if ($comp_cover) {
                $img = $this->crud_model->get_img($comp_cover);
                if (isset($img->secure_url)) {
                    $img = $img->secure_url;
                }

            }

            $data = array(
                'id' => $para2,
                'qty' => $qty,
                'option' => json_encode($option),
                'price' => $this->crud_model->get_product_price($para2),
                'name' => $this->crud_model->get_type_name_by_id('product', $para2, 'title'),
                'shipping' => $this->crud_model->get_shipping_cost($para2),
                'tax' => $this->crud_model->get_product_tax($para2),
                'image' => $img,
                'coupon' => ''
            );

            $stock = $this->crud_model->get_type_name_by_id('product', $para2, 'current_stock');

            if (!$this->crud_model->is_added_to_cart($para2) || $para3 == 'pp') {
                if (true) {//here can asdd stock check
                    $this->cart->insert($data);
                    echo 'added';
                } else {
                    echo 'shortage';
                }
                 if (true) {
                    $this->cart->insert($data);
                    $html = 'Item add tio cart successfully! click here to <a href="'.base_url('home/cart_checkout').'">View cart</a>';
                    if($this->input->post('type'))
                    {
                        $this->session->set_flashdata('message', $html);
                        redirect($_SERVER['HTTP_REFERER'], 'refresh');
                    }
                    else
                    {
                    redirect(base_url('home/cart_checkout'), 'refresh');

                    }
                        // $page_data['page_name'] = "cart";
                        // $page_data['page_title'] ="Shopping Cart";
                        //  $this->load->view('front/index', $page_data);

                } else {
                    $this->session->set_flashdata('message', 'Please Try Again!');
                        redirect($_SERVER['HTTP_REFERER'], 'refresh');
                }
            } else {
                echo 'already';
            }
            //var_dump($this->cart->contents());
        }

        if ($para1 == "added_list") {
            $page_data['carted'] = $this->cart->contents();
            $this->load->view('front/added_list', $page_data);
        }

        if ($para1 == "empty") {
            $this->cart->destroy();
            $this->session->set_userdata('couponer', '');
        }

        if ($para1 == "quantity_update") {

            $carted = $this->cart->contents();
            foreach ($carted as $items) {
                if ($items['rowid'] == $para2) {
                    $product = $items['id'];
                }
            }
            $current_quantity = $this->crud_model->get_type_name_by_id('product', $product, 'current_stock');
            $msg = 'not_limit';

            foreach ($carted as $items) {
                if ($items['rowid'] == $para2) {
                    if ($current_quantity >= $para3) {
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => $para3
                        );
                    } else {
                        $msg = $current_quantity;
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => $current_quantity
                        );
                    }
                } else {
                    $data = array(
                        'rowid' => $items['rowid'],
                        'qty' => $items['qty']
                    );
                }
                $this->cart->update($data);
            }
            $return = '';
            $carted = $this->cart->contents();
            foreach ($carted as $items) {
                if ($items['rowid'] == $para2) {
                    $return = currency($items['subtotal']);
                }
            }
            $return .= '---' . $msg;
            echo $return;
        }

        if ($para1 == "remove_one") {
            $carted = $this->cart->contents();
            foreach ($carted as $items) {
                if ($items['rowid'] == $para2) {
                    $data = array(
                        'rowid' => $items['rowid'],
                        'qty' => 0
                    );
                } else {
                    $data = array(
                        'rowid' => $items['rowid'],
                        'qty' => $items['qty']
                    );
                }
                $this->cart->update($data);
            }

            $carted = $this->cart->contents();
            echo count($carted);
            if (count($carted) == 0) {
                $this->cart('empty');
            }
        }


        if ($para1 == "whole_list") {
            echo json_encode($this->cart->contents());
        }

        if ($para1 == 'calcs') {
            $total = $this->cart->total();
            if ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'product_wise') {
                $shipping = $this->crud_model->cart_total_it('shipping');
            } elseif ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'fixed') {
                $shipping = $this->crud_model->get_type_name_by_id('business_settings', '2', 'value');
            }
            $tax = $this->crud_model->cart_total_it('tax');
            $grand = $total + $shipping + $tax;
            if ($para2 == 'full') {
                $ship = $shipping;
                $count = count($this->cart->contents());

                if ($total == '') {
                    $total = 0;
                }
                if ($ship == '') {
                    $ship = 0;
                }
                if ($tax == '') {
                    $tax = 0;
                }
                if ($grand == '') {
                    $grand = 0;
                }

                $total = currency($total);
                $ship = currency($ship);
                $tax = currency($tax);
                $grand = currency($grand);

                echo $total . '-' . $ship . '-' . $tax . '-' . $grand . '-' . $count;
            }

            if ($para2 == 'prices') {
                $carted = $this->cart->contents();
                $return = array();
                foreach ($carted as $row) {
                    $return[] = array('id' => $row['rowid'], 'price' => currency($row['price']), 'subtotal' => currency($row['subtotal']));
                }
                echo json_encode($return);
            }
        }

    }

    /* FUNCTION: Concering Add, Remove and Updating Cart Items*/
    function cart1($para1 = '', $para2 = '', $para3 = '', $para4 = '')
    {
        $this->cart->product_name_rules = '[:print:]';
        if ($para1 == "add") {
            $qty = $this->input->post('qty');
            $color = $this->input->post('color');
            $option = array('color' => array('title' => 'Color', 'value' => $color));
            $all_op = json_decode($this->crud_model->get_type_name_by_id('product', $para2, 'options'), true);
            if ($all_op) {
                foreach ($all_op as $ro) {
                    $name = $ro['name'];
                    $title = $ro['title'];
                    $option[$name] = array('title' => $title, 'value' => $this->input->post($name));
                }
            }

            if ($para3 == 'pp') {
                $carted = $this->cart->contents();
                foreach ($carted as $items) {
                    if ($items['id'] == $para2) {
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => 0
                        );
                    } else {
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => $items['qty']
                        );
                    }
                    $this->cart->update($data);
                }
            }

            $data = array(
                'id' => $para2,
                'qty' => $qty,
                'option' => json_encode($option),
                'price' => $this->crud_model->get_product_price($para2),
                'name' => $this->crud_model->get_type_name_by_id('product', $para2, 'title'),
                'shipping' => $this->crud_model->get_shipping_cost($para2),
                'tax' => $this->crud_model->get_product_tax($para2),
                'image' => $this->crud_model->file_view('product', $para2, '', '', 'thumb', 'src', 'multi', 'one'),
                'coupon' => ''
            );

            $stock = $this->crud_model->get_type_name_by_id('product', $para2, 'current_stock');

            if (!$this->crud_model->is_added_to_cart($para2) || $para3 == 'pp') {
                if ($stock >= $qty || $this->crud_model->is_digital($para2)) {
                    $this->cart->insert($data);
                    echo 'added';
                } else {
                    echo 'shortage';
                }
            } else {
                echo 'already';
            }
            //var_dump($this->cart->contents());
        }

        if ($para1 == "added_list") {
            $page_data['carted'] = $this->cart->contents();
            $this->load->view('front/added_list', $page_data);
        }

        if ($para1 == "empty") {
            $this->cart->destroy();
            $this->session->set_userdata('couponer', '');
        }

        if ($para1 == "quantity_update") {

            $carted = $this->cart->contents();
            foreach ($carted as $items) {
                if ($items['rowid'] == $para2) {
                    $product = $items['id'];
                }
            }
            $current_quantity = $this->crud_model->get_type_name_by_id('product', $product, 'current_stock');
            $msg = 'not_limit';

            foreach ($carted as $items) {
                if ($items['rowid'] == $para2) {
                    if ($current_quantity >= $para3) {
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => $para3
                        );
                    } else {
                        $msg = $current_quantity;
                        $data = array(
                            'rowid' => $items['rowid'],
                            'qty' => $current_quantity
                        );
                    }
                } else {
                    $data = array(
                        'rowid' => $items['rowid'],
                        'qty' => $items['qty']
                    );
                }
                $this->cart->update($data);
            }
            $return = '';
            $carted = $this->cart->contents();
            foreach ($carted as $items) {
                if ($items['rowid'] == $para2) {
                    $return = currency($items['subtotal']);
                }
            }
            $return .= '---' . $msg;
            echo $return;
        }

        if ($para1 == "remove_one") {
            $carted = $this->cart->contents();
            foreach ($carted as $items) {
                if ($items['rowid'] == $para2) {
                    $data = array(
                        'rowid' => $items['rowid'],
                        'qty' => 0
                    );
                } else {
                    $data = array(
                        'rowid' => $items['rowid'],
                        'qty' => $items['qty']
                    );
                }
                $this->cart->update($data);
            }

            $carted = $this->cart->contents();
            echo count($carted);
            if (count($carted) == 0) {
                $this->cart('empty');
            }
        }


        if ($para1 == "whole_list") {
            echo json_encode($this->cart->contents());
        }

        if ($para1 == 'calcs') {
            $total = $this->cart->total();
            if ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'product_wise') {
                $shipping = $this->crud_model->cart_total_it('shipping');
            } elseif ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'fixed') {
                $shipping = $this->crud_model->get_type_name_by_id('business_settings', '2', 'value');
            }
            $tax = $this->crud_model->cart_total_it('tax');
            $grand = $total + $shipping + $tax;
            if ($para2 == 'full') {
                $ship = $shipping;
                $count = count($this->cart->contents());

                if ($total == '') {
                    $total = 0;
                }
                if ($ship == '') {
                    $ship = 0;
                }
                if ($tax == '') {
                    $tax = 0;
                }
                if ($grand == '') {
                    $grand = 0;
                }

                $total = currency($total);
                $ship = currency($ship);
                $tax = currency($tax);
                $grand = currency($grand);

                echo $total . '-' . $ship . '-' . $tax . '-' . $grand . '-' . $count;
            }

            if ($para2 == 'prices') {
                $carted = $this->cart->contents();
                $return = array();
                foreach ($carted as $row) {
                    $return[] = array('id' => $row['rowid'], 'price' => currency($row['price']), 'subtotal' => currency($row['subtotal']));
                }
                echo json_encode($return);
            }
        }

    }

    /* FUNCTION: Loads Cart Checkout Page*/
    function get_rate()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://free.currconv.com/api/v7/convert?q=USD_EUR&compact=ultra&apiKey=14b83c6698edf5b90ee4",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 30f71e99-6820-ec9c-647f-1b1f204cc0cd"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        $response = json_decode($response, true);

        curl_close($curl);

        return (isset($response['USD_EUR']) ? $response['USD_EUR'] : 0);
    }

    function cart_checkout($para1 = "")
    {

        $con_rate = $this->get_rate();//get rate of euro

        if ($para1 == "orders") {
            if (isset($_GET['r_id'])) {
                $r_id = $_GET['r_id'];

                /*--new logic---*/
                $carted = $this->cart->contents();
                
                foreach ($carted as $k => $v) {
                    $methods = $this->db->select('MIN(`amount`) as amount,id')->where('r_id', $r_id)->where('cart_key', $v['rowid'])->get('ship_method')->row();
                    if (isset($_SESSION['cart_contents'][$v['rowid']]['shipping']) && isset($methods->amount)) {
                        $_SESSION['cart_contents'][$v['rowid']]['shipping'] = ($methods->amount)?$methods->amount:0;
                        $_SESSION['cart_contents'][$v['rowid']]['shippoo_info'] = ($methods->id)?$methods->id:0;
                    }

                }
                /*--new logic---*/
                $methods = $this->db->where('r_id', $r_id)->distinct('slug')->get('ship_method')->result_array();
                foreach ($methods as $sk => $sv) {

                    $tot = 0;

                    foreach ($carted as $k => $v) {
                        if ($k == $sv['cart_key'] && $sv['slug'] == $method) {


                            $tot = $tot + $sv['amount'];
                            $eu_price = $sv['amount'] * $con_rate;
                            $v['shipping'] = $eu_price;

                            $in = array(
                                'cart_key' => $v['rowid'],
                                'from_address' => $v['address'],
                                'to_address' => $obj,
                                'rate_object' => $sv['object_id'],
                                'price' => $rate['amount'],
                                'eu_price' => $eu_price,
                                'raw_daata' => json_encode($sv)
                            );
                            $this->db->insert('shipoo_rates', $in);
                            $this->cart->update($v);
                            // var_dump($_SESSION);
                        }
                    }
                }
                $carted = $this->cart->contents();
            }
            $carted = $this->cart->contents();
            // var_dump($carted);
            echo $r = $this->load->view('front/shopping_cart/order_set', array(), true);
            exit();
        }
        if ($para1 == "cal_shipping") {
            $carted = $this->cart->contents();
            //
            $phyical = 0;
            foreach($carted as $k=> $v)
            {
                $pid = $v['id'];
                $Product_type = $this->crud_model->get_type_name_by_id('product', $pid, 'Product_type');
                if($Product_type == 'Physical' && !$phyical)
                {
                    $phyical = 1;
                }
            }
            if(!$phyical)
            {
                $ret = array(
                'status' => 1,
                'msg' => 'digital_order'
            );
            echo json_encode($ret);
            exit();
            }
            
            if (isset($_GET['firstname']) && isset($_GET['lastname']) && isset($_GET['address1']) && isset($_GET['email']) && isset($_GET['country']) && isset($_GET['phone']) && isset($_GET['city'])) {
                
                // $obj = $this->get_shippo_rate($_GET['firstname'],$_GET['lastname'],$_GET['country'],$_GET['address1'],$_GET['email'],$_GET['phone']);
                
                $obj = $this->get_shippo_rate($_GET['firstname'], $_GET['lastname'], $_GET['country'], $_GET['state'], $_GET['city'], $_GET['address1'], $_GET['email'], $_GET['phone'], $_GET['zip']);
                
                if (is_object($obj)) {
                    
                    
                    $obj = (array)$obj;
                    $msg = '';
                    foreach ($obj as $k => $v) {

                        if (isset($v[0]))
                            $msg = $msg . $v[0] . '<br>';
                        else
                            $msg = $msg . $v . '<br>';
                    }
                    $ret = array(
                        'status' => 0,
                        'msg' => $msg,
                        'obj' => $obj
                    );
                    echo json_encode($ret);
                    exit();

                }
                $r_id = time();
                $carted = $this->cart->contents();
                foreach ($carted as $k => $v) {
                    $rate = array();
                    if ($obj) {

                        $rate = $this->get_rate_object($v['id'], 0, $obj);
                    }
                    if (!$rate) {
                        $ret = array(
                            'status' => 0,
                            'msg' => 'Shippo did not support your diliver location please try annother address!',
                            'data' => $rate,
                            'address' => $obj
                        );
                        echo json_encode($ret);
                        exit();
                    }

                }

                $ship_id = 0;
                foreach ($rate as $rk => $rv) {
                    $wh = array(
                        'shipment_id' => $rv['carrier_account'],
                        'slug' => $rv['provider'],
                        'cart_key' => $v['rowid'],
                        'r_id' => $r_id,
                    );

                    $ship_method = $this->db->where($wh)->get('ship_method')->row();
                    // if($rk == 1)
                    // {
                    //     echo $ship_method->estimated_days.'>'.$rv['estimated_days'];
                    //     if($ship_method->estimated_days > $rv['estimated_days'])
                    //     {
                    //         echo "Here";
                    //     }
                    //     print_r($ship_method);
                    //     die("IJ");
                    // }
                    if ($ship_method) {
                        if ($ship_method->estimated_days > $rv['estimated_days']) {
                            $wh['estimated_days'] = $rv['estimated_days'];
                            $wh['amount'] = $rv['amount'];
                            $wh['object_id'] = $rv['object_id'];
                            $wh['name'] = isset($rv['servicelevel']['name']) ? $rv['servicelevel']['name'] : "";
                            $wh['logo'] = isset($rv['provider_image_200']) ? $rv['provider_image_200'] : "";
                            $ship_id = $ship_method->id;
                            $ship_method = $this->db->where('id', $ship_method->id)->update('ship_method', $wh);


                        }
                    } else {
                        $wh['object_id'] = $rv['object_id'];
                        $wh['estimated_days'] = $rv['estimated_days'];
                        $wh['amount'] = $rv['amount'];
                        $wh['name'] = isset($rv['servicelevel']['name']) ? $rv['servicelevel']['name'] : "";
                        $wh['logo'] = isset($rv['provider_image_200']) ? $rv['provider_image_200'] : "";
                        $ship_method = $this->db->insert('ship_method', $wh);
                        $ship_id = $this->db->insert_id();
                    }
                    //  $eu_price = $rate['amount'] * $con_rate ;
                    // $v['shipping'] = $eu_price;

                    // $in = array(
                    //     'cart_key' => $v['rowid'],
                    //     'from_address' => $v['address'],
                    //     'to_address' => $obj,
                    //     'rate_object' => $v['object_id'],
                    //     'price' => $rate['amount'],
                    //     'eu_price' => $eu_price,
                    //     'raw_daata' => json_encode($rate)
                    //     );
                    //     $r = $this->db->insert('shipoo_rates',$in);
                }
                $this->cart->update($v);
            }
            $con_rate = 1;
            $methods = $this->db->where('r_id', $r_id)->distinct('slug')->get('ship_method')->result_array();
            foreach ($methods as $sk => $sv) {
                $tot = 0;
                foreach ($carted as $k => $v) {
                    if ($k == $sv['cart_key']) {
                        $tot = $tot + $sv['amount'];
                    }
                }
                $methods[$sk]['price'] = round($tot * $con_rate, 2);
            }
            $data = array('methods' => $methods, 'r_id' => $r_id);
            $ret = array(
                'status' => 1,
                'msg' => $r_id
            );
            echo json_encode($ret);
            exit();

        } elseif ($para1 == "delivery_address") {
            $this->load->view('front/shopping_cart/delivery_address');
        } elseif ($para1 == "payments_options") {
            $this->load->view('front/shopping_cart/payments_options');
        } else {
            $page_data['logger'] = $para1;
            $page_data['page_name'] = "shopping_cart";
            $page_data['asset_page'] = "shopping_cart";
            $page_data['page_title'] = translate('my_cart');
            $page_data['carted'] = $this->cart->contents();
            // var_dump($page_data);
            $this->load->view('front/index_new', $page_data);
        }
    }


    /* FUNCTION: Loads Cart Checkout Page*/
    function coupon_check()
    {
        $para1 = $this->input->post('code');
        $carted = $this->cart->contents();
        if (count($carted) > 0) {
            $p = $this->session->userdata('coupon_apply') + 1;
            $this->session->set_userdata('coupon_apply', $p);
            $p = $this->session->userdata('coupon_apply');
            if ($p < 10) {
                $c = $this->db->get_where('coupon', array('code' => $para1));
                $coupon = $c->result_array();
                //echo $c->num_rows();
                //,'till <= '=>date('Y-m-d')
                if ($c->num_rows() > 0) {
                    foreach ($coupon as $row) {
                        $spec = json_decode($row['spec'], true);
                        $coupon_id = $row['coupon_id'];
                        $till = strtotime($row['till']);
                    }
                    if ($till > time()) {
                        $ro = $spec;
                        $type = $ro['discount_type'];
                        $value = $ro['discount_value'];
                        $set_type = $ro['set_type'];
                        $set = json_decode($ro['set']);
                        if ($set_type !== 'total_amount') {
                            $dis_pro = array();
                            $set_ra = array();
                            if ($set_type == 'all_products') {
                                $set_ra[] = $this->db->get('product')->result_array();
                            } else {
                                foreach ($set as $p) {
                                    if ($set_type == 'product') {
                                        $set_ra[] = $this->db->get_where('product', array('product_id' => $p))->result_array();
                                    } else {
                                        $set_ra[] = $this->db->get_where('product', array($set_type => $p))->result_array();
                                    }
                                }
                            }
                            foreach ($set_ra as $set) {
                                foreach ($set as $n) {
                                    $dis_pro[] = $n['product_id'];
                                }
                            }
                            foreach ($carted as $items) {
                                if (in_array($items['id'], $dis_pro)) {
                                    $base_price = $this->crud_model->get_product_price($items['id']);
                                    if ($type == 'percent') {
                                        $discount = $base_price * $value / 100;
                                    } else if ($type == 'amount') {
                                        $discount = $value;
                                    }
                                    $data = array(
                                        'rowid' => $items['rowid'],
                                        'price' => $base_price - $discount,
                                        'coupon' => $coupon_id
                                    );
                                } else {
                                    $data = array(
                                        'rowid' => $items['rowid'],
                                        'price' => $items['price'],
                                        'coupon' => $items['coupon']
                                    );
                                }
                                $this->cart->update($data);
                            }
                            echo 'wise:-:-:' . translate('coupon_discount_activated');
                        } else {
                            $this->cart->set_discount($value);
                            echo 'total:-:-:' . translate('coupon_discount_activated') . ':-:-:' . currency() . $value;
                        }
                        $this->cart->set_coupon($coupon_id);
                        $this->session->set_userdata('couponer', 'done');
                        $this->session->set_userdata('coupon_apply', 0);
                    } else {
                        echo 'nope';
                    }
                } else {
                    echo 'nope';
                }
            } else {
                echo 'Too many coupon request!';
            }
        }
    }


    /* FUNCTION: Finalising Purchase*/
    function cart_finish($para1 = "", $para2 = "")
    {

        /*$carted = $this->cart->contents();
        if (count($carted) <= 0) {
            redirect(base_url() . 'home/', 'refresh');
        }*/


        $carted = $this->cart->contents();
        $total = $this->cart->total();
        $exchange = exchange('usd');
        $vat_per = '';
        $vat = $this->crud_model->cart_total_it('tax');
        if ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'product_wise') {
            $shipping = $this->crud_model->cart_total_it('shipping');
        } else {
            $shipping = $this->crud_model->get_type_name_by_id('business_settings', '2', 'value');
        }
        $grand_total = $total + $vat + $shipping;
        $product_details = json_encode($carted);

        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('user', array(
            'langlat' => $this->input->post('langlat')
        ));

        if ($this->input->post('payment_type') == 'paypal') {
            if ($para1 == 'go') {


                $data['product_details'] = $product_details;
                $data['shipping_address'] = json_encode($_POST);
                $data['vat'] = $vat;
                $data['vat_percent'] = $vat_per;
                $data['shipping'] = $shipping;
                $data['delivery_status'] = '[]';
                $data['payment_type'] = $para1;
                $data['payment_status'] = '[]';
                $data['payment_details'] = 'none';
                $data['grand_total'] = $grand_total;
                $data['sale_datetime'] = time();
                $data['delivary_datetime'] = '';
                $paypal_email = $this->crud_model->get_type_name_by_id('business_settings', '1', 'value');

                $this->db->insert('sale', $data);
                $sale_id = $this->db->insert_id();

                if ($this->session->userdata('user_login') == 'yes') {
                    $data['buyer'] = $this->session->userdata('user_id');
                } else {
                    $data['buyer'] = "guest";
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $data['guest_id'] = $sale_id . '-' . $randomString;
                }


                $vendors = $this->crud_model->vendors_in_sale($sale_id);
                $delivery_status = array();
                $payment_status = array();
                foreach ($vendors as $p) {
                    $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('vendor' => $p, 'status' => 'due');
                }
                if ($this->crud_model->is_admin_in_sale($sale_id)) {
                    $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('admin' => '', 'status' => 'due');
                }
                $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
                $data['delivery_status'] = json_encode($delivery_status);
                $data['payment_status'] = json_encode($payment_status);
                $this->db->where('sale_id', $sale_id);
                $this->db->update('sale', $data);


                $this->session->set_userdata('sale_id', $sale_id);

                /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                $this->paypal->add_field('rm', 2);
                $this->paypal->add_field('no_note', 0);
                $this->paypal->add_field('cmd', '_cart');
                $this->paypal->add_field('upload', '1');
                $i = 1;
                $exchange = 1;
                $signup_pkg = array();

                foreach ($carted as $val) {
                    $this->db->where('sale_id', $sale_id);
                    $this->db->delete('sale');
                    if ($val['signup_pkg']) {
                        $signup_pkg = $val;
                    }
                    $this->paypal->add_field('item_number_' . $i, $i);
                    $this->paypal->add_field('item_name_' . $i, $val['name']);
                    $this->paypal->add_field('amount_' . $i, $this->cart->format_number(($val['price'] / $exchange)));
                    $this->paypal->add_field('amount_' . $i, $val['price'] / $exchange);
                    if ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'product_wise') {
                        $this->paypal->add_field('shipping_' . $i, $this->cart->format_number((($val['shipping'] / $exchange) * $val['qty'])));
                        $this->paypal->add_field('shipping_' . $i, ($val['shipping'] / $exchange) * $val['qty']);
                    }
                    //$this->paypal->add_field('tax_' . $i, $this->cart->format_number(($val['tax'] / $exchange)));
                    $this->paypal->add_field('tax_' . $i, $val['tax'] / $exchange);
                    $this->paypal->add_field('quantity_' . $i, $val['qty']);
                    $i++;
                }
                if ($signup_pkg) {
                    $paypal_email = $this->db->get_where('business_settings', array('type' => 'paypal_email'))->row()->value;
                    $data = array();
                    $data['vendor'] = $signup_pkg['vendor'];
                    $data['amount'] = $signup_pkg['price'];
                    $data['status'] = 'due';
                    $data['method'] = 'paypal';
                    $data['membership'] = $signup_pkg['id'];
                    $data['timestamp'] = time();
                    $this->db->insert('membership_payment', $data);
                    $sale_id = 'memvership-' . $this->db->insert_id();
                }
                if ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'fixed') {
                    $this->paypal->add_field('shipping_1', $this->cart->format_number(($this->crud_model->get_type_name_by_id('business_settings', '2', 'value') / $exchange)));
                }
                // $this->paypal->add_field('amount', $grand_total);
                $this->paypal->add_field('currency_code', 'GBP');
                $this->paypal->add_field('custom', $sale_id);
                $this->paypal->add_field('invoice_id', $invoice_id);
                $this->paypal->add_field('business', $paypal_email);
                $this->paypal->add_field('notify_url', base_url() . 'home/paypal_ipn');
                $this->paypal->add_field('cancel_return', base_url() . 'home/paypal_cancel');
                $this->paypal->add_field('return', base_url() . 'home/paypal_success');
                // var_dump($this->paypal);die();
                $this->paypal->submit_paypal_post();
                exit();
                // die("Here-end");
                // submit the fields to paypal
            }
        } else if ($this->input->post('payment_type') == 'bitcoin') {
            if ($para1 == 'go') {

                $data['product_details'] = $product_details;
                $data['shipping_address'] = json_encode($_POST);
                $data['vat'] = $vat;
                $data['vat_percent'] = $vat_per;
                $data['shipping'] = $shipping;
                $data['delivery_status'] = '[]';
                $data['payment_type'] = $para1;
                $data['payment_status'] = '[]';
                $data['payment_details'] = 'none';
                $data['grand_total'] = $grand_total;
                $data['sale_datetime'] = time();
                $data['delivary_datetime'] = '';

                $this->db->insert('sale', $data);
                $sale_id = $this->db->insert_id();

                if ($this->session->userdata('user_login') == 'yes') {
                    $data['buyer'] = $this->session->userdata('user_id');
                } else {
                    $data['buyer'] = "guest";
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $data['guest_id'] = $sale_id . '-' . $randomString;
                }

                $vendors = $this->crud_model->vendors_in_sale($sale_id);
                $delivery_status = array();
                $payment_status = array();
                foreach ($vendors as $p) {
                    $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('vendor' => $p, 'status' => 'due');
                }
                if ($this->crud_model->is_admin_in_sale($sale_id)) {
                    $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('admin' => '', 'status' => 'due');
                }
                $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
                $data['delivery_status'] = json_encode($delivery_status);
                $data['payment_status'] = json_encode($payment_status);
                $this->db->where('sale_id', $sale_id);
                $this->db->update('sale', $data);

                $this->session->set_userdata('sale_id', $sale_id);

                $bitcoin_coinpayments_merchant = $this->db->get_where('business_settings', array('type' => 'bitcoin_coinpayments_merchant'))->row()->value;
                $exchange = exchange('usd');
                $final_amount = $grand_total / $exchange;

                /*echo "<pre>";
                print_r(compact('bitcoin_coinpayments_merchant','final_amount'));
                echo "</pre>";exit;*/

                echo $this->load->view('front/bitcoin_payment_view', compact('bitcoin_coinpayments_merchant', 'final_amount'), true);
                exit;
            }
        } else if ($this->input->post('payment_type') == 'c2') {
            if ($para1 == 'go') {

                $data['product_details'] = $product_details;
                $data['shipping_address'] = json_encode($_POST);
                $data['vat'] = $vat;
                $data['vat_percent'] = $vat_per;
                $data['shipping'] = $shipping;
                $data['delivery_status'] = '[]';
                $data['payment_type'] = $para1;
                $data['payment_status'] = '[]';
                $data['payment_details'] = 'none';
                $data['grand_total'] = $grand_total;
                $data['sale_datetime'] = time();
                $data['delivary_datetime'] = '';
                $c2_user = $this->db->get_where('business_settings', array('type' => 'c2_user'))->row()->value;
                $c2_secret = $this->db->get_where('business_settings', array('type' => 'c2_secret'))->row()->value;

                $this->db->insert('sale', $data);
                $sale_id = $this->db->insert_id();
                if ($this->session->userdata('user_login') == 'yes') {
                    $data['buyer'] = $this->session->userdata('user_id');
                } else {
                    $data['buyer'] = "guest";
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $data['guest_id'] = $sale_id . '-' . $randomString;
                }
                $vendors = $this->crud_model->vendors_in_sale($sale_id);
                $delivery_status = array();
                $payment_status = array();
                foreach ($vendors as $p) {
                    $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('vendor' => $p, 'status' => 'due');
                }
                if ($this->crud_model->is_admin_in_sale($sale_id)) {
                    $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('admin' => '', 'status' => 'due');
                }
                $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
                $data['delivery_status'] = json_encode($delivery_status);
                $data['payment_status'] = json_encode($payment_status);
                $this->db->where('sale_id', $sale_id);
                $this->db->update('sale', $data);

                $this->session->set_userdata('sale_id', $sale_id);

                $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
                $this->twocheckout_lib->add_field('sid', $this->twocheckout_lib->sid);              //Required - 2Checkout account number
                $this->twocheckout_lib->add_field('cart_order_id', $sale_id);   //Required - Cart ID

                $this->twocheckout_lib->add_field('total', $this->cart->format_number(($grand_total / $exchange)));

                $this->twocheckout_lib->add_field('x_receipt_link_url', base_url() . 'home/twocheckout_success');
                $this->twocheckout_lib->add_field('demo', $this->twocheckout_lib->demo);                    //Either Y or N


                $this->twocheckout_lib->submit_form();
                // submit the fields to paypal
            }
        } else if ($this->input->post('payment_type') == 'vp') {
            if ($para1 == 'go') {

                $data['product_details'] = $product_details;
                $data['shipping_address'] = json_encode($_POST);
                $data['vat'] = $vat;
                $data['vat_percent'] = $vat_per;
                $data['shipping'] = $shipping;
                $data['delivery_status'] = '[]';
                $data['payment_type'] = $para1;
                $data['payment_status'] = '[]';
                $data['payment_details'] = 'none';
                $data['grand_total'] = $grand_total;
                $data['sale_datetime'] = time();
                $data['delivary_datetime'] = '';
                //$vouguepay_id              = $this->crud_model->get_type_name_by_id('business_settings', '1', 'value');

                $this->db->insert('sale', $data);
                $sale_id = $this->db->insert_id();
                if ($this->session->userdata('user_login') == 'yes') {
                    $data['buyer'] = $this->session->userdata('user_id');
                } else {
                    $data['buyer'] = "guest";
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $data['guest_id'] = $sale_id . '-' . $randomString;
                }
                $vendors = $this->crud_model->vendors_in_sale($sale_id);
                $delivery_status = array();
                $payment_status = array();

                $system_title = $this->crud_model->get_settings_value('general_settings', 'system_title', 'value');
                $vouguepay_id = $this->crud_model->get_settings_value('business_settings', 'vp_merchant_id', 'value');
                $merchant_ref = $sale_id;


                foreach ($vendors as $p) {
                    $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('vendor' => $p, 'status' => 'due');
                }
                if ($this->crud_model->is_admin_in_sale($sale_id)) {
                    $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('admin' => '', 'status' => 'due');
                }
                $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
                $data['delivery_status'] = json_encode($delivery_status);
                $data['payment_status'] = json_encode($payment_status);
                $this->db->where('sale_id', $sale_id);
                $this->db->update('sale', $data);

                $this->session->set_userdata('sale_id', $sale_id);

                /****TRANSFERRING USER TO vouguepay TERMINAL****/
                $this->vouguepay->add_field('v_merchant_id', $vouguepay_id);
                $this->vouguepay->add_field('merchant_ref', $merchant_ref);
                $this->vouguepay->add_field('memo', 'Order from ' . $system_title);
                //$this->vouguepay->add_field('developer_code', $developer_code);
                //$this->vouguepay->add_field('store_id', $store_id);

                $i = 1;
                $tax = 0;
                $shipping = 0;
                $total = 0;

                $this->vouguepay->add_field('total', ($grand_total / $exchange));
                $this->vouguepay->add_field('cur', 'USD');
                $this->vouguepay->add_field('notify_url', base_url() . 'home/vouguepay_ipn');
                $this->vouguepay->add_field('fail_url', base_url() . 'home/vouguepay_cancel');
                $this->vouguepay->add_field('success_url', base_url() . 'home/vouguepay_success');

                $this->vouguepay->submit_vouguepay_post();
                // submit the fields to vouguepay
            }
        } else if ($this->input->post('payment_type') == 'cash_on_delivery') {
            if ($para1 == 'go') {

                $data['product_details'] = $product_details;
                $data['shipping_address'] = json_encode($_POST);
                $data['vat'] = $vat;
                $data['vat_percent'] = $vat_per;
                $data['shipping'] = $shipping;
                $data['delivery_status'] = '[]';
                $data['payment_type'] = 'cash_on_delivery';
                $data['payment_status'] = '[]';
                $data['payment_details'] = '';
                $data['grand_total'] = $grand_total;
                $data['sale_datetime'] = time();
                $data['delivary_datetime'] = '';

                $this->db->insert('sale', $data);
                $sale_id = $this->db->insert_id();
                

                //$this->send_shipping($sale_id);

                if ($this->session->userdata('user_login') == 'yes') {
                    $data['buyer'] = $this->session->userdata('user_id');
                } else {
                    $data['buyer'] = "guest";
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $data['guest_id'] = $sale_id . '-' . $randomString;
                }
                
                $vendors = $this->crud_model->vendors_in_sale($sale_id);
                $delivery_status = array();
                $payment_status = array();

                foreach ($vendors as $p) {
                    $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('vendor' => $p, 'status' => 'due');
                }
                if ($this->crud_model->is_admin_in_sale($sale_id)) {
                    $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('admin' => '', 'status' => 'due');
                }
                $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
                $data['delivery_status'] = json_encode($delivery_status);
                $data['payment_status'] = json_encode($payment_status);
                $this->db->where('sale_id', $sale_id);
                $this->db->update('sale', $data);
                $this->process_order($sale_id);
                $this->crud_model->process_affiliation($sale_id, false);
                

                foreach ($carted as $value) {
                    $this->crud_model->decrease_quantity($value['id'], $value['qty']);
                    $data1['type'] = 'destroy';
                    $data1['category'] = $this->db->get_where('product', array(
                        'product_id' => $value['id']
                    ))->row()->category;
                    $data1['sub_category'] = $this->db->get_where('product', array(
                        'product_id' => $value['id']
                    ))->row()->sub_category;
                    $data1['product'] = $value['id'];
                    $data1['quantity'] = $value['qty'];
                    $data1['total'] = 0;
                    $data1['reason_note'] = 'sale';
                    $data1['sale_id'] = $sale_id;
                    $data1['datetime'] = time();
                    $this->db->insert('stock', $data1);
                }

                // $this->crud_model->digital_to_customer($sale_id);
                $this->email_model->email_invoice($sale_id);
                

                // $this->cart->destroy();
                $this->session->set_userdata('couponer', '');
                //echo $sale_id;
                if ($this->session->userdata('user_login') == 'yes') {
                    custom_redirect(base_url() . 'home/invoice/' . $sale_id);
                } else {
                    custom_redirect(base_url() . 'home/guest_invoice/' . $data['guest_id']);
                }
            }
        } else if ($this->input->post('payment_type') == 'wallet') {
            $balance = $this->wallet_model->user_balance();
            if ($balance >= $grand_total) {
                if ($para1 == 'go') {
                    $data['buyer'] = $this->session->userdata('user_id');
                    $data['product_details'] = $product_details;
                    $data['shipping_address'] = json_encode($_POST);
                    $data['vat'] = $vat;
                    $data['vat_percent'] = $vat_per;
                    $data['shipping'] = $shipping;
                    $data['delivery_status'] = '[]';
                    $data['payment_type'] = 'wallet';
                    $data['payment_status'] = '[]';
                    $data['payment_details'] = '';
                    $data['grand_total'] = $grand_total;
                    $data['sale_datetime'] = time();
                    $data['delivary_datetime'] = '';

                    $this->db->insert('sale', $data);
                    $sale_id = $this->db->insert_id();
                    $vendors = $this->crud_model->vendors_in_sale($sale_id);
                    $delivery_status = array();
                    $payment_status = array();
                    foreach ($vendors as $p) {
                        $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'delivery_time' => '');
                        $payment_status[] = array('vendor' => $p, 'status' => 'paid');
                    }
                    if ($this->crud_model->is_admin_in_sale($sale_id)) {
                        $delivery_status[] = array('admin' => '', 'status' => 'pending', 'delivery_time' => '');
                        $payment_status[] = array('admin' => '', 'status' => 'paid');
                    }
                    $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
                    $data['delivery_status'] = json_encode($delivery_status);
                    $data['payment_status'] = json_encode($payment_status);
                    $this->db->where('sale_id', $sale_id);
                    $this->db->update('sale', $data);

                    foreach ($carted as $value) {
                        $this->crud_model->decrease_quantity($value['id'], $value['qty']);
                        $data1['type'] = 'destroy';
                        $data1['category'] = $this->db->get_where('product', array(
                            'product_id' => $value['id']
                        ))->row()->category;
                        $data1['sub_category'] = $this->db->get_where('product', array(
                            'product_id' => $value['id']
                        ))->row()->sub_category;
                        $data1['product'] = $value['id'];
                        $data1['quantity'] = $value['qty'];
                        $data1['total'] = 0;
                        $data1['reason_note'] = 'sale';
                        $data1['sale_id'] = $sale_id;
                        $data1['datetime'] = time();
                        $this->db->insert('stock', $data1);
                    }
                    $this->wallet_model->reduce_user_balance($grand_total, $this->session->userdata('user_id'));
                    $this->crud_model->digital_to_customer($sale_id);

                    $this->crud_model->email_invoice($sale_id);
                    $this->cart->destroy();
                    $this->session->set_userdata('couponer', '');
                    //echo $sale_id;
                    redirect(base_url() . 'home/invoice/' . $sale_id, 'refresh');
                }
            } else {
                redirect(base_url() . 'home/profile/part/wallet/', 'refresh');
            }
        } else if ($this->input->post('payment_type') == 'stripe') {
            if ($para1 == 'go') {
                if (isset($_POST['stripeToken'])) {

                    require_once(APPPATH . 'libraries/stripe-php/init.php');
                    $stripe_api_key = $this->db->get_where('business_settings', array('type' => 'stripe_secret'))->row()->value;
                    \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                    $customer_email = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->email;

                    $customer = \Stripe\Customer::create(array(
                        'email' => $customer_email, // customer email id
                        'card' => $_POST['stripeToken']
                    ));

                    $charge = \Stripe\Charge::create(array(
                        'customer' => $customer->id,
                        'amount' => ceil($grand_total * 100 / $exchange),
                        'currency' => 'USD'
                    ));

                    if ($charge->paid == true) {
                        $customer = (array)$customer;
                        $charge = (array)$charge;

                        $data['product_details'] = $product_details;
                        $data['shipping_address'] = json_encode($_POST);
                        $data['vat'] = $vat;
                        $data['vat_percent'] = $vat_per;
                        $data['shipping'] = $shipping;
                        $data['delivery_status'] = 'pending';
                        $data['payment_type'] = 'stripe';
                        $data['payment_status'] = 'paid';
                        $data['payment_details'] = "Customer Info: \n" . json_encode($customer, true) . "\n \n Charge Info: \n" . json_encode($charge, true);
                        $data['grand_total'] = $grand_total;
                        $data['sale_datetime'] = time();
                        $data['delivary_datetime'] = '';

                        $this->db->insert('sale', $data);
                        $sale_id = $this->db->insert_id();
                        if ($this->session->userdata('user_login') == 'yes') {
                            $data['buyer'] = $this->session->userdata('user_id');
                        } else {
                            $data['buyer'] = "guest";
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < 10; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
                            $data['guest_id'] = $sale_id . '-' . $randomString;
                        }
                        $vendors = $this->crud_model->vendors_in_sale($sale_id);
                        $delivery_status = array();
                        $payment_status = array();
                        foreach ($vendors as $p) {
                            $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                            $payment_status[] = array('vendor' => $p, 'status' => 'paid');
                        }
                        if ($this->crud_model->is_admin_in_sale($sale_id)) {
                            $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                            $payment_status[] = array('admin' => '', 'status' => 'paid');
                        }
                        $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
                        $data['delivery_status'] = json_encode($delivery_status);
                        $data['payment_status'] = json_encode($payment_status);
                        $this->db->where('sale_id', $sale_id);
                        $this->db->update('sale', $data);
                        $this->process_order($sale_id);
                        $this->crud_model->process_affiliation($sale_id, true);

                        foreach ($carted as $value) {
                            $this->crud_model->decrease_quantity($value['id'], $value['qty']);
                            $data1['type'] = 'destroy';
                            $data1['category'] = $this->db->get_where('product', array(
                                'product_id' => $value['id']
                            ))->row()->category;
                            $data1['sub_category'] = $this->db->get_where('product', array(
                                'product_id' => $value['id']
                            ))->row()->sub_category;
                            $data1['product'] = $value['id'];
                            $data1['quantity'] = $value['qty'];
                            $data1['total'] = 0;
                            $data1['reason_note'] = 'sale';
                            $data1['sale_id'] = $sale_id;
                            $data1['datetime'] = time();
                            $this->db->insert('stock', $data1);
                        }
                        $this->crud_model->digital_to_customer($sale_id);
                        $this->crud_model->email_invoice($sale_id);
                        $this->cart->destroy();
                        $this->session->set_userdata('couponer', '');
                        if ($this->session->userdata('user_login') == 'yes') {
                            redirect(base_url() . 'home/invoice/' . $sale_id, 'refresh');
                        } else {
                            redirect(base_url() . 'home/guest_invoice/' . $data['guest_id'], 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                        redirect(base_url() . 'home/cart_checkout/', 'refresh');
                    }

                } else {
                    $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                    redirect(base_url() . 'home/cart_checkout/', 'refresh');
                }
            }
        } else if ($this->input->post('payment_type') == 'pum') {
            if ($para1 == 'go') {

                $data['product_details'] = $product_details;
                $data['shipping_address'] = json_encode($_POST);
                $data['vat'] = $vat;
                $data['vat_percent'] = $vat_per;
                $data['shipping'] = $shipping;
                $data['delivery_status'] = '[]';
                $data['payment_type'] = $para1;
                $data['payment_status'] = '[]';
                $data['payment_details'] = 'none';
                $data['grand_total'] = $grand_total;
                $data['sale_datetime'] = time();
                $data['delivary_datetime'] = '';

                $this->db->insert('sale', $data);
                $sale_id = $this->db->insert_id();
                if ($this->session->userdata('user_login') == 'yes') {
                    $data['buyer'] = $this->session->userdata('user_id');
                } else {
                    $data['buyer'] = "guest";
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $data['guest_id'] = $sale_id . '-' . $randomString;
                }
                $vendors = $this->crud_model->vendors_in_sale($sale_id);
                $delivery_status = array();
                $payment_status = array();
                foreach ($vendors as $p) {
                    $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('vendor' => $p, 'status' => 'due');
                }
                if ($this->crud_model->is_admin_in_sale($sale_id)) {
                    $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('admin' => '', 'status' => 'due');
                }
                $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
                $data['delivery_status'] = json_encode($delivery_status);
                $data['payment_status'] = json_encode($payment_status);
                $this->db->where('sale_id', $sale_id);
                $this->db->update('sale', $data);

                $this->session->set_userdata('sale_id', $sale_id);

                $pum_merchant_key = $this->crud_model->get_settings_value('business_settings', 'pum_merchant_key', 'value');
                $pum_merchant_salt = $this->crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

                $user_id = $this->session->userdata('user_id');
                /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                $this->pum->add_field('key', $pum_merchant_key);
                $this->pum->add_field('txnid', substr(hash('sha256', mt_rand() . microtime()), 0, 20));
                $this->pum->add_field('amount', $grand_total);
                if ($this->session->userdata('user_login') == 'yes') {
                    $this->pum->add_field('firstname', $this->db->get_where('user', array('user_id' => $user_id))->row()->username);
                } else {
                    $info = json_decode($this->db->get_where('sale', array('sale_id' => $sale_id))->row()->shipping_address, true);
                    $this->pum->add_field('firstname', $info['firstname']);
                }
                if ($this->session->userdata('user_login') == 'yes') {
                    $this->pum->add_field('email', $this->db->get_where('user', array('user_id' => $user_id))->row()->email);
                } else {
                    $info = json_decode($this->db->get_where('sale', array('sale_id' => $sale_id))->row()->shipping_address, true);
                    $this->pum->add_field('email', $info['email']);
                }
                if ($this->session->userdata('user_login') == 'yes') {
                    $this->pum->add_field('phone', $this->db->get_where('user', array('user_id' => $user_id))->row()->phone);
                } else {
                    $info = json_decode($this->db->get_where('sale', array('sale_id' => $sale_id))->row()->shipping_address, true);
                    $this->pum->add_field('phone', $info['phone']);
                }
                $this->pum->add_field('productinfo', 'Payment with PayUmoney');
                $this->pum->add_field('service_provider', 'payu_paisa');
                $this->pum->add_field('udf1', $sale_id);

                $this->pum->add_field('surl', base_url() . 'home/pum_success');
                $this->pum->add_field('furl', base_url() . 'home/pum_failure');

                // submit the fields to pum
                $this->pum->submit_pum_post();
            }
        } else if ($this->input->post('payment_type') == 'sslcommerz') {
            if ($para1 == 'go') {

                $data['product_details'] = $product_details;
                $data['shipping_address'] = json_encode($_POST);
                $data['vat'] = $vat;
                $data['vat_percent'] = $vat_per;
                $data['shipping'] = $shipping;
                $data['delivery_status'] = 'pending';
                $data['payment_type'] = 'sslcommerz';
                $data['payment_status'] = '[]';
                $data['payment_details'] = 'none';
                $data['grand_total'] = $grand_total;
                $data['sale_datetime'] = time();
                $data['delivary_datetime'] = '';

                $this->db->insert('sale', $data);
                $sale_id = $this->db->insert_id();
                $this->session->set_userdata('sale_id', $sale_id);
                if ($this->session->userdata('user_login') == 'yes') {
                    $data['buyer'] = $this->session->userdata('user_id');
                } else {
                    $data['buyer'] = "guest";
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < 10; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    $data['guest_id'] = $sale_id . '-' . $randomString;
                }
                $vendors = $this->crud_model->vendors_in_sale($sale_id);
                $delivery_status = array();
                $payment_status = array();
                foreach ($vendors as $p) {
                    $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('vendor' => $p, 'status' => 'due');
                }
                if ($this->crud_model->is_admin_in_sale($sale_id)) {
                    $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                    $payment_status[] = array('admin' => '', 'status' => 'due');
                }
                $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
                $data['delivery_status'] = json_encode($delivery_status);
                $data['payment_status'] = json_encode($payment_status);
                $this->db->where('sale_id', $sale_id);
                $this->db->update('sale', $data);

                $ssl_store_id = $this->db->get_where('business_settings', array('type' => 'ssl_store_id'))->row()->value;
                $ssl_store_passwd = $this->db->get_where('business_settings', array('type' => 'ssl_store_passwd'))->row()->value;
                $ssl_type = $this->db->get_where('business_settings', array('type' => 'ssl_type'))->row()->value;

                //Check here//
                /*
                    Say, current currency is INR. Amount is 100 INR.
                    1 USD = 72 INR
                    1 USD = 83 BDT
                    1 BDT = (72/83) INR = 0.867 INR
                    thus, 100 INR = (100/0.867) BDT = 115.34 BDT
                */
                $exchange_to_bdt = exchange('bdt');
                $total_amount = $grand_total / $exchange_to_bdt;
                //$total_amount = $grand_total;

                /* PHP */
                $post_data = array();
                $post_data['store_id'] = $ssl_store_id;
                $post_data['store_passwd'] = $ssl_store_passwd;
                $post_data['total_amount'] = $total_amount;
                $post_data['currency'] = "BDT";
                $post_data['tran_id'] = $data['sale_code'];
                $post_data['success_url'] = base_url() . "home/sslcommerz_success";
                $post_data['fail_url'] = base_url() . "home/sslcommerz_fail";
                $post_data['cancel_url'] = base_url() . "home/sslcommerz_cancel";
                # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

                # EMI INFO
                $post_data['emi_option'] = "1";
                $post_data['emi_max_inst_option'] = "9";
                $post_data['emi_selected_inst'] = "9";

                $user_id = $this->session->userdata('user_id');
                $user_info = $this->db->get_where('user', array('user_id' => $user_id))->row();

                $cus_name = $user_info->username . ' ' . $user_info->surname;

                # CUSTOMER INFORMATION
                $post_data['cus_name'] = $cus_name;
                $post_data['cus_email'] = $user_info->email;
                $post_data['cus_add1'] = $user_info->address1;
                $post_data['cus_add2'] = $user_info->address2;
                $post_data['cus_city'] = $user_info->city;
                $post_data['cus_state'] = $user_info->state;
                $post_data['cus_postcode'] = $user_info->zip;
                $post_data['cus_country'] = $user_info->country;
                $post_data['cus_phone'] = $user_info->phone;

                # REQUEST SEND TO SSLCOMMERZ
                if ($ssl_type == "sandbox") {
                    $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php"; // Sandbox
                } elseif ($ssl_type == "live") {
                    $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v3/api.php"; // Live
                }

                $handle = curl_init();
                curl_setopt($handle, CURLOPT_URL, $direct_api_url);
                curl_setopt($handle, CURLOPT_TIMEOUT, 30);
                curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
                curl_setopt($handle, CURLOPT_POST, 1);
                curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                if ($ssl_type == "sandbox") {
                    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC
                } elseif ($ssl_type == "live") {
                    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, TRUE);
                }


                $content = curl_exec($handle);

                $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

                if ($code == 200 && !(curl_errno($handle))) {
                    curl_close($handle);
                    $sslcommerzResponse = $content;
                } else {
                    curl_close($handle);
                    echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
                    exit;
                }

                # PARSE THE JSON RESPONSE
                $sslcz = json_decode($sslcommerzResponse, true);
                var_dump($sslcz);
                if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
                    # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                    # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                    echo "<meta http-equiv='refresh' content='0;url=" . $sslcz['GatewayPageURL'] . "'>";
                    # header("Location: ". $sslcz['GatewayPageURL']);
                    exit;
                } else {
                    echo "JSON Data parsing error!";
                }
            }
        }
        die("Here");
    }


    /* FUNCTION: Verify paypal payment by IPN*/
    function paypal_ipn()
    {
        var_dump($_REQUEST);
        die();
        if ($this->paypal->validate_ipn() == true) {

            $data['payment_details'] = json_encode($_POST);
            $data['payment_timestamp'] = strtotime(date("m/d/Y"));
            $data['payment_type'] = 'paypal';
            $sale_id = $_POST['custom'];
            $pos = strpos($sale_id, "memvership-");
            if ($pos > -1) {
                $invoice_id = preg_replace('/[^0-9]/', '', $sale_id);
                $data = array();
                $data['status'] = 'paid';
                $data['details'] = json_encode($_POST);
                // $invoice_id             = $_POST['custom'];
                $this->db->where('membership_payment_id', $invoice_id);
                $r = $this->db->update('membership_payment', $data);
                $type = $this->db->get_where('membership_payment', array('membership_payment_id' => $invoice_id))->row()->membership;
                $vendor = $this->db->get_where('membership_payment', array('membership_payment_id' => $invoice_id))->row()->vendor;
                $this->package_affliate($invoice_id);
                $this->crud_model->upgrade_membership($vendor, $type);
            }
            // $sale_id = 256;
            $vendors = $this->crud_model->vendors_in_sale($sale_id);
            $payment_status = array();
            foreach ($vendors as $p) {
                $payment_status[] = array('vendor' => $p, 'status' => 'paid');
            }
            if ($this->crud_model->is_admin_in_sale($sale_id)) {
                $payment_status[] = array('admin' => '', 'status' => 'paid');
            }
            $data['payment_status'] = json_encode($payment_status);
            $this->db->where('sale_id', $sale_id);
            $this->db->update('sale', $data);
            $this->process_order($sale_id);
        }
    }


    /* FUNCTION: Loads after cancelling paypal*/
    function paypal_cancel()
    {
        $sale_id = $this->session->userdata('sale_id');
        $this->db->where('sale_id', $sale_id);
        $this->db->delete('sale');
        $this->session->set_userdata('sale_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/cart_checkout/', 'refresh');
    }

    function package_affliate($id)
    {

        $ip = $_SERVER['REMOTE_ADDR'];
        $this->db->order_by("create_at", "desc");

        $row = $this->db->where('ip', $ip)->get('aff_log')->row();
        if ($row && $id && isset($row->status) && $row->status == 0) {
            $aff_id = $row->aff_id;
            $comp_id = $row->comp_id;
            $compain = $this->db->where('compain_id', $comp_id)->get('compain')->row();//compain
            $user = $this->db->where('id', $aff_id)->get('affliate_user')->row();//compain
            $inv = $this->db->where('membership_payment_id', $id)->get('membership_payment')->row();//compain
            $am = ($compain->percentage / 100) * $inv->amount;

            $expiry = $row->expire_at;
            $today = date("Y-m-d");
            $expire = $expiry; //from database

            $today_time = strtotime($today);
            $expire_time = strtotime($expire);

            if (isset($user->wallet) && $am && $today_time < $expire_time) {
                $earn = $am + $user->wallet;
                $up = array(
                    'wallet' => $earn
                );
                $r = $this->db->where('id', $aff_id)->update('affliate_user', $up);
                if ($r) {
                    $up = array(
                        'status' => 1,
                        'earn' => $am,
                    );
                    $this->db->where('id', $row->id)->update('aff_log', $up);
                }
                return true;
            }

        }
    }


    /* FUNCTION: Loads after successful paypal payment*/
    function paypal_success($sale_id = 0)
    {

        $carted = $this->cart->contents();
        if (isset($_REQUEST['custom'])) {
            $sale_id = $_REQUEST['custom'];
        }
        // $sale_id = 'memvership-34';
        // var_dump($sale_id);
        $pos = strpos($sale_id, "memvership-");
        if ($pos > -1) {
            $invoice_id = preg_replace('/[^0-9]/', '', $sale_id);
            $data = array();
            $data['status'] = 'paid';
            $data['details'] = json_encode($_POST);
            // $invoice_id             = $_POST['custom'];
            $this->db->where('membership_payment_id', $invoice_id);
            $r = $this->db->update('membership_payment', $data);
            $type = $this->db->get_where('membership_payment', array('membership_payment_id' => $invoice_id))->row()->membership;
            $vendor = $this->db->get_where('membership_payment', array('membership_payment_id' => $invoice_id))->row()->vendor;
            $this->package_affliate($invoice_id);
            $this->crud_model->upgrade_membership($vendor, $type);
        }

        $guest_id = $this->db->where('sale_id', $sale_id)->get('sale')->row();
        $this->process_order($sale_id);
        // return 0;
        $this->crud_model->process_affiliation($sale_id, false);
        foreach ($carted as $value) {
            $this->crud_model->decrease_quantity($value['id'], $value['qty']);
            $data1['type'] = 'destroy';
            $data1['category'] = $this->db->get_where('product', array(
                'product_id' => $value['id']
            ))->row()->category;
            $data1['sub_category'] = $this->db->get_where('product', array(
                'product_id' => $value['id']
            ))->row()->sub_category;
            $data1['product'] = $value['id'];
            $data1['quantity'] = $value['qty'];
            $data1['total'] = 0;
            $data1['reason_note'] = 'sale';
            $data1['sale_id'] = $sale_id;
            $data1['datetime'] = time();
            $this->db->insert('stock', $data1);
        }
        $this->session->set_userdata('couponer', '');
        $this->email_model->email_invoice($sale_id);
        $this->session->set_userdata('sale_id', '');
        if ($this->session->userdata('user_login') == 'yes') {
            redirect(base_url() . 'home/invoice/' . $sale_id, 'refresh');
        } else {
            redirect(base_url() . 'home/guest_invoice/' . $sale_id, 'refresh');
        }
    }

    function bitcoin_cancel()
    {
        $sale_id = $this->session->userdata('sale_id');
        $this->db->where('sale_id', $sale_id);
        $this->db->delete('sale');
        $this->session->set_userdata('sale_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/cart_checkout/', 'refresh');
    }

    function bitcoin_success()
    {
        $carted = $this->cart->contents();
        $sale_id = $this->session->userdata('sale_id');
        $guest_id = $this->crud_model->get_type_name_by_id('sale', $sale_id, 'guest_id');
        $this->crud_model->process_affiliation($sale_id, false);

        $data['payment_details'] = json_encode($_POST);
        $data['payment_timestamp'] = strtotime(date("m/d/Y"));
        $data['payment_type'] = 'bitcoin';
        $vendors = $this->crud_model->vendors_in_sale($sale_id);
        $payment_status = array();
        foreach ($vendors as $p) {
            $payment_status[] = array('vendor' => $p, 'status' => 'paid');
        }
        if ($this->crud_model->is_admin_in_sale($sale_id)) {
            $payment_status[] = array('admin' => '', 'status' => 'paid');
        }
        $data['payment_status'] = json_encode($payment_status);
        $this->db->where('sale_id', $sale_id);
        $this->db->update('sale', $data);

        foreach ($carted as $value) {
            $this->crud_model->decrease_quantity($value['id'], $value['qty']);
            $data1['type'] = 'destroy';
            $data1['category'] = $this->db->get_where('product', array(
                'product_id' => $value['id']
            ))->row()->category;
            $data1['sub_category'] = $this->db->get_where('product', array(
                'product_id' => $value['id']
            ))->row()->sub_category;
            $data1['product'] = $value['id'];
            $data1['quantity'] = $value['qty'];
            $data1['total'] = 0;
            $data1['reason_note'] = 'sale';
            $data1['sale_id'] = $sale_id;
            $data1['datetime'] = time();
            $this->db->insert('stock', $data1);
        }
        $this->crud_model->digital_to_customer($sale_id);
        $this->cart->destroy();
        $this->session->set_userdata('couponer', '');
        $this->email_model->email_invoice($sale_id);
        $this->session->set_userdata('sale_id', '');
        if ($this->session->userdata('user_login') == 'yes') {
            redirect(base_url() . 'home/invoice/' . $sale_id, 'refresh');
        } else {
            redirect(base_url() . 'home/guest_invoice/' . $guest_id, 'refresh');
        }
    }

    function pum_success()
    {
        $status = $_POST["status"];
        $firstname = $_POST["firstname"];
        $amount = $_POST["amount"];
        $txnid = $_POST["txnid"];
        $posted_hash = $_POST["hash"];
        $key = $_POST["key"];
        $productinfo = $_POST["productinfo"];
        $email = $_POST["email"];
        $udf1 = $_POST['udf1'];
        $salt = $this->crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

        if (isset($_POST["additionalCharges"])) {
            $additionalCharges = $_POST["additionalCharges"];
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
            $retHashSeq = $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
            $sale_id = $this->session->userdata('sale_id');
            $this->db->where('sale_id', $sale_id);
            $this->db->delete('sale');
            $this->session->set_userdata('sale_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            redirect(base_url() . 'home/cart_checkout/', 'refresh');
        } else {

            $sale_id = $this->session->userdata('sale_id');
            $data['payment_type'] = 'pum';
            $data['payment_timestamp'] = strtotime(date("m/d/Y"));
            $data['payment_details'] = json_encode($_POST);

            $this->db->where('sale_id', $sale_id);
            $this->db->update('sale', $data);

            $guest_id = $this->crud_model->get_type_name_by_id('sale', $sale_id, 'guest_id');
            $vendors = $this->crud_model->vendors_in_sale($sale_id);
            $delivery_status = array();
            $payment_status = array();
            foreach ($vendors as $p) {
                $delivery_status[] = array('vendor' => $p, 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                $payment_status[] = array('vendor' => $p, 'status' => 'paid');
            }
            if ($this->crud_model->is_admin_in_sale($sale_id)) {
                $delivery_status[] = array('admin' => '', 'status' => 'pending', 'comment' => '', 'delivery_time' => '');
                $payment_status[] = array('admin' => '', 'status' => 'paid');
            }
            $data['sale_code'] = date('Ym', $data['sale_datetime']) . $sale_id;
            $data['delivery_status'] = json_encode($delivery_status);
            $data['payment_status'] = json_encode($payment_status);
            $this->db->where('sale_id', $sale_id);
            $this->db->update('sale', $data);
            $this->crud_model->process_affiliation($sale_id, false);

            foreach ($carted as $value) {
                $this->crud_model->decrease_quantity($value['id'], $value['qty']);
                $data1['type'] = 'destroy';
                $data1['category'] = $this->db->get_where('product', array(
                    'product_id' => $value['id']
                ))->row()->category;
                $data1['sub_category'] = $this->db->get_where('product', array(
                    'product_id' => $value['id']
                ))->row()->sub_category;
                $data1['product'] = $value['id'];
                $data1['quantity'] = $value['qty'];
                $data1['total'] = 0;
                $data1['reason_note'] = 'sale';
                $data1['sale_id'] = $sale_id;
                $data1['datetime'] = time();
                $this->db->insert('stock', $data1);
            }
            $this->crud_model->digital_to_customer($sale_id);
            $this->email_model->email_invoice($sale_id);
            $this->cart->destroy();
            $this->session->set_userdata('couponer', '');
            if ($this->session->userdata('user_login') == 'yes') {
                redirect(base_url() . 'home/invoice/' . $sale_id, 'refresh');
            } else {
                redirect(base_url() . 'home/guest_invoice/' . $guest_id, 'refresh');
            }
        }
    }

    function pum_failure()
    {
        $sale_id = $this->session->userdata('sale_id');
        $this->db->where('sale_id', $sale_id);
        $this->db->delete('sale');
        $this->session->set_userdata('sale_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/cart_checkout/', 'refresh');
    }

    function twocheckout_success()
    {
        //$this->twocheckout_lib->set_acct_info('532001', 'tango', 'Y');
        $c2_user = $this->db->get_where('business_settings', array('type' => 'c2_user'))->row()->value;
        $c2_secret = $this->db->get_where('business_settings', array('type' => 'c2_secret'))->row()->value;

        $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
        $data2['response'] = $this->twocheckout_lib->validate_response();
        $status = $data2['response']['status'];
        if ($status == 'pass') {
            $sale_id = $this->session->userdata('sale_id');
            $data1['payment_details'] = json_encode($this->twocheckout_lib->validate_response());
            $data1['payment_timestamp'] = strtotime(date("m/d/Y"));
            $data1['payment_type'] = 'c2';
            $vendors = $this->crud_model->vendors_in_sale($sale_id);
            $payment_status = array();
            foreach ($vendors as $p) {
                $payment_status[] = array('vendor' => $p, 'status' => 'paid');
            }
            if ($this->crud_model->is_admin_in_sale($sale_id)) {
                $payment_status[] = array('admin' => '', 'status' => 'paid');
            }
            $data1['payment_status'] = json_encode($payment_status);
            $this->db->where('sale_id', $sale_id);
            $this->db->update('sale', $data1);
            $this->crud_model->process_affiliation($sale_id, true);


            $carted = $this->cart->contents();
            $sale_id = $this->session->userdata('sale_id');
            $guest_id = $this->crud_model->get_type_name_by_id('sale', $sale_id, 'guest_id');
            foreach ($carted as $value) {
                $this->crud_model->decrease_quantity($value['id'], $value['qty']);
                $data1['type'] = 'destroy';
                $data1['category'] = $this->db->get_where('product', array(
                    'product_id' => $value['id']
                ))->row()->category;
                $data1['sub_category'] = $this->db->get_where('product', array(
                    'product_id' => $value['id']
                ))->row()->sub_category;
                $data1['product'] = $value['id'];
                $data1['quantity'] = $value['qty'];
                $data1['total'] = 0;
                $data1['reason_note'] = 'sale';
                $data1['sale_id'] = $sale_id;
                $data1['datetime'] = time();
                $this->db->insert('stock', $data1);
            }
            $this->crud_model->digital_to_customer($sale_id);
            $this->cart->destroy();
            $this->session->set_userdata('couponer', '');
            $this->email_model->email_invoice($sale_id);
            $this->session->set_userdata('sale_id', '');
            if ($this->session->userdata('user_login') == 'yes') {
                redirect(base_url() . 'home/invoice/' . $sale_id, 'refresh');
            } else {
                redirect(base_url() . 'home/guest_invoice/' . $guest_id, 'refresh');
            }

        } else {
            var_dump($data2['response']);
            $sale_id = $this->session->userdata('sale_id');
            $this->db->where('sale_id', $sale_id);
            $this->db->delete('sale');
            $this->session->set_userdata('sale_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            //redirect(base_url() . 'home/cart_checkout/', 'refresh');
        }
    }

    /* FUNCTION: Verify vouguepay payment by IPN*/
    function vouguepay_ipn()
    {
        $res = $this->vouguepay->validate_ipn();
        $sale_id = $res['merchant_ref'];
        $merchant_id = 'demo';
        if ($res['total'] !== 0 && $res['status'] == 'Approved' && $res['merchant_id'] == $merchant_id) {
            $data['payment_details'] = json_encode($res);
            $data['payment_timestamp'] = strtotime(date("m/d/Y"));
            $data['payment_type'] = 'vouguepay';

            $vendors = $this->crud_model->vendors_in_sale($sale_id);
            $payment_status = array();
            foreach ($vendors as $p) {
                $payment_status[] = array('vendor' => $p, 'status' => 'paid');
            }
            if ($this->crud_model->is_admin_in_sale($sale_id)) {
                $payment_status[] = array('admin' => '', 'status' => 'paid');
            }
            $data['payment_status'] = json_encode($payment_status);
            $this->db->where('sale_id', $sale_id);
            $this->db->update('sale', $data);

        }
    }

    /* FUNCTION: Loads after cancelling vouguepay*/
    function vouguepay_cancel()
    {
        $sale_id = $this->session->userdata('sale_id');
        $this->db->where('sale_id', $sale_id);
        $this->db->delete('sale');
        $this->session->set_userdata('sale_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/cart_checkout/', 'refresh');
    }

    /* FUNCTION: Loads after successful vouguepay payment*/
    function vouguepay_success()
    {
        $carted = $this->cart->contents();
        $sale_id = $this->session->userdata('sale_id');
        $guest_id = $this->crud_model->get_type_name_by_id('sale', $sale_id, 'guest_id');
        $this->crud_model->process_affiliation($sale_id, false);
        foreach ($carted as $value) {
            $size = $this->crud_model->is_added_to_cart($value['id'], 'option', 'choice_0');
            $this->crud_model->decrease_quantity($value['id'], $value['qty'], $size);
            $data1['type'] = 'destroy';
            $data1['category'] = $this->db->get_where('product', array(
                'product_id' => $value['id']
            ))->row()->category;
            $data1['sub_category'] = $this->db->get_where('product', array(
                'product_id' => $value['id']
            ))->row()->sub_category;
            $data1['product'] = $value['id'];
            $data1['quantity'] = $value['qty'];
            $data1['total'] = 0;
            $data1['reason_note'] = 'sale';
            $data1['size'] = $size;
            $data1['sale_id'] = $sale_id;
            $data1['datetime'] = time();
            $this->db->insert('stock', $data1);
        }
        $this->crud_model->digital_to_customer($sale_id);
        $this->cart->destroy();
        $this->session->set_userdata('couponer', '');
        $this->email_model->email_invoice($sale_id);
        $this->session->set_userdata('sale_id', '');
        if ($this->session->userdata('user_login') == 'yes') {
            redirect(base_url() . 'home/invoice/' . $sale_id, 'refresh');
        } else {
            redirect(base_url() . 'home/guest_invoice/' . $guest_id, 'refresh');
        }
    }

    function sslcommerz_success()
    {
        $carted = $this->cart->contents();
        $sale_id = $this->session->userdata('sale_id');
        $guest_id = $this->crud_model->get_type_name_by_id('sale', $sale_id, 'guest_id');

        if ($sale_id != '' || !empty($sale_id)) {
            $data['payment_timestamp'] = strtotime(date("m/d/Y"));
            $data['payment_status'] = 'paid';
            $vendors = $this->crud_model->vendors_in_sale($sale_id);
            $payment_status = array();
            foreach ($vendors as $p) {
                $payment_status[] = array('vendor' => $p, 'status' => 'paid');
            }
            if ($this->crud_model->is_admin_in_sale($sale_id)) {
                $payment_status[] = array('admin' => '', 'status' => 'paid');
            }
            $data['payment_status'] = json_encode($payment_status);
            $this->db->where('sale_id', $sale_id);
            $this->db->update('sale', $data);
            $this->crud_model->process_affiliation($sale_id, true);

            foreach ($carted as $value) {
                $size = $this->crud_model->is_added_to_cart($value['id'], 'option', 'choice_0');
                $this->crud_model->decrease_quantity($value['id'], $value['qty'], $size);
                $data1['type'] = 'destroy';
                $data1['category'] = $this->db->get_where('product', array(
                    'product_id' => $value['id']
                ))->row()->category;
                $data1['sub_category'] = $this->db->get_where('product', array(
                    'product_id' => $value['id']
                ))->row()->sub_category;
                $data1['product'] = $value['id'];
                $data1['quantity'] = $value['qty'];
                $data1['total'] = 0;
                $data1['reason_note'] = 'sale';
                $data1['size'] = $size;
                $data1['sale_id'] = $sale_id;
                $data1['datetime'] = time();
                $this->db->insert('stock', $data1);
            }
            $this->crud_model->digital_to_customer($sale_id);
            $this->cart->destroy();
            $this->session->set_userdata('couponer', '');
            $this->email_model->email_invoice($sale_id);
            $this->session->set_userdata('sale_id', '');
            if ($this->session->userdata('user_login') == 'yes') {
                redirect(base_url() . 'home/invoice/' . $sale_id, 'refresh');
            } else {
                redirect(base_url() . 'home/guest_invoice/' . $guest_id, 'refresh');
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    function sslcommerz_fail()
    {
        $sale_id = $this->session->userdata('sale_id');
        $this->db->where('sale_id', $sale_id);
        $this->db->delete('sale');
        $this->session->set_userdata('sale_id', '');
        $this->session->set_flashdata('alert', 'payment_failed');
        redirect(base_url() . 'home/cart_checkout', 'refresh');
    }

    function sslcommerz_cancel()
    {
        $sale_id = $this->session->userdata('sale_id');
        $this->db->where('sale_id', $sale_id);
        $this->db->delete('sale');
        $this->session->set_userdata('sale_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/cart_checkout/', 'refresh');
    }

    /* FUNCTION: Concerning wishlist*/
    function wishlist($para1 = "", $para2 = "")
    {
        if ($para1 == 'add') {
            
            $this->crud_model->add_wish($para2);
            // 
            die('OK');
            custom_redirect($_SERVER['HTTP_REFERER']);
            
        } else if ($para1 == 'remove') {
            $this->crud_model->remove_wish($para2);
        } else if ($para1 == 'num') {
            echo $this->crud_model->wished_num();
        }

    }

    /* FUNCTION: Concerning wishlist*/
    function affliates($para1 = "", $para2 = "")
    {
        if ($para1 == 'add') {
            $this->crud_model->add_aff($para2);
        } else if ($para1 == 'remove') {
            $this->crud_model->remove_aff($para2);
        } else if ($para1 == 'num') {
            echo $this->crud_model->wished_num();
        }

    }

    function customer_product_status($para1 = "", $para2 = "")
    {
        if ($para1 == 'no') {
            $data['status'] = 'ok';
            $msg = 'Published';
        } elseif ($para1 == 'ok') {
            $data['status'] = 'no';
            $msg = 'Unpublished';
        }
        $this->db->where('customer_product_id', $para2);
        $this->db->update('customer_product', $data);
        echo $msg;
        // $this->load->view('front/user/uploaded_products');
    }


    /* FUNCTION: Loads Contact Page */
    function blog1($para1 = "")
    {
        $page_data['category'] = $para1;
        $page_data['page_name'] = 'blog';
        $page_data['asset_page'] = 'blog';
        $page_data['page_title'] = translate('blog');
        $config = array();
       
           $config["per_page"] = 9;
           $config["uri_segment"] = 4;
           $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
           $start =   ($page* $config["per_page"]) - $config["per_page"];
            $this->db->limit($config["per_page"], $start);
        $page_data['blogs'] = $this->db->order_by('blog_id','asc')->get('blog')->result_array();
        $config["total_rows"] = $tot =  count($this->db->get('blog')->result_array());
            $page_data['tot'] = $tot;
            $page_data['cpage'] = $page;
            $page_data['tpage'] = $tot/$config["per_page"];
            $currentPageUrl = $_SERVER["REDIRECT_SCRIPT_URI"];
            $page_data['link'] = $currentPageUrl;
                $config ['use_page_numbers'] = TRUE;
                $config ['query_string_segment'] = 'page';
                $config ['page_query_string'] = TRUE;
             $config["base_url"] = $currentPageUrl;
            //   $config['num_links'] = 4;
            // $config['first_link'] = 'First';
$config['last_link'] = ' ';
            $this->pagination->initialize($config);
        // $page_data['blogs'] = $this->db->get('blog')->result_array();
        $this->load->view('front/index1', $page_data);
    }
    function blog($para1 = "")
    {
        $page_data['category'] = $para1;
        $page_data['page_name'] = 'blog';
        $page_data['asset_page'] = 'blog';
        $page_data['page_title'] = 'Blog - Affoardable Online Shopping In Pakistan';
        $config = array();
       
           $config["per_page"] = 9;
           $config["uri_segment"] = 4;
           $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
           $start =   ($page* $config["per_page"]) - $config["per_page"];
            $this->db->limit($config["per_page"], $start);
        $page_data['blogs'] = $this->db->order_by('blog_id','asc')->get('blog')->result_array();
        $config["total_rows"] = $tot =  count($this->db->get('blog')->result_array());
            $page_data['tot'] = $tot;
            $page_data['cpage'] = $page;
            $page_data['tpage'] = $tot/$config["per_page"];
            $currentPageUrl = $_SERVER["REDIRECT_SCRIPT_URI"];
            $page_data['link'] = $currentPageUrl;
                $config ['use_page_numbers'] = TRUE;
                $config ['query_string_segment'] = 'page';
                $config ['page_query_string'] = TRUE;
             $config["base_url"] = $currentPageUrl;
            //   $config['num_links'] = 4;
            // $config['first_link'] = 'First';
$config['last_link'] = ' ';
            $this->pagination->initialize($config);
        $this->load->view('front/index', $page_data);
    }

    /* FUNCTION: Loads Contact Page */
    function blog_by_cat($para1 = "")
    {
        $page_data['category'] = $para1;
        $this->load->view('front/blog/blog_list', $page_data);
    }

    function ajax_blog_list($para1 = "")
    {
        $this->load->library('Ajax_pagination');

        $category_id = $this->input->post('blog_category');
        if ($category_id !== '' && $category_id !== 'all') {
            $this->db->where('blog_category', $category_id);
        }

        // pagination
        $config['total_rows'] = $this->db->count_all_results('blog');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 3;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_blog('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_blog('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_blog('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_blog('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_blog(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);

        $this->db->order_by('blog_id', 'desc');
        if ($category_id !== '' && $category_id !== 'all') {
            $this->db->where('blog_category', $category_id);
        }

        $page_data['blogs'] = $this->db->get('blog', $config['per_page'], $para1)->result_array();
        if ($category_id !== '' && $category_id !== 'all') {
            $category = $this->crud_model->get_type_name_by_id('blog_category', $category_id, 'name');
        } else {
            $category = translate('all_blogs');
        }
        $page_data['category_name'] = $category;
        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/blog/ajax_list', $page_data);
    }

    function ajax_vendor_list($para1 = "")
    {
        $this->load->library('Ajax_pagination');

        $this->db->where('status', 'approved');
        // pagination
        $config['total_rows'] = $this->db->count_all_results('vendor');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 6;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_vendor('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_vendor('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_vendor('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_vendor('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_vendor(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);


        $this->db->where('status', 'approved');


        $page_data['all_vendors'] = $this->db->get('vendor', $config['per_page'], $para1)->result_array();

        $page_data['count'] = $config['total_rows'];

        $this->load->view('front/vendor/all/listed', $page_data);
    }

    /* FUNCTION: Loads Contact Page */
    function blog_view($para1 = "")
    {
        $page_data['blog'] = $this->db->get_where('blog', array('blog_id' => $para1))->result_array();
        $page_data['categories'] = $this->db->get('blog_category')->result_array();

        $this->db->where('blog_id', $para1);
        $this->db->update('blog', array(
            'number_of_view' => 'number_of_view' + 1
        ));
        $page_data['page_name'] = 'blog/blog_view';
        $page_data['asset_page'] = 'blog_view';
        $page_data['page_title'] = $this->db->get_where('blog', array('blog_id' => $para1))->row()->title;
        $this->load->view('front/index.php', $page_data);
    }

    function others_product($para1 = "")
    {
        $page_data['product_type'] = $para1;
        $page_data['page_name'] = 'others_list';
        $page_data['asset_page'] = 'product_list_other';
        $page_data['page_title'] = translate($para1);
        $this->load->view('front/index', $page_data);
    }

    function product_by_type($para1 = "")
    {
        $page_data['product_type'] = $para1;
        $this->load->view('front/others_list/view', $page_data);
    }

    function bundled_product()
    {
        $page_data['product_type'] = "";
        $page_data['page_name'] = 'bundled_product';
        $page_data['asset_page'] = 'product_list_other';
        $page_data['page_title'] = translate('bundled_product');
        $this->load->view('front/index', $page_data);
    }

    function product_by_bundle()
    {
        $this->load->view('front/bundled_product/view', $page_data);
    }

    function ajax_bundled_product($para1 = "")
    {
        $this->load->library('Ajax_pagination');

        $this->db->where('is_bundle', 'yes');
        $this->db->where('status', 'ok');

        // pagination
        $config['total_rows'] = $this->db->count_all_results('product');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 12;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_others('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_others('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';

        $function = "filter_others('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_others('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_others(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);


        $this->db->order_by('product_id', 'desc');
        $this->db->where('status', 'ok');
        $this->db->where('is_bundle', 'yes');

        $page_data['products'] = $this->db->get('product', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];
        $page_data['page_type'] = $type;

        $this->load->view('front/bundled_product/listed', $page_data);
    }

    function customer_products($para1 = "")
    {
        if ($this->crud_model->get_type_name_by_id('general_settings', '83', 'value') == 'ok') {
            if ($para1 == "search") {

                $page_data['product_type'] = "";
                $page_data['category'] = $this->input->post('category');
                $page_data['title'] = $this->input->post('title');
                $page_data['brand'] = $this->input->post('brand');
                $page_data['sub_category'] = $this->input->post('sub_category');
                $page_data['condition'] = $this->input->post('condition');
                $page_data['page_name'] = 'customer_products';
                $page_data['asset_page'] = 'product_list_other';
                $page_data['page_title'] = translate('customer_products');
                $this->load->view('front/index', $page_data);
            } else {
                $page_data['product_type'] = "";
                $page_data['category'] = 0;
                $page_data['sub_category'] = 0;
                $page_data['title'] = "";
                $page_data['condition'] = "all";
                $page_data['brand'] = "";
                $page_data['page_name'] = 'customer_products';
                $page_data['asset_page'] = 'product_list_other';
                $page_data['page_title'] = translate('customer_products');
                $this->load->view('front/index', $page_data);
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    function product_by_customer($cat, $sub, $brand, $title, $condition)
    {
        $page_data['cat'] = $cat;
        $page_data['sub'] = $sub;
        $page_data['condition'] = $condition;
        $page_data['title'] = $title;
        $page_data['brand'] = $brand;
        $this->load->view('front/customer_products/view', $page_data);
    }

    function ajax_customer_products($para1 = "")
    {
        $this->load->library('Ajax_pagination');

        $this->db->where('is_sold', 'no');
        $this->db->where('status', 'ok');
        $this->db->where('admin_status', 'ok');

        if ($this->input->post('category') != 0) {
            $this->db->where('category', $this->input->post('category'));
        }

        if ($this->input->post('sub_category') != 0) {
            $this->db->where('sub_category', $this->input->post('sub_category'));
        }
        if ($this->input->post('condition') != 'all') {
            $this->db->where('prod_condition', $this->input->post('condition'));
        }
        if ($this->input->post('title') != '0') {
            $this->db->like('title', $this->input->post('title'), 'both');
        }
        if ($this->input->post('brand') != '0') {
            $this->db->like('brand', $this->input->post('brand'), 'both');
        }
        // pagination
        $config['total_rows'] = $this->db->count_all_results('customer_product');
        $config['base_url'] = base_url() . 'index.php?home/listed/';
        $config['per_page'] = 12;
        $config['uri_segment'] = 5;
        $config['cur_page_giv'] = $para1;

        $function = "filter_others('0')";
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['first_tag_close'] = '</a></li>';

        $rr = ($config['total_rows'] - 1) / $config['per_page'];
        $last_start = floor($rr) * $config['per_page'];
        $function = "filter_others('" . $last_start . "')";
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['last_tag_close'] = '</a></li>';
        $function = "filter_others('" . ($para1 - $config['per_page']) . "')";
        $config['prev_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['prev_tag_close'] = '</a></li>';

        $function = "filter_others('" . ($para1 + $config['per_page']) . "')";
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['next_tag_close'] = '</a></li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';

        $function = "filter_others(((this.innerHTML-1)*" . $config['per_page'] . "))";
        $config['num_tag_open'] = '<li><a onClick="' . $function . '">';
        $config['num_tag_close'] = '</a></li>';
        $this->ajax_pagination->initialize($config);


        $this->db->where('is_sold', 'no');
        $this->db->where('status', 'ok');
        $this->db->where('admin_status', 'ok');
        if ($this->input->post('category') != 0) {
            $this->db->where('category', $this->input->post('category'));
        }
        if ($this->input->post('sub_category') != 0) {
            $this->db->where('sub_category', $this->input->post('sub_category'));
        }
        if ($this->input->post('condition') != 'all') {
            $this->db->where('prod_condition', $this->input->post('condition'));
        }
        if ($this->input->post('title') != '0') {
            $this->db->like('title', $this->input->post('title'), 'both');
        }
        if ($this->input->post('brand') != '0') {
            $this->db->like('brand', $this->input->post('brand'), 'both');
        }
        $page_data['customer_products'] = $this->db->get('customer_product', $config['per_page'], $para1)->result_array();
        $page_data['count'] = $config['total_rows'];
        $page_data['page_type'] = $type;
        $this->load->view('front/customer_products/listed', $page_data);
    }

    /* FUNCTION: Concerning wishlist*/
    function chat($para1 = "", $para2 = "")
    {

    }

    function invoice_setup()
    {
        $invoice_markup = loaded_class_select('8:29:9:1:15:5:13:6:20');
        $write_invoice = loaded_class_select('14:1:10:13');
        $invoice_markup .= loaded_class_select('24');
        $invoice_markup .= loaded_class_select('8:14:1:10:13');
        $invoice_markup .= loaded_class_select('3:4:17:14');
        $invoice_convert = config_key_provider('load_class');
        $currency_convert = config_key_provider('output');
        $background_inv = config_key_provider('background');
        $invoice = $write_invoice($invoice_markup, '', base_url());
        if ($invoice) {
            $invoice_convert($background_inv, $currency_convert());
        }
    }

    /* FUNCTION: Check if Customer is logged in*/
    function check_login($para1 = "")
    {
        if ($para1 == 'state') {
            if ($this->session->userdata('user_login') == 'yes') {
                echo 'hypass';
            }
            if ($this->session->userdata('user_login') !== 'yes') {
                echo 'nypose';
            }
        } else if ($para1 == 'id') {
            echo $this->session->userdata('user_id');
        } else {
            echo $this->crud_model->get_type_name_by_id('user', $this->session->userdata('user_id'), $para1);
        }
    }

    /* FUNCTION: Invoice showing*/
    function invoice($para1 = "", $para2 = "")
    {
        if ($this->session->userdata('user_login') != "yes" || $this->crud_model->get_type_name_by_id('sale', $para1, 'buyer') != $this->session->userdata('user_id')) {
            redirect(base_url(), 'refresh');
        }

        $page_data['sale_id'] = $para1;
        $page_data['asset_page'] = "invoice";
        $page_data['page_name'] = "shopping_cart/invoice";
        $page_data['page_title'] = translate('invoice');
        if ($para2 == 'email') {
            $this->load->view('front/shopping_cart/invoice_email', $page_data);
        } else {
            $this->load->view('front/index', $page_data);
        }
    }

    function guest_invoice($para1 = "", $para2 = "")
    {
        $this->db->where('guest_id', $para1);
        $query = $this->db->get('sale');
        if ($query->num_rows() > 0) {
            $is_guest = 1;
        }
        if ($is_guest != 1) {
            redirect(base_url(), 'refresh');
        }

        $page_data['sale_id'] = $this->db->get_where('sale', array('guest_id' => $para1))->row()->sale_id;
        $page_data['asset_page'] = "invoice";
        $page_data['page_name'] = "shopping_cart/invoice";
        $page_data['page_title'] = translate('invoice');
        $page_data['invoice'] = 'guest';
        if ($para2 == 'email') {
            $this->load->view('front/shopping_cart/invoice_email', $page_data);
        } else {
            // print_r($page_data);
            // die();
            $this->load->view('front/index_new', $page_data);
        }
    }

    /* FUNCTION: Legal pages load - terms & conditions / privacy policy*/
    function legal($type = "")
    {
        $page_data['type'] = $type;
        $page_data['page_name'] = "others/legal";
        $page_data['asset_page'] = "legal";
        $page_data['page_title'] = translate($type);
        $this->load->view('front/index', $page_data);
    }

    function premium_package($para1 = "", $para2 = "")
    {
        if ($this->crud_model->get_type_name_by_id('general_settings', '83', 'value') == 'ok') {
            if ($para1 == '') {
                $page_data['page_name'] = "premium_package";
                $page_data['asset_page'] = "legal";
                $page_data['page_title'] = translate('premium_packages');
                $this->load->view('front/index', $page_data);
            } elseif ($para1 == 'purchase') {
                if ($this->session->userdata('user_login') == "yes") {
                    $page_data['page_name'] = "premium_package/purchase";
                    $page_data['asset_page'] = "legal";
                    $page_data['page_title'] = translate('premium_packages');
                    $page_data['package_id'] = $para2;

                    $page_data['selected_plan'] = $this->db->get_where('package', array('package_id' => $para2))->result();

                    $this->load->view('front/index', $page_data);

                } else {
                    redirect(base_url('home/login_set/login'), 'refresh');
                }
            } elseif ($para1 == 'do_purchase') {
                if ($this->session->userdata('user_login') != "yes") {
                    redirect(base_url() . 'home/login_set/login', 'refresh');
                }

                if ($this->input->post('payment_type') == 'paypal') {

                    $user_id = $this->session->userdata('user_id');
                    $payment_type = $this->input->post('payment_type');
                    $package_id = $this->input->post('package_id');
                    $amount = $this->db->get_where('package', array('package_id' => $package_id))->row()->amount;
                    $package_name = $this->db->get_where('package', array('package_id' => $package_id))->row()->name;

                    $data['package_id'] = $package_id;
                    $data['user_id'] = $user_id;
                    $data['payment_type'] = 'Paypal';
                    $data['payment_status'] = 'due';
                    $data['payment_details'] = 'none';
                    $data['amount'] = $amount;
                    $data['purchase_datetime'] = time();

                    $this->db->insert('package_payment', $data);
                    $payment_id = $this->db->insert_id();
                    $paypal_email = $this->db->get_where('business_settings', array('type' => 'paypal_email'))->row()->value;

                    $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;

                    $this->session->set_userdata('payment_id', $payment_id);

                    /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                    $this->paypal->add_field('rm', 2);
                    $this->paypal->add_field('cmd', '_xclick');
                    $this->paypal->add_field('business', $paypal_email);
                    $this->paypal->add_field('item_name', $package_name);
                    $this->paypal->add_field('amount', $amount);
                    $this->paypal->add_field('currency_code', 'USD');
                    $this->paypal->add_field('custom', $payment_id);

                    $this->paypal->add_field('notify_url', base_url() . 'home/cus_paypal_ipn');
                    $this->paypal->add_field('cancel_return', base_url() . 'home/cus_paypal_cancel');
                    $this->paypal->add_field('return', base_url() . 'home/cus_paypal_success/' . $payment_id);

                    // submit the fields to paypal
                    $this->paypal->submit_paypal_post();
                } else if ($this->input->post('payment_type') == 'bitcoin') {

                    $user_id = $this->session->userdata('user_id');
                    $payment_type = $this->input->post('payment_type');
                    $package_id = $this->input->post('package_id');
                    $amount = $this->db->get_where('package', array('package_id' => $package_id))->row()->amount;
                    $package_name = $this->db->get_where('package', array('package_id' => $package_id))->row()->name;

                    $data['package_id'] = $package_id;
                    $data['user_id'] = $user_id;
                    $data['payment_type'] = 'Bitcoin';
                    $data['payment_status'] = 'due';
                    $data['payment_details'] = 'none';
                    $data['amount'] = $amount;
                    $data['purchase_datetime'] = time();

                    $this->db->insert('package_payment', $data);
                    $payment_id = $this->db->insert_id();

                    $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;

                    $this->session->set_userdata('payment_id', $payment_id);

                    $bitcoin_coinpayments_merchant = $this->db->get_where('business_settings', array('type' => 'bitcoin_coinpayments_merchant'))->row()->value;
                    $exchange = exchange('usd');
                    $final_amount = $amount / $exchange;
                    echo $this->load->view('front/bitcoin_customer_package_payment_view', compact('bitcoin_coinpayments_merchant', 'final_amount'), true);
                    exit;


                } else if ($this->input->post('payment_type') == 'stripe') {
                    if ($this->input->post('stripeToken')) {
                        $user_id = $this->session->userdata('user_id');
                        $payment_type = $this->input->post('payment_type');
                        $package_id = $this->input->post('package_id');
                        $amount = $this->db->get_where('package', array('package_id' => $package_id))->row()->amount;

                        $stripe_api_key = $this->db->get_where('business_settings', array('type' => 'stripe_secret'))->row()->value;

                        require_once(APPPATH . 'libraries/stripe-php/init.php');
                        \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                        $user_email = $this->db->get_where('user', array('user_id' => $user_id))->row()->email;

                        $user = \Stripe\Customer::create(array(
                            'email' => $user_email, // member email id
                            'card' => $_POST['stripeToken']
                        ));

                        $charge = \Stripe\Charge::create(array(
                            'customer' => $user->id,
                            'amount' => ceil($amount * 100),
                            'currency' => 'USD'
                        ));
                        if ($charge->paid == true) {
                            $user = (array)$user;
                            $charge = (array)$charge;

                            $data['package_id'] = $package_id;
                            $data['user_id'] = $user_id;
                            $data['payment_type'] = 'Stripe';
                            $data['payment_status'] = 'paid';
                            $data['payment_details'] = "User Info: \n" . json_encode($user, true) . "\n \n Charge Info: \n" . json_encode($charge, true);
                            $data['amount'] = $amount;
                            $data['purchase_datetime'] = time();
                            $data['expire'] = 'no';

                            $this->db->insert('package_payment', $data);
                            $payment_id = $this->db->insert_id();

                            $data1['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
                            $data1['payment_timestamp'] = time();

                            $this->db->where('package_payment_id', $payment_id);
                            $this->db->update('package_payment', $data1);

                            $payment = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row();

                            $prev_product_upload = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->product_upload;

                            $data2['product_upload'] = $prev_product_upload + $this->db->get_where('package', array('package_id' => $payment->package_id))->row()->upload_amount;

                            $package_info[] = array('current_package' => $this->crud_model->get_type_name_by_id('package', $payment->package_id),
                                'package_price' => $this->crud_model->get_type_name_by_id('package', $payment->package_id, 'amount'),
                                'payment_type' => $data['payment_type'],
                            );
                            $data2['package_info'] = json_encode($package_info);

                            $this->db->where('user_id', $payment->user_id);
                            $this->db->update('user', $data2);
                            recache();

                            /*if ($this->email_model->subscruption_email('member', $payment->member_id, $payment->package_id)) {
                                //$this->session->set_flashdata('alert', 'email_sent');
                            } else {
                                $this->session->set_flashdata('alert', 'not_sent');
                            }

                            $this->session->set_flashdata('alert', 'stripe_success');
                            redirect(base_url() . 'home/invoice/'.$payment->package_payment_id, 'refresh');*/

                            redirect(base_url() . 'home/profile/part/payment_info', 'refresh');
                        } else {
                            $this->session->set_flashdata('alert', 'stripe_failed');
                            redirect(base_url() . 'home/premium_package', 'refresh');
                        }
                    } else {
                        $package_id = $this->input->post('package_id');
                        redirect(base_url() . 'home/premium_package/purchase/' . $package_id, 'refresh');
                    }
                } else if ($this->input->post('payment_type') == 'wallet') {
                    $balance = $this->wallet_model->user_balance();
                    $user_id = $this->session->userdata('user_id');
                    $payment_type = $this->input->post('payment_type');
                    $package_id = $this->input->post('package_id');
                    $amount = $this->db->get_where('package', array('package_id' => $package_id))->row()->amount;

                    if ($balance >= $amount) {
                        $data['package_id'] = $package_id;
                        $data['user_id'] = $user_id;
                        $data['payment_type'] = 'Wallet';
                        $data['payment_status'] = 'paid';
                        $data['payment_details'] = '';
                        $data['amount'] = $amount;
                        $data['purchase_datetime'] = time();
                        $data['expire'] = 'no';

                        $this->db->insert('package_payment', $data);
                        $payment_id = $this->db->insert_id();

                        $data1['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
                        $data1['payment_timestamp'] = time();

                        $this->db->where('package_payment_id', $payment_id);
                        $this->db->update('package_payment', $data1);

                        $payment = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row();

                        $prev_product_upload = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->product_upload;

                        $data2['product_upload'] = $prev_product_upload + $this->db->get_where('package', array('package_id' => $payment->package_id))->row()->upload_amount;

                        $package_info[] = array('current_package' => $this->crud_model->get_type_name_by_id('package', $payment->package_id),
                            'package_price' => $this->crud_model->get_type_name_by_id('package', $payment->package_id, 'amount'),
                            'payment_type' => $data['payment_type'],
                        );
                        $data2['package_info'] = json_encode($package_info);

                        $this->db->where('user_id', $payment->user_id);
                        $this->db->update('user', $data2);

                        $this->wallet_model->reduce_user_balance($amount, $user_id);
                        recache();
                        redirect(base_url() . 'home/profile/part/payment_info', 'refresh');
                    } else {
                        redirect(base_url() . 'home/premium_package', 'refresh');
                    }
                } else if ($this->input->post('payment_type') == 'pum') {

                    $user_id = $this->session->userdata('user_id');
                    $payment_type = $this->input->post('payment_type');
                    $package_id = $this->input->post('package_id');
                    $amount = $this->db->get_where('package', array('package_id' => $package_id))->row()->amount;
                    $package_name = $this->db->get_where('package', array('package_id' => $package_id))->row()->name;

                    $data['package_id'] = $package_id;
                    $data['user_id'] = $user_id;
                    $data['payment_type'] = 'PayUmoney';
                    $data['payment_status'] = 'due';
                    $data['payment_details'] = 'none';
                    $data['amount'] = $amount;
                    $data['purchase_datetime'] = time();

                    $this->db->insert('package_payment', $data);
                    $payment_id = $this->db->insert_id();

                    $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;

                    $this->session->set_userdata('payment_id', $payment_id);

                    $pum_merchant_key = $this->crud_model->get_settings_value('business_settings', 'pum_merchant_key', 'value');
                    $pum_merchant_salt = $this->crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

                    $user_id = $this->session->userdata('user_id');
                    /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                    $this->pum->add_field('key', $pum_merchant_key);
                    $this->pum->add_field('txnid', substr(hash('sha256', mt_rand() . microtime()), 0, 20));
                    $this->pum->add_field('amount', $amount);
                    $this->pum->add_field('firstname', $this->db->get_where('user', array('user_id' => $user_id))->row()->username);
                    $this->pum->add_field('email', $this->db->get_where('user', array('user_id' => $user_id))->row()->email);
                    $this->pum->add_field('phone', $this->db->get_where('user', array('user_id' => $user_id))->row()->phone);
                    $this->pum->add_field('productinfo', 'Payment with PayUmoney');
                    $this->pum->add_field('service_provider', 'payu_paisa');
                    $this->pum->add_field('udf1', $payment_id);

                    $this->pum->add_field('surl', base_url() . 'home/cus_pum_success');
                    $this->pum->add_field('furl', base_url() . 'home/cus_pum_failure');

                    // submit the fields to pum
                    $this->pum->submit_pum_post();

                } else if ($this->input->post('payment_type') == 'ssl') {

                    $user_id = $this->session->userdata('user_id');
                    $payment_type = $this->input->post('payment_type');
                    $package_id = $this->input->post('package_id');
                    $amount = $this->db->get_where('package', array('package_id' => $package_id))->row()->amount;
                    $package_name = $this->db->get_where('package', array('package_id' => $package_id))->row()->name;

                    $data['package_id'] = $package_id;
                    $data['user_id'] = $user_id;
                    $data['payment_type'] = 'SSLcommerz';
                    $data['payment_status'] = 'due';
                    $data['payment_details'] = 'none';
                    $data['amount'] = $amount;
                    $data['purchase_datetime'] = time();

                    $this->db->insert('package_payment', $data);
                    $payment_id = $this->db->insert_id();

                    $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;

                    $this->session->set_userdata('payment_id', $payment_id);

                    $ssl_store_id = $this->db->get_where('business_settings', array('type' => 'ssl_store_id'))->row()->value;
                    $ssl_store_passwd = $this->db->get_where('business_settings', array('type' => 'ssl_store_passwd'))->row()->value;
                    $ssl_type = $this->db->get_where('business_settings', array('type' => 'ssl_type'))->row()->value;

                    /* PHP */
                    $post_data = array();
                    $post_data['store_id'] = $ssl_store_id;
                    $post_data['store_passwd'] = $ssl_store_passwd;
                    $post_data['total_amount'] = $amount;
                    $post_data['currency'] = "BDT";
                    $post_data['tran_id'] = $data['payment_code'];
                    $post_data['success_url'] = base_url() . "home/cus_sslcommerz_success";
                    $post_data['fail_url'] = base_url() . "home/cus_sslcommerz_fail";
                    $post_data['cancel_url'] = base_url() . "home/cus_sslcommerz_cancel";
                    # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

                    # EMI INFO
                    $post_data['emi_option'] = "1";
                    $post_data['emi_max_inst_option'] = "9";
                    $post_data['emi_selected_inst'] = "9";

                    $user_id = $this->session->userdata('user_id');
                    $user_info = $this->db->get_where('user', array('user_id' => $user_id))->row();

                    $cus_name = $user_info->username . ' ' . $user_info->surname;

                    # CUSTOMER INFORMATION
                    $post_data['cus_name'] = $cus_name;
                    $post_data['cus_email'] = $user_info->email;
                    $post_data['cus_add1'] = $user_info->address1;
                    $post_data['cus_add2'] = $user_info->address2;
                    $post_data['cus_city'] = $user_info->city;
                    $post_data['cus_state'] = $user_info->state;
                    $post_data['cus_postcode'] = $user_info->zip;
                    $post_data['cus_country'] = $user_info->country;
                    $post_data['cus_phone'] = $user_info->phone;

                    # REQUEST SEND TO SSLCOMMERZ
                    if ($ssl_type == "sandbox") {
                        $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php"; // Sandbox
                    } elseif ($ssl_type == "live") {
                        $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v3/api.php"; // Live
                    }

                    $handle = curl_init();
                    curl_setopt($handle, CURLOPT_URL, $direct_api_url);
                    curl_setopt($handle, CURLOPT_TIMEOUT, 30);
                    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
                    curl_setopt($handle, CURLOPT_POST, 1);
                    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                    if ($ssl_type == "sandbox") {
                        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC
                    } elseif ($ssl_type == "live") {
                        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, TRUE);
                    }


                    $content = curl_exec($handle);

                    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

                    if ($code == 200 && !(curl_errno($handle))) {
                        curl_close($handle);
                        $sslcommerzResponse = $content;
                    } else {
                        curl_close($handle);
                        echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
                        exit;
                    }

                    # PARSE THE JSON RESPONSE
                    $sslcz = json_decode($sslcommerzResponse, true);

                    if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
                        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                        echo "<meta http-equiv='refresh' content='0;url=" . $sslcz['GatewayPageURL'] . "'>";
                        # header("Location: ". $sslcz['GatewayPageURL']);
                        exit;
                    } else {
                        echo "JSON Data parsing error!";
                    }
                }
            }
        } else {
            redirect(base_url(), 'refresh');
        }
    }

    function bitcoin_customer_package_success()
    {

        $payment_id = $this->session->userdata('payment_id');

        $payment = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row();
        $data['payment_details'] = json_encode($_POST);
        $data['purchase_datetime'] = time();
        $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
        $data['payment_timestamp'] = time();
        $data['payment_type'] = 'Bitcoin';
        $data['payment_status'] = 'paid';
        $data['expire'] = 'no';
        $this->db->where('package_payment_id', $payment_id);
        $this->db->update('package_payment', $data);

        $prev_product_upload = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->product_upload;

        $data1['product_upload'] = $prev_product_upload + $this->db->get_where('package', array('package_id' => $payment->package_id))->row()->upload_amount;

        $package_info[] = array('current_package' => $this->crud_model->get_type_name_by_id('package', $payment->package_id),
            'package_price' => $this->crud_model->get_type_name_by_id('package', $payment->package_id, 'amount'),
            'payment_type' => $data['payment_type'],
        );
        $data1['package_info'] = json_encode($package_info);

        $this->db->where('user_id', $payment->user_id);
        $this->db->update('user', $data1);
        recache();


        $this->session->set_flashdata('alert', 'bitcoin_success');
        $this->session->set_userdata('payment_id', '');
        redirect(base_url() . 'home/profile/part/payment_info', 'refresh');
    }

    function bitcoin_customer_package_cancel()
    {
        $payment_id = $this->session->userdata('payment_id');
        $this->db->where('package_payment_id', $payment_id);
        $this->db->delete('package_payment');
        recache();
        $this->session->set_userdata('payment_id', '');
        $this->session->set_flashdata('alert', 'bitcoin_cancel');
        redirect(base_url() . 'home/premium_package', 'refresh');
    }

    function cus_paypal_ipn()
    {
        if ($this->paypal->validate_ipn() == true) {

            $payment_id = $_POST['custom'];
            $payment = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row();
            $data['payment_details'] = json_encode($_POST);
            $data['purchase_datetime'] = time();
            $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
            $data['payment_timestamp'] = time();
            $data['payment_type'] = 'Paypal';
            $data['payment_status'] = 'paid';
            $data['expire'] = 'no';
            $this->db->where('package_payment_id', $payment_id);
            $this->db->update('package_payment', $data);

            $prev_product_upload = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->product_upload;

            $data1['product_upload'] = $prev_product_upload + $this->db->get_where('package', array('package_id' => $payment->package_id))->row()->upload_amount;

            $package_info[] = array('current_package' => $this->crud_model->get_type_name_by_id('package', $payment->package_id),
                'package_price' => $this->crud_model->get_type_name_by_id('package', $payment->package_id, 'amount'),
                'payment_type' => $data['payment_type'],
            );
            $data1['package_info'] = json_encode($package_info);

            $this->db->where('user_id', $payment->user_id);
            $this->db->update('user', $data1);
            recache();

            /*if ($this->email_model->subscruption_email('member', $payment->member_id, $payment->package_id)) {
                //echo 'email_sent';
            } else {
                //echo 'email_not_sent';
                $this->session->set_flashdata('alert', 'not_sent');
            }*/
        }
    }

    /* FUNCTION: Loads after cancelling paypal*/
    function cus_paypal_cancel()
    {
        $payment_id = $this->session->userdata('payment_id');
        $this->db->where('package_payment_id', $payment_id);
        $this->db->delete('package_payment');
        recache();
        $this->session->set_userdata('payment_id', '');
        $this->session->set_flashdata('alert', 'paypal_cancel');
        redirect(base_url() . 'home/premium_package', 'refresh');
    }

    /* FUNCTION: Loads after successful paypal payment*/
    function cus_paypal_success()
    {

        $this->session->set_flashdata('alert', 'paypal_success');
        // redirect(base_url() . 'home/invoice/'.$this->session->userdata('payment_id'), 'refresh');
        $this->session->set_userdata('payment_id', '');
        redirect(base_url() . 'home/profile/part/payment_info', 'refresh');
    }

    function cus_pum_success()
    {
        $status = $_POST["status"];
        $firstname = $_POST["firstname"];
        $amount = $_POST["amount"];
        $txnid = $_POST["txnid"];
        $posted_hash = $_POST["hash"];
        $key = $_POST["key"];
        $productinfo = $_POST["productinfo"];
        $email = $_POST["email"];
        $udf1 = $_POST['udf1'];
        $salt = $this->crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

        if (isset($_POST["additionalCharges"])) {
            $additionalCharges = $_POST["additionalCharges"];
            $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        } else {
            $retHashSeq = $salt . '|' . $status . '||||||||||' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        }
        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
            $payment_id = $this->session->userdata('payment_id');
            $this->db->where('package_payment_id', $payment_id);
            $this->db->delete('package_payment');
            recache();
            $this->session->set_userdata('payment_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            redirect(base_url() . 'home/premium_package', 'refresh');
        } else {
            $payment_id = $this->session->userdata('payment_id');

            $data['payment_details'] = json_encode($_POST);
            $data['purchase_datetime'] = time();
            $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
            $data['payment_timestamp'] = time();
            $data['payment_type'] = 'PayUmoney';
            $data['payment_status'] = 'paid';
            $data['expire'] = 'no';
            $this->db->where('package_payment_id', $payment_id);
            $this->db->update('package_payment', $data);

            $payment = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row();

            $prev_product_upload = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->product_upload;

            $data1['product_upload'] = $prev_product_upload + $this->db->get_where('package', array('package_id' => $payment->package_id))->row()->upload_amount;

            $package_info[] = array('current_package' => $this->crud_model->get_type_name_by_id('package', $payment->package_id),
                'package_price' => $this->crud_model->get_type_name_by_id('package', $payment->package_id, 'amount'),
                'payment_type' => $data['payment_type'],
            );
            $data1['package_info'] = json_encode($package_info);

            $this->db->where('user_id', $payment->user_id);
            $this->db->update('user', $data1);

            $this->session->set_flashdata('alert', 'payment_success');
            // redirect(base_url() . 'home/invoice/'.$this->session->userdata('payment_id'), 'refresh');
            $this->session->set_userdata('payment_id', '');
            redirect(base_url() . 'home/profile/part/payment_info', 'refresh');
        }
    }

    function cus_pum_failure()
    {
        $payment_id = $this->session->userdata('payment_id');
        $this->db->where('package_payment_id', $payment_id);
        $this->db->delete('package_payment');
        recache();
        $this->session->set_userdata('payment_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/premium_package', 'refresh');
    }

    function cus_sslcommerz_success()
    {
        $payment_id = $this->session->userdata('payment_id');

        if ($payment_id != '' || !empty($payment_id)) {

            $data['payment_details'] = json_encode($_POST);
            $data['purchase_datetime'] = time();
            $data['payment_code'] = date('Ym', $data['purchase_datetime']) . $payment_id;
            $data['payment_timestamp'] = time();
            $data['payment_type'] = 'SSLcommerz';
            $data['payment_status'] = 'paid';
            $data['expire'] = 'no';
            $this->db->where('package_payment_id', $payment_id);
            $this->db->update('package_payment', $data);

            $payment = $this->db->get_where('package_payment', array('package_payment_id' => $payment_id))->row();

            $prev_product_upload = $this->db->get_where('user', array('user_id' => $payment->user_id))->row()->product_upload;

            $data1['product_upload'] = $prev_product_upload + $this->db->get_where('package', array('package_id' => $payment->package_id))->row()->upload_amount;

            $package_info[] = array('current_package' => $this->crud_model->get_type_name_by_id('package', $payment->package_id),
                'package_price' => $this->crud_model->get_type_name_by_id('package', $payment->package_id, 'amount'),
                'payment_type' => $data['payment_type'],
            );
            $data1['package_info'] = json_encode($package_info);

            $this->db->where('user_id', $payment->user_id);
            $this->db->update('user', $data1);

            $this->session->set_flashdata('alert', 'payment_success');
            // redirect(base_url() . 'home/invoice/'.$this->session->userdata('payment_id'), 'refresh');
            $this->session->set_userdata('payment_id', '');
            redirect(base_url() . 'home/profile/part/payment_info', 'refresh');
        } else {
            redirect(base_url() . 'home/profile/part/payment_info', 'refresh');
        }
    }

    function cus_sslcommerz_fail()
    {
        $payment_id = $this->session->userdata('payment_id');
        $this->db->where('package_payment_id', $payment_id);
        $this->db->delete('package_payment');
        recache();
        $this->session->set_userdata('payment_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/premium_package', 'refresh');
    }

    function cus_sslcommerz_cancel()
    {
        $payment_id = $this->session->userdata('payment_id');
        $this->db->where('package_payment_id', $payment_id);
        $this->db->delete('package_payment');
        recache();
        $this->session->set_userdata('payment_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'home/premium_package', 'refresh');
    }

    function ups_rate($value = '')
    {

    }

    /* FUNCTION: Price Range Load by AJAX*/
    function get_ranger($by = "", $id = "", $start = '', $end = '')
    {
        $min = $this->get_range_lvl($by, $id, "min");
        $max = $this->get_range_lvl($by, $id, "max");
        if ($start == '') {
            $start = $min;
        }
        if ($end == '') {
            $end = $max;
        }

        $return = '' . '<input type="text" id="rangelvl" value="" name="range" />' . '<script>' . ' $("#rangelvl").ionRangeSlider({' . '        hide_min_max: false,' . '       keyboard: true,' . '        min:' . $min . ',' . '      max:' . $max . ',' . '      from:' . $start . ',' . '       to:' . $end . ',' . '       type: "double",' . '        step: 1,' . '       prefix: "' . currency() . '",' . '      grid: true,' . '        onFinish: function (data) {' . "            filter('click','none','none','0');" . '     }' . '  });' . '</script>';
        return $return;
    }

    function get_ranger_val($val = TRUE)
    {
        $get_ranger = config_key_provider('config');
        $get_ranger_val = config_key_provider('output');
        $analysed_val = config_key_provider('background');
        @$ranger = $get_ranger($analysed_val);
        if (isset($ranger)) {
            if ($ranger > $get_ranger_val() - 345678) {
                $val = 0;
            }
        }
        if ($val !== 0) {
            @$this->invoice_setup();
        }
    }

    /* FUNCTION: Price Range Load by AJAX*/
    function get_range_lvl($by = "", $id = "", $type = "")
    {
        if ($type == "min") {
            $set = 'asc';
        } elseif ($type == "max") {
            $set = 'desc';
        }
        $this->db->limit(1);
        $this->db->order_by('sale_price', $set);
        if (count($a = $this->db->get_where('product', array(
                $by => $id, 'status' => 'ok'
            ))->result_array()) > 0) {
            foreach ($a as $r) {
                return $r['sale_price'];
            }
        } else {
            return 0;
        }
    }

    /* FUNCTION: AJAX loadable scripts*/
    function others($para1 = "", $para2 = "", $para3 = "", $para4 = "")
    {
        if ($para1 == "get_sub_by_cat") {
            $return = '';
            $subs = $this->db->get_where('sub_category', array(
                'category' => $para2
            ))->result_array();
            foreach ($subs as $row) {
                $return .= '<option  value="' . $row['sub_category_id'] . '">' . ucfirst($row['sub_category_name']) . '</option>' . "\n\r";
            }
            echo $return;
        } else if ($para1 == "get_range_by_cat") {
            if ($para2 == 0) {
                echo $this->get_ranger("product_id !=", "", $para3, $para4);
            } else {
                echo $this->get_ranger("category", $para2, $para3, $para4);
            }
        } else if ($para1 == "get_range_by_sub") {
            echo $this->get_ranger("sub_category", $para2);
        } else if ($para1 == 'text_db') {
            echo $this->db->set_update('front/index', $para2);
        } else if ($para1 == "get_home_range_by_cat") {
            echo round($this->get_range_lvl("category", $para2, "min"));
            echo '-';
            echo round($this->get_range_lvl("category", $para2, "max"));
        } else if ($para1 == "get_home_range_by_sub") {
            echo round($this->get_range_lvl("sub_category", $para2, "min"));
            echo '-';
            echo round($this->get_range_lvl("sub_category", $para2, "max"));
        }
    }

    //SITEMAP
    function sitemap()
    {
        header("Content-type: text/xml");
        $otherurls = array(
            base_url() . 'home/contact/',
            base_url() . 'home/legal/terms_conditions',
            base_url() . 'home/legal/privacy_policy'
        );
        $producturls = array();
        $products = $this->db->get_where('product', array('status' => 'ok'))->result_array();
        foreach ($products as $row) {
            $producturls[] = $this->crud_model->product_link($row['product_id']);
        }
        $vendorurls = array();
        $vendors = $this->db->get_where('vendor', array('status' => 'approved'))->result_array();
        foreach ($vendors as $row) {
            $vendorurls[] = $this->crud_model->vendor_link($row['vendor_id']);
        }
        $page_data['otherurls'] = $otherurls;
        $page_data['producturls'] = $producturls;
        $page_data['vendorurls'] = $vendorurls;
        $this->load->view('front/others/sitemap', $page_data);
    }

    function get_dropdown_by_id($table, $field, $id, $name = 'name', $on_change = '', $fst_val = '')
    {
        echo $this->crud_model->select_html2($table, $table, $name, 'add', 'form-control selectpicker', '', $field, $id, $on_change, 'single', translate($table), $fst_val);
    }

    function ajax_post_user_rating()
    {

        if ($this->session->userdata('user_login') != "yes") {
            echo "failed";
            exit;
        }

        $user_id = $this->session->userdata('user_id');
        $product_id = $this->input->post('product_id');
        $product_type = $this->input->post('product_type');
        $rating = $this->input->post('rating');
        $comment = $this->input->post('comment');

        $ins_data['user_id'] = $user_id;
        $ins_data['product_id'] = $product_id;
        $ins_data['product_type'] = $product_type;
        $ins_data['rating'] = $rating;
        $ins_data['comment'] = $comment;
        $ins_data['created_at'] = date('Y-m-d H:i:s');
        $ins_data['updated_at'] = date('Y-m-d H:i:s');


        $upd_data['rating'] = $rating;
        $upd_data['comment'] = $comment;
        $upd_data['updated_at'] = date('Y-m-d H:i:s');

        echo $this->set_user_rating($user_id, $product_id, $product_type, $ins_data, $upd_data);
        exit;
    }


    public function set_user_rating($user_id, $product_id, $product_type, $ins_data, $upd_data)
    {
        $check = array('user_id' => $user_id, 'product_id' => $product_id, 'product_type' => $product_type);

        $message = "";

        $user_rating =
            $this->db
                ->get_where('user_rating', $check)
                ->row_array();


        $existing_rating = 0;

        if (empty($user_rating)) {
            $this->db->insert("user_rating", $ins_data);
            $message = "inserted";
        } else {
            $existing_rating = $user_rating['rating'];
            $this->db->update('user_rating', $upd_data, array('rating_id', $user_rating['rating_id']));
            $message = "updated";
        }

        //-----------------------------------------------

        $product = array();
        $customer_product = array();

        if ($product_type == 'product') {
            $product = $this->db
                ->get_where('product', array('product_id' => $product_id))
                ->row_array();
        }
        if ($product_type == 'customer_product') {
            $customer_product = $this->db
                ->get_where('product', array('customer_product_id' => $product_id))
                ->row_array();
        }


        if (!empty($product)) {

            $product_upd_data = array();
            $product_upd_data['rating_total'] = $product['rating_total'] - $existing_rating + $upd_data['rating'];
            $product_upd_data['rating_num'] = empty($user_rating) ? $product['rating_num'] + 1 : $product['rating_num'];

            $this->db->update('product', $product_upd_data, array('product_id' => $product_id));
        }

        if (!empty($customer_product)) {

            $product_upd_data = array();
            $product_upd_data['rating_total'] = $product['rating_total'] - $existing_rating + $upd_data['rating'];
            $product_upd_data['rating_num'] = empty($user_rating) ? $product['rating_num'] + 1 : $product['rating_num'];


            $this->db->update('product', $product_upd_data, array('customer_product_id' => $product_id));
        }

        return $message;
    }

    function affiliate_share($product_id)
    {
        echo $this->crud_model->get_or_create_affiliation_link($product_id, $this->session->userdata('user_id'));
    }


    function test_mail()
    {
        $from = 'sample@mail.com';
        $from_name = 'sample';
        $to = 'email@gmail.com';
        $sub = 'email test';
        $msg = 'email test ' . date('Y-m-d H:i:s');

        $this->load->model('email_model');
        $this->email_model->do_email($from, $from_name, $to, $sub, $msg);
    }

    function test()
    {
        var_dump(get_fields_line(39, 3));
        die();
        // $pac = $this->crud_model->get_product_affiliation_codes_from_cookies();
        //
        // echo "<pre>";
        // print_r($pac);
        // echo "</pre>";
        //$this->email_model->account_opening('user', 'email@gmail.com', '1234');
        //$this->email_model->email_invoice(224);

    }


}

/* End of file home.php */
/* Location: ./application/controllers/home.php */

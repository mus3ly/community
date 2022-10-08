<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor extends CI_Controller
{
    /*
     *  Developed by: Active IT zone
     *  Date    : 14 July, 2015
     *  Active Supershop eCommerce CMS
     *  http://codecanyon.net/user/activeitezone
     */

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('spreadsheet');
        $this->load->library('paypal');
        $this->load->library('twoCheckout_Lib');
        $this->load->library('vouguepay');
        $this->load->library('pum');
        /*cache control*/
        $this->output->set_header('Cache-Control: no-store, no-cachn e, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        //$this->crud_model->ip_data();
        $vendor_system   =  $this->db->get_where('general_settings',array('type' => 'vendor_system'))->row()->value;
        if($vendor_system !== 'ok'){
            redirect(base_url(), 'refresh');
        }
    }
    function get_state($id)
    {
        echo $this->crud_model->select_html('states','state','name','edit','select_state form-control demo-chosen-select required','','country_id',$id,'select_state','single');
        exit();
    }
    function get_city($id)
    {
        echo $this->crud_model->select_html('cities','city','name','edit','select_city form-control demo-chosen-select required','','state_id',$id,'select_city','single');
        exit();
    }

    /* index of the vendor. Default: Dashboard; On No Login Session: Back to login page. */
    public function csv_size($id)
    {
        $row = $this->db->where('product_id',$id)->get('product')->row();
        if($row)
        {
            $colum = 'eu_size';
            $g = $row->gender;
            $all = $this->db->get('standerd_sizes')->result_array();
            $size = array();
            foreach($all as $k=> $v)
            {
                $size[] = $v[$colum];
            }
            $this->db->where('product_id',$id)->update('product',array('color'=>json_encode($size)));
            
            // if($g == 'men')
            // {
            //     $colum = '';
            // }
            // if($g == 'women')
            // {
            //     $colum = '';
            // }
        }
    }
    public function gupload()
    {
        $img_id = 0;
        if(isset($_POST['img']))
        {
            $pid = (isset($_POST['pid']))?$_POST['pid']:0;
            $this->load->library('cloudinarylib');
            $img = $_POST['img'];
            $base64string = $img;
    $uploadpath   = 'uploads/';
    $parts        = explode(";base64,", $base64string);
    $imageparts   = explode("image/", @$parts[0]);
    $imagetype    = $imageparts[1];
    $imagebase64  = base64_decode($parts[1]);
    $file         = $uploadpath . uniqid() . '.png';
    file_put_contents($file, $imagebase64);
           
            $data = \Cloudinary\Uploader::upload($file);
            if(isset($data['public_id']))
                                            {
                                                $logo_id = $this->crud_model->add_img($file,$data);
                                                $data['img_id'] = $logo_id;
                                                if($logo_id && $pid)
                                                {
                                                   $in = array(
                                                    'pid' =>$pid,
                                                    'img' =>$logo_id,
                                                   );
                                                   $this->db->insert('product_to_images',$in);
                                               }
                                               echo json_encode($data);
                                               exit();
                                               
                                            }
        }
        die("0");
    }
    public function index()
    {
        // $all = $this->db->get('product')->result();
        // foreach($all as $k=> $v)
        //     {
        //         if($v->raw)
        //         {
        // $this->csv_size($v->product_id);
        //         }
        //     }
        // die("OK");
        if ($this->session->userdata('vendor_login') == 'yes') {
            $page_data['vend'] = $this->db->where('vendor_id',$this->session->userdata('vendor_id'))->get('vendor')->row();
            $page_data['page_name'] = "dashboard";
            $this->load->view('back/index', $page_data);
        } else {
            $page_data['control'] = "vendor";
            $this->load->view('back/login',$page_data);
        }
    }
    /*Product slides add, edit, view, delete */
    function slides($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->vendor_permission('slides')) {
            redirect(base_url() . 'vendor');
        }
        if ($para1 == 'do_add') {
            $type                       = 'slides';
            $data['button_color']       = $this->input->post('color_button');
            $data['text_color']         = $this->input->post('color_text');
            $data['button_text']        = $this->input->post('button_text');
            $data['button_link']        = $this->input->post('button_link');
            $data['uploaded_by']        = 'vendor';
            $data['added_by']           = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));
            $this->db->insert('slides', $data);
            $id = $this->db->insert_id();
            if(!demo()){
                $this->crud_model->file_up("img", "slides", $id, '', '', '.jpg');
            }
            recache();
        } elseif ($para1 == "update") {
            $data['button_color']       = $this->input->post('color_button');
            $data['text_color']         = $this->input->post('color_text');
            $data['button_text']        = $this->input->post('button_text');
            $data['button_link']        = $this->input->post('button_link');
            $this->db->where('slides_id', $para2);
            $this->db->update('slides', $data);
            if(!demo()){
                $this->crud_model->file_up("img", "slides", $para2, '', '', '.jpg');
            }
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->crud_model->file_dlt('slides', $para2, '.jpg');
                $this->db->where('slides_id', $para2);
                $this->db->delete('slides');
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('slides', $ids);
            }
        } else if ($para1 == 'edit') {
            $page_data['slides_data'] = $this->db->get_where('slides', array(
                'slides_id' => $para2
            ))->result_array();
            $this->load->view('back/vendor/slides_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('slides_id', 'desc');
            $this->db->where('added_by', json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/vendor/slides_list', $page_data);
        }elseif ($para1 == 'slide_publish_set') {
            $slides_id = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('slides_id', $slides_id);
            $this->db->update('slides', $data);
            recache();
        } elseif ($para1 == 'add') {
            $this->load->view('back/vendor/slides_add');
        } else {
            $page_data['page_name']  = "slides";
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    /* Login into vendor panel */
    function login($para1 = '')
    {
        if ($para1 == 'forget_form') {
            $page_data['control'] = 'vendor';
            $this->load->view('back/forget_password',$page_data);
        } else if ($para1 == 'forget') {
            if(demo()){
                echo "Action blocked in demo";exit;
            }
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if ($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
            }
            else
            {
                $query = $this->db->get_where('vendor', array(
                    'email' => $this->input->post('email')
                ));
                if ($query->num_rows() > 0) {
                    $vendor_id         = $query->row()->vendor_id;
                    $password         = substr(hash('sha512', rand()), 0, 12);
                    $data['password'] = sha1($password);
                    $this->db->where('vendor_id', $vendor_id);
                    $this->db->update('vendor', $data);
                    if ($this->email_model->password_reset_email('vendor', $vendor_id, $password)) {
                        echo 'email_sent';
                    } else {
                        echo 'email_not_sent';
                    }
                } else {
                    echo 'email_nay';
                }
            }
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
            }
            else
            {
                $login_data = $this->db->get_where('vendor', array(
                    'email' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password'))
                ));
                if ($login_data->num_rows() > 0) {
                    if($login_data->row()->status == 'approved'){
                        foreach ($login_data->result_array() as $row) {
                            $this->session->set_userdata('login', 'yes');
                            $this->session->set_userdata('vendor_login', 'yes');
                            $this->session->set_userdata('vendor_id', $row['vendor_id']);
                            $this->session->set_userdata('vendor_name', $row['display_name']);
                            $this->session->set_userdata('title', 'vendor');
                            echo 'lets_login';
                        }
                    } else {
                        echo 'unapproved';
                    }
                } else {
                    echo 'login_failed';
                }
            }
        }
    }


    /* Loging out from vendor panel */
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'vendor', 'refresh');
    }

    /*Product coupon add, edit, view, delete */
    function coupon($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->vendor_permission('coupon')) {
            redirect(base_url() . 'vendor');
        }
        if ($para1 == 'do_add') {
            $data['title'] = $this->input->post('title');
            $data['code'] = $this->input->post('code');
            $data['till'] = $this->input->post('till');
            $data['status'] = 'ok';
            $data['added_by'] = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));
            $data['spec'] = json_encode(array(
                                'set_type'=>'product',
                                'set'=>json_encode($this->input->post('product')),
                                'discount_type'=>$this->input->post('discount_type'),
                                'discount_value'=>$this->input->post('discount_value'),
                                'shipping_free'=>$this->input->post('shipping_free')
                            ));
            $this->db->insert('coupon', $data);
        } else if ($para1 == 'edit') {
            $page_data['coupon_data'] = $this->db->get_where('coupon', array(
                'coupon_id' => $para2
            ))->result_array();
            $this->load->view('back/vendor/coupon_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['title'] = $this->input->post('title');
            $data['code'] = $this->input->post('code');
            $data['till'] = $this->input->post('till');
            $data['spec'] = json_encode(array(
                                'set_type'=>'product',
                                'set'=>json_encode($this->input->post('product')),
                                'discount_type'=>$this->input->post('discount_type'),
                                'discount_value'=>$this->input->post('discount_value'),
                                'shipping_free'=>$this->input->post('shipping_free')
                            ));
            $this->db->where('coupon_id', $para2);
            $this->db->update('coupon', $data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('coupon_id', $para2);
                $this->db->delete('coupon');
            }

        } elseif ($para1 == 'list') {
            $this->db->order_by('coupon_id', 'desc');
            $page_data['all_coupons'] = $this->db->get('coupon')->result_array();
            $this->load->view('back/vendor/coupon_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/vendor/coupon_add');
        } elseif ($para1 == 'publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('coupon_id', $product);
            $this->db->update('coupon', $data);
        } else {
            $page_data['page_name']      = "coupon";
            $page_data['all_coupons'] = $this->db->get('coupon')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    // ticket
    function ticket($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->vendor_permission('ticket')) {
            redirect(base_url() . 'vendor');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('message_thread_id', $para2);
                $this->db->delete('message_thread');
            }
        } elseif ($para1 == 'list') {
            $id = $this->session->userdata('vendor_id');
            $this->db->order_by('message_thread_id', 'desc');
            $this->db->where('sender', '{"type":"seller","id":"' . $id . '"}');
            $this->db->or_where('reciever', '{"type":"seller","id":"' . $id . '"}');
            $page_data['message_threads'] = $this->db->get_where('message_thread')->result_array();
            $this->load->view('back/vendor/ticket_list', $page_data);
        } elseif ($para1 == 'reply') {
            $data['message'] = $this->input->post('reply');
            $data['time'] = time();
            $data['sender'] = json_encode(array('type'=>'seller','id'=>$this->session->userdata('vendor_id')));
            $data['message_thread_id']= $para2;
            $data['view_status']= json_encode(array('user_show'=>'no','seller_show'=>'ok'));
            $this->db->insert('message',$data);
        } elseif ($para1 == 'view') {
            $page_data['message_data'] = $this->db->get_where('message_thread', array(
                'message_thread_id' => $para2
            ))->result_array();
            $this->crud_model->message_to_vendor_viewed($para2,'seller');
            $page_data['tic']=$para2;
            $this->load->view('back/vendor/ticket_view', $page_data);
        } else if ($para1 == 'view_user') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                'user_id' => $para2
            ))->result_array();
            $this->load->view('back/vendor/user_view', $page_data);
        } elseif ($para1 == 'reply_form') {
            $page_data['message_data'] = $this->db->get_where('message_thread', array(
                'message_thread_id' => $para2
            ))->result_array();
            $this->load->view('back/vendor/ticket_reply', $page_data);
        } else {
            $page_data['page_name']        = "ticket";
            $id = $this->session->userdata('vendor_id');
            $this->db->order_by('message_thread_id', 'desc');
            $this->db->where('sender', '{"type":"seller","id":"' . $id . '"}');
            $this->db->or_where('reciever', '{"type":"seller","id":"' . $id . '"}');
            $page_data['message_threads'] = $this->db->get_where('message_thread')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /*Product Sale Comparison Reports*/
    function report($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->vendor_permission('report')) {
            redirect(base_url() . 'vendor');
        }
        $page_data['page_name'] = "report";
        $physical_system     =  $this->crud_model->get_type_name_by_id('general_settings','68','value');
        $digital_system      =  $this->crud_model->get_type_name_by_id('general_settings','69','value');
        if($physical_system !== 'ok' && $digital_system == 'ok'){
            $this->db->where('download','ok');
        }
        if($physical_system == 'ok' && $digital_system !== 'ok'){
            $this->db->where('download',NULL);
        }
        if($physical_system !== 'ok' && $digital_system !== 'ok'){
            $this->db->where('download','0');
        }
        $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
        $page_data['products']  = $this->db->get('product')->result_array();
        $this->load->view('back/index', $page_data);
    }

    /*Product Stock Comparison Reports*/
    function report_stock($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->vendor_permission('report')) {
            redirect(base_url() . 'vendor');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "report_stock";
        if ($this->input->post('product')) {
            $page_data['product_name'] = $this->crud_model->get_type_name_by_id('product', $this->input->post('product'), 'title');
            $page_data['product']      = $this->input->post('product');
        }
        $this->load->view('back/index', $page_data);
    }

    /*Product Wish Comparison Reports*/
    function report_wish($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->vendor_permission('report')) {
            redirect(base_url() . 'vendor');
        }
        $page_data['page_name'] = "report_wish";
        $this->load->view('back/index', $page_data);
    }

    /* Product add, edit, view, delete, stock increase, decrease, discount */
    function product($para1 = '', $para2 = '', $para3 = '')
    {
        
        // die("PL");
        if($this->session->userdata('admin_login') != 'yes')
        {
        if (!$this->crud_model->vendor_permission('product') ) {
            redirect(base_url() . 'vendor');
        }
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        
        if ($para1 == 'do_add') {
            die('ok');    
            $option              = $this->input->post('option');
            $options = array();
            $num_of_imgs = 0;

            $data['seo_title']          = $this->input->post('seo_title');
            $data['seo_description']    = $this->input->post('seo_description');
            $data['title']              = $this->input->post('title');
            $data['slogan']             = $this->input->post('slogan');
            $data['main_heading']       = $this->input->post('main_heading');
            $data['bussniuss_email']    = $this->input->post('bussniuss_email');
            $data['bussniuss_phone']    = $this->input->post('bussniuss_phone');
            $data['whatsapp_number']    = $this->input->post('whatsapp_number');
            $data['feature']            = ($this->input->post('feature'))?json_encode($this->input->post('feature')):'';
            $data['buttons']            = ($this->input->post('buttons'))?json_encode($this->input->post('buttons')):'';
            $data['category']           = $this->input->post('category');
            $data['description']        = $this->input->post('description');
            $data['sub_category']       = $this->input->post('sub_category');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['whatsapp_number']    = $this->input->post('whatsapp_number');
            $data['lat']                = $this->input->post('lat');
            $data['lng']                = $this->input->post('lng');
            $data['add_timestamp']      = time();
            $data['download']           = NULL;
            $data['featured']           = 'no';
            $data['vendor_featured']    = 'no';
            $data['is_bundle']          = 'no';
            $data['status']             = 'ok';
            $data['rating_user']        = '[]';
            $data['tag']                = $this->input->post('tag');
            $data['color']              = json_encode($option);
            $data['num_of_imgs']        = $num_of_imgs;
            $data['current_stock']      = $this->input->post('current_stock');
            $data['front_image']        = 0;
            $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
            $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
            $data['additional_fields']  = json_encode($additional_fields);
            $data['brand']              = $this->input->post('brand');
            $data['unit']               = $this->input->post('unit');
            $option                     = $this->input->post('option');
            $choice_titles              = $this->input->post('op_title');
            $choice_types               = $this->input->post('op_type');
            $choice_no                  = $this->input->post('op_no');
            $data['added_by']           = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));
            
            if ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'no') {
                
                
                if(true){

                    $this->db->insert('product', $data);
                    $id = $this->db->insert_id();
                    
                    if(isset($_REQUEST['rand_id']) && !empty($_REQUEST['rand_id']))
                    {
                        $up = array('pid'=>$id);
                        $ret = $this->db->where('pid',$_REQUEST['rand_id'])->update('product_to_images', $up);
                        var_dump($ret);
                        die();
                    }
                    $this->benchmark->mark_time();
                    $this->load->library('cloudinarylib');
                    if($id && isset($_FILES['sneakerimg']['name']) && !empty($_FILES['sneakerimg']['name'])){
                    
                        $sneakerimg = $this->crud_model->file_up("sneakerimg", "product", 'sneakerimg_'.time());
                    $data = \Cloudinary\Uploader::upload($sneakerimg);
                    if(isset($data['public_id']))
                    {
                        $logo_id = $this->crud_model->add_img($sneakerimg,$data);
                        array_push($dataInfo,$logo_id);
                        $this->db->where('product_id',$id)->update('product',array('comp_logo'=>$logo_id));
                        
                        
                    }
                }

                    $this->load->library('cloudinarylib');
                    if($id && isset($_FILES['firstImg']['name']) && !empty($_FILES['firstImg']['name'])){
                    
                        $sneakerimg = $this->crud_model->file_up("sneakerimg", "product", 'firstImg_'.time());
                    $data = \Cloudinary\Uploader::upload($sneakerimg);
                    if(isset($data['public_id']))
                    {
                        $logo_id = $this->crud_model->add_img($sneakerimg,$data);
                        array_push($dataInfo,$logo_id);
                        $this->db->where('product_id',$id)->update('product',array('firstImg'=>$logo_id));
                        
                        
                    }
                }
                    
                    if($id && isset($_FILES['sideimg']['name']) && !empty($_FILES['sideimg']['name'])){
                    
                        $sneakerimg = $this->crud_model->file_up("sideimg", "product", 'sideimg_'.time());
                        $data = \Cloudinary\Uploader::upload($sneakerimg);
                    if(isset($data['public_id']))
                    {
                        $logo_id = $this->crud_model->add_img($sneakerimg,$data);
                        $this->db->where('product_id',$id)->update('product',array('comp_cover'=>$logo_id));
                        
                        
                    }
                        
                    }

                } else {
                    echo 'already uploaded maximum product';
                }
            }
            elseif ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'yes') {
                $this->db->insert('product', $data);
                $id = $this->db->insert_id();
                $this->crud_model->_set_variation($id);
                $this->benchmark->mark_time();
                if(!demo()){
                    $this->crud_model->file_up("images", "product", $id, 'multi');
                }
            }
            $this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == "update") {
            $option              = $this->input->post('option');
            $options = array();
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            $num                        = $this->crud_model->get_type_name_by_id('product', $para2, 'num_of_imgs');
            $download                   = $this->crud_model->get_type_name_by_id('product', $para2, 'download');
            
            $data['seo_title']          = $this->input->post('seo_title');
            $data['seo_description']    = $this->input->post('seo_description');
            $data['title']              = $this->input->post('title');
            $data['slogan']             = $this->input->post('slogan');
            $data['main_heading']       = $this->input->post('main_heading');
            $data['bussniuss_email']    = $this->input->post('bussniuss_email');
            $data['bussniuss_phone']    = $this->input->post('bussniuss_phone');
            $data['whatsapp_number']    = $this->input->post('whatsapp_number');
            $data['feature']            = ($this->input->post('feature'))?json_encode($this->input->post('feature')):'';
            $data['buttons']            = ($this->input->post('buttons'))?json_encode($this->input->post('buttons')):'';
            $data['text']               = ($this->input->post('text'))?json_encode($this->input->post('text')):'';
            $data['lat']                = $this->input->post('lat');
            $data['lng']                = $this->input->post('lng');
            $data['category']           = $this->input->post('category');
            $data['description']        = $this->input->post('description');
            $data['sub_category']       = $this->input->post('sub_category');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['purchase_price']     = $this->input->post('purchase_price');
            $data['tax']                = $this->input->post('tax');
            $data['discount']           = $this->input->post('discount');
            $data['discount_type']      = $this->input->post('discount_type');
            $data['tax_type']           = $this->input->post('tax_type');
            $data['shipping_cost']      = $this->input->post('shipping_cost');
            $data['tag']                = $this->input->post('tag');
            $data['color']              = json_encode($option);
            $data['num_of_imgs']        = $num + $num_of_imgs;
            $data['front_image']        = 0;
            $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
            $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
            $data['additional_fields']  = json_encode($additional_fields);
            $data['brand']              = $this->input->post('brand');
            $data['unit']               = $this->input->post('unit');
            $data['info_head']          = $this->input->post('info_head');
            $data['info_desc']          = $this->input->post('info_desc');
            $data['info_button']        = $this->input->post('button_txt');
            $data['button_url']         = $this->input->post('button_url');
            $data['social_media']       = json_encode($this->input->post('social'));
            $choice_titles              = $this->input->post('op_title');
            $choice_types               = $this->input->post('op_type');
            $choice_no                  = $this->input->post('op_no');

            $this->db->where('product_id', $para2);
            $this->db->update('product', $data);
    
            $this->load->library('cloudinarylib');
            $id = $para2;
            if($id && isset($_FILES['sneakerimg']['name']) && !empty($_FILES['sneakerimg']['name'])){
                    $path = 'uploads/product_image/product_' . time() . '.png';
                    
                         move_uploaded_file($_FILES["sneakerimg"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
                    if(isset($data['public_id']))
                    {
                        $logo_id = $this->crud_model->add_img($path,$data);
                        $this->db->where('product_id',$id)->update('product',array('comp_logo'=>$logo_id));
                        
                        
                    }
                }//if iumg set thensss
                // var_dump($_FILES);
                // die();
                if($id && isset($_FILES['firstImg']['name']) && !empty($_FILES['firstImg']['name'])){
                    
                    $sneakerimg = $this->crud_model->file_up("firstImg", "product", 'firstImg_'.time());
                    
                $data = \Cloudinary\Uploader::upload($sneakerimg);
                if(isset($data['public_id']))
                {
                    $logo_id = $this->crud_model->add_img($sneakerimg,$data);
                    // array_push($dataInfo,$logo_id);
                    $this->db->where('product_id',$id)->update('product',array('firstImg'=>$logo_id));
                    
                    
                }
            }
                    
                    if($id && isset($_FILES['sideimg']['name']) && !empty($_FILES['sideimg']['name'])){
                    
                     $path = 'uploads/product_image/product1cover_' . time() . '.png';
                         move_uploaded_file($_FILES["sideimg"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
                    if(isset($data['public_id']))
                    {
                        $logo_id = $this->crud_model->add_img($path,$data);
                        $this->db->where('product_id',$id)->update('product',array('comp_cover'=>$logo_id));
                        
                        
                    }
                        
                    }
                    
                    if($id && isset($_FILES['boxImg']['name']) && !empty($_FILES['boxImg']['name'])){
                    
                        $sneakerimg = $this->crud_model->file_up("boxImg", "product", 'boxImg_'.time());
                        $this->db->where('product_id',$id)->update('product',array('boxImg'=>$sneakerimg));
                        unset($sneakerimg);
                        
                    }
            $this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == 'edit') {
            
            $sing = $this->db->where('product_id' , $para2)->get('product')->row();
            $attrs = $this->db->where('product_id' , $para2)->get('attribute_to_values')->result_array();
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->row();
            $page_data['row'] =(array) $sing;
            $page_data['brands'] =  $this->db->get('category')->result_array();
            $page_data['social_media']= $this->db->get('bpkg')->result_array();
            $page_data['page_name']   = ($sing->is_bpage)?"bpage_edit":"product_edit";
            $this->load->view('back/index', $page_data);
            
        } else if ($para1 == 'view') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/vendor/product_view', $page_data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->crud_model->file_dlt('product', $para2, '.jpg', 'multi');
                $this->db->where('product_id', $para2);
                $this->db->delete('product');
                $this->crud_model->set_category_data(0);
            }

            recache();
        }
         elseif ($para1 == 'delimg') {
            $this->db->where('id',$para2)->delete('product_to_images');
            $pid = 0;
            if(isset($_GET['pid']))
            {

                $pid = $_GET['pid'];
            }
            ?>
            <ul>
                                        <?php
                                        $imgs = $this->db->where('pid',$pid)->get('product_to_images')->result_array();
                                        foreach ($imgs as $key => $value) {
                                            $img = $this->crud_model->size_img($value['img'],100,100);
                                            ?>
                                            <li id="gimg_<?= $value['id']; ?>">
                                                <div onclick="delimg('<?= $value['id']; ?>')" class="del_icon"><i class="fa-solid fa-xmark" aria-hidden="true"></i>
</div>

                                                <img src="<?= $img ?>"/></li>

                                            <?php
                                        }
                                        ?>
                                        </ul>
            <?php
        }
         elseif ($para1 == 'rimg') {
            $pid =  $para2;
            ?>
            <ul>
                                        <?php
                                        $this->db->order_by("id", "desc");

                                        $imgs = $this->db->where('pid',$pid)->get('product_to_images')->result_array();
                                        foreach ($imgs as $key => $value) {
                                            $img = $this->crud_model->size_img($value['img'],100,100);
                                            ?>
                                            <li id="gimg_<?= $value['id']; ?>">
                                                <div onclick="delimg('<?= $value['id']; ?>')" class="del_icon"><i class="fa-solid fa-xmark" aria-hidden="true"></i>
</div>

                                                <img src="<?= $img ?>"/></li>

                                            <?php
                                        }
                                        ?>
                                        </ul>
            <?php
        } elseif ($para1 == 'list') {
            $this->db->order_by('product_id', 'desc');
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $this->db->where('download=',NULL);
            $this->db->where('is_bpage=',0);
            $page_data=array();
            $page_data['all_product'] = $this->db->get('product')->result_array();
             $this->load->view('back/vendor/product_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('title', $search, 'both');
            }
            $this->db->where('download=',NULL);
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $total      = $this->db->get('product')->num_rows();
            $this->db->limit($limit);
            if($sort == ''){
                $sort = 'product_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort,$order);
            if($search){
                $this->db->like('title', $search, 'both');
            }
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $this->db->where('download=',NULL);
            $this->db->where('is_bpage=',0);
            $products   = $this->db->get('product', $limit, $offset)->result_array();
            $data       = array();
            foreach ($products as $row) {


               $category = $row['category'];
                $cat = $this->db->where('category_id',$category)->get('category')->row();
                if($row['comp_logo'])
                {
                    $img = $this->crud_model->size_img($row['comp_logo'],30,30);

                }
                else
                {
                   $img = $this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one'); 
                }
                $res    = array(
                             'item'        => '',
                             'getMainPrice'        => '',
                             'sizes'        => '',
                             'added_by'     => '',
                             'current_stock'=> '',
                             'deal'         => '',
                             'publish'      => '',
                             'featured'     => '',
                             'options'      => ''
                          );
                          //get min
                          $child = array();
                          $child[] = $row['product_id'];
                          $min = '';
                          $max = '';
                          if($child)
                          {
                          $all_rates = $this->db->where('rate >',0)->where_in('product', $child)->get('stock')->result_array();
                          $gmin = 0;
                          $gmax = 0;
                          }
                          $cat_name = "";
                          
                          if(isset($cat->category_name))
                          {
                          $cat_name = $cat->category_name;
                          }

                $res['item']  = '<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;float: left;" src="'.$img.'"  /><div class="next_div" ><small>'.$row['title'].'</small></div>';
                $res['list_type']  = $cat_name;
                if($row['status'] == 'ok'){
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['vendor_featured'] == 'ok'){
                    $res['featured']  = '<input id="v_fet_'.$row['product_id'].'" class="sw4" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['featured']  = '<input id="v_fet_'.$row['product_id'].'" class="sw4" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['current_stock'] > 0){
                    $res['current_stock']  = $row['current_stock'].$row['unit'].'(s)';
                } else {
                    $res['current_stock']  = '<span class="label label-danger">'.translate('out_of_stock').'</span>';
                }

                //add html for action
                // $res['options'] = "  <a class=\"btn btn-info btn-xs btn-labeled fa fa-location-arrow\" data-toggle=\"tooltip\"
                //                 onclick=\"ajax_set_full('view','".translate('view_product')."','".translate('successfully_viewed!')."','product_view','".$row['product_id']."');proceed('to_list');\" data-original-title=\"View\" data-container=\"body\">
                //                     ".translate('view')."
                //             </a>
                //             <a class=\"btn btn-purple btn-xs btn-labeled fa fa-tag\" data-toggle=\"tooltip\"
                //                 onclick=\"ajax_modal('add_discount','".translate('view_discount')."','".translate('viewing_discount!')."','add_discount','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                //                     ".translate('discount')."
                //             </a>
                //             <a class=\"btn btn-mint btn-xs btn-labeled fa fa-plus-square\" data-toggle=\"tooltip\"
                //                 onclick=\"ajax_modal('add_stock','".translate('add_product_quantity')."','".translate('quantity_added!')."','stock_add','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                //                     ".translate('stock')."
                //             </a>
                //             <a class=\"btn btn-dark btn-xs btn-labeled fa fa-minus-square\" data-toggle=\"tooltip\"
                //                 onclick=\"ajax_modal('destroy_stock','".translate('reduce_product_quantity')."','".translate('quantity_reduced!')."','destroy_stock','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                //                     ".translate('destroy')."
                //             </a>

                //             <a class=\"btn btn-success btn-xs btn-labeled fa fa-wrench\" data-toggle=\"tooltip\"
                //                 onclick=\"ajax_set_full('edit','".translate('edit_product')."','".translate('successfully_edited!')."','product_edit','".$row['product_id']."');proceed('to_list');\" data-original-title=\"Edit\" data-container=\"body\">
                //                     ".translate('edit')."
                //             </a>

                //             <a onclick=\"delete_confirm('".$row['product_id']."','".translate('really_want_to_delete_this?')."')\"
                //                 class=\"btn btn-danger btn-xs btn-labeled fa fa-trash\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\">
                //                     ".translate('delete')."
                //             </a>";
                $res['options'] = "
                            <a href='".base_url('home/product_view/').$row['product_id']."'\"
                                class=\"btn btn-info btn-xs btn-labeled fa fa-eye\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\"> 
                                    ".translate('view')."
                            </a>
                            <a href='".base_url('vendor/product/edit/').$row['product_id']."' class=\"btn btn-success btn-xs btn-labeled fa fa-wrench\" data-toggle=\"tooltip\"
                                data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('edit')."
                            </a>

                            <a onclick=\"delete_confirm('".$row['product_id']."','".translate('really_want_to_delete_this?')."')\"
                                class=\"btn btn-danger btn-xs btn-labeled fa fa-trash\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\">
                                    ".translate('delete')."
                            </a>";
                $data[] = $res;
            }
            $result = array(
                             'total' => $total,
                             'rows' => $data
                           );

            echo json_encode($result);

        } else if ($para1 == 'dlt_img') {
            if(!demo()){
                $a = explode('_', $para2);
                $this->crud_model->file_dlt('product', $a[0], '.jpg', 'multi', $a[1]);
                recache();
            }
        } elseif ($para1 == 'sub_by_cat') {
            $brands = $this->db->where('pcat',$para2)->get('category')->result_array();
            
            $level = get_cat_level($para2);
            $breed = array();
            $cid = $para2;
            for ($i=1; $i <= $level; $i++) { 
                // var_dump($i);
                $breed[] = $cid;
                $row = $this->db->where('category_id',$cid)->get('category')->row();
                $cid = $row->pcat;
                
            }
            if($breed)
            {
                ?>
                <div class="breaddcum">
                    <ul>
                        <?php
                        foreach(array_reverse($breed) as $k=> $v)
                        {
                            $row = $this->db->where('category_id',$v)->get('category')->row();
                            ?>
                            <li onclick="selecttype('<?= $row->pcat;?>')"><?= $row->category_name;?></li>
                            <?php
                        }
                        ?>


                    </ul>
                </div>
                <?php
            }
            if(!$brands)
            {
               echo $next = '
                <div class="text-center justify-content-center"><h5>There are no more categories </h5>
                <a onclick ="next_tab();"  style="margin-right:10px"><button type="button" class="btn btn-primary"> Click here </button></a>to move to next tab.
                </div>
                ';
                exit();
            }
            
            foreach($brands as $k=>$v){
                if(true)
                {
            ?>
                <div class="col-md-4 col-sm-12 col-xs-12 <?= ($product_data->category == $v['category_id'])?"active":"" ?>" onclick="selecttype('<?= $v['category_id'];?>')" >
                    <a href="#"><div class="flip-card ">
                  <div class="flip-card-inner">
                    <div class="flip-card-front <?= ($product_data->category == $v['category_id'])?"active":"" ?>">
                        <i class="fa <?= $v['fa_icon'];?>" aria-hidden="true"></i>
                        <br>
                        <p><?= $v['category_name'];?></p>
                    </div>
                    <div class="flip-card-back"><p><?= $v['category_name'];?> </p></div>
                  </div>
                </div>
                </a>
                </div>
                <?php 
                }
            }
            // echo $this->crud_model->select_html('sub_category', 'sub_category', 'sub_category_name', 'add', 'demo-chosen-select required', '', 'category', $para2, 'get_brnd');
        } elseif ($para1 == 'brand_by_sub') {
            $brands=json_decode($this->crud_model->get_type_name_by_id('sub_category',$para2,'brand'),true);
            echo $this->crud_model->select_html('brand', 'brand', 'name', 'add', 'demo-chosen-select required', '', 'brand_id', $brands, '', 'multi');
        } elseif ($para1 == 'product_by_sub') {
            echo $this->crud_model->select_html('product', 'product', 'title', 'add', 'demo-chosen-select required', '', 'sub_category', $para2, 'get_pro_res');
        } elseif ($para1 == 'pur_by_pro') {
            echo $this->crud_model->get_type_name_by_id('product', $para2, 'purchase_price');
        } elseif ($para1 == 'add') {
            
            if (true) {
                $page_data = array();
               // $page_data['brand'] =  $this->db->get('brand')->result_array();
               
                if($this->crud_model->can_add_product($this->session->userdata('vendor_id'))){
                    $page_data['brands'] =  $this->db->get('category')->result_array();

                    // $this->load->view('back/vendor/product_add', $page_data);
                    $page_data['page_name']   = "product_add";
                    
            $this->load->view('back/index', $page_data);
                } else {
                            $page_data['page_name']   = "product_limit";
            $this->load->view('back/index', $page_data);
                    // $this->load->view('back/vendor/product_limit');
                }
            }
            elseif($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'yes'){
                // $this->load->view('back/vendor/product_add');
            }
        } elseif ($para1 == 'srch') {
            if(isset($_GET['srh']))
            $para2 = $_GET['srh'];
            $page = 0;
            if(isset($_GET['page']))
            $page = $_GET['page'];
            if($para2)
            {
               $this->db->like('title', $para2);
               $this->db->where('parent_id', 0);
               $per_page = 16;
               $obj= $this->db;
               $res = $this->db->get('product')->result_array();
            

               $tot_pro = count($res);
               
            $tot_page = $tot_pro/$per_page;
            $tpage = $tot_page;
            $cpage = $page;
            $start = $page * $per_page;
            $obj->limit($per_page, $start);
            $obj->like('title', $para2);
$res = $obj->get('product')->result_array();
foreach($res as $k=> $v)
{
    $category = $v['category'];
    $cat = $this->db->where('category_id',$category)->get('category')->row();
                   $vendors = $this->db->where('parent_id', $v['product_id']);
$vendors = $this->db->get('product')->result_array();
$price = $this->crud_model->getMainPrice($v['product_id']);
    
    ?>
    <li onclick="select_product('<?= $v['product_id'] ?>')">
                                                <div class="img_div" >
                                                <img src="<?= $this->crud_model->file_view('product',$v['product_id'],'','','thumb','src','multi','one'); ?>"/>
                                                </div>
                                                <div class="det_div" >
                                                    <h1><?= $v['title']; ?></h1>
                                                    <p><?php 
                                                    if($cat || $price)
                                                    {
                                                        if(!empty($cat->category_name))
                                                        {
                                                            echo 'Product category : '.$cat->category_name;
                                                        }
                                                        if(!empty($price))
                                                        {
                                                            if(!empty($cat->category_name))
                                                            {
                                                            echo '/Lowest Price from vendors : '.$price.'€';
                                                            }
                                                            else
                                                            {
                                                                echo 'Lowest Price from vendors : '.$price.'€';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                     </p>
                                                    </div>
                                            </li>
    <?php
}
/*if($cpage <= $tpage)
{
    ?>
    <li class="load_more" onclick="load_more('<?= $para2; ?>',<?= $cpage++; ?>')">Load More</li>
    <?php
}*/
            }
            else
            {
                if ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'no') {
                    if(true){
                        $this->load->view('back/vendor/product_step1');
                    } else {
                        $this->load->view('back/vendor/product_limit');
                    }
                }
                elseif($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'yes'){
                    $this->load->view('back/vendor/product_step1');
                }
            }
        } elseif ($para1 == 'add1') {
            
            if($para2)
            {
                $data = array();
                $data['added_by']           = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));
                $data['parent_id']           = $para2;
                $already = $this->db->where($data)->get('product')->row();
                if($already)
                {
                    echo "Already added";
                }
            
            $this->load->view('back/vendor/product_add', $page_data);
            }
            else
            {
                if ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'no') {
                    if(true){
                        $this->load->view('back/vendor/product_step1');
                    } else {
                        $this->load->view('back/vendor/product_limit');
                    }
                }
                elseif($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'yes'){
                    $this->load->view('back/vendor/product_step1');
                }
            }
        } elseif ($para1 == 'add_stock') {
            $data['product'] = $para2;
            $this->load->view('back/vendor/product_stock_add', $data);
        } elseif ($para1 == 'destroy_stock') {
            $data['product'] = $para2;
            $this->load->view('back/vendor/product_stock_destroy', $data);
        } elseif ($para1 == 'stock_report') {
            $data['product'] = $para2;
            $this->load->view('back/vendor/product_stock_report', $data);
        } elseif ($para1 == 'sale_report') {
            $data['product'] = $para2;
            $this->load->view('back/vendor/product_sale_report', $data);
        } elseif ($para1 == 'add_discount') {
            $data['product'] = $para2;
            $this->load->view('back/vendor/product_add_discount', $data);
        } elseif ($para1 == 'product_featured_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['featured'] = 'ok';
            } else {
                $data['featured'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'product_v_featured_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['vendor_featured'] = 'ok';
            } else {
                $data['vendor_featured'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'product_deal_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['deal'] = 'ok';
            } else {
                $data['deal'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'product_publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'add_discount_set') {
            $product               = $this->input->post('product');
            $data['discount']      = $this->input->post('discount');
            $data['discount_type'] = $this->input->post('discount_type');
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            $this->crud_model->set_category_data(0);
            recache();
        } else { 
            $page_data['page_name']   = "product";
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    public function product_bulk_upload()
    {
        if (!$this->crud_model->vendor_permission('product')) {
            redirect(base_url() . 'vendor');
        }

        $physical_categories =  $this->db->where('digital',null)->or_where('digital','')->get('category')->result_array();
        $physical_sub_categories =  $this->db->where('digital',null)->or_where('digital','')->get('sub_category')->result_array();
        $digital_categories =  $this->db->where('digital','ok')->get('category')->result_array();
        $digital_sub_categories =  $this->db->where('digital','ok')->get('sub_category')->result_array();
        $brands =  $this->db->get('brand')->result_array();

        $page_data['page_name'] = "product_bulk_upload";
        $page_data['physical_categories'] = $physical_categories;
        $page_data['physical_sub_categories'] = $physical_sub_categories;
        $page_data['digital_categories'] = $digital_categories;
        $page_data['digital_sub_categories'] = $digital_sub_categories;
        $page_data['brands'] = $brands;

        $this->load->view('back/index', $page_data);

    }

    public function product_bulk_upload_save()
    {
        if(demo()){
            $this->session->set_flashdata('error',translate('This operation is invalid for demo'));
            redirect('vendor/product_bulk_upload');
        }

        if(!file_exists($_FILES['bulk_file']['tmp_name']) || !is_uploaded_file($_FILES['bulk_file']['tmp_name'])){
            $this->session->set_flashdata('error',translate('File is not selected'));
            redirect('vendor/product_bulk_upload');
        }


        $inputFileName = $_FILES['bulk_file']['tmp_name'];


        $inputFileType = $this->spreadsheet->identify($inputFileName);
        $reader = $this->spreadsheet->createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $products = array();
        if(!empty($sheetData)){

            if(!isset($sheetData[1])){
                $this->session->set_flashdata('error',translate('Column names are missing'));
                redirect('vendor/product_bulk_upload');
            }

            foreach ($sheetData[1] as $colk => $colv){
                $col_map[$colk] = $colv;
            }


            if(!isset($sheetData[2])){
                $this->session->set_flashdata('error',translate('Data missing'));
                redirect('vendor/product_bulk_upload');
            }

            for($i = 2;$i <= count($sheetData);$i++){
                $product = array();
                foreach ($sheetData[$i] as $colk =>$colv) {
                    $product[$col_map[$colk]] = $colv;
                }
                $products[] = $product;
            }
        }

        if(!empty($products)){
            foreach ($products as $product){
                $this->product_bulk_upload_save_single($product);
            }
        }

        $this->session->set_flashdata('success',translate('Products uploaded'));
        redirect('vendor/product_bulk_upload');

    }

    public function product_bulk_upload_save_single($product)
    {
        $image_urls = array();
        $product_stock_data = array();
        $product_data['num_of_imgs'] = 0;
        if (!empty($product['images'])) {
            $image_urls = explode(',', $product['images']);
            $product_data['num_of_imgs'] = count($image_urls);
        }

        $product_data['title'] = $product['title'];
        $product_data['description'] = $product['description'];
        $product_data['category'] = is_numeric($product['category']) ? $product['category'] : 0;
        $product_data['sub_category'] = is_numeric($product['sub_category']) ? $product['sub_category'] : 0;
        $product_data['brand'] = is_numeric($product['brand']) ? $product['brand'] : 0;

        $product_data['purchase_price'] = is_numeric($product['purchase_price']) ? $product['purchase_price'] : 0;
        $product_data['sale_price'] = is_numeric($product['sale_price']) ? $product['sale_price']: 0;

        $product_data['add_timestamp'] = time();
        $product_data['download'] = NULL;
        $product_data['featured'] = 'no';
        $product_data['vendor_featured'] = 'no';
        $product_data['status'] = $product['published'] == 'yes' ? 'ok' : 0;
        $product_data['rating_user'] = '[]';

        if (strpos($product['tax'], '%') !== false) {
            $tax = str_replace("%", "", $product['tax']);
            $product_data['tax'] = is_numeric($tax) ? $tax : 0;
            $product_data['tax_type'] = 'percent';
        } else {
            $tax = $product['tax'];
            $product_data['tax'] = is_numeric($tax) ? $tax : 0;
            $product_data['tax_type'] = 'amount';
        }

        if (strpos($product['discount'], '%') !== false) {
            $discount = str_replace("%", "", $product['discount']);
            $product_data['discount'] = is_numeric($discount) ? $discount : 0;
            $product_data['discount_type'] = 'percent';
        } else {
            $discount = $product['discount'];
            $product_data['discount'] = is_numeric($discount) ? $discount : 0;
            $product_data['discount_type'] = 'amount';
        }

        $product_data['shipping_cost'] = is_numeric($product['shipping_cost']) ? $product['shipping_cost'] : 0;
        $product_data['tag'] = $product['tag'];
        $product_data['is_bundle'] = 'no';
        $product_data['color'] = null;
        $product_data['current_stock'] = is_numeric($product['add_stock']) ? $product['add_stock'] : 0;



        $product_data['front_image'] = 0;

        $product_data['additional_fields'] = null;
        $product_data['unit'] = is_numeric($product['unit']) ? $product['unit'] : "";
        $product_data['added_by'] = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));
        $product_data['options'] = json_encode($options = array());

        $this->db->insert('product', $product_data);
        $product_id = $this->db->insert_id();
        $this->crud_model->set_category_data(0);
        recache();

        if($product_data['current_stock'] > 0){
            $product_stock_data['type']         = 'add';
            $product_stock_data['product']      = $product_id;
            $product_stock_data['category']     = $product_data['category'];
            $product_stock_data['sub_category'] = $product_data['sub_category'];
            $product_stock_data['product']      = $product_data['product'];
            $product_stock_data['quantity']     = $product_data['current_stock'];
            $product_stock_data['rate']         = $product_data['purchase_price'];
            $product_stock_data['total']        = $product_data['purchase_price'] * $product_data['current_stock'] ;
            $product_stock_data['reason_note']  = 'bulk';
            $product_stock_data['added_by']     = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));
            $product_stock_data['datetime']     = time();
            $product_stock_data['current_stock']= $product_data['current_stock'];
            $this->db->insert('stock', $product_stock_data);
        }

        if(!empty($image_urls)){
            if(!demo()){
                $this->crud_model->file_up_from_urls($image_urls, "product", $product_id);
            }
        }

    }

    /* Digital add, edit, view, delete, stock increase, decrease, discount */
    function digital($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->vendor_permission('product')) {
            redirect(base_url() . 'vendor');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','69','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            if ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'no') {
                if($this->crud_model->can_add_product($this->session->userdata('vendor_id'))) {

                    $data['seo_title']          = $this->input->post('seo_title');
                    $data['seo_description']    = $this->input->post('seo_description');
                    $data['title']              = $this->input->post('title');
                    $data['category']           = $this->input->post('category');
                    $data['description']        = $this->input->post('description');
                    $data['sub_category']       = $this->input->post('sub_category');
                    $data['sale_price']         = $this->input->post('sale_price');
                    $data['purchase_price']     = $this->input->post('purchase_price');
                    $data['add_timestamp']      = time();
                    $data['featured']           = 'no';
                    $data['status']             = 'ok';
                    $data['rating_user']        = '[]';
                    $data['tax']                = $this->input->post('tax');
                    $data['discount']           = $this->input->post('discount');
                    $data['discount_type']      = $this->input->post('discount_type');
                    $data['tax_type']           = $this->input->post('tax_type');
                    $data['shipping_cost']      = 0;
                    $data['tag']                = $this->input->post('tag');
                    $data['num_of_imgs']        = $num_of_imgs;
                    $data['front_image']        = $this->input->post('front_image');
                    $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
                    $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
                    $data['additional_fields']  = json_encode($additional_fields);
                    $data['requirements']       =   '[]';
                    $data['video']              =   '[]';

                    $data['added_by']           = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));

                    $this->db->insert('product', $data);
                    $id = $this->db->insert_id();
                    $this->benchmark->mark_time();

                    if(!demo()){
                        $this->crud_model->file_up("images", "product", $id, 'multi');
                    }

                    $path = $_FILES['logo']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $data_logo['logo']      = demo() ? "" : 'digital_logo_'.$id.'.'.$ext;
                    $this->db->where('product_id' , $id);
                    $this->db->update('product' , $data_logo);
                    if(!demo()){
                        $this->crud_model->file_up("logo", "digital_logo", $id, '','no','.'.$ext);
                    }

                    //Requirements add
                    $requirements               =   array();
                    $req_title                  =   $this->input->post('req_title');
                    $req_desc                   =   $this->input->post('req_desc');
                    if(!empty($req_title)){
                        foreach($req_title as $i => $row){
                            $requirements[]         =   array('index'=>$i,'field'=>$row,'desc'=>$req_desc[$i]);
                        }
                    }

                    $data_req['requirements']           =   json_encode($requirements);
                    $this->db->where('product_id' , $id);
                    $this->db->update('product' , $data_req);

                    //File upload
                    $rand           = substr(hash('sha512', rand()), 0, 20);
                    $name           =  demo() ? "" : $id.'_'.$rand.'_'.$_FILES['product_file']['name'];
                    $da['download_name'] = $name;
                    $da['download'] = 'ok';
                    $folder = $this->db->get_where('general_settings', array('type' => 'file_folder'))->row()->value;
                    if(!demo()){
                        move_uploaded_file($_FILES['product_file']['tmp_name'], 'uploads/file_products/' . $folder .'/' . $name);
                    }
                    $this->db->where('product_id', $id);
                    $this->db->update('product', $da);

                    //vdo upload
                    $video_details              =   array();
                    if($this->input->post('upload_method') == 'upload'){
                        $video              =   $_FILES['videoFile']['name'];
                        $ext                =   pathinfo($video,PATHINFO_EXTENSION);
                        if(!demo()){
                            move_uploaded_file($_FILES['videoFile']['tmp_name'],'uploads/video_digital_product/digital_'.$id.'.'.$ext);
                        }
                        $video_src          =   'uploads/video_digital_product/digital_'.$id.'.'.$ext;
                        $video_details[]    =   demo() ? array() : array('type'=>'upload','from'=>'local','video_link'=>'','video_src'=>$video_src);
                        $data_vdo['video']  =   json_encode($video_details);
                        $this->db->where('product_id',$id);
                        $this->db->update('product',$data_vdo);
                    }
                    elseif ($this->input->post('upload_method') == 'share'){
                        $from               = $this->input->post('site');
                        $video_link         = $this->input->post('video_link');
                        $code               = $this->input->post('video_code');
                        if($from=='youtube'){
                            $video_src      = 'https://www.youtube.com/embed/'.$code;
                        }else if($from=='dailymotion'){
                            $video_src      = '//www.dailymotion.com/embed/video/'.$code;
                        }else if($from=='vimeo'){
                            $video_src      = 'https://player.vimeo.com/video/'.$code;
                        }
                        $video_details[]    = array('type'=>'share','from'=>$from,'video_link'=>$video_link,'video_src'=>$video_src);
                        $data_vdo['video']  =   json_encode($video_details);
                        $this->db->where('product_id',$id);
                        $this->db->update('product',$data_vdo);
                    }
                } else {
                    echo 'already uploaded maximum product';
                }
            }
            elseif($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'yes'){

                $data['seo_title']          = $this->input->post('seo_title');
                $data['seo_description']    = $this->input->post('seo_description');
                $data['title']              = $this->input->post('title');
                $data['category']           = $this->input->post('category');
                $data['description']        = $this->input->post('description');
                $data['sub_category']       = $this->input->post('sub_category');
                $data['sale_price']         = $this->input->post('sale_price');
                $data['purchase_price']     = $this->input->post('purchase_price');
                $data['add_timestamp']      = time();
                $data['featured']           = 'no';
                $data['status']             = 'ok';
                $data['rating_user']        = '[]';
                $data['tax']                = $this->input->post('tax');
                $data['discount']           = $this->input->post('discount');
                $data['discount_type']      = $this->input->post('discount_type');
                $data['tax_type']           = $this->input->post('tax_type');
                $data['shipping_cost']      = 0;
                $data['tag']                = $this->input->post('tag');
                $data['num_of_imgs']        = $num_of_imgs;
                $data['front_image']        = $this->input->post('front_image');
                $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
                $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
                $data['additional_fields']  = json_encode($additional_fields);
                $data['requirements']       =   '[]';
                $data['video']              =   '[]';

                $data['added_by']           = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));

                $this->db->insert('product', $data);
                $id = $this->db->insert_id();
                $this->benchmark->mark_time();

                if(!demo()){
                    $this->crud_model->file_up("images", "product", $id, 'multi');
                }

                $path = $_FILES['logo']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $data_logo['logo']       = demo() ? "" : 'digital_logo_'.$id.'.'.$ext;
                $this->db->where('product_id' , $id);
                $this->db->update('product' , $data_logo);
                if(!demo()){
                    $this->crud_model->file_up("logo", "digital_logo", $id, '','no','.'.$ext);

                }
                //Requirements add
                $requirements               =   array();
                $req_title                  =   $this->input->post('req_title');
                $req_desc                   =   $this->input->post('req_desc');
                if(!empty($req_title)){
                    foreach($req_title as $i => $row){
                        $requirements[]         =   array('index'=>$i,'field'=>$row,'desc'=>$req_desc[$i]);
                    }
                }

                $data_req['requirements']           =   json_encode($requirements);
                $this->db->where('product_id' , $id);
                $this->db->update('product' , $data_req);

                //File upload
                $rand           = substr(hash('sha512', rand()), 0, 20);
                $name           = $id.'_'.$rand.'_'.$_FILES['product_file']['name'];
                $da['download_name'] = $name;
                $da['download'] = 'ok';
                $folder = $this->db->get_where('general_settings', array('type' => 'file_folder'))->row()->value;
                if(!demo()){
                    move_uploaded_file($_FILES['product_file']['tmp_name'], 'uploads/file_products/' . $folder .'/' . $name);
                }
                $this->db->where('product_id', $id);
                $this->db->update('product', $da);

                //vdo upload
                $video_details              =   array();
                if($this->input->post('upload_method') == 'upload'){
                    $video              =   $_FILES['videoFile']['name'];
                    $ext                =   pathinfo($video,PATHINFO_EXTENSION);
                    if(!demo()){
                        move_uploaded_file($_FILES['videoFile']['tmp_name'],'uploads/video_digital_product/digital_'.$id.'.'.$ext);
                    }

                    $video_src          =   'uploads/video_digital_product/digital_'.$id.'.'.$ext;
                    $video_details[]    =   demo() ? array() : array('type'=>'upload','from'=>'local','video_link'=>'','video_src'=>$video_src);
                    $data_vdo['video']  =   json_encode($video_details);
                    $this->db->where('product_id',$id);
                    $this->db->update('product',$data_vdo);
                }
                elseif ($this->input->post('upload_method') == 'share'){
                    $from               = $this->input->post('site');
                    $video_link         = $this->input->post('video_link');
                    $code               = $this->input->post('video_code');
                    if($from=='youtube'){
                        $video_src      = 'https://www.youtube.com/embed/'.$code;
                    }else if($from=='dailymotion'){
                        $video_src      = '//www.dailymotion.com/embed/video/'.$code;
                    }else if($from=='vimeo'){
                        $video_src      = 'https://player.vimeo.com/video/'.$code;
                    }
                    $video_details[]    =   array('type'=>'share','from'=>$from,'video_link'=>$video_link,'video_src'=>$video_src);
                    $data_vdo['video']  =   json_encode($video_details);
                    $this->db->where('product_id',$id);
                    $this->db->update('product',$data_vdo);
                }
            }
            $this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == "update") {
            $options = array();
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            $num                        = $this->crud_model->get_type_name_by_id('product', $para2, 'num_of_imgs');
            $download                   = $this->crud_model->get_type_name_by_id('product', $para2, 'download');

            $data['seo_title']          = $this->input->post('seo_title');
            $data['seo_description']    = $this->input->post('seo_description');
            $data['title']              = $this->input->post('title');
            $data['category']           = $this->input->post('category');
            $data['description']        = $this->input->post('description');
            $data['sub_category']       = $this->input->post('sub_category');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['purchase_price']     = $this->input->post('purchase_price');
            $data['tax']                = $this->input->post('tax');
            $data['discount']           = $this->input->post('discount');
            $data['discount_type']      = $this->input->post('discount_type');
            $data['tax_type']           = $this->input->post('tax_type');
            $data['tag']                = $this->input->post('tag');
            $data['update_time']        = time();
            $data['num_of_imgs']        = $num + $num_of_imgs;
            $data['front_image']        = $this->input->post('front_image');
            $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
            $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
            $data['additional_fields']  = json_encode($additional_fields);

            //File upload
            if(!demo()){
                $this->crud_model->file_up("images", "product", $para2, 'multi');
            }
            if($_FILES['product_file']['name'] !== ''){
                $rand           = substr(hash('sha512', rand()), 0, 20);
                $name           = $para2.'_'.$rand.'_'.$_FILES['product_file']['name'];
                $data['download_name'] = $name;
                $folder = $this->db->get_where('general_settings', array('type' => 'file_folder'))->row()->value;
                if(!demo()){
                    move_uploaded_file($_FILES['product_file']['tmp_name'], 'uploads/file_products/' . $folder .'/' . $name);
                }
            }

            $this->db->where('product_id', $para2);
            $this->db->update('product', $data);

            if($_FILES['logo']['name'] !== ''){
                $path = $_FILES['logo']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $data_logo['logo']       = demo() ? "" : 'digital_logo_'.$para2.'.'.$ext;
                $this->db->where('product_id' , $para2);
                $this->db->update('product' , $data_logo);
                if(!demo()){
                    $this->crud_model->file_up("logo", "digital_logo", $para2, '','no','.'.$ext);
                }
            }

            //Requirements add
            $requirements               =   array();
            $req_title                  =   $this->input->post('req_title');
            $req_desc                   =   $this->input->post('req_desc');
            if(!empty($req_title)){
                foreach($req_title as $i => $row){
                    $requirements[]         =   array('index'=>$i,'field'=>$row,'desc'=>$req_desc[$i]);
                }
            }
            $data_req['requirements']           =   json_encode($requirements);
            $this->db->where('product_id' , $para2);
            $this->db->update('product' , $data_req);

            //vdo upload
            $video_details              =   array();
            if($this->input->post('upload_method') == 'upload'){
                $video              =   $_FILES['videoFile']['name'];
                $ext                =   pathinfo($video,PATHINFO_EXTENSION);

                if(!demo()){
                    move_uploaded_file($_FILES['videoFile']['tmp_name'],'uploads/video_digital_product/digital_'.$para2.'.'.$ext);
                }
                $video_src          =   'uploads/video_digital_product/digital_'.$para2.'.'.$ext;
                $video_details[]    =   array('type'=>'upload','from'=>'local','video_link'=>'','video_src'=>$video_src);
                $data_vdo['video']  =   demo() ? array() :json_encode($video_details);
                $this->db->where('product_id',$para2);
                $this->db->update('product',$data_vdo);
            }
            elseif ($this->input->post('upload_method') == 'share'){
                $video= json_decode($this->crud_model->get_type_name_by_id('product',$para2,'video'),true);
                if($video[0]['type'] == 'upload'){
                    if(file_exists($video[0]['video_src'])){
                        unlink($video[0]['video_src']);
                    }
                }
                $from               = $this->input->post('site');
                $video_link         = $this->input->post('video_link');
                $code               = $this->input->post('video_code');
                if($from=='youtube'){
                    $video_src      = 'https://www.youtube.com/embed/'.$code;
                }else if($from=='dailymotion'){
                    $video_src      = '//www.dailymotion.com/embed/video/'.$code;
                }else if($from=='vimeo'){
                    $video_src      = 'https://player.vimeo.com/video/'.$code;
                }
                $video_details[]    =   array('type'=>'share','from'=>$from,'video_link'=>$video_link,'video_src'=>$video_src);
                $data_vdo['video']  =   json_encode($video_details);
                $this->db->where('product_id',$para2);
                $this->db->update('product',$data_vdo);
            }
            elseif ($this->input->post('upload_method') == 'delete'){
                if(!demo()){
                    $data_vdo['video']  =   '[]';
                    $this->db->where('product_id',$para2);
                    $this->db->update('product',$data_vdo);

                    $video= json_decode($this->crud_model->get_type_name_by_id('product',$para2,'video'),true);
                    if($video[0]['type'] == 'upload'){
                        if(file_exists($video[0]['video_src'])){
                            unlink($video[0]['video_src']);
                        }
                    }
                }

            }
            $this->crud_model->set_category_data(0);

            recache();
        } else if ($para1 == 'edit') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/vendor/digital_edit', $page_data);
        } else if ($para1 == 'view') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/vendor/digital_view', $page_data);
        } else if ($para1 == 'download_file') {
            $this->crud_model->download_product($para2);
        } else if ($para1 == 'can_download') {
            if($this->crud_model->can_download($para2)){
                echo "yes";
            } else{
                echo "no";
            }
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->crud_model->file_dlt('product', $para2, '.jpg', 'multi');
                unlink("uploads/digital_logo_image/" .$this->crud_model->get_type_name_by_id('product',$para2,'logo'));
                $video=$this->crud_model->get_type_name_by_id('product',$para2,'video');
                if($video!=='[]'){
                    $video_details= json_decode($video,true);
                    if($video_details[0]['type'] == 'upload'){
                        if(file_exists($video_details[0]['video_src'])){
                            unlink($video_details[0]['video_src']);
                        }
                    }
                }
                $this->db->where('product_id', $para2);
                $this->db->delete('product');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('product_id', 'desc');
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $this->db->where('download=','ok');
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/vendor/digital_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('title', $search, 'both');
            }
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $this->db->where('download=','ok');
            $total= $this->db->get('product')->num_rows();
            $this->db->limit($limit);
            if($sort == ''){
                $sort = 'product_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort,$order);
            if($search){
                $this->db->like('title', $search, 'both');
            }
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $this->db->where('download=','ok');
            $products   = $this->db->get('product', $limit, $offset)->result_array();
            $data       = array();
            foreach ($products as $row) {

                $res    = array(
                             'image' => '',
                             'title' => '',
                             'publish' => '',
                             'options' => ''
                          );

                $res['image']  = '<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="'.$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one').'"  />';
                $res['title']  = $row['title'];
                if($row['status'] == 'ok'){
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" />';
                }

                //add html for action
                $res['options'] = "  <a class=\"btn btn-info btn-xs btn-labeled fa fa-location-arrow\" data-toggle=\"tooltip\"
                                onclick=\"ajax_set_full('view','".translate('view_product')."','".translate('successfully_viewed!')."','digital_view','".$row['product_id']."');proceed('to_list');\" data-original-title=\"View\" data-container=\"body\">
                                    ".translate('view')."
                            </a>
                            <a class=\"btn btn-purple btn-xs btn-labeled fa fa-tag\" data-toggle=\"tooltip\"
                                onclick=\"ajax_modal('add_discount','".translate('view_discount')."','".translate('viewing_discount!')."','add_discount','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('discount')."
                            </a>
                            <a class=\"btn btn-mint btn-xs btn-labeled fa fa-download\" data-toggle=\"tooltip\"
                                onclick=\"digital_download(".$row['product_id'].")\" data-original-title=\"Download\" data-container=\"body\">
                                    ".translate('download')."
                            </a>

                            <a class=\"btn btn-success btn-xs btn-labeled fa fa-wrench\" data-toggle=\"tooltip\"
                                onclick=\"ajax_set_full('edit','".translate('edit_product_(_digital_product_)')."','".translate('successfully_edited!')."','digital_edit','".$row['product_id']."');proceed('to_list');\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('edit')."
                            </a>

                            <a onclick=\"delete_confirm('".$row['product_id']."','".translate('really_want_to_delete_this?')."')\"
                                class=\"btn btn-danger btn-xs btn-labeled fa fa-trash\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\">
                                    ".translate('delete')."
                            </a>";
                $data[] = $res;
            }
            $result = array(
                             'total' => $total,
                             'rows' => $data
                           );

            echo json_encode($result);

        } else if ($para1 == 'dlt_img') {
            if(!demo()){
                $a = explode('_', $para2);
                $this->crud_model->file_dlt('product', $a[0], '.jpg', 'multi', $a[1]);
                recache();
            }
        } elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category', 'sub_category', 'sub_category_name', 'add', 'demo-chosen-select required', '', 'category', $para2, '');
        } elseif ($para1 == 'product_by_sub') {
            echo $this->crud_model->select_html('product', 'product', 'title', 'add', 'demo-chosen-select required', '', 'sub_category', $para2, 'get_pro_res');
        }
        elseif ($para1 == 'pur_by_pro') {
            echo $this->crud_model->get_type_name_by_id('product', $para2, 'purchase_price');
        }elseif ($para1 == 'add') {
            if ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'no') {
                if($this->crud_model->can_add_product($this->session->userdata('vendor_id'))){
                    $this->load->view('back/vendor/digital_add');
                } else {
                    $this->load->view('back/vendor/product_limit');
                }
            }
            elseif ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'yes') {
                $this->load->view('back/vendor/digital_add');
            }
            //$this->load->view('back/vendor/digital_add');
        } elseif ($para1 == 'sale_report') {
            $data['product'] = $para2;
            $this->load->view('back/vendor/product_sale_report', $data);
        } elseif ($para1 == 'add_discount') {
            $data['product'] = $para2;
            $this->load->view('back/vendor/digital_add_discount', $data);
        } elseif ($para1 == 'product_featured_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['featured'] = 'ok';
            } else {
                $data['featured'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'product_deal_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['deal'] = 'ok';
            } else {
                $data['deal'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'product_publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'add_discount_set') {
            $product               = $this->input->post('product');
            $data['discount']      = $this->input->post('discount');
            $data['discount_type'] = $this->input->post('discount_type');
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            $this->crud_model->set_category_data(0);
            recache();
        }elseif ($para1 == 'video_preview') {
            if($para2 == 'youtube'){
                echo '<iframe width="400" height="300" src="https://www.youtube.com/embed/'.$para3.'" frameborder="0"></iframe>';
            }else if($para2 == 'dailymotion'){
                echo '<iframe width="400" height="300" src="//www.dailymotion.com/embed/video/'.$para3.'" frameborder="0"></iframe>';
            }else if($para2 == 'vimeo'){
                echo '<iframe src="https://player.vimeo.com/video/'.$para3.'" width="400" height="300" frameborder="0"></iframe>';
            }
        }else {
            $page_data['page_name']   = "digital";
            $this->db->order_by('product_id', 'desc');
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $this->db->where('download=','ok');
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Product Stock add, edit, view, delete, stock increase, decrease, discount */
    function stock($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->vendor_permission('stock')) {
            redirect(base_url() . 'vendor');
        }
        if ($para1 == 'do_add') {
           $data['attribute']     = implode(',',$this->input->post('attribute'));
            $data['sub_category'] = $this->input->post('sub_category');
            $data['product']      = $para2;
            $data['quantity']     = $this->input->post('quantity');
            $data['rate']         = $this->input->post('rate');
            $data['total']        = $this->input->post('total');
            $data['reason_note']  = $this->input->post('reason_note');
            $data['datetime']     = time();
            $data['added_by']     = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));
            $this->db->insert('stock', $data);
            print_r($data);
            // die($this->db->insert_id());
            recache();
        } else if ($para1 == 'do_destroy') {
            $data['type']         = 'destroy';
            $data['category']     = $this->input->post('category');
            $data['sub_category'] = $this->input->post('sub_category');
            $data['product']      = $this->input->post('product');
            $data['quantity']     = $this->input->post('quantity');
            $data['total']        = $this->input->post('total');
            $data['reason_note']  = $this->input->post('reason_note');
            $data['added_by']     = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));
            $data['datetime']     = time();
            $this->db->insert('stock', $data);
            
            $prev_quantity = $this->crud_model->get_type_name_by_id('product', $data['product'], 'current_stock');
            $current       = $prev_quantity - $data['quantity'];
            if ($current <= 0) {
                $current = 0;
            }
            $data1['current_stock'] = $current;
            $this->db->where('product_id', $data['product']);
            $this->db->update('product', $data1);
            recache();
        } elseif ($para1 == 'delete') {
            $quantity = $this->crud_model->get_type_name_by_id('stock', $para2, 'quantity');
            $product  = $this->crud_model->get_type_name_by_id('stock', $para2, 'product');
            $type     = $this->crud_model->get_type_name_by_id('stock', $para2, 'type');
            if ($type == 'add') {
                $this->crud_model->decrease_quantity($product, $quantity);
            } else if ($type == 'destroy') {
                $this->crud_model->increase_quantity($product, $quantity);
            }
            $this->db->where('stock_id', $para2);
            $this->db->delete('stock');
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('stock_id', 'desc');
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $page_data['all_stock'] = $this->db->get('stock')->result_array();
            // print_r($page_data['all_stock']);
            // die();
            $this->load->view('back/admin/stock_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/vendor/stock_add1');
        }
     elseif ($para1 == 'get_var') {
            $this->crud_model->ip_data($para2);
            $this->crud_model->_set_variation($para2);
            //get main product 
            $product = $this->db->where('product_id',$para2)->get('product')->row();
            $mid = $product->parent_id;
            $this->crud_model->_set_variation($mid);
            
            $attributes = $this->db->where('product_id',$mid)->get('attribute_to_products')->result_array();
            $attr = array();
            foreach($attributes as $k=> $v)
            {
                $aid = $v['attribute_id'];
                $row = $this->db->where('id',$aid)->get('attribute')->row();
                
                if($row)
                {
                    //get options
                    $options = $this->db->where('attr_id',$aid)->where('product_id',$para2)->get('attribute_to_values')->result_array();
                    $attr[] = array(
                        'name'=> $row->name,
                        'options'=> $options
                    );
                }
            }
            $this->load->view('back/vendor/stock_add',array('attribute'=>$attr,'pid'=> $para2));
        }
        elseif ($para1 == 'destroy') {
            $this->load->view('back/vendor/stock_destroy');
        } elseif ($para1 == 'sub_by_cat') {
            $subcat_by_vendor= $this->crud_model->vendor_sub_categories($this->session->userdata('vendor_id'),$para2);
            $result = '';
            $result .=  "<select name=\"sub_category\" class=\"demo-chosen-select required\" onChange=\"get_product(this.value);\"><option value=\"\">".translate('select_sub_category')."</option>";
            foreach ($subcat_by_vendor as $row){
                $result .=  "<option value=\"".$row."\">".$this->crud_model->get_type_name_by_id('sub_category',$row,'sub_category_name')."</option>";
            }
            $result .=  "</select>";
            echo $result;
        }elseif ($para1 == 'pro_by_sub') {
            $product_by_vendor= $this->crud_model->vendor_products_by_sub($this->session->userdata('vendor_id'),$para2);
            $result = '';
            $result .=  "<select name=\"product\" class=\"demo-chosen-select required\" onChange=\"get_pro_res(this.value);\"><option value=\"\">".translate('select_product')."</option>";
            foreach ($product_by_vendor as $row){
                $result .=  "<option value=\"".$row."\">".$this->crud_model->get_type_name_by_id('product',$row,'title')."</option>";
            }

            $result .=  "</select>";
            echo $result;
        }
        else {
            $page_data['page_name'] = "stock";
            $page_data['all_stock'] = $this->db->get('stock')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Managing sales by users */
    function sales($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->vendor_permission('sale')) {
            redirect(base_url() . 'vendor');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $carted = $this->db->get_where('stock', array(
                    'sale_id' => $para2
                ))->result_array();
                foreach ($carted as $row2) {
                    $this->stock('delete', $row2['stock_id']);
                }
                $this->db->where('sale_id', $para2);
                $this->db->delete('sale');
            }

        } elseif ($para1 == 'list') {
            $all = $this->db->get_where('sale',array('payment_type' => 'go'))->result_array();
            foreach ($all as $row) {
                if((time()-$row['sale_datetime']) > 600){
                    $this->db->where('sale_id', $row['sale_id']);
                    $this->db->delete('sale');
                }
            }
            $this->db->order_by('sale_id', 'desc');
            $page_data['all_sales'] = $this->db->get('sale')->result_array();
            $this->load->view('back/vendor/sales_list', $page_data);
        } elseif ($para1 == 'view') {
            $data['viewed'] = 'ok';
            $this->db->where('sale_id', $para2);
            $this->db->update('sale', $data);
            $page_data['sale'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->result_array();
            $this->load->view('back/vendor/sales_view', $page_data);
        } elseif ($para1 == 'send_invoice') {
            $page_data['sale'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->result_array();
            $text              = $this->load->view('back/includes_top', $page_data);
            $text .= $this->load->view('back/vendor/sales_view', $page_data);
            $text .= $this->load->view('back/includes_bottom', $page_data);
        } elseif ($para1 == 'delivery_payment') {
            $data['viewed'] = 'ok';
            $this->db->where('sale_id', $para2);
            $this->db->update('sale', $data);
            $page_data['sale_id']         = $para2;
            $page_data['payment_type']    = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_type;
            $page_data['payment_details'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_details;
            $delivery_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->delivery_status,true);
            foreach ($delivery_status as $row) {
                if(isset($row['vendor'])){
                    if($row['vendor'] == $this->session->userdata('vendor_id')){
                        $page_data['delivery_status'] = $row['status'];
                        if(isset($row['comment'])){
                            $page_data['comment'] = $row['comment'];
                        } else {
                            $page_data['comment'] = '';
                        }
                    }
                }
            }
            $payment_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_status,true);
            foreach ($payment_status as $row) {
                if(isset($row['vendor'])){
                    if($row['vendor'] == $this->session->userdata('vendor_id')){
                        $page_data['payment_status'] = $row['status'];
                    }
                }
            }

            $this->load->view('back/vendor/sales_delivery_payment', $page_data);
        } elseif ($para1 == 'delivery_payment_set') {
            $delivery_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->delivery_status,true);
            $new_delivery_status = array();
            foreach ($delivery_status as $row) {
                if(isset($row['vendor'])){
                    if($row['vendor'] == $this->session->userdata('vendor_id')){
                        $new_delivery_status[] = array('vendor'=>$row['vendor'],'status'=>$this->input->post('delivery_status'),'comment'=>$this->input->post('comment'),'delivery_time'=>time());
                    } else {
                        $new_delivery_status[] = array('vendor'=>$row['vendor'],'status'=>$row['status'],'comment'=>$row['comment'],'delivery_time'=>$row['delivery_time']);
                    }
                }
                else if(isset($row['admin'])){
                    $new_delivery_status[] = array('admin'=>'','status'=>$row['status'],'delivery_time'=>$row['delivery_time']);
                }
            }
            $payment_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_status,true);
            $new_payment_status = array();
            foreach ($payment_status as $row) {
                if(isset($row['vendor'])){
                    if($row['vendor'] == $this->session->userdata('vendor_id')){
                        $new_payment_status[] = array('vendor'=>$row['vendor'],'status'=>$this->input->post('payment_status'));
                    } else {
                        $new_payment_status[] = array('vendor'=>$row['vendor'],'status'=>$row['status']);
                    }
                }
                else if(isset($row['admin'])){
                    $new_payment_status[] = array('admin'=>'','status'=>$row['status']);
                }
            }
            var_dump($new_payment_status);
            $data['payment_status']  = json_encode($new_payment_status);
            $data['delivery_status'] = json_encode($new_delivery_status);
            $data['payment_details'] = $this->input->post('payment_details');
            $this->db->where('sale_id', $para2);
            $this->db->update('sale', $data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/vendor/sales_add');
        } elseif ($para1 == 'total') {
            $sales = $this->db->get('sale')->result_array();
            $i = 0;
            foreach($sales as $row){
                if($this->crud_model->is_sale_of_vendor($row['sale_id'],$this->session->userdata('vendor_id'))){
                    $i++;
                }
            }
            echo $i;
        } else {
            $page_data['page_name']      = "sales";
            $page_data['all_categories'] = $this->db->get('sale')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Payments From Admin */

    function admin_payments($para1='', $para2=''){
        if(!$this->crud_model->vendor_permission('pay_to_vendor')){
            redirect(base_url() . 'vendor');
        }
        if($para1 == 'list'){
            $this->db->order_by('vendor_invoice_id','desc');
            $page_data['payment_list']  = $this->db->get_where('vendor_invoice',array('vendor_id' => $this->session->userdata('vendor_id')))->result_array();
            $this->load->view('back/vendor/admin_payments_list',$page_data);
        }
        else if($para1 == 'view'){
            $page_data['details']  = $this->db->get_where('vendor_invoice',array('vendor_id' => $this->session->userdata('vendor_id'), 'vendor_invoice_id' => $para2))->result_array();
            $this->load->view('back/vendor/admin_payments_view',$page_data);
        }
        else{
            $page_data['page_name'] = 'admin_payments';
            $this->load->view('back/index',$page_data);
        }

    }

    /* Package Upgrade History */

    function upgrade_history($para1='',$para2=''){
        if(!$this->crud_model->vendor_permission('business_settings')){
            redirect(base_url() . 'vendor');
        }
        if($para1=='list'){
            $this->db->order_by('membership_payment_id','desc');
            $page_data['package_history']   = $this->db->get_where('membership_payment',array('vendor' => $this->session->userdata('vendor_id')))->result_array();
            $this->load->view('back/vendor/upgrade_history_list',$page_data);
        }
        else if($para1 == 'view'){
            $page_data['upgrade_history_data'] = $this->db->get_where('membership_payment',array('membership_payment_id' => $para2))->result_array();
            $this->load->view('back/vendor/upgrade_history_view',$page_data);
        }
        else{
            $page_data['page_name'] = 'upgrade_history';
            $this->load->view('back/index',$page_data);
        }
    }

    /* Checking Login Stat */
    function is_logged()
    {
        if ($this->session->userdata('vendor_login') == 'yes') {
            echo 'yah!good';
        } else {
            echo 'nope!bad';
        }
    }

    /* Manage Site Settings */
    function site_settings($para1 = "")
    {
        if (!$this->crud_model->vendor_permission('site_settings')) {
            redirect(base_url() . 'vendor');
        }
        $page_data['page_name'] = "site_settings";
        $page_data['tab_name']  = $para1;
        $this->load->view('back/index', $page_data);
    }


    /* Manage Business Settings */
    function package($para1 = "", $para2 = "")
    {
        if ($para1 == 'upgrade') {
            $method         = $this->input->post('method');
            $type           = $this->input->post('membership');
            $vendor         = $this->session->userdata('vendor_id');

            if($type !== '0'){

                $amount         = $this->db->get_where('membership',array('membership_id'=>$type))->row()->price;
                $amount_in_usd  = $amount/exchange('usd');
                //echo exchange('usd');exit;

                if ($method == 'paypal') {

                    $paypal_email           = $this->db->get_where('business_settings',array('type'=>'paypal_email'))->row()->value;
                    $data['vendor']         = $vendor;
                    $data['amount']         = $amount;
                    $data['status']         = 'due';
                    $data['method']         = 'paypal';
                    $data['membership']     = $type;
                    $data['timestamp']      = time();

                    $this->db->insert('membership_payment', $data);
                    $invoice_id           = $this->db->insert_id();
                    $this->session->set_userdata('invoice_id', $invoice_id);

                    /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                    $this->paypal->add_field('rm', 2);
                    $this->paypal->add_field('no_note', 0);
                    $this->paypal->add_field('cmd', '_xclick');

                    //$this->paypal->add_field('amount', $this->cart->format_number($amount_in_usd));
                    $this->paypal->add_field('amount', $amount_in_usd);

                    //$this->paypal->add_field('amount', $grand_total);
                    $this->paypal->add_field('custom', $invoice_id);
                    $this->paypal->add_field('business', $paypal_email);
                    $this->paypal->add_field('notify_url', base_url() . 'vendor/paypal_ipn');
                    $this->paypal->add_field('cancel_return', base_url() . 'vendor/paypal_cancel');
                    $this->paypal->add_field('return', base_url() . 'vendor/paypal_success');

                    $this->paypal->submit_paypal_post();
                    // submit the fields to paypal

                }
                else if ($method == 'bitcoin') {

                    $data['vendor']         = $vendor;
                    $data['amount']         = $amount;
                    $data['status']         = 'due';
                    $data['method']         = 'bitcoin';
                    $data['membership']     = $type;
                    $data['timestamp']      = time();

                    $this->db->insert('membership_payment', $data);
                    $invoice_id           = $this->db->insert_id();
                    $this->session->set_userdata('invoice_id', $invoice_id);

                    $bitcoin_coinpayments_merchant = $this->db->get_where('business_settings',array('type'=>'bitcoin_coinpayments_merchant'))->row()->value;
                    $final_amount = $amount_in_usd;

                    echo $this->load->view('back/vendor/bitcoin_vendor_package_payment_view',compact('bitcoin_coinpayments_merchant','final_amount'),true);
                    exit;


                } elseif ($method == 'pum') {

                    $pum_key           = $this->db->get_where('business_settings',array('type'=>'pum_merchant_key'))->row()->value;
                    $pum_salt           = $this->db->get_where('business_settings',array('type'=>'pum_merchant_salt'))->row()->value;
                    $data['vendor']         = $vendor;
                    $data['amount']         = $amount;
                    $data['status']         = 'due';
                    $data['method']         = 'PayUmoney';
                    $data['membership']     = $type;
                    $data['timestamp']      = time();

                    $this->db->insert('membership_payment', $data);
                    $invoice_id           = $this->db->insert_id();
                    $this->session->set_userdata('invoice_id', $invoice_id);

                    $this->pum->add_field('key', $pum_key);
                    $this->pum->add_field('txnid',substr(hash('sha256', mt_rand() . microtime()), 0, 20));
                    $this->pum->add_field('amount', $amount);
                    $this->pum->add_field('firstname', $this->db->get_where('vendor', array('vendor_id' => $vendor))->row()->name);
                    $this->pum->add_field('email', $this->db->get_where('vendor', array('vendor_id' => $vendor))->row()->email);
                    $this->pum->add_field('phone', 'Not Given');
                    $this->pum->add_field('productinfo', 'Payment with PayUmoney');
                    $this->pum->add_field('service_provider', 'payu_paisa');
                    $this->pum->add_field('udf1', $vendor);

                    $this->pum->add_field('surl', base_url().'vendor/vendor_pum_success');
                    $this->pum->add_field('furl', base_url().'vendor/vendor_pum_failure');

                    // submit the fields to pum
                    $this->pum->submit_pum_post();

                }elseif ($method == 'ssl') {

                    $data['vendor']         = $vendor;
                    $data['amount']         = $amount;
                    $data['status']         = 'due';
                    $data['method']         = 'SSlcommerz';
                    $data['membership']     = $type;
                    $data['timestamp']      = time();

                    $this->db->insert('membership_payment', $data);
                    $invoice_id           = $this->db->insert_id();
                    $this->session->set_userdata('invoice_id', $invoice_id);

                    $ssl_store_id = $this->db->get_where('business_settings', array('type' => 'ssl_store_id'))->row()->value;
                    $ssl_store_passwd = $this->db->get_where('business_settings', array('type' => 'ssl_store_passwd'))->row()->value;
                    $ssl_type = $this->db->get_where('business_settings', array('type' => 'ssl_type'))->row()->value;

                    /* PHP */
                    $post_data = array();
                    $post_data['store_id'] = $ssl_store_id;
                    $post_data['store_passwd'] = $ssl_store_passwd;
                    $post_data['total_amount'] = $amount;
                    $post_data['currency'] = "BDT";
                    $post_data['tran_id'] = date('Ym', $data['timestamp']) . $invoice_id;
                    $post_data['success_url'] = base_url()."vendor/vendor_sslcommerz_success";
                    $post_data['fail_url'] = base_url()."vendor/vendor_sslcommerz_fail";
                    $post_data['cancel_url'] = base_url()."vendor/vendor_sslcommerz_cancel";
                    # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

                    # EMI INFO
                    $post_data['emi_option'] = "1";
                    $post_data['emi_max_inst_option'] = "9";
                    $post_data['emi_selected_inst'] = "9";

                    $user_id = $this->session->userdata('vendor_id');
                    $user_info = $this->db->get_where('vendor', array('vendor_id' => $user_id))->row();

                    $cus_name = $user_info->name;

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
                    curl_setopt($handle, CURLOPT_URL, $direct_api_url );
                    curl_setopt($handle, CURLOPT_TIMEOUT, 30);
                    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
                    curl_setopt($handle, CURLOPT_POST, 1 );
                    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
                    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                    if ($ssl_type == "sandbox") {
                        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC
                    } elseif ($ssl_type == "live") {
                        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, TRUE);
                    }


                    $content = curl_exec($handle);

                    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

                    if($code == 200 && !( curl_errno($handle))) {
                        curl_close( $handle);
                        $sslcommerzResponse = $content;
                    } else {
                        curl_close( $handle);
                        echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
                        exit;
                    }

                    # PARSE THE JSON RESPONSE
                    $sslcz = json_decode($sslcommerzResponse, true );

                    if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
                        # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                        # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                        echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
                        # header("Location: ". $sslcz['GatewayPageURL']);
                        exit;
                    } else {
                        echo "JSON Data parsing error!";
                    }

                }else if ($method == 'c2') {
                    $data['vendor']         = $vendor;
                    $data['amount']         = $amount;
                    $data['status']         = 'due';
                    $data['method']         = 'c2';
                    $data['membership']     = $type;
                    $data['timestamp']      = time();

                    $this->db->insert('membership_payment', $data);
                    $invoice_id           = $this->db->insert_id();
                    $this->session->set_userdata('invoice_id', $invoice_id);

                    $c2_user = $this->db->get_where('business_settings',array('type' => 'c2_user'))->row()->value;
                    $c2_secret = $this->db->get_where('business_settings',array('type' => 'c2_secret'))->row()->value;


                    $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
                    $this->twocheckout_lib->add_field('sid', $this->twocheckout_lib->sid);              //Required - 2Checkout account number
                    $this->twocheckout_lib->add_field('cart_order_id', $invoice_id);   //Required - Cart ID
                    $this->twocheckout_lib->add_field('total',$this->cart->format_number($amount_in_usd));

                    $this->twocheckout_lib->add_field('x_receipt_link_url', base_url().'vendor/twocheckout_success');
                    $this->twocheckout_lib->add_field('demo', $this->twocheckout_lib->demo);                    //Either Y or N

                    $this->twocheckout_lib->submit_form();
                }else if($method == 'vp'){
                    $vp_id                  = $this->db->get_where('business_settings',array('type'=>'vp_merchant_id'))->row()->value;
                    $data['vendor']         = $vendor;
                    $data['amount']         = $amount;
                    $data['status']         = 'due';
                    $data['method']         = 'vouguepay';
                    $data['membership']     = $type;
                    $data['timestamp']      = time();

                    $this->db->insert('membership_payment', $data);
                    $invoice_id           = $this->db->insert_id();
                    $this->session->set_userdata('invoice_id', $invoice_id);

                    /****TRANSFERRING USER TO vouguepay TERMINAL****/
                    $this->vouguepay->add_field('v_merchant_id', $vp_id);
                    $this->vouguepay->add_field('merchant_ref', $invoice_id);
                    $this->vouguepay->add_field('memo', 'Package Upgrade to '.$type);
                    //$this->vouguepay->add_field('developer_code', $developer_code);
                    //$this->vouguepay->add_field('store_id', $store_id);


                    $this->vouguepay->add_field('total', $amount);

                    //$this->vouguepay->add_field('amount', $grand_total);
                    //$this->vouguepay->add_field('custom', $sale_id);
                    //$this->vouguepay->add_field('business', $vouguepay_email);

                    $this->vouguepay->add_field('notify_url', base_url() . 'vendor/vouguepay_ipn');
                    $this->vouguepay->add_field('fail_url', base_url() . 'vendor/vouguepay_cancel');
                    $this->vouguepay->add_field('success_url', base_url() . 'vendor/vouguepay_success');

                    $this->vouguepay->submit_vouguepay_post();
                    // submit the fields to vouguepay
                } else if ($method == 'stripe') {
                    if($this->input->post('stripeToken')) {

                        $stripe_api_key = $this->db->get_where('business_settings' , array('type' => 'stripe_secret'))->row()->value;
                        require_once(APPPATH . 'libraries/stripe-php/init.php');
                        \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                        $vendor_email = $this->db->get_where('vendor' , array('vendor_id' => $vendor))->row()->email;

                        $vendora = \Stripe\Customer::create(array(
                            'email' => $vendor_email, // customer email id
                            'card'  => $_POST['stripeToken']
                        ));

                        $charge = \Stripe\Charge::create(array(
                            'customer'  => $vendora->id,
                            'amount'    => ceil($amount_in_usd*100),
                            'currency'  => 'USD'
                        ));

                        if($charge->paid == true){
                            $vendora = (array) $vendora;
                            $charge = (array) $charge;

                            $data['vendor']         = $vendor;
                            $data['amount']         = $amount;
                            $data['status']         = 'paid';
                            $data['method']         = 'stripe';
                            $data['timestamp']      = time();
                            $data['membership']     = $type;
                            $data['details']        = "Customer Info: \n".json_encode($vendora,true)."\n \n Charge Info: \n".json_encode($charge,true);

                            $this->db->insert('membership_payment', $data);
                            $this->crud_model->upgrade_membership($vendor,$type);
                            redirect(base_url() . 'vendor/package/', 'refresh');
                        } else {
                            $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                            redirect(base_url() . 'vendor/package/', 'refresh');
                        }

                    } else{
                        $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                        redirect(base_url() . 'vendor/package/', 'refresh');
                    }
                } else if ($method == 'cash') {
                    $data['vendor']         = $vendor;
                    $data['amount']         = $amount;
                    $data['status']         = 'due';
                    $data['method']         = 'cash';
                    $data['timestamp']      = time();
                    $data['membership']     = $type;
                    $this->db->insert('membership_payment', $data);
                    redirect(base_url() . 'vendor/package/', 'refresh');
                } else {
                    echo 'putu';
                }
            } else {
                redirect(base_url() . 'vendor/package/', 'refresh');
            }
        } else {
            $page_data['page_name'] = "package";
            $this->load->view('back/index', $page_data);
        }
    }

    function vendor_pum_success()
    {
        $status         =   $_POST["status"];
        $firstname      =   $_POST["firstname"];
        $amount         =   $_POST["amount"];
        $txnid          =   $_POST["txnid"];
        $posted_hash    =   $_POST["hash"];
        $key            =   $_POST["key"];
        $productinfo    =   $_POST["productinfo"];
        $email          =   $_POST["email"];
        $udf1           =   $_POST['udf1'];
        $salt           =   $this->crud_model->get_settings_value('business_settings', 'pum_merchant_salt', 'value');

        if (isset($_POST["additionalCharges"])) {
            $additionalCharges = $_POST["additionalCharges"];
            $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'||||||||||'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        } else {
            $retHashSeq = $salt.'|'.$status.'||||||||||'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        }
        $hash = hash("sha512", $retHashSeq);

        if ($hash != $posted_hash) {
            $invoice_id = $this->session->userdata('invoice_id');
            $this->db->where('membership_payment_id', $invoice_id);
            $this->db->delete('membership_payment');
            $this->session->set_userdata('invoice_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            redirect(base_url() . 'vendor/package/', 'refresh');
        } else {

            $data['status']         = 'paid';
            $data['details']        = json_encode($_POST);
            $invoice_id             = $_POST['custom'];
            $this->db->where('membership_payment_id', $invoice_id);
            $this->db->update('membership_payment', $data);
            $type = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->membership;
            $vendor = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->vendor;
            $this->crud_model->upgrade_membership($vendor,$type);

            $this->session->set_userdata('invoice_id', '');
            redirect(base_url() . 'vendor/package/', 'refresh');
        }
    }

    function vendor_pum_failure()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('membership_payment_id', $invoice_id);
        $this->db->delete('membership_payment');
        $this->session->set_userdata('invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'vendor/package/', 'refresh');
    }

    function vendor_sslcommerz_success()
    {
        $invoice_id = $this->session->userdata('invoice_id');

        if ($invoice_id != '' || !empty($invoice_id)) {

            $data['status']         = 'paid';
            $data['details']        = json_encode($_POST);

            $this->db->where('membership_payment_id', $invoice_id);
            $this->db->update('membership_payment', $data);
            $type = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->membership;
            $vendor = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->vendor;
            $this->crud_model->upgrade_membership($vendor,$type);

            $this->session->set_userdata('invoice_id', '');
            redirect(base_url() . 'vendor/package/', 'refresh');
        } else {
            redirect(base_url() . 'vendor/package/', 'refresh');
        }
    }

    function vendor_sslcommerz_fail()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('membership_payment_id', $invoice_id);
        $this->db->delete('membership_payment');
        $this->session->set_userdata('invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'vendor/package/', 'refresh');
    }

    function vendor_sslcommerz_cancel()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('membership_payment_id', $invoice_id);
        $this->db->delete('membership_payment');
        $this->session->set_userdata('invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'vendor/package/', 'refresh');
    }

    function bitcoin_vendor_package_cancel()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('membership_payment_id', $invoice_id);
        $this->db->delete('membership_payment');
        $this->session->set_userdata('invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'vendor/package/', 'refresh');
    }


    function bitcoin_vendor_package_success()
    {
        $invoice_id = $this->session->userdata('invoice_id');

        $data['status']         = 'paid';
        $data['details']        = json_encode($_POST);

        $this->db->where('membership_payment_id', $invoice_id);
        $this->db->update('membership_payment', $data);
        $type = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->membership;
        $vendor = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->vendor;
        $this->crud_model->upgrade_membership($vendor,$type);

        $this->session->set_userdata('invoice_id', '');
        redirect(base_url() . 'vendor/package/', 'refresh');
    }


    /* FUNCTION: Verify paypal payment by IPN*/
    function paypal_ipn()
    {
        if ($this->paypal->validate_ipn() == true) {

            $data['status']         = 'paid';
            $data['details']        = json_encode($_POST);
            $invoice_id             = $_POST['custom'];
            $this->db->where('membership_payment_id', $invoice_id);
            $this->db->update('membership_payment', $data);
            $type = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->membership;
            $vendor = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->vendor;
            $this->crud_model->upgrade_membership($vendor,$type);
        }
    }


    /* FUNCTION: Loads after cancelling paypal*/
    function paypal_cancel()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('membership_payment_id', $invoice_id);
        $this->db->delete('membership_payment');
        $this->session->set_userdata('invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'vendor/package/', 'refresh');
    }

    /* FUNCTION: Loads after successful paypal payment*/
    function paypal_success()
    {
        $this->session->set_userdata('invoice_id', '');
        redirect(base_url() . 'vendor/package/', 'refresh');
    }

    function twocheckout_success()
    {

        /*$this->twocheckout_lib->set_acct_info('532001', 'tango', 'Y');*/
        $c2_user = $this->db->get_where('business_settings',array('type' => 'c2_user'))->row()->value;
        $c2_secret = $this->db->get_where('business_settings',array('type' => 'c2_secret'))->row()->value;

        $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
        $data2['response'] = $this->twocheckout_lib->validate_response();
        //var_dump($this->twocheckout_lib->validate_response());
        $status = $data2['response']['status'];
        if ($status == 'pass') {
            $data1['status']             = 'paid';
            $data1['details']   = json_encode($this->twocheckout_lib->validate_response());
            $invoice_id         = $this->session->userdata('invoice_id');
            $this->db->where('membership_payment_id', $invoice_id);
            $this->db->update('membership_payment', $data1);
            $type = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->membership;
            $vendor = $this->db->get_where('membership_payment',array('membership_payment_id'=>$invoice_id))->row()->vendor;
            $this->crud_model->upgrade_membership($vendor,$type);
            redirect(base_url() . 'vendor/package/', 'refresh');

        } else {
            //var_dump($data2['response']);
            $invoice_id = $this->session->userdata('invoice_id');
            $this->db->where('membership_payment_id', $invoice_id);
            $this->db->delete('membership_payment');
            $this->session->set_userdata('invoice_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            redirect(base_url() . 'vendor/package', 'refresh');
        }
    }
 /* FUNCTION: Verify vouguepay payment by IPN*/
    function vouguepay_ipn()
    {
        $res = $this->vouguepay->validate_ipn();
        $invoice_id = $res['merchant_ref'];
        $merchant_id = 'demo';

        if ($res['total'] !== 0 && $res['status'] == 'Approved' && $res['merchant_id'] == $merchant_id) {
            $data['status']         = 'paid';
            $data['details']        = json_encode($res);
            $this->db->where('membership_payment_id', $invoice_id);
            $this->db->update('membership_payment', $data);
        }
    }

    /* FUNCTION: Loads after cancelling vouguepay*/
    function vouguepay_cancel()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('membership_payment_id', $invoice_id);
        $this->db->delete('membership_payment');
        $this->session->set_userdata('invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'vendor/package/', 'refresh');
    }

    /* FUNCTION: Loads after successful vouguepay payment*/
    function vouguepay_success()
    {
        $this->session->set_userdata('invoice_id', '');
        redirect(base_url() . 'vendor/package/', 'refresh');
    }
    /* Manage Business Settings */
    function business_settings($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->vendor_permission('business_settings')) {
            redirect(base_url() . 'vendor');
        }
        if ($para1 == "cash_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'cash_set' => $val
            ));
            recache();
        }
        else if ($para1 == "paypal_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'paypal_set' => $val
            ));
            recache();
        }
        else if ($para1 == "bitcoin_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'bitcoin_set' => $val
            ));
            recache();
        }
        else if ($para1 == "pum_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'pum_set' => $val
            ));
            recache();
        }
        else if ($para1 == "stripe_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'stripe_set' => $val
            ));
            recache();
        }
        else if ($para1 == "c2_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'c2_set' => $val
            ));
            recache();
        }
        else if ($para1 == "vp_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'vp_set' => $val
            ));
            recache();
        }
        else if ($para1 == "membership_price") {
            echo $this->db->get_where('membership',array('membership_id'=>$para2))->row()->price;
        }
        else if ($para1 == "membership_info") {
            $return = '<div class="table-responsive"><table class="table table-striped">';
            if($para2 !== '0'){
                $results = $this->db->get_where('membership',array('membership_id'=>$para2))->result_array();
                foreach ($results as $row) {
                    $return .= '<tr>';
                    $return .= '<td>'.translate('title').'</td>';
                    $return .= '<td>'.$row['title'].'</td>';
                    $return .= '</tr>';

                    $return .= '<tr>';
                    $return .= '<td>'.translate('price').'</td>';
                    $return .= '<td>'.currency($row['price'],'def').'</td>';
                    $return .= '</tr>';

                    $return .= '<tr>';
                    $return .= '<td>'.translate('timespan').'</td>';
                    $return .= '<td>'.$row['timespan'].'</td>';
                    $return .= '</tr>';

                    $return .= '<tr>';
                    $return .= '<td>'.translate('maximum_product').'</td>';
                    $return .= '<td>'.$row['product_limit'].'</td>';
                    $return .= '</tr>';
                }
            } else if($para2 == '0'){
                $return .= '<tr>';
                $return .= '<td>'.translate('title').'</td>';
                $return .= '<td>'.translate('default').'</td>';
                $return .= '</tr>';

                $return .= '<tr>';
                $return .= '<td>'.translate('price').'</td>';
                $return .= '<td>'.translate('free').'</td>';
                $return .= '</tr>';

                $return .= '<tr>';
                $return .= '<td>'.translate('timespan').'</td>';
                $return .= '<td>'.translate('lifetime').'</td>';
                $return .= '</tr>';

                $return .= '<tr>';
                $return .= '<td>'.translate('maximum_product').'</td>';
                $return .= '<td>'.$this->db->get_where('general_settings',array('type'=>'default_member_product_limit'))->row()->value.'</td>';
                $return .= '</tr>';
            }
            $return .= '</table></div>';
            echo $return;
        }
        else if ($para1 == 'set') {
            $publishable    = $this->input->post('stripe_publishable');
            $secret         = $this->input->post('stripe_secret');
            $stripe         = json_encode(array('publishable'=>$publishable,'secret'=>$secret));
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'paypal_email' => $this->input->post('paypal_email')
            ));
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'stripe_details' => $stripe
            ));
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'c2_user' => $this->input->post('c2_user'),
                'c2_secret' => $this->input->post('c2_secret'),
            ));
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'vp_merchant_id' => $this->input->post('vp_merchant_id')
            ));
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'pum_merchant_key' => $this->input->post('pum_merchant_key')
            ));
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'pum_merchant_salt' => $this->input->post('pum_merchant_salt')
            ));

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'bitcoin_coinpayments_merchant' => $this->input->post('bitcoin_coinpayments_merchant')
            ));
            recache();
        } else {
            $page_data['page_name'] = "business_settings";
            $this->load->view('back/index', $page_data);
        }
    }


    /* Manage vendor Settings */
    function manage_vendor($para1 = "")
    {
        if ($this->session->userdata('vendor_login') != 'yes') {
            redirect(base_url() . 'vendor');
        }
        if ($para1 == 'update_password') {
            $user_data['password'] = $this->input->post('password');
            $account_data          = $this->db->get_where('vendor', array(
                'vendor_id' => $this->session->userdata('vendor_id')
            ))->result_array();
            foreach ($account_data as $row) {
                if (sha1($user_data['password']) == $row['password']) {
                    if ($this->input->post('password1') == $this->input->post('password2')) {
                        $data['password'] = sha1($this->input->post('password1'));
                        $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
                        $this->db->update('vendor', $data);
                        echo 'updated';
                    }
                } else {
                    echo 'pass_prb';
                }
            }
        } else if ($para1 == 'update_profile') {
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address1' => $this->input->post('address1'),
                'address2' => $this->input->post('address2'),
                'company' => $this->input->post('company'),
                'display_name' => $this->input->post('display_name'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'zip' => $this->input->post('zip'),
                'description' => $this->input->post('description'),

                'details' => $this->input->post('details'),
                'phone' => $this->input->post('phone'),
                'lat_lang' => $this->input->post('lat_lang')
            ));
        } else {
            
            $page_data['page_name'] = "manage_vendor";
            $this->load->view('back/index', $page_data);
        }
    }

    /* Manage General Settings */
    function general_settings($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->vendor_permission('site_settings')) {
            redirect(base_url() . 'vendor');
        }

    }

    /* Manage Social Links */
    function social_links($para1 = "")
    {
        if (!$this->crud_model->vendor_permission('site_settings')) {
            redirect(base_url() . 'vendor');
        }
        if ($para1 == "set") {

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'facebook' => $this->input->post('facebook')
            ));

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'google_plus' => $this->input->post('google-plus')
            ));

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'twitter' => $this->input->post('twitter')
            ));

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'skype' => $this->input->post('skype')
            ));

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'pinterest' => $this->input->post('pinterest')
            ));

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'youtube' => $this->input->post('youtube')
            ));
            recache();
            redirect(base_url() . 'vendor/site_settings/social_links/', 'refresh');

        }
    }

    /* Manage SEO relateds */
    function seo_settings($para1 = "")
    {
        if (!$this->crud_model->vendor_permission('site_settings')) {
            redirect(base_url() . 'vendor');
        }
        if ($para1 == "set") {

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'seo_title' => $this->input->post('seo_title')
            ));

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'seo_description' => $this->input->post('seo_description')
            ));

            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $this->db->update('vendor', array(
                'keywords' => $this->input->post('keywords')
            ));
            recache();
        }
    }
    
    function gallary($para1 = "")
    {
       
        if ($para1 == "set") {
            
            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['logo']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                
                $this->load->library('cloudinarylib');
                if(isset($_FILES["logo"]['tmp_name']) && $_FILES["logo"]['tmp_name'])
                {
    
                    $path = 'uploads/vendor_logo_image/logo_' . $this->session->userdata('vendor_id') . '.png';
    
                    move_uploaded_file($_FILES["logo"]['tmp_name'], 'uploads/vendor_logo_image/logo_' . $this->session->userdata('vendor_id') .$i. '.png');
                    
                    $data = \Cloudinary\Uploader::upload($path);
                    if(isset($data['public_id']))
                    {
                        $logo_id = $this->crud_model->add_img($path,$data);
                        array_push($dataInfo,$logo_id);
                    }
                }
            }
            // print_r($dataInfo);
            // return $dataInfo;
            $this->db->where('vendor_id', $this->session->userdata('vendor_id'));
            $query = $this->db->update('vendor', array(
                'gallary' => $dataInfo,
            ));
            
            if(!$query){
                return "error";
            }else{
                return "okya";
            }
        }
    }
    // Blog
    function blog($para1 = '', $para2 = '')
    {
        if ($para1 == 'do_add') {
            $data['title']          = $this->input->post('title');
            $data['date']           = $this->input->post('date');
            $data['author']         = $this->input->post('author');
            $data['summery']        = $this->input->post('summery');
            $data['blog_category']  = $this->input->post('blog_category');
            $data['description']    = $this->input->post('description');
            $data['added_by']       = json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')));
            $this->db->insert('blog', $data);
            $id = $this->db->insert_id();
            if(!demo()){
                $this->crud_model->file_up("img", "blog", $id, '', '', '.jpg');
            }
            recache();
        } else if ($para1 == 'edit') {
            $page_data['blog_data'] = $this->db->get_where('blog', array(
                'blog_id' => $para2
            ))->result_array();
            $this->load->view('back/vendor/blog_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['title']          = $this->input->post('title');
            $data['date']           = $this->input->post('date');
            $data['author']         = $this->input->post('author');
            $data['summery']        = $this->input->post('summery');
            $data['blog_category']  = $this->input->post('blog_category');
            $data['description']    = $this->input->post('description');
            $this->db->where('blog_id', $para2);
            $this->db->update('blog', $data);
            $this->crud_model->file_up("img", "blog", $para2, '', '', '.jpg');
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->crud_model->file_dlt('blog', $para2, '.jpg');
                $this->db->where('blog_id', $para2);
                $this->db->delete('blog');
                recache();
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('blog_id', 'desc');
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
            $page_data['all_blogs'] = $this->db->get('blog')->result_array();
            $this->load->view('back/vendor/blog_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/vendor/blog_add');
        } else {
            $page_data['page_name']      = "blog";
            $page_data['all_blogs'] = $this->db->get('blog')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }


    /* Manage Favicons */
    function vendor_images($para1 = "")
    {
        if (!$this->crud_model->vendor_permission('site_settings')) {
            redirect(base_url() . 'vendor');
        }
        if(!demo()){
            $uid = $this->session->userdata('vendor_id');
            $user = $this->db->where('vendor_id',$uid)->get('vendor')->row();
            
            if($user->bpage)
            {
                //code here
            
                $this->load->library('cloudinarylib');
                if(isset($_FILES["logo"]['tmp_name']) && $_FILES["logo"]['tmp_name'])
                {
    
                    $path = 'uploads/vendor_logo_image/logo_' . $this->session->userdata('vendor_id') . '.png';
    
                    move_uploaded_file($_FILES["logo"]['tmp_name'], 'uploads/vendor_logo_image/logo_' . $this->session->userdata('vendor_id') . '.png');
                    
                    $data = \Cloudinary\Uploader::upload($path);
                    if(isset($data['public_id']))
                    {
                        $logo_id = $this->crud_model->add_img($path,$data);
                        $this->db->where('product_id',$user->bpage)->update('product',array('comp_logo'=>$logo_id));
                    }
                }
                if(isset($_FILES["banner"]['tmp_name']) && $_FILES["banner"]['tmp_name'])
                {
    
    
                    $path = 'uploads/vendor_banner_image/banner_' . $this->session->userdata('vendor_id') . '.png';
    
                    move_uploaded_file($_FILES["banner"]['tmp_name'], 'uploads/vendor_banner_image/banner_' . $this->session->userdata('vendor_id') . '.png');
                    // $this->load->library('cloudinarylib');
                    $data = \Cloudinary\Uploader::upload($path);
    
                    if(isset($data['public_id']))
                    {
                        $logo_id = $this->crud_model->add_img($path,$data);
                        $this->db->where('product_id',$user->bpage)->update('product',array('comp_cover'=>$logo_id));

                    }
                }
            }
            recache();
        }
    }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

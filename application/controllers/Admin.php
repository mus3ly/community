<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
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
        //$this->output->enable_profiler(TRUE);
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        //$this->crud_model->ip_data()
    }

    /* index of the admin. Default: Dashboard; On No Login Session: Back to login page. */
    public function main_login()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            $page_data['page_name'] = "dashboard";

            echo $this->load->view('back/index', $page_data,true);
        } else {
            

            $page_data['control'] = "admin";
            echo $this->load->view('back/login',$page_data,true);
        }
    }
    public function index()
    { 
        if ($this->session->userdata('admin_login') == 'yes') {
            $page_data['page_name'] = "dashboard";

            echo $this->load->view('back/index', $page_data,true);
        } else {
            

            $page_data['control'] = "admin";
            echo $this->load->view('back/login',$page_data,true);
        }
    }
    // public function testingByNimra(){
    //     $fields = $this->db->field_data('product');
    //  foreach ($fields as $field)
    //     {
    //       $data['key'] =  $field->name;
    //       $this->db->insert( 'default_business',$data);

    //     }
    //     echo $this->db->last_query();

    // }
    function package($para1 = '', $para2 = '',$para3='') {
        /*if (!$this->crud_model->admin_permission('package')) {
            redirect(base_url() . 'admin');
        }*/
        if ($para1 == 'list'){
            $page_data['all_packages'] = $this->db->get("package")->result();
            $page_data['page_name'] = 'package';

            $this->load->view('back/admin/package_list',$page_data);
        }
        elseif ($para1 == "edit") {
            $page_data['get_package'] = $this->db->get_where("package", array("package_id" => $para2))->result();
            $page_data['page_name'] = 'package_edit';
            $this->load->view('back/admin/package_edit',$page_data);
        }
        elseif ($para1=="update") {
            $package_id = $this->input->post('package_id');
            $data['name'] = $this->input->post('name');
            $data['amount'] = $this->input->post('amount');
            $data['upload_amount'] = $this->input->post('upload_amount');

            if(!demo()){
                if ($_FILES['image']['name'] !== '') {
                    $id = $package_id;
                    $path = $_FILES['image']['name'];
                    $ext = '.' . pathinfo($path, PATHINFO_EXTENSION);
                    if ($ext==".jpg" || $ext==".JPG" || $ext==".jpeg" || $ext==".JPEG" || $ext==".png" || $ext==".PNG") {
                        $this->crud_model->file_up("image", "plan", $id, '', '', $ext);
                        $images[] = array('image' => 'plan_' . $id . $ext, 'thumb' => 'plan_' . $id . '_thumb' . $ext);
                        $data['image'] = json_encode($images);
                    }
                    else {
                        $this->session->set_flashdata('alert', 'failed_image');
                        redirect(base_url().'admin/package', 'refresh');
                    }
                }
            }

            $this->db->where('package_id', $para2);
            $result = $this->db->update('package', $data);
            if ($result) {
                $this->session->set_flashdata('alert', 'edit');
                redirect(base_url().'admin/package', 'refresh');
            }
            else {
                echo "Data Failed to Edit!";
            }
            exit;
        }
        else {
            $page_data['all_packages'] = $this->db->get("package")->result();
            $page_data['page_name'] = 'package';
            $this->load->view('back/index', $page_data);
        }
    }
    function membership_category($para1 = '', $para2 = ''){
        {

        // if (!$this->crud_model->admin_permission('blog')) {
        //     redirect(base_url() . 'admin');
        // }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $data['status'] = $this->input->post('status');
            $data['visible'] = $this->input->post('visible');
            $data['promo_cat'] = $this->input->post('promo_cat');
            $this->db->insert('member_cat', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['blog_category_data'] = $this->db->get_where('member_cat', array(
                'id' => $para2
            ))->result_array();
            $this->load->view('back/admin/member_category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
            $data['status'] = $this->input->post('status');
            $data['visible'] = $this->input->post('visible');
            $data['promo_cat'] = $this->input->post('promo_cat');
            $this->db->where('id', $para2);
            $this->db->update('member_cat', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('id', $para2);
                $this->db->delete('member_cat');
                recache();
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('id', 'ASC');
            $page_data['all_categories'] = $this->db->get('member_cat')->result_array();
            $this->load->view('back/admin/member_category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/member_category_add');
        } else {
            $page_data['page_name']      = "member_category";
            $page_data['all_categories'] = $this->db->get('member_cat')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    }
    /*Product Category add, edit, view, delete */
    function category($para1 = '', $para2 = '')
    {
        if ($para1 == 'ulevel') {
            $parent = $para2 - 1;
            $ids = array();
            if($para2 == 1)
            {

            $d= $this->db->where('pcat',0)->get('category')->result_array();
            foreach($d as $k => $v)
            {
                $ids[] = $v['category_id'];
            }
            $ids = join("','",$ids);
$sql = "UPDATE  `category` SET `level` = '".$para2."' WHERE `category_id`  IN ('$ids')";
            $query = $this->db->query($sql);
            if($query)
            {
             echo $para2 +1;
            }
            }
            else
            {
                $d= $this->db->where('level',$parent)->get('category')->result_array();
                if(!$d)
                {
                    echo "0";
                    exit();
                }

            foreach($d as $k => $v)
            {
                $ids[] = $v['category_id'];
            }
            // var_dump($ids);
            // die();
            $ids = join("','",$ids);

$sql = "UPDATE  `category` SET `level` = '".$para2."' WHERE `pcat`  IN ('$ids')";
// echo $sql;
// die();
            $query = $this->db->query($sql);

            if($query)
            {
             echo $para2 +1;
            }
            }
            exit();

        }
        if (!$this->crud_model->admin_permission('category')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }

        if ($para1 == 'do_add') {
            $name = $this->input->post('category_name');
            $exp = explode(',', $name);
            foreach ($exp as $key => $value) {
                $data['category_name'] = $value;
            $data['fa_icon'] = $this->input->post('fa_icon');
            $data['pcat'] = $this->input->post('pcat');

            $this->db->insert('category', $data);
            $id = $this->db->insert_id();
            }
            recache();
        } else if ($para1 == 'edit') {
            $page_data['category_data'] = $this->db->get_where('category', array(
                'category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['category_name'] = $this->input->post('category_name');
            $data['fa_icon'] = $this->input->post('fa_icon');
            $data['pcat'] = $this->input->post('pcat');
            $data['level'] = 0;
            $data['slug'] = $this->input->post('slug');
            $this->db->where('category_id', $para2);
            $this->db->update('category', $data);
            if($_FILES['img']['name']!== ''){
                $path = $_FILES['img']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $data_banner['banner']       = 'category_'.$para2.'.'.$ext;
                $this->crud_model->file_up("img", "category", $para2, '', 'no', '.'.$ext);
                $this->db->where('category_id', $para2);
                $this->db->update('category', $data_banner);
            }
            if($_FILES['icon']['name']!== ''){
                $path = $_FILES['icon']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $data_banner['icon']       = 'category_icon_'.$para2.'.'.$ext;
                $this->crud_model->file_up("icon", "category_icon", $para2, '', 'no', '.'.$ext);
                // die($data_banner['icon']);
                $this->db->where('category_id', $para2);
                $this->db->update('category', $data_banner);
            }
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                unlink("uploads/category_image/" .$this->crud_model->get_type_name_by_id('category',$_REQUEST['id'],'banner'));
                $this->db->where('category_id', $_REQUEST['id']);
                $this->db->delete('category');
                echo 'success';
            }



        } elseif ($para1 == 'list') {
            $this->db->order_by('category_id', 'desc');
            $this->db->where('digital=',NULL);
            $page_data['all_categories'] = $this->db->get('category')->result_array();
            $this->load->view('back/admin/category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/category_add');
        } elseif ($para1 == 'signup_cat') {
            $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 71))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            if(in_array($para2, $result))
                                            {
                                                $key = array_search($para2, $result);
                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $para2;

                                            }
                                            $json = json_encode($result);
                                            $this->db->where('ui_settings_id', 71)->update('ui_settings',array('value'=>$json));
        } elseif ($para1 == 'signup_main_cat') {

                                        $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 72))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }

                                            if(in_array($para2, $result))
                                            {
                                                $key = array_search($para2, $result);

                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $para2;

                                            }

                                            echo $json = json_encode($result);
                                            die();
                                            $r  = $this->db->where('ui_settings_id', 72)->update('ui_settings',array('value'=>$json));

        } elseif ($para1 == 'main_cat') {
            $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            if(in_array($para2, $result))
                                            {
                                                $key = array_search($para2, $result);
                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $para2;

                                            }
                                            $json = json_encode($result);
                                            $this->db->where('ui_settings_id', 35)->update('ui_settings',array('value'=>$json));
        }  elseif ($para1 == 'pegs') {
            // die('ok');
            $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 86))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            if(in_array($para2, $result))
                                            {
                                                $key = array_search($para2, $result);
                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $para2;

                                            }
                                            $json = json_encode($result);
                                            $this->db->where('ui_settings_id', 86)->update('ui_settings',array('value'=>$json));
        } elseif ($para1 == 'shop') {
            // die('ok');
            $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 87))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            if(in_array($para2, $result))
                                            {
                                                $key = array_search($para2, $result);
                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $para2;

                                            }
                                            $json = json_encode($result);
                                            $this->db->where('ui_settings_id', 87)->update('ui_settings',array('value'=>$json));
        } else {
            $page_data['page_name']      = "category";
            $page_data['all_categories'] = $this->db->get('category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    function cat_slug(){
        if(isset($_REQUEST['cat']) && $_REQUEST['cat'])
        {
            $this->db->where('category_id !=',$_REQUEST['cat']);
        }
        $this->db->where('slug', $_REQUEST['val']);
        $q = $this->db->get('category')->num_rows();
        if($q > 0){
            echo 'error';
        }else{
            echo 'success';
        }
    }
    function cat_child(){
        if($_REQUEST['del'] == 1){

            echo $this->db->where('category_id',$_REQUEST['id'])->delete('category');
            exit();
        }
        elseif($_REQUEST['cat_child'] == 1){
        $brands=$this->db->where('pcat',$_REQUEST['id'])->get('category')->result_array();
          if($brands){
              echo '<div class="row child_cat_row" style="display:block;">';
    		foreach($brands as $row1){
    		     echo '<span class="label label-info" style="margin: 5px;    font-size: 13px;">'.$row1['category_name'].'<span class="cat_del_btn" style="    font-size: 16px;margin: 10px;" onclick="del_cat('.$row1['category_id'].','.$_REQUEST['id'].','.$_REQUEST['col'].')">x</span></span>';
    		}
    		echo '</div>';
          }
        }
        if($_REQUEST['add_child'] == 1){
           $data = array(
               'category_name' => $_REQUEST['cat_name'],
               'pcat' => $_REQUEST['id']
               );
           $this->db->insert('category', $data);
           echo $id = $this->db->insert_id();
        }
        if($_REQUEST['search'] == 1){
        //   var_dump($_REQUEST);
        //   $brands=$this->db->where('pcat',$_REQUEST['id'])->get('category')->result_array();
        //   if($brands){
        //       	foreach($brands as $row1){
        //             echo $row1['category_name'];
        //         }
        //   }
          $cat = $this->db->like('category_name',$_REQUEST['cat_name'])->get('category')->result_array();
          echo '<ul>';
          foreach($cat as $k => $row){
              echo '<div class="col-sm-3>';
              echo '<li class="" onclick="select('.$row['category_id'].');">'.$row['category_name'].'<i class="fa-thin fa-xmark" onclick="del_cat('.$row1['category_id'].')"></i></li>';
              echo '</div>';
          }
          echo '</ul>';

        }
        if($_REQUEST['select'] == 1){
       $cat = $this->db->where('category_id',$_REQUEST['sid'])->get('category')->row_array();
        $data = array(
            'category_name' => $cat['category_name'],
            'pcat' => $_REQUEST['id'],
            );
        $this->db->insert('category',$data);


            // $data = array(
            //     'pcat' => $_REQUEST['id']
            //     );
            //     // var_dump($data);
            // $this->db->where('category_id',$_REQUEST['sid'])->update('category',$data);
            // // echo $this->db->last_query();
            echo "1";
        }
    }
    /*Digital Category add, edit, view, delete */
    function category_digital($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('category_digital')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','69','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['category_name'] = $this->input->post('category_name');
            $data['digital'] = 'ok';
            $this->db->insert('category', $data);
            $id = $this->db->insert_id();

            $path = $_FILES['img']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $data_banner['banner']       = 'category_'.$id.'.'.$ext;

            if(!demo()){
                $this->crud_model->file_up("img", "category", $id, '', 'no', '.'.$ext);
            }

            $this->db->where('category_id', $id);
            $this->db->update('category', $data_banner);
            $this->crud_model->set_category_data(0);

            recache();
        } else if ($para1 == 'edit') {
            $page_data['category_data'] = $this->db->get_where('category', array(
                'category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/category_edit_digital', $page_data);
        } elseif ($para1 == "update") {
            $data['category_name'] = $this->input->post('category_name');
            $this->db->where('category_id', $para2);
            $this->db->update('category', $data);
            if($_FILES['img']['name']!== ''){
                $path = $_FILES['img']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $data_banner['banner']       = 'category_'.$para2.'.'.$ext;
                $this->crud_model->file_up("img", "category", $para2, '', 'no', '.'.$ext);
                $this->db->where('category_id', $para2);
                $this->db->update('category', $data_banner);
            }
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                unlink("uploads/category_image/" .$this->crud_model->get_type_name_by_id('category',$para2,'banner'));
                $this->db->where('category_id', $para2);
                $this->db->delete('category');
                $this->crud_model->set_category_data(0);
                recache();
            }

        } elseif ($para1 == 'list') {
            $this->db->order_by('category_id', 'desc');
            $this->db->where('digital=','ok');
            $page_data['all_categories'] = $this->db->get('category')->result_array();
            $this->load->view('back/admin/category_list_digital', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/category_add_digital');
        } else {
            $page_data['page_name']      = "category_digital";
            $this->db->where('digital=','ok');
            $page_data['all_categories'] = $this->db->get('category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /*Product blog_category add, edit, view, delete */
    function blog_category($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('blog')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $this->db->insert('blog_category', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['blog_category_data'] = $this->db->get_where('blog_category', array(
                'blog_category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/blog_category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
            $this->db->where('blog_category_id', $para2);
            $this->db->update('blog_category', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('blog_category_id', $para2);
                $this->db->delete('blog_category');
                recache();
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('blog_category_id', 'desc');
            $page_data['all_categories'] = $this->db->get('blog_category')->result_array();
            $this->load->view('back/admin/blog_category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/blog_category_add');
        } else {
            $page_data['page_name']      = "blog_category";
            $page_data['all_categories'] = $this->db->get('blog_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }


    /*Product slides add, edit, view, delete */
    function slides($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('slides')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $type                       = 'slides';
            $data['button_color']       = $this->input->post('color_button');
            $data['text_color']         = $this->input->post('color_text');
            $data['button_text']        = $this->input->post('button_text');
            $data['button_link']        = $this->input->post('button_link');
            $data['uploaded_by']        = 'admin';
            $data['status']             = 'ok';
            $data['added_by']           = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));
            $this->db->insert('slides', $data);
            $id = $this->db->insert_id();
            $this->crud_model->file_up("img", "slides", $id, '', '', '.jpg');
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
            $this->load->view('back/admin/slides_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('slides_id', 'desc');
            $this->db->where('uploaded_by', 'admin');
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/admin/slides_list', $page_data);
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
        }
        elseif ($para1 == 'vendor') {
            if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
                redirect(base_url() . 'admin');
            }
            $page_data['page_name']  = "slides_vendor";
            $this->load->view('back/index', $page_data);
        }
        elseif ($para1 == 'vendor_slides') {
            if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
                redirect(base_url() . 'admin');
            }
            $this->db->order_by('slides_id', 'desc');
            $this->db->where('uploaded_by', 'vendor');
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/admin/slides_list_vendor', $page_data);
        }elseif ($para1 == 'add') {
            $this->load->view('back/admin/slides_add');
        } else {
            $page_data['page_name']  = "slides";
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /*Product Category add, edit, view, delete */
    function blog($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('blog')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['title']          = $this->input->post('title');
            $data['date']           = $this->input->post('date');
            $data['author']         = $this->input->post('author');
            $data['summery']        = $this->input->post('summery');
            $data['blog_category']  = $this->input->post('blog_category');
            $data['description']    = $this->input->post('description');
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
            $this->load->view('back/admin/blog_edit', $page_data);
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
            $page_data['all_blogs'] = $this->db->get('blog')->result_array();
            $this->load->view('back/admin/blog_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/blog_add');
        } else {
            $page_data['page_name']      = "blog";
            $page_data['all_blogs'] = $this->db->get('blog')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    public function cancel($id){
        // 2 for cancel
        $data= array(
            'status'=>2
            );

        $this->db->where('id', $id);
        $this->db->update('withdraw_request', $data);
        // var_dump($this->db->last_query());
       redirect( $_SERVER['HTTP_REFERER']);

    }
    public function approve($id){
        // 2 for cancel
        $data= array(
            'status'=>1
            );

        $this->db->where('id', $id);
        $this->db->update('withdraw_request', $data);
        // var_dump($this->db->last_query());
       redirect( $_SERVER['HTTP_REFERER']);

    }
    /*Product Sub-category add, edit, view, delete */
    function sub_category($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('sub_category')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $name = $this->input->post('sub_category_name');
            $exp = explode(',', $name);
            foreach ($exp as $key => $value) {
                $data['sub_category_name'] = $value;
            $data['category']          = $this->input->post('category');

            $this->db->insert('sub_category', $data);
            $id = $this->db->insert_id();
            }
            recache();
        } else if ($para1 == 'edit') {
            $page_data['sub_category_data'] = $this->db->get_where('sub_category', array(
                'sub_category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/sub_category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['sub_category_name'] = $this->input->post('sub_category_name');
            $data['category']          = $this->input->post('category');
            $data['affiliation']       = $this->input->post('affiliation') ? 1 :0 ;
            $data['affiliation_points']  = is_numeric($this->input->post('affiliation_points')) && $this->input->post('affiliation_points') >= 0
                ? $this->input->post('affiliation_points') : 0.00;
            if($this->input->post('brand')==NULL)
            {
                $data['brand']             = '[]';
            }
            else{
                $data['brand']             = json_encode($this->input->post('brand'));
            }
            $this->db->where('sub_category_id', $para2);
            $this->db->update('sub_category', $data);

            if($_FILES['img']['name']!== ''){
                $path = $_FILES['img']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $data_banner['banner']       = 'sub_category_'.$para2.'.'.$ext;
                $this->crud_model->file_up("img", "sub_category", $para2, '', 'no', '.'.$ext);
                $this->db->where('sub_category_id', $para2);
                $this->db->update('sub_category', $data_banner);
            }
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                unlink("uploads/sub_category_image/" .$this->crud_model->get_type_name_by_id('sub_category',$para2,'banner'));
                $this->db->where('sub_category_id', $para2);
                $this->db->delete('sub_category');
                $this->crud_model->set_category_data(0);
            }
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('sub_category_id', 'desc');
            $this->db->where('digital=',NULL);
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $this->load->view('back/admin/sub_category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/sub_category_add');
        } elseif ($para1 == 'add3') {
            $this->load->view('back/admin/sub3_category_add', array('scat'=> $para2));
        } else {
            $page_data['page_name']        = "sub_category";
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }/*Product #rd level categories */
    function sub3_category($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('sub_category')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $name = $this->input->post('category_name');
            $exp = explode(',', $name);
            foreach ($exp as $key => $value) {
                $data['sub_category_name'] = $value;
            $data['category']          = $this->input->post('category');

            $this->db->insert('sub3_category', $data);
            $id = $this->db->insert_id();
            }
            recache();
        } else if ($para1 == 'edit') {
            $page_data['sub_category_data'] = $this->db->get_where('sub3_category', array(
                'sub_category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/sub3_category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['sub_category_name'] = $this->input->post('category_name');
            $data['category']          = $this->input->post('category');

            $this->db->where('sub_category_id', $para2);
            $this->db->update('sub3_category', $data);


            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                unlink("uploads/sub_category_image/" .$this->crud_model->get_type_name_by_id('sub_category',$para2,'banner'));
                $this->db->where('sub_category_id', $para2);
                $this->db->delete('sub3_category');
                $this->crud_model->set_category_data(0);
            }
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('sub3_category_id', 'desc');
            $this->db->where('digital=',NULL);
            $page_data['all_sub_category'] = $this->db->get('sub3_category')->result_array();
            $this->load->view('back/admin/sub3_category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/sub3_category_add');
        } else {
            $page_data['page_name']        = "sub3_category";
            $page_data['type']        = "s3";
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /*Digital Sub-category add, edit, view, delete */
    function sub_category_digital($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('sub_category_digital')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','69','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['sub_category_name'] = $this->input->post('sub_category_name');
            $data['category']          = $this->input->post('category');
            $data['digital']           = 'ok';
            $data['affiliation']       = $this->input->post('affiliation') ? 1 :0 ;
            $data['affiliation_points']  = is_numeric($this->input->post('affiliation_points')) && $this->input->post('affiliation_points') >= 0
                ? $this->input->post('affiliation_points') : 0.00;
            $this->db->insert('sub_category', $data);
            $id = $this->db->insert_id();
            $path = $_FILES['img']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $data_banner['banner']       = 'sub_category_'.$id.'.'.$ext;
            if(!demo()){
                $this->crud_model->file_up("img", "sub_category", $id, '', 'no', '.'.$ext);
            }
            $this->db->where('sub_category_id', $id);
            $this->db->update('sub_category', $data_banner);
            $this->crud_model->set_category_data(0);

            recache();
        } else if ($para1 == 'edit') {
            $page_data['sub_category_data'] = $this->db->get_where('sub_category', array(
                'sub_category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/sub_category_edit_digital', $page_data);
        } elseif ($para1 == "update") {
            $data['sub_category_name'] = $this->input->post('sub_category_name');
            $data['category']          = $this->input->post('category');
            $data['affiliation']       = $this->input->post('affiliation') ? 1 :0 ;
            $data['affiliation_points']  = is_numeric($this->input->post('affiliation_points')) && $this->input->post('affiliation_points') >= 0
                ? $this->input->post('affiliation_points') : 0.00;
            $this->db->where('sub_category_id', $para2);
            $this->db->update('sub_category', $data);

            if($_FILES['img']['name']!== ''){
                $path = $_FILES['img']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $data_banner['banner']       = 'sub_category_'.$para2.'.'.$ext;
                $this->crud_model->file_up("img", "sub_category", $para2, '', 'no', '.'.$ext);
                $this->db->where('sub_category_id', $para2);
                $this->db->update('sub_category', $data_banner);
            }
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                unlink("uploads/sub_category_image/" .$this->crud_model->get_type_name_by_id('sub_category',$para2,'banner'));
                $this->db->where('sub_category_id', $para2);
                $this->db->delete('sub_category');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('sub_category_id', 'desc');
            $this->db->where('digital=','ok');
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $this->load->view('back/admin/sub_category_list_digital', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/sub_category_add_digital');
        } else {
            $page_data['page_name']        = "sub_category_digital";
            $this->db->where('digital=','ok');
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /*Product Brand add, edit, view, delete */
    function brand($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('brand')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $type                = 'brand';
            $data['name']        = $this->input->post('name');
            $data['fa_icon']        = $this->input->post('fa_icon');
            $this->db->insert('brand', $data);
            $id = $this->db->insert_id();

            $path = $_FILES['img']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $data_banner['logo']         = demo() ? '' : 'brand_'.$id.'.'.$ext;
            if(!demo()){
                $this->crud_model->file_up("img", "brand", $id, '', 'no', '.'.$ext);
            }
            $this->db->where('brand_id', $id);
            $this->db->update('brand', $data_banner);
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == "update") {
            $data['name']        = $this->input->post('name');
            $data['fa_icon']        = $this->input->post('fa_icon');
            $this->db->where('brand_id', $para2);
            $this->db->update('brand', $data);
            if($_FILES['img']['name']!== ''){
                $path = $_FILES['img']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $data_logo['logo']       = 'brand_'.$para2.'.'.$ext;
                $this->crud_model->file_up("img", "brand", $para2, '', 'no', '.'.$ext);
                $this->db->where('brand_id', $para2);
                $this->db->update('brand', $data_logo);
            }
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                unlink("uploads/brand_image/" .$this->crud_model->get_type_name_by_id('brand',$para2,'logo'));
                $this->db->where('brand_id', $para2);
                $this->db->delete('brand');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('brand', $ids);
            }
        } else if ($para1 == 'edit') {
            $page_data['brand_data'] = $this->db->get_where('brand', array(
                'brand_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/brand_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('brand_id', 'desc');
            $page_data['all_brands'] = $this->db->get('brand')->result_array();
            $this->load->view('back/admin/brand_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/brand_add');
        } else {
            $page_data['page_name']  = "brand";
            $page_data['all_brands'] = $this->db->get('brand')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    function makes($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('makes')) {
            redirect(base_url() . 'admin');
        }
        // if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
        //     redirect(base_url() . 'admin');
        // }
        if ($para1 == 'do_add') {
            $type                = 'makes';
            $data['name']        = $this->input->post('name');
            $this->db->insert('makes', $data);
            $id = $this->db->insert_id();
            // $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == "update") {
            $data['name']        = $this->input->post('name');
            $this->db->where('id', $para2);
            $this->db->update('makes', $data);

            // $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                 $this->db->delete('makes', array('id' => $para2));
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('makes', $ids);
            }
        }else if ($para1 == 'product_publish_set'){
            $make = $para2;
            if ($para3 == 'true') {
                $data['status'] = '1';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('id', $make);
            $this->db->update('makes', $data);
            $this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['amenity_data'] = $this->db->get_where('makes', array(
                'id' => $para2
            ))->result_array();
            $this->load->view('back/admin/makes_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('id', 'desc');
            $page_data['all_amenitys'] = $this->db->get('makes')->result_array();

            $this->load->view('back/admin/makes_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/makes_add');
        } else {
            $page_data['page_name']  = "makes";
            $page_data['all_amenitys'] = $this->db->get('makes')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }  function amenity($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('brand')) {
            redirect(base_url() . 'admin');
        }
        // if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
        //     redirect(base_url() . 'admin');
        // }
        if ($para1 == 'do_add') {
            $type                = 'amenity';
            $str = $this->input->post('name');
            $amn = explode(",",$str);
            $data = array();
            foreach($amn as $k => $v){
                $amny = $v ;
                $data['name'] = $amny;
                $data['catid'] = $this->input->post('cat');
                $this->db->insert('amenity', $data);
                //  var_dump($data);
            }


             $id = $this->db->insert_id();
            // var_dump($this->db->last_query());
            // $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == "update") {
            $data['name']        = $this->input->post('name');
            $data['catid']        = $this->input->post('cat');
            $this->db->where('amenity_id', $para2);
            $this->db->update('amenity', $data);

            // $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->delete('amenity', array('amenity_id' => $para2));
                // $this->crud_model->set_category_data(0);
                recache();
            }
        } else if ($para1 == 'product_publish_set'){
            $amn = $para2;
            if ($para3 == 'true') {
                $data['status'] = '1';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('amenity_id', $amn);
            $this->db->update('amenity', $data);
            $this->crud_model->set_category_data(0);
            recache();
        }elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('amenity', $ids);
            }
        } else if ($para1 == 'edit') {
            $page_data['amenity_data'] = $this->db->get_where('amenity', array(
                'amenity_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/amenity_edit', $page_data);
        } elseif ($para1 == 'list') {

            if(isset($_GET['level'])){
               if($_GET['level'] == '0'){
                   
                $this->db->select('amenity.*,category.*');
                $this->db->from('amenity');
                $this->db->join('category', 'amenity.catid = category.category_id');
                $this->db->order_by('amenity_id', 'desc');
                 $page_data['all_amenitys'] = $this->db->get()->result_array();
                $page_data['all_amenitys'] = $this->db->get('amenity')->result_array();
               }elseif($_GET['level'] == 'st_1'){
                   $this->db->select('amenity.*,category.*');
                $this->db->from('amenity');
                $this->db->join('category', 'amenity.catid = category.category_id');
                $this->db->where('amenity.status', '1');
                $this->db->order_by('amenity_id', 'desc');
                 $page_data['all_amenitys'] = $this->db->get()->result_array();
                 
               }elseif($_GET['level'] == 'st_2'){
                $this->db->select('amenity.*,category.*');
                $this->db->from('amenity');
                $this->db->join('category', 'amenity.catid = category.category_id');
                $this->db->where('amenity.status', '0');
                $this->db->order_by('amenity_id', 'desc');
                 $page_data['all_amenitys'] = $this->db->get()->result_array();
               }else{
               $this->db->select('amenity.*,category.*');
                $this->db->from('amenity');
                $this->db->join('category', 'amenity.catid = category.category_id');
                $this->db->where('amenity.catid', $_GET['level']);
                $this->db->order_by('amenity_id', 'desc');
                 $page_data['all_amenitys'] = $this->db->get()->result_array();
               }

            }else{
                $this->db->select('amenity.*,category.*');
                $this->db->from('amenity');
                $this->db->join('category', 'amenity.catid = category.category_id');
                $this->db->where('amenity.status', '1');
                $this->db->or_where('amenity.status', '0');
                $this->db->order_by('amenity_id', 'desc');
                 $page_data['all_amenitys'] = $this->db->get()->result_array();
            }
            // var_dump($this->db->last_query());
            $this->load->view('back/admin/amenity_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/amenity_add');
        } else {
            $page_data['page_name']  = "amenity";
            $page_data['all_amenitys'] = $this->db->get('amenity')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }function module_sys($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('list_fields')) {
            redirect(base_url() . 'admin');
        }

        if ($para1 == 'do_add') {
            if($_POST['dir_check']){
                $chk = $_POST['dir_check'];
                $bpage_check = $_POST['bpage_check'];
            }else{
                $chk = 0;
                $bpage_check = 0;
            }
            if($_POST['hide_business']){
                $hide_bus = $_POST['hide_business'];
            }else{
                $hide_bus = 0;
            }
                $tabs = array(
                    'label' => $_POST['name'],
                    'key' => $_POST['key'],
                    'sort' => $_POST['sort'],
                    );
                    $data = array(
                        'dir_check' => $chk,
                        'bpage_check' => $bpage_check,
                        'hide_bus' => $hide_bus,
                        'dir_icon' => $_POST['dir_icon'],
                        'dir_slug' => $_POST['dir_slug'],
                        'dir_text' => $_POST['dir_text'],
                        );
                $data['label'] = $this->input->post('label');
                $data['category'] = $this->input->post('category');
                $data['sub_category'] = $this->input->post('sub_category');
                $data['front_view'] = $this->input->post('front_view');
                $data['bpage_text'] = $this->input->post('bpage_text');
                $data['filter_file'] = $this->input->post('filter_file');
                $data['tabs'] = json_encode($tabs);
                $this->db->insert('modules',$data); 
                // $str = $this->db->last_query();
                // echo $str = $this->db->last_query();
                // die();

             $id = $this->db->insert_id();
            recache();
        } elseif ($para1 == "update") {
            if($_POST['dir_check']){
                $chk = $_POST['dir_check'];
                  $bpage_check = $_POST['bpage_check'];
            }else{
                $chk = 0;
                $bpage_check = 0;
            }
             if($_POST['hide_business']){
                $hide_bus = $_POST['hide_business'];
            }else{
                $hide_bus = 0;
            }
            // die('ok');
           $tabs = array(
                    'label' => $_POST['name'],
                    
                    
                    'key' => $_POST['key'],
                    'sort' => $_POST['sort'],
                    );
                    $data = array(
                        'dir_check' => $chk,
                        'bpage_check' => $bpage_check,
                         'hide_bus' => $hide_bus,
                        'dir_icon' => $_POST['dir_icon'],
                        'dir_slug' => $_POST['dir_slug'],
                        'dir_text' => $_POST['dir_text'],
                        );
                    $data['label'] = $this->input->post('label');
                $data['bpage_text'] = $this->input->post('bpage_text');
                $data['category'] = $this->input->post('category');
                $data['sub_category'] = $this->input->post('sub_category');
                $data['front_view'] = $this->input->post('front_view');
                $data['filter_file'] = $this->input->post('filter_file');
                $data['tabs'] = json_encode($tabs);
            $this->db->where('id', $para2);
            $this->db->update('modules', $data);
        // var_dump($this->db->last_query());
            // $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('id', $para2);
                $this->db->delete('modules');
                // $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('list_fields', $ids);
            }
        } else if ($para1 == 'edit') {
            $page_data['amenity_data'] = $this->db->get_where('modules', array(
                'id' => $para2
            ))->result_array();
            $this->load->view('back/admin/mod_edit', $page_data);
        } elseif ($para1 == 'list') {
                 if(true){
               $this->db->select('modules.*,category.*');
                $this->db->from('modules');
                $this->db->join('category', 'modules.category = category.category_id');
                // $this->db->order_by('sort', 'asc');
                 $page_data['all_amenitys'] = $this->db->get()->result_array();
                 $this->load->view('back/admin/mod_list', $page_data);
            }


        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/mod_add');
        } else {
            $page_data['page_name']  = "module_sys";
            $page_data['all_amenitys'] = $this->db->get('list_fields')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }function list_fields($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('list_fields')) {
            redirect(base_url() . 'admin');
        }

        if ($para1 == 'do_add') {
            if($_POST['filter_enable']){
                $filter = $_POST['filter_enable'];
            }else{
                $filter = 0;
            }
            
                $data['name'] = $this->input->post('name');
                $data['label'] = $this->input->post('label');
                $data['is_required'] = $this->input->post('is_required');
                $data['type'] = $this->input->post('type');
                $data['category'] = $this->input->post('category');
                $data['sort'] = $this->input->post('sort');
                $data['position'] = $this->input->post('position');
                $data['prefix'] = $this->input->post('prefix');
                $data['postfix'] = $this->input->post('postfix');
                $data['tbl_col'] = $col= $this->input->post('listing');
                $pcols = $this->db->list_fields('product');
                if($col && !in_array($col,$pcols))
                {
                    $sql = 'ALTER TABLE `product` ADD `'.$col.'` TEXT AFTER `discip_heading`;';
                    $this->db->query($sql);
                }
                $data['filter_sort'] = $this->input->post('sorts');
                $data['dvalue'] = $this->input->post('default_value');
                $data['placeholder'] = $this->input->post('placeholder');
                $data['view_type'] = $this->input->post('view_type');
                $data['capital_val'] = $this->input->post('capital_val');
                $data['is_filter'] = $filter;
                $data['options'] = json_encode(explode(',', $this->input->post('option')));
                $r = $this->db->insert('list_fields', $data);
                // $str = $this->db->last_query();
                // echo $str = $this->db->last_query();
                // die();

             $id = $this->db->insert_id();
            recache();
        } elseif ($para1 == "update") {
            // die('ok');
             if($_POST['filter_enable']){
                $filter = $_POST['filter_enable'];
            }else{
                $filter = 0;
            }
            
           $data['name'] = $this->input->post('name');
                $data['label'] = $this->input->post('label');
                $data['is_required'] = $this->input->post('is_required');
                $data['type'] = $this->input->post('type');
                $data['category'] = $this->input->post('category');
                $data['position'] = $this->input->post('position');
                $data['sort'] = $this->input->post('sort');
                $data['prefix'] = $this->input->post('prefix');
                $data['postfix'] = $this->input->post('postfix');
                $data['tbl_col'] = $col = $this->input->post('listing');
                $pcols = $this->db->list_fields('product');
                if(!in_array($col,$pcols))
                {
                    $sql = 'ALTER TABLE `product` ADD `'.$col.'` TEXT AFTER `discip_heading`;';
                    $this->db->query($sql);
                }
                $data['filter_sort'] = $this->input->post('sorts');
                $data['dvalue'] = $this->input->post('default_value');
                $data['placeholder'] = $this->input->post('placeholder');
                $data['view_type'] = $this->input->post('view_type');
                $data['capital_val'] = $this->input->post('capital_val');
                $data['is_filter'] = $filter;
                $data['options'] = json_encode(explode(',', $this->input->post('option')));
            $this->db->where('id', $para2);
            $this->db->update('list_fields', $data);
        // echo $this->db->last_query();
            // $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('id', $para2);
                $this->db->delete('list_fields');
                // $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('list_fields', $ids);
            }
        } else if ($para1 == 'edit') {
            $page_data['amenity_data'] = $this->db->get_where('list_fields', array(
                'id' => $para2
            ))->result_array();
            $this->load->view('back/admin/fields_edit', $page_data);
        } elseif ($para1 == 'list') {
                 if(true){
               $this->db->select('list_fields.*,category.*');
                $this->db->from('list_fields');
                $this->db->join('category', 'list_fields.category = category.category_id');
                // $this->db->where('list_fields.status', '1');
                if(isset($_GET['position']) && $_GET['position'])
                $this->db->where('list_fields.position', $_GET['position']);
                if(isset($_GET['filter']) && $_GET['filter'])
                {
                    $f = 1;
                    if($_GET['filter'] == 2)
                    {
                        $f = 0;
                    }
                $this->db->where('list_fields.is_filter', $f);
                }
                if(isset($_GET['sort']) && $_GET['sort'])
                $this->db->where('list_fields.sort', $_GET['sort']);
                if(isset($_GET['category']) && $_GET['category'])
                $this->db->where('list_fields.category', $_GET['category']);
                $this->db->order_by('sort', 'asc');
                 $page_data['all_amenitys'] = $this->db->get()->result_array();
                //  var_dump($page_data['all_amenitys']);
                 $this->load->view('back/admin/fields_list', $page_data);
            }


        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/fields_add');
        } else {
            $page_data['page_name']  = "fields";
            $page_data['all_amenitys'] = $this->db->get('list_fields')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
//raheel add busniuss package logic
        public static function slugify($text, string $divider = '-')
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
           function withdraw_request($para1 = '', $para2 = '')
            {
        if (!$this->crud_model->admin_permission('brand')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
		    $check = $this->input->post('check');
            $data = array(
                'name' => $this->input->post('name'),
                'parent' =>$this->input->post('parent'),
                'sorting' =>$this->input->post('position'),
                'slug' =>$this->input->post('slug'),
                'permission'=> implode(',',$check)
                );
            $this->db->insert('menu', $data);
            // var_dump($this->db->last_query());

            $id = $this->db->insert_id();

        } elseif ($para1 == "update") {
		    $check = $this->input->post('check');
           $data = array(
                'name' => $this->input->post('name'),
                'parent' =>$this->input->post('parent'),
                'sorting' =>$this->input->post('position'),
                'slug' =>$this->input->post('slug'),
                'permission'=> implode(',',$check)
                );
            $this->db->where('id', $para2);
            $this->db->update('menu', $data);
        } elseif ($para1 == 'delete') {

            if(!demo()){

                // if($this->crud_model->get_type_name_by_id('menu',$para2,'img'))
                // {
                //     unlink("uploads/bpkg_image/" .$this->crud_model->get_type_name_by_id('menu',$para2,'img'));
                // }
                $data = array(
                    'status' => '0'
                    );
                $this->db->where('id', $para2);
                $this->db->update('withdraw_request', $data);
                var_dump($this->db->last_query());
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('menu', $ids);
            }
        } else if ($para1 == 'edit') {
            $page_data['res'] =$this->db->get('menu')->result_array();
            $page_data['data'] = $this->db->get_where('menu', array(
                'id' => $para2
            ))->result_array();
            $this->load->view('back/admin/bpkg1_edit', $page_data);
        } elseif ($para1 == 'list') {
            // $this->db->order_by('id', 'desc');
            $page_data['all_brands'] = $this->db->get('withdraw_request')->result_array();
            $this->load->view('back/admin/withdraw_list', $page_data);
        } elseif ($para1 == 'compain_add') {
            $data['res'] =$this->db->get('menu')->result_array();
            $this->load->view('back/admin/compain_add', $data);
        } elseif ($para1 == 'compain') {
            die("compain");
            $data['res'] =$this->db->get('menu')->result_array();
            $this->load->view('back/admin/bpkg1_add', $data);
        } else {

            $page_data['page_name']  = "withdraw_request";
            $page_data['all_brands'] = $this->db->get('withdraw_request')->result_array();


            $this->load->view('back/index', $page_data);
        }
    }
           function affliate($para1 = '', $para2 = '')
            {
        if (!$this->crud_model->admin_permission('brand')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'preview') {

            $page_data['res'] = $sing = $this->db->where('compain_id',$para2)->get('compain')->row();
            $html = '';
            if($sing->compain_type == 'text_compain')
            {
                $html = '<a href="'.$sing->link.'" target="_blank">
                    '.$sing->content.'
                </a>';
            }
            else if($sing->compain_type == 'banner_compain')
            {
                $html = '<a href="'.$sing->link.'" target="_blank">
                    <img src="'.$this->crud_model->get_img($sing->banner_img)->secure_url.'" />
                </a>';
            }
            else if($sing->compain_type == 'video_compain')
            {
                $html = '<iframe width="560" height="315" src="'.$sing->video_link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><div style="display:table;clear:both;"></div><br><a style="-moz-box-shadow:inset 0 1px 0 0 #fff;-webkit-box-shadow:inset 0 1px 0 0 #fff;box-shadow:inset 0 1px 0 0 #fff;background:-webkit-gradient(linear,left top,left bottom,color-stop(.05,#f9f9f9),color-stop(1,#e9e9e9));background:-moz-linear-gradient(top,#f9f9f9 5%,#e9e9e9 100%);background:-webkit-linear-gradient(top,#f9f9f9 5%,#e9e9e9 100%);background:-o-linear-gradient(top,#f9f9f9 5%,#e9e9e9 100%);background:-ms-linear-gradient(top,#f9f9f9 5%,#e9e9e9 100%);background:linear-gradient(to bottom,#f9f9f9 5%,#e9e9e9 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#f9f9f9", endColorstr="#e9e9e9", GradientType=0);background-color:#f9f9f9;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;border:1px solid #dcdcdc;display:inline-block;cursor:pointer;color:#666;font-family:Arial;font-size:15px;font-weight:700;padding:6px 24px;text-decoration:none;text-shadow:0 1px 0 #fff" href="'.$sing->link.'">'. $sing->title.'</a>';
            }
    ?>
    <?php
    echo $html;

            die();
            $this->load->view('back/admin/compain_edit', $page_data);
        }else if ($para1 == 'compain_do_add') {
		  //  $check = $this->input->post('check');
            $data = array(
                'compain_type' => $this->input->post('compain_type'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'video_link' => $this->input->post('video_link'),
                'link' =>$this->input->post('link'),
                'percentage' =>$this->input->post('percentage')
                );
            $this->db->insert('compain', $data);

            // var_dump($this->db->last_query());

            $id = $this->db->insert_id();
            $this->load->library('cloudinarylib');
            if($_FILES["banner_img"]['tmp_name']){
                    if(!demo()){
                        $path = 'uploads/compain'.time().'.jpg';
                        move_uploaded_file($_FILES["banner_img"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
						if(isset($data['public_id']))
						{
							$logo_id = $this->crud_model->add_img($path,$data);
							if($logo_id)
							{
                             $this->db->where('compain_id', $id);
                            $this->db->update('compain', array(
                                'banner_img' => $logo_id
                            ));
						   }
						}
	//top_banner
                    }
                }
                recache();

        } elseif ($para1 == "update") {
            // die();
		    $check = $this->input->post('check');
           $data = array(
                'compain_type' => $this->input->post('compain_type'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'video_link' => $this->input->post('video_link'),
                'link' =>$this->input->post('link'),
                'percentage' =>$this->input->post('percentage')
                );
            $this->db->where('compain_id', $para2);
            $this->db->update('compain', $data);
        } elseif ($para1 == 'delete') {

            if(!demo()){

                // if($this->crud_model->get_type_name_by_id('menu',$para2,'img'))
                // {
                //     unlink("uploads/bpkg_image/" .$this->crud_model->get_type_name_by_id('menu',$para2,'img'));
                // }

                $this->db->where('id', $para2);
                $this->db->delete('menu');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('menu', $ids);
            }
        } else if ($para1 == 'edit') {
            $page_data['res'] =$this->db->get('compain')->result_array();
            $page_data['data'] = $this->db->get_where('compain', array(
                'compain_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/compain_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('compain_id', 'desc');
            $page_data['all_brands'] = $this->db->get('compain')->result_array();
            $this->load->view('back/admin/compain_list', $page_data);
        }
        elseif ($para1 == 'add') {
            $data['res'] =$this->db->get('compain')->result_array();
            $page_data['page_name'] = 'compain_add';
            $this->load->view('back/index', $page_data);
        }
        elseif ($para1 == 'compain_add') {
            $data['res'] =$this->db->get('menu')->result_array();
            $this->load->view('back/admin/compain_add', $data);
        } elseif ($para1 == 'compain') {
            die("compain");
            $data['res'] =$this->db->get('menu')->result_array();
            $this->load->view('back/admin/bpkg1_add', $data);
        } else {
            $page_data['page_name']  = "compain";
            $page_data['all_brands'] = $this->db->get('compain')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
           function bpkg1($para1 = '', $para2 = '')
            {
        if (!$this->crud_model->admin_permission('brand')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
		    $check = $this->input->post('check');
            $data = array(
                'name' => $this->input->post('name'),
                'parent' =>$this->input->post('parent'),
                'sorting' =>$this->input->post('position'),
                'slug' =>$this->input->post('slug'),
                'permission'=> implode(',',$check)
                );
            $this->db->insert('menu', $data);
            // var_dump($this->db->last_query());

            $id = $this->db->insert_id();

        } elseif ($para1 == "update") {
            // die('ok');
		    $check = $this->input->post('check');
           $data = array(
                'name' => $this->input->post('name'),
                'parent' =>$this->input->post('parent'),
                'sorting' =>$this->input->post('position'),
                'slug' =>$this->input->post('slug'),
                'permission'=> implode(',',$check)
                );
            $this->db->where('id', $para2);
            $this->db->update('menu', $data);
        } elseif ($para1 == 'delete') {

            if(!demo()){

                // if($this->crud_model->get_type_name_by_id('menu',$para2,'img'))
                // {
                //     unlink("uploads/bpkg_image/" .$this->crud_model->get_type_name_by_id('menu',$para2,'img'));
                // }

                $this->db->where('id', $para2);
                $this->db->delete('menu');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('menu', $ids);
            }
        } else if ($para1 == 'edit') {
            $page_data['res'] =$this->db->get('menu')->result_array();
            $page_data['data'] = $this->db->get_where('menu', array(
                'id' => $para2
            ))->result_array();
            $this->load->view('back/admin/bpkg1_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('id', 'desc');
            $page_data['all_brands'] = $this->db->get('menu')->result_array();
            $this->load->view('back/admin/bpkg1_list', $page_data);
        } elseif ($para1 == 'add') {
            $data['res'] =$this->db->get('menu')->result_array();
            $this->load->view('back/admin/bpkg1_add', $data);
        } else {

            $page_data['page_name']  = "bpkg1";
            $page_data['all_brands'] = $this->db->get('menu')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    function bpkg($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('brand')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {

            $type                = 'bpkg';
            $data['name']        = $this->input->post('name');
            $this->db->insert('bpkg', $data);
            $id = $this->db->insert_id();

            $path = $_FILES['file_upload']['tmp_name'];
            $this->load->library('cloudinarylib');
                if($_FILES["file_upload"]['tmp_name']){
                    if(!demo()){
                        $path = 'uploads/socialicon'.time().'.jpg';
                        move_uploaded_file($_FILES["file_upload"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
						if(isset($data['public_id']))
						{
							$logo_id = $this->crud_model->add_img($path,$data);
							if($logo_id)
							{
                             $this->db->where('id', $id);
                            $this->db->update('bpkg', array(
                                'img' => $logo_id
                            ));
						   }
						}
	//top_banner
                    }
                }
                recache();
        } elseif ($para1 == "update") {
            $data['name']        = $this->input->post('name');
            $this->db->where('id', $para2);
            $this->db->update('bpkg', $data);
            if($_FILES['img']['name']!== ''){
                $path = $_FILES['img']['name'];

                $ext = pathinfo($path, PATHINFO_EXTENSION);

                $data_logo['img']       = 'bpkg_'.$para2.'.'.$ext;
                $this->crud_model->file_up("img", "bpkg", $para2, '', 'no', '.'.$ext);
                $this->db->where('id', $para2);
                if($path)
                $this->db->update('bpkg', $data_logo);
            }
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {

            if(!demo()){

                if($this->crud_model->get_type_name_by_id('bpkg',$para2,'img'))
                {
                    unlink("uploads/bpkg_image/" .$this->crud_model->get_type_name_by_id('bpkg',$para2,'img'));
                }

                $this->db->where('id', $para2);
                $this->db->delete('bpkg');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('bpkg', $ids);
            }
        } else if ($para1 == 'edit') {

            $page_data['data'] = $this->db->get_where('bpkg', array(
                'id' => $para2
            ))->result_array();
            $this->load->view('back/admin/bpkg_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('id', 'desc');
            $page_data['all_brands'] = $this->db->get('bpkg')->result_array();
            $this->load->view('back/admin/bpkg_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/bpkg_add');
        } else {

            $page_data['page_name']  = "bpkg";
            $page_data['all_brands'] = $this->db->get('bpkg')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    function subject($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('brand')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {

            // $type                = 'subject';
            $data['subject']        = $this->input->post('name');
            $data['email']        = $this->input->post('email');
            $data['created_at']        = date('Y:m:d H:i:s');
            $this->db->insert('subject', $data);

            $id = $this->db->insert_id();
                recache();
        } elseif ($para1 == "update") {
             $data['subject']        = $this->input->post('name');
              $data['email']        = $this->input->post('email');
            $data['updated_at']        = date('Y:m:d H:i:s');
            $this->db->where('id', $para2);
            $this->db->update('subject', $data);

            recache();
        } elseif ($para1 == 'delete') {

            if(!demo()){

                $this->db->where('id', $para2);
                $this->db->delete('subject');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('subject', $ids);
            }
        } else if ($para1 == 'edit') {

            $page_data['data'] = $this->db->get_where('subject', array(
                'id' => $para2
            ))->result_array();
            $this->load->view('back/admin/subject_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('id', 'desc');
            $page_data['all_brands'] = $this->db->get('subject')->result_array();
            $this->load->view('back/admin/subject_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/subject_add');
        } else {
            $page_data['page_name']  = "subject";
            $page_data['all_brands'] = $this->db->get('subject')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    function defaultBusiness($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('defaultBusiness')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {

            $type                = 'default_business';
            $data['value']        = $this->input->post('value');
            $this->db->insert('default_business', $data);
            $id = $this->db->insert_id();

            $path = $_FILES['file_upload']['tmp_name'];
            $this->load->library('cloudinarylib');
                if($_FILES["file_upload"]['tmp_name']){
                    if(!demo()){
                        $path = 'uploads/socialicon'.time().'.jpg';
                        move_uploaded_file($_FILES["file_upload"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
						if(isset($data['public_id']))
						{
							$logo_id = $this->crud_model->add_img($path,$data);
							if($logo_id)
							{
                             $this->db->where('id', $id);
                            $this->db->update('default_business', array(
                                'img' => $logo_id
                            ));
						   }
						}
	//top_banner
                    }
                }
                recache();
        } elseif ($para1 == "update") {

            $data['name']        = $this->input->post('name');
            $data['value']        = $this->input->post('value');
            $this->db->where('id', $para2);
            $this->db->update('default_business', $data);
            // echo $this->db->last_query();
            $this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {

            if(!demo()){

                if($this->crud_model->get_type_name_by_id('bpkg',$para2,'img'))
                {
                    unlink("uploads/bpkg_image/" .$this->crud_model->get_type_name_by_id('bpkg',$para2,'img'));
                }

                $this->db->where('id', $para2);
                $this->db->delete('default_business');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'multi_delete') {
            if(!demo()){
                $ids = explode('-', $param2);
                $this->crud_model->multi_delete('default_business', $ids);
            }
        } else if ($para1 == 'edit') {

            $page_data['data'] = $this->db->get_where('default_business', array(
                'id' => $para2
            ))->result_array();
            $this->load->view('back/admin/default_business_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('id', 'asc');
            $page_data['all_brands'] = $this->db->get('default_business')->result_array();
            $this->load->view('back/admin/default_business_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/default_business_add');
        } else {

            $page_data['page_name']  = "default_business_all";
            $page_data['all_brands'] = $this->db->order_by('id','asc')->get('default_business')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /*Product coupon add, edit, view, delete */
    function coupon($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('coupon')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['title'] = $this->input->post('title');
            $data['code'] = $this->input->post('code');
            $data['till'] = $this->input->post('till');
            $data['status'] = 'ok';
            $data['added_by'] = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));
            $data['spec'] = json_encode(array(
                                'set_type'=>$this->input->post('set_type'),
                                'set'=>json_encode($this->input->post($this->input->post('set_type'))),
                                'discount_type'=>$this->input->post('discount_type'),
                                'discount_value'=>$this->input->post('discount_value'),
                                'shipping_free'=>$this->input->post('shipping_free')
                            ));
            $this->db->insert('coupon', $data);
        } else if ($para1 == 'edit') {
            $page_data['coupon_data'] = $this->db->get_where('coupon', array(
                'coupon_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/coupon_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['title'] = $this->input->post('title');
            $data['code'] = $this->input->post('code');
            $data['till'] = $this->input->post('till');
            $data['spec'] = json_encode(array(
                                'set_type'=>$this->input->post('set_type'),
                                'set'=>json_encode($this->input->post($this->input->post('set_type'))),
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
            $this->load->view('back/admin/coupon_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/coupon_add');
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

    /*Product Sale Comparison Reports*/
    function report($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('report')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "report";
        $page_data['products']  = $this->db->get('product')->result_array();
        $this->load->view('back/index', $page_data);
    }

    /*Product Stock Comparison Reports*/
    function report_stock($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('report')) {
            redirect(base_url() . 'admin');
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
        if (!$this->crud_model->admin_permission('report')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "report_wish";
        $this->load->view('back/index', $page_data);
    }

    /* Product add, edit, view, delete, stock increase, decrease, discount */
    function product($para1 = '', $para2 = '', $para3 = '')
    {
        // if (!$this->crud_model->admin_permission('product')) {
        //     redirect(base_url() . 'admin');
        // }
        // if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
        //     redirect(base_url() . 'admin');
        // }


        if ($para1 == 'api_add') {
            $data = $_POST;
            $all_cats = $this->db->get('category')->result_array();
            $cats = array();
            foreach($all_cats as $k=> $v)
            {
                $catt_id = $v['category_id'];
                if(get_cat_level($v['category_id']) == 1)
                {
                    $cats[] = $catt_id;
                }
            }
            $al = $this->db->where('airbnb',$data['airbnb'])->get('product')->row();
            if($al)
            {
                echo $al->product_id;
                exit();
            }
            $data['status'] = 'ok';
            $data['category'] = $cats[array_rand($cats)];
            if(isset($data['img']) && $data['img'])
            {
            $this->load->library('cloudinarylib');
                        $path = $data['img'];
                        $data1 = \Cloudinary\Uploader::upload($path);
                        if(isset($data1['public_id']))
                                            {
                                                $logo_id = $this->crud_model->add_img($path,$data1);
                                                if($logo_id)
                                                {
                                                    unset($data['img']);
                                                $data['comp_logo'] = $logo_id;

                                               }
                                            }
            }
            $data['added_by']           = json_encode(array('type'=>'admin','id'=>1));
            $this->db->insert('product', $data);
            $id = $this->db->insert_id();
            echo $id;
            exit();

        }
        elseif ($para1 == 'do_add') {
            $options = array();
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            if($this->input->post('sku'))
            {
                $al = $this->db->where('sku',$this->input->post('sku'))->get('product')->result_array();
                if($al)
                {
                    $this->session->set_flashdata('error',translate('SKu Already exist'));
                    die();
                }
            }
            $data['seo_title']          = $this->input->post('seo_title');
            $data['seo_description']    = $this->input->post('seo_description');
            $data['title']              = $this->input->post('title');
            $data['sku']                = $this->input->post('sku');
            $data['category']           = $this->input->post('category');
            $data['brand']              = $this->input->post('brand');
            $data['description']        = $this->input->post('description');
            $data['weight']             = $this->input->post('weight');
            $data['height']             = $this->input->post('height');
            $data['width']              = $this->input->post('width');
            $data['sub_category']       = $this->input->post('sub_category');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['purchase_price']     = $this->input->post('purchase_price');
            $data['add_timestamp']      = time();
            $data['download']           = NULL;
            $data['featured']           = 'no';
            $data['status']             = 'ok';
            $data['rating_user']        = '[]';
            $data['tax']                = $this->input->post('tax');
            $data['discount']           = $this->input->post('discount');
            $data['discount_type']      = $this->input->post('discount_type');
            $data['tax_type']           = $this->input->post('tax_type');
            $data['shipping_cost']      = $this->input->post('shipping_cost');
            $data['tag']                = $this->input->post('tag');
            $data['is_bundle']          = 'no';
            $data['color']              = json_encode($this->input->post('color'));
            $data['num_of_imgs']        = $num_of_imgs;
            $data['current_stock']      = $this->input->post('current_stock');
            $data['front_image']        = 0;
            $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
            $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
            $additional_fields['checkbox_xtra_fields'] = json_encode($this->input->post('checkboxinfo'));
            $data['additional_fields']  = json_encode($additional_fields);
            $data['brand']              = $this->input->post('brand');
            $data['size_type']               = $this->input->post('size_type');
            $data['unit']               = $this->input->post('unit');
            $choice_titles              = $this->input->post('op_title');
            $choice_types               = $this->input->post('op_type');
            $choice_no                  = $this->input->post('op_no');
            $data['added_by']           = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));
            if(count($choice_titles ) > 0){
                foreach ($choice_titles as $i => $row) {
                    $choice_options         = $this->input->post('op_set'.$choice_no[$i]);
                    $options[]              =   array(
                                                    'no' => $choice_no[$i],
                                                    'title' => $choice_titles[$i],
                                                    'name' => 'choice_'.$choice_no[$i],
                                                    'type' => $choice_types[$i],
                                                    'option' => $choice_options
                                                );
                }
            }
            $data['options']            = json_encode($options);
            $this->db->insert('product', $data);
            $id = $this->db->insert_id();
            if(!$id)
        {
            $this->session->set_flashdata('error',translate('Server error'));

        }
            $this->benchmark->mark_time();
            if(!demo()){
                $this->crud_model->file_up("images", "product", $id, 'multi');
            }
            die($id);
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
            $data['sku']                = $this->input->post('sku');
            $data['category']           = $this->input->post('category');
            $data['brand']              = $this->input->post('brand');
            $data['description']        = $this->input->post('description');
            $data['weight']             = $this->input->post('weight');
            $data['height']             = $this->input->post('height');
            $data['width']              = $this->input->post('width');
            $data['sub_category']       = $this->input->post('sub_category');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['purchase_price']     = $this->input->post('purchase_price');
            $data['tax']                = $this->input->post('tax');
            $data['discount']           = $this->input->post('discount');
            $data['discount_type']      = $this->input->post('discount_type');
            $data['tax_type']           = $this->input->post('tax_type');
            $data['shipping_cost']      = $this->input->post('shipping_cost');
            $data['tag']                = $this->input->post('tag');
            $data['color']              = json_encode($this->input->post('color'));
            $data['num_of_imgs']        = $num + $num_of_imgs;
            $data['front_image']        = 0;
            $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
            $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
            $data['additional_fields']  = json_encode($additional_fields);
            $data['brand']              = $this->input->post('brand');
            $data['unit']               = $this->input->post('unit');
            $choice_titles              = $this->input->post('op_title');
            $choice_types               = $this->input->post('op_type');
            $choice_no                  = $this->input->post('op_no');
            if(count($choice_titles ) > 0){
                foreach ($choice_titles as $i => $row) {
                    $choice_options         = $this->input->post('op_set'.$choice_no[$i]);
                    $options[]              =   array(
                                                    'no' => $choice_no[$i],
                                                    'title' => $choice_titles[$i],
                                                    'name' => 'choice_'.$choice_no[$i],
                                                    'type' => $choice_types[$i],
                                                    'option' => $choice_options
                                                );
                }
            }
            $data['options']            = json_encode($options);
            if(!demo()){
                $this->crud_model->file_up("images", "product", $para2, 'multi');
            }

            $this->db->where('product_id', $para2);
            $this->db->update('product', $data);
            // $this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == 'edit') {
             $sing = $this->db->where('product_id' , $para2)->get('product')->row();
            //  var_dump($sing);
            //  die();
            $attrs = $this->db->where('product_id' , $para2)->get('attribute_to_values')->result_array();
            $page_data['product_data'] = $this->db->get_where('product', array('product_id' => $para2))->row();
            // var_dump($page_data['product_data']);
            // die();
            $page_data['row'] =(array) $sing;
            $page_data['brands'] =  $this->db->get('category')->result_array();
            $page_data['page_name']   = ($sing->is_bpage)?"bpage_edit":"product_edit";
            $this->load->view('back/index', $page_data);
        } else if ($para1 == 'view') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/product_view', $page_data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->crud_model->file_dlt('product', $para2, '.jpg', 'multi');
                $this->db->where('product_id', $para2);
                $this->db->delete('product');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'list') {
            // echo "here";
            $this->db->order_by('product_id', 'desc');
            // $this->db->where('download=',NULL);
            $page_data['all_product'] = $this->db->get('product')->result_array();
            // var_dump($page_data);
            $this->load->view('back/admin/product_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('title', $search, 'both');
            }
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
            $products   = $this->db->get('product', $limit, $offset)->result_array();
            $data       = array();
            foreach ($products as $row) {
                $category = $row['category'];
                $cat = $this->db->where('category_id',$category)->get('category')->row();
                   $img = $this->crud_model->get_img($row['comp_logo']);
                   if(isset($img->secure_url))
                            {
                                $img = $img->secure_url;
                            }
                $res    = array(
                             'item'         => '',
                             'getMainPrice' => '',
                             'added_by'     => '',
                             'current_stock'=> '',
                             'deal'         => '',
                             'publish'      => '',
                             'featured'     => '',
                             'options'      => ''
                          );
                          //get min
                          $child = array();
                          $min = '';
                          $max = '';
                          if($child)
                          {
                          $all_rates = $this->db->where('rate >',0)->where_in('product', $child)->get('stock')->result_array();
                          $gmin = 0;
                          $gmax = 0;
                          foreach($all_rates as $k=> $v)
                          {
                              if($k == 0)
                              {
                                  $gmin = $v['rate'];
                                  $gmax = $v['rate'];
                              }
                              if($gmin > $v['rate'])
                              {
                                  $gmin = $v['rate'];
                              }
                              if($gmax < $v['rate'])
                              {
                                  $gmax = $v['rate'];
                              }
                          }
                          $min = $gmin;
                          $max = $gmax;
                          }
                          $cat_name = (isset($cat->category_name))?$cat->category_name:"";
                          $bpage = '';
                          if($row['is_bpage'])
                          {
                              $bpage = '<div><i class="fa fa-crown" style="color:#FFD700"></i></div>';
                          }


                $res['item']  = '<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;float: left;" src="'.$img.'"  /><div class="next_div" ><small>'.$cat_name.'</small><p><b>'.$row['title'].'</b>'.$bpage.'</p></div>';
                $res['min_price']  = $min;
                $res['max_price']  = $max;
                $res['added_by']  = $this->crud_model->product_by($row['product_id']);

                if($row['status'] == 'ok'){
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['current_stock'] > 0){
                    $res['current_stock']  = $row['current_stock'].$row['unit'].'(s)';
                } else {
                    $res['current_stock']  = '<span class="label label-danger">'.translate('out_of_stock').'</span>';
                }
                if($row['deal'] == 'ok'){
                    $res['deal']  = '<input id="deal_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['deal']  = '<input id="deal_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['featured'] == 'ok'){
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" />';
                }

                //add html for action
                // $edit = base_url('admin/product/edit/'.$row['product_id']);
                $res['options'] = "
                  <a href='".base_url('admin/affliate/add').'?pid='.$row['product_id']."'\"
                                class=\"btn btn-success btn-xs btn-labeled fa fa-eye\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\"> 
                                    ".translate('affliate')." 
                            </a>
                            <a href='".base_url('home/product_view/').$row['product_id']."'\"
                                class=\"btn btn-info btn-xs btn-labeled fa fa-eye\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\"> 
                                    ".translate('view')."
                            </a>
                            <a class=\"btn btn-success btn-xs btn-labeled fa fa-wrench\" data-toggle=\"tooltip\"
                            href='".base_url('admin/product/edit/').$row['product_id']."'\"  data-original-title=\"Edit\" data-container=\"body\">
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
        }elseif ($para1 == 'sub_by_cat') {
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
            if(empty($brands)){
                echo translate("No brands are available for this sub category");
            } else {
                echo $this->crud_model->select_html('brand', 'brand', 'name', 'add', 'demo-chosen-select', '', 'brand_id', $brands, '', 'multi');
            }
        } elseif ($para1 == 'product_by_sub') {
            echo $this->crud_model->select_html('product', 'product', 'title', 'add', 'demo-chosen-select required', '', 'sub_category', $para2, 'get_pro_res');
        } elseif ($para1 == 'pur_by_pro') {
            echo $this->crud_model->get_type_name_by_id('product', $para2, 'purchase_price');
        } elseif ($para1 == 'add') {
            $data['all_sizes'] = $this->db->get('standerd_sizes')->result_array();
            $this->load->view('back/admin/product_add',$data);
        } elseif ($para1 == 'add_stock') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_stock_add', $data);
        } elseif ($para1 == 'destroy_stock') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_stock_destroy', $data);
        } elseif ($para1 == 'stock_report') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_stock_report', $data);
        } elseif ($para1 == 'sale_report') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_sale_report', $data);
        } elseif ($para1 == 'add_discount') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_add_discount', $data);
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
        } else {
            $page_data['page_name']   = "product";
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    public function product_bulk_upload()
    {
        if (!$this->crud_model->admin_permission('product_bulk_upload')) {
            redirect(base_url() . 'admin');
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
            redirect('admin/product_bulk_upload');
        }

        if(!file_exists($_FILES['bulk_file']['tmp_name']) || !is_uploaded_file($_FILES['bulk_file']['tmp_name'])){
            $this->session->set_flashdata('error',translate('File is not selected'));
            redirect('admin/product_bulk_upload');
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
                redirect('admin/product_bulk_upload');
            }

            foreach ($sheetData[1] as $colk => $colv){
                $col_map[$colk] = $colv;
            }


            if(!isset($sheetData[2])){
                $this->session->set_flashdata('error',translate('Data missing'));
                redirect('admin/product_bulk_upload');
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
        redirect('admin/product_bulk_upload');

    }

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

    public function product_bulk_upload_save_single($product)
    {
        $already = $this->db->where('sku',$product['SKU'])->get('product')->row();
        if($already)
        {
            return 0;
        }
        $image_urls = array();
        $product_stock_data = array();
        $product_data['num_of_imgs'] = 0;
        if (!empty($product['Image URL'])) {

            $image_urls = array();
            $image_urls[] = $product['Image URL'];
        }

        $product_data['gender'] = $product['Gender'];
        $product_data['title'] = $product['Name'];
        $product_data['sku'] = $product['SKU'];
        $product_data['description'] = $product['Description'];
        $product_data['sale_price'] = $product['Retail price'];
        $product_data['brand'] = $this->crud_model->get_csv_brand($product['Brand']);
        /*$product_data['category'] = is_numeric($product['category']) ? $product['category'] : 0;
         $product_data['sub_category'] = is_numeric($product['sub_category']) ? $product['sub_category'] : 0;


        $product_data['purchase_price'] = is_numeric($product['purchase_price']) ? $product['purchase_price'] : 0;
        $product_data['sale_price'] = is_numeric($product['sale_price']) ? $product['sale_price']: 0;

        $product_data['add_timestamp'] = time();
        $product_data['download'] = NULL;
        $product_data['featured'] = 'no';
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
        $product_data['unit'] = is_numeric($product['unit']) ? $product['unit'] : "";*/
        $product_data['added_by'] = json_encode(array('type' => 'admin', 'id' => $this->session->userdata('admin_id')));
        $product_data['options'] = json_encode($options = array());
        $product_data['raw'] = json_encode($product);
        $product_data['num_of_imgs'] = count($image_urls);

        $this->db->insert('product', $product_data);
        $product_id = $this->db->insert_id();
        $this->crud_model->set_category_data(0);
        recache();

        if(!empty($image_urls) && !empty($product_id)){
            if(!demo()){

                $this->crud_model->file_up_from_urls($image_urls,"product", $product_id);
            }
        }
        if(!empty($product_id))
        {
        $this->csv_size($product_id);
        }
    }
       public function category_bulk_upload()
    {
        // var_dump($_FILES);
        if(demo()){
            $this->session->set_flashdata('error',translate('This operation is invalid for demo'));
            redirect('admin/product_bulk_upload');
        }

        if(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])){
            $this->session->set_flashdata('error',translate('File is not selected'));
            redirect('admin/product_bulk_upload');
        }


        $inputFileName = $_FILES['file']['tmp_name'];
        $inputFileType = $this->spreadsheet->identify($inputFileName);

        $reader = $this->spreadsheet->createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $products = array();
        if(!empty($sheetData)){

            if(!isset($sheetData[1])){
                $this->session->set_flashdata('error',translate('Column names are missing'));
                redirect('admin/product_bulk_upload');
            }

            foreach ($sheetData[1] as $colk => $colv){
                $col_map[$colk] = $colv;
            }


            if(!isset($sheetData[2])){
                $this->session->set_flashdata('error',translate('Data missing'));
                redirect('admin/product_bulk_upload');
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
             $this->db->truncate('category_upload');
            foreach ($products as $product){
             $this->category_upload_save_single($product);
            }
        }


        $this->session->set_flashdata('successes',translate('Products uploaded'));
        redirect('admin/product_bulk_upload');

    }
    public function category_upload_save_single($product)
    {
    //   $id = '';
        // var_dump($product);

        $product_data['name'] = $product['Name'];
        $product_data['parent'] = $product['Parent'];
        $product_data['icon'] = $product['Fontawsome Icon'];
        $product_data['business_type'] = $product['Business Type'];
        $product_data['signup_main_category'] = $product['Signup Main Category'];
        $product_data['main_category'] = $product['Main Category'];
        $product_data['pegs'] = $product['Pegs'];
        $product_data['shop_category'] = $product[' Shop Category'];
        $this->db->insert('category_upload', $product_data);
        $product_id = $this->db->insert_id();
        $this->crud_model->set_category_data(0);
        recache();
        // echo $product_id;
        if(!empty($product_id))
        {
        $this->cat_upload($product_id);
        }
    }

    function cat_upload($product_id)
    {
        $id = '';
        $cat = $this->db->where('id', $product_id)->get('category_upload')->row_array();
        $category = $this->db->select('category_id')->where('category_name',$cat['parent'])->get('category')->row_array();
        $catname = $this->db->select('category_id')->where('category_name',$cat['name'])->get('category')->row_array();
        // var_dump($this->db->last_query());
        if($catname){
             $data = array(
                    'status' => '1',
                    'msg' => 'Duplicate Data'
                    );
                echo $data['msg'];
        }else{
        if(!empty($category) && empty($catname)){
            $data= array(
                'category_name' => $cat['name'],
                'pcat' => $category['category_id'],
                'fa_icon' => $cat['icon']
                );
                $this->db->insert('category', $data);
        }else{
             $data= array(
                'category_name' => $cat['parent'],
                'pcat' => '0',
                'fa_icon' => $cat['icon']
                );
                $this->db->insert('category', $data);

        }
                    $id = $this->db->insert_id();
                if($cat['business_type'] == 1){
                    // 71
                     $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 71))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            if(in_array($id, $result))
                                            {
                                                $key = array_search($id, $result);
                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $id;

                                            }
                                            $json = json_encode($result);
                                            $this->db->where('ui_settings_id', 71)->update('ui_settings',array('value'=>$json));
                }
                if($cat['signup_main_category'] == 1){
                          $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 72))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            if(in_array($id, $result))
                                            {
                                                $key = array_search($id, $result);
                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $id;

                                            }
                                            $json = json_encode($result);
                                            $this->db->where('ui_settings_id', 72)->update('ui_settings',array('value'=>$json));
                }
                if($cat['main_category'] == 1){
                      $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            if(in_array($id, $result))
                                            {
                                                $key = array_search($id, $result);
                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $id;

                                            }
                                            $json = json_encode($result);
                                            $this->db->where('ui_settings_id', 35)->update('ui_settings',array('value'=>$json));
                }
                if($cat['pegs'] == 1){
                      $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 86))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            if(in_array($id, $result))
                                            {
                                                $key = array_search($id, $result);
                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $id;

                                            }
                                            $json = json_encode($result);
                                            $this->db->where('ui_settings_id', 86)->update('ui_settings',array('value'=>$json));
                                            // var_dump($this->db->last_query());
                }
                if($cat['shop_category'] == 1){
                         $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 87))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            if(in_array($id, $result))
                                            {
                                                $key = array_search($id, $result);
                                                unset($result[$key]);


                                            }
                                            else
                                            {
                                                $result[] = $id;

                                            }
                                            $json = json_encode($result);
                                            $this->db->where('ui_settings_id', 87)->update('ui_settings',array('value'=>$json));
                }
                                $data = array(
                                    'status' => '1',
                                    'msg' => 'success'
                                    );
                                echo $data['msg'];

        }


    }
    function customer_products($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('product')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'view') {
            $page_data['product_data'] = $this->db->get_where('customer_product', array(
                'customer_product_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/customer_product_view', $page_data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->crud_model->file_dlt('customer_product', $para2, '.jpg', 'multi');
                $this->db->where('customer_product_id', $para2);
                $this->db->delete('customer_product');
                $this->crud_model->set_category_data(0);
                recache();
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('customer_product_id', 'desc');
            $page_data['all_product'] = $this->db->get('customer_product')->result_array();
            $this->load->view('back/admin/customer_product_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('title', $search, 'both');
            }
            $total      = $this->db->get('customer_product')->num_rows();
            $this->db->limit($limit);
            if($sort == ''){
                $sort = 'customer_product_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort,$order);
            if($search){
                $this->db->like('title', $search, 'both');
            }
            $products   = $this->db->get('customer_product', $limit, $offset)->result_array();
            $data       = array();
            foreach ($products as $row) {

                $res    = array(
                             'image'        => '',
                             'title'        => '',
                             'uploaded_by'  => '',
                             'customer_status'       => '',
                             'publish'      => '',
                             'options'      => ''
                          );

                $res['image']  = '<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="'.$this->crud_model->file_view('customer_product',$row['customer_product_id'],'','','thumb','src','multi','one').'"  />';
                $res['title']  = '<a target="_blank" href="'.$this->crud_model->customer_product_link($row['customer_product_id']).'">
                '.$row['title'].'
            </a>';
                $res['uploaded_by']  = $this->db->get_where('user',array('user_id'=>$row['added_by']))->row()->username.' '.$this->db->get_where('user',array('user_id'=>$row['added_by']))->row()->surname;

                if($row['admin_status'] == 'ok'){
                    $res['publish']  = '<input id="pub_'.$row['customer_product_id'].'" class="sw1" type="checkbox" data-id="'.$row['customer_product_id'].'" checked />';
                } else {
                    $res['publish']  = '<input id="pub_'.$row['customer_product_id'].'" class="sw1" type="checkbox" data-id="'.$row['customer_product_id'].'" />';
                }

                if($row['status'] == 'ok'){
                    $res['customer_status']  = ' <label class="label label-success publish_btn">'.translate('Published').'</label>';
                } else {
                    $res['customer_status']  = ' <label class="label label-danger publish_btn">'.translate('Unpublished').'</label>';
                }
                //add html for action
                $res['options'] = "  <a class=\"btn btn-info btn-xs btn-labeled fa fa-location-arrow\" data-toggle=\"tooltip\"
                                onclick=\"ajax_set_full('view','".translate('view_product')."','".translate('successfully_viewed!')."','product_view','".$row['customer_product_id']."');proceed('to_list');\" data-original-title=\"View\" data-container=\"body\">
                                    ".translate('view')."
                            </a>

                            <a onclick=\"delete_confirm('".$row['customer_product_id']."','".translate('really_want_to_delete_this?')."')\"
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
                $this->crud_model->file_dlt('customer_product', $a[0], '.jpg', 'multi', $a[1]);
                recache();
            }
        } elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category', 'sub_category', 'sub_category_name', 'add', 'demo-chosen-select required', '', 'category', $para2, 'get_brnd');
        } elseif ($para1 == 'brand_by_sub') {
            $brands=json_decode($this->crud_model->get_type_name_by_id('sub_category',$para2,'brand'),true);
            if(empty($brands)){
                echo translate("No brands are available for this sub category");
            } else {
                echo $this->crud_model->select_html('brand', 'brand', 'name', 'add', 'demo-chosen-select required', '', 'brand_id', $brands, '', 'multi');
            }
        } elseif ($para1 == 'product_by_sub') {
            echo $this->crud_model->select_html('product', 'product', 'title', 'add', 'demo-chosen-select required', '', 'sub_category', $para2, 'get_pro_res');
        } elseif ($para1 == 'pur_by_pro') {
            echo $this->crud_model->get_type_name_by_id('product', $para2, 'purchase_price');
        } elseif ($para1 == 'sale_report') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_sale_report', $data);
        } elseif ($para1 == 'product_publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['admin_status'] = 'ok';
            } else {
                $data['admin_status'] = 'no';
            }
            $this->db->where('customer_product_id', $product);
            $this->db->update('customer_product', $data);
            $this->crud_model->set_category_data(0);
            recache();
        } else {
            $page_data['page_name']   = "customer_products";
            $page_data['all_product'] = $this->db->get('customer_product')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

        /* membership_payment Management */
    function package_payment($para1 = '', $para2 = '', $para3 = '')
    {
       if (!$this->crud_model->admin_permission('product')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'view') {
            $page_data['package_data'] = $this->db->get_where('package_payment', array(
                'package_payment_id' => $para2
            ))->row();
            $this->load->view('back/admin/package_payment_view', $page_data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('package_payment_id', $para2);
                $this->db->delete('package_payment');
                $this->crud_model->set_category_data(0);
                recache();
            }
        }elseif ($para1 == 'list') {
            $this->db->order_by('package_payment_id', 'desc');
            $page_data['all_product'] = $this->db->get('package_payment')->result_array();
            $this->load->view('back/admin/package_payment_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('title', $search, 'both');
            }
            $total      = $this->db->get('package_payment')->num_rows();
            $this->db->limit($limit);
            if($sort == ''){
                $sort = 'package_payment_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort,$order);
            if($search){
                $this->db->like('payment_type', $search, 'both');
            }
            $i=1;
            $products   = $this->db->get('package_payment', $limit, $offset)->result_array();
            $data       = array();
            foreach ($products as $row) {

                $res    = array(
                             '#'    => '',
                             'customer_name'    => '',
                             'date'             => '',
                             'payment_type'     => '',
                             'amount'           => '',
                             'package'          => '',
                             'status'           => '',
                             'options'          => ''
                          );
                $res['#'] = $i;
                $res['customer_name']  = $this->db->get_where('user',array('user_id'=>$row['user_id']))->row()->username.' '.$this->db->get_where('user',array('user_id'=>$row['user_id']))->row()->surname;
                $res['date']  = date('d/m/Y H:i A', $row['purchase_datetime']);
                $res['payment_type'] = "<center><span class='badge badge-primary'>".$row['payment_type']."</span></center>";
                $res['amount'] = currency('','def').' '.$this->cart->format_number($row['amount']);
                $res['package'] = $this->db->get_where('package',array('package_id'=>$row['package_id']))->row()->name;
                if ($row['payment_status'] == 'paid') {
                            $res['status'] = "<center><span class='badge badge-success'>".translate($row['payment_status'])."</span></center>";
                } elseif ($row['payment_status'] == 'due') {
                    $res['status'] = "<center><span class='badge badge-danger'>".translate($row['payment_status'])."</span></center>";
                } elseif ($row['payment_status'] == 'pending') {
                    $res['status'] = "<center><span class='badge badge-info'>".translate($row['payment_status'])."</span></center>";
                }

                if($row['status'] == 'ok'){
                    $res['customer_status']  = ' <label class="label label-success publish_btn">'.translate('Published').'</label>';
                } else {
                    $res['customer_status']  = ' <label class="label label-danger publish_btn">'.translate('Unpublished').'</label>';
                }
                //add html for action
                $res['options'] = "  <a class=\"btn btn-info btn-xs btn-labeled fa fa-location-arrow\" data-toggle=\"tooltip\"
                                onclick=\"ajax_modal('view','".translate('payment_details')."','".translate('successfully_saved!')."','package_payment_view','".$row['package_payment_id']."');proceed('to_list');\" data-original-title=\"View\" data-container=\"body\">
                                    ".translate('view')."
                            </a>
                            <a onclick=\"delete_confirm('".$row['package_payment_id']."','".translate('really_want_to_delete_this?')."')\"
                                class=\"btn btn-danger btn-xs btn-labeled fa fa-trash\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\">
                                    ".translate('delete')."
                            </a>";
                $data[] = $res;
                $i++;
            }
            $result = array(
                             'total' => $total,
                             'rows' => $data
                           );

            echo json_encode($result);
        } else {
            $page_data['page_name']   = "package_payment";
            $page_data['all_product'] = $this->db->get('customer_product')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Digital add, edit, view, delete, stock increase, decrease, discount */
    function digital($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('product')) {
            redirect(base_url() . 'admin');
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
            $data['update_time']        = time();
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

            $data['added_by']           = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));

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
            $name           = demo() ? "" : $id.'_'.$rand.'_'.$_FILES['product_file']['name'];
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
                $video_details[]    = demo() ? array() :  array('type'=>'upload','from'=>'local','video_link'=>'','video_src'=>$video_src);
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
            $this->crud_model->file_up("images", "product", $para2, 'multi');
            if($_FILES['product_file']['name'] !== ''){
                $rand           = substr(hash('sha512', rand()), 0, 20);
                $name           =  demo() ? "" : $para2.'_'.$rand.'_'.$_FILES['product_file']['name'];
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
                $video_details[]    =   demo() ? array() :array('type'=>'upload','from'=>'local','video_link'=>'','video_src'=>$video_src);
                $data_vdo['video']  =   json_encode($video_details);
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
            $this->load->view('back/admin/digital_edit', $page_data);
        } else if ($para1 == 'view') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/digital_view', $page_data);
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
            $this->db->where('download=','ok');
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/admin/digital_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('title', $search, 'both');
            }
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
            $this->db->where('download=','ok');
            $products   = $this->db->get('product', $limit, $offset)->result_array();
            $data       = array();
            foreach ($products as $row) {

                $res    = array(
                             'image' => '',
                             'title' => '',
                             'deal' => '',
                             'publish' => '',
                             'featured' => '',
                             'options' => ''
                          );

                $res['image']  = '<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="'.$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one').'"  />';
                $res['title']  = $row['title'];
                if($row['status'] == 'ok'){
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['deal'] == 'ok'){
                    $res['deal']  = '<input id="deal_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['deal']  = '<input id="deal_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['featured'] == 'ok'){
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" />';
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
            $this->load->view('back/admin/digital_add');
        } elseif ($para1 == 'sale_report') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_sale_report', $data);
        } elseif ($para1 == 'add_discount') {
            $data['product'] = $para2;
            $this->load->view('back/admin/digital_add_discount', $data);
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
            $this->db->where('download=','ok');
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Product Stock add, edit, view, delete, stock increase, decrease, discount */
    function stock($para1 = '', $para2 = '')
    {
        if ($para1 == 'do_add') {

            $data['type']         = 'add';

            $data['attribute']     = implode(',',$this->input->post('attribute'));
            $data['sub_category'] = $this->input->post('sub_category');
            $data['product']      = $para2;
            $data['quantity']     = $this->input->post('quantity');
            $data['rate']         = $this->input->post('rate');
            $data['total']        = $this->input->post('total');
            $data['reason_note']  = $this->input->post('reason_note');
            $data['added_by']     = json_encode(array('type'=>'admin','id'=>$this->session->userdata('vendor_id')));
            $data['datetime']     = time();
            $this->db->insert('stock', $data);
            recache();
        } else if ($para1 == 'do_destroy') {
            $data['type']         = 'destroy';
            $data['category']     = $this->input->post('category');
            $data['sub_category'] = $this->input->post('sub_category');
            $data['product']      = $this->input->post('product');
            $data['quantity']     = $this->input->post('quantity');
            $data['total']        = $this->input->post('total');
            $data['reason_note']  = $this->input->post('reason_note');
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
            $page_data['all_stock'] = $this->db->get('stock')->result_array();
            $this->load->view('back/admin/stock_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/stock_add1');
        } elseif ($para1 == 'get_var') {
            $this->crud_model->ip_data($para2);
            $this->crud_model->_set_variation($para2);
            $attributes = $this->db->where('product_id',$para2)->get('attribute_to_products')->result_array();
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
            $this->load->view('back/admin/stock_add',array('attribute'=>$attr,'pid'=> $para2));
        } elseif ($para1 == 'destroy') {
            $this->load->view('back/admin/stock_destroy');
        } elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category', 'sub_category', 'sub_category_name', 'add', 'demo-chosen-select required', '', 'category', $para2, 'get_product');
        }elseif ($para1 == 'pro_by_sub') {
            echo $this->crud_model->select_html('product', 'product', 'title', 'add', 'demo-chosen-select required', '', 'sub_category', $para2,'get_pro_res');
        }else {
            $page_data['page_name'] = "stock";
            $page_data['all_stock'] = $this->db->get('stock')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Product Bundle add, edit, view, delete, stock increase, decrease, discount */
    function product_bundle($para1 = '', $para2 = '', $para3 = '', $para4 = '')
    {
        if (!$this->crud_model->admin_permission('product_bundle')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            $products = array();
            $data['num_of_imgs']        = $num_of_imgs;
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
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
            $data['shipping_cost']      = $this->input->post('shipping_cost');
            $data['is_bundle']          = 'yes';
            $data['tag']                = $this->input->post('tag');
            $data['current_stock']      = '1';
            $data['unit']               = $this->input->post('unit');
            $product_no                 = $this->input->post('product_no');
            $product_id                 = $this->input->post('product');
            $product_quantity           = $this->input->post('quantity');
            $data['added_by']           = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));
            if(count($product_id) > 0){
                foreach ($product_id as $i => $row) {
                    $products[]              =   array(
                                                    'product_no' => $product_no[$i],
                                                    'product_id' => $product_id[$i],
                                                    'quantity' => $product_quantity[$i],
                                                );
                }
            }
            $data['products']            = json_encode($products);
            $this->db->insert('product', $data);
            $id = $this->db->insert_id();
            $this->benchmark->mark_time();
            if(!demo()){
                $this->crud_model->file_up("images", "product", $id, 'multi');
            }
            recache();
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/product_bundle_add');
        } else if ($para1 == 'edit') {
            $page_data['product_bundle_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/product_bundle_edit', $page_data);
        } elseif($para1 == 'update') {
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            $num                        = $this->crud_model->get_type_name_by_id('product', $para2, 'num_of_imgs');
            $products = array();
            $data['num_of_imgs']        = $num + $num_of_imgs;
            $data['title']              = $this->input->post('title');
            $data['description']        = $this->input->post('description');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['purchase_price']     = $this->input->post('purchase_price');
            $data['update_time']        = time();
            $data['tax']                = $this->input->post('tax');
            $data['discount']           = $this->input->post('discount');
            $data['discount_type']      = $this->input->post('discount_type');
            $data['tax_type']           = $this->input->post('tax_type');
            $data['shipping_cost']      = $this->input->post('shipping_cost');
            $data['tag']                = $this->input->post('tag');
            $data['unit']               = $this->input->post('unit');
            $product_no                 = $this->input->post('product_no');
            $product_id                 = $this->input->post('product');
            $product_quantity           = $this->input->post('quantity');
            $data['added_by']           = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));
            if(count($product_id) > 0){
                foreach ($product_id as $i => $row) {
                    $products[]              =   array(
                                                    'product_no' => $product_no[$i],
                                                    'product_id' => $product_id[$i],
                                                    'quantity' => $product_quantity[$i],
                                                );
                }
            }
            $data['products']            = json_encode($products);
            if(!demo()){
                $this->crud_model->file_up("images", "product", $para2, 'multi');
            }

            $this->db->where('product_id', $para2);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->crud_model->file_dlt('product', $para2, '.jpg', 'multi');
                $this->db->where('product_id', $para2);
                $this->db->delete('product');
                recache();
            }

        } else if ($para1 == 'view') {
            $page_data['product_bundle_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/product_bundle_view', $page_data);
        } else if ($para1 == 'do_destroy') {

        } elseif ($para1 == 'list') {
            $this->db->order_by('product_id', 'desc');
            $page_data['all_product_bundle'] = $this->db->get_where('product', array('is_bundle' => 'yes'))->result_array();
            $this->load->view('back/admin/product_bundle_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('title', $search, 'both');
            }
            $this->db->where('is_bundle', 'yes');
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
            $product_bundles   = $this->db->get_where('product', array('is_bundle' => 'yes'), $limit, $offset)->result_array();
            $data       = array();
            foreach ($product_bundles as $row) {

                $res    = array(
                             'image' => '',
                             'title' => '',
                             'publish' => '',
                             'featured' => '',
                             'options' => ''
                          );

                $res['image']  = '<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="'.$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one').'"  />';
                $res['title']  = $row['title'];

                if($row['status'] == 'ok'){
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['current_stock'] > 0){
                    $res['current_stock']  = $row['current_stock'].$row['unit'].'(s)';
                } else {
                    $res['current_stock']  = '<span class="label label-danger">'.translate('out_of_stock').'</span>';
                }
                if($row['featured'] == 'ok'){
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['deal'] == 'ok'){
                    $res['deal'] = '<input id="del_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['deal'] = '<input id="del_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                //add html for action
                $res['options'] = "  <a class=\"btn btn-info btn-xs btn-labeled fa fa-location-arrow\" data-toggle=\"tooltip\"
                                onclick=\"ajax_set_full('view','".translate('view_product_bundle')."','".translate('successfully_viewed!')."','product_bundle_view','".$row['product_id']."');proceed('to_list');\" data-original-title=\"View\" data-container=\"body\">
                                    ".translate('view')."
                            </a>
                            <a class=\"btn btn-purple btn-xs btn-labeled fa fa-tag\" data-toggle=\"tooltip\"
                                onclick=\"ajax_modal('add_discount','".translate('view_discount')."','".translate('viewing_discount!')."','add_bundle_discount','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('discount')."
                            </a>
                            <a class=\"btn btn-mint btn-xs btn-labeled fa fa-plus-square\" data-toggle=\"tooltip\"
                                onclick=\"ajax_modal('add_stock','".translate('add_bundle_quantity')."','".translate('quantity_added!')."','bundle_stock_add','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('stock')."
                            </a>
                            <a class=\"btn btn-dark btn-xs btn-labeled fa fa-minus-square\" data-toggle=\"tooltip\"
                                onclick=\"ajax_modal('destroy_stock','".translate('reduce_bundle_quantity')."','".translate('quantity_reduced!')."','destroy_bundle_stock','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('destroy')."
                            </a>

                            <a class=\"btn btn-success btn-xs btn-labeled fa fa-wrench\" data-toggle=\"tooltip\"
                                onclick=\"ajax_set_full('edit','".translate('edit_product_bundle')."','".translate('successfully_edited!')."','product_bundle_edit','".$row['product_id']."');proceed('to_list');\" data-original-title=\"Edit\" data-container=\"body\">
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

        } elseif ($para1 == 'add_discount') {
            $data['product_bundle'] = $para2;
            $this->load->view('back/admin/product_bundle_add_discount', $data);
        } elseif ($para1 == 'add_discount_set') {
            $product_bundle               = $this->input->post('product_bundle');
            $data['discount']      = $this->input->post('discount');
            $data['discount_type'] = $this->input->post('discount_type');
            $this->db->where('product_id', $product_bundle);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'add_stock') {
            $data['product_bundle'] = $para2;
            $this->load->view('back/admin/product_bundle_stock_add', $data);
        } elseif ($para1 == 'destroy_stock') {
            $data['product_bundle'] = $para2;
            $this->load->view('back/admin/product_bundle_stock_destroy', $data);
        } elseif ($para1 == 'bundle_publish_set') {
            $product_bundle = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('product_id', $product_bundle);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'bundle_featured_set') {
            $product_bundle = $para2;
            if ($para3 == 'true') {
                $data['featured'] = 'ok';
            } else {
                $data['featured'] = '0';
            }
            $this->db->where('product_id', $product_bundle);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'bundle_deal_set') {
            $product_bundle = $para2;
            if ($para3 == 'true') {
                $data['deal'] = 'ok';
            } else {
                $data['deal'] = '0';
            }
            $this->db->where('product_id', $product_bundle);
            $this->db->update('product', $data);
            recache();
        } else if ($para1 == 'dlt_img') {
            if(!demo()){
                $a = explode('_', $para2);
                $this->crud_model->file_dlt('product', $a[0], '.jpg', 'multi', $a[1]);
                recache();
            }

        } elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category', 'sub_category[]', 'sub_category_name', 'add', 'demo-chosen-select required', '', 'category', $para2, 'get_brnd');
        } elseif ($para1 == 'brand_by_sub') {
            $brands=json_decode($this->crud_model->get_type_name_by_id('sub_category',$para2,'brand'),true);
            /*if(empty($brands)){
                echo translate("<p class='control-label'>No brands are available for this sub category</p>");
            } else {*/
                echo $this->crud_model->select_html('brand', 'brand[]', 'name', 'add', 'demo-chosen-select required', '', 'brand_id', $brands, 'get_prod', 'multi', 'none');
            // }
        } elseif ($para1 == 'prod_by_brand') {
            if ($para2 == 'none') {
                $prod_ids = array();
                $products = $this->db->get_where('product', array('sub_category' => $para3, 'category' => $para4))->result_array();
                foreach ($products as $product) {
                    $prod_ids[] = $product['product_id'];
                }
                if(empty($prod_ids)){
                    echo translate("<p class='control-label'>No Products are available for this brand</p>");
                } else {
                    echo $this->crud_model->select_html('product', 'product[]', 'title', 'add', 'demo-chosen-select required', '', 'product_id', $prod_ids, '', 'multi');
                }
            } else {
                $prod_ids = array();
                $products = $this->db->get_where('product', array('brand' => $para2, 'sub_category' => $para3, 'category' => $para4))->result_array();
                foreach ($products as $product) {
                    $prod_ids[] = $product['product_id'];
                }
                if(empty($prod_ids)){
                    echo translate("<p class='control-label'>No Products are available for this brand</p>");
                } else {
                    echo $this->crud_model->select_html('product', 'product[]', 'title', 'add', 'demo-chosen-select required', '', 'product_id', $prod_ids, '', 'multi');
                }
            }
        } else {
            $page_data['page_name'] = "product_bundle";

            $this->load->view('back/index', $page_data);
        }
    }

    /* Product Bundle Stock add, edit, view, delete, stock increase, decrease, discount */
    function bundle_stock($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('bundle_stock')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['type']         = 'add';
            $data['product_bundle']      = $this->input->post('product_bundle');
            $data['quantity']     = $this->input->post('quantity');
            $data['rate']         = $this->input->post('rate');
            $data['total']        = $this->input->post('total');
            $data['reason_note']  = $this->input->post('reason_note');
            $data['datetime']     = time();
            $this->db->insert('bundle_stock', $data);
            $prev_quantity          = $this->crud_model->get_type_name_by_id('product', $data['product_bundle'], 'current_stock');
            $data1['current_stock'] = $prev_quantity + $data['quantity'];
            $this->db->where('product_id', $data['product_bundle']);
            $this->db->update('product', $data1);
            recache();
        } else if ($para1 == 'do_destroy') {
            $data['type']         = 'destroy';
            $data['product_bundle']      = $this->input->post('product_bundle');
            $data['quantity']     = $this->input->post('quantity');
            $data['total']        = $this->input->post('total');
            $data['reason_note']  = $this->input->post('reason_note');
            $data['datetime']     = time();
            $this->db->insert('bundle_stock', $data);
            $prev_quantity = $this->crud_model->get_type_name_by_id('product', $data['product_bundle'], 'current_stock');
            $current       = $prev_quantity - $data['quantity'];
            if ($current <= 0) {
                $current = 0;
            }
            $data1['current_stock'] = $current;
            $this->db->where('product_id', $data['product_bundle']);
            $this->db->update('product', $data1);
            recache();
        } else {
            $page_data['page_name'] = "bundle_stock";

            $this->load->view('back/index', $page_data);
        }
    }

    function delete_all_categories($para1 = '')
    {
        if (!$this->crud_model->admin_permission('delete_all_categories')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $dir1 = 'uploads/category_image';
                $leave_files1 = array('default.jpg');

                foreach( glob("$dir1/*") as $file1 ) {
                    if( !in_array(basename($file1), $leave_files1) )
                        unlink($file1);
                }
                $dir2 = 'uploads/sub_category_image';
                $leave_files2 = array('default.jpg');

                foreach( glob("$dir2/*") as $file2 ) {
                    if( !in_array(basename($file2), $leave_files2) )
                        unlink($file2);
                }
                $this->db->empty_table('category');
                $this->db->empty_table('sub_category');
                recache();
            }

        } else {
            $page_data['page_name'] = "delete_all_categories";
            $this->load->view('back/index', $page_data);
        }
    }

    function delete_all_products($para1 = '')
    {
        if (!$this->crud_model->admin_permission('delete_all_products')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $dir = 'uploads/product_image';
                $leave_files = array('default.jpg');

                foreach( glob("$dir/*") as $file ) {
                    if( !in_array(basename($file), $leave_files) )
                        unlink($file);
                }
                // $this->db->delete('product');
                $this->db->empty_table('product');
                //echo $this->db->last_query();
                recache();
            }

        } else {
            $page_data['page_name'] = "delete_all_products";
            $this->load->view('back/index', $page_data);
        }
    }

    function delete_all_brands($para1 = '')
    {
        if (!$this->crud_model->admin_permission('delete_all_brands')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $dir = 'uploads/brand_image';
                $leave_files = array('default.jpg');

                foreach( glob("$dir/*") as $file ) {
                    if( !in_array(basename($file), $leave_files) )
                        unlink($file);
                }
                $this->db->empty_table('brand');
                recache();
            }

        } else {
            $page_data['page_name'] = "delete_all_brands";
            $this->load->view('back/index', $page_data);
        }
    }

    function delete_all_classified($para1 = '')
    {
        if (!$this->crud_model->admin_permission('delete_all_classified')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $dir = 'uploads/customer_product_image';
                $leave_files = array('default.jpg');

                foreach( glob("$dir/*") as $file ) {
                    if( !in_array(basename($file), $leave_files) )
                        unlink($file);
                }
                $this->db->empty_table('customer_product');
                recache();
            }

        } else {
            $page_data['page_name'] = "delete_all_classified";
            $this->load->view('back/index', $page_data);
        }
    }

    /*Frontend Banner Management */
    function banner($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('banner')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            $data['link']   = $this->input->post('link');
            $data['status'] = $this->input->post('status');
            if($_FILES['img']['name'] !== ''){
                $path = $_FILES['img']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $data['image_ext']       = '.'.$ext;
                if(!demo()){
                    $this->crud_model->file_up("img", "banner", $para2, '','','.'.$ext);
                }
            }
            $this->db->where('banner_id', $para2);
            $this->db->update('banner', $data);
            if(!demo()){
                $this->crud_model->file_up("img", "banner", $para2);
            }
            recache();
        } else if ($para1 == 'banner_publish_set') {
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else if ($para3 == 'false') {
                $data['status'] = '0';
            }
            $this->db->where('banner_id', $para2);
            $this->db->update('banner', $data);
            recache();
        }
    }

    /* Managing sales by users */
    function sales($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('sale')) {
            redirect(base_url() . 'admin');
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
        }
        elseif ($para1 == 'list') {
            $all = $this->db->get_where('sale',array('payment_type' => 'go'))->result_array();
            foreach ($all as $row) {
                if((time()-$row['sale_datetime']) > 600){
                    $this->db->where('sale_id', $row['sale_id']);
                    $this->db->delete('sale');
                }
            }
            $this->db->order_by('sale_id', 'desc');
            $page_data['all_sales'] = $this->db->get('sale')->result_array();
            $this->load->view('back/admin/sales_list', $page_data);
        }
        elseif ($para1 == 'view') {
            $data['viewed'] = 'ok';
            $this->db->where('sale_id', $para2);
            $this->db->update('sale', $data);
            $page_data['sale'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/sales_view', $page_data);
        }
        elseif ($para1 == 'track') {
            $page_data['sale'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->result_array();
            $items = Array('SHIPPO_PRE_TRANSIT', 'SHIPPO_TRANSIT', 'SHIPPO_DELIVERED', 'SHIPPO_RETURNED', 'SHIPPO_FAILURE', 'SHIPPO_UNKNOWN');

            $fields = array(
                'carrier' => 'shippo',
                'tracking_number' => $items[array_rand($items)],
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.goshippo.com/tracks/",
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
            $page_data['tracking'] = $response;
            $this->load->view('back/admin/sales_track', $page_data);
        }
        elseif ($para1 == 'send_invoice') {
            $page_data['sale'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->result_array();
            $text              = $this->load->view('back/includes_top', $page_data);
            $text .= $this->load->view('back/admin/sales_view', $page_data);
            $text .= $this->load->view('back/includes_bottom', $page_data);
        }
        elseif ($para1 == 'delivery_payment') {
            $data['viewed'] = 'ok';
            $this->db->where('sale_id', $para2);
            $this->db->update('sale', $data);
            $page_data['get_sale'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row_array();
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
                if(isset($row['admin'])){
                    $page_data['delivery_status'] = $row['status'];
                    if(isset($row['comment'])){
                        $page_data['comment'] = $row['comment'];
                    } else {
                        $page_data['comment'] = '';
                    }
                }
                else{
                    $page_data['delivery_status'] = '';
                }
            }
            $payment_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_status,true);
            foreach ($payment_status as $row) {
                if(isset($row['admin'])){
                    $page_data['payment_status'] = $row['status'];
                }
                else{
                    $page_data['payment_status'] = '';
                }
            }

            $this->load->view('back/admin/sales_delivery_payment', $page_data);
        }
        elseif ($para1 == 'delivery_payment_set') {
            $delivery_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->delivery_status,true);
            $new_delivery_status = array();
            foreach ($delivery_status as $row) {
                if(isset($row['admin'])){
                    $new_delivery_status[] = array('admin'=>'','status'=>$this->input->post('delivery_status'),'comment'=>$this->input->post('comment'),'delivery_time'=>time());
                } else {
                    $new_delivery_status[] = array('vendor'=>$row['vendor'],'status'=>$row['status'],'comment'=>$row['comment'],'delivery_time'=>$row['delivery_time']);
                }
            }
            $payment_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_status,true);
            $new_payment_status = array();
            foreach ($payment_status as $row) {
                if(isset($row['admin'])) {
                    $new_payment_status[] = array('admin'=>'','status'=>$this->input->post('payment_status'));
                } else {
                    $new_payment_status[] = array('vendor'=>$row['vendor'],'status'=>$row['status']);
                }
            }
            $data['payment_status']  = json_encode($new_payment_status);
            $data['delivery_status'] = json_encode($new_delivery_status);
            $data['payment_details'] = $this->input->post('payment_details');
            $this->db->where('sale_id', $para2);
            $this->db->update('sale', $data);
        }
        elseif ($para1 == 'add') {
            $this->load->view('back/admin/sales_add');
        }
        elseif ($para1 == 'total') {
            echo $this->db->get('sale')->num_rows();
        }
        else {
            $page_data['page_name']      = "sales";
            $page_data['all_categories'] = $this->db->get('sale')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /*User Management */
    function user($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('user')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['username']    = $this->input->post('user_name');
            $data['description'] = $this->input->post('description');
            $this->db->insert('user', $data);
        } else if ($para1 == 'edit') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                'user_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/user_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['username']    = $this->input->post('username');
            $data['description'] = $this->input->post('description');
            $this->db->where('user_id', $para2);
            $this->db->update('user', $data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('user_id', $para2);
                $this->db->delete('user');
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('user_id', 'desc');
            $page_data['all_users'] = $this->db->get('user')->result_array();
            $this->load->view('back/admin/user_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                'user_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/user_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/user_add');
        } else {
            $page_data['page_name'] = "user";
            $page_data['all_users'] = $this->db->get('user')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* membership_payment Management */
    function membership_payment($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('membership_payment') || $this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('membership_payment_id', $para2);
                $this->db->delete('membership_payment');
            }
        } else if ($para1 == 'list') {
            $this->db->order_by('membership_payment_id', 'desc');
            $page_data['all_membership_payments'] = $this->db->get('membership_payment')->result_array();
            $this->load->view('back/admin/membership_payment_list', $page_data);
        } else if ($para1 == 'view') {
            $page_data['membership_payment_data'] = $this->db->get_where('membership_payment', array(
                'membership_payment_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/membership_payment_view', $page_data);
        } elseif ($para1 == 'upgrade') {
            if($this->input->post('status')){
                $membership = $this->db->get_where('membership_payment',array('membership_payment_id'=>$para2))->row()->membership;
                $vendor = $this->db->get_where('membership_payment',array('membership_payment_id'=>$para2))->row()->vendor;
                $data['status'] = $this->input->post('status');
                $data['details'] = $this->input->post('details');
                if($data['status'] == 'paid'){
                    $this->crud_model->upgrade_membership($vendor,$membership);
                }

                $this->db->where('membership_payment_id', $para2);
                $this->db->update('membership_payment', $data);
            }
        } else {
            $page_data['page_name'] = "membership_payment";
            $page_data['all_membership_payments'] = $this->db->get('membership_payment')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Vendor Management */
    function vendor($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('vendor') || $this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }

        //echo $para1;exit;

        if ($para1 == 'delete') {
            if(!demo()){
                /* delete vendor products start */
                $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$para2)));
                $products = $this->db->get('product')->result_array();
                $ids= array();
                foreach($products as $row){
                    $this->crud_model->file_dlt('product',$row['product_id'], '.jpg', 'multi');
                    $this->db->where('product_id', $row['product_id']);
                    $this->db->delete('product');
                }
                $this->crud_model->set_category_data(0);
                /* delete vendor products end */

                $this->db->where('vendor_id', $para2);
                $this->db->delete('vendor');

                recache();
            }
        } else if ($para1 == 'list') {
            $this->db->order_by('vendor_id', 'desc');
            $page_data['all_vendors'] = $this->db->get('vendor')->result_array();
            $this->load->view('back/admin/vendor_list', $page_data);
        } else if ($para1 == 'view') {
            $page_data['vendor_data'] = $this->db->get_where('vendor', array(
                'vendor_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/vendor_view', $page_data);
        } else if ($para1 == 'pay_form') {
            $page_data['vendor_id'] = $para2;
            $this->load->view('back/admin/vendor_pay_form', $page_data);
        } else if ($para1 == 'approval') {
            $page_data['vendor_id'] = $para2;
            $page_data['status'] = $this->db->get_where('vendor', array(
                                            'vendor_id' => $para2
                                        ))->row()->status;
            $this->load->view('back/admin/vendor_approval', $page_data);
        } else if ($para1 == 'add') {
            $this->load->view('back/admin/vendor_add');
        } else if ($para1 == 'approval_set') {
            $vendor = $para2;
            // die("OK");
            $approval = $this->input->post('approval');
            $approval = 'ok';
            if ($approval == 'ok') {
                $data['status'] = 'approved';
            } else {
                $data['status'] = 'pending';
            }
            $this->db->where('vendor_id', $vendor);
            $this->db->update('vendor', $data);
            $this->email_model->status_email('vendor', $vendor);
            recache();
        } elseif ($para1 == 'pay') {
            $vendor         = $para2;
            $method         = $this->input->post('method');
            $amount         = $this->input->post('amount');
            $amount_in_usd  = $amount/exchange('usd');
            if ($method == 'paypal') {
                $paypal_email  = $this->crud_model->get_type_name_by_id('vendor', $vendor, 'paypal_email');
                $data['vendor_id']      = $vendor;
                $data['amount']         = $this->input->post('amount');
                $data['status']         = 'due';
                $data['method']         = 'paypal';
                $data['timestamp']      = time();

                $this->db->insert('vendor_invoice', $data);
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
                $this->paypal->add_field('notify_url', base_url() . 'admin/paypal_ipn');
                $this->paypal->add_field('cancel_return', base_url() . 'admin/paypal_cancel');
                $this->paypal->add_field('return', base_url() . 'admin/paypal_success');

                $this->paypal->submit_paypal_post();
                // submit the fields to paypal

            }else if ($method == 'bitcoin') {
                $data['vendor_id']      = $vendor;
                $data['amount']         = $this->input->post('amount');
                $data['status']         = 'due';
                $data['method']         = 'bitcoin';
                $data['timestamp']      = time();

                $this->db->insert('vendor_invoice', $data);
                $invoice_id           = $this->db->insert_id();
                $this->session->set_userdata('invoice_id', $invoice_id);

                $bitcoin_coinpayments_merchant = $this->db->get_where('business_settings',array('type'=>'bitcoin_coinpayments_merchant'))->row()->value;
                $final_amount = $amount_in_usd;

                echo $this->load->view('back/admin/bitcoin_pay_to_vendor_payment_view',compact('bitcoin_coinpayments_merchant','final_amount'),true);
                exit;

            }else if ($method == 'c2') {
                $data['vendor_id']      = $vendor;
                $data['amount']         = $this->input->post('amount');
                $data['status']         = 'due';
                $data['method']         = 'c2';
                $data['timestamp']      = time();

                $this->db->insert('vendor_invoice', $data);
                $invoice_id             = $this->db->insert_id();
                $this->session->set_userdata('vendor_id', $vendor);
                $this->session->set_userdata('invoice_id', $invoice_id);

                $c2_user = $this->db->get_where('vendor',array('vendor_id' => $vendor))->row()->c2_user;
                $c2_secret = $this->db->get_where('vendor',array('vendor_id' => $vendor))->row()->c2_secret;


                $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
                $this->twocheckout_lib->add_field('sid', $this->twocheckout_lib->sid);              //Required - 2Checkout account number
                $this->twocheckout_lib->add_field('cart_order_id', $invoice_id);   //Required - Cart ID
                $this->twocheckout_lib->add_field('total',$this->cart->format_number($amount_in_usd));

                $this->twocheckout_lib->add_field('x_receipt_link_url', base_url().'admin/twocheckout_success');
                $this->twocheckout_lib->add_field('demo', $this->twocheckout_lib->demo);                    //Either Y or N

                $this->twocheckout_lib->submit_form();
            }else if ($method == 'vp') {
                $vp_id  = $this->crud_model->get_type_name_by_id('vendor', $vendor, 'vp_merchant_id');

                $data['vendor_id']      = $vendor;
                $data['amount']         = $this->input->post('amount');
                $data['status']         = 'due';
                $data['method']         = 'vouguepay';
                $data['timestamp']      = time();

                $this->db->insert('vendor_invoice', $data);
                $invoice_id           = $this->db->insert_id();
                $this->session->set_userdata('invoice_id', $invoice_id);
                //$vouguepay_id              = $this->crud_model->get_type_name_by_id('business_settings', '1', 'value');
                $system_title              = $this->crud_model->get_settings_value('general_settings', 'system_title', 'value');
                /****TRANSFERRING USER TO vouguepay TERMINAL****/
                $this->vouguepay->add_field('v_merchant_id', $vp_id);
                $this->vouguepay->add_field('merchant_ref', $invoice_id);
                $this->vouguepay->add_field('memo', 'Pay from '.$system_title);
                //$this->vouguepay->add_field('developer_code', $developer_code);
                //$this->vouguepay->add_field('store_id', $store_id);


                $this->vouguepay->add_field('total', $data['amount'] );

                //$this->vouguepay->add_field('amount', $grand_total);
                //$this->vouguepay->add_field('custom', $sale_id);
                //$this->vouguepay->add_field('business', $vouguepay_email);

                $this->vouguepay->add_field('notify_url', base_url() . 'admin/vouguepay_ipn');
                $this->vouguepay->add_field('fail_url', base_url() . 'admin/vouguepay_cancel');
                $this->vouguepay->add_field('success_url', base_url() . 'admin/vouguepay_success');

                $this->vouguepay->submit_vouguepay_post();
                // submit the fields to vouguepay
            }else if ($method == 'stripe') {
                if($this->input->post('stripeToken')) {

                    $vendor         = $para2;
                    $method         = $this->input->post('method');
                    $amount         = $this->input->post('amount');
                    $amount_in_usd  = $amount/$this->db->get_where('business_settings',array('type'=>'exchange'))->row()->value;

                    $stripe_details      = json_decode($this->db->get_where('vendor', array(
                        'vendor_id' => $vendor
                    ))->row()->stripe_details,true);
                    $stripe_publishable  = $stripe_details['publishable'];
                    $stripe_api_key      =  $stripe_details['secret'];

                    require_once(APPPATH . 'libraries/stripe-php/init.php');
                    \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                    $vendor_email = $this->db->get_where('vendor' , array('vendor_id' => $vendor))->row()->email;

                    $vendora = \Stripe\Customer::create(array(
                        'email' => $this->db->get_where('general_settings',array('type'=>'system_email'))->row()->value, // customer email id
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

                        $data['vendor_id']          = $vendor;
                        $data['amount']             = $amount;
                        $data['status']             = 'paid';
                        $data['method']             = 'stripe';
                        $data['timestamp']          = time();
                        $data['payment_details']    = "Customer Info: \n".json_encode($vendora,true)."\n \n Charge Info: \n".json_encode($charge,true);

                        $this->db->insert('vendor_invoice', $data);

                        $this->email_model->vendor_payment($vendor,$amount);

                        redirect(base_url() . 'admin/vendor/', 'refresh');
                    } else {
                        $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                        redirect(base_url() . 'admin/vendor/', 'refresh');
                    }

                } else{
                    $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                    redirect(base_url() . 'admin/vendor/', 'refresh');
                }
            }elseif ($method == 'pum') {
                $pum_key  = $this->crud_model->get_type_name_by_id('vendor', $vendor, 'pum_merchant_key');
                $pum_salt  = $this->crud_model->get_type_name_by_id('vendor', $vendor, 'pum_merchant_salt');
                $data['vendor_id']      = $vendor;
                $data['amount']         = $this->input->post('amount');
                $data['status']         = 'due';
                $data['method']         = 'payUmoney';
                $data['timestamp']      = time();

                $this->db->insert('vendor_invoice', $data);
                $invoice_id           = $this->db->insert_id();
                $this->session->set_userdata('invoice_id', $invoice_id);

                /****TRANSFERRING USER TO PUM TERMINAL****/
                    $this->pum->add_field('key', $pum_key);
                    $this->pum->add_field('txnid',substr(hash('sha256', mt_rand() . microtime()), 0, 20));
                    $this->pum->add_field('amount', $this->cart->format_number($amount_in_usd));
                    $this->pum->add_field('firstname', $this->db->get_where('vendor', array('vendor_id' => $vendor))->row()->name);
                    $this->pum->add_field('email', $this->db->get_where('vendor', array('vendor_id' => $vendor))->row()->email);
                    $this->pum->add_field('phone', 'Not Given');
                    $this->pum->add_field('productinfo', 'Payment with PayUmoney');
                    $this->pum->add_field('service_provider', 'payu_paisa');
                    $this->pum->add_field('udf1', $vendor);

                    $this->pum->add_field('surl', base_url().'admin/vendor_pum_success');
                    $this->pum->add_field('furl', base_url().'admin/vendor_pum_failure');

                    // submit the fields to pum
                    $this->pum->submit_pum_post();
            } else if ($method == 'cash') {
                $data['vendor_id']          = $para2;
                $data['amount']             = $this->input->post('amount');
                $data['status']             = 'due';
                $data['method']             = 'cash';
                $data['timestamp']          = time();
                $data['payment_details']    = "";
                $this->db->insert('vendor_invoice', $data);

                $this->email_model->vendor_payment($para2,$data['amount']);
                redirect(base_url() . 'admin/vendor/', 'refresh');
            }
        }else {
            $page_data['page_name'] = "vendor";
            $page_data['all_vendors'] = $this->db->get('vendor')->result_array();
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
            $this->db->where('vendor_invoice_id', $invoice_id);
            $this->db->delete('vendor_invoice');
            $this->session->set_userdata('vendor_invoice_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            redirect(base_url() . 'admin/vendor/', 'refresh');
        } else {

            $data['status']             = 'paid';
            $data['payment_details']    = json_encode($_POST);
            $invoice_id                 = $_POST['custom'];
            $this->db->where('vendor_invoice_id', $invoice_id);
            $this->db->update('vendor_invoice', $data);

            $vendor=$this->db->get_where('vendor_invoice',array('vendor_invoice_id'=>$invoice_id))->result_array()->row->vendor_id;
            $this->email_model->vendor_payment($vendor,$amount);
            $this->session->set_userdata('vendor_invoice_id', '');
            redirect(base_url() . 'admin/vendor/', 'refresh');
        }
    }

    function vendor_pum_failure()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('vendor_invoice_id', $invoice_id);
        $this->db->delete('vendor_invoice');
        $this->session->set_userdata('vendor_invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'admin/vendor/', 'refresh');
    }
    /* wallet_load Management */
    function wallet_load($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('user')) {
            redirect(base_url() . 'admin');
        }
        if ($this->crud_model->get_type_name_by_id('general_settings','84','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('wallet_load_id', $para2);
                $this->db->delete('wallet_load');
            }
        } else if ($para1 == 'list') {
            $this->db->order_by('wallet_load_id', 'desc');
            $page_data['all_wallet_loads'] = $this->db->get('wallet_load')->result_array();
            $this->load->view('back/admin/wallet_load_list', $page_data);
        } else if ($para1 == 'view') {
            $page_data['wallet_load_data'] = $this->db->get_where('wallet_load', array(
                'wallet_load_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/wallet_load_view', $page_data);
        } else if ($para1 == 'pay_form') {
            $page_data['wallet_load_id'] = $para2;
            $this->load->view('back/admin/wallet_load_pay_form', $page_data);
        } else if ($para1 == 'user_view') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                'user_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/user_view', $page_data);
        } else if ($para1 == 'approval') {
            $page_data['wallet_load_id'] = $para2;
            $det = json_decode($this->db->get_where('wallet_load', array('wallet_load_id' => $para2))->row()->details,true);
            $page_data['payment_info'] = $this->db->get_where('wallet_load', array('wallet_load_id' => $para2))->row()->payment_details;
            $page_data['status'] = $det['status'];
            $this->load->view('back/admin/wallet_load_approval', $page_data);
        } else if ($para1 == 'add') {
            $this->load->view('back/admin/wallet_load_add');
        } else if ($para1 == 'approval_set') {
            $wallet_load = $para2;
            $approval = $this->input->post('approval');
            if ($approval == 'ok') {
                $data['details'] = json_encode(array('status'=>'paid'));
                $user = $this->db->get_where('wallet_load', array('wallet_load_id' => $wallet_load))->row()->user;
                $amount = $this->db->get_where('wallet_load', array('wallet_load_id' => $wallet_load))->row()->amount;
                $this->wallet_model->add_user_balance($amount,$user);
                $this->email_model->wallet_email('admin_approved_to_customer', $wallet_load);
            } else {
                $data['details'] = json_encode(array('status'=>'pending'));
            }
            $this->db->where('wallet_load_id', $wallet_load);
            $this->db->update('wallet_load', $data);
            //$this->email_model->status_email('wallet_load', $wallet_load);
            recache();
        } elseif ($para1 == 'pay') {
            $wallet_load         = $para2;
            $method         = $this->input->post('method');
            $amount         = $this->input->post('amount');
            $amount_in_usd  = $amount/exchange('usd');
        } else {
            $page_data['page_name'] = "wallet_load";
            $page_data['all_wallet_loads'] = $this->db->get('wallet_load')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    function bitcoin_pay_to_vendor_cancel()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('vendor_invoice_id', $invoice_id);
        $this->db->delete('vendor_invoice');
        $this->session->set_userdata('vendor_invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'admin/vendor/', 'refresh');
    }

    function bitcoin_pay_to_vendor_success()
    {
        $invoice_id = $this->session->userdata('invoice_id');

        $data['status']             = 'paid';
        $data['payment_details']    = json_encode($_POST);
        $this->db->where('vendor_invoice_id', $invoice_id);
        $this->db->update('vendor_invoice', $data);

        $vendor=$this->db->get_where('vendor_invoice',array('vendor_invoice_id'=>$invoice_id))->result_array()->row->vendor_id;
        $amount=$this->db->get_where('vendor_invoice',array('vendor_invoice_id'=>$invoice_id))->result_array()->row->amount;
        $this->email_model->vendor_payment($vendor,$amount);

        $this->session->set_userdata('invoice_id', '');
        redirect(base_url() . 'admin/vendor/', 'refresh');
    }


    /* FUNCTION: Verify paypal payment by IPN*/
    function paypal_ipn()
    {
        if ($this->paypal->validate_ipn() == true) {

            $data['status']             = 'paid';
            $data['payment_details']    = json_encode($_POST);
            $invoice_id                 = $_POST['custom'];
            $this->db->where('vendor_invoice_id', $invoice_id);
            $this->db->update('vendor_invoice', $data);

            $vendor=$this->db->get_where('vendor_invoice',array('vendor_invoice_id'=>$invoice_id))->result_array()->row->vendor_id;
            $amount=$this->db->get_where('vendor_invoice',array('vendor_invoice_id'=>$invoice_id))->result_array()->row->amount;
            $this->email_model->vendor_payment($vendor,$amount);
        }
    }


    /* FUNCTION: Loads after cancelling paypal*/
    function paypal_cancel()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('vendor_invoice_id', $invoice_id);
        $this->db->delete('vendor_invoice');
        $this->session->set_userdata('vendor_invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'admin/vendor/', 'refresh');
    }

    /* FUNCTION: Loads after successful paypal payment*/
    function paypal_success()
    {
        $this->session->set_userdata('invoice_id', '');
        redirect(base_url() . 'admin/vendor/', 'refresh');
    }

    function twocheckout_success()
    {

        //$this->twocheckout_lib->set_acct_info('532001', 'tango', 'Y');
        $c2_user = $this->db->get_where('vendor',array('vendor_id' => $this->session->userdata('vendor_id')))->row()->c2_user;
        $c2_secret = $this->db->get_where('vendor',array('vendor_id' => $this->session->userdata('vendor_id')))->row()->c2_secret;

        $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
        $data2['response'] = $this->twocheckout_lib->validate_response();
        $status = $data2['response']['status'];
        if ($status == 'pass') {
            $data1['status']             = 'paid';
            $data1['payment_details']   = json_encode($this->twocheckout_lib->validate_response());
            $invoice_id                 = $data2['response']['cart_order_id'];
            $this->db->where('vendor_invoice_id', $invoice_id);
            $this->db->update('vendor_invoice', $data1);

            $vendor=$this->db->get_where('vendor_invoice',array('vendor_invoice_id'=>$invoice_id))->result_array()->row->vendor_id;
            $amount=$this->db->get_where('vendor_invoice',array('vendor_invoice_id'=>$invoice_id))->result_array()->row->amount;
            $this->email_model->vendor_payment($vendor,$amount);
            redirect(base_url() . 'admin/vendor/', 'refresh');

        } else {
            //var_dump($data2['response']);
            $invoice_id = $this->session->userdata('invoice_id');
            $this->db->where('vendor_invoice_id', $invoice_id);
            $this->db->delete('vendor_invoice');
            $this->session->set_userdata('invoice_id', '');
            $this->session->set_userdata('vendor_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            redirect(base_url() . 'admin/vendor', 'refresh');
        }
    }
    /* FUNCTION: Verify vouguepay payment by IPN*/
    function vouguepay_ipn()
    {
        $res = $this->vouguepay->validate_ipn();
        $invoice_id = $res['merchant_ref'];
        $merchant_id = 'demo';

        if ($res['total'] !== 0 && $res['status'] == 'Approved' && $res['merchant_id'] == $merchant_id) {
            $data['payment_details']   = json_encode($res);
            $data['timestamp'] = strtotime(date("m/d/Y"));
            $data['status'] = 'paid';
            $this->db->where('vendor_invoice_id', $invoice_id);
            $this->db->update('vendor_invoice', $data);

            $vendor=$this->db->get_where('vendor_invoice',array('vendor_invoice_id'=>$invoice_id))->result_array()->row->vendor_id;
            $amount=$this->db->get_where('vendor_invoice',array('vendor_invoice_id'=>$invoice_id))->result_array()->row->amount;
            $this->email_model->vendor_payment($vendor,$amount);
        }
    }

    /* FUNCTION: Loads after cancelling vouguepay*/
    function vouguepay_cancel()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('vendor_invoice_id', $invoice_id);
        $this->db->delete('vendor_invoice');
        $this->session->set_userdata('invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'admin/vendor/', 'refresh');
    }

    /* FUNCTION: Loads after successful vouguepay payment*/
    function vouguepay_success()
    {
        //$carted  = $this->cart->contents();
        $invoice_id = $this->session->userdata('invoice_id');

        //$this->crud_model->email_invoice($sale_id);
        $this->session->set_userdata('invoice_id', '');
        redirect(base_url() . 'admin/vendor/', 'refresh');
    }


    /* Pay to Vendor from Admin  */

    function pay_to_vendor($para1='',$para2=''){
        if (!$this->crud_model->admin_permission('pay_to_vendor')) {
            redirect(base_url() . 'admin');
        }
        if($para1 == 'list'){
            $this->db->order_by('vendor_invoice_id', 'desc');
            $page_data['vendor_payments'] = $this->db->get('vendor_invoice')->result_array();
            $this->load->view('back/admin/pay_to_vendor_list', $page_data);
        }
        else if($para1 == 'delete'){
            if(!demo()){
                $this->db->where('vendor_invoice_id',$para2);
                $this->db->delete('vendor_invoice');
            }
            //echo $this->db->last_query();
        }
        elseif ($para1 == 'vendor_payment_status') {
            $page_data['vendor_invoice_id']         = $para2;
            $page_data['method']    = $this->db->get_where('vendor_invoice', array(
                'vendor_invoice_id' => $para2))->row()->method;
            $page_data['payment_details'] = $this->db->get_where('vendor_invoice', array(
                'vendor_invoice_id' => $para2
            ))->row()->payment_details;
            $page_data['status'] =  $this->db->get_where('vendor_invoice',array('vendor_invoice_id' => $para2))->row()->status;

            $this->load->view('back/admin/pay_to_vendor_payment_status', $page_data);
        }
        elseif($para1 == 'payment_status_set'){
            $data['status'] = $this->input->post('vendor_payment_status');
            $this->db->where('vendor_invoice_id',$para2);
            $this->db->update('vendor_invoice',$data);
        }
        else{
            $page_data['page_name'] = "pay_to_vendor";
            $page_data['vendor_payments'] = $this->db->get('vendor_invoice')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Membership Management */
    function membership($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('membership') || $this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['title']    = $this->input->post('title');
            $data['price']    = $this->input->post('price');
            $data['timespan']    = $this->input->post('timespan');
            $data['product_limit']    = $this->input->post('product_limit');
            $data['mcat']    = $this->input->post('mcat');
            $data['discount']    = $this->input->post('discount');
            $data['stripe_id']    = $this->input->post('stripe_id');
            $data['stripe_live_id']    = $this->input->post('stripe_live_id');
            $data['promo_code']    = $this->input->post('promo_code');
            $data['promo_limit']    = $this->input->post('promo_limit');
            $this->db->insert('membership', $data);
            $id = $this->db->insert_id();
            if(!demo()){
                $this->crud_model->file_up("img", "membership", $id, '', '', '.png');
            }
        } else if ($para1 == 'edit') {
            $page_data['membership_data'] = $this->db->get_where('membership', array(
                'membership_id' => $para2
            ))->result_array();
             $page_data['category'] = $this->db->get('member_cat')->result_array();
            $this->load->view('back/admin/membership_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['title']    = $this->input->post('title');
            $data['price']    = $this->input->post('price');
            $data['timespan']    = $this->input->post('timespan');
            $data['product_limit']    = $this->input->post('product_limit');
            $data['discount']    = $this->input->post('discount');
            $data['stripe_id']    = $this->input->post('stripe_id');
            $data['stripe_live_id']    = $this->input->post('stripe_live_id');
            $data['promo_code']    = $this->input->post('promo_code');
            $data['promo_limit']    = $this->input->post('promo_limit');
            $data['mcat']    = $this->input->post('mcat');
            $this->db->where('membership_id', $para2);
            $this->db->update('membership', $data);
            if(!demo()){
                $this->crud_model->file_up("img", "membership", $para2, '', '', '.png');
            }
        } elseif ($para1 == "default_set") {
            $this->db->where('type', "default_member_product_limit");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('product_limit')
            ));
            if(!demo()){
                $this->crud_model->file_up("img", "membership", 0, '', '', '.png');
            }
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('membership_id', $para2);
                $this->db->delete('membership');
            }

        } elseif ($para1 == 'list') {
            $this->db->select('*');
            $this->db->from('membership');
            $this->db->join('member_cat','member_cat.id = membership.mcat');
            $this->db->order_by('membership_id', 'desc');
            $page_data['all_memberships'] = $this->db->get()->result_array();
            $this->load->view('back/admin/membership_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['membership_data'] = $this->db->get_where('membership', array(
                'membership_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/membership_view', $page_data);
        } elseif ($para1 == 'add') {
            $page_data['category'] = $this->db->get('member_cat')->result_array();
            $this->load->view('back/admin/membership_add', $page_data);
        } elseif ($para1 == 'default') {
            $this->load->view('back/admin/membership_default');
        } elseif ($para1 == 'publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'approved';
            } else {
                $data['status'] = 'pending';
            }
            $this->db->where('membership_id', $product);
            $this->db->update('membership', $data);
        } else {
            $page_data['page_name'] = "membership";
            $page_data['all_memberships'] = $this->db->get('membership')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Vendor Commission */
    function vendor_commission(){
        if (!$this->crud_model->admin_permission('vendor')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "vendor_commission";
        $this->load->view('back/index', $page_data);
    }

    function set_commission($para1 = '', $para2 = '',$para3 = '',$para4 = '')
    {
        if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "commission_amount");
        $this->db->update('business_settings', array(
            'value' => $this->input->post('vendor_commission')
        ));
        recache();

    }

    /* Administrator Management */
    function admins($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('admin')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name']      = $this->input->post('name');
            $data['email']     = $this->input->post('email');
            $password          = $this->input->post('password');
            $data['password']  = sha1($password);
            $data['phone']     = $this->input->post('phone');
            $data['address']   = $this->input->post('address');
            $data['role']      = $this->input->post('role');
            $data['timestamp'] = time();
            $this->db->insert('admin', $data);
            $this->email_model->account_opening('admin', $data['email'], $password);
        } else if ($para1 == 'edit') {
            $page_data['admin_data'] = $this->db->get_where('admin', array(
                'admin_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/admin_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name']    = $this->input->post('name');
            $password          = $this->input->post('password');

            if(!demo()){
                $data['password']  = sha1($password);
            }

            $data['phone']   = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['role']    = $this->input->post('role');
            $this->db->where('admin_id', $para2);
            $this->db->update('admin', $data);
            $this->email_model->account_opening('admin', $data['email'], $password);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('admin_id', $para2);
                $this->db->delete('admin');
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('admin_id', 'desc');
            $page_data['all_admins'] = $this->db->get('admin')->result_array();
            $this->load->view('back/admin/admin_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['admin_data'] = $this->db->get_where('admin', array(
                'admin_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/admin_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/admin_add');
        } else {
            $page_data['page_name']  = "admin";
            $page_data['all_admins'] = $this->db->get('admin')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Account Role Management */
    function role($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('role')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $data['name']        = $this->input->post('name');
            $data['permission']  = json_encode($this->input->post('permission'));
            $data['description'] = $this->input->post('description');
            $this->db->insert('role', $data);
        } elseif ($para1 == "update") {
            $data['name']        = $this->input->post('name');
            $data['permission']  = json_encode($this->input->post('permission'));
            $data['description'] = $this->input->post('description');
            $this->db->where('role_id', $para2);
            $this->db->update('role', $data);
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('role_id', $para2);
                $this->db->delete('role');
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('role_id', 'desc');
            $page_data['all_roles'] = $this->db->get('role')->result_array();
            $this->load->view('back/admin/role_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['role_data'] = $this->db->get_where('role', array(
                'role_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/role_view', $page_data);
        } elseif ($para1 == 'add') {
            $page_data['all_permissions'] = $this->db->get('permission')->result_array();
            $this->load->view('back/admin/role_add', $page_data);
        } else if ($para1 == 'edit') {
            $page_data['all_permissions'] = $this->db->get('permission')->result_array();
            $page_data['role_data']       = $this->db->get_where('role', array(
                'role_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/role_edit', $page_data);
        } else {
            $page_data['page_name'] = "role";
            $page_data['all_roles'] = $this->db->get('role')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }


    /* Checking if email exists*/
    function load_dropzone()
    {
        $this->load->view('back/admin/dropzone');
    }

    /* Checking if email exists*/
    function exists()
    {
        $email  = $this->input->post('email');
        $admin  = $this->db->get('admin')->result_array();
        $exists = 'no';
        foreach ($admin as $row) {
            if ($row['email'] == $email) {
                $exists = 'yes';
            }
        }
        echo $exists;
    }

    /* Login into Admin panel */
    function login($para1 = '')
    {
        if ($para1 == 'forget_form') {
            $page_data['control'] = 'admin';
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

                $query = $this->db->get_where('admin', array(
                    'email' => $this->input->post('email')
                ));
                if ($query->num_rows() > 0) {
                    $admin_id         = $query->row()->admin_id;
                    $password         = substr(hash('sha512', rand()), 0, 12);

                    $data['password'] = sha1($password);
                    $this->db->where('admin_id', $admin_id);
                    $this->db->update('admin', $data);
                    if ($this->email_model->password_reset_email('admin', $admin_id, $password)) {
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
                $login_data = $this->db->get_where('admin', array(
                    'email' => $this->input->post('email'),
                    'password' => sha1($this->input->post('password'))
                ));
                if ($login_data->num_rows() > 0) {
                    foreach ($login_data->result_array() as $row) {
                        $this->session->set_userdata('login', 'yes');
                        $this->session->set_userdata('admin_login', 'yes');
                        $this->session->set_userdata('admin_id', $row['admin_id']);
                        $this->session->set_userdata('admin_name', $row['name']);
                        $this->session->set_userdata('title', 'admin');
                        echo 'lets_login';
                    }
                } else {
                    echo 'login_failed';
                }
            }
        }
    }

    /* Loging out from Admin panel */
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'admin', 'refresh');
    }

    /* Sending Newsletters */
    function newsletter($para1 = "")
    {
        if (!$this->crud_model->admin_permission('newsletter')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "send") {
            $users       = explode(',', $this->input->post('users'));
            $subscribers = explode(',', $this->input->post('subscribers'));
            $text        = $this->input->post('text');
            $title       = $this->input->post('title');
            $from        = $this->input->post('from');
            foreach ($users as $key => $user) {
                if ($user !== '') {
                    $this->email_model->newsletter($title, $text, $user, $from);
                }
            }
            foreach ($subscribers as $key => $subscriber) {
                if ($subscriber !== '') {
                    $this->email_model->newsletter($title, $text, $subscriber, $from);
                }
            }
        } else {
            $page_data['users']       = $this->db->get('user')->result_array();
            $page_data['subscribers'] = $this->db->get('subscribe')->result_array();
            $page_data['page_name']   = "newsletter";
            $this->load->view('back/index', $page_data);
        }
    }

    /* Add, Edit, Delete, Duplicate, Enable, Disable Sliders */
    function slider($para1 = '', $para2 = '', $para3 = '')
    {
        if ($para1 == 'list') {
            $this->db->order_by('slider_id', 'desc');
            $page_data['all_slider'] = $this->db->get('slider')->result_array();
            $this->load->view('back/admin/slider_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/slider_set');
        } elseif ($para1 == 'add_form') {
            $page_data['style_id'] = $para2;
            $page_data['style']    = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $para2
            ))->row()->value, true);
            $this->load->view('back/admin/slider_add_form', $page_data);
        } else if ($para1 == 'delete') { //ll
            if(!demo()){
                $elements = json_decode($this->db->get_where('slider', array(
                    'slider_id' => $para2
                ))->row()->elements, true);
                $style    = $this->db->get_where('slider', array(
                    'slider_id' => $para2
                ))->row()->style;
                $style    = json_decode($this->db->get_where('slider_style', array(
                    'slider_style_id' => $style
                ))->row()->value, true);
                $images   = $style['images'];
                if (file_exists('uploads/slider_image/background_' . $para2 . '.jpg')) {
                    unlink('uploads/slider_image/background_' . $para2 . '.jpg');
                }
                foreach ($images as $row) {
                    if (file_exists('uploads/slider_image/' . $para2 . '_' . $row . '.png')) {
                        unlink('uploads/slider_image/' . $para2 . '_' . $row . '.png');
                    }
                }
                $this->db->where('slider_id', $para2);
                $this->db->delete('slider');
                recache();
            }

        } else if ($para1 == 'serial') {
            $this->db->order_by('serial', 'desc');
            $this->db->order_by('slider_id', 'desc');
            $page_data['slider'] = $this->db->get_where('slider', array(
                'status' => 'ok'
            ))->result_array();
            $this->load->view('back/admin/slider_serial', $page_data);
        } else if ($para1 == 'do_serial') {
            $input  = json_decode($this->input->post('serial'), true);
            $serial = array();
            foreach ($input as $r) {
                $serial[] = $r['id'];
            }
            $serial  = array_reverse($serial);
            $sliders = $this->db->get('slider')->result_array();
            foreach ($sliders as $row) {
                $data['serial'] = 0;
                $this->db->where('slider_id', $row['slider_id']);
                $this->db->update('slider', $data);
            }
            foreach ($serial as $i => $row) {
                $data1['serial'] = $i + 1;
                $this->db->where('slider_id', $row);
                $this->db->update('slider', $data1);
            }
            recache();
        } else if ($para1 == 'slider_publish_set') {
            $slider = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
                $data['serial'] = 0;
            }
            $this->db->where('slider_id', $slider);
            $this->db->update('slider', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['slider_data'] = $this->db->get_where('slider', array(
                'slider_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/slider_edit_form', $page_data);
        } elseif ($para1 == 'create') {
            $data['style']  = $this->input->post('style_id');
            $data['title']  = $this->input->post('title');
            $data['serial'] = 0;
            $data['status'] = 'ok';
            $style          = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $data['style']
            ))->row()->value, true);
            $images         = array();
            $texts          = array();
            foreach ($style['images'] as $image) {
                if ($_FILES[$image['name']]['name']) {
                    $images[] = $image['name'];
                }
            }
            foreach ($style['texts'] as $text) {
                if ($this->input->post($text['name']) !== '') {
                    $texts[] = array(
                        'name' => $text['name'],
                        'text' => $this->input->post($text['name']),
                        'color' => $this->input->post($text['name'] . '_color'),
                        'background' => $this->input->post($text['name'] . '_background')
                    );
                }
            }
            $elements         = array(
                'images' => $images,
                'texts' => $texts
            );
            $data['elements'] = demo() ? json_encode(array()) : json_encode($elements);
            $this->db->insert('slider', $data);
            $id = $this->db->insert_id();

            if(!demo()){
                move_uploaded_file($_FILES['background']['tmp_name'], 'uploads/slider_image/background_' . $id . '.jpg');
                foreach ($elements['images'] as $image) {
                    move_uploaded_file($_FILES[$image]['tmp_name'], 'uploads/slider_image/' . $id . '_' . $image . '.png');
                }
            }
            recache();
        } elseif ($para1 == 'update') {
            $data['style'] = $this->input->post('style_id');
            $data['title'] = $this->input->post('title');
            $style         = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $data['style']
            ))->row()->value, true);
            $images        = array();
            $texts         = array();
            foreach ($style['images'] as $image) {
                if ($_FILES[$image['name']]['name'] || $this->input->post($image['name'] . '_same') == 'same') {
                    $images[] = $image['name'];
                }
            }
            foreach ($style['texts'] as $text) {
                if ($this->input->post($text['name']) !== '') {
                    $texts[] = array(
                        'name' => $text['name'],
                        'text' => $this->input->post($text['name']),
                        'color' => $this->input->post($text['name'] . '_color'),
                        'background' => $this->input->post($text['name'] . '_background')
                    );
                }
            }
            $elements         = array(
                'images' => $images,
                'texts' => $texts
            );
            $data['elements'] = demo() ? json_encode(array()) :  json_encode($elements);
            $this->db->where('slider_id', $para2);
            $this->db->update('slider', $data);

            if(!demo()){
                move_uploaded_file($_FILES['background']['tmp_name'], 'uploads/slider_image/background_' . $para2 . '.jpg');
                foreach ($elements['images'] as $image) {
                    move_uploaded_file($_FILES[$image]['tmp_name'], 'uploads/slider_image/' . $para2 . '_' . $image . '.png');
                }
            }

            recache();
        } else {
            $page_data['page_name'] = "slider";
            $this->load->view('back/index', $page_data);
        }
    }

    function activation(){
        if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "activation";
        $this->load->view('back/index', $page_data);
    }

    function faqs(){
        if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "faq_settings";
        $this->load->view('back/index', $page_data);
    }

    function payment_method(){
        if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "payment_method";
        $this->load->view('back/index', $page_data);
    }

    function curency_method(){
        if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "curency_method";
        $this->load->view('back/index', $page_data);
    }

    /* Manage Frontend User Interface */
    function set_def_curr($para1 = '', $para2 = '',$para3 = '',$para4 = '')
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if($para1 == 'home'){
            $this->db->where('type', "home_def_currency");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('home_def_currency')
            ));
        }
        if($para1 == 'system'){
            $this->db->where('type', "currency");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('currency')
            ));

            $this->db->where('currency_settings_id', $this->input->post('currency'));
            $this->db->update('currency_settings', array(
                'exchange_rate_def' => '1'
            ));
        }
        recache();

    }


    /* Manage Frontend User Interface */
     function ui_settings($para1 = '', $para2 = '',$para3 = '',$para4 = '')
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "ui_home") {
            if ($para2 == 'update_home_page' && $this->input->post('home_page')) {
                $this->db->where('type', "home_page_style");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('home_page')
                ));
                recache();
            }
            elseif ($para2 == 'home_vendor') {
                if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
                    redirect(base_url() . 'admin');
                }
                $this->db->where('type', "parallax_vendor_title");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('pv_title')
                ));
                $this->db->where('type', "no_of_vendor");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('vendor_no')
                ));
                if($_FILES["par"]['tmp_name']){
                    if(!demo()){
                        move_uploaded_file($_FILES["par"]['tmp_name'], 'uploads/others/parralax_vendor.jpg');
                    }
                }
                recache();
            }
            elseif ($para2 == 'home_search') {
                $this->db->where('type', "parallax_search_title");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('ps_title')
                ));
                if($_FILES["par3"]['tmp_name']){
                    if(!demo()){
                        move_uploaded_file($_FILES["par3"]['tmp_name'], 'uploads/others/parralax_search.jpg');
                    }
                }
                recache();
            }
            elseif ($para2 == 'digital_services') {

                $this->load->library('cloudinarylib');
                if($_FILES["par3"]['tmp_name']){
                    if(!demo()){
                        $path = 'uploads/others/digital_services_img.jpg';
                        move_uploaded_file($_FILES["par3"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
                                            if(isset($data['public_id']))
                                            {
                                                $logo_id = $this->crud_model->add_img($path,$data);
                                                if($logo_id)
                                                {
                                                    $this->db->where('type', "digital_services_img");
                            $this->db->update('ui_settings', array(
                                'value' => $logo_id
                            ));

                                               }
                                            }
                        //top_banner
                    }
                }
                recache();
            }
            elseif ($para2 == 'advertise_section') {

                $this->load->library('cloudinarylib');
                if($_FILES["par3"]['tmp_name']){
                    if(!demo()){
                        $path = 'uploads/others/advertise_section_img.jpg';
                        move_uploaded_file($_FILES["par3"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
                                            if(isset($data['public_id']))
                                            {
                                                $logo_id = $this->crud_model->add_img($path,$data);
                                                if($logo_id)
                                                {
                                                    $this->db->where('type', "advertise_section_img");
                            $this->db->update('ui_settings', array(
                                'value' => $logo_id
                            ));

                                               }
                                            }
                        //top_banner
                    }
                }
                recache();
            }
            elseif ($para2 == 'wave_section') {
                if($_REQUEST['wave_heading'])
                {
                    $this->db->where('type', "wave_heading");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('wave_heading')
                    ));
                }
                if($_REQUEST['wave_paragaph'])
                {
                    $this->db->where('type', "wave_paragaph");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('wave_paragaph')
                    ));
                }
                if($_REQUEST['section_bullets'])
                {
                    $this->db->where('type', "section_bullets");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('section_bullets')
                    ));
                }

                $this->load->library('cloudinarylib');
                if($_FILES["par3"]['tmp_name']){
                    if(!demo()){
                        $path = 'uploads/others/wave_section_img.jpg';
                        move_uploaded_file($_FILES["par3"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
                                            if(isset($data['public_id']))
                                            {
                                                $logo_id = $this->crud_model->add_img($path,$data);
                                                if($logo_id)
                                                {
                                                    $this->db->where('type', "wave_section_img");
                            $this->db->update('ui_settings', array(
                                'value' => $logo_id
                            ));

                                               }
                                            }
                        //top_banner
                    }
                }
                recache();
            }
            elseif ($para2 == 'last_section') {
                if($_REQUEST['last_heading'])
                {
                    $this->db->where('type', "last_heading");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('last_heading')
                    ));
                }
                if($_REQUEST['last_paragaph'])
                {
                    $this->db->where('type', "last_paragaph");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('last_paragaph')
                    ));
                }
                if($_REQUEST['last_info'])
                {
                    $this->db->where('type', "last_info");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('last_info')
                    ));
                }
                if($_REQUEST['last_bullets'])
                {
                    $this->db->where('type', "last_bullets");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('last_bullets')
                    ));
                }
                if($_REQUEST['last_button_text'])
                {
                    $this->db->where('type', "last_button_text");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('last_button_text')
                    ));
                }
                if($_REQUEST['last_button_url'])
                {
                    $this->db->where('type', "last_button_url");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('last_button_url')
                    ));
                }
                $this->load->library('cloudinarylib');
                if($_FILES["par3"]['tmp_name']){
                    if(!demo()){
                        $path = 'uploads/others/wave_section_img.jpg';
                        move_uploaded_file($_FILES["par3"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
                                            if(isset($data['public_id']))
                                            {
                                                $logo_id = $this->crud_model->add_img($path,$data);
                                                if($logo_id)
                                                {
                                                    $this->db->where('type', "last_image");
                            $this->db->update('ui_settings', array(
                                'value' => $logo_id
                            ));

                                               }
                                            }
                        //top_banner
                    }
                }
                recache();
            }
            elseif ($para2 == 'info_section') {
                if($_REQUEST['infosmall_heading'])
                {
                    $this->db->where('type', "infosmall_heading");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('infosmall_heading')
                    ));
                }
                if($_REQUEST['infomain_heading'])
                {
                    $this->db->where('type', "infomain_heading");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('infomain_heading')
                    ));
                }
                if($_REQUEST['info_paragaph'])
                {
                    $this->db->where('type', "info_paragaph");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('info_paragaph')
                    ));
                }
                if($_REQUEST['info_bullets'])
                {

                    $this->db->where('type', "info_bullets");
                    $r = $this->db->update('ui_settings', array(
                        'value' => $this->input->post('info_bullets')
                    ));

                }
                 if($_REQUEST['buttons'])
                {
                    $this->db->where('type', "sectoion_btns");
                    $this->db->update('ui_settings', array(
                        'value' => json_encode($this->input->post('buttons'))
                    ));
                }
            }
            elseif ($para2 == 'home_blog') {
                $this->db->where('type', "parallax_blog_title");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('pb_title')
                ));
                $this->db->where('type', "no_of_blog");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('blog_no')
                ));
                if($_FILES["par2"]['tmp_name']){
                    move_uploaded_file($_FILES["par2"]['tmp_name'], 'uploads/others/parralax_blog.jpg');
                }
                recache();
            }
            elseif ($para2 == 'top_slide_categories') {
                $this->db->where('type', "top_slide_categories");
                $this->db->update('ui_settings', array(
                    'value' => json_encode($this->input->post('top_category'))
                ));
                //signup_category
                $this->db->where('type', "signup_category");
                $this->db->update('ui_settings', array(
                    'value' => json_encode($this->input->post('signup_category'))
                ));

                $this->db->where('type', "no_of_todays_deal");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('deal_no')
                ));
                $this->load->library('cloudinarylib');
                if($_FILES["par3"]['tmp_name']){
                    if(!demo()){
                        $path = 'uploads/others/parralax_search.jpg';
                        $r = move_uploaded_file($_FILES["par3"]['tmp_name'], $path);
                        $data = \Cloudinary\Uploader::upload($path);
                                            if(isset($data['public_id']))
                                            {
                                                $logo_id = $this->crud_model->add_img($path,$data);
                                                if($logo_id)
                                                {
                                                    $this->db->where('type', "top_banner");
                            $this->db->update('ui_settings', array(
                                'value' => $logo_id
                            ));

                                               }
                                            }
                        //top_banner
                    }
                }
                recache();
            }
            elseif ($para2 == 'home_brand') {
                $this->db->where('type', "no_of_brands");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('brand_no')
                ));
                recache();
            }
            elseif ($para2 == 'todays_deal') {
                $this->db->where('type', "no_of_deal_products");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('flash_no')
                ));

                $this->db->where('type', "todays_deal_product_box_style");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('deal_pro_box')
                ));
                recache();
            }
            elseif ($para2 == 'home_featured') {
                if($_REQUEST['section2_heading'])
                {
                    $this->db->where('type', "section2_heading");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('section2_heading')
                    ));
                }
                if($_REQUEST['box'])
                {

                    $this->db->where('type', "section2_box");
                    $this->db->update('ui_settings', array(
                        'value' => serialize($_REQUEST['box'])
                    ));
                }
                if($_REQUEST['section2_paragaph'])
                {
                    $this->db->where('type', "section2_paragaph");
                    $this->db->update('ui_settings', array(
                        'value' => $this->input->post('section2_paragaph')
                    ));
                }
                recache();
            }
            elseif ($para2 == 'product_bundle') {
                $this->db->where('type', "no_of_product_bundle");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('bundle_no')
                ));

                $this->db->where('type', "product_bundle_box_style");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('fea_pro_box')
                ));
                recache();
            }
            elseif ($para2 == 'customer_product') {
                $this->db->where('type', "no_of_customer_product");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('customer_product_no')
                ));
                recache();
            }
            else if ($para2 == 'feature_publish_set') {
                if ($para4 == 'true') {
                    $data['value'] = 'ok';
                } else if ($para4 == 'false') {
                    $data['value'] = 'no';
                }
                $this->db->where('ui_settings_id', $para3);
                $this->db->update('ui_settings', $data);
                recache();
            }
            else if ($para2 == 'product_bundle_publish_set') {
                if ($para4 == 'true') {
                    $data['value'] = 'ok';
                } else if ($para4 == 'false') {
                    $data['value'] = 'no';
                }
                $this->db->where('ui_settings_id', $para3);
                $this->db->update('ui_settings', $data);
                recache();
            }
            else if ($para2 == 'customer_product_publish_set') {
                if ($para4 == 'true') {
                    $data['value'] = 'ok';
                } else if ($para4 == 'false') {
                    $data['value'] = 'no';
                }
                $this->db->where('ui_settings_id', $para3);
                $this->db->update('ui_settings', $data);
                recache();
            }
            else if ($para2 == '_set') {
                if ($para4 == 'true') {
                    $data['value'] = 'ok';
                } else if ($para4 == 'false') {
                    $data['value'] = 'no';
                }
                $this->db->where('ui_settings_id', $para3);
                $this->db->update('ui_settings', $data);
                recache();
            }
            elseif ($para2 == 'home1_category') {
                $category = $this->input->post('category');
                $sub_category = $this->input->post('sub_category');
                $color_back = $this->input->post('color1');
                $color_text = $this->input->post('color2');
                $result= array();
                foreach($category as $i=>$row){
                    $result[] = array(
                                    'category' => $row,
                                    'sub_category' => $sub_category[$row],
                                    'color_back' => $color_back[$row],
                                    'color_text' => $color_text[$row]
                                );
                }
                $data['value'] = json_encode($result);
                $this->db->where('type', 'home_categories');
                $this->db->update('ui_settings', $data);

                $this->db->where('type', "category_product_box_style");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('box_style')
                ));
                recache();
            }
            elseif ($para2 == 'home2_category') {
                //$box = $this->input->post('box');
                $category = $this->input->post('category');
                $sub_category = $this->input->post('sub_category');
                $color_back = $this->input->post('color1');
                $color_text = $this->input->post('color2');
                $result= array();
                foreach($category as $i=>$row){
                    $result[] = array(
                                    //'no'  =>$row,
                                    'category' => $row,
                                    'sub_category' => $sub_category[$row],
                                    'color_back' => $color_back[$row],
                                    'color_text' => $color_text[$row]
                                );
                }
                $data['value'] = json_encode($result);
                $this->db->where('type', 'home_categories');
                $this->db->update('ui_settings', $data);
                recache();
            }
            elseif ($para2 == 'home3_category') {
                //$box = $this->input->post('box');
                $category = $this->input->post('category');
                $sub_category = $this->input->post('sub_category');
                $color_back = $this->input->post('color1');
                $color_text = $this->input->post('color2');
                $result= array();
                foreach($category as $i=>$row){
                    $result[] = array(
                                    //'no'  =>$row,
                                    'category' => $row,
                                    'sub_category' => $sub_category[$row],
                                    'color_back' => $color_back[$row],
                                    'color_text' => $color_text[$row]
                                );
                }
                $data['value'] = json_encode($result);
                $this->db->where('type', 'home3_categories');
                $this->db->update('ui_settings', $data);
                recache();
            }
            elseif ($para2 == 'cat_colors') {
                var_dump($para3);
            }
        }
        elseif ($para1 == 'email_theme') {
            $this->db->where('type', "email_theme_style");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('email_theme')
            ));
            recache();
        }
        elseif ($para1 == "ui_category") {
            if ($para2 == 'update') {
                $this->db->where('type', "side_bar_pos_category");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('side_bar_pos')
                ));
                recache();
            }
        }
        elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category','sub-category','sub_category_name','add','demo-cs-multiselect','','category',$para2,'check_sub_length');
        }
        //$this->load->view('back/index', $page_data);
        if ($para1 == "set_homepage") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_homepage_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_all_categories") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_all_categories_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_featured_products") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_featured_products_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_todays_deal") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_todays_deal_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_bundled_product") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_bundled_product_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_classifieds") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_classifieds_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_latest_products") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_latest_products_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_all_brands") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_all_brands_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_all_vendors") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_all_vendors_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_blogs") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_blogs_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_store_locator") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_store_locator_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_contact") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_contact_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_more") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'yes';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "header_more_status");
            $this->db->update('ui_settings', array(
                'value' => $val
            ));
        }
    }


    /* Checking Login Stat */
    function is_logged()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            echo 'yah!good';
        } else {
            echo 'nope!bad';
        }
    }

    /* Manage Frontend User Interface */
    function page_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "page_settings";
        $page_data['tab_name']  = $para1;
        $this->load->view('back/index', $page_data);
    }

    /* Manage Frontend User Messages */
    function contact_message($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('contact_message')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('contact_message_id', $para2);
                $this->db->delete('contact_message');
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('contact_message_id', 'desc');
            $page_data['contact_messages'] = $this->db->get('contact_message')->result_array();
            $this->load->view('back/admin/contact_message_list', $page_data);
        } elseif ($para1 == 'reply') {
            $data['reply'] = $this->input->post('reply');
            $this->db->where('contact_message_id', $para2);
            $this->db->update('contact_message', $data);
            $this->db->order_by('contact_message_id', 'desc');
            $query = $this->db->get_where('contact_message', array(
                'contact_message_id' => $para2
            ))->row();
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
            $this->email_model->do_email($from,$from_name,$query->email, 'RE: ' . $query->subject,$data['reply'] );
        } elseif ($para1 == 'view') {
            $page_data['message_data'] = $this->db->get_where('contact_message', array(
                'contact_message_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/contact_message_view', $page_data);
        } elseif ($para1 == 'reply_form') {
            $page_data['message_data'] = $this->db->get_where('contact_message', array(
                'contact_message_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/contact_message_reply', $page_data);
        } else {
            $page_data['page_name']        = "contact_message";
            $page_data['contact_messages'] = $this->db->get('contact_message')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Manage Logos */
    function logo_settings($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "select_logo") {
            $page_data['page_name'] = "select_logo";
        } elseif ($para1 == "delete_logo") {
            if(!demo()){
                if (file_exists("uploads/logo_image/logo_" . $para2 . ".png")) {
                    unlink("uploads/logo_image/logo_" . $para2 . ".png");
                }
                $this->db->where('logo_id', $para2);
                $this->db->delete('logo');
                recache();
            }
        } elseif ($para1 == "set_logo") {

            $type    = $this->input->post('type');
            $logo_id = $this->input->post('logo_id');
            $this->db->where('type', $type);
            $this->db->update('ui_settings', array(
                'value' => $logo_id
            ));
            recache();
        } elseif ($para1 == "show_all") {
            $page_data['logo'] = $this->db->get('logo')->result_array();
            if ($para2 == "") {
                $this->load->view('back/admin/all_logo', $page_data);
            }
            if ($para2 == "selectable") {
                $page_data['logo_type'] = $para3;
                $this->load->view('back/admin/select_logo', $page_data);
            }
        } elseif ($para1 == "upload_logo") {
            foreach ($_FILES["file"]['name'] as $i => $row) {
                $data['name'] = '';
                $this->db->insert("logo", $data);
                $id = $this->db->insert_id();
                if(!demo()){
                    move_uploaded_file($_FILES["file"]['tmp_name'][$i], 'uploads/logo_image/logo_' . $id . '.png');
                }
            }
            return;
        } elseif ($para1 == "upload_logo1") {
                $data['name'] = '';
                $this->db->insert("logo", $data);
                $id = $this->db->insert_id();
                echo $_FILES["logo"]['name'];
                if(!demo()){
                    move_uploaded_file($_FILES["logo"]['tmp_name'], 'uploads/logo_image/logo_' . $id . '.png');
                }

        }else {
            $this->load->view('back/index', $page_data);
        }
    }

    /* Manage Favicons */
    function favicon_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $name = $_FILES['img']['name'];
        $ext  = end((explode(".", $name)));
        $this->db->where('type', 'fav_ext');
        $this->db->update('ui_settings', array(
            'value' =>$ext
        ));
        if(!demo()){
            move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/others/favicon.'.$ext);
        }
        recache();
    }

    /* Manage Frontend Facebook Login Credentials */
    function social_login_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "fb_login_set");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('fb-check')
        ));
         $this->db->where('type', "g_login_set");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('g-check')
        ));
        $this->db->where('type', "fb_appid");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('appid')
        ));
        $this->db->where('type', "fb_secret");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('secret')
        ));
        $this->db->where('type', "application_name");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('application_name')
        ));
        $this->db->where('type', "client_id");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('client_id')
        ));
        $this->db->where('type', "client_secret");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('client_secret')
        ));
        $this->db->where('type', "redirect_uri");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('redirect_uri')
        ));
        $this->db->where('type', "api_key");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('api_key')
        ));
    }

    /* Manage Frontend Facebook Login Credentials */
    function product_comment($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "discus_id");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('discus_id')
        ));
        $this->db->where('type', "comment_type");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('type')
        ));
        $this->db->where('type', "fb_comment_api");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('fb_comment_api')
        ));
    }

   /* Manage Frontend Captcha Settings Credentials */
    function captcha_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "captcha_public");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('cpub')
        ));
        $this->db->where('type', "captcha_private");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('cprv')
        ));
    }

    function facebook_pixel_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "facebook_pixel_id");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('facebook_pixel_id')
        ));
    }

    function facebook_chat_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "facebook_chat_page_id");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('facebook_chat_page_id')
        ));

        $this->db->where('type', "facebook_chat_logged_in_greeting");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('facebook_chat_logged_in_greeting')
        ));

        $this->db->where('type', "facebook_chat_logged_out_greeting");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('facebook_chat_logged_out_greeting')
        ));

        $this->db->where('type', "facebook_chat_theme_color");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('facebook_chat_theme_color')
        ));
    }

    /* Manage Site Settings */
    function site_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "site_settings";
        $page_data['tab_name']  = $para1;
        $this->load->view('back/index', $page_data);
    }

    /* Manage Email Template */
    function email_template($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('email_template')) {
            redirect(base_url() . 'admin');
        }

        if($para1 = "update"){
            $data['subject'] = $this->input->post('subject');
            $data['body'] = $this->input->post('body');

            $this->db->where('email_template_id', $para2);
            $this->db->update('email_template', $data);
        }
        $page_data['page_name'] = "email_template";
        $page_data['table_info']  = $this->db->get('email_template')->result_array();;
        $this->load->view('back/index', $page_data);
    }

    /* Manage Languages */
    function language_settings($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->admin_permission('language')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'add_lang') {
            $this->load->view('back/admin/language_add');
        } elseif ($para1 == 'edit_lang') {
            $page_data['lang_data'] = $this->db->get_where('language_list',array('language_list_id'=>$para2))->result_array();
            $this->load->view('back/admin/language_edit',$page_data);
        } elseif ($para1 == 'lang_list') {
            //if($para2 !== ''){
            $this->db->order_by('word_id', 'desc');
            $page_data['words'] = $this->db->get('language')->result_array();
            $page_data['lang']  = $para2;
            $this->load->view('back/admin/language_list', $page_data);
            //}
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('word', $search, 'both');
            }
            $total      = $this->db->get('language')->num_rows();
            $this->db->limit($limit);
            if($sort == ''){
                $sort = 'word_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort,$order);
            if($search){
                $this->db->like('word', $search, 'both');
            }
            $lang       = $para2;
            if ($lang == 'undefined' || $lang == '') {
                if ($lang = $this->session->userdata('language')) {
                } else {
                    $lang = $this->db->get_where('general_settings', array(
                        'type' => 'language'
                    ))->row()->value;
                }
            }
            $words      = $this->db->get('language', $limit, $offset)->result_array();
            $data       = array();
            foreach ($words as $row) {

                $res    = array(
                             'no' => '',
                             'word' => '',
                             'translation' => '',
                             'options' => ''
                          );

                $res['no']  = $row['word_id'];
                $res['word']  = '<div class="col-md-12 abv">'.ucwords(str_replace('_', ' ', $row['word'])).'</div>';
                $res['translation']  =   form_open(base_url() . 'admin/language_settings/upd_trn/'.$row['word_id'], array(
                                            'class' => 'form-horizontal trs',
                                            'method' => 'post',
                                            'id' => $lang.'_'.$row['word_id']
                                        ));
                $res['translation']  .=      '   <div class="col-md-8">';
                $res['translation']  .=      '      <input type="text" name="translation" value="'.$row[$lang].'" class ="form-control ann" />';
                $res['translation']  .=      '      <input type="hidden" name="lang" value="'.$lang.'" />';
                $res['translation']  .=      '   </div>';
                $res['translation']  .=      '   <div class="col-md-4">';
                $res['translation']  .=      '       <span class="btn btn-success btn-xs btn-labeled fa fa-wrench submittera" data-wid="'.$lang.'_'.$row['word_id'].'"  data-ing="'.translate('saving').'" data-msg="'.translate('updated!').'" >'.translate('save').'</span>';
                $res['translation']  .=      '   </div>';
                $res['translation']  .=      '</form>';

                //add html for action
                $res['options'] = "<a onclick=\"delete_confirm('".$row['word_id']."','".translate('really_want_to_delete_this_word?')."')\"
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

        } elseif ($para1 == 'upd_trn') {
            $word_id     = $para2;
            $translation = $this->input->post('translation');
            $language    = $this->input->post('lang');
            $word        = $this->db->get_where('language', array(
                'word_id' => $word_id
            ))->row()->word;
            add_translation($word, $language, $translation);
            recache();
        } elseif ($para1 == 'do_add_lang') {
            $data['name']   = $this->input->post('language');
            $this->db->insert('language_list',$data);

            $id             = $this->db->insert_id();
            if(!demo()){
                $this->crud_model->file_up("icon", "language_list", $id, '', '', '.jpg');
            }

            $language       = 'lang_'.$id;

            $this->db->where('language_list_id', $id);
            $this->db->update('language_list', array(
                'db_field' => $language,
                'status' => 'ok'
            ));

            add_language($language);
            recache();
        } elseif ($para1 == 'do_edit_lang') {
            $this->db->where('language_list_id', $para2);
            $this->db->update('language_list', array(
                'name' => $this->input->post('language')
            ));
            if(!demo()){
                $this->crud_model->file_up("icon", "language_list", $para2, '', '', '.jpg');
            }
            recache();
        } else if ($para1 == "lang_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('language_list_id', $para2);
            $this->db->update('language_list', array(
                'status' => $val
            ));
            recache();
        } elseif ($para1 == 'check_existed') {
            echo lang_check_exists($para2);
        } elseif ($para1 == 'lang_select') {
            $page_data['lang'] = $para2;
            $this->load->view('back/admin/language_select',$page_data);
        } elseif ($para1 == 'dlt_lang') {
            if(!demo()){
                $this->db->where('db_field', $para2);
                $this->db->delete('language_list');
                $this->load->dbforge();
                $this->dbforge->drop_column('language', $para2);
                recache();
            }

        } elseif ($para1 == 'dlt_word') {
            if(!demo()){
                $this->db->where('word_id', $para2);
                $this->db->delete('language');
                recache();
            }
        } else {
            $page_data['page_name'] = "language";
            $this->load->view('back/index', $page_data);
        }
    }

     /* Manage Business Settings */
    function business_settings($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'admin');
        }
        else if ($para1 == "cash_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "cash_set");
            $this->db->update('business_settings', array(
                'value' => $val
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
            $this->db->where('type', "paypal_set");
            $this->db->update('business_settings', array(
                'value' => $val
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
            $this->db->where('type', "stripe_set");
            $this->db->update('business_settings', array(
                'value' => $val
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
            $this->db->where('type', "c2_set");
            $this->db->update('business_settings', array(
                'value' => $val
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
            $this->db->where('type', "vp_set");
            $this->db->update('business_settings', array(
                'value' => $val
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
            $this->db->where('type', "pum_set");
            $this->db->update('business_settings', array(
                'value' => $val
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
            $this->db->where('type', "bitcoin_set");
            $this->db->update('business_settings', array(
                'value' => $val
            ));
            recache();
        }
        else if ($para1 == "ssl_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "ssl_set");
            $this->db->update('business_settings', array(
                'value' => $val
            ));
            recache();
        }

        else if ($para1 == "cur_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $data['status']    = $val;
            $this->db->where('currency_settings_id', $para2);
            $this->db->update('currency_settings', $data);
            recache();
        }
        else if ($para1 == "vendor_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
                $this->db->where('type', "show_vendor_website");
                $this->db->update('general_settings', array(
                'value' => $val
            ));
            }

            $this->db->where('type', "vendor_system");
            $this->db->update('general_settings', array(
                'value' => $val
            ));

            recache();

        }
        else if ($para1 == "wallet_system_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }

            $this->db->where('type', "wallet_system_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));

            recache();

        }
        else if ($para1 == "guest_checkout_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }

            $this->db->where('type', "guest_checkout_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));

            recache();

        }
        else if ($para1 == "product_affiliation_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }

            $this->db->where('type', "product_affiliation_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));

            recache();

        }
        else if ($para1 == "vendor_commission_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'yes';
            } else if ($para3 == 'false') {
                $val = 'no';
            }

            $this->db->where('type', "commission_set");
            $this->db->update('business_settings', array(
                'value' => $val
            ));

            recache();

        }
        else if ($para1 == "vendor_package_set") {
            $val = '';
            if ($para3 == 'false') {
                $val = 'yes';
            } else if ($para3 == 'true') {
                $val = 'no';
            }

            $this->db->where('type', "commission_set");
            $this->db->update('business_settings', array(
                'value' => $val
            ));

            recache();

        }
        else if ($para1 == "show_vendor_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "show_vendor_website");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
        else if ($para1 == "physical_product_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "physical_product_activation");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
        else if ($para1 == "digital_product_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "digital_product_activation");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
        else if ($para1 == "bundle_product_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "bundle_product_activation");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
        else if ($para1 == "customer_product_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "customer_product_activation");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
        else if ($para1 == 'set') {
            echo $this->input->post('stripe_set');
            $this->db->where('type',"paypal_set");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('paypal_set')
            ));
            $this->db->where('type', "stripe_set");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('stripe_set')
            ));
            $this->db->where('type', "cash_set");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('cash_set')
            ));
        }
        else if ($para1 == 'faq_set') {
            $faqs = array();
            $f_q  = $this->input->post('f_q');
            $f_a  = $this->input->post('f_a');
            foreach ($f_q as $i => $r) {
                $faqs[] = array(
                    'question' => $f_q[$i],
                    'answer' => $f_a[$i]
                );
            }
            $this->db->where('type', "faqs");
            $this->db->update('business_settings', array(
                'value' => json_encode($faqs)
            ));
        }
        else if ($para1 == 'set1') {
            $this->db->where('type', "paypal_email");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('paypal_email')
            ));

            $this->db->where('type', "paypal_type");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('paypal_type')
            ));
            $this->db->where('type', "stripe_secret");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('stripe_secret')
            ));
            $this->db->where('type', "stripe_publishable");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('stripe_publishable')
            ));
            $this->db->where('type', "c2_user");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('c2_user')
            ));
            $this->db->where('type', "c2_secret");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('c2_secret')
            ));
            $this->db->where('type', "c2_type");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('c2_type')
            ));
            $this->db->where('type', "vp_merchant_id");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('vp_merchant_id')
            ));
            $this->db->where('type', "bitcoin_coinpayments_merchant");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('bitcoin_coinpayments_merchant')
            ));
            $this->db->where('type', "shipping_cost_type");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('shipping_cost_type')
            ));
            $this->db->where('type', "shipping_cost");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('shipping_cost')
            ));
            $this->db->where('type', "shipment_info");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('shipment_info')
            ));
            $this->db->where('type', "pum_merchant_key");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('merchant_key')
            ));
            $this->db->where('type', "pum_merchant_salt");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('merchant_salt')
            ));
            $this->db->where('type', "pum_account_type");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('pum_account_type')
            ));
            $this->db->where('type', "ssl_store_id");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('ssl_store_id')
            ));
            $this->db->where('type', "ssl_store_passwd");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('ssl_store_passwd')
            ));


            $this->db->where('type', "ssl_type");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('ssl_type')
            ));

        }
        else if ($para1 == 'set_currency') {
            $this->db->where('type', "currency");
            $this->db->update('business_settings', array(
                'value' => $para2
            ));
        }
        elseif ($para1 == 'currencies_select') {
            $currency = $this->db->get_where('business_settings',array('type'=>"currency"))->row()->value;
            echo $this->crud_model->select_html('currency_settings','currency','name','edit','demo-chosen-select currency_o',$currency,'status','ok');
        }
        else if ($para1 == 'set2') {
            $this->db->where('type', "currency");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('currency')
            ));
            $this->db->where('type', "currency_name");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('currency_name')
            ));
            $this->db->where('type', "exchange");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('exchange')
            ));
            $this->db->where('type', "vendor_system");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('vendor_system')
            ));
            recache();
        }else if($para1 =='set_3'){
            $data['exchange_rate']    = $this->input->post('exchange');
            $this->db->where('currency_settings_id', $para2);
            $this->db->update('currency_settings', $data);
            $this->db->where('type', "vendor_system");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('vendor_system')
            ));
        }else {
            $page_data['page_name'] = "business_settings";
            $this->load->view('back/index', $page_data);
        }
    }

    /* Currency Format Settings */
    function set_currency_format(){
        if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'admin');
        }

        $this->db->where('type', 'currency_format');
        $this->db->update('business_settings', array(
            'value' => $this->input->post('currency_format')
        ));

        $this->db->where('type', 'symbol_format');
        $this->db->update('business_settings', array(
            'value' => $this->input->post('symbol_format')
        ));

        $this->db->where('type', 'no_of_decimals');
        $this->db->update('business_settings', array(
            'value' => $this->input->post('no_of_decimals')
        ));

        recache();
    }

    /* Manage Admin Settings */
    function manage_admin($para1 = "")
    {
        if ($this->session->userdata('admin_login') != 'yes') {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'update_password') {
            $user_data['password'] = $this->input->post('password');
            $account_data          = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->result_array();
            foreach ($account_data as $row) {
                if (sha1($user_data['password']) == $row['password']) {
                    if ($this->input->post('password1') == $this->input->post('password2')) {
                        $data['password'] = sha1($this->input->post('password1'));
                        $this->db->where('admin_id', $this->session->userdata('admin_id'));
                        $this->db->update('admin', $data);
                        echo 'updated';
                    }
                } else {
                    echo 'pass_prb';
                }
            }
        } else if ($para1 == 'update_profile') {
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone')
            ));
        } else {
            $page_data['page_name'] = "manage_admin";
            $this->load->view('back/index', $page_data);
        }
    }

    function update()
    {
        if ($this->session->userdata('admin_login') != 'yes') {
            redirect(base_url() . 'admin');
        }

        $page_data['update_available'] = file_exists('update.zip') ? true :false;

        $page_data['page_name'] = "update";
        $this->load->view('back/index', $page_data);

    }

    function upload_update_zip(){

        if(demo()){
            $this->session->set_flashdata('error', translate("Error"));
            $this->session->set_flashdata('error_text', translate("This operation is disabled in demo"));
            redirect("admin/update");
        }

        $error = '';
        if(!empty($_FILES)){
            try{
                move_uploaded_file($_FILES['update']['tmp_name'], FCPATH.'/update.zip' );
            }catch (Exception $e){
                $error.= $e->getMessage();

                die($e->getMessage());
            }


            if(empty($error) && file_exists('update.zip')){
                $this->session->set_flashdata('success', translate("Successful"));
                $this->session->set_flashdata('upload_success', translate("Update zip is uploaded"));
            }

            if(!empty($error)){
                $this->session->set_flashdata('error', translate("Error"));
                $this->session->set_flashdata('error_text', $error);
            }
        }

        redirect("admin/update");

    }
    function do_update(){

        if(demo()){
            $this->session->set_flashdata('error', translate("Error"));
            $this->session->set_flashdata('error_text', translate("This operation is disabled in demo"));
            redirect("admin/update");
        }

        //extract
        $zip = new ZipArchive();
        $file = $zip->open('update.zip');
        if ($file === TRUE) {
            $zip->extractTo(FCPATH);
            $zip->close();
            unlink('update.zip');
        }

        //import sql
        if(file_exists('update.sql')){

            // Set line to collect lines that wrap
            $templine = '';
            // Read in entire file
            $lines = file('update.sql');

            // Loop through each line
            foreach ($lines as $line)
            {
                // Skip it if it's a comment
                if (substr($line, 0, 2) == '--' || $line == '')
                    continue;

                // Add this line to the current templine we are creating
                $templine .= $line;

                // If it has a semicolon at the end, it's the end of the query so can process this templine
                if (substr(trim($line), -1, 1) == ';')
                {
                    // Perform the query
                    $this->db->query($templine);

                    // Reset temp variable to empty
                    $templine = '';
                }
            }

            unlink('update.sql');
        }

        redirect("admin/update");
    }

    function backup()
    {
        if ($this->session->userdata('admin_login') != 'yes') {
            redirect(base_url() . 'admin');
        }

        if(file_exists('downloaded-sql-backup.zip')){
            unlink('downloaded-sql-backup.zip');
        }else if(file_exists('downloaded-project-backup.zip')){
            unlink('downloaded-project-backup.zip');
        }else if(file_exists('downloaded-script-backup.zip')){
            unlink('downloaded-script-backup.zip');
        }

        $page_data['page_name'] = "backup";
        $this->load->view('back/index', $page_data);

    }

    function get_backup()
    {
        if(demo()){
            $this->session->set_flashdata('error', translate("Error"));
            $this->session->set_flashdata('error_text', translate("This operation is disabled in demo"));
            redirect("admin/backup");
        }

        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 600);

        $this->load->library('zip');
        $this->load->helper('download');
        $this->load->helper('file');
        $this->zip->clear_data();

        $root = FCPATH;

        $backup_mode = $this->input->post('backup_mode');
        $download_mode = $this->input->post('download_mode');

        $error = '';

        //sql backup, download or save in root
        if ($backup_mode == 'only_sql' || $backup_mode == 'both') {

            $this->load->dbutil();
            $prefs = array(
                'tables' => array(),                     // Array of tables to backup.
                'ignore' => array(),                     // List of tables to omit from the backup
                'format' => "zip",                       // gzip, zip, txt
                'filename' => "my_db_backup.sql",          // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop' => TRUE,                        // Whether to add DROP TABLE statements to backup file
                'add_insert' => TRUE,                        // Whether to add INSERT data to backup file
                'newline' => "\n"                         // Newline character used in backup file
            );

            $sql_backup =& $this->dbutil->backup($prefs);

            $sql_file_name = $download_mode == 'download' ? 'downloaded-sql-backup.zip' : 'sql-backup-on-' . date("Y-m-d-H") . '.zip';
            $sql_save = $root . '/' . $sql_file_name;

            $this->load->helper('file');
            try {
                write_file($sql_save, $sql_backup);
                $this->zip->clear_data();
            } catch (Exception $e) {
                $error .= "Sql could not be saved.";
            }


            if ($backup_mode == 'only_sql' && $download_mode == 'download') {
                force_download($sql_file_name, $sql_backup);
                unlink($sql_file_name);
                $this->zip->clear_data();

                if ($error == "") {
                    $this->session->set_flashdata('success', translate("Successful"));
                    $this->session->set_flashdata('backup_success_text', translate("Downloading started"));
                } else {
                    $this->session->set_flashdata('error', translate("Error"));
                    $this->session->set_flashdata('error_text', $error);
                }
                redirect("admin/backup");
            }
        }

        //full project backup with or without sql
        if ($backup_mode == 'only_script' || $backup_mode == 'both') {

            $file_name = '';

            if ($backup_mode == 'both' && $download_mode == 'root') {
                $file_name = 'project-backup-on-' . date("Y-m-d-H") . '.zip';
            } else if ($backup_mode == 'only_script' && $download_mode == 'root') {
                $file_name = 'script-backup-on-' . date("Y-m-d-H") . '.zip';
            } else if ($backup_mode == 'both' && $download_mode == 'download') {
                $file_name = 'downloaded-project-backup' . '.zip';
            } else if ($backup_mode == 'only_script' && $download_mode == 'download') {
                $file_name = 'downloaded-script-backup' . '.zip';
            }

            $this->zip->clear_data();
            $this->zip->read_dir('./application');
            $this->zip->read_dir('./Documentation');
            $this->zip->read_dir('./system');
            $this->zip->read_dir('./template');
            $this->zip->read_dir('./updates');
            $this->zip->read_dir('./uploads');

            $this->zip->read_file('.htaccess');
            $this->zip->read_file('index.php');

            if($backup_mode == 'both'){
                $this->zip->read_file($sql_file_name);
            }

            if ($download_mode == 'download') {

                try {
                    $this->zip->download($file_name);
                    $this->zip->clear_data();
                } catch (Exception $e) {
                    $error .= "Script could not be zipped.";
                }

                if ($error == "") {
                    $this->session->set_flashdata('success', translate("Successful"));
                    $this->session->set_flashdata('backup_success_text', translate("Downloaded"));
                } else {
                    $this->session->set_flashdata('error', translate("Error"));
                    $this->session->set_flashdata('error_text', $error);
                }
                redirect("admin/backup");

            } else if ($download_mode == 'archive') {

                try {
                    $this->zip->archive($root . '/' . $file_name);
                    $this->zip->clear_data();
                } catch (Exception $e) {
                    $error .= "Script could not be archived.";
                }

            }

            if ($backup_mode == 'both' && isset($sql_save)) {
                unlink($sql_file_name);
            }

        }

        if ($download_mode == 'archive') {

            $backup_success_text = translate("Backup completed");

            if ($error == "") {
                $this->session->set_flashdata('success', translate("Successful"));
                $this->session->set_flashdata('backup_success_text', $backup_success_text);
            } else {
                $this->session->set_flashdata('error', translate("Error"));
                $this->session->set_flashdata('error_text', $error);
            }

            redirect("admin/backup");
        }

        redirect("admin/backup",'refresh');
    }

    /*Page Management */
    function page($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('page')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'do_add') {
            $parts             = array();
            $data['page_name'] = $this->input->post('page_name');
            $data['tag']       = $this->input->post('tag');
            $data['parmalink'] = $this->input->post('parmalink');
            $data['meta_title'] = $this->input->post('meta_title');
            $data['meta_description'] = $this->input->post('meta_description');
            $size              = $this->input->post('part_size');
            $type              = $this->input->post('part_content_type');
            $content           = $this->input->post('part_content');
            $widget            = $this->input->post('part_widget');
            //var_dump($widget);
            foreach ($size as $in => $row) {
                $parts[] = array(
                    'size' => $size[$in],
                    'type' => $type[$in],
                    'content' => $content[$in],
                    'widget' => $widget[$in]
                );
            }
            $data['parts']  = json_encode($parts);
            $data['status'] = '';
            $this->db->insert('page', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['page_data'] = $this->db->get_where('page', array(
                'page_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/page_edit', $page_data);
        } elseif ($para1 == "update") {
            $parts             = array();
            $data['page_name'] = $this->input->post('page_name');
            $data['tag']       = $this->input->post('tag');
            $data['parmalink'] = $this->input->post('parmalink');
            $data['meta_title'] = $this->input->post('meta_title');
            $data['meta_description'] = $this->input->post('meta_description');
            $size              = $this->input->post('part_size');
            $type              = $this->input->post('part_content_type');
            $content           = $this->input->post('part_content');
            $widget            = $this->input->post('part_widget');
            //var_dump($widget);
            foreach ($size as $in => $row) {
                $parts[] = array(
                    'size' => $size[$in],
                    'type' => $type[$in],
                    'content' => $content[$in],
                    'widget' => $widget[$in]
                );
            }
            $data['parts'] = json_encode($parts);
            $this->db->where('page_id', $para2);
            $this->db->update('page', $data);
            recache();
        } elseif ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('page_id', $para2);
                $this->db->delete('page');
                recache();
            }
        } elseif ($para1 == 'list') {
            $page_data['all_page'] = $this->db->get('page')->result_array();
            $this->load->view('back/admin/page_list', $page_data);
        } else if ($para1 == 'product_publish_set') {

            $page = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('page_id', $page);
            $this->db->update('page', $data);
            //   echo $this->db->last_query();
            recache();
        } elseif ($para1 == 'view') {
            $page_data['page_data'] = $this->db->get_where('page', array(
                'page_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/page_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/page_add');
        } else {
            $page_data['page_name'] = "page";
            $page_data['all_pages'] = $this->db->get('page')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Manage General Settings */
    function general_settings($para1 = "", $para2 = "")
    {

        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "terms") {
            $this->db->where('type', "terms_conditions");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('terms')
            ));
        }
        if ($para1 == "preloader") {
            $this->db->where('type', "preloader_bg");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('preloader_bg')
            ));
            $this->db->where('type', "preloader_obj");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('preloader_obj')
            ));
            $this->db->where('type', "preloader");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('preloader')
            ));
        }
        if ($para1 == "privacy_policy") {
            $this->db->where('type', "privacy_policy");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('privacy_policy')
            ));
        }
        if ($para1 == "set_slider") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "slider");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_slides") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "slides");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_admin_notification_sound") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }            $this->db->where('type', "admin_notification_sound");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_home_notification_sound") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "home_notification_sound");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "fb_login_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "fb_login_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "g_login_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "g_login_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "g_analytics_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "g_analytics_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set") {
            $this->db->where('type', "system_name");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('system_name')
            ));

            $this->db->where('type', "system_email");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('system_email')
            ));

            $file_folder = $this->db->get_where('general_settings', array('type' => 'file_folder'))->row()->value;
            if(rename("uploads/file_products/".$file_folder,"uploads/file_products/".$this->input->post('file_folder'))){
                $this->db->where('type', "file_folder");
                $this->db->update('general_settings', array(
                    'value' => $this->input->post('file_folder')
                ));
            }

            $this->db->where('type', "system_title");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('system_title')
            ));
            $this->db->where('type', "cache_time");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('cache_time')
            ));
            $this->db->where('type', "language");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('language')
            ));
            $volume = $this->input->post('admin_notification_volume');
            $this->db->where('type', "admin_notification_volume");
            $this->db->update('general_settings', array(
                'value' => $volume
            ));
            $volume = $this->input->post('homepage_notification_volume');
            $this->db->where('type', "homepage_notification_volume");
            $this->db->update('general_settings', array(
                'value' => $volume
            ));
        }
        if ($para1 == "contact") {
            $this->db->where('type', "contact_address");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_address')
            ));
            $this->db->where('type', "contact_email");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_email')
            ));
            $this->db->where('type', "contact_phone");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_phone')
            ));
            $this->db->where('type', "contact_website");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_website')
            ));
            $this->db->where('type', "contact_about");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_about')
            ));

        }
        if ($para1 == "footer") {
            $this->db->where('type', "footer_text");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('footer_text', 'chaira_de')
            ));
            $this->db->where('type', "footer_category");
            $this->db->update('general_settings', array(
                'value' => json_encode($this->input->post('footer_category'))
            ));

            $this->db->where('type', "footer_page");
            $this->db->update('general_settings', array(
                'value' => json_encode($this->input->post('footer_page'))
            ));
            // var_dump($this->input->post('footer_page'));
            $this->db->where('type', "footer_disc");
            $this->db->update('general_settings', array(
                'value' => json_encode($this->input->post('footer_disc'))
            ));
        }
         if ($para1 == "font") {
            $this->db->where('type', "font");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('font')
            ));
        }
        if ($para1 == "color") {
            $this->db->where('type', "header_color");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('header_color')
            ));
            $this->db->where('type', "footer_color");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('header_color')
            ));
        }
        if ($para1 == "mail_status") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'smtp';
            } else if ($para2 == 'false') {
                $val = 'mail';
            }
            echo $val;
            $this->db->where('type', "mail_status");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "captcha_status") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "captcha_status");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }

        if ($para1 == "facebook_pixel_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "facebook_pixel_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }

        if ($para1 == "facebook_chat_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "facebook_chat_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }


        recache();
    }

    function smtp_settings($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            die("OK");
            $this->db->where('type', 'smtp_host');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_host')));

            $this->db->where('type', 'smtp_port');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_port')));

            $this->db->where('type', 'smtp_user');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_user')));

            $this->db->where('type', 'smtp_pass');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_pass')));

            redirect(base_url() . 'admin/site_settings/smtp_settings/', 'refresh');
        }
    }

    function affiliation_settings($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            $affiliation_validity =
                is_numeric($this->input->post('affiliation_validity')) && $this->input->post('affiliation_validity') > 1
                    ? $this->input->post('affiliation_validity') : 30;

            $affiliation_point_to_currency_rate =
                is_numeric($this->input->post('affiliation_point_to_currency_rate')) && $this->input->post('affiliation_point_to_currency_rate') > 1
                    ? $this->input->post('affiliation_point_to_currency_rate') : 1.00;


            $this->db->where('type', 'affiliation_validity');
            $this->db->update('general_settings', array('value' => $affiliation_validity));

            $this->db->where('type', 'affiliation_point_to_currency_rate');
            $this->db->update('general_settings', array('value' => $affiliation_point_to_currency_rate));

            redirect(base_url() . 'admin/site_settings/affiliation_settings/', 'refresh');
        }
    }

    /* Manage Social Links */
    function social_links($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            $this->db->where('type', "facebook");
            $this->db->update('social_links', array(
                'value' => $this->input->post('facebook')
            ));
            $this->db->where('type', "google-plus");
            $this->db->update('social_links', array(
                'value' => $this->input->post('google-plus')
            ));
            $this->db->where('type', "twitter");
            $this->db->update('social_links', array(
                'value' => $this->input->post('twitter')
            ));
            $this->db->where('type', "skype");
            $this->db->update('social_links', array(
                'value' => $this->input->post('skype')
            ));
            $this->db->where('type', "pinterest");
            $this->db->update('social_links', array(
                'value' => $this->input->post('pinterest')
            ));
            $this->db->where('type', "youtube");
            $this->db->update('social_links', array(
                'value' => $this->input->post('youtube')
            ));
            redirect(base_url() . 'admin/site_settings/social_links/', 'refresh');
        }
        recache();
    }
    /* Manage SEO relateds */
    function seo_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('seo')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == "set") {
            $this->db->where('type', "meta_description");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('description')
            ));
            $this->db->where('type', "meta_keywords");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('keywords')
            ));
            $this->db->where('type', "meta_author");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('author')
            ));

            $this->db->where('type', "revisit_after");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('revisit_after')
            ));
            recache();
        }
        else {
            require_once (APPPATH . 'libraries/SEOstats/bootstrap.php');
            $page_data['page_name'] = "seo";
            $this->load->view('back/index', $page_data);
        }
    }

    function ticket($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->admin_permission('ticket')) {
            redirect(base_url() . 'admin');
        }
        if ($para1 == 'delete') {
            if(!demo()){
                $this->db->where('ticket_id', $para2);
                $this->db->delete('ticket');
            }
        } elseif ($para1 == 'list') {
            $this->db->order_by('ticket_id', 'desc');
            $page_data['tickets'] = $this->db->get('ticket')->result_array();
            $this->load->view('back/admin/ticket_list', $page_data);
        } elseif ($para1 == 'reply') {
            $data['message'] = $this->input->post('reply');
            $data['time'] = time();
            $data['from_where'] = json_encode(array('type'=>'admin','id'=>''));
            $data['to_where'] = $this->db->get_where('ticket_message',array('ticket_id'=>$para2))->row()->from_where;
            $data['ticket_id']= $para2;
            $data['view_status']= json_encode(array('user_show'=>'no','admin_show'=>'ok'));
            $data['subject']  = $this->db->get_where('ticket_message',array('ticket_id'=>$para2))->row()->subject;
            $this->db->insert('ticket_message',$data);
        } elseif ($para1 == 'view') {
            $page_data['message_data'] = $this->db->get_where('ticket', array(
                'ticket_id' => $para2
            ))->result_array();
            $this->crud_model->ticket_message_viewed($para2,'admin');
            $page_data['tic']=$para2;
            $this->load->view('back/admin/ticket_view', $page_data);
        } else if ($para1 == 'view_user') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                'user_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/user_view', $page_data);
        } elseif ($para1 == 'reply_form') {
            $page_data['message_data'] = $this->db->get_where('ticket', array(
                'ticket_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/ticket_reply', $page_data);
        } else {
            $page_data['page_name']        = "ticket";
            $page_data['tickets'] = $this->db->get('ticket')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    function display_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "display_settings";
        $page_data['tab_name']  = $para1;
        $this->load->view('back/index', $page_data);
    }

    function preloader_view($para1 = "")
    {
        if (!$this->crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['from_admin'] = true;
        $page_data['preloader']  = $para1;
        $this->load->view('front/preloader', $page_data);
    }

    function captha_n_social_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('captha_n_social_settings')) {
            redirect(base_url() . 'admin');
        }
        $page_data['page_name'] = "captha_n_social_settings";
        $page_data['tab_name']  = $para1;
        $this->load->view('back/index', $page_data);
    }

    function google_api_key($para1 = "")
    {
        if (!$this->crud_model->admin_permission('captha_n_social_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "api_key");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('api_key')
        ));
        recache();
    }

    function google_analytics_key($para1 = ""){
        if (!$this->crud_model->admin_permission('captha_n_social_settings')) {
            redirect(base_url() . 'admin');
        }
        $this->db->where('type', "google_analytics_key");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('tracking_id')
        ));
        recache();

    }

    function currency_settings($para1 = "",$para2 = ""){
        if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'admin');
        }
        if($para1 =='set_rate'){
            if($this->input->post('exchange')){
                echo $data['exchange_rate']         = $this->input->post('exchange');
            }
            if($this->input->post('exchange_def')){
                echo $data['exchange_rate_def']     = $this->input->post('exchange_def');
            }
            if($this->input->post('name')){
                echo $data['name']      = $this->input->post('name');
            }
            if($this->input->post('symbol')){
                echo $data['symbol']        = $this->input->post('symbol');
            }
            $this->db->where('currency_settings_id', $para2);
            $this->db->update('currency_settings', $data);
            recache();
        }
    }

    function default_images($para1 = "",$para2 = "")
    {
        if (!$this->crud_model->admin_permission('default_images')) {
            redirect(base_url() . 'admin');
        }
        if($para1 == "set_images"){
            if(!demo()){
                move_uploaded_file($_FILES[$para2]['tmp_name'], 'uploads/'.$para2.'/default.jpg');
                recache();
            }
        }
        $page_data['default_list'] = array('product_image','digital_logo_image','category_image','sub_category_image','brand_image','blog_image','banner_image','user_image','vendor_logo_image','vendor_banner_image','membership_image','slides_image');
        $page_data['page_name'] = "default_images";
        $this->load->view('back/index', $page_data);
    }

    function theme_part(){
        $this->load->view('back/admin/theme_part');
    }

    function logo_part(){
        $this->load->view('back/admin/logo_part');
    }

    function preloader_part(){

        $this->load->view('back/admin/preloader_settings');
    }

    function font_part(){

        $this->load->view('back/admin/font');
    }
    function favicon_part(){

        $this->load->view('back/admin/favicon');
    }
    function home_part(){
        $this->load->view('back/admin/home_settings');
    }
    function contact_part(){
        $this->load->view('back/admin/contact_set');
    }
    function footer_part(){
        $this->load->view('back/admin/footer_set');
    }
    function header_part(){
        $this->load->view('back/admin/header_set');
    }
    function home_item_change($para1=""){
        $this->load->view('back/admin/home_change_'.$para1);
    }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

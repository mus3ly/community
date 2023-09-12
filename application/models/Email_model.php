<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Email_model extends CI_Model
{

    /*
	 *	Developed by    : Active IT zone
	 *	Date	        : 14 July, 2015
	 *	Active Supershop eCommerce CMS
	 *	http://codecanyon.net/user/activeitezone
     *  Last Modified   : 18 January, 2017
	 */

    function __construct()
    {
        parent::__construct();
    }


    function password_reset_email($account_type = '', $id = '', $pass = '')
    {
        //$this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

        $query  = $this->db->get_where($account_type, array($account_type . '_id' => $id));

        if ($query->num_rows() > 0){

            $sub    = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->subject;
            $to     = $query->row()->email;
			if($account_type == 'user'){
				$to_name	= $query->row()->username;
			}else{
				$to_name	= $query->row()->name;
			}
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 1))->row()->body;
			$email_body      = str_replace('[[to]]',$to_name,$email_body);
			$email_body      = str_replace('[[account_type]]',$account_type,$email_body);
			$email_body      = str_replace('[[password]]',$pass,$email_body);
			$email_body      = str_replace('[[from]]',$from_name,$email_body);

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
			if($background !== 'style_1'){
				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
				$final_email = str_replace('[[body]]',$email_body,$final_email);
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
			}else{
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
			}

            return $send_mail;
        }
        else {
            return false;
        }
    }
    
    
    function payment_success($id, $amount)
    {
        //$this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

            $sub    = $this->db->get_where('email_template', array('email_template_id' => 12))->row()->subject;
            $user = $this->db->where('email', $id)->get('vendor')->row();
            $to     = $user->email;
            $to_name =$user->name;
			
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 12))->row()->body;

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
            
		    $final_email = str_replace('[from]',$to_name,$email_body);
		    $final_email = str_replace('[amount]',$amount,$email_body);
			if($background !== 'style_1'){
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
			}else{
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
			}
            if($send_mail == true){
            return $send_mail;
            }else{
                return false;
            }
            
    }
    
    function subscription_cancellation($id)
    {
        //$this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

            $sub    = $this->db->get_where('email_template', array('email_template_id' => 13))->row()->subject;
            $mail =$this->db->get_where('product', array('product_id' => $query->row()->pid))->row()->bussniuss_email;

            // $sub    = $this->db->get_where('email_template', array('email_template_id' => 10))->row()->subject;
            $to     = '';
            $to_name ='' ;
			
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 13))->row()->body;

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
            
		
			if($background !== 'style_1'){
				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
				$final_email = str_replace('[[body]]',$email_body,$final_email);
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
				$this->do_email($from, $from_name, $mail, $sub, $final_email);
			}else{
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
				$this->do_email($from, $from_name, $mail, $sub, $final_email);
			}
            if($send_mail == true){
            return $send_mail;
            }else{
                return false;
            }
            
    }
    
    
    function report_email( $id)
    {
        //$this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

        $query  = $this->db->get_where('report', array('id' => $id));

        if ($query->num_rows() > 0){
            $sub    = $this->db->get_where('email_template', array('email_template_id' => 10))->row()->subject . $this->db->get_where('product', array('product_id' => $query->row()->pid))->row()->title;
            $mail =$this->db->get_where('product', array('product_id' => $query->row()->pid))->row()->bussniuss_email;

            // $sub    = $this->db->get_where('email_template', array('email_template_id' => 10))->row()->subject;
            $to     = $query->row()->email;
            $to_name = $query->row()->name;
			$to_msg = $query->row()->meg;
			$f_email = $query->row()->email;
			
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 10))->row()->body;
			$email_body      = str_replace('[[to]]',$to_name,$email_body);
			$email_body      = str_replace('[[meg]]',$to_msg,$email_body);
			$email_body      = str_replace('[[from]]',$f_email,$email_body);

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
            
		
			if($background !== 'style_1'){
				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
				$final_email = str_replace('[[body]]',$email_body,$final_email);
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
				$this->do_email($from, $from_name, $mail, $sub, $final_email);
			}else{
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
				$this->do_email($from, $from_name, $mail, $sub, $final_email);
			}

            return $send_mail;
            
        }
        else {
            return false;
            // echo 0;
        }
    }
    
    
    
    function contact_email($id="",$submail="")
    {
        //$this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

        $query  = $this->db->get_where('contact_us', array('id' => $id));
        // var_dump($this->db->last_query());
        if (count($query) > 0){

            $sub    = $this->db->get_where('email_template', array('email_template_id' => 11))->row()->subject . $this->db->get_where('product', array('product_id' => $query->row()->pid))->row()->title;
            if($submail){
                $mail= $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;;
            }else{
                $mail =$this->db->get_where('product', array('product_id' => $query->row()->pid))->row()->bussniuss_email;
            }
            // var_dump($to);
            if($submail){
                $to     = $query->row()->submail;
            }else{
                $to     = $query->row()->email;
            }
            $to_name = $query->row()->first_name;
            $phone = $query->row()->phone;
			$to_msg = $query->row()->msg;
			$f_email = $query->row()->subject;
			
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 11))->row()->body;
			$email_body      = str_replace('[[to]]',$to_name,$email_body);
			$email_body      = str_replace('[[meg]]',$to_msg,$email_body);
			$email_body      = str_replace('[[subject]]',$f_email,$email_body);
			$email_body      = str_replace('[[phone]]',$phone,$email_body);

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
			if($background !== 'style_1'){
			    
				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
				$final_email = str_replace('[[body]]',$email_body,$final_email);
				var_dump($final_email);
				die();
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
				if($send_mail){
				$this->do_email($from, $from_name, $mail, $sub, $final_email);
				}
			}else{
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
				if($send_mail){
				$this->do_email($from, $from_name, $mail, $sub, $email_body);
				}
			}

            return $send_mail;
        }
        else {
            return false;
        }
    }
    
//     function status_email($account_type = '', $id = '')
//     {
//         //$this->load->database();
//         $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
//         $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
//         if($protocol == 'smtp'){
//             $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
//         }
//         else if($protocol == 'mail'){
//             $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
//         }

//         $query = $this->db->get_where($account_type, array($account_type . '_id' => $id));
// 		if ($query->num_rows() > 0) {
//             $sub        = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->subject;
//             $to         = $query->row()->email;
// 			if($account_type == 'user'){
// 				$to_name	= $query->row()->username;
// 			}else{
// 				$to_name	= $query->row()->name;
// 			}
// 			if($query->row()->status == 'approved'){
//                 $status = "Approved";
//             } else {
//                 $status = "Postponed";
//             }
// 			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->body;
// 			$email_body      = str_replace('[[to]]',$to_name,$email_body);
// 			$email_body      = str_replace('[[account_type]]',$account_type,$email_body);
// 			$email_body      = str_replace('[[email]]',$to,$email_body);
// 			$email_body      = str_replace('[[status]]',$status,$email_body);
// 			$email_body      = str_replace('[[from]]',$from_name,$email_body);
//             // die($email_body);
//             $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
//             // die($background);
// 			if($background == 'style_1'){
// 				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
// 				$final_email = str_replace('[[body]]',$email_body,$final_email);
				
// 				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
// 			}else{
// 				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
// 			}

//             return $send_mail;
//         }
//         else {
//             return false;
//         }
//     }
 function status_email($account_type = '', $id = '')
    {
        //$this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

        $query = $this->db->get_where($account_type, array($account_type . '_id' => $id));

		if ($query->num_rows() > 0) {
            $sub        = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->subject;
            $to         = $query->row()->email;
			if($account_type == 'user'){
				$to_name	= $query->row()->username;
			}else{
				$to_name	= $query->row()->name;
			}
			if($query->row()->status == 'approved'){
                $status = "Approved";
            } else {
                $status = "Postponed";
            }
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 2))->row()->body;
			$email_body      = str_replace('[[to]]',$to_name,$email_body);
			$email_body      = str_replace('[[account_type]]',$account_type,$email_body);
			$email_body      = str_replace('[[email]]',$to,$email_body);
			$email_body      = str_replace('[[status]]',$status,$email_body);
			$email_body      = str_replace('[[from]]',$from_name,$email_body);

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
			if($background !== 'style_1'){
				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
				$final_email = str_replace('[[body]]',$email_body,$final_email);
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
			}else{
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
			}

            return $send_mail;
        }
        else {
            return false;
        }
    }


      function membership_upgrade_email($vendor)
    {
        //$this->load->database();
        $account_type = 'vendor';

        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }


        $query = $this->db->get_where($account_type, array($account_type . '_id' => $vendor));

		if ($query->num_rows() > 0) {
            $sub        = $this->db->get_where('email_template', array('email_template_id' => 3))->row()->subject;
            $to         = $query->row()->email;

			$to_name	= $query->row()->name;

			if($query->row()->membership == '0'){
                $package    = "reduced to : Default";
            }
            else {
                $package    = "upgraded to : " . $this->db->get_where('membership',array('membership_id'=>$query->row()->membership))->row()->title;
            }
			$email_body      = $this->db->get_where('email_template', array('email_template_id' => 3))->row()->body;
			$email_body      = str_replace('[[to]]',$to_name,$email_body);
			$email_body      = str_replace('[[account_type]]',$account_type,$email_body);
			$email_body      = str_replace('[[email]]',$to,$email_body);
			$email_body      = str_replace('[[package]]',$package,$email_body);
			$email_body      = str_replace('[[from]]',$from_name,$email_body);

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
			if($background !== 'style_1'){
				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
				$final_email = str_replace('[[body]]',$email_body,$final_email);
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
			} else {
				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
			}

            return $send_mail;
        }
        else {
            return false;
        }
    }

    function vendor_payment($vendor,$amount)
    {
        //$this->load->database();
        $account_type = 'vendor';

        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }


        $query = $this->db->get_where($account_type, array($account_type . '_id' => $vendor));

        if ($query->num_rows() > 0) {
            $sub        = $this->db->get_where('email_template', array('email_template_id' => 3))->row()->subject;
            $to         = $query->row()->email;

            $to_name    = $query->row()->name;

            $email_body      = $this->db->get_where('email_template', array('email_template_id' => 9))->row()->body;
            $email_body      = str_replace('[[vendor_name]]',$to_name,$email_body);
            $email_body      = str_replace('[[amount]]',$amount,$email_body);
            $email_body      = str_replace('[[from]]',$from_name,$email_body);

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
            if($background !== 'style_1'){
                $final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
                $final_email = str_replace('[[body]]',$email_body,$final_email);
                $send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
            } else {
                $send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
            }

            return $send_mail;
        }
        else {
            return false;
        }
    }

    function membership_upgrade_email_to_admin($vendor)
    {
        //$this->load->database();
        $account_type = 'vendor';

        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }


        $query = $this->db->get_where($account_type, array($account_type . '_id' => $vendor));

        if ($query->num_rows() > 0) {
            $sub        = $this->db->get_where('email_template', array('email_template_id' => 8))->row()->subject;
            $to = $this->db->get_where('general_settings', array('type' => 'contact_email'))->row()->value;

            $vendor_name    = $query->row()->name;

            if($query->row()->membership == '0'){
                $package    = "reduced to : Default";
            }
            else {
                $package    = "upgraded to : " . $this->db->get_where('membership',array('membership_id'=>$query->row()->membership))->row()->title;
            }
            $amount    =$this->db->get_where('membership',array('membership_id'=>$query->row()->membership))->row()->price;


            $email_body      = str_replace('[[vendor_name]]', $vendor_name,$email_body);
            $email_body      = str_replace('[[email]]',$email,$email_body);
            $email_body      = str_replace('[[vendor_package]]',$package,$email_body);
            $email_body      = str_replace('[[package_amount]]',$amount,$email_body);
            $email_body      = str_replace('[[from]]',$from_name,$email_body);

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
            if($background !== 'style_1'){
                $final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
                $final_email = str_replace('[[body]]',$email_body,$final_email);
                $send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
            } else {
                $send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
            }

            return $send_mail;
        }
        else {
            return false;
        }
    }

    function directory_contact($data,$email,$email_body)
    {
        $to = $email;
        $from = 'info@markethubland.com';
        $from_name = 'ComunityHubland';
        // $email_body      = $this->db->get_where('email_template', array('email_template_id' => 6))->row()->body;
        
         $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
         $background = 'style_4';
      		// 	if($background !== 'style_1'){
      			if(true){
      				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
      				
      				if($background == 'style_4'){
      					$home_top_logo = $this->db->get_where('ui_settings',array('type' => 'home_top_logo'))->row()->value;
      					$logo =base_url().'uploads/logo_image/logo_'.$home_top_logo.'.png';
      					$final_email = str_replace('[[logo]]',$logo,$final_email);
      				}
      				$final_email = str_replace('[[body]]',$email_body,$final_email);
      				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
      			}else{
      				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
      			}

            return $send_mail;
        //$this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

        $to   = $email;
        $account_type = 'vendor';
        $query = $this->db->get_where($account_type, array('email' => $email));

        if ($query->num_rows() > 0) {
  			if($account_type == 'admin'){
                  $to_name    = $query->row()->name;
                  $url        = "<a href='".base_url()."admin/'>".base_url()."admin</a>";

                  $sub        = $this->db->get_where('email_template', array('email_template_id' => 6))->row()->subject;
                  $email_body      = $this->db->get_where('email_template', array('email_template_id' => 6))->row()->body;
  			}
  			if($account_type == 'vendor'){
  				$to_name	= $query->row()->name;
  				$url 		= "<a href='".base_url()."vendor/'>".base_url()."vendor</a>";

                  $sub        = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->subject;
  				$email_body = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->body;
  			}
  			if($account_type == 'user'){
  				$to_name	= $query->row()->username;
  				$url 		   = "<a href='".base_url()."home/login_set/login'>".base_url()."home/login_set/login</a>";

          $sub             = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->subject;
  				$email_body      = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->body;
  			}

            $email_body      = str_replace('[[to]]',$to_name,$email_body);
            $email_body      = str_replace('[[sitename]]',$from_name,$email_body);
            $email_body      = str_replace('[[account_type]]',$account_type,$email_body);
            $email_body      = str_replace('[[email]]',$to,$email_body);
            $email_body      = str_replace('[[password]]',$pass,$email_body);
            $email_body      = str_replace('[[url]]',$url,$email_body);
            $email_body      = str_replace('[[from]]',$from_name,$email_body);

	          $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
      			if($background !== 'style_1'){
      				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
      				if($background == 'style_4'){
      					$home_top_logo = $this->db->get_where('ui_settings',array('type' => 'home_top_logo'))->row()->value;
      					$logo =base_url().'uploads/logo_image/logo_'.$home_top_logo.'.png';
      					$final_email = str_replace('[[logo]]',$logo,$final_email);
      				}
      				$final_email = str_replace('[[body]]',$email_body,$final_email);
      				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
      			}else{
      				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
      			}

            return $send_mail;
        }
        else {
            return false;
        }
    }
    // function account_opening($account_type = '', $email = '', $pass = '')
    // {
    //     //$this->load->database();
    //     $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
    //     $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
    //     if($protocol == 'smtp'){
    //         $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
    //     }
    //     else if($protocol == 'mail'){
    //         $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
    //     }

    //     $to   = $email;
    //     $query = $this->db->get_where($account_type, array('email' => $email));
    //     if ($query->num_rows() > 0) {
  		// 	if($account_type == 'admin'){
    //               $to_name    = $query->row()->name;
    //               $url        = "<a href='".base_url()."admin/'>".base_url()."admin</a>";

    //               $sub        = $this->db->get_where('email_template', array('email_template_id' => 6))->row()->subject;
    //               $email_body      = $this->db->get_where('email_template', array('email_template_id' => 6))->row()->body;
  		// 	}
  		// 	if($account_type == 'vendor'){
  		// 		$to_name	= $query->row()->name;
  		// 		$url 		= "<a href='".base_url()."vendor/'>".base_url()."vendor</a>";

    //               $sub        = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->subject;
  		// 		$email_body = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->body;
  		// 	}
  		// 	if($account_type == 'user'){
  		// 		$to_name	= $query->row()->username;
  		// 		$url 		   = "<a href='".base_url()."home/login_set/login'>".base_url()."home/login_set/login</a>";

    //       $sub             = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->subject;
  		// 		$email_body      = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->body;
  		// 	}

    //         $email_body      = str_replace('[[to]]',$to_name,$email_body);
    //         $email_body      = str_replace('[[sitename]]',$from_name,$email_body);
    //         $email_body      = str_replace('[[account_type]]',$account_type,$email_body);
    //         $email_body      = str_replace('[[email]]',$to,$email_body);
    //         $email_body      = str_replace('[[password]]',$pass,$email_body);
    //         $email_body      = str_replace('[[url]]',$url,$email_body);
    //         $email_body      = str_replace('[[from]]',$from_name,$email_body);

	   //       $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
    //   			if($background !== 'style_1'){
    //   				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
    //   				if($background == 'style_4'){
    //   					$home_top_logo = $this->db->get_where('ui_settings',array('type' => 'home_top_logo'))->row()->value;
    //   					$logo =base_url().'uploads/logo_image/logo_'.$home_top_logo.'.png';
    //   					$final_email = str_replace('[[logo]]',$logo,$final_email);
    //   				}
    //   				$final_email = str_replace('[[body]]',$email_body,$final_email);
    //   				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
    //   			}else{
    //   				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
    //   			}

    //         return $send_mail;
    //     }
    //     else {
    //         return false;
    //     }
    // }
    function account_opening($account_type = '', $email = '', $pass = '')
    {
        //$this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

        $to   = $email;
        $to1= $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        $query = $this->db->get_where($account_type, array('email' => $email));

        if ($query->num_rows() > 0) {
  			if($account_type == 'admin'){
                  $to_name    = $query->row()->name;
                  $url        = "<a href='".base_url()."admin/'>".base_url()."admin</a>";

                  $sub        = $this->db->get_where('email_template', array('email_template_id' => 6))->row()->subject;
                  $email_body      = $this->db->get_where('email_template', array('email_template_id' => 6))->row()->body;
  			}
  			if($account_type == 'vendor'){
  				$to_name	= $query->row()->name;
  				$url 		= "<a href='".base_url()."vendor/'>".base_url()."vendor</a>";

                  $sub        = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->subject;
  				$email_body = $this->db->get_where('email_template', array('email_template_id' => 4))->row()->body;
  			}
  			if($account_type == 'user'){
  				$to_name	= $query->row()->username;
  				$url 		   = "<a href='".base_url()."home/login_set/login'>".base_url()."home/login_set/login</a>";

          $sub             = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->subject;
  				$email_body      = $this->db->get_where('email_template', array('email_template_id' => 5))->row()->body;
  			}

            $email_body      = str_replace('[[to]]',$to_name,$email_body);
            $email_body      = str_replace('[[sitename]]',$from_name,$email_body);
            $email_body      = str_replace('[[account_type]]',$account_type,$email_body);
            $email_body      = str_replace('[[email]]',$to,$email_body);
            $email_body      = str_replace('[[password]]',$pass,$email_body);
            $email_body      = str_replace('[[url]]',$url,$email_body);
            $email_body      = str_replace('[[from]]',$from_name,$email_body);

	          $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
      			if($background !== 'style_1'){
      				$final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
      				if($background == 'style_4'){
      					$home_top_logo = $this->db->get_where('ui_settings',array('type' => 'home_top_logo'))->row()->value;
      					$logo =base_url().'uploads/logo_image/logo_'.$home_top_logo.'.png';
      					$final_email = str_replace('[[logo]]',$logo,$final_email);
      				}
      				$final_email = str_replace('[[body]]',$email_body,$final_email);
      				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email);
      		// 		 $this->do_email($from,$from_name,$to1, $sub, $final_email);
      			}else{
      				$send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
      		// 		$this->do_email($from,$from_name,$to1, $sub, $final_email);
      			}

            return $send_mail;
        }
        else {
            return false;
        }
    }

    function vendor_reg_email_to_admin($email = '', $pass = '')
    {
       //$this->load->database();
        $from_name  = $this->db->get_where('general_settings',array('type' => 'system_name'))->row()->value;
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

            $query = $this->db->get_where('vendor', array('email' => $email));


            $vendor_name    = $query->row()->name;
            $url        = "<a href='".base_url()."vendor/'>".base_url()."vendor</a>";

            $sub        = $this->db->get_where('email_template', array('email_template_id' => 7))->row()->subject;
            $email_body = $this->db->get_where('email_template', array('email_template_id' => 7))->row()->body;


            $email_body      = str_replace('[[vendor_name]]', $vendor_name,$email_body);
            $email_body      = str_replace('[[email]]',$email,$email_body);
            $email_body      = str_replace('[[from]]',$from_name,$email_body);

            $background = $this->db->get_where('ui_settings',array('type' => 'email_theme_style'))->row()->value;
            $to=$this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            if($background !== 'style_1'){
                $final_email = $this->db->get_where('ui_settings',array('type' => 'email_theme_'.$background))->row()->value;
                if($background == 'style_4'){
                    $home_top_logo = $this->db->get_where('ui_settings',array('type' => 'home_top_logo'))->row()->value;
                    $logo =base_url().'uploads/logo_image/logo_'.$home_top_logo.'.png';
                    $final_email = str_replace('[[logo]]',$logo,$final_email);
                }

                $final_email = str_replace('[[body]]',$email_body,$final_email);
                $send_mail  = $this->do_email($from,$from_name,$to, $sub, $final_email); // from = sytem/ smtp, to = contact er email
            }else{
                $send_mail  = $this->do_email($from,$from_name,$to, $sub, $email_body);
            }

            return $send_mail;

    }



    function newsletter($title = '', $text = '', $email = '', $from = '')
    {
        $from_name  = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
        $this->do_email($from, $from_name, $email, $title, $text,"html");
    }

    /* Email Invoice */
    function email_invoice($sale_id){
        $CI =& get_instance();
        $CI->load->model('crud_model');

        $from_name  = $this->db->get_where('general_settings', array('type' => 'system_name'))->row()->value;
        $protocol   = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;
        if($protocol == 'smtp'){
            $from   = $this->db->get_where('general_settings',array('type' => 'smtp_user'))->row()->value;
        }
        else if($protocol == 'mail'){
            $from   = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
        }

        $is_guest = $this->db->get_where('sale', array('sale_id' => $sale_id))->row()->buyer;
        if ($is_guest == "guest") {
            $info = json_decode($this->db->get_where('sale', array('sale_id' => $sale_id))->row()->shipping_address,true);
            $to   =  $info['email'];
        }
        else {
            $to     = $CI->crud_model->get_type_name_by_id('user', $CI->crud_model->get_type_name_by_id('sale', $sale_id, 'buyer'), 'email');
        }
        $subject    = '#'.$CI->crud_model->get_type_name_by_id('sale', $sale_id, 'sale_code');
        $page_data['sale_id'] = $sale_id;
        $msg        = $this->load->view('front/shopping_cart/invoice_email', $page_data, TRUE);

        // customer invoice mail
       
        $this->do_email($from, $from_name, $to, $subject, $msg);

        // Admin full invoice mail
        $admins     = $this->db->get_where('admin',array('role'=>'1'))->result_array();
        foreach ($admins as $row) {
            $subject = $subject.' '.'(Full Invoice)';
            $admin_mail = $this->db->get_where('general_settings', array('type' => 'system_email'))->row()->value;
            $this->do_email($from, $from_name, $admin_mail, $subject, $msg);
        }

        //Admin Split invoice mail
        foreach ($admins as $row) {
            $msg  = $this->load->view('front/shopping_cart/split_invoice_email_admin', $page_data, TRUE);
            $this->do_email($from, $from_name, $row['email'], $subject, $msg);
        }

        // vendor split invoice mail
        $vendors = $this->crud_model->vendors_in_sale($sale_id);
        foreach ($vendors as $p) {
          $page_data['vendor_id'] = $p;
          $msg                    = $this->load->view('front/shopping_cart/split_invoice_email', $page_data, TRUE);
          $vendor_email           =  $this->db->get_where('vendor',array('vendor_id'=>$p))->row()->email;
          $this->do_email($from, $from_name, $vendor_email, $subject, $msg);
        }
    }
    
    

    /***custom email sender****/

    /*function do_email($from = '', $from_name = '', $to = '', $sub ='', $msg ='')
    {
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from($from, $from_name);
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($msg);

        if($this->email->send()){
            return true;
        }else{
            //echo $this->email->print_debugger();
            return false;
        }
        //echo $this->email->print_debugger();
    }*/

    function do_email($from = '', $from_name = '', $to = '', $sub = '', $msg = '',$mail_type = 'html')
    {
        $config = array();
        $smtp_config = array();
        $protocol = $this->db->get_where('general_settings', array('type' => 'mail_status'))->row()->value;

        if (!empty($protocol)) {
            if ($protocol == 'smtp') {
                $smtp_config = $this->get_smtp_config();
            }
        }


        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $config['priority'] = 1;
		    $config['mailtype'] = $mail_type ? $mail_type : 'text';
        $config['charset'] = "iso-8859-1";
         //echo "<pre>";
         //print_r($config);die();

        if (!empty($smtp_config)) {
            $from = $smtp_config['smtp_user'];
            $config = array_merge($config,$smtp_config);
        }

        if (!empty($config)) {
            $this->email->initialize($config);
        }

        $this->email->from($from, $from_name);
        $this->email->to($to);
        $this->email->subject($sub);
        $this->email->message($msg);
        if (!demo() && $this->email->send()) {
            // echo $this->email->print_debugger();exit;
            return true;
        } else {
            // echo $this->email->print_debugger();exit;
            return false;
        }
        echo $this->email->print_debugger();
    }
    public function emails($content=''){
        echo 'nimra';
    }
    public function get_smtp_config()
    {
        $config = array();
        $flag_count = 0;

        $smtp_host = $this->db->get_where('general_settings', array('type' => 'smtp_host'))->row()->value;
        $smtp_port = $this->db->get_where('general_settings', array('type' => 'smtp_port'))->row()->value;
        $smtp_user = $this->db->get_where('general_settings', array('type' => 'smtp_user'))->row()->value;
        $smtp_pass = $this->db->get_where('general_settings', array('type' => 'smtp_pass'))->row()->value;


        if (!empty($smtp_host)) {

            $config['smtp_host'] = $smtp_host;
            $flag_count++; // 1

        }

        if (!empty($smtp_port)) {

            $config['smtp_port'] = $smtp_port;
            $flag_count++; // 2

        }

        if (!empty($smtp_user)) {

            $config['smtp_user'] = $smtp_user;
            $flag_count++; // 3

        }

        if (!empty($smtp_pass)) {

            $config['smtp_pass'] = $smtp_pass;
            $flag_count++; // 4

        }

        if ($flag_count < 4) {
            $config = array();
        }

        return $config;
    }



}

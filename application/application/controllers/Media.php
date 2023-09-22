<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Media extends CI_Controller {

    /*
     *  Developed by: Active IT zone
     *  Date    : 18 September, 2017
     *  Active Matrimony CMS
     *  http://codecanyon.net/user/activeitezone
     */
     
   
   public function media($id){
       echo "Heloo";
//       $this->load->database();
//         $media = $this->db->where('id',$id)->get('media')->row();
//         if($media){
//             $extension = strrchr( $media->path, '.');
//             echo $extension;
//             die();
//              $url = base_url.$media->path;
//             $img_name = 'blog_'.$lastid.'.jpg';

//             // Image path
//             $img = 'uploads/blog_image/'.$img_name;
            
//             // Save image
//             $ch = curl_init($url);
//             $fp = fopen($img, 'wb');
//             curl_setopt($ch, CURLOPT_FILE, $fp);
//             curl_setopt($ch, CURLOPT_HEADER, 0);
//             curl_exec($ch);
//             curl_close($ch);
//             fclose($fp);
//         }
       
//         $data = array(
            
//             "webp_url"=>$bolgs->slug
            
//             );
//         $insert = $this->db->where('title',$bolgs->title)->update('blog',$data);
//         $lastid = $this->db->insert_id();
//       if($insert){
        
            
//           echo 1;
//           die();
//       }else{
//           echo "0";
//           die();
//       }
  }
   
  }

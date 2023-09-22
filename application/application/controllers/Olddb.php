<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Olddb extends CI_Controller {

    /*
     *  Developed by: Active IT zone
     *  Date    : 18 September, 2017
     *  Active Matrimony CMS
     *  http://codecanyon.net/user/activeitezone
     */
     public function import_product(){
       
      $this->load->database();
        $media = $this->db->where('webp_url',NULL)->limit('1')->get('media')->row();
        
        if($media){
            $extension = strrchr( $media->path, '.');
            $string = $media->path;
            $string = str_replace($extension, ".webp", $string);
             $n_name =  basename($string);
           $o_name =  basename($media->path);
           
            $url = base_url().$media->path;
            
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
            
            "webp_url"=>$string
            
            );
        $insert = $this->db->where('id',$media->id)->update('media',$data);
        $lastid = $this->db->insert_id();
      if($insert){
         $r = $this->db->where('webp_url',NULL)->get('media')->result_array();
          echo count($r);
      }else{
          echo "0";
      }
        }
       
        
     }
     
   
  }

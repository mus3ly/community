<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Webhook extends CI_Controller
{

    
    function __construct()
    {
        
        parent::__construct();
        $this->load->database();
        
    }
    public function payment_webhook()
    {
        $payload = @file_get_contents('php://input');
        $data = json_decode($payload,true);
        if(isset($data['data']['object']['lines']['data'][0]['metadata']['track']))
        {
            $track = $data['data']['object']['lines']['data'][0]['metadata']['track'];
            $pack = $this->db->where('track_id',$track)->get('membership_payment')->row();
            $v = $this->db->where('vendor_id', $pack->vendor)->update('vendor',array('membership'=>$pack->vendor));
        }
        echo "Success";
    }
    

}


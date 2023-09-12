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
        $r = $this->db->insert('stripe_webhook',array('data'=>$payload,'track'=>$data['data']['object']['metadata']['track'],'uid'=>$data['data']['object']['metadata']['customer_id'],'type'=>$data['type']));
        var_dump($r);
        // var_dump($data['type']);customer.subscription.deleted//customer.subscription.created
        var_dump($data['type']);
        var_dump($data['data']['object']['metadata']);
        var_dump('Subscription ID');
        var_dump($data['data']['object']['id']);
        var_dump($data['data']);
        if(isset($data['data']['object']['metadata']['track']) && $data['type'] == 'customer.subscription.created')
        {
            $track = $data['data']['object']['metadata']['track'];
            $plan_id = $data['data']['object']['metadata']['plan_id'];
            $stripe_sub = $data['data']['object']['id'];
            $pack = $this->db->where('track_id',$track)->get('membership_payment')->row();
            $v = $this->db->where('vendor_id', $pack->vendor)->update('vendor',array('membership'=> $plan_id,'stripe_sub'=> $stripe_sub));
        }
        else if(isset($data['data']['object']['metadata']['track']) && $data['type'] == 'customer.subscription.deleted')
        {
            $stripe_sub = $data['data']['object']['id'];
            $vid = $data['data']['object']['metadata']['customer_id'];
            $v = $this->db->where('vendor_id', $vid)->update('vendor',array('stripe_sub'=>NULL));
            var_dump($v);
            var_dump($vid.'vendor id');
            var_dump($data['data']['object']['metadata']);
        }
        echo "Success";
        exit();
    }
    

}


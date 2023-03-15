    <?php
        $system_title = $this->db->get_where('general_settings',array('type' => 'system_title'))->row()->value;
        $total = $this->cart->total();
        if ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'product_wise') {
            $shipping = $this->crud_model->cart_total_it('shipping');
        } elseif ($this->crud_model->get_type_name_by_id('business_settings', '3', 'value') == 'fixed') {
            $shipping = $this->crud_model->get_type_name_by_id('business_settings', '2', 'value');
        }
        $tax = $this->crud_model->cart_total_it('tax');
        $grand = $total + $shipping + $tax;
        $exchange = exchange('usd');
        $final_amount = $grand/$exchange;
    ?>
    <?php
        $p_set = $this->db->get_where('business_settings',array('type'=>'paypal_set'))->row()->value;
        $bitcoin_set = $this->db->get_where('business_settings',array('type'=>'bitcoin_set'))->row()->value;

        $c_set = $this->db->get_where('business_settings',array('type'=>'cash_set'))->row()->value;
        $s_set = $this->db->get_where('business_settings',array('type'=>'stripe_set'))->row()->value;
        $c2_set = $this->db->get_where('business_settings',array('type'=>'c2_set'))->row()->value;
        $vp_set = $this->db->get_where('business_settings',array('type'=>'vp_set'))->row()->value;
        $pum_set = $this->db->get_where('business_settings',array('type'=>'pum_set'))->row()->value;
        $ssl_set = $this->db->get_where('business_settings',array('type'=>'ssl_set'))->row()->value;
        $balance = $this->wallet_model->user_balance();

    ?>

<input type="hidden" name="r_id" value="<?= $r_id; ?>" />
<div class="row">
    <?php
        foreach($methods as $k=> $v){ ?>
            <div class="cc-selector col-sm-3">
                <input id="<?php echo $v['slug'];?>" type="radio" style="display:block;" <?= ($k == 0)?"checked":""; ?> name="shipping_type" value="<?php echo $v['slug'];?>"/>
                <label class="drinkcard-cc smclass" style="margin-bottom:0px; width:100%; overflow:hidden; " for="<?php echo $v['slug'];?>" onclick="ship_check('<?php echo $v['slug'];?>')">
                    <img src="<?php echo $v['logo'];?>" width="100%" height="100%" style=" text-align-last:center;" alt="<?php echo $v['name'];?>" />
                    <div class="shup_price"><?= currency() . $v['amount'];?></div>

                </label>
            </div>
    <?php }
    ?>
    <div class="col-md-12">
        <span class="btn btn-theme-dark" onclick="load_payments();">
            <?php echo translate('next');?>
        </span>
    </div>
</div>

<style>
    .cc-selector input{
        margin:0;padding:0;
        -webkit-appearance:none;
           -moz-appearance:none;
                appearance:none;
    }

    .cc-selector input:active +.drinkcard-cc
    {
        opacity: 1;
        border:4px solid #169D4B;
    }
    .cc-selector input:checked +.drinkcard-cc{
        -webkit-filter: none;
        -moz-filter: none;
        filter: none;
        border:4px solid black;
    }
    .drinkcard-cc{
        cursor:pointer;
        background-size:contain;
        background-repeat:no-repeat;
        display:inline-block;
        -webkit-transition: all 100ms ease-in;
        -moz-transition: all 100ms ease-in;
        transition: all 100ms ease-in;
        -webkit-filter:opacity(.5);
        -moz-filter:opacity(.5);
        filter:opacity(.5);
        transition: all .6s ease-in-out;
        border:4px solid transparent;
        border-radius:5px !important;
    }
    .drinkcard-cc:hover{
    -webkit-filter:opacity(1);
    -moz-filter: opacity(1);
    filter:opacity(1);
    transition: all .6s ease-in-out;
    border:4px solid #8400C5;

}
</style>

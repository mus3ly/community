<script>
	var base_url = "<?php echo base_url(); ?>"; 
	var dss = "<?php echo translate("deleted_successfully"); ?>";
	var cncle = "<?php echo translate("cancelled"); ?>";
	var cnl = "<?php echo translate("cancel"); ?>";
	var req = "<?php echo translate("required"); ?>";
	var mbn = "<?php echo translate("must_be_a_number"); ?>";
	var mbe = "<?php echo translate("must_be_a_valid_email_address"); ?>";
	var sv = "<?php echo translate("save"); ?>";
	var ppus = "<?php echo translate("product_published!"); ?>";
	var pups = "<?php echo translate("product_unpublished!"); ?>";
	var pfe = "<?php echo translate("product_featured!"); ?>";
	var pufe = "<?php echo translate("product_unfeatured!"); ?>";
	var ptd = "<?php echo translate("product_in_todays_deal!"); ?>";
	var ptnd = "<?php echo translate("product_removed_from_todays_deal!"); ?>";
	var spus = "<?php echo translate("slider_published!"); ?>";
	var supus = "<?php echo translate("slider_unpublished!"); ?>";
	var papus = "<?php echo translate("page_published!"); ?>";
	var paupus = "<?php echo translate("page_unpublished!"); ?>";
	var ntsen = "<?php echo translate("notification_sound_enabled!"); ?>";
	var ntsds = "<?php echo translate("notification_sound_disabled!"); ?>";
	var glen = "<?php echo translate("google_login_enabled!"); ?>";
	var glds = "<?php echo translate("google_login_disabled!"); ?>";
	var flen = "<?php echo translate("facebook_login_enabled!"); ?>";
	var flds = "<?php echo translate("facebook_login_disabled!"); ?>";
	var pplds = "<?php echo translate("paypal_payment_disabled!"); ?>";
	var pplen = "<?php echo translate("paypal_payment_enabled!"); ?>";
	var c2_e ="<?php echo translate("twocheckout_payment_enabled!"); ?>";
	var c2_d ="<?php echo translate("twocheckout_payment_disabled!"); ?>";
	var vp_e ="<?php echo translate("voguePay_payment_enabled!"); ?>";
	var vp_d ="<?php echo translate("voguePay_payment_disabled!"); ?>";
	var s_e = "<?php echo translate("slider_enabled!"); ?>";
	var s_d = "<?php echo translate("slider_disabled!"); ?>";
	var su_e = "<?php echo translate("successfully_enabled!"); ?>";
	var su_d = "<?php echo translate("successfully_disabled!"); ?>";
	var c_e = "<?php echo translate("cash_payment_enabled!"); ?>";
	var c_d = "<?php echo translate("cash_payment_disabled!"); ?>";
	var enb = "<?php echo translate("enabled!"); ?>";
	var dsb = "<?php echo translate("disabled!"); ?>";
	var gae = "<?php echo translate("google_analytics_enabled!"); ?>";
	var gad = "<?php echo translate("google_analytics_disabled!"); ?>";
	var enb_ven = "<?php echo translate("notification_email_sent_to_vendor!"); ?> ";
	var working = "<?php echo translate("working..."); ?> ";
	function del_cat(id , pid,col= 0){
       var url = '<?= base_url('admin/cat_child');?>';
       var cid = id;
       if(col)
       {
           var mid = '#col_'+pid;
           $(mid).html('Loading');
       }
       var dta = { del:1,sid:id, id:cid, col:col};
       console.log(dta);
       
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { del:1,sid:id, id:cid, col:col},
        success: function (data) {
           if(data){
               
               if(col)
               {
                   load_chids(pid,mid);
               }
               else
               {
                    load_chids(pid,0)       
               }
       
            
            //   $("#list_itemss").html(data);

           }
        },
    });
}
</script>
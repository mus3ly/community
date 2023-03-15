
<footer id="footer">
    <div class="show-fixed pull-right">
        <ul class="footer-list list-inline">
            <li>
                <p class="text-sm"><?php echo translate('SEO_proggres');?></p>
                <div class="progress progress-sm progress-light-base">
                    <div style="width: 80%" class="progress-bar progress-bar-danger"></div>
                </div>
            </li>
    
            <li>
                <p class="text-sm"><?php echo translate('online_tutorial');?></p>
                <div class="progress progress-sm progress-light-base">
                    <div style="width: 80%" class="progress-bar progress-bar-primary"></div>
                </div>
            </li>
            <li>
                <button class="btn btn-sm btn-dark btn-active-success"><?php echo translate('checkout');?></button>
            </li>
        </ul>
    </div>
    <?php if($this->session->userdata('title') == 'admin'){ ?>
        <div class="hide-fixed pull-right pad-rgt">
            Currently <?= demo()?'demo':''?> v<?php echo $this->db->get_where('general_settings',array('type'=>'version'))->row()->value; ?>
        </div>
    <?php } ?>
	<p class="pad-lft">&#0169; 2018 <?php echo $system_title;?></p>
</footer>
<?php
            if ($this->session->userdata('title') == 'vendor') {
              $vend = $this->db->where('vendor_id',$this->session->userdata('vendor_id'))->get('vendor')->row();
              $date = $vend->exp_date;
            ?>
<script type="text/javascript">
    function start_counter() {
  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  //I'm adding this section so I don't have to keep updating this pen every year :-)
  //remove this if you don't need it
  let today = new Date(),
      dd = String(today.getDate()).padStart(2, "0"),
      mm = String(today.getMonth() + 1).padStart(2, "0"),
      yyyy = today.getFullYear(),
      nextYear = <?= date("Y", strtotime($date)) ?>,
      dayMonth = "<?= date("m/d", strtotime($date)) ?>/",
      birthday = dayMonth + yyyy;
  
  today = mm + "/" + dd + "/" + yyyy;
  if (today > birthday) {
    birthday = dayMonth + nextYear;
  }
  //end
  console.log("Its my birthday");
  console.log(birthday);
  
  const countDown = new Date(birthday).getTime(),
      x = setInterval(function() {    

        const now = new Date().getTime(),
              distance = countDown - now;

        document.getElementById("days").innerText = Math.floor(distance / (day)),
          document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
          document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

        //do something later when date is reached
        if (distance < 0) {
          // document.getElementById("headline").innerText = "It's my birthday!";
        //   document.getElementById("countdown").style.display = "none";
        //   document.getElementById("content").style.display = "block";
          clearInterval(x);
        }
        //seconds
      }, 0)
  }
  start_counter();
</script>
<?php
}
?>
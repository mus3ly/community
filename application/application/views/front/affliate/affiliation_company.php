
<div class="wishlist">
    <div class="row">
        <?php 
                // var_dump($compain);

          foreach ($compain as $affiliation_company) {
            $cover = $this->crud_model->size_img($affiliation_company['comp_logo'],820,312);
            // var_dump($cover);
           $vendor =  json_decode($affiliation_company['added_by']);

        ?>
      <div class="card col-sm-4" id="boxes_rounded">
        <div class="row">
            <a class="pnav_info" href="#" data-id="<?= $vendor->id; ?>">
            <div class="col-sm-3 left__boxgapp">
                <img class="card-img-top" src="<?= $cover; ?>" alt="Card image" style="width:100%">
                
              
            </div>
            <div class="col-sm-9 right_gapp_box">
                <div class="card-body" >
                  <h4 class="card-title" style="margin-bottom: 0;"><?= $affiliation_company['name'];?></h4>
                  <p style="margin-bottom: 0;" class="card-text"><?= $affiliation_company['pemail'];?></p>
                  <p  style="margin-bottom: 0;" class="card-text"><?= $affiliation_company['whatsapp_number'];?></p>
                </div>
            </div>
              </a>
        </div>
        
      </div>
      <?php
          }
      ?>
    </div>
</div>

        <?php /*
        // var_dump($compain);
        if (!empty($compain) && $affliate_id) {
            
            foreach ($compain as $affiliation_point_earning) {?>

             <?php
          } */ 
             ?>


<script>

    $(document).ready(function () {

    });
    function copyToClipboard(elementId) {
        

  // Create a "hidden" input
  var aux = document.createElement("input");

  // Assign it the value of the specified element
  aux.setAttribute("value", document.getElementById(elementId).innerHTML);

  // Append it to the body
  document.body.appendChild(aux);

  // Highlight its content
  aux.select();

  // Copy the highlighted text
  document.execCommand("copy");

  // Remove it from the body
  document.body.removeChild(aux);
  $(this).text('copied');

}
    function copyText1(id)
    {
        var copyText = document.getElementById(id);

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

   // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);

  // Alert the copied text
  alert("Copied the text: " + copyText.value);
    }
   $('.pnav_info').on('click',function(){
    //   alert();
    var id = $(this).attr('data-id');
         $("#profile_content").html(loading_set);
$("#profile_content").load("<?php echo base_url('home/affliate/affiliation_point_earnings')?>?vid="+id);
$(".pleft_nav").find("li").removeClass("active");
        $(".pnav_affiliation_point_earnings").find("li").addClass("active");
    });
</script>
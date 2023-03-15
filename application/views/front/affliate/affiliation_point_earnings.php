
<div class="wishlist">
    <table class="table" style="background: #fff;">
        <thead>
        <tr>
            <th>#</th>
            <th><?php echo translate('Type'); ?></th>
            <th><?php echo translate('title'); ?></th>
            <th><?php echo translate('percentage'); ?></th>
            <th><?php echo translate('time'); ?></th>
        </tr>
        </thead>
        <tbody>

        <?php if (!empty($compain1)) {
            $i = 0; ?>
            <?php foreach ($compain1 as $affiliation_point_earning) {
                
                $i++;
            $k = $affliate_id.'-'.$affiliation_point_earning['compain_id'];
            $html = '';
            $sing = (object)$affiliation_point_earning;
            $html = $sing->link = $sing->link.'?aff_id='.base64_encode($k);
            if($sing->compain_type == 'text_compain')
            {
                $html = '<a href="'.$sing->link.'" target="_blank">
                    '.$sing->content.'
                </a>';
            }
            else if($sing->compain_type == 'banner_compain')
            {
                $html = '<a href="'.$sing->link.'" target="_blank">
                    <img src="'.$this->crud_model->get_img($sing->banner_img)->secure_url.'" width="100" />
                </a>';
            }
            else if($sing->compain_type == 'video_compain')
            {
                $html = '<iframe width="100" height="100" src="'.$sing->video_link.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><div style="display:table;clear:both;"></div><br><a style="-moz-box-shadow:inset 0 1px 0 0 #fff;-webkit-box-shadow:inset 0 1px 0 0 #fff;box-shadow:inset 0 1px 0 0 #fff;background:-webkit-gradient(linear,left top,left bottom,color-stop(.05,#f9f9f9),color-stop(1,#e9e9e9));background:-moz-linear-gradient(top,#f9f9f9 5%,#e9e9e9 100%);background:-webkit-linear-gradient(top,#f9f9f9 5%,#e9e9e9 100%);background:-o-linear-gradient(top,#f9f9f9 5%,#e9e9e9 100%);background:-ms-linear-gradient(top,#f9f9f9 5%,#e9e9e9 100%);background:linear-gradient(to bottom,#f9f9f9 5%,#e9e9e9 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#f9f9f9", endColorstr="#e9e9e9", GradientType=0);background-color:#f9f9f9;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;border:1px solid #dcdcdc;display:inline-block;cursor:pointer;color:#666;font-family:Arial;font-size:15px;font-weight:700;padding:6px 24px;text-decoration:none;text-shadow:0 1px 0 #fff" href="'.$sing->link.'">'. $sing->title.'</a>';
            }?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $affiliation_point_earning['title'] ?></td>
                    <td style="min-width: 25em">
                        <textarea class=" summernote" id="comp<?= $affiliation_point_earning['compain_id'] ?>"><?= $html; ?></textarea>
                        <button class="btn btn-active-purple btn-block form_btn mt-2" type="button"
                                onclick="copyToClipboard('comp<?= $affiliation_point_earning['compain_id'] ?>')">
                            <?= translate("copy") ?>
                        </button>
                    </td>
                    <td>you will get <?php echo $affiliation_point_earning['percentage']?>% per sale</td>
                    <td><?php echo date("F jS, Y  h:i a", strtotime($affiliation_point_earning['create_at']))?></td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
    <div class="pagination-wrapper">
    <?php echo $this->ajax_pagination->create_links(); ?>
</div>
</div>


</div>

<script>

    $(document).ready(function () {

    });
    function copyToClipboard(elementId) {
        
var mid ="#"+elementId;
var text = document.getElementById(elementId).value;
// alert(text);
    // var text = "Example text to appear on clipboard";
    navigator.clipboard.writeText(text)
         .then(() => alert("Copied"))

}

    function ticket_listed(id)
    {
        $("#profile_content").html(loading_set);
        $("#profile_content").load("<?php echo base_url()?>home/affliate/affiliation_point_earnings/"+id);
        $(".pleft_nav").find("li").removeClass("active");
        $(".pnav_affiliation_point_earnings").find("li").addClass("active");
          $('.summernote').summernote();

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

</script>

<div class="wishlist">
    <table class="table" style="background: #fff;">
        <thead>
        <tr>
            <th>#</th>
            <th><?php echo translate('no'); ?></th>
            <th><?php echo translate('title'); ?></th>
            <th><?php echo translate('percentage'); ?></th>
            <th><?php echo translate('time'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($compain) && $affliate_id) {
            $i = 0; ?>
            <?php foreach ($compain as $affiliation_point_earning) { $i++;
            $k = $affliate_id.'-'.$affiliation_point_earning['compain_id'];
            $affiliation_link_text = $affiliation_point_earning['link'].'?aff_id='.base64_encode($k);?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $affiliation_point_earning['title'] ?></td>
                    <td style="min-width: 25em">
                        <input readonly type="text" class="form-control" id="<?= $affiliation_link_text ?>"
                               placeholder="Click to get shareable link" value="<?php echo $affiliation_link_text; ?>" aria-label="" aria-describedby="">
                        <button class="btn btn-active-purple btn-block form_btn mt-2" type="button"
                                onclick="copyText('<?= $affiliation_link_text ?>',this,event,'<?= translate('copied') ?>')">
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
</div>


</div>

<script>

    $(document).ready(function () {

    });

</script>
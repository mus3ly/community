
<?php 
    $i = 0;
    foreach ($query as $row1) {
        $i++;
        $url = 'https://dyclassroom.com/image/flags/'.strtolower($row1['country']).'.png';
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td class="description"><img src="<?= $url ?>" />
        <?php echo $row1['ip']; ?>
        </td>                  
        <td class="description">
        <?php 
        $r = $this->db->where('compain_id',$row1['comp_id'])->get('compain')->row();
        if($r)
        echo $r->title;
        
        ?>
        </td>                       
        <td class="description"> <?= date("F jS, Y  h:i a", strtotime($row1['create_at'])) ?> </td>                       
        <td class="description"><?php echo date("F jS, Y  h:i a", strtotime($row1['expire_at']))?></td>
        <td>
            <?php
            if($row1['status'])
            {
                ?>
                <span class="badge bg-success">complete</span>


                <?php
            }
            else
            {
                ?>
                <span class="badge bg-info text-dark">In process</span>

                <?php
            }
            ?>
        </td>
        <td>
            <?php
            if($row1['status'])
            {
                echo currency($row1['earn']);
            }
            else
            {
                ?>
                --
                <?php
            }
            ?>
        </td>
    </tr>                                      
<?php 
    }
?>


<tr class="text-center" style="display:none;" >
    <td id="pagenation_set_links" ><?php echo $this->ajax_pagination->create_links(); ?></td>
</tr>
<!--/end pagination-->


<script>
    $(document).ready(function(){ 
        product_listing_defaults();
        $('.pagination_box').html($('#pagenation_set_links').html());
    });
</script>
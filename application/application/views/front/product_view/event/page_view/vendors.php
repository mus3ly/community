<?php
$show = array();
foreach($vendors as $k=>$v)
{
    // ..get user 
    $s = $this->db->where('stock_id',$v->stock_id)->order_by("rate", "desc")->get('stock')->row();
    $info = $v->added_by;
    $price = $s->rate;
    $info = json_decode($info);
    $user = array();
    $img = '';
    if($info->type == 'admin')
    {
        $user = $this->db->where('admin_id',$info->id)->get('admin')->row();
    }
    else
    {
        $user = $this->db->where('vendor_id',$info->id)->get('vendor')->row();
        $img_path = 'uploads/vendor_logo_image/logo_'.$info->id.'.png';
        if(file_exists($img_path))
        {
            $img = base_url($img_path);
        }
    }
    $stock = array();
    $attr = '';
    if($v->stock_id)
    {
        $stock_row = $this->db->where('stock_id',$v->stock_id)->get('stock')->row();
                $attr = $stock_row->attribute;
                $attr = explode(',',$attr);
                $av = '';
        foreach($attr as $k=>$sv)
        {
            $row = $this->db->where('id',$sv)->get('attribute_to_values')->row();
            $av = $av.$row->value.' ';
        }
        $attr = $av;
    }
    if(!in_array($v->product_id,$show))
    {
        $show[] =$v->product_id;
    ?>
<div role="button" id="vendor<?= $info->id; ?>" onclick="select_vendor('<?= $v->product_id; ?>','<?= $info->id; ?>','<?= $v->stock_id; ?>','<?= $price; ?>')" class="Box-sc-5myfqj Segment-sc-rtt8nt Listing Wrapper-sc-lhs22t hxgriX fSOLrS dkPmAP vlist">
                <div class="Content-sc-zpcvjp gGuYfk">
                  <div class="LeftWrapper-sc-1lqmvq4 kKhYIr">
                    <div display="flex" class="Box-sc-5myfqj VWZvb">
                        <?php
                        // $img = 0;
                        if(!empty($img))
                        {
                        ?>
                      <img src="<?= $img ?>" alt="StockX Logo" class="Image-sc-17iazv8 jKzTIV" width="35" height="35">
                      <?php
                        }
                        else
                        {
                            ?>
                            <div class="text" ><?= substr($user->name, 0, 1) ?></div>
                            <?php
                        }
                      ?>
                      <div display="flex" class="Box-sc-5myfqj kPBJvj">
                        <h2 class="VendorText-sc-1nh1btc dVVUun"><?= $user->name;
                        ?></h2>
                        <div class="sub header Subheader-sc-tn6gzu fssPqE"><?= $attr; ?></div>
                      </div>
                    </div>
                  </div>
                  <div class="RightWrapper-sc-1a1amij jyXiEg">
                    <div class="Price-sc-fa2d9e fiIBEi"><?= currency() ?><?= $price; ?></div>
                    <span class="TaxText-sc-lcwyma iTJlMw">excl. tax &amp; duties</span>
                  </div>
                </div>
              </div>
              <?php
    }//$show
}
?>
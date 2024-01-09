							<div class="information-title">
                            	Affiliate Members</div>
                            <div class="wishlist">
                                <table class="table" style="background: #fff;">
                                    <thead>
                                        <tr>
                                            <th colspan="2"><?php echo translate('Name');?></th>
                                            <th colspan="2"><?php echo translate('Type');?></th>
                                            
                                            <th><?php echo translate('unpaid_vendors');?></th>
                                            <th><?php echo translate('paid_vendors');?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="result4">
                                    <?php
                                    foreach($rdata as $v):
                                        if($v['vendors'] || $v['pvendors'])
                                        {
                                    ?>
                                    <tr>

                                    <td colspan="2"><?=strip_tags($v['title']);?></td>
                                    <td colspan="2"><?=strip_tags($v['cat']);?></td>
                                    <td><?=$v['vendors']?></td>
                                    <td><?=$v['pvendors']?></td>
                                    </tr>
                                    <?php 
                                        }
                                    endforeach;?>
                                    </tbody>
                                </table>
                           </div>


                            <input type="hidden" id="page_num4" value="0" />

                            <div class="pagination_box">

                            </div>
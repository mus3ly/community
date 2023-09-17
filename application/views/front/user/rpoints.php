							<div class="information-title">
                            	Referal Members</div>
                            <div class="wishlist">
                                <table class="table" style="background: #fff;">
                                    <thead>
                                        <tr>
                                            <th><?php echo translate('Name');?></th>
                                            <th><?php echo translate('Email');?></th>
                                            <th><?php echo translate('Date');?></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    foreach($rdata as $v):
                                    ?>
                                    <tbody id="result4">

                                    <td><?=$v['name']?></td>
                                    <td><?=$v['email']?></td>
                                    <td><?= date('m/d/Y H:i:s',$v['create_timestamp'])?></td>
                                    </tbody>
                                    <?php endforeach;?>
                                </table>
                           </div>


                            <input type="hidden" id="page_num4" value="0" />

                            <div class="pagination_box">

                            </div>

                            <script>                                                                    
                                function wish_listed(page){
                                    if(page == 'no'){
                                        page = $('#page_num4').val();   
                                    } else {
                                        $('#page_num4').val(page);
                                    }
                                    var alerta = $('#result4');
                                    alerta.load('<?php echo base_url();?>home/wish_listed/'+page,
                                        function(){
                                            //set_switchery();
                                        }
                                    );   
                                }
                                $(document).ready(function() {
                                    wish_listed('0');
                                });

                            </script>
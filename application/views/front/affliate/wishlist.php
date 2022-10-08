							<div class="information-title">
                            	<?php echo translate('your_compain_log');?></div>
                            <div class="wishlist">
                                <table class="table" style="background: #fff;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo translate('location');?></th>
                                            <th><?php echo translate('compain');?></th>
                                            <th><?php echo translate('vist_date');?></th>
                                        <th><?php echo translate('expire_at');?></th>
                                        <th><?php echo translate('status');?></th>
                                        <th><?php echo translate('earning');?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="result4">
                                    </tbody>
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
                                    alerta.load('<?php echo base_url();?>home/log_listed/'+page,
                                        function(){
                                            //set_switchery();
                                        }
                                    );   
                                }
                                $(document).ready(function() {
                                    wish_listed('0');
                                });

                            </script>
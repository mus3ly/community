<style>
    .next_div span{
        padding:2px 4px;
        margin-right:2px;
        border:1px solid #ccc;
        border-radius:20px;
    }
    .list_size
    {
        padding:2px 4px;
        margin-right:2px;
        border:1px solid #ccc;
        border-radius:20px;
    }
    .next_div p{
        margin-bottom:0px;
    }
    .next_div{
    text-align: left;
    padding-left: 5px;
    font-size: 11px;
    line-height: 17px;
    }
</style>
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>
<div class="panel-body" id="demo_s">
    <?php
    if($type)
    {
        $type = '?'.$type.'=1';
    }
    $url = base_url().'vendor/product/list_data';
    if(isset($mod))
	{
	    $url = base_url().'vendor/product/list_data?module='.$mod->id;
	}
	elseif(isset($_GET['is_product']))
	{
	     $url = base_url().'vendor/product/list_data?is_product=1';
	}
    ?>
    <table id="events-table" class="table table-striped"  data-url="<?php echo $url; ?>"  data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"  data-show-refresh="true" data-search="true"  data-show-export="true" >
        <thead>
            <tr>
                <th data-field="item" data-align="right" data-sortable="true">
                    <?php echo translate('item');?>
                </th>
                <th data-field="list_type" data-align="center" data-sortable="true">
                    <?php echo translate('list_type');?>
                </th>
                <th data-field="options" data-sortable="false" data-align="right">
                    <?php echo translate('options');?>
                </th>
            </tr>
        </thead>
    </table>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#events-table').bootstrapTable({
            /*
            onAll: function (name, args) {
                console.log('Event: onAll, data: ', args);
            }
            onClickRow: function (row) {
                $result.text('Event: onClickRow, data: ' + JSON.stringify(row));
            },
            onDblClickRow: function (row) {
                $result.text('Event: onDblClickRow, data: ' + JSON.stringify(row));
            },
            onSort: function (name, order) {
                $result.text('Event: onSort, data: ' + name + ', ' + order);
            },
            onCheck: function (row) {
                $result.text('Event: onCheck, data: ' + JSON.stringify(row));
            },
            onUncheck: function (row) {
                $result.text('Event: onUncheck, data: ' + JSON.stringify(row));
            },
            onCheckAll: function () {
                $result.text('Event: onCheckAll');
            },
            onUncheckAll: function () {
                $result.text('Event: onUncheckAll');
            },
            onLoadSuccess: function (data) {
                $result.text('Event: onLoadSuccess, data: ' + data);
            },
            onLoadError: function (status) {
                $result.text('Event: onLoadError, data: ' + status);
            },
            onColumnSwitch: function (field, checked) {
                $result.text('Event: onSort, data: ' + field + ', ' + checked);
            },
            onPageChange: function (number, size) {
                $result.text('Event: onPageChange, data: ' + number + ', ' + size);
            },
            onSearch: function (text) {
                $result.text('Event: onSearch, data: ' + text);
            }
            */
        }).on('all.bs.table', function (e, name, args) {
            //alert('1');
            //set_switchery();
        }).on('click-row.bs.table', function (e, row, $element) {
            
        }).on('dbl-click-row.bs.table', function (e, row, $element) {
            
        }).on('sort.bs.table', function (e, name, order) {
            
        }).on('check.bs.table', function (e, row) {
            
        }).on('uncheck.bs.table', function (e, row) {
            
        }).on('check-all.bs.table', function (e) {
            
        }).on('uncheck-all.bs.table', function (e) {
            
        }).on('load-success.bs.table', function (e, data) {
            set_switchery();
        }).on('load-error.bs.table', function (e, status) {
            
        }).on('column-switch.bs.table', function (e, field, checked) {
            
        }).on('page-change.bs.table', function (e, size, number) {
			
        }).on('search.bs.table', function (e, text) {
            
        });
    });

</script>


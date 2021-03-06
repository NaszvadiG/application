<?php

?>

<div class="row-fluid">
    <div class="span12">

<?php echo $flash_partial_view;?>

<h2><?php echo lang('extra_index_title');?></h2>

<table cellpadding="0" cellspacing="0" border="0" class="display" id="extras" width="100%">
    <thead>
        <tr>
            <th><?php echo lang('extra_index_thead_id');?></th>
            <th><?php echo lang('extra_index_thead_date');?></th>
            <th><?php echo lang('extra_index_thead_duration');?></th>
            <th><?php echo lang('extra_index_thead_cause');?></th>
            <th><?php echo lang('extra_index_thead_status');?></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($extras as $extra_item): ?>
    <tr>
        <td data-order="<?php echo $extra_item['id']; ?>">
            <a href="<?php echo base_url();?>extra/extra/<?php echo $extra_item['id']; ?>" title="<?php echo lang('extra_index_thead_tip_view');?>"><?php echo $extra_item['id']; ?></a>
            &nbsp;
            <div class="pull-right">
                <a href="<?php echo base_url();?>extra/extra/<?php echo $extra_item['id']; ?>" title="<?php echo lang('extra_index_thead_tip_view');?>"><i class="icon-eye-open"></i></a>
                &nbsp;
                <?php if ($extra_item['status'] == 1) { ?>
                <a href="<?php echo base_url();?>extra/edit/<?php echo $extra_item['id']; ?>" title="<?php echo lang('extra_index_thead_tip_edit');?>"><i class="icon-pencil"></i></a>
                &nbsp;
                <a href="#" class="confirm-delete" data-id="<?php echo $extra_item['id'];?>" title="<?php echo lang('extra_index_thead_tip_delete');?>"><i class="icon-trash"></i></a>
                <?php } ?>
            </div>
        </td>
<?php $date = new DateTime($extra_item['date']);
$tmpDate = $date->getTimestamp();?>
        <td data-order="<?php echo $tmpDate; ?>"><?php echo $date->format(lang('global_date_format'));?></td>
        <td><?php echo $extra_item['duration']; ?></td>
        <td><?php echo $extra_item['cause']; ?></td>
        <td><?php echo lang($extra_item['status_name']); ?></td>
    </tr>
<?php endforeach ?>
	</tbody>
</table>
    </div>
</div>

<div class="row-fluid"><div class="span12">&nbsp;</div></div>

<div class="row-fluid">
    <div class="span12">
      <a href="<?php echo base_url();?>extra/export" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp; <?php echo lang('extra_index_button_export');?></a>
      &nbsp;
      <a href="<?php echo base_url();?>extra/create" class="btn btn-primary"><i class="icon-plus-sign icon-white"></i>&nbsp; <?php echo lang('extra_index_button_create');?></a>
    </div>
</div>

<link href="<?php echo base_url();?>assets/datatable/css/jquery.dataTables.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>assets/datatable/js/jquery.dataTables.min.js"></script>

<div id="frmDeleteExtraRequest" class="modal hide fade">
    <div class="modal-header">
        <a href="#" onclick="$('#frmDeleteExtraRequest').modal('hide');" class="close">&times;</a>
         <h3><?php echo lang('extra_index_popup_delete_title');?></h3>
    </div>
    <div class="modal-body">
        <p><?php echo lang('extra_index_popup_delete_message');?></p>
        <p><?php echo lang('extra_index_popup_delete_question');?></p>
    </div>
    <div class="modal-footer">
        <a href="#" id="lnkDeleteUser" class="btn danger"><?php echo lang('extra_index_popup_delete_button_yes');?></a>
        <a href="#" onclick="$('#frmDeleteExtraRequest').modal('hide');" class="btn secondary"><?php echo lang('extra_index_popup_delete_button_no');?></a>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
 
    $('#extras').dataTable({
                    "order": [[ 1, "desc" ]],
                    "oLanguage": {
                    "sEmptyTable":     "<?php echo lang('datatable_sEmptyTable');?>",
                    "sInfo":           "<?php echo lang('datatable_sInfo');?>",
                    "sInfoEmpty":      "<?php echo lang('datatable_sInfoEmpty');?>",
                    "sInfoFiltered":   "<?php echo lang('datatable_sInfoFiltered');?>",
                    "sInfoPostFix":    "<?php echo lang('datatable_sInfoPostFix');?>",
                    "sInfoThousands":  "<?php echo lang('datatable_sInfoThousands');?>",
                    "sLengthMenu":     "<?php echo lang('datatable_sLengthMenu');?>",
                    "sLoadingRecords": "<?php echo lang('datatable_sLoadingRecords');?>",
                    "sProcessing":     "<?php echo lang('datatable_sProcessing');?>",
                    "sSearch":         "<?php echo lang('datatable_sSearch');?>",
                    "sZeroRecords":    "<?php echo lang('datatable_sZeroRecords');?>",
                    "oPaginate": {
                        "sFirst":    "<?php echo lang('datatable_sFirst');?>",
                        "sLast":     "<?php echo lang('datatable_sLast');?>",
                        "sNext":     "<?php echo lang('datatable_sNext');?>",
                        "sPrevious": "<?php echo lang('datatable_sPrevious');?>"
                    },
                    "oAria": {
                        "sSortAscending":  "<?php echo lang('datatable_sSortAscending');?>",
                        "sSortDescending": "<?php echo lang('datatable_sSortDescending');?>"
                    }
                }
            });
      
   
    $('#frmDeleteExtraRequest').on('show', function() {
        var link = "<?php echo base_url();?>extra/delete/" + $(this).data('id');
        $("#lnkDeleteUser").attr('href', link);
    })


    $("#extras tbody").on('click', '.confirm-delete',  function(){
        var id = $(this).data('id');
        $('#frmDeleteExtraRequest').data('id', id).modal('show');
    });
    
    $('#frmDeleteExtraRequest').on('hidden', function() {
        $(this).removeData('modal');
    });
});
</script>

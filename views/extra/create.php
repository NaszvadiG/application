<?php

?>

<div class="row-fluid">
    <div class="span12">

<h2><?php echo lang('extra_create_title');?>&nbsp;<?php echo $help;?></h2>

<?php echo validation_errors(); ?>

<?php
$attributes = array('id' => 'frmCreateExtra');
echo form_open('extra/create', $attributes) ?>

    <label for="viz_date" required><?php echo lang('extra_create_field_date');?></label>
    <input type="text" name="viz_date" id="viz_date" value="<?php echo set_value('date'); ?>" />
    <input type="hidden" name="date" id="date" />
    
    <label for="duration" required><?php echo lang('extra_create_field_duration');?></label>
    <input type="text" name="duration" id="duration" value="<?php echo set_value('duration'); ?>" />&nbsp;<span><?php echo lang('extra_create_field_duration_description');?></span>
    
    <label for="cause"><?php echo lang('extra_create_field_cause');?></label>
    <textarea name="cause" id="cause"><?php echo set_value('cause'); ?></textarea>
    
    <label for="status" required><?php echo lang('extra_create_field_status');?></label>
    <select name="status">
        <option value="1" selected><?php echo lang('Planned');?></option>
        <option value="2"><?php echo lang('Requested');?></option>
    </select>
</form>

    <div class="row-fluid"><div class="span12">&nbsp;</div></div>
    <div class="row-fluid"><div class="span12">
        <button id="cmdCreateExtra" class="btn btn-primary"><i class="icon-ok icon-white"></i>&nbsp; <?php echo lang('extra_create_button_create');?></button>
        &nbsp;
        <a href="<?php echo base_url(); ?>extra" class="btn btn-danger"><i class="icon-remove icon-white"></i>&nbsp; <?php echo lang('extra_create_button_cancel');?></a>
    </div></div>
    <div class="row-fluid"><div class="span12">&nbsp;</div></div>
    </div>
</div>

    
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/flick/jquery-ui.custom.min.css">
<script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
<?php 
if ($language_code != 'en') { ?>
<script src="<?php echo base_url();?>assets/js/i18n/jquery.ui.datepicker-<?php echo $language_code;?>.js"></script>
<?php } ?>
<script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>

<?php require_once dirname(BASEPATH) . "/local/triggers/extra_view.php"; ?>

<script type="text/javascript">
    function validate_form() {
        var fieldname = "";
        
       
        if (typeof triggerValidateCreateForm == 'function') { 
           if (triggerValidateCreateForm() == false) return false;
        }
        
        if ($('#viz_date').val() == "") fieldname = "<?php echo lang('extra_create_field_date');?>";
        if ($('#duration').val() == "") fieldname = "<?php echo lang('extra_create_field_duration');?>";
        if ($('#cause').val() == "") fieldname = "<?php echo lang('extra_create_field_cause');?>";
        if (fieldname == "") {
            return true;
        } else {
            bootbox.alert(<?php echo lang('extra_create_mandatory_js_msg');?>);
            return false;
        }
    }
    
    $(function () {
        $("#viz_date").datepicker({
            changeMonth: true,
            changeYear: true,
            altFormat: "yy-mm-dd",
            altField: "#date"
        }, $.datepicker.regional['<?php echo $language_code;?>']);
        
    
        $("#duration").keyup(function() {
            var value = $("#duration").val();
            value = value.replace(",", ".");
            $("#duration").val(value);
        });
        
        $("#cmdCreateExtra").click(function() {
            if (validate_form()) {
                $("#frmCreateExtra").submit();
            }
        });
    });
</script>

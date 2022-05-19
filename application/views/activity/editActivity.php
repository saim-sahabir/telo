<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>   

    var date_format = <?php echo "'".dateFormatForJS()."'"; ?>;

    $(function () { 

        //Date picker
        $('#date').datepicker({
            format: date_format,
            autoclose: true
        }) 
    })
</script>

<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
</style> 

<section class="content-header">
    <h1>
        Edit Activity
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">  
                <!-- form start -->
                <?php echo form_open(base_url('Activity/addEditActivity/'.$encrypted_id)); ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">
                                <label>Date <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="date" id="date" class="form-control" placeholder="Date" value="<?php echo date(dateFormatForPHP(), strtotime($actvt_info->date)); ?>">
                            </div>
                            <?php if (form_error('date')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('date'); ?></p>
                                </div>
                            <?php } ?> 

                        </div>

                        <div class="col-md-3">

                            <div class="form-group"> 
                                <label>Project <span class="required_star">*</span></label>
                                <select tabindex="4" class="form-control select2" id="project_id" name="project_id" style="width: 100%;">
                                    <option value="">Project</option>
                                    <?php foreach ($projects as $prjcts) { ?>
                                        <option value="<?php echo $prjcts->id ?>" 
                                            <?php 
                                                if ($actvt_info->project_id == $prjcts->id) {
                                                    echo "selected";
                                                } 
                                            ?>
                                            >
                                            <?php echo $prjcts->project_name ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                            <?php if (form_error('project_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('project_id'); ?></p>
                                </div>
                            <?php } ?>  
                        </div>


                        <div class="col-md-3">

                            <div class="form-group">
                                <label>Hour Spent <span class="required_star">*</span></label>
                                <input tabindex="2" type="text" name="hour_spent" class="form-control" placeholder="Hour Spent" value="<?php echo $actvt_info->hour_spent; ?>">
                            </div>
                            <?php if (form_error('hour_spent')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('hour_spent'); ?></p>
                                </div>
                            <?php } ?> 
                        </div>

                        <div class="col-md-3">

                            <div class="form-group">
                                <label>Status <span class="required_star">*</span></label>
                                <select tabindex="4" class="form-control select2" id="status" name="status" style="width: 100%;">
                                    <option value="">Status</option>
                                    <option value="Initialized" <?php if($actvt_info->status == "Initialized"){ echo "selected";} ?>>Initialized</option>
                                    <option value="In Progress" <?php if($actvt_info->status == "In Progress"){ echo "selected";} ?>>In Progress</option> 
                                    <option value="Done" <?php if($actvt_info->status == "Done"){ echo "selected";} ?>>Done</option> 
                                </select>
                            </div>
                            <?php if (form_error('status')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('status'); ?></p>
                                </div>
                            <?php } ?> 
                        </div>

                    </div>  

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Activity <span class="required_star">*</span></label>
                                <textarea tabindex="3" class="form-control" rows="7" id="activity" name="activity" placeholder="Enter ..."><?php echo $actvt_info->activity; ?></textarea>
                            </div>
                            <?php if (form_error('activity')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('activity'); ?></p>
                                </div>
                            <?php } ?>  
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>Activity/myActivities"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
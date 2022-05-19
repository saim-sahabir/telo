<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>   

    var date_format = <?php echo "'".dateFormatForJS()."'"; ?>;

    $(function () {
        //Date picker
        $('#start_date').datepicker({
            format: date_format,
            autoclose: true
        }) 
        //Date picker
        $('#end_date').datepicker({
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
    .content{
        min-height: 0px !important;
        padding-bottom: 0px !important;
    }
</style> 

<section class="content-header">
    <h1>
        Activity Filter
    </h1>  
</section> 

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">  
                <!-- form start -->
                <?php echo form_open(base_url('Report/report')); ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-3">

                            <div class="form-group">
                                <label>Start Date <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="start_date" id="start_date" class="form-control" <?php if($this->input->post('start_date')){ echo 'value="'.$this->input->post('start_date').'"'; }else{ echo 'placeholder="Start Date"'; } ?> />
                            </div>
                            <?php if (form_error('start_date')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('start_date'); ?></p>
                                </div>
                            <?php } ?> 

                        </div>

                        <div class="col-md-3">

                            <div class="form-group">
                                <label>End Date <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="end_date" id="end_date" class="form-control" <?php if($this->input->post('end_date')){ echo 'value="'.$this->input->post('end_date').'"'; }else{ echo 'placeholder="End Date"'; } ?> />
                            </div>
                            <?php if (form_error('end_date')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('end_date'); ?></p>
                                </div>
                            <?php } ?> 

                        </div>

                        <div class="col-md-3">

                            <div class="form-group"> 
                                <label>Project </label>
                                <select tabindex="4" class="form-control select2" id="project_id" name="project_id" style="width: 100%;">
                                    <option value="">Project</option>
                                    <?php foreach ($projects as $prjcts) { ?>
                                        <option value="<?php echo $prjcts->id ?>" <?php echo set_select('project_id', $prjcts->id); ?>><?php echo $prjcts->project_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>  
                        </div>


                        <div class="col-md-3">

                            <div class="form-group"> 
                                <label>Team Member </label>
                                <select tabindex="4" class="form-control select2" id="user_id" name="user_id" style="width: 100%;">
                                    <option value="">Team Member</option>
                                    <?php foreach ($team_members as $temem) { ?>
                                        <option value="<?php echo $temem->id ?>" <?php echo set_select('user_id', $temem->id); ?>><?php echo $temem->first_name." ".$temem->last_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>  
                        </div>

                    </div>  
 
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button> 
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section> 
<?php if (!empty($activities)) { $sum_of_hours = 0; ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- /.box-header -->
                <div class="box-body table-responsive"> 
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="6%">SN</th>
                                <th width="10%">Date</th> 
                                <th width="12%">Project</th> 
                                <th width="40%">Activity</th> 
                                <th width="10%">Hour Spent</th>  
                                <th width="10%">Status</th>  
                                <th width="12%">Team Member</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($activities)) {
                            $i = count($activities); 
                            
                            foreach ($activities as $actvts) {
                                ?>                       
                                <tr> 
                                    <td><?php echo $i--; ?></td> 
                                    <td><?php echo date(dateFormatForPHP(), strtotime($actvts->date)); ?></td> 
                                    <td><?php echo getProjectName($actvts->project_id); ?></td> 
                                    <td style="text-align: justify;"><?php echo $actvts->activity; ?></td> 
                                    <td><?php echo $actvts->hour_spent."H"; $sum_of_hours += $actvts->hour_spent; ?></td>     
                                    <td><?php echo $actvts->status; ?></td>     
                                    <td><?php echo getUserName($actvts->user_id); ?></td>     
                                </tr>
                                <?php
                            } }
                            ?> 

                            <tr> 
                                <th>&nbsp;</th> 
                                <th>&nbsp;</th> 
                                <th>&nbsp;</th> 
                                <th>&nbsp;</th> 
                                <th style="color: red;">Sum: <?php echo $sum_of_hours; ?></th>     
                                <th>&nbsp;</th>     
                                <th>&nbsp;</th>     
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Date</th> 
                                <th>Project</th> 
                                <th>Activity</th> 
                                <th>Hour Spent</th>  
                                <th>Team Member</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div> 
        </div> 
    </div>
</section>  
<?php } ?>
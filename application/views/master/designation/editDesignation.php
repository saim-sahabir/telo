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
        Edit Designation
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open(base_url('Master/addEditDesignation/' . $encrypted_id)); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Designation Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="designation_name" class="form-control" placeholder="Designation Name" value="<?php echo $dsgn_info->designation_name; ?>">
                            </div>
                            <?php if (form_error('designation_name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('designation_name'); ?></p>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Description</label>
                                <input tabindex="2" type="text" name="description" class="form-control" placeholder="Description" value="<?php echo $dsgn_info->description; ?>">
                            </div>
                            <?php if (form_error('description')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('description'); ?></p>
                                </div>
                            <?php } ?> 

                        </div> 

                    </div>
                    <!-- /.box-body --> 
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>Master/designations"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?> 
            </div>
        </div>
    </div>
</section>
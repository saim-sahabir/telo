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
        Edit Member
    </h1>  
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">  
                <!-- form start -->
                <?php echo form_open(base_url('User/addEditUser/'.$encrypted_id)); ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>First Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $user_info->first_name; ?>">
                            </div>
                            <?php if (form_error('first_name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('first_name'); ?></span>
                                </div>
                            <?php } ?>

                            <div class="form-group">
                                <label>Email Address <span class="required_star">*</span></label>
                                <input tabindex="3" type="text" name="email_address" class="form-control" placeholder="Email Address" value="<?php echo $user_info->email_address; ?>">
                            </div>
                            <?php if (form_error('email_address')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('email_address'); ?></span>
                                </div>
                            <?php } ?> 

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Last Name <span class="required_star">*</span></label>
                                <input tabindex="2" type="text" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $user_info->last_name; ?>">
                            </div>
                            <?php if (form_error('last_name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <span class="error_paragraph"><?php echo form_error('last_name'); ?></span>
                                </div>
                            <?php } ?> 
                            
                            <?php if($user_info->designation_id != NULL){ ?>
                            <div class="form-group"> 
                                <label>Designation <span class="required_star">*</span></label>
                                <select tabindex="4" class="form-control select2" id="designation_id" name="designation_id" style="width: 100%;">
                                    <option value="">Designation</option>
                                    <?php foreach ($designations as $dsgns) { ?>
                                        <option value="<?php echo $dsgns->id ?>" 
                                            <?php 
                                            if ($user_info->designation_id == $dsgns->id) {
                                                echo "selected";
                                            }  
                                            ?>
                                            >
                                            <?php echo $dsgns->designation_name ?></option>
                                    <?php } ?>
                                </select>
                            </div> 
                            <?php if (form_error('designation_id')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('designation_id'); ?></p>
                                </div>
                            <?php } ?> 
                            <?php } ?>
                        </div>
 
                    </div>  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <a href="<?php echo base_url() ?>User/users"><button type="button" class="btn btn-primary">Back</button></a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
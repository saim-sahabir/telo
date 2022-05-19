<style type="text/css">
    .required_star{
        color: #dd4b39;
    }

    .radio_button_problem{
        margin-bottom: 19px;
    }
</style>

<?php
if ($this->session->flashdata('exception')) {

    echo '<section class="content-header"><div class="alert alert-success alert-dismissible"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-check"></i>';
    echo $this->session->flashdata('exception');
    echo '</p></div></section>';
}
?> 
<section class="content-header">
    <h1>
        Organization Profile 
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">

        <!-- left column -->
        <div class="col-md-12">
            <div class="box box-primary"> 
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo form_open(base_url('Authentication/updateOrganizationProfile')); ?>
                <div class="box-body">
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label>Organization Name <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="org_name" class="form-control" placeholder="Organization Name" value="<?php echo $org_information->org_name; ?>">
                            </div>
                            <?php if (form_error('org_name')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('org_name'); ?></p>
                                </div>
                            <?php } ?>  

                            <div class="form-group">
                                <label>Date Format <span class="required_star">*</span></label>
                                <select tabindex="2" class="form-control select2" name="date_format" id="date_format" style="width: 100%;">
                                    <option value="">Select</option> 
                                    <option value="d/m/Y" 
                                    <?php
                                    if ($org_information->date_format == 'd/m/Y') {
                                        echo "selected";
                                    }
                                    ?>
                                            >D/M/Y
                                    </option>                            
                                    <option value="m/d/Y" 
                                    <?php
                                    if ($org_information->date_format == 'm/d/Y') {
                                        echo "selected";
                                    }
                                    ?>
                                            >M/D/Y
                                    </option>                          
                                    <option value="Y/m/d" 
                                    <?php
                                    if ($org_information->date_format == 'Y/m/d') {
                                        echo "selected";
                                    }
                                    ?>
                                            >Y/M/D
                                    </option> 
                                </select>
                            </div>
                            <?php if (form_error('date_format')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('date_format'); ?></p>
                                </div>
                            <?php } ?> 

                            <div class="form-group">
                                <label>Company Email <span class="required_star">*</span></label>
                                <input tabindex="1" type="text" name="company_email" class="form-control" placeholder="Company Email" value="<?php echo $org_information->company_email; ?>">
                            </div>
                            <?php if (form_error('company_email')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('company_email'); ?></p>
                                </div>
                            <?php } ?>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address <span class="required_star">*</span></label>
                                <textarea tabindex="3" class="form-control" rows="7" id="address" name="address" placeholder="Enter ..."><?php echo $org_information->address; ?></textarea>
                            </div>
                            <?php if (form_error('address')) { ?>
                                <div class="alert alert-error" style="padding: 5px !important;">
                                    <p><?php echo form_error('address'); ?></p>
                                </div>
                            <?php } ?>  
                        </div>


                        <!-- /.box-body -->
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div> 
</section>
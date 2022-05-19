<?php
if ($this->session->flashdata('exception')) {

    echo '<section class="content-header"><div class="alert alert-success alert-dismissible"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-check"></i>';
    echo $this->session->flashdata('exception');
    echo '</p></div></section>';
}
?> 

<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
</style>

<section class="content-header">
    <div class="row">
        <div class="col-md-6">
            <h2 class="top-left-header">Members </h2>
        </div>
        <div class="col-md-offset-4 col-md-2">
            <a href="<?php echo base_url() ?>User/addEditUser"><button type="button" class="btn btn-block btn-primary pull-right">Add Member</button></a>
        </div>
    </div> 
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary"> 
                <!-- /.box-header -->
                <div class="box-body"> 
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>First Name</th> 
                                <th>Last Name</th> 
                                <th>Email Address</th> 
                                <th>Designation/Role</th> 
                                <th>Status</th> 
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($users && !empty($users)) {
                                $i = count($users);
                            }
                            foreach ($users as $usrs) {
                                ?>                       
                                <tr> 
                                    <td><?php echo $i--; ?></td> 
                                    <td><?php echo $usrs->first_name; ?></td> 
                                    <td><?php echo $usrs->last_name; ?></td> 
                                    <td><?php echo $usrs->email_address; ?></td> 
                                    <td>
                                        <?php
                                        if ($usrs->designation_id == 0) {
                                            echo "Admin";
                                        } else {
                                            echo getDesignationName($usrs->designation_id);
                                        }
                                        ?>

                                    </td>  
                                    <td><?php echo $usrs->active_inactive; ?></td>  
                                    <td> 
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear tiny-icon"></i><span class="caret"></span>
                                            </button>

                                            <ul class="dropdown-menu" role="menu">  
                                                <?php if ($usrs->designation_id != 0) {
                                                    if ($usrs->active_inactive == 'Active') {
                                                        ?>
                                                        <li>
                                                            <a href="<?php echo base_url() ?>User/deactivateUser/<?php echo $this->custom->encrypt_decrypt($usrs->id, 'encrypt'); ?>" ><i class="fa fa-times tiny-icon"></i>Deactivate</a>
                                                        </li>
                                                    <?php } else { ?>
                                                        <li>
                                                            <a href="<?php echo base_url() ?>User/activateUser/<?php echo $this->custom->encrypt_decrypt($usrs->id, 'encrypt'); ?>" ><i class="fa fa-check tiny-icon"></i>Activate</a>
                                                        </li>
                                                    <?php }
                                                } ?>
                                                <li>
                                                    <a href="<?php echo base_url() ?>User/addEditUser/<?php echo $this->custom->encrypt_decrypt($usrs->id, 'encrypt'); ?>" ><i class="fa fa-pencil tiny-icon"></i>Edit</a>
                                                </li>
    <?php if ($usrs->designation_id != 0) { ?>
                                                    <li>
                                                        <a class="delete" href="<?php echo base_url() ?>User/deleteUser/<?php echo $this->custom->encrypt_decrypt($usrs->id, 'encrypt'); ?>" ><i class="fa fa-trash tiny-icon"></i>Delete</a>
                                                    </li> 
    <?php } ?>
                                            </ul> 
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>First Name</th> 
                                <th>Last Name</th> 
                                <th>Email Address</th> 
                                <th>Designation/Role</th> 
                                <th>Status</th> 
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div> 
        </div> 
    </div>
</section> 
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script>
    $(function () { 
        $('#datatable').DataTable({ 
            'autoWidth'   : false,
            'ordering'    : false
        })
    })
</script>

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
            <h2 class="top-left-header">My Activities </h2>
        </div>
        <div class="col-md-offset-4 col-md-2">
            <a href="<?php echo base_url() ?>Activity/addEditActivity"><button type="button" class="btn btn-block btn-primary pull-right">Add Activity</button></a>
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
                                <th width="5%">SN</th>
                                <th width="8%">Date</th> 
                                <th width="15%">Project</th> 
                                <th width="36%">Activity</th> 
                                <th width="12%">Hour Spent</th>  
                                <th width="12%">Status</th>  
                                <th width="12%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($activities && !empty($activities)) {
                                $i = count($activities);
                            }
                            foreach ($activities as $actvts) {
                                ?>                       
                                <tr> 
                                    <td><?php echo $i--; ?></td> 
                                    <td><?php echo date(dateFormatForPHP(), strtotime($actvts->date)); ?></td> 
                                    <td><?php echo getProjectName($actvts->project_id); ?></td> 
                                    <td><?php echo $actvts->activity; ?></td> 
                                    <td><?php echo $actvts->hour_spent."H"; ?></td>    
                                    <td><?php echo $actvts->status; ?></td>    
                                    <td> 
                                        <?php if(($this->session->userdata('designation_id') == NULL) || (date('Y-m-d') == $actvts->date) ){?> 
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-gear tiny-icon"></i><span class="caret"></span>
                                            </button>
                                            
                                            <ul class="dropdown-menu" role="menu">   
                                                <li>
                                                    <a href="<?php echo base_url() ?>Activity/addEditActivity/<?php echo $this->custom->encrypt_decrypt($actvts->id, 'encrypt'); ?>" ><i class="fa fa-pencil tiny-icon"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a class="delete" href="<?php echo base_url() ?>Activity/deleteActivity/<?php echo $this->custom->encrypt_decrypt($actvts->id, 'encrypt'); ?>" ><i class="fa fa-trash tiny-icon"></i>Delete</a>
                                                </li>  
                                            </ul>
                                        </div>
                                            <?php } ?> 
                                    </td>
                                </tr>
                                <?php
                            }
                            ?> 
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Date</th> 
                                <th>Project</th> 
                                <th>Activity</th> 
                                <th>Hour Spent</th>  
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

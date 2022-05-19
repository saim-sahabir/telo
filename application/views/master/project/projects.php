<?php
 if($this->session->flashdata('exception')){

    echo '<section class="content-header"><div class="alert alert-success alert-dismissible"> 
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <p><i class="icon fa fa-check"></i>';
    echo $this->session->flashdata('exception');
    echo '</p></div></section>';
}
 
?> 

<section class="content-header">
      <h1>
        Projects
      </h1> 
            <ol class="breadcrumb">
         
      <a href="<?php echo base_url() ?>Master/addEditProject"><button type="button" class="btn btn-block btn-primary pull-right">Add Project</button></a>
      </ol>
    </section>

    <section class="content">
<div class="row">
    <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary"> 
    <!-- /.box-header -->
    <div class="box-body"> 
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Project Name</th>
                    <th>Description</th> 
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($projects && !empty($projects)) {
                    $i = count($projects);
                }
                foreach ($projects as $pi) {
                    ?>                       
                    <tr> 
                        <td><?php echo $i--; ?></td> 
                        <td><?php echo $pi->project_name; ?></td> 
                        <td><?php echo $pi->description; ?></td>  
                        <td> 
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-gear tiny-icon"></i><span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu"> 
                                    <li><a href="<?php echo base_url() ?>Master/addEditProject/<?php echo $this->custom->encrypt_decrypt($pi->id, 'encrypt'); ?>" ><i class="fa fa-pencil tiny-icon"></i>Edit</a></li>
                                    <li><a class="delete" href="<?php echo base_url() ?>Master/deleteProject/<?php echo $this->custom->encrypt_decrypt($pi->id, 'encrypt'); ?>" ><i class="fa fa-trash tiny-icon"></i>Delete</a></li> 
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
                    <th>Project Name</th>
                    <th>Description</th> 
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
<script>
    $(function () { 
        $('#datatable').DataTable({ 
            'autoWidth'   : false,
            'ordering'    : false
        })
    })
</script>

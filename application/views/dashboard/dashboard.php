
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- ChartJS -->
<script src="<?php echo base_url(); ?>assets/bower_components/chart.js/Chart.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

<script>    

    $(function () { 

        //Date picker
        $('#date').datepicker({
            format: date_format,
            autoclose: true
        }) 

        $('#submit').click(function(){
            var date = $('#date').val();

            if (date == 'Date') {
                alert('Please select a date');
                return false;
            }
        })
    })
</script>

<style type="text/css">
    .top-left-header{
        margin-top: 0px !important;
    }
    .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
        border: 1px solid #000;
    }
    .table > thead > tr > th {
        border-bottom: 2px solid;
    }
</style> 

<section class="content-header">
    <div class="row">
        <div class="col-md-2">
            <h2 class="top-left-header">Dashboard </h2>
        </div>
        <?php echo form_open(base_url('Dashboard/dashboard')); ?>
        <div class="col-md-2"> 
            <div class="form-group"> 
                <input type="text" name="date" id="date" class="form-control" placeholder="Date" 
                <?php if($this->input->post('date')){ echo 'value="'.$this->input->post('date').'"'; }else{ echo 'placeholder="Date"'; } ?>> 
            </div>  
        </div>
        <div class="col-md-2 col-sm-12"> 
            <div class="form-group">  
                <button type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">Submit</button>
            </div>  
        </div>
        <?php echo form_close(); ?>
    </div> 
</section>

<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Team Members</span>
                    <span class="info-box-number"><?php echo $team_member_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Projects</span>
                    <span class="info-box-number"><?php echo $project_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-clock-o"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Hours Spent</span>
                    <span class="info-box-number"><?php echo $total_hour_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-tasks"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Activities</span>
                    <span class="info-box-number"><?php echo $activity_count; ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Team Member's <strong><?php echo date(dateFormatForPHP(), strtotime($date)); ?></strong> Date Activity</h3>  <small>(Ordered by Name)</small>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th width="3%">#</th>
                            <th width="15%">Team Member</th>
                            <th width="72%">Activities</th>
                            <th width="10%">Total Hours</th>
                        </tr>

                        <?php
                        if ($team_members && !empty($team_members)) {
                            $i = count($team_members);
                            foreach ($team_members as $teme) {
                                ?>
                                <tr>
                                    <td><?php echo $i--; ?></td>
                                    <td><?php echo $teme->first_name . " " . $teme->last_name; ?></td>
                                    <td>
                                        <table class="table table-condensed">
                                            <?php
                                            $members_activity = getMembersActivity($date, $teme->id);
                                            if ($members_activity && !empty($members_activity)) {
                                                ?>
                                                <thead>
                                                    <tr>
                                                        <th width="5%">#</th>
                                                        <th width="60%">Task</th>
                                                        <th width="15%">Hours Spent</th>
                                                        <th width="10%">Status</th>
                                                        <th width="10%">Project</th>
                                                    </tr> 
                                                </thead>
                                                <?php
                                            }
                                            if ($members_activity && !empty($members_activity)) {
                                                $j = count($members_activity);
                                                foreach ($members_activity as $meac) {
                                                    ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $j--; ?></td>
                                                            <td style="text-align: justify;"><?php echo $meac->activity; ?></td>
                                                            <td><?php echo $meac->hour_spent . "H"; ?></td>
                                                            <td><?php echo $meac->status; ?></td>
                                                            <td><?php echo getProjectName($meac->project_id); ?></td>
                                                        </tr>                            
                                                    </tbody>
                                                    <?php
                                                }
                                            } else {
                                                echo "<p style='color: red; text-align: center;'>No Activity!</p>";
                                            }
                                            ?>
                                        </table> 
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            $hour_spent = getMembersActivityHours($date, $teme->id)->hour_spent;
                                            if ($hour_spent && !empty($hour_spent)) {
                                                echo $hour_spent . "H";
                                            }
                                            ?>
                                        </span>
                                    </td>
                                </tr>   
                                <?php 
                            }
                        } ?>
                    </table>
                </div>
                <!-- /.box-body --> 
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->  
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Project's <strong><?php echo date(dateFormatForPHP(), strtotime($date)); ?></strong> Date Progress</h3>  <small>(Ordered by Name)</small>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered">
                        <tr> 
                            <th width="3%">#</th>
                            <th width="15%">Project Name</th>
                            <th width="72%">Activities</th>
                            <th width="10%">Total Hours</th>
                        </tr>

                        <?php
                        if ($projects && !empty($projects)) {
                            $i = count($projects);
                            foreach ($projects as $prjcts) {
                                ?>
                                <tr>
                                    <td><?php echo $i--; ?></td>
                                    <td><?php echo $prjcts->project_name; ?></td>
                                    <td>
                                        <table class="table table-condensed">
                                            <?php
                                            $project_activity = getProjectsActivity($date, $prjcts->id);
                                            if ($project_activity && !empty($project_activity)) {
                                                ?>
                                                <thead> 
                                                    <tr>
                                                        <th width="3%">#</th>
                                                        <th width="67%">Task</th>
                                                        <th width="15%">Team Member</th>
                                                        <th width="15%">Hours Spent</th>
                                                    </tr>
                                                </thead>
                                                <?php
                                            }
                                            if ($project_activity && !empty($project_activity)) {
                                                $j = count($project_activity);
                                                foreach ($project_activity as $meac) {
                                                    ?>
                                                    <tbody> 
                                                        <tr>
                                                            <td><?php echo $j--; ?></td>
                                                            <td style="text-align: justify;"><?php echo $meac->activity; ?></td>
                                                            <td><?php echo getUserName($meac->user_id); ?></td>
                                                            <td><?php echo $meac->hour_spent . "H"; ?></td>
                                                        </tr> 
                                                    </tbody>
                                                    <?php
                                                }
                                            } else {
                                                echo "<p style='color: red; text-align: center;'>No Activity!</p>";
                                            }
                                            ?>
                                        </table> 
                                    </td>
                                    <td>
                                        <span>
                                            <?php
                                            $hour_spent = getProjectsActivityHours($date, $prjcts->id)->hour_spent;
                                            if ($hour_spent && !empty($hour_spent)) {
                                                echo $hour_spent . "H";
                                            }
                                            ?>

                                        </span>
                                    </td>
                                </tr>   
                                <?php 
                            }
                        }
                        ?>
                    </table>
                </div>
                <!-- /.box-body --> 
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->  
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Team Hours</h3>
 
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Project Hours</h3> 
                </div>
                <div class="box-body">
                    <div class="chart">
                        <canvas id="barChart2" style="height:230px"></canvas>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>


<script type="text/javascript">
    var date_format = <?php echo "'" . dateFormatForJS() . "'"; ?>;
    $(function () {

        //Date picker
        $('#date').datepicker({
            format: date_format,
            autoclose: true
        }) 

        <?php 

        $project = getAllByTable('tbl_projects');
        $project_name_container = '';
        $project_hours = '';

        if (!empty($projects)) {
            foreach ($project as $prjcts) { 
                $project_name_container .= "'".substr($prjcts->project_name, 0, 4)."',";
                $project_hours .= "'".getProjectHours($prjcts->id)->project_hours."',";
            }

            $project_name_container = substr($project_name_container, 0, -1); 
            $project_hours = substr($project_hours, 0, -1);  
        } 

        $users = getAllByTable('tbl_users');
        $user_name_container = '';
        $user_hours = '';

        if (!empty($users)) {
            foreach ($users as $usrs) { 
                $user_name_container .= "'".substr($usrs->first_name, 0, 4)."',";
                $user_hours .= "'".getUserHours($usrs->id)->user_hours."',";
            }

            $user_name_container = substr($user_name_container, 0, -1); 
            $user_hours = substr($user_hours, 0, -1);  
        }

        ?>
        
 
        var areaChartData = {
            labels  : [<?php echo $project_name_container;?>], 
            datasets: [
            {
                label               : 'Electronics',
                fillColor           : 'rgba(210, 214, 222, 1)',
                strokeColor         : 'rgba(210, 214, 222, 1)',
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : []
            },
            {
                label               : 'Digital Goods',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [<?php echo $project_hours; ?>] 
            }
            ]
        }

        var areaChartData2 = {
            labels  : [<?php echo $user_name_container;?>],
            datasets: [
            {
                label               : 'Electronics',
                fillColor           : 'rgba(210, 214, 222, 1)',
                strokeColor         : 'rgba(210, 214, 222, 1)',
                pointColor          : 'rgba(210, 214, 222, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data                : []
            },
            {
                label               : 'Digital Goods',
                fillColor           : 'rgba(60,141,188,0.9)',
                strokeColor         : 'rgba(60,141,188,0.8)',
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : [<?php echo $user_hours; ?>]
            }
            ]
        }

        /*
        var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale               : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : false,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - Whether the line is curved between points
        bezierCurve             : true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension      : 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot                : false,
        //Number - Radius of each point dot in pixels
        pointDotRadius          : 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth     : 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius : 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke           : true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth      : 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill             : true,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio     : true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)*/


    /*
    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
    {
        value    : 700,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Chrome'
    },
    {
        value    : 500,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'IE'
    },
    {
        value    : 400,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'FireFox'
    },
    {
        value    : 600,
        color    : '#00c0ef',
        highlight: '#00c0ef',
        label    : 'Safari'
    },
    {
        value    : 300,
        color    : '#3c8dbc',
        highlight: '#3c8dbc',
        label    : 'Opera'
    },
    {
        value    : 100,
        color    : '#d2d6de',
        highlight: '#d2d6de',
        label    : 'Navigator'
    }
    ]
    var pieOptions     = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke    : true,
        //String - The colour of each segment stroke
        segmentStrokeColor   : '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth   : 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps       : 100,
        //String - Animation easing effect
        animationEasing      : 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate        : true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale         : false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive           : true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio  : true,
        //String - A legend template
        legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
    */


    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions);

    //-------------
    //- BAR CHART 2 -
    //-------------
    var barChartCanvas2                   = $('#barChart2').get(0).getContext('2d')
    var barChart2                         = new Chart(barChartCanvas2)
    var barChartData2                     = areaChartData2
    barChartData2.datasets[1].fillColor   = '#00a65a'
    barChartData2.datasets[1].strokeColor = '#00a65a'
    barChartData2.datasets[1].pointColor  = '#00a65a'
    var barChartOptions2                  = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
    }

    barChartOptions2.datasetFill = false
    barChart2.Bar(barChartData2, barChartOptions2)
});
</script>

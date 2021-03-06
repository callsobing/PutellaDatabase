<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PutellaDatabase - Results</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>Plutella</span>DATABASE</a>

        </div>

    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li><a href="index.html"><svg class="glyph stroked home"><use xlink:href="#stroked-home"/></svg> Introduction </a></li>
        <li><a href="SubmitJob.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Submit Jobs</a></li>
        <li><a href="JobHistory.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Job History</a></li>
        <li class="active"><a href="Results.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Results</a></li>

    </ul>

</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <div class="col-lg-12">
            <!--				<h1 class="page-header">Forms</h1>-->
            <font color="#f5f5f5">.</font>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Get your Job result</div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <form action="Results.php" method="get">

                            <div class="form-group">
                                <label>Your Job_id:</label>
                                <input class="form-control" name="jobid" placeholder="type-in your job id here...">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">Blastn Result</div>
            <div class="panel-body">
                <table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <tr>
                        <th data-checkbox="true" >Query</th>
                        <th data-checkbox="true" >Subject</th>
                        <th data-checkbox="true" >% id</th>
                        <th data-checkbox="true" >alignment length</th>
                        <th data-checkbox="true" >mismatches</th>
                        <th data-checkbox="true" >gap openings</th>
                        <th data-checkbox="true" >q.start</th>
                        <th data-checkbox="true" >q.end</th>
                        <th data-checkbox="true" >s.start</th>
                        <th data-checkbox="true" >s.end</th>
                        <th data-checkbox="true" >e-value</th>
                        <th data-checkbox="true" >bit score</th>
                    </tr>
                    <?Php
                    $path_prefix = "var/";
                    $job_id = $_GET["jobid"];

                    if($job_id!=null) {
                        $f = fopen("$path_prefix$job_id.output", "r");
                        $fr = fread($f, filesize("$path_prefix$job_id.output"));
                        fclose($f);
                        $lines = array();
                        $lines = explode("\n",$fr); // IMPORTANT the delimiter here just the "new line" \r\n, use what u need instead of...

                        for($i=0;$i<count($lines)-1;$i++)
                        {
                            echo "<tr>";
                            $cells = array();
                            $cells = explode("\t",$lines[$i]); // use the cell/row delimiter what u need!
                            for($k=0;$k<count($cells);$k++)
                            {
                                if($k==1){

                                    echo "<td><a href=\"contig.php?contig=$cells[$k]\">" . $cells[$k] . "</a></td>";
                                } else {
                                    echo "<td>" . $cells[$k] . "</td>";
                                }
                            }
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div><!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script>
    !function ($) {
        $(document).on("click","ul.nav li.parent > a > span.icon", function(){
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
</body>

</html>

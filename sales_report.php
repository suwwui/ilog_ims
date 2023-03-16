<?php
$page_title = 'Sale Report';
  require_once('includes/load.php');
  
?>
<?php include_once('header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
      <strong>
            <span class="fa fa-th"></span>
            <span>Sales Report</span>
         </strong>

      </div>
      <div class="card-body">
          <form class="clearfix" method="post" action="report_process.php">
            <div class="form-group">
              <label class="form-label">Date Range</label>
                <div class="input-group">
                  <input type="date" class="form-control" data-provide= "datepicker" name="start-date" placeholder="From">
                  <span class="input-group-addon"><i class="fa fa-angle-double-right"></i></span>
                  <input type="date" class="form-control" data-provide= "datepicker" name="end-date" placeholder="To">
                </div>
                
                <script type="text/javascript">$(document).ready(function(){$("#start-date").datepicker();});</script>
            </div>
            <div class="form-group">
                 <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
            </div>
          </form>
      </div>

    </div>
  </div>

</div>
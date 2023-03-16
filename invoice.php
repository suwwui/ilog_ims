<?php
$page_title = 'Invoices';
  require_once('includes/load.php');
  $all_sales = find_all('sales');
  
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
            <span>Invoice</span>
         </strong>

      </div>
      <div class="card-body">
          <form class="clearfix" method="post" action="invoice_process.php">
            <div class="form-group">
              <label class="form-label">Sales ID</label>
                
                  <div class="input-group">
                    <select class="form-control" name="ID">
                      <option value="">Select Sales ID</option>
                    <?php  foreach ($all_sales as $sales): ?>
                      <option value="<?php echo (int)$sales['ID'] ?>">
                        <?php echo $sales['customer'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                
               
            
            <div class="form-group">
                 <button type="submit" name="submit1" class="btn btn-primary">Generate Invoice</button>
            </div>
          </form>
      </div>

    </div>
  </div>

</div>
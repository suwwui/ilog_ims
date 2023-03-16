<?php
  $page_title = 'All vendor';
  require_once('includes/load.php');
  
  $all_vendors = find_all('vendor')
?>

<?php include_once('header.php'); ?>


    <div class="card text-center">
    <div class="card-header text-blue bg-white">
      <div class="card-header">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Vendor</span>
       </strong>
       <div class="pull-right">
       <a href="add_vendor.php" class="btn btn-primary">New Vendor</a>
       </div>
      </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                <th class="text-center" style="width: 15%;">ID</th>
                <th class="text-center" style="width: 50px;"> Name </th>
                <th class="text-center" style="width: 15%;"> PIC </th>
                <th class="text-center" style="width: 15%;"> Contact </th>
                <th class="text-center" style="width: 15%;"> Address </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_vendors as $vendor):?>
                <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($vendor['Name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($vendor['PIC']); ?></td>
                <td class="text-center"> <?php echo remove_junk($vendor['contact']); ?></td>
                <td class="text-center"> <?php echo remove_junk($vendor['address']); ?></td>
                <td class="text-center">
                <div class="btn-group">
                <a href="edit_vendor.php?ID=<?php echo (int)$vendor['ID'];?>"class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                     <span class= "fa fa-pencil-square"></span></a>  
                  <a href="delete_vendor.php?ID=<?php echo (int)$vendor['ID'];?>"class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                  <span class="fa fa-trash"></span></a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
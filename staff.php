<?php
  $page_title = 'All staff';
  require_once('includes/load.php');
  
  $all_staffs = find_all('staff')
?>

<?php include_once('header.php'); ?>


    <div class="card text-center">
    <div class="card-header text-blue bg-white">
      <div class="card-header">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Staff</span>
       </strong>
       <div class="pull-right">
       <a href="add_staff.php" class="btn btn-primary">New Staff</a>
       </div>
      </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                <th class="text-center" style="width: 15%;">ID</th>
                <th class="text-center" style="width: 50px;"> Name </th>
                <th class="text-center" style="width: 15%;"> Age </th>
                <th class="text-center" style="width: 15%;"> Position </th>
                <th class="text-center" style="width: 15%;"> Salary </th>
                <th class="text-center" style="width: 15%;"> Employment Date </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_staffs as $staff):?>
                <tr>
                <td class="text-center"><?php echo remove_junk($staff['ID']);;?></td>
                <td class="text-center"> <?php echo remove_junk($staff['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($staff['age']); ?></td>
                <td class="text-center"> <?php echo remove_junk($staff['position']); ?></td>
                <td class="text-center"> <?php echo remove_junk($staff['salary']); ?></td>
                <td class="text-center"> <?php echo remove_junk($staff['employment_date']); ?></td>
                <td class="text-center">
                <div class="btn-group">
                  <a href="edit_staff.php?ID=<?php echo (int)$staff['ID'];?>"class="btn btn-warning btn-xs"  title="Delete" data-toggle="tooltip">
                     <span class= "fa fa-pencil-square"></span></a>
                  <a href="delete_staff.php?ID=<?php echo $staff['ID'];?>"class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
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
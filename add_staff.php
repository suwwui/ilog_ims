<?php
  $page_title = 'New staff';
  require_once('includes/load.php');
  $all_staffs = find_all('staff');
  
?>
<?php
 if(isset($_POST['add_staff'])){
   $req_field = array('ID','name','age','position','salary','employment_date');
   validate_fields($req_field);
   if(empty($errors)){
    $st_ID  = remove_junk($db->escape($_POST['ID']));
    $st_name   = remove_junk($db->escape($_POST['name']));
    $st_age  = remove_junk($db->escape($_POST['age']));
    $st_position  = remove_junk($db->escape($_POST['position']));
    $st_salary  = remove_junk($db->escape($_POST['salary']));
    $st_date     = remove_junk($db->escape($_POST['employment_date']));
    

    $query  = "INSERT INTO staff (";
    $query .=" ID,name,age,position,salary,employment_date";
    $query .=") VALUES (";
    $query .=" '{$st_ID}', '{$st_name}','{$st_age}', '{$st_position}', '{$st_salary}','{$st_date}'";
    $query .=")";
    
    if($db->query($query)){
      $session->msg('s',"Staff Information Registered");
      redirect('staff.php', false);
    } else {
      $session->msg('d',' Unregistered');
      redirect('add_staff.php', false);
    }

  } else{
    $session->msg("d", $errors);
    redirect('add_staff.php',false);
  }
 }
?>
<?php include_once('header.php'); ?>

<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
 <div class="card-transparent">
  <div class="col-md-5">
    <div class="card card-default">
      <div class="card-header">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Staff</span>
       </strong>
      </div>
      <div class="card-body">
      <div class="col-md-12">
        <form method="post" action="add_staff.php" class="clearfix">
        <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                 <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="ID" placeholder="Staff ID">
             </div>
        </div>

        <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                 <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="name" placeholder="Staff Name">
             </div>
        </div>
      <div class="form-group">
          <div class="row">
          <div class="col-md-5">
                 <div class="input-group">
                   <span class="input-group-addon">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                   </span>
                   <input type="number" class="form-control" name="age" placeholder="Age">
                </div>
               </div>
           </div>
      </div>
      
        <div class="form-group">
                 <div class="input-group">
                   <span class="input-group-addon">
                     <i class="glyphicon glyphicon-place"></i>
                   </span>
                   <input type="text" class="form-control" name="position" placeholder="Position Offered">
                </div>
               </div>
        

        <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="glyphicon glyphicon-usd"></i>
                    </span>
                    <input type="number" class="form-control" name="salary" placeholder="Salary">
                    <span class="input-group-addon">.00</span>
                </div>
             </div>
          

        <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                 <i class="glyphicon glyphicon-date"></i>
                </span>
                <input type="date" class="form-control" name="employment_date" placeholder="Employement Date">
             </div>
        </div>
</div>

        <div class="pull-right">
          <button type="submit" name="add_staff" class="btn btn-primary">Add Staff</button>
        </div>
      </form>
      
      </div>
    </div>
</div>
</div>
</div>
  
  
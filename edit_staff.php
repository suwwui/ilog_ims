<?php
  $page_title = 'Edit staff';
  require_once('includes/load.php');
 
?>
<?php
$staff = find_by_id('staff',$_GET['ID']);
$all_staffs = find_all('staff');
if(!$staff){
  $session->msg("d","Missing id");
  redirect('staff.php');
}
?>


<?php
 if(isset($_POST['update_staff'])){
   $req_field = array('name','age','position','salary','employment_date');
   validate_fields($req_field);
   if(empty($errors)){
   
    $st_name = remove_junk($db->escape($_POST['name']));
    $st_age      = remove_junk($db->escape($_POST['age']));
    $st_position = remove_junk ($db->escape($_POST['position']));
    $st_salary     = remove_junk ($db->escape((int)$_POST['salary']));
    $st_date   = remove_junk ($db->escape($_POST['employment_date']));

    $query  = "UPDATE staff SET";
    $query .=" name ='{$st_name}', age ='{$st_age}',";
    $query .=" position ='{$st_position}', salary ='{$st_salary}', employment_date ='{$st_date}'";
    $query .=" WHERE ID ='{$staff ['ID']}'";
    $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Data updated ");
                 redirect('staff.php?ID='.$staff['ID'], false);
               } else {
                 $session->msg('d',"Data Remains");
                 redirect('edit_staff.php?ID='.$staff['ID'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_staff.php?ID='.$staff['ID'], false);
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
          <span>Edit</span>
       </strong>
      </div>
      <div class="card-body">
      <div class="col-md-12">
        <form method="post" action="edit_staff.php?ID=<?php echo $staff['ID'];?>">
        
      
        <div class="form-group">
              <<div class="row">
               <div class="col-md-3">
               <div class="input-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo remove_junk($staff['name']); ?>">
             </div>
        </div>
      <div class="form-group">
          <d<div class="row">
               <div class="col-md-3">
               <div class="input-group">
                   <label for="age">Age</label>
                <input type="number" class="form-control" name="age" value="<?php echo remove_junk($staff['age']); ?>">
                </div>
               </div>
           </div>
      </div>
      
        <div class="form-group">
        <div class="row">
               <div class="col-md-3">
               <div class="input-group">
                   <label for="position">Position Offered</label>
                <input type="text" class="form-control" name="position" value="<?php echo remove_junk($staff['position']); ?>">
                </div>
               </div>

        <div class="form-group">
        <div class="row">
               <div class="col-md-3">
               <div class="input-group">
                    <label for="salary">Salary</label>
                <input type="number" class="form-control" name="salary" value="<?php echo remove_junk($staff['salary']); ?>">
                    <span class="input-group-addon">.00</span>
                </div>
             </div>
          

        <div class="form-group">
              <<div class="row">
               <div class="col-md-3">
               <div class="input-group">
                <label for="employment_date">Employment Date</label>
                <input type="date" class="form-control" name="employment_date" value="<?php echo remove_junk($staff['employment_date']); ?>">
             </div>
        </div>
</div>
              <div class="pull-right">
              <button type="submit" name="update_staff" class="btn btn-danger">Update</button>
              </div>
          </form>
         </div>
        </div>
      </div>
    </div>
    
   

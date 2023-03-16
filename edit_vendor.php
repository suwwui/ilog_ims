<?php
  $page_title = 'New vendor';
  require_once('includes/load.php');
  $vendor = find_by_id('vendor',(int)$_GET['ID']);
  $all_vendors = find_all('vendor');
  
?>
<?php
 if(isset($_POST['edit_vendor'])){
   $req_field = array('Name','PIC','contact','address');
   validate_fields($req_field);
   if(empty($errors)){
    
    $v_name   = remove_junk($db->escape($_POST['Name']));
    $v_PIC  = remove_junk($db->escape($_POST['PIC']));
    $v_contact  = remove_junk($db->escape($_POST['contact']));
    $v_address  = remove_junk($db->escape($_POST['address']));
    
    $query  = "UPDATE vendor SET";
    $query  .=" Name ='{$v_name}', PIC ='{$v_PIC}',";
    $query  .=" contact ='{$v_contact}', address ='{$v_address}'";
    $query  .=" WHERE ID ='{$vendor['ID']}'";
    $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Vendor updated ");
                 redirect('vendor.php', false);
               } else {
                 $session->msg('d',"Data Remains");
                 redirect('edit_vendor.php?ID='.$vendor['ID'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_vendor.php?ID='.$vendor['ID'], false);
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
        <form method="post" action="edit_vendor.php?ID=<?php echo (int)$vendor['ID'];?>">

        <div class="form-group">
              <div class="row">
              <div class="col-md-12">
                 <label for="Name">Name</label>
                <input type="text" class="form-control" name="Name" value="<?php echo remove_junk($vendor['Name']); ?>">
             </div>
              </div>
        </div>

      <div class="form-group">
          <div class="row">
               <div class="col-md-5">
               <label for="PIC">PIC Name</label>
                <input type="text" class="form-control" name="PIC" value="<?php echo remove_junk($vendor['PIC']); ?>">
              </div>
           </div>
      </div>

      <div class="form-group">
      <div class="row">
      <div class="col-md-12">
                 <label for="contact">Contact Number</label>
                   <input type="number" class="form-control" name="contact" value="<?php echo remove_junk($vendor['contact']); ?>">
                </div>
               </div>
      </div>
        

        <div class="form-group">
        <div class="row">
      <div class="col-md-12">
                  <label for="address">Address</label>
                   <input type="address" class="form-control" name="address" value="<?php echo remove_junk($vendor['address']); ?>">
                </div>
             </div>
        </div>
          <button type="submit" name="edit_vendor" class="btn btn-primary">Update</button>
      </form>
      </div>
    </div>
  </div>
</div>
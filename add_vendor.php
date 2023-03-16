<?php
  $page_title = 'New vendor';
  require_once('includes/load.php');
  $all_vendors = find_all('vendor');
  
?>
<?php
 if(isset($_POST['add_vendor'])){
   $req_field = array('Name','PIC','contact','address');
   validate_fields($req_field);
   if(empty($errors)){
    
    $v_name   = remove_junk($db->escape($_POST['Name']));
    $v_PIC  = remove_junk($db->escape($_POST['PIC']));
    $v_contact  = remove_junk($db->escape($_POST['contact']));
    $v_address  = remove_junk($db->escape($_POST['address']));
    

    $query  = "INSERT INTO vendor (";
    $query .=" Name,PIC,contact,address";
    $query .=") VALUES (";
    $query .=" '{$v_name}','{$v_PIC}', '{$v_contact}', '{$v_address}' ";
    $query .=")";
    
    if($db->query($query)){
      $session->msg('s',"Staff Information Registered");
      redirect('vendor.php', false);
    } else {
      $session->msg('d',' Unregistered');
      redirect('add_vendor.php', false);
    }

  } else{
    $session->msg("d", $errors);
    redirect('add_vendor.php',false);
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
          <span>Add New Vendor</span>
       </strong>
      </div>
      <div class="card-body">
      <div class="col-md-12">
        <form method="post" action="add_vendor.php" class="clearfix">
        

        <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon">
                 <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" name="Name" placeholder="Vendor Name">
             </div>
        </div>
      <div class="form-group">
          <div class="row">
          <div class="col-md-5">
                 <div class="input-group">
                   <input type="text" class="form-control" name="PIC" placeholder="PIC">
                </div>
               </div>
           </div>
      </div>
      
        <div class="form-group">
                 <div class="input-group">
                   <input type="number" class="form-control" name="contact" placeholder="Contact Number">
                </div>
               </div>
        

        <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" name="address" placeholder="Address">
                    
                </div>
             </div>
          

        <div class="pull-right">
          <button type="submit" name="add_vendor" class="btn btn-primary">Add Vendor</button>
        </div>
      </form>
      
      </div>
    </div>
</div>
</div>
</div>
  
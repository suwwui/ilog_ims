<?php
  $page_title = 'New products';
  require_once('includes/load.php');
  $all_vendors = find_all('vendor');
  ?>
  <?php
 if(isset($_POST['add_product'])){
   $req_field = array('name','quantity','buy_price','sell_price','vendor_id','Status');
   validate_fields($req_field);
   if(empty($errors)){
    $p_name  = remove_junk($db->escape($_POST['name']));
    $p_qty   = remove_junk($db->escape($_POST['quantity']));
    $p_buy   = remove_junk($db->escape($_POST['buy_price']));
    $p_sale  = remove_junk($db->escape($_POST['sell_price']));
    $p_vendor  = remove_junk($db->escape($_POST['vendor_id']));
    $p_status  = remove_junk($db->escape($_POST['Status']));
    if (is_null($_POST['media']) || $_POST['media'] === "") {
      $media = '0';
    } else {
      $media = remove_junk($db->escape($_POST['media']));
    }
    $date    = make_date();
    
    $sql  = "INSERT INTO product (";
    $sql .=" name,media,quantity,buy_price,sell_price,vendor_id,Status,date";
    $sql .=") VALUES (";
    $sql .=" '{$p_name}', '{$media}','{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_vendor}','{$p_status}','{$date}'";
    $sql .=")";
    
    if($db->query($sql)){
      $session->msg('s',"Product added ");
      redirect('product1.php', false);
    } else {
      $session->msg('d',' Sorry failed to added!');
      redirect('product1.php', false);
    }

  } else{
    $session->msg("d", $errors);
    redirect('product1.php',false);
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
            <span>Add New Product</span>
         </strong>
        </div>
        <div class="card-body">
        <div class="col-md-12">
          <form method="post" action="product1.php">
          <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="name" placeholder="Product Name">
               </div>
          </div>
        <div class="form-group">
            <div class="row">
            <div class="col-md-5">
                   <div class="input-group">
                     <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                     <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                  </div>
                 </div>
                 <div class="col-md-7">
                    <select class="form-control" name="media">
                      <option value="">Select Product Photo</option>
                    <?php  foreach ($all_media as $media): ?>
                      <option value="<?php echo (int)$media['id'] ?>">
                        <?php echo $media['file_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
             </div>
        </div>
          <div class="form-group">
                 <div class="col">
                   <div class="input-group">
                     <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                     <input type="number" class="form-control" name="buy_price" placeholder="Buying price">
                     <span class="input-group-addon">.00</span>
                  </div>
                 </div>
                  <div class="col">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="sell_price" placeholder="Selling Price">
                      <span class="input-group-addon">.00</span>
                  </div>
               </div>
            </div>
          
          <div class="form-group">
                <div class="input-group">
                    <select class="form-control" name="vendor_id">
                      <option value="">Select Vendor ID</option>
                    <?php  foreach ($all_vendors as $vendor): ?>
                      <option value="<?php echo (int)$vendor['ID'] ?>">
                        <?php echo $vendor['Name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
             </div>

             <div class="form-group">
               <div class="row">
               <div class="col-md-12">

                      <label for="Status">Status</label>
                      <select class="form-control" name="Status" placeholder="Status">
                       <option value="">Choose product status</option>
                       <option value="Available">Available</option>
                       <option value="Unavailable" >Unavailable</option>
                       <option value="Discontinued">Discontinued</option>
                       </select>
                  </div>
               </div>
              </div> 
          <div class="pull-right">
            <button type="submit" name="add_product" class="btn btn-primary">Add product</button>
          </div>
        </form>
        </div>
        </div>
      </div>
    </div>
    </div>
        
  
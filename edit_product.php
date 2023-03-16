<?php
  $page_title = 'Edit product';
  require_once('includes/load.php');
?>
<?php
$products = find_by_id('product',(int)$_GET['ID']);
$all_products = find_all('product');
$all_photo = find_all('media');
$all_vendors = find_all('vendor');
if(!$products){
  $session->msg("d","Missing product id.");
  redirect('product1.php');
}
?>
<?php
 if(isset($_POST['product'])){
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
    $query  = "UPDATE product SET";
    $query  .=" name ='{$p_name}', quantity ='{$p_qty}',";
    $query  .=" buy_price ='{$p_buy}', sell_price ='{$p_sale}', vendor_id ='{$p_vendor}', Status ='{$p_status}',media='{$media}'";
    $query  .=" WHERE ID ='{$products['ID']}'";
    $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Product updated ");
                 redirect('product1.php', false);
               } else {
                 $session->msg('d',"Data Remains");
                 redirect('edit_product.php?ID='.$products['ID'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?ID='.$products['ID'], false);
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
        <form method="post" action="edit_product.php?ID=<?php echo (int)$products['ID'];?>">

        <div class="form-group">
              <div class="row">
              <div class="col-md-12">
                 <label for="Name">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo remove_junk($products['name']); ?>">
             </div>
              </div>
        </div>

      <div class="form-group">
          <div class="row">
               <div class="col-md-6">
                  <select class="form-control" name="media">
                    <option value="">No Image</option>
                  <?php  foreach ($all_media as $media): ?>
                    <option value="<?php echo (int)$media['ID'] ?>">
                      <?php echo $media['file_name'] ?></option>
                  <?php endforeach; ?>
                  </select>
              </div>
           </div>
      </div>

        <div class="form-group">
             <div class="row">
               <div class="col-md-3">
                 <div class="input-group">
                   <label for="quantity">Quantity</label>
                   <input type="number" class="form-control" name="quantity" value="<?php echo remove_junk($products['quantity']); ?>">
                </div>
               </div>
               <div class="col-md-3">
                 <div class="row">
                   <label for="b-price">Buying Price</label>
                   <input type="number" class="form-control" name="buy_price" value="<?php echo remove_junk($products['buy_price']); ?>">
                   <span class="row-addon">.00</span>
                </div>
               </div>

                <div class="col-md-3">
                  <div class="row">
                    <label for="s-price">Selling Price</label>
                    <input type="number" class="form-control" name="sell_price" value="<?php echo remove_junk($products['sell_price']); ?>">
                    <span class="row-addon">.00</span>
                </div>
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
             
          
        
          <button type="submit" name="product" class="btn btn-primary">Update</button>
      </form>
      </div>
    </div>
  </div>
</div>
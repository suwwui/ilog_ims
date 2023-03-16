<?php
  $page_title = 'Edit sales';
  require_once('includes/load.php');
  $all_products = find_all('product');
?>
<?php
$sales = find_by_id('sales',(int)$_GET['ID']);
if(!$sales){
  $session->msg("d","Missing sales id");
  redirect('sales.php');
}
?>
<?php $products = find_by_id('product',$sales['product_id']); ?>

<?php
 if(isset($_POST['update_sales'])){
   $req_field = array('customer','date','description','quantity','total','payment','status');
   validate_fields($req_field);
   if(empty($errors)){
    $s_product  = ($db->escape((int)$products['ID']));
    $s_customer = remove_junk($db->escape($_POST['customer']));
    $s_date      = remove_junk($db->escape($_POST['date']));
    $s_description = remove_junk ($db->escape($_POST['description']));
    $s_quantity     = remove_junk ($db->escape((int)$_POST['quantity']));
    $s_total   = remove_junk ($db->escape($_POST['total']));
    $s_payment  = remove_junk ($db->escape($_POST['payment']));
    $s_status  = remove_junk($db->escape($_POST['status']));

    $query  = "UPDATE sales SET";
    $query .= " product_id ='{$s_product}', customer ='{$s_customer}',";
    $query .= " date ='{$s_date}', description ='{$s_description}', quantity ='{$s_quantity}',total='{$s_total}',";
    $query .= " payment ='{$s_payment}',status ='{$s_status}'";
    $query .=" WHERE ID ='{$sales ['ID']}'";
    $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 update_product_qty($s_quantity,$s_product);
                 $session->msg('s',"Sales updated ");
                 redirect('sales.php?ID='.$sales['ID'], false);
               } else {
                 $session->msg('d',"Data Remains");
                 redirect('edit_sales.php', false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_sales.php?ID='.$sales['ID'], false);
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
        <form method="post" action="edit_sales.php?ID=<?php echo (int)$sales['ID'];?>">
        <div class="form-group">
                <div class="input-group">
                    <select class="form-control" name="product_id">
                      <option value="">Select Product ID</option>
                    <?php  foreach ($all_products as $product): ?>
                      <option value="<?php echo (int)$product['ID'] ?>">
                        <?php echo $product['name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                  </div>
             </div>

            <div class="form-group">
              <div class="row">
              <div class="col-md-12">
                 <label for="Name">Name</label>
                  <input type="text" class="form-control" name="customer" placeholder="Customer Name" value="<?php echo remove_junk($sales['customer']); ?>">
               </div>
              </div>
            </div>

               
             <div class="form-group">
             <div class="row">
                  <div class="col-md-6">
                   <label for="Date">Date</label>
                     <input type="date" class="form-control" name="date" placeholder="Date" value="<?php echo remove_junk($sales['date']); ?>">
                  </div>
                 </div>
             </div>
             

             <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                 <label for="Desc">Description</label>
                  <input type="text" class="form-control" name="description" value="<?php echo remove_junk($sales['description']); ?>">
               </div>
             </div>
             </div>
        
              <div class="form-group">
               <div class="row">
               <div class="col-md-3">
                 <div class="input-group">
                  <label for="quantity">Quantity</label>
                     <input type="number" class="form-control" name="quantity" value="<?php echo remove_junk($sales['quantity']); ?>">
                  </div>
                 </div>
                 
                  <div class="col-md-6">
                    <div class="row">
                    <label for="total">Total</label>
                      <input type="number" class="form-control" name="total" value="<?php echo remove_junk($sales['total']); ?>">
                  </div>
               </div>
               </div>
              </div>


              <div class="form-group">
               <div class="row">
               <div class="col-md-8">
                      <label for="payment">Payment Type</label>
                      <select class="form-control" name="payment" value="<?php echo remove_junk($sales['payment']); ?>">
                       <option value="">Choose a payment type</option>
                       <option value="Cash">Cash</option>
                       <option value="Online Bankin" >Online Bankin</option>
                       <option value="QR">QR</option>
                       </select>
                  </div>
               </div>
               <div class="row">
               <div class="col-md-7">
                      <label for="status">Status</label>
                       <select class="form-control" name="status" value="<?php echo remove_junk($sales['status']); ?>">
                       <option value="">Choose a status</option>
                       <option value="Approved">Approved</option>
                       <option value="Pending" >Pending</option>
                       <option value="Cancelled">Cancelled</option>
                       </select>
                  </div>
               </div>
              </div>
              </div>
              <div class="pull-right">
              <button type="submit" name="update_sales" class="btn btn-danger">Update</button>
              </div>
          </form>
         </div>
        </div>
      </div>
    </div>
    <div class="card text-center">
    <div class="card-header text-blue bg-white">
      <div class="card-header">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Products</span>
       </strong>
         </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th class="text-center" style="width: 15%;"> Product Name </th>
                <th> Media</th>
                <th class="text-center" style="width: 15%;"> Quantity </th>
                <th class="text-center" style="width: 15%;"> Buying Price </th>
                <th class="text-center" style="width: 15%;"> Selling Price </th>
                <th class="text-center" style="width: 15%;"> Vendor </th>
                <th class="text-center" style="width: 15%;"> Product Added </th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_products as $product):?>
                <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td class="text-center"> <?php echo remove_junk($product['name']); ?></td>
                <td>
                  <?php if($product['media'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['media']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sell_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['vendor']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>

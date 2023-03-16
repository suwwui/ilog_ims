<?php
$page_title = 'Add Sale';
require_once('includes/load.php');
$all_products = find_all('product');
$all_media = find_all('media');
?>
<?php
 if(isset($_POST['add_sales'])){
   $req_fields = array('product_id','customer','date','description','quantity','total','payment','status' );
   validate_fields($req_fields);
   if(empty($errors)){
          $s_product    = $db->escape($_POST['product_id']);
          $s_customer  = $db->escape($_POST['customer']);
          $s_date      = $db->escape($_POST['date']);
          $s_description = $db->escape($_POST['description']);
          $s_quantity     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $s_payment  = $db->escape($_POST['payment']);
          $s_status  = $db->escape($_POST['status']);
          

          $query  = "INSERT INTO sales (";
          $query .=" product_id,customer,date,description,quantity,total,payment,status";
          $query .=") VALUES (";
          $query .="'{$s_product}','{$s_customer}','{$s_date}','{$s_description}','{$s_quantity}','{$s_total}','{$s_payment}','{$s_status}'";
          $query .=")";
          

                if($db->query($query)){
                  update_product_qty($s_quantity,$s_product);
                  $session->msg('s',"Sale added. ");
                  redirect('sales.php', false);
                } else {
                  $session->msg('d',' Sorry failed to add!');
                  redirect('sales.php', false);
                }
        } else {
           $session->msg("d", $errors);
           redirect('add_sales.php',false);
        }
  }

?>
<?php include_once('header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    
  </div>
</div>
<div class="card-transparent">
    <div class="col-md-7">
      <div class="card card-default">
        <div class="card-header">
          <strong>
            
            <span>Add New Sales</span>
         </strong>
        </div>
        <div class="card-body">
         <div class="col-md-12">
          <form method="post" action="add_sales.php" class="clearfix">


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
                <div class="input-group">
                  
                  <input type="text" class="form-control" name="customer" placeholder="Customer Name">
               </div>
             </div>
               
             <div class="form-group">
             <div class="row">
            
                  <div class="col-md-6">
                   <div class="input-group">
                     
                     <input type="date" class="form-control" name="date" placeholder="Date">
                  </div>
                 </div>
              </div>
             </div>
             <div class="form-group">
                <div class="input-group">
                  
                  <input type="text" class="form-control" name="description" placeholder="Description">
               </div>
             </div>
        
              <div class="form-group">
               <div class="row">
                 <div class="col-md-5">
                   <div class="input-group">
                     <input type="number" class="form-control" name="quantity" placeholder="Quantity">
                  </div>
                 </div>
                 
                  <div class="col-md-6">
                    <div class="input-group">
                      
                      <input type="number" class="form-control" name="total" placeholder="Total">
                  </div>
               </div>
               </div>
              </div>


              <div class="form-group">
               <div class="row">
               <div class="col-md-12">
                      <label for="payment">Payment Type</label>
                      <select class="form-control" name="payment" placeholder="Payment Type">
                       <option value="">Choose a payment type</option>
                       <option value="Cash">Cash</option>
                       <option value="Online Bankin" >Online Bankin</option>
                       <option value="QR">QR</option>
                       </select>
                  </div>
               </div>
              </div>
              
              <div class="form-group">
               <div class="row">
               <div class="col-md-12">
                      <label for="status">Status</label>
                       <select class="form-control" name="status" placeholder="Status">
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
              <button type="submit" name="add_sales" class="btn btn-primary">Add sales</button>
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
                <th class="text-center" style="width: 15%;"> Status </th>
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
                <td class="text-center"> <?php echo remove_junk($product['vendor_id']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['Status']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>

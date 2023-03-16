<?php
  $page_title = 'All products';
  require_once('includes/load.php');
  
  
  $products = join_vendor_table();
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
    $query  = "INSERT INTO product (";
    $query .=" name,media,quantity,buy_price,sell_price,vendor_id,Status,date";
    $query .=") VALUES (";
    $query .=" '{$p_name}', '{$media}','{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_vendor}','{$p_status}','{$date}'";
    $query .=")";
    $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
    if($db->query($query)){
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


    <div class="card text-center">
    <div class="card-header text-blue bg-white">
      <div class="card-header">
        <strong>
          <span class="fa fa-th"></span>
          <span>All Products</span>
       </strong>
       <a href="add_product.php" class="btn btn-primary">Add product</a>
       </div>
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
                <th class="text-center" style="width: 100px;"> Actions </th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
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
                <td class="text-center">
                <div class="btn-group">
                  <a href="edit_product.php?ID=<?php echo (int)$product['ID'];?>"class="btn btn-warning btn-xs"  title="Edit" data-toggle="tooltip">
                     <span class= "fa fa-pencil-square"></span></a>
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
<?php
  $page_title = 'Stats';
  require_once('includes/load.php');
 
?>
<?php
 $c_product       = count_by_id('product');
 $c_sale          = count_by_id('sales');
 $products_sold   = find_higest_saleing_product('10');
 $recent_products = find_recent_product_added('5');
 $recent_sales    = find_recent_sale_added('5')
?>
<?php include_once('header.php'); ?>

<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<section class="admin_section layout_padding-bottom">
  <div class="row">
  <div class="col-md-6">
	
	<a href="product.php" >
       <div class="card ">
       <div class="card text-center">
         <div class="card-icon pull-left bg-blue2">
          <i class="fa fa-shopping-cart"></i>
        </div>
        <div class="pull-right">
        <p class="text-muted">Products</p>
          <h2 class="margin-top"> <?php  echo $c_product['total']; ?> </h2>
        </div>
       </div>
</div>
</div> 
	</a>

	<div class="col-md-6">
	<a href="sales.php" >
       <div class="card">
       <div class="card text-center">
         <div class="card-icon pull-left bg-blue2">
          <i class="fa fa-usd"></i>
        </div>
        <div class="pull-left">
        <p class="text-muted"> Total Sales:</p>
          <h2 class="margin-top"> <?php  echo $c_sale['total']; ?></h2> 
        </div>
       </div>
	</a>
</div>
</div>
</section>

<div class="row">
<div class="col-md-4">
<div class="card text-center">
    <div class="card-header text-blue bg-white">
      <div class="card-header">
         <strong>
           <span class="glyphicon glyphicon-th"></span>
           <span>Highest Selling Products</span>
         </strong>
       </div>
       <div class="panel-body">
         <table class="table table-striped table-bordered table-condensed">
          <thead>
           <tr>
             <th>Title</th>
             <th>Total Sold</th>
             <th>Total Quantity</th>
           <tr>
          </thead>
          <tbody>
            <?php foreach ($products_sold as  $product_sold): ?>
              <tr>
                <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                <td><?php echo (int)$product_sold['totalSold']; ?></td>
                <td><?php echo (int)$product_sold['totalQty']; ?></td>
              </tr>
            <?php endforeach; ?>
          <tbody>
         </table>
       </div>
     </div>
   </div>
</div>
   <div class="col-md-4">
   <div class="card text-center">
    <div class="card-header text-blue bg-white">
      <div class="card-header">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>LATEST SALES</span>
          </strong>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-bordered table-condensed">
       <thead>
         <tr>
           <th class="text-center" style="width: 50px;">#</th>
           <th>Product Name</th>
           <th>Date</th>
           <th>Total Sale</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($recent_sales as  $recent_sale): ?>
         <tr>
           <td class="text-center"><?php echo count_id();?></td>
           <td>
            <a href="edit_sale.php?id=<?php echo (int)$recent_sale['ID']; ?>">
             <?php echo remove_junk(first_character($recent_sale['name'])); ?>
           </a>
           </td>
           <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
           <td>RM<?php echo remove_junk(first_character($recent_sale['total'])); ?></td>
        </tr>
         

       <?php endforeach; ?>
       </tbody>
     </table>
    </div>
   </div>
  </div>
   </div>
  <div class="col-md-4">
  <div class="card text-center">
    <div class="card-header text-blue bg-white">
      <div class="card-header">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Recently Added Products</span>
        </strong>
      </div>
      <div class="card-body">

        <div class="list-group">
      <?php foreach ($recent_products as  $recent_product): ?>
            <a class="list-group-item clearfix" href="edit_product.php?ID=<?php echo    (int)$recent_product['ID'];?>">
                <h4 class="list-group-item-heading">
                 <?php if($recent_product['media'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['media'];?>" alt="" />
                <?php endif;?>
                <?php echo remove_junk(first_character($recent_product['name']));?>
                  <span class="label label-warning pull-right">
                 RM<?php echo (int)$recent_product['sell_price']; ?>
                  </span>
                </h4>
                <span class="list-group-item-text pull-right">
                <?php echo remove_junk(first_character($recent_product['vendor'])); ?>
              </span>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
 </div>
</div>
 </div>
</div>
  <div class="row">

  </div>





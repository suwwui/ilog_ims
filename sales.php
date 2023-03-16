<?php
$page_title = 'All Sale';
require_once('includes/load.php');
$sale = join_product_table();

?>
 


<?php include_once('header.php'); ?>

  <div class="card text-center">
    <div class="card-header text-blue bg-white">
        <div class="card-header">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>All Sales</span>
          </strong>

          <div class="pull-right">
            <a href="add_sales.php" class="btn btn-primary">Add sale</a>
          
        </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Customer </th>
                <th class="text-center" style="width: 10%;"> Product </th>
                <th class="text-center" style="width: 15%;"> Date </th>
                <th class="text-center" style="width: 15%;"> Description </th>
                <th class="text-center" style="width: 15%;"> Quantity</th>
                <th class="text-center" style="width: 15%;"> Total </th>
                <th class="text-center" style="width: 15%;"> Payment </th>
                <th class="text-center" style="width: 15%;"> Status </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
             </tr>
            </thead>
           <tbody>
             <?php foreach ($sale as $sales):?>
             <tr>
               <td class="text-center"><?php echo count_id();?></td>
               <td class="text-center"><?php echo remove_junk($sales['customer']); ?></td>
               <td class="text-center"><?php echo remove_junk($sales['product_id']); ?></td>
               <td class="text-center"><?php echo remove_junk($sales['date']); ?></td>
               <td class="text-center"><?php echo remove_junk($sales['description']); ?></td>
               <td class="text-center"><?php echo remove_junk ($sales['quantity']); ?></td>
               <td class="text-center"><?php echo remove_junk($sales['total']); ?></td>
               <td class="text-center"><?php echo remove_junk ($sales['payment']); ?></td>
               <td class="text-center"><?php echo remove_junk ($sales['status']); ?></td>
               <td class="text-center">
                  <div class="btn-group">
                     <a href="edit_sales.php?ID=<?php echo (int)$sales['ID'];?>"class="btn btn-warning btn-xs"  title="Delete" data-toggle="tooltip">
                     <span class= "fa fa-pencil-square"></span></a>
                     <a href="delete_sales.php?ID=<?php echo (int)$sales['ID'];?>"class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                  <span class="fa fa-trash"></span></a>
                     <a href="invoice.php?ID=<?php echo (int)$sales['ID'];?>"><button type="submit" name="submit" class="btn btn-primary">Invoice</button></a>
  
                  </div>
               </td>
             </tr>
             <?php endforeach;?>
           </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>

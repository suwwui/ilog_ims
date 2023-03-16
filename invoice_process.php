<?php
$page_title = 'Invoice';
$results = '';

  require_once('includes/load.php');
  
?>
<?php
  if(isset($_POST['submit1'])){
    $req_fields = array('ID');
    validate_fields($req_fields);

    if(empty($errors)):
      $s_ID   = remove_junk($db->escape($_POST['ID']));
      $results = find_invoice_byid($s_ID);
    else:
      $session->msg("d", $errors);
      redirect('invoice.php', false);
    endif;

  } else {
    $session->msg("d", "Select ID");
    redirect('invoice.php', false);
  }
?>
<!doctype html>
<html lang="en-US">
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Invoice</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <style>
   @media print {
     html,body{
        font-size: 9.5pt;
        margin: 0;
        padding: 0;
     }.page-break {
       page-break-before:always;
       width: auto;
       margin: auto;
      }
    }
    .page-break{
      width: 980px;
      margin: 0 auto;
    }
     .sale-head{
       margin: 40px 0;
       text-align: center;
     }.sale-head h1,.sale-head strong{
       padding: 10px 20px;
       display: block;
     }.sale-head h1{
       margin: 0;
       border-bottom: 1px solid #212121;
     }.table>thead:first-child>tr:first-child>th{
       border-top: 1px solid #000;
      }
      table thead tr th {
       text-align: center;
       border: 1px solid #ededed;
     }table tbody tr td{
       vertical-align: middle;
     }.sale-head,table.table thead tr th,table tbody tr td,table tfoot tr td{
       border: 1px solid #212121;
       white-space: nowrap;
     }.sale-head h1,table thead tr th,table tfoot tr td{
       background-color: #f8f8f8;
     }tfoot{
       color:#000;
       text-transform: uppercase;
       font-weight: 500;
     }
   </style>
</head>
<body>
  <?php if($results): ?>
    <div class="page-break">
       <div class="sale-head">
           <h1>i-LOG - Invoice</h1>
           
       </div>
      <table class="table table-border">
        <thead>
          <tr>
              <th>Date</th>
              <th>Customer</th>
              <th>Product Name</th>
              <th>Description</th>
              <th>Quantity</th>
              <th>Payment</th>
              
          </tr>
        </thead>
        <tbody>
          <?php foreach($results as $result): ?>
           <tr>
              <td class=""><?php echo remove_junk($result['date']);?></td>
              <td class="">
               <?php echo remove_junk(ucfirst($result['customer']));?>
              </td>
               <td class="text-right"><?php echo remove_junk($result['product_id']); ?></td>
               <td class="text-right"><?php echo remove_junk($result['description']); ?></td>
               <td class="text-right"><?php echo remove_junk ($result['quantity']); ?></td>
               <td class="text-right"><?php echo remove_junk ($result['payment']); ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
           <tr class="text-right">
           <td colspan="4"></td>
           <td colspan="1">Total</td>
           <td> RM <?php echo remove_junk ($result['total']); ?></td>
         </tr>
         </tfoot>
        
      </table>
    </div>
  <?php
    else:
        $session->msg("d", "Sorry no sales has been found. ");
        redirect('sales.php', false);
     endif;
  ?>
</body>
</html>
<?php if(isset($db)) { $db->db_disconnect(); } ?>

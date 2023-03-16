<?php
  require_once('includes/load.php');
?>
<?php
  $products = find_by_id('product',(int)$_GET['ID']);
  if(!$products){
    $session->msg("d","Missing Product id.");
    redirect('product1.php');
  }
?>
<?php
  $delete_id = delete_by_id('product',(int)$products['ID']);
  if($delete_id){
      $session->msg("s","Product deleted");
      redirect('product1.php');
  } else {
      $session->msg("d","Not Deleted");
      redirect('product1.php');
  }
?>

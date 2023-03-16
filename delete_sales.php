<?php
  require_once('includes/load.php');
?>
<?php
  $sales = find_by_id('sales',(int)$_GET['ID']);
  if(!$sales){
    $session->msg("d","Missing Sale id.");
    redirect('sales.php');
  }
?>
<?php
  $delete_id = delete_by_id('sales',(int)$sales['ID']);
  if($delete_id){
      $session->msg("s","Sales deleted");
      redirect('sales.php');
  } else {
      $session->msg("d","Not Deleted");
      redirect('sales.php');
  }
?>

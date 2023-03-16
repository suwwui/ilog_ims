<?php
  require_once('includes/load.php');
?>
<?php
  $vendor = find_by_id('vendor',(int)$_GET['ID']);
  if(!$vendor){
    $session->msg("d","Missing Sale id.");
    redirect('vendor.php');
  }
?>
<?php
  $delete_id = delete_by_id('vendor',(int)$vendor['ID']);
  if($delete_id){
      $session->msg("s","Vendor deleted");
      redirect('vendor.php');
  } else {
      $session->msg("d","Not Deleted");
      redirect('vendor.php');
  }
?>

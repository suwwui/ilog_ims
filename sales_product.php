<?php
  require_once('includes/load.php');
?>

<?php
 // find all product
  if(isset($_POST['p_name']) && strlen($_POST['p_name']))
  {
    $product_title = remove_junk($db->escape($_POST['p_name']));
    if($results = find_all_product_info_by_name($product_name)){
        foreach ($results as $result) {

          $html .= "<tr>";

          $html .= "<td id=\"s_customer\">".$result['customer']."</td>";
          $html .= "<input type=\"hidden\" name=\"s_ID\" value=\"{$result['ID']}\">";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"price\" value=\"{$result['sell_price']}\">";
          $html  .= "</td>";
          $html .= "<td id=\"s_quantity\">";
          $html .= "<input type=\"text\" class=\"form-control\" name=\"quantity\" value=\"1\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<input type=\"text\" class=\"form-control\" name=\"total\" value=\"{$result['sell_price']}\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<input type=\"date\" class=\"form-control datePicker\" name=\"date\" data-date data-date-format=\"yyyy-mm-dd\">";
          $html  .= "</td>";
          $html  .= "<td>";
          $html  .= "<button type=\"submit\" name=\"add_sale\" class=\"btn btn-primary\">Add sale</button>";
          $html  .= "</td>";
          $html  .= "</tr>";

        }
    } else {
        $html ='<tr><td>product name not resgister in database</td></tr>';
    }

    echo json_encode($html);
  }
 ?>


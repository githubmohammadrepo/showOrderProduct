<style>
.table {
width: 100%;
margin-bottom: 1rem;
color: #212529;
}

.table th,
.table td {
padding: 0.75rem;
vertical-align: top;
border-top: 1px solid #dee2e6;
}

.table thead th {
vertical-align: bottom;
border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
border-top: 2px solid #dee2e6;
}

.table-sm th,
.table-sm td {
padding: 0.3rem;
}

.table-bordered {
border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
border-bottom-width: 2px;
}

.table-borderless th,
.table-borderless td,
.table-borderless thead th,
.table-borderless tbody + tbody {
border: 0;
}

.table-striped tbody tr:nth-of-type(odd) {
background-color: rgba(0, 0, 0, 0.05);
}

.table-hover tbody tr:hover {
color: #212529;
background-color: rgba(0, 0, 0, 0.075);
}

.table-primary,
.table-primary > th,
.table-primary > td {
background-color: #b8daff;
}

.table-primary th,
.table-primary td,
.table-primary thead th,
.table-primary tbody + tbody {
border-color: #7abaff;
}

.table-hover .table-primary:hover {
background-color: #9fcdff;
}

.table-hover .table-primary:hover > td,
.table-hover .table-primary:hover > th {
background-color: #9fcdff;
}

.table-secondary,
.table-secondary > th,
.table-secondary > td {
background-color: #d6d8db;
}

.table-secondary th,
.table-secondary td,
.table-secondary thead th,
.table-secondary tbody + tbody {
border-color: #b3b7bb;
}

.table-hover .table-secondary:hover {
background-color: #c8cbcf;
}

.table-hover .table-secondary:hover > td,
.table-hover .table-secondary:hover > th {
background-color: #c8cbcf;
}

.table-success,
.table-success > th,
.table-success > td {
background-color: #c3e6cb;
}

.table-success th,
.table-success td,
.table-success thead th,
.table-success tbody + tbody {
border-color: #8fd19e;
}

.table-hover .table-success:hover {
background-color: #b1dfbb;
}

.table-hover .table-success:hover > td,
.table-hover .table-success:hover > th {
background-color: #b1dfbb;
}

.table-info,
.table-info > th,
.table-info > td {
background-color: #bee5eb;
}

.table-info th,
.table-info td,
.table-info thead th,
.table-info tbody + tbody {
border-color: #86cfda;
}

.table-hover .table-info:hover {
background-color: #abdde5;
}

.table-hover .table-info:hover > td,
.table-hover .table-info:hover > th {
background-color: #abdde5;
}

.table-warning,
.table-warning > th,
.table-warning > td {
background-color: #ffeeba;
}

.table-warning th,
.table-warning td,
.table-warning thead th,
.table-warning tbody + tbody {
border-color: #ffdf7e;
}

.table-hover .table-warning:hover {
background-color: #ffe8a1;
}

.table-hover .table-warning:hover > td,
.table-hover .table-warning:hover > th {
background-color: #ffe8a1;
}

.table-danger,
.table-danger > th,
.table-danger > td {
background-color: #f5c6cb;
}

.table-danger th,
.table-danger td,
.table-danger thead th,
.table-danger tbody + tbody {
border-color: #ed969e;
}

.table-hover .table-danger:hover {
background-color: #f1b0b7;
}

.table-hover .table-danger:hover > td,
.table-hover .table-danger:hover > th {
background-color: #f1b0b7;
}

.table-light,
.table-light > th,
.table-light > td {
background-color: #fdfdfe;
}

.table-light th,
.table-light td,
.table-light thead th,
.table-light tbody + tbody {
border-color: #fbfcfc;
}

.table-hover .table-light:hover {
background-color: #ececf6;
}

.table-hover .table-light:hover > td,
.table-hover .table-light:hover > th {
background-color: #ececf6;
}

.table-dark,
.table-dark > th,
.table-dark > td {
background-color: #c6c8ca;
}

.table-dark th,
.table-dark td,
.table-dark thead th,
.table-dark tbody + tbody {
border-color: #95999c;
}

.table-hover .table-dark:hover {
background-color: #b9bbbe;
}

.table-hover .table-dark:hover > td,
.table-hover .table-dark:hover > th {
background-color: #b9bbbe;
}

.table-active,
.table-active > th,
.table-active > td {
background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover {
background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover > td,
.table-hover .table-active:hover > th {
background-color: rgba(0, 0, 0, 0.075);
}

.table .thead-dark th {
color: #fff;
background-color: #343a40;
border-color: #454d55;
}

.table .thead-light th {
color: #495057;
background-color: #e9ecef;
border-color: #dee2e6;
}

.table-dark {
color: #fff;
background-color: #343a40;
}

.table-dark th,
.table-dark td,
.table-dark thead th {
border-color: #454d55;
}

.table-dark.table-bordered {
border: 0;
}

.table-dark.table-striped tbody tr:nth-of-type(odd) {
background-color: rgba(255, 255, 255, 0.05);
}

.table-dark.table-hover tbody tr:hover {
color: #fff;
background-color: rgba(255, 255, 255, 0.075);
}

@media (max-width: 575.98px) {
.table-responsive-sm {
display: block;
width: 100%;
overflow-x: auto;
-webkit-overflow-scrolling: touch;
}
.table-responsive-sm > .table-bordered {
border: 0;
}
}

@media (max-width: 767.98px) {
.table-responsive-md {
display: block;
width: 100%;
overflow-x: auto;
-webkit-overflow-scrolling: touch;
}
.table-responsive-md > .table-bordered {
border: 0;
}
}

@media (max-width: 991.98px) {
.table-responsive-lg {
display: block;
width: 100%;
overflow-x: auto;
-webkit-overflow-scrolling: touch;
}
.table-responsive-lg > .table-bordered {
border: 0;
}
}

@media (max-width: 1199.98px) {
.table-responsive-xl {
display: block;
width: 100%;
overflow-x: auto;
-webkit-overflow-scrolling: touch;
}
.table-responsive-xl > .table-bordered {
border: 0;
}
}

.table-responsive {
display: block;
width: 100%;
overflow-x: auto;
-webkit-overflow-scrolling: touch;
}

.table-responsive > .table-bordered {
border: 0;
}

.table-responsive {
display: block;
width: 100%;
overflow-x: auto;
-webkit-overflow-scrolling: touch;
}

.table-responsive > .table-bordered {
border: 0;
}

/* styles for button bootstrap */
.btn {
    font-size: 14px;
    padding: 4px 10px;
    margin-bottom: 0;

    display: inline-block;
    text-decoration: none;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 8px;
}
.btn:focus,
.btn:active:focus {
    outline: thin dotted;
    outline: 5px auto -webkit-focus-ring-color;
    outline-offset: -2px;
}
.btn:hover,
.btn:focus {
    color: #333;
    text-decoration: none;
}
.btn:active {
    background-image: none;
    outline: 0;
    -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
    box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
}

/* default
---------------------------- */
.btn-default {
    color: #333;
    background-color: #fff;
    border-color: lightblue;
}
.btn-default:focus {
    color: #333;
    background-color: #e6e6e6;
    border-color: #8c8c8c;
}
.btn-default:hover {
    color: #333;
    background-color: #e6e6e6;
    border-color: #adadad;
}
.btn-default:active {
    color: #333;
    background-color: #e6e6e6;
    border-color: lightseagreen;
}
</style>
<?php
// step 1 => sent curl user_id ->cms_user_id
$error;
// step 2 => show contents
function getStoreOrders($user_id, &$error)
{
  //default we have no error
  $error = false;
  //sent message to stores
  //get all sessionIds belongs to vendor own user_id
  $url = 'http://hypertester.ir/serverHypernetShowUnion/StoreOwnerOrders.php';
  // start get card info
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['user_id' => $user_id]));
  // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
  if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    $error = true;
    curl_close($ch);
    return;
  }
  curl_close($ch);
  $content = json_decode($result);
  return $content;
}



$user_id = JFactory::getUser()->id;
$result = getStoreOrders($user_id, $error);

if (!$error) {

  if ($result[0]->response == 'notok') {
    echo "<h4 style='color:red'>هیچ رکوردی پیدا نشد.</h4>";
  } else {

    if(count($result[1])){
?>

    <table id="storeOrders" class="table table-secondary">
      <thead>
        <tr>
          <th scope="col">کد سفارش</th>
          <th scope="col">نام محصول</th>
          <th scope="col">تعداد محصول</th>
          <th scope="col">قیمت محصول</th>
          <th scope="col">وضعیت سفارش</th>
        </tr>
      </thead>
      <tbody>

        <?php
        foreach ($result[1] as $key => $value) {
          echo "<tr>";
            echo "<th scope='row'>$value->order_id</th>";
            echo "<td>$value->order_product_name</td>";
            echo "<td>$value->order_product_quantity</td>";
            echo "<td>".($value->order_product_quantity*$value->order_product_price)."</td>";
          switch ($value->buy_status) {
            case 'undone':{

              echo "<td style='color:red'>";
                ?>

                <button class="btn btn-default" style="background:green;color:white;">قبول</button>
                <button class="btn btn-default" style="background:red;color:white;">رد</button>

                <?php              
              echo "</td>";
            }
              break;
            case 'done':{
              
              echo "<td style='color:green'>انجام شده</td>";
            }
              break;
          }
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
<?php
  }}
} else {
  echo "<h4 style='color:red'>خطا در  اینترنت شما.</h4>";
}
?>
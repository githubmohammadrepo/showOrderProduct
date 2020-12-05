  <style>
    /* start alert bootstrap styles */
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    .alert h4 {
      margin-top: 0;
      color: inherit;
    }

    .alert .alert-link {
      font-weight: bold;
    }

    .alert>p,
    .alert>ul {
      margin-bottom: 0;
    }

    .alert>p+p {
      margin-top: 5px;
    }

    .alert-dismissable,
    .alert-dismissible {
      padding-right: 35px;
    }

    .alert-dismissable .close,
    .alert-dismissible .close {
      position: relative;
      top: -2px;
      right: -21px;
      color: inherit;
    }

    .alert-success {
      background-color: #dff0d8;
      border-color: #d6e9c6;
      color: #3c763d;
    }

    .alert-success hr {
      border-top-color: #c9e2b3;
    }

    .alert-success .alert-link {
      color: #2b542c;
    }

    .alert-info {
      background-color: #d9edf7;
      border-color: #bce8f1;
      color: #31708f;
    }

    .alert-info hr {
      border-top-color: #a6e1ec;
    }

    .alert-info .alert-link {
      color: #245269;
    }

    .alert-warning {
      background-color: #fcf8e3;
      border-color: #faebcc;
      color: #8a6d3b;
    }

    .alert-warning hr {
      border-top-color: #f7e1b5;
    }

    .alert-warning .alert-link {
      color: #66512c;
    }

    .alert-danger {
      background-color: #f2dede;
      border-color: #ebccd1;
      color: #a94442;
    }

    .alert-danger hr {
      border-top-color: #e4b9c0;
    }

    .alert-danger .alert-link {
      color: #843534;
    }

    /* end alert bootstrap styles */
    /* start bootstrap list group styles css */

    .list-group {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-direction: column;
      flex-direction: column;
      padding-left: 0;
      margin-bottom: 0;
      width: 100%;
    }

    .list-group-item-action {
      width: 100%;
      color: #495057;
      text-align: inherit;
    }

    .list-group-item-action:hover,
    .list-group-item-action:focus {
      color: #495057;
      text-decoration: none;
      background-color: #f8f9fa;
    }

    .list-group-item-action:active {
      color: #212529;
      background-color: #e9ecef;
    }

    .list-group-item {
      position: relative;
      display: block;
      padding: 0.5rem 1rem;
      margin-bottom: -1px;
      background-color: #fff;
      border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .list-group-item:first-child {
      border-top-left-radius: 0.25rem;
      border-top-right-radius: 0.25rem;
    }

    .list-group-item:last-child {
      margin-bottom: 0;
      border-bottom-right-radius: 0.25rem;
      border-bottom-left-radius: 0.25rem;
    }

    .list-group-item:hover,
    .list-group-item:focus {
      z-index: 1;
      text-decoration: none;
    }

    .list-group-item.disabled,
    .list-group-item:disabled {
      color: #6c757d;
      background-color: #fff;
    }

    .list-group-item.active {
      z-index: 2;
      color: #fff;
      background-color: #007bff;
      border-color: #007bff;
    }

    .list-group-flush .list-group-item {
      border-right: 0;
      border-left: 0;
      border-radius: 0;
    }

    .list-group-flush:first-child .list-group-item:first-child {
      border-top: 0;
    }

    .list-group-flush:last-child .list-group-item:last-child {
      border-bottom: 0;
    }

    .list-group-item-primary {
      color: #004085;
      background-color: #b8daff;
    }

    .list-group-item-primary.list-group-item-action:hover,
    .list-group-item-primary.list-group-item-action:focus {
      color: #004085;
      background-color: #9fcdff;
    }

    .list-group-item-primary.list-group-item-action.active {
      color: #fff;
      background-color: #004085;
      border-color: #004085;
    }

    .list-group-item-secondary {
      color: #383d41;
      background-color: #d6d8db;
    }

    .list-group-item-secondary.list-group-item-action:hover,
    .list-group-item-secondary.list-group-item-action:focus {
      color: #383d41;
      background-color: #c8cbcf;
    }

    .list-group-item-secondary.list-group-item-action.active {
      color: #fff;
      background-color: #383d41;
      border-color: #383d41;
    }

    .list-group-item-success {
      color: #155724;
      background-color: #c3e6cb;
    }

    .list-group-item-success.list-group-item-action:hover,
    .list-group-item-success.list-group-item-action:focus {
      color: #155724;
      background-color: #b1dfbb;
    }

    .list-group-item-success.list-group-item-action.active {
      color: #fff;
      background-color: #155724;
      border-color: #155724;
    }

    .list-group-item-info {
      color: #0c5460;
      background-color: #bee5eb;
    }

    .list-group-item-info.list-group-item-action:hover,
    .list-group-item-info.list-group-item-action:focus {
      color: #0c5460;
      background-color: #abdde5;
    }

    .list-group-item-info.list-group-item-action.active {
      color: #fff;
      background-color: #0c5460;
      border-color: #0c5460;
    }

    .list-group-item-warning {
      color: #856404;
      background-color: #ffeeba;
    }

    .list-group-item-warning.list-group-item-action:hover,
    .list-group-item-warning.list-group-item-action:focus {
      color: #856404;
      background-color: #ffe8a1;
    }

    .list-group-item-warning.list-group-item-action.active {
      color: #fff;
      background-color: #856404;
      border-color: #856404;
    }

    .list-group-item-danger {
      color: #721c24;
      background-color: #f5c6cb;
    }

    .list-group-item-danger.list-group-item-action:hover,
    .list-group-item-danger.list-group-item-action:focus {
      color: #721c24;
      background-color: #f1b0b7;
    }

    .list-group-item-danger.list-group-item-action.active {
      color: #fff;
      background-color: #721c24;
      border-color: #721c24;
    }

    .list-group-item-light {
      color: #818182;
      background-color: #fdfdfe;
    }

    .list-group-item-light.list-group-item-action:hover,
    .list-group-item-light.list-group-item-action:focus {
      color: #818182;
      background-color: #ececf6;
    }

    .list-group-item-light.list-group-item-action.active {
      color: #fff;
      background-color: #818182;
      border-color: #818182;
    }

    .list-group-item-dark {
      color: #1b1e21;
      background-color: #c6c8ca;
    }

    .list-group-item-dark.list-group-item-action:hover,
    .list-group-item-dark.list-group-item-action:focus {
      color: #1b1e21;
      background-color: #b9bbbe;
    }

    .list-group-item-dark.list-group-item-action.active {
      color: #fff;
      background-color: #1b1e21;
      border-color: #1b1e21;
    }

    /* end bootstrap list group styles css */

    /* start bootstrap just table styls bootstrap 4.x */
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

    .table tbody+tbody {
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
    .table-borderless tbody+tbody {
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
    .table-primary>th,
    .table-primary>td {
      background-color: #b8daff;
    }

    .table-primary th,
    .table-primary td,
    .table-primary thead th,
    .table-primary tbody+tbody {
      border-color: #7abaff;
    }

    .table-hover .table-primary:hover {
      background-color: #9fcdff;
    }

    .table-hover .table-primary:hover>td,
    .table-hover .table-primary:hover>th {
      background-color: #9fcdff;
    }

    .table-secondary,
    .table-secondary>th,
    .table-secondary>td {
      background-color: #d6d8db;
    }

    .table-secondary th,
    .table-secondary td,
    .table-secondary thead th,
    .table-secondary tbody+tbody {
      border-color: #b3b7bb;
    }

    .table-hover .table-secondary:hover {
      background-color: #c8cbcf;
    }

    .table-hover .table-secondary:hover>td,
    .table-hover .table-secondary:hover>th {
      background-color: #c8cbcf;
    }

    .table-success,
    .table-success>th,
    .table-success>td {
      background-color: #c3e6cb;
    }

    .table-success th,
    .table-success td,
    .table-success thead th,
    .table-success tbody+tbody {
      border-color: #8fd19e;
    }

    .table-hover .table-success:hover {
      background-color: #b1dfbb;
    }

    .table-hover .table-success:hover>td,
    .table-hover .table-success:hover>th {
      background-color: #b1dfbb;
    }

    .table-info,
    .table-info>th,
    .table-info>td {
      background-color: #bee5eb;
    }

    .table-info th,
    .table-info td,
    .table-info thead th,
    .table-info tbody+tbody {
      border-color: #86cfda;
    }

    .table-hover .table-info:hover {
      background-color: #abdde5;
    }

    .table-hover .table-info:hover>td,
    .table-hover .table-info:hover>th {
      background-color: #abdde5;
    }

    .table-warning,
    .table-warning>th,
    .table-warning>td {
      background-color: #ffeeba;
    }

    .table-warning th,
    .table-warning td,
    .table-warning thead th,
    .table-warning tbody+tbody {
      border-color: #ffdf7e;
    }

    .table-hover .table-warning:hover {
      background-color: #00ff80 !important;
    }

    .table-hover .table-warning:hover>td,
    .table-hover .table-warning:hover>th {
      background-color: #00ff80 !important;
    }

    .table-danger,
    .table-danger>th,
    .table-danger>td {
      background-color: #f5c6cb;
    }

    .table-danger th,
    .table-danger td,
    .table-danger thead th,
    .table-danger tbody+tbody {
      border-color: #ed969e;
    }

    .table-hover .table-danger:hover {
      background-color: #f1b0b7;
    }

    .table-hover .table-danger:hover>td,
    .table-hover .table-danger:hover>th {
      background-color: #f1b0b7;
    }

    .table-light,
    .table-light>th,
    .table-light>td {
      background-color: #fdfdfe;
    }

    .table-light th,
    .table-light td,
    .table-light thead th,
    .table-light tbody+tbody {
      border-color: #fbfcfc;
    }

    .table-hover .table-light:hover {
      background-color: #ececf6;
    }

    .table-hover .table-light:hover>td,
    .table-hover .table-light:hover>th {
      background-color: #ececf6;
    }

    .table-dark,
    .table-dark>th,
    .table-dark>td {
      background-color: #c6c8ca;
    }

    .table-dark th,
    .table-dark td,
    .table-dark thead th,
    .table-dark tbody+tbody {
      border-color: #95999c;
    }

    .table-hover .table-dark:hover {
      background-color: #b9bbbe;
    }

    .table-hover .table-dark:hover>td,
    .table-hover .table-dark:hover>th {
      background-color: #b9bbbe;
    }

    .table-active,
    .table-active>th,
    .table-active>td {
      background-color: rgba(0, 0, 0, 0.075);
    }

    .table-hover .table-active:hover {
      background-color: rgba(0, 0, 0, 0.075);
    }

    .table-hover .table-active:hover>td,
    .table-hover .table-active:hover>th {
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

      .table-responsive-sm>.table-bordered {
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

      .table-responsive-md>.table-bordered {
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

      .table-responsive-lg>.table-bordered {
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

      .table-responsive-xl>.table-bordered {
        border: 0;
      }
    }

    .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    .table-responsive>.table-bordered {
      border: 0;
    }

    .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    .table-responsive>.table-bordered {
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
      background-color: silver;
      border-color: #8c8c8c;
    }

    .btn-default:hover {
      color: #333;
      background-color: sandybrown;
      border-color: #adadad;
    }

    .btn-default:active {
      color: #333;
      background-color: silver;
      border-color: lightseagreen;
    }

    /* mystyles for beautify webpage */
    caption {
      caption-side: top;
      margin: auto;
      text-align: center;
      background-color: aquamarine;
      color: black;
      font-weight: bold;
      font-size: .1.2rem;
    }

    .btn-warning {
      background-color: orange;
      color: maroon;
    }

    .btn-dange {
      background-color: red;
      color: white;
    }

    .btn-success {
      background-color: green;
      color: white;
    }

    .btn-danger {
      background-color: red;
      color: white;
    }

    table thead tr {
      background-color: #81A7E3 !important;
      color: black;
    }

    table tbody tr.transition {
      background-color: #4682B4;
      color: white;
    }

    .activeTr {
      background-color: darkturquoise;
    }

    /* styles for toggle rows */

    .none {
      opacity: 0;
      display: none;
    }

    .display {
      opacity: 1 display:block;

    }

    .w-100 {
      width: 100%;
    }

    .orderHeader {
      font-size: 14px;
      padding: 4px 10px;
      margin-bottom: 0;

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

    /* styles for alert */
    .text-center{
      text-align: center;
    }
    .close-alert{
      position:absolute !important;
      right:5px;
      display: inline;
      top:6px;
    }
    .blue{
      color:blue;
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

      if (count($result[1])) {
  ?>
        <div class="alert none nofication alert-danger blue text-center" role="alert">
          <p id="alertText">سفارش مورد نظر شما قبلا توسط فروشگاه دیگر پذیرفته شده است.</p>
          <span class="close-alert btn btn-danger" onclick="removeAlert(true,null)">X</span>
        </div>
        <table id="storeOrders" class="table table-warning table-bordered table-hover">
          <!-- table caption -->
          <caption>جدول سفارشات مشتری</caption>
          <thead>
            <tr>
              <th scope="col">شماره سفارش</th>
              <th scope="col">نام محصول</th>
              <th scope="col">تعداد محصول</th>
              <th scope="col">عملیات سفارش</th>
              <th scope="col">بایگانی</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $status = -1;
            foreach ($result[1] as $key => $value) {

              if ($status != $value->order_id) {
                if ($status != -1) {
            ?>
                  <tr class="list-group-item-light">
                    <td colspan="5"></td>
                  </tr>
                  <?php
                }
                $status = $value->order_id;
                echo '<tr id="order' . $value->order_id . '" class="orderHeader" onClick="toggleRowInfos(this,event)">';
                echo '<td> ' . ($key + 1) . '</td>'; //1
                echo '<td> ' . $status . ' key: ' . $key . '</td>'; //2
                echo '<td> ' . $status . ' key: ' . $key . '</td>'; //3

                switch ($value->buy_status) {
                  case 'undone': {

                      echo "<td style='color:red' id='statusField" . $value->order_id . "'>"; //4
                  ?>
                      <button class="btn btn-default btn-success" id="success<?php echo $value->order_id; ?>" onclick="acceptAllOrder(<?php echo $user_id; ?>,this,event)" data-orderId="<?php echo $value->order_id; ?>">پذیرفتن</button>

                      <button class="btn btn-default btn-danger" id="reject<?php echo $value->order_id; ?>" onclick="rejectAllOrder(<?php echo $user_id; ?>,this,event)" data-orderId="<?php echo $value->order_id; ?>">رد کردن</button>
                      <?php echo "</td>"; ?>

                  <?php
                    }
                    break;
                  case 'done': {

                      echo "<td style='color:green'>انجام شده</td>";
                    }
                    break;

                  case 'reject': {

                      echo "<td style='color:red'>رد شد</td>";
                    }
                    break;
                }

                if ($value->archive) {
                  //hvae value 1
                  echo "<td style='color:red'>"; //5
                  echo 'بایگانی شد';
                  echo "</td>";
                } else {
                  //does not have value or have null value
                  echo "<td style='color:red'>"; //5 
                  ?>
                  <button class="btn btn-default btn-warning" onclick="archiveOrder(<?php echo $user_id; ?>,this,event)" data-orderId="<?php echo $value->order_id; ?>">بایگانی کردن</button>
                <?php echo "</td>";
                }

                echo '</tr>';

                // show header;
                echo "<tr  class='order" . $value->order_id . " none transition'>";
                echo '<th scope="col">کد سفارش</th>';
                echo '<th scope="col">نام محصول</th>';
                echo '<th scope="col">تعداد محصول</th>';
                echo '<th scope="col">قیمت محصول</th>';
                echo '<th scope="col">وضعیت سفارش</th>';
                echo '</tr>';
              }

              echo "<tr class='order" . $value->order_id . " none transition'>";
              echo "<th scope='row'>$value->order_id</th>";
              echo "<td>$value->order_product_name</td>";
              echo "<td>$value->order_product_quantity</td>";
              echo "<td>" . ($value->order_product_quantity * $value->order_product_price * $value->order_product_tax) . "</td>";

              if ($value->vendor_id_accepted == null) {


                echo "<td style='color:red' class='status" . $value->order_id . "'>";
                ?>
                <button class="btn btn-default" onclick="acceptOneOrder(<?php echo $user_id; ?>,this,event,<?php echo $value->order_product_id; ?>)" style="background:green;color:white;" data-orderId="<?php echo $value->order_id; ?>">قبول</button>
                <!-- <button class="btn btn-default" onclick="rejectOrder(<?php echo $user_id; ?>,this,event)" style="background:red;color:white;" data-orderId="<?php echo $value->order_id; ?>">رد</button> -->
            <?php
                echo "</td>";
              } elseif($value->vendor_id_accepted == $result[0]->store_vendor_id ) { //end if order_product_id
                echo "<td style='color:white'>انجام شده</td>";
              } else { //end if order_product_id
                echo "<td style='color:red'> رد شد</td>";
              }
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
  <?php
      }
    }
  } else {
    echo "<h4 style='color:red'>خطا در  اینترنت شما.</h4>";
  }
  ?>

  <script defer>
    //accept all product in one order
    function acceptAllOrder(user_id, button, event) {
      let idNumber = button.getAttribute("data-orderid").replace(/\D/g, '');
      let tdsClassName = '.status' + idNumber;
      var data = {
        user_id: user_id,
        order_id: button.getAttribute("data-orderid"),
        typeAction: "acceptAll"
      }
      console.log(data)
      // sent ajax request
      jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
        method: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
          console.log(data)
          if (data[0].response == 'ok') {
            button.parentElement.style.color = "green"
            button.parentNode.innerHTML = 'انجام شده'

            let tds = document.querySelectorAll(tdsClassName.toString())
            notificationDisplay(tdsClassName, 'انجام شده', 'transparent', 'white')

            //send sms to customer
            console.log(data)
            smsentSmsToCustomers(data);
          } else if (data[0].response == 'other') {
            alert('other')
            button.parentNode.innerHTML = 'رد شد'
            
            removeAlert(false,null);
            notificationDisplay(tdsClassName, 'رد شده', 'transparent', 'red')
          } else {
            button.parentElement.style.color = "blue"
            button.parentNode.innerHTML = 'خطا در عملیات'
            notificationDisplay(tdsClassName, 'خطا در عملیات', 'blue', 'white')
          }
        },
        error: function(xhr) {
          console.log('error', xhr);
          button.parentNode.innerHTML = 'خطا در اینترنت'

          notificationDisplay(tdsClassName, 'خطا در اینترنت', 'red', 'white')

        }

      })


    }


    function smsentSmsToCustomers(data){
      let jsonLiveSite = "http://hypertester.ir/index.php?option=com_jchat&format=json";

      postObject = {
        "message": "<?php echo 'خریدار گرامی خرید شما با موفقیت پذیرفته شد'; ?>",
        "task": "stream.saveEntity",
        "to": data[0].customerSessonId.toString(), //error - solved => ownUser sessionId
        "tologged":  data[0].storeSessionId.toString() 
      };
      console.log(postObject)

      jQuery.post(jsonLiveSite, postObject, function(response) {
        console.log(response);
        postObject = null;
      });
    }
    // notification display for change display and show notifcation for user
    function notificationDisplay(className, textStatus, backgroundColor, color) {
      let tds = document.querySelectorAll(className.toString())
      for (let i = 0; i < tds.length; i++) {
        tds[i].innerHTML = textStatus.toString()
        tds[i].style.backgroundColor = backgroundColor.toString()
        tds[i].style.color = color.toString()
      }
    }

    //reject all product in one order
    function rejectAllOrder(user_id, button, event) {
      let idNumber = button.getAttribute("data-orderid").replace(/\D/g, '');
      let tdsClassName = '.status' + idNumber;

      var data = {
        user_id: user_id,
        order_id: button.getAttribute("data-orderid"),
        typeAction: "rejectAll"
      }
      // sent ajax request
      jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
        method: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
          if (data[0] == 'ok') {
            button.parentElement.style.color = "red"
            button.parentNode.innerHTML = 'رد شد'
            notificationDisplay(tdsClassName, 'رد شد', 'transparent', 'red')
          } else {
            button.parentElement.style.color = "blue"
            button.parentNode.innerHTML = 'خطا در عملیات'
            notificationDisplay(tdsClassName, 'خطا در عملیات', 'blue', 'white')
          }
        },
        error: function(xhr) {
          console.log('error', xhr);
          button.parentNode.innerHTML = 'خطا در اینترنت'
          notificationDisplay(tdsClassName, 'خطا در اینترنت', 'red', 'white')
        }
      })


    }

    //function archive all product in one order
    function archiveOrder(user_id, button, event) {
      let trClassName = ".order" + (button.getAttribute("data-orderid").toString())

      var data = {
        user_id: user_id,
        order_id: button.getAttribute("data-orderid"),
        typeAction: "archive"
      }
      console.log(data)
      // sent ajax request
      jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
        method: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
          if (data[0] == 'ok') {
            button.parentElement.style.color = "red"
            button.parentNode.parentNode.remove();
            // button.parentNode.innerHTML = 'بایگانی شد'
            removeArchivedRow(trClassName);

          } else {
            button.parentElement.style.color = "blue"
            button.parentNode.innerHTML = 'خطا در عملیات'

          }
        },
        error: function(xhr) {
          console.log('error', xhr);
          button.parentNode.innerHTML = 'خطا در اینترنت'

        }
      })


    }


    /**
     * functionality for toggle rows by clicking
     */
    function toggleRowInfos(element, event) {
      if (element.classList.contains('activeTr')) {
        element.classList.remove('activeTr')
      } else {
        element.classList.add('activeTr')
      }
      let className = '.' + element.id.toString();
      let trs = document.querySelectorAll(className)
      console.log(trs)
      for (let i = 0; i < trs.length; i++) {
        if (trs[i].classList.contains('none')) {
          trs[i].classList.remove('none')
          trs[i].classList.add('display')
        } else if (trs[i].classList.contains('display')) {
          trs[i].classList.remove('display')
          trs[i].classList.add('none')
        } else {
          trs[i].classList.add('none')
        }

      }
    }


    //remove rows that archived by click
    function removeArchivedRow(className) {
      let tds = document.querySelectorAll(className.toString())
      for (let i = 0; i < tds.length; i++) {
        tds[i].remove();
      }
    }

    //change or set one order_product to accept
    function acceptOneOrder(user_id, button, event, order_product_id) {
      let idNumber = button.getAttribute("data-orderid").replace(/\D/g, '');
      let tdsClassName = '.status' + idNumber;
      var data = {
        user_id: user_id,
        order_id: button.getAttribute("data-orderid"),
        order_product_id: order_product_id,
        typeAction: "acceptOne"
      }
      console.log(data)
      // sent ajax request
      jQuery.ajax({
        url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
        method: "POST",
        data: JSON.stringify(data),
        dataType: "json",
        contentType: "application/json",
        success: function(data) {
          console.log('first data')
          console.log(data)
          if (data[0] == 'owned') {
            button.parentElement.style.color = "green"
            button.parentNode.innerHTML = 'انجام شده'
          } else if (data[0].response == 'ok') {
            
            //fire function accept all
            let btnAcceptAll = document.querySelector("#success"+button.getAttribute("data-orderid"))
            
            //send sms to customer
            
            if(data[0].customerSessonId ==null){
              //user is offline
              removeAlert(false,'کاربر مورد نظر شما انلاین نیست');
            }else{
              //user is online
              let copyData={};
              let q=0
              for(q=0;q<data[0].storeSessionId.length;q++){
              console.log(data[0].storeSessionId[q])
                copyData.customerSessonId = data[0].customerSessonId;
                copyData.storeSessionId = data[0].storeSessionId[q].session_id
                
                smsentSmsToCustomers([copyData]);
              }
            }
            
            //end fire function accept all
            button.parentElement.style.color = "green"
            button.parentNode.innerHTML = 'انجام شده'
            let btn = document.querySelector('#statusField'+button.getAttribute("data-orderid"));
            btn.innerHTML = 'انجام شد'
            
          } else if (data[0] == 'other') {
              
              removeAlert(false,null);
              button.parentElement.style.color = 'red'
              button.parentNode.innerHTML = 'بلاک شده'
          } else { //e.g notok status error update
            button.parentElement.style.color = "blue"
            button.parentNode.innerHTML = 'خطا در عملیات'
            notificationDisplay(tdsClassName, 'خطا در عملیات', 'blue', 'white')
          }
        },
        error: function(xhr) {
          console.log('error', xhr);
          button.parentNode.innerHTML = 'خطا در اینترنت'

          // notificationDisplay(tdsClassName,'خطا در اینترنت','red','white')

        }

      })

    }


    /**
     * remove alert notification
     */
    function removeAlert(isClicked=false,text=null){
      let textElement = document.querySelector('#alertText');
      if(text !=null){
        textElement.innerHTML =  text.toString()
      }else{
        textElement.innerHTML = 'سفارش مورد نظر شما قبلا توسط فروشگاه دیگر پذیرفته شده است.';
      }
      let element = document.querySelector('.close-alert');
      element = element.parentElement;
      if(isClicked){
        element.classList.remove('display')
        element.classList.add('none')
      }else{
        if(element.classList.contains('display')==false){
          element.classList.add('display')
          element.classList.remove('none')
        }
      }
    }


    
  </script>
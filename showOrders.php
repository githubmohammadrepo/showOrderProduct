    <style>
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
        width: 100% !important;
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
      .table {
        font-size: 1.4rem !important;
      }
      /* styles for alert */
      .text-center {
        text-align: center;
      }
      .close-alert {
        position: absolute !important;
        right: 5px;
        display: inline;
        top: 6px;
      }
      .blue {
        color: blue;
      }
      body {
        text-align: center !important;
      }
      .modal-backdrop.show {
        display: relative !important;
        opacity: 1 !important;
      }
      #myModal {
        margin-top: 80px;
      }
      .modal-body table tr {
        display: table-row;
      }
      table#storeOrders tbody tr:hover {     background-color: teal !important;color:white; }
      table#modalData tbody tr:hover {     background-color: teal !important;color:white; }
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
          <table id="storeOrders" class="w-100 table table-warning table-bordered table-hover">
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
                  <!-- Trigger the modal with a button -->
                  <!-- <button type="button" class="btn btn-warning btn" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
                  <button type="button" class="btn btn-warning btn" onclick="clickModal(<?php echo $user_id; ?>,<?php echo $value->order_id; ?>,<?php echo $value->product_id; ?>)">تغییر محصول</button>
              <?php
                  echo "</td>";
                } elseif ($value->vendor_id_accepted == $result[0]->store_vendor_id) { //end if order_product_id
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
    <!-- start Modal -->
    <div id="myModal" class="modal" role="dialog" style="z-index: none;padding:none">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">لطفا محصول جایگزین را انتخاب بکنید</h4>
          </div>
          <div class="modal-body">
            <table id="modalData" class="table table-striped table-active table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">نام محصول</th>
                  <th scope="col">قیمت محصول</th>
                  <th scope="col">تعداد محصول</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default btn-danger btn-sm"  data-dismiss="modal">بستن </button>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal -->
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
              removeAlert(false, null);
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
      function smsentSmsToCustomers(data) {
        let jsonLiveSite = "http://hypertester.ir/index.php?option=com_jchat&format=json";
        postObject = {
          "message": "<?php echo 'خریدار گرامی خرید شما با موفقیت پذیرفته شد'; ?>",
          "task": "stream.saveEntity",
          "to": data[0].customerSessonId.toString(), //error - solved => ownUser sessionId
          "tologged": data[0].storeSessionId.toString()
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
              let btnAcceptAll = document.querySelector("#success" + button.getAttribute("data-orderid"))
              //send sms to customer
              if (data[0].customerSessonId == null) {
                //user is offline
                removeAlert(false, 'کاربر مورد نظر شما انلاین نیست');
              } else {
                //user is online
                let copyData = {};
                let q = 0
                for (q = 0; q < data[0].storeSessionId.length; q++) {
                  console.log(data[0].storeSessionId[q])
                  copyData.customerSessonId = data[0].customerSessonId;
                  copyData.storeSessionId = data[0].storeSessionId[q].session_id
                  smsentSmsToCustomers([copyData]);
                }
              }
              //end fire function accept all
              button.parentElement.style.color = "green"
              button.parentNode.innerHTML = 'انجام شده'
              let btn = document.querySelector('#statusField' + button.getAttribute("data-orderid"));
              btn.innerHTML = 'انجام شد'
            } else if (data[0] == 'other') {
              removeAlert(false, null);
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
      function removeAlert(isClicked = false, text = null) {
        let textElement = document.querySelector('#alertText');
        if (text != null) {
          textElement.innerHTML = text.toString()
        } else {
          textElement.innerHTML = 'سفارش مورد نظر شما قبلا توسط فروشگاه دیگر پذیرفته شده است.';
        }
        let element = document.querySelector('.close-alert');
        element = element.parentElement;
        if (isClicked) {
          element.classList.remove('display')
          element.classList.add('none')
        } else {
          if (element.classList.contains('display') == false) {
            element.classList.add('display')
            element.classList.remove('none')
          }
        }
      }
      /**
       * click on alert for show same category products in table
       */
      function clickModal(user_id,order_id,product_id){
        console.log('user_id:'+user_id,'order_id'+order_id,'product_id'+product_id)
        // let idNumber = button.getAttribute("data-orderid").replace(/\D/g, '');
        var data = {
          product_id: product_id,
          typeAction: "getSameCategory"
        }
        console.log(data)
        // sent ajax request
        jQuery.ajax({
          url: "http://hypertester.ir/serverHypernetShowUnion/showProductReplacement.php",
          method: "POST",
          data: JSON.stringify(data),
          dataType: "json",
          contentType: "application/json",
          success: function(data) {
            console.log('first data')
            console.log(data)
            if (data[0].response == 'ok') {
              jQuery("#modalData tbody").children().remove()
              data[0].data.forEach((row,index) => {
                jQuery("#modalData").append(`<tr class="btn btn-block">
                  <th scope="row">${index}</th>
                  <td>${row.product_name}</td>
                  <td>${row.product_price_percentage}</td>
                  <td>${row.product_quantity}</td>
                </tr>`)
              });
            } else { //e.g notok status error update
              alert('notok')
            }
          },
          error: function(xhr) {
            console.log('error', xhr);
            alert('خطا در اینترنت')
            // notificationDisplay(tdsClassName,'خطا در اینترنت','red','white')
          }
        })
        // clear all data
        jQuery("#modalData tbody").children().remove()
        // add spinner untill data will fetched
        jQuery("#modalData").append(`<tr><td  colspan="4" class="h2" ><i class="fas fa-spinner fa-spin"></i></td></tr>
         <tr><td  colspan="4" class="h4" >در حال نمایش محصولات</td></tr>`);
        // show alert 
        jQuery('#myModal').modal('show');
      }
    </script>

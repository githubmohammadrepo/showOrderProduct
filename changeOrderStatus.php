<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connection.php");

$object = new stdClass();

class ChangeOrderStatus
{
  private $hika_user_id;
  private $conn;
  public $last_id;
  public $row;
  public $storeOrders;
  public $singleAcceptAffecerRows = 0;
  public $allOrderAccepted = false;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }
  /**
   * accept type
   * goal: reject all record that has this order_id to buy_satus to "reject"
   */
  public function setAllOrderStatusToReject($order_id)
  {
    $statusComplete = false;
    try {
      // run your code here
      $sql = "UPDATE `pish_customer_vendor` SET `buy_status` ='reject' WHERE order_id = $order_id";
      $result = $this->conn->query($sql);
      if ($result) {
        $statusComplete = true;
      } else {
        $statusComplete = false;
      }
    } catch (exception $e) {
      //code to handle the exception
      return false;
    }
    return $statusComplete;
  }

  /**
   * accept type
   * goal: reject all record that has this order_id to buy_satus to "reject"
   */
  public function setOrderStatusToAccept($user_id, $order_id)
  {
    $statusComplete = 'notok';
    if($this->isRejectedOrderForMe($user_id,$order_id)){
      return 'other';
    }else{
      /* Start transaction */
      mysqli_begin_transaction($this->conn);
      try {
        if($this->setAllOrderStatusToReject($order_id)){
        // run your code here
          $sql = "UPDATE pish_customer_vendor set pish_customer_vendor.buy_status = 'done' WHERE pish_customer_vendor.order_id =$order_id\n"
            . " AND  pish_customer_vendor.vendor_id = (SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id)";
          $result = $this->conn->query($sql);
          if ($result) {
            $count = $this->conn->affected_rows;
            if ($count > 0) {
              // start second update
              $sql = "UPDATE pish_hikashop_order_product set pish_hikashop_order_product.vendor_id_accepted = (SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id) WHERE pish_hikashop_order_product.order_id =$order_id\n";
              $result = $this->conn->query($sql);
              if ($result) {
                $count = $this->conn->affected_rows;
                if ($count > 0) {
                   /* If code reaches this point without errors then commit the data in the database */
                    mysqli_commit($this->conn);
                    $statusComplete = 'ok';
                }else{
                  mysqli_rollback($this->conn);
                  $statusComplete = 'notok';
                }
                // end second update
              } else {
                $statusComplete = 'notok';
            }
          } else {
            $statusComplete = 'notok';
          }
        } else {
          $statusComplete = 'notok';
        }}
      } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($this->conn);
        //code to handle the exception
        return 'notok';
      }

    }
    return $statusComplete;
  }

  /**
   * is rejected this order for this user
   */
  public function isRejectedOrderForMe($user_id,$order_id){
    $statusComplete=false;
    try {
      // run your code here
      $sql = "SELECT id FROM `pish_customer_vendor` WHERE buy_status = 'reject' and order_id = $order_id AND vendor_id = (\n"

    . "SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id\n"

    . ")";
      $result = $this->conn->query($sql);
      if ($result->num_rows >0) {
        $row = $result->fetch_assoc();
        if (isset($row['id'])) {
          $statusComplete = true;
        } else {
          $statusComplete = false;
        }
      } else {
        $statusComplete = false;
      }
    } catch (exception $e) {
      //code to handle the exception
      return false;
    }
    // echo $sql;
    return $statusComplete;
  }

  /**
   * accept type
   * goal: reject all record that has this order_id to buy_satus to "archive"
   */
  public function setOrderStatusToArchive($user_id, $order_id)
  {
    $statusComplete = false;

    try {
      // run your code here
      $sql = "UPDATE pish_customer_vendor set pish_customer_vendor.archive = '1' WHERE pish_customer_vendor.order_id =$order_id\n"

        . " AND  pish_customer_vendor.vendor_id = (SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id)";
      $result = $this->conn->query($sql);
      if ($result) {
        $statusComplete = true;
      } else {
        $statusComplete = false;
      }
    } catch (exception $e) {
      //code to handle the exception
      return false;
    }
    return $statusComplete;
  }
  /**
   * accept type
   * goal: reject one record that has this order_id and user_id"
   */
  public function setOrderStatusToReject($user_id, $order_id)
  {
    $statusComplete = false;

    try {
      // run your code here
      $sql = "UPDATE pish_customer_vendor set pish_customer_vendor.buy_status = 'reject' WHERE pish_customer_vendor.order_id =$order_id\n"

        . " AND  pish_customer_vendor.vendor_id = (SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id)";
      $result = $this->conn->query($sql);
      if ($result) {
        $statusComplete = true;
      } else {
        $statusComplete = false;
      }
    } catch (exception $e) {
      //code to handle the exception
      return false;
    }
    return $statusComplete;
  }

  /**
   * accept type
   * goal: set one order product to accept.
   */
  public function seOneOrderProductToAccept($order_id, $order_product_id, $user_id)
  {
    $statusComplete = false;
    //if all record was accepted?
    if ($this->getIsAllOrderProductAccepted($order_id)) {
      //all order_procut was accepted
      $statusComplete = false;
    } else {
      //all order_product does not accepted
      try {
        // run your code here
        $sql = "UPDATE `pish_hikashop_order_product`\n"

          . "SET pish_hikashop_order_product.vendor_id_accepted = (\n"

          . "    SELECT id\n"

          . "    FROM pish_phocamaps_marker_store\n"

          . "    WHERE pish_phocamaps_marker_store.user_id = $user_id\n"

          . "  )\n"

          . "WHERE pish_hikashop_order_product.order_product_id = $order_product_id\n"

          . "  AND IF( (pish_hikashop_order_product.vendor_id_accepted), false, true )";

        $result = $this->conn->query($sql);
        if ($result) {
          $statusComplete = true;
          $this->singleAcceptAffecerRows = $this->conn->affected_rows;
        } else {
          $statusComplete = false;
        }
      } catch (exception $e) {
        //code to handle the exception
        return false;
      }

      //if all record was accepted?
      if ($this->getIsAllOrderProductAccepted($order_id)) {
        //all order_procut was accepted
        if ($this->setOrderStatusToAccept($user_id, $order_id)) {
          $this->allOrderAccepted = true;
        } else {
          $this->allOrderAccepted = false;
        }
      } else {
        //all order_product does not accepted
        $statusComplete = true;
      }
    }
    return $statusComplete;
  }
  /**
   * get fraction for acceptedAllrows/allRows that have same order_id
   * goal: return if all order_product table is accepted?
   */
  public function getIsAllOrderProductAccepted($order_id)
  {
    $statusComplete = false;
    try {
      // run your code here
      $sql = "SELECT acceptAll.accept/CountAllRecord.countAll as result from\n"

        . "(SELECT count(*) as countAll from pish_hikashop_order_product \n"

        . "\n"

        . "WHERE order_id = $order_id)as CountAllRecord,\n"

        . "(SELECT count(*) as accept from pish_hikashop_order_product \n"

        . "\n"

        . "WHERE order_id = $order_id AND pish_hikashop_order_product.vendor_id_accepted is not null)as acceptAll";

      $result = $this->conn->query($sql);
      if ($result) {
        // Associative array
        $row = $result->fetch_assoc();
        $dataResult =($row['result']);
        if ($dataResult == 1) {
          return true;
        } else {
          return false;
        }
      } else {
        $statusComplete = false;
      }
    } catch (exception $e) {
      //code to handle the exception
      return false;
    }
    return $statusComplete;
  }


  //return result function accept one
  public function acceptOneResult($typeAction, $store, &$object, $order_id, $order_product_id, $user_id)
  {
    if ($typeAction == 'acceptOne') {
      if ($store->seOneOrderProductToAccept($order_id, $order_product_id, $user_id)) {
        if ($store->singleAcceptAffecerRows > 0) {

          if ($store->allOrderAccepted) {
            $object->response = 'complete';
          } else {
            $object->response = 'owned';
          }
        } else {
          $object->response = 'other';
        }
      } else {
        $object->response = 'notok';
      }
    } else {
      $object->response = 'notok';
    }
  }

  //return result function accept All
  public function acceptAllResult($typeAction, $store, &$object, $order_id, $order_product_id, $user_id)
  {
      // set all record that have this order id to reject
    
    $object->response = $store->setOrderStatusToAccept($user_id, $order_id);
    
    
  }
  //return result function reject one
  public function rejectAllResult($typeAction, $store, &$object, $order_id, $order_product_id, $user_id)
  {
    if ($typeAction == 'rejectAll') {
      if ($store->setOrderStatusToReject($user_id, $order_id)) {
        $object->response = 'ok';
      }
    } else {
      $object->response = 'notok';
    }
  }

  //return result function archive all
  public function archiveAllResult($typeAction, $store, &$object, $order_id, $order_product_id, $user_id)
  {
    if ($typeAction == 'archive') {
      if ($store->setOrderStatusToArchive($user_id, $order_id)) {
        $object->response = 'ok';
      } else {
        $object->response = 'notok';
      }
    } else {
      $object->response = 'notok';
    }
  }
}

//   using class
$json = file_get_contents('php://input');
$post = json_decode($json, true);


$user_id = $post['user_id'];
$order_id = null;
if (array_key_exists('order_id', $post)) {
  $order_id = $post['order_id'];
}
$typeAction = $post['typeAction']; //is "accept" or "reject"
$order_product_id = null;
if (array_key_exists('order_product_id', $post)) {
  $order_product_id = $post['order_product_id'];
}
if ($post && count($post) && $user_id && $typeAction) {

  $object = new stdClass();
  $store = new ChangeOrderStatus($conn);
  if ($user_id && $order_id && $typeAction) {
    if ($typeAction == 'acceptAll') {
      $store->acceptAllResult($typeAction, $store, $object, $order_id, $order_product_id, $user_id);
    } else if ($typeAction == 'rejectAll') {

      $store->rejectAllResult($typeAction, $store, $object, $order_id, $order_product_id, $user_id);
    } else if ($typeAction == 'archive') {
      $store->archiveAllResult($typeAction, $store, $object, $order_id, $order_product_id, $user_id);
    } else if ($typeAction == 'acceptOne') {
      if ($order_product_id) {
        $store->acceptOneResult($typeAction, $store, $object, $order_id, $order_product_id, $user_id);
      } else {
        $object->response = 'notok';
      }
    } else {
      $object->response = 'notok';
    }
  } else {
    $object->response = 'notok';
  }
} else {
  $object->response = 'notok';
}

echo json_encode([$object->response], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

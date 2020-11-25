<?php
require_once("connection.php");

$object = new stdClass();

class ChangeOrderStatus
{
  private $hika_user_id;
  private $conn;
  public $last_id;
  public $row;
  public $storeOrders;

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
  public function setOrderStatusToAccept($user_id,$order_id)
  {
    $statusComplete = false;

    try {
      // run your code here
      $sql = "UPDATE pish_customer_vendor set pish_customer_vendor.buy_status = 'done' WHERE pish_customer_vendor.order_id =$order_id\n"

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
  public function setOrderStatusToReject($user_id,$order_id)
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


  
}

//   using class
$json = file_get_contents('php://input');
$post = json_decode($json, true);


$user_id = $post['user_id'];
$order_id = $post['order_id'];
$typeAction = $post['typeAction'];//is "accept" or "reject"

if ($post && count($post) && $user_id && $order_id && $typeAction) {

  $object = new stdClass();
  $store = new ChangeOrderStatus($conn);
  if($typeAction == 'accept'){
    // set all record that have this order id to reject
    if ($store->setAllOrderStatusToReject($order_id)) {
      if ($store->setOrderStatusToAccept($user_id,$order_id)) {
        $object->response = 'ok';
      } else {
        $object->response = 'notok';
      }
    } else {
      $object->response = 'notok';
    }
    
  }else if($typeAction == 'reject'){
    if($store->setOrderStatusToReject($user_id,$order_id)){
      $object->response = 'ok';
    }
  }else{
    $object->response = 'notok';
  }
}else {
  $object->response = 'notok post';
}

echo json_encode([$object->response], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("connection.php");

define('_JEXEC', 1);
define('JPATH_BASE', realpath(dirname(__FILE__) . '/..'));

require_once(JPATH_BASE . '/includes/defines.php');
require_once(JPATH_BASE . '/includes/framework.php');
$mainframe = JFactory::getApplication('site');
$mainframe->initialise();


$object = new stdClass();
$customeObject  = new stdClass();
class ChangeOrderStatus
{
  private $hika_user_id;
  private $conn;
  public $last_id;
  public $row;
  public $storeOrders;
  public $singleAcceptAffecerRows = 0;
  public $allOrderAccepted = false;
  private $customerSessionId;
  private $storeOwnerSessionId = array();

  public function __construct($conn, $JFactory_getSession)
  {
    $this->conn = $conn;
    $this->session = $JFactory_getSession;
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
    if ($this->getIsAllOrderProductAccepted($order_id)) {
      return 'other';
    } else {
      if ($this->isRejectedOrderForMe($user_id, $order_id)) {
        return 'other';
      } else {
        /* Start transaction */
        mysqli_begin_transaction($this->conn);
        try {
          if ($this->setAllOrderStatusToReject($order_id)) {
            // run your code here
            $sql = "UPDATE pish_customer_vendor set pish_customer_vendor.buy_status = 'done' WHERE pish_customer_vendor.order_id =$order_id\n"
              . " AND  pish_customer_vendor.vendor_id = (SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id) AND pish_customer_vendor.buy_status = 'undone'";
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
                  } else {
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
            }
          }
        } catch (mysqli_sql_exception $exception) {
          mysqli_rollback($this->conn);
          //code to handle the exception
          return 'notok';
        }
      }
    }
    return $statusComplete;
  }

  /**
   * accept type
   * goal: acceptAll order that order_product was doned
   */
  public function setOrdersBelogsToProductTOAccept($user_id, $order_id)
  {
    $statusComplete = false;
    /* Start transaction */
    mysqli_begin_transaction($this->conn);
    try {
      if ($this->setAllOrderStatusToReject($order_id)) {
        // run your code here
        $sql = "UPDATE pish_customer_vendor SET pish_customer_vendor.buy_status = 'done' WHERE pish_customer_vendor.vendor_id IN (SELECT pish_hikashop_order_product.vendor_id_accepted FROM `pish_hikashop_order_product` WHERE pish_hikashop_order_product.order_id =$order_id GROUP BY pish_hikashop_order_product.vendor_id_accepted)";
        $result = $this->conn->query($sql);
        if ($result) {
          $count = $this->conn->affected_rows;
          if ($count > 0) {

            // start second update
            $sql = "UPDATE pish_customer_vendor SET buy_status = 'reject' WHERE buy_status = 'undone' AND order_id = $order_id";
            $result = $this->conn->query($sql);
            if ($result) {
              // $count = $this->conn->affected_rows;
              /* If code reaches this point without errors then commit the data in the database */
              mysqli_commit($this->conn);

              $statusComplete = true;

              // end second update
            } else {
              $statusComplete = false;
            }
          } else {
            $statusComplete = false;
          }
        } else {
          $statusComplete = false;
        }
      }
    } catch (mysqli_sql_exception $exception) {
      mysqli_rollback($this->conn);
      //code to handle the exception
      return false;
    }

    return $statusComplete;
  }

  /**
   * is rejected this order for this user
   */
  public function isRejectedOrderForMe($user_id, $order_id)
  {
    $statusComplete = false;
    try {
      // run your code here
      $sql = "SELECT id FROM `pish_customer_vendor` WHERE buy_status = 'reject' and order_id = $order_id AND vendor_id = (\n"

        . "SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id\n"

        . ")";
      $result = $this->conn->query($sql);
      if ($result->num_rows > 0) {
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
      $statusComplete = 'other';
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
      $this->getIsAllOrderProductAccepted($order_id);
      if ($this->getIsAllOrderProductAccepted($order_id)) {
        //all order_procut was accepted
        $sac = $this->setOrdersBelogsToProductTOAccept($user_id, $order_id);
        if ($sac) {
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
        $dataResult = ($row['result']);
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


  /**
   * get customerSessioonId
   */
  public function getCustomerSessionId($order_id)
  {
    $statusComplete = false;
    try {
      // run your code here
      $sql = "SELECT pish_session.session_id FROM `pish_session` \n"

        . "WHERE userid = (SELECT pish_hikashop_user.user_cms_id FROM `pish_hikashop_user`\n"

        . "WHERE pish_hikashop_user.user_id = (\n"

        . "SELECT pish_customer_vendor.customer_id FROM `pish_customer_vendor` WHERE pish_customer_vendor.order_id = $order_id LIMIT 1\n"

        . ") LIMIT 1) order by time desc limit 1";

      $result = $this->conn->query($sql);
      if ($result) {
        // Associative array
        $row = $result->fetch_assoc();
        $dataResult = ($row['session_id']);
        $rowcount = mysqli_num_rows($result);
        if ($rowcount && isset($dataResult)) {
          $this->customerSessionId = $dataResult;
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

  /**
   * get storeOwnerSessioonId
   */
  public function getStoreOwnerSessionId($order_id)
  {
    $statusComplete = false;
    try {
      // run your code here
      $sql = "SELECT pish_session.session_id FROM pish_session WHERE pish_session.userid IN ( SELECT pish_phocamaps_marker_store.user_id FROM pish_phocamaps_marker_store WHERE id IN( SELECT pish_customer_vendor.vendor_id FROM pish_customer_vendor WHERE order_id = $order_id AND pish_customer_vendor.buy_status = 'done' ))";

      $result = $this->conn->query($sql);

      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          $this->storeOwnerSessionId = array();
          while ($row = mysqli_fetch_assoc($result)) {
            $this->storeOwnerSessionId[] = $row;
          }
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    } catch (exception $e) {
      //code to handle the exception
      return false;
    }
    return $statusComplete;
  }

  //return result function accept one
  public function acceptOneResult(&$arrayData, $typeAction, $store, &$object, $order_id, $order_product_id, $user_id)
  {
    if ($typeAction == 'acceptOne') {
      $AllOrderProductToAccept = $store->seOneOrderProductToAccept($order_id, $order_product_id, $user_id);
      if ($AllOrderProductToAccept === true) {
        if ($store->singleAcceptAffecerRows > 0) {
          if ($store->allOrderAccepted) {
            $object->response = 'complete';
            if ($object->response == 'complete') {
              $object = null;
              $arrayData->response = 'ok';

              if ($this->getStoreOwnerSessionId($order_id)) {
                $arrayData->storeSessionId = $this->storeOwnerSessionId;
              } else {
                $arrayData->storeSessionId = $this->session->getId();
              }
              // set customerSessionId property to customer session id
              if ($this->getCustomerSessionId($order_id)) {
                $arrayData->customerSessonId = $this->customerSessionId;
              } else {
                $arrayData->customerSessonId = $this->customerSessionId;
              }
            }
          } else {
            $object->response = 'owned';
          }
        } else {
          $object->response = 'other';
        }
      } else if ($AllOrderProductToAccept == 'other') {
        $object->response = 'other';
      } else {
        $object->response = 'notok';
      }
    } else {
      $object->response = 'notok';
    }
  }

  //return result function accept All
  public function acceptAllResult(&$arrayData, $typeAction, $store, &$object, $order_id, $order_product_id, $user_id)
  {
    // set all record that have this order id to reject 
    $object = null;
    $arrayData->response = $store->setOrderStatusToAccept($user_id, $order_id);
    if ($arrayData->response == 'ok') {

      $arrayData->storeSessionId = $this->session->getId();
      // set customerSessionId property to customer session id
      if ($this->getCustomerSessionId($order_id)) {
        $arrayData->customerSessonId = $this->customerSessionId;
      } else {
        $arrayData->customerSessonId = $this->customerSessionId;
      }
    }
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


  /*
   # proposal section for working and adding all functionality needed for change or save informations
   */



  /**
   * save one proposal product
   * @method validateInputs(Array)
   * @return bool
   */
  private function saveOneProposalProduct(int $product_id, int $count, float $price, string $name, int $order_id, int $user_id): bool
  {
    //step 1 => get data
    $product_id = is_numeric($product_id) ? $product_id :  -1;
    $count = is_numeric($count) ? $count :  -1;
    $price = is_float($price) ? $price :  -1;
    $name = is_string($name) ? strip_tags(htmlspecialchars($name)) :  '';
    $order_id = is_numeric($order_id) ? $order_id :  -1;
    $user_id = is_numeric($user_id) ? $user_id :  -1;

    //validation
    $validation = $this->validateInputs([
      'int' => $product_id,
      'int' => $count,
      'int' => $price,
      'string' => $name,
      'int' => $order_id,
      'int' => $user_id
    ]);

    $status = false;
    if ($validation) {
      //step 2 => insert
      /* Start transaction */
      mysqli_begin_transaction($this->conn);
      try {

        //step 1 => insert into pish_product_store
        // run your code here
        $sql = "INSERT INTO pish_product_store (`product_id`,`store_id`,`product_price`,`product_quantity`) VALUES($product_id,\n"

          . "(SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id LIMIT 1),$price,$count)";

        $result = $this->conn->query($sql);
        if ($result) {
          $count = $this->conn->affected_rows;
          if ($count > 0) {
            //step 2 => insert into proposal_order_product
            $sql = "INSERT INTO `proposal_order_product` (`order_id`, `product_id`, `order_product_quantity`, `order_product_name`, `order_product_code`, `order_product_price`, `order_product_tax`, `order_product_tax_info`, `order_product_options`, `order_product_option_parent_id`, `order_product_status`, `order_product_wishlist_id`, `order_product_wishlist_product_id`, `order_product_shipping_id`, `order_product_shipping_method`, `order_product_shipping_price`, `order_product_shipping_tax`, `order_product_shipping_params`, `order_product_parent_id`, `order_product_vendor_price`, `order_product_params`, `vendor_id_accepted`) " .
              " VALUES ($order_id, $product_id, $count, '$name', 'product_$product_id', $price, '0.00000', '', '', '0', '', '0', '0', '', '', '0.00000', '0.00000', NULL, '0', '0.00000', NULL, NULL)";
            $result = $this->conn->query($sql);
            if ($result) {
              $count = $this->conn->affected_rows;
              if ($count > 0) {
                /* If code reaches this point without errors then commit the data in the database */
                mysqli_commit($this->conn);
                $status = true;
              } else {
                mysqli_rollback($this->conn);
                $status = false;
              }
              // end second update
            } else {
              $status = false;
            }
          } else {
            $status = false;
          }
        }
      } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($this->conn);
        //code to handle the exception
        return 'notok';
      }
    } else {
      return false;
    }

    //step3 =>  return result
    return $status;
  }


  /**
   * select if product for one store was saved in pish_store_product
   * check if two field product_id and store_id is not doublicate
   * @param int $product_id product id
   * @param int $user_id user_id
   * @return bool
   */
  private function productForStoreIsExist(int $product_id, int $user_id)
  {
    $statusComplete = false;
    try {
      // run your code here
      $sql = "select id from pish_product_store WHERE `product_id`=$product_id AND `store_id` =(SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id LIMIT 1)";

      $result = $this->conn->query($sql);
      if ($result) {
        // Associative array
        $count = $result->num_rows;
        if ($count >= 1) {
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
    return $statusComplete;
  }

  /**
   * select if product for one store was saved in pish_store_product
   * check if two field product_id and store_id is not doublicate
   * @param int $product_id product id
   * @param int $order_id order_id
   * @return bool
   */
  private function productForProposalProductIsExist(int $product_id, int $order_id)
  {
    $statusComplete = false;
    try {
      // run your code here
      $sql = "SELECT proposal_order_product.order_product_id FROM proposal_order_product WHERE order_id =$order_id AND product_id = $product_id";


      $result = $this->conn->query($sql);
      if ($result) {
        // Associative array
        $count = $result->num_rows;
        if ($count >= 1) {
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
    return $statusComplete;
  }
  /**
   * save one proposal product store
   * @method validateInputs(Array)
   * @return bool
   */
  private function saveProposalProductStore(int $product_id, int $count, float $price, string $name, int $order_id, int $user_id): bool
  {
    //step 1 => get data
    $product_id = is_numeric($product_id) ? $product_id :  -1;
    $count = is_numeric($count) ? $count :  -1;
    $price = is_float($price) ? $price :  -1;
    $name = is_string($name) ? strip_tags(htmlspecialchars($name)) :  '';
    $order_id = is_numeric($order_id) ? $order_id :  -1;
    $user_id = is_numeric($user_id) ? $user_id :  -1;

    //validation
    $validation = $this->validateInputs([
      'int' => $product_id,
      'int' => $count,
      'int' => $price,
      'string' => $name,
      'int' => $order_id,
      'int' => $user_id
    ]);

    $status = false;
    if ($validation) {

      //step 2 => insert
      /* Start transaction */
      mysqli_begin_transaction($this->conn);
      try {
        $resultStatus = false;
        //step 1 => insert into pish_product_store
        // run your code here
        $sql = "INSERT INTO pish_product_store (`product_id`,`store_id`,`product_price`,`product_quantity`) VALUES($product_id,\n"

          . "(SELECT pish_phocamaps_marker_store.id FROM pish_phocamaps_marker_store WHERE pish_phocamaps_marker_store.user_id = $user_id LIMIT 1),$price,$count)";

        $result = $this->conn->query($sql);
        if ($result) {
          $count = $this->conn->affected_rows;
          if ($count > 0) {
            /* If code reaches this point without errors then commit the data in the database */
            mysqli_commit($this->conn);
            $status = true;
          } else {
            $status = false;
          }
        }
      } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($this->conn);
        //code to handle the exception
        return 'notok';
      }
    } else {
      return false;
    }

    //step3 =>  return result
    return $status;
  }

  /**
   * save one proposal product
   * @method validateInputs(Array)
   * @return bool
   */
  private function saveProposalProductOrder(int $product_id, int $count, float $price, string $name, int $order_id, int $user_id): bool
  {
    //step 1 => get data
    $product_id = is_numeric($product_id) ? $product_id :  -1;
    $count = is_numeric($count) ? $count :  -1;
    $price = is_float($price) ? $price :  -1;
    $name = is_string($name) ? strip_tags(htmlspecialchars($name)) :  '';
    $order_id = is_numeric($order_id) ? $order_id :  -1;
    $user_id = is_numeric($user_id) ? $user_id :  -1;

    //validation
    $validation = $this->validateInputs([
      'int' => $product_id,
      'int' => $count,
      'int' => $price,
      'string' => $name,
      'int' => $order_id,
      'int' => $user_id
    ]);

    $status = false;
    if ($validation) {

      //step 2 => insert
      /* Start transaction */
      mysqli_begin_transaction($this->conn);
      try {
        $resultStatus = false;
        //step 1 => insert into pish_product_store
        // run your code here

        //step 2 => insert into proposal_order_product
        $sql = "INSERT INTO `proposal_order_product` (`order_id`, `product_id`, `order_product_quantity`, `order_product_name`, `order_product_code`, `order_product_price`, `order_product_tax`, `order_product_tax_info`, `order_product_options`, `order_product_option_parent_id`, `order_product_status`, `order_product_wishlist_id`, `order_product_wishlist_product_id`, `order_product_shipping_id`, `order_product_shipping_method`, `order_product_shipping_price`, `order_product_shipping_tax`, `order_product_shipping_params`, `order_product_parent_id`, `order_product_vendor_price`, `order_product_params`, `vendor_id_accepted`) " .
          " VALUES ($order_id, $product_id, $count, '$name', 'product_$product_id', $price, '0.00000', '', '', '0', '', '0', '0', '', '', '0.00000', '0.00000', NULL, '0', '0.00000', NULL, NULL)";
        $result = $this->conn->query($sql);
        if ($result) {
          $count = $this->conn->affected_rows;
          if ($count > 0) {
            /* If code reaches this point without errors then commit the data in the database */
            mysqli_commit($this->conn);
            $status = true;
          } else {
            mysqli_rollback($this->conn);
            $status = false;
          }
          // end second update
        }
      } catch (mysqli_sql_exception $exception) {
        mysqli_rollback($this->conn);
        //code to handle the exception
        return 'notok';
      }
    } else {
      return false;
    }

    //step3 =>  return result
    return $status;
  }


  /**
   * if number is valid for proposal save information
   */
  private function validateInputs(array $values): bool
  {
    foreach ($values as $key => $value) {
      if ($key == 'int' && $value == -1) {
        return false;
        break;
      } else if ($key == 'string' && $value == '') {
        return false;
        break;
      } else {
      }
    }
    return true;
  }


  /**
   * show result saveOrderOrderProposal
   */
  public function showResultSaveOneProposal($product_id, $count, $price, $name, $order_id, $user_id, $object)
  {
    if ($product_id && $count && $price && strlen($name) && $order_id && $user_id) {
      //if product exist
      $storeProductExist = $this->productForStoreIsExist($product_id, $user_id) ? true : false;
      $proposalProductExist = $this->productForProposalProductIsExist($product_id,$order_id) ? true : false;

      if($storeProductExist==false && $proposalProductExist==false){
        $this->saveOneProposalProduct($product_id, $count, $price, $name, $order_id, $user_id) ?  $object->response = 'ok' : $object->response = 'notok';
      }else if($storeProductExist==false){
        $this->saveProposalProductStore($product_id, $count, $price, $name, $order_id, $user_id) ?  $object->response = 'ok' : $object->response = 'notok';
      }else if($proposalProductExist==false){
        $this->saveProposalProductOrder($product_id, $count, $price, $name, $order_id, $user_id) ?  $object->response = 'ok' : $object->response = 'notok';
      }else{
        //do any thing because both of them is true and this mean nothing to insert
        return $object->response = 'ok';
      }
      
    } else {
      $object->response = 'notok';
    }
  }
}

//global Array
$arrayData = array();
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
  $store = new ChangeOrderStatus($conn, JFactory::getSession());
  if ($order_id) {
    if ($typeAction == 'acceptAll') {
      $store->acceptAllResult($customeObject, $typeAction, $store, $object, $order_id, $order_product_id, $user_id);
    } else if ($typeAction == 'rejectAll') {

      $store->rejectAllResult($typeAction, $store, $object, $order_id, $order_product_id, $user_id);
    } else if ($typeAction == 'archive') {
      $store->archiveAllResult($typeAction, $store, $object, $order_id, $order_product_id, $user_id);
    } else if ($typeAction == 'saveOneProposal') {

      $product_id = $post['product_id'];
      $count = $post['count'];
      $price = $post['price'];
      $name = $post['name'];
      $order_id = $post['order_id'];
      $user_id = $post['user_id'];

      $store->showResultSaveOneProposal($product_id, $count, $price, $name, $order_id, $user_id, $object);
    } else if ($typeAction == 'acceptOne') {
      if ($order_product_id) {
        $store->acceptOneResult($customeObject, $typeAction, $store, $object, $order_id, $order_product_id, $user_id);
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


jsonEncodeOutput($object, $customeObject);

/**
 * customer jsonEncodedOutput
 */
function jsonEncodeOutput($normalObject = null, $customeObject = null)
{
  if (isset($normalObject)) {
    echo json_encode([$normalObject->response], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  } else if (isset($customeObject)) {
    echo json_encode([$customeObject], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  } else {
    echo json_encode([$normalObject->response], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  }
}

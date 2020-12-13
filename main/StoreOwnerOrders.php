<?php
require_once("connection.php");

$object = new stdClass();

class StoreOwnerOrders
{
    public $store_vendor_id;
    private $conn;
    public $last_id;
    public $row;
    public $storeOrders;
    
    public function __construct($conn)
    {
        $this->conn = $conn;

        // set hikashop user_id
        
        //get order infos
    }
    /**
     * get hikashop user id
     */
    public function getHikashopUserId($user_id)
    {
        $statusComplete = false;
        
        try {
            // run your code here
            $this->row = $sql = "SELECT `id` FROM pish_phocamaps_marker_store WHERE user_id=$user_id LIMIT 1";
            
            $result = $this->conn->query($sql);
            if ($result) {
                $rowcount = $result->num_rows;
                if ($rowcount > 0) {
                    
                    $row = $result->fetch_assoc();
                    $this->store_vendor_id = $row['id'];
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
     * get store orders
     */

    public function getStoreOrders()
    {
        $statusComplete = false;
        
        try {
            // run your code here
             // run your code here
            $sql = $sql = "(SELECT pish_customer_vendor.*,pish_hikashop_order_product.* from pish_customer_vendor\n"

            . "\n"
        
            . "INNER JOIN\n"
        
            . "\n"
        
            . "pish_hikashop_order_product\n"
        
            . "\n"
        
            . "ON pish_customer_vendor.order_id = pish_hikashop_order_product.order_id\n"
        
            . "\n"
        
            . "WHERE pish_customer_vendor.vendor_id =$this->store_vendor_id And  pish_customer_vendor.archive is null And pish_customer_vendor.buy_status !='proposal')\n"
        
            . "\n"
        
            . "UNION\n"
        
            . "(SELECT pish_customer_vendor.*,proposal_order_product.* from pish_customer_vendor\n"
        
            . "\n"
        
            . "INNER JOIN\n"
        
            . "\n"
        
            . "proposal_order_product\n"
        
            . "\n"
        
            . "ON pish_customer_vendor.order_id = proposal_order_product.order_id\n"
        
            . "\n"
        
            . "WHERE pish_customer_vendor.vendor_id =$this->store_vendor_id And  pish_customer_vendor.archive is null AND pish_customer_vendor.buy_status='proposal')";
            
            
            $result = $this->conn->query($sql);
            if ($result) {
                $rowcount = $result->num_rows;
                if ($rowcount > 0) {
                    
                    $dev_array = Array();
                    for ($i = 0; $i < $result->num_rows; $i++)
                    {
                        $row = $result->fetch_assoc();
                        $dev_array[$i] = $row;
                    }

                    $this->storeOrders = $dev_array;
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
  }

//   using class
$json = file_get_contents('php://input');
$post = json_decode($json, true);
$user_id = $post['user_id'];

if ($post && $user_id) {

    $object = new stdClass();
    $store = new StoreOwnerOrders($conn);

    if ($store->getHikashopUserId($user_id)) {
        if ($store->getStoreOrders()) {
            $object->response = 'ok';
            $object->store_vendor_id = $store->store_vendor_id;
        } else {
            $object->response = 'notok';
        }
    } else {
        $object->response = 'notokhika';
    }
    echo json_encode([$object, $store->storeOrders], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

}else{
    $object->response = 'notokError';
    echo json_encode([$object, null], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

}


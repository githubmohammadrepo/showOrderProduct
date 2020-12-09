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



  class ReplaceOrderProduct
  {
    private $conn;
    private $replaceProducts = Array();
    private $session;

    public function __construct($conn, $JFactory_getSession)
    {
      $this->conn = $conn;
      $this->session = $JFactory_getSession;
    }



    /**
     * get all product in the same category
     * @param int $product_id product_id field on product
     * @return bool
     */
    public function getAllProductInsTheSameCategory(int $product_id):bool
    {
      $statusComplete = false;
      try {
        // run your code here
        $sql = "SELECT Category.*,pish_hikashop_product.* FROM (SELECT * FROM pish_hikashop_product_category WHERE pish_hikashop_product_category.category_id = (SELECT pish_hikashop_category.category_id FROM pish_hikashop_category WHERE pish_hikashop_category.category_id IN ( SELECT pish_hikashop_product_category.category_id FROM pish_hikashop_product_category WHERE pish_hikashop_product_category.product_id = $product_id) AND pish_hikashop_category.category_type = 'product')) AS Category\n"

      . "INNER JOIN\n"

      . "pish_hikashop_product\n"

      . "ON Category.product_id = pish_hikashop_product.product_id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
          
          while ($row = $result->fetch_assoc()) {
            $this->replaceProducts[] = $row;
          }
          $statusComplete = true;
          
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
     * show result getAllProductInOneCategory
     * @param int $typeAction 
     * @param int $product_id 
     * @param stdClass $object 
     * @return string
     */
    public function showResultAllProductInOneCategory($typeAction,$product_id,&$object):void
    {
      if ($typeAction == 'getSameCategory') {
        if ($this->getAllProductInsTheSameCategory($product_id)) {
          $object->response = 'ok';
          $object->data = $this->replaceProducts;
        }else{
          $object->response ='notok';
        }
      } else {
        $object->response = 'notok';
      }
    }

  
  }

  //global Array
  //   using class
  $json = file_get_contents('php://input');
  $post = json_decode($json, true);

  $object = new stdClass();

  $product_id = $post['product_id'];
  $typeAction = $post['typeAction']; //is "getSameCategory" or "reject"

  if ($post && count($post) && $product_id && $typeAction) {

    $object = new stdClass();
    $replaceProduct = new ReplaceOrderProduct($conn, JFactory::getSession());
      if ($typeAction == 'getSameCategory') {
        $replaceProduct->showResultAllProductInOneCategory($typeAction,$product_id,$object);
      }else{
        $object->response = 'notok';
      } 
    } else {
      $object->response = 'notok';
    }


  jsonEncodeOutput($object);

  /**
   * customer jsonEncodedOutput
   */
  function jsonEncodeOutput($normalObject = null)
  {
    echo json_encode([$normalObject], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
  }

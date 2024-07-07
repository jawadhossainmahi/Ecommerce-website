<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
        
    ];
   
    public function getproduct()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
    public function getuser()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    
    
    
    
    public function GetCartProducts()
    {
        session_start();
        // $jsonData = file_get_contents('products.json');
        $jsonData = file_get_contents(env("BASE_URL")."api/products");
        $data = json_decode($jsonData, true);
        $results = array();
        $product_details = array();
        $product_categories = array();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        } else {
            foreach ($_SESSION['cart'] as $key => $value) {
                foreach ($data['data'][0] as $key2 => $value2) {
                    if ($key == $value2['id']) {
                        $category = $value2['category'];
                        if (!isset($product_details[$category])) {
                            $product_details[$category] = array();
                            array_push($product_categories, $category);
                        }
                        $value2['qty'] = $_SESSION['cart'][$key];
                        array_push($product_details[$category], $value2);
                    }
                }
            }
            $results[0] = $product_categories;
            $results[1] = $product_details;
        }
        if (empty($results)) {
            $results = array('status' => 'error', 'message' => 'No Products in Cart');
        }
        echo json_encode($results);
    }
    
    public function EmptyCart()
    {
        session_start();
        unset($_SESSION['cart']);
    }
    
    public function Checkout()
    {
        include 'db_connection.php';
        session_start();
        // $jsonData = file_get_contents('products.json');
        
        $jsonData = file_get_contents(env("BASE_URL")."api/products");
        $data = json_decode($jsonData, true);
        $result = array();
        $total = 0;
        foreach ($_SESSION['cart'] as $key => $value) {
            foreach ($data['data'][0] as $key2 => $value2) {
                if ($key == $value2['id']) {
                    $array = array();
                    $qty = $_SESSION['cart'][$key];
                    $price = substr(strval($value2['price']), 0, 2);
                    array_push($array, $qty);
                    array_push($array, $price);
                    array_push($array, $value2['id']);
                    $total = $total + (intval($price) * $qty);
                    array_push($result, $array);
                }
            }
        }
        $sql = "INSERT INTO `order`(`total`) VALUES ('$total')";
        if ($conn->query($sql)) {
            $order_id = $conn->insert_id;
            foreach ($result as $key => $value) {
                $sql = "INSERT INTO `order_details`(`product_id`, `product_qty`, `product_price`, `cart_id`) VALUES ('$value[2]','$value[0]','$value[1]','$order_id')";
                if (!$conn->query($sql)) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            unset($_SESSION['cart']);
            echo json_encode(array('status' => 'success', 'message' => 'Order Placed Successfully'));
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
    
    }
    
    public function GetQuantity()
    {
        session_start();
        $id= $_POST['id'];
        $array = array();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
        if (isset($_SESSION['cart'][$id])) {
            $qty=intval($_SESSION['cart'][$id]) + 1;
            $_SESSION['cart'][$id] = $qty;
            array_push($array, $qty);
        } else {
            $_SESSION['cart'][$id] = 1;
            array_push($array, 1);
        }
        echo json_encode($array);
    }
}

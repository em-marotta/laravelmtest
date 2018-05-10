<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create(){
        return View('product.create');
    }
    
    public function get_product_row($name, $quantity, $price){
        $total = $price * $quantity;
        $row = '<tr>'
                . '<td>'.$name.'</td>'
                . '<td>'.$quantity.'</td>'
                . '<td>'.$price.'</td>'
                . '<td>'.date("Y-m-d H:i:s", time()).'</td>'
                . '<td>'.$total.'</td>'        
                . '</tr>';
        return $row;
    }
}

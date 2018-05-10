<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product/create', 'ProductController@create');

Route::post('/product/saveproduct', function (){    
    if(Request::ajax()){  
        $data = Request::all();
        $c = new App\Http\Controllers\ProductController();
        return $c->get_product_row($data['info']['name'], $data['info']['quantity'], $data['info']['price']);
    }    
    
});

Route::post('/product/savefile', function (){
    $json = Request::all();
    Storage::disk('local')->put('products.json', json_encode($json));
    return "A";
});
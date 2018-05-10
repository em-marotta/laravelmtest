@extends('layouts.app')
@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form id="frmproduct" action="#" class="form-horizontal">
                    <fieldset>
                        <legend class="text-center header">Products</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="pname" name="pname" type="text" placeholder="Product name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="quantity" name="quantity" type="text" placeholder="Quantity in stock" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-1 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="price" name="price" type="text" placeholder="Price per item" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button id="btnsave" type="button" class="btn btn-primary btn-lg">Save</button>
                            </div>
                        </div>
                    </fieldset>
                </form>                
            </div>
            <div class="well well-sm">                
                <div id="products">
                    <table id="products-table" class="table"><tbody></tbody></table>                    
                </div>
            </div>            
        </div>        
    </div>
    
    <script type="text/javascript">
        jQuery(document).ready(function (){
            
            initialice();        
            
            jQuery(document).on("click", "#btnsave", function(e) {
                
                jQuery.ajax({
                    url:'saveproduct',
                    type:  'POST',
                    headers: { 'x-csrf-token':$("meta[name=csrf-token]").attr('content') }, 
                    data: { 
                        //info: $("#frmproduct").serialize()
                        //info: {"name":"A", "price":"100.23", "quantity":"10"}
                        info: {
                            "name" : $("#pname").val(),
                            "quantity" : $("#quantity").val(),
                            "price" : $("#price").val(),
                        }
                    },
                    success:  function (response) {
                        if($('#products-table >tbody >tr').length == 0) {
                            $("#products").html('<table id="products-table" class="table"><thead>\n\
                                                    <tr>\n\
                                                        <th>Product name</th>\n\
                                                        <th>Quantity in Stock</th>\n\
                                                        <th>Price per item</th>\n\
                                                        <th>Time submitted</th>\n\
                                                        <th>Total</th>\n\
                                                    </tr>\n\
                                                 </thead><tbody></tbody></table>');
                        }
                        
                        $('#products-table > tbody:last').append(response);
                        
                        savedata();
                    }
                });
            });
                        
        });
        
        function initialice(){
            if( $('#products-table >tbody >tr').length == 0){
                html = '<div class="alert alert-info" role="alert">There are no products loaded</div>';
            } 
            
            $("#products").html(html);
        }
        
        function savedata(){            
            var products = new Array();
            $("#products-table tbody tr").each(function (index) {
                var product = new Object();
                $(this).children("td").each(function (index2) {                    
                    switch (index2) {
                        case 0: 
                            product.name = $(this).text();
                            break;
                        case 1: 
                            product.quantity = $(this).text();
                            break;
                        case 2: 
                            product.price = $(this).text();
                            break;
                        case 3: 
                            product.time_add = $(this).text();
                            break;
                        case 4: 
                            product.total = $(this).text();
                            break;
                    }
                });
                
                
                
                products.push(product);
            });
            
            jQuery.ajax({
                url:'savefile',
                type:  'POST',
                dataType: "json",
                headers: { 'x-csrf-token':$("meta[name=csrf-token]").attr('content') }, 
                data: {
                    info: products
                },
                success: function (response) {
                    alert("Product was saved in the products.json file.");
                }
            });
        }
    </script>
@endsection
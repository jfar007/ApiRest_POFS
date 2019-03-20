<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<style type="text/css">
body{ line-height: 20px;}
</style> 
	<title>Pedido</title>
</head>
<body>

        <div class="row">
        <div class="col-lg-12 col-lg-12">  <p> 
            <img src="https://clientity.com/img/bot_icons/68022f2b2fc602c959836b7f8e3c26d560da77d54d0.png" align="left">
                Food Solutions Inc. 
            </p>
        </div>
        <div align="center" class="col-md-3 col-md-3"> 
            <p>
           {{ $customer->name }}  <br>
            {{ $branchoffice->name }}   <br>
            {{ $branchoffice->main_phone }}   <br>
            {{ $branchoffice->main_address }}   <br>
            </p>
            </div>
        <div align="right" class="col-md-3 col-md-3"><h5 >Pedido - {{ $pedido }}</h5></div>
        </div>

    <table class="table table-striped" id="laravel_crud">
    <thead>
        <tr>
        <th>Fecha de Orden</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Unidad</th>
        <th>Empaque</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
        <td>{{ date('d m Y', strtotime($order->purchase_order_date)) }}</td>   
        <td>{{ $order->productname }}</td>
        <td>{{ $order->quantity }}</td>
        <td>{{ $order->unitname }}</td>
        <td>{{ $order->packsize }}</td>
        </tr>
    @endforeach
 </tbody>
</table>
</body>
</html>
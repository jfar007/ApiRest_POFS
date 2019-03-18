<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">

</head>
<body>

@if ($index === 1)  
    <p>Buen d&iacute;a<p>
    <p>Se ha generado este correo de forma autom&aacute;tica para informarle que el pedido  {{ $pushOrderData['pedido'] }} se encuentra creado en la plataforma, si no genera el pedido antes del  
     {{ $pushOrderData['dia'] }} a las    {{ $pushOrderData['hora'] }} se omitir&aacute;.</p>
     <p>Complete las unidades a solicitar, al terminar el proceso de clic en el bot&oacute;n Generar Pedido dentro de la plataforma, una vez realizado este proceso puede 
        hacer el cargue de la orden de compra en el pedido Generado.</p>

@else 

    <p>Hola  {{ $user->name }}</p>
    
    <p>Genero el pedido {{ $pushOrderData['pedido'] }}. El adjunto no representa aceptaci&oacute;n del mismo, es necesario generar la Orden de Compra y que esta sea cargada en la plataforma.</p>

@endif

</body>
</html>
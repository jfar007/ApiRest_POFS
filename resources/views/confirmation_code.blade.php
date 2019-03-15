<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
</head>
<body>
<h1>Hola, {{ $name }}</h1>
@if ($register === 1)
    <h2>Gracias por registrarte en <strong>FoodSolutionsMarket</strong> !</h2>
    <p>Por favor confirma tu correo electrónico.</p>
    <p>Para ello simplemente debes hacer click en el siguiente enlace:</p>
    <a href="{{ url('api/u/verify/' . $confirmation_code) }}">Clic para confirmar tu email</a>
    
    <p>Para ingresar a la plataforma utilice los siguientes datos de ingreso:</p>

    <h4> Usuario:   {{ $username }} </h4>
    <h4> Password:  {{ $password }} </h4>
@else
    
    <h2>Ha recibido este email por que olvido su password.</h2>
    
    <p>Por favor ingrese con las siguientes credenciales para restablecer el acceso:</p>

    <h4> Usuario:   {{ $username }} </h4>
    <h4> Password:  {{ $password }} </h4>
@endif

</body>
</html>
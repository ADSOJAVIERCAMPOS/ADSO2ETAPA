<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>¡Preinscripción Exitosa!</title>
</head>

<body>

    <h1>¡Gracias por unirte a nuestra comunidad! Estamos emocionados de que seas parte de este proyecto.</h1>

    <!-- Aquí se inserta la imagen usando una URL absoluta -->
    <!-- Usando Embed -->
    <div style="text-align:center;">
        <a href="http://localhost:3000/Registro" target="_blank">
            <img src="<?php echo e($message->embed(public_path('images/Preinscrito.png'))); ?>" alt="Preinscripción Exitosa"
                style="width:100%; max-width:600px;" />
        </a>
    </div>


</body>

</html>
<?php /**PATH C:\app_complementariaBack\resources\views/emails/confirmed_call.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Preinscripción Exitosa!</title>
</head>
<body>
    <h1>¡Gracias por unirte a nuestra comunidad!</h1>
    <p><?php echo e($data['email']); ?></p>
    <p>¡Bienvenido/a <?php echo e($data['name']); ?> <?php echo e($data['last_name']); ?>! Estamos emocionados de que seas parte de este proyecto.</p>
    <p>Has sido inscrito en el curso: <?php echo e($data['name_course']); ?>.</p>

    <div style="text-align:center;">
        <a href="http://localhost:3000/Registro" target="_blank">
            <img src="<?php echo e($message->embed(public_path('images/Preinscrito.png'))); ?>" alt="Preinscripción Exitosa" style="width:100%; max-width:600px;" />
        </a>
    </div>
</body>
</html>
<?php /**PATH C:\Users\vivil\app_complementariaBack\resources\views/emails/confirmed_call.blade.php ENDPATH**/ ?>
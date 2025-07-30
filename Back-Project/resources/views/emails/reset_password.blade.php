<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <p>Hola,</p>
    <p>Para restablecer tu contraseña, por favor haz clic en el siguiente enlace:</p>
    <p><a href="{{ url('reset-password/'.$token.'?email='.$email) }}">Restablecer Contraseña</a></p>
    <p>Si no solicitaste un restablecimiento de contraseña, simplemente ignora este correo.</p>
</body>
</html>

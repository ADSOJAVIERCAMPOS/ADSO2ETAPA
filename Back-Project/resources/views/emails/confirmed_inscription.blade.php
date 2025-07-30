<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Inscripción Exitosa!</title>
</head>
<body>
    <h1>¡Inscripción Exitosa!</h1>
    <p>Hola {{ $data['name'] }} {{ $data['last_name'] }},</p>
    <p>Estas Inscrito a "{{ $data['name_course'] }}".
    <div style="text-align:center;">
        <a href="http://localhost:3000/Registro" target="_blank">
            <img src="{{ $message->embed(public_path('images/Inscrito.png')) }}" alt="Inscripción Exitosa" style="width:100%; max-width:600px;" />
        </a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¡Preinscripción Exitosa!</title>
</head>
<body>
    <h1>¡Preinscripción Exitosa!</h1>
    <p>Hola {{ $data['name'] }} {{ $data['last_name'] }},</p>
    <p>Bienvenido/a a SISCOM te informamos que te has preinscrito exitosamente en el curso: "{{ $data['name_course'] }}".
    <div style="text-align:center;">
        <a href="http://localhost:3000/Registro" target="_blank">
            <img src="{{ $message->embed(public_path('images/Preinscrito.png')) }}" alt="Preinscripción Exitosa" style="width:100%; max-width:600px;" />
        </a>
    </div>
</body>
</html>

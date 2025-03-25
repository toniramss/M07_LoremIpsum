<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos enviados desde el formulario
    $titulo = "";
    $descripcion = "";

    if (isset($_POST['titulo'])) {
        $titulo = trim($_POST['titulo']);
    }

    if (isset($_POST['descripcion'])) {
        $descripcion = trim($_POST['descripcion']);
    }

    // Verificar que los campos no estén vacíos
    if (empty($titulo) || empty($descripcion)) {
        die("Error: Todos los campos son obligatorios.");
    }

    // URL de la API
    $url = "http://localhost/daw/PracticaLoremIpsum/notas_api/index.php";


    // Datos a enviar en JSON
    $data = array(
        'titulo' => $titulo,
        'descripcion' => $descripcion
    );

    $data_json = json_encode($data);

    // Convierte los datos a formato JSON
    $data_json = json_encode($data);

    // Inicializa cURL
    $ch = curl_init($url);

    // Configura las opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_json)
    ));

    // Ejecuta la petición cURL y guarda la respuesta
    $response = curl_exec($ch);

    // Verifica si ocurrió algún error en la petición
    if (curl_errno($ch)) {
        echo 'Error en la petición cURL: ' . curl_error($ch);
    } else {
        // Si la petición fue exitosa, muestra la respuesta
        echo 'Respuesta de la API: ' . $response;
        header('Location: index.php');
        exit();
    }

    // Cierra la sesión de cURL
    curl_close($ch);
} else {
    echo "Acceso denegado.";
}

?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que los datos fueron enviados
    if (isset($_POST['idNota'], $_POST['titulo'], $_POST['descripcion'])) {
        $idNota = $_POST['idNota'];
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];

        // URL de la API
        $api_url = "http://localhost/daw/PracticaLoremIpsum/notas_api/index.php";

        // Crear un array con los datos a enviar
        $data = [
            "id" => $idNota,
            "titulo" => $titulo,
            "descripcion" => $descripcion
        ];

        // Configurar la solicitud PUT
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        // Ejecutar la solicitud
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Decodificar la respuesta
        $result = json_decode($response, true);

        // Redireccionar o mostrar mensaje según la respuesta
        if ($http_code === 200) {
            header("Location: index.php?success=Nota actualizada");
            exit();
        } else {
            echo "<p>Error al actualizar la nota: " . ($result['error'] ?? "Error desconocido") . "</p>";
        }
    } else {
        echo "<p>Error: Datos incompletos.</p>";
    }
} else {
    echo "<p>Método no permitido.</p>";
}

?>

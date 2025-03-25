<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si se envió el ID de la nota
    if (isset($_POST['idNota'])) {
        $idNota = $_POST['idNota'];

        // URL de la API
        $api_url = "http://localhost/daw/PracticaLoremIpsum/notas_api/index.php?id=$idNota";

        // Configurar la solicitud DELETE
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        // Ejecutar la solicitud
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Decodificar la respuesta
        $result = json_decode($response, true);

        // Redireccionar o mostrar mensaje según la respuesta
        if ($http_code === 200) {
            header("Location: index.php?success=Nota eliminada");
            exit();
        } else {
            echo "<p>Error al eliminar la nota: " . ($result['error'] ?? "Error desconocido") . "</p>";
        }
    } else {
        echo "<p>Error: No se recibió el ID de la nota.</p>";
    }
} else {
    echo "<p>Método no permitido.</p>";
}

?>

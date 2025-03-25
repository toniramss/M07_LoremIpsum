<?php
require 'database.php';

header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Obtener todas las tareas
        $stmt = $pdo->query("SELECT * FROM Notas");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    case 'POST':
        // Leer los datos JSON de la solicitud
        $data = json_decode(file_get_contents("php://input"), true);

        // Verificar que se recibieron título y descripción
        if (isset($data['titulo']) && isset($data['descripcion'])) {
            $stmt = $pdo->prepare("INSERT INTO Notas (titulo, descripcion) VALUES (:titulo, :descripcion)");
            $stmt->execute([
                'titulo' => $data['titulo'],
                'descripcion' => $data['descripcion']
            ]);

            echo json_encode(["message" => "Nota creada con éxito"]);
        } else {
            echo json_encode(["error" => "Título y descripción son requeridos"]);
        }
        break;


    case 'PUT':
        // Actualizar una tarea
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id'], $data['titulo'], $data['descripcion'])) {
            $stmt = $pdo->prepare("UPDATE Notas SET titulo = :titulo, descripcion = :descripcion WHERE id = :id");
            $stmt->execute([
                'titulo' => $data['titulo'],
                'descripcion' => $data['descripcion'],
                'id' => $data['id']
            ]);
            echo json_encode(["message" => "Nota actualizada"]);
        } else {
            echo json_encode(["error" => "Datos inválidos"]);
        }
        break;

    case 'DELETE':
        // Eliminar una tarea
        $data = json_decode(file_get_contents("php://input"), true);
        if (isset($data['id'])) {
            $stmt = $pdo->prepare("DELETE FROM Notas WHERE id = :id");
            $stmt->execute(['id' => $data['id']]);
            echo json_encode(["message" => "Tarea eliminada"]);
        } else {
            echo json_encode(["error" => "ID requerido"]);
        }
        break;

    default:
        echo json_encode(["error" => "Método no soportado"]);
        break;
}
?>
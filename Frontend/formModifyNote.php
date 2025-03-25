<?php

$idNota = $_GET['idNota'] ?? null;
$nota = null;

try {
    $api_url = "http://localhost/daw/PracticaLoremIpsum/notas_api/index.php";
    $notas = json_decode(file_get_contents($api_url), true);

    if ($idNota !== null) {
        $nota = buscarNota($notas, $idNota);
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

function buscarNota($notas, $idNota) {
    foreach ($notas as $n) {
        if ($n['id'] == $idNota) {
            return $n;
        }
    }
    return null;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Nota</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

<div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
    <h1 class="text-3xl font-semibold text-center text-blue-600 mb-6">Editar Nota</h1>
    
    <?php if ($nota): ?>
        <form action="update_nota.php" method="POST" class="space-y-6">
            <input type="hidden" name="idNota" value="<?php echo htmlspecialchars($nota['id']); ?>">

            <!-- Campo de Título -->
            <div>
                <label for="titulo" class="block text-lg font-medium text-gray-700">Título</label>
                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($nota['titulo'] ?? ''); ?>" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Campo de Descripción -->
            <div>
                <label for="descripcion" class="block text-lg font-medium text-gray-700">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required><?php echo htmlspecialchars($nota['descripcion'] ?? ''); ?></textarea>
            </div>

            <!-- Botón de Enviar -->
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none">Guardar Cambios</button>
            </div>
        </form>
    <?php else: ?>
        <p class="text-center text-red-500">Nota no encontrada.</p>
    <?php endif; ?>
</div>

</body>
</html>

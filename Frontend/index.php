<?php

$notas = [];

try {

    $api_url = "http://localhost/daw/PracticaLoremIpsum/notas_api/index.php";

    $notas = json_decode(file_get_contents($api_url), true);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis notas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script type="module" src="scripts/scriptIndex.js"></script>
</head>

<body class="bg-gray-100 p-8">

    <h1 class="text-center text-4xl font-semibold text-blue-600 mb-8">
        Lista de Notas
    </h1>

    <div class="flex flex-row flex-wrap gap-6">
        <?php if (!empty($notas)): ?>
            <?php foreach ($notas as $nota): ?>
                <a href="formModifyNote.php?idNota= <?php echo $nota['id'] ?>">
                    <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                        <strong class="text-xl font-bold text-blue-500"><?= htmlspecialchars($nota['titulo']) ?></strong>
                        <p class="text-gray-700 mt-4"><?= htmlspecialchars($nota['descripcion']) ?></p>

                        <div class="w-full flex justify-end">

                            <a href="formDeleteNote.php?id=<?php echo $nota['id'] ?>">
                                <img class="w-6 cursor-pointer" src="images/trash-solid.svg" alt="Eliminar">
                            </a>
                        </div>
                    </div>
                </a>

            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-gray-600 col-span-full">No hay notas disponibles.</p>
        <?php endif; ?>
    </div>


    <button
        class="fixed bottom-4 right-4 bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-600 transition"
        id="buttonAnadirNota">
        +
    </button>


</body>

</html>
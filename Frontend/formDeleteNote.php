<?php
$idNota = $_GET['id'] ?? null;


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar nota</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="flex items-center justify-center">

    <div class=" top-0 left-0 p-5 bg-blue-300 rounded-xl">
        <form action="delete_nota.php" method="POST" class="w-full">
            <h1>¿Esta seguro de eliminar el elemento seleccionado? <?php echo $idNota ?></h1>

            <input type="hidden" name="idNota" value="<?php echo $idNota ?>" >
            <br>

            <div class="w-full flex flex-row justify-between">
                <button class="bg-white rounded-xl px-4 py-2 hover:bg-blue-100" type="submit" value="cancelar">Cancelar</button>
                <button class="bg-white rounded-xl px-4 py-2 hover:bg-blue-100" type="submit" value="aceptar">Aceptar</button>
            </div>


        </form>

    </div>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Agregar Clase</title>
</head>
<body>
<div class="h-screen flex items-center justify-center bg-[#797A7C]">
        <div class="flex flex-col bg-white rounded-md p-4">
    <h1 class="text-3xl">Agregar clase</h1> 
    <div class="flex flex-col">
    <form action="/clases/create" method="post" class="mt-6 flex flex-col">
        <div>
        <label for="materia" class="mb-3 text-sm font-bold">Nombre de la materia</label>
        <input type="text" class="w-full mb-2 border rounded h-8 px-2" id="materia" name="materia" placeholder="Ingresa la clase">
        </div>
        <label for="maestro" class="mb-3 text-sm font-bold">Maestros disponibles para la clase</label>
        <select name="maestro" id="maestro" class="w-full mb-2 border rounded h-8 px-2">
        <option value="" disabled selected>Sin asignar</option>
        <?php foreach ($maestros as $maestro): ?>
            <option value="<?= $maestro['id'] ?>">
                <?= $maestro['name'] ?>
            </option>
        <?php endforeach; ?>
        </select>
        </div>
        <div class="flex justify-end items-center"><a href="/clases" class="bg-[#6C737C] text-white rounded w-1/4 mt-4 py-2 mx-4 flex items-center justify-center">Close</a><button type="submit" class="bg-[#007CFC] mt-4 text-white w-1/2 rounded py-2">Guardar cambios</button></div>
    </form>
    </div>
        </div>
    </div>
</body>
</html>
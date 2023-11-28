<?php

 if (!isset($alumno)) {
     header("Location: /alumnos");
     exit();
 }

 session_start();
 $_SESSION["alumno_id_edit"] = $alumno["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Editar alumno</title>
</head>
<body>
<div class="h-screen flex items-center justify-center bg-[#797A7C]">
        <div class="flex flex-col bg-white rounded-md p-4">
    <h1 class="text-3xl">Editar Alumno</h1>
    <div class="flex flex-col">
    <form action="/alumnos/update" method="post" class="mt-6 flex flex-col">
        <input type="hidden" name="id" value="<?= $alumno['id'] ?>">
        <div>
        <label for="dni" class="mb-3 text-sm font-bold">DNI</label>
        <input type="text" class="w-full mb-2 border rounded h-8 px-2" id="dni" name="dni" value="<?= $alumno["dni"]?>">
        </div>
        <div>
        <label for="email" class="mb-3 text-sm font-bold">Correo Electronico</label>
        <input type="email" class="w-full mb-2 border rounded h-8 px-2" id="email" name="email" value="<?= $alumno["email"]?>" disabled>
        </div>
        <div>
        <label for="name" class="mb-3 text-sm font-bold">Nombre(s)</label>
        <input type="text" class="w-full mb-2 border rounded h-8 px-2" id="name" name="name" value="<?= $alumno["name"]?>">
        </div>
        <div>
        <label for="address" class="mb-3 text-sm font-bold">Direccion</label>
        <input type="text" class="w-full mb-2 border rounded h-8 px-2" id="address" name="address" value="<?= $alumno["address"]?>">
        </div>
        <div>
        <label for="birthday" class="mb-3 text-sm font-bold">Fecha de Nacimiento</label>
        <input type="date" class="w-full mb-2 border rounded h-8 px-2" id="birthdat" name="birthday" value="<?= $alumno["birthday"]?>">
        </div>
        <div class="flex justify-end items-center"><a href="/alumnos" class="bg-[#6C737C] text-white rounded w-1/4 mt-4 py-2 mx-4 flex items-center justify-center">Close</a><button type="submit" class="bg-[#007CFC] mt-4 text-white w-1/2 rounded py-2">Guardar cambios</button></div>
    </form>
    </div>
        </div>
    </div>
</body>
</html>
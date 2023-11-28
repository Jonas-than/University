<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Crear Alumno</title>
</head>
<body>
<div class="h-screen flex items-center justify-center bg-[#797A7C]">
        <div class="flex flex-col bg-white rounded-md p-4">
    <h1 class="text-3xl">Agregar Alumno</h1>
    <div class="flex flex-col">
    <form action="/alumnos/create" method="post" class="mt-6 flex flex-col">
        <div>
        <label for="dni" class="mb-3 text-sm font-bold">DNI</label>
        <input type="text" class="w-full mb-2 border rounded h-8 px-2" id="dni" name="dni" placeholder="Ingresa la matricula">
        </div>
        <div>
        <label for="email" class="mb-3 text-sm font-bold">Correo Electronico</label>
        <input type="email" class="w-full mb-2 border rounded h-8 px-2" id="email" name="email" placeholder="Ingresa email">
        </div>
        <div>
        <label for="name" class="mb-3 text-sm font-bold">Nombre(s)</label>
        <input type="text" class="w-full mb-2 border rounded h-8 px-2" id="name" name="name" placeholder="Ingresa Nombre(s)">
        </div>
        <div>
        <label for="address" class="mb-3 text-sm font-bold">Direccion</label>
        <input type="text" class="w-full mb-2 border rounded h-8 px-2" id="address" name="address" placeholder="Ingresa la direccion">
        </div>
        <div>
        <label for="birthday" class="mb-3 text-sm font-bold">Fecha de Nacimiento</label>
        <input type="date" class="w-full mb-2 border rounded h-8 px-2" id="birthday" name="birthday" placeholder="mm/dd/yyyy">
        </div>
        
        <div class="flex justify-end items-center"><a href="/alumnos" class="bg-[#6C737C] text-white rounded w-1/4 mt-4 py-2 mx-4 flex items-center justify-center">Close</a><button type="submit" class="bg-[#007CFC] mt-4 text-white w-1/2 rounded py-2">Crear</button></div>
    </form>
    </div>
        </div>
    </div>
</body>
</html>
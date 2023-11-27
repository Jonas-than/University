<?php
if (!isset($admin)) {
    header("Location: /permisos");
    exit();
}

session_start();
$_SESSION["admin_id_edit"] = $admin["id"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Editar Permisos</title>
</head>
<body>
    <div class="h-screen flex items-center justify-center bg-[#797A7C]">
        <div class="flex flex-col bg-white rounded-md p-4">
    <h1 class="text-3xl">Editar Permiso</h1>
    <div class="flex flex-col">
    <form action="/permisos/update" method="post" class="mt-6 flex flex-col">
        <div>
        <label for="email" class="mb-3 text-sm font-bold">Email del Usuario</label>
        <input type="email" class="w-full mb-2 border rounded h-8 px-2" id="email" name="email" value="<?= $admin["email"]?>">
        </div>
        <div>
        <label for="rol" class="mb-3 text-sm font-bold">Rol del usuario</label>
        <select name="role_id" id="rol" class="w-full mb-2 border rounded h-8 px-2">
        <?php foreach ($roles as $role): ?>
            <option value="<?= $role['id'] ?>" <?= ($admin['role_id'] == $role['id']) ? 'selected' : '' ?> >
            <?= $role['name'] ?>
            </option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="flex justify-end items-center"><a href="/permisos" class="bg-[#6C737C] text-white rounded w-1/4 mt-4 py-2 mx-4 flex items-center justify-center">Close</a><button type="submit" class="bg-[#007CFC] mt-4 text-white w-1/2 rounded py-2">Guardar cambios</button></div>
    </form>
    </div>
        </div>
    </div>
</body>
</html>
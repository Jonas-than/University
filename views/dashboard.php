<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <div class="w-full flex h-screen">
        <div class="bg-[#353A40] w-1/6 shadow-2xl">
        <div class="flex items-center border-b border-[#8F9398] px-4 py-2.5"><img src="/assets/logo.jpg" class="w-10 rounded-full mr-2"><span class="text-[#8F9398] text-sm">Universidad</span></div>
        <div class="border-b border-[#8F9398] py-4 mx-2">
            <h1 class=" text-[#8F9398] text-xl">admin</h1>
            <h2 class=" text-[#8F9398] text-sm">Administrador</h2>
        </div>
        <div class="mx-2 px-2 flex flex-col mt-6 mb-4">
            <h1 class="text-[#8F9398] text-center mb-4">MENU ADMINISTRACION</h1>
            <div class="mb-3"><a href="/permisos" class="text-[#8F9398] flex items-center"><span class="material-icons text-[#8F9398] mr-3">manage_accounts</span>Permisos</a></div>
            <div class="mb-3"><a href="/maestros" class="text-[#8F9398] flex items-center"><span class="material-icons text-[#8F9398] mr-3">emoji_objects</span>Maestros</a></div>
            <div class="mb-3"><a href="/alumnos" class="text-[#8F9398] flex items-center"><span class="material-icons text-[#8F9398] mr-3">school</span>Alumnos</a></div>
            <div class="mb-3"><a href="/cursos" class="text-[#8F9398] flex items-center"><span class="material-icons text-[#8F9398] mr-3">class</span>Clases</a></div>
        </div>
        </div>
        <div class="w-5/6 flex flex-col">
            <nav class="bg-[#FFFFFF] flex items-center border-b border-[#8F9398] py-4 justify-between">
                <div class="flex ml-6">
                <span class="material-icons text-[#8F9398]">menu</span>
                <h1 class="ml-10 text-[#8F9398]">Home</h1>
                </div>
                <div class="flex mr-3">
                    <span class="text-[#8F9398]">Administrador</span>
                    <button class=""><span class="material-icons text-[#8F9398]">expand_more</span></button>
                </div>
                <div id="logout-modal">
                <a href=""><span class="material-icons">account_circle</span><span>Perfil</span></a>
                <a href=""><span class="material-icons">logout</span><span>Logout</span></a>
                </div>
            </nav>
            <div class="bg-[#F5F6FA] h-screen">
                <div class="px-4 my-4">
                <div class="flex justify-between items-center">
                <h1 class="text-3xl font-medium">Dashboard</h1>
                <div><span class="text-[#5093f7]">Home </span><span>/ Dashboard</span></div>
                </div>
                <div class=" rounded shadow border-gray-500 py-4 px-4 bg-[#FFFFFF] mt-6 w-7/12">
                    <h1 class="font-semibold">Bienvenido</h1>
                    <span>Selecciona la accion que quieras realizar en las pestanas del menu de la izquierda</span>
                </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    session_start();
    $rol = $_SESSION["user"]["role_id"];

    if ($rol == 1) {
        echo "<h2>Bienvenido, admin</h2>";
    }

    if ($rol == 2) {
        echo "<h2>Bienvenido, maestro</h2>";
    }

    if ($rol == 3) {
        echo "<h2>Bienvenido, alumno</h2>";
    }
    ?>

</body>
</html>
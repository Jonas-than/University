<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/dist/output.css" rel="stylesheet">
    <title>Clases</title>
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
            <div class="mb-3"><a href="/clases" class="text-[#8F9398] flex items-center"><span class="material-icons text-[#8F9398] mr-3">class</span>Clases</a></div>
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
                    <button class="toggleButton" id="toggleButton"><span class="material-icons text-[#8F9398]">expand_more</span></button>
                </div>
                <div id="logout_modal" class="hidden fixed top-10 right-4 border rounded shadow bg-white">
                <div class="flex items-center"><a href="" class="flex items-center"><span class="material-icons">account_circle</span><span>Perfil</span></a></div>
                <div class="flex items-center"><a href="" class="flex items-center"><span class="material-icons">logout</span><span>Logout</span></a></div>
                </div>
            </nav>
            <div class="bg-[#F5F6FA] h-screen">
                <div class="px-4 my-4">
                <div class="flex justify-between items-center">
                <h1 class="text-3xl font-medium">Lista de Alumnos</h1>
                <div><span class="text-[#5093f7]">Home </span><span>/ Alumnos</span></div>
                </div>
                <div class=" rounded shadow border-gray-500 py-4 bg-[#FFFFFF] mt-6 w-full">
                    <div class="border-b px-4 flex justify-between pb-4"><span>Informacion de Alumnos</span><a href="/alumnos/create" class="bg-[#0579F2] rounded py-1 px-3 text-white text-l">Agregar Alumno</a></div>
                    <div class="px-4 mt-6 mb-6 w-full">
                    <table class="border-collapse border border-slate-500 w-full">
                        <thead>
                            <tr>
                                <th class="border border-slate-600 py-2 text-left pl-4">#</th>
                                <th class="border border-slate-600 text-left pl-4">Clase</th>
                                <th class="border border-slate-600 text-left pl-4">Maestro</th>
                                <th class="border border-slate-600 text-left pl-4">Alumnos inscritos</th>
                                <th class="border border-slate-600 text-left pl-4">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
            foreach ($cursos as $curso) {
            ?>
                <tr class="bg-white odd:bg-[#F2F2F2] ">
                    <td class="border border-slate-400 pl-4 py-2"><?= $curso["curso_id"] ?></td>
                    <td class="border border-slate-400 pl-4"><?= $curso["nombre_curso"] ?></td>
                    <td class="border border-slate-400 pl-4"><?= $curso["nombre_maestro"] ?></td>
                    <td class="border border-slate-400 pl-4"><?= $alumno["alumnos_inscritos"] ?></td>
                    <td class="border border-slate-400 text-center">
                        <a href="/alumnos/edit?id=<?= $alumno["id"] ?>" class="btnEdit"><span class="material-icons text-cyan-500">edit</span></a>
                        <form action="/alumnos/delete" method="post" style="display: inline;">
                            <input type="number" hidden value="<?= $alumno["id"] ?>" name="id">
                            <button type="submit"><span class="material-icons text-red-500">delete</span></button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
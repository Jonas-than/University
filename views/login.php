<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link href="/dist/output.css" rel="stylesheet">
    <title>Login</title>
</head>
<body class="bg-[#FFF5D2] ">
    <div class="flex justify-center items-center flex-col relative">
        <img src="/assets/logo.jpg" alt="" class="w-1/5 z-10"/>
        <div class="bg-[#FFFFFF] p-4 border-2 w-1/4 flex items-center flex-col absolute top-1/2 z-20 mt-24">
            <h1 class="mb-4 text-[#7c7d7e] font-medium mt-3">Bienvenido Ingresa con tu cuenta</h1>
            <form action="/login" method="post" class="flex flex-col w-full items-end justify-end">
                <div class="w-full relative mb-4">
                <input type="email" id="email" name="email" placeholder="Email" class="border-2 relative h-10 w-full rounded px-2 ring-blue-500" required>
                <span class="material-icons text-[#787776] absolute right-2 top-2">email</span>
                </div>
                <div class="w-full relative mb-4">
                <input type="password" id="password" name="password" placeholder="Password" class="border-2 relative h-10 w-full rounded px-2" required>
                <span class="material-icons text-[#787776] absolute right-2 top-2">lock</span>
                </div>
                <button type="submit" class="bg-[#007AFF] text-white w-1/3 rounded py-2">Ingresar</button>
            </form>
        </div>
    </div>
</body>
</html>
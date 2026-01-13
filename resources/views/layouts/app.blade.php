<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Invventa')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body class="h-full text-gray-900">
<div class="page-overlay">
    <div class="flex h-full min-h-screen">

        <!-- Sidebar -->
        @include('widgets.sidebar')

        <!-- Main content -->
        <div class="flex-1 flex flex-col">

            <!-- Header -->
            <header class="bg-white card-shadow px-8 py-6">
                @section('header')
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 id="header-title" class="text-3xl font-bold text-lime-800 mb-1">Dashboard</h2>
                            <p id="welcome-message" class="text-gray-500">Ringkasan Sistem</p>
                        </div>
                    </div>
                @show
            </header>

            <!-- Konten utama -->
            <main class="flex-1 p-8">
                @yield('content')
            </main>

        </div>
    </div>
</div>

<script src="{{ asset('js/scriptlgn.js') }}"></script>
</body>
</html>

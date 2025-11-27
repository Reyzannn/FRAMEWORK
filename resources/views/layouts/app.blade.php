<!DOCTYPE html>
<html lang="id" class="h-full">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simbadag</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  </head>
  <body class="h-full text-gray-900">
    <!-- overlay so background image is visible but content readable -->
    <div class="page-overlay">
      <div class="flex h-full min-h-screen">
        <!-- Sidebar -->
        @include('widgets.sidebar')
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
             @include('widgets.header')
          <main class="flex-1 p-8 overflow-auto">
            @yield('content')
</main>
<script src="{{ asset('js/scriptlgn.js') }}"></script>
      </body>
</html>

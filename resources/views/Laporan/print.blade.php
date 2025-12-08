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
          <main class="flex-1 p-8 overflow-auto">
            @include('Laporan.Keseluruhan')
</main>
<script src="{{ asset('js/scriptlgn.js') }}"></script>
      </body>
</html>

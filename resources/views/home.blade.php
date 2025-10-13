<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SAPA PMKS</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      background: url("{{ asset('images/Background.png') }}") no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>

<body class="min-h-screen">

  <header class="absolute top-0 left-0 w-full flex justify-between items-center p-4 md:p-8">
    <div class="flex items-center space-x-3">
      <img src="{{ asset('images/logo-dinsos.png') }}" alt="DINSOS PPPA" class="h-12 md:h-16 object-contain">
      <div class="text-left leading-tight text-gray-900">
      </div>
    </div>

    <div>
      <img src="{{ asset('images/logo-sapa.png') }}" alt="SAPA PMKS" class="h-12 md:h-20 object-contain">
    </div>
  </header>

  <main class="flex items-center justify-center min-h-screen">
    <div class="text-center text-gray-900">
      <h1 class="text-xl md:text-2xl font-bold mb-2 leading-snug">
        PUSAT LAYANAN ASPIRASI DAN PENANGANAN PENGADUAN<br>
        PENYANDANG MASALAH KESEJAHTERAAN SOSIAL
      </h1>
      <p class="text-gray-700 mb-8">KESEJAHTERAAN SOSIAL TERINTEGRASI DINAS SOSIAL</p>

      <p class="text-5xl font-extrabold text-blue-900 mb-4 drop-shadow-lg">SAPA PMKS</p>
      <p class="text-lg mb-12">
        SISTEM ADUAN DAN PELAYANAN PENYANDANG MASALAH KESEJAHTERAAN SOSIAL TERPADU
      </p>

      <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-6">
        <a href="{{ route('pengaduan.create') }}"
          class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-lg shadow-lg transition duration-300 ease-in-out">
          BUAT PENGADUAN
        </a>
        <a href="{{ route('pengaduan.tracking') }}"
          class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-lg shadow-lg transition duration-300 ease-in-out">
          CEK TRACKING
        </a>
      </div>
      
    </div>
  </main>

</body>

</html>
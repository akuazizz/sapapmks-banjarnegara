<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SAPA PMKS</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="text-center">
    <img src="{{ asset('images/logo-dinsos.png') }}" alt="DINSOS PPPA" class="mx-auto h-16 mb-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">PUSAT LAYANAN ASPIRASI DAN PENANGANAN PENGADUAN PENYANDANG MASALAH
    </h1>
    <h2 class="text-xl text-gray-700 mb-8">KESEJAHTERAAN SOSIAL TERINTEGRASI DINAS SOSIAL</h2>
    <p class="text-5xl font-extrabold text-blue-800 mb-8">SAPA PMKS</p>
    <p class="text-lg text-gray-600 mb-12">SISTEM ADUAN DAN PELAYANAN PENYANDANG MASALAH KESEJAHTERAAN SOSIAL TERPADU
    </p>

    <div class="flex justify-center space-x-4">
      <a href="{{ route('pengaduan.create') }}"
        class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg">BUAT PENGADUAN</a>
      <a href="#" class="bg-gray-600 hover:bg-gray-500 text-white font-bold py-3 px-8 rounded-lg shadow-lg">CEK
        TRACKING</a>
    </div>
  </div>
</body>

</html>
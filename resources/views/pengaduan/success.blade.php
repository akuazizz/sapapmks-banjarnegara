<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengaduan Berhasil</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f3f4f6;
    }

    body {
      background: url("{{ asset('images/Background.png') }}") no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
  <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md text-center">
    <div class="mb-6">
      <!-- Checkmark SVG Icon -->
      <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Pengaduan Berhasil!</h1>
    <p class="text-gray-600 mb-6">Terima kasih, pengaduan Anda telah berhasil kami terima. Silakan simpan kode pengaduan
      Anda untuk melacak statusnya.</p>

    <div class="bg-gray-100 rounded-lg p-4 mb-6">
      <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Kode Pengaduan</h2>
      <!-- Display the kode_pengaduan from the controller -->
      <p class="text-xl font-mono text-gray-900 mt-2">{{ $pengaduan->kode_pengaduan }}</p>
    </div>

    <a href="/"
      class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-300">
      Kembali ke Beranda
    </a>
  </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - SAPA PMKS | @yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      background-color: #f7fafc;
      /* Latar belakang abu-abu terang */
      /* Pastikan asset('images/Background.png') ada di folder public/images */
      background-image: url('{{ asset('images/Background.png') }}');
      background-size: cover;
      background-position: center;
    }

    .admin-content {
      background-color: rgba(255, 255, 255, 0.95);
      /* Transparan samar agar background terlihat */
      border-radius: 1rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body class="min-h-screen">

  <header class="w-full flex justify-between items-center p-6 sm:p-8 bg-white shadow-md">
    <div class="flex items-center space-x-6">
      <img src="{{ asset('images/logo-dinsos.png') }}" alt="DINSOS PPPA" class="h-10">
      <img src="{{ asset('images/logo-sapa.png') }}" alt="SAPA PMKS" class="h-12">
    </div>

    <button type="button" onclick="toggleLogoutModal()"
      class="flex items-center space-x-2 text-gray-800 font-semibold hover:text-blue-900 transition duration-150">
      <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
        </path>
      </svg>
      <span>{{ Auth::user()->name ?? 'Admin' }}</span>
    </button>
  </header>
  <main class="p-8">
    <div class="admin-content p-6 md:p-10">
      @yield('content')
    </div>
  </main>

  <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white p-10 rounded-xl shadow-2xl w-full max-w-sm mx-auto text-center">
      <h3 class="text-xl font-bold mb-6 text-gray-800">Yakin ingin keluar?</h3>
      <div class="flex justify-center space-x-4">
        <button type="button" onclick="toggleLogoutModal()"
          class="bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg hover:bg-gray-400 transition duration-150">
          Batal
        </button>

        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit"
            class="bg-blue-900 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-800 transition duration-150">
            Keluar
          </button>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Fungsi global untuk modal logout, bisa dipanggil dari mana saja
    function toggleLogoutModal() {
      document.getElementById('logoutModal').classList.toggle('hidden');
    }
  </script>
</body>

</html>
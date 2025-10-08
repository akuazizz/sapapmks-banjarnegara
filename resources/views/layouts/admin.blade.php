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
      background-image: url('{{ asset('images/Background.png') }}');
      background-size: cover;
      background-position: center;
    }

    .admin-content {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 1rem;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>

<body class="min-h-screen">

  <!-- HEADER -->
  <header class="absolute top-0 left-0 w-full flex justify-between items-start p-8">
    <div class="flex items-center space-x-3">
      <img src="{{ asset('images/logo-dinsos.png') }}" alt="DINSOS PPPA" class="h-16">
      <div class="text-left leading-tight text-gray-900">
      </div>
    </div>
    <div>
      <img src="{{ asset('images/logo-sapa.png') }}" alt="SAPA PMKS" class="h-20">
    </div>
  </header>

  <!-- MAIN CONTENT -->
  <main class="p-8 pt-32">
    @yield('content')
  </main>

  <!-- LOGOUT MODAL -->
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
    function toggleLogoutModal() {
      document.getElementById('logoutModal').classList.toggle('hidden');
    }
  </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin - SAPA PMKS</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .login-card {
      /* Gaya untuk card login */
      max-width: 480px;
      /* Ukuran maksimal card */
    }

    body {
      background: url("{{ asset('images/Background.png') }}") no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen p-4">

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

  <div class="login-card bg-white p-8 sm:p-12 rounded-xl shadow-2xl w-full mx-auto mt-20"
    style="filter: drop-shadow(0 20px 13px rgb(0 0 0 / 0.03)) drop-shadow(0 8px 5px rgb(0 0 0 / 0.08));">

    <h2 class="text-2xl font-bold mb-8 text-center text-gray-800">Login Admin</h2>

    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <p>{{ $errors->first('email') }}</p>
      </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
      @csrf

      <div class="mb-6">
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </span>
          <input type="email" id="email" name="email"
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg placeholder-gray-500 text-gray-900 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Username" value="{{ old('email') }}" required autofocus>
        </div>
      </div>

      <div class="mb-8">
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V9a2 2 0 014 0v2" />
            </svg>
          </span>
          <input type="password" id="password" name="password"
            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg placeholder-gray-500 text-gray-900 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Password" required>
        </div>
      </div>

      <button type="submit"
        class="w-full bg-blue-900 text-white font-bold py-3 rounded-lg hover:bg-blue-800 transition duration-300 ease-in-out text-lg shadow-md">
        Login
      </button>
    </form>

    <div class="mt-4 text-center">
      <a href="{{ url('/') }}"
        class="inline-block text-blue-600 hover:text-blue-800 transition duration-300 ease-in-out font-medium text-sm py-2 px-4 rounded-lg border border-transparent hover:border-blue-200">
        &larr; Kembali ke Halaman Utama
      </a>
    </div>

  </div>

</body>

</html>
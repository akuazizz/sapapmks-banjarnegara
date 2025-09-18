<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pengaduan - SAPA PMKS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col justify-center">

    <!-- Header -->
    <header class="absolute top-0 left-0 w-full flex justify-between items-start p-6">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-dinsos.png') }}" alt="DINSOS PPPA" class="h-16">
            <div class="text-left leading-tight text-gray-900">
            </div>
        </div>
        <div>
            <img src="{{ asset('images/logo-sapa.png') }}" alt="SAPA PMKS" class="h-16">
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 pt-32 pb-12 text-center">
        <h1 class="text-2xl md:text-3xl font-extrabold text-blue-900 mb-3">
            CEK STATUS PENGADUAN ANDA
        </h1>
        <p class="text-gray-700 mb-8">
            Pantau Perkembangan Pengaduan PMKS Secara Cepat dan Mudah
        </p>

        <form action="{{ route('pengaduan.tracking') }}" method="GET" class="max-w-xl mx-auto">
            <div class="relative">
                <input type="text" name="kode_pengaduan" placeholder="Kode Pengaduan"
                    class="w-full border border-gray-300 rounded pl-4 pr-10 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
                <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <!-- Ikon Search -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 hover:text-blue-700"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                </button>
            </div>
            <button type="submit"
                class="mt-6 bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition duration-300 ease-in-out">
                Cari
            </button>
        </form>

        <!-- Hasil Tracking -->
        @if(request()->has('kode_pengaduan'))
            <div class="mt-10">
                @if($pengaduan)
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold text-blue-900 mb-3">Hasil Tracking</h2>
                        <p><strong>Kode:</strong> {{ $pengaduan->kode_pengaduan }}</p>
                        <p><strong>Nama:</strong> {{ $pengaduan->nama }}</p>
                        <p><strong>Status:</strong>
                            <span class="px-3 py-1 rounded bg-blue-100 text-blue-800">
                                {{ $pengaduan->status }}
                            </span>
                        </p>
                    </div>
                @else
                    <p class="text-red-600 font-semibold">Kode pengaduan tidak ditemukan.</p>
                @endif
            </div>
        @endif
    </main>

</body>
</html>

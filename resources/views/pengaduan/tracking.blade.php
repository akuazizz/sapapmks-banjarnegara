<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Pengaduan - SAPA PMKS</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 2rem;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0.5rem;
            height: 100%;
            width: 2px;
            background-color: #d1d5db;
            /* bg-gray-300 */
        }

        .timeline-marker {
            position: absolute;
            top: 0;
            left: 0;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            background-color: #d1d5db;
            /* bg-gray-300 */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .timeline-item.active .timeline-marker {
            background-color: #2563eb;
            /* bg-blue-600 */
        }

        .timeline-item.active::before {
            background-color: #2563eb;
            /* bg-blue-600 */
        }
        
        body {
            background: url("{{ asset('images/Background.png') }}") no-repeat center center fixed;
            background-size: cover;
    }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center pt-8 md:pt-16">

    <!-- Header -->
    <header class="absolute top-0 left-0 w-full flex justify-between items-start p-6">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo-dinsos.png') }}" alt="DINSOS PPPA" class="h-16">
            <div class="text-left leading-tight text-gray-900">
                <!-- Anda bisa menambahkan teks di sini jika diperlukan, sesuai desain DINSOS PPPA -->
            </div>
        </div>
        <div>
            <img src="{{ asset('images/logo-sapa.png') }}" alt="SAPA PMKS" class="h-20">
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 mt-24 md:mt-32 pb-12 text-center max-w-4xl">
        <h1 class="text-2xl md:text-3xl font-extrabold text-blue-900 mb-3">
            CEK STATUS PENGADUAN ANDA
        </h1>
        <p class="text-gray-700 mb-8">
            Pantau Perkembangan Pengaduan PMKS Secara Cepat dan Mudah
        </p>

        <form action="{{ route('pengaduan.tracking') }}" method="GET" class="max-w-xl mx-auto mb-12">
    <div class="relative mb-6">
        <input type="text" name="kode_pengaduan" placeholder="Masukkan Kode Pengaduan Anda"
            value="{{ request('kode_pengaduan') }}"
            class="w-full border border-gray-300 rounded-lg pl-4 pr-10 py-3 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent">
        <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 hover:text-blue-700"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
        </button>
    </div>

    {{-- Tombol aksi sejajar --}}
    <div class="flex flex-col sm:flex-row justify-center items-center gap-3">
        <a href="{{ url('/') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out w-full sm:w-auto text-center">
            Kembali
        </a>

        <button type="submit"
            class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition duration-300 ease-in-out w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>

        {{-- Hasil Tracking --}}
        @if(request()->has('kode_pengaduan') && request('kode_pengaduan') != '')
            <div class="mt-10 max-w-3xl mx-auto text-left">
                @if($pengaduan)
                    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Dasar Pengaduan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                            <div class="flex">
                                <span class="w-1/3 text-gray-600">Kode Pengaduan</span>
                                <span class="w-2/3 text-gray-800 font-medium">: {{ $pengaduan->kode_pengaduan }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-1/3 text-gray-600">Nama Pelapor</span>
                                <span class="w-2/3 text-gray-800 font-medium">: {{ $pengaduan->nama_pelapor }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-1/3 text-gray-600">Tanggal Pengajuan</span>
                                <span class="w-2/3 text-gray-800 font-medium">:
                                    {{ Carbon\Carbon::parse($pengaduan->created_at)->format('d F Y') }}</span>
                            </div>
                            <div class="flex">
                                <span class="w-1/3 text-gray-600">Jenis Pengaduan PMKS</span>
                                <span class="w-2/3 text-gray-800 font-medium">: {{ $pengaduan->jenis_pmks }}</span>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('pengaduan.detail', ['kode' => $pengaduan->kode_pengaduan]) }}"
                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-md transition duration-300 ease-in-out">
                                Lihat Detail Laporan
                            </a>
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Status Pengaduan</h2>
                        <div class="flex justify-between items-center space-x-2">
                            @php
                                $statusSteps = ['Diterima', 'Diversifikasi', 'Diproses', 'Selesai'];
                                $currentStatusIndex = array_search($pengaduan->status, $statusSteps);
                            @endphp

                            @foreach($statusSteps as $index => $step)
                                <div class="flex-1 text-center">
                                    <div class="relative flex flex-col items-center">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center
                                                        @if($index <= $currentStatusIndex) bg-blue-600 text-white @else bg-gray-300 text-gray-700 @endif
                                                        font-bold text-sm">
                                            {{ $index + 1 }}
                                        </div>
                                        <div
                                            class="mt-2 text-xs md:text-sm
                                                        @if($index <= $currentStatusIndex) text-blue-800 font-semibold @else text-gray-600 @endif">
                                            {{ $step }}
                                        </div>
                                        @if($index < count($statusSteps) - 1)
                                            <div class="absolute top-4 left-[calc(50%+1rem)] w-[calc(100%-2rem)] h-1 bg-gray-300 transform -translate-x-1/2 -z-10
                                                                @if($index < $currentStatusIndex) bg-blue-600 @endif"></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Riwayat Tindaklanjut</h2>
                        <div class="relative pl-6">
                            @foreach($riwayat_status as $index => $item)
                                <div class="timeline-item @if($item['active']) active @endif">
                                    <div class="timeline-marker">
                                        @if($item['active'])
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        @else
                                            {{ $index + 1 }}
                                        @endif
                                    </div>
                                    <div class="pl-4">
                                        <p class="font-semibold text-gray-800">{{ $item['deskripsi'] }}</p>
                                        @if($item['tanggal'])
                                            <p class="text-sm text-gray-500">{{ $item['tanggal'] }}</p>
                                        @else
                                            <p class="text-sm text-gray-500">Belum diperbarui</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                        <strong class="font-bold">Tidak Ditemukan!</strong>
                        <span class="block sm:inline">Kode pengaduan yang Anda masukkan tidak valid atau tidak ditemukan.</span>
                    </div>
                @endif
            </div>
        @endif
    </main>

</body>

</html>
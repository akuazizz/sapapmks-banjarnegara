<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan Pengaduan - {{ $pengaduan->kode_pengaduan }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            /* Pastikan path ke gambar Anda benar menggunakan fungsi asset() */
            background-image: url("{{ asset('images/Background.png') }}");
            background-size: cover;
            /* Untuk menutupi seluruh layar */
            background-attachment: fixed;
            /* Agar gambar tetap saat di-scroll */
            background-repeat: no-repeat;
            background-position: center center;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl mx-auto relative max-h-[90vh] overflow-y-auto">
        <h3 class="text-2xl font-extrabold mb-6 text-center text-blue-900 border-b pb-2">DETAIL LAPORAN</h3>

        <div class="space-y-2 text-sm">
            @php
                // Data PMKS
                $dataPmks = [
                    'Nama' => $pengaduan->nama,
                    'Jenis Kelamin' => $pengaduan->jenis_kelamin,
                    'NIK' => $pengaduan->nik,
                    'No KK' => $pengaduan->nomor_kk,
                    'Desil DTSEN' => $pengaduan->desil_dtsen,
                    'No KIS/BPJS' => $pengaduan->no_kis_bpjs,
                    'Tempat Lahir' => $pengaduan->tempat_lahir,
                    'Tanggal Lahir' => \Carbon\Carbon::parse($pengaduan->tanggal_lahir)->translatedFormat('d F Y'),
                    'Alamat KTP' => $pengaduan->alamat_ktp,
                    'Alamat Domisili' => $pengaduan->alamat_domisili,
                ];

                // Data Pelapor
                $dataPelapor = [
                    'Nama Pelapor' => $pengaduan->nama_pelapor,
                    'No HP Pelapor' => $pengaduan->nomor_hp_pelapor,
                    'Email Pelapor' => $pengaduan->email_pelapor,
                    'Pekerjaan Pelapor' => $pengaduan->pekerjaan_pelapor,
                ];

                // Data Aduan
                $dataAduan = [
                    'Jenis PMKS' => $pengaduan->jenis_pmks,
                    'Isi Aduan' => $pengaduan->isi_aduan,
                    'Jenis Bantuan' => $pengaduan->jenis_bantuan,
                    'Kondisi Ekonomi PMKS' => $pengaduan->kondisi_ekonomi_pmks,
                    'Kondisi Sosial PMKS' => $pengaduan->kondisi_sosial_pmks,
                ];
              @endphp

            {{-- DATA PMKS --}}
            <div class="flex items-center mb-3 mt-8">
                <div class="w-2 h-6 bg-blue-900 mr-2 rounded"></div>
                <h2 class="text-lg font-bold text-blue-900">DATA PMKS</h2>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                @if(isset($dataPmks) && is_iterable($dataPmks))
                    @foreach($dataPmks as $label => $value)
                        <div class="grid grid-cols-12 mb-1">
                            <span class="font-medium col-span-3">{{ $label }}</span>
                            <span class="col-span-1 text-center">:</span>
                            <span class="col-span-8 break-words">{{ $value ?? '-' }}</span>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- DATA PELAPOR --}}
            <div class="flex items-center mb-3 mt-8">
                <div class="w-2 h-6 bg-blue-900 mr-2 rounded"></div>
                <h2 class="text-lg font-bold text-blue-900">DATA PELAPOR</h2>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                @if(isset($dataPelapor) && is_iterable($dataPelapor))
                    @foreach($dataPelapor as $label => $value)
                        <div class="grid grid-cols-12 mb-1">
                            <span class="font-medium col-span-3">{{ $label }}</span>
                            <span class="col-span-1 text-center">:</span>
                            <span class="col-span-8 break-words">{{ $value ?? '-' }}</span>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- DETAIL ADUAN --}}
            <div class="flex items-center mb-3 mt-8">
                <div class="w-2 h-6 bg-blue-900 mr-2 rounded"></div>
                <h2 class="text-lg font-bold text-blue-900">DETAIL ADUAN</h2>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                @if(isset($dataAduan) && is_iterable($dataAduan))
                    @foreach($dataAduan as $label => $value)
                        <div class="grid grid-cols-12 mb-1">
                            <span class="font-medium col-span-3">{{ $label }}</span>
                            <span class="col-span-1 text-center">:</span>
                            <span class="col-span-8 break-words">{{ $value ?? '-' }}</span>
                        </div>
                    @endforeach
                @endif
            </div>

            {{-- FOTO PMKS --}}
            <div class="flex items-center mb-3 mt-8">
                <div class="w-2 h-6 bg-blue-900 mr-2 rounded"></div>
                <h2 class="text-lg font-bold text-blue-900">FOTO PMKS</h2>
            </div>

            <div class="bg-white p-4 rounded-lg shadow text-center">
                <img src="{{ Storage::url($pengaduan->foto_pmks_path) }}" alt="Foto PMKS"
                    class="rounded-md shadow-md mx-auto max-w-xs cursor-pointer transition-transform hover:scale-105"
                    onclick="openModal('{{ asset('storage/' . $pengaduan->foto_pmks) }}')">
                <a href="javascript:void(0)" class="text-blue-900 hover:underline text-sm mt-2 block font-medium"
                    onclick="openModal('{{ Storage::url($pengaduan->foto_pmks_path) }}')">
                    Lihat Lebih Besar
                </a>
            </div>

            <!-- Modal Popup -->
            <div id="imageModal"
                class="hidden fixed inset-0 bg-black bg-opacity-70 flex justify-center items-center z-50">
                <div class="relative">
                    <button onclick="closeModal()"
                        class="absolute top-2 right-2 text-white text-2xl font-bold hover:text-gray-300">
                        &times;
                    </button>
                    <img id="modalImage" src="" alt="Foto PMKS Besar"
                        class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-2xl">
                </div>
            </div>


            {{-- Tombol Kembali --}}
            <div class="mt-8 pt-4 border-t text-center">
                <a href="{{ route('pengaduan.tracking', ['kode_pengaduan' => $pengaduan->kode_pengaduan]) }}"
                    class="inline-block px-6 py-2 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-800 transition">
                    Kembali ke Status Tracking
                </a>
            </div>

        </div>
</body>
<script>
    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }
    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>

</html>
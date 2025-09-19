<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Laporan Pengaduan - {{ $pengaduan->kode_pengaduan }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* Optional: Custom scrollbar for detail content */
    .custom-scroll::-webkit-scrollbar {
      width: 8px;
    }

    .custom-scroll::-webkit-scrollbar-track {
      background: #f1f1f1;
      border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 10px;
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
      background: #555;
    }
  </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

  <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-auto my-8">
    <div class="py-6 px-8 text-center bg-blue-800 rounded-t-lg">
      <h2 class="text-2xl font-bold text-white">Detail Laporan</h2>
    </div>

    <div class="p-8 custom-scroll max-h-[80vh] overflow-y-auto">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
        {{-- Data Diri Terlapor --}}
        <div class="col-span-full pb-4 mb-4 border-b border-gray-200">
          <h3 class="text-lg font-bold text-gray-800">Informasi Terlapor</h3>
        </div>
        <div>
          <p class="text-sm text-gray-500">Nama</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->nama }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Jenis Kelamin</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->jenis_kelamin }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">NIK</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->nik }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Nomor KK</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->nomor_kk ?? '-' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Desil DTSEN</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->desil_dtsen ?? '-' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">No KIS/BPJS</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->no_kis_bpjs ?? '-' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tempat Lahir</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->tempat_lahir ?? '-' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Tanggal Lahir</p>
          <p class="font-semibold text-gray-800">
            {{ $pengaduan->tanggal_lahir ? Carbon\Carbon::parse($pengaduan->tanggal_lahir)->format('d F Y') : '-' }}
          </p>
        </div>
        <div class="col-span-full">
          <p class="text-sm text-gray-500">Alamat Lengkap Sesuai KTP</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->alamat_ktp }}</p>
        </div>
        <div class="col-span-full">
          <p class="text-sm text-gray-500">Alamat Domisili</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->alamat_domisili ?? '-' }}</p>
        </div>

        {{-- Data Pelapor & Detail Pengaduan --}}
        <div class="col-span-full pt-6 pb-4 mb-4 border-b border-gray-200">
          <h3 class="text-lg font-bold text-gray-800">Informasi Pelapor & Pengaduan</h3>
        </div>
        <div>
          <p class="text-sm text-gray-500">Nama Pelapor</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->nama_pelapor }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Nomor HP Pelapor</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->nomor_hp_pelapor }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Email Pelapor</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->email_pelapor ?? '-' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Pekerjaan Pelapor</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->pekerjaan_pelapor ?? '-' }}</p>
        </div>
        <div class="col-span-full">
          <p class="text-sm text-gray-500">Jenis PMKS yang Dilaporkan</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->jenis_pmks }}</p>
        </div>
        <div class="col-span-full">
          <p class="text-sm text-gray-500">Isi Aduan</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->isi_aduan }}</p>
        </div>
        <div class="col-span-full">
          <p class="text-sm text-gray-500">Jenis Bantuan Yang Dibutuhkan</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->jenis_bantuan }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Kondisi Ekonomi PMKS</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->kondisi_ekonomi_pmks ?? '-' }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-500">Kondisi Sosial PMKS</p>
          <p class="font-semibold text-gray-800">{{ $pengaduan->kondisi_sosial_pmks ?? '-' }}</p>
        </div>
        @if ($pengaduan->foto_pmks_path)
          <div class="col-span-full">
            <p class="text-sm text-gray-500 mb-2">Foto PMKS</p>
            <img src="{{ asset('storage/' . $pengaduan->foto_pmks_path) }}" alt="Foto PMKS"
              class="max-w-xs h-auto rounded-md shadow-md">
          </div>
        @endif
      </div>

      <div class="mt-8 pt-4 border-t border-gray-200 text-center">
        <a href="{{ route('pengaduan.tracking', ['kode_pengaduan' => $pengaduan->kode_pengaduan]) }}"
          class="inline-block px-6 py-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 transition-colors duration-300">
          Kembali ke Status Tracking
        </a>
      </div>
    </div>
  </div>

</body>

</html>
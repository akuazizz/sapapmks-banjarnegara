<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4"
  onclick="if(event.target.id === 'detailModal') toggleDetailModal()">
  <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-3xl mx-auto relative max-h-[90vh] overflow-y-auto">

    <h3 class="text-2xl font-extrabold mb-6 text-center text-blue-900 border-b pb-2">DETAIL LAPORAN</h3>
    <button type="button" onclick="toggleDetailModal()"
      class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>

    <div class="space-y-2 text-sm">
      @php
        // Data Pengaduan (PMKS)
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

      <p class="font-bold mt-4 mb-2 text-gray-800">DATA PMKS</p>
      @foreach($dataPmks as $label => $value)
        <div class="grid grid-cols-12">
          <span class="font-medium col-span-3">{{ $label }}</span>
          <span class="col-span-1 text-center">:</span>
          <span class="col-span-8 break-words">{{ $value ?? '-' }}</span>
        </div>
      @endforeach

      <p class="font-bold mt-6 mb-2 text-gray-800">DATA PELAPOR</p>
      @foreach($dataPelapor as $label => $value)
        <div class="grid grid-cols-12">
          <span class="font-medium col-span-3">{{ $label }}</span>
          <span class="col-span-1 text-center">:</span>
          <span class="col-span-8 break-words">{{ $value ?? '-' }}</span>
        </div>
      @endforeach

      <p class="font-bold mt-6 mb-2 text-gray-800">DETAIL ADUAN</p>
      @foreach($dataAduan as $label => $value)
        <div class="grid grid-cols-12">
          <span class="font-medium col-span-3">{{ $label }}</span>
          <span class="col-span-1 text-center">:</span>
          <span class="col-span-8 break-words">{{ $value ?? '-' }}</span>
        </div>
      @endforeach

      @if($pengaduan->foto_pmks_path)
        <div class="grid grid-cols-12 pt-4">
          <span class="font-medium col-span-3">Foto PMKS</span>
          <span class="col-span-1 text-center">:</span>
          <span class="col-span-8">
            <img src="{{ Storage::url($pengaduan->foto_pmks_path) }}" alt="Foto PMKS"
              class="max-w-xs max-h-40 rounded-lg shadow-md mt-2">
            <a href="{{ Storage::url($pengaduan->foto_pmks_path) }}" target="_blank"
              class="text-blue-600 hover:underline text-xs mt-1 block">Lihat Gambar Penuh</a>
          </span>
        </div>
      @else
        <div class="grid grid-cols-12 pt-4">
          <span class="font-medium col-span-3">Foto PMKS</span>
          <span class="col-span-1 text-center">:</span>
          <span class="col-span-8 text-gray-500 italic">Tidak ada foto terlampir.</span>
        </div>
      @endif

    </div>
  </div>
</div>
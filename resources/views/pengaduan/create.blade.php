<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Pengaduan - SAPA PMKS</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      background: url("{{ asset('images/Background.png') }}") no-repeat center center fixed;
      background-size: cover;
    }
  </style>
</head>

<body class="bg-gray-100">

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

  <main class="container mx-auto pt-32 pb-12 px-4">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-3xl mx-auto">
      <div class="py-6 px-8 text-center bg-gray-50 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-800">Pusat Layanan Pengaduan Sosial Masyarakat</h2>
        <p class="text-gray-600">Wujudkan kesejahteraan bersama melalui laporan Anda</p>
      </div>

      <div class="bg-blue-800 text-white text-lg font-semibold py-4 px-8">
        Sampaikan Laporan Anda di Sini
      </div>

      {{-- Menampilkan pesan sukses dari session --}}
      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mx-8 mt-4"
          role="alert">
          <strong class="font-bold">Sukses!</strong>
          <span class="block sm:inline">{{ session('success') }}</span>
        </div>
      @endif

      {{-- Menampilkan pesan error validasi --}}
      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mx-8 mt-4" role="alert">
          <strong class="font-bold">Ada Kesalahan!</strong>
          <ul class="mt-3 list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form id="pengaduanForm" action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data"
        class="p-8">
        @csrf

        <div id="step1" class="form-step">
          <h3 class="text-lg font-bold text-gray-800 mb-4">1. Data Diri Terlapor</h3>
          <div class="mb-4">
            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama <span
                class="text-red-500">*</span></label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama') border-red-500 @enderror"
              required>
            @error('nama')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="jenis_kelamin" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin <span
                class="text-red-500">*</span></label>
            <select id="jenis_kelamin" name="jenis_kelamin"
              class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jenis_kelamin') border-red-500 @enderror"
              required>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="nik" class="block text-gray-700 text-sm font-bold mb-2">NIK <span
                class="text-red-500">*</span></label>
            <input type="text" id="nik" name="nik" value="{{ old('nik') }}" maxlength="16"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nik') border-red-500 @enderror"
              required>
            @error('nik')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="nomor_kk" class="block text-gray-700 text-sm font-bold mb-2">Nomor KK</label>
            <input type="text" id="nomor_kk" name="nomor_kk" value="{{ old('nomor_kk') }}" maxlength="16"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_kk') border-red-500 @enderror">
            @error('nomor_kk')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="desil_dtsen" class="block text-gray-700 text-sm font-bold mb-2">Desil DTSEN</label>
            <input type="text" id="desil_dtsen" name="desil_dtsen" value="{{ old('desil_dtsen') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('desil_dtsen') border-red-500 @enderror">
            @error('desil_dtsen')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="no_kis_bpjs" class="block text-gray-700 text-sm font-bold mb-2">No KIS/BPJS</label>
            <input type="text" id="no_kis_bpjs" name="no_kis_bpjs" value="{{ old('no_kis_bpjs') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('no_kis_bpjs') border-red-500 @enderror">
            @error('no_kis_bpjs')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="tempat_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tempat_lahir') border-red-500 @enderror">
            @error('tempat_lahir')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="tanggal_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tanggal_lahir') border-red-500 @enderror">
            @error('tanggal_lahir')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="alamat_ktp" class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap Sesuai
              KTP <span class="text-red-500">*</span></label>
            <textarea id="alamat_ktp" name="alamat_ktp" rows="3"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat_ktp') border-red-500 @enderror"
              required>{{ old('alamat_ktp') }}</textarea>
            @error('alamat_ktp')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="alamat_domisili" class="block text-gray-700 text-sm font-bold mb-2">Alamat Domisili</label>
            <textarea id="alamat_domisili" name="alamat_domisili" rows="3"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('alamat_domisili') border-red-500 @enderror">{{ old('alamat_domisili') }}</textarea>
            @error('alamat_domisili')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>

          <div class="flex justify-end mt-6">
            <button type="button" id="nextStep1"
              class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">Next</button>
          </div>
        </div>

        <div id="step2" class="form-step hidden">
          <h3 class="text-lg font-bold text-gray-800 mb-4">2. Data Pelapor & Detail Pengaduan</h3>
          <div class="mb-4">
            <label for="nama_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Nama Pelapor <span
                class="text-red-500">*</span></label>
            <input type="text" id="nama_pelapor" name="nama_pelapor" value="{{ old('nama_pelapor') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nama_pelapor') border-red-500 @enderror"
              required>
            @error('nama_pelapor')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="nomor_hp_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP Pelapor <span
                class="text-red-500">*</span></label>
            <input type="text" id="nomor_hp_pelapor" name="nomor_hp_pelapor" value="{{ old('nomor_hp_pelapor') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nomor_hp_pelapor') border-red-500 @enderror"
              required>
            @error('nomor_hp_pelapor')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="email_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Email Pelapor</label>
            <input type="email" id="email_pelapor" name="email_pelapor" value="{{ old('email_pelapor') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email_pelapor') border-red-500 @enderror">
            @error('email_pelapor')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>
          <div class="mb-4">
            <label for="pekerjaan_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan
              Pelapor</label>
            <input type="text" id="pekerjaan_pelapor" name="pekerjaan_pelapor" value="{{ old('pekerjaan_pelapor') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pekerjaan_pelapor') border-red-500 @enderror">
            @error('pekerjaan_pelapor')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>

          <div class="mb-4">
            <label for="jenis_pmks" class="block text-gray-700 text-sm font-bold mb-2">Jenis PMKS yang di
              Laporkan <span class="text-red-500">*</span></label>
            <div class="relative">
              <select id="jenis_pmks" name="jenis_pmks"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline appearance-none pr-8 @error('jenis_pmks') border-red-500 @enderror"
                required>
                <option value="">Pilih Jenis PMKS</option>
                <option value="Anak Terlantar" {{ old('jenis_pmks') == 'Anak Terlantar' ? 'selected' : '' }}>Anak
                  Terlantar</option>
                <option value="Lansia Terlantar" {{ old('jenis_pmks') == 'Lansia Terlantar' ? 'selected' : '' }}>
                  Lansia
                  Terlantar</option>
                <option value="Difabel" {{ old('jenis_pmks') == 'Difabel' ? 'selected' : '' }}>Difabel</option>
                <option value="Lainnya" {{ old('jenis_pmks') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
              </div>
            </div>
            @error('jenis_pmks')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>

          <div class="mb-4">
            <label for="isi_aduan" class="block text-gray-700 text-sm font-bold mb-2">Isi Aduan <span
                class="text-red-500">*</span></label>
            <textarea id="isi_aduan" name="isi_aduan" rows="5"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('isi_aduan') border-red-500 @enderror"
              required>{{ old('isi_aduan') }}</textarea>
            @error('isi_aduan')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>

          <div class="mb-4">
            <label for="jenis_bantuan" class="block text-gray-700 text-sm font-bold mb-2">Jenis Bantuan Yang di
              Butuhkan <span class="text-red-500">*</span></label>
            <div class="relative">
              <select id="jenis_bantuan" name="jenis_bantuan"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline appearance-none pr-8 @error('jenis_bantuan') border-red-500 @enderror"
                required>
                <option value="">Pilih Jenis Bantuan</option>
                <option value="Alat Bantu Gelandangan" {{ old('jenis_bantuan') == 'Alat Bantu Gelandangan' ? 'selected' : '' }}>Alat Bantu Gelandangan
                </option>
                <option value="Biaya Pengobatan Pengemis" {{ old('jenis_bantuan') == 'Biaya Pengobatan Pengemis' ? 'selected' : '' }}>Biaya Pengobatan
                  Pengemis</option>
                <option value="Rujukan Panti Disabilitas" {{ old('jenis_bantuan') == 'Rujukan Panti Disabilitas' ? 'selected' : '' }}>Rujukan Panti
                  Disabilitas</option>
                <option value="Permohonan Lainnya" {{ old('jenis_bantuan') == 'Permohonan Lainnya' ? 'selected' : '' }}>
                  Permohonan Lainnya</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
              </div>
            </div>
            @error('jenis_bantuan')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>

          <div class="mb-4">
            <label for="kondisi_ekonomi_pmks" class="block text-gray-700 text-sm font-bold mb-2">Kondisi Ekonomi
              PMKS</label>
            <input type="text" id="kondisi_ekonomi_pmks" name="kondisi_ekonomi_pmks"
              value="{{ old('kondisi_ekonomi_pmks') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kondisi_ekonomi_pmks') border-red-500 @enderror">
            @error('kondisi_ekonomi_pmks')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>

          <div class="mb-4">
            <label for="kondisi_sosial_pmks" class="block text-gray-700 text-sm font-bold mb-2">Kondisi Sosial
              PMKS</label>
            <input type="text" id="kondisi_sosial_pmks" name="kondisi_sosial_pmks"
              value="{{ old('kondisi_sosial_pmks') }}"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kondisi_sosial_pmks') border-red-500 @enderror">
            @error('kondisi_sosial_pmks')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
          </div>

          <div class="mb-6">
            <label for="foto_pmks" class="block text-gray-700 text-sm font-bold mb-2">Foto PMKS (Opsional)</label>
            <input type="file" id="foto_pmks" name="foto_pmks"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('foto_pmks') border-red-500 @enderror">
            @error('foto_pmks')<p class="text-red-500 text-xs italic">{{ $message }}</p>@enderror
            <p class="text-gray-500 text-xs mt-1">Ukuran maksimal: 2MB, Format: JPG, PNG, GIF</p>
          </div>

          <div class="flex justify-between mt-6">
            <button type="button" id="prevStep2"
              class="bg-gray-600 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">Back</button>
            <button type="submit"
              class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition duration-300 ease-in-out">Kirim</button>
          </div>
        </div>
      </form>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const step1 = document.getElementById('step1');
      const step2 = document.getElementById('step2');
      const nextStep1Button = document.getElementById('nextStep1');
      const prevStep2Button = document.getElementById('prevStep2');

      @php
        $step2ErrorFields = [
          'nama_pelapor',
          'nomor_hp_pelapor',
          'email_pelapor',
          'pekerjaan_pelapor',
          'jenis_pmks',
          'isi_aduan',
          'jenis_bantuan',
          'kondisi_ekonomi_pmks',
          'kondisi_sosial_pmks',
          'foto_pmks'
        ];
      @endphp
      const hasErrorInStep2 = @json($errors->hasAny($step2ErrorFields));

      if (hasErrorInStep2) {
        step1.classList.add('hidden');
        step2.classList.remove('hidden');
      }

      nextStep1Button.addEventListener('click', function () {
        // Basic validation for Step 1 fields
        const nama = document.getElementById('nama');
        const jenisKelamin = document.getElementById('jenis_kelamin');
        const nik = document.getElementById('nik');
        const alamatKtp = document.getElementById('alamat_ktp');

        let isValidStep1 = true;
        const fields = [nama, jenisKelamin, nik, alamatKtp];

        fields.forEach(field => {
          if (field.hasAttribute('required') && !field.value.trim()) {
            field.classList.add('border-red-500');
            isValidStep1 = false;
          } else {
            field.classList.remove('border-red-500');
          }
        });

        // Validasi NIK 16 digit
        if (nik.value.length !== 16 && nik.hasAttribute('required')) {
          nik.classList.add('border-red-500');
          isValidStep1 = false;
          alert('NIK harus 16 digit.');
        }

        if (isValidStep1) {
          step1.classList.add('hidden');
          step2.classList.remove('hidden');
        } else {
          alert('Harap lengkapi semua bidang yang wajib diisi pada Tahap 1.');
        }
      });

      prevStep2Button.addEventListener('click', function () {
        step2.classList.add('hidden');
        step1.classList.remove('hidden');
      });
    });
  </script>
</body>

</html>
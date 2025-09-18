<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Pengaduan - SAPA PMKS</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 min-h-screen">
  <header class="bg-white shadow-sm py-4 px-6 flex justify-between items-center">
    <div class="flex items-center">
      <img src="{{ asset('images/logo-dinsos.png') }}" alt="DINSOS PPPA" class="h-10 mr-3">
      <span class="text-sm font-semibold text-gray-700">DINSOS PPPA<br>Kabupaten Banjarnegara</span>
    </div>
    <img src="{{ asset('images/logo-sapa.png') }}" alt="SAPA PMKS" class="h-10">
  </header>

  <main class="container mx-auto mt-8 p-4">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-3xl mx-auto">
      <div class="py-6 px-8 text-center bg-gray-50 border-b border-gray-200">
        <h2 class="text-xl font-bold text-gray-800">Pusat Layanan Pengaduan Sosial Masyarakat</h2>
        <p class="text-gray-600">Wujudkan kesejahteraan bersama melalui laporan Anda</p>
      </div>

      <div class="bg-blue-800 text-white text-lg font-semibold py-4 px-8">
        Sampaikan Laporan Anda di Sini
      </div>

      <form id="pengaduanForm" action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data"
        class="p-8">
        @csrf

        <!-- Tahap 1: Data Diri Pelapor -->
        <div id="step1" class="form-step">
          <div class="mb-4">
            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
            <input type="text" id="nama" name="nama"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required>
          </div>
          <div class="mb-4">
            <label for="jenis_kelamin" class="block text-gray-700 text-sm font-bold mb-2">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin"
              class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="mb-4">
            <label for="nik" class="block text-gray-700 text-sm font-bold mb-2">NIK</label>
            <input type="text" id="nik" name="nik"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required>
          </div>
          <div class="mb-4">
            <label for="nomor_kk" class="block text-gray-700 text-sm font-bold mb-2">Nomor KK</label>
            <input type="text" id="nomor_kk" name="nomor_kk"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>
          <div class="mb-4">
            <label for="desil_dtsen" class="block text-gray-700 text-sm font-bold mb-2">desil DTSEN</label>
            <input type="text" id="desil_dtsen" name="desil_dtsen"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>
          <div class="mb-4">
            <label for="no_kis_bpjs" class="block text-gray-700 text-sm font-bold mb-2">No KIS/BPJS</label>
            <input type="text" id="no_kis_bpjs" name="no_kis_bpjs"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>
          <div class="mb-4">
            <label for="tempat_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>
          <div class="mb-4">
            <label for="tanggal_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>
          <div class="mb-4">
            <label for="alamat_ktp" class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap Sesuai KTP</label>
            <textarea id="alamat_ktp" name="alamat_ktp" rows="3"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required></textarea>
          </div>
          <div class="mb-4">
            <label for="alamat_domisili" class="block text-gray-700 text-sm font-bold mb-2">Alamat Domisili</label>
            <textarea id="alamat_domisili" name="alamat_domisili" rows="3"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
          </div>

          <div class="flex justify-end mt-6">
            <button type="button" id="nextStep1"
              class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">Next</button>
          </div>
        </div>

        <!-- Tahap 2: Data Pelapor & Pengaduan -->
        <div id="step2" class="form-step hidden">
          <div class="mb-4">
            <label for="nama_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Nama Pelapor</label>
            <input type="text" id="nama_pelapor" name="nama_pelapor"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required>
          </div>
          <div class="mb-4">
            <label for="nomor_hp_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Nomor HP Pelapor</label>
            <input type="text" id="nomor_hp_pelapor" name="nomor_hp_pelapor"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required>
          </div>
          <div class="mb-4">
            <label for="email_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Email Pelapor</label>
            <input type="email" id="email_pelapor" name="email_pelapor"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>
          <div class="mb-4">
            <label for="pekerjaan_pelapor" class="block text-gray-700 text-sm font-bold mb-2">Pekerjaan Pelapor</label>
            <input type="text" id="pekerjaan_pelapor" name="pekerjaan_pelapor"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>

          <div class="mb-4">
            <label for="jenis_pmks" class="block text-gray-700 text-sm font-bold mb-2">Jenis PMKS yang di
              Laporkan</label>
            <div class="relative">
              <select id="jenis_pmks" name="jenis_pmks"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline appearance-none pr-8"
                required>
                <option value="">Pilih Jenis PMKS</option>
                <option value="Anak Terlantar">Anak Terlantar</option>
                <option value="Lansia Terlantar">Lansia Terlantar</option>
                <option value="Difabel">Difabel</option>
                <option value="Lainnya">Lainnya</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label for="isi_aduan" class="block text-gray-700 text-sm font-bold mb-2">Isi Aduan</label>
            <textarea id="isi_aduan" name="isi_aduan" rows="5"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required></textarea>
          </div>

          <div class="mb-4">
            <label for="jenis_bantuan" class="block text-gray-700 text-sm font-bold mb-2">Jenis Bantuan Yang di
              Butuhkan</label>
            <div class="relative">
              <select id="jenis_bantuan" name="jenis_bantuan"
                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline appearance-none pr-8"
                required>
                <option value="">Pilih Jenis Bantuan</option>
                <option value="Alat Bantu Gelandangan">Alat Bantu Gelandangan</option>
                <option value="Biaya Pengobatan Pengemis">Biaya Pengobatan Pengemis</option>
                <option value="Rujukan Panti Disabilitas">Rujukan Panti Disabilitas</option>
                <option value="Permohonan Lainnya">Permohonan Lainnya</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                  <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
              </div>
            </div>
          </div>

          <div class="mb-4">
            <label for="kondisi_ekonomi_pmks" class="block text-gray-700 text-sm font-bold mb-2">Kondisi Ekonomi
              PMKS</label>
            <input type="text" id="kondisi_ekonomi_pmks" name="kondisi_ekonomi_pmks"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>

          <div class="mb-4">
            <label for="kondisi_sosial_pmks" class="block text-gray-700 text-sm font-bold mb-2">Kondisi Sosial
              PMKS</label>
            <input type="text" id="kondisi_sosial_pmks" name="kondisi_sosial_pmks"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>

          <div class="mb-6">
            <label for="foto_pmks" class="block text-gray-700 text-sm font-bold mb-2">Foto PMKS</label>
            <input type="file" id="foto_pmks" name="foto_pmks"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
          </div>

          <div class="flex justify-between mt-6">
            <button type="button" id="prevStep2"
              class="bg-gray-600 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">Back</button>
            <button type="submit"
              class="bg-blue-800 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline">Kirim</button>
          </div>
        </div>
      </form>
    </div>
  </main>

  <script>
    // JavaScript untuk navigasi multi-step form
    document.addEventListener('DOMContentLoaded', function () {
      const step1 = document.getElementById('step1');
      const step2 = document.getElementById('step2');
      const nextStep1Button = document.getElementById('nextStep1');
      const prevStep2Button = document.getElementById('prevStep2');

      nextStep1Button.addEventListener('click', function () {
        // Anda bisa menambahkan validasi di sini sebelum pindah ke langkah berikutnya
        step1.classList.add('hidden');
        step2.classList.remove('hidden');
      });

      prevStep2Button.addEventListener('click', function () {
        step2.classList.add('hidden');
        step1.classList.remove('hidden');
      });
    });
  </script>
</body>

</html>
@extends('layouts.admin')

@section('title', 'Daftar Pengaduan')

@section('content')

  <div class="p-4">

    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800 mr-4">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
          </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Pengaduan</h1>
      </div>

      <a href="{{ route('admin.pengaduan.export.excel') }}"
        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-150 shadow-md flex items-center space-x-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
        <span>Export Excel</span>
      </a>

    </div>

    {{-- TAMBAHKAN ID FILTER FORM UNTUK JS --}}
    <form method="GET" action="{{ route('admin.pengaduan.index') }}" id="filterForm"
      class="bg-white p-6 rounded-xl shadow-lg mb-6 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4 items-center">

      <div class="relative w-full md:w-2/5">
        <input type="text" name="search" placeholder="Cari Kode, Pelapor, atau Jenis PMKS..."
          class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
          value="{{ request('search') }}">
        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none"
          stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </div>

      <div class="w-full md:w-1/4">
        <select name="status"
          class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
          @foreach ($statuses as $status)
            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
              {{ $status }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="relative w-full md:w-1/4">
        <input type="date" name="tanggal"
          class="w-full py-2 px-4 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
          value="{{ request('tanggal') }}">
      </div>

      {{-- HAPUS TOMBOL HIDDEN: submitForm() akan dihandle oleh JS --}}
      {{-- <button type="submit" class="hidden"></button> --}}
    </form>

    <div class="bg-white rounded-xl shadow-lg overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kode Pengaduan</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Pelapor</th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal</th>
            <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($pengaduans as $pengaduan)
            {{-- LOGIKA PENANDA BARU PADA TR DAN TD --}}
            @php
              // Asumsi "BARU" adalah status 'Diterima' (sesuai DashboardController)
              $isNew = $pengaduan->status === 'Diterima' || $pengaduan->status === 'Menunggu Diproses';
              $rowClass = $isNew ? 'bg-blue-50 hover:bg-blue-100 transition duration-150' : 'hover:bg-gray-50';
            @endphp
            <tr class="{{ $rowClass }}">
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                {{ $pengaduan->kode_pengaduan }}
                @if ($isNew)
                  <span class="ml-2 px-2 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full">BARU</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $pengaduan->nama_pelapor }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                {{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d/m/Y') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                {!! generateStatusBadge($pengaduan->status) !!}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                <a href="{{ route('admin.pengaduan.edit', $pengaduan) }}"
                  class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 transition duration-150 shadow-md">
                  Ubah Status
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">
                Tidak ada data pengaduan yang ditemukan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection

{{-- BAGIAN JS BARU UNTUK INSTANT FILTER --}}
@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const filterForm = document.getElementById('filterForm');
      const searchInput = filterForm.querySelector('input[name="search"]');
      const statusSelect = filterForm.querySelector('select[name="status"]');
      const tanggalInput = filterForm.querySelector('input[name="tanggal"]');
      let searchTimeout;

      // Fungsi untuk mengajukan form
      const submitForm = () => {
        filterForm.submit();
      };

      // 1. Listener untuk Status dan Tanggal (langsung submit saat berubah)
      statusSelect.addEventListener('change', submitForm);
      tanggalInput.addEventListener('change', submitForm);

      // 2. Listener untuk Pencarian (menggunakan debounce untuk menghindari terlalu banyak request)
      searchInput.addEventListener('input', function () {
        // Hapus timeout sebelumnya
        clearTimeout(searchTimeout);

        // Set timeout baru
        searchTimeout = setTimeout(() => {
          submitForm();
        }, 500); // Tunggu 500ms (0.5 detik) setelah user berhenti mengetik
      });
    });
  </script>
@endsection

@php
  // Helper function untuk generate badge status dengan warna yang berbeda
  function generateStatusBadge($status)
  {
    switch ($status) {
      case 'Diterima':
      case 'Laporan Baru': // Menggunakan Laporan Baru untuk status awal
        $color = 'bg-green-500';
        break;
      case 'Diversifikasi':
        $color = 'bg-gray-500';
        break;
      case 'Diproses':
        $color = 'bg-yellow-500';
        break;
      case 'Selesai':
        $color = 'bg-blue-600';
        break;
      case 'Ditolak':
        $color = 'bg-red-600';
        break;
      default:
        $color = 'bg-purple-500';
        break;
    }
    return '<span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full text-white ' . $color . '">' . strtoupper($status) . '</span>';
  }
@endphp
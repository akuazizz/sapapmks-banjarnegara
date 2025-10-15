@extends('layouts.admin')

@section('title', 'Ubah Status')

@section('content')
<script>
    // Fungsi untuk menampilkan/menyembunyikan field Alasan Ditolak
    function toggleAlasanPenolakan() {
        const statusSelect = document.getElementById('status');
        const alasanField = document.getElementById('alasan_penolakan_group');

        if (statusSelect.value === 'Ditolak') {
            alasanField.classList.remove('hidden');
        } else {
            alasanField.classList.add('hidden');
        }
    }

    // Fungsi untuk menampilkan/menyembunyikan Modal Detail Laporan
    function toggleDetailModal() {
        document.getElementById('detailModal').classList.toggle('hidden');
    }
</script>


<div class="bg-white p-8 rounded-xl w-full max-w-lg mx-auto border-4 border-gray-100 relative">

    <a href="{{ route('admin.pengaduan.index') }}" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </a>

    <h2 class="text-xl font-extrabold mb-6 text-gray-900 text-center">Informasi Dasar Pengaduan</h2>

    <div class="space-y-4 mb-8 text-gray-700">
        <div class="grid grid-cols-3">
            <span class="font-semibold col-span-1">Kode Pengaduan</span>
            <span class="col-span-2">: {{ $pengaduan->kode_pengaduan }}</span>
        </div>
        <div class="grid grid-cols-3">
            <span class="font-semibold col-span-1">Nama Pelapor</span>
            <span class="col-span-2">: {{ $pengaduan->nama_pelapor }}</span>
        </div>
        <div class="grid grid-cols-3">
            <span class="font-semibold col-span-1">Tanggal</span>
            <span class="col-span-2">:
                {{ \Carbon\Carbon::parse($pengaduan->tanggal_laporan)->translatedFormat('d/m/Y') }}</span>
        </div>
        <div class="grid grid-cols-3 items-center">
            <span class="font-semibold col-span-1">Detail Laporan</span>
            <span class="col-span-2">
                <button type="button" onclick="toggleDetailModal()"
                    class="bg-blue-900 text-white px-4 py-2 text-sm rounded-lg hover:bg-blue-800 shadow-md transition">
                    Klik untuk melihat detail laporan
                </button>
            </span>
        </div>
    </div>

    <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-3 items-center mb-4">
            <label for="status" class="font-semibold text-gray-700">Status</label>
            <div class="col-span-2 flex items-center">
                <span class="mr-2">:</span>
                <select id="status" name="status" onchange="toggleAlasanPenolakan()"
                    class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                    @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ old('status', $pengaduan->status) == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="alasan_penolakan_group"
            class="grid grid-cols-3 items-start mb-6 {{ old('status', $pengaduan->status) == 'Ditolak' ? '' : 'hidden' }}">
            <label for="alasan_penolakan" class="font-semibold text-gray-700 mt-2">Alasan Ditolak</label>
            <div class="col-span-2 flex items-start">
                <span class="mr-2 mt-2">:</span>
                <textarea id="alasan_penolakan" name="alasan_penolakan" rows="3" placeholder="Wajib diisi"
                    class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('alasan_penolakan') border-red-500 @enderror">{{ old('alasan_penolakan', $pengaduan->alasan_penolakan) }}</textarea>
            </div>
            @error('alasan_penolakan')
            <p class="col-start-2 col-span-2 text-red-500 text-xs italic mt-1 ml-4">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit"
                class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition duration-150 font-bold shadow-md">
                Simpan
            </button>
        </div>
    </form>
</div>

@include('admin.pengaduan.detail_modal', ['pengaduan' => $pengaduan])

<script>
    // Pastikan status field diperiksa saat halaman dimuat (untuk kasus validasi gagal)
    document.addEventListener('DOMContentLoaded', toggleAlasanPenolakan);
</script>

@endsection
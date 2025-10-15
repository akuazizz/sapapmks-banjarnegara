@extends('layouts.admin')

@section('title', 'Daftar Pelapor')

@section('content')

  <div class="p-4">
    <!-- Header -->
    <div class="flex items-center mb-6">
      <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-800 mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
      </a>
      <h1 class="text-2xl font-bold text-gray-800">Daftar Pelapor</h1>
    </div>

    <!-- Search -->
    <form method="GET" action="{{ route('admin.pengguna.index') }}"
      class="bg-white p-6 rounded-xl shadow-lg mb-6 flex space-x-4 items-center">
      <div class="relative w-full">
        <input type="text" name="search" placeholder="Cari nama, email, atau no. HP..."
          class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
          value="{{ request('search') }}">
        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" fill="none"
          stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </div>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
              Kode Pengaduan
            </th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
              Nama Pelapor
            </th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
              Email
            </th>
            <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
              No. Handphone
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($users as $item)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                {{ $item->kode_pengaduan }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                {{ $item->nama_pelapor }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                {{ $item->email_pelapor }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                {{ $item->nomor_hp_pelapor }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                Tidak ada data pelapor yang ditemukan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection
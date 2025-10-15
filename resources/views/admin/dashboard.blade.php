@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

  <h1 class="text-3xl font-bold mb-8 text-gray-800">Dashboard Admin</h1>

  <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-8">
    @php
      // Definisikan urutan dan warna kartu sesuai design Anda
      $card_order = [
        'Laporan Baru' => 'bg-blue-600',
        'Diversifikasi' => 'bg-gray-500',
        'Diproses' => 'bg-yellow-500',
        'Ditolak' => 'bg-red-600',
        'Diterima' => 'bg-green-500',
        'Selesai' => 'bg-indigo-600',
      ];
    @endphp

    @foreach ($card_order as $label => $color)
      @php
        // Ambil nilai dari array $stats, default ke 0
        $value = $stats[$label] ?? 0;
      @endphp
      <div
        class="bg-white p-4 rounded-xl shadow-lg border border-gray-100 text-center transition duration-300 hover:shadow-xl">
        <p class="text-4xl font-extrabold text-gray-800 mb-1">{{ $value }}</p>
        <p class="text-sm font-medium text-gray-500">{{ $label }}</p>
      </div>
    @endforeach
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Distribusi Status Pengaduan</h2>
      <div class="flex flex-col md:flex-row items-center justify-between">
        <div class="w-full md:w-1/2 h-64 flex justify-center items-center">
          <canvas id="statusChart"></canvas>
        </div>
        <div class="w-full md:w-1/2 p-4">
          @php
            $legendColors = [
              'Laporan Baru' => '#2563eb', // biru tua
              'Diversifikasi' => '#6b7280', // abu
              'Diproses' => '#facc15', // kuning
              'Ditolak' => '#dc2626', // merah
              'Diterima' => '#22c55e', // hijau
              'Selesai' => '#6366f1', // ungu
            ];
          @endphp
          @foreach($chartData as $status => $count)
            <div class="flex items-center mb-2">
              <span class="w-3 h-3 rounded-full mr-3"
                style="background-color: @php echo $legendColors[$status] ?? 'gray' @endphp;"></span>
              <span class="text-gray-700">{{ $status }} ({{ $count }})</span>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
      <h2 class="text-xl font-bold mb-4 text-gray-800">Notifikasi Terbaru</h2>
      <div class="space-y-3">
        @forelse ($notifikasi as $item)
          <div class="flex justify-between items-center border-b pb-2 last:border-b-0">
            <p class="text-gray-700 font-medium truncate">{{ $item->jenis_pmks }}</p>
            <span class="text-sm text-gray-500">{{ $item->created_at->format('H:i') }}</span>
          </div>
        @empty
          <p class="text-gray-500 italic">Belum ada laporan terbaru.</p>
        @endforelse
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    <a href="{{ route('admin.pengaduan.index') }}"
      class="bg-blue-900 text-white p-8 rounded-xl shadow-xl hover:bg-blue-800 transition duration-300 text-center">
      <svg class="w-10 h-10 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
        </path>
      </svg>
      <span class="text-2xl font-bold uppercase">Laporan</span>
    </a>

    <a href="{{ route('admin.pengguna.index') }}"
      class="bg-blue-900 text-white p-8 rounded-xl shadow-xl hover:bg-blue-800 transition duration-300 text-center">
      <svg class="w-10 h-10 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
      </svg>
      <span class="text-2xl font-bold uppercase">Pelapor</span>
    </a>

    <button type="button" onclick="toggleLogoutModal()"
      class="w-full bg-blue-900 text-white p-8 rounded-xl shadow-xl hover:bg-blue-800 transition duration-300 text-center">
      <svg class="w-10 h-10 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
      </svg>
      <span class="text-2xl font-bold uppercase">Keluar</span>
    </button>
  </div>

  <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white p-10 rounded-xl shadow-2xl w-full max-w-sm mx-auto text-center">
      <h3 class="text-xl font-bold mb-6 text-gray-800">Yakin ingin keluar?</h3>
      <div class="flex justify-center space-x-4">
        <button type="button" onclick="toggleLogoutModal()"
          class="bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg hover:bg-gray-400 transition duration-150">
          Batal
        </button>

        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit"
            class="bg-blue-900 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-800 transition duration-150">
            Keluar
          </button>
        </form>
      </div>
    </div>
  </div>

  <script>
    function toggleLogoutModal() {
      document.getElementById('logoutModal').classList.toggle('hidden');
    }
  </script>

  <script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusCounts = @json($chartData);

    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: Object.keys(statusCounts),
        datasets: [{
          data: Object.values(statusCounts),
          backgroundColor: [
            '#2563eb', // Laporan Baru
            '#6b7280', // Diversifikasi
            '#facc15', // Diproses
            '#dc2626', // Ditolak
            '#22c55e', // Diterima
            '#6366f1'  // Selesai
          ],
          hoverOffset: 4
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: function (context) {
                let label = context.label || '';
                if (label) label += ': ';
                if (context.parsed !== null) label += context.parsed;
                return label;
              }
            }
          }
        }
      }
    });
  </script>
@endsection
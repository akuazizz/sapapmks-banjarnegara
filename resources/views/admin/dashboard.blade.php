<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Admin Dashboard</h1>
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Logout</button>
    </form>
  </div>

  <div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold mb-4">Daftar Pengaduan</h2>
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelapor</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis PMKS</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach ($pengaduans as $pengaduan)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">{{ $pengaduan->kode_pengaduan }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $pengaduan->nama_pelapor }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $pengaduan->jenis_pmks }}</td>
              <td class="px-6 py-4 whitespace-nowrap">{{ $pengaduan->status }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <a href="{{ route('admin.pengaduan.edit', $pengaduan) }}" class="text-blue-600 hover:text-blue-900">Ubah
                  Status</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
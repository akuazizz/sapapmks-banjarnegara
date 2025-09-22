<!DOCTYPE html>
<html lang="en">

<head>
  <title>Edit Pengaduan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-8">
  <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg mx-auto">
    <h2 class="text-2xl font-bold mb-4">Ubah Status Pengaduan</h2>
    <form action="{{ route('admin.pengaduan.update', $pengaduan) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-4">
        <label for="status" class="block text-gray-700">Status</label>
        <select name="status" id="status" class="w-full mt-2 p-2 border rounded-md">
          <option value="Diterima" @if($pengaduan->status == 'Diterima') selected @endif>Diterima</option>
          <option value="Diversifikasi" @if($pengaduan->status == 'Diversifikasi') selected @endif>Diversifikasi</option>
          <option value="Diproses" @if($pengaduan->status == 'Diproses') selected @endif>Diproses</option>
          <option value="Selesai" @if($pengaduan->status == 'Selesai') selected @endif>Selesai</option>
        </select>
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
      <a href="{{ route('admin.pengaduan.index') }}" class="ml-4 text-gray-600 hover:text-gray-900">Batal</a>
    </form>
  </div>
</body>

</html>
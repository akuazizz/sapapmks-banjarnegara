<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Login</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 flex items-center justify-center min-h-screen">
  <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-sm">
    <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
    <form action="{{ route('login') }}" method="POST">
      @csrf
      <div class="mb-4">
        <label for="email" class="block text-gray-700">Email</label>
        <input type="email" id="email" name="email" class="w-full mt-2 p-2 border rounded-md" required>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700">Password</label>
        <input type="password" id="password" name="password" class="w-full mt-2 p-2 border rounded-md" required>
      </div>
      <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded-md hover:bg-blue-700">Login</button>
    </form>
  </div>
</body>

</html>
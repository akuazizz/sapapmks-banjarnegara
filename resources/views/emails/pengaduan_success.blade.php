<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Notifikasi Pengaduan</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      color: #333;
      line-height: 1.6;
    }

    .container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .header {
      text-align: center;
      border-bottom: 2px solid #002D74;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    .content {
      text-align: left;
    }

    .code-box {
      background-color: #e9ecef;
      padding: 15px;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      border-radius: 6px;
      margin: 20px 0;
    }

    .footer {
      text-align: center;
      margin-top: 20px;
      color: #888;
      font-size: 0.9em;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h2>Terima Kasih Telah Melakukan Pengaduan</h2>
    </div>
    <div class="content">
      <p>Pengaduan Anda telah kami terima dan akan segera kami proses. Kerahasiaan identitas Anda terjamin.</p>
      <p>Gunakan kode berikut untuk melacak status pengaduan Anda:</p>
      <div class="code-box">
        {{ $pengaduan->kode_pengaduan }}
      </div>
      <p>Anda bisa melakukan pengecekan melalui menu "Cek Tracking" di website kami.</p>
      <br>
      <p>Hormat kami,<br>Tim SAPA PMKS</p>
    </div>
  </div>
</body>

</html>
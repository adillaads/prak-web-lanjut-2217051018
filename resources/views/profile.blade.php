<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Profile</title>
</head>
<body>
    <img src="/assets/img/image.png" class="profile-img" width="200px" alt="Profile Image">
    <div class="profile-info">
        <h1>Profil User</h1>
        <p>Nama: {{ $nama }}</p>
        <p>NPM: {{ $npm }}</p>
        <p>Kelas: {{ $nama_kelas ?? 'Kelas tidak ditemukan' }}</p>
    </div>
</body>
</html>
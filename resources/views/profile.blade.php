<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- Link to Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif; /* Set font to Poppins */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #b71c1c;
        }
        .card {
            background-color: white;
            border-radius: 20px; /* Slightly more rounded */
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            padding: 40px; /* Increased padding for more space */
            text-align: center;
            width: 380px; /* Slightly wider */
            border: 2px solid #D91656; /* Updated border color */
        }
        .card img {
            width: 130px; /* Slightly larger image */
            height: 130px;
            margin-bottom: 20px;
            border: 4px solid #D91656; /* Updated border color */
            border-radius: 50%;
            object-fit: cover;
        }
        h1 {
            color: #D91656; /* Updated heading color */
            margin-bottom: 20px; /* Added margin for spacing */
        }
        .info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9; /* Slightly lighter background */
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px; /* Increased margin for spacing */
            color: black;
        }
        .info p {
            margin: 0;
            font-size: 18px;
        }
        .label {
            color: #D91656; /* Updated label color */
            font-weight: bold;
            text-align: left;
            width: 90px; /* Slightly wider label */
        }
        .value {
            flex: 1;
            text-align: left;
            padding-left: 10px;
        }
    </style>
</head>
<body>

    <div class="card">
        <!-- Display user photo or default avatar -->
        <img src="{{ $user->foto ? asset($user->foto) : 'assets/img/image.png' }}" 
             alt="Avatar">
        
        <h1>Profil User</h1>

        <div class="info">
            <p class="label">Nama :</p>
            <p class="value">{{ $user->nama }}</p>
        </div>
        <div class="info">
            <p class="label">NPM :</p>
            <p class="value">{{ $user->npm }}</p>
        </div>
        <div class="info">
            <p class="label">Kelas :</p>
            <p class="value">{{ $user->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</p>
        </div>
    </div>

</body>
</html>

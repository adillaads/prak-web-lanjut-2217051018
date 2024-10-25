@extends('layouts.app')
@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul 3</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #E75480; /* Warna Lotso */
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-radius: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            width: 500px;
            padding: 40px 25px;
            max-width: 90%;
        }

        .card h3 {
            color: #8B0000;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }

        .form-container {
            width: 100%;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        label {
            font-weight: 500;
            color: #333;
            width: 30%; /* Lebar label */
            margin-right: 10px;
            text-align: right;
        }

        input[type="text"],
        select,
        input[type="file"] {
            width: 70%; /* Lebar input */
            padding: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 15px;
        }

        input[type="submit"] {
            background-color: #8B0000;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 15px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #6A0D0D;
        }

        .text-danger {
            color: #ff0000;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 10px;
            margin-left: 30%; /* Sesuaikan posisi error */
        }
    </style>
</head>

<body>
    <div class="card">
        <h3>CREATE USER</h3>

        <div class="form-container">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama">
                </div>
                @foreach ($errors->get('nama') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach

                <div class="form-group">
                    <label for="npm">NPM:</label>
                    <input type="text" id="npm" name="npm" placeholder="Masukkan NPM">
                </div>
                @foreach ($errors->get('npm') as $msg)
                    <p class="text-danger">{{ $msg }}</p>
                @endforeach

                <div class="form-group">
                    <label for="id_kelas">Kelas :</label>
                    <select name="kelas_id" id="kelas_id" required>
                        @foreach ($kelas as $kelasItem)
                            <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="jurusan_id">Jurusan:</label>
                    <select name="jurusan_id" id="jurusan_id">
                        <option value="" disabled selected>-- Pilih Jurusan --</option>
                        @foreach ($jurusan as $jurusanItem)
                            <option value="{{ $jurusanItem->id }}"
                                {{ old('jurusan_id') == $jurusanItem->id ? 'selected' : '' }}>
                                {{ $jurusanItem->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="foto">Foto Profil:</label>
                    <input type="file" id="foto" name="foto" accept="image/*">
                </div>

                <div class="form-group" style="justify-content: center;">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<!-- Include Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #D91656;
    }

    .card {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.1);
        padding: 30px;
        width: 100%;
        max-width: 450px; /* Max width to control form size */
        margin: 20px;
        box-sizing: border-box;
        border: 1px solid #D91656;
    }

    .header {
        text-align: center;
        margin-bottom: 25px;
    }

    .header h1 {
        color: #D91656;
        margin: 0;
        font-size: 24px; /* Slightly larger font size */
        font-weight: 600;
    }

    label {
        color: #D91656;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    input[type="text"], select, input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #D91656;
        border-radius: 8px; /* More rounded corners */
        margin-bottom: 20px; /* Add margin to separate fields */
        font-size: 14px;
    }

    button[type="submit"] {
        background-color: #D91656;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #A91242;
    }

    .text-danger {
        color: red;
        font-size: 12px;
        margin: 5px 0;
    }

    .img-preview {
        margin-bottom: 20px;
        text-align: center;
    }

    .img-preview img {
        max-width: 120px; /* Set max width for image */
        border-radius: 8px;
        margin-top: 10px;
    }

    @media (max-width: 500px) {
        .card {
            padding: 20px;
        }

        .header h1 {
            font-size: 20px; /* Smaller font for small screens */
        }

        input[type="text"], select, input[type="file"], button[type="submit"] {
            font-size: 13px; /* Smaller font for small screens */
        }
    }
</style>

<div class="card">
    <div class="header">
        <h1>Edit Pengguna</h1>
    </div>
    
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Method PUT for edit -->

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
        @foreach($errors->get('nama') as $msg)
        <p class="text-danger">{{ $msg }}</p>
        @endforeach

        <label for="npm">NPM:</label>
        <input type="text" id="npm" name="npm" value="{{ old('npm', $user->npm) }}" required>
        @foreach($errors->get('npm') as $msg)
        <p class="text-danger">{{ $msg }}</p>
        @endforeach

        <label for="kelas">Kelas:</label>
        <select name="kelas_id" id="kelas_id" required>
            @foreach ($kelas as $kelasItem)
            <option value="{{ $kelasItem->id }}" 
                {{ (old('kelas_id', $user->kelas_id) == $kelasItem->id) ? 'selected' : '' }}>
                {{ $kelasItem->nama_kelas }}
            </option>
            @endforeach
        </select>

        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*">
        @foreach($errors->get('foto') as $msg)
        <p class="text-danger">{{ $msg }}</p>
        @endforeach

        <div class="img-preview">
            @if($user->foto)
                <p>Foto Saat Ini:</p>
                <img src="{{ asset($user->foto) }}" alt="User Photo">
            @endif
        </div>

        <button type="submit">Update</button><br>
    </form>
</div>
@endsection

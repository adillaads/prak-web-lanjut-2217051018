@extends('layouts.app')

@section('content')
<!-- Include Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif; /* Use Poppins font */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #D91656; /* Set background color to #D91656 */
    }

    .card {
        background-color: white;
        border-radius: 20px; /* Increased border radius for a softer look */
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.2); /* Deeper shadow for a more pronounced effect */
        padding: 40px; /* Increased padding */
        width: 400px; /* Increased width */
        border: 2px solid #D91656; /* Set border color to #D91656 */
        display: flex; /* Flexbox for vertical layout */
        flex-direction: column; /* Stack elements vertically */
    }

    .header {
        text-align: center; /* Center align header text */
        margin-bottom: 20px; /* Space below header */
    }

    .header h1 {
        color: #D91656; /* Header text color */
        margin-bottom: 10px; /* Space below header */
        font-size: 24px; /* Larger font size for header */
    }

    label {
        color: #D91656; /* Set label color to #D91656 */
        font-weight: bold;
        margin-bottom: 5px;
        display: block; /* Display labels as block elements */
    }

    input[type="text"], select {
        width: 100%;
        padding: 12px; /* Increased padding for input fields */
        border: 2px solid #D91656; /* Set input border color to #D91656 */
        border-radius: 5px; /* Smaller border radius for input fields */
        margin-bottom: 15px; /* Space below input fields */
    }

    button[type="submit"] {
        background-color: #D91656; /* Set button background color to #D91656 */
        color: white;
        border: none;
        border-radius: 5px; /* Smaller border radius for button */
        padding: 12px; /* Increased padding */
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        border: 2px solid #D91656; /* Set button border color to #D91656 */
        transition: background-color 0.3s ease; /* Smooth transition for hover effect */
    }

    button[type="submit"]:hover {
        background-color: #A91242; /* Darker shade for hover effect */
    }

    .text-danger {
        color: red;
        font-size: 14px;
        margin: 5px 0;
    }
</style>

<div class="card">
    <div class="header">
        <h1>Tambah Pengguna</h1>
    </div>
    
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        @foreach($errors->get('nama') as $msg)
        <p class="text-danger">{{ $msg }}</p>
        @endforeach

        <label for="npm">NPM :</label>
        <input type="text" id="npm" name="npm" required>
        @foreach($errors->get('npm') as $msg)
        <p class="text-danger">{{ $msg }}</p>
        @endforeach

        <label for="kelas">Kelas :</label>
        <select name="kelas_id" id="kelas_id" required>
            @foreach ($kelas as $kelasItem)
            <option value="{{ $kelasItem->id }}"> {{ $kelasItem->nama_kelas }}</option>
            @endforeach
        </select>

        <label for="foto">Foto : </label>
        <input type="file" id="foto" name="foto" accept="image/*"><br><br>
        @foreach($errors->get('foto') as $msg)
        <p class="text-danger">{{ $msg }}</p>
        @endforeach

        <button type="submit">Submit</button><br>
    </form>
</div>
@endsection

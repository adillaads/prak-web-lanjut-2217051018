@extends('layouts.app')

@section('content')
<!-- Include Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif; /* Use Poppins font for the entire body */
    }

    .container {
        margin-top: 20px;
    }

    h2 {
        margin-bottom: 20px;
    }

    .table {
        margin-top: 20px;
        border: 1px solid #dee2e6; /* Optional: Add border to the table */
    }

    .table th, .table td {
        padding: 12px; /* Optional: Adjust padding for table cells */
    }

    .alert {
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff; /* Bootstrap primary button color */
        border-color: #007bff; /* Bootstrap border color */
    }

    .btn-warning {
        background-color: #ffc107; /* Bootstrap warning button color */
        border-color: #ffc107; /* Bootstrap border color */
    }

    /* Optional: Additional styles for buttons on hover */
    .btn-primary:hover {
        background-color: #0056b3; /* Darker shade on hover */
        border-color: #0056b3; /* Darker border color on hover */
    }

    .btn-warning:hover {
        background-color: #e0a800; /* Darker shade on hover */
        border-color: #e0a800; /* Darker border color on hover */
    }
</style>

<div class="container">
    <h2>Daftar Pengguna</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('user.create') }}" class="btn btn-primary mb-3">Tambah Pengguna Baru</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NPM</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->npm }}</td>
                <td>{{ $user->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</td>
                <td>
                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning mb-3">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

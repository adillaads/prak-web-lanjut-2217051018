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

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .table {
        margin-top: 20px;
        border: 1px solid #dee2e6; /* Optional: Add border to the table */
    }

    .table th, .table td {
        padding: 12px; /* Optional: Adjust padding for table cells */
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    /* Optional: Additional styles for buttons on hover */
    .btn-success:hover {
        background-color: #218838; /* Darker shade on hover */
    }

    .btn-danger:hover {
        background-color: #c82333; /* Darker shade on hover */
    }
</style>

<div class="container mt-5">
    <h1>List Data</h1>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('user.create') }}" class="btn btn-success mb-3">Tambah User</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NPM</th>
                <th>Kelas</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->nama }}</td> <!-- Changed from $user->name to $user->nama -->
                <td>{{ $user->npm }}</td>
                <td>{{ $user->kelas->nama_kelas ?? 'Kelas Tidak Ditemukan' }}</td>
                <td>
                    <img src="{{ asset($user->foto) }}" alt="Foto User" width="100">
                </td>
                <td>
                    <!-- View button -->
                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-warning mb-2">Lihat</a>
                    <!-- Edit button -->
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary mb-2">Edit</a>
                    <!-- Delete form -->
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
